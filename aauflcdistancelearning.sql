-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: aauflcdistancelearning
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.10-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin_announcements`
--

DROP TABLE IF EXISTS `admin_announcements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_announcements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `announcement_data` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_announcements`
--

LOCK TABLES `admin_announcements` WRITE;
/*!40000 ALTER TABLE `admin_announcements` DISABLE KEYS */;
INSERT INTO `admin_announcements` VALUES (12,'Dear Students, We are thrilled to welcome you to Ambrose Alli University Distance Learning FLc Platform!!! As you embark on your educational journey with us, we want to extend our warmest greetings and support. At Ambrose Alli University Distance Learning FLc Platform, we are committed to providing you with high-quality education and resources to help you achieve your academic goals, no matter where you are in the world.','2023-10-08 11:56:59');
/*!40000 ALTER TABLE `admin_announcements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_users`
--

DROP TABLE IF EXISTS `admin_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_users`
--

LOCK TABLES `admin_users` WRITE;
/*!40000 ALTER TABLE `admin_users` DISABLE KEYS */;
INSERT INTO `admin_users` VALUES (7,'AAUFLC','$2y$10$2RkfRJo0tQV5XYQjFqdHQ.s.UFDP0utV2P.CmL3G.ddpOa6eEjOli');
/*!40000 ALTER TABLE `admin_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_name` varchar(255) NOT NULL,
  `course_description` text NOT NULL,
  `instructor_name` varchar(255) NOT NULL,
  `program_id` int(11) NOT NULL,
  `program_name` varchar(255) NOT NULL,
  PRIMARY KEY (`course_id`),
  KEY `program_id` (`program_id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses`
--

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` VALUES (10,'Developmental Psychology','Developmental Psychology','Dr. Mrs. Shobayo M. A',9,''),(20,'ENT  201 Entrepreneurship Education','Entrepreneurship Education','Mr Oyemomilara',4,''),(21,'CSC  205 Computer Hardware','Computer Hardware','Mr Nofiu',4,''),(11,'Nigeria Legal System POS 104 ','Nigeria Legal System','Dr. Abidoye',9,''),(12,'GST 103 Use Of LibraryGST 103 ','Use Of Library','Mr Afolabi',9,''),(13,'Introduction To Teaching Profession History Of Education EDU 101','Introduction To Teaching Profession History Of Education','Mr Akinlabi',9,''),(14,'Developmental Psychology EDU 102','Developmental Psychology','Dr. Mrs. Shobayo M. A',9,''),(19,'CSC 204 Object Oriented programming','Object Oriented programming','Dr Abidoye',4,''),(16,'CSC 201 Web Development','Web Development','Mr Oyeniran',4,''),(17,'CSC 202 File Organisation','File Organisation\r\n','Mr Bayo Jolaoye',4,''),(18,'CSC 203 Computer Programming 1 (Fortran)','Computer Programming 1 (Fortran)\r\n','Mr Oyeniran',4,''),(22,'EDU  201 Philosophy of Education',' Philosophy of Education','Mr Adetoro S.T / Mr Moses',4,'');
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enrollments`
--

DROP TABLE IF EXISTS `enrollments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `enrollments` (
  `enrollment_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `enrollment_date` date NOT NULL,
  PRIMARY KEY (`enrollment_id`),
  UNIQUE KEY `student_id` (`student_id`,`course_id`),
  KEY `course_id` (`course_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enrollments`
--

LOCK TABLES `enrollments` WRITE;
/*!40000 ALTER TABLE `enrollments` DISABLE KEYS */;
/*!40000 ALTER TABLE `enrollments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lessons`
--

DROP TABLE IF EXISTS `lessons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lessons` (
  `lesson_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `content` text DEFAULT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `admin_id` int(11) DEFAULT NULL,
  `zoom_session_link` varchar(255) NOT NULL,
  `zoom_session_password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`lesson_id`),
  KEY `admin_id` (`admin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lessons`
--

LOCK TABLES `lessons` WRITE;
/*!40000 ALTER TABLE `lessons` DISABLE KEYS */;
INSERT INTO `lessons` VALUES (11,'Introduction to Entrepreneurship Education','ENT 201 Entrepreneurship Education','Entrepreneurship education is considered as a collection of formalized teachings that informs, educates, and trains anyone concerned in business establishment.','','2023-10-08 11:14:45',NULL,'https://us05web.zoom.us/j/87277841058?pwd=Vk2bSWLysizZid21i4I8jJMEepEb75.1 ','3uszCb'),(12,'Introduction to Computer Hardware','CSC 205 Computer Hardware','Hardware refers to the computer\'s tangible components or delivery systems that store and run the written instructions provided by the software.','','2023-10-08 11:18:10',NULL,'https://us05web.zoom.us/j/81859863628?pwd=svBebKs0AZsON2cGQfrbHQaeVE8F4f.1  ','0ScqD2'),(13,'Intro to Object Oriented programming','CSC 204 Object Oriented programming','OOP focuses on the objects that developers want to manipulate rather than the logic required to manipulate them. ','','2023-10-08 11:24:05',NULL,'https://us05web.zoom.us/j/89910984476?pwd=C09VQqYmLXxUsiBgnLtDbFAzLEP024.1 ','9upgq4'),(14,'Introduction to Web Development','CSC 201 Web Development','Web development refers to the creating, building, and maintaining of websites','','2023-10-08 11:30:39',NULL,'https://us05web.zoom.us/j/89910984476?pwd=C09VQqYmLXxUsiBgnLtDbFAzLEP024.1 ','9upgq4'),(15,'Introduction to File Organisation','CSC 202 File Organisation','file organization refers to the way in which data is stored in a file and, consequently, the method(s) by which it can be accessed.','','2023-10-08 11:35:54',NULL,'https://us05web.zoom.us/j/84877588557?pwd=MOC0e0l8I0sbEHCSYBsV17Pr4plxTi.1  ','1z4khH'),(16,'Introduction to FORTRAN','FORTRAN','FORTRAN .......','','2023-10-09 10:06:44',NULL,'https://us05web.zoom.us/j/89910984476?pwd=C09VQqYmLXxUsiBgnLtDbFAzLEP024.1 ','3uszCb');
/*!40000 ALTER TABLE `lessons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `program_courses`
--

DROP TABLE IF EXISTS `program_courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `program_courses` (
  `program_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  PRIMARY KEY (`program_id`,`course_id`),
  KEY `course_id` (`course_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `program_courses`
--

LOCK TABLES `program_courses` WRITE;
/*!40000 ALTER TABLE `program_courses` DISABLE KEYS */;
/*!40000 ALTER TABLE `program_courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `programs`
--

DROP TABLE IF EXISTS `programs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `programs` (
  `program_id` int(11) NOT NULL AUTO_INCREMENT,
  `program_name` varchar(255) NOT NULL,
  PRIMARY KEY (`program_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `programs`
--

LOCK TABLES `programs` WRITE;
/*!40000 ALTER TABLE `programs` DISABLE KEYS */;
INSERT INTO `programs` VALUES (1,'Accounting'),(2,'Business Administration'),(3,'Biology'),(4,'Computer Science'),(5,'Economics'),(6,'English'),(7,'Guidance and Counselling'),(8,'Library and Information Science'),(9,'Political Science'),(10,'Public Administration'),(14,'HEALTH RECORDS');
/*!40000 ALTER TABLE `programs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reports`
--

DROP TABLE IF EXISTS `reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `report_data` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reports`
--

LOCK TABLES `reports` WRITE;
/*!40000 ALTER TABLE `reports` DISABLE KEYS */;
/*!40000 ALTER TABLE `reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_courses`
--

DROP TABLE IF EXISTS `student_courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `student_courses` (
  `enrollment_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `enrollment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `course_name` varchar(255) DEFAULT NULL,
  `program_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`enrollment_id`),
  KEY `student_id` (`student_id`),
  KEY `course_id` (`course_id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_courses`
--

LOCK TABLES `student_courses` WRITE;
/*!40000 ALTER TABLE `student_courses` DISABLE KEYS */;
/*!40000 ALTER TABLE `student_courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_programs`
--

DROP TABLE IF EXISTS `student_programs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `student_programs` (
  `enrollment_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `enrollment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`enrollment_id`),
  KEY `student_id` (`student_id`),
  KEY `program_id` (`program_id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_programs`
--

LOCK TABLES `student_programs` WRITE;
/*!40000 ALTER TABLE `student_programs` DISABLE KEYS */;
INSERT INTO `student_programs` VALUES (34,26,1,'2023-11-08 19:08:30'),(33,25,4,'2023-10-31 11:00:52'),(32,24,4,'2023-10-09 09:51:52'),(31,23,4,'2023-10-08 08:59:58'),(30,22,4,'2023-10-02 09:19:53'),(29,21,4,'2023-09-29 11:05:36'),(28,18,9,'2023-09-29 09:10:11'),(27,19,1,'2023-09-28 22:22:28');
/*!40000 ALTER TABLE `student_programs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `students` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `program_enrollment` varchar(255) DEFAULT NULL,
  `registration_date` date DEFAULT NULL,
  `student_level` varchar(255) DEFAULT NULL,
  `profile_picture_url` varchar(255) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `address` varchar(255) DEFAULT 'N/A',
  `state_of_origin` varchar(50) DEFAULT 'N/A',
  `phone_number` varchar(20) DEFAULT 'N/A',
  `qualifications` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`student_id`),
  UNIQUE KEY `username` (`username`),
  KEY `course_id` (`course_id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students`
--

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` VALUES (27,'Ummu','Dawood','kay@gmail.com','Ummu dahood','$2y$10$jNBagRFUWHIrTGbFPvclremJKMsenXrKCRAGZ7kQHjtrqVyZ44Rb2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'N/A','N/A','N/A',NULL),(26,'AROLAKE','SARO','arolake@gmail.com','lugard','$2y$10$pA1G.HmHQHqYkgaPnV98kOn9qwysAduTRDIjXgWXTz1MENRPMmjFS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'N/A','N/A','N/A',NULL);
/*!40000 ALTER TABLE `students` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-11-17  7:56:55
