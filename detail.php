<?php include './header.php';?>
<?php
    if(empty($_GET['gid'])) header('location:index.php');
    $sql = 'select * from goods where id='.$_GET['gid'];
    $good = query($sql)[0];
    $good['view']++;
    $sql = 'update goods set view='.$good['view'].' where id='.$_GET['gid'];
    execute($sql);
?>
<div style="border:1px solid #dedede;padding:20px 0 40px 0;text-align:center;">
    <div class="w">
        <div class="left fl" style="padding-right:40px;">
            <div style="padding-bottom:20px;"><img src="<?php echo APP.'upload/goods/'.$good['bigimage']?>" width="470" height="284"></div>
            <div style="text-align:left;"><img src="<?php echo APP.'upload/goods/'.$good['image']?>" width="100" height="100"></div>
        </div>
        <div class="right fl" style="width:440px;">
            <div style="font-size:24px;text-align:left;"><?php echo $good['name']?></div>
            <div style="color:#999;font-size:14px;text-align:left;margin:20px 0 20px 0;"><?php echo $good['miaoshu']?></div>
            <div>
                <div style="background-color:#fafafa;margin-right:2px;text-align:center;padding:24px 30px;" class="fl"><?php echo $good['view']?>人已浏览</div>
                <div style="background-color:#fafafa;margin-right:2px;text-align:center;padding:24px 30px;" class="fl"><?php if($good['is_new']==1) echo '本宝贝为新品'; else echo'本宝贝距上架已有一段时间'?></div>
                <div style="background-color:#fafafa;margin-right:2px;text-align:center;padding:24px 30px;" class="fl">随便送</div>
                <div class="clear"></div>
            </div>
            <div>
                <div style="font:80px Arial;margin-right:50px;color:#fd8e51;" class="fl"><font style="font-size:30px;">￥</font><?php echo $good['price']?></div>
                <div style="font:15px Arial;margin-top:35px;color:#666;" class="fl"><font style="font-size:25px;">价值￥</font><del><?php echo $good['price']*1.3?></del></div>
                <div class="clear"></div>
            </div>
            <div style="text-align:left;width:300px;height:44px;margin-top:40px;">
                <form action="./cart_action.php?a=add" method="post">
                    <input type="hidden" name="id" value="<?php echo $good['id']?>"/>
                    <input type="hidden" name="store" value="<?php echo $good['store']?>"/>
                    <input type="hidden" name="price" value="<?php echo $good['price']?>"/>
                    <input type="hidden" name="name" value="<?php echo $good['name']?>"/>
                    <input type="hidden" name="image" value="<?php echo $good['image']?>"/>
                    <input type="submit" class="cart" value="加入购物车"/>
                </form>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="w" style="text-align:left;margin-top:20px;border-bottom:2px solid pink;padding-bottom:8px;">
    <a style="padding:10px 50px;background-color:#ff658e;font-weight:bold;color:#fff;" href="">宝贝详情</a>
</div>
<div style="margin-top:20px;">
    <img style="margin-right:15px;" src="./upload/goods/20141115220531.png">
    <img style="position:relative;top:-25px;" src="./upload/goods/<?php echo $good['bigimage']?>">
</div>
<?php include './footer.php';?>
