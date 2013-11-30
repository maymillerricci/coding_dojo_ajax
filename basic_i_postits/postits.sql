CREATE DATABASE  IF NOT EXISTS `postits` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `postits`;
-- MySQL dump 10.13  Distrib 5.6.13, for osx10.6 (i386)
--
-- Host: 127.0.0.1    Database: postits
-- ------------------------------------------------------
-- Server version	5.5.33

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
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,'test post','2013-11-01 09:18:26',NULL),(2,'test post 2','2013-11-01 09:20:34',NULL),(3,'test post 3 test post 3 test post 3 test post 3 test post 3 test post 3 test post 3','2013-11-01 09:46:08',NULL),(4,'another note','2013-11-01 09:48:18',NULL),(5,'new line?  not yet?','2013-11-01 09:48:27',NULL),(6,'yes new line...','2013-11-01 09:48:37',NULL),(50,'q','2013-11-01 16:48:29',NULL),(51,'#8','2013-11-01 16:49:02',NULL),(52,'number9','2013-11-01 16:49:58',NULL),(53,'10.  Will this work?','2013-11-01 16:51:44',NULL),(54,'11.  Will this work?','2013-11-01 16:52:07',NULL),(55,'number 12','2013-11-01 16:54:02',NULL),(56,'NEW number 13','2013-11-01 16:54:05',NULL),(57,'test','2013-11-01 17:03:38',NULL),(58,'note','2013-11-01 17:13:55',NULL),(59,'SIXTEEN!','2013-11-02 19:52:21',NULL),(60,'?','2013-11-02 20:21:08',NULL),(61,'18','2013-11-02 20:22:50',NULL),(62,'okay, here\'s a note\r\n','2013-11-02 20:33:04',NULL),(63,'this is a note','2013-11-02 20:34:03',NULL),(64,'new note','2013-11-02 20:35:30',NULL),(65,'22!!!!!!!!!!!!!!!!!','2013-11-02 20:36:10',NULL),(66,'23.  when i submit this, it should add the note, but the text should go away in my submit box','2013-11-02 20:37:32',NULL),(67,'e','2013-11-02 20:38:57',NULL),(68,'qwe','2013-11-02 20:39:36',NULL),(69,'d','2013-11-02 20:40:07',NULL),(70,'dsadas','2013-11-02 20:41:03',NULL),(71,'this time itll work','2013-11-02 20:41:47',NULL),(72,'??','2013-11-02 20:42:09',NULL),(73,'d','2013-11-02 20:43:27',NULL),(74,'dasdas','2013-11-02 20:44:48',NULL),(75,'d','2013-11-02 20:45:27',NULL),(76,'THIS WILL WORK!','2013-11-02 20:46:09',NULL),(77,'finally','2013-11-02 20:46:22',NULL),(78,'???','2013-11-02 20:46:37',NULL),(79,'still?','2013-11-02 20:46:43',NULL),(80,'yes....','2013-11-02 20:46:46',NULL),(81,'last one','2013-11-02 20:47:03',NULL),(82,'and one last one','2013-11-03 09:47:44',NULL),(83,'new note','2013-11-06 19:13:20',NULL),(84,'test','2013-11-09 18:17:10','2013-11-09 18:17:10'),(85,'test','2013-11-09 18:17:20','2013-11-09 18:17:20'),(86,'another test','2013-11-09 18:19:01','2013-11-09 18:19:01'),(87,'new note','2013-11-10 14:30:08',NULL),(88,'another new note','2013-11-10 14:30:13',NULL);
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-11-29 18:38:58
