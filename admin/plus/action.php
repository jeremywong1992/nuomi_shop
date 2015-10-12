<?php 
	include '../common.php';
	$bzjx = $_GET['bzjx'];

	switch($bzjx){

		case 'on':
			$id = $_GET['id'];
			$sql = 'select count(*) from goods where bzjx=1';
			//执行sql语句
			$result = query($sql)[0]['count(*)'];
            if($result >= 2){
                exit(jump('本周精选已经达到饱和状态','./index.php'));
            }
			$sql = 'update goods set bzjx=1 where id='.$id;
            if(execute($sql)){
                jump('已经将本商品标记为本周精选','./index.php');
            }else{
                jump('标记失败，请技术员及早修复','./index.php');
            }
			break;
		case 'off':
			$id = $_GET['id'];
			$sql = 'select count(*) from goods where bzjx=1';
			//执行sql语句
			$result = query($sql)[0]['count(*)'];
            if($result <= 1){
                exit(jump('请必须完成至少1个商品的标记','./index.php'));
            }
			$sql = 'update goods set bzjx=0 where id='.$id;
            if(execute($sql)){
                jump('已经去除标记','./index.php');
            }else{
                jump('标记失败，请技术员及早修复','./index.php');
            }
			break;
    }
?>
