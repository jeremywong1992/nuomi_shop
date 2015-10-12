<?php 
	include '../admin_head.php';

	if(!empty($_GET['name'])){
		$name = $_GET['name'];
		$where = "where name like '%{$name}%'";		
	}else{
		$where = "where name like '%%'";
	}
    $sql = "select count(*)  from goods {$where}";
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
	$sql = "select * from goods {$where} order by id limit {$offset},{$num}";
	$goodslist = query($sql);
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
                <th>商品ID</th>
                <th>商品名</th>
                <th>商品图片</th>
                <th>价格</th>
                <th>库存</th>
                <th>添加时间</th>
                <th width="160">操作</th>
            </tr>
            <?php if($goodslist==false) exit('<td style="color:red;font-weight:bold;" colspan="10">未找到符合数据</td>');?>
            <?php foreach($goodslist as $val):?>
            <tr>
                <td><?php echo $val['id']?></td>
                <td><?php echo $val['name']?></td>
                <td width="100"><?php 
                	$path = APP.'upload/goods/'.$val['image'];
                	echo '<img src="'.$path.'" width="40"/>';
                	?></td>
                <td><?php echo $val['price']?></td>
                <td><?php echo $val['store']?></td>
                <td><?php echo date('y-m-d',$val['addtime'])?></td>
                <td width="190" height="50">
                    <?php if($val['bzjx']==0):?>
                    <a href="./action.php?bzjx=on&id=<?php echo $val['id']?>" class="btn btn-red">设为本周精选</a>
                    <?php else:?>
                    <a href="./action.php?bzjx=off&id=<?php echo $val['id']?>" class="btn btn-red">取消本周精选</a>
                    <?php endif;?>
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
