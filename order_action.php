<?php
    include './init.php';
    foreach($_SESSION['cart'] as $key => $val){
        $price = $_SESSION['cart'][$key]['sum'];
        $addtime = time();
        $address_id = $_POST['address'];
        $sql = "insert into `order`(user_name,addtime,goods_id,num,price,address_id) value('{$_SESSION['login']['name']}',{$addtime},{$key},{$_SESSION['cart'][$key]['num']},{$price},$address_id)";
        execute($sql);
        $sql = "update goods set store= store-'{$val['num']}' where id='{$key}'";
        execute($sql);
    }
    unset($_SESSION['cart']);
    jump('提交成功','./index.php');
?>
