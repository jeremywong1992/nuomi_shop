<?php
    include '../../include/config.php';
    include '../../include/funcs.php';
    $sql = "select id,name,path,concat(path,id) bpath from category order by bpath";
    $catelist = query($sql);
    foreach($catelist as &$val){
        $val['name'] = str_repeat('&nbsp',(strlen($val['path'])-2)).$val['name'];
    }
    if(!empty($_GET['a'])){
        $is_edit = true;
        $id = $_GET['id'];
        $sql = "select * from goods where id=$id";
        $goodslist = query($sql)[0];
    }else{
        $is_edit = false;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title>Index</title>
        <style type="text/css">
            /*rest(初始化样式)*/
            *{margin:0px;padding:0px;}
            body{font:16px/1.5 黑体;color:#8D8F82;text-align:center;}
            img{border:0px;}
            a{/*text-decoration:none;*/color:#8D8F82}
            ul,ol{list-style:none;}

            /* 公共样式 */
            .w{width:420px;margin:0 auto;}
            .c{background:white;}
            .b{border:1px solid gray;}
            .fl{float:left;}
            .fr{float:right;}
            .mt10{margin-top:10px;}
            .mt30{margin-top:30px;}
            .ml10{margin-left:10px}
            .clear{clear:both;}

            /*主体开始*/
            #head{height:80px;background:#F2F6F7;color:#949494;line-height:80px;text-indent:20px}
            #head .l{font-size:32px;font-weight:bold}
            #head .r{font-size:24px}
            .menu{width:70px;height:32px;margin:9px 0 18px 40px;line-height:32px;}
            .input{width:275px;height:32px;margin:9px 30px 18px 0;line-height:32px}
            select{width:275px;height:32px;}
            textarea{width:275px;height:100px;}
            .x1{word-spacing:65px}
            .x2{word-spacing:50px}
            .time{width:85px;height:32px;}
            .add{width:271px;height:28px}
            .sub{width:352px;height:51px;background-color:#2cabce;border:0;font:25px/1.5 黑体;color:#fff;cursor:pointer;margin-bottom:20px;}
            .sub:hover{background-color:#2cabff;border:0;font-size:25px;color:#e3c8de;}
            .foot{margin:25px auto;width:185px;}
            .footer{width:100px;height:20px;background:url(./xiaologo.jpg) no-repeat;}
        </style>
    </head>
    <body>
        <div id="box" class="w c mt30" style="border-radius:20px;box-shadow:5px 5px 5px;">
            <div id="head" class="w">
                <span class="r"><h3><?if($is_edit) echo '编辑';else echo '添加';?>商品</h3></span>
            </div>
            <div id="body" class="w">
                <form action="<?if($is_edit) echo './action.php?a=edit&id='.$id; else echo './action.php?a=add'?>" method="post" enctype="multipart/form-data">
                    <div class="left fl mt10">
                        <div class="menu">商品名称</div>
                        <div class="menu">价　　格</div>
                        <div class="menu">所属分类</div>
                        <div class="menu">库　　存</div>
                        <div class="menu">是否上架</div>
                        <div class="menu">是否新品</div>
                        <div class="menu">是否热销</div>
                        <div class="menu">商品图片</div>
                        <div class="menu">描　　述</div>
                    </div>
                    <div class="right fr mt10">
                        <div class="input">
                            <div class="fl">
                                <input class="add" type="text" name="name" <?if($is_edit) echo "value={$goodslist['name']}";?>>
                            </div>
                        </div>
                        <div class="input">
                            <div class="fl">
                                <input class="add" type="text" name="price" <?if($is_edit) echo "value={$goodslist['price']}";?>>
                            </div>
                        </div>
                        <div class="input">
                            <div class="fl">
                                <select name="class">
                                    <?php
                                        foreach($catelist as $val){
                                            if($goodslist['cate_id']==$val['id']){
                                                echo '<option selected value="'.$val['id'].'">'.$val['id'].$val['name'].'</option>';
                                            }else{
                                                echo '<option value="'.$val['id'].'">'.$val['id'].$val['name'].'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="input">
                            <div class="fl">
                                <input class="add" type="text" name="store" <?if($is_edit) echo "value={$goodslist['store']}";?>>
                            </div>
                        </div>
                        <div class="input x1">
                            <div class="fl">
                                <input type="radio" name="is_up" value="0" <?if($is_edit) if($goodslist['is_up']==0) echo 'checked';?>/>仓库
                                <input type="radio" name="is_up" value="1" <?if($is_edit) if($goodslist['is_up']==1) echo 'checked';?>/>上架
                            </div>
                        </div>
                        <div class="input x1">
                            <div class="fl">
                                <input type="radio" name="is_new" value="0" <?if($is_edit) if($goodslist['is_new']==0) echo 'checked';?>/>否
                                <input type="radio" name="is_new" value="1" <?if($is_edit) if($goodslist['is_new']==1) echo 'checked';?>/>是
                            </div>
                        </div>
                        <div class="input x1">
                            <div class="fl">
                                <input type="radio" name="is_hot" value="0" <?if($is_edit) if($goodslist['is_hot']==0) echo 'checked';?>/>否
                                <input type="radio" name="is_hot" value="1" <?if($is_edit) if($goodslist['is_hot']==1) echo 'checked';?>/>是
                            </div>
                        </div>
                        <div class="input">
                            <div class="fl">
                                <input class="add" type="file" name="pic"/>
                            </div>
                        </div>
                        <div class="input">
                            <div class="fl">
                                <textarea name="miaoshu"><?if($is_edit) echo $goodslist['miaoshu'];?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="bottom">
                        <input type="submit" class="sub" name="submit" value=<?if($is_edit) echo '"完成修改"'; else echo '"完成添加"';?>>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>


