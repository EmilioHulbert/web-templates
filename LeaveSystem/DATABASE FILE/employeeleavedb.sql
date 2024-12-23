/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.11.9-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: employeeleavedb
-- ------------------------------------------------------
-- Server version	10.11.9-MariaDB-0+deb12u1

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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(55) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES
(1,'admin','dd2acc2369c32fca70a65234a534442e','Liam Moore','admin@mail.com','2024-12-22 17:03:57');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbldepartments`
--

DROP TABLE IF EXISTS `tbldepartments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbldepartments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `DepartmentName` varchar(150) DEFAULT NULL,
  `DepartmentShortName` varchar(100) NOT NULL,
  `DepartmentCode` varchar(50) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbldepartments`
--

LOCK TABLES `tbldepartments` WRITE;
/*!40000 ALTER TABLE `tbldepartments` DISABLE KEYS */;
INSERT INTO `tbldepartments` VALUES
(1,'Human Resource','HR','HR160','2020-11-01 04:16:25'),
(2,'Information Technology','IT','IT807','2020-11-01 04:19:37'),
(3,'Operations','OP','OP640','2020-12-02 18:28:56'),
(4,'Volunteer','VL','VL9696','2021-03-03 05:27:52'),
(5,'Marketing','MK','MK369','2021-03-03 07:53:52'),
(6,'Finance','FI','FI123','2021-03-03 07:54:27'),
(7,'Sales','SS','SS469','2021-03-03 07:55:24'),
(8,'Research','RS','RS666','2021-03-03 13:39:03');
/*!40000 ALTER TABLE `tbldepartments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblemployees`
--

DROP TABLE IF EXISTS `tblemployees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblemployees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `EmpId` varchar(100) NOT NULL,
  `FirstName` varchar(150) NOT NULL,
  `LastName` varchar(150) NOT NULL,
  `EmailId` varchar(200) NOT NULL,
  `Password` varchar(180) NOT NULL,
  `Department` varchar(255) NOT NULL,
  `Status` int(1) NOT NULL,
  `RegDate` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblemployees`
--

LOCK TABLES `tblemployees` WRITE;
/*!40000 ALTER TABLE `tblemployees` DISABLE KEYS */;
INSERT INTO `tblemployees` VALUES
(1,'ASTR001245','Johnny','test','johnny@mail.com','8c7bec625909e324622568298dfa5cb2','Information Technology',1,'2020-11-10 08:29:59'),
(9,'12','Emilio','Hulbert','emilio@mail.com','25c380b9dbbad71a287ece5c0b8019fd','Finance',1,'2024-11-23 17:06:41'),
(10,'12','Emilio','Hulbert','emilio@mail.com','25c380b9dbbad71a287ece5c0b8019fd','Finance',1,'2024-11-23 17:06:58');
/*!40000 ALTER TABLE `tblemployees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblleaves`
--

DROP TABLE IF EXISTS `tblleaves`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblleaves` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `LeaveType` varchar(110) NOT NULL,
  `ToDate` date DEFAULT NULL,
  `FromDate` date DEFAULT NULL,
  `Description` mediumtext NOT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `AdminRemark` mediumtext DEFAULT NULL,
  `AdminRemarkDate` varchar(120) DEFAULT NULL,
  `Status` int(1) NOT NULL,
  `IsRead` int(1) NOT NULL,
  `empid` int(11) DEFAULT NULL,
  `leave_duration` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `UserEmail` (`empid`)
) ENGINE=InnoDB AUTO_INCREMENT=207 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblleaves`
--

LOCK TABLES `tblleaves` WRITE;
/*!40000 ALTER TABLE `tblleaves` DISABLE KEYS */;
INSERT INTO `tblleaves` VALUES
(195,'Self-Quarantine Leave','2024-11-24','2024-11-30','etst','2024-11-23 18:26:08',NULL,NULL,0,0,1,0),
(196,'Self-Quarantine Leave','2024-11-30','2024-11-24','etst','2024-11-23 18:26:08','qwqw','2024-11-23 18:26:27 ',1,1,1,6),
(197,'Self-Quarantine Leave','2024-11-24','2024-11-30','etst','2024-11-23 18:26:30',NULL,NULL,0,0,1,0),
(198,'Self-Quarantine Leave','2024-11-30','2024-11-24','etst','2024-11-23 18:26:30',NULL,NULL,0,0,1,6),
(199,'Self-Quarantine Leave','2024-11-24','2024-11-30','etst','2024-11-23 18:26:33',NULL,NULL,0,0,1,0),
(200,'Self-Quarantine Leave','2024-11-30','2024-11-24','etst','2024-11-23 18:26:33',NULL,NULL,0,0,1,6),
(201,'Self-Quarantine Leave','2024-11-24','2024-11-30','etst','2024-11-23 18:26:35',NULL,NULL,0,0,1,0),
(202,'Self-Quarantine Leave','2024-11-30','2024-11-24','etst','2024-11-23 18:26:35',NULL,NULL,0,0,1,6),
(203,'Self-Quarantine Leave','2024-11-24','2024-11-30','etst','2024-11-23 18:27:12',NULL,NULL,0,0,1,0),
(204,'Self-Quarantine Leave','2024-11-30','2024-11-24','etst','2024-11-23 18:27:12',NULL,NULL,0,0,1,6),
(205,'Self-Quarantine Leave','2024-11-24','2024-11-30','etst','2024-11-23 18:28:09',NULL,NULL,0,0,1,0),
(206,'Self-Quarantine Leave','2024-11-30','2024-11-24','etst','2024-11-23 18:28:09',NULL,NULL,0,0,1,6);
/*!40000 ALTER TABLE `tblleaves` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblleavetype`
--

DROP TABLE IF EXISTS `tblleavetype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblleavetype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `LeaveType` varchar(200) DEFAULT NULL,
  `Description` mediumtext DEFAULT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblleavetype`
--

LOCK TABLES `tblleavetype` WRITE;
/*!40000 ALTER TABLE `tblleavetype` DISABLE KEYS */;
INSERT INTO `tblleavetype` VALUES
(1,'Casual Leave','Provided for urgent or unforeseen matters to the employees.','2020-11-01 09:07:56'),
(2,'Medical Leave','Related to Health Problems of Employee','2020-11-06 10:16:09'),
(3,'Restricted Holiday','Holiday that is optional','2020-11-06 10:16:38'),
(5,'Paternity Leave','To take care of newborns','2021-03-03 07:46:31'),
(6,'Bereavement Leave','Grieve their loss of losing loved ones','2021-03-03 07:47:48'),
(7,'Compensatory Leave','For Overtime workers','2021-03-03 07:48:37'),
(8,'Maternity Leave','Taking care of newborn ,recoveries','2021-03-03 07:50:17'),
(9,'Religious Holidays','Based on employee\'s followed religion','2021-03-03 07:51:26'),
(10,'Adverse Weather Leave','In terms of extreme weather conditions','2021-03-03 10:18:26'),
(11,'Voting Leave','For official election day','2021-03-03 10:19:06'),
(12,'Self-Quarantine Leave','Related to COVID-19 issues','2021-03-03 10:19:48'),
(13,'Personal Time Off','To manage some private matters','2021-03-03 10:21:10');
/*!40000 ALTER TABLE `tblleavetype` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-22 20:08:48
