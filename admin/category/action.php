<?php 
	include '../common.php';
	$a = $_GET['a'];

	switch($a){

		case 'add':
			//添加分类
			$pid = $_POST['pid'];
			$name = $_POST['name'];
			//查询出指定pid的path和id  拼接成我们要用的path
            if($pid != 0){
                $sql = "select id,path from category where id={$pid}";
			    $list = query($sql)[0];
			    $path = $list['path'].$list['id'].',';
            }else{
                $path = '0,';
            }
			//准备sql语句
			$sql = "insert into category(name,pid,path) values('{$name}','{$pid}','{$path}')";
			$result = execute($sql);
			if($result){
				header('location:index.php?pid='.$pid);
			}else{
				header('location:'.$_SERVER['HTTP_REFERER']);
			}
			break;
		case 'del':
			$id = $_GET['id'];
			$sql = "delete from category where id={$id}";
			$result = execute($sql);
            $sql = "delete from category where pid={$id}";
            @execute($sql);
			if($result){
				jump('删除成功','./index.php',5);
			}else{
				jump('删除失败','./index.php',5);
			}
			break;
		case 'edit':
			//添加分类
			$pid = $_POST['pid'];
            $spid = $_POST['spid'];
			$name = $_POST['name'];
            echo "<pre>";
                print_r($_POST);
            echo "</pre>";

			//查询出指定pid的path和id  拼接成我们要用的path
            if($spid != 0){
                $sql = "select id,path,pid from category where id={$pid}";
                $list = query($sql)[0];
                $pid = $list['id'];
                $path = $list['path'].$_POST['pid'].',';
            }else{
                $path = '0,';
                $pid = '0';
            }
			//准备sql语句
			$sql = "update category set name='{$name}',pid='{$pid}',path='{$path}' where id='{$_POST['id']}'";
			$result = execute($sql);
			if($result){
				header('location:index.php?pid='.$pid);
			}else{
				header('location:'.$_SERVER['HTTP_REFERER']);
			}
			break;
        case 'userdisplay':
            $id = $_GET['id'];
            $display = $_GET['display'];
            if($display=='yes'){
                $sql = "update category set display=0 where id=$id";
            }else{
                $sql = "update category set display=1 where id=$id";
            }
            if(!execute($sql)) exit('执行失败');
            header('location:index.php');
	}
?>
