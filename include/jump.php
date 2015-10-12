<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title>Index</title>
        <style type="text/css">
            #jump{width:600px;height:400px;position:absolute;top:50%;left:50%;margin-left:-300px;margin-top:-200px;background:#ccc;border-radius:20px;text-align:center;}
            #jump h2{color:white;padding-top:100px;}
        </style>
        <meta http-equiv="refresh" content="<?php echo $time?>;url=<?php echo $des?>">
    </head>
    <body>
        <div id="jump">
            <h2>提示信息</h2>
            <p><?php echo $msg?></p>
            <div><span><?php echo $time?>秒后跳转</span> <a href="<?php echo $des?>">立即跳转</a></div>
        </div>
    </body>
</html>

