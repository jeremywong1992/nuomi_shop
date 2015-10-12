<?php 
	include '../common.php';
	$order = $_GET['order'];
    $id = $_GET['id'];
	switch($order){

		case '0':
            $sql = 'update `order` set status=1 where id='.$id;
			//执行sql语句
			$result = execute($sql);
            header('location:index.php');
			break;
		case '1':
            $sql = 'update `order` set status=0 where id='.$id;
			//执行sql语句
			$result = execute($sql);
            header('location:index.php');
			break;
		case '4':
            $sql = 'update `order` set status=6 where id='.$id;
			//执行sql语句
			$result = execute($sql);
            header('location:index.php');
			break;
		case 'del':
			$sql = "delete from `order` where id={$id}";
			$result = execute($sql);
            header('location:index.php');
			break;
    }
?>
