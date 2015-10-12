<?php
    include '../header.php';
    $sql = 'select * from user where id='.$_SESSION['login']['id'];
    $user = query($sql)[0];
    $sql = "select * from `order` where user_name='{$_SESSION['login']['name']}'";
    $orderlist = query($sql);
?>
<div class="w" style="margin-top:50px;margin-bottom:50px;">
    <?php if(empty($_GET['user'])||$_GET['user']!=='order'):?>
    <div class="left fl">
        <div style="background-color:#ff658e;padding:10px 50px;font-weight:bold;"><a href="./index.php" style="color:#fff;">个人信息</a></div>
        <div><a href="./index.php?user=order" style="color:#000;">订单信息</a></div>
    </div>
    <div class="right fr">
        <table width="824" cellspacing="0" bordercolor="#ff658e" cellpadding="0" border="2" align="center">
            <tr height="50">
                <th width="150">会员名</th>
                <td width="150"><?php echo $user['name']?></td>
                <th width="150">性别</th>
                <td width="150"><?php if($user['sex']==0) echo '男'; else echo '女';?></td>
                <td width="150" colspan="2" rowspan="4"><img src="<?php echo APP.'upload/user/'.$user['pic']?>" width="210"></td>
            </tr>
            <tr height="50">
                <th>UID</th>
                <td><?php echo $user['id']?></td>
                <th>用户权限</th>
                <td><?php if($user['level']==0) echo '炒鸡鹳狸猿'; else echo'普通会员';?></td>
            </tr>
            <tr height="50">
                <th>年龄</th>
                <td><?php echo $user['age']?></td>
                <th>积分</th>
                <td>99999</td>
            </tr>
            <tr height="50">
                <th>注册时间</th>
                <td><?php echo date('y-m-d',$user['reg_time'])?></td>
                <th>最后登录</th>
                <td><?php echo date('y-m-d',$user['login_time'])?></td>
            </tr>
            <tr height="50">
                <th>认证邮箱</th>
                <td>admin@otokaze.cn</td>
                <th>联系方式</th>
                <td>叔叔，我们不约</td>
                <th><a href="" style="padding:10px 50px;background:#ff658e;border-radius:10px;color:#fff">更新个人资料</a></th>
            </tr>
        </table>
    </div>
    <?php elseif($_GET['user']=='order'):?>
    <div class="left fl">
        <div><a href="./index.php" style="color:#000;">个人信息</a></div>
        <div style="background-color:#ff658e;padding:10px 50px;color:#fff;font-weight:bold;"><a href="./index.php?user=order" style="color:#fff;">订单信息</a></div>
    </div>
    <div class="right fr">
        <table width="824" cellspacing="0" bordercolor="#ff658e" cellpadding="0" border="2" align="center">
            <tr height="50">
                <th width="150">商品名称</th>
                <th width="80">商品图片</td>
                <th width="80">购买件数</th>
                <th width="80">合计价格</td>
                <th width="80">物流地址</td>
                <th width="80">订单状态</td>
                <th width="100">创建时间</th>
                <th >操作</th>
            </tr>
            <?php if(!empty($orderlist)):?>
            <?php foreach($orderlist as $val):?>
            <tr height="50">
                <td>
                <?php
                    $sql = 'select name,image from goods where id='.$val['goods_id'];
                    $goods = query($sql)[0];
                    echo $goods['name'];
                ?>
                </td>
                <td><img width="50" src="<?php echo APP.'upload/goods/'.$goods['image']?>"></td>
                <td><?php echo $val['num']?></td>
                <td><?php echo $val['price']?></td>
                <td>显示</td>
                <td>
                <?php 
                    if($val['comeback']==0 && $val['status']==1){
                        echo '<span style="background-color:#ff6100;padding:3px 10px;border-radius:8px;border-color:#ff0099;color:#fff;font-weight:bold;">已发货</span>';
                    }elseif($val['comeback']==0 && $val['status']==3){
                        echo '<span style="background-color:green;padding:3px 10px;border-radius:8px;border-color:#ff0099;color:#fff;font-weight:bold;">交易完成</span>';
                    }elseif($val['comeback']==1 && $val['status']==4){
                        echo '<span style="background-color:#ee3968;padding:3px 10px;border-radius:8px;border-color:#ff0099;color:#fff;font-weight:bold;">退货中…</span>';
                    }elseif($val['comeback']==1 && $val['status']==6){
                        echo '<span style="background-color:gray;padding:3px 10px;border-radius:8px;border-color:#ff0099;color:#fff;font-weight:bold;">交易关闭</span>';
                    }elseif($val['status']==0){
                        echo '<span style="background-color:#ff0099;padding:3px 10px;border-radius:8px;border-color:#ff0099;color:#fff;font-weight:bold;">未发货</span>';
                    }
                ?>
                </td>
                <td><?php echo date('y-m-d',$val['addtime'])?></td>
                <td>
                <?php
                    if($val['comeback']==0 && $val['status']==1){
                        echo '<a href="./action.php?order=2&id='.$val['id'].'" class="btn btn-green">确认收货</a>';
                        echo '<a href="./action.php?order=3&id='.$val['id'].'" class="btn btn-red">申请退货</a>';
                    }elseif($val['comeback']==0 && $val['status']==0){
                        echo '<a style="padding:8px 40px;" href="./action.php?order=del&id='.$val['id'].'" class="btn btn-red">取消订单</a>';
                    }elseif($val['comeback']==1 && $val['status']==4){
                        echo '<img src="'.APP.'public/images/jinzhi.png" width="40">';
                    }elseif($val['comeback']==0 && $val['status']==3){
                        echo '<a  href="./action.php?order=del&id='.$val['id'].'" class="btn btn-blue">删除订单</a>';
                        echo '<a style="padding:5 15px;" href="./action.php?order=del&id='.$val['id'].'" class="btn btn-blue">去评价</a>';
                    }elseif($val['comeback']==1 && $val['status']==6){
                        echo '<a style="padding:8px 40px;" href="./action.php?order=del&id='.$val['id'].'" class="btn btn-blue">删除订单</a>';
                    }
                ?>
                </td>
            </tr>
            <?php endforeach;?>
            <?php else:?>
            <tr height="80">
                <td colspan="8">无订单记录哦~还不赶紧抢购！<a style="color:pink" href="<?php echo APP?>index.php">去购物</a></td>
            </tr>
            <?php endif;?>
        </table>
    </div>
    <?php endif;?>
    <div class="clear"></div>
</div>
<?php include '../footer.php';?>
