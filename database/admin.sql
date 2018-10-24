-- MySQL dump 10.13  Distrib 5.7.23, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: larashop
-- ------------------------------------------------------
-- Server version	5.7.23-0ubuntu0.18.04.1

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
-- Dumping data for table `admin_menu`
--

LOCK TABLES `admin_menu` WRITE;
/*!40000 ALTER TABLE `admin_menu` DISABLE KEYS */;
INSERT INTO `admin_menu` VALUES (1,0,1,'首页','fa-bar-chart','/',NULL,NULL,'2018-10-18 11:29:16'),(2,0,7,'Admin','fa-tasks','',NULL,NULL,'2018-10-23 21:00:13'),(3,2,8,'管理员','fa-users','auth/users',NULL,NULL,'2018-10-23 21:00:13'),(4,2,9,'角色','fa-user','auth/roles',NULL,NULL,'2018-10-23 21:00:13'),(5,2,10,'权限','fa-ban','auth/permissions',NULL,NULL,'2018-10-23 21:00:13'),(6,2,11,'菜单','fa-bars','auth/menu',NULL,NULL,'2018-10-23 21:00:13'),(7,2,12,'操作日志','fa-history','auth/logs',NULL,NULL,'2018-10-23 21:00:13'),(8,0,2,'用户管理','fa-users','/users',NULL,'2018-10-18 12:41:06','2018-10-18 12:42:17'),(9,0,4,'商品管理','fa-cubes',NULL,NULL,'2018-10-18 13:26:46','2018-10-24 16:48:37'),(10,0,5,'订单管理','fa-rmb','/orders',NULL,'2018-10-22 10:37:40','2018-10-23 21:00:13'),(11,0,6,'优惠券管理','fa-tags','/coupon_codes',NULL,'2018-10-22 21:16:06','2018-10-23 21:00:13'),(12,0,3,'类目管理','fa-bars','/categories',NULL,'2018-10-23 21:00:02','2018-10-23 21:00:20'),(13,9,0,'众筹商品','fa-asl-interpreting','/crowdfunding_products',NULL,'2018-10-24 16:46:07','2018-10-24 16:46:07'),(14,9,0,'普通商品','fa-credit-card-alt','/products',NULL,'2018-10-24 16:48:25','2018-10-24 16:48:25');
/*!40000 ALTER TABLE `admin_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `admin_permissions`
--

LOCK TABLES `admin_permissions` WRITE;
/*!40000 ALTER TABLE `admin_permissions` DISABLE KEYS */;
INSERT INTO `admin_permissions` VALUES (1,'All permission','*','','*',NULL,NULL),(2,'Dashboard','dashboard','GET','/',NULL,NULL),(3,'Login','auth.login','','/auth/login\r\n/auth/logout',NULL,NULL),(4,'User setting','auth.setting','GET,PUT','/auth/setting',NULL,NULL),(5,'Auth management','auth.management','','/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs',NULL,NULL),(6,'用户管理','users','','/users*','2018-10-18 12:47:37','2018-10-18 12:47:37'),(7,'商品管理','products','','/products*','2018-10-23 14:03:05','2018-10-23 14:03:05'),(8,'订单管理','orders','','/orders*','2018-10-23 14:03:24','2018-10-23 14:03:24'),(9,'优惠券管理','coupon_codes','','/coupon_codes*','2018-10-23 14:03:57','2018-10-23 14:03:57');
/*!40000 ALTER TABLE `admin_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `admin_role_menu`
--

LOCK TABLES `admin_role_menu` WRITE;
/*!40000 ALTER TABLE `admin_role_menu` DISABLE KEYS */;
INSERT INTO `admin_role_menu` VALUES (1,2,NULL,NULL);
/*!40000 ALTER TABLE `admin_role_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `admin_role_permissions`
--

LOCK TABLES `admin_role_permissions` WRITE;
/*!40000 ALTER TABLE `admin_role_permissions` DISABLE KEYS */;
INSERT INTO `admin_role_permissions` VALUES (1,1,NULL,NULL),(2,2,NULL,NULL),(2,3,NULL,NULL),(2,4,NULL,NULL),(2,6,NULL,NULL),(2,9,NULL,NULL),(2,7,NULL,NULL),(2,8,NULL,NULL);
/*!40000 ALTER TABLE `admin_role_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `admin_role_users`
--

LOCK TABLES `admin_role_users` WRITE;
/*!40000 ALTER TABLE `admin_role_users` DISABLE KEYS */;
INSERT INTO `admin_role_users` VALUES (1,1,NULL,NULL),(2,2,NULL,NULL);
/*!40000 ALTER TABLE `admin_role_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `admin_roles`
--

LOCK TABLES `admin_roles` WRITE;
/*!40000 ALTER TABLE `admin_roles` DISABLE KEYS */;
INSERT INTO `admin_roles` VALUES (1,'Administrator','administrator','2018-10-18 11:19:21','2018-10-18 11:19:21'),(2,'运营','operator','2018-10-18 12:50:33','2018-10-18 12:50:33');
/*!40000 ALTER TABLE `admin_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `admin_user_permissions`
--

LOCK TABLES `admin_user_permissions` WRITE;
/*!40000 ALTER TABLE `admin_user_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin_user_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `admin_users`
--

LOCK TABLES `admin_users` WRITE;
/*!40000 ALTER TABLE `admin_users` DISABLE KEYS */;
INSERT INTO `admin_users` VALUES (1,'admin','$2y$10$oa7mWnDauxck4pYyXUkcf.OBYImZiLanF0Nn85HZsp/7YKfzLiWLq','Administrator',NULL,'4gQBBZXruJZ52OfBKOkEvMILBOttw3wbQ4Dfyc67w7LdEPbA1Dz3PbXf9Aji','2018-10-18 11:19:21','2018-10-18 12:55:28'),(2,'operator','$2y$10$jsOY4ARwSxoFrFhArMZ9Ye0Mqduop.ajr7AAyGLxfUst2hhWRqZlq','运营',NULL,'7LMnUc3HbhF5S6MQIxa60wDjuDlmPhxESnls08OpcE37sGFJqSA1J6S5wP57','2018-10-18 12:52:31','2018-10-18 12:52:31');
/*!40000 ALTER TABLE `admin_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-10-24  9:00:34
