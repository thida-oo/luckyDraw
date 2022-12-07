/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.5.5-10.4.24-MariaDB : Database - qr_code
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `draw_imei` */

DROP TABLE IF EXISTS `draw_imei`;

CREATE TABLE `draw_imei` (
  `id` int(50) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `imei_sn` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imei_sn_2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `draw_date` datetime DEFAULT NULL,
  `draw_by` int(11) DEFAULT NULL COMMENT 'draw_by_staff',
  `draw_store` int(11) DEFAULT NULL COMMENT 'store that made draw',
  `get_present_status` int(11) DEFAULT NULL,
  `present_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `remark` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `draw_imei` */

/*Table structure for table `event_settings` */

DROP TABLE IF EXISTS `event_settings`;

CREATE TABLE `event_settings` (
  `id` int(50) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `event_start_time` datetime DEFAULT NULL,
  `event_end_time` datetime DEFAULT NULL,
  `product_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `present_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remark` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `event_settings` */

/*Table structure for table `presents` */

DROP TABLE IF EXISTS `presents`;

CREATE TABLE `presents` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `present_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `present_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `present_no` int(11) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '0:NotActive, 1: Active',
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `remark` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `presents` */

insert  into `presents`(`id`,`present_code`,`present_name`,`present_no`,`image`,`created_at`,`created_by`,`updated_at`,`updated_by`,`remark`) values (1,'P-00001','Buds 2',1,'P-00001.png','2022-12-06 09:42:44',NULL,'2022-12-06 09:42:44',NULL,NULL),(2,'P-00002','Speaker',2,'P-00002.png','2022-12-06 09:44:17',NULL,'2022-12-06 09:44:17',NULL,NULL),(3,'P-00003','ရေဗူး',3,'P-00003.png','2022-12-06 09:44:38',NULL,'2022-12-06 09:44:38',NULL,NULL),(4,NULL,NULL,NULL,NULL,'2022-12-06 09:54:53',NULL,'2022-12-06 09:54:53',NULL,NULL),(5,'မြန်မာကုဒ်','မြန်မာလို စမ်းသပ်ခြင်း',5,'မြန်မာကုဒ်.png','2022-12-06 09:56:38',NULL,'2022-12-06 09:56:38',NULL,NULL),(6,'中文测试','中文测试',3,'中文测试.png','2022-12-07 04:40:43',NULL,'2022-12-07 04:40:43',NULL,'只是中文测试，数据库里看看'),(7,NULL,NULL,NULL,NULL,'2022-12-07 08:19:20',NULL,'2022-12-07 08:19:20',NULL,NULL),(8,NULL,NULL,NULL,NULL,'2022-12-07 08:20:10',NULL,'2022-12-07 08:20:10',NULL,NULL),(9,'dfdf','wewew',1,'dfdf.png','2022-12-07 08:28:19',NULL,'2022-12-07 08:28:19',NULL,NULL),(10,'xcxcx','xcxcx',3,'xcxcx.png','2022-12-07 08:30:11',NULL,'2022-12-07 08:30:11',NULL,NULL);

/*Table structure for table `products` */

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `p_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` int(11) DEFAULT NULL COMMENT '1:Mobile, 2:IOT',
  `created_time` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `products` */

insert  into `products`(`id`,`p_code`,`p_name`,`type`,`created_time`,`created_by`,`updated_time`,`updated_by`) values (1,'10001','A17k',1,NULL,NULL,NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
