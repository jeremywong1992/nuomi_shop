        <?php include './header.php';?>
        <div id="nav2">
            <div class="w">    
                <div class="fl b b3">
                    <?php
                        foreach($nav as $val){
                            echo '<div class="b1">';
                            echo '<div class="b2">';
                            echo '<div class="t5 fl mt10"></div>';
                            echo '<div class="fl ml20">';
                            echo '<div class="font-bold fl"><a href="index.php?cid='.$val['id'].'">'.$val['name'].'</a></div><br/>';
                            $sql = 'select * from category where pid='.$val['id'].' and display=1 limit 3';
                            $arr = query($sql);
                            echo '<div class="fl">';
                            foreach($arr as $val){
                                echo '<a style="margin-right:2px;" href="index.php?cid='.$val['id'].'">'.$val['name'].'</a>';
                            }
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                        
                    ?>
                    
                </div>
                <div class="fr">
                    <div class="b4">
                        <div class="fl c2">热门团购：</div>
                        <div class="fl"><a class="c3" href="">电影</a></div>
                        <div class="fl"><a class="c4" href="">自助餐</a></div>
                        <div class="fl"><a class="c3" href="">KTV</a></div>
                        <div class="fl"><a class="c4" href="">火锅</a></div>
                        <div class="fl"><a class="c3" href="">蛋糕</a></div>
                        <div class="fl"><a class="c4" href="">酒店</a></div>
                        <div class="fl"><a class="c3" href="">小吃快餐</a></div>
                        <div class="fl"><a class="c3" href="">西餐</a></div>
                        <div class="fl"><a class="c3" href="">川菜</a></div>
                        <div class="fl"><a class="c4" href="">家具家纺</a></div>
                        <div class="fl"><a class="c3" href="">烧烤</a></div>
                        <div class="fl"><a class="c3" href="">韩国料理</a></div>
                    </div>
                    <div class="b4">
                        <div class="fl c2">全部区域：</div>
                        <div class="fl"><a class="c3" href="">地铁附近</a></div>
                        <div class="fl"><a class="c3" href="">浦东新区</a></div>
                        <div class="fl"><a class="c3" href="">闵行区</a></div>
                        <div class="fl"><a class="c3" href="">宝山区</a></div>
                        <div class="fl"><a class="c3" href="">虹口区</a></div>
                        <div class="fl"><a class="c3" href="">徐汇区</a></div>
                        <div class="fl"><a class="c3" href="">普陀区</a></div>
                        <div class="fl"><a class="c3" href="">松江区</a></div>
                        <div class="fl"><a class="c3" href="">长宁区</a></div>
                        <div class="fl"><a class="c3" href="">杨浦区</a></div>
                    </div>
                    <div class="b4">
                        <div class="fl c2">热门商圈：</div>
                        <div class="fl"><a class="c3" href="">地铁附近</a></div>
                        <div class="fl"><a class="c3" href="">浦东新区</a></div>
                        <div class="fl"><a class="c3" href="">闵行区</a></div>
                        <div class="fl"><a class="c3" href="">宝山区</a></div>
                        <div class="fl"><a class="c3" href="">虹口区</a></div>
                        <div class="fl"><a class="c3" href="">徐汇区</a></div>
                        <div class="fl"><a class="c3" href="">普陀区</a></div>
                        <div class="fl"><a class="c3" href="">松江区</a></div>
                        <div class="fl"><a class="c3" href="">长宁区</a></div>
                        <div class="fl"><a class="c3" href="">杨浦区</a></div>
                    </div>
                    <div class="b5">本周精选</div>
                    <div>
                        <?php foreach($bzjx as $val):?>
                        <div class="fl">
                            <a href="<?php echo APP?>detail.php?gid=<?php echo $val['id']?>">
                                <img src="<?php echo APP?>upload/goods/<?php echo $val['bigimage']?>" height="210">
                                <div class="bzjx" style="width:310px;height:80px;padding:17px 20px;margin-right:5px;">
                                    <div class="fl" style="width:200px;text-align:left;">
                                        <div style="font-family:微软雅黑;font-size:18px;color:#2b2b2b;"><?php echo $val['name']?></div>
                                        <div style="font-family:SimSun;font-size:14px;color:#999;"><?php echo substr($val['miaoshu'],0,78)?></div>
                                    </div>
                                    <div class="fr" style="font-size:32px;color:#fb8e51;margin-top:10px;">
                                        <span><?php echo $val['price']?></span>
                                    </div>
                                </div>
                            </a> 
                        </div>
                        <?php endforeach;?>
                        
                    </div>
                </div>
            </div>
            
        </div>
        <div class="clear"></div>

        <div style="background-color:#ff6581;height:30px;margin-top:20px;margin-bottom:10px;color:#fff;font-family:黑体;font-size:17px;text-align:left;padding-left:20px;" class="w">
            <?php 
                if(!empty($_GET['cid'])){
                    $cid = $_GET['cid'];
                    $sql = 'select name from category where id='.$cid.' and display=1';
                    echo '>> '.query($sql)[0]['name'].' <<';
                    
                }else{
                    echo '所有宝贝';
                }
            ?>
        </div>
        <div class="w">
            <div class="c5 font-bold ml20 fl"><a href="./index.php" <?php if(empty($_GET['goods'])) echo 'style="color:#ee3968"';?>>默认</a></div>
            <div class="fl"><a href="./index.php?goods=hot" <?php if(@$_GET['goods']=='hot') echo 'style="color:#ee3968"';?> class="font-bold c6">最热</a></div>
            <div class="fl"><a href="./index.php?goods=price" <?php if(@$_GET['goods']=='price') echo 'style="color:#ee3968"';?> class="font-bold c6">价格</a></div>
            <div class="fl"><a href="./index.php?goods=new" class="font-bold c6" <?php if(@$_GET['goods']=='new') echo 'style="color:#ee3968"';?>>最新发布</a></div>
        </div>
        <div class="clear"></div>
        <div id="body" style="margin-bottom:50px;">
            <div class="w">
                <?php 
                    if(!empty($_GET['cid'])){
                        $sql = "select name,concat(path,id) bpath from category where id = {$cid}";

                        $info = query($sql);
                        $path = $info[0]['bpath'];
                        $cname = $info[0]['name'];
                        $sql = "select * from goods where cate_id in (select id from category where path like '{$path}%') and is_up=1";
                        $sql2 = "select * from goods where cate_id={$_GET['cid']}";
                        if(!$goods = query($sql)){
                            $sql2 = "select * from goods where cate_id={$_GET['cid']} and is_up=1";
                            $goods = query($sql2);
                        }
                    }
                    $i = 0;
                    if(empty($goods)){
                        echo '<div style="color:red;font-family:微软雅黑;font-size:25px;margin-bottom:50px;margin-top:40px;">未找到相关数据</div></div>';
                        include './footer.php';
                        exit;
                    }
                    foreach($goods as $val){ 
                        $i++;
                        echo '<a href="detail.php?gid='.$val['id'].'">';
                        echo '<div class="ybox fl">';
                        echo '<div class="y1box"><img src="./upload/goods/'.$val['bigimage'].'" width="320" height="194"></div>';
                        echo '<div class="c7">'.$val['name'].'</div>';
                        echo '<div class="c8">'.$val['miaoshu'].'</div>';
                        echo '<div style="text-align:left;border-bottom:1px #dedede solid;"><span class="c9"><span style="font-size:20px;">&yen</span>'.$val['price'].'&nbsp;</span> 价值<span class="c10">&yen;'.($val['price'] * 1.3).'</span></div>';
                        echo '<div class="c11">'.$val['view'].'人已浏览</div>';
                        echo '</div>';
                        echo '</a>';
                        if($i%3==0) echo '<div class="clear"></div>';
                    }
                ?>
            </div>
            <div class="clear"></div>
        </div>
        <?php include './footer.php';?>
