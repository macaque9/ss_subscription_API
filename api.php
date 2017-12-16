<?php
//登录配置 $username - $userport 简单防止注入
$userport = addslashes(sprintf(htmlspecialchars($_GET['port'])));//端口
$password = addslashes(sprintf(htmlspecialchars($_GET['passwd'])));//ss密码
//数据库配置
$db_host = 'localhost';$db_user = 'root';$db_pw = '<填写你的密码>';$db_name = 'ssapi';
$con = mysqli_connect($db_host, $db_user, $db_pw, $db_name);// or die("Connection error." . mysqli_error());
//链接前缀
$after_ssr_url = 'ss://';
//验证账号密码正误
//$login_code 查询 判断状态1/0
$sql = "SELECT IF( EXISTS (SELECT * FROM `user` WHERE `user`.U_port = '".$userport."' AND `user`.U_pass = '".$password."') ,1 ,0) AS flag";
$login_code=mysqli_fetch_array(mysqli_query($con, $sql));

if($login_code['flag']=="1") {//验证状态重写了
//用户名密码正确时
function get_ss_url($server_id, $userport, $password, $con, $db_host, $db_user, $db_pw, $db_name, $after_ssr_url)
{
//获取连接配置
    $user_method = "chacha20-ietf-poly1305";//加密
//获取服务器配置 
    $sql = "SELECT * FROM `server` WHERE `SID` = '".$server_id."'";
    $server_config = mysqli_fetch_array(mysqli_query($con, $sql));
    $server_address = $server_config['S_IP'];//地址
    $server_name = $server_config['S_name'];//名称
//生成
    $array = array("$user_method", ":", "$password", "@", "$server_address", ":", "$userport");
    $server_url_1 = implode($array);//此处得到的是连接配置明文
    $server_url_2 = (base64_encode($server_url_1));//此处得到的是被base64加密的连接配置明文
    $array = array("$after_ssr_url", "$server_url_2", "#", "$server_name");//将ss://与被base64加密的连接配置明文拼接
    $server_url_3 = implode($array);//此处得到完整的ss://链接
    return $server_url_3;
}
//生成
$server_tw_url = get_ss_url('1', $userport, $password, $con, $db_host, $db_user, $db_pw, $db_name, $after_ssr_url);
$server_jp_url = get_ss_url('2', $userport, $password, $con, $db_host, $db_user, $db_pw, $db_name, $after_ssr_url);
$server_us_url = get_ss_url('3', $userport, $password, $con, $db_host, $db_user, $db_pw, $db_name, $after_ssr_url);
//拼接
$array = array("$server_tw_url", "\r\n", "$server_jp_url", "\r\n", "$server_us_url");
$server_all_url_1 = implode($array);
$server_all_url_2 = (base64_encode($server_all_url_1));
echo "$server_all_url_2";
}
//用户名密码错误时
else{
    echo "401 Unauthorized";
} 
?>