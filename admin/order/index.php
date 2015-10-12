<?php 
	include '../admin_head.php';

	if(!empty($_GET['name'])){
		$name = $_GET['name'];
		$where = "where user_name like '%{$name}%'";
		$sql = "select count(*)  from `order` {$where}";
	}else{
		$where = "where user_name like '%%'";
		$sql = "select count(*)  from `order` {$where}";
	}
	$num = 10; //每个页面分为10条
	if(empty($_GET['p'])) $_GET['p'] = 1;
	$p = $_GET['p'];
	$total = query($sql)[0]['count(*)'];
	$pages = ceil($total / $num);
	$offset = ($p-1) * $num;
    $p = max(1,$p);
    $p = min($p,$pages);
	$pagesbutton = '<a href="./index.php?p=1">首页</a>';
	//制作数字按钮
    for($i = 1;$i<=$pages;$i++){
        if($i == $p){
            $pagesbutton .= '<a style="background-color:#fff;">'.$i.'</a>';
        }
        else{
        	 if(!empty($_GET['name'])){
            	$pagesbutton .= "<a href=\"./index.php?p={$i}&name={$name}\">{$i}</a>";
            }else{
            	$pagesbutton .= '<a href="./index.php?p='.$i.'">'.$i.'</a>';
          	}
        }
    }
	$pagesbutton .= '<a href="./index.php?p='.$pages.'">尾页</a>';
	$sql = "select * from `order` {$where} order by id limit {$offset},{$num}";
	$orderlist = query($sql);
?>
	<div class="main fl">
		<div class="table">
        <div class="title">
            <form action="" class="fr">
                <input class="search" style="width:180px;height:26px;border:1px solid #ff6581;position:relative;top:-3px;" type="text" name="name"/>
                <input class="button" type="submit" value=""/> 
            </form>
            <div class="clear"></div>
        </div>
        <table>
            <tr align="center">
                <th>会员名称</th>
                <th>商品图片</th>
                <th>购买个数</th>
                <th>合计价格</th>
                <th>物流地址</th>
                <th>创建时间</th>
                <th>订单状态</th>
                <th width="160">操作</th>
            </tr>
            <?php if($orderlist==false) exit('<td style="color:red;font-weight:bold;" colspan="8">未找到符合数据</td>');?>
            <?php foreach($orderlist as $val):?>
            <tr>
                <td><?php echo $val['user_name']?></td>
                <td width="<?php if(!empty($_GET['address'])) echo '70'; else echo '110';?>"><?php
                    $sql = 'select image from goods where id='.$val['goods_id'];
                    $image = query($sql)[0]['image'];
                	$path = APP.'upload/goods/'.$image;
                	echo '<img src="'.$path.'" width="40"/>';
                	?></td>
                <td><?php echo $val['num']?></td>
                <td><?php echo $val['price']?></td>
                <?php
                    if(empty($_GET['address'])){
                        echo '<td><a href="./index.php?address=look">查看</a></td>';
                    }else{
                        $address_id = $val['address_id'];
                        $sql = "select * from address where id={$address_id}";
                        $address = query($sql)[0]['address'];
                        echo '<td width="200">'.$address.'</td>';
                    }
                ?>
                <td><?php echo date('y-m-t',$val['addtime'])?></td>
                <td>
                <?php
                    if($val['status']==0){
                        echo '<span style="background-color:#ff0099;padding:3px 10px;border-radius:8px;border-color:#ff0099;color:#fff;font-weight:bold;">未发货</span>';
                    }elseif($val['status']==1){
                        echo '<span style="background-color:#ff6100;padding:3px 10px;border-radius:8px;border-color:#ff0099;color:#fff;font-weight:bold;">已发货</span>';
                    }elseif($val['status']==2){
                        echo '<span style="background-color:#fb4f4f;padding:3px 10px;border-radius:8px;border-color:#ff0099;color:#fff;font-weight:bold;">确认收货</span>';
                    }elseif($val['status']==3){
                        echo '<span style="background-color:green;padding:3px 10px;border-radius:8px;border-color:#ff0099;color:#fff;font-weight:bold;">交易完成</span>';
                    }elseif($val['status']==4){
                        echo '<span style="background-color:#ee3968;padding:3px 10px;border-radius:8px;border-color:#ff0099;color:#fff;font-weight:bold;">退货中…</span>';
                    }elseif($val['status']==5){
                        echo '<span style="background-color:green;padding:3px 10px;border-radius:8px;border-color:#ff0099;color:#fff;font-weight:bold;">确认退货</span>';
                    }elseif($val['status']==6){
                        echo '<span style="background-color:gray;padding:3px 10px;border-radius:8px;border-color:#ff0099;color:#fff;font-weight:bold;">交易关闭</span>';
                    }
                ?>
                </td>
                <td width="190" height="50">
                <?php
                    if($val['status']==0){
                        echo '<a href="./action.php?order=0&id='.$val['id'].'" class="btn btn-red">确认发货</a>';
                    }elseif($val['comeback']==1 && $val['status']==4){
                        echo '<a href="./action.php?order=4&id='.$val['id'].'" class="btn btn-red">确认退货</a>';
                    }elseif($val['comeback']==0 && $val['status']==3){
                        echo '<a href="./action.php?order=del&id='.$val['id'].'" class="btn btn-green">删除订单</a>';
                    }elseif($val['comeback']==1 && $val['status']==6){
                        echo '<a href="./action.php?order=del&id='.$val['id'].'" class="btn btn-green">删除订单</a>';
                    }elseif($val['comeback']==0 && $val['status']==1){
                        echo '<a href="./action.php?order=1&id='.$val['id'].'" class="btn btn-green">撤回发货</a>';
                    }
                ?>
                    <a href="<?php echo APP.'detail.php?gid='.$val['goods_id']?>" target="_blank" class="btn btn-blue">详情</a>
                </td>
            </tr>
        <?php endforeach;?>
        </table>
        <div class="pagesbutton mt20 ">
        	<? echo $pagesbutton;?>
        </div>
        </div>
	</div>
	<div class="clear"></div>
<?php include '../admin_footer.php'?>
