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

/*Data for the table `warehouses` */

insert  into `warehouses`(`id`,`name`,`level`,`status`,`type`,`superior_distributor`,`address`,`region_id`,`created_at`,`created_by`,`updated_at`,`updated_by`,`remark`) values (1,'HQ-MDY',1,1,1,NULL,'Mandalay',NULL,NULL,NULL,NULL,NULL,NULL),(2,'Warehouse LaoKai',2,1,1,NULL,'ရပ္​ကြက္​(၈)၊ ​ေမာ​ေရႊလီလမ္​း၊ ​ေရႊ​ေမတၱာKTV​ေ႐ွ႕၊ ​ေကာင္​စီရံုးအနီး။',NULL,NULL,NULL,NULL,NULL,NULL),(3,'Warehouse TGI(DQL)',2,1,1,NULL,'TGI',NULL,NULL,NULL,NULL,NULL,NULL),(4,'Warehouse_Ayeyarwady',2,1,1,NULL,'No.35C, Aung Yadanar Road , 3rd Floor , Pathein Tsp',NULL,NULL,NULL,NULL,NULL,NULL),(5,'Warehouse_Bago',2,1,1,NULL,'အမှတ် ၄/၅၉ , နန္ဒသူရိယလမ်းသွယ် , မဟာမြိုင်ရပ်ကွက် , ပဲခူးမြို့',NULL,NULL,NULL,NULL,NULL,NULL),(6,'Warehouse_Kayin',2,1,1,NULL,'Kayin',NULL,NULL,NULL,NULL,NULL,NULL),(7,'Warehouse_Lashio',2,1,1,NULL,'ရပ္​ကြက္​(၈)၊ ​ေမာ​ေရႊလီလမ္​း၊ ​ေရႊ​ေမတၱာKTV​ေ႐ွ႕၊ ​ေကာင္​စီရံုးအနီး။',NULL,NULL,NULL,NULL,NULL,NULL),(8,'Warehouse_Magway',2,1,1,NULL,'ကန္​သာ(၁၁)လမ္​း၊ ကန္​သာရပ္​၊ မ​ေကြးၿမိဳ႕။	',NULL,NULL,NULL,NULL,NULL,NULL),(9,'Warehouse_Mandalay',2,1,1,NULL,'၆၂ လမ္း၊ စိန္ပန္းလမ္းေထာင့္၊ FUJI Shopping center မ်က္ေစာင္ထိုး။',NULL,NULL,NULL,NULL,NULL,NULL),(10,'Warehouse_MLM',2,1,1,NULL,'အမွတ္ (၄)၊ သစ္ေတာရံုးလမ္း(ေအာက္လမ္းမၾကီး)စစ္ကဲကုန္းရပ္၊ ေမာ္လျမိဳင္ျမိဳ႔။',NULL,NULL,NULL,NULL,NULL,NULL),(11,'Warehouse_Myeik',2,1,1,NULL,'အမွတ္ (၁၄)၊ ထားဝယ္စုကမ္းနားလမ္း၊ Rainbow အိမ္သံုးပစၥည္းဆိုင္ေဘး၊ ၿမိတ္ၿမိဳ႕။',NULL,NULL,NULL,NULL,NULL,NULL),(12,'Warehouse_Myitkyinar',2,1,1,NULL,'No.48, Won Thno Kyaung Street, North Shan Su, Myitkyina',NULL,NULL,NULL,NULL,NULL,NULL),(13,'Warehouse_NPD',2,1,1,NULL,'နေပြည်တော်',NULL,NULL,NULL,NULL,NULL,NULL),(14,'Warehouse_Rakhine',2,1,1,NULL,'အမွတ္ (၁၉၄)၊ ​ေဂါက္​ရီလမ္​း၊ ​ေက်ာင္​းတက္​လမ္​းရပ္​ကြက္​၊ စစ္​​ေတြၿမိဳ႕။',NULL,NULL,NULL,NULL,NULL,NULL),(15,'Warehouse_Sagaing',2,1,1,NULL,'OPPO service center, Kyauk Kar Road,Myawady Qr, Monywa Tsp',NULL,NULL,NULL,NULL,NULL,NULL),(16,'Warehouse_Taunggyi',2,1,1,NULL,'အမွတ္​၈/၅၊ က​ေမာ႓ဇလမ္​းခြဲ၊ ​ေရ​ေအးကြင္​းရပ္​ကြက္​၊ တရုတ္​မဟာယန​ေက်ာင္​းအနီး၊ ​ေတာင္​ႀကီးၿမိဳ့	',NULL,NULL,NULL,NULL,NULL,NULL),(17,'Warehouse_Yangon',2,1,1,NULL,'A/21, Shwe Hnin Si 5(B) road , Mayangone township,Yangon',NULL,NULL,NULL,NULL,NULL,NULL),(18,'品牌仓-Branding Warehouse',2,1,2,NULL,'Yangon',NULL,NULL,NULL,NULL,NULL,NULL),(19,'售后仓-Service Warehouse',2,1,2,NULL,'Yangon',NULL,NULL,NULL,NULL,NULL,NULL),(20,'培训仓-Training Warehouse',2,1,2,NULL,'Yangon',NULL,NULL,NULL,NULL,NULL,NULL),(21,'海关-Custom Warehouse',2,1,2,NULL,'၆၂ လမ္း၊ စိန္ပန္းလမ္းေထာင့္၊ FUJI Shopping center မ်က္ေစာင္ထိုး။',NULL,NULL,NULL,NULL,NULL,NULL),(22,'销售仓-Sell Warehouse',2,1,2,NULL,'YGN',NULL,NULL,NULL,NULL,NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
