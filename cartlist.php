    <?php include './header.php';?>
	<div id="shopcar" class="shopcar w1">
		<div class="title" style="text-align:left;"><img src="<?php echo APP?>public/images/shoppingtitle1.jpg"/></div>
		<div class="mt20">
			<table cellspacing="0" cellpadding="0" width="980">
				<tr class="color">
					<th width="120">商品</th>
					<th width="300">商品名</th>
					<th>单价</th>
					<th>数量</th>
					<th>小计</th>
					<th>操作</th>
				</tr>
                <?php 
                    if(empty($_SESSION['cart'])){
                        echo '<tr>';
                        echo '<td colspan="6"><font size="5" color="red">购物车为空</font></td>';
                        echo '</tr>';                     
                        exit;
                    }
                ?>
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
					<td><a href="cart_action.php?a=del&id=<?php echo $key?>">删除</a></td>
                    <?php $sum += $val['sum']?>
				</tr>
			<?php endforeach;?>
				<tr class="color count">
					<td><a href="cart_action.php?a=emp">清空购物车</a></td>
					<td colspan="5" style="text-align:right;"><span>总计：￥<?php echo $sum;?></span></td>
				</tr>
				</table>
				<div class="bottom">
					<div class="right fr"> <a href="./index.php"><img src="<?php echo APP?>public/images/2013-12-05_144221.png"/></a>　　<a href="order_inf.php"><img src="<?php echo APP?>public/images/2013-12-05_103427.png"/></a></div>
					<div class="clear"></div>
				</div>	
		</div>
	</div>

<?php include './footer.php';?>

