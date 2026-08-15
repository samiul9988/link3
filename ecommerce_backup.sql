-- MySQL dump 10.13  Distrib 9.6.0, for macos26.2 (arm64)
--
-- Host: 127.0.0.1    Database: ecommerce
-- ------------------------------------------------------
-- Server version	8.0.33

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
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admins` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('super_admin','manager','editor') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'manager',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'Super Admin','admin@example.com',NULL,'$2y$12$ICungcguNaVSWyyUirtRa.jpq4.C/6Nf6NfU0/CuFYSoyrdxa/Mxa',NULL,'super_admin',1,NULL,'2026-08-07 09:27:15','2026-08-07 09:27:15');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `banners`
--

DROP TABLE IF EXISTS `banners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `banners` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banners`
--

LOCK TABLES `banners` WRITE;
/*!40000 ALTER TABLE `banners` DISABLE KEYS */;
INSERT INTO `banners` VALUES (1,'Router Combo Deal','uploads/banners/banner_1.jpg','/products?brand=tp-link','home_top',0,1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(2,'Fiber Optics Special','uploads/banners/banner_2.jpg','/products?category=fiber-optic-equipment','home_top',1,1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(3,'ONU Installation Kit','uploads/banners/banner_3.jpg','/products?category=modems-onu','home_middle',2,1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(4,'CCTV Camera Deals','uploads/banners/banner_4.jpg','/products?category=cctv-security','home_middle',3,1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(5,'Free Shipping Above ৳5000','uploads/banners/banner_5.jpg','/products','home_top',4,1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(6,'Antenna & Booster','uploads/banners/banner_6.jpg','/products?category=antennas-boosters','listing_page',5,1,'2026-08-07 10:18:29','2026-08-07 10:18:29');
/*!40000 ALTER TABLE `banners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `brands` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `brands_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brands`
--

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT INTO `brands` VALUES (1,'TP-Link','tp-link','uploads/brands/brand_0.jpg','TP-Link is a leading brand providing high-quality networking and broadband accessories worldwide.',1,1,'Buy TP-Link Products Online - Tihan Online','Shop authentic TP-Link networking products at Tihan Online. Best price guaranteed.',NULL,0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(2,'D-Link','d-link','uploads/brands/brand_1.jpg','D-Link is a leading brand providing high-quality networking and broadband accessories worldwide.',1,1,'Buy D-Link Products Online - Tihan Online','Shop authentic D-Link networking products at Tihan Online. Best price guaranteed.',NULL,1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(3,'Cisco','cisco','uploads/brands/brand_2.jpg','Cisco is a leading brand providing high-quality networking and broadband accessories worldwide.',1,1,'Buy Cisco Products Online - Tihan Online','Shop authentic Cisco networking products at Tihan Online. Best price guaranteed.',NULL,2,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(4,'Netgear','netgear','uploads/brands/brand_3.jpg','Netgear is a leading brand providing high-quality networking and broadband accessories worldwide.',1,1,'Buy Netgear Products Online - Tihan Online','Shop authentic Netgear networking products at Tihan Online. Best price guaranteed.',NULL,3,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(5,'MikroTik','mikrotik','uploads/brands/brand_4.jpg','MikroTik is a leading brand providing high-quality networking and broadband accessories worldwide.',1,1,'Buy MikroTik Products Online - Tihan Online','Shop authentic MikroTik networking products at Tihan Online. Best price guaranteed.',NULL,4,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(6,'Ubiquiti','ubiquiti','uploads/brands/brand_5.jpg','Ubiquiti is a leading brand providing high-quality networking and broadband accessories worldwide.',1,1,'Buy Ubiquiti Products Online - Tihan Online','Shop authentic Ubiquiti networking products at Tihan Online. Best price guaranteed.',NULL,5,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(7,'Tenda','tenda','uploads/brands/brand_6.jpg','Tenda is a leading brand providing high-quality networking and broadband accessories worldwide.',1,1,'Buy Tenda Products Online - Tihan Online','Shop authentic Tenda networking products at Tihan Online. Best price guaranteed.',NULL,6,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(8,'Xiaomi','xiaomi','uploads/brands/brand_7.jpg','Xiaomi is a leading brand providing high-quality networking and broadband accessories worldwide.',1,1,'Buy Xiaomi Products Online - Tihan Online','Shop authentic Xiaomi networking products at Tihan Online. Best price guaranteed.',NULL,7,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(9,'Huawei','huawei','uploads/brands/brand_8.jpg','Huawei is a leading brand providing high-quality networking and broadband accessories worldwide.',1,1,'Buy Huawei Products Online - Tihan Online','Shop authentic Huawei networking products at Tihan Online. Best price guaranteed.',NULL,8,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(10,'ZTE','zte','uploads/brands/brand_9.jpg','ZTE is a leading brand providing high-quality networking and broadband accessories worldwide.',1,1,'Buy ZTE Products Online - Tihan Online','Shop authentic ZTE networking products at Tihan Online. Best price guaranteed.',NULL,9,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(11,'Totolink','totolink','uploads/brands/brand_10.jpg','Totolink is a leading brand providing high-quality networking and broadband accessories worldwide.',0,1,'Buy Totolink Products Online - Tihan Online','Shop authentic Totolink networking products at Tihan Online. Best price guaranteed.',NULL,10,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(12,'Asus','asus','uploads/brands/brand_11.jpg','Asus is a leading brand providing high-quality networking and broadband accessories worldwide.',0,1,'Buy Asus Products Online - Tihan Online','Shop authentic Asus networking products at Tihan Online. Best price guaranteed.',NULL,11,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(13,'Linksys','linksys','uploads/brands/brand_12.jpg','Linksys is a leading brand providing high-quality networking and broadband accessories worldwide.',0,1,'Buy Linksys Products Online - Tihan Online','Shop authentic Linksys networking products at Tihan Online. Best price guaranteed.',NULL,12,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(14,'Ruijie','ruijie','uploads/brands/brand_13.jpg','Ruijie is a leading brand providing high-quality networking and broadband accessories worldwide.',0,1,'Buy Ruijie Products Online - Tihan Online','Shop authentic Ruijie networking products at Tihan Online. Best price guaranteed.',NULL,13,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(15,'Cambium','cambium','uploads/brands/brand_14.jpg','Cambium is a leading brand providing high-quality networking and broadband accessories worldwide.',0,1,'Buy Cambium Products Online - Tihan Online','Shop authentic Cambium networking products at Tihan Online. Best price guaranteed.',NULL,14,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(16,'Cudy','cudy','uploads/brands/brand_15.jpg','Cudy is a leading brand providing high-quality networking and broadband accessories worldwide.',0,1,'Buy Cudy Products Online - Tihan Online','Shop authentic Cudy networking products at Tihan Online. Best price guaranteed.',NULL,15,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(17,'Mercusys','mercusys','uploads/brands/brand_16.jpg','Mercusys is a leading brand providing high-quality networking and broadband accessories worldwide.',0,1,'Buy Mercusys Products Online - Tihan Online','Shop authentic Mercusys networking products at Tihan Online. Best price guaranteed.',NULL,16,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(18,'BDCOM','bdcom','uploads/brands/brand_17.jpg','BDCOM is a leading brand providing high-quality networking and broadband accessories worldwide.',0,1,'Buy BDCOM Products Online - Tihan Online','Shop authentic BDCOM networking products at Tihan Online. Best price guaranteed.',NULL,17,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(19,'VSOL','vsol','uploads/brands/brand_18.jpg','VSOL is a leading brand providing high-quality networking and broadband accessories worldwide.',0,1,'Buy VSOL Products Online - Tihan Online','Shop authentic VSOL networking products at Tihan Online. Best price guaranteed.',NULL,18,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(20,'Nokia','nokia','uploads/brands/brand_19.jpg','Nokia is a leading brand providing high-quality networking and broadband accessories worldwide.',0,1,'Buy Nokia Products Online - Tihan Online','Shop authentic Nokia networking products at Tihan Online. Best price guaranteed.',NULL,19,'2026-08-07 10:18:29','2026-08-07 10:18:29');
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carts`
--

DROP TABLE IF EXISTS `carts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `session_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` bigint unsigned DEFAULT NULL,
  `product_id` bigint unsigned NOT NULL,
  `variant_id` bigint unsigned DEFAULT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `carts_product_id_foreign` (`product_id`),
  KEY `carts_variant_id_foreign` (`variant_id`),
  KEY `carts_session_id_index` (`session_id`),
  KEY `carts_customer_id_index` (`customer_id`),
  CONSTRAINT `carts_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `carts_variant_id_foreign` FOREIGN KEY (`variant_id`) REFERENCES `product_variants` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carts`
--

LOCK TABLES `carts` WRITE;
/*!40000 ALTER TABLE `carts` DISABLE KEYS */;
INSERT INTO `carts` VALUES (1,'cart_6a7609f49d2557.26638693',NULL,3,NULL,3,'2026-08-07 10:52:50','2026-08-07 10:53:07'),(2,'cart_6a7609f49d2557.26638693',NULL,4,NULL,1,'2026-08-07 10:52:51','2026-08-07 10:52:51'),(3,'cart_6a7609f49d2557.26638693',NULL,5,NULL,1,'2026-08-07 10:52:52','2026-08-07 10:52:52'),(8,'cart_6a7612462a4781.85440949',NULL,1,NULL,1,'2026-08-07 11:13:42','2026-08-07 11:13:42'),(9,'cart_6a7609f49d2557.26638693',21,3,NULL,2,'2026-08-07 11:19:33','2026-08-07 11:19:39'),(10,'cart_6a7609f49d2557.26638693',21,4,NULL,2,'2026-08-07 11:19:35','2026-08-07 11:19:46'),(11,'cart_6a79e3da1c58e1.50299670',NULL,4,NULL,1,'2026-08-10 08:45:06','2026-08-10 08:45:06'),(12,'cart_6a79e3da1c58e1.50299670',NULL,5,NULL,1,'2026-08-10 08:46:27','2026-08-10 08:46:27'),(13,'cart_6a79e3da1c58e1.50299670',NULL,3,NULL,1,'2026-08-10 08:47:04','2026-08-10 08:47:04'),(14,'cart_6a7c8e1e4da422.33468960',NULL,7,NULL,1,'2026-08-12 09:16:15','2026-08-12 09:16:15'),(15,'cart_6a7c8e1e4da422.33468960',23,5,NULL,1,'2026-08-12 09:16:40','2026-08-12 09:16:40'),(16,'cart_6a7ecdc62b65c1.11331347',NULL,10,NULL,6,'2026-08-14 02:11:54','2026-08-14 02:12:03'),(21,'cart_6a7ed3eda4da38.85864443',NULL,10,NULL,1,'2026-08-14 02:38:09','2026-08-14 02:38:09'),(22,'cart_6a7ed3eda4da38.85864443',NULL,1,NULL,1,'2026-08-14 02:38:11','2026-08-14 02:38:11'),(34,'cart_6a7ee9f96b0564.85609349',NULL,10,NULL,6,'2026-08-14 04:21:33','2026-08-14 04:24:34'),(35,'cart_6a7ee9f96b0564.85609349',26,38,NULL,1,'2026-08-14 04:26:24','2026-08-14 04:26:24');
/*!40000 ALTER TABLE `carts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint unsigned DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`),
  KEY `categories_parent_id_foreign` (`parent_id`),
  CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Routers & Networking','routers-networking',NULL,'uploads/categories/cat_0.jpg','fas fa-wifi','WiFi routers, mesh systems, and networking devices',1,1,'Routers & Networking - Buy Online at Tihan Online','Shop the best routers & networking at Tihan Online. ✓ Best Price ✓ Fast Delivery ✓ Genuine Products.',NULL,0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(2,'Routers & Networking - Premium','routers-networking-premium',1,'uploads/categories/cat_10.jpg',NULL,'Best quality routers & networking at affordable prices.',0,1,NULL,NULL,NULL,0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(3,'Routers & Networking - Budget','routers-networking-budget',1,'uploads/categories/cat_11.jpg',NULL,'Best quality routers & networking at affordable prices.',0,1,NULL,NULL,NULL,1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(4,'Cables & Connectors','cables-connectors',NULL,'uploads/categories/cat_1.jpg','fas fa-plug','LAN cables, fiber cables, RJ45 connectors, and accessories',1,1,'Cables & Connectors - Buy Online at Tihan Online','Shop the best cables & connectors at Tihan Online. ✓ Best Price ✓ Fast Delivery ✓ Genuine Products.',NULL,1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(5,'Cables & Connectors - Premium','cables-connectors-premium',4,'uploads/categories/cat_12.jpg',NULL,'Best quality cables & connectors at affordable prices.',0,1,NULL,NULL,NULL,0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(6,'Cables & Connectors - Budget','cables-connectors-budget',4,'uploads/categories/cat_13.jpg',NULL,'Best quality cables & connectors at affordable prices.',0,1,NULL,NULL,NULL,1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(7,'Antennas & Boosters','antennas-boosters',NULL,'uploads/categories/cat_2.jpg','fas fa-broadcast-tower','WiFi antennas, signal boosters, and range extenders',1,1,'Antennas & Boosters - Buy Online at Tihan Online','Shop the best antennas & boosters at Tihan Online. ✓ Best Price ✓ Fast Delivery ✓ Genuine Products.',NULL,2,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(8,'Antennas & Boosters - Premium','antennas-boosters-premium',7,'uploads/categories/cat_14.jpg',NULL,'Best quality antennas & boosters at affordable prices.',0,1,NULL,NULL,NULL,0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(9,'Antennas & Boosters - Budget','antennas-boosters-budget',7,'uploads/categories/cat_15.jpg',NULL,'Best quality antennas & boosters at affordable prices.',0,1,NULL,NULL,NULL,1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(10,'Modems & ONU','modems-onu',NULL,'uploads/categories/cat_3.jpg','fas fa-server','GPON ONU, optical network terminals, and modems',1,1,'Modems & ONU - Buy Online at Tihan Online','Shop the best modems & onu at Tihan Online. ✓ Best Price ✓ Fast Delivery ✓ Genuine Products.',NULL,3,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(11,'Modems & ONU - Premium','modems-onu-premium',10,'uploads/categories/cat_16.jpg',NULL,'Best quality modems & onu at affordable prices.',0,1,NULL,NULL,NULL,0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(12,'Modems & ONU - Budget','modems-onu-budget',10,'uploads/categories/cat_17.jpg',NULL,'Best quality modems & onu at affordable prices.',0,1,NULL,NULL,NULL,1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(13,'Network Switches','network-switches',NULL,'uploads/categories/cat_4.jpg','fas fa-network-wired','Managed/unmanaged switches, PoE switches',1,1,'Network Switches - Buy Online at Tihan Online','Shop the best network switches at Tihan Online. ✓ Best Price ✓ Fast Delivery ✓ Genuine Products.',NULL,4,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(14,'Network Switches - Premium','network-switches-premium',13,'uploads/categories/cat_18.jpg',NULL,'Best quality network switches at affordable prices.',0,1,NULL,NULL,NULL,0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(15,'Network Switches - Budget','network-switches-budget',13,'uploads/categories/cat_19.jpg',NULL,'Best quality network switches at affordable prices.',0,1,NULL,NULL,NULL,1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(16,'Power & Adapters','power-adapters',NULL,'uploads/categories/cat_5.jpg','fas fa-bolt','Power adapters, PoE injectors, UPS for networking',1,1,'Power & Adapters - Buy Online at Tihan Online','Shop the best power & adapters at Tihan Online. ✓ Best Price ✓ Fast Delivery ✓ Genuine Products.',NULL,5,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(17,'Power & Adapters - Premium','power-adapters-premium',16,'uploads/categories/cat_20.jpg',NULL,'Best quality power & adapters at affordable prices.',0,1,NULL,NULL,NULL,0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(18,'Power & Adapters - Budget','power-adapters-budget',16,'uploads/categories/cat_21.jpg',NULL,'Best quality power & adapters at affordable prices.',0,1,NULL,NULL,NULL,1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(19,'Mounting & Accessories','mounting-accessories',NULL,'uploads/categories/cat_6.jpg','fas fa-tools','Wall mounts, brackets, cable organizers',1,1,'Mounting & Accessories - Buy Online at Tihan Online','Shop the best mounting & accessories at Tihan Online. ✓ Best Price ✓ Fast Delivery ✓ Genuine Products.',NULL,6,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(20,'Mounting & Accessories - Premium','mounting-accessories-premium',19,'uploads/categories/cat_22.jpg',NULL,'Best quality mounting & accessories at affordable prices.',0,1,NULL,NULL,NULL,0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(21,'Mounting & Accessories - Budget','mounting-accessories-budget',19,'uploads/categories/cat_23.jpg',NULL,'Best quality mounting & accessories at affordable prices.',0,1,NULL,NULL,NULL,1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(22,'Fiber Optic Equipment','fiber-optic-equipment',NULL,'uploads/categories/cat_7.jpg','fas fa-fiber','Fiber patch cords, SFP modules, media converters',1,1,'Fiber Optic Equipment - Buy Online at Tihan Online','Shop the best fiber optic equipment at Tihan Online. ✓ Best Price ✓ Fast Delivery ✓ Genuine Products.',NULL,7,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(23,'Fiber Optic Equipment - Premium','fiber-optic-equipment-premium',22,'uploads/categories/cat_24.jpg',NULL,'Best quality fiber optic equipment at affordable prices.',0,1,NULL,NULL,NULL,0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(24,'Fiber Optic Equipment - Budget','fiber-optic-equipment-budget',22,'uploads/categories/cat_25.jpg',NULL,'Best quality fiber optic equipment at affordable prices.',0,1,NULL,NULL,NULL,1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(25,'LAN Cards & Adapters','lan-cards-adapters',NULL,'uploads/categories/cat_8.jpg','fas fa-ethernet','PCIe LAN cards, USB to Ethernet adapters',0,1,'LAN Cards & Adapters - Buy Online at Tihan Online','Shop the best lan cards & adapters at Tihan Online. ✓ Best Price ✓ Fast Delivery ✓ Genuine Products.',NULL,8,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(26,'LAN Cards & Adapters - Premium','lan-cards-adapters-premium',25,'uploads/categories/cat_26.jpg',NULL,'Best quality lan cards & adapters at affordable prices.',0,1,NULL,NULL,NULL,0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(27,'LAN Cards & Adapters - Budget','lan-cards-adapters-budget',25,'uploads/categories/cat_27.jpg',NULL,'Best quality lan cards & adapters at affordable prices.',0,1,NULL,NULL,NULL,1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(28,'CCTV & Security','cctv-security',NULL,'uploads/categories/cat_9.jpg','fas fa-video','IP cameras, NVR, security accessories',0,1,'CCTV & Security - Buy Online at Tihan Online','Shop the best cctv & security at Tihan Online. ✓ Best Price ✓ Fast Delivery ✓ Genuine Products.',NULL,9,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(29,'CCTV & Security - Premium','cctv-security-premium',28,'uploads/categories/cat_28.jpg',NULL,'Best quality cctv & security at affordable prices.',0,1,NULL,NULL,NULL,0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(30,'CCTV & Security - Budget','cctv-security-budget',28,'uploads/categories/cat_29.jpg',NULL,'Best quality cctv & security at affordable prices.',0,1,NULL,NULL,NULL,1,'2026-08-07 10:18:29','2026-08-07 10:18:29');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_messages`
--

DROP TABLE IF EXISTS `contact_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact_messages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_messages`
--

LOCK TABLES `contact_messages` WRITE;
/*!40000 ALTER TABLE `contact_messages` DISABLE KEYS */;
INSERT INTO `contact_messages` VALUES (1,'Customer 1','customer1@gmail.com','01843574430','Order Status','I need information about networking products available at Tihan Online.',1,'2026-07-13 10:18:33','2026-08-07 10:18:33'),(2,'Customer 2','customer2@gmail.com','01838769215','Bulk Order','I need information about networking products available at Tihan Online.',1,'2026-07-25 10:18:33','2026-08-07 10:18:33'),(3,'Customer 3','customer3@gmail.com','01898170096','Order Status','I need information about networking products available at Tihan Online.',1,'2026-07-24 10:18:33','2026-08-07 10:18:33'),(4,'Customer 4','customer4@gmail.com','01770330710','Technical Support','I need information about networking products available at Tihan Online.',1,'2026-07-10 10:18:33','2026-08-07 10:18:33'),(5,'Customer 5','customer5@gmail.com','01738682271','Technical Support','I need information about networking products available at Tihan Online.',1,'2026-07-11 10:18:33','2026-08-07 10:18:33'),(6,'Customer 6','customer6@gmail.com','01889464567','Bulk Order','I need information about networking products available at Tihan Online.',1,'2026-08-04 10:18:33','2026-08-07 10:18:33'),(7,'Customer 7','customer7@gmail.com','01923477907','Feedback','I need information about networking products available at Tihan Online.',1,'2026-07-24 10:18:33','2026-08-07 10:18:33'),(8,'Customer 8','customer8@gmail.com','01814309651','Feedback','I need information about networking products available at Tihan Online.',1,'2026-07-16 10:18:33','2026-08-07 10:18:33'),(9,'Customer 9','customer9@gmail.com','01922707969','Technical Support','I need information about networking products available at Tihan Online.',1,'2026-07-11 10:18:33','2026-08-07 10:18:33'),(10,'Customer 10','customer10@gmail.com','01863943019','Bulk Order','I need information about networking products available at Tihan Online.',1,'2026-07-09 10:18:33','2026-08-07 10:18:33'),(11,'Customer 11','customer11@gmail.com','01847165330','Feedback','I need information about networking products available at Tihan Online.',1,'2026-07-23 10:18:33','2026-08-07 10:18:33'),(12,'Customer 12','customer12@gmail.com','01991020590','Product Inquiry','I need information about networking products available at Tihan Online.',1,'2026-07-18 10:18:33','2026-08-07 10:18:33'),(13,'Customer 13','customer13@gmail.com','01769889648','Bulk Order','I need information about networking products available at Tihan Online.',1,'2026-07-22 10:18:33','2026-08-07 10:18:33'),(14,'Customer 14','customer14@gmail.com','01854131334','Product Inquiry','I need information about networking products available at Tihan Online.',1,'2026-08-03 10:18:33','2026-08-07 10:18:33'),(15,'Customer 15','customer15@gmail.com','01844744302','Bulk Order','I need information about networking products available at Tihan Online.',1,'2026-07-30 10:18:33','2026-08-07 10:18:33'),(16,'Customer 16','customer16@gmail.com','01787527097','Product Inquiry','I need information about networking products available at Tihan Online.',0,'2026-07-26 10:18:33','2026-08-07 10:18:33'),(17,'Customer 17','customer17@gmail.com','01840332677','Product Inquiry','I need information about networking products available at Tihan Online.',0,'2026-08-05 10:18:33','2026-08-07 10:18:33'),(18,'Customer 18','customer18@gmail.com','01857477882','Product Inquiry','I need information about networking products available at Tihan Online.',0,'2026-07-28 10:18:33','2026-08-07 10:18:33'),(19,'Customer 19','customer19@gmail.com','01945877185','Feedback','I need information about networking products available at Tihan Online.',0,'2026-07-28 10:18:33','2026-08-07 10:18:33'),(20,'Customer 20','customer20@gmail.com','01979708154','Feedback','I need information about networking products available at Tihan Online.',0,'2026-07-27 10:18:33','2026-08-07 10:18:33');
/*!40000 ALTER TABLE `contact_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coupons` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('fixed','percent') COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` decimal(12,2) NOT NULL,
  `min_order_amount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `max_discount` decimal(12,2) DEFAULT NULL,
  `usage_limit` int DEFAULT NULL,
  `used_count` int NOT NULL DEFAULT '0',
  `starts_at` datetime NOT NULL,
  `expires_at` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `coupons_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coupons`
--

LOCK TABLES `coupons` WRITE;
/*!40000 ALTER TABLE `coupons` DISABLE KEYS */;
INSERT INTO `coupons` VALUES (1,'TIHAN10','percent',10.00,500.00,300.00,471,10,'2026-08-04 16:18:29','2026-09-29 16:18:29',1,'2026-08-07 10:18:29','2026-08-14 02:35:49'),(2,'ROUTER500','fixed',500.00,3000.00,NULL,478,2,'2026-08-07 16:18:29','2026-09-02 16:18:29',1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(3,'FIBER20','percent',20.00,2000.00,1000.00,272,9,'2026-08-03 16:18:29','2026-09-01 16:18:29',1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(4,'WELCOME','percent',15.00,300.00,500.00,129,22,'2026-08-04 16:18:29','2026-10-18 16:18:29',1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(5,'BROADBAND','fixed',200.00,1000.00,NULL,206,13,'2026-08-06 16:18:29','2026-09-03 16:18:29',1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(6,'FLASH25','percent',25.00,5000.00,2000.00,472,22,'2026-08-06 16:18:29','2026-10-21 16:18:29',1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(7,'SAVE1000','fixed',1000.00,8000.00,NULL,318,19,'2026-08-02 16:18:29','2026-10-19 16:18:29',1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(8,'MEGA30','percent',30.00,10000.00,3000.00,386,27,'2026-08-02 16:18:29','2026-09-16 16:18:29',1,'2026-08-07 10:18:29','2026-08-07 10:18:29');
/*!40000 ALTER TABLE `coupons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_addresses`
--

DROP TABLE IF EXISTS `customer_addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer_addresses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint unsigned NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `division` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `upazila` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_line` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `type` enum('home','office','other') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'home',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_addresses_customer_id_foreign` (`customer_id`),
  CONSTRAINT `customer_addresses_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_addresses`
--

LOCK TABLES `customer_addresses` WRITE;
/*!40000 ALTER TABLE `customer_addresses` DISABLE KEYS */;
INSERT INTO `customer_addresses` VALUES (1,1,'Md. Hasan Ahmed','01769040443',NULL,'Rangpur','Khilgaon','Banani','House 92, Road 27, Block B',NULL,1,'home','2026-08-07 10:18:29','2026-08-07 10:18:29'),(2,2,'Fatima Akhter','01726319715',NULL,'Mymensingh','Mirpur','Gulshan','House 27, Road 37, Block D',NULL,1,'home','2026-08-07 10:18:29','2026-08-07 10:18:29'),(3,3,'Tanvir Hasan','01818588990',NULL,'Mymensingh','Mirpur','Gulshan','House 86, Road 2, Block F',NULL,1,'home','2026-08-07 10:18:30','2026-08-07 10:18:30'),(4,4,'Nusrat Jahan','01967792898',NULL,'Rajshahi','Dhanmondi','Mohammadpur','House 56, Road 36, Block D',NULL,1,'home','2026-08-07 10:18:30','2026-08-07 10:18:30'),(5,5,'Shakib Rahman','01772754588',NULL,'Mymensingh','Banani','Badda','House 30, Road 47, Block A',NULL,1,'home','2026-08-07 10:18:30','2026-08-07 10:18:30'),(6,6,'Ayesha Siddique','01830206726',NULL,'Mymensingh','Mirpur','Banani','House 57, Road 36, Block F',NULL,1,'home','2026-08-07 10:18:30','2026-08-07 10:18:30'),(7,7,'Mehedi Hassan','01951633333',NULL,'Rangpur','Gulshan','Mohammadpur','House 94, Road 3, Block A',NULL,1,'home','2026-08-07 10:18:30','2026-08-07 10:18:30'),(8,8,'Tania Sultana','01967426822',NULL,'Rajshahi','Badda','Mohammadpur','House 36, Road 15, Block C',NULL,1,'home','2026-08-07 10:18:31','2026-08-07 10:18:31'),(9,9,'Ariful Islam','01926364483',NULL,'Rangpur','Uttara','Dhanmondi','House 7, Road 31, Block F',NULL,1,'home','2026-08-07 10:18:31','2026-08-07 10:18:31'),(10,10,'Nadia Islam','01888958692',NULL,'Rangpur','Uttara','Uttara','House 61, Road 20, Block C',NULL,1,'home','2026-08-07 10:18:31','2026-08-07 10:18:31'),(11,11,'Kabir Hossain','01819162623',NULL,'Khulna','Mirpur','Dhanmondi','House 28, Road 50, Block F',NULL,1,'home','2026-08-07 10:18:31','2026-08-07 10:18:31'),(12,12,'Sharmin Akhter','01821551394',NULL,'Sylhet','Gulshan','Mohammadpur','House 73, Road 30, Block A',NULL,1,'home','2026-08-07 10:18:31','2026-08-07 10:18:31'),(13,13,'Rafiqul Islam','01826145541',NULL,'Rangpur','Khilgaon','Gulshan','House 71, Road 32, Block F',NULL,1,'home','2026-08-07 10:18:32','2026-08-07 10:18:32'),(14,14,'Jannatul Ferdous','01821221177',NULL,'Chattogram','Badda','Badda','House 46, Road 41, Block D',NULL,1,'home','2026-08-07 10:18:32','2026-08-07 10:18:32'),(15,15,'Sohel Rana','01729183394',NULL,'Rajshahi','Dhanmondi','Dhanmondi','House 37, Road 48, Block A',NULL,1,'home','2026-08-07 10:18:32','2026-08-07 10:18:32'),(16,16,'Mousumi Khatun','01971065095',NULL,'Mymensingh','Banani','Badda','House 6, Road 13, Block A',NULL,1,'home','2026-08-07 10:18:32','2026-08-07 10:18:32'),(17,17,'Imran Khan','01795604145',NULL,'Khulna','Mohammadpur','Mirpur','House 10, Road 25, Block E',NULL,1,'home','2026-08-07 10:18:32','2026-08-07 10:18:32'),(18,18,'Sabrina Yesmin','01895860737',NULL,'Rajshahi','Gulshan','Gulshan','House 78, Road 31, Block A',NULL,1,'home','2026-08-07 10:18:33','2026-08-07 10:18:33'),(19,19,'Fahim Chowdhury','01820880763',NULL,'Rajshahi','Khilgaon','Badda','House 19, Road 4, Block C',NULL,1,'home','2026-08-07 10:18:33','2026-08-07 10:18:33'),(20,20,'Rokeya Begum','01710604936',NULL,'Khulna','Khilgaon','Gulshan','House 28, Road 34, Block E',NULL,1,'home','2026-08-07 10:18:33','2026-08-07 10:18:33'),(21,24,'Kibo Mcdowell','+1 (259) 127-8295','bomitov@mailinator.com','Rangpur','Ranpur','pirgaccha','test addresss','Quos facilis ullamco',0,'home','2026-08-14 02:35:49','2026-08-14 02:35:49'),(22,25,'Quintessa Wilkinson','+1 (187) 418-3677','kotybezywy@mailinator.com','dhaka','dhaka','adabor','Maxime inventore sun','Sed reprehenderit si',0,'home','2026-08-14 02:54:57','2026-08-14 03:33:53'),(23,25,'Kessie Gutierrez','+1 (586) 965-6165','tymylywoqa@mailinator.com','Blanditiis esse dol','Quo ratione quia pra','Nesciunt quidem aut','Fugiat deserunt prae','Voluptas in ut verit',1,'home','2026-08-14 03:33:53','2026-08-14 03:33:53');
/*!40000 ALTER TABLE `customer_addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customers_email_unique` (`email`),
  UNIQUE KEY `customers_phone_unique` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,'Md. Hasan Ahmed','ahmed22@gmail.com','2026-08-07 10:18:29','01914046420',NULL,'$2y$12$OikCSCxPz.qEg1YzaZKYquvxBFsq2rfM81..Lr7qT5v0rwoVHPBeu',NULL,NULL,NULL,1,NULL,'2026-07-04 10:18:29','2026-08-07 10:18:29'),(2,'Fatima Akhter','akhter99@gmail.com','2026-08-07 10:18:29','01785480151',NULL,'$2y$12$zwyeOW77M23W6UeZvx5QAe1MNGey4vTbZHWxcJy7sB8pHWvBHxDBu',NULL,NULL,NULL,1,NULL,'2026-08-01 10:18:29','2026-08-07 10:18:29'),(3,'Tanvir Hasan','hasan70@gmail.com','2026-08-07 10:18:29','01777000631',NULL,'$2y$12$CjWRcEPQhiBlpHM/vNgTC.PVavIqYk7TMg2TqYdzyrjHg9afculL6',NULL,NULL,NULL,1,NULL,'2026-04-08 10:18:30','2026-08-07 10:18:30'),(4,'Nusrat Jahan','jahan67@gmail.com','2026-08-07 10:18:30','01918806386',NULL,'$2y$12$EKLUXHQByJgeHE530sbfdedaIoNFg628aXFS11pZQiuoMKTBedqKm',NULL,NULL,NULL,1,NULL,'2026-02-14 10:18:30','2026-08-07 10:18:30'),(5,'Shakib Rahman','rahman89@gmail.com','2026-08-07 10:18:30','01884812810',NULL,'$2y$12$xA3Rp6Lma3QRVFsLsFY1a.skz2iJCeyuTBrlgd/ONbQunkp9bR3V2',NULL,NULL,NULL,1,NULL,'2026-05-11 10:18:30','2026-08-07 10:18:30'),(6,'Ayesha Siddique','siddique87@gmail.com','2026-08-07 10:18:30','01921061865',NULL,'$2y$12$RyBsje0PPyI7ip.fZlFZr.3x6QPoc0bUoAnqH87DP4UHABtyLkLLu',NULL,NULL,NULL,1,NULL,'2026-05-06 10:18:30','2026-08-07 10:18:30'),(7,'Mehedi Hassan','hassan70@gmail.com','2026-08-07 10:18:30','01762395517',NULL,'$2y$12$egA/teHnr5DF2i/ayYdiV.VdHhVAasM4OghSexc2NiefenJCZFPN6',NULL,NULL,NULL,1,NULL,'2026-04-21 10:18:30','2026-08-07 10:18:30'),(8,'Tania Sultana','sultana25@gmail.com','2026-08-07 10:18:30','01825471954',NULL,'$2y$12$cw2Z0ombw1JIQgMvY0bznOGldqrJY7CJf7nzhqVhL25Hs1xpYsKiC',NULL,NULL,NULL,1,NULL,'2026-03-06 10:18:31','2026-08-07 10:18:31'),(9,'Ariful Islam','islam16@gmail.com','2026-08-07 10:18:31','01727129008',NULL,'$2y$12$9vmvp7nximSYzxWO46E5SOHFS.DHbGtVM95BUHa0BYo71Pe.9PI6u',NULL,NULL,NULL,1,NULL,'2026-06-08 10:18:31','2026-08-07 10:18:31'),(10,'Nadia Islam','islam74@gmail.com','2026-08-07 10:18:31','01757026820',NULL,'$2y$12$QvLZNanJ7934R142SIwdrez7zfEBW6FNPcdRA0mwfyECBBCHtrFku',NULL,NULL,NULL,1,NULL,'2026-05-15 10:18:31','2026-08-07 10:18:31'),(11,'Kabir Hossain','hossain84@gmail.com','2026-08-07 10:18:31','01971298632',NULL,'$2y$12$PZfJubvaykp1kVx5B4Scc.loqSSXsfiC4w7HWI13mTiqqEK4fgD22',NULL,NULL,NULL,1,NULL,'2026-07-01 10:18:31','2026-08-07 10:18:31'),(12,'Sharmin Akhter','akhter82@gmail.com','2026-08-07 10:18:31','01795838305',NULL,'$2y$12$P6B.LNiISF.LRj5PNU.h3.R7X7wQu7HXz1ECltnHYqmqHPZgcTEJm',NULL,NULL,NULL,1,NULL,'2026-04-09 10:18:31','2026-08-07 10:18:31'),(13,'Rafiqul Islam','islam18@gmail.com','2026-08-07 10:18:31','01852932909',NULL,'$2y$12$tpdTwFbuJfu4RSwbTSHyvO2cP/wI.EpCNzJZWOUI5W43zfQn/mjcq',NULL,NULL,NULL,1,NULL,'2026-04-02 10:18:32','2026-08-07 10:18:32'),(14,'Jannatul Ferdous','ferdous96@gmail.com','2026-08-07 10:18:32','01717159224',NULL,'$2y$12$oIA0hFgYgRw0xCAP7L7MTu0XftwnUiT6RJATncN.9BT.rdlfPTxNi',NULL,NULL,NULL,1,NULL,'2026-06-04 10:18:32','2026-08-07 10:18:32'),(15,'Sohel Rana','rana27@gmail.com','2026-08-07 10:18:32','01715067945',NULL,'$2y$12$CayZ2nDLxxy88tv/DUt/Vu.AItSXxdV95r.X7Yy712HrRl8bO84tm',NULL,NULL,NULL,1,NULL,'2026-03-12 10:18:32','2026-08-07 10:18:32'),(16,'Mousumi Khatun','khatun76@gmail.com','2026-08-07 10:18:32','01920780258',NULL,'$2y$12$NL8DcCCk3xvdueyRYKDTzuYi16o0PpJJKsAdaqflsJSXl3kFFXZy2',NULL,NULL,NULL,1,NULL,'2026-07-24 10:18:32','2026-08-07 10:18:32'),(17,'Imran Khan','khan33@gmail.com','2026-08-07 10:18:32','01867311636',NULL,'$2y$12$IWchVL9WHRWBJvduDk89M.9n4wJR6xBdt30dOwsS7hQ0UgZxZsTkm',NULL,NULL,NULL,1,NULL,'2026-08-02 10:18:32','2026-08-07 10:18:32'),(18,'Sabrina Yesmin','yesmin21@gmail.com','2026-08-07 10:18:32','01888354232',NULL,'$2y$12$n57GwCLpjwnwbeTqaWO86uhXC/DpicK6u/kwKhrPlLb3C8X1PM33.',NULL,NULL,NULL,1,NULL,'2026-05-01 10:18:33','2026-08-07 10:18:33'),(19,'Fahim Chowdhury','chowdhury14@gmail.com','2026-08-07 10:18:33','01863808481',NULL,'$2y$12$oYeCjCkJYIDzfKB37o7anOrvZGQG7z0HOWNpi2x//ZdUVLUPyrvry',NULL,NULL,NULL,1,NULL,'2026-02-09 10:18:33','2026-08-07 10:18:33'),(20,'Rokeya Begum','begum29@gmail.com','2026-08-07 10:18:33','01880067126',NULL,'$2y$12$5fuzhFjGlV8MyHc0yvByFeo.EEWBRijXNkE4z6sG4aLRUrAkz5r66',NULL,NULL,NULL,1,NULL,'2026-05-20 10:18:33','2026-08-07 10:18:33'),(21,'Anne Beach','dymagyno@mailinator.com',NULL,'+1 (947) 949-8317',NULL,'$2y$12$qH9DXHa5qMyE2TCAUKoXCe1Pm/qs.Mj7HIdDi0CPeWklM9i8MsDB.',NULL,NULL,NULL,1,NULL,'2026-08-07 10:53:26','2026-08-07 10:53:26'),(22,'Test User','testuser@test.com',NULL,'01712345678',NULL,'$2y$12$xIA/crGBo1oaMvYJr4X5p.7rnPiuW3L0t03Gx2bdCgG1q8wn8Jwlq',NULL,NULL,NULL,0,NULL,'2026-08-07 11:15:13','2026-08-14 03:31:03'),(23,'Imelda Mcpherson','xekup@mailinator.com',NULL,'+1 (728) 174-4787',NULL,'$2y$12$K.hf6QTOGxnzsg2yMVUba.nI2kwx/BAUN8kvevBJ8QN1ygVLmpUjC',NULL,NULL,NULL,0,NULL,'2026-08-12 09:16:34','2026-08-14 03:31:01'),(24,'Aspen Lambert','jiguqokike@mailinator.com',NULL,'+1 (155) 857-6721',NULL,'$2y$12$Pdhmoy/pmfMu1RAZF7FR7Ocxz/YpPybHEJAsm339oQsZME7zCclNO',NULL,NULL,NULL,1,NULL,'2026-08-14 02:12:43','2026-08-14 02:12:43'),(25,'Denise Alexander','lyrizika@mailinator.com',NULL,'+1 (909) 751-2813',NULL,'$2y$12$nN8uD1Nmud4H1lWDVIs3U.KIWrqBr4ZO6j/7RGFErFkR3vkZX7lbC',NULL,NULL,NULL,1,NULL,'2026-08-14 02:38:35','2026-08-14 03:27:59'),(26,'Jada Roy','fepawusax@mailinator.com',NULL,'+1 (621) 262-4379',NULL,'$2y$12$I.DuaWI5E2oDZql130GMbuIMl66.atyUInRUGj.jHS9p1q6gffVpy',NULL,NULL,NULL,1,NULL,'2026-08-14 04:26:18','2026-08-14 04:26:18');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2026_08_07_152244_create_admins_table',1),(2,'2026_08_07_152245_create_categories_table',1),(3,'2026_08_07_152246_create_brands_table',1),(4,'2026_08_07_152247_create_products_table',1),(5,'2026_08_07_152248_create_product_images_table',1),(6,'2026_08_07_152249_create_product_variants_table',1),(7,'2026_08_07_152250_create_sliders_table',1),(8,'2026_08_07_152251_create_banners_table',1),(9,'2026_08_07_152252_create_coupons_table',1),(10,'2026_08_07_152253_create_settings_table',1),(11,'2026_08_07_152254_create_customers_table',1),(12,'2026_08_07_152255_create_customer_addresses_table',1),(13,'2026_08_07_152256_create_orders_table',1),(14,'2026_08_07_152257_create_order_items_table',1),(15,'2026_08_07_152258_create_wishlists_table',1),(16,'2026_08_07_152259_create_carts_table',1),(17,'2026_08_07_152300_create_product_reviews_table',1),(18,'2026_08_07_152301_create_pages_table',1),(19,'2026_08_07_152302_create_subscribers_table',1),(20,'2026_08_07_152303_create_contact_messages_table',1),(21,'2026_08_07_152304_create_search_terms_table',1),(22,'2026_08_07_152305_create_cache_table',1),(23,'2026_08_07_152306_create_sessions_table',1),(24,'2026_08_07_154604_create_password_reset_tokens_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned DEFAULT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `variant_details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int NOT NULL,
  `unit_price` decimal(12,2) NOT NULL,
  `subtotal` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_items_order_id_foreign` (`order_id`),
  KEY `order_items_product_id_foreign` (`product_id`),
  CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
INSERT INTO `order_items` VALUES (1,1,17,'VSOL V2802RH Dual-Band XPON ONU','uploads/products/prod_16.jpg',NULL,2,3200.00,6400.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(2,1,25,'UPS 650VA for Networking Equipment','uploads/products/prod_24.jpg',NULL,2,3200.00,6400.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(3,2,17,'VSOL V2802RH Dual-Band XPON ONU','uploads/products/prod_16.jpg',NULL,3,3200.00,9600.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(4,3,39,'CCTV Power Supply Box 12V 10A 8CH','uploads/products/prod_38.jpg',NULL,1,1200.00,1200.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(5,3,38,'CAT6 Outdoor Ethernet Cable 50m','uploads/products/prod_37.jpg',NULL,3,999.00,2997.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(6,3,38,'CAT6 Outdoor Ethernet Cable 50m','uploads/products/prod_37.jpg',NULL,3,999.00,2997.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(7,4,23,'12V 2A DC Power Adapter for Router/ONU','uploads/products/prod_22.jpg',NULL,2,299.00,598.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(8,4,12,'2.4GHz WiFi Signal Booster Repeater','uploads/products/prod_11.jpg',NULL,3,999.00,2997.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(9,5,16,'ZTE F660 GPON ONU WiFi Router','uploads/products/prod_15.jpg',NULL,2,1599.00,3198.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(10,5,3,'MikroTik hAP ac2 Dual-Band Router','uploads/products/prod_2.jpg',NULL,3,6500.00,19500.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(11,5,17,'VSOL V2802RH Dual-Band XPON ONU','uploads/products/prod_16.jpg',NULL,3,3200.00,9600.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(12,6,31,'Fiber Optical Power Meter with VFL','uploads/products/prod_30.jpg',NULL,3,2200.00,6600.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(13,6,18,'Nokia G-2425G-A GPON ONT','uploads/products/prod_17.jpg',NULL,3,2500.00,7500.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(14,6,21,'MikroTik CRS328-24P-4S+RM PoE Switch','uploads/products/prod_20.jpg',NULL,3,38000.00,114000.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(15,7,5,'Xiaomi Mi Router 4A Gigabit Edition','uploads/products/prod_4.jpg',NULL,2,1899.00,3798.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(16,7,1,'TP-Link Archer C80 AC1900 Wireless Router','uploads/products/prod_0.jpg',NULL,3,2999.00,8997.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(17,7,24,'TP-Link TL-PoE150S PoE Injector','uploads/products/prod_23.jpg',NULL,1,750.00,750.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(18,8,23,'12V 2A DC Power Adapter for Router/ONU','uploads/products/prod_22.jpg',NULL,3,299.00,897.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(19,9,23,'12V 2A DC Power Adapter for Router/ONU','uploads/products/prod_22.jpg',NULL,2,299.00,598.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(20,9,39,'CCTV Power Supply Box 12V 10A 8CH','uploads/products/prod_38.jpg',NULL,3,1200.00,3600.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(21,10,1,'TP-Link Archer C80 AC1900 Wireless Router','uploads/products/prod_0.jpg',NULL,1,2999.00,2999.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(22,10,14,'WiFi 6 Mesh Extender AX1800','uploads/products/prod_13.jpg',NULL,2,3999.00,7998.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(23,10,31,'Fiber Optical Power Meter with VFL','uploads/products/prod_30.jpg',NULL,3,2200.00,6600.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(24,11,37,'Dahua 4-Channel PoE NVR','uploads/products/prod_36.jpg',NULL,2,4999.00,9998.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(25,12,17,'VSOL V2802RH Dual-Band XPON ONU','uploads/products/prod_16.jpg',NULL,3,3200.00,9600.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(26,13,22,'Tenda TEG1024D 24-Port Gigabit Switch','uploads/products/prod_21.jpg',NULL,2,3999.00,7998.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(27,13,36,'Hikvision 2MP IP Bullet Camera','uploads/products/prod_35.jpg',NULL,3,3200.00,9600.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(28,13,8,'3m CAT6 Patch Cord Ethernet Cable','uploads/products/prod_7.jpg',NULL,2,150.00,300.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(29,14,13,'Outdoor 14dBi Panel Antenna 2.4GHz','uploads/products/prod_12.jpg',NULL,2,1800.00,3600.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(30,14,1,'TP-Link Archer C80 AC1900 Wireless Router','uploads/products/prod_0.jpg',NULL,3,2999.00,8997.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(31,15,38,'CAT6 Outdoor Ethernet Cable 50m','uploads/products/prod_37.jpg',NULL,1,999.00,999.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(32,15,34,'PCIe Gigabit Network Card Dual Port','uploads/products/prod_33.jpg',NULL,1,2500.00,2500.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(33,15,4,'Tenda AC10 AC1200 Smart WiFi Router','uploads/products/prod_3.jpg',NULL,3,1550.00,4650.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(34,16,16,'ZTE F660 GPON ONU WiFi Router','uploads/products/prod_15.jpg',NULL,1,1599.00,1599.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(35,16,17,'VSOL V2802RH Dual-Band XPON ONU','uploads/products/prod_16.jpg',NULL,3,3200.00,9600.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(36,17,23,'12V 2A DC Power Adapter for Router/ONU','uploads/products/prod_22.jpg',NULL,1,299.00,299.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(37,17,6,'CAT6 UTP LAN Cable 305m Box','uploads/products/prod_5.jpg',NULL,3,4500.00,13500.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(38,18,36,'Hikvision 2MP IP Bullet Camera','uploads/products/prod_35.jpg',NULL,2,3200.00,6400.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(39,18,6,'CAT6 UTP LAN Cable 305m Box','uploads/products/prod_5.jpg',NULL,3,4500.00,13500.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(40,18,22,'Tenda TEG1024D 24-Port Gigabit Switch','uploads/products/prod_21.jpg',NULL,3,3999.00,11997.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(41,19,29,'1GE SFP Module SX MM 550m LC','uploads/products/prod_28.jpg',NULL,2,999.00,1998.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(42,19,27,'Cable Tie Organizer Kit 200pcs','uploads/products/prod_26.jpg',NULL,1,199.00,199.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(43,19,10,'RJ45 Crimping Tool with Cable Tester Kit','uploads/products/prod_9.jpg',NULL,2,499.00,998.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(44,20,15,'Huawei HG8245H5 GPON ONU Terminal','uploads/products/prod_14.jpg',NULL,3,1999.00,5997.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(45,20,33,'USB 3.0 to Gigabit Ethernet Adapter','uploads/products/prod_32.jpg',NULL,2,999.00,1998.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(46,20,38,'CAT6 Outdoor Ethernet Cable 50m','uploads/products/prod_37.jpg',NULL,2,999.00,1998.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(47,21,39,'CCTV Power Supply Box 12V 10A 8CH','uploads/products/prod_38.jpg',NULL,3,1200.00,3600.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(48,21,12,'2.4GHz WiFi Signal Booster Repeater','uploads/products/prod_11.jpg',NULL,2,999.00,1998.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(49,21,26,'Universal Wall Mount Bracket for Router/ONU','uploads/products/prod_25.jpg',NULL,3,150.00,450.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(50,22,31,'Fiber Optical Power Meter with VFL','uploads/products/prod_30.jpg',NULL,3,2200.00,6600.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(51,23,4,'Tenda AC10 AC1200 Smart WiFi Router','uploads/products/prod_3.jpg',NULL,2,1550.00,3100.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(52,23,18,'Nokia G-2425G-A GPON ONT','uploads/products/prod_17.jpg',NULL,1,2500.00,2500.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(53,24,28,'Outdoor Weatherproof Enclosure Box','uploads/products/prod_27.jpg',NULL,2,750.00,1500.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(54,24,24,'TP-Link TL-PoE150S PoE Injector','uploads/products/prod_23.jpg',NULL,1,750.00,750.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(55,24,1,'TP-Link Archer C80 AC1900 Wireless Router','uploads/products/prod_0.jpg',NULL,2,2999.00,5998.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(56,25,3,'MikroTik hAP ac2 Dual-Band Router','uploads/products/prod_2.jpg',NULL,2,6500.00,13000.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(57,26,7,'RJ45 CAT6 Pass-Through Connector 100pcs','uploads/products/prod_6.jpg',NULL,3,299.00,897.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(58,27,26,'Universal Wall Mount Bracket for Router/ONU','uploads/products/prod_25.jpg',NULL,2,150.00,300.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(59,27,14,'WiFi 6 Mesh Extender AX1800','uploads/products/prod_13.jpg',NULL,2,3999.00,7998.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(60,28,28,'Outdoor Weatherproof Enclosure Box','uploads/products/prod_27.jpg',NULL,3,750.00,2250.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(61,29,19,'TP-Link TL-SG108 8-Port Gigabit Switch','uploads/products/prod_18.jpg',NULL,1,1550.00,1550.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(62,29,30,'Media Converter Gigabit SC Single-Mode','uploads/products/prod_29.jpg',NULL,2,1600.00,3200.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(63,29,23,'12V 2A DC Power Adapter for Router/ONU','uploads/products/prod_22.jpg',NULL,2,299.00,598.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(64,30,11,'9dBi Omni WiFi Antenna with RP-SMA','uploads/products/prod_10.jpg',NULL,1,399.00,399.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(65,30,21,'MikroTik CRS328-24P-4S+RM PoE Switch','uploads/products/prod_20.jpg',NULL,2,38000.00,76000.00,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(66,31,11,'9dBi Omni WiFi Antenna with RP-SMA','uploads/products/prod_10.jpg',NULL,1,399.00,399.00,'2026-08-14 02:35:49','2026-08-14 02:35:49'),(67,31,2,'D-Link DIR-825 WiFi 5 AC1200 Router','uploads/products/prod_1.jpg',NULL,1,2499.00,2499.00,'2026-08-14 02:35:49','2026-08-14 02:35:49'),(68,32,10,'RJ45 Crimping Tool with Cable Tester Kit','uploads/products/prod_9.jpg',NULL,1,499.00,499.00,'2026-08-14 02:55:49','2026-08-14 02:55:49'),(69,32,8,'3m CAT6 Patch Cord Ethernet Cable','uploads/products/prod_7.jpg',NULL,1,150.00,150.00,'2026-08-14 02:55:49','2026-08-14 02:55:49'),(70,33,38,'CAT6 Outdoor Ethernet Cable 50m','uploads/products/prod_37.jpg',NULL,2,999.00,1998.00,'2026-08-14 03:21:48','2026-08-14 03:21:48'),(71,33,33,'USB 3.0 to Gigabit Ethernet Adapter','uploads/products/prod_32.jpg',NULL,2,999.00,1998.00,'2026-08-14 03:21:48','2026-08-14 03:21:48'),(72,34,8,'3m CAT6 Patch Cord Ethernet Cable','uploads/products/prod_7.jpg',NULL,1,150.00,150.00,'2026-08-14 03:22:43','2026-08-14 03:22:43'),(73,35,9,'Fiber Optic Patch Cable SC/APC-SC/APC 3m','uploads/products/prod_8.jpg',NULL,1,150.00,150.00,'2026-08-14 03:32:04','2026-08-14 03:32:04'),(74,35,38,'CAT6 Outdoor Ethernet Cable 50m','uploads/products/prod_37.jpg',NULL,1,999.00,999.00,'2026-08-14 03:32:04','2026-08-14 03:32:04'),(75,36,15,'Huawei HG8245H5 GPON ONU Terminal','uploads/products/prod_14.jpg',NULL,1,1999.00,1999.00,'2026-08-14 03:33:57','2026-08-14 03:33:57'),(76,37,8,'3m CAT6 Patch Cord Ethernet Cable','uploads/products/prod_7.jpg',NULL,1,150.00,150.00,'2026-08-14 04:11:09','2026-08-14 04:11:09'),(77,37,27,'Cable Tie Organizer Kit 200pcs','uploads/products/prod_26.jpg',NULL,2,199.00,398.00,'2026-08-14 04:11:09','2026-08-14 04:11:09'),(78,37,28,'Outdoor Weatherproof Enclosure Box','uploads/products/prod_27.jpg',NULL,1,750.00,750.00,'2026-08-14 04:11:09','2026-08-14 04:11:09');
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` bigint unsigned DEFAULT NULL,
  `address_id` bigint unsigned DEFAULT NULL,
  `coupon_id` bigint unsigned DEFAULT NULL,
  `subtotal` decimal(12,2) NOT NULL,
  `discount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `delivery_charge` decimal(12,2) NOT NULL DEFAULT '0.00',
  `total` decimal(12,2) NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` enum('pending','paid','failed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `order_status` enum('pending','confirmed','processing','shipped','delivered','cancelled','returned') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_note` text COLLATE utf8mb4_unicode_ci,
  `admin_note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orders_order_number_unique` (`order_number`),
  KEY `orders_address_id_foreign` (`address_id`),
  KEY `orders_coupon_id_foreign` (`coupon_id`),
  KEY `orders_customer_id_index` (`customer_id`),
  KEY `orders_order_status_index` (`order_status`),
  KEY `orders_payment_status_index` (`payment_status`),
  KEY `orders_created_at_index` (`created_at`),
  CONSTRAINT `orders_address_id_foreign` FOREIGN KEY (`address_id`) REFERENCES `customer_addresses` (`id`) ON DELETE SET NULL,
  CONSTRAINT `orders_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`) ON DELETE SET NULL,
  CONSTRAINT `orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,'TIH-20260807-TBES2',20,20,NULL,12800.00,0.00,0.00,12800.00,'bkash','pending','confirmed',NULL,'Call before delivery.',NULL,'2026-08-03 10:18:33','2026-08-07 10:18:33'),(2,'TIH-20260807-KDF03',15,15,NULL,9600.00,1344.00,0.00,8256.00,'nagad','paid','pending','TXNK3RMD4NULJ','Call before delivery.',NULL,'2026-07-10 10:18:33','2026-08-07 10:18:33'),(3,'TIH-20260807-SWFPH',16,16,7,7194.00,0.00,0.00,7194.00,'bkash','paid','delivered','TXN1TBWSUI2J4','Call before delivery.',NULL,'2026-07-23 10:18:33','2026-08-07 10:18:33'),(4,'TIH-20260807-TZRSE',9,9,1,3595.00,0.00,120.00,3715.00,'cod','pending','cancelled',NULL,NULL,NULL,'2026-07-11 10:18:33','2026-08-07 10:18:33'),(5,'TIH-20260807-K9SPY',16,16,NULL,32298.00,3553.00,0.00,28745.00,'bkash','paid','delivered','TXNTDAWJ8BDNE',NULL,NULL,'2026-07-23 10:18:33','2026-08-07 10:18:33'),(6,'TIH-20260807-HCVVU',9,9,3,128100.00,0.00,0.00,128100.00,'nagad','paid','shipped','TXNWZTSHWLZSV','Call before delivery.',NULL,'2026-07-25 10:18:33','2026-08-07 10:18:33'),(7,'TIH-20260807-OMZ6Y',16,16,7,13545.00,0.00,0.00,13545.00,'bkash','paid','shipped','TXNMXKBI9DXZJ',NULL,NULL,'2026-07-17 10:18:33','2026-08-07 10:18:33'),(8,'TIH-20260807-WWLNO',1,1,4,897.00,99.00,60.00,858.00,'cod','pending','processing',NULL,NULL,NULL,'2026-08-04 10:18:33','2026-08-07 10:18:33'),(9,'TIH-20260807-KGD8I',3,3,5,4198.00,546.00,120.00,3772.00,'nagad','paid','delivered','TXNOA3DG6TJ9G',NULL,NULL,'2026-07-24 10:18:33','2026-08-07 10:18:33'),(10,'TIH-20260807-NLFX2',7,7,NULL,17597.00,2464.00,0.00,15133.00,'cod','pending','confirmed',NULL,'Call before delivery.',NULL,'2026-08-02 10:18:33','2026-08-07 10:18:33'),(11,'TIH-20260807-Y62LF',12,12,NULL,9998.00,1300.00,0.00,8698.00,'cod','pending','shipped',NULL,NULL,NULL,'2026-08-04 10:18:33','2026-08-07 10:18:33'),(12,'TIH-20260807-VN6PU',5,5,1,9600.00,1056.00,0.00,8544.00,'bkash','paid','pending','TXNLFUSYK8NQW','Call before delivery.',NULL,'2026-07-18 10:18:33','2026-08-07 10:18:33'),(13,'TIH-20260807-BRU33',9,9,NULL,17898.00,2148.00,0.00,15750.00,'bkash','pending','cancelled',NULL,NULL,NULL,'2026-08-04 10:18:33','2026-08-07 10:18:33'),(14,'TIH-20260807-EQHPZ',16,16,8,12597.00,0.00,0.00,12597.00,'nagad','paid','confirmed','TXNV4YMW32UYH',NULL,NULL,'2026-07-19 10:18:33','2026-08-07 10:18:33'),(15,'TIH-20260807-K3GIH',20,20,NULL,8149.00,0.00,0.00,8149.00,'bkash','paid','confirmed','TXNH1EFZNH7NS','Call before delivery.',NULL,'2026-07-21 10:18:33','2026-08-07 10:18:33'),(16,'TIH-20260807-1XQS5',16,16,4,11199.00,0.00,0.00,11199.00,'bkash','paid','pending','TXN0GUK93KAVQ',NULL,NULL,'2026-07-19 10:18:33','2026-08-07 10:18:33'),(17,'TIH-20260807-VFHDH',11,11,NULL,13799.00,0.00,0.00,13799.00,'nagad','paid','confirmed','TXN1NAJO8QGKK',NULL,NULL,'2026-08-06 10:18:33','2026-08-07 10:18:33'),(18,'TIH-20260807-MUV30',9,9,NULL,31897.00,4785.00,0.00,27112.00,'cod','paid','delivered','TXNDSA3QLLJCR','Call before delivery.',NULL,'2026-07-27 10:18:33','2026-08-07 10:18:33'),(19,'TIH-20260807-BSV7O',9,9,NULL,3195.00,0.00,120.00,3315.00,'cod','paid','delivered','TXNXHL9AZZ9XI','Call before delivery.',NULL,'2026-07-13 10:18:33','2026-08-07 10:18:33'),(20,'TIH-20260807-GMAT4',17,17,5,9993.00,0.00,0.00,9993.00,'bkash','paid','confirmed','TXNYSUVTASOLC',NULL,NULL,'2026-07-15 10:18:33','2026-08-07 10:18:33'),(21,'TIH-20260807-6O6MO',4,4,NULL,6048.00,0.00,0.00,6048.00,'cod','pending','pending',NULL,NULL,NULL,'2026-07-13 10:18:33','2026-08-07 10:18:33'),(22,'TIH-20260807-OHDB7',12,12,6,6600.00,0.00,0.00,6600.00,'bkash','paid','delivered','TXNUX1HY44B1S',NULL,NULL,'2026-07-31 10:18:33','2026-08-07 10:18:33'),(23,'TIH-20260807-ONGYW',13,13,5,5600.00,560.00,0.00,5040.00,'bkash','paid','pending','TXN9WMW6ZEPFY',NULL,NULL,'2026-07-18 10:18:33','2026-08-07 10:18:33'),(24,'TIH-20260807-K3QVJ',4,4,NULL,8248.00,0.00,0.00,8248.00,'nagad','pending','shipped',NULL,'Call before delivery.',NULL,'2026-07-14 10:18:33','2026-08-07 10:18:33'),(25,'TIH-20260807-CS5XJ',11,11,NULL,13000.00,1690.00,0.00,11310.00,'nagad','paid','shipped','TXNINGKQEPVZY',NULL,NULL,'2026-07-27 10:18:33','2026-08-07 10:18:33'),(26,'TIH-20260807-BPRDU',8,8,6,897.00,0.00,60.00,957.00,'nagad','paid','shipped','TXNVV7NVOWGHC','Call before delivery.',NULL,'2026-08-05 10:18:33','2026-08-07 10:18:33'),(27,'TIH-20260807-NTFTN',4,4,5,8298.00,0.00,0.00,8298.00,'nagad','paid','confirmed','TXNFPVCK5L7QL',NULL,NULL,'2026-08-02 10:18:33','2026-08-07 10:18:33'),(28,'TIH-20260807-JZLTY',10,10,7,2250.00,0.00,60.00,2310.00,'nagad','paid','shipped','TXNLJDLE3V8WA',NULL,NULL,'2026-07-20 10:18:33','2026-08-07 10:18:33'),(29,'TIH-20260807-LIMSZ',9,9,NULL,5348.00,0.00,0.00,5348.00,'nagad','paid','confirmed','TXNTK9FCOD7SD',NULL,NULL,'2026-07-15 10:18:33','2026-08-07 10:18:33'),(30,'TIH-20260807-M1PLH',17,17,2,76399.00,9168.00,0.00,67231.00,'nagad','paid','confirmed','TXNNVCTS0YDHD','Call before delivery.',NULL,'2026-07-17 10:18:33','2026-08-07 10:18:33'),(31,'ORD-20260814-561FA9',24,21,1,2898.00,289.80,120.00,2728.20,'cod','pending','pending',NULL,'Velit tempore occa',NULL,'2026-08-14 02:35:49','2026-08-14 02:35:49'),(32,'ORD-20260814-589C02',25,22,NULL,649.00,0.00,120.00,769.00,'cod','pending','pending',NULL,NULL,NULL,'2026-08-14 02:55:49','2026-08-14 02:55:49'),(33,'ORD-20260814-CC82EC',25,22,NULL,3996.00,0.00,120.00,4116.00,'cod','pending','pending',NULL,'Et ratione obcaecati',NULL,'2026-08-14 03:21:48','2026-08-14 03:21:48'),(34,'ORD-20260814-392FF1',25,22,NULL,150.00,0.00,120.00,270.00,'cod','pending','pending',NULL,'Nulla aliqua Labore',NULL,'2026-08-14 03:22:43','2026-08-14 03:22:43'),(35,'ORD-20260814-4EFA36',25,22,NULL,1149.00,0.00,60.00,1209.00,'cod','pending','pending',NULL,NULL,NULL,'2026-08-14 03:32:04','2026-08-14 03:32:04'),(36,'ORD-20260814-5B6039',25,23,NULL,1999.00,0.00,120.00,2119.00,'cod','pending','pending',NULL,'Qui beatae deserunt',NULL,'2026-08-14 03:33:57','2026-08-14 03:33:57'),(37,'ORD-20260814-D1F790',25,22,NULL,1298.00,0.00,60.00,1358.00,'cod','paid','processing',NULL,NULL,NULL,'2026-08-14 04:11:09','2026-08-14 04:16:58');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pages_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,'About Us','about-us','<h2>About Tihan Online</h2><p>Welcome to <strong>Tihan Online</strong> — your trusted destination for broadband accessories and networking equipment in Bangladesh.</p><p>We specialize in providing high-quality routers, cables, ONUs, fiber optic equipment, switches, antennas, and all networking essentials. Our mission is to make networking equipment accessible and affordable for everyone.</p><h3>Why Choose Tihan Online?</h3><ul><li>100% Genuine Products</li><li>Best Prices in Bangladesh</li><li>Fast Delivery Nationwide</li><li>Expert Technical Support</li><li>Warranty on All Products</li></ul>','About Us - Tihan Online',NULL,NULL,1,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(2,'Privacy Policy','privacy-policy','<h2>Privacy Policy</h2><p>Tihan Online is committed to protecting your privacy. This policy explains how we collect and use your information.</p><h3>Information We Collect</h3><p>We collect your name, email, phone, and address when you place an order. Payment information is handled securely through our payment partners.</p>','Privacy Policy - Tihan Online',NULL,NULL,1,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(3,'Terms & Conditions','terms','<h2>Terms & Conditions</h2><p>By using tihanonline.net, you agree to our terms. All products come with manufacturer warranty. Prices are subject to change without notice.</p>','Terms & Conditions - Tihan Online',NULL,NULL,1,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(4,'Return Policy','return-policy','<h2>Return & Refund</h2><p>Returns accepted within 7 days of delivery. Product must be unused with original packaging. Refunds processed within 5-7 business days.</p>','Return Policy - Tihan Online',NULL,NULL,1,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(5,'Contact Us','contact','<h2>Contact Tihan Online</h2><p><strong>Email:</strong> support@tihanonline.net</p><p><strong>Phone:</strong> +8801XXXXXXXXX</p><p><strong>Address:</strong> Dhaka, Bangladesh</p><p>We are available 7 days a week. Feel free to reach out for any inquiries!</p>','Contact Us - Tihan Online',NULL,NULL,1,'2026-08-07 10:18:33','2026-08-07 10:18:33'),(6,'Qui expedita vel qui','qui-expedita-vel-qui','Officia aut quasi su','Omnis deleniti conse','Sit omnis exercitat','Minim sint tenetur c',1,'2026-08-14 02:50:22','2026-08-14 02:50:22');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_images_product_id_foreign` (`product_id`),
  CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=151 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_images`
--

LOCK TABLES `product_images` WRITE;
/*!40000 ALTER TABLE `product_images` DISABLE KEYS */;
INSERT INTO `product_images` VALUES (1,1,'uploads/products/prod_1.jpg','TP-Link Archer C80 AC1900 Wireless Router - View 1',0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(2,1,'uploads/products/prod_2.jpg','TP-Link Archer C80 AC1900 Wireless Router - View 2',1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(3,1,'uploads/products/prod_3.jpg','TP-Link Archer C80 AC1900 Wireless Router - View 3',2,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(4,1,'uploads/products/prod_4.jpg','TP-Link Archer C80 AC1900 Wireless Router - View 4',3,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(5,1,'uploads/products/prod_5.jpg','TP-Link Archer C80 AC1900 Wireless Router - View 5',4,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(6,2,'uploads/products/prod_2.jpg','D-Link DIR-825 WiFi 5 AC1200 Router - View 1',0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(7,2,'uploads/products/prod_3.jpg','D-Link DIR-825 WiFi 5 AC1200 Router - View 2',1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(8,2,'uploads/products/prod_4.jpg','D-Link DIR-825 WiFi 5 AC1200 Router - View 3',2,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(9,2,'uploads/products/prod_5.jpg','D-Link DIR-825 WiFi 5 AC1200 Router - View 4',3,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(10,3,'uploads/products/prod_3.jpg','MikroTik hAP ac2 Dual-Band Router - View 1',0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(11,3,'uploads/products/prod_4.jpg','MikroTik hAP ac2 Dual-Band Router - View 2',1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(12,3,'uploads/products/prod_5.jpg','MikroTik hAP ac2 Dual-Band Router - View 3',2,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(13,3,'uploads/products/prod_6.jpg','MikroTik hAP ac2 Dual-Band Router - View 4',3,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(14,4,'uploads/products/prod_4.jpg','Tenda AC10 AC1200 Smart WiFi Router - View 1',0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(15,4,'uploads/products/prod_5.jpg','Tenda AC10 AC1200 Smart WiFi Router - View 2',1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(16,4,'uploads/products/prod_6.jpg','Tenda AC10 AC1200 Smart WiFi Router - View 3',2,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(17,4,'uploads/products/prod_7.jpg','Tenda AC10 AC1200 Smart WiFi Router - View 4',3,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(18,5,'uploads/products/prod_5.jpg','Xiaomi Mi Router 4A Gigabit Edition - View 1',0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(19,5,'uploads/products/prod_6.jpg','Xiaomi Mi Router 4A Gigabit Edition - View 2',1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(20,5,'uploads/products/prod_7.jpg','Xiaomi Mi Router 4A Gigabit Edition - View 3',2,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(21,5,'uploads/products/prod_8.jpg','Xiaomi Mi Router 4A Gigabit Edition - View 4',3,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(22,5,'uploads/products/prod_9.jpg','Xiaomi Mi Router 4A Gigabit Edition - View 5',4,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(23,6,'uploads/products/prod_6.jpg','CAT6 UTP LAN Cable 305m Box - View 1',0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(24,6,'uploads/products/prod_7.jpg','CAT6 UTP LAN Cable 305m Box - View 2',1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(25,6,'uploads/products/prod_8.jpg','CAT6 UTP LAN Cable 305m Box - View 3',2,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(26,7,'uploads/products/prod_7.jpg','RJ45 CAT6 Pass-Through Connector 100pcs - View 1',0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(27,7,'uploads/products/prod_8.jpg','RJ45 CAT6 Pass-Through Connector 100pcs - View 2',1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(28,7,'uploads/products/prod_9.jpg','RJ45 CAT6 Pass-Through Connector 100pcs - View 3',2,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(29,8,'uploads/products/prod_8.jpg','3m CAT6 Patch Cord Ethernet Cable - View 1',0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(30,8,'uploads/products/prod_9.jpg','3m CAT6 Patch Cord Ethernet Cable - View 2',1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(31,8,'uploads/products/prod_10.jpg','3m CAT6 Patch Cord Ethernet Cable - View 3',2,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(32,9,'uploads/products/prod_9.jpg','Fiber Optic Patch Cable SC/APC-SC/APC 3m - View 1',0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(33,9,'uploads/products/prod_10.jpg','Fiber Optic Patch Cable SC/APC-SC/APC 3m - View 2',1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(34,9,'uploads/products/prod_11.jpg','Fiber Optic Patch Cable SC/APC-SC/APC 3m - View 3',2,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(35,10,'uploads/products/prod_10.jpg','RJ45 Crimping Tool with Cable Tester Kit - View 1',0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(36,10,'uploads/products/prod_11.jpg','RJ45 Crimping Tool with Cable Tester Kit - View 2',1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(37,10,'uploads/products/prod_12.jpg','RJ45 Crimping Tool with Cable Tester Kit - View 3',2,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(38,11,'uploads/products/prod_11.jpg','9dBi Omni WiFi Antenna with RP-SMA - View 1',0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(39,11,'uploads/products/prod_12.jpg','9dBi Omni WiFi Antenna with RP-SMA - View 2',1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(40,11,'uploads/products/prod_13.jpg','9dBi Omni WiFi Antenna with RP-SMA - View 3',2,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(41,12,'uploads/products/prod_12.jpg','2.4GHz WiFi Signal Booster Repeater - View 1',0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(42,12,'uploads/products/prod_13.jpg','2.4GHz WiFi Signal Booster Repeater - View 2',1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(43,12,'uploads/products/prod_14.jpg','2.4GHz WiFi Signal Booster Repeater - View 3',2,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(44,13,'uploads/products/prod_13.jpg','Outdoor 14dBi Panel Antenna 2.4GHz - View 1',0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(45,13,'uploads/products/prod_14.jpg','Outdoor 14dBi Panel Antenna 2.4GHz - View 2',1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(46,13,'uploads/products/prod_15.jpg','Outdoor 14dBi Panel Antenna 2.4GHz - View 3',2,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(47,13,'uploads/products/prod_16.jpg','Outdoor 14dBi Panel Antenna 2.4GHz - View 4',3,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(48,14,'uploads/products/prod_14.jpg','WiFi 6 Mesh Extender AX1800 - View 1',0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(49,14,'uploads/products/prod_15.jpg','WiFi 6 Mesh Extender AX1800 - View 2',1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(50,14,'uploads/products/prod_16.jpg','WiFi 6 Mesh Extender AX1800 - View 3',2,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(51,15,'uploads/products/prod_15.jpg','Huawei HG8245H5 GPON ONU Terminal - View 1',0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(52,15,'uploads/products/prod_16.jpg','Huawei HG8245H5 GPON ONU Terminal - View 2',1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(53,15,'uploads/products/prod_17.jpg','Huawei HG8245H5 GPON ONU Terminal - View 3',2,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(54,16,'uploads/products/prod_16.jpg','ZTE F660 GPON ONU WiFi Router - View 1',0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(55,16,'uploads/products/prod_17.jpg','ZTE F660 GPON ONU WiFi Router - View 2',1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(56,16,'uploads/products/prod_18.jpg','ZTE F660 GPON ONU WiFi Router - View 3',2,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(57,16,'uploads/products/prod_19.jpg','ZTE F660 GPON ONU WiFi Router - View 4',3,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(58,17,'uploads/products/prod_17.jpg','VSOL V2802RH Dual-Band XPON ONU - View 1',0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(59,17,'uploads/products/prod_18.jpg','VSOL V2802RH Dual-Band XPON ONU - View 2',1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(60,17,'uploads/products/prod_19.jpg','VSOL V2802RH Dual-Band XPON ONU - View 3',2,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(61,17,'uploads/products/prod_20.jpg','VSOL V2802RH Dual-Band XPON ONU - View 4',3,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(62,18,'uploads/products/prod_18.jpg','Nokia G-2425G-A GPON ONT - View 1',0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(63,18,'uploads/products/prod_19.jpg','Nokia G-2425G-A GPON ONT - View 2',1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(64,18,'uploads/products/prod_20.jpg','Nokia G-2425G-A GPON ONT - View 3',2,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(65,18,'uploads/products/prod_21.jpg','Nokia G-2425G-A GPON ONT - View 4',3,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(66,18,'uploads/products/prod_22.jpg','Nokia G-2425G-A GPON ONT - View 5',4,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(67,19,'uploads/products/prod_19.jpg','TP-Link TL-SG108 8-Port Gigabit Switch - View 1',0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(68,19,'uploads/products/prod_20.jpg','TP-Link TL-SG108 8-Port Gigabit Switch - View 2',1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(69,19,'uploads/products/prod_21.jpg','TP-Link TL-SG108 8-Port Gigabit Switch - View 3',2,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(70,19,'uploads/products/prod_22.jpg','TP-Link TL-SG108 8-Port Gigabit Switch - View 4',3,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(71,20,'uploads/products/prod_20.jpg','D-Link DES-1008C 8-Port Fast Switch - View 1',0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(72,20,'uploads/products/prod_21.jpg','D-Link DES-1008C 8-Port Fast Switch - View 2',1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(73,20,'uploads/products/prod_22.jpg','D-Link DES-1008C 8-Port Fast Switch - View 3',2,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(74,20,'uploads/products/prod_23.jpg','D-Link DES-1008C 8-Port Fast Switch - View 4',3,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(75,20,'uploads/products/prod_24.jpg','D-Link DES-1008C 8-Port Fast Switch - View 5',4,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(76,21,'uploads/products/prod_21.jpg','MikroTik CRS328-24P-4S+RM PoE Switch - View 1',0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(77,21,'uploads/products/prod_22.jpg','MikroTik CRS328-24P-4S+RM PoE Switch - View 2',1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(78,21,'uploads/products/prod_23.jpg','MikroTik CRS328-24P-4S+RM PoE Switch - View 3',2,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(79,21,'uploads/products/prod_24.jpg','MikroTik CRS328-24P-4S+RM PoE Switch - View 4',3,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(80,22,'uploads/products/prod_22.jpg','Tenda TEG1024D 24-Port Gigabit Switch - View 1',0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(81,22,'uploads/products/prod_23.jpg','Tenda TEG1024D 24-Port Gigabit Switch - View 2',1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(82,22,'uploads/products/prod_24.jpg','Tenda TEG1024D 24-Port Gigabit Switch - View 3',2,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(83,22,'uploads/products/prod_25.jpg','Tenda TEG1024D 24-Port Gigabit Switch - View 4',3,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(84,23,'uploads/products/prod_23.jpg','12V 2A DC Power Adapter for Router/ONU - View 1',0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(85,23,'uploads/products/prod_24.jpg','12V 2A DC Power Adapter for Router/ONU - View 2',1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(86,23,'uploads/products/prod_25.jpg','12V 2A DC Power Adapter for Router/ONU - View 3',2,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(87,23,'uploads/products/prod_26.jpg','12V 2A DC Power Adapter for Router/ONU - View 4',3,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(88,24,'uploads/products/prod_24.jpg','TP-Link TL-PoE150S PoE Injector - View 1',0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(89,24,'uploads/products/prod_25.jpg','TP-Link TL-PoE150S PoE Injector - View 2',1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(90,24,'uploads/products/prod_26.jpg','TP-Link TL-PoE150S PoE Injector - View 3',2,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(91,24,'uploads/products/prod_27.jpg','TP-Link TL-PoE150S PoE Injector - View 4',3,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(92,25,'uploads/products/prod_25.jpg','UPS 650VA for Networking Equipment - View 1',0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(93,25,'uploads/products/prod_26.jpg','UPS 650VA for Networking Equipment - View 2',1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(94,25,'uploads/products/prod_27.jpg','UPS 650VA for Networking Equipment - View 3',2,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(95,25,'uploads/products/prod_28.jpg','UPS 650VA for Networking Equipment - View 4',3,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(96,25,'uploads/products/prod_29.jpg','UPS 650VA for Networking Equipment - View 5',4,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(97,26,'uploads/products/prod_26.jpg','Universal Wall Mount Bracket for Router/ONU - View 1',0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(98,26,'uploads/products/prod_27.jpg','Universal Wall Mount Bracket for Router/ONU - View 2',1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(99,26,'uploads/products/prod_28.jpg','Universal Wall Mount Bracket for Router/ONU - View 3',2,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(100,26,'uploads/products/prod_29.jpg','Universal Wall Mount Bracket for Router/ONU - View 4',3,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(101,27,'uploads/products/prod_27.jpg','Cable Tie Organizer Kit 200pcs - View 1',0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(102,27,'uploads/products/prod_28.jpg','Cable Tie Organizer Kit 200pcs - View 2',1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(103,27,'uploads/products/prod_29.jpg','Cable Tie Organizer Kit 200pcs - View 3',2,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(104,28,'uploads/products/prod_28.jpg','Outdoor Weatherproof Enclosure Box - View 1',0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(105,28,'uploads/products/prod_29.jpg','Outdoor Weatherproof Enclosure Box - View 2',1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(106,28,'uploads/products/prod_30.jpg','Outdoor Weatherproof Enclosure Box - View 3',2,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(107,28,'uploads/products/prod_31.jpg','Outdoor Weatherproof Enclosure Box - View 4',3,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(108,29,'uploads/products/prod_29.jpg','1GE SFP Module SX MM 550m LC - View 1',0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(109,29,'uploads/products/prod_30.jpg','1GE SFP Module SX MM 550m LC - View 2',1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(110,29,'uploads/products/prod_31.jpg','1GE SFP Module SX MM 550m LC - View 3',2,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(111,29,'uploads/products/prod_32.jpg','1GE SFP Module SX MM 550m LC - View 4',3,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(112,29,'uploads/products/prod_33.jpg','1GE SFP Module SX MM 550m LC - View 5',4,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(113,30,'uploads/products/prod_30.jpg','Media Converter Gigabit SC Single-Mode - View 1',0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(114,30,'uploads/products/prod_31.jpg','Media Converter Gigabit SC Single-Mode - View 2',1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(115,30,'uploads/products/prod_32.jpg','Media Converter Gigabit SC Single-Mode - View 3',2,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(116,31,'uploads/products/prod_31.jpg','Fiber Optical Power Meter with VFL - View 1',0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(117,31,'uploads/products/prod_32.jpg','Fiber Optical Power Meter with VFL - View 2',1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(118,31,'uploads/products/prod_33.jpg','Fiber Optical Power Meter with VFL - View 3',2,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(119,31,'uploads/products/prod_34.jpg','Fiber Optical Power Meter with VFL - View 4',3,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(120,31,'uploads/products/prod_35.jpg','Fiber Optical Power Meter with VFL - View 5',4,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(121,32,'uploads/products/prod_32.jpg','SC/APC Fiber Optic Fast Connector 50pcs - View 1',0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(122,32,'uploads/products/prod_33.jpg','SC/APC Fiber Optic Fast Connector 50pcs - View 2',1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(123,32,'uploads/products/prod_34.jpg','SC/APC Fiber Optic Fast Connector 50pcs - View 3',2,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(124,32,'uploads/products/prod_35.jpg','SC/APC Fiber Optic Fast Connector 50pcs - View 4',3,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(125,33,'uploads/products/prod_33.jpg','USB 3.0 to Gigabit Ethernet Adapter - View 1',0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(126,33,'uploads/products/prod_34.jpg','USB 3.0 to Gigabit Ethernet Adapter - View 2',1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(127,33,'uploads/products/prod_35.jpg','USB 3.0 to Gigabit Ethernet Adapter - View 3',2,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(128,33,'uploads/products/prod_36.jpg','USB 3.0 to Gigabit Ethernet Adapter - View 4',3,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(129,34,'uploads/products/prod_34.jpg','PCIe Gigabit Network Card Dual Port - View 1',0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(130,34,'uploads/products/prod_35.jpg','PCIe Gigabit Network Card Dual Port - View 2',1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(131,34,'uploads/products/prod_36.jpg','PCIe Gigabit Network Card Dual Port - View 3',2,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(132,35,'uploads/products/prod_35.jpg','USB WiFi Adapter AC1300 Dual Band - View 1',0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(133,35,'uploads/products/prod_36.jpg','USB WiFi Adapter AC1300 Dual Band - View 2',1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(134,35,'uploads/products/prod_37.jpg','USB WiFi Adapter AC1300 Dual Band - View 3',2,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(135,36,'uploads/products/prod_36.jpg','Hikvision 2MP IP Bullet Camera - View 1',0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(136,36,'uploads/products/prod_37.jpg','Hikvision 2MP IP Bullet Camera - View 2',1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(137,36,'uploads/products/prod_38.jpg','Hikvision 2MP IP Bullet Camera - View 3',2,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(138,36,'uploads/products/prod_39.jpg','Hikvision 2MP IP Bullet Camera - View 4',3,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(139,37,'uploads/products/prod_37.jpg','Dahua 4-Channel PoE NVR - View 1',0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(140,37,'uploads/products/prod_38.jpg','Dahua 4-Channel PoE NVR - View 2',1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(141,37,'uploads/products/prod_39.jpg','Dahua 4-Channel PoE NVR - View 3',2,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(142,38,'uploads/products/prod_38.jpg','CAT6 Outdoor Ethernet Cable 50m - View 1',0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(143,38,'uploads/products/prod_39.jpg','CAT6 Outdoor Ethernet Cable 50m - View 2',1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(144,38,'uploads/products/prod_40.jpg','CAT6 Outdoor Ethernet Cable 50m - View 3',2,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(145,38,'uploads/products/prod_41.jpg','CAT6 Outdoor Ethernet Cable 50m - View 4',3,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(146,38,'uploads/products/prod_42.jpg','CAT6 Outdoor Ethernet Cable 50m - View 5',4,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(147,39,'uploads/products/prod_39.jpg','CCTV Power Supply Box 12V 10A 8CH - View 1',0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(148,39,'uploads/products/prod_40.jpg','CCTV Power Supply Box 12V 10A 8CH - View 2',1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(149,39,'uploads/products/prod_41.jpg','CCTV Power Supply Box 12V 10A 8CH - View 3',2,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(150,39,'uploads/products/prod_42.jpg','CCTV Power Supply Box 12V 10A 8CH - View 4',3,'2026-08-07 10:18:29','2026-08-07 10:18:29');
/*!40000 ALTER TABLE `product_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_reviews`
--

DROP TABLE IF EXISTS `product_reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_reviews` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `order_id` bigint unsigned DEFAULT NULL,
  `rating` tinyint NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_reviews_customer_id_foreign` (`customer_id`),
  KEY `product_reviews_product_id_foreign` (`product_id`),
  KEY `product_reviews_order_id_foreign` (`order_id`),
  CONSTRAINT `product_reviews_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_reviews_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE SET NULL,
  CONSTRAINT `product_reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_reviews`
--

LOCK TABLES `product_reviews` WRITE;
/*!40000 ALTER TABLE `product_reviews` DISABLE KEYS */;
INSERT INTO `product_reviews` VALUES (1,7,36,7,4,'Very fast delivery. Product is exactly as advertised.',1,'2026-07-06 10:18:33','2026-08-07 10:18:33'),(2,1,34,29,3,'Good quality. Delivery was fast. Highly recommended seller.',0,'2026-07-03 10:18:33','2026-08-07 10:18:33'),(3,13,8,16,3,'Great value for money. Will definitely buy again.',1,'2026-06-23 10:18:33','2026-08-07 10:18:33'),(4,4,4,5,4,'Professional packaging. Product works flawlessly.',1,'2026-06-17 10:18:33','2026-08-07 10:18:33'),(5,4,11,3,5,'Good quality. Delivery was fast. Highly recommended seller.',1,'2026-07-21 10:18:33','2026-08-07 10:18:33'),(6,9,11,19,5,'Great value for money. Will definitely buy again.',1,'2026-07-27 10:18:33','2026-08-07 10:18:33'),(7,3,38,6,4,'Cable quality is excellent. Using it for my ISP setup.',0,'2026-07-07 10:18:33','2026-08-07 10:18:33'),(8,3,27,2,3,'Very fast delivery. Product is exactly as advertised.',0,'2026-07-03 10:18:33','2026-08-07 10:18:33'),(9,19,38,25,5,'Best price in the market. Genuine product with warranty.',1,'2026-07-28 10:18:33','2026-08-07 10:18:33'),(10,17,34,3,3,'The ONU works perfectly. No issues with bridge mode.',1,'2026-06-15 10:18:33','2026-08-07 10:18:33'),(11,12,19,11,3,'The ONU works perfectly. No issues with bridge mode.',0,'2026-07-21 10:18:33','2026-08-07 10:18:33'),(12,9,16,7,4,'Very fast delivery. Product is exactly as advertised.',1,'2026-07-12 10:18:33','2026-08-07 10:18:33'),(13,5,36,23,4,'Excellent product! Working perfectly with my broadband connection.',1,'2026-07-26 10:18:33','2026-08-07 10:18:33'),(14,10,29,4,4,'Great value for money. Will definitely buy again.',0,'2026-06-19 10:18:33','2026-08-07 10:18:33'),(15,19,25,15,4,'Nice router, easy to set up. Signal strength is great.',1,'2026-06-12 10:18:33','2026-08-07 10:18:33'),(16,17,4,4,3,'Excellent product! Working perfectly with my broadband connection.',1,'2026-07-26 10:18:33','2026-08-07 10:18:33'),(17,3,22,7,5,'Professional packaging. Product works flawlessly.',1,'2026-06-13 10:18:33','2026-08-07 10:18:33'),(18,10,21,1,3,'Original product as described. Very satisfied with the purchase.',0,'2026-06-30 10:18:33','2026-08-07 10:18:33'),(19,17,34,24,4,'Professional packaging. Product works flawlessly.',0,'2026-07-03 10:18:33','2026-08-07 10:18:33'),(20,17,35,25,4,'Cable quality is excellent. Using it for my ISP setup.',1,'2026-07-27 10:18:33','2026-08-07 10:18:33'),(21,4,25,6,5,'Cable quality is excellent. Using it for my ISP setup.',0,'2026-07-15 10:18:33','2026-08-07 10:18:33'),(22,15,37,11,3,'Great value for money. Will definitely buy again.',1,'2026-06-21 10:18:33','2026-08-07 10:18:33'),(23,10,8,30,4,'Great value for money. Will definitely buy again.',1,'2026-07-30 10:18:33','2026-08-07 10:18:33'),(24,4,14,20,3,'Good quality. Delivery was fast. Highly recommended seller.',1,'2026-07-30 10:18:33','2026-08-07 10:18:33'),(25,9,4,5,3,'Nice router, easy to set up. Signal strength is great.',1,'2026-07-13 10:18:33','2026-08-07 10:18:33'),(26,4,16,9,5,'Good quality. Delivery was fast. Highly recommended seller.',1,'2026-07-30 10:18:33','2026-08-07 10:18:33'),(27,14,7,1,4,'Excellent product! Working perfectly with my broadband connection.',1,'2026-06-21 10:18:33','2026-08-07 10:18:33'),(28,12,9,6,3,'Cable quality is excellent. Using it for my ISP setup.',1,'2026-07-17 10:18:33','2026-08-07 10:18:33'),(29,7,5,20,4,'Cable quality is excellent. Using it for my ISP setup.',0,'2026-07-28 10:18:33','2026-08-07 10:18:33'),(30,4,26,21,3,'Good quality. Delivery was fast. Highly recommended seller.',1,'2026-07-01 10:18:33','2026-08-07 10:18:33'),(31,3,9,19,3,'The ONU works perfectly. No issues with bridge mode.',0,'2026-07-15 10:18:33','2026-08-07 10:18:33'),(32,16,31,16,5,'The ONU works perfectly. No issues with bridge mode.',1,'2026-06-20 10:18:33','2026-08-07 10:18:33'),(33,10,35,26,3,'Excellent product! Working perfectly with my broadband connection.',1,'2026-07-05 10:18:33','2026-08-07 10:18:33'),(34,14,4,15,4,'The ONU works perfectly. No issues with bridge mode.',0,'2026-07-01 10:18:33','2026-08-07 10:18:33'),(35,20,21,18,5,'Excellent product! Working perfectly with my broadband connection.',1,'2026-07-09 10:18:33','2026-08-07 10:18:33'),(36,12,9,1,4,'Great value for money. Will definitely buy again.',1,'2026-07-12 10:18:33','2026-08-07 10:18:33'),(37,3,19,5,3,'Cable quality is excellent. Using it for my ISP setup.',0,'2026-06-10 10:18:33','2026-08-07 10:18:33'),(38,7,28,29,5,'Good quality. Delivery was fast. Highly recommended seller.',1,'2026-06-08 10:18:33','2026-08-07 10:18:33'),(39,7,19,6,4,'The ONU works perfectly. No issues with bridge mode.',1,'2026-07-02 10:18:33','2026-08-07 10:18:33'),(40,15,17,17,3,'Good quality. Delivery was fast. Highly recommended seller.',1,'2026-07-28 10:18:33','2026-08-07 10:18:33'),(41,25,10,NULL,4,'Test review',1,'2026-08-14 04:04:14','2026-08-14 04:04:14');
/*!40000 ALTER TABLE `product_reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_variants`
--

DROP TABLE IF EXISTS `product_variants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_variants` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `variant_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `variant_value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `additional_price` decimal(12,2) NOT NULL DEFAULT '0.00',
  `stock_quantity` int NOT NULL DEFAULT '0',
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_variants_product_id_foreign` (`product_id`),
  CONSTRAINT `product_variants_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_variants`
--

LOCK TABLES `product_variants` WRITE;
/*!40000 ALTER TABLE `product_variants` DISABLE KEYS */;
INSERT INTO `product_variants` VALUES (1,1,'Version','Standard',0.00,30,'TIH-MKSF',0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(2,1,'Version','Pro',500.00,15,'TIH-RDVI',1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(3,1,'Version','Enterprise',1000.00,20,'TIH-Q6PT',2,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(4,2,'Version','Standard',0.00,15,'TIH-8EG4',0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(5,2,'Version','Pro',500.00,17,'TIH-ZIWB',1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(6,2,'Version','Enterprise',1000.00,25,'TIH-WL9J',2,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(7,3,'Version','Standard',0.00,25,'TIH-PRSH',0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(8,3,'Version','Pro',500.00,10,'TIH-JJR4',1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(9,3,'Version','Enterprise',1000.00,27,'TIH-QACU',2,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(10,4,'Version','Standard',0.00,6,'TIH-KUXC',0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(11,4,'Version','Pro',500.00,29,'TIH-7T6N',1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(12,4,'Version','Enterprise',1000.00,21,'TIH-6DNZ',2,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(13,5,'Version','Standard',0.00,14,'TIH-QKD7',0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(14,5,'Version','Pro',500.00,11,'TIH-XYTO',1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(15,5,'Version','Enterprise',1000.00,10,'TIH-83W8',2,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(16,11,'Version','Standard',0.00,28,'TIH-Q8EE',0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(17,11,'Version','Pro',500.00,24,'TIH-IMUO',1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(18,11,'Version','Enterprise',1000.00,13,'TIH-45SG',2,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(19,12,'Version','Standard',0.00,14,'TIH-5AWX',0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(20,12,'Version','Pro',500.00,28,'TIH-KOE1',1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(21,12,'Version','Enterprise',1000.00,24,'TIH-HU2A',2,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(22,13,'Version','Standard',0.00,26,'TIH-V3VR',0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(23,13,'Version','Pro',500.00,5,'TIH-ZSFY',1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(24,13,'Version','Enterprise',1000.00,16,'TIH-AD57',2,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(25,14,'Version','Standard',0.00,30,'TIH-HJZX',0,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(26,14,'Version','Pro',500.00,19,'TIH-DUOJ',1,'2026-08-07 10:18:29','2026-08-07 10:18:29'),(27,14,'Version','Enterprise',1000.00,9,'TIH-HRPR',2,'2026-08-07 10:18:29','2026-08-07 10:18:29');
/*!40000 ALTER TABLE `product_variants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` bigint unsigned DEFAULT NULL,
  `brand_id` bigint unsigned DEFAULT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `full_description` longtext COLLATE utf8mb4_unicode_ci,
  `regular_price` decimal(12,2) NOT NULL,
  `sale_price` decimal(12,2) DEFAULT NULL,
  `discount_percent` decimal(5,2) NOT NULL DEFAULT '0.00',
  `stock_quantity` int NOT NULL DEFAULT '0',
  `min_order_quantity` int NOT NULL DEFAULT '1',
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `is_new_arrival` tinyint(1) NOT NULL DEFAULT '0',
  `is_best_selling` tinyint(1) NOT NULL DEFAULT '0',
  `is_flash_deal` tinyint(1) NOT NULL DEFAULT '0',
  `flash_deal_end` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `total_sold` int NOT NULL DEFAULT '0',
  `total_views` int NOT NULL DEFAULT '0',
  `average_rating` decimal(3,2) NOT NULL DEFAULT '0.00',
  `total_reviews` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_slug_unique` (`slug`),
  KEY `products_category_id_index` (`category_id`),
  KEY `products_brand_id_index` (`brand_id`),
  KEY `products_status_index` (`status`),
  KEY `products_is_featured_index` (`is_featured`),
  KEY `products_is_new_arrival_index` (`is_new_arrival`),
  KEY `products_is_best_selling_index` (`is_best_selling`),
  KEY `products_is_flash_deal_index` (`is_flash_deal`),
  KEY `products_created_at_index` (`created_at`),
  CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE SET NULL,
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'TP-Link Archer C80 AC1900 Wireless Router','tp-link-archer-c80-ac1900-wireless-router','TIH-P214YD',1,1,'Dual-band WiFi router with MU-MIMO technology. 1300Mbps on 5GHz + 600Mbps on 2.4GHz. 4 external antennas.','<h3>TP-Link Archer C80 AC1900 Wireless Router</h3><p>Dual-band WiFi router with MU-MIMO technology. 1300Mbps on 5GHz + 600Mbps on 2.4GHz. 4 external antennas.</p><h4>Key Features:</h4><ul><li>Original authentic product</li><li>Brand new, sealed pack</li><li>Warranty included</li><li>Fast delivery across Bangladesh</li></ul><h4>Why Buy From Tihan Online?</h4><p>We are your trusted source for broadband accessories in Bangladesh. All products are 100% genuine with manufacturer warranty. Order now and get fast delivery!</p>',3500.00,2999.00,14.00,42,1,'pcs','uploads/products/prod_0.jpg',1,0,1,1,'2026-08-12 16:18:29',1,'TP-Link Archer C80 AC1900 Wireless Router - Buy at Best Price | Tihan Online','Buy TP-Link Archer C80 AC1900 Wireless Router online at the best price in Bangladesh. ✓ Genuine Product ✓ Fast Delivery ✓ Warranty. Tihan Online.',NULL,489,4494,3.60,42,'2026-06-03 10:18:29','2026-08-07 11:16:56'),(2,'D-Link DIR-825 WiFi 5 AC1200 Router','d-link-dir-825-wifi-5-ac1200-router','TIH-SVANYS',4,2,'Dual-band gigabit router. 4 high-gain antennas. MU-MIMO and beamforming support.','<h3>D-Link DIR-825 WiFi 5 AC1200 Router</h3><p>Dual-band gigabit router. 4 high-gain antennas. MU-MIMO and beamforming support.</p><h4>Key Features:</h4><ul><li>Original authentic product</li><li>Brand new, sealed pack</li><li>Warranty included</li><li>Fast delivery across Bangladesh</li></ul><h4>Why Buy From Tihan Online?</h4><p>We are your trusted source for broadband accessories in Bangladesh. All products are 100% genuine with manufacturer warranty. Order now and get fast delivery!</p>',2800.00,2499.00,11.00,71,1,'pcs','uploads/products/prod_1.jpg',1,0,1,1,'2026-08-09 16:18:29',1,'D-Link DIR-825 WiFi 5 AC1200 Router - Buy at Best Price | Tihan Online','Buy D-Link DIR-825 WiFi 5 AC1200 Router online at the best price in Bangladesh. ✓ Genuine Product ✓ Fast Delivery ✓ Warranty. Tihan Online.',NULL,36,7404,4.70,16,'2026-07-25 10:18:29','2026-08-14 02:35:49'),(3,'MikroTik hAP ac2 Dual-Band Router','mikrotik-hap-ac2-dual-band-router','TIH-N5WIR7',1,5,'Professional-grade dual-band router with RouterOS L4. 5x Gigabit ports. IPsec hardware encryption.','<h3>MikroTik hAP ac2 Dual-Band Router</h3><p>Professional-grade dual-band router with RouterOS L4. 5x Gigabit ports. IPsec hardware encryption.</p><h4>Key Features:</h4><ul><li>Original authentic product</li><li>Brand new, sealed pack</li><li>Warranty included</li><li>Fast delivery across Bangladesh</li></ul><h4>Why Buy From Tihan Online?</h4><p>We are your trusted source for broadband accessories in Bangladesh. All products are 100% genuine with manufacturer warranty. Order now and get fast delivery!</p>',6500.00,NULL,0.00,56,1,'pcs','uploads/products/prod_2.jpg',1,0,1,1,'2026-08-11 16:18:29',1,'MikroTik hAP ac2 Dual-Band Router - Buy at Best Price | Tihan Online','Buy MikroTik hAP ac2 Dual-Band Router online at the best price in Bangladesh. ✓ Genuine Product ✓ Fast Delivery ✓ Warranty. Tihan Online.',NULL,489,7591,4.60,21,'2026-05-27 10:18:29','2026-08-07 10:18:29'),(4,'Tenda AC10 AC1200 Smart WiFi Router','tenda-ac10-ac1200-smart-wifi-router','TIH-KYC6FY',4,7,'Dual-band 1200Mbps router. 4x 6dBi antennas. Smart WiFi schedule. Parental control.','<h3>Tenda AC10 AC1200 Smart WiFi Router</h3><p>Dual-band 1200Mbps router. 4x 6dBi antennas. Smart WiFi schedule. Parental control.</p><h4>Key Features:</h4><ul><li>Original authentic product</li><li>Brand new, sealed pack</li><li>Warranty included</li><li>Fast delivery across Bangladesh</li></ul><h4>Why Buy From Tihan Online?</h4><p>We are your trusted source for broadband accessories in Bangladesh. All products are 100% genuine with manufacturer warranty. Order now and get fast delivery!</p>',1800.00,1550.00,14.00,172,1,'pcs','uploads/products/prod_3.jpg',1,0,1,1,'2026-08-10 16:18:29',1,'Tenda AC10 AC1200 Smart WiFi Router - Buy at Best Price | Tihan Online','Buy Tenda AC10 AC1200 Smart WiFi Router online at the best price in Bangladesh. ✓ Genuine Product ✓ Fast Delivery ✓ Warranty. Tihan Online.',NULL,436,2157,4.70,42,'2026-05-18 10:18:29','2026-08-07 11:02:31'),(5,'Xiaomi Mi Router 4A Gigabit Edition','xiaomi-mi-router-4a-gigabit-edition','TIH-USTYKK',1,8,'Gigabit dual-band WiFi router. 4 high-performance antennas. Mi WiFi app control.','<h3>Xiaomi Mi Router 4A Gigabit Edition</h3><p>Gigabit dual-band WiFi router. 4 high-performance antennas. Mi WiFi app control.</p><h4>Key Features:</h4><ul><li>Original authentic product</li><li>Brand new, sealed pack</li><li>Warranty included</li><li>Fast delivery across Bangladesh</li></ul><h4>Why Buy From Tihan Online?</h4><p>We are your trusted source for broadband accessories in Bangladesh. All products are 100% genuine with manufacturer warranty. Order now and get fast delivery!</p>',2200.00,1899.00,14.00,78,1,'pcs','uploads/products/prod_4.jpg',1,0,1,1,'2026-08-12 16:18:29',1,'Xiaomi Mi Router 4A Gigabit Edition - Buy at Best Price | Tihan Online','Buy Xiaomi Mi Router 4A Gigabit Edition online at the best price in Bangladesh. ✓ Genuine Product ✓ Fast Delivery ✓ Warranty. Tihan Online.',NULL,363,650,3.60,46,'2026-05-11 10:18:29','2026-08-07 10:18:29'),(6,'CAT6 UTP LAN Cable 305m Box','cat6-utp-lan-cable-305m-box','TIH-RLCFCC',7,2,'Premium CAT6 UTP solid copper cable. 23 AWG. 550MHz bandwidth. 305 meters per box.','<h3>CAT6 UTP LAN Cable 305m Box</h3><p>Premium CAT6 UTP solid copper cable. 23 AWG. 550MHz bandwidth. 305 meters per box.</p><h4>Key Features:</h4><ul><li>Original authentic product</li><li>Brand new, sealed pack</li><li>Warranty included</li><li>Fast delivery across Bangladesh</li></ul><h4>Why Buy From Tihan Online?</h4><p>We are your trusted source for broadband accessories in Bangladesh. All products are 100% genuine with manufacturer warranty. Order now and get fast delivery!</p>',4500.00,NULL,0.00,67,1,'pcs','uploads/products/prod_5.jpg',1,0,1,0,NULL,1,'CAT6 UTP LAN Cable 305m Box - Buy at Best Price | Tihan Online','Buy CAT6 UTP LAN Cable 305m Box online at the best price in Bangladesh. ✓ Genuine Product ✓ Fast Delivery ✓ Warranty. Tihan Online.',NULL,297,5409,4.60,25,'2026-05-25 10:18:29','2026-08-15 02:14:39'),(7,'RJ45 CAT6 Pass-Through Connector 100pcs','rj45-cat6-pass-through-connector-100pcs','TIH-PLKHAH',10,2,'CAT6 pass-through RJ45 connectors. 3-prong 50 micron gold plated. Pack of 100.','<h3>RJ45 CAT6 Pass-Through Connector 100pcs</h3><p>CAT6 pass-through RJ45 connectors. 3-prong 50 micron gold plated. Pack of 100.</p><h4>Key Features:</h4><ul><li>Original authentic product</li><li>Brand new, sealed pack</li><li>Warranty included</li><li>Fast delivery across Bangladesh</li></ul><h4>Why Buy From Tihan Online?</h4><p>We are your trusted source for broadband accessories in Bangladesh. All products are 100% genuine with manufacturer warranty. Order now and get fast delivery!</p>',350.00,299.00,15.00,188,1,'pcs','uploads/products/prod_6.jpg',1,0,1,0,NULL,1,'RJ45 CAT6 Pass-Through Connector 100pcs - Buy at Best Price | Tihan Online','Buy RJ45 CAT6 Pass-Through Connector 100pcs online at the best price in Bangladesh. ✓ Genuine Product ✓ Fast Delivery ✓ Warranty. Tihan Online.',NULL,448,6656,4.10,9,'2026-06-02 10:18:29','2026-08-07 10:18:29'),(8,'3m CAT6 Patch Cord Ethernet Cable','3m-cat6-patch-cord-ethernet-cable','TIH-XOK3QY',7,1,'High-quality CAT6 patch cord. Gold plated connectors. Snagless boot design. 3 meters.','<h3>3m CAT6 Patch Cord Ethernet Cable</h3><p>High-quality CAT6 patch cord. Gold plated connectors. Snagless boot design. 3 meters.</p><h4>Key Features:</h4><ul><li>Original authentic product</li><li>Brand new, sealed pack</li><li>Warranty included</li><li>Fast delivery across Bangladesh</li></ul><h4>Why Buy From Tihan Online?</h4><p>We are your trusted source for broadband accessories in Bangladesh. All products are 100% genuine with manufacturer warranty. Order now and get fast delivery!</p>',150.00,NULL,0.00,23,1,'pcs','uploads/products/prod_7.jpg',1,0,1,0,NULL,1,'3m CAT6 Patch Cord Ethernet Cable - Buy at Best Price | Tihan Online','Buy 3m CAT6 Patch Cord Ethernet Cable online at the best price in Bangladesh. ✓ Genuine Product ✓ Fast Delivery ✓ Warranty. Tihan Online.',NULL,184,7227,3.70,40,'2026-07-11 10:18:29','2026-08-15 02:14:30'),(9,'Fiber Optic Patch Cable SC/APC-SC/APC 3m','fiber-optic-patch-cable-scapc-scapc-3m','TIH-GQAL0T',10,3,'Single-mode fiber patch cord G.652D. SC/APC to SC/APC connectors. 3 meter length.','<h3>Fiber Optic Patch Cable SC/APC-SC/APC 3m</h3><p>Single-mode fiber patch cord G.652D. SC/APC to SC/APC connectors. 3 meter length.</p><h4>Key Features:</h4><ul><li>Original authentic product</li><li>Brand new, sealed pack</li><li>Warranty included</li><li>Fast delivery across Bangladesh</li></ul><h4>Why Buy From Tihan Online?</h4><p>We are your trusted source for broadband accessories in Bangladesh. All products are 100% genuine with manufacturer warranty. Order now and get fast delivery!</p>',180.00,150.00,17.00,183,1,'pcs','uploads/products/prod_8.jpg',1,0,0,0,NULL,1,'Fiber Optic Patch Cable SC/APC-SC/APC 3m - Buy at Best Price | Tihan Online','Buy Fiber Optic Patch Cable SC/APC-SC/APC 3m online at the best price in Bangladesh. ✓ Genuine Product ✓ Fast Delivery ✓ Warranty. Tihan Online.',NULL,63,1146,3.70,43,'2026-06-30 10:18:29','2026-08-14 03:32:04'),(10,'RJ45 Crimping Tool with Cable Tester Kit','rj45-crimping-tool-with-cable-tester-kit','TIH-OSWNFG',10,2,'Professional crimping tool for RJ45/RJ11. Includes network cable tester. Ergonomic grip.','<h3>RJ45 Crimping Tool with Cable Tester Kit</h3><p>Professional crimping tool for RJ45/RJ11. Includes network cable tester. Ergonomic grip.</p><h4>Key Features:</h4><ul><li>Original authentic product</li><li>Brand new, sealed pack</li><li>Warranty included</li><li>Fast delivery across Bangladesh</li></ul><h4>Why Buy From Tihan Online?</h4><p>We are your trusted source for broadband accessories in Bangladesh. All products are 100% genuine with manufacturer warranty. Order now and get fast delivery!</p>',650.00,499.00,23.00,192,1,'pcs','uploads/products/prod_9.jpg',1,0,0,0,NULL,1,'RJ45 Crimping Tool with Cable Tester Kit - Buy at Best Price | Tihan Online','Buy RJ45 Crimping Tool with Cable Tester Kit online at the best price in Bangladesh. ✓ Genuine Product ✓ Fast Delivery ✓ Warranty. Tihan Online.',NULL,136,7556,4.00,1,'2026-07-13 10:18:29','2026-08-14 04:04:14'),(11,'9dBi Omni WiFi Antenna with RP-SMA','9dbi-omni-wifi-antenna-with-rp-sma','TIH-1FM82I',13,1,'High-gain 9dBi omni-directional antenna. RP-SMA connector. 2.4GHz frequency.','<h3>9dBi Omni WiFi Antenna with RP-SMA</h3><p>High-gain 9dBi omni-directional antenna. RP-SMA connector. 2.4GHz frequency.</p><h4>Key Features:</h4><ul><li>Original authentic product</li><li>Brand new, sealed pack</li><li>Warranty included</li><li>Fast delivery across Bangladesh</li></ul><h4>Why Buy From Tihan Online?</h4><p>We are your trusted source for broadband accessories in Bangladesh. All products are 100% genuine with manufacturer warranty. Order now and get fast delivery!</p>',450.00,399.00,11.00,36,1,'pcs','uploads/products/prod_10.jpg',1,0,0,0,NULL,1,'9dBi Omni WiFi Antenna with RP-SMA - Buy at Best Price | Tihan Online','Buy 9dBi Omni WiFi Antenna with RP-SMA online at the best price in Bangladesh. ✓ Genuine Product ✓ Fast Delivery ✓ Warranty. Tihan Online.',NULL,363,2386,3.80,21,'2026-07-27 10:18:29','2026-08-14 02:35:49'),(12,'2.4GHz WiFi Signal Booster Repeater','24ghz-wifi-signal-booster-repeater','TIH-MNA5PA',16,8,'300Mbps WiFi range extender. 2 external antennas. Wall plug design. Easy setup.','<h3>2.4GHz WiFi Signal Booster Repeater</h3><p>300Mbps WiFi range extender. 2 external antennas. Wall plug design. Easy setup.</p><h4>Key Features:</h4><ul><li>Original authentic product</li><li>Brand new, sealed pack</li><li>Warranty included</li><li>Fast delivery across Bangladesh</li></ul><h4>Why Buy From Tihan Online?</h4><p>We are your trusted source for broadband accessories in Bangladesh. All products are 100% genuine with manufacturer warranty. Order now and get fast delivery!</p>',1200.00,999.00,17.00,51,1,'pcs','uploads/products/prod_11.jpg',1,0,0,0,NULL,1,'2.4GHz WiFi Signal Booster Repeater - Buy at Best Price | Tihan Online','Buy 2.4GHz WiFi Signal Booster Repeater online at the best price in Bangladesh. ✓ Genuine Product ✓ Fast Delivery ✓ Warranty. Tihan Online.',NULL,215,4784,3.90,48,'2026-05-10 10:18:29','2026-08-07 10:18:29'),(13,'Outdoor 14dBi Panel Antenna 2.4GHz','outdoor-14dbi-panel-antenna-24ghz','TIH-ZKUQNE',13,5,'Directional outdoor panel antenna. 14dBi gain. Weatherproof. N-female connector.','<h3>Outdoor 14dBi Panel Antenna 2.4GHz</h3><p>Directional outdoor panel antenna. 14dBi gain. Weatherproof. N-female connector.</p><h4>Key Features:</h4><ul><li>Original authentic product</li><li>Brand new, sealed pack</li><li>Warranty included</li><li>Fast delivery across Bangladesh</li></ul><h4>Why Buy From Tihan Online?</h4><p>We are your trusted source for broadband accessories in Bangladesh. All products are 100% genuine with manufacturer warranty. Order now and get fast delivery!</p>',1800.00,NULL,0.00,112,1,'pcs','uploads/products/prod_12.jpg',0,0,0,0,NULL,1,'Outdoor 14dBi Panel Antenna 2.4GHz - Buy at Best Price | Tihan Online','Buy Outdoor 14dBi Panel Antenna 2.4GHz online at the best price in Bangladesh. ✓ Genuine Product ✓ Fast Delivery ✓ Warranty. Tihan Online.',NULL,188,1494,4.70,56,'2026-06-29 10:18:29','2026-08-07 10:18:29'),(14,'WiFi 6 Mesh Extender AX1800','wifi-6-mesh-extender-ax1800','TIH-RXLKJF',13,1,'WiFi 6 (802.11ax) mesh range extender. Dual-band 1800Mbps. EasyMesh compatible.','<h3>WiFi 6 Mesh Extender AX1800</h3><p>WiFi 6 (802.11ax) mesh range extender. Dual-band 1800Mbps. EasyMesh compatible.</p><h4>Key Features:</h4><ul><li>Original authentic product</li><li>Brand new, sealed pack</li><li>Warranty included</li><li>Fast delivery across Bangladesh</li></ul><h4>Why Buy From Tihan Online?</h4><p>We are your trusted source for broadband accessories in Bangladesh. All products are 100% genuine with manufacturer warranty. Order now and get fast delivery!</p>',4500.00,3999.00,11.00,99,1,'pcs','uploads/products/prod_13.jpg',0,0,0,0,NULL,1,'WiFi 6 Mesh Extender AX1800 - Buy at Best Price | Tihan Online','Buy WiFi 6 Mesh Extender AX1800 online at the best price in Bangladesh. ✓ Genuine Product ✓ Fast Delivery ✓ Warranty. Tihan Online.',NULL,351,5471,4.00,49,'2026-06-18 10:18:29','2026-08-07 10:18:29'),(15,'Huawei HG8245H5 GPON ONU Terminal','huawei-hg8245h5-gpon-onu-terminal','TIH-XQFEH3',19,9,'GPON ONU with 4 GE ports + 1 POTS + WiFi. SC/APC interface. Bridge and route mode.','<h3>Huawei HG8245H5 GPON ONU Terminal</h3><p>GPON ONU with 4 GE ports + 1 POTS + WiFi. SC/APC interface. Bridge and route mode.</p><h4>Key Features:</h4><ul><li>Original authentic product</li><li>Brand new, sealed pack</li><li>Warranty included</li><li>Fast delivery across Bangladesh</li></ul><h4>Why Buy From Tihan Online?</h4><p>We are your trusted source for broadband accessories in Bangladesh. All products are 100% genuine with manufacturer warranty. Order now and get fast delivery!</p>',2200.00,1999.00,9.00,168,1,'pcs','uploads/products/prod_14.jpg',0,0,0,0,NULL,1,'Huawei HG8245H5 GPON ONU Terminal - Buy at Best Price | Tihan Online','Buy Huawei HG8245H5 GPON ONU Terminal online at the best price in Bangladesh. ✓ Genuine Product ✓ Fast Delivery ✓ Warranty. Tihan Online.',NULL,494,2202,4.50,44,'2026-08-02 10:18:29','2026-08-14 03:33:57'),(16,'ZTE F660 GPON ONU WiFi Router','zte-f660-gpon-onu-wifi-router','TIH-Q3DWOA',22,10,'GPON terminal with 4 LAN + 2 POTS + WiFi. 300Mbps wireless. NAT/firewall.','<h3>ZTE F660 GPON ONU WiFi Router</h3><p>GPON terminal with 4 LAN + 2 POTS + WiFi. 300Mbps wireless. NAT/firewall.</p><h4>Key Features:</h4><ul><li>Original authentic product</li><li>Brand new, sealed pack</li><li>Warranty included</li><li>Fast delivery across Bangladesh</li></ul><h4>Why Buy From Tihan Online?</h4><p>We are your trusted source for broadband accessories in Bangladesh. All products are 100% genuine with manufacturer warranty. Order now and get fast delivery!</p>',1800.00,1599.00,11.00,194,1,'pcs','uploads/products/prod_15.jpg',0,0,0,0,NULL,1,'ZTE F660 GPON ONU WiFi Router - Buy at Best Price | Tihan Online','Buy ZTE F660 GPON ONU WiFi Router online at the best price in Bangladesh. ✓ Genuine Product ✓ Fast Delivery ✓ Warranty. Tihan Online.',NULL,65,508,3.90,50,'2026-06-13 10:18:29','2026-08-07 10:18:29'),(17,'VSOL V2802RH Dual-Band XPON ONU','vsol-v2802rh-dual-band-xpon-onu','TIH-VQEQX5',19,18,'XPON ONU dual-band WiFi 6. 1x 2.5G port. Compatible with GPON/EPON. Bridge/router mode.','<h3>VSOL V2802RH Dual-Band XPON ONU</h3><p>XPON ONU dual-band WiFi 6. 1x 2.5G port. Compatible with GPON/EPON. Bridge/router mode.</p><h4>Key Features:</h4><ul><li>Original authentic product</li><li>Brand new, sealed pack</li><li>Warranty included</li><li>Fast delivery across Bangladesh</li></ul><h4>Why Buy From Tihan Online?</h4><p>We are your trusted source for broadband accessories in Bangladesh. All products are 100% genuine with manufacturer warranty. Order now and get fast delivery!</p>',3500.00,3200.00,9.00,151,1,'pcs','uploads/products/prod_16.jpg',0,0,0,0,NULL,1,'VSOL V2802RH Dual-Band XPON ONU - Buy at Best Price | Tihan Online','Buy VSOL V2802RH Dual-Band XPON ONU online at the best price in Bangladesh. ✓ Genuine Product ✓ Fast Delivery ✓ Warranty. Tihan Online.',NULL,325,7921,4.50,32,'2026-06-03 10:18:29','2026-08-07 10:18:29'),(18,'Nokia G-2425G-A GPON ONT','nokia-g-2425g-a-gpon-ont','TIH-WJPOVP',22,20,'Nokia GPON ONT with 4 Gigabit ports + WiFi + VoIP. SC/APC. Bridge/router/WiFi modes.','<h3>Nokia G-2425G-A GPON ONT</h3><p>Nokia GPON ONT with 4 Gigabit ports + WiFi + VoIP. SC/APC. Bridge/router/WiFi modes.</p><h4>Key Features:</h4><ul><li>Original authentic product</li><li>Brand new, sealed pack</li><li>Warranty included</li><li>Fast delivery across Bangladesh</li></ul><h4>Why Buy From Tihan Online?</h4><p>We are your trusted source for broadband accessories in Bangladesh. All products are 100% genuine with manufacturer warranty. Order now and get fast delivery!</p>',2500.00,NULL,0.00,35,1,'pcs','uploads/products/prod_17.jpg',0,0,0,0,NULL,1,'Nokia G-2425G-A GPON ONT - Buy at Best Price | Tihan Online','Buy Nokia G-2425G-A GPON ONT online at the best price in Bangladesh. ✓ Genuine Product ✓ Fast Delivery ✓ Warranty. Tihan Online.',NULL,57,6989,4.80,33,'2026-07-05 10:18:29','2026-08-07 10:18:29'),(19,'TP-Link TL-SG108 8-Port Gigabit Switch','tp-link-tl-sg108-8-port-gigabit-switch','TIH-5U8CWX',25,1,'8-port gigabit unmanaged switch. Plug & play. Auto MDI/MDIX. Green Ethernet technology.','<h3>TP-Link TL-SG108 8-Port Gigabit Switch</h3><p>8-port gigabit unmanaged switch. Plug & play. Auto MDI/MDIX. Green Ethernet technology.</p><h4>Key Features:</h4><ul><li>Original authentic product</li><li>Brand new, sealed pack</li><li>Warranty included</li><li>Fast delivery across Bangladesh</li></ul><h4>Why Buy From Tihan Online?</h4><p>We are your trusted source for broadband accessories in Bangladesh. All products are 100% genuine with manufacturer warranty. Order now and get fast delivery!</p>',1800.00,1550.00,14.00,46,1,'pcs','uploads/products/prod_18.jpg',0,0,0,0,NULL,1,'TP-Link TL-SG108 8-Port Gigabit Switch - Buy at Best Price | Tihan Online','Buy TP-Link TL-SG108 8-Port Gigabit Switch online at the best price in Bangladesh. ✓ Genuine Product ✓ Fast Delivery ✓ Warranty. Tihan Online.',NULL,226,7923,4.40,31,'2026-07-26 10:18:29','2026-08-07 10:18:29'),(20,'D-Link DES-1008C 8-Port Fast Switch','d-link-des-1008c-8-port-fast-switch','TIH-DOZ6EL',28,2,'8-port 10/100Mbps switch. Compact design. Fanless quiet operation. QoS support.','<h3>D-Link DES-1008C 8-Port Fast Switch</h3><p>8-port 10/100Mbps switch. Compact design. Fanless quiet operation. QoS support.</p><h4>Key Features:</h4><ul><li>Original authentic product</li><li>Brand new, sealed pack</li><li>Warranty included</li><li>Fast delivery across Bangladesh</li></ul><h4>Why Buy From Tihan Online?</h4><p>We are your trusted source for broadband accessories in Bangladesh. All products are 100% genuine with manufacturer warranty. Order now and get fast delivery!</p>',950.00,NULL,0.00,36,1,'pcs','uploads/products/prod_19.jpg',0,0,0,0,NULL,1,'D-Link DES-1008C 8-Port Fast Switch - Buy at Best Price | Tihan Online','Buy D-Link DES-1008C 8-Port Fast Switch online at the best price in Bangladesh. ✓ Genuine Product ✓ Fast Delivery ✓ Warranty. Tihan Online.',NULL,80,3462,3.80,11,'2026-07-26 10:18:29','2026-08-07 10:18:29'),(21,'MikroTik CRS328-24P-4S+RM PoE Switch','mikrotik-crs328-24p-4srm-poe-switch','TIH-OQYCXX',25,5,'24-port PoE+ gigabit switch. 4x SFP+ 10Gbps ports. 450W power budget. RouterOS L5.','<h3>MikroTik CRS328-24P-4S+RM PoE Switch</h3><p>24-port PoE+ gigabit switch. 4x SFP+ 10Gbps ports. 450W power budget. RouterOS L5.</p><h4>Key Features:</h4><ul><li>Original authentic product</li><li>Brand new, sealed pack</li><li>Warranty included</li><li>Fast delivery across Bangladesh</li></ul><h4>Why Buy From Tihan Online?</h4><p>We are your trusted source for broadband accessories in Bangladesh. All products are 100% genuine with manufacturer warranty. Order now and get fast delivery!</p>',38000.00,NULL,0.00,198,1,'pcs','uploads/products/prod_20.jpg',0,0,0,0,NULL,1,'MikroTik CRS328-24P-4S+RM PoE Switch - Buy at Best Price | Tihan Online','Buy MikroTik CRS328-24P-4S+RM PoE Switch online at the best price in Bangladesh. ✓ Genuine Product ✓ Fast Delivery ✓ Warranty. Tihan Online.',NULL,99,6456,4.10,29,'2026-06-11 10:18:29','2026-08-07 10:18:29'),(22,'Tenda TEG1024D 24-Port Gigabit Switch','tenda-teg1024d-24-port-gigabit-switch','TIH-VA2JQK',25,7,'24-port gigabit rackmount switch. 48Gbps switching capacity. Fanless design.','<h3>Tenda TEG1024D 24-Port Gigabit Switch</h3><p>24-port gigabit rackmount switch. 48Gbps switching capacity. Fanless design.</p><h4>Key Features:</h4><ul><li>Original authentic product</li><li>Brand new, sealed pack</li><li>Warranty included</li><li>Fast delivery across Bangladesh</li></ul><h4>Why Buy From Tihan Online?</h4><p>We are your trusted source for broadband accessories in Bangladesh. All products are 100% genuine with manufacturer warranty. Order now and get fast delivery!</p>',4500.00,3999.00,11.00,189,1,'pcs','uploads/products/prod_21.jpg',0,0,0,0,NULL,1,'Tenda TEG1024D 24-Port Gigabit Switch - Buy at Best Price | Tihan Online','Buy Tenda TEG1024D 24-Port Gigabit Switch online at the best price in Bangladesh. ✓ Genuine Product ✓ Fast Delivery ✓ Warranty. Tihan Online.',NULL,175,4949,4.50,17,'2026-05-17 10:18:29','2026-08-07 10:18:29'),(23,'12V 2A DC Power Adapter for Router/ONU','12v-2a-dc-power-adapter-for-routeronu','TIH-DSIBSG',1,1,'Universal 12V 2A DC adapter. 5.5mm x 2.1mm connector. Compatible with most routers and ONUs.','<h3>12V 2A DC Power Adapter for Router/ONU</h3><p>Universal 12V 2A DC adapter. 5.5mm x 2.1mm connector. Compatible with most routers and ONUs.</p><h4>Key Features:</h4><ul><li>Original authentic product</li><li>Brand new, sealed pack</li><li>Warranty included</li><li>Fast delivery across Bangladesh</li></ul><h4>Why Buy From Tihan Online?</h4><p>We are your trusted source for broadband accessories in Bangladesh. All products are 100% genuine with manufacturer warranty. Order now and get fast delivery!</p>',350.00,299.00,15.00,172,1,'pcs','uploads/products/prod_22.jpg',0,0,0,0,NULL,1,'12V 2A DC Power Adapter for Router/ONU - Buy at Best Price | Tihan Online','Buy 12V 2A DC Power Adapter for Router/ONU online at the best price in Bangladesh. ✓ Genuine Product ✓ Fast Delivery ✓ Warranty. Tihan Online.',NULL,24,6172,4.60,59,'2026-05-17 10:18:29','2026-08-07 10:18:29'),(24,'TP-Link TL-PoE150S PoE Injector','tp-link-tl-poe150s-poe-injector','TIH-WVOZBG',4,1,'Single-port PoE injector. 802.3af compliant. 15.4W power. Up to 100m transmission.','<h3>TP-Link TL-PoE150S PoE Injector</h3><p>Single-port PoE injector. 802.3af compliant. 15.4W power. Up to 100m transmission.</p><h4>Key Features:</h4><ul><li>Original authentic product</li><li>Brand new, sealed pack</li><li>Warranty included</li><li>Fast delivery across Bangladesh</li></ul><h4>Why Buy From Tihan Online?</h4><p>We are your trusted source for broadband accessories in Bangladesh. All products are 100% genuine with manufacturer warranty. Order now and get fast delivery!</p>',850.00,750.00,12.00,104,1,'pcs','uploads/products/prod_23.jpg',0,0,0,0,NULL,1,'TP-Link TL-PoE150S PoE Injector - Buy at Best Price | Tihan Online','Buy TP-Link TL-PoE150S PoE Injector online at the best price in Bangladesh. ✓ Genuine Product ✓ Fast Delivery ✓ Warranty. Tihan Online.',NULL,286,7320,5.00,19,'2026-05-29 10:18:29','2026-08-07 10:18:29'),(25,'UPS 650VA for Networking Equipment','ups-650va-for-networking-equipment','TIH-E7RI39',1,3,'650VA/360W line-interactive UPS. 3x battery backup outlets. Surge protection.','<h3>UPS 650VA for Networking Equipment</h3><p>650VA/360W line-interactive UPS. 3x battery backup outlets. Surge protection.</p><h4>Key Features:</h4><ul><li>Original authentic product</li><li>Brand new, sealed pack</li><li>Warranty included</li><li>Fast delivery across Bangladesh</li></ul><h4>Why Buy From Tihan Online?</h4><p>We are your trusted source for broadband accessories in Bangladesh. All products are 100% genuine with manufacturer warranty. Order now and get fast delivery!</p>',3500.00,3200.00,9.00,168,1,'pcs','uploads/products/prod_24.jpg',0,0,0,0,NULL,1,'UPS 650VA for Networking Equipment - Buy at Best Price | Tihan Online','Buy UPS 650VA for Networking Equipment online at the best price in Bangladesh. ✓ Genuine Product ✓ Fast Delivery ✓ Warranty. Tihan Online.',NULL,437,4769,4.60,31,'2026-05-19 10:18:29','2026-08-07 10:18:29'),(26,'Universal Wall Mount Bracket for Router/ONU','universal-wall-mount-bracket-for-routeronu','TIH-B2NSAE',7,2,'Universal wall mount bracket. Compatible with most routers and ONUs. Includes screws.','<h3>Universal Wall Mount Bracket for Router/ONU</h3><p>Universal wall mount bracket. Compatible with most routers and ONUs. Includes screws.</p><h4>Key Features:</h4><ul><li>Original authentic product</li><li>Brand new, sealed pack</li><li>Warranty included</li><li>Fast delivery across Bangladesh</li></ul><h4>Why Buy From Tihan Online?</h4><p>We are your trusted source for broadband accessories in Bangladesh. All products are 100% genuine with manufacturer warranty. Order now and get fast delivery!</p>',150.00,NULL,0.00,30,1,'pcs','uploads/products/prod_25.jpg',0,0,0,0,NULL,1,'Universal Wall Mount Bracket for Router/ONU - Buy at Best Price | Tihan Online','Buy Universal Wall Mount Bracket for Router/ONU online at the best price in Bangladesh. ✓ Genuine Product ✓ Fast Delivery ✓ Warranty. Tihan Online.',NULL,61,7898,3.50,21,'2026-07-06 10:18:29','2026-08-15 02:14:41'),(27,'Cable Tie Organizer Kit 200pcs','cable-tie-organizer-kit-200pcs','TIH-EGAXIQ',10,2,'Nylon cable ties assorted sizes. UV resistant. Self-locking. Pack of 200.','<h3>Cable Tie Organizer Kit 200pcs</h3><p>Nylon cable ties assorted sizes. UV resistant. Self-locking. Pack of 200.</p><h4>Key Features:</h4><ul><li>Original authentic product</li><li>Brand new, sealed pack</li><li>Warranty included</li><li>Fast delivery across Bangladesh</li></ul><h4>Why Buy From Tihan Online?</h4><p>We are your trusted source for broadband accessories in Bangladesh. All products are 100% genuine with manufacturer warranty. Order now and get fast delivery!</p>',250.00,199.00,20.00,151,1,'pcs','uploads/products/prod_26.jpg',0,0,0,0,NULL,1,'Cable Tie Organizer Kit 200pcs - Buy at Best Price | Tihan Online','Buy Cable Tie Organizer Kit 200pcs online at the best price in Bangladesh. ✓ Genuine Product ✓ Fast Delivery ✓ Warranty. Tihan Online.',NULL,61,7834,4.30,35,'2026-06-30 10:18:29','2026-08-14 04:11:09'),(28,'Outdoor Weatherproof Enclosure Box','outdoor-weatherproof-enclosure-box','TIH-2P4YQL',7,3,'IP65 weatherproof junction box. Suitable for outdoor networking equipment. With mounting plate.','<h3>Outdoor Weatherproof Enclosure Box</h3><p>IP65 weatherproof junction box. Suitable for outdoor networking equipment. With mounting plate.</p><h4>Key Features:</h4><ul><li>Original authentic product</li><li>Brand new, sealed pack</li><li>Warranty included</li><li>Fast delivery across Bangladesh</li></ul><h4>Why Buy From Tihan Online?</h4><p>We are your trusted source for broadband accessories in Bangladesh. All products are 100% genuine with manufacturer warranty. Order now and get fast delivery!</p>',850.00,750.00,12.00,145,1,'pcs','uploads/products/prod_27.jpg',0,0,0,0,NULL,1,'Outdoor Weatherproof Enclosure Box - Buy at Best Price | Tihan Online','Buy Outdoor Weatherproof Enclosure Box online at the best price in Bangladesh. ✓ Genuine Product ✓ Fast Delivery ✓ Warranty. Tihan Online.',NULL,363,3049,4.60,11,'2026-06-26 10:18:29','2026-08-14 04:11:09'),(29,'1GE SFP Module SX MM 550m LC','1ge-sfp-module-sx-mm-550m-lc','TIH-9IP9H2',13,3,'1.25G SFP multimode transceiver. 850nm. LC connector. Up to 550m range.','<h3>1GE SFP Module SX MM 550m LC</h3><p>1.25G SFP multimode transceiver. 850nm. LC connector. Up to 550m range.</p><h4>Key Features:</h4><ul><li>Original authentic product</li><li>Brand new, sealed pack</li><li>Warranty included</li><li>Fast delivery across Bangladesh</li></ul><h4>Why Buy From Tihan Online?</h4><p>We are your trusted source for broadband accessories in Bangladesh. All products are 100% genuine with manufacturer warranty. Order now and get fast delivery!</p>',1200.00,999.00,17.00,197,1,'pcs','uploads/products/prod_28.jpg',0,0,0,0,NULL,1,'1GE SFP Module SX MM 550m LC - Buy at Best Price | Tihan Online','Buy 1GE SFP Module SX MM 550m LC online at the best price in Bangladesh. ✓ Genuine Product ✓ Fast Delivery ✓ Warranty. Tihan Online.',NULL,284,6312,4.40,44,'2026-06-01 10:18:29','2026-08-07 10:18:29'),(30,'Media Converter Gigabit SC Single-Mode','media-converter-gigabit-sc-single-mode','TIH-BB0YX6',16,1,'10/100/1000M media converter. SC connector single-mode. 20km transmission distance.','<h3>Media Converter Gigabit SC Single-Mode</h3><p>10/100/1000M media converter. SC connector single-mode. 20km transmission distance.</p><h4>Key Features:</h4><ul><li>Original authentic product</li><li>Brand new, sealed pack</li><li>Warranty included</li><li>Fast delivery across Bangladesh</li></ul><h4>Why Buy From Tihan Online?</h4><p>We are your trusted source for broadband accessories in Bangladesh. All products are 100% genuine with manufacturer warranty. Order now and get fast delivery!</p>',1800.00,1600.00,11.00,36,1,'pcs','uploads/products/prod_29.jpg',0,0,0,0,NULL,1,'Media Converter Gigabit SC Single-Mode - Buy at Best Price | Tihan Online','Buy Media Converter Gigabit SC Single-Mode online at the best price in Bangladesh. ✓ Genuine Product ✓ Fast Delivery ✓ Warranty. Tihan Online.',NULL,251,1070,4.20,44,'2026-05-11 10:18:29','2026-08-07 10:18:29'),(31,'Fiber Optical Power Meter with VFL','fiber-optical-power-meter-with-vfl','TIH-IFFQ6Y',13,3,'Optical power meter -70~+10dBm. Visual fault locator 30mW. FC/SC/ST adapters included.','<h3>Fiber Optical Power Meter with VFL</h3><p>Optical power meter -70~+10dBm. Visual fault locator 30mW. FC/SC/ST adapters included.</p><h4>Key Features:</h4><ul><li>Original authentic product</li><li>Brand new, sealed pack</li><li>Warranty included</li><li>Fast delivery across Bangladesh</li></ul><h4>Why Buy From Tihan Online?</h4><p>We are your trusted source for broadband accessories in Bangladesh. All products are 100% genuine with manufacturer warranty. Order now and get fast delivery!</p>',2500.00,2200.00,12.00,105,1,'pcs','uploads/products/prod_30.jpg',0,1,0,0,NULL,1,'Fiber Optical Power Meter with VFL - Buy at Best Price | Tihan Online','Buy Fiber Optical Power Meter with VFL online at the best price in Bangladesh. ✓ Genuine Product ✓ Fast Delivery ✓ Warranty. Tihan Online.',NULL,466,604,4.90,23,'2026-06-28 10:18:29','2026-08-07 10:18:29'),(32,'SC/APC Fiber Optic Fast Connector 50pcs','scapc-fiber-optic-fast-connector-50pcs','TIH-44TI3T',16,3,'SC/APC field assembly connectors. Pre-polished. No epoxy needed. Pack of 50.','<h3>SC/APC Fiber Optic Fast Connector 50pcs</h3><p>SC/APC field assembly connectors. Pre-polished. No epoxy needed. Pack of 50.</p><h4>Key Features:</h4><ul><li>Original authentic product</li><li>Brand new, sealed pack</li><li>Warranty included</li><li>Fast delivery across Bangladesh</li></ul><h4>Why Buy From Tihan Online?</h4><p>We are your trusted source for broadband accessories in Bangladesh. All products are 100% genuine with manufacturer warranty. Order now and get fast delivery!</p>',1800.00,1550.00,14.00,82,1,'pcs','uploads/products/prod_31.jpg',0,1,0,0,NULL,1,'SC/APC Fiber Optic Fast Connector 50pcs - Buy at Best Price | Tihan Online','Buy SC/APC Fiber Optic Fast Connector 50pcs online at the best price in Bangladesh. ✓ Genuine Product ✓ Fast Delivery ✓ Warranty. Tihan Online.',NULL,107,5311,3.60,21,'2026-06-20 10:18:29','2026-08-07 10:18:29'),(33,'USB 3.0 to Gigabit Ethernet Adapter','usb-30-to-gigabit-ethernet-adapter','TIH-MEI45Y',19,1,'USB 3.0 to RJ45 Gigabit adapter. 10/100/1000Mbps. Plug and play. Windows/Mac/Linux.','<h3>USB 3.0 to Gigabit Ethernet Adapter</h3><p>USB 3.0 to RJ45 Gigabit adapter. 10/100/1000Mbps. Plug and play. Windows/Mac/Linux.</p><h4>Key Features:</h4><ul><li>Original authentic product</li><li>Brand new, sealed pack</li><li>Warranty included</li><li>Fast delivery across Bangladesh</li></ul><h4>Why Buy From Tihan Online?</h4><p>We are your trusted source for broadband accessories in Bangladesh. All products are 100% genuine with manufacturer warranty. Order now and get fast delivery!</p>',1200.00,999.00,17.00,92,1,'pcs','uploads/products/prod_32.jpg',0,1,0,0,NULL,1,'USB 3.0 to Gigabit Ethernet Adapter - Buy at Best Price | Tihan Online','Buy USB 3.0 to Gigabit Ethernet Adapter online at the best price in Bangladesh. ✓ Genuine Product ✓ Fast Delivery ✓ Warranty. Tihan Online.',NULL,295,1196,4.40,28,'2026-08-03 10:18:29','2026-08-14 03:40:16'),(34,'PCIe Gigabit Network Card Dual Port','pcie-gigabit-network-card-dual-port','TIH-KAV9CN',22,4,'Dual-port PCIe x1 gigabit LAN card. Realtek chipset. Low profile bracket included.','<h3>PCIe Gigabit Network Card Dual Port</h3><p>Dual-port PCIe x1 gigabit LAN card. Realtek chipset. Low profile bracket included.</p><h4>Key Features:</h4><ul><li>Original authentic product</li><li>Brand new, sealed pack</li><li>Warranty included</li><li>Fast delivery across Bangladesh</li></ul><h4>Why Buy From Tihan Online?</h4><p>We are your trusted source for broadband accessories in Bangladesh. All products are 100% genuine with manufacturer warranty. Order now and get fast delivery!</p>',2500.00,NULL,0.00,54,1,'pcs','uploads/products/prod_33.jpg',0,1,0,0,NULL,1,'PCIe Gigabit Network Card Dual Port - Buy at Best Price | Tihan Online','Buy PCIe Gigabit Network Card Dual Port online at the best price in Bangladesh. ✓ Genuine Product ✓ Fast Delivery ✓ Warranty. Tihan Online.',NULL,381,7774,3.60,26,'2026-07-28 10:18:29','2026-08-14 02:17:59'),(35,'USB WiFi Adapter AC1300 Dual Band','usb-wifi-adapter-ac1300-dual-band','TIH-AOZHZR',19,1,'Dual-band AC1300 USB WiFi adapter. 867Mbps on 5GHz + 400Mbps on 2.4GHz. WPA3 support.','<h3>USB WiFi Adapter AC1300 Dual Band</h3><p>Dual-band AC1300 USB WiFi adapter. 867Mbps on 5GHz + 400Mbps on 2.4GHz. WPA3 support.</p><h4>Key Features:</h4><ul><li>Original authentic product</li><li>Brand new, sealed pack</li><li>Warranty included</li><li>Fast delivery across Bangladesh</li></ul><h4>Why Buy From Tihan Online?</h4><p>We are your trusted source for broadband accessories in Bangladesh. All products are 100% genuine with manufacturer warranty. Order now and get fast delivery!</p>',1500.00,1299.00,13.00,198,1,'pcs','uploads/products/prod_34.jpg',0,1,0,0,NULL,1,'USB WiFi Adapter AC1300 Dual Band - Buy at Best Price | Tihan Online','Buy USB WiFi Adapter AC1300 Dual Band online at the best price in Bangladesh. ✓ Genuine Product ✓ Fast Delivery ✓ Warranty. Tihan Online.',NULL,281,558,3.80,27,'2026-08-02 10:18:29','2026-08-14 03:42:05'),(36,'Hikvision 2MP IP Bullet Camera','hikvision-2mp-ip-bullet-camera','TIH-VMRJZS',25,3,'2MP IP bullet camera. IR 30m. H.265+ compression. IP67 weatherproof. PoE.','<h3>Hikvision 2MP IP Bullet Camera</h3><p>2MP IP bullet camera. IR 30m. H.265+ compression. IP67 weatherproof. PoE.</p><h4>Key Features:</h4><ul><li>Original authentic product</li><li>Brand new, sealed pack</li><li>Warranty included</li><li>Fast delivery across Bangladesh</li></ul><h4>Why Buy From Tihan Online?</h4><p>We are your trusted source for broadband accessories in Bangladesh. All products are 100% genuine with manufacturer warranty. Order now and get fast delivery!</p>',3500.00,3200.00,9.00,59,1,'pcs','uploads/products/prod_35.jpg',0,1,0,0,NULL,1,'Hikvision 2MP IP Bullet Camera - Buy at Best Price | Tihan Online','Buy Hikvision 2MP IP Bullet Camera online at the best price in Bangladesh. ✓ Genuine Product ✓ Fast Delivery ✓ Warranty. Tihan Online.',NULL,294,6878,4.20,59,'2026-05-16 10:18:29','2026-08-07 10:18:29'),(37,'Dahua 4-Channel PoE NVR','dahua-4-channel-poe-nvr','TIH-ZYR2ES',28,14,'4-channel PoE NVR. Supports up to 4K recording. H.265+. 1 SATA HDD slot.','<h3>Dahua 4-Channel PoE NVR</h3><p>4-channel PoE NVR. Supports up to 4K recording. H.265+. 1 SATA HDD slot.</p><h4>Key Features:</h4><ul><li>Original authentic product</li><li>Brand new, sealed pack</li><li>Warranty included</li><li>Fast delivery across Bangladesh</li></ul><h4>Why Buy From Tihan Online?</h4><p>We are your trusted source for broadband accessories in Bangladesh. All products are 100% genuine with manufacturer warranty. Order now and get fast delivery!</p>',5500.00,4999.00,9.00,133,1,'pcs','uploads/products/prod_36.jpg',0,1,0,0,NULL,1,'Dahua 4-Channel PoE NVR - Buy at Best Price | Tihan Online','Buy Dahua 4-Channel PoE NVR online at the best price in Bangladesh. ✓ Genuine Product ✓ Fast Delivery ✓ Warranty. Tihan Online.',NULL,204,5033,3.70,39,'2026-07-20 10:18:29','2026-08-07 10:18:29'),(38,'CAT6 Outdoor Ethernet Cable 50m','cat6-outdoor-ethernet-cable-50m','TIH-7PTVQB',25,2,'Outdoor CAT6 Ethernet cable. UV resistant. Copper clad aluminum. 50 meters.','<h3>CAT6 Outdoor Ethernet Cable 50m</h3><p>Outdoor CAT6 Ethernet cable. UV resistant. Copper clad aluminum. 50 meters.</p><h4>Key Features:</h4><ul><li>Original authentic product</li><li>Brand new, sealed pack</li><li>Warranty included</li><li>Fast delivery across Bangladesh</li></ul><h4>Why Buy From Tihan Online?</h4><p>We are your trusted source for broadband accessories in Bangladesh. All products are 100% genuine with manufacturer warranty. Order now and get fast delivery!</p>',1200.00,999.00,17.00,188,1,'pcs','uploads/products/prod_37.jpg',0,1,0,0,NULL,1,'CAT6 Outdoor Ethernet Cable 50m - Buy at Best Price | Tihan Online','Buy CAT6 Outdoor Ethernet Cable 50m online at the best price in Bangladesh. ✓ Genuine Product ✓ Fast Delivery ✓ Warranty. Tihan Online.',NULL,315,7886,4.90,9,'2026-08-03 10:18:29','2026-08-14 03:32:04'),(39,'CCTV Power Supply Box 12V 10A 8CH','cctv-power-supply-box-12v-10a-8ch','TIH-VMJLUT',28,3,'12V 10A CCTV power distribution box. 8 channels. Short circuit protection. LED indicator.','<h3>CCTV Power Supply Box 12V 10A 8CH</h3><p>12V 10A CCTV power distribution box. 8 channels. Short circuit protection. LED indicator.</p><h4>Key Features:</h4><ul><li>Original authentic product</li><li>Brand new, sealed pack</li><li>Warranty included</li><li>Fast delivery across Bangladesh</li></ul><h4>Why Buy From Tihan Online?</h4><p>We are your trusted source for broadband accessories in Bangladesh. All products are 100% genuine with manufacturer warranty. Order now and get fast delivery!</p>',1200.00,NULL,0.00,200,1,'pcs','uploads/products/prod_38.jpg',0,1,0,0,NULL,1,'CCTV Power Supply Box 12V 10A 8CH - Buy at Best Price | Tihan Online','Buy CCTV Power Supply Box 12V 10A 8CH online at the best price in Bangladesh. ✓ Genuine Product ✓ Fast Delivery ✓ Warranty. Tihan Online.',NULL,388,7252,5.00,11,'2026-05-13 10:18:29','2026-08-07 10:18:29');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `search_terms`
--

DROP TABLE IF EXISTS `search_terms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `search_terms` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `term` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `count` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `search_terms_term_unique` (`term`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `search_terms`
--

LOCK TABLES `search_terms` WRITE;
/*!40000 ALTER TABLE `search_terms` DISABLE KEYS */;
INSERT INTO `search_terms` VALUES (1,'router',3,'2026-08-07 11:13:29','2026-08-07 11:16:56'),(2,'TIH-KAV9CN',2,'2026-08-14 02:18:12','2026-08-14 02:18:12');
/*!40000 ALTER TABLE `search_terms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('ahxTKMoZuIeZDM7hWWSqiQlf74aIXt6WmTesT30E',NULL,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:153.0) Gecko/20100101 Firefox/153.0','eyJfdG9rZW4iOiJMalhFWkFrcWxyTnVnTGxxemZzYUxNbGVvMGx4VjkxUml3WGVabkNTIiwiY2FydF9zZXNzaW9uX2lkIjoiY2FydF82YTdlZDllMmQzNjc4OC4xNDg2OTQ2NyIsIl9wcmV2aW91cyI6eyJ1cmwiOiJodHRwOlwvXC90aWhhbm9ubGluZS50ZXN0Iiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1786698210),('b8iWzRI0vKMYtGphSLL5XTUjfLm8aRAhQil0pXst',NULL,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:153.0) Gecko/20100101 Firefox/153.0','eyJfdG9rZW4iOiI1U1M0WTBHeDZESmd0SUNEWHRPMFMzeU4wcVh2bUZCTGRHSjZrRXZzIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJjYXJ0X3Nlc3Npb25faWQiOiJjYXJ0XzZhN2VlOWY5NmIwNTY0Ljg1NjA5MzQ5IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL3RpaGFub25saW5lLnRlc3RcL3Byb2R1Y3RzIiwicm91dGUiOiJwcm9kdWN0cy5saXN0aW5nIn0sImxvZ2luX2FkbWluXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjEsInVybCI6eyJpbnRlbmRlZCI6Imh0dHA6XC9cL3RpaGFub25saW5lLnRlc3RcL2NoZWNrb3V0In0sImxvZ2luX2N1c3RvbWVyXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjI2fQ==',1786703207),('jtW4bjvdNa2NYjevgWlUqxdaATF0Fl2ba7PXuw74',NULL,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:153.0) Gecko/20100101 Firefox/153.0','eyJfdG9rZW4iOiJqdWhud1lMSGtGb2dRZVFKOGw0OUw4Q285SVZpVVB2eXR1eU93N3U2IiwiY2FydF9zZXNzaW9uX2lkIjoiY2FydF82YTgwMWZlM2U5Y2M1OC44OTU1MTU3NiIsIl9wcmV2aW91cyI6eyJ1cmwiOiJodHRwOlwvXC90aWhhbm9ubGluZS50ZXN0XC9wYWdlXC9jb250YWN0Iiwicm91dGUiOiJwYWdlIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1786781689);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'site_name','Tihan Online','2026-08-07 09:27:15','2026-08-07 10:14:31'),(2,'tagline','Broadband Accessories & Networking Solutions','2026-08-07 09:27:15','2026-08-07 10:14:31'),(3,'contact_email','support@example.com','2026-08-07 09:27:15','2026-08-07 09:27:15'),(4,'contact_phone','+8801800000000','2026-08-07 09:27:15','2026-08-14 03:00:47'),(5,'address','Dhaka, Bangladesh','2026-08-07 09:27:15','2026-08-07 09:27:15'),(6,'logo','/storage/uploads/logos/QUARwuIN0ed0yHK89Pbi5jQQHRFXsfbw1QNgEg9p.png','2026-08-07 09:27:15','2026-08-14 02:58:15'),(7,'favicon','','2026-08-07 09:27:15','2026-08-07 09:27:15'),(8,'primary_color','#0b1f4b','2026-08-07 09:27:15','2026-08-14 03:00:10'),(9,'meta_title','Tihan Online - Broadband Accessories & Networking Equipment','2026-08-07 09:27:15','2026-08-07 10:14:31'),(10,'meta_description','Shop the best broadband accessories, routers, cables, and networking equipment online at Tihan Online. Fast delivery across Bangladesh.','2026-08-07 09:27:15','2026-08-07 10:14:31'),(11,'meta_keywords','broadband accessories, router, cable, networking, antenna, modem, ONU, tihan online','2026-08-07 09:27:15','2026-08-07 10:14:31'),(12,'show_flash_deals','1','2026-08-07 09:27:15','2026-08-07 09:27:15'),(13,'show_featured','1','2026-08-07 09:27:15','2026-08-07 09:27:15'),(14,'show_new_arrivals','1','2026-08-07 09:27:15','2026-08-07 09:27:15'),(15,'show_best_selling','1','2026-08-07 09:27:15','2026-08-07 09:27:15'),(16,'show_category_showcase','1','2026-08-07 09:27:15','2026-08-07 09:27:15'),(17,'show_brand_showcase','1','2026-08-07 09:27:15','2026-08-07 09:27:15'),(18,'products_per_section','12','2026-08-07 09:27:15','2026-08-07 09:27:15'),(19,'cod_enabled','1','2026-08-07 09:27:15','2026-08-07 09:27:15'),(20,'bkash_enabled','0','2026-08-07 09:27:15','2026-08-14 02:56:30'),(21,'nagad_enabled','0','2026-08-07 09:27:15','2026-08-14 02:56:30'),(22,'bkash_number',NULL,'2026-08-07 09:27:15','2026-08-14 02:41:22'),(23,'nagad_number',NULL,'2026-08-07 09:27:15','2026-08-14 02:41:22'),(24,'payment_instructions','Please send payment to the above number and enter the Transaction ID.','2026-08-07 09:27:15','2026-08-07 09:27:15'),(25,'inside_dhaka_charge','60','2026-08-07 09:27:15','2026-08-07 09:27:15'),(26,'outside_dhaka_charge','120','2026-08-07 09:27:15','2026-08-07 09:27:15'),(27,'free_delivery_above','5000','2026-08-07 09:27:15','2026-08-07 09:27:15'),(28,'facebook_url',NULL,'2026-08-07 09:27:15','2026-08-14 02:41:22'),(29,'twitter_url',NULL,'2026-08-07 09:27:15','2026-08-14 02:41:22'),(30,'instagram_url',NULL,'2026-08-07 09:27:15','2026-08-14 02:41:22'),(31,'youtube_url',NULL,'2026-08-07 09:27:15','2026-08-14 02:41:22'),(32,'whatsapp_number',NULL,'2026-08-07 09:27:15','2026-08-14 02:41:22'),(33,'google_login_enabled','0','2026-08-07 09:27:15','2026-08-07 09:27:15'),(34,'google_client_id','','2026-08-07 09:27:15','2026-08-07 09:27:15'),(35,'google_client_secret','','2026-08-07 09:27:15','2026-08-07 09:27:15'),(36,'facebook_login_enabled','0','2026-08-07 09:27:15','2026-08-07 09:27:15'),(37,'facebook_app_id','','2026-08-07 09:27:15','2026-08-07 09:27:15'),(38,'facebook_app_secret','','2026-08-07 09:27:15','2026-08-07 09:27:15'),(39,'google_analytics_id',NULL,'2026-08-07 09:27:15','2026-08-14 02:41:22'),(40,'facebook_pixel_id',NULL,'2026-08-07 09:27:15','2026-08-14 02:41:22');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sliders`
--

DROP TABLE IF EXISTS `sliders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sliders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image_desktop` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sliders`
--

LOCK TABLES `sliders` WRITE;
/*!40000 ALTER TABLE `sliders` DISABLE KEYS */;
INSERT INTO `sliders` VALUES (1,'High-Speed Routers','Starting from ৳1,550','Get the best WiFi routers for your home and office. TP-Link, D-Link, Tenda & more.','uploads/sliders/1786120339_3GkQ5CMdCg.jpeg','uploads/sliders/1786120339_E3SYNTxnjQ.jpeg','/products?category=routers-networking','Shop Routers',0,1,'2026-08-07 10:18:29','2026-08-07 10:32:19'),(2,'Fiber Optic Solutions','Premium Quality Cables & Tools','SC/APC connectors, patch cords, media converters, power meters. Everything for fiber networks.','uploads/sliders/1786120400_Q100icSQ5w.jpeg','uploads/sliders/1786120400_dISEdhtF57.jpeg','/products?category=fiber-optic-equipment','View Fiber',1,1,'2026-08-07 10:18:29','2026-08-07 10:33:20'),(3,'GPON ONU Sale','Up to 20% Off','Huawei, ZTE, Nokia, VSOL GPON ONUs. Bridge mode ready. Best prices guaranteed.','uploads/sliders/1786120425_NdgUiYxZ9g.jpg','uploads/sliders/1786120425_6hpFGZSk7s.jpg','/products?category=modems-onu','Buy ONU',2,1,'2026-08-07 10:18:29','2026-08-07 10:33:45'),(4,'Networking Essentials','Switches, Cables & More','CAT6 cables, RJ45 connectors, gigabit switches. Everything you need for your network setup.','uploads/sliders/1786120445_UB0dPFEVf3.jpeg','uploads/sliders/1786120445_UN5GnEKKs7.jpeg','/products','Shop Now',3,1,'2026-08-07 10:18:29','2026-08-07 10:34:05'),(5,'Tihan Online','Your Broadband Partner','100% genuine products. Fast delivery across Bangladesh. Expert support.','uploads/sliders/1786120469_wcuUdXOxLk.jpeg','uploads/sliders/1786120469_ICZEN8uXBp.jpeg','/products','Explore',4,1,'2026-08-07 10:18:29','2026-08-07 10:34:29');
/*!40000 ALTER TABLE `sliders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscribers`
--

DROP TABLE IF EXISTS `subscribers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subscribers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `subscribers_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscribers`
--

LOCK TABLES `subscribers` WRITE;
/*!40000 ALTER TABLE `subscribers` DISABLE KEYS */;
INSERT INTO `subscribers` VALUES (1,'subscriber1@gmail.com',1,'2026-06-07 10:18:33',NULL),(2,'subscriber2@gmail.com',1,'2026-07-14 10:18:33',NULL),(3,'subscriber3@gmail.com',1,'2026-05-30 10:18:33',NULL),(4,'subscriber4@gmail.com',1,'2026-06-03 10:18:33',NULL),(5,'subscriber5@gmail.com',1,'2026-07-25 10:18:33',NULL),(6,'subscriber6@gmail.com',1,'2026-08-05 10:18:33',NULL),(7,'subscriber7@gmail.com',1,'2026-07-30 10:18:33',NULL),(8,'subscriber8@gmail.com',1,'2026-05-10 10:18:33',NULL),(9,'subscriber9@gmail.com',1,'2026-06-13 10:18:33',NULL),(10,'subscriber10@gmail.com',1,'2026-06-02 10:18:33',NULL),(11,'subscriber11@gmail.com',1,'2026-07-26 10:18:33',NULL),(12,'subscriber12@gmail.com',1,'2026-07-07 10:18:33',NULL),(13,'subscriber13@gmail.com',1,'2026-06-28 10:18:33',NULL),(14,'subscriber14@gmail.com',1,'2026-07-14 10:18:33',NULL),(15,'subscriber15@gmail.com',1,'2026-08-06 10:18:33',NULL),(16,'subscriber16@gmail.com',1,'2026-05-31 10:18:33',NULL),(17,'subscriber17@gmail.com',1,'2026-07-29 10:18:33',NULL),(18,'subscriber18@gmail.com',1,'2026-07-09 10:18:33',NULL),(19,'subscriber19@gmail.com',1,'2026-06-17 10:18:33',NULL),(20,'subscriber20@gmail.com',1,'2026-07-26 10:18:33',NULL);
/*!40000 ALTER TABLE `subscribers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wishlists`
--

DROP TABLE IF EXISTS `wishlists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wishlists` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `wishlists_customer_id_product_id_unique` (`customer_id`,`product_id`),
  KEY `wishlists_product_id_foreign` (`product_id`),
  CONSTRAINT `wishlists_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wishlists`
--

LOCK TABLES `wishlists` WRITE;
/*!40000 ALTER TABLE `wishlists` DISABLE KEYS */;
INSERT INTO `wishlists` VALUES (4,25,9,'2026-08-14 03:38:21','2026-08-14 03:38:21'),(5,25,1,'2026-08-14 03:38:40','2026-08-14 03:38:40'),(7,25,33,'2026-08-14 03:40:32','2026-08-14 03:40:32'),(8,26,33,'2026-08-14 04:26:26','2026-08-14 04:26:26'),(9,26,8,'2026-08-14 04:26:33','2026-08-14 04:26:33'),(10,26,1,'2026-08-14 04:26:34','2026-08-14 04:26:34'),(11,26,3,'2026-08-14 04:26:36','2026-08-14 04:26:36');
/*!40000 ALTER TABLE `wishlists` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-08-15 14:16:33
