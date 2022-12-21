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
) ENGINE=InnoDB AUTO_INCREMENT=2502 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `stock` */

insert  into `stock`(`id`,`imei_sn`,`imei_sn_2`,`store_code`,`distributor_code`,`region_id`,`warehouse_id`,`order_date`,`order_by`,`shipment_order_no`,`delivery_order_no`,`product_id`) values (2500,'865947069050231','865947069050223','0341004109','342005738',NULL,11,'2022-12-15 14:11:34',NULL,'SHP22121500000900018','DLV22121500000900018',1),(2501,'866375060142436','866375060142428\r\n','0341004109','342005738',NULL,11,'2022-12-15 14:11:34',NULL,'SHP22121500000900018','DLV22121500000900018',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
