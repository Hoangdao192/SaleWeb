-- MySQL dump 10.13  Distrib 8.0.28, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: sale_web_assignment
-- ------------------------------------------------------
-- Server version	8.0.28

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
-- Table structure for table `cartitem`
--

DROP TABLE IF EXISTS `cartitem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cartitem` (
  `id` int NOT NULL,
  `shoppingCartId` int DEFAULT NULL,
  `productId` int DEFAULT NULL,
  `productSize` text COLLATE utf8mb4_unicode_ci,
  `productColor` text COLLATE utf8mb4_unicode_ci,
  `quantityOrdered` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shoppingCartId` (`shoppingCartId`),
  KEY `productId` (`productId`),
  CONSTRAINT `cartitem_ibfk_1` FOREIGN KEY (`shoppingCartId`) REFERENCES `shopingcart` (`shopingCartId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cartitem_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cartitem`
--

LOCK TABLES `cartitem` WRITE;
/*!40000 ALTER TABLE `cartitem` DISABLE KEYS */;
/*!40000 ALTER TABLE `cartitem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customers` (
  `customerName` text COLLATE utf8mb4_unicode_ci,
  `userId` int NOT NULL,
  `age` int DEFAULT NULL,
  `email` text COLLATE utf8mb4_unicode_ci,
  `gender` text COLLATE utf8mb4_unicode_ci,
  `phoneNumber` text COLLATE utf8mb4_unicode_ci,
  `address` text COLLATE utf8mb4_unicode_ci,
  `dateOfBirth` date DEFAULT NULL,
  PRIMARY KEY (`userId`),
  CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES ('Trần Đình Cường',20,20,'','Nam','0862964913','Hà Nam','2002-01-19'),('Trần Đình Cường',21,20,'','Nam','0863964913','cdscsd','2002-01-22'),('Trần Thị Kim Bắc',23,20,'','Nam','0399523244','Bắc Lý-Lý Nhân-Hà Nam','2002-10-05'),('xuan hoang',24,20,'','Nam','0335135255','ha noi','2002-07-23'),('Trần Kim Bắc',25,2,'','Nam','0333223322','Sao hỏa','2020-10-05'),('a',27,2,'','Nam','dcds','đcdcs','2022-04-28'),('a',28,2,'','Nam','e','e','2022-05-17'),('a',29,2,'','Nam','e','e','2022-05-17'),('Phan Văn A',30,18,'','Nam','0863964913','Hà Nội','2022-05-17'),('Phan Văn A',31,18,'','Nam','0863964913','Hà Nội','2022-05-17');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orderdetails`
--

DROP TABLE IF EXISTS `orderdetails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orderdetails` (
  `orderNumber` int DEFAULT NULL,
  `productId` int DEFAULT NULL,
  `quantityOrdered` int DEFAULT NULL,
  `priceEach` int DEFAULT NULL,
  `productSize` text COLLATE utf8mb4_unicode_ci,
  `productColor` text COLLATE utf8mb4_unicode_ci,
  KEY `productId` (`productId`),
  KEY `orderNumber` (`orderNumber`),
  CONSTRAINT `orderdetails_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`),
  CONSTRAINT `orderdetails_ibfk_3` FOREIGN KEY (`orderNumber`) REFERENCES `orders` (`orderNumber`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orderdetails`
--

LOCK TABLES `orderdetails` WRITE;
/*!40000 ALTER TABLE `orderdetails` DISABLE KEYS */;
INSERT INTO `orderdetails` VALUES (60,12,1,245000,'XL','#1B1A1F'),(60,12,1,245000,'L','#1B1A1F'),(60,12,1,245000,'M','#1B1A1F'),(60,12,1,245000,'S','#1B1A1F'),(60,12,1,245000,'XXL','#1B1A1F'),(60,11,1,295000,'XXL','#FFFFFF'),(60,11,1,295000,'XL','#FFFFFF'),(60,11,1,295000,'L','#FFFFFF'),(60,11,1,295000,'M','#FFFFFF'),(60,11,1,295000,'S','#FFFFFF'),(61,11,2,295000,'S','#FFFFFF'),(62,13,1,285000,'XXL','#DB9E01'),(62,14,1,265000,'XL','#FFFFFF'),(62,14,1,265000,'L','#FFFFFF'),(62,14,2,265000,'M','#FFFFFF'),(76,13,1,285000,'L','#DB9E01'),(76,14,2,265000,'S','#FFFFFF'),(76,11,1,295000,'S','#FFFFFF'),(76,60,1,285000,'S','#41B4C6'),(76,60,1,285000,'XXL','#41B4C6'),(76,19,1,350000,'S','#D8BFC2'),(76,164,1,245000,'S','#F96865'),(76,157,1,215000,'S','#C5CF8A'),(76,159,1,215000,'XL','#131114'),(76,159,1,215000,'L','#131114'),(79,13,2,285000,'S','#DB9E01'),(79,12,1,245000,'XL','#1B1A1F'),(79,14,1,265000,'L','#FFFFFF'),(79,15,5,285000,'M','#1D86DE'),(79,11,1,295000,'S','#FFFFFF'),(80,158,1,215000,'S','#B0A9C7'),(81,17,1,255000,'S','#F8D16A'),(82,26,2,285000,'S','#C7BABC'),(85,72,1,315000,'S','#B94849'),(86,91,1,165000,'S','#D9D9D9'),(87,72,1,315000,'XXL','#B94849'),(87,73,1,340000,'XXL','#A9BED9'),(87,75,1,415000,'XXL','#416C9E'),(87,76,1,415000,'XXL','#355D90'),(87,77,1,395000,'XXL','#2D4873'),(88,11,1,295000,'XXL','#FFFFFF'),(88,60,1,285000,'XXL','#41B4C6'),(88,65,1,285000,'XXL','#262628'),(88,66,1,345000,'M','#202020'),(89,13,1,285000,'XL','#DB9E01'),(89,14,1,265000,'XL','#FFFFFF'),(90,11,1,295000,'XXL','#FFFFFF'),(90,12,1,245000,'XXL','#1B1A1F'),(91,11,1,295000,'XXL','#FFFFFF'),(91,14,1,265000,'S','#FFFFFF');
/*!40000 ALTER TABLE `orderdetails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `orderNumber` int NOT NULL AUTO_INCREMENT,
  `orderDate` date DEFAULT NULL,
  `totalPrice` int DEFAULT NULL,
  `userId` int DEFAULT NULL,
  `shippingAddressId` int DEFAULT NULL,
  PRIMARY KEY (`orderNumber`),
  KEY `shippingAddressId` (`shippingAddressId`),
  KEY `userId` (`userId`),
  CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`shippingAddressId`) REFERENCES `shippingaddress` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`userId`) REFERENCES `customers` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (60,'2022-05-19',2700000,20,27),(61,'2022-05-20',590000,21,28),(62,'2022-05-20',1345000,23,30),(76,'2022-05-21',2920000,24,33),(79,'2022-05-21',2800000,24,33),(80,'2022-05-21',215000,24,33),(81,'2022-05-21',255000,24,34),(82,'2022-05-21',570000,24,34),(85,'2022-05-21',315000,24,34),(86,'2022-05-21',165000,24,34),(87,'2022-05-22',1880000,25,38),(88,'2022-05-23',1210000,23,30),(89,'2022-05-23',550000,21,46),(90,'2022-05-23',540000,21,45),(91,'2022-05-24',560000,23,32);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product` (
  `productId` int NOT NULL AUTO_INCREMENT,
  `productTypeId` int DEFAULT NULL,
  `productName` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `productColor` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `productPrice` int DEFAULT NULL,
  `productImagePath` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categoryId` int DEFAULT '1',
  PRIMARY KEY (`productId`),
  KEY `productTypeId` (`productTypeId`),
  KEY `categoryId` (`categoryId`),
  CONSTRAINT `product_ibfk_1` FOREIGN KEY (`productTypeId`) REFERENCES `producttype` (`productTypeId`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `product_ibfk_2` FOREIGN KEY (`categoryId`) REFERENCES `productcategory` (`categoryId`)
) ENGINE=InnoDB AUTO_INCREMENT=181 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (11,5,'ÁO POLO M2ATP2051002','#FFFFFF,#E3A421',295000,'11',1),(12,5,'ÁO THUN M2ATN120015','#1B1A1F,#FBF393,#F8F7FD',245000,'12',1),(13,5,'ÁO THUN U1ATD020001','#DB9E01,#960023',285000,'13',1),(14,5,'ÁO THUN U1ATN12103FOSBA','#FFFFFF,#4088DD',265000,'14',1),(15,5,'ÁO THUN U1ATN12107FOSBA','#1D86DE',285000,'15',1),(16,5,'ÁO THUN U1ATN1041003','#BCE1FC,#005478,#026251,#C42835,#EAA318,#EEC601,',160000,'16',1),(17,5,'THUN NAM M2ATD119009','#F8D16A',255000,'17',1),(18,5,'ÁO THUN U1ATD010008','#EAA702',285000,'18',1),(19,5,'ÁO THUN U1ATD01201FOSBA','#D8BFC2',350000,'19',1),(20,5,'ÁO THUN U1ATN12102SOSHT','#E6E5E3',285000,'20',1),(21,5,'ÁO THUN U1ATN2051002','#033C85',265000,'21',1),(22,5,'ÁO THUN M2ATN4011002','#241F24',290000,'22',1),(23,6,'ÁO SƠMI M1SMD01203BOSTR','#D8DAD9',295000,'23',1),(24,6,'ÁO SƠMI M1SMD12102BOSTR','#121013,#DDDCE2',295000,'24',1),(25,6,'ÁO SOMI M2SMN3051006','#80B8DF',285000,'25',1),(26,6,'ÁO SOMI M1SMN2041001','#C7BABC',285000,'26',1),(27,6,'ÁO SOMI M1SMD2041003','#7686A9,#98A8AC,#C67681,#CCAC7C',285000,'27',1),(28,6,'ÁO SOMI M1SMD2031001','#DAD9E1,#A7C0C4',285000,'28',1),(29,6,'ÁO SOMI M1SMN120003','#ECEFF8,#1C191E',265000,'29',1),(30,6,'ÁO SOMI M1SMD110001','#232227',275000,'30',1),(31,6,'ÁO SOMI M1SMD050001','#B5BECD,#1A1A1A',295000,'31',1),(32,6,'ÁO SOMI M1SMD010004','#151C20',315000,'32',1),(33,6,'ÁO SOMI M1SMD010002','#6D0311,#F1B40D',275000,'33',1),(34,6,'ÁO SOMI M1SMD129001','#A91E25,#DBAE20',275000,'34',1),(35,7,'QUẦN SHORT M1SJN01202FSFRI','#383838',345000,'35',1),(36,7,'QUẦN SHORT M1SKK1061001','#DBA54B#C08382',285000,'36',1),(37,7,'QUẦN SHORT M1SKK1041001','#BB935D,#535263',265000,'37',1),(38,7,'QUẦN SHORT M2STH3041003','#CAC1BA',245000,'38',1),(39,7,'QUẦN SHORT M1STH1011001','#D6D5DB',175000,'39',1),(40,7,'QUẦN SHORT M1SJN120002','#18171D',285000,'40',1),(41,7,'QUẦN SHORT M1SJN100004','#434E6C',295000,'41',1),(42,7,'QUẦN SHORT M1SJN110002','#90AECA',285000,'42',1),(43,7,'SHORT JEAN M2SJN010002','#90ACCB',365000,'43',1),(44,7,'SHORT NAM QSB079011','#90ACCB',285000,'44',1),(45,7,'SHORT NAM KKB089007NV','#2F2E38',195000,'45',1),(46,7,'SHORT THUN M1STH129001','#400F19',160000,'46',1),(47,8,'QUẦN JEAN M1QJN01215FSFRI','#120D11',425000,'47',1),(48,8,'QUẦN JEAN M1QJN01210FBGRI','#929EAE',415000,'48',1),(49,8,'QUẦN JOGGER M1QJK12105FBGCR','#13181E',315000,'49',1),(50,8,'QUẦN TÂY M1QTY11103BSFTR','#DBDBDB',365000,'50',1),(51,8,'QUẦN JOGGER M1QJT2031001','#1D1D27',195000,'51',1),(52,8,'QUẦN JOGGER M2QJK2011005','#F0F0F0,#4C4845',365000,'52',1),(53,8,'QUẦN JOGGER M2QJK1011004','#E8E3DE,#131217,#554F4B',315000,'53',1),(54,8,'QUẦN JOGGER M1QJG4011004','#E8CCB1,#141118,#69616C',395000,'54',1),(55,8,'KAKI NAM KKB079002NV','#1B203D',345000,'55',1),(56,8,'JEAN NAM QJB069018','#5D7E9E',425000,'56',1),(57,8,'JEAN NAM QJB059008','#5C749F',365000,'57',1),(58,8,'JEAN NAM QJB069002','#3E4B6B',375000,'58',1),(59,9,'BALO A2BLD11105','#E9C4CB,#222021,#959EA5,#FAC239',285000,'59',6),(60,9,'BALO A2BLD11104','#41B4C6,#D5A738,#AB5E56',285000,'60',6),(61,9,'BALO A2BLD11103','#C0C8D5,#C7BAB4,#393939,#E0C0C3',285000,'61',6),(62,9,'BALO A2BLD11102','#F1E9E6,#202020',325000,'62',6),(63,9,'BALO A2BLD11101','#5D8D89,#292728,#8493B0,#DDBCC1',265000,'63',6),(64,9,'BALO A2BLV11103','#292929',285000,'64',6),(65,9,'BALO A2BLV11102','#262628',285000,'65',6),(66,9,'BALO A2BLA11107','#202020',345000,'66',6),(67,9,'BALO A2BLA11106','#2F2F2F',345000,'67',6),(68,9,'BALO A2BLA11105','#2C2C2C',345000,'68',6),(69,9,'BALO A2BLO120002','#4C474B,#1A181B',315000,'69',6),(70,9,'BALO A2BLO120001','#918B95',285000,'70',6),(71,9,'BALO A2BLO080018','#DDD4CF,#212123,#A6A59F',265000,'71',6),(72,19,'ĐẦM NỮ W2DAM030002','#B94849',315000,'72',2),(73,20,'YẾM W2YEM2011005','#A9BED9',340000,'73',2),(74,20,'YẾM W2YEM2011004','#4A78A9',415000,'74',2),(75,20,'YẾM W2YEM2011002','#416C9E',415000,'75',2),(76,20,'YẾM W2YEM2011001','#355D90',415000,'76',2),(77,20,'YẾM W2YEM090004','#2D4873',395000,'77',2),(78,20,'YẾM W2YEM090002','#B8C8DF',395000,'78',2),(79,10,'TÚI XÁCH A2TXA11101','#3B3B3B',225000,'79',6),(80,10,'TÚI XÁCH A2TXA120017','#2C2D34',345000,'80',6),(81,10,'TÚI XÁCH A2TXA120016','#25232C',345000,'81',6),(82,10,'TÚI XÁCH A2TXA120015','#28272D',345000,'82',6),(83,10,'TÚI XÁCH A2TXA120013','#38383C',345000,'83',6),(84,10,'TÚI XÁCH A2TXA120002','#F0B43E',265000,'84',6),(85,10,'TÚI XÁCH A2TXA070007','#161518',345000,'85',6),(86,10,'TÚI XÁCH A2TX129012','#B1293F',285000,'86',6),(87,11,'NÓN LƯỠI TRAI A2NLT01211','#177EDB,#50ACC0,#55AAA3',165000,'87',6),(88,11,'NÓN LƯỠI TRAI A2NLT01210','#D2739B,#1A5CAF,#01A2B3,#D7D7E4',165000,'88',6),(89,11,'NÓN LƯỠI TRAI A2NLT01209','#EEA23A,#0385A6,#A43134,#E4E4EF',165000,'89',6),(90,11,'NÓN LƯỠI TRAI A2NLT01208','#D2B19E,#0254BF,#018368',165000,'90',6),(91,11,'NÓN LƯỠI TRAI A2NLT01206','#D9D9D9,#243F44,#A11831',165000,'91',6),(92,11,'NÓN LƯỠI TRAI A2NLT01204','#590722.#000000,#3D5152,#86543C',165000,'92',6),(93,11,'NÓN BUCKET A2NBK12108','#E02239',165000,'93',6),(94,11,'NÓN BUCKET A2NBK12106','#1D1C23',165000,'94',6),(95,11,'NÓN BUCKET A2NBK12105','#131218',165000,'95',6),(96,11,'NÓN BUCKET A2NBK12103','#E93F48',165000,'96',6),(97,11,'NÓN BUCKET A2NBK12102','#D51D39,#ECD5C7,#171C34,#DEE0EF',150000,'97',6),(98,11,'NÓN BUCKET A2NBK12101','#1E1B24',165000,'98',6),(99,12,'DÂY NỊT A2DNI01205','#19181E',285000,'99',6),(100,12,'DÂY NỊT A2DNI01204','#15141A',285000,'100',6),(101,12,'DÂY NỊT A2DNI01203','#1A191E',285000,'101',6),(102,12,'DÂY NỊT A2DNI01202','#2A292F',285000,'102',6),(103,12,'DÂY NỊT A2DNI11169','#242426',255000,'103',6),(104,12,'DÂY NỊT A2DNI11168','#333132',255000,'104',6),(105,12,'DÂY NỊT A2DNI11167','#2E2E2E',255000,'105',6),(106,12,'DÂY NỊT A2DNI11166','#282627',255000,'106',6),(107,12,'DÂY NỊT A2DNI11165','#030302',255000,'107',6),(108,12,'DÂY NỊT A2DNI11164','#232122',255000,'108',6),(109,12,'DÂY NỊT A2DNI11163','#413F40',255000,'109',6),(110,12,'DÂY NỊT A2DNI11162','#343235',255000,'110',6),(111,18,'CHÂN VÁY W2CHV12103FSFTR','#111010,#DCD3CE',235000,'111',2),(112,18,'CHÂN VÁY W2CHV12102FSFXL','#170F0C,#A17C5F,#492D29',225000,'112',2),(113,18,'CHÂN VÁY W2CHV12101FSFTR','#EDD8C4,#100F14,#432A26',225000,'113',2),(114,18,'CHÂN VÁY W2CHV2011004','#C57475,#E2B78A',225000,'114',2),(115,18,'CHÂN VÁY W2CHV2011003','#AF7A4E',225000,'115',2),(116,18,'CHÂN VÁY W2CHV2011002','#84879A',195000,'116',2),(117,18,'CHÂN VÁY W2CHV120002','#F8F9FD,#7F89A8',315000,'117',2),(118,18,'CHÂN VÁY W2CHV120001','#3E4361,#18171C',315000,'118',2),(119,18,'CHÂN VÁY W2CHV070001','#E7E7E7,#C48868',235000,'119',2),(120,17,'QUẦN JOGGER W2QJJ1011001','#131218',395000,'120',2),(121,17,'QUẦN JOGGER W2QJG120002','#CDB9AB,#1C1B21',385000,'121',2),(122,17,'QUẦN JOGGER W2QJG120001','#7184A2,#111016',385000,'122',2),(123,17,'QUẦN JEAN W2QJN03207FSFTR','#212333',325000,'123',2),(124,17,'QUẦN JEAN W2QJN03206FSFTR','#283756',325000,'124',2),(125,17,'QUẦN JEAN W2QJN03205FSFTR','#9CA3B3',325000,'125',2),(126,17,'QUẦN JEAN W2QJN03204FSFTR','#677689',325000,'126',2),(127,17,'QUẦN JEAN W2QJN01202FSFRI','#3A5077',440000,'127',2),(128,17,'QUẦN JEAN W1QJN01201FBGRI','#91A1B8',325000,'128',2),(129,17,'QUẦN JEAN W2QJN12113FBGRN','#A4B1C2',295000,'129',2),(130,17,'QUẦN JEAN W2QJN12101FBGRI','#ADA59D',450000,'130',2),(131,16,'QUẦN SHORT W2SJN03202FBGTR','#3D5070',265000,'131',2),(132,16,'QUẦN SHORT W2SJN03201FBGTR','#526680',265000,'132',2),(133,16,'QUẦN SHORT W2SKK12101FSFTR','#0D0D0D,#97735B',225000,'133',2),(134,16,'QUẦN SHORT W2SJN1011003','#EDCDB2,#1D1C24,#B5723B',215000,'134',2),(135,16,'QUẦN SHORT W2SJN1011002','#1F1E24,#DEC6AE',215000,'135',2),(136,16,'QUẦN SHORT W2SJN120004','#D2BAAC,#19181D,#9EA3AC,#EFF0F4',315000,'136',2),(137,16,'QUẦN SHORT W2SJN120003','#8894A6,#201F24,#EDEEF3',285000,'137',2),(138,16,'QUẦN SHORT W2SJN120002','#EDEEF6,#394969',285000,'138',2),(139,16,'QUẦN SHORT W2SJN120001','#18171C,#F9EFE5,#354564',315000,'139',2),(140,16,'QUẦN SHORT W2SJN100002','#54678A,#B5C1D3',345000,'140',2),(141,16,'QUẦN SHORT W2SJN100001','#687D9F,#BFC5D5',345000,'141',2),(142,16,'QUẦN SHORT W2SJN070010','#E4BDB6',325000,'142',2),(143,14,'ÁO SƠMI W2SMD03208FOSTR','#AAA39B,#A4CCD1,#D1D0D3',265000,'143',2),(144,14,'ÁO SƠMI W2SMD03207FOSTR','#8B9CA6,#DCB7BB,#DEDFE4',265000,'144',2),(145,14,'ÁO SƠMI W2SMD03206FOSCR','#4D5B69,#3F3E46',265000,'145',2),(146,14,'ÁO SƠMI W2SMD03205BOSTR','#4EA98A,#1C1A1F,#BBC2DE,#F5C0BC,#DBE1EF',235000,'146',2),(147,14,'ÁO SƠMI W2SMD03204BOSCR','#D9C391,#74B7C0,#AC8FAE,#FA795C',235000,'147',2),(148,14,'ÁO SƠMI W2SMD03203BOSCR','#B17063,#D28F08',235000,'148',2),(149,14,'ÁO SƠMI W2SMD03202BOSCR','#364D2B',235000,'149',2),(150,14,'ÁO SƠMI W2SMD03201BOSTR','#697899,#EEEDF2',250000,'150',2),(151,14,'ÁO SƠMI W2SMD12104BOSTR','#8AA2C4',225000,'151',2),(152,14,'ÁO SƠMI W2SMD11109BOSTR','#E0DEDF',225000,'152',2),(153,14,'ÁO SƠMI W2SMD11106BOSTR','#E2E1DF',225000,'153',2),(154,14,'ÁO SƠMI W2SMD11105BOSTR','#E6E4E5,#121117',225000,'154',2),(155,13,'ÁO THUN W1ATN02201FOSHT','#A5BACF,#C8C4D2,#D7D7DF',285000,'155',2),(156,13,'ÁO THUN W1ATN03201FOSHT','#BFBC9D,#131217,#1476CC,#E4E3E8',285000,'156',2),(157,13,'ÁO THUN W2ATN03203FOSHT','#C5CF8A,#141217,#014FB3,#F6CFD2,#E4E4EE',215000,'157',2),(158,13,'ÁO THUN W2ATN03202FOSHT','#B0A9C7,#D8E684,#110F10,#1D61B7,#F1C8CB,#E7E7EF',215000,'158',2),(159,13,'ÁO THUN W2ATN03201BOSBA','#131114,#025AC2,#F5CCD0,#DFDFE9',215000,'159',2),(161,13,'ÁO LEN W2ALD12102BSFTR','#D0AF9C,#0F0E13,#E0E0E2',185000,'161',2),(162,13,'ÁO LEN W2ALD12101BSFTR','#1F1915,#BFA99C,#E2E1E6',245000,'162',2),(163,13,'ÁO THUN W2ATD120003','#F97189,#FDBDBE',245000,'163',2),(164,13,'ÁO THUN W2ATD110023','#F96865',245000,'164',2),(165,13,'ÁO THUN W2ATD110019','#FB7268,#141414',215000,'165',2),(166,13,'ÁO THUN W2ATD090005','#D7BCDF,#D0D0D0',185000,'166',2);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productcategory`
--

DROP TABLE IF EXISTS `productcategory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productcategory` (
  `categoryId` int NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`categoryId`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productcategory`
--

LOCK TABLES `productcategory` WRITE;
/*!40000 ALTER TABLE `productcategory` DISABLE KEYS */;
INSERT INTO `productcategory` VALUES (1,'Nam'),(2,'Nữ'),(6,'Phụ kiện');
/*!40000 ALTER TABLE `productcategory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `producttype`
--

DROP TABLE IF EXISTS `producttype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `producttype` (
  `productTypeId` int NOT NULL AUTO_INCREMENT,
  `categoryId` int DEFAULT NULL,
  `productTypeName` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`productTypeId`),
  KEY `categoryId` (`categoryId`),
  CONSTRAINT `producttype_ibfk_1` FOREIGN KEY (`categoryId`) REFERENCES `productcategory` (`categoryId`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producttype`
--

LOCK TABLES `producttype` WRITE;
/*!40000 ALTER TABLE `producttype` DISABLE KEYS */;
INSERT INTO `producttype` VALUES (5,1,'Áo thun nam'),(6,1,'Áo sơ mi nam'),(7,1,'Quần Short Nam'),(8,1,'Quần Dài Nam'),(9,6,'Balo'),(10,6,'Túi Xách'),(11,6,'Nón'),(12,6,'Dây Nịt'),(13,2,'Áo Thun Nữ'),(14,2,'Áo Sơ Mi Nữ'),(16,2,'Quần Short Nữ'),(17,2,'Quần Dài Nữ'),(18,2,'Chân Váy'),(19,2,'Đầm Nữ'),(20,2,'Yếm');
/*!40000 ALTER TABLE `producttype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shippingaddress`
--

DROP TABLE IF EXISTS `shippingaddress`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `shippingaddress` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userId` int DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `receiverName` text COLLATE utf8mb4_unicode_ci,
  `receiverPhoneNumber` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`),
  CONSTRAINT `shippingaddress_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `customers` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shippingaddress`
--

LOCK TABLES `shippingaddress` WRITE;
/*!40000 ALTER TABLE `shippingaddress` DISABLE KEYS */;
INSERT INTO `shippingaddress` VALUES (25,20,'Hà Nam','Trần Đình Cường','0862964913'),(26,20,'Tỉnh Bắc Kạn, Huyện Bạch Thông, Xã Đôn Phong, Hai Duong','Trần Đình Cường','0862964913'),(27,20,'Tỉnh Quảng Ninh, Thành phố Cẩm Phả, Phường Cẩm Trung, Hai Duong','Trần Đình Cường','0862964913'),(28,21,'cdscsd','Trần Đình Cường','0863964913'),(30,23,'Bắc Lý-Lý Nhân-Hà Nam','Trần Thị Kim Bắc','0399523244'),(32,23,'Tỉnh Bắc Kạn, Huyện Ba Bể, Xã Chu Hương, Nhà 16, Ngõ 59, Phố Đồng Me','Trần Thị Kim Bắc','0399523244'),(33,24,'ha noi','xuan hoang','0335135255'),(34,24,'Thành phố Hà Nội, Quận Hai Bà Trưng, Phường Trương Định, 281','hoang','0335135255'),(38,25,'Sao hỏa','Trần Kim Bắc','0333223322'),(40,27,'đcdcs','a','dcds'),(41,28,'e','a','e'),(42,29,'e','a','e'),(43,30,'Hà Nội','Phan Văn A','0863964913'),(44,31,'Hà Nội','Phan Văn A','0863964913'),(45,21,'Thành phố Hà Nội, Huyện Gia Lâm, Xã Đặng Xá, ','s','0863964913'),(46,21,'Thành phố Hà Nội, Huyện Gia Lâm, Xã Đặng Xá, jkjkkjkj','s','0863964913'),(47,21,'Tỉnh Thái Nguyên, Huyện Phú Lương, Xã Tức Tranh, ghgjfvujg','s','0863964913'),(48,21,'Tỉnh Thái Nguyên, Huyện Phú Lương, Xã Tức Tranh, ','s','0863964913'),(49,21,'Tỉnh Thái Nguyên, Huyện Phú Lương, Xã Tức Tranh, ','s','jh'),(50,21,'Tỉnh Thái Nguyên, Huyện Phú Lương, Xã Tức Tranh, ','s','0939837'),(51,21,'Tỉnh Thái Nguyên, Huyện Phú Lương, Xã Tức Tranh, ','Trần Đình Cường','0939837'),(52,21,'Thành phố Hà Nội, Quận Ba Đình, Phường Liễu Giai, Hà Nội','Trần Đình Cường','0863964913'),(53,21,'Thành phố Hà Nội, Quận Ba Đình, Phường Liễu Giai, Hà Nội','Trần Đình Cường','0863964913'),(54,21,'Thành phố Hà Nội, Quận Ba Đình, Phường Liễu Giai, Hà Nội','Trần Đình Cường','0863964913'),(55,21,'Thành phố Hà Nội, Quận Ba Đình, Phường Liễu Giai, Hà Nội','Trần Đình Cường','0863964913'),(56,21,'Thành phố Hà Nội, Quận Ba Đình, Phường Liễu Giai, Hà Nội','Trần Đình Cường','0863964913'),(57,21,'Thành phố Hà Nội, Quận Ba Đình, Phường Liễu Giai, Hà Nội','Trần Đình Cường','0863964913'),(58,21,'Thành phố Hà Nội, Quận Ba Đình, Phường Liễu Giai, Hà Nội','Trần Đình Cường','0863964913'),(59,21,'Thành phố Hà Nội, Quận Ba Đình, Phường Liễu Giai, Hà Nội','Trần Đình Cường','0863964913'),(60,21,'Thành phố Hà Nội, Quận Ba Đình, Phường Liễu Giai, Hà Nội','Trần Đình Cường','086396491'),(61,21,'Thành phố Hà Nội, Quận Ba Đình, Phường Liễu Giai, Hà Nội','Trần Đình Cường','086396491'),(62,21,'Thành phố Hà Nội, Quận Ba Đình, Phường Liễu Giai, Hà Nội','Trần Đình Cường','0863964913'),(63,21,'Thành phố Hà Nội, Quận Ba Đình, Phường Liễu Giai, Hà Nội','Trần Đình Cường','0863964913'),(64,21,'Thành phố Hà Nội, Quận Ba Đình, Phường Liễu Giai, Hà Nội','Trần Đình Cường','0863964913'),(65,21,'Thành phố Hà Nội, Quận Ba Đình, Phường Liễu Giai, Hà Nội','Trần Đình Cường','0863964913'),(66,21,'Thành phố Hà Nội, Quận Ba Đình, Phường Liễu Giai, Hà Nội','Trần Đình Cường','0863964913'),(67,21,'Thành phố Hà Nội, Quận Ba Đình, Phường Liễu Giai, Hà Nội','Trần Đình Cường','0863964913'),(68,21,'Thành phố Hà Nội, Quận Ba Đình, Phường Liễu Giai, Hà Nội','Trần Đình Cường','0863964913'),(69,21,'Thành phố Hà Nội, Quận Ba Đình, Phường Liễu Giai, Hà Nội','Trần Đình Cường','0863964913'),(70,21,'Thành phố Hà Nội, Quận Ba Đình, Phường Liễu Giai, Hà Nội','Trần Đình Cường','0863964913'),(71,21,'Thành phố Hà Nội, Quận Ba Đình, Phường Liễu Giai, Hà Nội','Trần Đình Cường','0863964913'),(72,21,'Thành phố Hà Nội, Quận Ba Đình, Phường Liễu Giai, Hà Nội','Trần Đình Cường','086396491'),(73,21,'Thành phố Hà Nội, Quận Long Biên, Phường Phúc Lợi, Hà Nội','Trần Đình Cường','0863964913'),(74,21,'Thành phố Hà Nội, Quận Long Biên, Phường Phúc Lợi, Hà Nội','','0863964913'),(75,21,'Thành phố Hà Nội, Quận Long Biên, Phường Phúc Lợi, Hà Nội','',''),(76,21,'Thành phố Hà Nội, Quận Long Biên, Phường Phúc Lợi, ','',''),(77,21,'Thành phố Hà Nội, Quận Long Biên, Phường Phúc Lợi, ','',''),(78,21,'Thành phố Hà Nội, Quận Long Biên, Phường Phúc Lợi, ','',''),(79,21,'Tỉnh Hà Giang, Huyện Đồng Văn, Xã Sảng Tủng, ','Trần Đình Cường','0863964913'),(80,21,'Tỉnh Hà Giang, Huyện Đồng Văn, Xã Sảng Tủng, ','Trần Đình Cường',''),(81,21,'Thành phố Hà Nội, Quận Ba Đình, Phường Liễu Giai, ','Trần Đình Cường','0863964913'),(82,21,'Thành phố Hà Nội, Quận Ba Đình, Phường Liễu Giai, Hà Nội','Trần Đình Cường','0863964913'),(83,21,'Thành phố Hà Nội, Quận Ba Đình, Phường Liễu Giai, Hà Nội','Trần Đình Cường','0863964913'),(84,21,'Thành phố Hà Nội, Quận Ba Đình, Phường Liễu Giai, Hà Nội','Trần Đình Cường','0863964913'),(85,21,'Thành phố Hà Nội, Quận Ba Đình, Phường Liễu Giai, Hà Nội','Trần Đình Cường','0863964913'),(86,21,'Thành phố Hà Nội, Quận Ba Đình, Phường Liễu Giai, Hà Nội','Trần Đình Cường','0863964913'),(87,21,'Thành phố Hà Nội, Quận Ba Đình, Phường Liễu Giai, Hà Nội','Trần Đình Cường','0863964913'),(88,21,'Thành phố Hà Nội, Quận Long Biên, Phường Phúc Lợi, Hà Nội','Trần Đình Cường','0863964913'),(89,21,'Thành phố Hà Nội, Quận Long Biên, Phường Phúc Lợi, Hà Nội','','0863964913'),(90,21,'Thành phố Hà Nội, Quận Long Biên, Phường Phúc Lợi, Hà Nội','',''),(91,21,'Thành phố Hà Nội, Quận Long Biên, Phường Phúc Lợi, ','',''),(92,21,'Thành phố Hà Nội, Quận Ba Đình, Phường Liễu Giai, ','Trần Đình Cường','0863964913'),(93,21,'Thành phố Hà Nội, Quận Ba Đình, Phường Liễu Giai, ','',''),(94,21,'Thành phố Hà Nội, Quận Ba Đình, Phường Liễu Giai, Hà Nội','Trần Đình Cường','0863964913'),(95,21,'Thành phố Hà Nội, Quận Ba Đình, Phường Liễu Giai, ','Trần Đình Cường','0863964913'),(96,21,'Thành phố Hà Nội, Quận Ba Đình, Phường Liễu Giai, ','Trần Đình Cường','0863964914');
/*!40000 ALTER TABLE `shippingaddress` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shopingcart`
--

DROP TABLE IF EXISTS `shopingcart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `shopingcart` (
  `userId` int NOT NULL,
  `cart` text COLLATE utf8mb4_unicode_ci,
  `shopingCartId` int NOT NULL,
  PRIMARY KEY (`shopingCartId`),
  KEY `userId` (`userId`),
  CONSTRAINT `shopingcart_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `customers` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shopingcart`
--

LOCK TABLES `shopingcart` WRITE;
/*!40000 ALTER TABLE `shopingcart` DISABLE KEYS */;
/*!40000 ALTER TABLE `shopingcart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `userId` int NOT NULL AUTO_INCREMENT,
  `userName` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `userPassword` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `userType` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (10,'admin','admin','admin'),(20,'dinhcuong2002','Dinhcuong2002@','customer'),(21,'20020376','20020376','customer'),(23,'Kimbac','a','customer'),(24,'hoang','23072002','customer'),(25,'Mập','abcd','customer'),(27,'a','a','customer'),(28,'admin01','admin01','customer'),(29,'admin02','admin02','customer'),(30,'admin03','123456','customer'),(31,'admin04','123456','customer');
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

-- Dump completed on 2022-05-24 14:23:29
