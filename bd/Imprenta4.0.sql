CREATE DATABASE  IF NOT EXISTS `imprenta` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `imprenta`;
-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: localhost    Database: imprenta
-- ------------------------------------------------------
-- Server version	8.0.40

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `detalleentrada`
--

DROP TABLE IF EXISTS `detalleentrada`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detalleentrada` (
  `idDetalleEntrada` int NOT NULL AUTO_INCREMENT,
  `idMateriales` int NOT NULL,
  `fechaDetalle` date NOT NULL,
  `proveedor` varchar(255) NOT NULL,
  `factura` int NOT NULL,
  `cantidadResma` int NOT NULL,
  `pliegosResma` int NOT NULL,
  `cantidadPliegos` int NOT NULL,
  `precioPliego` decimal(18,2) NOT NULL,
  `subtotal` decimal(18,2) NOT NULL,
  `descuento` varchar(255) NOT NULL,
  `tipoCambio` decimal(18,2) NOT NULL,
  `precioTotal` decimal(18,2) NOT NULL,
  PRIMARY KEY (`idDetalleEntrada`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalleentrada`
--

LOCK TABLES `detalleentrada` WRITE;
/*!40000 ALTER TABLE `detalleentrada` DISABLE KEYS */;
INSERT INTO `detalleentrada` VALUES (1,1,'2024-04-02','VADI',19084,1,1500,1500,210.00,315000.00,'0',1.00,315000.00),(2,1,'2024-05-21','VADI',19785,1,900,900,210.00,189000.00,'0',1.00,189000.00),(3,1,'2024-06-25','VADI',20225,1,1800,1800,210.00,378000.00,'0',1.00,378000.00),(4,1,'2024-10-11','Mauricio',312,1,1000,1000,210.00,210000.00,'0.00',1.00,210000.00),(5,4,'2024-12-17','Mauricio',1,100,100,100,150.00,15000.00,'0.00',1.00,15000.00),(6,6,'2025-04-20','sebas',1,100,100,100,10.00,1000.00,'0',1.00,1000.00),(9,6,'2025-04-20','Mauricio',3,3,66,66,60.00,3960.00,'0.00',1.00,3960.00),(10,7,'2025-04-20','sebas',1,1,100,150,2.00,300.00,'0.00',1.00,300.00),(12,9,'2025-04-20','sebas',1,1,100,100,1.00,100.00,'0.00',1.00,100.00),(13,10,'2025-04-21','sebas',1,1,200,200,1.00,200.00,'0.00',1.00,200.00),(14,11,'2025-04-21','sebas',1,1,1000,1000,2.00,2000.00,'0.00',1.00,2000.00),(15,11,'2025-04-21','sebas',2,1,600,2000,2.00,4000.00,'0.00',1.00,4000.00),(16,12,'2025-04-21','sebas',1,1,100,100,2.00,200.00,'0.00',1.00,200.00),(17,12,'2025-04-21','sebas',2,1,200,300,2.00,600.00,'0.00',1.00,600.00),(18,13,'2025-04-21','sebas',1,1,1000,1000,2.00,2000.00,'0.00',1.00,2000.00),(19,13,'2025-04-21','sebas',2,1,500,600,2.00,1000.00,'0.00',1.00,1000.00),(20,13,'2025-04-21','sebas',2,1,500,600,2.00,1000.00,'0.00',1.00,1000.00),(21,14,'2025-04-21','sebas',1,1,1000,1000,2.00,2000.00,'0.00',1.00,2000.00),(22,14,'2025-04-21','sebas',2,1,500,500,2.00,1000.00,'0.00',1.00,1000.00),(23,15,'2025-04-21','sebas',1,1,1000,1000,2.00,2000.00,'0.00',1.00,2000.00),(24,16,'2025-04-21','sebas',1,1,1000,1000,2.00,2000.00,'0.00',1.00,2000.00);
/*!40000 ALTER TABLE `detalleentrada` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detallesalida`
--

DROP TABLE IF EXISTS `detallesalida`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detallesalida` (
  `idDetalleSalida` int NOT NULL AUTO_INCREMENT,
  `idMateriales` int NOT NULL,
  `fechaDetalle` date NOT NULL,
  `cliente` varchar(255) NOT NULL,
  `corte` varchar(255) NOT NULL,
  `produccion` varchar(255) NOT NULL,
  `cantidadPliegos` int NOT NULL,
  `precioPliego` decimal(18,2) NOT NULL,
  `tipoCambio` decimal(18,2) NOT NULL,
  `precioTotal` decimal(18,2) NOT NULL,
  PRIMARY KEY (`idDetalleSalida`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detallesalida`
--

LOCK TABLES `detallesalida` WRITE;
/*!40000 ALTER TABLE `detallesalida` DISABLE KEYS */;
INSERT INTO `detallesalida` VALUES (1,1,'2024-12-17','gabriel','1','2',200,120.00,1.00,24000.00),(2,4,'2024-12-17','gabriel','1','2',20,200.00,1.00,4000.00),(3,6,'2025-04-20','gabriel','1','2',50,200.00,1.00,10000.00),(4,8,'2025-04-20','gabriel','1','1',50,5.00,1.00,250.00),(5,9,'2025-04-20','gabriel','1','2',50,2.00,1.00,100.00),(6,10,'2025-04-21','gabriel','1','2',50,2.00,1.00,100.00),(7,11,'2025-04-21','gabriel','1','2',200,2.00,1.00,400.00),(8,12,'2025-04-21','gabriel','1','2',50,4.00,1.00,200.00),(9,14,'2025-04-21','gabriel','1','2',200,4.00,1.00,800.00),(10,15,'2025-04-21','gabriel','1','2',400,4.00,1.00,1600.00),(11,16,'2025-04-21','gabriel','1','2',800,4.00,1.00,3200.00);
/*!40000 ALTER TABLE `detallesalida` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dias_trabajados`
--

DROP TABLE IF EXISTS `dias_trabajados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dias_trabajados` (
  `id` int NOT NULL AUTO_INCREMENT,
  `empleado_id` int NOT NULL,
  `dia` varchar(255) NOT NULL,
  `hora_llegada` varchar(255) NOT NULL,
  `hora_salida` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `empleado_id` (`empleado_id`),
  CONSTRAINT `dias_trabajados_ibfk_1` FOREIGN KEY (`empleado_id`) REFERENCES `horarios_empleados` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4768 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dias_trabajados`
--

LOCK TABLES `dias_trabajados` WRITE;
/*!40000 ALTER TABLE `dias_trabajados` DISABLE KEYS */;
INSERT INTO `dias_trabajados` VALUES (4488,882,'Fri - 15/11/2024','hola',''),(4489,882,'Sat - 16/11/2024','',''),(4490,882,'Sun - 17/11/2024','',''),(4491,882,'Mon - 18/11/2024','',''),(4492,882,'Tue - 19/11/2024','',''),(4493,882,'Wed - 20/11/2024','',''),(4494,882,'Thu - 21/11/2024','',''),(4495,883,'Fri - 15/11/2024','',''),(4496,883,'Sat - 16/11/2024','',''),(4497,883,'Sun - 17/11/2024','',''),(4498,883,'Mon - 18/11/2024','',''),(4499,883,'Tue - 19/11/2024','',''),(4500,883,'Wed - 20/11/2024','',''),(4501,883,'Thu - 21/11/2024','',''),(4502,884,'Fri - 15/11/2024','11/15/2024, 6:09:49 AM','11/15/2024, 5:08:22 PM'),(4503,884,'Sat - 16/11/2024','',''),(4504,884,'Sun - 17/11/2024','',''),(4505,884,'Mon - 18/11/2024','11/18/2024, 6:55:08 AM','11/18/2024, 7:00:25 AM'),(4506,884,'Tue - 19/11/2024','11/19/2024, 6:16:03 AM','11/19/2024, 5:04:15 PM'),(4507,884,'Wed - 20/11/2024','11/20/2024, 6:14:10 AM','11/20/2024, 5:17:44 PM'),(4508,884,'Thu - 21/11/2024','11/21/2024, 6:52:34 AM','11/21/2024, 5:08:35 PM'),(4509,885,'Fri - 15/11/2024','11/15/2024, 6:46:11 AM','11/15/2024, 5:07:04 PM'),(4510,885,'Sat - 16/11/2024','',''),(4511,885,'Sun - 17/11/2024','',''),(4512,885,'Mon - 18/11/2024','11/18/2024, 6:57:36 AM','11/18/2024, 5:34:28 PM'),(4513,885,'Tue - 19/11/2024','11/19/2024, 6:58:05 AM','11/19/2024, 5:06:02 PM'),(4514,885,'Wed - 20/11/2024','11/20/2024, 6:58:33 AM','11/20/2024, 5:05:27 PM'),(4515,885,'Thu - 21/11/2024','11/21/2024, 6:43:32 AM','11/21/2024, 5:05:41 PM'),(4516,886,'Fri - 15/11/2024','11/15/2024, 6:45:20 AM','11/15/2024, 5:04:55 PM'),(4517,886,'Sat - 16/11/2024','11/16/2024, 6:54:22 AM','11/16/2024, 12:02:36 PM'),(4518,886,'Sun - 17/11/2024','',''),(4519,886,'Mon - 18/11/2024','11/18/2024, 6:46:35 AM','11/18/2024, 7:05:45 PM'),(4520,886,'Tue - 19/11/2024','11/19/2024, 6:48:06 AM','11/19/2024, 7:04:00 PM'),(4521,886,'Wed - 20/11/2024','11/20/2024, 6:49:29 AM','11/20/2024, 5:06:24 PM'),(4522,886,'Thu - 21/11/2024','11/21/2024, 6:48:12 AM','11/21/2024, 7:03:12 PM'),(4523,887,'Fri - 15/11/2024','11/15/2024, 6:56:28 AM','11/15/2024, 5:21:00 PM'),(4524,887,'Sat - 16/11/2024','11/16/2024, 7:04:17 AM','11/16/2024, 12:03:41 PM'),(4525,887,'Sun - 17/11/2024','',''),(4526,887,'Mon - 18/11/2024','11/18/2024, 7:05:42 AM','11/18/2024, 7:05:16 PM'),(4527,887,'Tue - 19/11/2024','11/19/2024, 7:00:01 AM','11/19/2024, 7:05:48 PM'),(4528,887,'Wed - 20/11/2024','11/20/2024, 7:02:03 AM','11/20/2024, 5:25:49 PM'),(4529,887,'Thu - 21/11/2024','11/21/2024, 7:03:37 AM','11/21/2024, 7:09:02 PM'),(4530,888,'Fri - 15/11/2024','11/15/2024, 7:50:40 AM','11/15/2024, 5:12:16 PM'),(4531,888,'Sat - 16/11/2024','',''),(4532,888,'Sun - 17/11/2024','',''),(4533,888,'Mon - 18/11/2024','11/18/2024, 6:45:30 AM','11/18/2024, 5:37:08 PM'),(4534,888,'Tue - 19/11/2024','11/19/2024, 6:19:41 AM','11/19/2024, 5:34:55 PM'),(4535,888,'Wed - 20/11/2024','11/20/2024, 5:03:23 PM',''),(4536,888,'Thu - 21/11/2024','11/21/2024, 6:20:45 AM','11/21/2024, 5:21:43 PM'),(4537,889,'Fri - 15/11/2024','',''),(4538,889,'Sat - 16/11/2024','',''),(4539,889,'Sun - 17/11/2024','',''),(4540,889,'Mon - 18/11/2024','',''),(4541,889,'Tue - 19/11/2024','',''),(4542,889,'Wed - 20/11/2024','',''),(4543,889,'Thu - 21/11/2024','',''),(4544,890,'Fri - 15/11/2024','11/15/2024, 6:51:14 AM',''),(4545,890,'Sat - 16/11/2024','',''),(4546,890,'Sun - 17/11/2024','',''),(4547,890,'Mon - 18/11/2024','',''),(4548,890,'Tue - 19/11/2024','11/19/2024, 6:56:28 AM','11/19/2024, 5:07:07 PM'),(4549,890,'Wed - 20/11/2024','',''),(4550,890,'Thu - 21/11/2024','11/21/2024, 6:59:50 AM','11/21/2024, 7:08:59 PM'),(4551,891,'Fri - 15/11/2024','11/15/2024, 7:19:58 AM','11/15/2024, 5:03:05 PM'),(4552,891,'Sat - 16/11/2024','',''),(4553,891,'Sun - 17/11/2024','',''),(4554,891,'Mon - 18/11/2024','11/18/2024, 7:05:59 AM','11/18/2024, 5:34:38 PM'),(4555,891,'Tue - 19/11/2024','11/19/2024, 7:08:32 AM','11/19/2024, 7:04:20 PM'),(4556,891,'Wed - 20/11/2024','11/20/2024, 7:02:37 AM','11/20/2024, 5:04:09 PM'),(4557,891,'Thu - 21/11/2024','11/21/2024, 7:03:25 AM','11/21/2024, 7:03:25 PM'),(4558,892,'Fri - 15/11/2024','11/15/2024, 7:03:28 AM','11/15/2024, 5:17:31 PM'),(4559,892,'Sat - 16/11/2024','',''),(4560,892,'Sun - 17/11/2024','',''),(4561,892,'Mon - 18/11/2024','11/18/2024, 6:46:29 AM','11/18/2024, 5:34:33 PM'),(4562,892,'Tue - 19/11/2024','11/19/2024, 6:43:48 AM','11/19/2024, 5:11:30 PM'),(4563,892,'Wed - 20/11/2024','11/20/2024, 7:03:49 AM','11/20/2024, 7:05:50 PM'),(4564,892,'Thu - 21/11/2024','11/21/2024, 7:04:14 AM','11/21/2024, 5:05:16 PM'),(4565,893,'Fri - 15/11/2024','11/15/2024, 7:07:01 AM','11/15/2024, 4:03:36 PM'),(4566,893,'Sat - 16/11/2024','',''),(4567,893,'Sun - 17/11/2024','',''),(4568,893,'Mon - 18/11/2024','11/18/2024, 7:07:31 AM','11/18/2024, 5:47:36 PM'),(4569,893,'Tue - 19/11/2024','11/19/2024, 7:20:59 AM','11/19/2024, 5:08:52 PM'),(4570,893,'Wed - 20/11/2024','11/20/2024, 7:26:57 AM','11/20/2024, 4:18:42 PM'),(4571,893,'Thu - 21/11/2024','11/21/2024, 7:03:50 AM','11/21/2024, 6:11:28 PM'),(4572,894,'Fri - 15/11/2024','11/15/2024, 6:22:52 AM','11/15/2024, 4:34:27 PM'),(4573,894,'Sat - 16/11/2024','',''),(4574,894,'Sun - 17/11/2024','',''),(4575,894,'Mon - 18/11/2024','11/18/2024, 7:00:31 AM','11/18/2024, 5:33:37 PM'),(4576,894,'Tue - 19/11/2024','11/19/2024, 6:53:36 AM','11/19/2024, 7:06:47 PM'),(4577,894,'Wed - 20/11/2024','11/20/2024, 7:03:04 AM','11/20/2024, 5:06:43 PM'),(4578,894,'Thu - 21/11/2024','11/21/2024, 7:03:21 AM','11/21/2024, 5:05:03 PM'),(4579,895,'Fri - 15/11/2024','11/15/2024, 7:00:18 AM','11/15/2024, 5:03:24 PM'),(4580,895,'Sat - 16/11/2024','',''),(4581,895,'Sun - 17/11/2024','',''),(4582,895,'Mon - 18/11/2024','11/18/2024, 6:56:43 AM','11/18/2024, 7:04:14 PM'),(4583,895,'Tue - 19/11/2024','11/19/2024, 6:59:21 AM','11/19/2024, 7:05:02 PM'),(4584,895,'Wed - 20/11/2024','11/20/2024, 6:52:18 AM','11/20/2024, 5:04:47 PM'),(4585,895,'Thu - 21/11/2024','11/21/2024, 6:54:55 AM','11/21/2024, 6:58:30 PM'),(4586,896,'Fri - 15/11/2024','11/15/2024, 6:04:10 AM','11/15/2024, 5:07:23 PM'),(4587,896,'Sat - 16/11/2024','11/16/2024, 5:49:20 AM','11/16/2024, 2:07:13 PM'),(4588,896,'Sun - 17/11/2024','',''),(4589,896,'Mon - 18/11/2024','11/18/2024, 6:04:34 AM','11/18/2024, 7:24:24 PM'),(4590,896,'Tue - 19/11/2024','11/19/2024, 5:48:48 AM','11/19/2024, 5:06:29 PM'),(4591,896,'Wed - 20/11/2024','11/20/2024, 6:03:55 AM','11/20/2024, 5:21:03 PM'),(4592,896,'Thu - 21/11/2024','11/21/2024, 6:07:11 AM','11/21/2024, 6:12:04 PM'),(4593,897,'Fri - 15/11/2024','11/15/2024, 6:40:43 AM','11/15/2024, 5:04:07 PM'),(4594,897,'Sat - 16/11/2024','',''),(4595,897,'Sun - 17/11/2024','',''),(4596,897,'Mon - 18/11/2024','11/18/2024, 9:35:35 AM','11/18/2024, 5:33:33 PM'),(4597,897,'Tue - 19/11/2024','11/19/2024, 7:14:13 AM','11/19/2024, 5:06:22 PM'),(4598,897,'Wed - 20/11/2024','11/20/2024, 7:00:28 AM','11/20/2024, 5:06:35 PM'),(4599,897,'Thu - 21/11/2024','11/21/2024, 7:13:52 AM','11/21/2024, 5:04:23 PM'),(4600,898,'Fri - 15/11/2024','11/15/2024, 6:57:39 AM','11/15/2024, 5:06:46 PM'),(4601,898,'Sat - 16/11/2024','',''),(4602,898,'Sun - 17/11/2024','',''),(4603,898,'Mon - 18/11/2024','11/18/2024, 7:02:53 AM','11/18/2024, 5:06:40 PM'),(4604,898,'Tue - 19/11/2024','11/19/2024, 7:00:23 AM','11/19/2024, 5:19:45 PM'),(4605,898,'Wed - 20/11/2024','11/20/2024, 6:59:05 AM','11/20/2024, 5:02:51 PM'),(4606,898,'Thu - 21/11/2024','11/21/2024, 6:58:16 AM','11/21/2024, 5:08:47 PM'),(4607,899,'Fri - 15/11/2024','11/15/2024, 8:32:34 AM','11/15/2024, 4:02:50 PM'),(4608,899,'Sat - 16/11/2024','',''),(4609,899,'Sun - 17/11/2024','',''),(4610,899,'Mon - 18/11/2024','11/18/2024, 8:28:46 AM','11/18/2024, 5:46:31 PM'),(4611,899,'Tue - 19/11/2024','11/19/2024, 8:22:08 AM','11/19/2024, 5:09:32 PM'),(4612,899,'Wed - 20/11/2024','11/20/2024, 8:13:13 AM','11/20/2024, 5:04:56 PM'),(4613,899,'Thu - 21/11/2024','11/21/2024, 8:51:29 AM',''),(4614,900,'Fri - 15/11/2024','11/15/2024, 6:22:57 AM','11/15/2024, 4:37:00 PM'),(4615,900,'Sat - 16/11/2024','',''),(4616,900,'Sun - 17/11/2024','',''),(4617,900,'Mon - 18/11/2024','11/18/2024, 7:08:08 AM','11/18/2024, 5:34:55 PM'),(4618,900,'Tue - 19/11/2024','11/19/2024, 6:56:13 AM','11/19/2024, 5:04:20 PM'),(4619,900,'Wed - 20/11/2024','11/20/2024, 7:03:20 AM','11/20/2024, 5:07:26 PM'),(4620,900,'Thu - 21/11/2024','11/21/2024, 7:03:17 AM','11/21/2024, 5:04:26 PM'),(4621,901,'Fri - 15/11/2024','11/15/2024, 6:33:48 AM','11/15/2024, 5:01:50 PM'),(4622,901,'Sat - 16/11/2024','11/16/2024, 5:41:02 AM','11/16/2024, 1:01:57 PM'),(4623,901,'Sun - 17/11/2024','',''),(4624,901,'Mon - 18/11/2024','11/18/2024, 6:33:29 AM','11/18/2024, 5:02:09 PM'),(4625,901,'Tue - 19/11/2024','11/19/2024, 5:33:07 PM',''),(4626,901,'Wed - 20/11/2024','11/20/2024, 5:55:55 AM','11/20/2024, 5:30:39 PM'),(4627,901,'Thu - 21/11/2024','11/21/2024, 6:56:29 AM','11/21/2024, 6:02:04 PM'),(4628,902,'Fri - 15/11/2024','11/15/2024, 7:03:23 AM','11/15/2024, 5:04:20 PM'),(4629,902,'Sat - 16/11/2024','',''),(4630,902,'Sun - 17/11/2024','',''),(4631,902,'Mon - 18/11/2024','11/18/2024, 7:02:24 AM','11/18/2024, 5:34:24 PM'),(4632,902,'Tue - 19/11/2024','11/19/2024, 7:02:53 AM','11/19/2024, 5:07:15 PM'),(4633,902,'Wed - 20/11/2024','11/20/2024, 7:03:36 AM','11/20/2024, 5:06:51 PM'),(4634,902,'Thu - 21/11/2024','11/21/2024, 7:03:33 AM','11/21/2024, 5:05:47 PM'),(4635,903,'Fri - 15/11/2024','11/15/2024, 6:57:41 AM','11/15/2024, 5:02:35 PM'),(4636,903,'Sat - 16/11/2024','11/16/2024, 5:50:43 AM','11/16/2024, 1:02:15 PM'),(4637,903,'Sun - 17/11/2024','',''),(4638,903,'Mon - 18/11/2024','11/18/2024, 6:56:21 AM','11/18/2024, 7:35:09 PM'),(4639,903,'Tue - 19/11/2024','11/19/2024, 5:52:48 AM',''),(4640,903,'Wed - 20/11/2024','11/20/2024, 5:48:37 AM','11/20/2024, 6:23:27 PM'),(4641,903,'Thu - 21/11/2024','11/21/2024, 5:45:11 AM','11/21/2024, 6:23:51 PM'),(4642,904,'Fri - 15/11/2024','11/15/2024, 6:57:54 AM','11/15/2024, 5:05:33 PM'),(4643,904,'Sat - 16/11/2024','',''),(4644,904,'Sun - 17/11/2024','',''),(4645,904,'Mon - 18/11/2024','11/18/2024, 7:05:56 PM',''),(4646,904,'Tue - 19/11/2024','11/19/2024, 7:01:16 AM','11/19/2024, 7:04:14 PM'),(4647,904,'Wed - 20/11/2024','11/20/2024, 7:04:30 AM','11/20/2024, 7:04:06 PM'),(4648,904,'Thu - 21/11/2024','11/21/2024, 6:52:21 AM','11/21/2024, 5:08:14 PM'),(4649,905,'Fri - 15/11/2024','11/15/2024, 7:06:40 AM','11/15/2024, 5:05:51 PM'),(4650,905,'Sat - 16/11/2024','',''),(4651,905,'Sun - 17/11/2024','',''),(4652,905,'Mon - 18/11/2024','11/18/2024, 7:08:32 AM','11/18/2024, 3:04:46 PM'),(4653,905,'Tue - 19/11/2024','11/19/2024, 7:08:56 AM','11/19/2024, 5:07:26 PM'),(4654,905,'Wed - 20/11/2024','11/20/2024, 7:11:52 AM','11/20/2024, 5:07:13 PM'),(4655,905,'Thu - 21/11/2024','11/21/2024, 7:00:49 AM',''),(4656,906,'Fri - 15/11/2024','11/15/2024, 6:57:46 AM','11/15/2024, 5:17:52 PM'),(4657,906,'Sat - 16/11/2024','',''),(4658,906,'Sun - 17/11/2024','',''),(4659,906,'Mon - 18/11/2024','11/18/2024, 8:17:28 AM','11/18/2024, 1:30:24 PM'),(4660,906,'Tue - 19/11/2024','',''),(4661,906,'Wed - 20/11/2024','11/20/2024, 6:58:30 AM','11/20/2024, 5:42:07 PM'),(4662,906,'Thu - 21/11/2024','11/21/2024, 6:59:13 AM','11/21/2024, 5:05:19 PM'),(4663,907,'Fri - 15/11/2024','11/15/2024, 6:52:59 AM','11/15/2024, 5:10:31 PM'),(4664,907,'Sat - 16/11/2024','11/16/2024, 7:05:11 AM','11/16/2024, 12:10:03 PM'),(4665,907,'Sun - 17/11/2024','',''),(4666,907,'Mon - 18/11/2024','11/18/2024, 6:52:53 AM','11/18/2024, 7:08:11 PM'),(4667,907,'Tue - 19/11/2024','11/19/2024, 5:11:22 AM','11/19/2024, 7:43:11 PM'),(4668,907,'Wed - 20/11/2024','11/20/2024, 5:12:40 AM','11/20/2024, 5:31:43 PM'),(4669,907,'Thu - 21/11/2024','11/21/2024, 7:04:36 AM','11/21/2024, 5:08:41 PM'),(4670,908,'Fri - 15/11/2024','11/15/2024, 6:30:29 AM','11/15/2024, 5:09:27 PM'),(4671,908,'Sat - 16/11/2024','',''),(4672,908,'Sun - 17/11/2024','',''),(4673,908,'Mon - 18/11/2024','11/18/2024, 6:08:36 AM','11/18/2024, 7:26:52 PM'),(4674,908,'Tue - 19/11/2024','11/19/2024, 6:15:23 AM','11/19/2024, 7:13:01 PM'),(4675,908,'Wed - 20/11/2024','11/20/2024, 6:12:04 AM','11/20/2024, 7:17:55 PM'),(4676,908,'Thu - 21/11/2024','11/21/2024, 6:09:03 AM','11/21/2024, 7:04:08 PM'),(4677,909,'Fri - 15/11/2024','',''),(4678,909,'Sat - 16/11/2024','',''),(4679,909,'Sun - 17/11/2024','',''),(4680,909,'Mon - 18/11/2024','',''),(4681,909,'Tue - 19/11/2024','',''),(4682,909,'Wed - 20/11/2024','',''),(4683,909,'Thu - 21/11/2024','',''),(4684,910,'Fri - 15/11/2024','11/15/2024, 7:02:15 AM','11/15/2024, 5:08:31 PM'),(4685,910,'Sat - 16/11/2024','',''),(4686,910,'Sun - 17/11/2024','',''),(4687,910,'Mon - 18/11/2024','11/18/2024, 6:48:39 AM','11/18/2024, 5:03:26 PM'),(4688,910,'Tue - 19/11/2024','11/19/2024, 7:06:21 AM','11/19/2024, 5:05:43 PM'),(4689,910,'Wed - 20/11/2024','11/20/2024, 7:04:36 AM','11/20/2024, 4:41:50 PM'),(4690,910,'Thu - 21/11/2024','11/21/2024, 6:59:43 AM','11/21/2024, 5:33:41 PM'),(4691,911,'Fri - 15/11/2024','11/15/2024, 6:47:58 AM','11/15/2024, 5:02:05 PM'),(4692,911,'Sat - 16/11/2024','11/16/2024, 7:18:58 AM','11/16/2024, 1:02:50 PM'),(4693,911,'Sun - 17/11/2024','',''),(4694,911,'Mon - 18/11/2024','11/18/2024, 6:34:39 AM','11/18/2024, 6:50:10 AM'),(4695,911,'Tue - 19/11/2024','11/19/2024, 5:43:28 PM',''),(4696,911,'Wed - 20/11/2024','11/20/2024, 5:55:51 AM','11/20/2024, 6:07:40 PM'),(4697,911,'Thu - 21/11/2024','11/21/2024, 7:16:01 AM','11/21/2024, 6:10:48 PM'),(4698,912,'Fri - 15/11/2024','11/15/2024, 6:57:06 AM','11/15/2024, 5:04:04 PM'),(4699,912,'Sat - 16/11/2024','',''),(4700,912,'Sun - 17/11/2024','',''),(4701,912,'Mon - 18/11/2024','11/18/2024, 6:55:35 AM','11/18/2024, 5:35:11 PM'),(4702,912,'Tue - 19/11/2024','11/19/2024, 7:10:19 AM','11/19/2024, 6:05:55 PM'),(4703,912,'Wed - 20/11/2024','11/20/2024, 7:09:15 AM','11/20/2024, 5:03:30 PM'),(4704,912,'Thu - 21/11/2024','11/21/2024, 7:08:35 AM','11/21/2024, 5:04:48 PM'),(4705,913,'Fri - 15/11/2024','11/15/2024, 7:05:00 AM','11/15/2024, 5:04:01 PM'),(4706,913,'Sat - 16/11/2024','',''),(4707,913,'Sun - 17/11/2024','',''),(4708,913,'Mon - 18/11/2024','11/18/2024, 6:52:22 AM','11/18/2024, 5:33:50 PM'),(4709,913,'Tue - 19/11/2024','11/19/2024, 6:49:19 AM','11/19/2024, 5:04:09 PM'),(4710,913,'Wed - 20/11/2024','11/20/2024, 6:50:31 AM','11/20/2024, 5:03:35 PM'),(4711,913,'Thu - 21/11/2024','11/21/2024, 6:58:00 AM',''),(4712,914,'Fri - 15/11/2024','11/15/2024, 9:02:55 AM','11/15/2024, 5:02:47 PM'),(4713,914,'Sat - 16/11/2024','',''),(4714,914,'Sun - 17/11/2024','',''),(4715,914,'Mon - 18/11/2024','11/18/2024, 7:18:58 AM','11/18/2024, 5:37:12 PM'),(4716,914,'Tue - 19/11/2024','11/19/2024, 7:11:56 AM','11/19/2024, 5:00:58 PM'),(4717,914,'Wed - 20/11/2024','11/20/2024, 7:13:36 AM','11/20/2024, 5:03:08 PM'),(4718,914,'Thu - 21/11/2024','11/21/2024, 7:10:38 AM','11/21/2024, 5:03:24 PM'),(4719,915,'Fri - 15/11/2024','11/15/2024, 6:48:41 AM','11/15/2024, 5:03:37 PM'),(4720,915,'Sat - 16/11/2024','',''),(4721,915,'Sun - 17/11/2024','',''),(4722,915,'Mon - 18/11/2024','11/18/2024, 6:38:44 AM','11/18/2024, 7:02:35 PM'),(4723,915,'Tue - 19/11/2024','11/19/2024, 6:53:50 AM','11/19/2024, 5:04:58 PM'),(4724,915,'Wed - 20/11/2024','11/20/2024, 6:44:06 AM','11/20/2024, 7:03:01 PM'),(4725,915,'Thu - 21/11/2024','11/21/2024, 6:45:01 AM','11/21/2024, 5:04:02 PM'),(4726,916,'Fri - 15/11/2024','11/15/2024, 7:19:07 AM','11/15/2024, 5:02:41 PM'),(4727,916,'Sat - 16/11/2024','11/16/2024, 6:08:10 AM','11/16/2024, 1:02:05 PM'),(4728,916,'Sun - 17/11/2024','',''),(4729,916,'Mon - 18/11/2024','11/18/2024, 6:37:23 AM',''),(4730,916,'Tue - 19/11/2024','11/19/2024, 7:05:08 AM','11/19/2024, 7:03:09 PM'),(4731,916,'Wed - 20/11/2024','11/20/2024, 6:58:46 AM','11/20/2024, 6:03:27 PM'),(4732,916,'Thu - 21/11/2024','11/21/2024, 6:42:52 AM','11/21/2024, 5:02:38 PM'),(4733,917,'Fri - 15/11/2024','11/15/2024, 8:31:14 AM','11/15/2024, 5:03:48 PM'),(4734,917,'Sat - 16/11/2024','11/16/2024, 8:14:53 AM','11/16/2024, 12:04:37 PM'),(4735,917,'Sun - 17/11/2024','',''),(4736,917,'Mon - 18/11/2024','11/18/2024, 7:19:36 AM','11/18/2024, 7:03:01 PM'),(4737,917,'Tue - 19/11/2024','11/19/2024, 7:04:04 AM','11/19/2024, 4:01:38 PM'),(4738,917,'Wed - 20/11/2024','11/20/2024, 7:01:43 AM','11/20/2024, 7:03:04 PM'),(4739,917,'Thu - 21/11/2024','11/21/2024, 6:59:00 AM','11/21/2024, 5:04:41 PM'),(4740,918,'Fri - 15/11/2024','11/15/2024, 7:03:44 AM','11/15/2024, 5:01:58 PM'),(4741,918,'Sat - 16/11/2024','',''),(4742,918,'Sun - 17/11/2024','',''),(4743,918,'Mon - 18/11/2024','11/18/2024, 7:13:23 AM','11/18/2024, 7:35:12 PM'),(4744,918,'Tue - 19/11/2024','11/19/2024, 5:59:31 AM','11/19/2024, 6:04:32 PM'),(4745,918,'Wed - 20/11/2024','',''),(4746,918,'Thu - 21/11/2024','11/21/2024, 6:18:53 AM','11/21/2024, 6:10:51 PM'),(4747,919,'Fri - 15/11/2024','11/15/2024, 5:59:25 AM','11/15/2024, 5:03:56 PM'),(4748,919,'Sat - 16/11/2024','',''),(4749,919,'Sun - 17/11/2024','',''),(4750,919,'Mon - 18/11/2024','11/18/2024, 11:14:28 AM','11/18/2024, 7:03:42 PM'),(4751,919,'Tue - 19/11/2024','11/19/2024, 6:18:33 AM','11/19/2024, 5:03:27 PM'),(4752,919,'Wed - 20/11/2024','11/20/2024, 6:14:59 AM','11/20/2024, 5:03:16 PM'),(4753,919,'Thu - 21/11/2024','11/21/2024, 6:14:59 AM','11/21/2024, 5:03:40 PM'),(4754,920,'Fri - 15/11/2024','11/15/2024, 7:06:48 AM','11/15/2024, 5:03:16 PM'),(4755,920,'Sat - 16/11/2024','',''),(4756,920,'Sun - 17/11/2024','',''),(4757,920,'Mon - 18/11/2024','11/18/2024, 7:03:25 AM','11/18/2024, 5:34:06 PM'),(4758,920,'Tue - 19/11/2024','11/19/2024, 7:02:58 AM','11/19/2024, 5:05:03 PM'),(4759,920,'Wed - 20/11/2024','11/20/2024, 7:02:42 AM','11/20/2024, 5:04:39 PM'),(4760,920,'Thu - 21/11/2024','11/21/2024, 7:03:07 AM','11/21/2024, 5:03:48 PM'),(4761,921,'Fri - 15/11/2024','11/15/2024, 7:06:36 AM',''),(4762,921,'Sat - 16/11/2024','',''),(4763,921,'Sun - 17/11/2024','',''),(4764,921,'Mon - 18/11/2024','11/18/2024, 7:08:40 AM','11/18/2024, 5:58:07 PM'),(4765,921,'Tue - 19/11/2024','11/19/2024, 7:02:26 AM','11/19/2024, 5:24:46 PM'),(4766,921,'Wed - 20/11/2024','11/20/2024, 7:08:40 AM','11/20/2024, 5:37:46 PM'),(4767,921,'Thu - 21/11/2024','11/21/2024, 7:07:58 AM','11/21/2024, 5:12:08 PM');
/*!40000 ALTER TABLE `dias_trabajados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empleados`
--

DROP TABLE IF EXISTS `empleados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `empleados` (
  `id` int NOT NULL AUTO_INCREMENT,
  `identificacion` varchar(20) DEFAULT NULL,
  `numero_asegurado` varchar(20) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `primer_apellido` varchar(50) DEFAULT NULL,
  `segundo_apellido` varchar(50) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `edad` int DEFAULT NULL,
  `telefono1` varchar(15) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `sexo` enum('M','F','Otro') DEFAULT NULL,
  `estado_civil` enum('Soltero','Casado','Divorciado','Viudo') DEFAULT NULL,
  `lugar_nacimiento` varchar(100) DEFAULT NULL,
  `nacionalidad` varchar(50) DEFAULT NULL,
  `direccion_domicilio` text,
  `telefono2` varchar(15) DEFAULT NULL,
  `nombre_contacto1` varchar(50) DEFAULT NULL,
  `parentesco_contacto1` varchar(50) DEFAULT NULL,
  `telefono_contacto1` varchar(15) DEFAULT NULL,
  `direccion_contacto1` text,
  `nombre_contacto2` varchar(50) DEFAULT NULL,
  `parentesco_contacto2` varchar(50) DEFAULT NULL,
  `telefono_contacto2` varchar(15) DEFAULT NULL,
  `direccion_contacto2` text,
  `tipo_sangre` varchar(5) DEFAULT NULL,
  `padecimientos` text,
  `discapacidades` text,
  `intervenciones` text,
  `uso_aparatos` text,
  `medicamentos` text,
  `dosificacion` text,
  `frecuencia` text,
  `proposito` text,
  `fecha_ingreso` date DEFAULT NULL,
  `jefe_supervisor` varchar(100) DEFAULT NULL,
  `puesto_actual` varchar(100) DEFAULT NULL,
  `ultimo_grado_estudio` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleados`
--

LOCK TABLES `empleados` WRITE;
/*!40000 ALTER TABLE `empleados` DISABLE KEYS */;
INSERT INTO `empleados` VALUES (28,'116860425',NULL,'Stephanie María','Rojas','Ulate','1997-09-07',25,'86055690','sm.rojas97@hotmail.com','F','Soltero','San José','Costarricense','San Rafael Arriba, Desamparados',NULL,'Michael Rojas','Hermano','86611995','Cartago','Xinia Ulate','Mamá','88702596','San rafael arriba, desamparados',NULL,'Ninguno','Ninguno','Osteomelitis, cuerdas vocales','Anteojos','No',NULL,NULL,NULL,'2021-09-01','Gerente General','Crédito y Cobro','Licenciatura Universitaria Completa');
/*!40000 ALTER TABLE `empleados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `events` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text,
  `url` varchar(255) DEFAULT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `CausaCambio` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (1,'prueba','prueba','','2025-04-23 00:00:00','2025-04-24 00:00:00',NULL),(2,'prueba2','prueba2','','2025-04-22 00:00:00','2025-04-23 00:00:00',NULL),(3,'prueba3','','','2025-04-21 00:00:00','2025-04-22 00:00:00',NULL),(4,'carton','','','2025-04-24 00:00:00','2025-04-25 00:00:00',NULL),(5,'prueba','','','2025-04-25 00:00:00','2025-04-26 00:00:00',NULL),(6,'prueba','','','2025-04-26 00:00:00','2025-04-27 00:00:00',NULL),(7,'prueba','','','2025-04-27 00:00:00','2025-04-28 00:00:00',NULL),(8,'prueba','','','2025-04-29 00:00:00','2025-04-30 00:00:00',NULL),(9,'prueba2','','','2025-04-28 00:00:00','2025-04-29 00:00:00',NULL),(10,'prueba2','','','2025-04-30 00:00:00','2025-05-01 00:00:00',NULL),(11,'prueba','','','2025-04-20 00:00:00','2025-04-21 00:00:00',NULL);
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `horarios_empleados`
--

DROP TABLE IF EXISTS `horarios_empleados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `horarios_empleados` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `periodo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=922 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `horarios_empleados`
--

LOCK TABLES `horarios_empleados` WRITE;
/*!40000 ALTER TABLE `horarios_empleados` DISABLE KEYS */;
INSERT INTO `horarios_empleados` VALUES (882,'Michael Rojas','15/11/2024 - 21/11/2024'),(883,'Stephanie Rojas','15/11/2024 - 21/11/2024'),(884,'NIDIA ROJAS','15/11/2024 - 21/11/2024'),(885,'ELIAS SALAZAR','15/11/2024 - 21/11/2024'),(886,'MARTÍN VARGAS','15/11/2024 - 21/11/2024'),(887,'ANA YANEY MOLINA','15/11/2024 - 21/11/2024'),(888,'HERNÁN MANCIA','15/11/2024 - 21/11/2024'),(889,'MICHAEL MADRIGAL','15/11/2024 - 21/11/2024'),(890,'YENDRY CALDERÓN','15/11/2024 - 21/11/2024'),(891,'JAVIER CAMPOS','15/11/2024 - 21/11/2024'),(892,'MAURICIO ARCE','15/11/2024 - 21/11/2024'),(893,'LEONARDO NÚÑEZ','15/11/2024 - 21/11/2024'),(894,'ANA GUTIÉRREZ','15/11/2024 - 21/11/2024'),(895,'VIRGINIA JIMÉNEZ','15/11/2024 - 21/11/2024'),(896,'LUIS LEÓN','15/11/2024 - 21/11/2024'),(897,'CRISTOPHER SANTAMARÍA','15/11/2024 - 21/11/2024'),(898,'WILLIAM SÁNCHEZ','15/11/2024 - 21/11/2024'),(899,'BRANDON SÁNCHEZ','15/11/2024 - 21/11/2024'),(900,'ESTEBAN CALDERÓN','15/11/2024 - 21/11/2024'),(901,'ALEXANDER ARAYA','15/11/2024 - 21/11/2024'),(902,'JAIRO BALTODAÑO','15/11/2024 - 21/11/2024'),(903,'ESTEBAN ABARCA','15/11/2024 - 21/11/2024'),(904,'MOISÉS MORA','15/11/2024 - 21/11/2024'),(905,'GEOVANNY BARBOZA','15/11/2024 - 21/11/2024'),(906,'XINIA ROJAS','15/11/2024 - 21/11/2024'),(907,'ROBERTH LEÓN','15/11/2024 - 21/11/2024'),(908,'DANILO BARQUERO','15/11/2024 - 21/11/2024'),(909,'JULIO BARRANTES','15/11/2024 - 21/11/2024'),(910,'ERICK ESQUIVEL','15/11/2024 - 21/11/2024'),(911,'JOSÉ MADRIGAL','15/11/2024 - 21/11/2024'),(912,'GLORIA ELENA VASQUEZ BARRERA','15/11/2024 - 21/11/2024'),(913,'DYLAN  FLORES','15/11/2024 - 21/11/2024'),(914,'DENNIS JAEN','15/11/2024 - 21/11/2024'),(915,'HUGO QUESADA FALLAS','15/11/2024 - 21/11/2024'),(916,'MARCO ÁLVAREZ','15/11/2024 - 21/11/2024'),(917,'CARLOS ANDRÉS VEGA LEÓN','15/11/2024 - 21/11/2024'),(918,'DUJARDI ORTIZ','15/11/2024 - 21/11/2024'),(919,'RAFAEL ÁNGEL CALDERÓN SALAS','15/11/2024 - 21/11/2024'),(920,'JEAN CARLO ROJAS ROJAS','15/11/2024 - 21/11/2024'),(921,'ALEXANDER RODRIGUEZ GONZALEZ','15/11/2024 - 21/11/2024');
/*!40000 ALTER TABLE `horarios_empleados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materiales`
--

DROP TABLE IF EXISTS `materiales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `materiales` (
  `idMateriales` int NOT NULL AUTO_INCREMENT,
  `Material` varchar(500) DEFAULT NULL,
  `Cantidad_Inventario` varchar(500) DEFAULT NULL,
  `Valor_Inventario` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`idMateriales`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materiales`
--

LOCK TABLES `materiales` WRITE;
/*!40000 ALTER TABLE `materiales` DISABLE KEYS */;
INSERT INTO `materiales` VALUES (4,'prueba','80','11000'),(6,'sebas','120','3968.00'),(10,'mauricio','50','50'),(13,'pruebaFinal','2100','4200.00'),(14,'carton','1300','2800'),(16,'papel','200','400');
/*!40000 ALTER TABLE `materiales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rol`
--

DROP TABLE IF EXISTS `rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rol` (
  `idRol` int NOT NULL,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`idRol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rol`
--

LOCK TABLES `rol` WRITE;
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` VALUES (1,'admin');
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `idUsuario` int NOT NULL AUTO_INCREMENT,
  `nombreUsu` varchar(45) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `apellido2` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `clave` varchar(45) NOT NULL,
  `activo` varchar(45) NOT NULL,
  `idRol` varchar(45) NOT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'admin','admin','admin','admin','admin@gmail.com','admin','1','1');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'imprenta'
--

--
-- Dumping routines for database 'imprenta'
--
/*!50003 DROP PROCEDURE IF EXISTS `agregarEntradaMaterial` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `agregarEntradaMaterial`(
    IN p_idMateriales INT,
    IN p_proveedor VARCHAR(255),
    IN p_factura VARCHAR(255),
    IN p_cantidadResma INT,
    IN p_pliegosResma INT,
    IN p_cantidadPliegos INT,
    IN p_precioPliego DECIMAL(10, 2),
    IN p_descuento DECIMAL(10, 2),
    IN p_tipoCambio DECIMAL(10, 2)
)
BEGIN
    DECLARE subtotal DECIMAL(10, 2);
    DECLARE precioTotal DECIMAL(10, 2);
    DECLARE cantidadInventario INT;
    DECLARE valorInventario DECIMAL(10, 2);
    DECLARE exit handler for sqlexception
        BEGIN
            -- Rollback en caso de error
            ROLLBACK;
        END;

    -- Iniciar la transacción
    START TRANSACTION;

    -- Calcular subtotal
    SET subtotal = p_precioPliego * p_cantidadPliegos;

    -- Calcular precio total
    SET precioTotal = (subtotal - p_descuento) * p_tipoCambio;

    -- Obtener la cantidad de inventario actual y el valor actual del inventario
    SELECT Cantidad_Inventario, Valor_Inventario INTO cantidadInventario, valorInventario
    FROM materiales
    WHERE idMateriales = p_idMateriales
    FOR UPDATE;

    -- Verificar si se encontró el material
    IF cantidadInventario IS NULL THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Material no encontrado';
    END IF;

    -- Actualizar la tabla detalleentrada
    INSERT INTO detalleentrada (
        idMateriales,
        fechaDetalle,
        proveedor,
        factura,
        cantidadResma,
        pliegosResma,
        cantidadPliegos,
        precioPliego,
        subtotal,
        descuento,
        tipoCambio,
        precioTotal
    )
    VALUES (
        p_idMateriales,
        NOW(),  -- fechaDetalle se establece automáticamente
        p_proveedor,
        p_factura,
        p_cantidadResma,
        p_pliegosResma,
        p_cantidadPliegos,
        p_precioPliego,
        subtotal,
        p_descuento,
        p_tipoCambio,
        precioTotal
    );

    -- Actualizar la cantidad de inventario y el valor de inventario
    UPDATE materiales
    SET Cantidad_Inventario = cantidadInventario + p_cantidadPliegos,
        Valor_Inventario = valorInventario + precioTotal
    WHERE idMateriales = p_idMateriales;

    -- Confirmar la transacción
    COMMIT;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `agregarMaterial` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `agregarMaterial`(
    IN materialName VARCHAR(255)  -- Parámetro de entrada
)
BEGIN
    -- Inserta el nuevo material con Cantidad_Inventario y Valor_Inventario en 0
    INSERT INTO imprenta.materiales (Material, Cantidad_Inventario, Valor_Inventario)
    VALUES (materialName, 0, 0);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `agregarSalidaMaterial` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `agregarSalidaMaterial`(
    IN p_idMateriales INT,
    IN p_cliente VARCHAR(255),
    IN p_corte VARCHAR(255),
    IN p_produccion VARCHAR(255),
    IN p_cantidadPliegos INT,
    IN p_precioPliego DECIMAL(10, 2),
    IN p_tipoCambio DECIMAL(10, 2)
)
BEGIN
    -- Declarar variables locales
    DECLARE precioTotal DECIMAL(10, 2);
    DECLARE cantidadInventario INT;
    DECLARE valorInventario DECIMAL(10, 2);
    DECLARE costoUnitarioCompra DECIMAL(10, 2);
    DECLARE costoTotalSalida DECIMAL(10, 2);

    -- Calcular el precio total de la salida en base al precio de venta
    SET precioTotal = (p_precioPliego * p_cantidadPliegos) * p_tipoCambio;

    -- Obtener la cantidad y valor actual del inventario
    SELECT Cantidad_Inventario, Valor_Inventario 
    INTO cantidadInventario, valorInventario
    FROM materiales
    WHERE idMateriales = p_idMateriales;

    -- Obtener el precio unitario de compra más reciente del material
    SELECT precioPliego
    INTO costoUnitarioCompra
    FROM detalleentrada
    WHERE idMateriales = p_idMateriales
    ORDER BY fechaDetalle DESC
    LIMIT 1;

    -- Calcular el costo total de salida basado en el precio de compra
    SET costoTotalSalida = costoUnitarioCompra * p_cantidadPliegos;

    -- Verificar si hay suficiente inventario disponible
    IF cantidadInventario >= p_cantidadPliegos THEN
        -- Insertar los detalles de la salida
        INSERT INTO detallesalida (
            idMateriales,
            fechaDetalle,
            cliente,
            corte,
            produccion,
            cantidadPliegos,
            precioPliego,
            tipoCambio,
            precioTotal
        )
        VALUES (
            p_idMateriales,
            NOW(),
            p_cliente,
            p_corte,
            p_produccion,
            p_cantidadPliegos,
            p_precioPliego,
            p_tipoCambio,
            precioTotal
        );

        -- Actualizar el inventario usando el costo de compra y no el precio de venta
        UPDATE materiales
        SET Cantidad_Inventario = Cantidad_Inventario - p_cantidadPliegos,
            Valor_Inventario = Valor_Inventario - costoTotalSalida
        WHERE idMateriales = p_idMateriales;
    ELSE
        -- Lanzar un error si no hay suficiente inventario
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'No hay suficiente inventario disponible para la salida.';
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `editarEntradaMaterial` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `editarEntradaMaterial`(
    IN p_idDetalleEntrada INT,
    IN p_proveedor VARCHAR(255),
    IN p_factura VARCHAR(255),
    IN p_cantidadResma INT,
    IN p_pliegosResma INT,
    IN p_cantidadPliegos INT,
    IN p_precioPliego DECIMAL(10, 2),
    IN p_descuento DECIMAL(10, 2),
    IN p_tipoCambio DECIMAL(10, 2)
)
BEGIN
    DECLARE oldCantidadPliegos INT;
    DECLARE oldPrecioTotal DECIMAL(10, 2);
    DECLARE newSubtotal DECIMAL(10, 2);
    DECLARE newPrecioTotal DECIMAL(10, 2);
    DECLARE cantidadInventario INT;
    DECLARE valorInventario DECIMAL(10, 2);
    DECLARE exit handler for sqlexception
        BEGIN
            -- Rollback en caso de error
            ROLLBACK;
        END;

    -- Iniciar la transacción
    START TRANSACTION;

    -- Obtener los detalles de la entrada para calcular la diferencia
    SELECT cantidadPliegos, (precioPliego * cantidadPliegos) - descuento INTO oldCantidadPliegos, oldPrecioTotal
    FROM detalleentrada
    WHERE idDetalleEntrada = p_idDetalleEntrada;

    -- Verificar si se encontró la entrada
    IF oldCantidadPliegos IS NULL THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Entrada no encontrada';
    END IF;

    -- Calcular el nuevo subtotal y precio total
    SET newSubtotal = p_precioPliego * p_cantidadPliegos;
    SET newPrecioTotal = (newSubtotal - p_descuento) * p_tipoCambio;

    -- Actualizar los detalles de la entrada
    UPDATE detalleentrada
    SET
        proveedor = p_proveedor,
        factura = p_factura,
        cantidadResma = p_cantidadResma,
        pliegosResma = p_pliegosResma,
        cantidadPliegos = p_cantidadPliegos,
        precioPliego = p_precioPliego,
        descuento = p_descuento,
        tipoCambio = p_tipoCambio
    WHERE idDetalleEntrada = p_idDetalleEntrada;

    -- Obtener la cantidad de inventario actual y el valor actual del inventario
    SELECT Cantidad_Inventario, Valor_Inventario INTO cantidadInventario, valorInventario
    FROM materiales
    WHERE idMateriales = (SELECT idMateriales FROM detalleentrada WHERE idDetalleEntrada = p_idDetalleEntrada);

    -- Verificar si se encontró el material
    IF cantidadInventario IS NULL THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Material no encontrado';
    END IF;

    -- Ajustar la cantidad de inventario y el valor de inventario
    UPDATE materiales
    SET
        Cantidad_Inventario = cantidadInventario + (p_cantidadPliegos - oldCantidadPliegos),
        Valor_Inventario = valorInventario + (newPrecioTotal - oldPrecioTotal)
    WHERE idMateriales = (SELECT idMateriales FROM detalleentrada WHERE idDetalleEntrada = p_idDetalleEntrada);

    -- Confirmar la transacción
    COMMIT;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `editarMaterial` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `editarMaterial`(
    IN materialID INT,              
    IN nuevoNombre VARCHAR(255)     
)
BEGIN
    -- Actualiza el nombre del material basado en el ID proporcionado
    UPDATE materiales
    SET Material = nuevoNombre
    WHERE idMateriales = materialID;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `editarSalidaMaterial` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `editarSalidaMaterial`(
    IN p_idDetalleSalida INT,
    IN p_cliente VARCHAR(255),
    IN p_corte VARCHAR(255),
    IN p_produccion VARCHAR(255),
    IN p_cantidadPliegos INT,
    IN p_precioPliego DECIMAL(10, 2),
    IN p_tipoCambio DECIMAL(10, 2)
)
BEGIN
    DECLARE oldCantidadPliegos INT;
    DECLARE newPrecioTotal DECIMAL(10, 2);
    DECLARE diferencia INT;
    DECLARE idMat INT;
    DECLARE costoUnitarioCompra DECIMAL(10, 2);

    -- Iniciar transacción
    START TRANSACTION;

    -- Obtener datos anteriores
    SELECT cantidadPliegos, idMateriales INTO oldCantidadPliegos, idMat
    FROM detallesalida
    WHERE idDetalleSalida = p_idDetalleSalida;

    -- Calcular la diferencia en unidades
    SET diferencia = p_cantidadPliegos - oldCantidadPliegos;

    -- Obtener el precio de compra más reciente
    SELECT precioPliego
    INTO costoUnitarioCompra
    FROM detalleentrada
    WHERE idMateriales = idMat
    ORDER BY fechaDetalle DESC
    LIMIT 1;

    -- Verificar si hay suficiente inventario (cuando diferencia es positiva)
    IF diferencia > 0 THEN
        IF (SELECT Cantidad_Inventario FROM materiales WHERE idMateriales = idMat) < diferencia THEN
            SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'No hay suficiente inventario disponible para aumentar la salida.';
        END IF;
    END IF;

    -- Calcular nuevo precio total en base al precio de venta
    SET newPrecioTotal = (p_precioPliego * p_cantidadPliegos) * p_tipoCambio;

    -- Actualizar salida
    UPDATE detallesalida
    SET
        cliente = p_cliente,
        corte = p_corte,
        produccion = p_produccion,
        cantidadPliegos = p_cantidadPliegos,
        precioPliego = p_precioPliego,
        tipoCambio = p_tipoCambio,
        precioTotal = newPrecioTotal
    WHERE idDetalleSalida = p_idDetalleSalida;

    -- Actualizar inventario
    UPDATE materiales
    SET 
        Cantidad_Inventario = Cantidad_Inventario - diferencia,
        Valor_Inventario = Valor_Inventario - (diferencia * costoUnitarioCompra)
    WHERE idMateriales = idMat;

    -- Finalizar
    COMMIT;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `eliminarEntradaMaterial` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminarEntradaMaterial`(
    IN p_idDetalleEntrada INT
)
BEGIN
    -- Eliminar el registro de detalleentrada
    DELETE FROM detalleentrada
    WHERE idDetalleEntrada = p_idDetalleEntrada;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `eliminarMaterial` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminarMaterial`(
    IN materialID INT  
)
BEGIN
    -- Elimina el material basado en el ID proporcionado
    DELETE FROM materiales
    WHERE idMateriales = materialID;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `existeMaterial` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `existeMaterial`(
    IN materialName VARCHAR(255)
)
BEGIN
    DECLARE materialCount INT;

    -- Cuenta el número de filas que coinciden con el nombre del material
    SELECT COUNT(*) INTO materialCount 
    FROM imprenta.materiales 
    WHERE Material = materialName;

    -- Si el conteo es mayor que 0, el material existe
    IF materialCount > 0 THEN
        SELECT '1' AS existe;  -- Retorna 1 si existe
    ELSE
        SELECT '0' AS existe;  -- Retorna 0 si no existe
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `listarMateriales` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `listarMateriales`()
BEGIN
    SELECT * FROM imprenta.materiales;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-22 22:36:41
