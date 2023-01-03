-- MariaDB dump 10.17  Distrib 10.4.11-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: wappublishers
-- ------------------------------------------------------
-- Server version	10.4.11-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `attendances`
--

DROP TABLE IF EXISTS `attendances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attendances` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `in_time` varchar(100) DEFAULT NULL,
  `out_time` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attendances`
--

LOCK TABLES `attendances` WRITE;
/*!40000 ALTER TABLE `attendances` DISABLE KEYS */;
INSERT INTO `attendances` VALUES (1,57,'2022-08-18','10.10','12.10');
/*!40000 ALTER TABLE `attendances` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `center_id` int(11) DEFAULT 0,
  `staff_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `admin_status` varchar(50) DEFAULT NULL,
  `cust_status` varchar(50) DEFAULT NULL,
  `customer_name` varchar(50) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `date_of_birth` varchar(10) DEFAULT NULL,
  `name_of_college` varchar(100) DEFAULT NULL,
  `name_of_department` varchar(50) DEFAULT NULL,
  `name_of_instiute` varchar(100) DEFAULT NULL,
  `name_of_board_univercity` varchar(100) DEFAULT NULL,
  `percentage_of_marks` varchar(50) DEFAULT NULL,
  `year_of_passing` varchar(50) DEFAULT NULL,
  `remarks` varchar(50) DEFAULT NULL,
  `mobile_number` varchar(20) DEFAULT NULL,
  `comments` varchar(50) DEFAULT NULL,
  `name_of_degree` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (1,2,7,0,'assigned','assigned','Test','Male','Test','Test','Test','Test','Test','Test','Test','Test','Test',NULL,'Test','1@gmail.com',NULL,'2022-12-07 18:00:38'),(2,3,0,0,'assigned','unassigned','Test','Male','Test','Test','Test','Test','Test','Test','Test','Test','Test','test','Test','Test@gmail.com',NULL,'2022-12-07 18:04:12'),(3,2,6,0,'assigned','assigned','Test','Male','Test','Test','Test','Test','Test','Test','Test','Test','Test',NULL,'Test','Test@gmail.com',NULL,'2022-12-07 18:04:35'),(4,3,0,0,'assigned','unassigned','Test4','Male','Test','Test','Test','Test','Test','Test','Test','Test','Test','test','Test','Test@gmail.com',NULL,'2022-12-07 18:05:03'),(5,1,0,0,'unassigned','unassigned','Test 5','Female','Test','Test','Test','Test','Test','Test','Test','Test','Test',NULL,'Test','Test@gmail.com',NULL,'2022-12-07 18:05:37'),(6,1,0,0,'unassigned','unassigned','jino','Male','Test','jino','jino','jino','kandanvilai','Test','Test','Test','+919047736314',NULL,'jino','universejino@gmail.com',NULL,'2022-12-07 18:10:28'),(7,1,0,0,'unassigned','unassigned','jino','Male','Test','jino','jino','jino','kandanvilai','Test','Test','Test','+919047736314',NULL,'jino','universejino@gmail.com',NULL,'2022-12-07 18:12:11');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_permission`
--

DROP TABLE IF EXISTS `user_permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_permission` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `user_types_id` int(10) DEFAULT NULL,
  `roles` int(1) DEFAULT 0,
  `addrole` int(1) DEFAULT 0,
  `editrole` int(1) DEFAULT 0,
  `deleterole` int(1) DEFAULT 0,
  `dashboard` int(10) DEFAULT 1,
  `users` int(10) DEFAULT 0,
  `adduser` int(10) DEFAULT 0,
  `edituser` int(1) DEFAULT 0,
  `deleteuser` int(1) DEFAULT 0,
  `patients` int(1) DEFAULT 0,
  `addpatient` int(1) DEFAULT 0,
  `editpatient` int(1) DEFAULT 0,
  `deletepatient` int(1) DEFAULT 0,
  `blocks` int(1) DEFAULT 0,
  `addblock` int(1) DEFAULT 0,
  `editblock` int(1) DEFAULT 0,
  `deleteblock` int(1) DEFAULT 0,
  `rooms` int(1) DEFAULT 0,
  `addroom` int(1) DEFAULT 0,
  `editroom` int(1) DEFAULT 0,
  `deleteroom` int(1) DEFAULT 0,
  `admission` int(1) NOT NULL DEFAULT 0,
  `billing` int(1) NOT NULL DEFAULT 0,
  `pharmacy` int(1) NOT NULL DEFAULT 0,
  `investigation` int(1) NOT NULL DEFAULT 0,
  `ot` int(1) NOT NULL DEFAULT 0,
  `mrd` int(1) NOT NULL DEFAULT 0,
  `appointments` int(1) NOT NULL DEFAULT 0,
  `mis` int(1) NOT NULL DEFAULT 0,
  `Login_id` int(10) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_permission`
--

LOCK TABLES `user_permission` WRITE;
/*!40000 ALTER TABLE `user_permission` DISABLE KEYS */;
INSERT INTO `user_permission` VALUES (1,1,2,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(2,1,2,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(3,4,3,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(4,5,3,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(5,6,3,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(6,7,3,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
/*!40000 ALTER TABLE `user_permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_types`
--

DROP TABLE IF EXISTS `user_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_types` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_types_id` int(10) DEFAULT NULL,
  `user_types_name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_types`
--

LOCK TABLES `user_types` WRITE;
/*!40000 ALTER TABLE `user_types` DISABLE KEYS */;
INSERT INTO `user_types` VALUES (1,1,'Superadmin','2022-06-07 11:42:03','2022-06-07 11:42:08',1),(2,2,'Admin','2022-06-07 06:11:55','2022-06-07 06:11:55',1),(3,3,'Staf','2022-06-07 06:12:39','2022-06-07 06:12:39',1);
/*!40000 ALTER TABLE `user_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_types_id` int(11) DEFAULT NULL,
  `full_name` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile_number` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8_unicode_ci DEFAULT '1',
  `dob` varchar(33) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `check_password` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `states` varchar(10) COLLATE utf8_unicode_ci DEFAULT '1',
  `district_id` int(10) DEFAULT NULL,
  `taluk_id` int(10) DEFAULT NULL,
  `village_id` int(10) DEFAULT NULL,
  `address` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `login_id` int(10) DEFAULT NULL,
  `center_id` int(11) DEFAULT 0,
  `profile_photo` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,'WAP Publishers\r\n',NULL,NULL,'Male','1234567890','whiteangelpublishers@gmail.com','$2y$10$HW.RWivIXhSkpgAqVY4ov.wB4abs6Stzjg/GQKKLzxoBVEj2bZYi.','1',NULL,NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,1,NULL),(2,2,'Admin 1','Admin','1','Male','9047736314','admin@gmail.com','$2y$10$S/W7mW9V9Z7AKxGooi9vmuB6ufNqvmpDIypofe0yo/EwbunHReV9y','1',NULL,'2022-12-07 12:18:24',NULL,'123456','1',NULL,NULL,NULL,'Test',NULL,2,'man.png'),(3,2,'Admin 2','Admin','2','Female','9047736314','admin1@gmail.com','$2y$10$45cRjZAK..VpkNBNOCsmM.E7P2JC/cGRn3W0M3MbPnDhhTbrij.zO','1',NULL,'2022-12-07 12:19:08',NULL,'123456','1',NULL,NULL,NULL,'Test',NULL,3,'girl.png'),(4,3,'Staff 1','Staff','1','Male','9047736314','staff1@gmail.com','$2y$10$1pyNflY0T5b0gJ3Ynhdpb.LAWIIKvT8TPf9y73oGMbpw64Dg8SQUq','1',NULL,'2022-12-07 12:21:53',NULL,'123456','1',NULL,NULL,NULL,'Test',NULL,3,'man.png'),(5,3,'Staff 2','Staff','2','Male','9047736314','staff2@gmail.com','$2y$10$AMFHv4eTGjpkp0h5wdrjWOyqdZNARjQuKSyluOTeUYccfcrs/FkBW','1',NULL,'2022-12-07 12:22:42',NULL,'123456','1',NULL,NULL,NULL,'Test',NULL,3,'man.png'),(6,3,'Staff 3','Staff','3','Male','9047736314','staff3@gmail.com','$2y$10$a2/EIXJ2zgHmi2SUd0OrRu7aRLsyGCznWR4nlteWAbHDLmLR3L2YC','1',NULL,'2022-12-07 12:28:58',NULL,'123456','1',NULL,NULL,NULL,'Test',NULL,2,'man.png'),(7,3,'Staff 4','Staff','4','Male','9047736314','staff4@gmail.com','$2y$10$XbPWrLdjqx91ru7L1CYOH..tGUIekzE9EeJHig5ZdhZRoIxU8vbv6','1',NULL,'2022-12-07 12:29:45',NULL,'123456','1',NULL,NULL,NULL,'Test',NULL,2,'man.png');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-12-12 13:34:12
