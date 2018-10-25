/*
SQLyog Ultimate v11.24 (32 bit)
MySQL - 5.5.47 : Database - weiziadmin
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`weiziadmin` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `weiziadmin`;

/*Table structure for table `pw_article` */

DROP TABLE IF EXISTS `pw_article`;

CREATE TABLE `pw_article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '标题',
  `content` text COMMENT '内容',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0删除状态,1显示,2待发布,3待审核',
  `author` varchar(50) NOT NULL DEFAULT '' COMMENT '作者',
  `source` varchar(300) NOT NULL DEFAULT '' COMMENT '文章来源',
  `keyword` text COMMENT '关键字',
  `content_introduce` text COMMENT '内容简介',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '修改时间',
  `index_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '首页0不是,1是',
  `headline` tinyint(4) NOT NULL DEFAULT '0' COMMENT '头条0不是头条,1是头条',
  `title_img` varchar(200) NOT NULL DEFAULT '' COMMENT '标题标题地址',
  `click_number` int(11) NOT NULL DEFAULT '0' COMMENT '点击数',
  `collect_unmber` int(11) NOT NULL DEFAULT '0' COMMENT '收藏数',
  `admin_type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否是后台发送0不是,1是后台发送',
  `user_uid` int(11) NOT NULL DEFAULT '0' COMMENT '发布文章用户UID',
  `type_id` int(11) NOT NULL DEFAULT '1' COMMENT '文章类型默认第1个类型',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COMMENT='文章列表';

/*Data for the table `pw_article` */

insert  into `pw_article`(`id`,`title`,`content`,`status`,`author`,`source`,`keyword`,`content_introduce`,`created_at`,`updated_at`,`index_status`,`headline`,`title_img`,`click_number`,`collect_unmber`,`admin_type`,`user_uid`,`type_id`) values (1,'测试测试','&lt;p&gt;内容测试2&lt;/p&gt;',1,'admin','来源','关键字','介绍',1502456523,1520600847,0,1,'/uploads/20170827/59a28dc3b2b44.png',0,0,1,1,2),(2,'测试2','&lt;p&gt;测试&lt;/p&gt;',1,'测试','','测试','测试',1502456523,1502457362,0,1,'/uploads/20170827/59a28dc3b2b44.png',0,0,0,2,1),(3,'测试1','&lt;p&gt;测试测试&lt;/p&gt;',1,'测试','','测试','测试',1502456523,0,0,1,'/uploads/20170827/59a28dc3b2b44.png',0,0,0,2,1),(5,'发布文章','&lt;p&gt;内容内容&lt;img src=&quot;http://www.yiicmss.com//ueditor/php/upload/image/20170827/1503819464887745.png&quot; title=&quot;1503819464887745.png&quot; alt=&quot;QQ截图20170827143912.png&quot;/&gt;&lt;img src=&quot;http://www.yiicmss.com//ueditor/php/upload/image/20170828/1503930919303976.gif&quot; title=&quot;1503930919303976.gif&quot; alt=&quot;noavatar_small.gif&quot;/&gt;&lt;/p&gt;',1,'admin','','关键字','介绍内容',1502456523,1503930922,0,1,'/uploads/20170827/59a28dc3b2b44.png',0,0,1,1,1),(6,'测试文章','&amp;lt;p&amp;gt;测试测试&amp;lt;/p&amp;gt;',0,'测试','','测试','测试',1502543156,1502543194,0,1,'/uploads/20170827/59a28dc3b2b44.png',0,0,0,0,1),(7,'测试测试1','&lt;p&gt;菜市场&lt;/p&gt;',1,'测试','','测试','笑出声',1503820359,0,0,0,'/uploads/20170827/59a28dc3b2b44.png',0,0,0,0,1),(8,'测试测试12','&lt;p&gt;菜市场&lt;/p&gt;',1,'测试','','测试,测试2','笑出声',1503820406,1503820491,0,0,'/uploads/20170827/59a28dc3b2b44.png',0,0,0,0,1),(9,'测试22','&lt;p&gt;测试厂房&lt;/p&gt;',1,'测试','','测试测试',' vssd',1503820519,0,0,0,'/uploads/20170827/59a28dc3b2b44.png',0,0,0,0,1),(10,'测试22','&lt;p&gt;测试厂房&lt;/p&gt;',1,'测试','','测试测试',' vssd',1503820669,0,1,0,'/uploads/20170827/59a28dc3b2b44.png',0,0,1,1,1),(11,'测试22','&lt;p&gt;测试厂房&lt;/p&gt;',1,'测试','','测试测试,测试',' vssd',1503820677,0,1,0,'/uploads/20170827/59a28dc3b2b44.png',0,0,1,1,1),(12,'测试22','&lt;p&gt;测试厂房&lt;/p&gt;',1,'admin','','测试测试,测试',' vssd',1503822603,1503924099,1,0,'/uploads/20170827/59a28dc3b2b44.png',0,0,1,1,1),(13,'测试23','&lt;p&gt;正文&lt;/p&gt;',1,'admin','','好,php','介绍内容',1503924174,0,1,0,'/uploads/20170905/59aebba1e9d39.jpg',0,0,1,1,1),(14,'测试24','&lt;p&gt;测试&lt;/p&gt;',1,'admin','','测试,测试2','测试',1503924240,1503932997,0,0,'/uploads/20170905/59aebba1e9d39.jpg',0,0,1,1,1),(15,'测试25','&lt;p&gt;&amp;nbsp;想吃撒旦&lt;/p&gt;',1,'admin','','测试, 测试2','传是',1503924451,1503927482,0,0,'/uploads/20170828/59a410c16d772.png',0,0,1,1,1),(16,'测试30','&lt;pre style=&quot;box-sizing: inherit; overflow: auto; font-size: 0.9375rem; font-family: &amp;quot;Courier 10 Pitch&amp;quot;, Courier, monospace; margin-bottom: 1.6em; padding: 1.6em; max-width: 100%; border: 1px solid rgb(221, 221, 221); background-color: rgb(255, 255, 255); line-height: 1.6; color: rgb(48, 48, 48);&quot;&gt;package&amp;nbsp;main\n\n\nimport&amp;nbsp;(\n&amp;quot;path/filepath&amp;quot;\n&amp;quot;os&amp;quot;\n&amp;quot;fmt&amp;quot;\n//&amp;quot;flag&amp;quot;\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;quot;bufio&amp;quot;\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;quot;encoding/hex&amp;quot;\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;quot;crypto/md5&amp;quot;\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;quot;strings&amp;quot;\n)\n//字符串MD5加密\nfunc&amp;nbsp;get_md5(str&amp;nbsp;string)&amp;nbsp;&amp;nbsp;{\n&amp;nbsp;&amp;nbsp;&amp;nbsp;md5Ctx&amp;nbsp;:=&amp;nbsp;md5.New()\n&amp;nbsp;&amp;nbsp;&amp;nbsp;md5Ctx.Write([]byte(str))\n&amp;nbsp;&amp;nbsp;&amp;nbsp;cipherStr&amp;nbsp;:=&amp;nbsp;md5Ctx.Sum(nil)\n&amp;nbsp;&amp;nbsp;&amp;nbsp;//fmt.Print(cipherStr)\n&amp;nbsp;&amp;nbsp;&amp;nbsp;//fmt.Print(&amp;quot;\\n&amp;quot;)\n&amp;nbsp;&amp;nbsp;&amp;nbsp;fmt.Print(hex.EncodeToString(cipherStr))\n}\n//遍历文件\nfunc&amp;nbsp;op_file(file_name&amp;nbsp;string)&amp;nbsp;&amp;nbsp;{\n&amp;nbsp;&amp;nbsp;&amp;nbsp;file,err:=os.OpenFile(file_name,os.O_CREATE|os.O_RDWR,0777)\n&amp;nbsp;&amp;nbsp;&amp;nbsp;if&amp;nbsp;err!=nil{\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;fmt.Println(&amp;quot;open&amp;nbsp;file&amp;nbsp;error:&amp;quot;,err)\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;return\n&amp;nbsp;&amp;nbsp;&amp;nbsp;}\n&amp;nbsp;&amp;nbsp;&amp;nbsp;defer&amp;nbsp;file.Close()\n&amp;nbsp;&amp;nbsp;&amp;nbsp;reader&amp;nbsp;:=bufio.NewReader(file)\n&amp;nbsp;&amp;nbsp;&amp;nbsp;/*buf,err:=ioutil.ReadAll(file)\n&amp;nbsp;&amp;nbsp;&amp;nbsp;if&amp;nbsp;err!=nil{\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;fmt.Fprintf(os.Stderr,&amp;quot;dile&amp;nbsp;error:%s\\n&amp;quot;,err)\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;return\n&amp;nbsp;&amp;nbsp;&amp;nbsp;}\n&amp;nbsp;&amp;nbsp;&amp;nbsp;fmt.Printf(&amp;quot;%s\\n&amp;quot;,string(buf))*/\n\n\n&amp;nbsp;&amp;nbsp;&amp;nbsp;for&amp;nbsp;{\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;str,err:=reader.ReadString(&amp;#39;\\n&amp;#39;)\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;if&amp;nbsp;err!=nil{\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;fmt.Println(&amp;quot;文件读取错误,err:&amp;quot;,err)\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;return\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;}\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;//fmt.Printf(str)\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;get_md5(str)\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;fmt.Print(&amp;quot;\\r\\n&amp;quot;)\n&amp;nbsp;&amp;nbsp;&amp;nbsp;}\n}\n/**\n遍历文件夹\n&amp;nbsp;*/\nfunc&amp;nbsp;getFilelist(path&amp;nbsp;string)&amp;nbsp;{\n&amp;nbsp;&amp;nbsp;&amp;nbsp;err&amp;nbsp;:=&amp;nbsp;filepath.Walk(path,&amp;nbsp;func(path&amp;nbsp;string,&amp;nbsp;f&amp;nbsp;os.FileInfo,&amp;nbsp;err&amp;nbsp;error)&amp;nbsp;error&amp;nbsp;{\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;if&amp;nbsp;f&amp;nbsp;==&amp;nbsp;nil&amp;nbsp;{\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;return&amp;nbsp;err\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;}\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;//println(path)\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;//这样就排除了不遍历的文件,但是文件里面不能包含这个文件名\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;if&amp;nbsp;strings.Contains(path,&amp;nbsp;&amp;quot;.idea&amp;quot;){\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;return&amp;nbsp;nil\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;}&amp;nbsp;//true\n\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;//println(path)\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;if&amp;nbsp;f.IsDir()&amp;nbsp;{\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;return&amp;nbsp;nil\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;}\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;op_file(path)\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;//println(path)\n\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;return&amp;nbsp;nil\n&amp;nbsp;&amp;nbsp;&amp;nbsp;})\n&amp;nbsp;&amp;nbsp;&amp;nbsp;fmt.Print()\n&amp;nbsp;&amp;nbsp;&amp;nbsp;if&amp;nbsp;err&amp;nbsp;!=&amp;nbsp;nil&amp;nbsp;{\n&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;fmt.Printf(&amp;quot;filepath.Walk()&amp;nbsp;returned&amp;nbsp;%v\\n&amp;quot;,&amp;nbsp;err)\n&amp;nbsp;&amp;nbsp;&amp;nbsp;}\n}\n\nfunc&amp;nbsp;main(){\n&amp;nbsp;&amp;nbsp;&amp;nbsp;//flag.Parse()\n&amp;nbsp;&amp;nbsp;&amp;nbsp;//root&amp;nbsp;:=&amp;nbsp;flag.Arg(0)\n&amp;nbsp;&amp;nbsp;&amp;nbsp;getFilelist(&amp;quot;./&amp;quot;)\n}&lt;/pre&gt;&lt;p&gt;&lt;img src=&quot;/ueditor/php/upload/image/20170830/1504097241564146.png&quot; alt=&quot; &quot;/&gt;&lt;/p&gt;',1,'admin','','php','ccs',1504097278,1504100345,0,0,'/uploads/20170830/59a6bff4b137a.jpg',0,0,1,1,1),(17,'测试','&lt;p&gt;测试厂房撒啊&lt;/p&gt;',1,'517421372','','测试','查重率',1504618198,0,0,0,'/uploads/20170905/59aebba1e9d39.jpg',0,0,0,2,1),(18,'测试234','&lt;p&gt;测试厂房撒啊&lt;/p&gt;',1,'517421372','','测试','查重率',1504618328,0,0,0,'/uploads/20170905/59aebba1e9d39.jpg',0,0,0,2,1),(19,'测试的萨达是','&lt;p&gt;1111&lt;/p&gt;',1,'517421372','','111','1111',1504618826,0,0,0,'/uploads/20170905/59aebba1e9d39.jpg',0,0,0,2,1),(20,'显示','&lt;p&gt;啊撒大声地&lt;/p&gt;',1,'517421372','','sad','阿打算的',1504618865,0,0,0,'/uploads/20170905/59aebba1e9d39.jpg',0,0,0,2,1),(21,'测试测试436543','&lt;p&gt;现在vsxzc&lt;br/&gt;&lt;/p&gt;',1,'517421372','','vcxzv',' 线程V型存在v',1504618993,0,0,0,'/uploads/20170905/59aebba1e9d39.jpg',0,0,0,2,1),(22,'可收到反馈撒酒疯v','&lt;p&gt;舒服撒发到付&lt;/p&gt;',1,'517421372','','是否是范德萨','舒服撒反对',1504619251,0,0,0,'/uploads/20170905/59aebba1e9d39.jpg',0,0,0,2,1),(23,'adads ','&lt;p&gt;&amp;nbsp;asdasdas&lt;/p&gt;',2,'517421372','','adasd','asdasd',1504619432,0,0,0,'/uploads/20170905/59aebba1e9d39.jpg',0,0,0,2,1),(24,'dgfsd','&lt;p&gt;safsdf&lt;/p&gt;',1,'admin','','safsadfsa','safsdaf',1504619495,0,0,0,'/uploads/20170905/59aebba1e9d39.jpg',0,0,1,1,1),(25,'测试在来一次','&lt;p&gt;撒发生大&lt;/p&gt;',1,'517421372','','整的','虾吃虾涮',1504623559,1518012752,0,0,'/uploads/20170905/59aebba1e9d39.jpg',0,0,0,2,1),(26,'1312','&lt;p&gt;131232&lt;/p&gt;&lt;audio controls=&quot;controls&quot; style=&quot;display: none;&quot;&gt;&lt;/audio&gt;',1,'admin','','1312','123123',1518012839,1518013367,0,0,'/uploads/20180207/5a7b0bb516a18.jpg',0,0,1,1,1),(27,'13123','&lt;p&gt;13123&lt;/p&gt;&lt;audio controls=&quot;controls&quot; style=&quot;display: none;&quot;&gt;&lt;/audio&gt;',1,'admin','','3122123','13212',1518013294,1518013337,0,0,'/uploads/20180207/5a7b0b9743a1d.jpg',0,0,1,1,1),(28,'新闻中心','&lt;p&gt;关键字&lt;/p&gt;',1,'admin','','关键字','关键字',1520599740,1520599849,0,0,'/uploads/20180309/5aa282b3f4052.jpg',0,0,1,1,1);

/*Table structure for table `pw_article_comment` */

DROP TABLE IF EXISTS `pw_article_comment`;

CREATE TABLE `pw_article_comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_uid` int(11) NOT NULL DEFAULT '0' COMMENT '评论ID',
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT '评论的父级',
  `article_id` int(11) NOT NULL DEFAULT '0' COMMENT '评论的文章id',
  `comm_cont` text COMMENT '评论内容',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '评论时间',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '是否显示1显示,2不显示',
  `admin_type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否是管理员评论,1是,0不是',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='文章评论';

/*Data for the table `pw_article_comment` */

insert  into `pw_article_comment`(`id`,`user_uid`,`parent_id`,`article_id`,`comm_cont`,`created_at`,`status`,`admin_type`) values (1,1,0,1,'评论就是这么简单',1504418861,1,1),(2,1,0,2,'评论就是这么简单',1504418861,1,1),(3,2,0,3,'这次评论',0,1,0),(4,2,0,3,'来评论',0,1,0);

/*Table structure for table `pw_article_type` */

DROP TABLE IF EXISTS `pw_article_type`;

CREATE TABLE `pw_article_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '类型名字',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `save_time` int(11) NOT NULL DEFAULT '0' COMMENT '修改时间',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='新闻类型';

/*Data for the table `pw_article_type` */

insert  into `pw_article_type`(`id`,`name`,`add_time`,`save_time`,`status`) values (1,'新闻中心',1520601612,0,1),(2,'电视媒体',1520601624,0,1);

/*Table structure for table `pw_banner` */

DROP TABLE IF EXISTS `pw_banner`;

CREATE TABLE `pw_banner` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态',
  `url` varchar(500) NOT NULL DEFAULT '' COMMENT 'banner图片地址',
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1是主页,暂时没有其他',
  `jump_url` varchar(500) NOT NULL DEFAULT '' COMMENT '跳转地址',
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '主题名字',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='banner表';

/*Data for the table `pw_banner` */

insert  into `pw_banner`(`id`,`status`,`url`,`type`,`jump_url`,`name`,`created_at`,`updated_at`) values (1,1,'/uploads/20170902/59aa6f944f534.jpg',1,'','测试3',0,1504341911),(2,1,'/uploads/20170902/59aa702a8d825.jpg',1,'','测试2',1503137770,1504342060),(3,1,'/uploads/20180309/5aa284a0e720d.jpg',1,'https://www.2345.com/?kweipu517421372','测试1',1503137857,1520600228);

/*Table structure for table `pw_config` */

DROP TABLE IF EXISTS `pw_config`;

CREATE TABLE `pw_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `types` int(11) NOT NULL COMMENT '类型,1底部,2公司名字,',
  `content` text COMMENT '内容',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `save_time` int(11) NOT NULL DEFAULT '0' COMMENT '修改时间',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='配置表';

/*Data for the table `pw_config` */

insert  into `pw_config`(`id`,`types`,`content`,`add_time`,`save_time`,`status`) values (1,1,'©2017大华股份 浙ICP07004180浙公网安备 33010802003424号',1517711955,1517712471,1),(2,2,'测试公司',1517713144,0,1);

/*Table structure for table `pw_permissions` */

DROP TABLE IF EXISTS `pw_permissions`;

CREATE TABLE `pw_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `access` text,
  `info` text,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `pw_permissions` */

insert  into `pw_permissions`(`id`,`name`,`access`,`info`,`status`) values (1,'超级管理','基础查询;文章管理;解决方案管理;产品及服务管理;配置管理;权限管理;','icon;spread;主页;首页中心;icon;spread;文章管理;发布文章;编辑文章;获取文章编辑页面;文章数据列表;删除文章;置顶文章;取消置顶文章;文章类型管理;添加类型文章;编辑类型文章;获取文章类型编辑页面;文章类型数据列表;删除文章类型;banner管理;修改banner;获取banner编辑页面;添加banner;获取banner数据列表;删除banner;icon;spread;解决方案类型列表;添加解决方案类型;修改解决方案类型;解决方案类型编辑页面;解决方案类型获取数据列表;删除解决方案类型;解决方案内容列表;添加解决方案内容;修改解决方案内容;解决方案内容编辑页面;解决方案内容获取数据列表;删除解决方案内容;icon;spread;产品及服务列表;添加产品及服务;修改产品及服务;产品及服务编辑页面;产品及服务获取数据列表;删除产品及服务;icon;spread;配置列表;添加配置;修改配置;配置编辑页面;配置获取数据列表;删除配置;icon;spread;管理员管理;添加管理员;修改管理员;管理员编辑页面;管理员获取数据列表;删除管理员;管理组管理;修改管理组;获取编辑页面;添加管理组;获取数据列表;删除管理组;icon;spread;获取菜单数据;文件上传;',1),(2,'超级2','基础查询;文章管理;权限管理;','icon;spread;主页;首页中心;icon;spread;咨询管理;发布咨询;编辑咨询;推送至专题;咨询文章数据列表;删除咨询;获取专题内容;推送专题入库;置顶文章;取消置顶文章;推送头条;取消推送头条;专题管理;修改专题;获取专题编辑页面;添加专题;获取专题数据列表;删除专题;icon;spread;管理员管理;添加管理员;修改管理员;管理员编辑页面;管理员获取数据列表;删除管理员;管理组管理;修改管理组;获取编辑页面;添加管理组;获取数据列表;删除管理组;icon;spread;获取菜单数据;',0);

/*Table structure for table `pw_programa` */

DROP TABLE IF EXISTS `pw_programa`;

CREATE TABLE `pw_programa` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '栏目名字',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父名字',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态1显示,2不显示',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='栏目名字';

/*Data for the table `pw_programa` */

insert  into `pw_programa`(`id`,`name`,`pid`,`status`) values (1,'菜单',0,1),(2,'菜单22',4,1),(3,'菜单1-2',0,1),(4,'菜单1-1',3,1),(5,'cs',2,1);











/*Table structure for table `pw_user` */

DROP TABLE IF EXISTS `pw_user`;

CREATE TABLE `pw_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL DEFAULT '' COMMENT '用户名字',
  `password_hash` char(60) NOT NULL DEFAULT '' COMMENT '密码',
  `email` char(50) NOT NULL DEFAULT '' COMMENT '邮箱',
  `role` int(11) NOT NULL DEFAULT '0' COMMENT '权限',
  `status` tinyint(4) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `auth_key` char(50) NOT NULL DEFAULT '',
  `head_portrait` varchar(200) NOT NULL DEFAULT '' COMMENT '头像',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `pw_user` */

insert  into `pw_user`(`id`,`username`,`password_hash`,`email`,`role`,`status`,`created_at`,`updated_at`,`auth_key`,`head_portrait`) values (1,'admin','$2y$13$QnI4C1BVCiMmH5nrCJ0odezLLFRXrKr0hNo5Ee6reY89NGmZ1btGq','123@123.com',1,10,1499428389,1499428389,'','/images/noavatar_small.gif'),(2,'admin2','$2y$13$QnI4C1BVCiMmH5nrCJ0odezLLFRXrKr0hNo5Ee6reY89NGmZ1btGq','123@123.com',2,10,1499430288,1502457861,'','');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
