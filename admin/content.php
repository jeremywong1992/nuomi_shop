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
    <body class="w">
        	<div style="text-align:left;" class="fl"><iframe src="<?php echo APP?>admin/menu.php" name="menu" width="240px" height="830px" scrolling="no" frameborder="0"></iframe></div>
        	<div style="text-align:right;" class="fr"><iframe src="<?php echo APP?>admin/main.php" name="main" width="950px" height="830px" scrolling="no" frameborder="0"></iframe></div>
        	<div class="clear"></div>
    </body>
</html>
