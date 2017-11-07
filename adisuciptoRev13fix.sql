/*
SQLyog Ultimate v11.33 (64 bit)
MySQL - 10.1.13-MariaDB : Database - adisucipto
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`adisucipto` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `adisucipto`;

/*Table structure for table `tb_act` */

DROP TABLE IF EXISTS `tb_act`;

CREATE TABLE `tb_act` (
  `id` int(10) NOT NULL,
  `act` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_act` */

insert  into `tb_act`(`id`,`act`) values (99,'service'),(100,'idle'),(101,'top'),(102,'los'),(201,'top-Active'),(202,'los-Active');

/*Table structure for table `tb_bridger` */

DROP TABLE IF EXISTS `tb_bridger`;

CREATE TABLE `tb_bridger` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `platbrid` varchar(20) NOT NULL,
  `qty` int(11) NOT NULL,
  `kode` varchar(20) NOT NULL,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `tb_bridger` */

insert  into `tb_bridger`(`id`,`platbrid`,`qty`,`kode`,`status`) values (1,'G 1882 AE',45000,'BRID.01',1),(2,'G 1883 AE',32000,'BRID.02',1),(3,'H 1584 AW',32000,'BRID.03',1),(4,'H 1955 GY',32000,'BRID.04',1),(5,'H 1520 AW\r\n',32000,'BRID.05',1),(6,'H 1751 DY',32000,'BRID.06',1),(7,'H 1062 AW',32000,'BRID.07',0),(8,'H 1847 GY',32000,'BRID.08',0),(9,'H 1193 AW',32000,'BRID.09',1),(10,'xxxxx',32000,'BRID.10',1),(11,'xxxxx',32000,'BRID.11',1),(12,'xxxxx',32000,'BRID.12',1),(13,'xxxxx',32000,'BRID.13',1),(14,'xxxxx',32000,'BRID.14',1),(15,'xxxxx',32000,'BRID.15',1),(16,'xxxxx',32000,'BRID.16',1);

/*Table structure for table `tb_log` */

DROP TABLE IF EXISTS `tb_log`;

CREATE TABLE `tb_log` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `logid` varchar(255) NOT NULL,
  `activity` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`logid`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tb_log` */

insert  into `tb_log`(`id`,`logid`,`activity`) values (1,'ADSL12345','setting planning toplos tgl 22 oktober 2017');

/*Table structure for table `tb_loss` */

DROP TABLE IF EXISTS `tb_loss`;

CREATE TABLE `tb_loss` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `time` datetime NOT NULL,
  `brid` int(20) NOT NULL,
  `qty_req` int(20) NOT NULL,
  `tank_tujuan` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tb_topp_fk0` (`brid`),
  KEY `tb_topp_fk1` (`tank_tujuan`),
  CONSTRAINT `tb_loss_ibfk_1` FOREIGN KEY (`tank_tujuan`) REFERENCES `tb_tank` (`id`),
  CONSTRAINT `tb_loss_ibfk_2` FOREIGN KEY (`brid`) REFERENCES `tb_bridger` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

/*Data for the table `tb_loss` */

insert  into `tb_loss`(`id`,`time`,`brid`,`qty_req`,`tank_tujuan`) values (1,'2017-10-23 09:01:19',8,3500,5),(2,'2017-10-24 09:01:52',9,6700,1),(3,'2017-10-24 09:06:06',3,400,6),(4,'2017-10-24 19:57:43',3,400,6),(5,'2017-10-24 20:09:16',3,400,6),(6,'2017-10-24 20:09:21',3,400,6),(8,'2017-10-24 20:17:27',2,3500,5),(9,'2017-10-24 20:17:40',1,400,4),(10,'2017-10-25 07:58:19',4,4500,1),(12,'2017-10-27 23:16:57',3,2333,5),(22,'2017-10-28 01:38:37',1,555,1),(23,'2017-10-28 01:39:39',4,10,1),(24,'2017-10-28 01:41:00',1,113,1),(25,'2017-10-30 08:28:23',1,2345,2);

/*Table structure for table `tb_plan` */

DROP TABLE IF EXISTS `tb_plan`;

CREATE TABLE `tb_plan` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `planid` varchar(255) NOT NULL,
  `tanktop` varchar(30) DEFAULT NULL,
  `qtytop` int(20) DEFAULT NULL,
  `tanklos` varchar(30) DEFAULT NULL,
  `qtylos` int(20) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tankmaint` varchar(255) DEFAULT NULL,
  `refmaint` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`planid`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

/*Data for the table `tb_plan` */

insert  into `tb_plan`(`id`,`planid`,`tanktop`,`qtytop`,`tanklos`,`qtylos`,`time`,`tankmaint`,`refmaint`) values (19,'PTMADS002230','1-2-3-4-5',2300,'5-6-7-8-1',5600,'2017-10-29 09:46:30','T3','ADS.09'),(27,'PTMADS052293','1-2-3',12400,'4-5-6',3400,'2017-10-29 20:04:50','T5,T6,,,,,,',',,,'),(3,'PTMADS120628','5-6-7',4567,'8-1-2',5678,'2017-10-23 19:47:37','4','ADS.01-ADS.09'),(14,'PTMADS138287','1-2-3',345,'4-5-6',222,'2017-10-28 02:46:02','T3','ADS.08'),(28,'PTMADS152433','1-2-3',2234,'4-5-6',233,'2017-10-29 20:06:13','T7,T8,,,,,,','ADS.08,ADS.09,ADS.10'),(18,'PTMADS216979','1-4',4500,'0',6700,'2017-10-29 09:43:47','T1','ADS.01'),(1,'PTMADS238801','1-2-3',3400,'4-5-6',4590,'2017-10-23 08:46:03','6','ADS.10-ADS.11'),(2,'PTMADS238802','1-2-3',2400,'5-6-7',4560,'2017-10-23 19:50:12','5','ADS.01-ADS.09'),(6,'PTMADS271340','1-2-3',3400,'4-5-6',3455,'2017-10-23 19:58:55','7','ADS.01-ADS.09'),(25,'PTMADS281902','1-2-3',333,'4-5-6',444,'2017-10-29 19:37:36','T1-T2-T3-----','Array'),(10,'PTMADS299563','1-2-3',34500,'4-5-6',56700,'2017-10-24 07:58:45','6,7,8','8,9,10,11'),(32,'PTMADS301022','1-2-3',23400,'0',1234,'2017-11-02 00:11:45','',''),(15,'PTMADS303899','1-2',230,'3',230,'2017-10-28 02:52:11','T2','ADS.08'),(26,'PTMADS307163','1-2-3',555,'4-5-6',666,'2017-10-29 19:48:11','T1,T2,T5,,,,,','ADS.02,ADS.03,ADS.04,ADS.09,,,,'),(4,'PTMADS343782','3-4-5',5000,'1-2-6',6000,'2017-10-23 19:49:49','2','ADS.01-ADS.09'),(30,'PTMADS361079','1',4500,'4-5-6',2300,'2017-10-29 20:15:08','T2,T3,T7,T8','ADS.09,ADS.10,ADS.15'),(23,'PTMADS455635','1-2-3',2345,'4-5-6',2434,'2017-10-29 19:26:10','Array','ADS.09'),(8,'PTMADS471873','3-4-7',3450,'8-1-2',4567,'2017-10-23 20:02:55','6','ADS.01-ADS.09'),(31,'PTMADS472452','1-2-3',500000,'4-5-7',4500,'2017-11-01 11:58:29','T6','ADS.07,ADS.08,ADS.09,ADS.10,ADS.11,ADS.12,ADS.13,ADS.14,ADS.15'),(24,'PTMADS574188','1-4-5',23455,'3-2',4566,'2017-10-29 19:34:24','Array','Array'),(5,'PTMADS624300','1-2',4500,'4-5',7800,'2017-10-23 19:54:18','1','ADS.01-ADS.09'),(12,'PTMADS721687','1-4-5',0,'7-8-2',0,'2017-10-28 02:31:07','0','0'),(7,'PTMADS743091','1-2-3',2345,'6-7-8',1234,'2017-10-23 20:00:20','7','ADS.01-ADS.09'),(17,'PTMADS772439','1-2',12000,'3-4',444,'2017-10-28 03:36:49','T2','ADS.02'),(21,'PTMADS780812','1-4-5',4566,'5-6-7',6777,'2017-10-29 19:24:19','','ADS.09'),(11,'PTMADS852996','1-4-5',3456,'7-8-2',5677,'2017-10-24 08:47:46','6,3','7,8'),(22,'PTMADS897528','1-4-5',123,'4-5-6',32321,'2017-10-29 19:25:12','Array','ADS.09'),(9,'PTMADS913814','1-2-3',5600,'4-5-6',6700,'2017-10-24 07:55:45','6,7','9,10'),(13,'PTMADS919525','1-4-5',0,'1-4-5',0,'2017-10-28 02:35:59','',''),(16,'PTMADS965651','1-2',12000,'3-4',5646,'2017-10-28 03:36:42','T5','ADS.01'),(29,'PTMADS968926','1-2-3',43000,'4-6',455,'2017-10-29 20:08:25','T5,T7,T8','ADS.09,ADS.10,ADS.12,ADS.13,ADS.14'),(20,'PTMADS991211','1-2-3',3455,'6-7-8',5677,'2017-10-29 19:20:53','T5','ADS.08');

/*Table structure for table `tb_ref` */

DROP TABLE IF EXISTS `tb_ref`;

CREATE TABLE `tb_ref` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `platref` varchar(20) NOT NULL,
  `qty` int(11) NOT NULL,
  `kode` varchar(20) NOT NULL,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `tb_ref` */

insert  into `tb_ref`(`id`,`platref`,`qty`,`kode`,`status`) values (1,'AB555CD',13000,'ADS.01',1),(2,'AB1214HN',16000,'ADS.02',1),(3,'nn',3490,'ADS.03',1),(4,'AB2222JN',16000,'ADS.04',1),(5,'AB2222JN',16000,'ADS.05',1),(6,'AB2222JN',16000,'ADS.06',1),(7,'AB2222JN',16000,'ADS.07',1),(8,'AB2222JN',13000,'ADS.08',1),(9,'AB2222JN',16000,'ADS.09',1),(10,'nn',45000,'ADS.10',1),(11,'AB2222JN',16000,'ADS.11',1),(12,'AB2222JN',16000,'ADS.12',1),(13,'AB2222JN',16000,'ADS.13',1),(14,'AB2222JN',16000,'ADS.14',1),(15,'AB2222JN',16000,'ADS.15',1),(16,'AB1234CD',24000,'TNIAU_TC01',1);

/*Table structure for table `tb_tank` */

DROP TABLE IF EXISTS `tb_tank`;

CREATE TABLE `tb_tank` (
  `id` int(10) NOT NULL,
  `tank` varchar(10) NOT NULL,
  `level` int(10) DEFAULT NULL,
  `pa` int(6) DEFAULT '0',
  `max_level` int(10) DEFAULT NULL,
  `max_pa` int(10) DEFAULT NULL,
  `status` int(10) NOT NULL,
  `sisipan` int(20) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `deadstok` int(10) DEFAULT NULL,
  `patarget` int(6) NOT NULL DEFAULT '0',
  `targetstat` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tb_tank_fk0` (`status`),
  CONSTRAINT `tb_tank_fk0` FOREIGN KEY (`status`) REFERENCES `tb_act` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_tank` */

insert  into `tb_tank`(`id`,`tank`,`level`,`pa`,`max_level`,`max_pa`,`status`,`sisipan`,`time`,`deadstok`,`patarget`,`targetstat`) values (1,'T1',42,28487,1000,58972,201,500,'2017-10-28 01:41:00',4000,100,0),(2,'T2',127,46811,2000,58900,101,500,'2017-10-30 08:28:23',2920,200,0),(3,'T3',200,58800,200,58750,101,500,'2017-07-30 06:31:48',3300,300,0),(4,'T4',108,10000,200,57100,100,500,'2017-10-28 02:24:33',3424,9,0),(5,'T5',26,80000,200,99800,100,500,'2017-10-27 23:16:57',3600,500,0),(6,'T6',200,0,200,99000,100,500,'2017-07-30 06:31:48',0,0,0),(7,'T7',176,81000,200,99150,100,500,'2017-10-27 23:14:23',1900,81,0),(8,'T8',189,97520,200,99070,100,500,'2017-10-13 17:51:53',2165,97,0);

/*Table structure for table `tb_topp` */

DROP TABLE IF EXISTS `tb_topp`;

CREATE TABLE `tb_topp` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `toppid` varchar(15) DEFAULT NULL,
  `time` datetime NOT NULL,
  `ref` int(20) NOT NULL,
  `qty_req` int(20) NOT NULL,
  `tank_asal` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tb_topp_fk0` (`ref`),
  KEY `tb_topp_fk1` (`tank_asal`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;

/*Data for the table `tb_topp` */

insert  into `tb_topp`(`id`,`toppid`,`time`,`ref`,`qty_req`,`tank_asal`) values (1,NULL,'2017-10-06 10:59:55',1,3000,2),(2,NULL,'2017-10-06 11:00:04',1,800,2),(3,NULL,'2017-10-06 11:00:12',1,1800,2),(4,NULL,'2017-10-06 11:00:16',1,900,2),(5,NULL,'2017-10-06 11:03:04',6,500,4),(6,NULL,'2017-10-06 11:06:37',4,450,4),(7,NULL,'2017-10-06 11:08:04',7,250,4),(8,NULL,'2017-10-06 11:12:08',8,777,4),(9,NULL,'2017-10-06 11:22:54',4,780,4),(10,NULL,'2017-10-06 11:29:53',2,1000,4),(11,NULL,'2017-10-07 07:01:37',5,300,4),(12,NULL,'2017-10-07 07:04:01',3,690,4),(13,NULL,'2017-10-07 07:26:27',6,900,4),(14,NULL,'2017-10-07 07:40:45',5,900,4),(15,NULL,'2017-10-07 08:31:27',5,800,4),(16,NULL,'2017-10-07 08:36:44',9,80,4),(17,NULL,'2017-10-07 08:56:51',6,800,4),(18,NULL,'2017-10-07 09:01:19',9,80,4),(19,NULL,'2017-10-07 09:05:14',5,899,4),(20,NULL,'2017-10-07 09:09:11',5,80,4),(21,NULL,'2017-10-07 09:11:51',7,900,4),(22,NULL,'2017-10-09 10:40:14',4,80,4),(23,NULL,'2017-10-09 10:41:58',2,100,4),(24,NULL,'2017-10-09 10:42:57',5,70,4),(25,NULL,'2017-10-13 13:03:06',5,280,4),(26,NULL,'2017-10-13 13:24:24',7,450,4),(27,NULL,'2017-10-13 14:11:37',6,10440,4),(28,NULL,'2017-10-13 14:20:22',4,580,8),(29,NULL,'2017-10-13 17:34:07',2,530,1),(30,NULL,'2017-10-13 17:51:53',5,4860,8),(31,NULL,'2017-10-13 19:47:06',3,7000,1),(32,NULL,'2017-10-14 00:10:05',3,5500,1),(33,NULL,'2017-10-14 07:22:04',9,12500,5),(34,NULL,'2017-10-14 08:04:02',7,13300,4),(35,NULL,'2017-10-14 08:04:59',6,15230,4),(36,NULL,'2017-10-14 08:05:56',9,2070,4),(37,NULL,'2017-10-14 08:10:16',6,10380,7),(38,NULL,'2017-10-14 08:44:20',9,9030,5),(39,NULL,'2017-10-14 11:24:24',7,9050,5),(40,NULL,'2017-10-14 11:25:17',3,5920,5),(41,NULL,'2017-10-14 11:26:21',6,6200,5),(42,NULL,'2017-10-14 12:09:21',3,12120,5),(43,NULL,'2017-10-14 12:18:52',6,5010,5),(44,NULL,'2017-10-14 13:02:52',7,13960,5),(45,NULL,'2017-10-14 13:04:49',9,3000,5),(46,NULL,'2017-10-14 13:17:51',9,12230,7),(47,NULL,'2017-10-15 07:46:50',6,1400,1),(48,NULL,'2017-10-17 07:47:51',9,6500,1),(49,NULL,'2017-10-17 10:36:29',3,1900,1),(50,NULL,'2017-10-24 10:37:29',7,5000,1),(51,NULL,'2017-10-22 10:50:38',9,2400,2),(52,NULL,'2017-10-23 15:15:07',1,100,2),(53,NULL,'2017-10-28 15:15:46',1,500,2),(54,NULL,'2017-10-29 15:18:50',4,230,2),(55,NULL,'2017-10-29 08:05:39',1,4566,1),(56,NULL,'2017-11-02 09:58:26',2,0,2);

/*Table structure for table `tb_type` */

DROP TABLE IF EXISTS `tb_type`;

CREATE TABLE `tb_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tb_type` */

insert  into `tb_type`(`id`,`type`) values (1,'superuser'),(2,'admin'),(3,'operator');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `foto` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`password`,`type`,`foto`) values (1,'admin','d033e22ae348aeb5660fc2140aec35850c4da997','admin','user.jpg'),(2,'operator','fe96dd39756ac41b74283a9292652d366d73931f','operator',''),(3,'user1','avsavsa','operator','logo.jpg'),(4,'user2','a1881c06eec96db9901c7bbfe41c42a3f08e9cb4','operator','logo.png'),(5,'user4','06e6eef6adf2e5f54ea6c43c376d6d36605f810e','operator','logo.png'),(6,'user3','0b7f849446d3383546d15a480966084442cd2193','operator','logo.png'),(7,'superuser','6e5604185b0d626d02a5575a12d32826cee45b98','superuser','user.jpg');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
