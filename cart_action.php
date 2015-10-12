<?php
    include './init.php';

    $a = $_GET['a'];
    $id = $_POST['id'];
    echo "<pre>";
        print_r($_POST);
    echo "</pre>";

    switch($a){
        case 'add':
            $name = $_POST['name'];
            $image = $_POST['image'];
            $price = $_POST['price'];
            $num = 1;
            if(!empty($_SESSION['cart'][$id])) $num += $_SESSION['cart'][$id]['num'];
            $_SESSION['cart'][$id] = array(
                'name' => $name,
                'image' => $image,
                'price' => $price,
                'num' => $num,
                'store' => $store,
                'sum' => $num * $price
            );
            header('location:./cartlist.php');
            break;

        case 'del':
        	$id = $_GET['id'];
        	unset($_SESSION['cart'][$id]);
        	header('location:cartlist.php');
            break;

        case 'emp':
            unset($_SESSION['cart']);
            header('location:cartlist.php');
            break;
    }
?>
