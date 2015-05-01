/*
SQLyog Community v9.10 
MySQL - 5.5.27 : Database - prj_default
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `banner` */

DROP TABLE IF EXISTS `banner`;

CREATE TABLE `banner` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `info` text COLLATE utf8_unicode_ci,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_width` int(3) NOT NULL,
  `image_height` int(3) NOT NULL,
  `position` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ordering` int(11) DEFAULT NULL,
  `create_date` int(11) DEFAULT NULL,
  `expired_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `banner` */

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
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `lookup` */

insert  into `lookup`(`id`,`name`,`code`,`type`,`position`) values (1,'Approved','1','Status',1),(2,'Pending','2','Status',2),(3,'Super','0','Level_User',1),(4,'Administrators','1','Level_User',2),(5,'User','3','Level_User',3),(6,'Top','1','Position_Banner',1),(7,'Bottom','2','Position_Banner',2),(8,'Left','3','Position_Banner',3),(9,'Right','4','Position_Banner',4),(11,'Offline','2','isOnline',2),(10,'Online','1','isOnline',1);

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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

/*Data for the table `setting_params` */

insert  into `setting_params`(`id`,`name`,`label`,`values`,`description`,`setting_group`,`ordering`,`visible`,`module`) values (1,'ADMIN_EMAIL','Administrator\'s email','tuan.buidoanngoc@gmail.com','','General',NULL,'1',''),(2,'BO_PAGE_SIZE','Entries per page in Admin panel','10','','General',NULL,'1',''),(3,'BO_THEME','Back Office theme','Backend','','General',NULL,'1',''),(4,'DEFAULT_BO_LAYOUT','Default BO layout','//layouts/main','','General',NULL,'1',''),(5,'DEFAULT_LAYOUT','Default layout','//layouts/home','','General',NULL,'1',''),(6,'DEFAULT_META_DESCRIPTION','Default meta description','Chuyên cung cấp dịch vụ thiết kế web,SEO có ngay pageRank,hỗ trợ 24/24 mọi lúc mọi nơi, đừng ngần ngại hãy gọi cho chúng tôi để được tư vấn free.Điên thoại: 0909 79 39 72','','General',NULL,'1',''),(7,'DEFAULT_META_KEYWORDS','Default meta keywords','Dịch vụ thiết kế web,SEO có ngay pageRank,áp dụng kỹ thuật mới nhất,hỗ trợ sinh viên làm đồ án tốt nghiệp trên nền web, bảo hành vĩnh viễn khi gặp sự cố,tư vấn miễn phí','','General',NULL,'1',''),(8,'MAIL_METHOD','Mail sending method','smtp','','General',NULL,'1',''),(9,'MAIL_SENDER_NAME','Email sender name','Contact Web3in1','','General',NULL,'1',''),(10,'MAIL_SENDER_ADDRESS','Email sender address','tuan.buidoanngoc@gmail.com','','General',NULL,'1',''),(11,'PAGE_SIZE','Entries per page','10','','General',NULL,'1',''),(12,'DB_HOST','DB Host','localhost','','DB Local',NULL,'1',''),(13,'DB_PORT','DB Port','3306','','DB Local',NULL,'1',''),(14,'DB_NAME','DB Name','prj_web3in1_seo','','DB Local',NULL,'1',''),(15,'DB_PSWD','DB password','','','DB Local',NULL,'1',''),(16,'DB_USER','DB User','root','','DB Local',NULL,'1',''),(17,'SMTP_HOST','SMTP host','smtp.gmail.com','','General',NULL,'1',''),(18,'SMTP_PASSWORD','SMTP password','Ng9ct71n','','General',NULL,'1',''),(19,'SMTP_PORT','SMTP port','465','','General',NULL,'1',''),(20,'SMTP_SECURE','SMTP sercure connection','ssl','','General',NULL,'1',''),(21,'SMTP_USERNAME','SMTP username','tuan.buidoanngoc@gmail.com','','General',NULL,'1',''),(22,'THEME','THEME','FrontEnd','','General',NULL,'1',''),(23,'APPROVED','Status Approved','1',NULL,'General',NULL,'1',''),(24,'PENDING','Status Pending','2',NULL,'General',NULL,'1',''),(25,'None_Spam','None spam','2','','General',NULL,'1',''),(26,'tagCloudCount ','tagCloudCount ','10',NULL,'General',NULL,'1',''),(27,'commentCount','commentCount','10',NULL,'General',NULL,'1',''),(28,'BO_SUPER_ADMIN_THEME','Super Admin Theme','SuperAdmin',NULL,'General',NULL,'1',''),(29,'Online','User Online','1',NULL,'General',NULL,'1',NULL),(30,'Offline','User Offline','2',NULL,'General',NULL,'1',NULL),(31,'Type_Post','Type Post','1','','General',NULL,'1','');

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
  `website` varchar(255) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `last_login` date DEFAULT NULL,
  `is_online` char(1) DEFAULT NULL,
  `validation_code` varchar(64) DEFAULT NULL,
  `validation_type` smallint(6) DEFAULT NULL,
  `validation_expired` int(11) DEFAULT NULL,
  `status` char(1) DEFAULT NULL,
  `type` char(1) DEFAULT '3',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `user` */

insert  into `user`(`id`,`username`,`password`,`email`,`fullname`,`birthday`,`phone`,`address`,`country`,`description`,`avatar`,`website`,`created_date`,`last_login`,`is_online`,`validation_code`,`validation_type`,`validation_expired`,`status`,`type`) values (1,'gilla','e10adc3949ba59abbe56e057f20f883e','ngoctuan3010842003@yahoo.com','Bui Doan Ngoc Tuan','1984-10-30','0977757911','27/21 Bui Tu Toan','Viet Nam','Design Web, Yii Framework, Symfony, HTML, CSS, JQuery','2013_08_23_06_27_37_Tulips.jpg,2013_08_23_06_27_37_Penguins.jpg,2013_08_23_06_28_25_Koala.jpg','http://web3in1.com','2013-04-07','2013-08-23','1','',NULL,NULL,'1','0'),(2,'admin','827ccb0eea8a706c4c34a16891f84e7b','ngoctuan3010842003@yahoo.com1','Bui Tran Ngoc Phu','2010-03-19','09040909099','27/21 Bui Tu Toan F.An Lac Q.Binh Tan','VN','tét','',NULL,'2013-04-08','2013-08-26','1','',NULL,0,'1','1'),(3,'user','827ccb0eea8a706c4c34a16891f84e7b','ngoctuan3010842003@yahoo.com2','wwww','0000-00-00','3543412345','4334','VN','11111111',NULL,NULL,'2013-04-08','2013-04-08',NULL,NULL,NULL,0,'1','3'),(7,'abctest','e10adc3949ba59abbe56e057f20f883e','gangtergilla4@gmail.com','abc test','1988-07-15','09090909090','27.21 bui tu toan','VN','vvvvvvvvvv','2013_08_23_05_28_15_create-crud-by-model.png,2013_08_23_05_28_15_Chrysanthemum.jpg','http://web3in1.com','2013-08-23','0000-00-00','2','',NULL,NULL,'1','3');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
