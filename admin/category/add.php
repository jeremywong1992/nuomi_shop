<?php 
    include '../../include/config.php';
    include '../../include/funcs.php';
	$sql = "select id,name,path,concat(path,id) bpath from category order by bpath";
	$catelist = query($sql);

	foreach($catelist as &$val){
		$val['name'] = @str_repeat('&nbsp;',(strlen($val['path'])-2)).$val['name'];

	}

    if(!empty($_GET['a'])){
        $is_edit = true;
        $id = $_GET['id'];
        $sql = "select * from category where id=$id";
        $arr = query($sql)[0];
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
            select{width:275px;height:32px;font-size:14px;}
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
                <span class="r"><h3><?if($is_edit) echo '编辑';else echo '添加';?>分类</h3></span>
            </div>
            <div id="body" class="w">
                <form action="<?if($is_edit) echo './action.php?a=edit&id='.$id; else echo './action.php?a=add'?>" method="post" enctype="multipart/form-data">
                    <div class="left fl mt10">
                        <div class="menu">所属分类</div>
                        <div class="menu">分类名称</div>
                    </div>
                    <div class="right fr mt10">
                        <div class="input">
                            <select name="pid" >
                                <option value="0">-- 顶级分类 --</option>
                                <?
                                foreach($catelist as $val){
                                    if(!empty($arr['id'])){
                                        if($arr['id']==$val['id']){
                                            echo '<option selected value="'.$val['id'].'">'.$val['name'].'</option>';
                                        }
                                    }
                                    echo '<option value="'.$val['id'].'">'.$val['name'].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="input">
                            <div class="fl">
                                <input class="add" type="text" name="name" <?if($is_edit) echo "value={$arr['name']}";?>>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="bottom">
                        <input type="hidden" name="id" value="<?php if($is_edit) echo $arr['id'];?>">
                        <input type="hidden" name="spid" value="<?php if($is_edit) echo $arr['pid'];?>">
                        <input type="submit" class="sub" name="submit" value=<?if($is_edit) echo '"完成修改"'; else echo '"完成添加"';?>>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>

