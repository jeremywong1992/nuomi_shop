<?php
    include './init.php';
    if(empty($_SESSION['login'])){
        $is_login = false;
   }else{
        $is_login = true;
   }
    if(!empty($_GET['login'])){
        unset($_SESSION['login']);
        jump('退出成功！','./index.php');
        exit;
    }
    if(!empty($_GET['search'])){
        $sql = "select * from goods where name LIKE '%{$_GET['search']}%'";
        $goods = query($sql);
    }else{
        //查询最热(浏览量)
        if(!empty($_GET['goods'])){
            switch($_GET['goods']){
                case 'hot':
                    $sql = 'select * from goods where is_up=1 order by view desc';
                    $goods = query($sql);
                    break;
                case 'price';
                    $sql = 'select * from goods where is_up=1 order by price';
                    $goods = query($sql);
                    break;
                case 'new';
                    $sql = 'select * from goods where is_up=1 order by addtime desc';
                    $goods = query($sql);
                    break;
            }
        }else{
            $sql = 'select * from goods where is_new=1 and is_up=1';
            $goods = query($sql);
        }
    }
    //查询类别
    $sql = 'select * from category where pid=0 and display=1 limit 9';
    $nav = query($sql);
    $sql = "select id,name,path,concat(path,id) bpath from category order by bpath";
    $catelist = query($sql);
    
    //查询本周精选
    $sql = 'select * from goods where bzjx=1';
    $bzjx = query($sql);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title>Index</title>
        <link href="<?php echo APP?>public/style.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div id="title" style="border-bottom:1px solid #Dedede;">
            <div class="w">
                <div class="fl">
                    <div class="fl font-bold">北京</div>
                    <div class="fl c1 ml10"><a href="">[切换城市]</a></div>
                </div>
                <div class="fr">
                    <?php 
                        if($is_login){
                            echo '<div class="fr c1 ml10" style="padding-right:10px;">欢迎您，<a href="" style="text-decoration:none;">'.$_SESSION['login']['name'].'</a></div>';
                            echo '<div class="fr c1 ml10" style="padding-right:10px;"><a style="text-decoration:none;" href="'.APP.'user/">我的糯米　|</a></div>';
                            if($_SESSION['login']['lv']==0){
                                echo '<div class="fr c1 ml10" style="padding-right:10px;"><a style="text-decoration:none;" href="'.APP.'admin/index.php">后台管理　|</a></div>';
                            }else{
                                echo '<div class="fr c1 ml10" style="border-right:2px #dedede solid;padding-right:10px;"><a style="text-decoration:none;" href="'.APP.'user/">个人中心</a></div>';
                            }
                            echo '<div class="fr c1 ml10" style="padding-right:5px;"><a style="text-decoration:none;" href="'.APP.'index.php?login=out">退出　|</a></div>';
                        }else{
                            echo '<div class="fr c1 ml10" style="padding-right:10px;"><a style="text-decoration:none;" href="'.APP.'register.php">注册　|</a></div>';
                            echo '<div class="fr c1 ml10" style="padding-right:10px;"><a style="text-decoration:none;" href="'.APP.'login.php">登陆　|</a></div>';
                        }
                    ?>          
                </div>
            </div>
        </div>
        <div id="head" class="w">
            <div class="left fl"><a href=""><img src="<?php echo APP?>upload/images/1.png" width="320" height="50"></a></div>
            <div class="center fl">
                <form action="">
                    <input type="text" name="search" class=" search fl s10 mt20 ml30"/>
                    <input type="submit" name="sub" value="搜索" class="sub fl mt20 font-bold s20"/>
                </form>
                <div class="fl ml30"><a href="">小吃快餐</a></div>
                <div class="fl ml10"><a href="">火锅</a></div>
                <div class="fl ml10"><a href="">真功夫</a></div>
                <div class="fl ml10"><a href="">周黑鸭</a></div>
                <div class="fl ml10"><a href="">小辉哥火锅</a></div>
            </div>
            <div class="right fr">
                <a href="" class="x1"></a>
            </div>
        </div>
        <div class="clear"></div>
        <div id="nav">
            <div class="w">
                <div class="left fl">全部团购分类</div>
                <div class="fl"><a class="n1" <?php if(empty($_GET['cid'])) echo 'style="background-color:#EE3968;"';?> href="<?php echo APP;?>index.php">首页</a></div>
                <?php 
                    foreach($nav as $val){
                        if(@$_GET['cid']==$val['id']) $select = 'style="background-color:#EE3968"'; else $select = '';
                        echo '<div class="fl"><a class="n2" '.$select.' href="'.APP.'index.php?cid='.$val['id'].'">'.$val['name'].'</a></div>';
                    }
                ?>
            </div>
            <div class="clear"></div>
        </div>

