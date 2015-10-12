<?php 
	include '../common.php';
	$a = $_GET['a'];

	switch($a){

		case 'add':
			@$name = $_POST['name'];
			@$pwd = $_POST['pwd'];
			@$rpwd = $_POST['rpwd'];
			@$sex = $_POST['sex'];
			@$age = $_POST['age'];
			@$level = $_POST['level'];
			if(empty($name)) exit(jump('请输入姓名',$_SERVER['HTTP_REFERER']));
            if(empty($sex)) exit(jump('请选择性别',$_SERVER['HTTP_REFERER']));
            if(empty($age)) exit(jump('请输入年龄',$_SERVER['HTTP_REFERER']));
            if(!isset($_POST['level'])) exit(jump('请选择级别',$_SERVER['HTTP_REFERER']));
			//验证用户数据
            if($pwd === '') exit(jump('密码不能为空',$_SERVER['HTTP_REFERER']));
			if($pwd != $rpwd) exit(jump('密码不一致',$_SERVER['HTTP_REFERER']));
			//密码加密
			$pwd = md5($pwd);
			//拼接sql语句
			if($_FILES['pic']['error']==0||!empty($_FILES['pic']['tmp_name'])){
				$path = PATH.'upload/user/';
				$filename = upload('pic',$path);
				$path = PATH.'upload/user/'.$filename;
				$newname = zoom($path);
				$sql = "insert into user(name,password,sex,age,level,pic) value('{$name}','{$pwd}','{$sex}','{$age}','{$level}','{$newname}')";
			}else{
				$sql = "insert into user(name,password,sex,age,level) value('{$name}','{$pwd}','{$sex}','{$age}','{$level}')";
			}
			//执行sql语句
			$result = execute($sql);
			if($result){

				jump('添加成功','./index.php');
			}else{
				jump('添加失败','./add.php');
			}
			break;
		case 'del':
			$id = $_GET['id'];
            if($id == 1){
                jump('无法删除炒鸡鹳狸猿','./index.php',3);
                break;
            }
			$sql = "delete from user where id={$id}";
			$result = execute($sql);
			if($result){
				jump('删除成功','./index.php',5);
			}else{
				jump('删除失败','./index.php',5);
			}
			break;
		case 'edit':
			$name = $_POST['name'];
			$sex  = $_POST['sex'];
			$age = $_POST['age'];
			$level = $_POST['level'];
            if(!empty($_POST['pwd'])){
                $pwd = $_POST['pwd'];
			    $rpwd = $_POST['rpwd'];
                if($pwd != $rpwd) exit(jump('密码输入不一致',$_SERVER['HTTP_REFERER']));
                $pwd = md5($pwd);
                $pwdname = "password='$pwd',";
            }else{
                $pwdname = '';
            }
			$id=$_GET['id'];
			mysql_connect(HOST,USER,PWD) or die('数据库连接失败');
			mysql_select_db(DB);
        	mysql_set_charset('utf8');
        	if($_FILES['pic']['error']==0||!empty($_FILES['pic']['tmp_name'])){
				$path = PATH.'upload/user/';
				$filename = upload('pic',$path);
				$path = PATH.'upload/user/'.$filename;
				$newname = zoom($path);
				$sql = "update user set name='{$name}',{$pwdname}sex={$sex},age={$age},level='{$level}',pic='{$newname}' where id={$id}";
			}else{
				$sql = "update user set name='{$name}',sex={$sex},age={$age},{$pwdname}level='{$level}' where id={$id}";
			}
			if(!mysql_query($sql)) exit('更新失败！');
			jump('更新成功','./index.php');
            break;
        case 'userdisplay':
            $id = $_GET['id'];
            $display = $_GET['display'];
            if($display=='yes'){
                $sql = "update user set display=0 where id=$id";
            }else{
                $sql = "update user set display=1 where id=$id";
            }
            if(!execute($sql)) exit('执行失败');
            header('location:index.php');
    }
?>
