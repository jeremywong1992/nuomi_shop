<?php
session_start();

function test($height='30',$len='4',$type='3',$imgtype='jpeg'){
    //宽度根据字符数自动调整
    $width = ($height/2+5)*$len;
    $img = imagecreatetruecolor($width,$height);
    
    //动态填充背景颜色
    imagefilledrectangle($img,0,0, $width,$height,lightcolor($img));

    //画干扰点,干扰点的数量，根据图像大小调整，平均一个字符的位置100个点
    for($i = 0; $i < $height*$len; $i++){
        $x = mt_rand(0,$width);
        $y = mt_rand(0,$height);
        imagesetpixel($img,$x,$y,darkcolor($img));
    }

    //获取字符
    switch($type){
        //全部都是数字类型
        case 1:
            $str = join('',array_rand(range(0,9),$len));
            break;
        //小写字母
        case 2:
            $str = implode('',array_rand(array_flip(range(a,z)),$len));
            break;
        case 3:
            $string = '12345678901234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $str = substr(str_shuffle($string),0,$len);
            break;
    }
    //文字加入到图片中
    //imagettftext($img, 18, 0, 20, 30, darkcolor($img), 'msyh.ttf', $str ); 
    for($i=0;$i<$len;$i++):
        $x = ($height/2+5)*$i+5;
        $y = mt_rand( $height/2+5,$height-5);
        imagettftext($img, $height/2, mt_rand(-20,20), $x, $y, darkcolor($img), './msyh.ttf', $str[$i] );

    endfor;
    $_SESSION['vcode'] = $str;
    //动态输出各种格式
    $header = 'content-type:image/'.$imgtype;
	//echo '<br>';
    $func = 'image'. $imgtype;
   
    if(function_exists($func)):
    header($header);
    $func($img);
    imagedestroy($img);
    endif;


}

//定义颜色函数
    function lightcolor($img){
        return imagecolorallocate($img,mt_rand(150,255),mt_rand(150,255),mt_rand(150,255));
    }

    function darkcolor($img){
        return imagecolorallocate($img,mt_rand(0,120),mt_rand(0,120),mt_rand(0,120));
    }


test(40);
