/*
SQLyog Community v9.10 
MySQL - 5.5.32-cll : Database - thietkew_vomam
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `cache` */

DROP TABLE IF EXISTS `cache`;

CREATE TABLE `cache` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `expired` int(11) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `cache` */

insert  into `cache`(`id`,`name`,`description`,`expired`,`duration`) values (1,'cached_Review_all_limit-false-_pagingAjax-1_durati','Cache for Review with time=600',1385087245,600),(2,'cached_Review_all_limit-false-_pagingAjax-1_durati','Cache for Review with time=600',1385087272,600),(3,'cached_Review_all_limit-false-_pagingAjax-1_durati','Cache for Review with time=600',1385087290,600),(4,'cached_Review_all_limit-false-_pagingAjax-1_durati','Cache for Review with time=600',1385087406,600),(5,'cached_Review_all_limit-false-_pagingAjax-1_durati','Cache for Review with time=600',1385087651,600),(6,'cached_Review_all_limit-false-_pagingAjax-1_durati','Cache for Review with time=600',1385087740,600),(7,'cached_Review_all_limit-false-_pagingAjax-1_durati','Cache for Review with time=600',1385087792,600),(8,'cached_Review_all_limit-false-_pagingAjax-1_durati','Cache for Review with time=600',1385087829,600),(9,'cached_Review_all_limit-false-_pagingAjax-1_durati','Cache for Review with time=600',1385087866,600),(10,'cached_Review_all_limit-false-_pagingAjax-1_durati','Cache for Review with time=600',1385089195,600),(11,'cached_Review_all_limit-false-_pagingAjax-1_durati','Cache for Review with time=600',1385089230,600),(12,'cached_Review_all_limit-false-_pagingAjax-1_durati','Cache for Review with time=600',1385089253,600);

/*Table structure for table `lookup` */

DROP TABLE IF EXISTS `lookup`;

CREATE TABLE `lookup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `code` varchar(10) NOT NULL,
  `type` varchar(128) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

/*Data for the table `lookup` */

insert  into `lookup`(`id`,`name`,`code`,`type`,`position`) values (1,'Approved','1','Status',1),(2,'Pending','2','Status',2),(3,'Super','0','Level_User',1),(4,'Administrators','1','Level_User',2),(5,'User','3','Level_User',3),(6,'Top','1','Position_Banner',1),(7,'Bottom','2','Position_Banner',2),(8,'Left','3','Position_Banner',3),(9,'Right','4','Position_Banner',4),(11,'Offline','2','isOnline',2),(10,'Online','1','isOnline',1),(12,'Trang chủ','1','Display_On_Page',1),(13,'Trang list','2','Display_On_Page',2),(14,'Trang chi tiết','3','Display_On_Page',3),(15,'Thành công','1','Order_Status',1),(16,'Đang đợi','2','Order_Status',2),(17,'Đang chuyển hàng','3','Order_Status',3),(18,'Hủy','4','Order_Status',4),(19,'Tin Giới Thiệu','1','Type_News',1),(20,'Tin Tức','2','Type_News',2),(21,'Tin Thông Báo','3','Type_News',3),(22,'Tin Khuyến mãi','4','Type_News',4);

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
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

/*Data for the table `setting_params` */

insert  into `setting_params`(`id`,`name`,`label`,`values`,`description`,`setting_group`,`ordering`,`visible`,`module`) values (1,'ADMIN_EMAIL','Administrator\'s email','gangtergilla4@gmail.com','','General',NULL,'1',''),(2,'BO_PAGE_SIZE','Entries per page in Admin panel','10','','General',NULL,'1',''),(3,'BO_THEME','Back Office theme','Backend','','General',NULL,'1',''),(4,'DEFAULT_BO_LAYOUT','Default BO layout','//layouts/main','','General',NULL,'1',''),(5,'DEFAULT_LAYOUT','Default layout','//layouts/home','','General',NULL,'1',''),(6,'DEFAULT_META_DESCRIPTION','Default meta description','Chuyên cung cấp Vỏ xe nâng Bergougnan đặc ruột 600-9,Vỏ xe nâng TongYong đặc ruột 700-12,Vỏ xe điện Komatsu 305x152,Vỏ xe nâng Aichi đặc ruột 700-12,Vỏ xe nâng Aichi đặc ruột 28x9-15/700,Vỏ xe nâng TongYong đặc ruột 700-12, vỏ xe nâng, mâm xe nâng, vỏ xe điện mới, cũ, nhiều kích cớ,đầy đủ nhà sản xuất Aichi,Bridgestone,... giá cả phải chăng,luôn làm hài lòng quý khách gần xa.Hotline: 0913.600.210','','General',NULL,'1',''),(7,'DEFAULT_META_KEYWORDS','Default meta keywords','Vỏ xe nâng Bergougnan đặc ruột 600-9,Vỏ xe nâng TongYong đặc ruột 700-12,Vỏ xe điện Komatsu 305x152,Vỏ xe nâng Aichi đặc ruột 700-12,Vỏ xe nâng Aichi đặc ruột 28x9-15/700,Vỏ xe nâng TongYong đặc ruột 700-12,Vỏ xe nâng, mâm xe nâng, vỏ xe điện mới, cũ, nhiều loại từ 500-9,650-10,300-10,... với đầy đủ nhà sản xuất Aichi,Bridgestone,..','','General',NULL,'1',''),(8,'MAIL_METHOD','Mail sending method','smtp','','General',NULL,'1',''),(9,'MAIL_SENDER_NAME','Email sender name','Contact Web3in1','','General',NULL,'1',''),(10,'MAIL_SENDER_ADDRESS','Email sender address','gangtergilla4@gmail.com','','General',NULL,'1',''),(11,'PAGE_SIZE','Entries per page','10','','General',NULL,'1',''),(12,'DB_HOST','DB Host','localhost','','DB Local',NULL,'1',''),(13,'DB_PORT','DB Port','3306','','DB Local',NULL,'1',''),(14,'DB_NAME','DB Name','vomamxenang','','DB Local',NULL,'1',''),(15,'DB_PSWD','DB password','T71n@123','','DB Local',NULL,'1',''),(16,'DB_USER','DB User','root','','DB Local',NULL,'1',''),(17,'SMTP_HOST','SMTP host','smtp.gmail.com','','General',NULL,'1',''),(18,'SMTP_PASSWORD','SMTP password','Ng9cT71n','','General',NULL,'1',''),(19,'SMTP_PORT','SMTP port','465','','General',NULL,'1',''),(20,'SMTP_SECURE','SMTP sercure connection','ssl','','General',NULL,'1',''),(21,'SMTP_USERNAME','SMTP username','gangtergilla4@gmail.com','','General',NULL,'1',''),(22,'THEME','THEME','Frontend','','General',NULL,'1',''),(23,'APPROVED','Status Approved','1',NULL,'General',NULL,'1',''),(24,'PENDING','Status Pending','2',NULL,'General',NULL,'1',''),(25,'None_Spam','None spam','2','','General',NULL,'1',''),(26,'tagCloudCount ','tagCloudCount ','10',NULL,'General',NULL,'1',''),(27,'commentCount','commentCount','10',NULL,'General',NULL,'1',''),(28,'BO_SUPER_ADMIN_THEME','Super Admin Theme','SuperAdmin',NULL,'General',NULL,'1',''),(29,'Online','User Online','1',NULL,'General',NULL,'1',NULL),(30,'Offline','User Offline','2',NULL,'General',NULL,'1',NULL),(31,'Type_Post','Type Post','1','','General',NULL,'1',''),(32,'INDEX_PAGE','INDEX PAGE','1',NULL,'General',NULL,'1',NULL),(33,'Cache_Time','Cache time','600',NULL,'General',NULL,'1',NULL),(34,'ITEM_PER_PAGE','Item per page','10',NULL,'General',NULL,'1',NULL),(35,'Transport_Charge','Transport Charge','0','','General',NULL,'1','');

/*Table structure for table `shop_category` */

DROP TABLE IF EXISTS `shop_category`;

CREATE TABLE `shop_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_category_parent` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `shop_category` */

insert  into `shop_category`(`id`,`name`,`alias`,`description`,`image`,`status`,`parent_id`) values (1,'Vỏ xe nâng','Vo-xe-nang','','','1',0),(2,'Vỏ xe điện','Vo-xe-dien','','','1',0),(3,'Vỏ xe nâng đăc ruột','Vo-xe-nang-dac-ruot','','','1',1),(4,'Vỏ xe nâng có ruột','Vo-xe-nang-co-ruot','','','1',1),(5,'Mâm xe nâng','Mam-xe-nang','Mâm xe','','1',0);

/*Table structure for table `shop_news` */

DROP TABLE IF EXISTS `shop_news`;

CREATE TABLE `shop_news` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `info` text COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_date` int(11) DEFAULT NULL,
  `update_date` int(11) DEFAULT NULL,
  `type_news` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `shop_news` */

insert  into `shop_news`(`id`,`title`,`alias`,`info`,`content`,`image`,`status`,`create_date`,`update_date`,`type_news`) values (1,'Cam kết lợi ích khi mua online','Cam-ket-loi-ich-khi-mua-online','Mua - bán hàng qua mạng - hình thức thương mại mới xuất hiện ở Việt Nam nhưng nhanh chóng phát triển, lôi kéo được nhiều khách hàng tin dùng. Mua hàng qua mạng có nhiều điểm ưu việt so với cách mua- bán trực tiếp ','<h2>Niềm tin &amp; Dịch vụ chăm s&oacute;c kh&aacute;ch h&agrave;ng tuyệt vời</h2>\r\n<p>Ch&uacute;ng t&ocirc;i tin rằng:</p>\r\n<ul class=\"list\">\r\n<li>Mọi người lu&ocirc;n muốn hợp t&aacute;c với người m&agrave; họ tin tưởng.</li>\r\n<li>Mọi người lu&ocirc;n muốn hợp t&aacute;c với người c&oacute; hiểu biết, l&agrave;m việc hiệu quả v&agrave; lu&ocirc;n thực hiện những g&igrave; đ&atilde; hứa.</li>\r\n</ul>\r\n<p>Tại&nbsp;Cửa h&agrave;ng <strong>Vỏ m&acirc;m xe n&acirc;ng Ngọc Thanh</strong>, kh&aacute;ch h&agrave;ng v&agrave; niềm tin của kh&aacute;ch h&agrave;ng l&agrave; điều ch&uacute;ng t&ocirc;i lu&ocirc;n t&acirc;m niệm. shop cam kết b&aacute;n h&agrave;ng 100% ch&iacute;nh h&atilde;ng,đ&uacute;ng như th&ocirc;ng tin sản phẩm, v&agrave; sẽ&nbsp;ho&agrave;n trả gấp đ&ocirc;i&nbsp;cho bạn nếu sản phẩm kh&ocirc;ng phải ch&iacute;nh h&atilde;ng. Để mang lại sự h&agrave;i l&ograve;ng v&agrave; thoải m&aacute;i cho kh&aacute;ch h&agrave;ng, ch&uacute;ng t&ocirc;i c&oacute;&nbsp;ch&iacute;nh s&aacute;ch đổi trả h&agrave;ng trong 2 ng&agrave;y: kh&aacute;ch h&agrave;ng c&oacute; thể đổi trả bất kỳ sản phẩm n&agrave;o đ&atilde; mua ở shop trong v&ograve;ng 2 ng&agrave;y. Nếu bạn cần trợ gi&uacute;p để nhận dạng h&agrave;ng thật giả, xin li&ecirc;n hệ với ch&uacute;ng t&ocirc;i .</p>\r\n<h2>Thuận tiện</h2>\r\n<p><em>&ldquo;T&ocirc;i th&iacute;ch việc c&oacute; thể ngồi tại nh&agrave;, mặc bộ đồ ngủ của m&igrave;nh, bất chấp b&ecirc;n ngo&agrave;i trời đang nắng n&oacute;ng hay mưa gi&oacute;, t&ocirc;i c&oacute; thể mua sắm bất kỳ l&uacute;c n&agrave;o t&ocirc;i muốn. T&ocirc;i thấy thư gi&atilde;n khi mua sắm, nhưng t&ocirc;i gh&eacute;t sự hối hả của đ&aacute;m đ&ocirc;ng v&agrave; sự ồn &agrave;o&rdquo;</em>&nbsp;&ndash; Chị&nbsp;Nguyễn Thu Thủy&nbsp;&ndash; Doanh nh&acirc;n, chia sẻ.</p>\r\n<p>Sự thuật tiện l&agrave; 1 lợi &iacute;ch tuy&ecirc;t vời khi mua sắm trực tuyến tạiCửa h&agrave;ng Vỏ m&acirc;m xe n&acirc;ng Ngọc Thanh. Mua sắm trực tuyến rất đơn giản: bạn chỉ cần ngồi trước m&aacute;y t&iacute;nh, v&agrave;i c&uacute; click chuột, lựa chọn sản phẩm bạn th&iacute;ch trong rất nhiều sản phẩm. Sau đ&oacute; sản phẩm sẽ được giao trực tiếp đến tận nh&agrave; bạn.</p>\r\n<p>Nếu bạn cần mua qu&agrave; cho một người bạn tại tỉnh th&agrave;nh kh&aacute;c, bạn kh&ocirc;ng cần lo lắng, ch&uacute;ng t&ocirc;i sẽ g&oacute;i qu&agrave; v&agrave; vận chuyển sản phẩm đến người bạn của bạn nhanh ch&oacute;ng .</p>\r\n<h2>Sự lựa chọn đa dạng</h2>\r\n<p>Tại&nbsp;Cửa h&agrave;ng <strong>Vỏ m&acirc;m xe n&acirc;ng Ngọc Thanh</strong>, ch&uacute;ng t&ocirc;i tập trung v&agrave;o những sản phẩm độc nhất:</p>\r\n<ul class=\"list\">\r\n<li><strong>ĐỘC NHẤT</strong>: 80% những sản phẩm tại&nbsp;Cửa h&agrave;ng <strong>Vỏ m&acirc;m xe n&acirc;ng Ngọc Thanh</strong> bạn kh&ocirc;ng thể t&igrave;m thấy nơi n&agrave;o kh&aacute;c ở Việt Nam.</li>\r\n<li><strong>GI&Aacute; HỢP L&Yacute;</strong>: . Nếu bạn t&igrave;m thấy trung t&acirc;m thương mại n&agrave;o b&aacute;n gi&aacute; thấp hơn&nbsp;Cửa h&agrave;ng <strong>Vỏ m&acirc;m xe n&acirc;ng Ngọc Thanh</strong>, ch&uacute;ng t&ocirc;i sẽ chấp nhận b&aacute;n cho bạn thấp hơn 5% so với gi&aacute; ở shop kh&aacute;c.</li>\r\n</ul>\r\n<p>Hơn nữa,&nbsp;Cửa h&agrave;ng <strong>Vỏ m&acirc;m xe n&acirc;ng Ngọc Thanh</strong> c&ograve;n c&oacute; thể nhận đặt h&agrave;ng v&agrave; chuyển h&agrave;ng đến tỉnh th&agrave;nh kh&aacute;c.</p>','2013_10_11_17_54_59-vomamxenang-Loi-ich-khi-mua-online-1.jpg,2013_10_11_17_54_59-vomamxenang-Loi-ich-khi-mua-online-2.jpg','1',1371979450,1381489245,'1'),(2,'Giao nhận hàng hoá xuất nhập khẩu','Giao-nhan-hang-hoa-xuat-nhap-khau','DACO Logistics được phép của hải quan thay mặt chủ hàng đứng tên trên tờ khai, thực hiện thủ tục khai báo hải quan, nộp thuế, giao nhận và vận chuyển hàng hóa xuất nhập khẩu giúp khách hàng đơn giản hóa trong các thủ tục chứng từ phức tạp khi khai báo hải quan và giao nhận hàng hóa xuất nhập khẩu.','<p><strong>Dịch vụ của ch&uacute;ng t&ocirc;i bao gồm:</strong></p>\r\n<p>&bull;&nbsp;&nbsp;&nbsp; Lập tờ khai v&agrave; ho&agrave;n th&agrave;nh thủ tục khai b&aacute;o hải quan.<br />&bull;&nbsp;&nbsp;&nbsp; Ho&agrave;n th&agrave;nh c&aacute;c thủ tục tại cảng v&agrave; giao h&agrave;ng/nhận h&agrave;ng.<br />&bull;&nbsp;&nbsp;&nbsp; Giải quyết c&aacute;c vấn đề ph&aacute;t sinh. (Nếu c&oacute;)<br />&bull;&nbsp;&nbsp;&nbsp; Đ&oacute;ng h&agrave;ng/r&uacute;t h&agrave;ng tại cảng.<br />&bull;&nbsp;&nbsp;&nbsp; Giao nhận h&agrave;ng h&oacute;a xuất nhập khẩu từ cảng hoặc s&acirc;n bay đến kh&aacute;ch h&agrave;ng v&agrave; ngược lại.<br />&bull;&nbsp;&nbsp;&nbsp; Giao nhận h&agrave;ng h&oacute;a qua trung t&acirc;m ph&acirc;n phối.</p>\r\n<p><span>&ldquo;Kinh nghiệm nhiều năm trong c&ocirc;ng t&aacute;c khai b&aacute;o hải quan gi&uacute;p ch&uacute;ng t&ocirc;i giải quyết nhiều vấn đề ph&aacute;t sinh trong khai b&aacute;o bằng c&aacute;ch thay mặt chủ h&agrave;ng k&yacute; t&ecirc;n v&agrave; đ&oacute;ng dấu tr&ecirc;n tờ khai hải quan, thể hiện được tr&aacute;ch nhiệm của người khai b&aacute;o hải quan&rdquo;.</span><br /><strong>Mr. B&ugrave;i Đo&agrave;n Ngọc Tuấn, Customs Broker Department.</strong></p>\r\n<p><span><strong>Để được tư vấn về dịch vụ, vui l&ograve;ng li&ecirc;n hệ:</strong></span></p>\r\n<p><strong>Mr. <strong>B&ugrave;i Đo&agrave;n Ngọc Tuấn</strong>&nbsp;(Gilla)</strong></p>\r\n<p>Phone: 09.777.5.7.9.11</p>\r\n<p>Email: <a href=\"mailto:tuan.buidoanngoc@gmail.com\">tuan.buidoanngoc@gmail.com</a></p>\r\n<p>Yahoo: <a href=\"mailto:ngoctuan3010842003@yahoo.com\">ngoctuan3010842003@yahoo.com</a></p>\r\n<p>Skype: dev_tuan</p>','','1',1381312731,1381312854,'1');

/*Table structure for table `shop_orders` */

DROP TABLE IF EXISTS `shop_orders`;

CREATE TABLE `shop_orders` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `bill_to` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `ship_to` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `cart` text COLLATE utf8_unicode_ci NOT NULL,
  `info` text COLLATE utf8_unicode_ci,
  `status` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_status` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `shop_orders` */

insert  into `shop_orders`(`id`,`bill_to`,`ship_to`,`cart`,`info`,`status`,`order_status`,`create_date`) values (1,'{\"username\":\"admin\",\"email\":\"ngoctuan3010842003@yahoo.com1\",\"full_name\":\"Bui Tran Ngoc Phu\",\"phone\":\"09040909099\",\"address\":\"27\\/21 Bui Tu Toan F.An Lac Q.Binh Tan\",\"description\":\"t\\u00e9t\"}','{\"full_name\":\"wwwwwwwwwwww\",\"phone\":\"444444444444\",\"address\":\"5555555555555\",\"other\":\"qqqqqqqqqqqqq\"}','[{\"category\":\"\",\"name\":\"V\\u1ecf xe n\\u00e2ng Aichi \\u0111\\u1eb7c ru\\u1ed9t 28x9-15\\/700\",\"alias\":\"Vo-xe-nang-Aichi-dac-ruot-28x9-15-700\",\"price\":\"2500000\",\"quantity\":2,\"value\":5000000,\"valueDiscount\":0,\"valueAfterDiscount\":5000000,\"totalValueAfterDiscount\":5000000,\"formatValueDiscount\":\"0\",\"formatValueAfterDiscount\":\"5,000,000\",\"formatTotalValueAfterDiscount\":\"5,000,000\",\"amountProductsInCart\":1}]','','2','2',1383359254);

/*Table structure for table `shop_products` */

DROP TABLE IF EXISTS `shop_products`;

CREATE TABLE `shop_products` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cate_id` int(11) unsigned NOT NULL,
  `cate_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `info` text COLLATE utf8_unicode_ci,
  `description` text COLLATE utf8_unicode_ci,
  `image` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` float DEFAULT NULL,
  `barcode` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  `is_sale_off` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `total_buy` int(11) DEFAULT '0',
  `is_popular` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `page` char(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_product_category` (`cate_id`),
  CONSTRAINT `FK_product_category` FOREIGN KEY (`cate_id`) REFERENCES `shop_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `shop_products` */

insert  into `shop_products`(`id`,`cate_id`,`cate_name`,`name`,`alias`,`info`,`description`,`image`,`price`,`barcode`,`quantity`,`is_sale_off`,`discount`,`total_buy`,`is_popular`,`page`,`status`,`create_date`) values (1,3,'Vỏ xe nâng đăc ruột','Vỏ xe nâng Bergougnan đặc ruột 600-9','Vo-xe-nang-Bergougnan-dac-ruot-600-9','Chúng tôi chuyên cung cấp mâm xe nâng và vỏ xe nâng Aichi, Bridgestone,Yokohama, ... đăc biệt cung cấp các loại vỏ xe nâng mới/cũ hiệu Bergougnan đặc ruột 600-9','<p><span>Ch&uacute;ng t&ocirc;i tự h&agrave;o l&agrave; nh&agrave; cung cấp sản phẩm&nbsp;<a title=\"Vỏ xe n&acirc;ng Bergougnan đặc ruột 600-9\" href=\"/shop/Vo-xe-nang-dac-ruot/Vo-xe-nang-Bergougnan-dac-ruot-600-9\">Vỏ xe n&acirc;ng Bergougnan đặc ruột 600-9</a>&nbsp;mới / cũ&nbsp; với gi&aacute; cả phải chăng nhưng đảm bảo chất lượng</span></p>\r\n<p><img title=\"Vỏ xe n&acirc;ng Bergougnan đặc ruột 600-9\" src=\"/uploads/resizeOnIndex/Products/2013_11_04_11_19_07-vomamxenang-Vo-xe-nang-Bergougnan_600-9_1.jpg\" alt=\"Vỏ xe n&acirc;ng Bergougnan đặc ruột 600-9\" width=\"189\" height=\"253\" />&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<img title=\"Vỏ xe n&acirc;ng Bergougnan đặc ruột 600-9 2\" src=\"/uploads/resizeOnIndex/Products/2013_11_04_11_19_07-vomamxenang-Vo-xe-nang-Bergougnan_600-9_2.jpg\" alt=\"Vỏ xe n&acirc;ng Bergougnan đặc ruột 600-9 2\" width=\"189\" height=\"253\" />&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<img title=\"Vỏ xe n&acirc;ng Bergougnan đặc ruột 600-9\" src=\"/uploads/resizeOnIndex/Products/2013_11_04_11_59_07-vomamxenang-Vo-xe-nang-Bergougnan_600-9-3.jpg\" alt=\"Vỏ xe n&acirc;ng Bergougnan đặc ruột 600-9\" width=\"224\" height=\"167\" /></p>\r\n<p><span data-mce-mark=\"1\">&nbsp;</span></p>\r\n<p><span>&nbsp;Đặt biệt ch&uacute;ng t&ocirc;i chuy&ecirc;n b&aacute;n&nbsp;<strong>vỏ xe n&acirc;ng mới/cũ</strong>&nbsp;c&aacute;c loại nhập khẩu hiệu (Aichi, Bridgestone,Yokohama,&nbsp;Pio, Komachi, Pro, Rhino, caosumina, Deestone, Heung ah, Solido, cho c&aacute;c h&atilde;ng xe TCM, TOYOTA, KOMATSU, NISSAN, MITSUBISHI, HYSTER...)</span></p>\r\n<p><span>Gi&aacute; cả phải chăng,lu&ocirc;n l&agrave;m h&agrave;i l&ograve;ng qu&yacute; kh&aacute;ch gần xa.</span></p>\r\n<p><span>Hotline: 0913.600.210</span></p>\r\n<p><span>Website:&nbsp;<a title=\"Vỏ m&acirc;m xe nang Ngọc Thanh\" href=\"/\"><strong>Vỏ m&acirc;m xe nang Ngọc Thanh</strong></a></span></p>\r\n<p><span>&nbsp;</span></p>','2013_11_04_11_19_07-vomamxenang-Vo-xe-nang-Bergougnan_600-9_1.jpg,2013_11_04_11_19_07-vomamxenang-Vo-xe-nang-Bergougnan_600-9_2.jpg,2013_11_04_11_59_07-vomamxenang-Vo-xe-nang-Bergougnan_600-9-3.JPG',NULL,'6009Bergo',0,'1',5,0,'1','1','1',1378633484),(2,3,'Vỏ xe nâng đăc ruột','Vỏ xe nâng TongYong đặc ruột 700-12','Vo-xe-nang-TongYong-dac-ruot-700-12','Chúng tôi chuyên cung cấp mâm xe nâng và vỏ xe nâng mới/cũ hiệu Bridgestone Japan đặc ruột 700-12 Aichi, Bridgestone,Yokohama','<p><span style=\"font-size: small; font-family: arial, helvetica, sans-serif;\">Ch&uacute;ng t&ocirc;i chuy&ecirc;n b&aacute;n c&aacute;c loại&nbsp;<a title=\"Vỏ xe n&acirc;ng TongYong đặc ruột 700-12\" href=\"/shop/Vo-xe-nang-dac-ruot/Vo-xe-nang-TongYong-dac-ruot-700-12\">Vỏ xe n&acirc;ng TongYong đặc ruột 700-12</a>&nbsp;với nhiều thương hiệu v&agrave; th&ocirc;ng số size phong ph&uacute;, đa dạng.</span></p>\r\n<p><span style=\"font-size: small; font-family: arial, helvetica, sans-serif;\" data-mce-mark=\"1\"><img title=\"Vỏ xe n&acirc;ng TongYong đặc ruột 700-12\" src=\"/uploads/resizeOnIndex/Products/2013_11_04_11_15_54-vomamxenang-Vo-xe-nang-Tong-Yong_700-12.jpg\" alt=\"Vỏ xe n&acirc;ng TongYong đặc ruột 700-12\" width=\"224\" height=\"168\" />&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span></p>\r\n<p><span style=\"font-size: small; font-family: arial, helvetica, sans-serif;\">&nbsp;</span><span style=\"font-size: small; font-family: arial, helvetica, sans-serif;\">&nbsp;Đặt biệt ch&uacute;ng t&ocirc;i chuy&ecirc;n b&aacute;n&nbsp;</span><strong style=\"font-family: arial, helvetica, sans-serif; font-size: small;\">vỏ xe n&acirc;ng TongYong đặc ruột 700-12&nbsp;mới/cũ</strong><span style=\"font-size: small; font-family: arial, helvetica, sans-serif;\">&nbsp;c&aacute;c loại nhập khẩu hiệu (Aichi, Bridgestone,Yokohama,&nbsp;Pio, Komachi, Pro, Rhino, caosumina, Deestone, Heung ah, Solido, cho c&aacute;c h&atilde;ng xe TCM, TOYOTA, KOMATSU, NISSAN, MITSUBISHI, HYSTER...)</span></p>\r\n<p><span style=\"font-size: small; font-family: arial, helvetica, sans-serif;\">Gi&aacute; cả phải chăng,lu&ocirc;n l&agrave;m h&agrave;i l&ograve;ng qu&yacute; kh&aacute;ch gần xa.</span></p>\r\n<p><span style=\"font-size: small; font-family: arial, helvetica, sans-serif;\">Hotline: 0913.600.210</span></p>\r\n<p><span style=\"font-size: small; font-family: arial, helvetica, sans-serif;\">Website:&nbsp;<a title=\"Vỏ m&acirc;m xe nang Ngọc Thanh\" href=\"/\"><strong>Vỏ m&acirc;m xe nang Ngọc Thanh</strong></a></span></p>','2013_11_04_11_15_54-vomamxenang-Vo-xe-nang-Tong-Yong_700-12.jpg',NULL,'70012ToYo',10,'0',0,0,'1','1','1',1378781469),(3,2,'Vỏ xe điện','Vỏ xe điện Komatsu 305x152','Vo-xe-dien-Komatsu-305x152','Chúng tôi chuyên cung cấp mâm xe nâng và vỏ xe nâng mới/cũ, vỏ xe điện Komatsu 305x152, Aichi, Bridgestone,Yokohama, ... đăc biệt cung cấp các loại vỏ xe nâng ','<p><span style=\"font-size: small; font-family: arial, helvetica, sans-serif;\">Ch&uacute;ng t&ocirc;i chuy&ecirc;n b&aacute;n c&aacute;c loại&nbsp;<a title=\"Vỏ xe điện Komatsu 305-152\" href=\"/shop/Vo-xe-dien/Vo-xe-dien-Komatsu-305x152\">Vỏ xe điện Komatsu 305x152</a>&nbsp;với nhiều thương hiệu v&agrave; th&ocirc;ng số size phong ph&uacute;, đa dạng.</span></p>\r\n<p><img title=\"Vỏ xe điện Komatsu 305x152 1\" src=\"/uploads/resizeOnIndex/Products/2013_11_04_11_26_30-vomamxenang-Vo-xe-dien-1.jpg\" alt=\"Vỏ xe điện Komatsu 305x152 1\" width=\"224\" height=\"253\" />&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<img title=\"Vỏ xe điện Komatsu 305x152 2\" src=\"/uploads/resizeOnIndex/Products/2013_11_04_11_26_30-vomamxenang-Vo-xe-dien-2.jpg\" alt=\"Vỏ xe điện Komatsu 305x152 2\" width=\"224\" height=\"253\" /></p>\r\n<p><span style=\"font-size: small; font-family: arial, helvetica, sans-serif;\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small; font-family: arial, helvetica, sans-serif;\">&nbsp;Đặt biệt ch&uacute;ng t&ocirc;i chuy&ecirc;n b&aacute;n&nbsp;<strong>vỏ xe n&acirc;ng mới/cũ</strong>&nbsp;c&aacute;c loại nhập khẩu hiệu (Aichi, Bridgestone,Yokohama,&nbsp;Pio, Komachi, Pro, Rhino, caosumina, Deestone, Heung ah, Solido, cho c&aacute;c h&atilde;ng xe TCM, TOYOTA, KOMATSU, NISSAN, MITSUBISHI, HYSTER...)</span></p>\r\n<p><span style=\"font-size: small; font-family: arial, helvetica, sans-serif;\">Gi&aacute; cả phải chăng,lu&ocirc;n l&agrave;m h&agrave;i l&ograve;ng qu&yacute; kh&aacute;ch gần xa.</span></p>\r\n<p><span style=\"font-size: small; font-family: arial, helvetica, sans-serif;\">Hotline: 0913.600.210</span></p>\r\n<p><span style=\"font-size: small; font-family: arial, helvetica, sans-serif;\">Website:&nbsp;<a title=\"Vỏ m&acirc;m xe nang Ngọc Thanh\" href=\"/\"><strong>Vỏ m&acirc;m xe nang Ngọc Thanh</strong></a></span></p>','2013_11_04_11_26_30-vomamxenang-Vo-xe-dien-1.jpg,2013_11_04_11_26_30-vomamxenang-Vo-xe-dien-2.jpg',NULL,'50010D-D',9,'0',0,1,'0','1','1',1378782670),(4,3,'Vỏ xe nâng đăc ruột','Vỏ xe nâng Aichi đặc ruột 700-12','Vo-xe-nang-Aichi-dac-ruot-700-12','Chúng tôi chuyên cung cấp mâm xe nâng và vỏ xe nâng mới/cũ hiệu Aichi đặc ruột 700-12, Aichi, Bridgestone,Yokohama, ... đăc biệt cung cấp các loại vỏ xe nâng ','<p><span style=\"font-size: small; font-family: arial, helvetica, sans-serif;\">Ch&uacute;ng t&ocirc;i chuy&ecirc;n b&aacute;n c&aacute;c loại&nbsp;<a title=\"Vỏ xe n&acirc;ng Aichi đặc ruột 700-12\" href=\"/shop/Vo-xe-nang-dac-ruot/Vo-xe-nang-Aichi-dac-ruot-700-12\"><strong>vỏ xe n&acirc;ng Aichi đặc ruột 700-12</strong></a>&nbsp;với nhiều thương hiệu v&agrave; th&ocirc;ng số size phong ph&uacute;, đa dạng.</span></p>\r\n<p><span style=\"font-size: small; font-family: arial, helvetica, sans-serif;\"><img title=\"Vỏ xe n&acirc;ng Aichi đặc ruột 700-12\" src=\"/uploads/resizeOnIndex/Products/2013_11_04_10_49_44-vomamxenang-Vo-xe-nang-Aichi_70012.jpg\" alt=\"Vỏ xe n&acirc;ng Aichi đặc ruột 700-12\" width=\"189\" height=\"253\" /></span></p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-size: small; font-family: arial, helvetica, sans-serif;\">&nbsp;Đặt biệt ch&uacute;ng t&ocirc;i chuy&ecirc;n b&aacute;n&nbsp;<strong>vỏ xe n&acirc;ng mới/cũ</strong>&nbsp;c&aacute;c loại nhập khẩu hiệu (Aichi, Bridgestone,Yokohama,&nbsp;Pio, Komachi, Pro, Rhino, caosumina, Deestone, Heung ah, Solido, cho c&aacute;c h&atilde;ng xe TCM, TOYOTA, KOMATSU, NISSAN, MITSUBISHI, HYSTER...)</span></p>\r\n<p><span style=\"font-size: small; font-family: arial, helvetica, sans-serif;\">Gi&aacute; cả phải chăng,lu&ocirc;n l&agrave;m h&agrave;i l&ograve;ng qu&yacute; kh&aacute;ch gần xa.</span></p>\r\n<p><span style=\"font-size: small; font-family: arial, helvetica, sans-serif;\">Hotline: 0913.600.210</span></p>\r\n<p><span style=\"font-size: small; font-family: arial, helvetica, sans-serif;\">Website:&nbsp;<a title=\"Vỏ m&acirc;m xe nang Ngọc Thanh\" href=\"/\"><strong>Vỏ m&acirc;m xe nang Ngọc Thanh</strong></a></span></p>','2013_11_04_10_49_44-vomamxenang-Vo-xe-nang-Aichi_70012.jpg',NULL,'',1,'0',0,0,'1','1','1',1381077992),(6,3,'Vỏ xe nâng đăc ruột','Vỏ xe nâng Aichi đặc ruột 28x9-15/700','Vo-xe-nang-Aichi-dac-ruot-28x9-15-700','Chúng tôi chuyên cung cấp mâm xe nâng và vỏ xe nâng mới/cũ hiệu Aichi đặc ruột 28x9-15/700 Aichi, Bridgestone,Yokohama','<p><span style=\"font-size: small; font-family: arial, helvetica, sans-serif;\">Ch&uacute;ng t&ocirc;i chuy&ecirc;n b&aacute;n c&aacute;c loại&nbsp;<a title=\"Vỏ xe nanang Aichi đặc ruột 28x9-15/700\" href=\"/shop/Vo-xe-nang-dac-ruot/Vo-xe-nang-Aichi-dac-ruot-28x9-15-700\"><strong>vỏ xe n&acirc;ng&nbsp;</strong><strong>Aichi đặc ruột 28x9-15/700</strong></a>&nbsp;với nhiều thương hiệu v&agrave; th&ocirc;ng số size phong ph&uacute;, đa dạng.</span></p>\r\n<p><span style=\"font-size: small; font-family: arial, helvetica, sans-serif;\"><img title=\"Vỏ xe n&acirc;ng Aichi đặc ruột 28x9-15/700\" src=\"/uploads/resizeOnIndex/Products/2013_11_01_00_05_22-vomamxenang-Vo-xe-nang-Aichi_28x9-15-700_2.jpg\" alt=\"Vỏ xe n&acirc;ng Aichi đặc ruột 28x9-15/700\" width=\"212\" height=\"253\" />&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<img title=\"Vỏ xe n&acirc;ng Aichi đặc ruột 28x9-15/700 2\" src=\"/uploads/resizeOnIndex/Products/2013_11_01_00_05_22-vomamxenang-Vo-xe-nang-Aichi_28x9-15-700_1.jpg\" alt=\"Vỏ xe n&acirc;ng Aichi đặc ruột 28x9-15/700 2\" width=\"224\" height=\"189\" /></span></p>\r\n<p><span style=\"font-size: small; font-family: arial, helvetica, sans-serif;\">&nbsp;</span></p>\r\n<p style=\"color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;\"><span style=\"font-family: arial, helvetica, sans-serif; font-size: small;\">&nbsp;Đặt biệt ch&uacute;ng t&ocirc;i chuy&ecirc;n b&aacute;n&nbsp;<strong>vỏ xe n&acirc;ng Aichi đặc ruột 28x9-15/700&nbsp;mới/cũ</strong>&nbsp;c&aacute;c loại nhập khẩu hiệu (Aichi, Bridgestone,Yokohama,&nbsp;Pio, Komachi, Pro, Rhino, caosumina, Deestone, Heung ah, Solido, cho c&aacute;c h&atilde;ng xe TCM, TOYOTA, KOMATSU, NISSAN, MITSUBISHI, HYSTER...)</span></p>\r\n<p style=\"color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;\"><span style=\"font-family: arial, helvetica, sans-serif; font-size: small;\">Gi&aacute; cả phải chăng,lu&ocirc;n l&agrave;m h&agrave;i l&ograve;ng qu&yacute; kh&aacute;ch gần xa.</span></p>\r\n<p style=\"color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;\"><span style=\"font-family: arial, helvetica, sans-serif; font-size: small;\">Hotline: 0913.600.210</span></p>\r\n<p style=\"color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;\"><span style=\"font-size: small; font-family: arial, helvetica, sans-serif;\">Website: <a title=\"Vỏ m&acirc;m xe nang Ngọc Thanh\" href=\"/\"><strong>Vỏ m&acirc;m xe nang Ngọc Thanh</strong></a><a title=\"Vỏ xe n&acirc;ng Aichi đặc ruột 28x9-15/700\" href=\"/\"><br /></a></span></p>','2013_11_01_00_05_22-vomamxenang-Vo-xe-nang-Aichi_28x9-15-700_2.jpg,2013_11_01_00_05_22-vomamxenang-Vo-xe-nang-Aichi_28x9-15-700_1.jpg',2500000,'',4,'0',0,6,'1','1','1',1381080369),(7,3,'Vỏ xe nâng đăc ruột','Vỏ xe nâng đặc ruột 500-8','Vo-xe-nang-dac-ruot-500-8','Chúng tôi chuyên cung cấp mâm xe nâng và vỏ xe nâng mới/cũ hiệu đặc ruột 500-8, Aichi, Bridgestone,Yokohama, ... đăc biệt cung cấp các loại vỏ xe nâng ','<p><span style=\"font-size: small;\">Ch&uacute;ng t&ocirc;i tự h&agrave;o l&agrave; nh&agrave; cung cấp sản phẩm <a title=\"Vỏ xe n&acirc;ng đặc ruột 500-8\" href=\"/shop/Vo-xe-nang-dac-ruot/Vo-xe-nang-dac-ruot-500-8\"><strong>vỏ xe n&acirc;ng</strong>&nbsp;<strong>đặc ruột 500-8</strong></a> mới / cũ&nbsp; với gi&aacute; cả phải chăng nhưng đảm bảo chất lượng</span></p>\r\n<p><img title=\"Vỏ xe n&acirc;ng đặc ruột 500-8\" src=\"/uploads/resizeOnIndex/Products/2013_11_04_10_53_04-vomamxenang-Vo-xe-nang-500-8.jpg\" alt=\"Vỏ xe n&acirc;ng đặc ruột 500-8\" width=\"224\" height=\"167\" /></p>\r\n<p><span style=\"font-size: small;\" data-mce-mark=\"1\">&nbsp;</span></p>\r\n<p><span style=\"font-size: small;\">&nbsp;Đặt biệt ch&uacute;ng t&ocirc;i chuy&ecirc;n b&aacute;n&nbsp;<strong>vỏ xe n&acirc;ng mới/cũ</strong>&nbsp;c&aacute;c loại nhập khẩu hiệu (Aichi, Bridgestone,Yokohama,&nbsp;Pio, Komachi, Pro, Rhino, caosumina, Deestone, Heung ah, Solido, cho c&aacute;c h&atilde;ng xe TCM, TOYOTA, KOMATSU, NISSAN, MITSUBISHI, HYSTER...)</span></p>\r\n<p><span style=\"font-size: small;\">Gi&aacute; cả phải chăng,lu&ocirc;n l&agrave;m h&agrave;i l&ograve;ng qu&yacute; kh&aacute;ch gần xa.</span></p>\r\n<p><span style=\"font-size: small;\">Hotline: 0913.600.210</span></p>\r\n<p><span style=\"font-size: small;\">Website:&nbsp;<a title=\"Vỏ m&acirc;m xe nang Ngọc Thanh\" href=\"/\"><strong>Vỏ m&acirc;m xe nang Ngọc Thanh</strong></a></span></p>\r\n<p><span style=\"font-size: small;\">&nbsp;</span></p>','2013_11_04_10_53_04-vomamxenang-Vo-xe-nang-500-8.jpg',NULL,'',1,'0',0,0,'1','1','1',1382160213),(8,3,'Vỏ xe nâng đăc ruột','Vỏ xe nâng Aichi-16x6-8-425-488','Vo-xe-nang-Aichi-16x6-8-425-488','Chúng tôi chuyên cung cấp mâm xe nâng và vỏ xe nâng mới/cũ hiệu Aichi-16x6-8-425-488 Aichi, Bridgestone,Yokohama','<p><span>Ch&uacute;ng t&ocirc;i chuy&ecirc;n b&aacute;n c&aacute;c loại&nbsp;<a title=\"Vỏ xe nanang Aichi đặc ruột 28x9-15/700\" href=\"/shop/Vo-xe-nang-dac-ruot/Vo-xe-nang-Aichi-dac-ruot-28x9-15-700\"><strong>vỏ xe n&acirc;ng&nbsp;Aichi-16x6-8-425-488</strong></a>&nbsp;với nhiều thương hiệu v&agrave; th&ocirc;ng số size phong ph&uacute;, đa dạng.</span></p>\r\n<p><span><img title=\"Vỏ xe n&acirc;ng Aichi-16x6-8-425-488\" src=\"/uploads/resizeOnIndex/Products/2013_11_04_17_42_41-vomamxenang-Vo-xe-nang-Aichi-16x6-8-425-488-2.jpg\" alt=\"Vỏ xe n&acirc;ng Aichi-16x6-8-425-488\" width=\"189\" height=\"253\" />&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<img title=\"Vỏ xe n&acirc;ng Aichi-16x6-8-425-488\" src=\"/uploads/resizeOnIndex/Products/2013_11_04_17_42_41-vomamxenang-Vo-xe-nang-Aichi-16x6-8-425-488.JPG\" alt=\"Vỏ xe n&acirc;ng Aichi-16x6-8-425-488\" width=\"224\" height=\"167\" /></span></p>\r\n<p><span>&nbsp;</span></p>\r\n<p><span>&nbsp;Đặt biệt ch&uacute;ng t&ocirc;i chuy&ecirc;n b&aacute;n&nbsp;<strong>vỏ xe n&acirc;ng Aichi đặc ruột 28x9-15/700&nbsp;mới/cũ</strong>&nbsp;c&aacute;c loại nhập khẩu hiệu (Aichi, Bridgestone,Yokohama,&nbsp;Pio, Komachi, Pro, Rhino, caosumina, Deestone, Heung ah, Solido, cho c&aacute;c h&atilde;ng xe TCM, TOYOTA, KOMATSU, NISSAN, MITSUBISHI, HYSTER...)</span></p>\r\n<p><span>Gi&aacute; cả phải chăng,lu&ocirc;n l&agrave;m h&agrave;i l&ograve;ng qu&yacute; kh&aacute;ch gần xa.</span></p>\r\n<p><span>Hotline: 0913.600.210</span></p>\r\n<p><span>Website:&nbsp;<a title=\"Vỏ m&acirc;m xe nang Ngọc Thanh\" href=\"/\"><strong>Vỏ m&acirc;m xe nang Ngọc Thanh</strong></a></span></p>','',NULL,'',1,'0',0,0,'1','1','1',1383557665);

/*Table structure for table `shop_review` */

DROP TABLE IF EXISTS `shop_review`;

CREATE TABLE `shop_review` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `status` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_date` int(11) DEFAULT NULL,
  `product_id` int(11) unsigned DEFAULT NULL,
  `rating` float DEFAULT NULL,
  `ip_address` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `page` char(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_review_product` (`product_id`),
  CONSTRAINT `FK_review_product` FOREIGN KEY (`product_id`) REFERENCES `shop_products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `shop_review` */

insert  into `shop_review`(`id`,`full_name`,`subject`,`description`,`status`,`create_date`,`product_id`,`rating`,`ip_address`,`page`) values (2,'Ngoc Phu','mua bán uy tín chất lượng','mua bán uy tín, chất lượng tốt, giá cả phải chăng','1',1384249443,7,10,'115.78.73.221','');

/*Table structure for table `site_banner` */

DROP TABLE IF EXISTS `site_banner`;

CREATE TABLE `site_banner` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `info` text COLLATE utf8_unicode_ci,
  `page_link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `page` char(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ordering` int(11) DEFAULT NULL,
  `create_date` int(11) DEFAULT NULL,
  `expired_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `site_banner` */

insert  into `site_banner`(`id`,`name`,`alias`,`info`,`page_link`,`image`,`position`,`page`,`status`,`ordering`,`create_date`,`expired_date`) values (1,'Banner Vỏ xe nâng đã cắt gai','Banner-Vo-xe-nang-da-cat-gai','','http://vomamxenang.com/','2013_11_04_15_23_18-vomamxenang-Banner_vo-xe-nang-3.jpg','1','1,2','1',NULL,1378789311,1410278400),(2,'Banner Vỏ xe nâng Aichi 28x9-15 - 700','Banner-Vo-xe-nang-Aichi-28x9-15---700','Vỏ xe nâng Aichi cũ, giá cả phải chăng,luôn làm hài lòng quý khách gần xa.Hotline: 0913.600.210','http://vomamxenang.com/shop/Vo-xe-nang-dac-ruot/Vo-xe-nang-Aichi-dac-ruot-28x9-15-700','2013_11_04_15_17_32-vomamxenang-Banner_vo-xe-nang-1.jpg','1','1,2','1',2,1378882209,1410364800),(3,'Banner Vỏ xe nâng Bergougnan 600-9','Banner-Vo-xe-nang-Bergougnan-600-9','Vỏ xe nâng cũ, giá cả phải chăng,luôn làm hài lòng quý khách gần xa.Hotline: 0913.600.210','http://vomamxenang.com/shop/Vo-xe-nang-dac-ruot/Vo-xe-nang-Bergougnan-dac-ruot-600-9','2013_11_04_15_22_37-vomamxenang-Banner_vo-xe-nang-2.jpg','1','1,3','1',3,1378885871,1410364800),(4,'Banner mâm xe nâng cũ 2 mảnh','Banner-mam-xe-nang-cu-2-manh','Mâm xe nâng cũ, giá cả phải chăng,luôn làm hài lòng quý khách gần xa.Hotline: 0913.600.210','http://vomamxenang.com/shop/Mam-xe-nang','2013_11_04_17_21_51-vomamxenang-Banner_mam-xe-nang-2-manh.jpg','1','1','1',4,1383556911,1415092911),(5,'Banner mâm xe nâng cũ 2 mảnh','Banner-mam-xe-nang-cu-2-manh','Mâm xe nâng cũ, giá cả phải chăng,luôn làm hài lòng quý khách gần xa.Hotline: 0913.600.210','http://vomamxenang.com/shop/Mam-xe-nang','2013_11_04_17_24_55-vomamxenang-Banner_mam-xe-nang-2-manh-2.jpg','1','1,3','1',5,1383557095,1415093095),(6,'Banner mâm xe thân cao','Banner-mam-xe-than-cao','Mâm xe nâng thân cao cũ, giá cả phải chăng,luôn làm hài lòng quý khách gần xa.Hotline: 0913.600.210','http://vomamxenang.com/shop/Mam-xe-nang','2013_11_04_17_29_49-vomamxenang-Banner_mam-xe-nang-than-cao.jpg','1','1,2','1',6,1383557389,1415093389);

/*Table structure for table `site_qa` */

DROP TABLE IF EXISTS `site_qa`;

CREATE TABLE `site_qa` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(11) unsigned NOT NULL DEFAULT '0',
  `user_id` int(11) unsigned DEFAULT NULL,
  `status` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `site_qa` */

/*Table structure for table `site_video` */

DROP TABLE IF EXISTS `site_video`;

CREATE TABLE `site_video` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cate_id` int(11) unsigned DEFAULT NULL,
  `link_youtube` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `page` tinyint(1) DEFAULT '0',
  `create_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_video_category` (`cate_id`),
  CONSTRAINT `FK_video_category` FOREIGN KEY (`cate_id`) REFERENCES `shop_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `site_video` */

insert  into `site_video`(`id`,`name`,`alias`,`cate_id`,`link_youtube`,`status`,`page`,`create_date`) values (1,'Style Vo mam xe nang','Style-Vo-mam-xe-nang',3,'http://www.youtube.com/watch?v=6q2FN8Fphew','1',1,1379065872);

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

insert  into `user`(`id`,`username`,`password`,`email`,`fullname`,`birthday`,`phone`,`address`,`country`,`description`,`avatar`,`website`,`created_date`,`last_login`,`is_online`,`validation_code`,`validation_type`,`validation_expired`,`status`,`type`) values (1,'gilla','827ccb0eea8a706c4c34a16891f84e7b','ngoctuan3010842003@yahoo.com','Bui Doan Ngoc Tuan','1984-10-30','0977757911','27/21 Bui Tu Toan','Viet Nam','Design Web, Yii Framework, Symfony, HTML, CSS, JQuery','2013_08_23_06_27_37_Tulips.jpg,2013_08_23_06_27_37_Penguins.jpg,2013_08_23_06_28_25_Koala.jpg','http://web3in1.com','2013-04-07','0000-00-00','2','',NULL,NULL,'1','0'),(2,'admin','827ccb0eea8a706c4c34a16891f84e7b','ngoctuan3010842003@yahoo.com1','Bui Tran Ngoc Phu','2010-03-19','09040909099','27/21 Bui Tu Toan F.An Lac Q.Binh Tan','VN','tét','',NULL,'2013-04-08','2013-11-22','1','',NULL,0,'1','1'),(3,'user','827ccb0eea8a706c4c34a16891f84e7b','ngoctuan3010842003@yahoo.com2','wwww','0000-00-00','3543412345','4334','VN','11111111',NULL,NULL,'2013-04-08','2013-04-08',NULL,NULL,NULL,0,'1','3'),(7,'abctest','e10adc3949ba59abbe56e057f20f883e','gangtergilla4@gmail.com','abc test','1988-07-15','09090909090','27.21 bui tu toan','VN','vvvvvvvvvv','2013_08_23_05_28_15_create-crud-by-model.png,2013_08_23_05_28_15_Chrysanthemum.jpg','http://web3in1.com','2013-08-23','0000-00-00','2','',NULL,NULL,'1','3');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
