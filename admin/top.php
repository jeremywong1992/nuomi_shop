<?php
    include './common.php';
    if(!empty($_GET['login'])){
        unset($_SESSION['login']);
        jump('退出成功！','./index.php');
        exit;
    }
    if(!empty($_GET['jump'])){
        header('location:'.APP.'index.php');
        exit;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title>Index</title>
        <link rel="stylesheet" href="<?php echo APP?>public/admin.css"/>
        <style type="text/css">
            body{background:#296cc4}
        </style>
    </head>
    <body>
        <div id="top" class="w1">
            <img style="margin-top:20px;" src="<?php echo APP?>public/images/admin_logo.png">
            <div class="btn fr">
                <a href=""><?php echo $_SESSION['login']['name']?></a>
                <a target="_top" href="./top.php?jump=index">返回首页</a>
                <a target="_top" href="./top.php?login=out">退出</a>
            </div>
        </div>
    </body>
</html>

