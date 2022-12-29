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
/*Table structure for table `event_setting_details` */

DROP TABLE IF EXISTS `event_setting_details`;

CREATE TABLE `event_setting_details` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `event_id` int(50) DEFAULT NULL,
  `present_id` int(50) DEFAULT NULL,
  `present_prob` int(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `remark` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `event_setting_details` */

insert  into `event_setting_details`(`id`,`event_id`,`present_id`,`present_prob`,`created_at`,`created_by`,`updated_at`,`updated_by`,`remark`) values (1,19,1,30,'2022-12-29 04:00:45',2,'2022-12-29 04:00:45',NULL,NULL),(2,19,2,25,'2022-12-29 04:00:45',2,'2022-12-29 04:00:45',NULL,NULL),(3,19,3,20,'2022-12-29 04:00:45',2,'2022-12-29 04:00:45',NULL,NULL),(4,19,4,10,'2022-12-29 04:00:45',2,'2022-12-29 04:00:45',NULL,NULL),(5,19,7,5,'2022-12-29 04:00:45',2,'2022-12-29 04:00:45',NULL,NULL),(6,19,6,2,'2022-12-29 04:00:45',2,'2022-12-29 04:00:45',NULL,NULL);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT 0,
  `google_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`,`role`,`google_id`,`avatar`) values (1,'Thida','admin@demo.com',NULL,'$2y$10$7BUnldrrQGmZBgQwjve7JeOWz1ybWwsp0gcCam/fr.MhOBteAz18K','2jXf1hsvIsHZDibFoWC48YUVKlyvx5Rbr5E3PpPQyOOCjvR1K2ILC9ECk1Jv','2022-11-10 09:17:40','2022-11-10 09:17:40',0,NULL,NULL),(2,'Admin','admin@admin.com',NULL,'$2y$10$vkKKr7d/5aziNXV8rGkj5OzlqzMvgX3EDCTAdhO/T3D50b2MMh.UG','hapNBwJStelLHYt6NpAHttL2zXTgxnVpOlhgz5BCiYcomY3u95AuC3T5E2vR','2022-11-22 07:54:26','2022-11-22 07:54:26',1,NULL,NULL),(12,'Thida','hMgKbeVlpbPU75TnaiPTQSQiEiE',NULL,'$2y$10$Z56ATVamB.m3i1tGn7erjus/sBi29w2UfCT8wRh9X.kvGsrWOhede',NULL,'2022-12-28 10:16:46','2022-12-28 10:16:46',0,'2fiSXUsUUGQcH8STa42vd0AiEiE','https://static-legacy.dingtalk.com/media/lADPGSkSFq973ZfNAg3NAhw_540_525.jpg');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
