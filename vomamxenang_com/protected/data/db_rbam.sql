/*
SQLyog Trial v10.51 
MySQL - 5.5.16 : Database - prj_default
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`prj_default` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `prj_default`;

/*Table structure for table `authassignment` */

DROP TABLE IF EXISTS `authassignment`;

CREATE TABLE `authassignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` int(11) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=COMPACT;

/*Data for the table `authassignment` */

/*Table structure for table `authitem` */

DROP TABLE IF EXISTS `authitem`;

CREATE TABLE `authitem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `authitem` */

insert  into `authitem`(`name`,`type`,`description`,`bizrule`,`data`) values ('Administrators',2,'Administrators Role',NULL,'N;'),('Super Admin',2,'Super Admin Role',NULL,'N;'),('User',2,'User Role','return Helper::user()->id;','N;');

/*Table structure for table `authitemchild` */

DROP TABLE IF EXISTS `authitemchild`;

CREATE TABLE `authitemchild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `FK_authitemchild_1` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `authitemchild` */

insert  into `authitemchild`(`parent`,`child`) values ('Super Admin','Administrators'),('Administrators','User'),('Super Admin','User');

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `lookup` */

insert  into `lookup`(`id`,`name`,`code`,`type`,`position`) values (1,'Approved','1','Status',1),(2,'Pending','2','Status',2),(3,'SuperAdmin','0','Level_User',1),(4,'Admin','1','Level_User',2),(5,'User','2','Level_User',3);

/*Table structure for table `setting_params` */

DROP TABLE IF EXISTS `setting_params`;

CREATE TABLE `setting_params` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `label` varchar(64) DEFAULT NULL,
  `values` text,
  `description` text,
  `setting_group` varchar(128) DEFAULT NULL,
  `ordering` int(11) DEFAULT NULL,
  `visible` char(1) DEFAULT NULL,
  `module` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

/*Data for the table `setting_params` */

insert  into `setting_params`(`id`,`name`,`label`,`values`,`description`,`setting_group`,`ordering`,`visible`,`module`) values (1,'ADMIN_EMAIL','Administrator\'s email','tuan.buidoanngoc@gmail.com','','General',NULL,'1',''),(2,'BO_PAGE_SIZE','Entries per page in Admin panel','10','','General',NULL,'1',''),(3,'BO_THEME','Back Office theme','Backend','','General',NULL,'1',''),(4,'DEFAULT_BO_LAYOUT','Default BO layout','//layouts/main','','General',NULL,'1',''),(5,'DEFAULT_LAYOUT','Default layout','//layouts/home','','General',NULL,'1',''),(6,'DEFAULT_META_DESCRIPTION','Default meta description','thiet ke web,thiet ke web chat luong,thiet ke web gia re,web3in1.com','','General',NULL,'1',''),(7,'DEFAULT_META_KEYWORDS','Default meta keywords','thiet ke web,thiet ke web chat luong,thiet ke web gia re,web3in1.com','','General',NULL,'1',''),(8,'MAIL_METHOD','Mail sending method','smtp','','General',NULL,'1',''),(9,'MAIL_SENDER_NAME','Email sender name','Contact Web3in1','','General',NULL,'1',''),(10,'MAIL_SENDER_ADDRESS','Email sender address','tuan.buidoanngoc@gmail.com','','General',NULL,'1',''),(11,'PAGE_SIZE','Entries per page','10','','General',NULL,'1',''),(12,'DB_HOST','DB Host','localhost','','DB Local',NULL,'1',''),(13,'DB_PORT','DB Port','3306','','DB Local',NULL,'1',''),(14,'DB_NAME','DB Name','prj_default','','DB Local',NULL,'1',''),(15,'DB_PSWD','DB password','','','DB Local',NULL,'1',''),(16,'DB_USER','DB User','root','','DB Local',NULL,'1',''),(17,'SMTP_HOST','SMTP host','smtp.gmail.com','','General',NULL,'1',''),(18,'SMTP_PASSWORD','SMTP password','ngoctuan','','General',NULL,'1',''),(19,'SMTP_PORT','SMTP port','465','','General',NULL,'1',''),(20,'SMTP_SECURE','SMTP sercure connection','tls','','General',NULL,'1',''),(21,'SMTP_USERNAME','SMTP username','tuan.buidoanngoc@gmail.com','','General',NULL,'1',''),(22,'THEME','THEME','FrontEnd','','General',NULL,'1',''),(23,'APPROVED','Status Approved','1',NULL,'General',NULL,'1',''),(24,'PENDING','Status Pending','2',NULL,'General',NULL,'1',''),(25,'None_Spam','None spam','2','','General',NULL,'1',''),(26,'tagCloudCount ','tagCloudCount ','10',NULL,'General',NULL,'1',''),(27,'commentCount','commentCount','10',NULL,'General',NULL,'1',''),(28,'BO_SUPER_ADMIN_THEME','Super Admin Theme','SuperAdmin',NULL,'General',NULL,'1','');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `password` char(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `address` varchar(255) NOT NULL,
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

insert  into `user`(`id`,`username`,`password`,`email`,`fullname`,`phone`,`address`,`avatar`,`created_date`,`last_login`,`validation_code`,`validation_type`,`validation_expired`,`status`,`type`) values (1,'gilla','827ccb0eea8a706c4c34a16891f84e7b','ngoctuan3010842003@yahoo.com','Bui Doan Ngoc Tuan','','','','0000-00-00','2012-09-29','',NULL,0,'1','0'),(2,'admin','827ccb0eea8a706c4c34a16891f84e7b','ngoctuan3010842003@yahoo.com1','fullname Admin','09090000','373/152/45 Lý Thường Kiệt F8 Q.Tân Bình','','2013-03-26','2012-09-29','',NULL,0,'1','1');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
