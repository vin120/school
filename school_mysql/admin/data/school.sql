/*数据库名称为 school */

/*首页-首页图片*/
create table `index_SYTP`(
`id` int not null auto_increment,
`name` varchar(300) not null,
primary key(id));

/*首页-园区动态*/
create table `index_YQDT`(
`id` int not null auto_increment,
`title` varchar(300) not null,
`author` varchar(150) not null,
`content` text not null,
`times` varchar(30) not null,
primary key(id));


/*首页-创业政策*/
create table `index_CYZC`(
`id` int not null auto_increment,
`title` varchar(300) not null,
`author` varchar(150) not null,
`content` text not null,
`times` varchar(30) not null,
`url` varchar(300) not null,
`path` varchar(300) not null,
`size`	varchar(30) not null,
primary key(id));


/*首页-创业团队*/
create table `index_CYTD`(
`id` int not null auto_increment,
`title` varchar(300) not null,
`author` varchar(150) not null,
`content` text not null,
`times` varchar(30) not null,
primary key(id));


/*首页-通知公告*/
create table `index_TZGG`(
`id` int not null auto_increment,
`title` varchar(300) not null,
`author` varchar(150) not null,
`content` text not null,
`times` varchar(30) not null,
primary key(id));


/*首页-资源下载*/
create table `index_ZYXZ`(
`id` int not null auto_increment,
`title` varchar(300) not null,
`author` varchar(150) not null,
`times` varchar(30) not null,
`url` varchar(300) not null,
`path` varchar(300) not null,
`size`	varchar(30) not null,
primary key(id));


/*园区概括---园区简介*/
create table `YQ_about`(
`id` int not null auto_increment,
`content` text not null,
`times` varchar(30) not null,
primary key(id));


/*园区概括---机构设置*/
create table `YQ_set`(
`id` int not null auto_increment,
`content` text not null,
`times` varchar(30) not null,
primary key(id));


/*院士工作站----院士简介*/
create table `YS_about`(
`id` int not null auto_increment,
`title` varchar(300) not null,
`author` varchar(150) not null,
`content` text not null,
`times` varchar(30) not null, 
primary key(id));



/*院士工作站----建设进展*/
create table `YS_build`(
`id` int not null auto_increment,
`title` varchar(300) not null,
`author` varchar(150) not null,
`content` text not null,
`times` varchar(30) not null,
primary key(id));


/*创业工厂--创业工厂简介*/
create table `CY_about`(
`id` int not null auto_increment,
`content` text not null,
`times` varchar(30) not null,
primary key(id));


/*创业工厂----创业入驻通须知*/
create table `CY_news`(
`id` int not null auto_increment,
`title` varchar(300) not null,
`author` varchar(150) not null,
`content` text not null,
`times` varchar(30) not null,
`url` varchar(300) not null,
`path` varchar(300) not null,
`size`	varchar(30) not null,
primary key(id));



/*创业工厂---创业团队经营情况*/
create table `CY_teamnews`(
`id` int not null auto_increment,
`title` varchar(300) not null,
`author` varchar(150) not null,
`content` text not null,
`times` varchar(30) not null, 
primary key(id));



/*创业工厂---创业入驻团队招聘*/
create table `CY_job`(
`id` int not null auto_increment,
`title` varchar(300) not null,
`times` varchar(30) not null,
`content` text not null,
`author` varchar(30) not null,
primary key(id));



/*联系我们*/
create table `contact`(
`id` int not null auto_increment,
`content` text not null,
`times` varchar(30) not null,
primary key(id));



/*管理员*/
create table `admin`(
`id` int not null auto_increment,
`username` varchar(30) not null unique,
`password` varchar(80) not null,
primary key(id));


INSERT INTO  admin VALUES('','admin','21232f297a57a5a743894a0e4a801fc3');
INSERT INTO  admin VALUES('','admin@admin.com','21232f297a57a5a743894a0e4a801fc3');
INSERT INTO index_SYTP VALUES('','1.jpg');
INSERT INTO index_SYTP VALUES('','2.jpg');
INSERT INTO index_SYTP VALUES('','3.jpg');
INSERT INTO index_SYTP VALUES('','4.jpg');
INSERT INTO index_SYTP VALUES('','2.jpg');
INSERT INTO index_SYTP VALUES('','1.jpg');
INSERT INTO index_SYTP VALUES('','2.jpg');
INSERT INTO index_SYTP VALUES('','3.jpg');