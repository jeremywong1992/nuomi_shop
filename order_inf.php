<?php
    include './header.php';
    if(!isset($_SESSION['login'])){
        $url = $_SERVER['HTTP_REFERER'];
        header('location:login.php');
        $_SESSION['jump'] = $url;
        exit;
    }
    if(isset($_GET['address'])){
        if($_GET['address']=='add'){
            $sql = "insert into address(user_id,name,address,tel) value({$_SESSION['login']['id']},'{$_POST['name']}','{$_POST['address']}',{$_POST['tel']});";
            execute($sql);
        }elseif($_GET['address']=='del'){
            $id = $_GET['id'];
            $sql = 'delete from address where id='.$id;
            execute($sql);
        }
    }
    $sql = 'select * from address';
    $addlist = query($sql);

?>

	<div id="shopcar" class="shopcar w1">
		<div class="title" ><img src="<?php echo APP.'public/images/shoppingtitle2.jpg'?>"/></div>
		<!-- 统计用户信息的表单 -->
		<div>
			<div class="admin_form fl">
				<table width="500">
					<div class="user_index_title">收货信息</div>
					<!-- 如果有收货信息，则显示收货信息 -->
					<?php if(empty($addlist)||@$_GET['address']=='new'):?>
					<form action="order_inf.php?address=add" method="post">
						<tr>
							<th>收件人：</th>
							<td><input type="text" name="name" /></td>
						</tr>
						<tr>
							<th>联系电话：</th>
							<td><input type="text" name="tel" /></td>
						</tr>
						<tr>
							<th>详细地址：</th>
							<td><input type="text" name="address" /></td>
						</tr>
						<tr>
							<td colspan="2" class="submit"><input type="submit" value="添加地址" /><a href="order_inf.php">使用已有地址</a></td>
						</tr>
					</form>
					<?php else:?>
						<form action="order_action.php" method="post">
						<?php foreach($addlist as $val):?>
							<tr class="radio">
								<td width="5"><input type="radio" name="address" value="<?php echo $val['id']?>"/><span><?php echo $val['name'].'　　'.$val['tel'].'　　'.$val['address']?></span></td>
								<td width="10"><a href="order_inf.php?address=del&id=<?php echo $val['id']?>">删除</a></td>
							</tr>
						<?php endforeach;?>
							<tr><td colspan="2" class="submit"><a href="order_inf.php?address=new">使用新地址</a></td></tr>
					<?php endif;?>
				</table>
			</div>
			<div class="admin_form fl trans">
				<div class="user_index_title">配送方式</div>
				<div class="pay">货到付款</div>
			</div>
			<div class="clear"></div>
		</div>
		
		
		<!-- 商品清单 -->
		<div class="mt20">
			<?php if(!empty($_SESSION['cart'])):?>
			<table cellspacing="0" cellpadding="0" width="980">
			<div class="user_index_title">商品信息</div>
				<tr class="color">
					<th width="120">商品</th>
					<th width="300">商品名</th>
					<th>单价</th>
					<th>数量</th>
					<th>小计</th>
				</tr>
				<?php $sum=0;?>
				<?php foreach($_SESSION['cart'] as $key=>$val):?>
                    <tr class="goods">
                        <td><img src="<?php echo APP.'upload/goods/'.$val['image'] ?>" height="80"/></td>
                        <td><?php echo $val['name']?></td>
                        <td><?php echo $val['price']?></td>
                        <td>
                            <a href="cart_action.php?a=mf&id=9&value=1"><div class="icon min"></div></a>
                            <span><?php echo $val['num']?>&nbsp;</span>
                            <a href="cart_action.php?a=mf&id=9&value=3"><div class="icon add"></div></a>
                        </td>
                        <td><?php echo $val['sum']?></td>
                        <?php $sum += $val['sum']?>
                    </tr>
			    <?php endforeach;?>
				<tr class="color count">
					<td colspan="5" style="text-align:right;"><span>应付金额：￥<?php echo $sum ?> </span></td>
				</tr>
			</table>
			<div class="bottom">
				<div class="right fr">
					<?php if(empty($addlist)):?>
					<a href="#"><span class="order_error">还没有选择地址</span></a>
					<?php else:?>
					<input style="background-color:#ff658e;padding:10px 50px;border:none;font-weight:bold;color:#fff;font-size:20px;cursor:pointer;" type="submit" value="提交订单"/>
					<?php endif;?>
				</div>
					<div class="clear"></div>
			</div>
			<?php else:?>
			<div class="shop_empty" >购物车还没有货！亲，赶紧开心购物吧！！</div>
			<?php endif;?>			
			</form>
		</div>
	</div>
    <?php include './footer.php';?>
