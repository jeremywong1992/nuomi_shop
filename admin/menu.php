<?php
    include './common.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <link rel="stylesheet" href="<?php echo APP?>public/admin.css"/>
        <title>Index</title>
    </head>
    <body id="menu">
        <dl>
            <dt>用户管理</dt>
            <dd>
                <a href="./user/add.php" target="main">添加用户</a>
            </dd>
            <dd>
                <a href="./user/index.php" target="main">用户列表</a>
            </dd>
        </dl>
        <dl>
            <dt>类别管理</dt>
            <dd>
                <a href="./category/add.php" target="main">添加分类</a>
            </dd>
            <dd>
                <a href="./category/index.php" target="main">分类列表</a>
            </dd>
        </dl>
        <dl>
            <dt>商品管理</dt>
            <dd>
                <a href="./goods/add.php" target="main">添加商品</a>
            </dd>
            <dd>
                <a href="./goods/index.php" target="main">商品列表</a>
            </dd>
        </dl>    
        <dl>
            <dt>订单管理</dt>
            <dd>
                <a href="./order/index.php" target="main">订单列表</a>
            </dd>
        </dl>
        <dl>
            <dt>拓展模块</dt>
            <dd>
                <a href="./plus/index.php" target="main">本周精选</a>
            </dd>
            <dd>
                <a href="./plus/index.php" target="main">评论管理</a>
            </dd>
        </dl>
    </body>
</html>

