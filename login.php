<?php
    include('./init.php');

    if(!empty($_POST['vcode'])){
        $vcode = $_POST['vcode'];
        if(strtolower($_SESSION['vcode'])!=strtolower($vcode)){
            jump('验证码错误','./login.php');
            exit;
        }
    }
    if(!empty($_POST['name'])&&!empty($_POST['pwd'])){
        if(empty($_POST['vcode'])) exit(jump('请输入验证码','./login.php'));
        $name = $_POST['name'];
        $pwd = md5($_POST['pwd']);
        $sql = "select * from user where name='{$name}'";
        $result = query($sql)[0];
        if(!$result){
            jump('不存在的用户','./login.php');
            exit;
        }
        $tpassword = $result['password'];
        if($pwd == $tpassword){
            $user['name'] = $name;
            $user['pwd'] = $pwd;
            $user['lv'] = $result['level'];
            $user['id'] = $result['id'];
            if($result['display']==0){
                jump('此用户已经被禁用，请砍掉重练','./index.php');
                exit;
            }
            $_SESSION['login'] = $user;
            $sql = 'update user set login_time='.time().' where id='.$result['id'];
            execute($sql);
            if(isset($_SESSION['jump'])){
                jump('登录成功！ 欢迎回来 '.$name.'君',$_SESSION['jump']); 
            }else{
                jump('登录成功！ 欢迎回来 '.$name.'君','./index.php',100000);
            }
            exit;
        }else{
            jump('密码错误！','./login.php');
            exit;
        }
    }
?><!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title>Index</title>
        <link href="./public/login.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div id="top" style="border-bottom:1px #dedede solid;">
            <div class="w980" style="padding:20px 20px 12px 20px;">
                <div class="left fl">
                    <div style="background-image:url(./public/images/20141111165157.png);width:104px;height:45px;margin-right:20px;" class="fl"></div>
                    <div style="padding:3px 20px;border-left:2px solid #dedede;color:#666;" class="fl mt10">登陆</div>
                </div>
                <div class="right fr" style="margin-top:10px;">
                    <span style="font-size:14px;">还没有百度糯米帐号</span>
                    <a style="padding:10px 20px;border:1px solid #ccc;font-weight:bold;" href="./register.php">注册</a>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div id="content" style="background-color:#f5fbfd;border-bottom:#dbdbdb 5px solid">
            <div class="w980" style="padding:50px 0 30px 0;">
                <div style="background-image:url(./public/images/login-logo_cdc50ad.png);width:623px;height:337px;" class="fl"></div>
                <div style="border:#eee 1px solid;background-color:#fff;padding:20px 15px;" class="fl">
                    <div style="font-weight:bold;font-family:黑体;color:#666666;font-size:17px;">登陆百度糯米</div>
                    <form action="" method="post">
                        <input type="text" name="name" placeholder="请输入用户名"><br>
                        <input type="password" name="pwd"><br>
                        <div>
                            <font color="#666" style="font-family:黑体;">验证码：</font>
                            <input type="text" name="vcode" style="width:100px;">
                            <img style="position:relative;top:14px;"src="./vcode/vcode.php" />
                        </div>
                        <input type="submit" class="submit" value="登陆">
                        
                    </form>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="w-footer-mini" alog-alias="bainuo-order-footermini" alog-group="bainuo-order-footermini">
            <div class="wrap">
                <div class="links">
                    <a href="http://www.nuomi.com/about" class="link">关于百度糯米</a><span>|</span>
                    <a href="http://www.nuomi.com/help" class="link">常见问题</a><span>|</span>
                    <a href="javascript:;" class="link" id="j-tttel">廉政反馈</a><span>|</span>
                    <a href="http://www.nuomi.com/help/api" class="link">开放平台</a><span>|</span>
                    <a href="http://www.nuomi.com/about/eula" class="link">用户协议</a><span>|</span>
                    客服电话：<span class="tel">4006-888-887</span>（每天9:00 - 22:00）</div>
                    <div class="site-info">
                        <span class="copyright">&copy;</span>2014&nbsp;nuomi.com &nbsp;<a href="http://www.miitbeian.gov.cn" class="link" target="_blank">京ICP证060807号京公网安备</a>
&nbsp;京公网安备11010802014106号&nbsp;<a href="http://S1.nuomi.bdimg.com/vone/img/license_v.jpg" class="link" target="_blank">工商注册号110000450203508</a>
&nbsp;<a href="http://S1.nuomi.bdimg.com/vone/img/certificate.jpg" class="link" target="_blank">互联网药品信息服务资格证编号（京-经营性-2011-0009）</a>
                    </div>
            </div>
        </div>
    </body>
</html>

