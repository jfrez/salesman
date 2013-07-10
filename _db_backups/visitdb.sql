-- MySQL dump 10.13  Distrib 5.5.19, for Linux (x86_64)
--
-- Host: 68.178.139.16    Database: visitdb
-- ------------------------------------------------------
-- Server version	5.0.96-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clients` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(100) default NULL,
  `sap_code` varchar(20) default NULL,
  `market_niche_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  KEY `market_niche_id` (`market_niche_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (1,'Diego Portales','0001',1,'','2013-04-05 20:15:44'),(2,'Farmacia Ahumada','2264',1,'','2013-05-06 19:39:12');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clients_locations`
--

DROP TABLE IF EXISTS `clients_locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clients_locations` (
  `client_id` int(11) unsigned NOT NULL,
  `location_id` int(11) unsigned NOT NULL,
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP,
  KEY `client_id` (`client_id`,`location_id`),
  KEY `location_id` (`location_id`),
  CONSTRAINT `clients_locations_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `clients_locations_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients_locations`
--

LOCK TABLES `clients_locations` WRITE;
/*!40000 ALTER TABLE `clients_locations` DISABLE KEYS */;
INSERT INTO `clients_locations` VALUES (1,1,'2013-04-05 20:16:22'),(1,2,'2013-04-07 12:38:31'),(2,3,'2013-05-06 19:39:12');
/*!40000 ALTER TABLE `clients_locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commit`
--

DROP TABLE IF EXISTS `commit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commit` (
  `id` int(11) NOT NULL auto_increment,
  `client` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `idate` date NOT NULL,
  `fdate` date NOT NULL default '0000-00-00',
  `comment` text NOT NULL,
  `type` varchar(255) NOT NULL,
  `done` tinyint(1) NOT NULL default '0',
  `importance` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commit`
--

LOCK TABLES `commit` WRITE;
/*!40000 ALTER TABLE `commit` DISABLE KEYS */;
INSERT INTO `commit` VALUES (9,1,2,'2013-04-24','0000-00-00','','1',1,0),(8,1,2,'2013-04-24','2013-04-25','','1',1,0),(7,1,2,'2013-04-23','2013-05-03','demo','2',1,0),(6,1,2,'2013-04-23','2013-04-02','sd','1',1,0),(10,1,2,'2013-04-28','2013-04-30','demo','1',1,2),(11,1,2,'2013-04-28','2013-04-30','demo','1',1,2),(12,1,2,'2013-04-28','0000-00-00','sa','1',1,2),(13,1,2,'2013-04-28','2013-04-17','ddd','1',1,2),(14,1,2,'2013-04-28','2013-04-30','ss','1',1,2),(15,1,2,'2013-04-28','0000-00-00','ddd','1',1,1),(16,1,2,'2013-04-28','2013-04-25','muy importante','1',1,3),(17,1,2,'2013-04-28','0000-00-00','para nada importante','1',1,1),(18,1,2,'2013-04-28','0000-00-00','normal','1',1,2),(19,1,2,'2013-04-28','2013-05-02','ss','1',1,2),(20,1,2,'2013-04-28','2013-04-19','ss','1',1,3),(21,1,2,'2013-04-28','2013-04-30','demo','1',1,2),(22,1,2,'2013-04-28','2013-04-30','Demo','1',1,3),(23,1,2,'2013-04-28','2013-04-30','','1',1,2),(24,1,2,'2013-04-28','2013-04-18','demo3','1',1,1),(25,1,2,'2013-04-30','0000-00-00','ss','1',1,3),(26,1,2,'2013-04-30','2013-04-10','no importante','1',0,1),(27,1,2,'2013-04-30','2013-04-30','importante','1',1,2),(28,1,2,'2013-04-30','2013-05-03','muy importante','1',0,3);
/*!40000 ALTER TABLE `commit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events` (
  `Description` longtext,
  `Date` datetime default NULL,
  `ID` int(11) NOT NULL auto_increment,
  `owner` int(11) NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES ('','2013-04-23 23:00:00',1,1),('Demo','2013-04-24 00:51:00',2,2);
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `localization`
--

DROP TABLE IF EXISTS `localization`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `localization` (
  `user` int(11) NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `localization`
--

LOCK TABLES `localization` WRITE;
/*!40000 ALTER TABLE `localization` DISABLE KEYS */;
INSERT INTO `localization` VALUES (1,-33.46912,-70.641997,'2013-04-05 20:19:03'),(2,-33.561899,-70.7826217,'2013-04-06 12:58:47');
/*!40000 ALTER TABLE `localization` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `locations`
--

DROP TABLE IF EXISTS `locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `locations` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(100) default NULL,
  `address` varchar(300) default NULL,
  `lat` varchar(16) default NULL,
  `lon` varchar(16) default NULL,
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `contacto` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `desc` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locations`
--

LOCK TABLES `locations` WRITE;
/*!40000 ALTER TABLE `locations` DISABLE KEYS */;
INSERT INTO `locations` VALUES (1,'Ingeniería','0','-33.46912','-70.641997','2013-04-05 20:16:22','Jfrez','jonathan.frez@mail.udp.com','6768107','C. Academico'),(2,'Sede PH','0','-33.5619209','-70.782549899999','2013-04-07 12:38:31','Jonathan.frez','jonathan.frez@gmail.com','2235432','Director'),(3,'Centro','Vergara 432, Santiago Centro, Regin Metropolitana de Santiago de Chile, Chile','-33.4525451','-70.661570699999','2013-05-06 19:39:12','','','','');
/*!40000 ALTER TABLE `locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `market_niches`
--

DROP TABLE IF EXISTS `market_niches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `market_niches` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(100) default NULL,
  `status` enum('active','deleted') NOT NULL default 'active',
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `market_niches`
--

LOCK TABLES `market_niches` WRITE;
/*!40000 ALTER TABLE `market_niches` DISABLE KEYS */;
INSERT INTO `market_niches` VALUES (1,'Demostrativo','active','2013-04-05 20:15:06');
/*!40000 ALTER TABLE `market_niches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `opor`
--

DROP TABLE IF EXISTS `opor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `opor` (
  `id` int(11) NOT NULL auto_increment,
  `client` int(11) NOT NULL,
  `salesman` int(11) NOT NULL,
  `date` date NOT NULL,
  `comment` text NOT NULL,
  `amount` int(11) NOT NULL,
  `prob` int(11) NOT NULL,
  `state` varchar(255) NOT NULL,
  `famount` int(11) NOT NULL,
  `fechaf` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `opor`
--

LOCK TABLES `opor` WRITE;
/*!40000 ALTER TABLE `opor` DISABLE KEYS */;
INSERT INTO `opor` VALUES (1,1,2,'2013-04-04','s',7000,50,'ProcessClosed',0,'0000-00-00'),(2,2,2,'2013-05-15','',3500,50,'ProcessClosed',0,'0000-00-00'),(3,1,2,'2013-05-16','UUIIUUI',5000,90,'Sale',4000,'2013-05-25');
/*!40000 ALTER TABLE `opor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(128) NOT NULL auto_increment,
  `name` varchar(128) NOT NULL,
  `price` varchar(32) NOT NULL,
  `image` varchar(128) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'MacBook Pro','1199','http://www.tecnologia123.com/wp-content/uploads/2011/12/macbook_pro_late_2008.jpg'),(2,'MacBook Air','1499','http://www.fayerwayer.com/up/2008/01/macbook-air-2.jpg'),(3,'MacBook','999','http://www.fayerwayer.com/up/2008/01/macbook-air-2.jpg'),(4,'MacBook Pro','1199','http://www.tecnologia123.com/wp-content/uploads/2011/12/macbook_pro_late_2008.jpg'),(5,'MacBook Air','1499','http://www.fayerwayer.com/up/2008/01/macbook-air-2.jpg'),(6,'MacBook','999','http://www.fayerwayer.com/up/2008/01/macbook-air-2.jpg'),(7,'MacBook Pro','1199','http://www.tecnologia123.com/wp-content/uploads/2011/12/macbook_pro_late_2008.jpg'),(8,'MacBook Air','1499','http://www.fayerwayer.com/up/2008/01/macbook-air-2.jpg'),(9,'MacBook','999','http://www.fayerwayer.com/up/2008/01/macbook-air-2.jpg'),(10,'MacBook Pro','1199','http://www.tecnologia123.com/wp-content/uploads/2011/12/macbook_pro_late_2008.jpg'),(11,'MacBook Air','1499','http://www.fayerwayer.com/up/2008/01/macbook-air-2.jpg'),(12,'MacBook','999','http://www.fayerwayer.com/up/2008/01/macbook-air-2.jpg'),(13,'MacBook Pro','1199','http://www.tecnologia123.com/wp-content/uploads/2011/12/macbook_pro_late_2008.jpg'),(14,'MacBook Air','1499','http://www.fayerwayer.com/up/2008/01/macbook-air-2.jpg'),(15,'MacBook','999','http://www.fayerwayer.com/up/2008/01/macbook-air-2.jpg'),(16,'MacBook Pro','1199','http://www.tecnologia123.com/wp-content/uploads/2011/12/macbook_pro_late_2008.jpg'),(17,'MacBook Air','1499','http://www.fayerwayer.com/up/2008/01/macbook-air-2.jpg'),(18,'MacBook','999','http://www.fayerwayer.com/up/2008/01/macbook-air-2.jpg');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(300) default NULL,
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'System Manager','2012-04-20 19:42:45'),(2,'Sales Man','2012-04-20 19:43:03');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `scheduled_visits`
--

DROP TABLE IF EXISTS `scheduled_visits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `scheduled_visits` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `client_id` int(11) unsigned NOT NULL,
  `salesman_id` int(11) unsigned NOT NULL,
  `location_id` int(11) unsigned NOT NULL,
  `message` varchar(500) default NULL,
  `status` enum('pending','isok','checkin') NOT NULL default 'pending',
  `is_approved` enum('0','1') NOT NULL default '0',
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `date` date NOT NULL,
  `comment` text NOT NULL,
  `visittime` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `client_id` (`client_id`,`salesman_id`,`location_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `scheduled_visits`
--

LOCK TABLES `scheduled_visits` WRITE;
/*!40000 ALTER TABLE `scheduled_visits` DISABLE KEYS */;
INSERT INTO `scheduled_visits` VALUES (1,0,2,2,'','checkin','0','2013-04-24 03:44:28','1969-12-31','',21161),(2,0,3,2,'','checkin','0','2013-05-04 12:45:39','1969-12-31','',5),(3,0,3,2,'comentario, test','checkin','0','2013-05-04 12:50:35','1969-12-31','',301),(4,0,2,3,'','checkin','0','2013-05-06 19:39:30','1969-12-31','',12),(5,2,2,3,NULL,'pending','1','2013-05-07 16:57:15','2013-05-24','            asistir a cena anual',0);
/*!40000 ALTER TABLE `scheduled_visits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) default NULL,
  `password` varchar(100) default NULL,
  `salt` varchar(50) NOT NULL,
  `name` varchar(100) default NULL,
  `sur_name` varchar(100) default NULL,
  `Identification_no` varchar(20) default NULL,
  `birth_date` timestamp NULL default NULL,
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','admin@gmail.com','d41d8cd98f00b204e9800998ecf8427e','','admin','Tt','','2012-04-18 23:48:23','2012-04-18 23:48:23'),(2,'demo','demo','fe01ce2a7fbac8fafaed7c982a04e229','','demo demo','demo','','0000-00-00 00:00:00','2013-04-06 12:24:37'),(3,'jfrez','jonathan.frez@gmail.com','31eff3a79cdd0dbc8fc2138e675f8ad6','','Jonathan','Frez','','0000-00-00 00:00:00','2013-05-04 12:42:51');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_roles`
--

DROP TABLE IF EXISTS `users_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_roles` (
  `user_id` int(11) unsigned NOT NULL,
  `role_id` int(11) unsigned NOT NULL,
  KEY `user_id` (`user_id`,`role_id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `users_roles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `users_roles_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_roles`
--

LOCK TABLES `users_roles` WRITE;
/*!40000 ALTER TABLE `users_roles` DISABLE KEYS */;
INSERT INTO `users_roles` VALUES (1,1),(1,2),(2,1),(2,2),(3,1),(3,2);
/*!40000 ALTER TABLE `users_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visit`
--

DROP TABLE IF EXISTS `visit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `visit` (
  `id` int(11) NOT NULL auto_increment,
  `user` int(11) NOT NULL,
  `location` int(11) NOT NULL,
  `time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visit`
--

LOCK TABLES `visit` WRITE;
/*!40000 ALTER TABLE `visit` DISABLE KEYS */;
INSERT INTO `visit` VALUES (1,2,3,'2013-05-06 19:39:18'),(2,1,1,'2013-04-09 12:51:41'),(3,3,2,'2013-05-04 12:45:34');
/*!40000 ALTER TABLE `visit` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-07-10 12:12:39
