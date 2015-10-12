<?php 
	include '../admin_head.php';

	if(!empty($_GET['name'])){
		$name = $_GET['name'];
		$where = "where name like '%{$name}%'";
		$sql = "select count(*)  from user {$where}";
	}else{
		$where = "where name like '%%'";
		$sql = "select count(*)  from user {$where}";
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
	$sql = "select * from user {$where} order by id limit {$offset},{$num}";
	$userlist = query($sql);
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
                <th>UID</th>
                <th>昵称</th>
                <th>头像</th>
                <th>性别</th>
                <th>年龄</th>
                <th>权限</th>
                <th>可用</th>
                <th width="160">操作</th>
            </tr>
            <?php if($userlist==false) exit('<td style="color:red;font-weight:bold;" colspan="8">未找到符合数据</td>');?>
            <?php foreach($userlist as $val):?>
            <tr>
                <td><?php echo $val['id']?></td>
                <td><?php echo $val['name']?></td>
                <td width="100"><?php 
                	$path = APP.'upload/user/'.$val['pic'];
                	echo '<img src="'.$path.'" width="40"/>';
                	?></td>
                <td><?php 
                	if($val['sex'] == 0) echo '男';
                	if($val['sex'] == 1) echo '女';
                	if($val['sex'] == 2) echo '人妖';
                	?></td>
                <td><?php echo $val['age']?></td>
                <td><?php 
                	if($val['level']=='1'){
                		echo '普通会员';	
                	}elseif($val['id']=='1' && $val['level']=='0'){
                		echo '炒鸡鹳狸猿';		
                	}else{
                        echo '鹳狸猿';
                    }
                ?></td>
                <td>
                    <?
                        if($val['display']==1){
                            echo '<a href="./action.php?a=userdisplay&display=yes&id='.$val['id'].'"><img src="../../public/images/yes.gif"/></a>';
                        }else{
                            $path = PATH.'public/images/no.gif';
                            echo '<a href="./action.php?a=userdisplay&display=no&id='.$val['id'].'"><img src="../../public/images/no.gif"/></a>';
                        }
                    ?>
                </td>
                <td width="190" height="50">
                    <a href="./add.php?a=edit&id=<?php echo $val['id']?>" class="btn btn-red">编辑</a>
                    <a href="./action.php?a=del&id=<?php echo $val['id']?>" class="btn btn-green">删除</a>
                    <a href="" class="btn btn-blue">详情</a>
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
