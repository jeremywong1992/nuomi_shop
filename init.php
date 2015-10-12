<?php
    //开启session
    session_start();

    //设置字符集
    header("content-type:text/html;charset=utf-8");

    //定义绝对路径
    
    define('PATH', str_replace('\\','/',dirname(__FILE__)).'/');        //用于包含

    $des = strtolower(explode('/',$_SERVER['SERVER_PROTOCOL'])[0]).'://'.$_SERVER['SERVER_NAME'];
    $search = $_SERVER['DOCUMENT_ROOT'];
   
    define('APP',str_replace($search,$des,PATH));                       //用于跳转

    include PATH.'include/config.php';
    include PATH.'include/funcs.php';

?>
