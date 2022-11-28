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
/*Table structure for table `distributors` */

DROP TABLE IF EXISTS `distributors`;

CREATE TABLE `distributors` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `distributor_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `distributor_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `superior_distributor` int(25) DEFAULT NULL,
  `type` int(25) DEFAULT NULL COMMENT '1:FirstLevelAgency, 2:SecondLevelAgency, 3:Distributor',
  `price_system` int(25) DEFAULT NULL COMMENT '1:PurchasePrice, 2:AgentPrice, 3:DistributorPrice, 4:DistributorPrice(NoTax)',
  `region` int(25) DEFAULT NULL,
  `customer_id` int(25) DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '0:InService, 1:Suspend Cooperation, 2:Close',
  `remark` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `col_1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `col_2` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `distributors` */

insert  into `distributors`(`id`,`distributor_code`,`distributor_name`,`superior_distributor`,`type`,`price_system`,`region`,`customer_id`,`status`,`remark`,`created_at`,`created_by`,`updated_at`,`updated_by`,`col_1`,`col_2`) values (1,'0342000011\r\n','BF Science & Technology Co.,Ltd.\r\n',0,0,NULL,NULL,NULL,0,NULL,'2020-10-15 11:34:20',NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `draw_event` */

DROP TABLE IF EXISTS `draw_event`;

CREATE TABLE `draw_event` (
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

/*Data for the table `draw_event` */

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

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2022_11_10_092333_create_todos_table',2),(6,'2022_11_22_074216_add-role-to-users-table',3);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `presents` */

DROP TABLE IF EXISTS `presents`;

CREATE TABLE `presents` (
  `id` int(50) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `present_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `present_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `present_no` int(11) DEFAULT NULL,
  `image` int(11) DEFAULT NULL COMMENT '0:NotActive, 1: Active',
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `remark` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `presents` */

/*Table structure for table `region` */

DROP TABLE IF EXISTS `region`;

CREATE TABLE `region` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `region_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `region_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` int(11) DEFAULT NULL COMMENT '0:Factory, 1:Company, 2:Partner, 3: ASM, 4:Leader, 5:Sale',
  `status` int(11) DEFAULT NULL COMMENT '0:InService, 1:NotService',
  `remark` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `superior` int(25) DEFAULT NULL COMMENT 'parent_id',
  `point` double DEFAULT NULL COMMENT 'area share point',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `region` */

/*Table structure for table `stock` */

DROP TABLE IF EXISTS `stock`;

CREATE TABLE `stock` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `imei_sn` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'encrypted',
  `imei_sn_2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `store_id` int(50) DEFAULT NULL,
  `distributor_id` int(50) DEFAULT NULL,
  `region_id` int(50) DEFAULT NULL COMMENT 'sale_area_no',
  `warehouse_id` int(50) DEFAULT NULL,
  `order_date` datetime DEFAULT NULL COMMENT 'order_time',
  `order_by` int(11) DEFAULT NULL COMMENT 'order_by_staff',
  `shipment_order_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '发货单号',
  `delivery_order_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '出库单号',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `stock` */

/*Table structure for table `store` */

DROP TABLE IF EXISTS `store`;

CREATE TABLE `store` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `store_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `store_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `distributor_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `price_system` int(11) DEFAULT NULL,
  `shop_level` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `store` */

/*Table structure for table `todos` */

DROP TABLE IF EXISTS `todos`;

CREATE TABLE `todos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `todos` */

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
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`,`role`) values (1,'Thida','admin@demo.com',NULL,'$2y$10$7BUnldrrQGmZBgQwjve7JeOWz1ybWwsp0gcCam/fr.MhOBteAz18K','2jXf1hsvIsHZDibFoWC48YUVKlyvx5Rbr5E3PpPQyOOCjvR1K2ILC9ECk1Jv','2022-11-10 09:17:40','2022-11-10 09:17:40',0),(2,'Admin','admin@admin.com',NULL,'$2y$10$vkKKr7d/5aziNXV8rGkj5OzlqzMvgX3EDCTAdhO/T3D50b2MMh.UG','C8eqd4Z53oRq2WS1czB6G7pVcIzrtArv9EHdjy8dUZGgFGj1yTfH6qCTfaqM','2022-11-22 07:54:26','2022-11-22 07:54:26',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
