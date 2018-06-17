说明
---
Forked from[qinghuas/ss-panel-v3-subscription](https://github.com/qinghuas/ss-panel-v3-subscription)<br>
感谢 @qinghuas 的开源项目让我免去了重复造轮子的麻烦。<br>

不想安装面板的黑心老板也能以订阅链接的方式自动化分发链接信息了！（大雾）<br>
笔者偷懒用认证用户端口号与密码的方式进行api的身份认证，我是不是很机智(<ゝω·)☆~Kira <br>
加密方式已经钦定为`chacha20-ietf-poly1305` (๑•̀ㅂ•́)و✧ <br>

请注意：笔者仅为在iOS平台的shadowrocket上方便以订阅功能更新原版SS连接信息而编写，需要支持其他协议请自行修改。<br>

简介
---
本脚本适合不想安装面板的低调多用户小众机场管理员进行闷声大发财。<br>

更新日志
---
`2018.06.17` 新增功能，PC用户可以通过下载gui-config.json来获取更新。
`2017.12.17` 删繁就简，按照下面的说明配置好环境，导入sql文件，移动api.php到webroot就可以使用了！

系统需求
---

理论上来讲，本脚本可以在安装了PHP+WebServer+MySQL的Windows或Linux系统中正常运行。<br>

使用方法
---

0.准备工作：您需要在部署本脚本前安装Apache2/Nginx、MySQL和PHP，安装教程很多，此处不再赘述(笔者仅测试在MySQL5.7和PHP7下的可用性)。

1.安装Git 并Clone本项目

    yum install git -y
    git clone https://github.com/macaque9/ss_subscription_API.git
    
2.将项目中的api.php移动至webroot（或者webroot的子目录）。以Apache的webroot为例。

    cd ./ss_subscription_API
    mv ./api.php /var/www/html

3.修改db_conf.php，按提示填写自己的数据库连接信息。

    vim /var/www/html/db_conf.php
    
    注：不建议嫌麻烦的用户修改数据库名称，否则还要修改SQL文件。

4.修改api.php的34\~36行（pcapi.php修改33\~35行）的信息。有多少个服务器IP就按照格式写几行。分别通过生成连接字串的形式赋值。注意修改调用get_ss_url函数中的第一个字段。

5.修改api.php的38行（pcapi.php修改37行），拼接所有server_**_url字串

当服务器只有一台时<br>

    $array = array("$server_usa_url");

当有多台服务器`server_usa_url`，`server_hk_url`，`server_sg_url`时，应按照如下配置

    $array = array("$server_usa_url","\r\n","$server_hk_url","\r\n","$server_sg_url");

注：`"\r\n"`是为ss://链接换行，只需在倒数第二个服务器变量名后添加

6.在MySQL中执行ssapi.sql文件，并对应编辑服务器信息与用户的ss认证信息。

7.配置完成，假如您将文件放在了webroot中，且域名为`https://domain.com`，我们访问订阅地址<br>
`https://domain.com/api.php?port=端口&passwd=ss的密码`<br>
当所有配置正确时，您可看到一串长链接。当账号密码错误时，您可看到错误401的提示。<br>
PC版访问 `https://domain.com/api.php?port=端口&passwd=ss的密码`<br>
当所有配置正确时，您可看到浏览器提示下载配置文件，将配置文件放入ss的文件夹中即可。当账号密码错误时，您可看到错误401的提示。<br>

IOS平台订阅
---
打开Shadowsocket，点击右上方的+号，类型选择Subscribe，url输入订阅地址，备注自定义即可，点完成，Shadowsocket会自动获取配置<br>
可在“设置-其他-服务器订阅”中启用更多选项<br>

致谢
---
感谢原项目[qinghuas/ss-panel-v3-subscription](https://github.com/qinghuas/ss-panel-v3-subscription)和作者[qinghuas](https://github.com/qinghuas)
