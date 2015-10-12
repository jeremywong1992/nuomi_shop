<?php
    //开启session
    session_start();

    //设置字符集
    header("content-type:text/html;charset=utf-8");

    //定义绝对路径
    define('PATH', str_replace('\\','/',dirname(__FILE__)).'/../');        

    $des = strtolower(explode('/',$_SERVER['SERVER_PROTOCOL'])[0]).'://'.$_SERVER['SERVER_NAME'];
    $search = $_SERVER['DOCUMENT_ROOT'];
   
    //用于跳转
    define('APP',str_replace($search,$des,PATH));

    include PATH.'include/config.php';
    include PATH.'include/funcs.php';

    if(!isset($_SESSION['login']['lv'])) exit(jump('还没有登陆',APP.'login.php'));
    if($_SESSION['login']['lv'] != 0) exit(jump('您当前没有访问权限',APP.'index.php'));


?>

