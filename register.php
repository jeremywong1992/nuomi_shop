<?php
    include('./init.php');
    if(!empty($_GET['reg'])){
        @$name = $_POST['name'];
        @$pwd = $_POST['pwd'];
        @$rpwd = $_POST['rpwd'];
        @$sex = $_POST['sex'];
        @$age = $_POST['age'];
        $reg_time = time();

        //验证用户数据
        if(empty($name)) exit(jump('请输入姓名',$_SERVER['HTTP_REFERER']));
        if(!isset($_POST['sex'])) exit(jump('请选择性别',$_SERVER['HTTP_REFERER']));
        if(empty($age)) exit(jump('请输入年龄',$_SERVER['HTTP_REFERER']));
        if($pwd === '') exit(jump('密码不能为空',$_SERVER['HTTP_REFERER']));
        if($pwd != $rpwd) exit(jump('密码不一致',$_SERVER['HTTP_REFERER']));
        
        //密码加密
        $pwd = md5($pwd);
        if($_FILES['pic']['error']==0||!empty($_FILES['pic']['tmp_name'])){
            $path = PATH.'upload/user/';
            $filename = upload('pic',$path);
            $path = PATH.'upload/user/'.$filename;
            $newname = zoom($path);
            $sql = "insert into user(name,password,sex,age,pic,level,reg_time,login_time) value('{$name}','{$pwd}','{$sex}','{$age}','{$newname}','1','{$reg_time}','{$reg_time}')";
        }else{
            $sql = "insert into user(name,password,sex,age,level,reg_time) value('{$name}','{$pwd}','{$sex}','{$age}','1',{$reg_time})";
        }
        //执行sql语句
        $result = execute($sql);
        if($result){
            $user['name'] = $name;
            $user['pwd'] = $pwd;
            $user['lv'] = 1;
            $user['id'] = $result;
            $_SESSION['login'] = $user;
            exit(jump('注册成功','./index.php'));
        }else{
            exit(jump('注册失败','./register.php'));
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title>Index</title>
        <link href="<?php echo APP?>public/register.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div id="top" style="border-bottom:1px #dedede solid;">
            <div class="w980" style="padding:20px 20px 12px 20px;">
                <div class="left fl">
                    <div style="background-image:url(<?php echo APP?>public/images/20141111165157.png);width:104px;height:45px;margin-right:20px;" class="fl"></div>
                    <div style="padding:3px 20px;border-left:2px solid #dedede;color:#666;" class="fl mt10">注册</div>
                </div>
                <div class="right fr" style="margin-top:10px;">
                    <span style="font-size:14px;">已有百度糯米帐号</span>
                    <a style="padding:10px 20px;border:1px solid #ccc;font-weight:bold;" href="<?php echo APP?>login.php">登陆</a>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div id="content" style="background-color:#f5fbfd;border-bottom:#dbdbdb 5px solid">
            <div class="w980" style="padding:50px 0 30px 0;">
                <div style="background-image:url(<?php echo APP?>public/images/login-logo_cdc50ad.png);width:623px;height:337px;" class="fl"></div>
                <div style="background-color:#fff;" class="fr">
                    <form action="<?php echo APP.'register.php?reg=new'?>" method="post" enctype="multipart/form-data">
                        <div class="left fl mt10">
                            <div class="menu">昵　　称</div>
                            <div class="menu">性　　别</div>
                            <div class="menu">年　　龄</div>
                            <div class="menu">密　　码</div>
                            <div class="menu">确认密码</div>
                        </div>
                        <div class="right fr mt10">
                            <div class="input">
                                <div class="fl">
                                    <input class="add" type="text" name="name" />
                                </div>
                            </div>
                            <div class="input x1">
                                <div class="fl">
                                    <input type="radio" name="sex" value="0" />男
                                    <input type="radio" name="sex" value="1" />女
                                </div>
                            </div>
                            <div class="input">
                                <div class="fl">
                                    <input class="add" type="text" name="age" />
                                </div>
                            </div>
                            <div class="input">
                                <input type="password" class="fl add" name="pwd">
                            </div>
                            <div class="input">
                                <input type="password" class="fl add" name="rpwd">
                            </div>
                        </div>
                        <div class="bottom">
                            <input type="submit" class="sub" name="submit" value="完成注册">
                        </div>
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


