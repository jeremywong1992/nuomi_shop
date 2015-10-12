<?php
    //传入sql语句，做查询操作，返回结果集数组
    function query($sql){
        mysql_connect(HOST,USER,PWD) or die('数据库连接失败');
        mysql_select_db(DB);
        mysql_set_charset('utf8');
        $result = mysql_query($sql);
        if($result && mysql_affected_rows() > 0){
            while($row = mysql_fetch_assoc($result)){
                $list[] = $row;
            }
            mysql_free_result($result);
        }else{$list = false;}
        mysql_close();
        return $list;
    }
    //执行操作，最终返回受影响行数或者最后插入id  增 删 改
    function execute($sql){
        mysql_connect(HOST,USER,PWD) or die('数据库连接失败');
        mysql_select_db(DB);
        mysql_set_charset('utf8');
        $result = mysql_query($sql);
        if($result){
            $info =  mysql_insert_id()?mysql_insert_id():mysql_affected_rows();
            mysql_close();
        }
        return $info;
    }

    //跳转函数
    function jump($msg,$des,$time =3){
        include PATH.'include/jump.php';
    }

    //第一个参数  要上传哪个 表单中的名字
    //要上传到哪里
    function upload($field,$path){
        //判断错误
        if($_FILES[$field]['error'] != 0) exit('上传出错');

        //获取文件信息
        list($maintype,$subtype) = explode('/',$_FILES[$field]['type']);

        //判断上传的文件是否是指定类型
        if($maintype != 'image') exit('请上传图片');

        //产生新的文件名
        if($subtype == 'jpeg') $subtype = 'jpg';
        $newfile = md5(uniqid()).'.'.$subtype;
        
        //拼接保存文件的完整路径
        $newpath = rtrim($path,'/').'/'.$newfile;

        $res = move_uploaded_file($_FILES[$field]['tmp_name'],$newpath);
        if($res){
            return $newfile;
        }else{
            return '上传失败';
        }
    }
     function zoom($path,$width=200,$height=200){

        //获取图片信息
        $info = getimagesize($path);

        //判断是不是图片
        if(!$info) exit('请处理图片');
        $arr = explode('/',$info['mime']);
        $ext = $arr[1];

        //拼接相关函数  打开  保存
        $create = 'imagecreatefrom'.$ext;
        $save = 'image'.$ext;
        

        //获取图片原有信息
        list($t_w,$t_h) = $info;

        //要计算图片最终的宽高
        //假设按照图片的宽度来,计算出图片的高度
        $des_w = $width;
        $des_h = $des_w * ($t_h / $t_w);

        
        //图片缩放之后的尺寸
        if($des_h >  $height){
            $des_h = $height;
            $des_w = $height * ($t_w / $t_h);
        }else{
            $des_w = $width;
            $des_h = $des_w * ($t_h / $t_w);
        }

        //创建画布
        $huabu = imagecreatetruecolor($width,$height);
        $white = imagecolorallocate($huabu, 255, 255, 255);
        imagefill($huabu, 0, 0, $white);
        $meizi = $create($path);
        
        //画布的起点
        //横坐标  （画布的宽度 - 目标的宽度）/2
        $hua_x = ($width - $des_w) / 2;
        //纵坐标   (画布的高度 - 目标的高度) /2
        $hua_y = ($height - $des_h) / 2;

        imagecopyresampled($huabu,$meizi, $hua_x,$hua_y, 0,0, $des_w,$des_h, $t_w,$t_h);
        if($ext == 'jpeg') $ext = 'jpg';
        $filename = basename($path);
        $filename = substr($filename,0,strrpos($filename,'.'));
        $newname =$filename.'.'.$ext;
        $savepath = rtrim(dirname($path),'/').'/'.$newname;
        $save($huabu,$savepath);
        imagedestroy($huabu);
        imagedestroy($meizi);

        //返回新的文件名，以备使用
        return $newname;
    }
     function goodszoom($path,$width=470,$height=284){

        //获取图片信息
        $info = getimagesize($path);

        //判断是不是图片
        if(!$info) exit('请处理图片');
        $arr = explode('/',$info['mime']);
        $ext = $arr[1];

        //拼接相关函数  打开  保存
        $create = 'imagecreatefrom'.$ext;
        $save = 'image'.$ext;
        

        //获取图片原有信息
        list($t_w,$t_h) = $info;

        //要计算图片最终的宽高
        //假设按照图片的宽度来,计算出图片的高度
        $des_w = $width;
        $des_h = $des_w * ($t_h / $t_w);

        
        //图片缩放之后的尺寸
        if($des_h >  $height){
            $des_h = $height;
            $des_w = $height * ($t_w / $t_h);
        }else{
            $des_w = $width;
            $des_h = $des_w * ($t_h / $t_w);
        }

        //创建画布
        $huabu = imagecreatetruecolor($width,$height);
        $white = imagecolorallocate($huabu, 255, 255, 255);
        imagefill($huabu, 0, 0, $white);
        $meizi = $create($path);
        
        //画布的起点
        //横坐标  （画布的宽度 - 目标的宽度）/2
        $hua_x = ($width - $des_w) / 2;
        //纵坐标   (画布的高度 - 目标的高度) /2
        $hua_y = ($height - $des_h) / 2;

        imagecopyresampled($huabu,$meizi, $hua_x,$hua_y, 0,0, $des_w,$des_h, $t_w,$t_h);
        if($ext == 'jpeg') $ext = 'jpg';
        $filename = basename($path);
        $filename = substr($filename,0,strrpos($filename,'.'));
        $newname =$filename.'.470_284'.'.'.$ext;
        $savepath = rtrim(dirname($path),'/').'/'.$newname;
        $save($huabu,$savepath);
        imagedestroy($huabu);
        imagedestroy($meizi);

        //返回新的文件名，以备使用
        return $newname;
    }
