<?php 
	include '../admin_head.php';
    if(empty($_GET['pid'])){
        $sql = 'select * from category where pid=0';
    }else{
        $pid = $_GET['pid'];
        $sql = "select * from category where pid={$pid}";
    }
    if(!empty($_GET['name'])) $sql = "select * from category where name='{$_GET['name']}'";
    $class = query($sql);
    
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
                <th>ID</th>
                <th>类别</th>
                <th>PID</th>
                <th>状态</th>
                <th width="160">操作</th>
            </tr>
            <?php if($class == '') exit('<tr><td style="font-weight:bold;color:red;" colspan="5">未找到符合数据</td></tr>');?>
            <?php foreach($class as $val):?>
            <tr>
                <td><?php echo $val['id']?></td>
                <td><?php echo $val['name']?></td>
                <td><?php echo $val['pid']?></td>
                <td>
                    <?php
                        if($val['display']==1){
                            echo '<a href="./action.php?a=userdisplay&display=yes&id='.$val['id'].'"><img src="../../public/images/yes.gif"/></a>';
                        }else{
                            echo '<a href="./action.php?a=userdisplay&display=no&id='.$val['id'].'"><img src="../../public/images/no.gif"/></a>';
                        }
                    ?>
                </td>
                <td width="250" height="50">
                    <a href="./add.php?a=edit&id=<?php echo $val['id']?>" class="btn btn-red">编辑</a>
                    <a href="./action.php?a=del&id=<?php echo $val['id']?>" class="btn btn-green">删除</a>
                    <a href="./index.php?pid=<?echo $val['id']?>" class="btn btn-blue">查看子分类</a>
                </td>
            </tr>
        <?php endforeach;?>
        </table>
        </div>
	</div>
	<div class="clear"></div>
<?php include '../admin_footer.php'?>
