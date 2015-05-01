/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.5.25a : Database - prj_default
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `authassignment` */

DROP TABLE IF EXISTS `authassignment`;

CREATE TABLE `authassignment` (
  `itemname` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `userid` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `bizrule` text COLLATE utf8_unicode_ci,
  `data` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`itemname`,`userid`),
  CONSTRAINT `FK_authassignmentItemname_authitemName` FOREIGN KEY (`itemname`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `authassignment` */

insert  into `authassignment`(`itemname`,`userid`,`bizrule`,`data`) values ('8ddb4942','1',NULL,'N;'),('Admin','1',NULL,'N;'),('Admin','2',NULL,'N;'),('Administrators','2',NULL,'N;'),('Super','1',NULL,'N;'),('SuperAdmin','1',NULL,'N;');

/*Table structure for table `authitem` */

DROP TABLE IF EXISTS `authitem`;

CREATE TABLE `authitem` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `bizrule` text COLLATE utf8_unicode_ci,
  `data` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `authitem` */

insert  into `authitem`(`name`,`type`,`description`,`bizrule`,`data`) values ('8ddb4942',2,'',NULL,'N;'),('Admin',2,'',NULL,'N;'),('Admin:Default',1,'',NULL,'N;'),('Admin:Default:Index',0,'',NULL,'N;'),('Admin:User',1,'',NULL,'N;'),('Admin:User:Admin',0,'',NULL,'N;'),('Admin:User:ChangePassword',0,'',NULL,'N;'),('Admin:User:Create',0,'',NULL,'N;'),('Admin:User:Delete',0,'',NULL,'N;'),('Admin:User:Index',0,'',NULL,'N;'),('Admin:User:Update',0,'',NULL,'N;'),('Admin:User:View',0,'',NULL,'N;'),('Administrators',2,'Administrators Role',NULL,'N;'),('Site',1,'',NULL,'N;'),('Site:Captcha',0,'',NULL,'N;'),('Site:CCaptchaAction',0,'',NULL,'N;'),('Site:Contact',0,'',NULL,'N;'),('Site:Error',0,'',NULL,'N;'),('Site:Index',0,'',NULL,'N;'),('Site:Login',0,'',NULL,'N;'),('Site:Logout',0,'',NULL,'N;'),('Super',2,'SuperAdmin Role',NULL,'N;'),('SuperAdmin',2,'',NULL,'N;'),('SuperAdmin:Cache',1,'',NULL,'N;'),('SuperAdmin:Cache:Admin',0,'',NULL,'N;'),('SuperAdmin:Cache:Create',0,'',NULL,'N;'),('SuperAdmin:Cache:Delete',0,'',NULL,'N;'),('SuperAdmin:Cache:Expire',0,'',NULL,'N;'),('SuperAdmin:Cache:Index',0,'',NULL,'N;'),('SuperAdmin:Cache:Update',0,'',NULL,'N;'),('SuperAdmin:Cache:View',0,'',NULL,'N;'),('SuperAdmin:Default',1,'',NULL,'N;'),('SuperAdmin:Default:DeleteAll',0,'',NULL,'N;'),('SuperAdmin:Default:DeleteAssets',0,'',NULL,'N;'),('SuperAdmin:Default:DeleteCache',0,'',NULL,'N;'),('SuperAdmin:Default:DeleteImage',0,'',NULL,'N;'),('SuperAdmin:Default:Index',0,'',NULL,'N;'),('SuperAdmin:Lookup',1,'',NULL,'N;'),('SuperAdmin:Lookup:Admin',0,'',NULL,'N;'),('SuperAdmin:Lookup:Create',0,'',NULL,'N;'),('SuperAdmin:Lookup:Delete',0,'',NULL,'N;'),('SuperAdmin:Lookup:Index',0,'',NULL,'N;'),('SuperAdmin:Lookup:Update',0,'',NULL,'N;'),('SuperAdmin:Lookup:View',0,'',NULL,'N;'),('SuperAdmin:SettingParams',1,'',NULL,'N;'),('SuperAdmin:SettingParams:Admin',0,'',NULL,'N;'),('SuperAdmin:SettingParams:ConfigParams',0,'',NULL,'N;'),('SuperAdmin:SettingParams:Create',0,'',NULL,'N;'),('SuperAdmin:SettingParams:Delete',0,'',NULL,'N;'),('SuperAdmin:SettingParams:Index',0,'',NULL,'N;'),('SuperAdmin:SettingParams:Update',0,'',NULL,'N;'),('SuperAdmin:SettingParams:View',0,'',NULL,'N;');

/*Table structure for table `authitemchild` */

DROP TABLE IF EXISTS `authitemchild`;

CREATE TABLE `authitemchild` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `FK_authitemchildChild_authitemName` (`child`),
  CONSTRAINT `FK_authitemchildChild_authitemName` FOREIGN KEY (`child`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_authitemchildParent_authitemName` FOREIGN KEY (`parent`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `authitemchild` */

insert  into `authitemchild`(`parent`,`child`) values ('8ddb4942','Admin'),('Admin','Admin:Default'),('Admin:Default','Admin:Default:Index'),('Admin','Admin:User'),('Admin:User','Admin:User:Admin'),('Admin:User','Admin:User:ChangePassword'),('Admin:User','Admin:User:Create'),('Admin:User','Admin:User:Delete'),('Admin:User','Admin:User:Index'),('Admin:User','Admin:User:Update'),('Admin:User','Admin:User:View'),('Super','Administrators'),('8ddb4942','Site'),('Site','Site:Captcha'),('Site','Site:CCaptchaAction'),('Site','Site:Contact'),('Site','Site:Error'),('Site','Site:Index'),('Site','Site:Login'),('Site','Site:Logout'),('8ddb4942','SuperAdmin'),('SuperAdmin','SuperAdmin:Cache'),('SuperAdmin:Cache','SuperAdmin:Cache:Admin'),('SuperAdmin:Cache','SuperAdmin:Cache:Create'),('SuperAdmin:Cache','SuperAdmin:Cache:Delete'),('SuperAdmin:Cache','SuperAdmin:Cache:Expire'),('SuperAdmin:Cache','SuperAdmin:Cache:Index'),('SuperAdmin:Cache','SuperAdmin:Cache:Update'),('SuperAdmin:Cache','SuperAdmin:Cache:View'),('SuperAdmin','SuperAdmin:Default'),('SuperAdmin:Default','SuperAdmin:Default:DeleteAll'),('SuperAdmin:Default','SuperAdmin:Default:DeleteAssets'),('SuperAdmin:Default','SuperAdmin:Default:DeleteCache'),('SuperAdmin:Default','SuperAdmin:Default:DeleteImage'),('SuperAdmin:Default','SuperAdmin:Default:Index'),('SuperAdmin','SuperAdmin:Lookup'),('SuperAdmin:Lookup','SuperAdmin:Lookup:Admin'),('SuperAdmin:Lookup','SuperAdmin:Lookup:Create'),('SuperAdmin:Lookup','SuperAdmin:Lookup:Delete'),('SuperAdmin:Lookup','SuperAdmin:Lookup:Index'),('SuperAdmin:Lookup','SuperAdmin:Lookup:Update'),('SuperAdmin:Lookup','SuperAdmin:Lookup:View'),('SuperAdmin','SuperAdmin:SettingParams'),('SuperAdmin:SettingParams','SuperAdmin:SettingParams:Admin'),('SuperAdmin:SettingParams','SuperAdmin:SettingParams:ConfigParams'),('SuperAdmin:SettingParams','SuperAdmin:SettingParams:Create'),('SuperAdmin:SettingParams','SuperAdmin:SettingParams:Delete'),('SuperAdmin:SettingParams','SuperAdmin:SettingParams:Index'),('SuperAdmin:SettingParams','SuperAdmin:SettingParams:Update'),('SuperAdmin:SettingParams','SuperAdmin:SettingParams:View');

/*Table structure for table `authitemweight` */

DROP TABLE IF EXISTS `authitemweight`;

CREATE TABLE `authitemweight` (
  `itemname` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  PRIMARY KEY (`itemname`),
  CONSTRAINT `FK_authitemweightItemname_authitemName` FOREIGN KEY (`itemname`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `authitemweight` */

/*Table structure for table `banner` */

DROP TABLE IF EXISTS `banner`;

CREATE TABLE `banner` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `info` text COLLATE utf8_unicode_ci,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_width` int(3) DEFAULT NULL,
  `image_height` int(3) DEFAULT NULL,
  `position` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ordering` int(11) DEFAULT NULL,
  `create_date` int(11) DEFAULT NULL,
  `expired_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `banner` */

/*Table structure for table `blog_comments` */

DROP TABLE IF EXISTS `blog_comments`;

CREATE TABLE `blog_comments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `info` text COLLATE utf8_unicode_ci NOT NULL,
  `status` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_date` int(11) DEFAULT NULL,
  `user_id` int(11) unsigned DEFAULT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `post_id` int(11) unsigned DEFAULT NULL,
  `post_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `post_alias` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `owner_post` int(11) DEFAULT NULL,
  `update_date` int(11) DEFAULT NULL,
  `parent_id` int(11) unsigned DEFAULT NULL,
  `is_read` char(1) COLLATE utf8_unicode_ci DEFAULT '1',
  `is_spam` char(1) COLLATE utf8_unicode_ci DEFAULT '2',
  `logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_comment_post` (`post_id`),
  KEY `FK_comment_user` (`user_id`),
  KEY `FK_comment_parent` (`parent_id`),
  CONSTRAINT `FK_comment_parent` FOREIGN KEY (`parent_id`) REFERENCES `blog_comments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_comment_post` FOREIGN KEY (`post_id`) REFERENCES `blog_posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_comment_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `blog_comments` */

/*Table structure for table `blog_posts` */

DROP TABLE IF EXISTS `blog_posts`;

CREATE TABLE `blog_posts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `info` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tags` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `create_date` int(11) DEFAULT NULL,
  `update_date` int(11) DEFAULT NULL,
  `priority` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `blog_posts` */

/*Table structure for table `blog_tags` */

DROP TABLE IF EXISTS `blog_tags`;

CREATE TABLE `blog_tags` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `frequency` int(11) DEFAULT NULL,
  `status` char(1) COLLATE utf8_unicode_ci DEFAULT '1',
  `type` char(1) COLLATE utf8_unicode_ci DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `blog_tags` */

/*Table structure for table `cache` */

DROP TABLE IF EXISTS `cache`;

CREATE TABLE `cache` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `expired` int(11) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `cache` */

/*Table structure for table `lookup` */

DROP TABLE IF EXISTS `lookup`;

CREATE TABLE `lookup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `code` varchar(10) NOT NULL,
  `type` varchar(128) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `lookup` */

insert  into `lookup`(`id`,`name`,`code`,`type`,`position`) values (1,'Approved','1','Status',1),(2,'Pending','2','Status',2),(3,'Super','0','Level_User',1),(4,'Administrators','1','Level_User',2);

/*Table structure for table `setting_params` */

DROP TABLE IF EXISTS `setting_params`;

CREATE TABLE `setting_params` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `label` varchar(64) DEFAULT NULL,
  `values` text NOT NULL,
  `description` text,
  `setting_group` varchar(128) DEFAULT NULL,
  `ordering` int(11) DEFAULT NULL,
  `visible` char(1) DEFAULT NULL,
  `module` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

/*Data for the table `setting_params` */

insert  into `setting_params`(`id`,`name`,`label`,`values`,`description`,`setting_group`,`ordering`,`visible`,`module`) values (1,'ADMIN_EMAIL','Administrator\'s email','tuan.buidoanngoc@gmail.com','','General',NULL,'1',''),(2,'BO_PAGE_SIZE','Entries per page in Admin panel','10','','General',NULL,'1',''),(3,'BO_THEME','Back Office theme','Backend','','General',NULL,'1',''),(4,'DEFAULT_BO_LAYOUT','Default BO layout','//layouts/main','','General',NULL,'1',''),(5,'DEFAULT_LAYOUT','Default layout','//layouts/home','','General',NULL,'1',''),(6,'DEFAULT_META_DESCRIPTION','Default meta description','thiet ke web,thiet ke web chat luong,thiet ke web gia re,web3in1.com','','General',NULL,'1',''),(7,'DEFAULT_META_KEYWORDS','Default meta keywords','thiet ke web,thiet ke web chat luong,thiet ke web gia re,web3in1.com','','General',NULL,'1',''),(8,'MAIL_METHOD','Mail sending method','smtp','','General',NULL,'1',''),(9,'MAIL_SENDER_NAME','Email sender name','Contact Web3in1','','General',NULL,'1',''),(10,'MAIL_SENDER_ADDRESS','Email sender address','tuan.buidoanngoc@gmail.com','','General',NULL,'1',''),(11,'PAGE_SIZE','Entries per page','10','','General',NULL,'1',''),(12,'DB_HOST','DB Host','localhost','','DB Local',NULL,'1',''),(13,'DB_PORT','DB Port','3306','','DB Local',NULL,'1',''),(14,'DB_NAME','DB Name','prj_default','','DB Local',NULL,'1',''),(15,'DB_PSWD','DB password','','','DB Local',NULL,'1',''),(16,'DB_USER','DB User','root','','DB Local',NULL,'1',''),(17,'SMTP_HOST','SMTP host','smtp.gmail.com','','General',NULL,'1',''),(18,'SMTP_PASSWORD','SMTP password','ngoctuan','','General',NULL,'1',''),(19,'SMTP_PORT','SMTP port','465','','General',NULL,'1',''),(20,'SMTP_SECURE','SMTP sercure connection','ssl','','General',NULL,'1',''),(21,'SMTP_USERNAME','SMTP username','tuan.buidoanngoc@gmail.com','','General',NULL,'1',''),(22,'THEME','THEME','FrontEnd','','General',NULL,'1',''),(23,'APPROVED','Status Approved','1',NULL,'General',NULL,'1',''),(24,'PENDING','Status Pending','2',NULL,'General',NULL,'1',''),(25,'None_Spam','None spam','2','','General',NULL,'1',''),(26,'tagCloudCount ','tagCloudCount ','10',NULL,'General',NULL,'1',''),(27,'commentCount','commentCount','10',NULL,'General',NULL,'1',''),(28,'BO_SUPER_ADMIN_THEME','Super Admin Theme','SuperAdmin',NULL,'General',NULL,'1','');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `password` char(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `birthday` date DEFAULT NULL,
  `phone` varchar(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `country` varchar(64) DEFAULT NULL,
  `description` text,
  `avatar` varchar(255) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `last_login` date DEFAULT NULL,
  `validation_code` varchar(64) DEFAULT NULL,
  `validation_type` smallint(6) DEFAULT NULL,
  `validation_expired` int(11) DEFAULT NULL,
  `status` char(1) DEFAULT NULL,
  `type` char(1) DEFAULT '3',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `user` */

insert  into `user`(`id`,`username`,`password`,`email`,`fullname`,`birthday`,`phone`,`address`,`country`,`description`,`avatar`,`created_date`,`last_login`,`validation_code`,`validation_type`,`validation_expired`,`status`,`type`) values (1,'gilla','827ccb0eea8a706c4c34a16891f84e7b','ngoctuan3010842003@yahoo.com','Bui Doan Ngoc Tuan','1984-10-30','0909793972','','Viet Nam','tét décription','','2013-03-25','2012-09-29','',NULL,0,'1','0'),(2,'admin','e10adc3949ba59abbe56e057f20f883e','ngoctuan3010842003@yahoo.com1','fullname Admin',NULL,'','',NULL,NULL,'','2013-03-24','2012-09-29','',NULL,0,'1','1');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
