-- 创建库
CREATE DATABASE nuomi;

-- 选择库
USE nuomi;

-- 创建用户表
create table user(
	id int unsigned not null primary key auto_increment,
	name varchar(50) not null,
	password char(32) not null,
	sex tinyint unsigned not null default 2,
	age tinyint unsigned not null default 18,
	level tinyint unsigned not null default 0,
	reg_time int unsigned not null default 0,
	login_time int unsigned not null default 0,
    display tinyint unsigned not null default 1,
	pic varchar(255) not null default 'default.jpg'
)engine=MyISAM DEFAULT CHARSET=utf8; 

-- 插入数据
insert into user(name,password,sex,age,level,reg_time,login_time,pic) value
('admin','admin',0,19,10,0,0,'default.jpg');
-- 分类表格
create table category(
    id int unsigned not null primary key auto_increment,
    name varchar(50) not null default '',
    pid int unsigned not null,
    display tinyint not null default 1,
    path varchar(255) not null
)engine=MyISAM DEFAULT CHARSET=utf8;

insert into category(name,pid,path) values
    ('美食',0,'0,'),
    ('娱乐',0,'0,'),
    ('生活',0,'0,'),
    ('丽人',0,'0,'),
    ('酒店',0,'0,'),
    ('旅游',0,'0,')
    ;
//1 美食
insert into category(name,pid,path) values
    ('中餐',1,'0,1,'),
    ('西餐',1,'0,1,'),
    ('日本料理',1,'0,1,'),
    ('韩国料理',1,'0,1,'),
    ('东南亚菜',1,'0,1,'),
    ('披萨',1,'0,1,'),
    ('中东菜',1,'0,1,'),
    ('其他异国餐饮',1,'0,1,')
    ;
//2 娱乐
insert into category(name,pid,path) values
    ('足疗按摩',2,'0,2,'),
    ('运动健身',2,'0,2,'),
    ('景点郊游',2,'0,2,'),
    ('密室逃脱',2,'0,2,'),
    ('温泉洗浴',2,'0,2,'),
    ('文化艺术',2,'0,2,'),
    ('真人CS',2,'0,2,'),
    ('其他娱乐',2,'0,2,')
    ;
//3 生活
insert into category(name,pid,path) values
    ('口腔',3,'0,3,'),
    ('鲜花',3,'0,3,'),
    ('儿童摄影',3,'0,3,'),
    ('个性写真',3,'0,3,'),
    ('教育培训',3,'0,3,'),
    ('婚纱摄影',3,'0,3,'),
    ('宠物服务',3,'0,3,'),
    ('其他生活',3,'0,3,')
    ;
//4 丽人
insert into category(name,pid,path) values
    ('美发',4,'0,4,'),
    ('美甲',4,'0,4,'),
    ('美容',4,'0,4,'),
    ('化妆',4,'0,4,'),
    ('其他丽人',4,'0,4,')
    ;
//5 酒店
insert into category(name,pid,path) values
    ('浦东新区',5,'0,5,'),
    ('闵行区',5,'0,5,'),
    ('宝山区',5,'0,5,'),
    ('松江区',5,'0,5,'),
    ('普陀区',5,'0,5,'),
    ('虹口区',5,'0,5,'),
    ('嘉定区',5,'0,5,'),
    ('黄浦区',5,'0,5,'),
    ('杨浦区',5,'0,5,')
    ;
//6 旅游
insert into category(name,pid,path) values
    ('浦东新区',6,'0,6,'),
    ('闵行区',6,'0,6,'),
    ('宝山区',6,'0,6,'),
    ('松江区',6,'0,6,'),
    ('普陀区',6,'0,6,'),
    ('虹口区',6,'0,6,'),
    ('嘉定区',6,'0,6,'),
    ('黄浦区',6,'0,6,'),
    ('杨浦区',6,'0,6,')
    ;

-- 商品列表
create table goods(
    id int not null primary key auto_increment,
    name varchar(50) not null,
    cate_id int unsigned not null,
    price decimal(10,2) not null default '100.00',
    store int unsigned not null default 100,
    image varchar(255) not null default 'default.png',
    view int unsigned not null default 60,
    is_up tinyint not null default 1,
    is_hot tinyint not null default 1,
    is_new tinyint not null default 1,
    addtime int unsigned not null default 0,
    miaoshu varchar(255) not null default '暂无相关说明'
)engine=MyISAM default charset=utf8;

insert into goods(name,cate_id,price,store) values
('测试',1,'10.10',100),
('测试',1,'10.10',100),
('测试',1,'10.10',100),
('测试',1,'10.10',100),
('测试',1,'10.10',100),
('测试',1,'10.10',100),
('测试',1,'10.10',100);

-- 商品详情表
create table goods_images(
    id int unsigned not null auto_increment primary key,
    name varchar(50) not null,
    goods_id int unsigned not null default 0
)engine=MyISAM default charset=utf8;

-- 订单表
create table `order`(
    id int unsigned not null auto_increment primary key,
    user_name varchar(50) not null,
    addtime int unsigned not null default 0,
    status tinyint unsigned not null default 0,
    goods_id int unsigned not null,
    num int unsigned not null,
    price decimal(10,2) not null
)engine=MyISAM default charset=utf8;

insert into `order`(user_name,addtime,goods_id,num,price) value('admin',0,15,10,190);

-- 收货人地址表
create table address(
    id int unsigned not null auto_increment primary key,
    user_id int unsigned not null,
    name varchar(50) not null,
    address varchar(255) not null,
    tel int unsigned not null
)engine=MyISAM default charset=utf8;

insert into address(user_id,name,address,tel) value(1,'音風','xxxxxxxx',17091955564);
