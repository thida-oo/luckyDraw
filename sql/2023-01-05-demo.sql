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
) ENGINE=InnoDB AUTO_INCREMENT=4729 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `draw_imeis` */

DROP TABLE IF EXISTS `draw_imeis`;

CREATE TABLE `draw_imeis` (
  `id` int(50) unsigned NOT NULL AUTO_INCREMENT,
  `imei_sn` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imei_sn_2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `draw_date` datetime DEFAULT NULL,
  `draw_by` int(11) DEFAULT NULL COMMENT 'draw_by_staff',
  `draw_store` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'store that made draw',
  `get_present_status` int(11) DEFAULT NULL,
  `present_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `remark` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_by` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

/*Table structure for table `event_settings` */

DROP TABLE IF EXISTS `event_settings`;

CREATE TABLE `event_settings` (
  `id` int(50) unsigned NOT NULL AUTO_INCREMENT,
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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `products` */

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `p_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` int(11) DEFAULT NULL COMMENT '1:Mobile, 2:IOT',
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=227 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

/*Table structure for table `stock` */

DROP TABLE IF EXISTS `stock`;

CREATE TABLE `stock` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `imei_sn` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'encrypted',
  `imei_sn_2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `store_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `distributor_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `region_id` int(50) DEFAULT NULL COMMENT 'sale_area_no',
  `warehouse_id` int(50) DEFAULT NULL,
  `order_date` datetime DEFAULT NULL COMMENT 'order_time',
  `order_by` int(11) DEFAULT NULL COMMENT 'order_by_staff',
  `shipment_order_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '发货单号',
  `delivery_order_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '出库单号',
  `product_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8196 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `store` */

DROP TABLE IF EXISTS `store`;

CREATE TABLE `store` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `store_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `store_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `distributor_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `price_system` int(11) DEFAULT NULL,
  `shop_level` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6087 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

/*Table structure for table `warehouses` */

DROP TABLE IF EXISTS `warehouses`;

CREATE TABLE `warehouses` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `type` int(25) DEFAULT NULL,
  `superior_distributor` int(11) DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `region_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `remark` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;



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
/*Data for the table `distributors` */

insert  into `distributors`(`id`,`distributor_code`,`distributor_name`,`superior_distributor`,`type`,`price_system`,`region`,`customer_id`,`status`,`remark`,`created_at`,`created_by`,`updated_at`,`updated_by`,`col_1`,`col_2`) values (1,'0342000011','BF Science & Technology Co.,Ltd.\r\n',0,1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,'0342013920','NPD Partner\r\n',1,2,2,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,'0342000015\r\n','YGN Partner\r\n',1,2,2,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,'0342003700\r\n','MON Partner\r\n',1,2,2,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,'0342000009\r\n','TNTY\r\n',1,2,2,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,'0342000008\r\n','TGI Partner\r\n',1,2,2,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(7,'0342000007\r\n','SG Partner\r\n',1,2,2,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(8,'0342000006\r\n','RK Partner\r\n',1,2,2,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(9,'0342000014\r\n','PT Partner\r\n',1,2,2,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(10,'0342000004\r\n','LS Partner\r\n',1,2,2,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(11,'0342000005\r\n','MG\r\n',1,2,2,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(12,'0342000003\r\n','MKN Partner\r\n',1,2,2,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(13,'0342000002\r\n','MDY Partner\r\n',1,2,2,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(14,'0342000012\r\n','BG Partner\r\n',1,2,2,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(15,'0342013508\r\n','LS TGOU 经销商\r\n',1,2,2,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(16,'0342013714\r\n','海关（总部）\r\n',1,2,2,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(17,'0342013316\r\n','售后+品牌+税务\r\n',1,2,2,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL);


/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`,`role`,`google_id`,`avatar`) values (1,'Thida','admin@demo.com',NULL,'$2y$10$7BUnldrrQGmZBgQwjve7JeOWz1ybWwsp0gcCam/fr.MhOBteAz18K','2jXf1hsvIsHZDibFoWC48YUVKlyvx5Rbr5E3PpPQyOOCjvR1K2ILC9ECk1Jv','2022-11-10 09:17:40','2022-11-10 09:17:40',0,NULL,NULL),(2,'Admin','admin@admin.com',NULL,'$2y$10$vkKKr7d/5aziNXV8rGkj5OzlqzMvgX3EDCTAdhO/T3D50b2MMh.UG','zcKEKEw1jZrJXYbzwHNZhIjaeXQMGEYpmr8pEjCoviqmfAsFR3Z7hdDOz9pv','2022-11-22 07:54:26','2022-11-22 07:54:26',1,NULL,NULL),(12,'Thida','hMgKbeVlpbPU75TnaiPTQSQiEiE',NULL,'$2y$10$Z56ATVamB.m3i1tGn7erjus/sBi29w2UfCT8wRh9X.kvGsrWOhede',NULL,'2022-12-28 10:16:46','2022-12-28 10:16:46',0,'2fiSXUsUUGQcH8STa42vd0AiEiE','https://static-legacy.dingtalk.com/media/lADPGSkSFq973ZfNAg3NAhw_540_525.jpg');

/*Data for the table `warehouses` */

insert  into `warehouses`(`id`,`name`,`level`,`status`,`type`,`superior_distributor`,`address`,`region_id`,`created_at`,`created_by`,`updated_at`,`updated_by`,`remark`) values (1,'HQ-MDY',1,1,1,NULL,'Mandalay',NULL,NULL,NULL,NULL,NULL,NULL),(2,'Warehouse LaoKai',2,1,1,NULL,'ရပ္​ကြက္​(၈)၊ ​ေမာ​ေရႊလီလမ္​း၊ ​ေရႊ​ေမတၱာKTV​ေ႐ွ႕၊ ​ေကာင္​စီရံုးအနီး။',NULL,NULL,NULL,NULL,NULL,NULL),(3,'Warehouse TGI(DQL)',2,1,1,NULL,'TGI',NULL,NULL,NULL,NULL,NULL,NULL),(4,'Warehouse_Ayeyarwady',2,1,1,NULL,'No.35C, Aung Yadanar Road , 3rd Floor , Pathein Tsp',NULL,NULL,NULL,NULL,NULL,NULL),(5,'Warehouse_Bago',2,1,1,NULL,'အမှတ် ၄/၅၉ , နန္ဒသူရိယလမ်းသွယ် , မဟာမြိုင်ရပ်ကွက် , ပဲခူးမြို့',NULL,NULL,NULL,NULL,NULL,NULL),(6,'Warehouse_Kayin',2,1,1,NULL,'Kayin',NULL,NULL,NULL,NULL,NULL,NULL),(7,'Warehouse_Lashio',2,1,1,NULL,'ရပ္​ကြက္​(၈)၊ ​ေမာ​ေရႊလီလမ္​း၊ ​ေရႊ​ေမတၱာKTV​ေ႐ွ႕၊ ​ေကာင္​စီရံုးအနီး။',NULL,NULL,NULL,NULL,NULL,NULL),(8,'Warehouse_Magway',2,1,1,NULL,'ကန္​သာ(၁၁)လမ္​း၊ ကန္​သာရပ္​၊ မ​ေကြးၿမိဳ႕။	',NULL,NULL,NULL,NULL,NULL,NULL),(9,'Warehouse_Mandalay',2,1,1,NULL,'၆၂ လမ္း၊ စိန္ပန္းလမ္းေထာင့္၊ FUJI Shopping center မ်က္ေစာင္ထိုး။',NULL,NULL,NULL,NULL,NULL,NULL),(10,'Warehouse_MLM',2,1,1,NULL,'အမွတ္ (၄)၊ သစ္ေတာရံုးလမ္း(ေအာက္လမ္းမၾကီး)စစ္ကဲကုန္းရပ္၊ ေမာ္လျမိဳင္ျမိဳ႔။',NULL,NULL,NULL,NULL,NULL,NULL),(11,'Warehouse_Myeik',2,1,1,NULL,'အမွတ္ (၁၄)၊ ထားဝယ္စုကမ္းနားလမ္း၊ Rainbow အိမ္သံုးပစၥည္းဆိုင္ေဘး၊ ၿမိတ္ၿမိဳ႕။',NULL,NULL,NULL,NULL,NULL,NULL),(12,'Warehouse_Myitkyinar',2,1,1,NULL,'No.48, Won Thno Kyaung Street, North Shan Su, Myitkyina',NULL,NULL,NULL,NULL,NULL,NULL),(13,'Warehouse_NPD',2,1,1,NULL,'နေပြည်တော်',NULL,NULL,NULL,NULL,NULL,NULL),(14,'Warehouse_Rakhine',2,1,1,NULL,'အမွတ္ (၁၉၄)၊ ​ေဂါက္​ရီလမ္​း၊ ​ေက်ာင္​းတက္​လမ္​းရပ္​ကြက္​၊ စစ္​​ေတြၿမိဳ႕။',NULL,NULL,NULL,NULL,NULL,NULL),(15,'Warehouse_Sagaing',2,1,1,NULL,'OPPO service center, Kyauk Kar Road,Myawady Qr, Monywa Tsp',NULL,NULL,NULL,NULL,NULL,NULL),(16,'Warehouse_Taunggyi',2,1,1,NULL,'အမွတ္​၈/၅၊ က​ေမာ႓ဇလမ္​းခြဲ၊ ​ေရ​ေအးကြင္​းရပ္​ကြက္​၊ တရုတ္​မဟာယန​ေက်ာင္​းအနီး၊ ​ေတာင္​ႀကီးၿမိဳ့	',NULL,NULL,NULL,NULL,NULL,NULL),(17,'Warehouse_Yangon',2,1,1,NULL,'A/21, Shwe Hnin Si 5(B) road , Mayangone township,Yangon',NULL,NULL,NULL,NULL,NULL,NULL),(18,'品牌仓-Branding Warehouse',2,1,2,NULL,'Yangon',NULL,NULL,NULL,NULL,NULL,NULL),(19,'售后仓-Service Warehouse',2,1,2,NULL,'Yangon',NULL,NULL,NULL,NULL,NULL,NULL),(20,'培训仓-Training Warehouse',2,1,2,NULL,'Yangon',NULL,NULL,NULL,NULL,NULL,NULL),(21,'海关-Custom Warehouse',2,1,2,NULL,'၆၂ လမ္း၊ စိန္ပန္းလမ္းေထာင့္၊ FUJI Shopping center မ်က္ေစာင္ထိုး။',NULL,NULL,NULL,NULL,NULL,NULL),(22,'销售仓-Sell Warehouse',2,1,2,NULL,'YGN',NULL,NULL,NULL,NULL,NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
