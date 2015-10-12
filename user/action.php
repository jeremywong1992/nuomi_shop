<?php 
	include './init.php';
	$order = $_GET['order'];
    $id = $_GET['id'];
	switch($order){

		case '0':
            $sql = 'update `order` set status=1 where id='.$id;
			//执行sql语句
			$result = execute($sql);
            header('location:index.php');
			break;
		case '2':
            $sql = 'update `order` set status=3,comeback=0 where id='.$id;
			//执行sql语句
			$result = execute($sql);
            header('location:index.php');
			break;
		case '3':
            $sql = 'update `order` set status=4,comeback=1 where id='.$id;
			//执行sql语句
			$result = execute($sql);
            header('location:index.php');
			break;
		case '4':
            $sql = 'update `order` set status=5 where id='.$id;
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
