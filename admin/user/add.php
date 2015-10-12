<?php
    include '../common.php';
    if(!empty($_GET['a'])){
        $is_edit = true;
        $id = $_GET['id'];
        mysql_connect(HOST,USER,PWD) or die('数据库连接失败');
        mysql_select_db(DB);
        mysql_set_charset('utf8');
        $sql = "select * from user where id=$id";
        $result = mysql_query($sql);
        if($result && mysql_affected_rows() > 0){
            $arr = mysql_fetch_assoc($result);
            mysql_free_result($result);
            mysql_close();
        }else{
            exit('查询出错');
        }
        
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
                <span class="r"><h3><?if($is_edit) echo '编辑';else echo '添加';?>用户</h3></span>
            </div>
            <div id="body" class="w">
                <form action="<?if($is_edit) echo './action.php?a=edit&id='.$id; else echo './action.php?a=add'?>" method="post" enctype="multipart/form-data">
                    <div class="left fl mt10">
                        <div class="menu">昵　　称</div>
                        <div class="menu">性　　别</div>
                        <div class="menu">年　　龄</div>
                        <div class="menu">级　　别</div>
                        <div class="menu">头　　像</div>
                        <div class="menu"><?if($is_edit) echo '重置密码'; else echo '密　　码'?></div>
                        <div class="menu">确认密码</div>
                    </div>
                    <div class="right fr mt10">
                        <div class="input">
                            <div class="fl">
                                <input class="add" type="text" name="name" <?if($is_edit) echo "value={$arr['name']}";?>>
                            </div>
                        </div>
                        <div class="input x1">
                            <div class="fl">
                                <input type="radio" name="sex" value="0" <?if($is_edit) if($arr['sex']==0) echo 'checked';?> />男
                                <input type="radio" name="sex" value="1" <?if($is_edit) if($arr['sex']==1) echo 'checked';?>/>女
                            </div>
                        </div>
                        <div class="input">
                            <div class="fl">
                                <input class="add" type="text" name="age" <?if($is_edit) echo "value={$arr['age']}";?>>
                            </div>
                        </div>
                        <div class="input x1">
                            <div class="fl">
                                <input type="radio" name="level" value="1" <?if($is_edit) if($arr['level']==1) echo 'checked';?> />普通会员
                                <input type="radio" name="level" value="0" <?if($is_edit) if($arr['level']==0) echo 'checked';?>/>管理员
                            </div>
                        </div>
                        <div class="input">
                            <div class="fl">
                                <input class="add" type="file" name="pic"/>
                            </div>
                        </div>
                        <div class="input">
                            <input type="password" class="fl add" name="pwd">
                        </div>
                        <div class="input">
                            <input type="password" class="fl add" name="rpwd">
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


