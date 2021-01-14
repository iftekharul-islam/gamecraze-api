-- MySQL dump 10.13  Distrib 5.7.32, for Linux (x86_64)
--
-- Host: localhost    Database: gamehub
-- ------------------------------------------------------
-- Server version	5.7.32-0ubuntu0.18.04.1

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
-- Table structure for table `addresses`
--

DROP TABLE IF EXISTS `addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `addresses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `addresses`
--

LOCK TABLES `addresses` WRITE;
/*!40000 ALTER TABLE `addresses` DISABLE KEYS */;
INSERT INTO `addresses` VALUES (1,NULL,NULL,NULL,'2020-09-09 10:37:23','2020-09-09 10:37:23'),(2,NULL,NULL,NULL,'2020-09-09 11:35:11','2020-09-09 11:35:11'),(3,'Ansarcamp','Dhaka','1216','2020-09-09 11:49:39','2020-09-09 11:52:18'),(4,'Mirpur DOHS','Dhaka','1216','2020-09-09 11:55:04','2020-09-09 11:58:40'),(5,'11/18 block C','Mirpur','1216','2020-09-09 12:02:00','2020-09-09 12:02:58'),(6,'Ansarcamp','Dhaka','1216','2020-09-09 12:29:24','2020-09-09 12:31:26'),(7,'Ansarcamp','Dhaka','1216','2020-09-09 12:33:10','2020-09-09 12:34:17'),(8,'Ansarcamp','Dhaka','1216','2020-09-09 13:23:07','2020-09-09 13:24:12'),(9,'Ansarcamp','Dhaka','1216','2020-09-10 04:18:48','2020-09-10 04:21:36'),(10,NULL,NULL,NULL,'2020-09-10 06:49:50','2020-09-10 06:49:50'),(11,'Ansarcamp','Dhaka','1216','2020-09-10 10:00:07','2020-09-10 10:01:09'),(12,'Ansarcamp','Dhaka','1216','2020-09-10 10:09:06','2020-09-10 10:09:58'),(13,'Ansarcamp','Dhaka','1216','2020-09-12 12:11:19','2020-09-12 12:15:22'),(14,'Ansarcamp','Dhaka','1216','2020-09-13 04:52:03','2020-09-13 04:54:22'),(15,'Ansarcamp','Dhaka','1216','2020-09-13 05:03:07','2020-09-13 05:04:17'),(16,'Ansarcamp','Dhaka','1216','2020-09-13 05:09:39','2020-09-13 05:10:51'),(17,'Ansarcamp','Dhaka','1216','2020-09-13 11:14:46','2020-09-13 11:15:44'),(18,NULL,NULL,NULL,'2020-09-13 11:21:28','2020-09-13 11:21:28'),(19,'Ansarcamp','Dhaka','1216','2020-09-13 11:41:38','2020-09-13 11:43:07'),(20,'Ansarcamp','Dhaka','1216','2020-09-13 12:08:19','2020-09-13 12:09:12'),(21,'Ansarcamp','Dhaka','1216','2020-09-13 12:13:34','2020-09-13 12:14:39'),(22,NULL,NULL,NULL,'2020-09-14 05:18:22','2020-09-14 05:18:22'),(23,NULL,NULL,NULL,'2020-09-14 05:29:01','2020-09-14 05:29:01'),(24,'Ansarcamp','Dhaka','1216','2020-09-14 05:37:06','2020-09-14 05:38:56'),(25,'Ansarcamp','Dhaka','1216','2020-09-14 09:07:01','2020-09-14 09:07:54'),(26,'Ansarcamp, Mirpur','Dhaka','1216','2020-09-16 04:30:41','2020-09-16 04:32:17'),(27,'DOHS','Dhaka','1216','2020-10-12 06:38:07','2020-10-12 07:06:20'),(28,NULL,NULL,NULL,'2020-10-19 07:15:15','2020-10-19 07:15:15'),(29,'abcd','Dhaka','1216','2020-10-22 11:00:06','2020-10-22 11:07:14'),(30,NULL,NULL,NULL,'2020-12-19 06:03:18','2020-12-19 06:03:18'),(31,NULL,NULL,NULL,'2020-12-19 11:42:41','2020-12-19 11:42:41'),(32,NULL,NULL,NULL,'2020-12-19 12:37:31','2020-12-19 12:37:31'),(33,'test','test','12112','2020-12-20 04:54:13','2020-12-20 04:55:20'),(34,NULL,NULL,NULL,'2020-12-22 12:22:11','2020-12-22 12:22:11'),(35,NULL,NULL,NULL,'2020-12-22 13:07:54','2020-12-22 13:07:54'),(36,NULL,NULL,NULL,'2020-12-22 13:34:04','2020-12-22 13:34:04'),(37,NULL,NULL,NULL,'2020-12-23 09:06:53','2020-12-23 09:06:53'),(38,NULL,NULL,NULL,'2020-12-27 08:55:47','2020-12-27 08:55:47'),(39,NULL,NULL,NULL,'2020-12-27 08:58:46','2020-12-27 08:58:46'),(40,NULL,NULL,NULL,'2020-12-28 09:52:14','2020-12-28 09:52:14'),(41,NULL,NULL,NULL,'2020-12-30 10:49:46','2020-12-30 10:49:46'),(42,NULL,NULL,NULL,'2020-12-31 04:42:44','2020-12-31 04:42:44'),(43,NULL,NULL,NULL,'2021-01-03 11:20:11','2021-01-03 11:20:11'),(44,NULL,NULL,NULL,'2021-01-04 04:40:55','2021-01-04 04:40:55'),(45,NULL,NULL,NULL,'2021-01-04 09:23:00','2021-01-04 09:23:00'),(46,NULL,NULL,NULL,'2021-01-07 05:47:50','2021-01-07 05:47:50'),(47,NULL,NULL,NULL,'2021-01-07 08:40:15','2021-01-07 08:40:15'),(48,NULL,NULL,NULL,'2021-01-12 05:40:32','2021-01-12 05:40:32'),(49,NULL,NULL,NULL,'2021-01-12 06:58:03','2021-01-12 06:58:03'),(50,NULL,NULL,NULL,'2021-01-12 08:16:05','2021-01-12 08:16:05'),(51,NULL,NULL,NULL,'2021-01-12 08:23:02','2021-01-12 08:23:02'),(52,NULL,NULL,NULL,'2021-01-13 05:17:26','2021-01-13 05:17:26'),(53,NULL,NULL,NULL,'2021-01-13 08:52:14','2021-01-13 08:52:14'),(54,NULL,NULL,NULL,'2021-01-13 12:19:03','2021-01-13 12:19:03'),(55,NULL,NULL,NULL,'2021-01-13 13:44:42','2021-01-13 13:44:42'),(56,NULL,NULL,NULL,'2021-01-13 13:51:55','2021-01-13 13:51:55');
/*!40000 ALTER TABLE `addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `areas`
--

DROP TABLE IF EXISTS `areas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `areas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thana_id` bigint(20) unsigned NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `areas`
--

LOCK TABLES `areas` WRITE;
/*!40000 ALTER TABLE `areas` DISABLE KEYS */;
INSERT INTO `areas` VALUES (1,1,'DOHS',1,'dohs',1,'2020-09-09 12:08:33','2021-01-07 07:11:08');
/*!40000 ALTER TABLE `areas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` VALUES (2,'storage/article-image/thumbnail-1-1609043067imresizer.com (7).jpg','Test','<p>Test</p>','1',1,'2020-12-27 04:24:27','2020-12-27 04:24:27',0),(3,'storage/article-image/thumbnail-1-1609147087Screenshot_1.png','Top 10 Quick Flutter Tips Tricks and Techniques','<p>It&rsquo;s a horrible feeling when some of your content is getting cut by the iPhone X notch. The same could happen in Android. Consider using the<a href=\"https://api.flutter.dev/flutter/widgets/SafeArea-class.html\" target=\"_blank\">&nbsp;SafeArea widget</a>&nbsp;can keep the pesky notification bars and phone notches from encroaching on your app&rsquo;s UI. It uses a MediaQuery to check the dimensions of the screen and pads its child Widget to match, making sure your app is safe on both iOS and Android!It&rsquo;s a horrible feeling when some of your content is getting cut by the iPhone X notch. The same could happen in Android. Consider using the<a href=\"https://api.flutter.dev/flutter/widgets/SafeArea-class.html\" target=\"_blank\">&nbsp;SafeArea widget</a>&nbsp;can keep the pesky notification bars and phone notches from encroaching on your app&rsquo;s UI. It uses a MediaQuery to check the dimensions of the screen and pads its child Widget to match, making sure your app is safe on both iOS and Android!It&rsquo;s a horrible feeling when some of your content is getting cut by the iPhone X notch. The same could happen in Android. Consider using the<a href=\"https://api.flutter.dev/flutter/widgets/SafeArea-class.html\" target=\"_blank\">&nbsp;SafeArea widget</a>&nbsp;can keep the pesky notification bars and phone notches from encroaching on your app&rsquo;s UI. It uses a MediaQuery to check the dimensions of the screen and pads its child Widget to match, making sure your app is safe on both iOS and Android!It&rsquo;s a horrible feeling when some of your content is getting cut by the iPhone X notch. The same could happen in Android. Consider using the<a href=\"https://api.flutter.dev/flutter/widgets/SafeArea-class.html\" target=\"_blank\">&nbsp;SafeArea widget</a>&nbsp;can keep the pesky notification bars and phone notches from encroaching on your app&rsquo;s UI. It uses a MediaQuery to check the dimensions of the screen and pads its child Widget to match, making sure your app is safe on both iOS and Android!It&rsquo;s a horrible feeling when some of your content is getting cut by the iPhone X notch. The same could happen in Android. Consider using the<a href=\"https://api.flutter.dev/flutter/widgets/SafeArea-class.html\" target=\"_blank\">&nbsp;SafeArea widget</a>&nbsp;can keep the pesky notification bars and phone notches from encroaching on your app&rsquo;s UI. It uses a MediaQuery to check the dimensions of the screen and pads its child Widget to match, making sure your app is safe on both iOS and Android!It&rsquo;s a horrible feeling when some of your content is getting cut by the iPhone X notch. The same could happen in Android. Consider using the<a href=\"https://api.flutter.dev/flutter/widgets/SafeArea-class.html\" target=\"_blank\">&nbsp;SafeArea widget</a>&nbsp;can keep the pesky notification bars and phone notches from encroaching on your app&rsquo;s UI. It uses a MediaQuery to check the dimensions of the screen and pads its child Widget to match, making sure your app is safe on both iOS and Android!It&rsquo;s a horrible feeling when some of your content is getting cut by the iPhone X notch. The same could happen in Android. Consider using the<a href=\"https://api.flutter.dev/flutter/widgets/SafeArea-class.html\" target=\"_blank\">&nbsp;SafeArea widget</a>&nbsp;can keep the pesky notification bars and phone notches from encroaching on your app&rsquo;s UI. It uses a MediaQuery to check the dimensions of the screen and pads its child Widget to match, making sure your app is safe on both iOS and Android!It&rsquo;s a horrible feeling when some of your content is getting cut by the iPhone X notch. The same could happen in Android. Consider using the<a href=\"https://api.flutter.dev/flutter/widgets/SafeArea-class.html\" target=\"_blank\">&nbsp;SafeArea widget</a>&nbsp;can keep the pesky notification bars and phone notches from encroaching on your app&rsquo;s UI. It uses a MediaQuery to check the dimensions of the screen and pads its child Widget to match, making sure your app is safe on both iOS and Android!</p>','1',1,'2020-12-28 09:18:07','2021-01-07 05:59:48',1),(4,'storage/article-image/thumbnail-1-1610455907sddefault.jpg','Cyberpunk 2077 — from the creators of The Witcher','<p><em><strong>Cyberpunk 2077 is a 2020 action role-playing video game developed and published by CD Projekt. The story takes place in Night City, an open world set in the Cyberpunk universe. Players assume the first-person perspective of a customisable mercenary known as V, who can acquire skills in hacking and machinery with options for melee and ranged combat. The game was developed using the REDengine 4 by a team of around 500 people, exceeding the number that worked on the studio&#39;s previous game The Witcher 3: Wild Hunt (2015). CD Projekt launched a new division in Wrocław, Poland, and partnered with Digital Scapes, Nvidia, QLOC, and Jali Research to aid the production. Cyberpunk creator Mike Pondsmith was a consultant, and actor Keanu Reeves has a starring role. The original score was led by Marcin Przybyłowicz, featuring the contributions of several licensed artists. CD Projekt released Cyberpunk 2077 for PlayStation 4, Stadia, Windows, and Xbox One on 10 December 2020, with PlayStation 5 and Xbox Series X/S versions planned to follow in 2021. It received praise for its narrative, setting, and graphics, although some of its gameplay elements received mixed responses. In contrast, it was widely criticized for bugs, particularly in the console versions which also suffered from performance issues; Sony removed it from the PlayStation Store on 17 December 2020.</strong></em></p>','1',1,'2021-01-12 12:51:47','2021-01-12 13:00:27',1),(5,'storage/article-image/thumbnail-1-161045639146694366-4336-11ea-bfa0-35d85fc987f6.PNG','PlayerUnknown\'s Battlegrounds','<p>PlayerUnknown&#39;s Battlegrounds (PUBG) is an online multiplayer battle royale game developed and published by PUBG Corporation, a subsidiary of South Korean video game company Bluehole. The game is based on previous mods that were created by Brendan &quot;PlayerUnknown&quot; Greene for other games, inspired by the 2000 Japanese film Battle Royale, and expanded into a standalone game under Greene&#39;s creative direction. In the game, up to one hundred players parachute onto an island and scavenge for weapons and equipment to kill others while avoiding getting killed themselves. The available safe area of the game&#39;s map decreases in size over time, directing surviving players into tighter areas to force encounters. The last player or team standing wins the round. PUBG was first released for Microsoft Windows via Steam&#39;s early access beta program in March 2017, with a full release in December 2017. The game was also released by Microsoft Studios for the Xbox One via its Xbox Game Preview program that same month, and officially released in September 2018. PUBG Mobile, a free-to-play mobile game version for Android and iOS, was released in 2018, in addition to a port for the PlayStation 4. A version for the Stadia streaming platform was released in April 2020. PUBG is one of the best-selling, highest-grossing and most-played video games of all time. The game has sold over 70 million copies on personal computers and game consoles as of 2020, in addition to PUBG Mobile accumulating 734 million downloads and grossing over $4.3 billion on mobile devices as of December 2020. PUBG received positive reviews from critics, who found that while the game had some technical flaws, it presented new types of gameplay that could be easily approached by players of any skill level and was highly replayable. The game was attributed to popularizing the battle royale genre, with a number of unofficial Chinese clones also being produced following its success. The game also received several Game of the Year nominations, among other accolades. PUBG Corporation has run several small tournaments and introduced in-game tools to help with broadcasting the game to spectators, as they wish for it to become a popular esport. The game has also been banned in some countries for allegedly being harmful and addictive to younger players.</p>','1',1,'2021-01-12 12:59:51','2021-01-12 12:59:51',0);
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assets`
--

DROP TABLE IF EXISTS `assets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `game_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `assets_game_id_foreign` (`game_id`),
  CONSTRAINT `assets_game_id_foreign` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assets`
--

LOCK TABLES `assets` WRITE;
/*!40000 ALTER TABLE `assets` DISABLE KEYS */;
INSERT INTO `assets` VALUES (1,1,'game-1-capsule_616x353.jpg','storage/game-image/game-1-capsule_616x353.jpg','2020-09-09 11:49:00','2020-09-09 11:49:00'),(2,2,'game-1-nfs.jpg','storage/game-image/game-1-nfs.jpg','2020-09-09 11:52:29','2020-09-09 11:52:29'),(3,3,'game-1-assassins-creed-iv.jpg','storage/game-image/game-1-assassins-creed-iv.jpg','2020-09-09 11:52:39','2020-09-09 11:52:39'),(4,4,'game-1-cover.jpg','storage/game-image/game-1-cover.jpg','2020-09-09 11:53:37','2020-09-09 11:53:37'),(5,6,'game-1-capsule_616x353.jpg','storage/game-image/game-1-capsule_616x353.jpg','2020-12-22 11:07:14','2020-12-22 11:07:14'),(6,7,'game-1-437.com.jpg','storage/game-image/game-1-437.com.jpg','2020-12-24 04:38:18','2021-01-06 05:36:38'),(7,8,'game-1-H2x1_NSwitchDS_Fortnite_Chapter2Season5_image1600w.jpg','storage/game-image/game-1-H2x1_NSwitchDS_Fortnite_Chapter2Season5_image1600w.jpg','2020-12-24 06:11:35','2020-12-24 06:11:35'),(8,9,'game-1-PUBG.jfif','storage/game-image/game-1-PUBG.jfif','2020-12-24 06:48:21','2020-12-24 06:48:21'),(9,10,'game-1-1609922339resizedImage.png','storage/game-image/game-1-1609922339resizedImage.png','2021-01-06 08:38:59','2021-01-06 08:38:59'),(10,11,'game-1-1610452801Cyberpunk-2077-lore.png','storage/game-image/game-1-1610452801Cyberpunk-2077-lore.png','2021-01-12 12:00:01','2021-01-12 12:00:01'),(11,12,'game-1-1610534554246758ce3215fc74fab9591a5b05b3e1 (1).png','storage/game-image/game-1-1610534554246758ce3215fc74fab9591a5b05b3e1 (1).png','2021-01-13 10:42:34','2021-01-13 10:42:34'),(12,13,'game-1-1610542167fifa-theme-um10.png','storage/game-image/game-1-1610542167fifa-theme-um10.png','2021-01-13 12:49:27','2021-01-13 12:49:27'),(13,14,'game-1-1610598703crop (1).png','storage/game-image/game-1-1610598703crop (1).png','2021-01-14 04:31:43','2021-01-14 04:31:43');
/*!40000 ALTER TABLE `assets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `base_prices`
--

DROP TABLE IF EXISTS `base_prices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `base_prices` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `start` int(11) NOT NULL,
  `end` int(11) NOT NULL,
  `base` int(11) NOT NULL,
  `second_week` double NOT NULL,
  `third_week` double NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `base_prices`
--

LOCK TABLES `base_prices` WRITE;
/*!40000 ALTER TABLE `base_prices` DISABLE KEYS */;
INSERT INTO `base_prices` VALUES (1,1,1,1000,200,0.75,0.65,1,'2020-09-09 11:48:12','2020-09-09 11:48:12');
/*!40000 ALTER TABLE `base_prices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `checkpionts`
--

DROP TABLE IF EXISTS `checkpionts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `checkpionts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `author_id` bigint(20) unsigned NOT NULL,
  `flat_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `house_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `road_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `block_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `area_id` bigint(20) unsigned NOT NULL,
  `availability_start_time` time DEFAULT NULL,
  `availability_end_time` time DEFAULT NULL,
  `holiday` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `checkpionts`
--

LOCK TABLES `checkpionts` WRITE;
/*!40000 ALTER TABLE `checkpionts` DISABLE KEYS */;
INSERT INTO `checkpionts` VALUES (1,'Augnitive',13,1,'1','2','3','4',1,'10:00:00','22:00:00','Friday, Saturday',1,'Test',NULL,'2020-09-09 12:09:25','2021-01-07 07:12:16');
/*!40000 ALTER TABLE `checkpionts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `disk_conditions`
--

DROP TABLE IF EXISTS `disk_conditions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `disk_conditions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `disk_conditions`
--

LOCK TABLES `disk_conditions` WRITE;
/*!40000 ALTER TABLE `disk_conditions` DISABLE KEYS */;
INSERT INTO `disk_conditions` VALUES (1,1,'Super','Its look like new',1,NULL,'2020-09-09 11:59:24','2020-09-09 11:59:24'),(2,1,'medium','Its a regular quality',1,NULL,'2020-09-09 11:59:41','2020-09-09 11:59:41'),(3,1,'Poor','its low quality',1,NULL,'2020-09-09 11:59:55','2020-09-09 11:59:55');
/*!40000 ALTER TABLE `disk_conditions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `districts`
--

DROP TABLE IF EXISTS `districts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `districts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `author_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `division_id` bigint(20) unsigned NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `districts`
--

LOCK TABLES `districts` WRITE;
/*!40000 ALTER TABLE `districts` DISABLE KEYS */;
INSERT INTO `districts` VALUES (1,1,'Dhaka',1,'dhaka',1,'2020-09-09 12:07:26','2020-09-09 12:07:26');
/*!40000 ALTER TABLE `districts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `divisions`
--

DROP TABLE IF EXISTS `divisions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `divisions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `author_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `divisions`
--

LOCK TABLES `divisions` WRITE;
/*!40000 ALTER TABLE `divisions` DISABLE KEYS */;
INSERT INTO `divisions` VALUES (1,1,'Dhaka','dhaka',1,'2020-09-09 12:07:06','2020-09-09 12:07:06');
/*!40000 ALTER TABLE `divisions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exchangeable_games`
--

DROP TABLE IF EXISTS `exchangeable_games`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exchangeable_games` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `game_id` bigint(20) unsigned NOT NULL,
  `exchangeable_game_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `exchangeable_games_user_id_foreign` (`user_id`),
  KEY `exchangeable_games_game_id_foreign` (`game_id`),
  KEY `exchangeable_games_exchangeable_game_id_foreign` (`exchangeable_game_id`),
  CONSTRAINT `exchangeable_games_exchangeable_game_id_foreign` FOREIGN KEY (`exchangeable_game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE,
  CONSTRAINT `exchangeable_games_game_id_foreign` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE,
  CONSTRAINT `exchangeable_games_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exchangeable_games`
--

LOCK TABLES `exchangeable_games` WRITE;
/*!40000 ALTER TABLE `exchangeable_games` DISABLE KEYS */;
/*!40000 ALTER TABLE `exchangeable_games` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exchanges`
--

DROP TABLE IF EXISTS `exchanges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exchanges` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `borrower_id` bigint(20) unsigned DEFAULT NULL,
  `lender_id` bigint(20) unsigned NOT NULL,
  `game_id` bigint(20) unsigned NOT NULL,
  `no_of_days` int(11) NOT NULL,
  `condition` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `disk_health` decimal(8,2) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `exchanges_borrower_id_foreign` (`borrower_id`),
  KEY `exchanges_lender_id_foreign` (`lender_id`),
  KEY `exchanges_game_id_foreign` (`game_id`),
  CONSTRAINT `exchanges_borrower_id_foreign` FOREIGN KEY (`borrower_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `exchanges_game_id_foreign` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE,
  CONSTRAINT `exchanges_lender_id_foreign` FOREIGN KEY (`lender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exchanges`
--

LOCK TABLES `exchanges` WRITE;
/*!40000 ALTER TABLE `exchanges` DISABLE KEYS */;
/*!40000 ALTER TABLE `exchanges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `game_genre`
--

DROP TABLE IF EXISTS `game_genre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `game_genre` (
  `game_id` bigint(20) unsigned NOT NULL,
  `genre_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `game_genre_game_id_foreign` (`game_id`),
  KEY `game_genre_genre_id_foreign` (`genre_id`),
  CONSTRAINT `game_genre_game_id_foreign` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE,
  CONSTRAINT `game_genre_genre_id_foreign` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `game_genre`
--

LOCK TABLES `game_genre` WRITE;
/*!40000 ALTER TABLE `game_genre` DISABLE KEYS */;
INSERT INTO `game_genre` VALUES (1,1,NULL,NULL),(2,1,NULL,NULL),(2,2,NULL,NULL),(3,1,NULL,NULL),(3,2,NULL,NULL),(4,2,NULL,NULL),(2,3,NULL,NULL),(2,4,NULL,NULL),(5,1,NULL,NULL),(5,3,NULL,NULL),(5,4,NULL,NULL),(6,1,NULL,NULL),(7,1,NULL,NULL),(8,1,NULL,NULL),(9,1,NULL,NULL),(10,2,NULL,NULL),(10,3,NULL,NULL),(11,2,NULL,NULL),(12,2,NULL,NULL),(13,3,NULL,NULL),(14,1,NULL,NULL);
/*!40000 ALTER TABLE `game_genre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `game_platform`
--

DROP TABLE IF EXISTS `game_platform`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `game_platform` (
  `game_id` bigint(20) unsigned NOT NULL,
  `platform_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `game_platform_game_id_foreign` (`game_id`),
  KEY `game_platform_platform_id_foreign` (`platform_id`),
  CONSTRAINT `game_platform_game_id_foreign` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE,
  CONSTRAINT `game_platform_platform_id_foreign` FOREIGN KEY (`platform_id`) REFERENCES `platforms` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `game_platform`
--

LOCK TABLES `game_platform` WRITE;
/*!40000 ALTER TABLE `game_platform` DISABLE KEYS */;
INSERT INTO `game_platform` VALUES (1,3,NULL,NULL),(2,3,NULL,NULL),(2,5,NULL,NULL),(3,3,NULL,NULL),(3,4,NULL,NULL),(3,5,NULL,NULL),(4,3,NULL,NULL),(4,4,NULL,NULL),(2,4,NULL,NULL),(2,6,NULL,NULL),(5,3,NULL,NULL),(6,3,NULL,NULL),(6,5,NULL,NULL),(6,6,NULL,NULL),(1,4,NULL,NULL),(1,5,NULL,NULL),(1,6,NULL,NULL),(7,3,NULL,NULL),(7,5,NULL,NULL),(7,6,NULL,NULL),(8,3,NULL,NULL),(8,4,NULL,NULL),(8,5,NULL,NULL),(8,6,NULL,NULL),(9,3,NULL,NULL),(9,5,NULL,NULL),(10,3,NULL,NULL),(10,5,NULL,NULL),(10,6,NULL,NULL),(11,3,NULL,NULL),(11,5,NULL,NULL),(11,6,NULL,NULL),(12,3,NULL,NULL),(12,5,NULL,NULL),(12,6,NULL,NULL),(13,3,NULL,NULL),(13,5,NULL,NULL),(13,6,NULL,NULL),(14,3,NULL,NULL),(14,5,NULL,NULL);
/*!40000 ALTER TABLE `game_platform` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `game_reminders`
--

DROP TABLE IF EXISTS `game_reminders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `game_reminders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `game_id` bigint(20) unsigned NOT NULL,
  `is_sent` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `game_reminders`
--

LOCK TABLES `game_reminders` WRITE;
/*!40000 ALTER TABLE `game_reminders` DISABLE KEYS */;
INSERT INTO `game_reminders` VALUES (1,53,8,0,'2021-01-12 04:46:15','2021-01-12 04:46:15',NULL);
/*!40000 ALTER TABLE `game_reminders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `games`
--

DROP TABLE IF EXISTS `games`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `games` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author_id` int(11) NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` int(11) NOT NULL,
  `publisher` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `developer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `base_price_id` bigint(20) unsigned DEFAULT NULL,
  `is_trending` tinyint(1) NOT NULL,
  `released` date NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `trending_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `poster_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `games`
--

LOCK TABLES `games` WRITE;
/*!40000 ALTER TABLE `games` DISABLE KEYS */;
INSERT INTO `games` VALUES (1,'Pubg',1,'<p>Asasas</p>',89,'Testing','Divageo',1,1,'2021-08-04','2020-12-23 10:46:16','2020-09-09 11:49:00','2020-12-23 10:46:16',NULL,NULL,NULL),(2,'Need for Speed Heat Premium edition',1,'<p>Need for Speed Heat is a racing video game developed by Ghost Games and published by Electronic Arts for Microsoft Windows, PlayStation 4 and Xbox One. It is the twenty-fourth installment in the Need for Speed series and commemorates the series&#39; 25th anniversary. It was released on November 8, 2019.</p>',98,'Testing','EA',1,1,'2020-09-24','2020-12-23 10:46:14','2020-09-09 11:50:37','2020-12-23 10:46:14',NULL,NULL,NULL),(3,'Assassins creed IV- black flag',1,'<p>Assassin&#39;s Creed IV: Black Flag is an action-adventure video game developed by Ubisoft Montreal and published by Ubisoft. It is the sixth major installment in the Assassin&#39;s Creed series. Its historical timeframe precedes that of Assassin&#39;s Creed III, though its modern-day sequences succeed III&#39;s own.&nbsp;</p>',89,'Testing','EA',1,1,'2021-09-25','2020-12-23 08:56:12','2020-09-09 11:51:26','2020-12-23 08:56:12',NULL,NULL,NULL),(4,'Ghost of Tsushima',1,'<p>Ghost of Tsushima is an action-adventure game developed by Sucker Punch Productions and published by Sony Interactive Entertainment for PlayStation 4. Featuring an open world, it follows a samurai on a quest to protect Tsushima Island during the first Mongol invasion of Japan. The game was released on July 17, 2020.</p>',98,'Testing','EA',1,1,'2021-09-17','2020-12-23 08:56:20','2020-09-09 11:53:28','2020-12-23 08:56:20',NULL,NULL,NULL),(5,'Fifa 3000 usgud wudgausd sakgucsagv',1,'<p>dhd gjg</p>',2,'Testing','Namco Bandai',1,1,'2020-12-18','2020-12-23 08:56:16','2020-12-21 09:35:11','2020-12-23 08:56:16',NULL,NULL,NULL),(6,'Cyberpunk 2077',1,'<p>Cyberpunk 206 is an action role-playing video game developed and published by CD Project.&nbsp;It was released on December 10, 2020 for Microsoft Windows, PlayStation 4, PlayStation 5, Stadia, Xbox One and Xbox Series X / S.</p>',76,'Testing','Mateusz Popławski',1,1,'2020-12-10','2020-12-23 10:46:12','2020-12-22 11:07:14','2020-12-23 10:46:12',NULL,NULL,NULL),(7,'Cyberpunk 2077',1,'<p>Cyberpunk 2077 is a 2020 action role-playing video game developed and published by CD Projekt. The story takes place in Night City, an open world set in the Cyberpunk universe.</p>',75,'Mateusz Popławski','CD Projekt, CD Projekt RED',1,1,'2020-12-10','2021-01-12 11:25:26','2020-12-24 04:38:18','2021-01-12 11:25:26','storage/game-image/Cyberpunk 2077-trending-1-1609911398game-1-imresizer.com (3).jpg','storage/game-image/Cyberpunk 2077-cover-1-1609911398cover2.jpg','storage/game-image/Cyberpunk 2077-poster-1-1609911398cover1.jpg'),(8,'Fortnite',1,'<p>Fortnite is an online video game developed by Epic Games and released in 2017. It is available in three distinct game mode versions that otherwise share the same general gameplay and game engine</p>',79,'Epic Games, Warner Bros. Interactive Entertainment','Epic Games, People Can Fly',1,1,'2021-01-21','2021-01-13 09:32:14','2020-12-24 06:11:35','2021-01-13 09:32:14','storage/game-image/Fortnite-trending-1-1609923938oZzgDgvDYaNFGWZnrl9hRdG3.png','storage/game-image/Fortnite-cover-1-1608790295imresizer.com (5).jpg','storage/game-image/Fortnite-poster-1-1608790295imresizer.com (6).jpg'),(9,'PubG',1,'<p>PlayerUnknown&#39;s Battlegrounds is an online multiplayer battle royale game developed and published by PUBG Corporation, a subsidiary of South Korean video game company Bluehole.</p>',80,'Mateusz Popławski','CD Projekt, CD Projekt RED',1,1,'2020-12-17','2021-01-13 08:32:05','2020-12-24 06:48:21','2021-01-13 08:32:05','storage/game-image/PubG-trending-1-1608792501imresizer.com (7).jpg','storage/game-image/PubG-cover-1-1608792501imresizer.com (8).jpg','storage/game-image/PubG-poster-1-1608792501imresizer.com (9).jpg'),(10,'Microsoft Flight Simulator',1,'<p>Microsoft Flight Simulator is a flight simulator built by Esobo Studios and published by Xbox Game Studios.&nbsp;This is an entry in the Microsoft Flight Simulator series, first published in 1982, and previously published by Microsoft Flight Simulator X.</p>',95,'Aerosoft , Xbox Game Studios','Asobo Studio , Turn 10 Studios',1,1,'2020-05-16','2021-01-13 08:32:02','2021-01-06 08:38:59','2021-01-13 08:32:02','storage/game-image/Microsoft Flight Simulator-trending-1-1609922339a (1).png','storage/game-image/Microsoft Flight Simulator-cover-1-1609922339a (2).png','storage/game-image/Microsoft Flight Simulator-poster-1-1609922339a (3).png'),(11,'Cyberpunk 2077',1,'<pre>\r\nThe Battlefield series goes back to its roots in a never-before-seen portrayal of World War 2. Take on physical, all-out multiplayer with your squad in modes like the vast Grand Operations and the cooperative Combined Arms, or witness human drama set against global combat in the single player War Stories. As you fight in epic, unexpected locations across the globe, enjoy the richest and most immersive Battlefield yet. Now also includes Firestorm &ndash; Battle Royale, reimagined for Battlefield.</pre>\r\n\r\n<p>Game contains In-Game Purchases:</p>\r\n\r\n<ul>\r\n	<li>Firestorm &ndash; Battle Royale, reimagined for Battlefield. Dominate on the largest Battlefield map ever with epic weapons and combat vehicles as a deadly ring of fire closes in. Scavenge, fight, and survive to become the last squad standing.</li>\r\n	<li>World War 2 as You&rsquo;ve Never Seen It Before &ndash; Take the fight to unexpected but crucial moments of the war, as Battlefield goes back to where it all began.</li>\r\n</ul>\r\n\r\n<ul>\r\n	<li>Firestorm &ndash; Battle Royale, reimagined for Battlefield. Dominate on the largest Battlefield map ever with epic weapons and combat vehicles as a deadly ring of fire closes in. Scavenge, fight, and survive to become the last squad standing.</li>\r\n	<li>World War 2 as You&rsquo;ve Never Seen It Before &ndash; Take the fight to unexpected but crucial moments of the war, as Battlefield goes back to where it all began.</li>\r\n	<li>Firestorm &ndash; Battle Royale, reimagined for Battlefield. Dominate on the largest Battlefield map ever with epic weapons and combat vehicles as a deadly ring of fire closes in. Scavenge, fight, and survive to become the last squad standing.</li>\r\n	<li>World War 2 as You&rsquo;ve Never Seen It Before &ndash; Take the fight to unexpected but crucial moments of the war, as Battlefield goes back to where it all began.</li>\r\n</ul>',74,'REDengine 4','CD Projekt, CD Projekt RED',1,1,'2020-12-10',NULL,'2021-01-12 12:00:01','2021-01-13 10:55:02','storage/game-image/Cyberpunk 2077-trending-1-1610535302cyberpunk-2077-cover (1).jpg','storage/game-image/Cyberpunk 2077-cover-1-1610452801cyberpunk-2077-3.png','storage/game-image/Cyberpunk 2077-poster-1-1610452801Cyberpunk-2077-lore.png'),(12,'PlayerUnknown\'s Battlegrounds',1,'<p>PlayerUnknown&#39;s Battlegrounds (PUBG) is an online multiplayer battle royale game developed and published by PUBG Corporation, a subsidiary of South Korean video game company Bluehole. The game is based on previous mods that were created by Brendan &quot;PlayerUnknown&quot; Greene for other games, inspired by the 2000 Japanese film Battle Royale, and expanded into a standalone game under Greene&#39;s creative direction. In the game, up to one hundred players parachute onto an island and scavenge for weapons and equipment to kill others while avoiding getting killed themselves.</p>\r\n\r\n<p>The available safe area of the game&#39;s map decreases in size over time, directing surviving players into tighter areas to force encounters. The last player or team standing wins the round. PUBG was first released for Microsoft Windows via Steam&#39;s early access beta program in March 2017, with a full release in December 2017. The game was also released by Microsoft Studios for the Xbox One via its Xbox Game Preview program that same month, and officially released in September 2018. PUBG Mobile, a free-to-play mobile game version for Android and iOS, was released in 2018, in addition to a port for the PlayStation 4.</p>\r\n\r\n<p>A version for the Stadia streaming platform was released in April 2020. PUBG is one of the best-selling, highest-grossing and most-played video games of all time. The game has sold over 70 million copies on personal computers and game consoles as of 2020, in addition to PUBG Mobile accumulating 734 million downloads and grossing over $4.3 billion on mobile devices as of December 2020. PUBG received positive reviews from critics, who found that while the game had some technical flaws, it presented new types of gameplay that could be easily approached by players of any skill level and was highly replayable.</p>\r\n\r\n<p>The game was attributed to popularizing the battle royale genre, with a number of unofficial Chinese clones also being produced following its success. The game also received several Game of the Year nominations, among other accolades. PUBG Corporation has run several small tournaments and introduced in-game tools to help with broadcasting the game to spectators, as they wish for it to become a popular esport. The game has also been banned in some countries for allegedly being harmful and addictive to younger players.</p>',87,'PUBG Corporation, KRAFTON, Lightspeed & Quantum, Kakao Games, Xbox Game Studios','PUBG Corporation, KRAFTON',1,1,'2016-07-01',NULL,'2021-01-13 10:42:34','2021-01-13 10:42:34','storage/game-image/PlayerUnknown\'s Battlegrounds-trending-1-1610534554246758ce3215fc74fab9591a5b05b3e1.png','storage/game-image/PlayerUnknown\'s Battlegrounds-cover-1-1610534554pubg-sur.png','storage/game-image/PlayerUnknown\'s Battlegrounds-poster-1-1610534554246758ce3215fc74fab9591a5b05b3e1 (1).png'),(13,'FIFA 21',1,'<p>FIFA 21 is a football simulation video game published by Electronic Arts as part of the FIFA series.[1] It is the 28th installment in the FIFA series, and was released 9 October 2020 for Microsoft Windows, Nintendo Switch, PlayStation 4 and Xbox One. Enhanced versions for the PlayStation 5 and Xbox Series X and Series S were released on 3 December 2020, in addition to a version for Stadia.</p>\r\n\r\n<p>Ultimate Team features 100 icon players, including 11 new names. Eric Cantona, Petr Čech, Ashley Cole, Samuel Eto&#39;o, Philipp Lahm, Ferenc Pusk&aacute;s, Bastian Schweinsteiger, Davor &Scaron;uker, Fernando Torres, Nemanja Vidić, and Xavi all feature as icons for the first time.[2][3] Jens Lehmann will not be an icon in FUT 21.</p>\r\n\r\n<p><strong>Ultimate Team will see the addition of a co-op gameplay feature in the form of Division Rivals, Squad Battles and Friendlies with a friend online to unlock objectives and rewards. FUT was surrounded by controversy due to it being classified as a loot box and a source of online gambling. In January 2019, EA agreed to stop selling FIFA in Belgium, following government pressure. Petitions to ban the points elsewhere began in June 2020, with the points&#39; legality being debated in the US and UK, the latter via the UK&#39;s Department of Digital, Culture, Media and Sport.</strong></p>',79,'FIFA','Electronic Arts , EA Vancouver , EA Bucharest',1,1,'2021-01-29',NULL,'2021-01-13 12:49:27','2021-01-13 12:49:27','storage/game-image/FIFA 21-trending-1-16105421679u0nlyu__400x400.png','storage/game-image/FIFA 21-cover-1-1610542167AC_WALKOUT_HIRES_WM_16X9.png','storage/game-image/FIFA 21-poster-1-1610542167fifa-theme-um10.png'),(14,'Dying Light 2',1,'<p>Dying Light 2 is an open world first-person zombie apocalyptic-themed action role-playing game. The game begins 15 years after Dying Light, starring a new protagonist named Aiden Caldwell, who is equipped with various parkour skills. Players can perform actions such as climbing ledges, sliding, leaping off from edges, and wall running to quickly navigate the city. More than double the parkour moves have been added since the first game, some are exclusive to particular areas of the city.</p>\r\n\r\n<p>Tools such as a grappling hook and a paraglider also aid traversal in the city. Aiden can also use the undead to break his fall. The game is mostly melee-based with the majority of fighting using melee weapons. The melee weapons have a limited lifespan and will degrade the longer the player uses the melee weapons in combat. Long-range weapons such as crossbows, shotguns, spears, can be used as well.</p>\r\n\r\n<p>Weapons can be upgraded with different blueprints and components which can be found by breaking down weapons for craft parts. Aiden can also utilize superhuman skills due to the infection. New zombies have been added. Like the first game, the zombies are slow when exposed to sunlight, but they become more aggressive and hostile at night.</p>',90,'Techland','Techland',1,1,'2021-01-30',NULL,'2021-01-14 04:31:43','2021-01-14 04:31:43','storage/game-image/Dying Light 2-trending-1-1610598703crop.png','storage/game-image/Dying Light 2-cover-1-1610598703250-2507672_dying-light-2-4k-dying-light-2-4k.png','storage/game-image/Dying Light 2-poster-1-1610598703crop (1).png');
/*!40000 ALTER TABLE `games` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `genres`
--

DROP TABLE IF EXISTS `genres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `genres` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `genres`
--

LOCK TABLES `genres` WRITE;
/*!40000 ALTER TABLE `genres` DISABLE KEYS */;
INSERT INTO `genres` VALUES (1,1,'Action','action','2020-09-09 11:46:39','2020-09-09 11:46:39'),(2,1,'Adventure','adventure','2020-09-09 11:46:46','2020-09-09 11:46:46'),(3,1,'sports','sports','2020-12-20 11:12:57','2020-12-20 11:12:57'),(4,1,'arcade','arcade','2020-12-20 11:13:08','2020-12-20 11:13:08');
/*!40000 ALTER TABLE `genres` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lenders`
--

DROP TABLE IF EXISTS `lenders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lenders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `lender_id` bigint(20) unsigned NOT NULL,
  `rent_id` bigint(20) unsigned NOT NULL,
  `checkpoint_id` bigint(20) unsigned DEFAULT NULL,
  `lend_week` int(11) NOT NULL,
  `lend_cost` int(11) NOT NULL,
  `lend_date` date NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lenders_lender_id_foreign` (`lender_id`),
  KEY `lenders_rent_id_foreign` (`rent_id`),
  CONSTRAINT `lenders_lender_id_foreign` FOREIGN KEY (`lender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `lenders_rent_id_foreign` FOREIGN KEY (`rent_id`) REFERENCES `rents` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lenders`
--

LOCK TABLES `lenders` WRITE;
/*!40000 ALTER TABLE `lenders` DISABLE KEYS */;
INSERT INTO `lenders` VALUES (1,5,1,NULL,3,480,'2020-09-09','cod',0,NULL,'2020-09-09 12:03:23','2020-09-09 12:03:23'),(2,7,2,NULL,1,200,'2020-09-09','cod',0,NULL,'2020-09-09 12:34:48','2020-09-09 12:34:48'),(3,8,3,NULL,2,350,'2020-09-09','cod',0,NULL,'2020-09-09 13:24:44','2020-09-09 13:24:44'),(4,9,5,NULL,2,350,'2020-09-10','cod',0,NULL,'2020-09-10 04:27:46','2020-09-10 04:27:46'),(5,11,4,NULL,2,350,'2020-09-10','cod',0,NULL,'2020-09-10 10:03:21','2020-09-10 10:03:21'),(6,13,6,NULL,3,480,'2020-09-13','cod',0,NULL,'2020-09-13 04:36:42','2020-09-13 04:36:42'),(7,14,8,NULL,2,350,'2020-09-13','cod',0,NULL,'2020-09-13 05:02:05','2020-09-13 05:02:05'),(8,16,10,NULL,1,200,'2020-09-13','cod',0,NULL,'2020-09-13 05:15:27','2020-09-13 05:15:27'),(9,17,12,NULL,1,200,'2020-09-13','cod',0,NULL,'2020-09-13 11:37:48','2020-09-13 11:37:48'),(10,17,12,NULL,1,199,'2020-09-13','cod',0,NULL,'2020-09-13 11:38:17','2020-09-13 11:38:17'),(11,19,11,NULL,1,0,'2020-09-13','cod',0,NULL,'2020-09-13 11:45:18','2020-09-13 11:45:18'),(12,21,13,NULL,2,350,'2020-09-13','cod',0,NULL,'2020-09-13 12:31:14','2020-09-13 12:31:14'),(13,24,9,NULL,3,50,'2020-09-14','cod',0,NULL,'2020-09-14 05:58:52','2020-09-14 05:58:52'),(14,24,9,NULL,3,50,'2020-09-14','cod',0,NULL,'2020-09-14 05:58:58','2020-09-14 05:58:58'),(15,24,9,NULL,3,50,'2020-09-14','cod',0,NULL,'2020-09-14 05:59:01','2020-09-14 05:59:01'),(16,24,9,NULL,3,50,'2020-09-14','cod',0,NULL,'2020-09-14 05:59:09','2020-09-14 05:59:09'),(17,26,15,NULL,4,20,'2020-09-16','cod',0,NULL,'2020-09-16 04:51:38','2020-09-16 04:51:38'),(18,26,15,NULL,4,20,'2020-09-16','cod',0,NULL,'2020-09-16 04:51:47','2020-09-16 04:51:47'),(19,26,15,NULL,4,90,'2020-09-16','cod',0,NULL,'2020-09-16 04:51:56','2020-09-16 04:51:56'),(20,27,14,NULL,2,350,'2020-10-12','cod',0,NULL,'2020-10-12 07:07:51','2020-10-12 07:07:51'),(21,29,16,NULL,1,200,'2020-10-22','cod',0,NULL,'2020-10-22 11:09:08','2020-10-22 11:09:08'),(22,33,18,NULL,1,200,'2020-12-20','cod',0,NULL,'2020-12-20 04:59:04','2020-12-20 04:59:04');
/*!40000 ALTER TABLE `lenders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `managements`
--

DROP TABLE IF EXISTS `managements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `managements` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `delivery_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_amount` decimal(8,2) NOT NULL,
  `delivery_commission` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `managements_user_id_foreign` (`user_id`),
  CONSTRAINT `managements_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `managements`
--

LOCK TABLES `managements` WRITE;
/*!40000 ALTER TABLE `managements` DISABLE KEYS */;
/*!40000 ALTER TABLE `managements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2016_06_01_000001_create_oauth_auth_codes_table',1),(4,'2016_06_01_000002_create_oauth_access_tokens_table',1),(5,'2016_06_01_000003_create_oauth_refresh_tokens_table',1),(6,'2016_06_01_000004_create_oauth_clients_table',1),(7,'2016_06_01_000005_create_oauth_personal_access_clients_table',1),(8,'2019_08_19_000000_create_failed_jobs_table',1),(9,'2020_04_18_183520_create_permission_tables',1),(10,'2020_04_21_060126_create_genres_table',1),(11,'2020_04_23_122419_create_games_table',1),(12,'2020_04_23_122849_create_assets_table',1),(13,'2020_04_23_123036_create_taggable_table',1),(14,'2020_04_26_073924_create_user_ratings_table',1),(15,'2020_04_30_112955_create_user_histories_table',1),(16,'2020_04_30_113354_create_exchangeable_games_table',1),(17,'2020_04_30_113706_create_exchanges_table',1),(18,'2020_05_02_162301_create_rents_table',1),(19,'2020_05_04_091233_create_managements_table',1),(20,'2020_05_05_045123_create_transaction_histories_table',1),(21,'2020_05_05_045230_create_user_requests_table',1),(22,'2020_06_02_065353_create_platforms_table',1),(23,'2020_06_02_162415_create_game_platform_table',1),(24,'2020_06_03_045751_create_game_genre_table',1),(25,'2020_06_29_093250_create_disk_conditions_table',1),(26,'2020_06_30_044915_create_one_time_passwords_table',1),(27,'2020_07_02_055609_create_jobs_table',1),(28,'2020_07_13_114100_create_lenders_table',1),(29,'2020_07_20_104436_create_orders_table',1),(30,'2020_07_26_054131_create_addresses_table',1),(31,'2020_07_26_055007_add_column_to_users_table',1),(32,'2020_08_10_121331_create_base_prices_table',1),(33,'2020_08_20_121059_create_checkpionts_table',1),(34,'2020_08_23_102026_create_districts_table',1),(35,'2020_08_23_102044_create_divisions_table',1),(36,'2020_08_23_102137_create_thanas_table',1),(37,'2020_08_23_102153_create_areas_table',1),(38,'2020_12_21_100538_add_image_coloumns_to_games_table',2),(39,'2020_12_22_065720_create_screenshots_table',2),(40,'2020_12_22_104408_create_video_urls_table',2),(41,'2020_12_23_092143_create_articles_table',3),(42,'2020_12_23_092910_add_last_name_column_to_users_table',3),(43,'2021_01_07_034406_add_featured_column_to_articles',4),(44,'2021_01_07_063625_create_game_reminders',5),(45,'2021_01_11_110315_reset_password_tokens',5);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'App\\Models\\User',1),(2,'App\\Models\\User',2),(2,'App\\Models\\User',3),(2,'App\\Models\\User',4),(2,'App\\Models\\User',5),(2,'App\\Models\\User',6),(2,'App\\Models\\User',7),(2,'App\\Models\\User',8),(2,'App\\Models\\User',9),(2,'App\\Models\\User',10),(2,'App\\Models\\User',11),(2,'App\\Models\\User',12),(2,'App\\Models\\User',13),(2,'App\\Models\\User',14),(2,'App\\Models\\User',15),(2,'App\\Models\\User',16),(2,'App\\Models\\User',17),(2,'App\\Models\\User',18),(2,'App\\Models\\User',19),(2,'App\\Models\\User',20),(2,'App\\Models\\User',21),(2,'App\\Models\\User',22),(2,'App\\Models\\User',23),(2,'App\\Models\\User',24),(2,'App\\Models\\User',25),(2,'App\\Models\\User',26),(2,'App\\Models\\User',27),(2,'App\\Models\\User',28),(2,'App\\Models\\User',29),(2,'App\\Models\\User',30),(2,'App\\Models\\User',31),(2,'App\\Models\\User',32),(2,'App\\Models\\User',33),(2,'App\\Models\\User',34),(2,'App\\Models\\User',35),(2,'App\\Models\\User',36),(2,'App\\Models\\User',37),(2,'App\\Models\\User',38),(2,'App\\Models\\User',39),(2,'App\\Models\\User',40),(2,'App\\Models\\User',41),(2,'App\\Models\\User',42),(2,'App\\Models\\User',43),(2,'App\\Models\\User',44),(2,'App\\Models\\User',45),(2,'App\\Models\\User',53),(2,'App\\Models\\User',54),(2,'App\\Models\\User',56),(2,'App\\Models\\User',59),(2,'App\\Models\\User',61),(2,'App\\Models\\User',62),(2,'App\\Models\\User',63),(2,'App\\Models\\User',66),(2,'App\\Models\\User',67),(2,'App\\Models\\User',68),(2,'App\\Models\\User',69);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_access_tokens`
--

DROP TABLE IF EXISTS `oauth_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_access_tokens`
--

LOCK TABLES `oauth_access_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_access_tokens` DISABLE KEYS */;
INSERT INTO `oauth_access_tokens` VALUES ('0192a714236f831f20f39ac2bfc863f11c5b93aa0f0c39391a65aadd533adb98c2fc1a5d4e1b2134',36,1,'01909090909-2020-12-22 13:34:04','[]',0,'2020-12-22 13:34:04','2020-12-22 13:34:04','2021-12-22 13:34:04'),('01a47aa0f5938161d829b91a1e203996b7889a693068432f1b9ed740e83413038ad080d444bd12d1',63,1,'01766566556-2021-01-13 05:17:26','[]',0,'2021-01-13 05:17:26','2021-01-13 05:17:26','2022-01-13 05:17:26'),('036c5be4eaa664a850f05015eab3506828fcef9ca377dfd03de32285a28217b8e6b13cda3b5fc041',27,1,'ucchash@augnitive.com-2020-10-12 07:18:31','[]',0,'2020-10-12 07:18:31','2020-10-12 07:18:31','2021-10-12 07:18:31'),('039319957dabf04ccb2509e47d934530bae33122b80b3334dc9fb50cec62a14cce053ffe7922ce70',53,1,'debashish@augnitive.com-2021-01-12 05:39:15','[]',0,'2021-01-12 05:39:15','2021-01-12 05:39:15','2022-01-12 05:39:15'),('094144c51de4e03a0cc71adaa06bba83a64b001030884ec3cb9159556793836b101bef46251a94bc',13,1,'01770703838-2020-12-27 10:00:18','[]',0,'2020-12-27 10:00:18','2020-12-27 10:00:18','2021-12-27 10:00:18'),('09913e377b1dfd2ca64fd80972b28909a6f4084a8b85347ee1c175e548a99d32bf18c2830d35ebd0',13,1,'01770703838-2020-12-28 05:57:45','[]',0,'2020-12-28 05:57:45','2020-12-28 05:57:45','2021-12-28 05:57:45'),('0ae498ccad96929fcbd9a5a195ed26ac4db2e5b3627f3ea6c556dee3ff765ab7527530eeb403b1c1',27,1,'ucchash@augnitive.com-2020-10-20 11:26:28','[]',0,'2020-10-20 11:26:28','2020-10-20 11:26:28','2021-10-20 11:26:28'),('0e16495c94a335c98fdd03c1fab2569b8afc27f58074ff5304622d941f10ebd120401830ded5b536',57,1,'mij@gmail.com-2021-01-12 06:18:35','[]',0,'2021-01-12 06:18:35','2021-01-12 06:18:35','2022-01-12 06:18:35'),('12371d9bcb291f93cb9a57b111d85d4c5a736d9dd62fb7ebf229404669e34230efb081cf417f6bdf',28,1,'minhaj372@gmail.com-2021-01-13 12:28:25','[]',0,'2021-01-13 12:28:25','2021-01-13 12:28:25','2022-01-13 12:28:25'),('1570d0f01f3c0a193b3f3538a8a7f4fde577189201b58a2b4450b0f8e88c575b38b9c2fd638a0b71',24,1,'01222222222-2020-09-14 05:37:06','[]',0,'2020-09-14 05:37:06','2020-09-14 05:37:06','2021-09-14 05:37:06'),('171751cbb65820871476292f71ebafb4a1e14bc6671d5379122469be503ba0daedf57600aec8d5a2',36,1,'01909090909-2020-12-30 12:24:07','[]',0,'2020-12-30 12:24:07','2020-12-30 12:24:07','2021-12-30 12:24:07'),('1a07c64bd26194883453019cfbe3cd0617f7cc70f4eb9e10389bbf554a5895768f4c6111dcd05eef',4,1,'01521466101-2020-09-09 11:55:04','[]',0,'2020-09-09 11:55:04','2020-09-09 11:55:04','2021-09-09 11:55:04'),('1b4dd4b9ce09163d4a7fb27aff09f156d779192d0e9c9fa22c065fc71864a145cb826cc12d555a90',15,1,'01838383888-2020-09-13 05:07:01','[]',0,'2020-09-13 05:07:01','2020-09-13 05:07:01','2021-09-13 05:07:01'),('1bf5f25b403c9f0dc87a285e1201e9f71303fd71509def09d9161bfdc9db4d21bc12682cd3bf6718',28,1,'minhaj372@gmail.com-2021-01-13 12:22:46','[]',0,'2021-01-13 12:22:46','2021-01-13 12:22:46','2022-01-13 12:22:46'),('1c6be13d718ad897294f820e0e9a9ea79984d0a70251c67b5805342bde8e738d5ef35972753a949e',44,1,'01333333333-2021-01-04 04:40:55','[]',0,'2021-01-04 04:40:55','2021-01-04 04:40:55','2022-01-04 04:40:55'),('1d3eb74f9a4c437ce18be878d2c3f427501b43eda5eb21bd7cf4d864839f9c3604976e6daba5b83b',61,1,'01111111110-2021-01-12 08:16:05','[]',0,'2021-01-12 08:16:05','2021-01-12 08:16:05','2022-01-12 08:16:05'),('2083c847572d4da781398de9879bbc879ab32f4812fa5c8010078705e82d26c48be813138c449d7b',19,1,'01976756556-2020-09-13 12:12:26','[]',0,'2020-09-13 12:12:26','2020-09-13 12:12:26','2021-09-13 12:12:26'),('234b16947bf3cbf7fa06f2103ff7380c5ef4f8f656607f1eca9e033124ffe84b65f3d49ee8a5732a',35,1,'01000000000-2020-12-22 13:07:54','[]',0,'2020-12-22 13:07:54','2020-12-22 13:07:54','2021-12-22 13:07:54'),('2417ca64dcb5570c75e8feeca86a968af91975de09f4fc71296a1f6ed79d8c94b6603fa1307f4d34',56,1,'debashish+1@augnitive.com-2021-01-12 05:41:32','[]',0,'2021-01-12 05:41:32','2021-01-12 05:41:32','2022-01-12 05:41:32'),('259450e3e63bd0a2199fb1a2b0006a9abfc8199256b3df4ffd5fa21ecafe9715c03e2a2d2ff02b72',9,1,'01899999999-2020-09-10 04:18:48','[]',0,'2020-09-10 04:18:48','2020-09-10 04:18:48','2021-09-10 04:18:48'),('261a4b2848e1a58a3716891de196d836a3edf6c74ebb8858d955a9602c2b8b7ed0ec3361de13cd01',13,1,'01770703838-2020-09-13 04:37:42','[]',0,'2020-09-13 04:37:42','2020-09-13 04:37:42','2021-09-13 04:37:42'),('277b0f239b42428a31eb787b859915097388cdb896a21a287daccfe14bf6b18d70022dca09600e65',4,1,'koushik@gmail.com-2021-01-09 15:31:49','[]',0,'2021-01-09 15:31:49','2021-01-09 15:31:49','2022-01-09 15:31:49'),('29abb6d75e5dac506275816ac99c62d3d3c3c8035ddd3f21b4322dcb2670d020bf9765ef2798c57a',28,1,'01825586090-2020-12-27 08:30:28','[]',0,'2020-12-27 08:30:28','2020-12-27 08:30:28','2021-12-27 08:30:28'),('29c576cb11b3be202facd9a086b95ce1d81ab06e7d6cb0c8bc3d2b3f555322ac07c73c3b063bcfa3',39,1,'01928636354-2020-12-27 08:58:46','[]',0,'2020-12-27 08:58:46','2020-12-27 08:58:46','2021-12-27 08:58:46'),('29d0b0ba133a0668dc78f2b3aa6c62f2ac9f26fd3b9483fbd9d4d6943d46130c8f5dcc22c8d968be',37,1,'01828272727-2020-12-23 09:06:53','[]',0,'2020-12-23 09:06:53','2020-12-23 09:06:53','2021-12-23 09:06:53'),('2c96f8f8cd67b28742fb771ea3d88c34cc4bb0ddba95ccd65959614296d946ca95959d6eb3ae6a5e',4,1,'01521466101-2020-09-09 12:36:00','[]',0,'2020-09-09 12:36:00','2020-09-09 12:36:00','2021-09-09 12:36:00'),('2da894f651882505dab06818af183ad960292b26c168c84c720e7578165575007ab6b10f81629494',3,1,'01982828822-2020-09-09 11:49:39','[]',0,'2020-09-09 11:49:39','2020-09-09 11:49:39','2021-09-09 11:49:39'),('2e30fd3d8d9e733b64074c66f33e42dbc0afefe9d4ec9a745094cb9a3cdfdfcc931e337d3fd39391',26,1,'01788938383-2020-09-16 04:34:59','[]',0,'2020-09-16 04:34:59','2020-09-16 04:34:59','2021-09-16 04:34:59'),('2eeb4bc66bbf8e76c556678fb029973d78d9a40f12ce4762768862e8ed27312910eb9fc6f5bac07d',13,1,'01770703838-2020-09-13 11:57:42','[]',0,'2020-09-13 11:57:42','2020-09-13 11:57:42','2021-09-13 11:57:42'),('317e676aa081b8799c139d30b58167cb1d2a99674941722e13de821082fe0ca4574a3d52b76c102e',13,1,'01770703838-2020-09-13 04:40:08','[]',0,'2020-09-13 04:40:08','2020-09-13 04:40:08','2021-09-13 04:40:08'),('3294bca2f577f72ff28c2b740892070dd7e9d7f9dd108630d6085565b214181bba66fc517e6704bd',12,1,'01779299999-2020-09-10 10:09:06','[]',0,'2020-09-10 10:09:06','2020-09-10 10:09:06','2021-09-10 10:09:06'),('32a8e065bd6ff63f59538bf19e1533dc8c4d29a3ca4a6c78fee8d869a757a1e5cf70d5adbd56cb1b',28,1,'01825586090-2020-12-27 08:54:09','[]',0,'2020-12-27 08:54:09','2020-12-27 08:54:09','2021-12-27 08:54:09'),('33482f32cb9d7831d923634605a208f9df9a01d5530adfeffd3f2436204f44691ae1cb7ffa53b540',27,1,'01764649486-2020-10-22 10:57:13','[]',0,'2020-10-22 10:57:13','2020-10-22 10:57:13','2021-10-22 10:57:13'),('3565f57ea25eab6236ea21d1fff5b7bf02d22374251cd169fcaefb47362d86031c53b610872ba190',13,1,'01770703838-2020-09-12 12:11:19','[]',0,'2020-09-12 12:11:19','2020-09-12 12:11:19','2021-09-12 12:11:19'),('376e7c63814b1c39f19c4df2cb105ac04a33ef7312c042f661170b1081faf390a94225356c22c462',13,1,'01770703838-2020-09-14 05:29:41','[]',0,'2020-09-14 05:29:41','2020-09-14 05:29:41','2021-09-14 05:29:41'),('38b2d88a5ceda0bb11d2ab35e2e56e1ee0df090b84cb8ce144e811dac7b477c02896e70ece3020e7',10,1,'01521486543-2020-09-10 06:49:50','[]',0,'2020-09-10 06:49:50','2020-09-10 06:49:50','2021-09-10 06:49:50'),('3a9cd457174ff85b51d83d94d4e497871bc9285ed2c0976776997173ced04bd769804beaee5098a8',53,1,'01746603777-2021-01-12 04:42:36','[]',0,'2021-01-12 04:42:36','2021-01-12 04:42:36','2022-01-12 04:42:36'),('3bfa37b7937642ba5227f9acd87dabd0486159ab767b47df06aaefb3c6d2d0e7252b3b0fa2bccbd7',13,1,'01770703838-2020-12-19 06:26:24','[]',0,'2020-12-19 06:26:24','2020-12-19 06:26:24','2021-12-19 06:26:24'),('3e5fb2778d1ee448455d772162efa77ef9df9c3814c533d49322f072e86e7d181fffd24660ed85ed',11,1,'01992929292-2020-09-10 10:00:07','[]',0,'2020-09-10 10:00:07','2020-09-10 10:00:07','2021-09-10 10:00:07'),('3f8de08087bec585f58946fd216fe6b8693c7d4353e307251b2d1fd64d583fb58b91e7ef81eec31f',28,1,'minhaj372@gmail.com-2020-12-31 10:50:09','[]',0,'2020-12-31 10:50:09','2020-12-31 10:50:09','2021-12-31 10:50:09'),('400f8c3d12930fc4a03875171753460db8f973969e2229e265823ebca3d27ce5d8d39078ae77362d',53,1,'01746603777-2021-01-12 05:26:57','[]',0,'2021-01-12 05:26:57','2021-01-12 05:26:57','2022-01-12 05:26:57'),('415a1df894d868472f5a3f2dab221bafe4a6c5b6dcf97b09fa0b82fccc237f4daad5b094d3904d6b',26,1,'01788938383-2020-09-16 04:40:14','[]',0,'2020-09-16 04:40:14','2020-09-16 04:40:14','2021-09-16 04:40:14'),('464fe44dba6e5e7ed140e12319bff5c24cab897d4d240e2889ec00e6da5a33c62f5631dc14639725',6,1,'01373737777-2020-09-09 12:29:24','[]',0,'2020-09-09 12:29:24','2020-09-09 12:29:24','2021-09-09 12:29:24'),('47980ca52b088ad9bff97f4834fe548ea8e1c60f280c1fa98f858fcd6a4a5587e787feeb7ebcba77',48,1,'min@gmail.com-2021-01-05 04:14:57','[]',0,'2021-01-05 04:14:57','2021-01-05 04:14:57','2022-01-05 04:14:57'),('480609db37fba16826c203199c5dabeb3e9d45d9d75fec5cc722d44d3e2d7287874d5e0ddb086a65',13,1,'01770703838-2020-09-13 04:35:23','[]',0,'2020-09-13 04:35:23','2020-09-13 04:35:23','2021-09-13 04:35:23'),('4849c04882ff14a6bfa1eb6cf086bb1fad1329cb837e27c55f81d350f0dc632d19f246c9a31a06be',32,1,'01919989886-2020-12-19 12:37:31','[]',0,'2020-12-19 12:37:31','2020-12-19 12:37:31','2021-12-19 12:37:31'),('509ec23719b7e5ee781790a478a6fefac04eef6b65a822713ec3c8ff0115a645f6b98e4b9166ed8f',28,1,'01825586090-2020-12-20 13:34:23','[]',0,'2020-12-20 13:34:23','2020-12-20 13:34:23','2021-12-20 13:34:23'),('5120c7b750e0cade7f44d8674b131f711d94d756f11aef1a70681f3c299f27921461b48d1d6b331a',28,1,'01825586090-2021-01-12 07:02:35','[]',0,'2021-01-12 07:02:35','2021-01-12 07:02:35','2022-01-12 07:02:35'),('5a269aa4a2db08c799b36aa3dabbbdd1ecd88d593afe412fde098fe6688ab173b8aa5686faa79f4e',43,1,'01825432224-2021-01-03 11:20:11','[]',0,'2021-01-03 11:20:11','2021-01-03 11:20:11','2022-01-03 11:20:11'),('60ee3cda715cda435ab7d18b57da4ac09d4790a48ac43b5089a4ddd2879902c1154e45f1466d4cdc',60,1,'akashahmed@gmail.com-2021-01-12 07:22:02','[]',0,'2021-01-12 07:22:02','2021-01-12 07:22:02','2022-01-12 07:22:02'),('61a0a42d3d81ee5788e949a76ed07cfb58b4800476700df92ac181f7108e2d13c0efc2ffed352017',28,1,'01825586090-2021-01-04 10:06:38','[]',0,'2021-01-04 10:06:38','2021-01-04 10:06:38','2022-01-04 10:06:38'),('6435df5e2da822f86f6790a3fc3ab3eacf94c80235fa1586ac51109a69271ce1ca5fb392c390d4a7',28,1,'01825586090-2020-12-23 08:45:07','[]',0,'2020-12-23 08:45:07','2020-12-23 08:45:07','2021-12-23 08:45:07'),('648ae3f86d4405ab03e727edeffd86a6b5ffd89d8a63dde52698b6e2e095cf045ab4f82456160431',33,1,'01983838388-2020-12-20 04:54:13','[]',0,'2020-12-20 04:54:13','2020-12-20 04:54:13','2021-12-20 04:54:13'),('656404578e88beca20d343fd7f0a43de9a0946e518e45b0e0d5ad3e36a6e1d674cd39567adda9cd8',8,1,'01999999999-2020-09-15 07:04:16','[]',0,'2020-09-15 07:04:16','2020-09-15 07:04:16','2021-09-15 07:04:16'),('669022627ff72873d5cff7f790d4ac01560de7b8886cc2f56267e314bb59e2c60f4d817050b54bc1',27,1,'01764649486-2020-10-12 06:38:07','[]',0,'2020-10-12 06:38:07','2020-10-12 06:38:07','2021-10-12 06:38:07'),('66c5f4edead6d7f635cc8aae2ee912173c9041532595b61fdb3b7b5a53e3b46933ef15a6e52d1441',59,1,'01770703737-2021-01-12 06:58:03','[]',0,'2021-01-12 06:58:03','2021-01-12 06:58:03','2022-01-12 06:58:03'),('67a8c489798035be4ac63119d60704a1503ccb3a004029d40e45ef87e0b86014c666cba2f86a3e66',27,1,'01764649486-2021-01-05 08:24:24','[]',0,'2021-01-05 08:24:24','2021-01-05 08:24:24','2022-01-05 08:24:24'),('6c2665282073bdff4b30e5d6408835ae674bd3df19207497abf6d1481c01c530f810bd7c9c3f70fe',5,1,'01717739179-2020-09-09 12:02:00','[]',0,'2020-09-09 12:02:00','2020-09-09 12:02:00','2021-09-09 12:02:00'),('6cc27790ba1c5c463abd84050e16b6de54e075ff658007f63d71e9a4ce1cfa1d1017f4a69a0ddb11',45,1,'01970703838-2021-01-04 09:23:00','[]',0,'2021-01-04 09:23:00','2021-01-04 09:23:00','2022-01-04 09:23:00'),('6d1b81fdb9fbbe47f36ea601b9716dc4f96532d6dfca7fd8f2710c5cc778179e33ca9f9800669cc4',58,1,'debashish+2@augnitive.com-2021-01-12 06:23:31','[]',0,'2021-01-12 06:23:31','2021-01-12 06:23:31','2022-01-12 06:23:31'),('70995b25e9a1a1c3d21022a80e43b2a6ee0fbb825d6613d64b52a92f93048cc9f88daa43b93f4a6c',65,1,'debashish+3@augnitive.com-2021-01-13 05:35:27','[]',0,'2021-01-13 05:35:27','2021-01-13 05:35:27','2022-01-13 05:35:27'),('7189ffff048c8fdcbfd9953802e17998b84ffc721f95118f8d5f042269dd7c00f4326055a60728c0',56,1,'debashish+1@augnitive.com-2021-01-12 05:41:48','[]',0,'2021-01-12 05:41:48','2021-01-12 05:41:48','2022-01-12 05:41:48'),('725edd85f664acd79e2b0fd4e67d25a6359709b4e3e68fa94478c4435273c4c85fe5dc2b897ba812',56,1,'01746603776-2021-01-12 05:40:32','[]',0,'2021-01-12 05:40:32','2021-01-12 05:40:32','2022-01-12 05:40:32'),('728ce9e0f0a09da3ef0ec31f277d77864ad6c8d9b480889df78b7e7bb965d70ad50daa3bc29ef31d',40,1,'01010101010-2020-12-28 09:52:14','[]',0,'2020-12-28 09:52:14','2020-12-28 09:52:14','2021-12-28 09:52:14'),('74c36d8686351ae6637b58238d76e61b166beef8663d03f44f09e7ee8f00fde7912a7aa27e776aa4',14,1,'01783737457-2020-09-13 04:52:03','[]',0,'2020-09-13 04:52:03','2020-09-13 04:52:03','2021-09-13 04:52:03'),('7545fbaeb8cd6ba1989f0c9a553e7e37033d70157337fd0a5b7d9ebf1f779b43ef8e7566058bdb4b',13,1,'01770703838-2020-09-13 04:50:24','[]',0,'2020-09-13 04:50:24','2020-09-13 04:50:24','2021-09-13 04:50:24'),('7574481719cb4daa0efaed9aed00bde71758a07027b98745e6e21bea3155fe36c68eeeda223bbcc9',25,1,'01746464446-2020-09-14 09:07:01','[]',0,'2020-09-14 09:07:01','2020-09-14 09:07:01','2021-09-14 09:07:01'),('771fe5eed0bf6a4b9706f65ec082890dfd58aa9e63827be48c6b7de9cc65a00e3c7b372264f51711',28,1,'01825586090-2020-12-29 08:54:43','[]',0,'2020-12-29 08:54:43','2020-12-29 08:54:43','2021-12-29 08:54:43'),('781e70ac42488aff9269fdc05b5969ef9ded4418f4de643d803d6d177629f82c51e6e63cb76f7496',13,1,'01770703838-2020-09-14 08:51:01','[]',0,'2020-09-14 08:51:01','2020-09-14 08:51:01','2021-09-14 08:51:01'),('7a6cedca5b15652a310114699af6493d1835f0cea4da817b787620136a48b49b1508568d96d7a663',41,1,'01929292728-2020-12-30 10:49:46','[]',0,'2020-12-30 10:49:46','2020-12-30 10:49:46','2021-12-30 10:49:46'),('7e6ca75b684ca772ecb0886636a33886deee9d1acb20642158598151de210aa6457df4bc355abeed',29,1,'01686406730-2020-10-22 11:00:06','[]',0,'2020-10-22 11:00:06','2020-10-22 11:00:06','2021-10-22 11:00:06'),('7fbf37765c2ba434bf0a43dd1e9b2458ca97a8ff38e847151869749386d23974c6a079052447b74a',34,1,'01911358926-2020-12-22 12:22:11','[]',0,'2020-12-22 12:22:11','2020-12-22 12:22:11','2021-12-22 12:22:11'),('7fe9301926c72cefb7e4695ae5c4034fd6bf5a93acff4433c465bcf38d5ee03234f074f60784f205',56,1,'debashish+1@augnitive.com-2021-01-12 06:21:56','[]',0,'2021-01-12 06:21:56','2021-01-12 06:21:56','2022-01-12 06:21:56'),('8549675a78eade06b7d7f772f93e0959cdce5e056579bcc0079d000cb6e21c5f5ded0fcb1d1306a3',64,1,'akashahmed121@gmail.com-2021-01-13 05:34:50','[]',0,'2021-01-13 05:34:50','2021-01-13 05:34:50','2022-01-13 05:34:50'),('8572f3587dc37b7e2a2dbe2f36a9243ce9b4be651113c84ef26c3b08927f8bd5d1e30c339108e160',19,1,'01976756556-2020-09-13 11:41:38','[]',0,'2020-09-13 11:41:38','2020-09-13 11:41:38','2021-09-13 11:41:38'),('867965af41d07d5974bb322abe6d217b0576a0bc71919b6304710a790459a50163a0b6f4e2047536',52,1,'sadia@augnitive.com-2021-01-06 11:11:30','[]',0,'2021-01-06 11:11:30','2021-01-06 11:11:30','2022-01-06 11:11:30'),('88ae8a0c0492b4c90f62535304ceb27003e60eced9a500ef7a04c219e9e33da765347d9a084718ab',13,1,'01770703838-2020-12-20 04:36:46','[]',0,'2020-12-20 04:36:46','2020-12-20 04:36:46','2021-12-20 04:36:46'),('8af90cd15c830743f411d9d9fb575b6a927a0303cd1d1338959b99dcf791f1e13216fc8e0eb0e3bf',13,1,'01770703838-2021-01-06 08:40:33','[]',0,'2021-01-06 08:40:33','2021-01-06 08:40:33','2022-01-06 08:40:33'),('8d2877ff8c01bc8fd4788ef2d580ef28928c29ccdce7263975634ce3161c6ca5f546e3e6f82e1c7f',38,1,'01667554534-2020-12-27 08:55:47','[]',0,'2020-12-27 08:55:47','2020-12-27 08:55:47','2021-12-27 08:55:47'),('8d8a05211e0b1e0839c02afd4ac9ef528ad5e11ce271674bac81da0b3f7ec94500b688eff88b4c14',4,1,'01521466101-2020-12-19 12:43:59','[]',0,'2020-12-19 12:43:59','2020-12-19 12:43:59','2021-12-19 12:43:59'),('8f97fe3e3cce9318b4d03ef1a83913416a4409d02b9521c81de1c6e6727f98b1f91b15d3100b07ca',28,1,'01825586090-2020-10-19 07:15:15','[]',0,'2020-10-19 07:15:15','2020-10-19 07:15:15','2021-10-19 07:15:15'),('8f9f6cb718e0013bc28ff9b5f04f4022ecdd5b5b99fb8cf7e672406dace5c67aad271791c29fcf0d',15,1,'01838383888-2020-09-13 05:03:07','[]',0,'2020-09-13 05:03:07','2020-09-13 05:03:07','2021-09-13 05:03:07'),('917f6168600722357d0e4c1938c9feb308a5de27286c7efb30df8c03419b70f6a030aacf60da083d',54,1,'01928238388-2021-01-07 08:40:15','[]',0,'2021-01-07 08:40:15','2021-01-07 08:40:15','2022-01-07 08:40:15'),('9335802a02ac0d1093e409dbc03a99ba371fa86361c1ed43044cd36696fb497d23db4beb0b04a84b',68,1,'01782828384-2021-01-13 13:44:42','[]',0,'2021-01-13 13:44:42','2021-01-13 13:44:42','2022-01-13 13:44:42'),('94a26ab02b6a4c6102cdc0c371c2dc9568f376b69efd9f247e0f9978aa34e93e84f651704e95d099',28,1,'minhaj372@gmail.com-2021-01-13 12:34:00','[]',0,'2021-01-13 12:34:00','2021-01-13 12:34:00','2022-01-13 12:34:00'),('94ef43eebf9a63e76a8dc5b0f647cf3cca5a914e2c99817668083c59006ce56188467cb2553f8197',27,1,'01764649486-2020-10-12 07:04:15','[]',0,'2020-10-12 07:04:15','2020-10-12 07:04:15','2021-10-12 07:04:15'),('97efb52f608923e728e60f17a6f461668623a20e6ca1db38d33fc1d12bb8232c18c50b0327062196',27,1,'01764649486-2020-12-22 05:11:49','[]',0,'2020-12-22 05:11:49','2020-12-22 05:11:49','2021-12-22 05:11:49'),('9ace2645fd79fb12f8c0560a068ecfb621ebdca676a3f5c340b2f43a5ffa9b5dab3a2702df23728e',13,1,'01770703838-2020-12-31 09:03:03','[]',0,'2020-12-31 09:03:03','2020-12-31 09:03:03','2021-12-31 09:03:03'),('9b79016cf69bef02c33ec0cf0d672806b5d85f5b3091154f05c2504b29934303ecb67da7aa976dae',67,1,'01909099900-2021-01-13 12:19:03','[]',0,'2021-01-13 12:19:03','2021-01-13 12:19:03','2022-01-13 12:19:03'),('9c1258c198655bc73d98eb305f87bd5adece421e1ee946a3fc67cab56327891faeeb74847554b126',59,1,'01770703737-2021-01-12 12:04:35','[]',0,'2021-01-12 12:04:35','2021-01-12 12:04:35','2022-01-12 12:04:35'),('a5b68c5bf65bd386c3cc8bfd0f6090dd90751da53ffb0686858eec1b768befbd5274efd16647b85c',22,1,'01888888888-2020-09-14 05:18:22','[]',0,'2020-09-14 05:18:22','2020-09-14 05:18:22','2021-09-14 05:18:22'),('a816982304b3e4415670810513df8c0a7be753c193a808d8d634df19a9c50e2260403d72b403265c',16,1,'01937737373-2020-09-13 05:09:39','[]',0,'2020-09-13 05:09:39','2020-09-13 05:09:39','2021-09-13 05:09:39'),('aab134be0bb8101ff466b4421914b62627330c77bf7cf8c82c6d29c47a995fba1a9c0f54e5dd17f2',42,1,'01826354353-2020-12-31 04:42:44','[]',0,'2020-12-31 04:42:44','2020-12-31 04:42:44','2021-12-31 04:42:44'),('aab19425020de16c3bca183aadd8edf492584c1c70361ee849f1c4e01eb6e6335c6f370d047d5dd6',27,1,'01764649486-2020-10-19 07:17:25','[]',0,'2020-10-19 07:17:25','2020-10-19 07:17:25','2021-10-19 07:17:25'),('aae39b79e53d9a253bf5110a3e430ee39f9950225e3c7fcb0225ce3bf1fc613c8173523474675d8c',62,1,'01919191919-2021-01-12 08:23:02','[]',0,'2021-01-12 08:23:02','2021-01-12 08:23:02','2022-01-12 08:23:02'),('ab345fe9d408dc0329fe9408c79ccba1a3f626702c385467a24c8386607080e64cdd9175638636b2',18,1,'01521324269-2020-09-13 11:21:28','[]',0,'2020-09-13 11:21:28','2020-09-13 11:21:28','2021-09-13 11:21:28'),('ae6f776c28cd096833ca3746de9d87caec53f95b20c153af87d7bd1484ee9969f30fc904b6820813',21,1,'01988888888-2020-09-13 12:13:34','[]',0,'2020-09-13 12:13:34','2020-09-13 12:13:34','2021-09-13 12:13:34'),('aeb45cf97e226e9aebbf033de6b109ec77d9ebfc46cdd443c34a957177cc462295eef5c7c34b6f8b',13,1,'01770703838-2021-01-06 12:25:48','[]',0,'2021-01-06 12:25:48','2021-01-06 12:25:48','2022-01-06 12:25:48'),('b19c4e18523f6787650ab43e00e8d598f04d0a3412eb2279da2a8419c47276cd2687570c795487a1',50,1,'min11@gmail.com-2021-01-06 04:18:31','[]',0,'2021-01-06 04:18:31','2021-01-06 04:18:31','2022-01-06 04:18:31'),('b2b81956d8049908c1db2b1647858ad314ddf5002f6f09e5c49cc3e9c8d04eaba6d2dd94bf646917',28,1,'minhaj372@gmail.com-2020-12-31 10:10:40','[]',0,'2020-12-31 10:10:40','2020-12-31 10:10:40','2021-12-31 10:10:40'),('b475c491e36f6be128d4437b708cc3b4fdab970abad08791fad2901e88f6adc0d3ae6071b8633ad7',59,1,'01770703737-2021-01-12 11:12:07','[]',0,'2021-01-12 11:12:07','2021-01-12 11:12:07','2022-01-12 11:12:07'),('b95838000b297db75c08cf5658c4a8584acf5997cf060db566b9e106b8875bccc73855d426a68018',13,1,'01770703838-2020-09-13 04:43:59','[]',0,'2020-09-13 04:43:59','2020-09-13 04:43:59','2021-09-13 04:43:59'),('b972e0c621a8849a60a0a2d3f70b672f5ee8cc6ee6b04e4f5a81746b6981955dc45124d33a059a45',29,1,'01686406730-2020-12-22 06:50:33','[]',0,'2020-12-22 06:50:33','2020-12-22 06:50:33','2021-12-22 06:50:33'),('ba962b0fd7ceeaa8c9063aae0503728dd0c6f85a07c4cfbef5224bfe218879772bf8941fd27df5b7',66,1,'01833353508-2021-01-13 08:52:14','[]',0,'2021-01-13 08:52:14','2021-01-13 08:52:14','2022-01-13 08:52:14'),('bb9b2f0b5ebd478cc51d06a9bd1521b2e51a4e4cd4a8e2f8b02088349ca64828cd369345e9709ff6',55,1,'akashahmed509@gmail.com-2021-01-07 08:47:43','[]',0,'2021-01-07 08:47:43','2021-01-07 08:47:43','2022-01-07 08:47:43'),('bc2c8fdeec312a6e5e6d329ba25794f434c6ff7c56391470ce727ee4ff68d5777c485d2837716205',28,1,'minhaj372@gmail.com-2021-01-13 12:53:02','[]',0,'2021-01-13 12:53:02','2021-01-13 12:53:02','2022-01-13 12:53:02'),('bf2a367e9a5fa43f5e3ae972bf20de61b256c6df855b381b0ffc192bbbd848999bd58a893bec37e5',27,1,'01764649486-2020-10-12 07:24:12','[]',0,'2020-10-12 07:24:12','2020-10-12 07:24:12','2021-10-12 07:24:12'),('c1b3ad9e57dfd36d3b894960ef07676c2491741f61f0a198fe3bb0ee2df9c928d2eba1b805158530',27,1,'01764649486-2020-12-27 10:14:02','[]',0,'2020-12-27 10:14:02','2020-12-27 10:14:02','2021-12-27 10:14:02'),('c2eb0ad57082cbd82d5d6576335e5a69fd4336bf79d2c6ca99a1d25ffbdd4ace49a3555910370fbc',23,1,'01988888366-2020-09-14 05:29:01','[]',0,'2020-09-14 05:29:01','2020-09-14 05:29:01','2021-09-14 05:29:01'),('c486b555ad68065394f37ac2e1780acf3da0ea44ad20f1e141cb4b78cd71ebcb077fbe8ce2fb10ff',31,1,'01919989887-2020-12-19 11:42:41','[]',0,'2020-12-19 11:42:41','2020-12-19 11:42:41','2021-12-19 11:42:41'),('c586dbc9b6485fe2ab74b655735e3d191c315a8de450cf2c797e9d9f9b833703f5f0fcbcbe3757d6',7,1,'01232283282-2020-09-09 12:33:10','[]',0,'2020-09-09 12:33:10','2020-09-09 12:33:10','2021-09-09 12:33:10'),('c589dff65129300c5c3fae41fc342db60d7c70e6f4ff3def130776573e281d2566d38633d55ddbd5',27,1,'01764649486-2021-01-10 07:23:06','[]',0,'2021-01-10 07:23:06','2021-01-10 07:23:06','2022-01-10 07:23:06'),('c70fbe414fc51eafa4f06fe0e6dde48a9c13c4a7d06b204d8580662923904aedfb93a731d3f04eb7',30,1,'01919989876-2020-12-19 06:03:18','[]',0,'2020-12-19 06:03:18','2020-12-19 06:03:18','2021-12-19 06:03:18'),('c71c2a2d47ec0c3f287fd0ce5af4a4527590510aa6a8e06e73ae320f49fc426483ac0803817e37d6',30,1,'01919989876-2020-12-19 07:13:58','[]',0,'2020-12-19 07:13:58','2020-12-19 07:13:58','2021-12-19 07:13:58'),('cb9f78ba49b289ffdffec415655c5eefa661c42bb051ffae0693c952a8a4186780a26d55045e11f9',53,1,'01746603777-2021-01-07 05:47:50','[]',0,'2021-01-07 05:47:50','2021-01-07 05:47:50','2022-01-07 05:47:50'),('cbfc90310f5649a3c878aecf8b3412a5231480222f9baca0f142d6bb5b62917e1ba1f88bb7efeedc',28,1,'minhaj372@gmail.com-2021-01-05 13:03:29','[]',0,'2021-01-05 13:03:29','2021-01-05 13:03:29','2022-01-05 13:03:29'),('cd475f8c94cc79e79ec03f27050561510f3909bc405e3012b18a190dd621a363f2704f14dd7da79d',36,1,'hello@gmail.com-2020-12-31 10:08:10','[]',0,'2020-12-31 10:08:10','2020-12-31 10:08:10','2021-12-31 10:08:10'),('d024c7fa414a3437271ae0522e574c5c7f63b1a2e610f53fed049d7fc3d8677f439b529b96fd7a8e',27,1,'01764649486-2020-10-20 15:27:59','[]',0,'2020-10-20 15:27:59','2020-10-20 15:27:59','2021-10-20 15:27:59'),('d0fccdfe0fe09e4b7986318b6b8ddb224831be89ee32459c9075d2b534fe76f8f479f3e1a032e0a1',49,1,'akashahmed59@gmail.com-2021-01-05 06:49:28','[]',0,'2021-01-05 06:49:28','2021-01-05 06:49:28','2022-01-05 06:49:28'),('d1510ddd1ea5d5091eeaee614da25d6067d0e5f05d34f763869c0be990dc462b21efb0aa52d8265e',53,1,'01746603777-2021-01-11 04:45:25','[]',0,'2021-01-11 04:45:25','2021-01-11 04:45:25','2022-01-11 04:45:25'),('d289fa7a318f5cfe684c9cf623aaf931b0edc17ce7fe165de71902257fce1a5adb6da5f8ac2c44cc',27,1,'01764649486-2020-12-22 11:51:50','[]',0,'2020-12-22 11:51:50','2020-12-22 11:51:50','2021-12-22 11:51:50'),('d292062db906b142dc73996a13235aa542521f24ef2c8e7d50a33827bd4b13b6ff288f23b389e25d',17,1,'01789928288-2020-09-13 11:14:46','[]',0,'2020-09-13 11:14:46','2020-09-13 11:14:46','2021-09-13 11:14:46'),('d6c2307f695e82e2e3c95659ad07e5b8ad29f5c0cedf3bf7b5af3f41f3a422644ea24733b2d2c843',53,1,'01746603777-2021-01-12 04:40:33','[]',0,'2021-01-12 04:40:33','2021-01-12 04:40:33','2022-01-12 04:40:33'),('db4b3de79302e5bf249ebd99018505ca32f70e2e178ad3f9155685dac8019b9988d87da8f09c34e1',27,1,'ucchash@augnitive.com-2020-10-12 07:19:19','[]',0,'2020-10-12 07:19:19','2020-10-12 07:19:19','2021-10-12 07:19:19'),('dccdd926bfe79ac00e05d139f1000cafb37c8cc5375b140581420aa9baa7dd88cb0d4cddc6c4fc0e',27,1,'01764649486-2020-12-23 08:43:01','[]',0,'2020-12-23 08:43:01','2020-12-23 08:43:01','2021-12-23 08:43:01'),('dcf648a64c6825f1c35a46bf7ab57a07e87fc9810509e5bad34e441c30b9650b49bbed133b885546',28,1,'minhaj372@gmail.com-2021-01-13 12:27:13','[]',0,'2021-01-13 12:27:13','2021-01-13 12:27:13','2022-01-13 12:27:13'),('dd5f3c79aea66a12fd5fdfe273a6be428256fab8ff8781083bffb7af74d7dab1a92684477b2cf291',51,1,'minh1@mail.com-2021-01-06 04:22:30','[]',0,'2021-01-06 04:22:30','2021-01-06 04:22:30','2022-01-06 04:22:30'),('e1e9870bc57746db9d43568f5f4b4f17c61ffec4ebd0b9582a77158194fbf7268f7674b2828ddcaa',8,1,'01999999999-2020-09-09 13:23:07','[]',0,'2020-09-09 13:23:07','2020-09-09 13:23:07','2021-09-09 13:23:07'),('e48690412654e5c4927a1e6f4d396bc459c7250a39066c6666625f12c48b87c28180bbbc503dd9ae',69,1,'01970703837-2021-01-13 13:51:55','[]',0,'2021-01-13 13:51:55','2021-01-13 13:51:55','2022-01-13 13:51:55'),('eb3e21ac1884405165da95f0952cfab347a5ff2bb7417eb7db3b33006e135c6af56d57c7901bfff2',20,1,'01238383838-2020-09-13 12:08:19','[]',0,'2020-09-13 12:08:19','2020-09-13 12:08:19','2021-09-13 12:08:19'),('ebf930db245127e37a2f3672649bdcfc9c5234ed15e13ba45dc15ba755513385b6ea18d1680d9307',31,1,'01919989887-2020-12-19 12:59:38','[]',0,'2020-12-19 12:59:38','2020-12-19 12:59:38','2021-12-19 12:59:38'),('ec1bc2127d71e8c0dcbe042f4e0391843221f8e2efd42bc843ff6fc825d50fbc290375d475b79fb2',46,1,'hi@gmail.com-2021-01-05 04:12:50','[]',0,'2021-01-05 04:12:50','2021-01-05 04:12:50','2022-01-05 04:12:50'),('edd0341a527771a8fc4e76ae5e463cdbb063451df29f24a9ff8f30866cd08a3ec843d05a7ebc30aa',28,1,'01825586090-2020-12-21 11:40:13','[]',0,'2020-12-21 11:40:13','2020-12-21 11:40:13','2021-12-21 11:40:13'),('f361267a25abca895daf99af138a5607ec07aef65c02e9622a7fe85268497574aad4197a72f9b653',27,1,'ucchash@augnitive.com-2020-10-12 07:17:31','[]',0,'2020-10-12 07:17:31','2020-10-12 07:17:31','2021-10-12 07:17:31'),('f4dcd57d1de1ad511bd041065f32d054cc3cddbac0bc09fb9ab2596b6a1c70c3c16539e01a1c599f',13,1,'01770703838-2021-01-07 10:07:37','[]',0,'2021-01-07 10:07:37','2021-01-07 10:07:37','2022-01-07 10:07:37'),('f6c4bea071055f6353a53ef9f181319030d5c6afb103e2589e5d52638a19163d424df500fb82a3ce',13,1,'01770703838-2020-09-15 07:00:57','[]',0,'2020-09-15 07:00:57','2020-09-15 07:00:57','2021-09-15 07:00:57'),('f7664b830a5b2f38df81548f2926a4fd70df3cf37a177bf7cff1bde3a25bbeac0aa56670f1b2e6cd',2,1,'01799837377-2020-09-09 11:35:11','[]',0,'2020-09-09 11:35:11','2020-09-09 11:35:11','2021-09-09 11:35:11'),('fa42200e3e3083a5c88e7e31b372ec7ab5632ea02e88b361892cdebd4c1e206a52f1010287fa1ccb',47,1,'jfeh@gmail.com-2021-01-05 04:13:23','[]',0,'2021-01-05 04:13:23','2021-01-05 04:13:23','2022-01-05 04:13:23'),('fdcee606656e9072b86103795e1eecd8fab8560466e00ac3e4aa71a9e2cb6063ebf8c572f17433a3',26,1,'01788938383-2020-09-16 04:30:41','[]',0,'2020-09-16 04:30:41','2020-09-16 04:30:41','2021-09-16 04:30:41'),('fe79f2502ab24d8b83af9f019732b9f0e097e5718d170367613716545fc9ef70c09bbc7c729c6893',4,1,'01521466101-2020-12-27 09:59:22','[]',0,'2020-12-27 09:59:22','2020-12-27 09:59:22','2021-12-27 09:59:22');
/*!40000 ALTER TABLE `oauth_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_auth_codes`
--

DROP TABLE IF EXISTS `oauth_auth_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_auth_codes_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_auth_codes`
--

LOCK TABLES `oauth_auth_codes` WRITE;
/*!40000 ALTER TABLE `oauth_auth_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_auth_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_clients`
--

DROP TABLE IF EXISTS `oauth_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_clients`
--

LOCK TABLES `oauth_clients` WRITE;
/*!40000 ALTER TABLE `oauth_clients` DISABLE KEYS */;
INSERT INTO `oauth_clients` VALUES (1,NULL,'Laravel Personal Access Client','QwHCXPEmZ30baFwHZ5diccKo65GGulQDAU0rpVYv','http://localhost',1,0,0,'2020-09-09 10:37:33','2020-09-09 10:37:33'),(2,NULL,'Laravel Password Grant Client','YLcvo5iiUyfYS9ai8JvBhT3XdVhJNVtoRF3vadso','http://localhost',0,1,0,'2020-09-09 10:37:33','2020-09-09 10:37:33');
/*!40000 ALTER TABLE `oauth_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_personal_access_clients`
--

DROP TABLE IF EXISTS `oauth_personal_access_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_personal_access_clients`
--

LOCK TABLES `oauth_personal_access_clients` WRITE;
/*!40000 ALTER TABLE `oauth_personal_access_clients` DISABLE KEYS */;
INSERT INTO `oauth_personal_access_clients` VALUES (1,1,'2020-09-09 10:37:33','2020-09-09 10:37:33');
/*!40000 ALTER TABLE `oauth_personal_access_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_refresh_tokens`
--

DROP TABLE IF EXISTS `oauth_refresh_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_refresh_tokens`
--

LOCK TABLES `oauth_refresh_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_refresh_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_refresh_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `one_time_passwords`
--

DROP TABLE IF EXISTS `one_time_passwords`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `one_time_passwords` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `otp` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=205 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `one_time_passwords`
--

LOCK TABLES `one_time_passwords` WRITE;
/*!40000 ALTER TABLE `one_time_passwords` DISABLE KEYS */;
INSERT INTO `one_time_passwords` VALUES (1,'01183888876',119716,'2020-09-09 11:32:57','2020-09-09 11:32:57'),(2,'01799837377',619622,'2020-09-09 11:34:50','2020-09-09 11:34:50'),(3,'01982828822',250945,'2020-09-09 11:49:23','2020-09-09 11:49:23'),(4,'01521466101',564015,'2020-09-09 11:54:51','2020-09-09 11:54:51'),(5,'01717739179',336060,'2020-09-09 12:01:36','2020-09-09 12:01:36'),(6,'01373737777',359878,'2020-09-09 12:28:51','2020-09-09 12:28:51'),(7,'01232283282',577027,'2020-09-09 12:32:53','2020-09-09 12:32:53'),(8,'01521466101',907861,'2020-09-09 12:35:49','2020-09-09 12:35:49'),(9,'01999999999',417432,'2020-09-09 13:22:50','2020-09-09 13:22:50'),(10,'01899999999',299193,'2020-09-10 04:17:48','2020-09-10 04:17:48'),(11,'01681654863',626798,'2020-09-10 06:48:48','2020-09-10 06:48:48'),(12,'01521486543',910325,'2020-09-10 06:49:43','2020-09-10 06:49:43'),(13,'01992929292',532998,'2020-09-10 09:59:49','2020-09-10 09:59:49'),(14,'01779299999',230113,'2020-09-10 10:08:47','2020-09-10 10:08:47'),(15,'01770703838',205584,'2020-09-12 12:09:59','2020-09-12 12:09:59'),(16,'01770703838',610200,'2020-09-13 04:34:56','2020-09-13 04:34:56'),(17,'01770703838',439315,'2020-09-13 04:37:27','2020-09-13 04:37:27'),(18,'01770703838',732112,'2020-09-13 04:39:47','2020-09-13 04:39:47'),(19,'01770703838',262014,'2020-09-13 04:43:42','2020-09-13 04:43:42'),(20,'01770703838',868491,'2020-09-13 04:50:11','2020-09-13 04:50:11'),(21,'01783737457',235443,'2020-09-13 04:51:49','2020-09-13 04:51:49'),(22,'01838383888',752976,'2020-09-13 05:02:55','2020-09-13 05:02:55'),(23,'01838383888',107293,'2020-09-13 05:06:41','2020-09-13 05:06:41'),(24,'01937737373',505078,'2020-09-13 05:09:25','2020-09-13 05:09:25'),(25,'01825586090',199480,'2020-09-13 05:16:40','2020-09-13 05:16:40'),(26,'01825586090',995901,'2020-09-13 05:17:48','2020-09-13 05:17:48'),(27,'01825586090',891871,'2020-09-13 05:18:18','2020-09-13 05:18:18'),(28,'01825586090',578683,'2020-09-13 05:21:14','2020-09-13 05:21:14'),(29,'01825586090',106565,'2020-09-13 05:41:51','2020-09-13 05:41:51'),(30,'01789928288',601812,'2020-09-13 11:14:26','2020-09-13 11:14:26'),(31,'01521324269',207263,'2020-09-13 11:21:15','2020-09-13 11:21:15'),(32,'01976756556',916656,'2020-09-13 11:41:12','2020-09-13 11:41:12'),(33,'01770703838',101885,'2020-09-13 11:57:08','2020-09-13 11:57:08'),(34,'01789928288',316630,'2020-09-13 12:03:55','2020-09-13 12:03:55'),(35,'01937737373',952439,'2020-09-13 12:04:41','2020-09-13 12:04:41'),(36,'01238383838',126763,'2020-09-13 12:08:05','2020-09-13 12:08:05'),(37,'01976756556',802238,'2020-09-13 12:12:12','2020-09-13 12:12:12'),(38,'01988888888',905087,'2020-09-13 12:13:21','2020-09-13 12:13:21'),(39,'01888888888',489853,'2020-09-14 05:18:09','2020-09-14 05:18:09'),(40,'01838383838',533460,'2020-09-14 05:20:29','2020-09-14 05:20:29'),(41,'01838383838',945738,'2020-09-14 05:27:03','2020-09-14 05:27:03'),(42,'01988888366',376289,'2020-09-14 05:28:48','2020-09-14 05:28:48'),(43,'01770703838',150828,'2020-09-14 05:29:30','2020-09-14 05:29:30'),(44,'01222222222',645790,'2020-09-14 05:36:49','2020-09-14 05:36:49'),(45,'01770703838',906563,'2020-09-14 08:50:29','2020-09-14 08:50:29'),(46,'01937737373',574395,'2020-09-14 09:05:38','2020-09-14 09:05:38'),(47,'01778888883',237877,'2020-09-14 09:06:28','2020-09-14 09:06:28'),(48,'01746464446',669145,'2020-09-14 09:06:47','2020-09-14 09:06:47'),(49,'01770703838',830443,'2020-09-15 07:00:46','2020-09-15 07:00:46'),(50,'01999999999',485120,'2020-09-15 07:04:02','2020-09-15 07:04:02'),(51,'01764649486',768615,'2020-09-15 10:15:10','2020-09-15 10:15:10'),(52,'01764649486',703675,'2020-09-15 10:15:42','2020-09-15 10:15:42'),(53,'01764649486',236509,'2020-09-15 10:16:21','2020-09-15 10:16:21'),(54,'01686406730',168533,'2020-09-15 10:16:58','2020-09-15 10:16:58'),(55,'01788938383',530813,'2020-09-16 04:30:21','2020-09-16 04:30:21'),(56,'01788938383',795001,'2020-09-16 04:34:43','2020-09-16 04:34:43'),(57,'01788938383',120458,'2020-09-16 04:39:53','2020-09-16 04:39:53'),(58,'01686406730',165561,'2020-10-11 06:44:44','2020-10-11 06:44:44'),(59,'01764649486',651168,'2020-10-12 06:34:54','2020-10-12 06:34:54'),(60,'01764649486',970846,'2020-10-12 06:35:13','2020-10-12 06:35:13'),(61,'01764649486',730112,'2020-10-12 06:37:16','2020-10-12 06:37:16'),(62,'01764649486',283028,'2020-10-12 07:02:27','2020-10-12 07:02:27'),(63,'01764649486',229422,'2020-10-12 07:02:49','2020-10-12 07:02:49'),(64,'01764649486',508969,'2020-10-12 07:03:24','2020-10-12 07:03:24'),(65,'01764649486',268933,'2020-10-12 07:20:47','2020-10-12 07:20:47'),(66,'01764649486',471688,'2020-10-12 07:21:08','2020-10-12 07:21:08'),(67,'01764649486',860080,'2020-10-12 07:21:35','2020-10-12 07:21:35'),(68,'01764649486',282753,'2020-10-12 07:23:38','2020-10-12 07:23:38'),(69,'01825586090',508907,'2020-10-19 07:14:30','2020-10-19 07:14:30'),(70,'01764649486',556975,'2020-10-19 07:17:11','2020-10-19 07:17:11'),(71,'01764649486',700951,'2020-10-20 15:27:37','2020-10-20 15:27:37'),(72,'01764649486',242042,'2020-10-22 10:56:26','2020-10-22 10:56:26'),(73,'01686406730',901000,'2020-10-22 10:59:42','2020-10-22 10:59:42'),(74,'01770703838',400357,'2020-12-07 09:11:28','2020-12-07 09:11:28'),(75,'01825586090',371392,'2020-12-14 04:43:13','2020-12-14 04:43:13'),(76,'01919989876',167490,'2020-12-19 06:03:07','2020-12-19 06:03:07'),(77,'01770703838',880879,'2020-12-19 06:23:42','2020-12-19 06:23:42'),(78,'01919989876',678774,'2020-12-19 07:13:39','2020-12-19 07:13:39'),(79,'01919989887',431679,'2020-12-19 11:42:26','2020-12-19 11:42:26'),(80,'01919989886',989134,'2020-12-19 12:37:17','2020-12-19 12:37:17'),(81,'01521466101',602227,'2020-12-19 12:43:46','2020-12-19 12:43:46'),(82,'01919989887',715579,'2020-12-19 12:58:59','2020-12-19 12:58:59'),(83,'01770703838',455623,'2020-12-20 04:36:06','2020-12-20 04:36:06'),(84,'01983838388',164969,'2020-12-20 04:53:49','2020-12-20 04:53:49'),(85,'01825586090',500049,'2020-12-20 13:33:19','2020-12-20 13:33:19'),(86,'01825586090',543352,'2020-12-21 11:39:36','2020-12-21 11:39:36'),(87,'01764649486',602361,'2020-12-22 05:09:38','2020-12-22 05:09:38'),(88,'01833353524',825461,'2020-12-22 05:15:26','2020-12-22 05:15:26'),(89,'01686406730',465700,'2020-12-22 06:50:16','2020-12-22 06:50:16'),(90,'01825586090',555549,'2020-12-22 10:33:58','2020-12-22 10:33:58'),(91,'01764649486',511000,'2020-12-22 10:36:36','2020-12-22 10:36:36'),(92,'01686406730',430278,'2020-12-22 10:37:14','2020-12-22 10:37:14'),(93,'01825586090',491512,'2020-12-22 10:40:11','2020-12-22 10:40:11'),(94,'01764649486',254218,'2020-12-22 11:07:00','2020-12-22 11:07:00'),(95,'01764649486',854058,'2020-12-22 11:13:00','2020-12-22 11:13:00'),(96,'01825586090',379135,'2020-12-22 11:16:41','2020-12-22 11:16:41'),(97,'01764649486',668405,'2020-12-22 11:19:19','2020-12-22 11:19:19'),(98,'01764649486',157858,'2020-12-22 11:31:26','2020-12-22 11:31:26'),(99,'01764649486',894625,'2020-12-22 11:40:56','2020-12-22 11:40:56'),(100,'01764649486',268751,'2020-12-22 11:50:41','2020-12-22 11:50:41'),(101,'01764649486',100532,'2020-12-22 11:54:05','2020-12-22 11:54:05'),(102,'01764649486',422627,'2020-12-22 11:57:02','2020-12-22 11:57:02'),(103,'01764649486',931495,'2020-12-22 12:00:28','2020-12-22 12:00:28'),(104,'01825586090',693888,'2020-12-22 12:16:29','2020-12-22 12:16:29'),(105,'01825586090',830233,'2020-12-22 12:16:49','2020-12-22 12:16:49'),(106,'01825586090',108774,'2020-12-22 12:16:51','2020-12-22 12:16:51'),(107,'01825586090',699581,'2020-12-22 12:17:05','2020-12-22 12:17:05'),(108,'01825586090',360546,'2020-12-22 12:17:06','2020-12-22 12:17:06'),(109,'01825586090',167203,'2020-12-22 12:17:07','2020-12-22 12:17:07'),(110,'01825586090',340956,'2020-12-22 12:17:08','2020-12-22 12:17:08'),(111,'01825586090',645199,'2020-12-22 12:17:09','2020-12-22 12:17:09'),(112,'01825586090',890845,'2020-12-22 12:17:11','2020-12-22 12:17:11'),(113,'01825586090',237053,'2020-12-22 12:17:13','2020-12-22 12:17:13'),(114,'01911358926',976162,'2020-12-22 12:21:55','2020-12-22 12:21:55'),(115,'01000000000',951692,'2020-12-22 13:07:38','2020-12-22 13:07:38'),(116,'01909090909',945645,'2020-12-22 13:33:47','2020-12-22 13:33:47'),(117,'01825586090',174460,'2020-12-23 05:12:33','2020-12-23 05:12:33'),(118,'01716560946',891514,'2020-12-23 05:41:36','2020-12-23 05:41:36'),(119,'01764649486',946345,'2020-12-23 05:56:42','2020-12-23 05:56:42'),(120,'01764649486',161000,'2020-12-23 06:16:49','2020-12-23 06:16:49'),(121,'01825586090',393490,'2020-12-23 06:19:38','2020-12-23 06:19:38'),(122,'01764649486',358580,'2020-12-23 06:32:38','2020-12-23 06:32:38'),(123,'01764649486',772062,'2020-12-23 06:50:02','2020-12-23 06:50:02'),(124,'01764649486',929602,'2020-12-23 07:25:07','2020-12-23 07:25:07'),(125,'01764649486',456383,'2020-12-23 08:24:23','2020-12-23 08:24:23'),(126,'01764649486',270242,'2020-12-23 08:32:08','2020-12-23 08:32:08'),(127,'01764649486',458796,'2020-12-23 08:33:43','2020-12-23 08:33:43'),(128,'01764649486',230576,'2020-12-23 08:34:05','2020-12-23 08:34:05'),(129,'01825586090',200934,'2020-12-23 08:41:23','2020-12-23 08:41:23'),(130,'01764649486',773628,'2020-12-23 08:41:59','2020-12-23 08:41:59'),(131,'01764649486',363993,'2020-12-23 08:42:10','2020-12-23 08:42:10'),(132,'01764649486',629782,'2020-12-23 08:42:14','2020-12-23 08:42:14'),(133,'01686406730',408333,'2020-12-23 08:43:12','2020-12-23 08:43:12'),(134,'01825586090',122313,'2020-12-23 08:44:33','2020-12-23 08:44:33'),(135,'01825586090',183737,'2020-12-23 08:44:53','2020-12-23 08:44:53'),(136,'01825586090',849462,'2020-12-23 08:52:33','2020-12-23 08:52:33'),(137,'01825586090',225209,'2020-12-23 08:53:31','2020-12-23 08:53:31'),(138,'01764649486',212745,'2020-12-23 09:00:27','2020-12-23 09:00:27'),(139,'01764649486',822927,'2020-12-23 09:00:53','2020-12-23 09:00:53'),(140,'01764649486',162600,'2020-12-23 09:01:22','2020-12-23 09:01:22'),(141,'01825586090',968277,'2020-12-23 09:04:51','2020-12-23 09:04:51'),(142,'01828272727',262778,'2020-12-23 09:06:26','2020-12-23 09:06:26'),(143,'01825586090',758627,'2020-12-27 07:46:21','2020-12-27 07:46:21'),(144,'01825586090',677902,'2020-12-27 08:27:23','2020-12-27 08:27:23'),(145,'01825586090',640711,'2020-12-27 08:53:50','2020-12-27 08:53:50'),(146,'01521466101',699382,'2020-12-27 08:54:53','2020-12-27 08:54:53'),(147,'01667554534',780825,'2020-12-27 08:54:56','2020-12-27 08:54:56'),(148,'01667554534',639067,'2020-12-27 08:55:31','2020-12-27 08:55:31'),(149,'01928636354',923750,'2020-12-27 08:58:07','2020-12-27 08:58:07'),(150,'01521466101',112422,'2020-12-27 09:22:45','2020-12-27 09:22:45'),(151,'01833353524',527671,'2020-12-27 09:45:05','2020-12-27 09:45:05'),(152,'01521466101',465183,'2020-12-27 09:59:05','2020-12-27 09:59:05'),(153,'01770703838',283604,'2020-12-27 09:59:55','2020-12-27 09:59:55'),(154,'01764649486',260984,'2020-12-27 10:13:37','2020-12-27 10:13:37'),(155,'01837376363',757186,'2020-12-27 10:37:04','2020-12-27 10:37:04'),(156,'01770703838',594379,'2020-12-28 04:44:30','2020-12-28 04:44:30'),(157,'01770703838',468397,'2020-12-28 05:57:14','2020-12-28 05:57:14'),(158,'01010101010',612333,'2020-12-28 09:51:53','2020-12-28 09:51:53'),(159,'01770703838',341243,'2020-12-29 07:23:26','2020-12-29 07:23:26'),(160,'01825586090',935994,'2020-12-29 08:54:24','2020-12-29 08:54:24'),(161,'01929292728',584057,'2020-12-30 10:49:21','2020-12-30 10:49:21'),(162,'01909090909',569076,'2020-12-30 12:23:50','2020-12-30 12:23:50'),(163,'01825586090',566016,'2020-12-30 12:28:29','2020-12-30 12:28:29'),(164,'01826354353',423428,'2020-12-31 04:42:22','2020-12-31 04:42:22'),(165,'01770703838',382282,'2020-12-31 09:00:26','2020-12-31 09:00:26'),(166,'01770703838',341143,'2020-12-31 09:02:45','2020-12-31 09:02:45'),(167,'01825432224',513179,'2021-01-03 11:19:44','2021-01-03 11:19:44'),(168,'01333333333',742202,'2021-01-04 04:40:31','2021-01-04 04:40:31'),(169,'01970703838',157491,'2021-01-04 09:21:11','2021-01-04 09:21:11'),(170,'01825586090',559158,'2021-01-04 10:06:21','2021-01-04 10:06:21'),(171,'01764649486',415885,'2021-01-05 08:24:05','2021-01-05 08:24:05'),(172,'01825586090',209308,'2021-01-05 13:03:00','2021-01-05 13:03:00'),(173,'01770703838',812293,'2021-01-06 08:40:18','2021-01-06 08:40:18'),(174,'01783730044',961366,'2021-01-06 10:59:05','2021-01-06 10:59:05'),(175,'01521224333',824949,'2021-01-06 11:01:23','2021-01-06 11:01:23'),(176,'01770703838',975022,'2021-01-06 11:43:18','2021-01-06 11:43:18'),(177,'01770703838',102960,'2021-01-06 12:25:27','2021-01-06 12:25:27'),(178,'01746603777',698761,'2021-01-07 05:47:37','2021-01-07 05:47:37'),(179,'01467767676',686513,'2021-01-07 08:35:55','2021-01-07 08:35:55'),(180,'01928238388',288429,'2021-01-07 08:39:50','2021-01-07 08:39:50'),(181,'01770703838',418548,'2021-01-07 10:07:19','2021-01-07 10:07:19'),(182,'01764649486',492392,'2021-01-10 07:22:45','2021-01-10 07:22:45'),(183,'01746603777',736681,'2021-01-11 04:45:07','2021-01-11 04:45:07'),(184,'01746603777',735521,'2021-01-12 04:37:21','2021-01-12 04:37:21'),(185,'01746603777',636581,'2021-01-12 04:42:25','2021-01-12 04:42:25'),(186,'01746603777',717059,'2021-01-12 05:26:42','2021-01-12 05:26:42'),(187,'01746603776',573300,'2021-01-12 05:40:22','2021-01-12 05:40:22'),(188,'01770703737',854917,'2021-01-12 06:54:21','2021-01-12 06:54:21'),(189,'01770703737',218467,'2021-01-12 06:57:19','2021-01-12 06:57:19'),(190,'01770703737',439905,'2021-01-12 06:57:23','2021-01-12 06:57:23'),(191,'01825586090',353003,'2021-01-12 07:02:16','2021-01-12 07:02:16'),(192,'01770703737',561218,'2021-01-12 07:19:00','2021-01-12 07:19:00'),(193,'01111111110',885008,'2021-01-12 08:15:43','2021-01-12 08:15:43'),(194,'01825586090',838018,'2021-01-12 08:22:23','2021-01-12 08:22:23'),(195,'01919191919',265348,'2021-01-12 08:22:42','2021-01-12 08:22:42'),(196,'01770703837',354659,'2021-01-12 11:02:06','2021-01-12 11:02:06'),(197,'01770703737',779423,'2021-01-12 11:04:25','2021-01-12 11:04:25'),(198,'01770703737',678888,'2021-01-12 11:11:43','2021-01-12 11:11:43'),(199,'01770703737',897951,'2021-01-12 12:04:21','2021-01-12 12:04:21'),(200,'01766566556',892373,'2021-01-13 05:16:47','2021-01-13 05:16:47'),(201,'01833353508',512206,'2021-01-13 08:51:57','2021-01-13 08:51:57'),(202,'01909099900',347143,'2021-01-13 12:18:27','2021-01-13 12:18:27'),(203,'01782828384',540865,'2021-01-13 13:44:12','2021-01-13 13:44:12'),(204,'01970703837',220870,'2021-01-13 13:51:17','2021-01-13 13:51:17');
/*!40000 ALTER TABLE `one_time_passwords` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,'Bughub','Bughub@gmail.com','01783737457','350','Ansarcamp','Pending','5f5da6aeef8d5','BDT','2020-09-13 04:57:18',NULL),(2,'Webhub','Webhub@gmail.com','01937737373','200','Ansarcamp','Pending','5f5daa70ef5de','BDT','2020-09-13 05:13:20',NULL),(3,'Webhub','Webhub@gmail.com','01937737373','200','Ansarcamp','Pending','5f5daa7820b34','BDT','2020-09-13 05:13:28',NULL),(4,'Webhub','Webhub@gmail.com','01937737373','200','Ansarcamp','Pending','5f5daa871d6cb','BDT','2020-09-13 05:13:43',NULL),(5,'Webhub','Webhub@gmail.com','01937737373','200','Ansarcamp','Pending','5f5daa9c174ac','BDT','2020-09-13 05:14:04',NULL),(6,'Webhub','Webhub@gmail.com','01937737373','200','Ansarcamp','Pending','5f5daaaddd3f1','BDT','2020-09-13 05:14:21',NULL),(7,'Rent','Rent@gmail.com','01789928288','200','Ansarcamp','Pending','5f5e04993b2cd','BDT','2020-09-13 11:38:01',NULL),(8,'Rent','Rent@gmail.com','01789928288','200','Ansarcamp','Pending','5f5e049d9a803','BDT','2020-09-13 11:38:05',NULL),(9,'Jossbd','Jossbd@gmail.com','01976756556','0','Ansarcamp','Pending','5f5e06452d62e','BDT','2020-09-13 11:45:09',NULL),(10,'LaLaa','LaLaa@gmail.com','01788938383','610','Ansarcamp, Mirpur','Pending','5f6199ba8577d','BDT','2020-09-16 04:51:06',NULL),(11,'LaLaa','LaLaa@gmail.com','01788938383','610','Ansarcamp, Mirpur','Pending','5f6199c8e4ed7','BDT','2020-09-16 04:51:20',NULL);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `otp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` VALUES ('koushik@gmail.com','212749','2020-12-28 09:33:26');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'add game','web','2020-09-09 10:37:23','2020-09-09 10:37:23'),(2,'update game','web','2020-09-09 10:37:23','2020-09-09 10:37:23'),(3,'delete game','web','2020-09-09 10:37:23','2020-09-09 10:37:23');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `platforms`
--

DROP TABLE IF EXISTS `platforms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `platforms` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `platforms`
--

LOCK TABLES `platforms` WRITE;
/*!40000 ALTER TABLE `platforms` DISABLE KEYS */;
INSERT INTO `platforms` VALUES (3,1,'PS4','ps4','storage/platform-image/platform1610257673.svg',1,'2020-09-09 11:45:49','2021-01-10 05:47:53'),(4,1,'NINTENDO','nintendo','storage/platform-image/platform1608442920.svg',1,'2020-09-09 11:46:01','2020-12-20 05:42:00'),(5,1,'XBOX','xbox','storage/platform-image/platform1608442912.svg',1,'2020-09-09 11:46:15','2020-12-20 05:41:52'),(6,1,'WINDOWS','windows','storage/platform-image/platform1608442950.svg',1,'2020-12-20 05:42:30','2020-12-20 05:42:30');
/*!40000 ALTER TABLE `platforms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rents`
--

DROP TABLE IF EXISTS `rents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rents` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `game_id` bigint(20) unsigned NOT NULL,
  `availability` date NOT NULL,
  `max_week` int(11) NOT NULL,
  `platform_id` int(10) unsigned NOT NULL,
  `checkpoint_id` bigint(20) unsigned DEFAULT NULL,
  `earning_amount` decimal(8,2) DEFAULT NULL,
  `disk_condition_id` int(10) unsigned NOT NULL,
  `cover_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rented_user_id` bigint(20) unsigned DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `reason` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rents_user_id_foreign` (`user_id`),
  KEY `rents_game_id_foreign` (`game_id`),
  KEY `rents_rented_user_id_foreign` (`rented_user_id`),
  CONSTRAINT `rents_game_id_foreign` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE,
  CONSTRAINT `rents_rented_user_id_foreign` FOREIGN KEY (`rented_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `rents_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rents`
--

LOCK TABLES `rents` WRITE;
/*!40000 ALTER TABLE `rents` DISABLE KEYS */;
INSERT INTO `rents` VALUES (1,4,2,'2020-09-24',5,3,NULL,NULL,1,'cover_1599652831_2.jpeg','disk_1599652831_2.jpeg',5,0,'nop','2020-12-27 08:22:02','2020-09-09 12:00:31','2020-12-27 08:22:02'),(2,3,2,'2020-09-12',4,3,NULL,NULL,2,'cover_1599653016_2.png','disk_1599653016_2.png',7,0,'nop','2020-12-27 08:22:14','2020-09-09 12:03:36','2020-12-27 08:22:14'),(3,4,4,'2020-09-30',5,3,NULL,NULL,3,'cover_1599655159_4.jpeg','disk_1599655159_4.jpeg',8,1,NULL,'2020-12-27 08:21:32','2020-09-09 12:39:19','2020-12-27 08:21:32'),(4,7,1,'2020-09-15',3,3,NULL,NULL,1,'cover_1599657618_1.webp','disk_1599657618_1.webp',11,1,NULL,'2020-12-27 08:22:24','2020-09-09 13:20:18','2020-12-27 08:22:24'),(5,8,3,'2020-09-13',4,4,NULL,NULL,3,'cover_1599658205_3.jpeg','disk_1599658205_3.jpeg',9,1,NULL,'2020-12-27 08:22:38','2020-09-09 13:30:05','2020-12-27 08:22:38'),(6,8,4,'2020-09-12',3,3,NULL,NULL,3,'cover_1599658331_4.jpeg','disk_1599658331_4.jpeg',13,1,NULL,'2020-12-27 08:23:28','2020-09-09 13:32:11','2020-12-27 08:23:28'),(7,11,3,'2020-09-14',3,4,1,NULL,1,'cover_1599732128_3.jpeg','disk_1599732128_3.jpeg',NULL,1,NULL,'2020-09-10 10:03:39','2020-09-10 10:02:08','2020-09-10 10:03:39'),(8,11,3,'2020-09-11',3,4,1,NULL,1,'cover_1599732301_3.jpeg','disk_1599732301_3.jpeg',14,1,NULL,'2020-12-27 08:23:44','2020-09-10 10:05:01','2020-12-27 08:23:44'),(9,13,1,'2020-09-16',3,3,NULL,NULL,3,'cover_1599972366_1.png','disk_1599972366_1.png',24,1,NULL,'2020-12-27 08:24:53','2020-09-13 04:46:06','2020-12-27 08:24:53'),(10,15,2,'2020-09-20',2,3,NULL,NULL,1,'cover_1599973677_2.jpeg','disk_1599973677_2.jpeg',16,1,NULL,'2020-12-27 08:25:04','2020-09-13 05:07:57','2020-12-27 08:25:04'),(11,16,8,'2020-09-17',2,4,1,NULL,1,'cover_1599974424_3.png','disk_1599974424_3.png',19,1,'expired',NULL,'2020-09-13 05:20:24','2021-01-12 07:08:15'),(12,16,4,'2020-09-15',2,3,NULL,NULL,1,'cover_1599978521_4.jpeg','disk_1599978521_4.jpeg',17,1,NULL,'2020-12-27 08:25:16','2020-09-13 06:28:42','2020-12-27 08:25:16'),(13,19,7,'2020-09-16',2,3,NULL,NULL,3,'cover_1599998216_3.png','disk_1599998216_3.png',21,0,'expired',NULL,'2020-09-13 11:56:57','2020-12-27 13:09:08'),(14,24,9,'2020-09-18',3,3,1,NULL,1,'cover_1600061974_2.webp','disk_1600061974_2.webp',27,0,'expired',NULL,'2020-09-14 05:39:34','2020-12-27 13:09:24'),(15,24,8,'2020-09-19',4,3,NULL,NULL,3,'cover_1600062040_4.jpeg','disk_1600062040_4.jpeg',26,0,'Test',NULL,'2020-09-14 05:40:40','2021-01-12 06:47:53'),(16,27,7,'2020-10-30',4,3,1,NULL,1,NULL,NULL,29,0,NULL,NULL,'2020-10-22 10:58:32','2021-01-12 06:47:43'),(17,13,1,'2020-12-21',3,3,NULL,NULL,2,'cover_1608365738_1.png','disk_1608365738_1.png',NULL,1,NULL,'2020-12-27 08:25:27','2020-12-19 08:15:38','2020-12-27 08:25:27'),(18,13,1,'2020-12-23',4,3,NULL,NULL,1,'cover_1608439051_1.png','disk_1608439052_1.png',33,1,NULL,'2020-12-27 08:25:41','2020-12-20 04:37:32','2020-12-27 08:25:41'),(19,13,7,'2020-12-30',2,6,NULL,NULL,2,'cover_1609064072_7.jpeg','disk_1609064072_7.jpeg',NULL,0,NULL,NULL,'2020-12-27 10:14:32','2021-01-12 06:47:32'),(20,13,7,'2020-12-30',3,5,NULL,NULL,1,'cover_1609135263_7.png','disk_1609135264_7.png',NULL,0,NULL,NULL,'2020-12-28 06:01:04','2021-01-12 06:47:23'),(21,13,10,'2021-02-10',3,5,NULL,NULL,1,'cover_1609922688_10.png','disk_1609922688_10.png',NULL,0,NULL,NULL,'2021-01-06 08:44:48','2021-01-12 06:47:07'),(22,59,11,'2021-01-14',5,3,1,NULL,3,'cover_1610454495_11.jpeg','disk_1610454495_11.jpeg',NULL,1,NULL,NULL,'2021-01-12 12:28:15','2021-01-12 12:41:48'),(23,59,11,'2021-01-14',5,6,1,NULL,3,'cover_1610454519_11.jpeg','disk_1610454519_11.jpeg',NULL,NULL,NULL,NULL,'2021-01-12 12:28:40','2021-01-12 12:28:40'),(24,59,11,'2021-01-14',5,3,NULL,NULL,3,'cover_1610454545_11.jpeg','disk_1610454545_11.jpeg',NULL,NULL,NULL,NULL,'2021-01-12 12:29:05','2021-01-12 12:29:05'),(25,59,11,'2021-01-14',5,6,NULL,NULL,3,'cover_1610454575_11.jpeg','disk_1610454575_11.jpeg',NULL,NULL,NULL,NULL,'2021-01-12 12:29:36','2021-01-12 12:29:36');
/*!40000 ALTER TABLE `rents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reset_password_tokens`
--

DROP TABLE IF EXISTS `reset_password_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reset_password_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expires_at` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reset_password_tokens`
--

LOCK TABLES `reset_password_tokens` WRITE;
/*!40000 ALTER TABLE `reset_password_tokens` DISABLE KEYS */;
INSERT INTO `reset_password_tokens` VALUES (1,53,'b135a8a4126e6720d28aa0a5d818255317ace249708a93e95c709bb899f57119','2021-01-12 06:27:39','2021-01-12 05:27:39','2021-01-12 05:27:39',NULL),(2,53,'cddc20e575b00d63ef64265ca6d118c67751d24803a030b4fb6dee7f47fe418a','2021-01-12 06:34:34','2021-01-12 05:34:34','2021-01-12 05:39:15','2021-01-12 05:39:15'),(3,56,'dfd6313b2270c0bc05f07a506cd18b1b7890c3e24b90c5d3508be0c87f5a326e','2021-01-12 06:41:03','2021-01-12 05:41:03','2021-01-12 05:41:32','2021-01-12 05:41:32');
/*!40000 ALTER TABLE `reset_password_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES (1,1),(2,1),(3,1);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','web','2020-09-09 10:37:23','2020-09-09 10:37:23'),(2,'customer','web','2020-09-09 10:37:23','2020-09-09 10:37:23');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `screenshots`
--

DROP TABLE IF EXISTS `screenshots`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `screenshots` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `game_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `screenshots_game_id_foreign` (`game_id`),
  CONSTRAINT `screenshots_game_id_foreign` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `screenshots`
--

LOCK TABLES `screenshots` WRITE;
/*!40000 ALTER TABLE `screenshots` DISABLE KEYS */;
INSERT INTO `screenshots` VALUES (1,1,'Pubg-screenshot-1-1608720302Rent Dashboard.png','storage/game-image/Pubg-screenshot-1-1608720302Rent Dashboard.png','2020-12-23 10:45:02','2020-12-23 10:45:02'),(2,1,'Pubg-screenshot-1-1608720302User Profile - Overview.png','storage/game-image/Pubg-screenshot-1-1608720302User Profile - Overview.png','2020-12-23 10:45:02','2020-12-23 10:45:02'),(3,7,'Cyberpunk 2077-screenshot-1-1608784698Cyberpunk-2077-Voodoo-Boys-1.jpg','storage/game-image/Cyberpunk 2077-screenshot-1-1608784698Cyberpunk-2077-Voodoo-Boys-1.jpg','2020-12-24 04:38:18','2020-12-24 04:38:18'),(4,8,'Fortnite-screenshot-1-1608790295H2x1_NSwitchDS_Fortnite_Chapter2Season5_image1600w.jpg','storage/game-image/Fortnite-screenshot-1-1608790295H2x1_NSwitchDS_Fortnite_Chapter2Season5_image1600w.jpg','2020-12-24 06:11:35','2020-12-24 06:11:35'),(5,8,'Fortnite-screenshot-1-1608790295fortnite.png','storage/game-image/Fortnite-screenshot-1-1608790295fortnite.png','2020-12-24 06:11:35','2020-12-24 06:11:35'),(6,7,'Cyberpunk 2077-screenshot-1-16087920861591693643_Cyberpunk-2077-will-have-more-than-1000-NPCs-with-daily-1024x576.jpg','storage/game-image/Cyberpunk 2077-screenshot-1-16087920861591693643_Cyberpunk-2077-will-have-more-than-1000-NPCs-with-daily-1024x576.jpg','2020-12-24 06:41:26','2020-12-24 06:41:26'),(8,9,'PubG-screenshot-1-1608792501PUBG-training-mode-840x473-1.jpg','storage/game-image/PubG-screenshot-1-1608792501PUBG-training-mode-840x473-1.jpg','2020-12-24 06:48:21','2020-12-24 06:48:21'),(9,9,'PubG-screenshot-1-16087925011a3889b0-d223-11ea-88dd-6bec610be4a6_image_hires_163718.jpg','storage/game-image/PubG-screenshot-1-16087925011a3889b0-d223-11ea-88dd-6bec610be4a6_image_hires_163718.jpg','2020-12-24 06:48:21','2020-12-24 06:48:21'),(10,9,'PubG-screenshot-1-1608792501maxresdefault.jpg','storage/game-image/PubG-screenshot-1-1608792501maxresdefault.jpg','2020-12-24 06:48:21','2020-12-24 06:48:21'),(11,9,'PubG-screenshot-1-1608792501PUBG.jfif','storage/game-image/PubG-screenshot-1-1608792501PUBG.jfif','2020-12-24 06:48:21','2020-12-24 06:48:21'),(12,7,'Cyberpunk 2077-screenshot-1-1609828014Cart Page.png','storage/game-image/Cyberpunk 2077-screenshot-1-1609828014Cart Page.png','2021-01-05 06:26:54','2021-01-05 06:26:54'),(15,10,'Microsoft Flight Simulator-screenshot-1-1609922339a.PNG','storage/game-image/Microsoft Flight Simulator-screenshot-1-1609922339a.PNG','2021-01-06 08:38:59','2021-01-06 08:38:59'),(16,11,'Cyberpunk 2077-screenshot-1-1610452801cyberpunk_2077_c_2020_by_cd_projekt_red_03_12_2020_11_17_08.jpg','storage/game-image/Cyberpunk 2077-screenshot-1-1610452801cyberpunk_2077_c_2020_by_cd_projekt_red_03_12_2020_11_17_08.jpg','2021-01-12 12:00:01','2021-01-12 12:00:01'),(17,11,'Cyberpunk 2077-screenshot-1-1610452801sddefault.jpg','storage/game-image/Cyberpunk 2077-screenshot-1-1610452801sddefault.jpg','2021-01-12 12:00:01','2021-01-12 12:00:01'),(18,11,'Cyberpunk 2077-screenshot-1-1610452801cyberpunk-2077-3.jpg','storage/game-image/Cyberpunk 2077-screenshot-1-1610452801cyberpunk-2077-3.jpg','2021-01-12 12:00:01','2021-01-12 12:00:01'),(19,11,'Cyberpunk 2077-screenshot-1-1610452801cyberpunk_2077_map_is_denser_than_the_witcher_3_wild_hunt_gaming_instincts_tv_article_website_youtube_thumbnail.jpg','storage/game-image/Cyberpunk 2077-screenshot-1-1610452801cyberpunk_2077_map_is_denser_than_the_witcher_3_wild_hunt_gaming_instincts_tv_article_website_youtube_thumbnail.jpg','2021-01-12 12:00:01','2021-01-12 12:00:01'),(21,12,'PlayerUnknown\'s Battlegrounds-screenshot-1-1610534554dims.jpg','storage/game-image/PlayerUnknown\'s Battlegrounds-screenshot-1-1610534554dims.jpg','2021-01-13 10:42:34','2021-01-13 10:42:34'),(22,12,'PlayerUnknown\'s Battlegrounds-screenshot-1-1610534554pubg-sur.jpg','storage/game-image/PlayerUnknown\'s Battlegrounds-screenshot-1-1610534554pubg-sur.jpg','2021-01-13 10:42:34','2021-01-13 10:42:34'),(23,12,'PlayerUnknown\'s Battlegrounds-screenshot-1-1610534554pubg-mobile-xda-uaz-1024x473.jpg','storage/game-image/PlayerUnknown\'s Battlegrounds-screenshot-1-1610534554pubg-mobile-xda-uaz-1024x473.jpg','2021-01-13 10:42:34','2021-01-13 10:42:34'),(24,12,'PlayerUnknown\'s Battlegrounds-screenshot-1-1610534554PubG-Game-1.webp','storage/game-image/PlayerUnknown\'s Battlegrounds-screenshot-1-1610534554PubG-Game-1.webp','2021-01-13 10:42:34','2021-01-13 10:42:34'),(25,13,'FIFA 21-screenshot-1-1610542167fifa.jpg','storage/game-image/FIFA 21-screenshot-1-1610542167fifa.jpg','2021-01-13 12:49:27','2021-01-13 12:49:27'),(26,13,'FIFA 21-screenshot-1-1610542167fifa-theme-um10.jpg','storage/game-image/FIFA 21-screenshot-1-1610542167fifa-theme-um10.jpg','2021-01-13 12:49:27','2021-01-13 12:49:27'),(27,13,'FIFA 21-screenshot-1-16105421678429dd5c5a.jpg','storage/game-image/FIFA 21-screenshot-1-16105421678429dd5c5a.jpg','2021-01-13 12:49:27','2021-01-13 12:49:27'),(28,13,'FIFA 21-screenshot-1-1610542167AC_WALKOUT_HIRES_WM_16X9.jpg','storage/game-image/FIFA 21-screenshot-1-1610542167AC_WALKOUT_HIRES_WM_16X9.jpg','2021-01-13 12:49:27','2021-01-13 12:49:27'),(29,14,'Dying Light 2-screenshot-1-16105987034k-screenshot-dying-light-2-e3-2018-wallpaper-preview.jpg','storage/game-image/Dying Light 2-screenshot-1-16105987034k-screenshot-dying-light-2-e3-2018-wallpaper-preview.jpg','2021-01-14 04:31:43','2021-01-14 04:31:43'),(30,14,'Dying Light 2-screenshot-1-1610598703Dying-Light-2-sunset.jpg','storage/game-image/Dying Light 2-screenshot-1-1610598703Dying-Light-2-sunset.jpg','2021-01-14 04:31:43','2021-01-14 04:31:43'),(31,14,'Dying Light 2-screenshot-1-1610598703144-1448217_dying-light-2-tower-wallpaper-does-dying-light.jpg','storage/game-image/Dying Light 2-screenshot-1-1610598703144-1448217_dying-light-2-tower-wallpaper-does-dying-light.jpg','2021-01-14 04:31:43','2021-01-14 04:31:43'),(32,14,'Dying Light 2-screenshot-1-1610598703250-2507672_dying-light-2-4k-dying-light-2-4k.jpg','storage/game-image/Dying Light 2-screenshot-1-1610598703250-2507672_dying-light-2-4k-dying-light-2-4k.jpg','2021-01-14 04:31:43','2021-01-14 04:31:43');
/*!40000 ALTER TABLE `screenshots` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `taggable_taggables`
--

DROP TABLE IF EXISTS `taggable_taggables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `taggable_taggables` (
  `tag_id` bigint(20) unsigned NOT NULL,
  `taggable_id` bigint(20) unsigned NOT NULL,
  `taggable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  UNIQUE KEY `taggable_taggables_tag_id_taggable_id_taggable_type_unique` (`tag_id`,`taggable_id`,`taggable_type`),
  KEY `i_taggable_fwd` (`tag_id`,`taggable_id`),
  KEY `i_taggable_rev` (`taggable_id`,`tag_id`),
  KEY `i_taggable_type` (`taggable_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `taggable_taggables`
--

LOCK TABLES `taggable_taggables` WRITE;
/*!40000 ALTER TABLE `taggable_taggables` DISABLE KEYS */;
/*!40000 ALTER TABLE `taggable_taggables` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `taggable_tags`
--

DROP TABLE IF EXISTS `taggable_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `taggable_tags` (
  `tag_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `normalized` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`tag_id`),
  UNIQUE KEY `taggable_tags_normalized_unique` (`normalized`),
  KEY `taggable_tags_normalized_index` (`normalized`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `taggable_tags`
--

LOCK TABLES `taggable_tags` WRITE;
/*!40000 ALTER TABLE `taggable_tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `taggable_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `thanas`
--

DROP TABLE IF EXISTS `thanas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `thanas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `author_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district_id` bigint(20) unsigned NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `thanas`
--

LOCK TABLES `thanas` WRITE;
/*!40000 ALTER TABLE `thanas` DISABLE KEYS */;
INSERT INTO `thanas` VALUES (1,1,'Mirpur',1,'mirpur',1,'2020-09-09 12:07:39','2020-09-09 12:07:39');
/*!40000 ALTER TABLE `thanas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction_histories`
--

DROP TABLE IF EXISTS `transaction_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaction_histories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `post_id` bigint(20) unsigned NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transaction_histories_user_id_foreign` (`user_id`),
  KEY `transaction_histories_post_id_foreign` (`post_id`),
  CONSTRAINT `transaction_histories_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `exchanges` (`id`) ON DELETE CASCADE,
  CONSTRAINT `transaction_histories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction_histories`
--

LOCK TABLES `transaction_histories` WRITE;
/*!40000 ALTER TABLE `transaction_histories` DISABLE KEYS */;
/*!40000 ALTER TABLE `transaction_histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_histories`
--

DROP TABLE IF EXISTS `user_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_histories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `game_id` bigint(20) unsigned NOT NULL,
  `no_of_days` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_histories_user_id_foreign` (`user_id`),
  KEY `user_histories_game_id_foreign` (`game_id`),
  CONSTRAINT `user_histories_game_id_foreign` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_histories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_histories`
--

LOCK TABLES `user_histories` WRITE;
/*!40000 ALTER TABLE `user_histories` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_ratings`
--

DROP TABLE IF EXISTS `user_ratings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_ratings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `by_user` bigint(20) unsigned NOT NULL,
  `to_user` bigint(20) unsigned NOT NULL,
  `rating` decimal(2,1) NOT NULL DEFAULT '0.0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_ratings_by_user_foreign` (`by_user`),
  KEY `user_ratings_to_user_foreign` (`to_user`),
  CONSTRAINT `user_ratings_by_user_foreign` FOREIGN KEY (`by_user`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_ratings_to_user_foreign` FOREIGN KEY (`to_user`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_ratings`
--

LOCK TABLES `user_ratings` WRITE;
/*!40000 ALTER TABLE `user_ratings` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_ratings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_requests`
--

DROP TABLE IF EXISTS `user_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_requests` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `post_id` bigint(20) unsigned NOT NULL,
  `management_id` bigint(20) unsigned NOT NULL,
  `delivery_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_requests_user_id_foreign` (`user_id`),
  KEY `user_requests_post_id_foreign` (`post_id`),
  KEY `user_requests_management_id_foreign` (`management_id`),
  CONSTRAINT `user_requests_management_id_foreign` FOREIGN KEY (`management_id`) REFERENCES `managements` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_requests_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `exchanges` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_requests`
--

LOCK TABLES `user_requests` WRITE;
/*!40000 ALTER TABLE `user_requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `address_id` bigint(20) unsigned DEFAULT NULL,
  `identification_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `identification_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `interest` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wallet` decimal(8,2) NOT NULL DEFAULT '0.00',
  `rent_limit` int(11) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_phone_number_unique` (`phone_number`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_address_id_foreign` (`address_id`),
  CONSTRAINT `users_address_id_foreign` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'tushar','tushar@gmail.com',NULL,'$2y$10$qNdxvz4YeskK4dPgPO1lQezYS8L47Aww3zcl1VpVwRthJlkkXG/vy','WToUjacO7x1GDkg3ktefgtP1QWKIJ7vjrWtTym3ItW7ZLXElOMEbC7G0wFZh','2020-09-09 10:37:23','2020-09-09 10:37:23','01770353601',NULL,NULL,1,NULL,NULL,NULL,NULL,0.00,1,0,NULL),(2,'Jio','Jio@gmail.com',NULL,'$2y$10$NofzqeYPqvQUu.P11n6KTeIp0TmsWPj6RYXcJ4yUSj.gWiwQDsFsO',NULL,'2020-09-09 11:35:11','2020-09-09 11:38:11','01799837377',NULL,NULL,2,NULL,NULL,NULL,NULL,0.00,1,1,NULL),(3,'Divago','Divago@gmail.com',NULL,'$2y$10$KS2Gp7POna3iAXecZbR1r.7Xxhq1oNzfM3vzWYNPloZAzg7UTJpbW',NULL,'2020-09-09 11:49:39','2020-09-09 11:52:18','01982828822','Male','1997-01-03',3,'4545455433',NULL,NULL,NULL,0.00,1,1,NULL),(4,'Koushik','koushik@gmail.com',NULL,'$2y$10$FPdKrsqlxmINFr6OaolO.uDRnwN/jWQld/bguoN8Kxa.wF0ALnPma',NULL,'2020-09-09 11:55:04','2020-09-10 06:40:15','01521466101','Male','2009-12-27',4,'132132131231231','identification/id_1599720015_4.jpeg',NULL,'profile/profile_1599720001_4.jpeg',0.00,1,1,NULL),(5,'Koushik','tester@mail.com',NULL,'$2y$10$HX/bVtxU6gayGnRJkv2dz.GYz6kY2fS0AnOZLTtHsWzWq76EmJXci',NULL,'2020-09-09 12:02:00','2020-09-09 12:02:58','01717739179','Male','2009-12-29',5,'132132131231231',NULL,NULL,NULL,0.00,1,1,NULL),(6,'Shohag','Shohag@gmail.com',NULL,'$2y$10$cfpiSIrSUROc0Gbn.x67A.Joz1.OAjqFPTD23yp4hRUI/HdOPUYN.',NULL,'2020-09-09 12:29:24','2020-09-09 12:31:26','01373737777','Male','1996-01-01',6,'9889999999',NULL,NULL,NULL,0.00,1,1,NULL),(7,'KKK','KKK@gmail.com',NULL,'$2y$10$7h2xftYwcW1tu5GfVay9qOmHQQv/QoN9Pl/waNnvNppICDm0EOskS',NULL,'2020-09-09 12:33:10','2020-09-09 12:34:17','01232283282','Male','1989-01-01',7,'12312312334',NULL,NULL,NULL,0.00,1,1,NULL),(8,'Jiodana','Jiodana@gmail.com',NULL,'$2y$10$T5R.QCJ0XL/JDXew6fMjuOPv5Y1vu4lPXg.w./Qf6YQOo647utAPG',NULL,'2020-09-09 13:23:07','2020-09-15 08:18:21','01999999999','Male','1996-01-03',8,'00000000000','identification/id_1600157888_8.jpeg',NULL,'profile/profile_1600157901_8.png',0.00,1,1,NULL),(9,'Piash','Piash@gmail.com',NULL,'$2y$10$Qwr.qVzqltCkFBOnJRi5fucp49UkqlDnseLMFHTLB0E9rg9jpyFYm',NULL,'2020-09-10 04:18:48','2020-09-10 04:21:36','01899999999','Male','1996-12-30',9,'9383838383',NULL,NULL,NULL,0.00,1,1,NULL),(10,'ifti','newer@mail.com',NULL,'$2y$10$w3/0eZTbdGrRHwDX84JSFeccmWOVarD3eRyTkim/mlhR0m6wz2WMG',NULL,'2020-09-10 06:49:50','2020-09-10 06:50:29','01521486543',NULL,NULL,10,NULL,NULL,NULL,NULL,0.00,1,1,NULL),(11,'Zahid H. Akash','kkkkk@gmail.com',NULL,'$2y$10$E46NWCRm.MZI8FzrBbr6OOSw3lJfqOcedBd8LGMEiC53jxUmRifaC',NULL,'2020-09-10 10:00:07','2020-09-10 10:08:11','01992929292','Male','1998-01-01',11,'1212121211','identification/id_1599732491_11.jpeg',NULL,'profile/profile_1599732491_11.jpeg',0.00,1,1,NULL),(12,'PS4','ps4@gmail.com',NULL,'$2y$10$dveP6SNo7ZOJEBqRwlAYQeVHUngakDV6Mk5F0WCUXwaKk9i6WaaF2',NULL,'2020-09-10 10:09:06','2020-09-10 10:10:09','01779299999','Male','1995-12-31',12,'33333333333','identification/id_1599732598_12.jpeg',NULL,'profile/profile_1599732609_12.jpeg',0.00,1,1,NULL),(13,'TestWork','Test@gmail.com',NULL,'$2y$10$RV2RPXYJEFUzvNKGyoq9HOhb6ppS/Z0exKRitsRSrJJ3iAxf64JoK',NULL,'2020-09-12 12:11:19','2020-09-13 04:45:41','01770703838','Male','1997-12-28',13,'12112121221','identification/id_1599972341_13.png',NULL,'profile/profile_1599972341_13.png',0.00,1,1,NULL),(14,'Bughub','Bughub@gmail.com',NULL,'$2y$10$kH8tQAB2p9bmM1QRFH3HFuMfqCaMPo8LfM.3kN9HdFBI/GXBUoxxG',NULL,'2020-09-13 04:52:03','2020-09-13 04:54:22','01783737457','Male','1997-01-02',14,'1234567891','identification/id_1599972862_14.png',NULL,'profile/profile_1599972862_14.png',0.00,1,1,NULL),(15,'BugJila','BugJila@gmail.com',NULL,'$2y$10$UavXpe0A3zuLHaeRs79K2eMGe5e2Piq09VAzJ/NI3.5MyJadZgb0.',NULL,'2020-09-13 05:03:07','2020-09-13 05:04:17','01838383888','Male','1997-01-02',15,'1212121111','identification/id_1599973457_15.png',NULL,'profile/profile_1599973457_15.png',0.00,1,1,NULL),(16,'Webhub','Webhub@gmail.com',NULL,'$2y$10$AlFU697zMDyU4TYZCIqskOx9bSFKcrBFDZSwxlOKkNoQOY8BsYCwu',NULL,'2020-09-13 05:09:39','2020-09-13 05:19:16','01937737373','Male','1997-01-02',16,'2222222222','identification/id_1599973851_16.jpeg',NULL,'profile/profile_1599973851_16.png',0.00,1,0,NULL),(17,'Rent','Rent@gmail.com',NULL,'$2y$10$tEyVUhiMbAGOCaieTSuoluksiFpVXmgQnvsres7Spp7bqI7vge2qa',NULL,'2020-09-13 11:14:46','2020-09-13 12:03:42','01789928288','Male','1999-01-02',17,'1234567890','identification/id_1599995743_17.png',NULL,'profile/profile_1599995744_17.png',0.00,1,0,NULL),(18,'Tushar',NULL,NULL,NULL,NULL,'2020-09-13 11:21:28','2020-09-13 11:21:41','01521324269',NULL,NULL,18,NULL,NULL,NULL,NULL,0.00,1,1,NULL),(19,'Jossbd','Jossbd@gmail.com',NULL,'$2y$10$1OE0cTKKEr0qLYMozU.Pvu8L9OsNZyDTyREDtz/IrmQZy7RnKyNem',NULL,'2020-09-13 11:41:38','2020-09-13 11:43:07','01976756556','Male','1997-01-06',19,'8787877788','identification/id_1599997387_19.png',NULL,'profile/profile_1599997387_19.png',0.00,1,1,NULL),(20,'Hack','Hack@gmail.com',NULL,'$2y$10$T5iB1DH7sHVfNj2vRBlfXO481bZzeiTutxXWvUZdhz8zXlImM8LJu',NULL,'2020-09-13 12:08:19','2020-09-13 12:09:12','01238383838','Male','2000-01-01',20,'1111111111','identification/id_1599998952_20.png',NULL,NULL,0.00,1,1,NULL),(21,'Trello','Trello@gmail.com',NULL,'$2y$10$Qsayv8Y5w2iQs0aHlOzJYemoyLFawizQCB5veaWkX6OmB.Oq3Ual2',NULL,'2020-09-13 12:13:34','2020-09-13 12:14:39','01988888888','Male','1996-01-02',21,'11111111111','identification/id_1599999279_21.png',NULL,NULL,0.00,1,1,NULL),(22,'Tin','Tin@gmail.com',NULL,'$2y$10$.SpwUmYw3W83hy8sbdgF9us8AllDMyci7MQOKXpYrJKTIeTPaIIZW',NULL,'2020-09-14 05:18:22','2020-09-14 05:19:06','01888888888',NULL,NULL,22,NULL,NULL,NULL,NULL,0.00,1,1,NULL),(23,NULL,NULL,NULL,NULL,NULL,'2020-09-14 05:29:01','2020-09-14 05:29:01','01988888366',NULL,NULL,23,NULL,NULL,NULL,NULL,0.00,1,1,NULL),(24,'Mofiz','Mofiz@gmail.com',NULL,'$2y$10$1ZkrqkX96nbErjcclSGmseQEGKSwyvrGtp23Ti48YIJs/ZOnwc/dO',NULL,'2020-09-14 05:37:06','2020-09-14 05:38:58','01222222222','Male','1997-01-01',24,'2836276722','identification/id_1600061938_24.jpeg',NULL,'profile/profile_1600061938_24.jpeg',0.00,1,1,NULL),(25,'Gamehub','Gamehub@gmail.com',NULL,'$2y$10$Qzen2btx8.ZU6Z8GqGf8wukqxJSeUZhQQ1gmYOxxHBzsizKHCnM4W',NULL,'2020-09-14 09:07:01','2020-09-14 09:07:55','01746464446','Male','1997-01-03',25,'234323231234','identification/id_1600074474_25.jpeg',NULL,'profile/profile_1600074474_25.jpeg',0.00,1,1,NULL),(26,'LaLaa','LaLaa@gmail.com',NULL,NULL,NULL,'2020-09-16 04:30:41','2020-09-16 04:47:20','01788938383','Male','1996-01-04',26,'11111111133','identification/id_1600231640_26.jpeg',NULL,'profile/profile_1600231640_26.jpeg',0.00,1,1,NULL),(27,'Ucchash','ucchash@augnitive.com',NULL,'$2y$10$Hr5QAIUPDNUFyUo7n7hH0uNIfWVn.JzqcuxzzxZN2/dXC6DfG2wSm',NULL,'2020-10-12 06:38:07','2020-10-12 07:07:27','01764649486','Male','1990-12-29',27,'1764649486','identification/id_1602486431_27.png',NULL,NULL,0.00,1,1,NULL),(28,'Minhaj','minhaj372@gmail.com',NULL,'$2y$10$BsRJLzJDXICv3Pc2ffpsXeGohfhf4s0czLiFczHJxATRLpPS2hRiW',NULL,'2020-10-19 07:15:15','2020-12-21 11:40:36','01825586090',NULL,NULL,28,NULL,NULL,NULL,NULL,0.00,1,1,NULL),(29,'ricky','rixky@sex.porn',NULL,'$2y$10$h3DFV19KLbAp.KFpQDAYWeZJuXvKMjK6CXOVS375dwYr26vEbSt9m',NULL,'2020-10-22 11:00:06','2020-10-22 11:07:37','01686406730','Male','2010-01-01',29,'1111111111',NULL,NULL,NULL,0.00,1,1,NULL),(30,NULL,NULL,NULL,NULL,NULL,'2020-12-19 06:03:18','2020-12-19 06:03:18','01919989876',NULL,NULL,30,NULL,NULL,NULL,NULL,0.00,1,1,NULL),(31,NULL,NULL,NULL,NULL,NULL,'2020-12-19 11:42:41','2020-12-19 11:42:41','01919989887',NULL,NULL,31,NULL,NULL,NULL,NULL,0.00,1,1,NULL),(32,NULL,NULL,NULL,NULL,NULL,'2020-12-19 12:37:31','2020-12-19 12:37:31','01919989886',NULL,NULL,32,NULL,NULL,NULL,NULL,0.00,1,1,NULL),(33,'TestBro','TestBro@gmail.com',NULL,'$2y$10$vfb6y1/FO3rwEW2NKWCw2.azDWOuNXybRmZJKb.FOF.pkgIzRCbla',NULL,'2020-12-20 04:54:13','2020-12-20 04:55:20','01983838388','Male','2009-12-31',33,'11111111212','identification/id_1608440120_33.png',NULL,NULL,0.00,1,1,NULL),(34,NULL,NULL,NULL,NULL,NULL,'2020-12-22 12:22:11','2020-12-22 12:22:11','01911358926',NULL,NULL,34,NULL,NULL,NULL,NULL,0.00,1,1,NULL),(35,'md','mahadi@augnitive.com',NULL,'$2y$10$5dqtOWxhH8S.a4TSZA0CcezUfUyO9.cyVXHFMeHOA/eli0rJFXZM.',NULL,'2020-12-22 13:07:54','2020-12-22 13:08:19','01000000000',NULL,NULL,35,NULL,NULL,NULL,NULL,0.00,1,1,NULL),(36,'efewfew','hello@gmail.com',NULL,'$2y$10$R2xdqAPPWODINut3m31Ooun3tjygc5gtKOYmCKVAOhmv2cdskoIky',NULL,'2020-12-22 13:34:04','2020-12-31 10:08:10','01909090909',NULL,NULL,36,NULL,NULL,NULL,NULL,0.00,1,1,'ddrfef'),(37,NULL,NULL,NULL,NULL,NULL,'2020-12-23 09:06:52','2020-12-23 09:06:53','01828272727',NULL,NULL,37,NULL,NULL,NULL,NULL,0.00,1,1,NULL),(38,NULL,NULL,NULL,NULL,NULL,'2020-12-27 08:55:47','2020-12-27 08:55:47','01667554534',NULL,NULL,38,NULL,NULL,NULL,NULL,0.00,1,1,NULL),(39,'dj','dj@gmail.com',NULL,NULL,NULL,'2020-12-27 08:58:46','2020-12-27 08:59:24','01928636354',NULL,NULL,39,NULL,NULL,NULL,NULL,0.00,1,1,'rahul'),(40,'Mr','mrdavid@gmail.com',NULL,NULL,NULL,'2020-12-28 09:52:14','2020-12-28 09:52:47','01010101010',NULL,NULL,40,NULL,NULL,NULL,NULL,0.00,1,1,'David'),(41,'david','david@gmail.com',NULL,NULL,NULL,'2020-12-30 10:49:46','2020-12-30 10:50:28','01929292728',NULL,NULL,41,NULL,NULL,NULL,NULL,0.00,1,1,'Brojah'),(42,'heyyyyyyyyy',NULL,NULL,NULL,NULL,'2020-12-31 04:42:44','2020-12-31 04:43:14','01826354353',NULL,NULL,42,NULL,NULL,NULL,NULL,0.00,1,1,'gamehub'),(43,NULL,NULL,NULL,NULL,NULL,'2021-01-03 11:20:11','2021-01-03 11:20:11','01825432224',NULL,NULL,43,NULL,NULL,NULL,NULL,0.00,1,1,NULL),(44,NULL,NULL,NULL,NULL,NULL,'2021-01-04 04:40:55','2021-01-04 04:40:55','01333333333',NULL,NULL,44,NULL,NULL,NULL,NULL,0.00,1,1,NULL),(45,NULL,NULL,NULL,NULL,NULL,'2021-01-04 09:23:00','2021-01-04 09:23:00','01970703838',NULL,NULL,45,NULL,NULL,NULL,NULL,0.00,1,1,NULL),(46,'md','hi@gmail.com',NULL,'$2y$10$gpOvdFpHCisbJyeUImchGeklR7UmD2wrm9sQaes/Xw./2ZP35w6Lm',NULL,'2021-01-05 04:12:50','2021-01-05 04:12:50','0182558609111',NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.00,1,0,'David'),(47,'md','jfeh@gmail.com',NULL,'$2y$10$st/Iw7CpxYwavNSt70LpduHxA3V/YpAERK4x./Rm5nyJEs/8RM5KG',NULL,'2021-01-05 04:13:23','2021-01-05 04:13:23','88e9e89wq8e9qw89',NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.00,1,0,'David'),(48,'md','min@gmail.com',NULL,'$2y$10$xnSpa.zENeuo1CaLtqtg9O8nvLf9IjFzxnXBChvLiZqfF5CBONkQ6',NULL,'2021-01-05 04:14:57','2021-01-05 04:14:57','01825586091',NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.00,1,0,'David'),(49,'Akash','akashahmed59@gmail.com',NULL,'$2y$10$sScYt5jpDoBkE4EvOizbKemrRVgP/avpf7xeHHQZCd4JmZezlSwWS',NULL,'2021-01-05 06:49:28','2021-01-05 06:50:25','01770703837',NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.00,1,0,'Ahmed'),(50,'md','min11@gmail.com',NULL,'$2y$10$xRCUNGpcL3G2BV267SpGuOQ/DyMbwGaGC7MN0yjgmmdtVHeRz62dK',NULL,'2021-01-06 04:18:31','2021-01-06 04:18:31','01731611600',NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.00,1,0,'rahul'),(51,'md','minh1@mail.com',NULL,'$2y$10$dQIgQj16GxVfQj4P5.xyDe2E8jS9Re482drvbgdXdYKTy32Wj9LYq',NULL,'2021-01-06 04:22:30','2021-01-06 04:22:30','01731611611',NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.00,1,0,'gamehub'),(52,'sadia','sadia@augnitive.com',NULL,'$2y$10$t5Ie6.pB2C3osYMOSRiJKePqGuDBIDzPwYcKU9vCvUQEZYHThSeDW',NULL,'2021-01-06 11:11:30','2021-01-06 11:11:30','01783730044',NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.00,1,0,'hossain'),(53,'Debashish','debashish@augnitive.com',NULL,'$2y$10$0LblP8HgCdAsTLyVnM3Dh.m0Ie3tvQV3agcx6x5DlkTH0O5AZGZqW',NULL,'2021-01-07 05:47:50','2021-01-12 05:39:15','01746603777',NULL,NULL,46,NULL,NULL,NULL,NULL,0.00,1,1,'Roy'),(54,NULL,NULL,NULL,NULL,NULL,'2021-01-07 08:40:15','2021-01-07 08:40:15','01928238388',NULL,NULL,47,NULL,NULL,NULL,NULL,0.00,1,1,NULL),(55,'Akash','akashahmed509@gmail.com',NULL,'$2y$10$tcpd9R0iPt2bWMVK7hKijOSi35HZU6.tbdP51HTP8UKZBKurubACK',NULL,'2021-01-07 08:47:43','2021-01-07 08:47:43','01770703430',NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.00,1,0,'Ahmed'),(56,'Debashish','debashish+1@augnitive.com',NULL,'$2y$10$APSrE7vzApMfu4zbL5s.K.L1fqBL8uQQDfzAZeDxhbLEKZGHimtZi',NULL,'2021-01-12 05:40:32','2021-01-12 05:41:32','01746603776',NULL,NULL,48,NULL,NULL,NULL,NULL,0.00,1,1,'Roy'),(57,'md','mij@gmail.com',NULL,'$2y$10$m4ozcQv7Zw457ZuuwNYey.pgoZGy1DL7iTblnTiWz8LiP1wwvYOky',NULL,'2021-01-12 06:18:35','2021-01-12 06:18:35','01711111111',NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.00,1,0,'rahul'),(58,'Debashish','debashish+2@augnitive.com',NULL,'$2y$10$6CZ/4H1PHQtZSmJvtrSlhO/qmLVULZhhzvO94zb8OQCFXGvFmJPwu',NULL,'2021-01-12 06:23:31','2021-01-12 06:23:31','01746602778',NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.00,1,0,'Roy'),(59,'A',NULL,NULL,NULL,NULL,'2021-01-12 06:58:03','2021-01-12 07:10:50','01770703737',NULL,NULL,49,NULL,NULL,NULL,NULL,0.00,1,1,'B'),(60,'Akash','akashahmed@gmail.com',NULL,NULL,NULL,'2021-01-12 07:22:02','2021-01-12 07:22:02','01778383434',NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.00,1,0,'Ahmed'),(61,'danish','danis@gmail.com',NULL,NULL,NULL,'2021-01-12 08:16:05','2021-01-12 08:16:46','01111111110',NULL,NULL,50,NULL,NULL,NULL,NULL,0.00,1,1,'kanaria'),(62,'minhaj','minhaj1@gmail.com',NULL,NULL,NULL,'2021-01-12 08:23:02','2021-01-12 08:23:30','01919191919',NULL,NULL,51,NULL,NULL,NULL,NULL,0.00,1,1,'md'),(63,NULL,NULL,NULL,NULL,NULL,'2021-01-13 05:17:26','2021-01-13 05:17:26','01766566556',NULL,NULL,52,NULL,NULL,NULL,NULL,0.00,1,1,NULL),(64,'Akash','akashahmed121@gmail.com',NULL,'$2y$10$YAoAJEjrXO9/SKvN1ksc3OD2l.Y7rHxlTnP9K2nPu6IElcEa2DGlC',NULL,'2021-01-13 05:34:50','2021-01-13 05:34:50','01783843388',NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.00,1,0,'ashmed'),(65,'Debashish','debashish+3@augnitive.com',NULL,'$2y$10$mxfagFpWg0cNO0lXHT5KWeirOtzlp2RPyR8717qfUxfvZw4p4GVim',NULL,'2021-01-13 05:35:27','2021-01-13 05:35:27','01746603888',NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.00,1,0,'Roy'),(66,'fvdf','eee@gmail.com',NULL,NULL,NULL,'2021-01-13 08:52:14','2021-01-13 08:53:02','01833353508',NULL,NULL,53,NULL,NULL,NULL,NULL,0.00,1,1,'dfdf'),(67,'minhaj','md@gmail.com',NULL,NULL,NULL,'2021-01-13 12:19:03','2021-01-13 12:19:22','01909099900',NULL,NULL,54,NULL,NULL,NULL,NULL,0.00,1,1,'md'),(68,'World','akashahmed45@gmail.com',NULL,NULL,NULL,'2021-01-13 13:44:42','2021-01-13 13:45:53','01782828384',NULL,NULL,55,NULL,NULL,NULL,NULL,0.00,1,1,'Best Tester'),(69,NULL,NULL,NULL,NULL,NULL,'2021-01-13 13:51:55','2021-01-13 13:51:55','01970703837',NULL,NULL,56,NULL,NULL,NULL,NULL,0.00,1,1,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `video_urls`
--

DROP TABLE IF EXISTS `video_urls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `video_urls` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `game_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `video_urls_game_id_foreign` (`game_id`),
  CONSTRAINT `video_urls_game_id_foreign` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `video_urls`
--

LOCK TABLES `video_urls` WRITE;
/*!40000 ALTER TABLE `video_urls` DISABLE KEYS */;
INSERT INTO `video_urls` VALUES (1,1,'Pubg-Video-1-1608720187',NULL,'2020-12-23 10:43:07','2020-12-23 10:43:07'),(2,1,'Pubg-Video-1-1608720302',NULL,'2020-12-23 10:45:02','2020-12-23 10:45:02'),(4,8,'Fortnite-Video-1-1608790295',NULL,'2020-12-24 06:11:35','2020-12-24 06:11:35'),(5,8,'Fortnite-Video-1-1608790571',NULL,'2020-12-24 06:16:11','2020-12-24 06:16:11'),(7,9,'PubG-Video-1-1608792501','https://www.youtube.com/watch?v=WWXm39leYew&list=RDmOnGAQHbrK4&index=13','2020-12-24 06:48:21','2020-12-24 06:48:21'),(8,9,'PubG-Video-1-1608792501',NULL,'2020-12-24 06:48:21','2020-12-24 06:48:21'),(10,7,'Cyberpunk 2077-Video-1-1609911398','https://www.youtube.com/watch?v=BjS2ygZ3dY8','2021-01-06 05:36:38','2021-01-06 05:36:38'),(11,7,'Cyberpunk 2077-Video-1-1609911453','https://www.youtube.com/watch?v=BjS2ygZ3dY8','2021-01-06 05:37:33','2021-01-06 05:37:33'),(12,7,'Cyberpunk 2077-Video-1-1609911453','https://www.youtube.com/watch?v=BjS2ygZ3dY8','2021-01-06 05:37:33','2021-01-06 05:37:33'),(13,10,'Microsoft Flight Simulator-Video-1-1609922339','https://www.youtube.com/watch?v=ioNng23DkIM','2021-01-06 08:38:59','2021-01-06 08:38:59'),(14,11,'Cyberpunk 2077-Video-1-1610452801','https://www.youtube.com/watch?v=FhZTB7ZpPpw','2021-01-12 12:00:01','2021-01-12 12:00:01'),(15,11,'Cyberpunk 2077-Video-1-1610452801','https://www.youtube.com/watch?v=BO8lX3hDU30','2021-01-12 12:00:01','2021-01-12 12:00:01'),(16,12,'PlayerUnknown\'s Battlegrounds-Video-1-1610534554','https://youtu.be/YLwCfTA6LCQ','2021-01-13 10:42:34','2021-01-13 10:42:34'),(17,12,'PlayerUnknown\'s Battlegrounds-Video-1-1610534554','https://youtu.be/OBQbC8pxDZ8','2021-01-13 10:42:34','2021-01-13 10:42:34'),(18,12,'PlayerUnknown\'s Battlegrounds-Video-1-1610534554','https://youtu.be/HPpcAxKVar4','2021-01-13 10:42:34','2021-01-13 10:42:34'),(19,13,'FIFA 21-Video-1-1610542167','https://youtu.be/QJJX0vXDP4g','2021-01-13 12:49:27','2021-01-13 12:49:27'),(20,14,'Dying Light 2-Video-1-1610598703','https://www.youtube.com/watch?v=uy6ne-fEsAw','2021-01-14 04:31:43','2021-01-14 04:31:43'),(21,14,'Dying Light 2-Video-1-1610598703','https://www.youtube.com/watch?v=3nIPYn9DDWQ','2021-01-14 04:31:43','2021-01-14 04:31:43'),(22,14,'Dying Light 2-Video-1-1610598703','https://www.youtube.com/watch?v=dkWS0xGutSY','2021-01-14 04:31:43','2021-01-14 04:31:43');
/*!40000 ALTER TABLE `video_urls` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-01-14  4:43:04
