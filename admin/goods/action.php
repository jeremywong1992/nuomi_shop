<?php 
	include '../common.php';
	$a = $_GET['a'];

	switch($a){

		case 'add':
			$name = $_POST['name'];
			$price = $_POST['price'];
			$cate_id = $_POST['class'];
			$store = $_POST['store'];
			$is_up = $_POST['is_up'];
			$is_new = $_POST['is_new'];
            $is_hot = $_POST['is_hot'];
            $miaoshu = $_POST['miaoshu'];
            $image = $_FILES['pic']['tmp_name'];
            $addtime = time();
            //验证用户数据
			if(empty($name)) exit(jump('商品名不能为空',$_SERVER['HTTP_REFERER']));
            if(empty($cate_id)) exit(jump('请选择类别',$_SERVER['HTTP_REFERER']));
            if(empty($image)) exit(jump('请上传商品图片',$_SERVER['HTTP_REFERER']));
            if(empty($price)) exit(jump('请输入价格',$_SERVER['HTTP_REFERER']));
            if(empty($is_up)) exit(jump('请选择是否上架',$_SERVER['HTTP_REFERER']));
            if(empty($is_new)) exit(jump('请选择是否新品',$_SERVER['HTTP_REFERER']));
            if(empty($is_hot)) exit(jump('请选择是否热门',$_SERVER['HTTP_REFERER']));
			//拼接sql语句
			$path = PATH.'upload/goods/';
			$filename = upload('pic',$path);
			$path = PATH.'upload/goods/'.$filename;
			$bigimage = goodszoom($path);
            $image = zoom($path);
			$sql = "insert into goods(name,price,cate_id,store,is_up,is_new,is_hot,miaoshu,image,bigimage,addtime) value('{$name}','{$price}','{$cate_id}','{$store}','{$is_up}','{$is_new}','{$is_hot}','{$miaoshu}','{$image}','{$bigimage}','{$addtime}')";

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
			$sql = "delete from goods where id={$id}";
			$result = execute($sql);
			if($result){
				jump('删除成功','./index.php',5);
			}else{
				jump('删除失败','./index.php',5);
			}
			break;
		case 'edit':
            $id = $_GET['id'];
			$name = $_POST['name'];
			$price = $_POST['price'];
			$cate_id = $_POST['class'];
			$store = $_POST['store'];
			$is_up = $_POST['is_up'];
			$is_new = $_POST['is_new'];
            $is_hot = $_POST['is_hot'];
            $miaoshu = $_POST['miaoshu'];
            $image = $_FILES['pic']['tmp_name'];
            $addtime = time();
            //验证用户数据
			if(empty($name)) exit('用户名不能为空');
            if(empty($cate_id)) exit('请选择类别');
			//拼接sql语句
            if(!empty($image)){
                $path = PATH.'upload/goods/';
			    $filename = upload('pic',$path);
			    $path = PATH.'upload/goods/'.$filename;
			    $newname = zoom($path,200,200);
			    unlink($path);
                $sql = "update goods set name='$name',price=$price,cate_id=$cate_id,store=$store,is_up=$is_up,is_new=$is_new,is_hot=$is_hot,miaoshu='$miaoshu',image='$newname',addtime=$addtime where id=$id";
            }else{
			    $sql = "update goods set name='$name',price=$price,cate_id=$cate_id,store=$store,is_up=$is_up,is_new=$is_new,is_hot=$is_hot,miaoshu='$miaoshu',addtime=$addtime where id=$id";
            }

			//执行sql语句
			$result = execute($sql);
			if($result){

				jump('修改成功','./index.php');
			}else{
				jump('修改失败','./add.php');
			}
			break;
        case 'updown':
            $id = $_GET['id'];
            $updown = $_GET['is_up'];
            if($updown=='yes'){
                $sql = "update goods set is_up=0 where id=$id";
            }else{
                $sql = "update goods set is_up=1 where id=$id";
            }
            if(!execute($sql)) exit('执行失败');
            header('location:index.php');
    }
?>
