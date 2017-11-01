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
  KEY `tb_topp_fk1` (`tank_asal`),
  CONSTRAINT `refuler` FOREIGN KEY (`ref`) REFERENCES `tb_ref` (`id`),
  CONSTRAINT `tb_topp_ibfk_1` FOREIGN KEY (`tank_asal`) REFERENCES `tb_tank` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;


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
