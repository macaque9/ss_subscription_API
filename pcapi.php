<?php
require "./db_conf.php";
//偷懒改内容类型实现Json格式化，仅测试Chrome兼容性。
header('Content-disposition: attachment; filename=gui-config.json');
header('Content-type: application/json');
//登录配置 $username - $userport 简单防止注入
$userport = addslashes(sprintf(htmlspecialchars($_GET['port'])));//端口
$password = addslashes(sprintf(htmlspecialchars($_GET['passwd'])));//ss密码
//数据库配置
$con = mysqli_connect($db_host, $db_user, $db_pw, $db_name);// or die("Connection error." . mysqli_error());
//链接前缀
$after_ssr_url = 'ss://';
//验证账号密码正误
//$login_code 查询 判断状态1/0
$sql = "SELECT IF( EXISTS (SELECT * FROM `user` WHERE `user`.U_port = '" . $userport . "' AND `user`.U_pass = '" . $password . "') ,1 ,0) AS flag";
$login_code = mysqli_fetch_array(mysqli_query($con, $sql));
if ($login_code['flag'] == "1") {//验证状态重写了
//用户名密码正确时
    function get_ssr_url($server_id, $userport, $password, $con, $db_host, $db_user, $db_pw, $db_name, $after_ssr_url)
    {
//参数
        $user_method = "chacha20-ietf-poly1305";//$user_config['method'];//加密
//获取服务器配置 
        $sql = "SELECT * FROM `server` WHERE `SID` = '" . $server_id . "'";
        $server_config = mysqli_fetch_array(mysqli_query($con, $sql));
        $server_address = $server_config['S_IP'];//地址
        $server_name = $server_config['S_name'];//名称
//打印
        $array = array('server' => $server_address, 'server_port' => (int)$userport, 'password' => $password, 'method' => $user_method, 'plugin' => '', 'plugin_opts' => '', 'remarks' => $server_name, 'timeout' => 5);
        return $array;
    }
// 生成 去掉去掉
    $server_tw_url = get_ssr_url('1', $userport, $password, $con, $db_host, $db_user, $db_pw, $db_name, $after_ssr_url);
    $server_jp_url = get_ssr_url('2', $userport, $password, $con, $db_host, $db_user, $db_pw, $db_name, $after_ssr_url);
    $server_us_url = get_ssr_url('3', $userport, $password, $con, $db_host, $db_user, $db_pw, $db_name, $after_ssr_url);
//调用 处理换行和逗号
    $servArr = array($server_tw_url, $server_jp_url, $server_us_url);
    $array = array('configs' => $servArr, 'index' => (int)0);
    echo json_encode($array, JSON_PRETTY_PRINT);
} //用户名密码错误时
else {
    echo "401 Unauthorized";
}
?>
