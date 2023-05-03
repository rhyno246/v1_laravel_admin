-- MySQL dump 10.13  Distrib 8.0.29, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: db_shop
-- ------------------------------------------------------
-- Server version	8.0.29

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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int NOT NULL DEFAULT '0',
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (20,'Đồ nam',0,'do-nam','2022-08-26 07:01:29','2022-09-30 06:55:05'),(21,'Giày thể thao',0,'giay-the-thao','2022-08-26 23:56:28','2022-09-30 06:54:06'),(25,'Nike',21,'nike','2022-09-30 06:54:17','2022-09-30 06:54:17'),(26,'Addidas',21,'addidas','2022-09-30 06:54:29','2022-09-30 06:54:29'),(27,'Puma',21,'puma','2022-09-30 06:54:41','2022-09-30 06:54:41'),(28,'Gucci',20,'gucci','2022-09-30 06:55:13','2022-09-30 06:55:13'),(29,'Dior',20,'dior','2022-09-30 06:55:25','2022-09-30 06:55:25'),(30,'Chanel',20,'chanel','2022-09-30 06:55:41','2022-09-30 06:55:41'),(31,'DOLCE AND GABBANA',20,'dolce-and-gabbana','2022-09-30 06:55:58','2022-09-30 06:55:58'),(32,'Đồ nữ',0,'do-nu','2022-09-30 06:56:21','2022-09-30 06:56:21'),(33,'Dior',32,'dior','2022-09-30 06:57:16','2022-09-30 06:57:16'),(34,'Chanel',32,'chanel','2022-09-30 06:57:24','2022-09-30 06:57:24'),(35,'Đồ trẻ em',0,'do-tre-em','2022-09-30 06:57:40','2022-09-30 06:57:40'),(36,'Túi xách',0,'tui-xach','2022-09-30 06:57:56','2022-09-30 06:57:56');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coupons` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `coupons_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_start` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_end` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupons_value` int NOT NULL DEFAULT '0',
  `coupons_cart_value` int NOT NULL,
  `customer_group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupons_price` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coupons`
--

LOCK TABLES `coupons` WRITE;
/*!40000 ALTER TABLE `coupons` DISABLE KEYS */;
INSERT INTO `coupons` VALUES (4,'admin',5,'FREE20','2022-09-25','2022-09-30',1,500000,'vip',20,'2022-09-25 03:07:59','2022-09-25 03:07:59'),(5,'admin',5,'OFF100','2022-09-25','2022-09-25',0,600000,'normal',100000,'2022-09-25 03:08:19','2022-09-25 03:08:19'),(6,'admin',5,'FREE50','2022-09-25','2022-09-30',1,800000,'super_vip',50,'2022-09-25 03:08:52','2022-09-25 03:08:52');
/*!40000 ALTER TABLE `coupons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customers` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `src` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` int NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'normal',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `password_dehash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  UNIQUE KEY `customers_id_unique` (`id`),
  UNIQUE KEY `customers_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES ('08ab0810-1a56-46d1-a412-3dbd056d446e','test nguyen','/storage/customers/5/b1f8db03513912254d185addce84c7e0.png','img3.png','quangthanhliet@gmail.com',908096448,'$2y$10$RozXEPxp0kN/Mzjo3Wv.GeeIQZwQv4HpnwBJRWRnTmPuu6PkgAzpa',1,'normal','2022-09-22 07:32:35','2022-09-23 19:57:02','quang thanh liet'),('38ad7143-3ab7-45f1-ba19-dc4f338e75cf','janna nguyen','/storage/customers//e233f218a90b7a00b94b7f533a98c0a2.png','img1.png','janna@gmail.com',908096448,'$2y$10$/Oath5usbrRK6l54uo6WNeSeHaz/cdvTt3/26zKaZXWC.KyVAgR5q',1,'super_vip','2022-09-23 09:46:50','2022-09-23 19:58:31','minhman'),('898f6f82-8309-4465-83c8-af710091816f','jaden nguyen','/storage/customers//3849a4745c6dded7ae71f6ea03458100.png','sec4_img3.png','jaden@gmail.com',908096448,'$2y$10$ib2lU6YSXe5qGVQce.fDGeb4K9v2o1u41QG7YA.lvrUrDmMWnofFq',1,'super_vip','2022-09-23 09:47:36','2022-09-25 03:24:09','minhman'),('b3b4e507-a628-43e1-9ab1-6b265decf71c','my nguyen','/storage/customers//65bd2c9b931f057d7307dfaaa8d5c433.png','img2.png','mynguyen@gmail.com',908096448,'$2y$10$2lBwLas.vofEmKA0kpsHYe9TITt6P5C3NuoFneo88Xe5fiZ/VZBsC',1,'vip','2022-09-23 09:48:25','2022-09-23 19:58:22','minhman'),('da19acc6-65dd-4f96-8c82-dc39d68df931','man nguyen','/storage/customers/5/f357a461752937f229971594e957e867.jpg','5x5.jpg','nguyentrongminhman95@gmail.com',908096448,'$2y$10$1MgS7CPE/4Rl.27LQcko/ucPkTX6LyGfDUICyMZqJZ63XsEGJ00AW',1,'vip','2022-09-22 06:58:02','2022-09-24 21:59:59','minhman'),('f6356afb-389a-4a4e-a538-884143495427','oiashsa',NULL,NULL,'fsdakds@gmail.com',908096448,'$2y$10$Dh4CRumFhUBf0CnJSaQ8m.4BE8lDt4EUC.apEPaSrcf7IqRNknBYq',1,'normal','2022-10-07 05:45:12','2022-10-07 05:45:12','minhman');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
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
-- Table structure for table `galleries`
--

DROP TABLE IF EXISTS `galleries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `galleries` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `feature_image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `feature_image_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  UNIQUE KEY `galleries_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `galleries`
--

LOCK TABLES `galleries` WRITE;
/*!40000 ALTER TABLE `galleries` DISABLE KEYS */;
INSERT INTO `galleries` VALUES ('2a2ff917-3174-4693-a57a-5357d18ee301',5,'admin',1,NULL,NULL,'/storage/gallerys/5/396d16c4947a0f32e4f4fbdab0741093.png','content_popup3 - Copy.png','2022-09-20 06:59:54','2022-09-20 06:59:54'),('6f46495f-9a34-46be-8b35-c280bef1dc3d',5,'admin',1,'test','test','/storage/gallerys/5/b602e370d365f2ea954368469cbc8d7c.jpg','content_popup2.jpg','2022-09-19 08:07:35','2022-10-03 06:45:10'),('84986e73-56c8-446e-b3f5-0edd082ff240',5,'admin',1,'updated','updated','/storage/gallerys/5/fc5d240ab05d09b974527265e0eb3ed5.png','bg_sp.png','2022-09-19 08:24:05','2022-09-20 07:18:22'),('c147dd24-1149-406a-9b89-0c03b8d0379f',5,'admin',0,'updated best',NULL,'/storage/gallerys/5/d1adf6dbdb03db1627b404cf59426007.jpg','bai_viet_1.jpg','2022-09-20 07:04:43','2022-09-21 05:59:52');
/*!40000 ALTER TABLE `galleries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gallery_images`
--

DROP TABLE IF EXISTS `gallery_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gallery_images` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `src` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gellery_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  UNIQUE KEY `gallery_images_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gallery_images`
--

LOCK TABLES `gallery_images` WRITE;
/*!40000 ALTER TABLE `gallery_images` DISABLE KEYS */;
INSERT INTO `gallery_images` VALUES ('1b25e464-c2f7-49bd-a84c-63a324e8187a','/storage/gallerys/5/b602e370d365f2ea954368469cbc8d7c.jpg','content_popup2.jpg','6f46495f-9a34-46be-8b35-c280bef1dc3d','2022-09-19 08:07:35','2022-09-19 08:07:35'),('262cd14a-3e3f-4929-9fd7-8bf884c4f9c5','/storage/gallerys/5/396d16c4947a0f32e4f4fbdab0741093.png','content_popup3 - Copy.png','84986e73-56c8-446e-b3f5-0edd082ff240','2022-09-20 07:18:22','2022-09-20 07:18:22'),('82db4a82-f3d6-4ba7-a146-f63a90cf0a5a','/storage/gallerys/5/481827cbfe3b2e4edb1756049341fd72.png','content_popup4.png','6f46495f-9a34-46be-8b35-c280bef1dc3d','2022-09-19 08:07:35','2022-09-19 08:07:35'),('8c1f29c5-c89b-456a-af36-a10c00be209c','/storage/gallerys/5/7f2126490d695eeb0f45d825b055aadc.jpg','content_popup2 - Copy.jpg','6f46495f-9a34-46be-8b35-c280bef1dc3d','2022-09-19 08:07:35','2022-09-19 08:07:35'),('9a22803e-eb51-47ff-a26e-c62f2328b3a6','/storage/gallerys/5/eee85d6257f47357acdbb81b3323685a.jpg','content_popup1.jpg','84986e73-56c8-446e-b3f5-0edd082ff240','2022-09-19 08:24:05','2022-09-19 08:24:05'),('a4d51878-66b1-4a31-8b39-d1a7da4cfc3c','/storage/gallerys/5/b602e370d365f2ea954368469cbc8d7c.jpg','content_popup2.jpg','2a2ff917-3174-4693-a57a-5357d18ee301','2022-09-20 06:59:54','2022-09-20 06:59:54'),('a91c81b0-b048-4f8c-9ad7-2e3774d256ea','/storage/gallerys/5/eee85d6257f47357acdbb81b3323685a.jpg','content_popup1.jpg','6f46495f-9a34-46be-8b35-c280bef1dc3d','2022-09-19 08:07:35','2022-09-19 08:07:35'),('ad678cc5-853d-4073-96bb-7bcb15a3599a','/storage/gallerys/5/8df7b73a7820f4aef47864f2a6c5fccf.jpg','12.jpg','c147dd24-1149-406a-9b89-0c03b8d0379f','2022-09-20 07:18:49','2022-09-20 07:18:49'),('edf61e23-66ce-4030-ada2-ad1d44c7f6f5','/storage/gallerys/5/da01349b67d60c9a6ac014b4cc969b59.png','content_popup3.png','6f46495f-9a34-46be-8b35-c280bef1dc3d','2022-09-19 08:07:35','2022-09-19 08:07:35'),('f2fd4de2-6857-4a16-8664-e5a23e504fe3','/storage/gallerys/5/396d16c4947a0f32e4f4fbdab0741093.png','content_popup3 - Copy.png','6f46495f-9a34-46be-8b35-c280bef1dc3d','2022-09-19 08:07:35','2022-09-19 08:07:35');
/*!40000 ALTER TABLE `gallery_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menus` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int NOT NULL DEFAULT '0',
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `icon_menu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (9,'Trang Chủ',0,'trang-chu','2022-09-27 07:48:37','2022-09-29 05:37:19','fas fa-home'),(15,'Tin tức',0,'tin-tuc','2022-09-30 04:05:53','2022-09-30 04:05:53','fas fa-newspaper'),(16,'Sản phẩm',0,'san-pham','2022-09-30 04:07:19','2022-09-30 04:08:26','fas fa-window-maximize'),(17,'Dịch vụ',0,'dich-vu','2022-09-30 04:08:49','2022-09-30 04:08:49','fab fa-servicestack'),(18,'Liên hệ',0,'lien-he','2022-09-30 04:09:13','2022-09-30 04:09:13','fas fa-address-card');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (1,'sasadds fdsdfsdds','hehe@gmail.com','dsadas','dasdsadsa','2022-10-05 06:49:44','2022-10-05 06:49:44'),(2,'sasadds fdsdfsdds','hehe@gmail.com','sdadas','asdasd','2022-10-05 06:49:53','2022-10-05 06:49:53');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2022_08_19_140135_create_categories_table',1),(6,'2022_08_21_064052_create_permissions_table',2),(7,'2022_08_21_134858_create_table_user_role',3),(8,'2022_08_21_135231_create_roles_table',4),(9,'2022_08_21_140009_create_table_permission_role',5),(10,'2022_08_22_142940_create_table_permissions_role',6),(11,'2022_08_22_143029_create_table_users_role',6),(12,'2022_08_26_145237_create_column_password_dehash_table_user',7),(13,'2022_08_27_040416_create_menus_table',8),(14,'2022_08_27_082803_create_post_models_table',9),(15,'2022_08_27_090943_create_post_categories_table',10),(16,'2022_08_28_064245_create_posts_table',11),(17,'2022_08_28_072632_create_posts_table',12),(18,'2022_08_28_081928_create_column_slug_post_table',13),(19,'2022_08_28_120917_create_column_status_table_post',14),(20,'2022_08_29_133310_create_tags_table',15),(21,'2022_08_29_134106_create_post_tags_table',16),(22,'2022_08_29_134255_create_table_post_tag_relationship',16),(23,'2022_08_30_125425_create_post_tags_table',17),(24,'2022_08_30_125605_create_tablle_post_tag_ralationship',17),(25,'2022_08_30_153425_create_post_tag_table_ralationship',18),(26,'2022_09_02_121459_create_product_tags_table',19),(27,'2022_09_02_121607_create_table_product_tag_ralationship',19),(28,'2022_09_02_123829_create_table_product_tag_ralationship',20),(29,'2022_09_02_123919_create_table_product_tag_ralationship',21),(30,'2022_09_02_133812_create_sliders_table',22),(31,'2022_09_02_144514_create_sliders_table',23),(32,'2022_09_02_145824_create_column_users_name_posts_model',24),(33,'2022_09_02_145929_create_column_users_name_slider_model',24),(34,'2022_09_07_133213_create_products_table',25),(35,'2022_09_07_144816_create_products_images_table',26),(36,'2022_09_07_145609_create_colum_products_slug',27),(37,'2022_09_12_122446_create_products_table',28),(38,'2022_09_12_124153_create_column_user_name_for_products_table',29),(39,'2022_09_14_123843_create_column_image_name_table_products_image',30),(40,'2022_09_14_130656_create_products_table',31),(41,'2022_09_16_123630_create_products_images_table',32),(42,'2022_09_17_161337_create_galleries_table',33),(43,'2022_09_18_062121_create_column_price_table_products',34),(44,'2022_09_19_121654_create_gallery_images_table',35),(45,'2022_09_20_143845_create_user_avatars_table',36),(46,'2022_09_21_130641_create_settings_pages_table',37),(47,'2022_09_21_143809_create_column_type_table_setting_page',38),(48,'2022_09_22_130007_create_customers_table',39),(49,'2022_09_22_131348_craete_column_password_dehash',40),(50,'2022_09_22_160101_create_role_customers_table',41),(51,'2022_09_24_032430_create_coupons_table',42),(52,'2022_09_24_040607_create_column_coupons_price_table_coupon',43),(53,'2022_09_24_045910_create_table_coupons_role_customer_relationship',44),(54,'2022_09_24_050127_create_coupons_table',45),(55,'2022_09_24_050239_create_table_coupons_role_customer_relationship',46),(56,'2022_09_25_111944_create_column_product_sale',47),(57,'2022_09_26_152916_create_products_table',48),(58,'2022_09_26_153305_create_column_price_products',49),(59,'2022_09_27_131411_create_column_sale_products',50),(60,'2022_09_27_133719_create_column_new_price_products',51),(61,'2022_09_27_144628_create_column_menu_icon',52),(62,'2022_09_30_102549_create_services_table',53),(63,'2022_09_30_145422_create_column_view_count_products',54),(64,'2022_10_04_134948_create_messages_table',55),(65,'2022_10_04_160346_create_colum_count_message',56),(66,'2022_10_05_134835_create_messages_table',57);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int NOT NULL DEFAULT '0',
  `key_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'Danhmucsanpham','Danh mục sản phẩm',0,'Danhmucsanpham_parent_id','2022-08-22 07:32:04','2022-08-22 07:32:04'),(2,'Danhsach','Danh sách',1,'Danhmucsanpham_Danhsach','2022-08-22 07:32:04','2022-08-22 07:32:04'),(3,'Themmoi','Thêm mới',1,'Danhmucsanpham_Themmoi','2022-08-22 07:32:04','2022-08-22 07:32:04'),(4,'Sua','Sửa',1,'Danhmucsanpham_Sua','2022-08-22 07:32:04','2022-08-22 07:32:04'),(5,'Xoa','Xóa',1,'Danhmucsanpham_Xoa','2022-08-22 07:32:04','2022-08-22 07:32:04'),(6,'Danhsachtaikhoan','Danh sách tài khoản',0,'Danhsachtaikhoan_parent_id','2022-08-22 07:32:06','2022-08-22 07:32:06'),(7,'Danhsach','Danh sách',6,'Danhsachtaikhoan_Danhsach','2022-08-22 07:32:06','2022-08-22 07:32:06'),(8,'Themmoi','Thêm mới',6,'Danhsachtaikhoan_Themmoi','2022-08-22 07:32:06','2022-08-22 07:32:06'),(9,'Sua','Sửa',6,'Danhsachtaikhoan_Sua','2022-08-22 07:32:06','2022-08-22 07:32:06'),(10,'Xoa','Xóa',6,'Danhsachtaikhoan_Xoa','2022-08-22 07:32:06','2022-08-22 07:32:06'),(11,'Capquyen','Cấp quyền',0,'Capquyen_parent_id','2022-08-22 07:32:07','2022-08-22 07:32:07'),(12,'Danhsach','Danh sách',11,'Capquyen_Danhsach','2022-08-22 07:32:07','2022-08-22 07:32:07'),(13,'Themmoi','Thêm mới',11,'Capquyen_Themmoi','2022-08-22 07:32:07','2022-08-22 07:32:07'),(14,'Sua','Sửa',11,'Capquyen_Sua','2022-08-22 07:32:07','2022-08-22 07:32:07'),(15,'Xoa','Xóa',11,'Capquyen_Xoa','2022-08-22 07:32:07','2022-08-22 07:32:07'),(16,'Vaitro','Vai trò',0,'Vaitro_parent_id','2022-08-22 07:32:09','2022-08-22 07:32:09'),(17,'Danhsach','Danh sách',16,'Vaitro_Danhsach','2022-08-22 07:32:09','2022-08-22 07:32:09'),(18,'Themmoi','Thêm mới',16,'Vaitro_Themmoi','2022-08-22 07:32:09','2022-08-22 07:32:09'),(19,'Sua','Sửa',16,'Vaitro_Sua','2022-08-22 07:32:09','2022-08-22 07:32:09'),(20,'Xoa','Xóa',16,'Vaitro_Xoa','2022-08-22 07:32:09','2022-08-22 07:32:09');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions_role`
--

DROP TABLE IF EXISTS `permissions_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions_role` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int NOT NULL,
  `permission_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions_role`
--

LOCK TABLES `permissions_role` WRITE;
/*!40000 ALTER TABLE `permissions_role` DISABLE KEYS */;
INSERT INTO `permissions_role` VALUES (1,1,2,NULL,NULL),(2,1,3,NULL,NULL),(3,1,4,NULL,NULL),(4,1,5,NULL,NULL),(5,1,7,NULL,NULL),(6,1,8,NULL,NULL),(7,1,9,NULL,NULL),(8,1,10,NULL,NULL),(9,1,12,NULL,NULL),(10,1,13,NULL,NULL),(11,1,14,NULL,NULL),(12,1,15,NULL,NULL),(13,1,17,NULL,NULL),(14,1,18,NULL,NULL),(15,1,19,NULL,NULL),(16,1,20,NULL,NULL),(37,4,2,NULL,NULL),(38,4,3,NULL,NULL),(39,4,4,NULL,NULL),(40,4,5,NULL,NULL),(41,4,7,NULL,NULL),(42,4,8,NULL,NULL),(43,4,9,NULL,NULL),(44,4,10,NULL,NULL),(45,4,12,NULL,NULL),(46,4,13,NULL,NULL),(47,4,14,NULL,NULL),(48,4,15,NULL,NULL),(49,4,17,NULL,NULL),(50,4,18,NULL,NULL),(51,4,19,NULL,NULL),(52,4,20,NULL,NULL),(70,6,3,NULL,NULL),(82,6,2,NULL,NULL),(83,6,4,NULL,NULL),(84,6,5,NULL,NULL),(85,7,2,NULL,NULL),(86,7,3,NULL,NULL),(87,7,4,NULL,NULL);
/*!40000 ALTER TABLE `permissions_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_categories`
--

DROP TABLE IF EXISTS `post_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `post_categories` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  UNIQUE KEY `post_categories_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_categories`
--

LOCK TABLES `post_categories` WRITE;
/*!40000 ALTER TABLE `post_categories` DISABLE KEYS */;
INSERT INTO `post_categories` VALUES ('117bd649-80c0-4b43-8330-4d6b1219b254','Quần Áo','0','quan-ao','2022-08-30 05:46:45','2022-08-30 05:46:45'),('89368daf-8931-4d82-9b40-cce23047e50b','eddfs','0','eddfs','2022-09-01 22:11:00','2022-09-01 22:11:00');
/*!40000 ALTER TABLE `post_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_tag`
--

DROP TABLE IF EXISTS `post_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `post_tag` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `post_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_tag`
--

LOCK TABLES `post_tag` WRITE;
/*!40000 ALTER TABLE `post_tag` DISABLE KEYS */;
INSERT INTO `post_tag` VALUES (32,'06d8272d-d8d5-4997-ac6a-3033bc049392','10','2022-09-02 05:41:53','2022-09-02 05:41:53'),(33,'06d8272d-d8d5-4997-ac6a-3033bc049392','6','2022-09-02 05:41:53','2022-09-02 05:41:53');
/*!40000 ALTER TABLE `post_tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_tags`
--

DROP TABLE IF EXISTS `post_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `post_tags` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_tags`
--

LOCK TABLES `post_tags` WRITE;
/*!40000 ALTER TABLE `post_tags` DISABLE KEYS */;
INSERT INTO `post_tags` VALUES (6,'Quần Áo','quan-ao','2022-08-30 08:53:32','2022-08-30 08:53:32'),(10,'Sinh nhật bé','sinh-nhat-be','2022-08-31 08:31:24','2022-08-31 08:31:24'),(11,'test 1','test-1','2022-09-02 03:54:23','2022-09-02 05:37:10');
/*!40000 ALTER TABLE `post_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categories_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `feature_image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `feature_image_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_show_home` int NOT NULL DEFAULT '0',
  `status` int NOT NULL DEFAULT '1',
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  UNIQUE KEY `posts_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES ('1fd42220-f0de-412d-8f9a-010b966aaace','sdaadsdsas','117bd649-80c0-4b43-8330-4d6b1219b254','<p><img alt=\"\" src=\"http://127.0.0.1:8000/storage/photos/5/gallery3.jpg\" style=\"height:183px; width:207px\" /></p>',5,'/storage/post/5/cc3e007d8fe7f33324b7b09a322d35e4.jpg','man-three.jpg','2022-10-04 06:21:31','2022-10-04 06:22:08','sdaadsdsas',0,1,'admin'),('57747d52-b846-4a9f-a9a9-726b5602cae8','fdsfdsfdfd','89368daf-8931-4d82-9b40-cce23047e50b','<p><img alt=\"\" src=\"http://127.0.0.1:8000/storage/photos/5/blog-three.jpg\" style=\"height:396px; width:866px\" /></p>',5,'/storage/post/5/8c0289f3d1a4a8d9098c285631aad68d.jpg','man-one.jpg','2022-10-10 06:16:16','2022-10-04 06:22:19','fdsfdsfdfd',0,1,'admin'),('9ba27815-c4b1-49f6-83d9-f39db52cb104','sdadssa','89368daf-8931-4d82-9b40-cce23047e50b','<p><img alt=\"blush\" src=\"http://cdn.ckeditor.com/4.19.1/full/plugins/smiley/images/embarrassed_smile.png\" style=\"height:23px; width:23px\" title=\"blush\" /><img alt=\"\" src=\"http://127.0.0.1:8000/storage/photos/5/blog-one.jpg\" style=\"height:398px; width:862px\" /></p>',5,'/storage/post/5/7c61405b047bb442ea3515bf100a219e.jpg','man-two.jpg','2022-10-04 05:59:00','2022-10-04 06:22:36','sdadssa',0,1,'admin');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_tag`
--

DROP TABLE IF EXISTS `product_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_tag` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_tag`
--

LOCK TABLES `product_tag` WRITE;
/*!40000 ALTER TABLE `product_tag` DISABLE KEYS */;
INSERT INTO `product_tag` VALUES (19,'d7ffb662-bf2b-4c63-aa6e-a26f91245bd9','1','2022-10-03 06:53:37','2022-10-03 06:53:37');
/*!40000 ALTER TABLE `product_tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_tags`
--

DROP TABLE IF EXISTS `product_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_tags` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_tags`
--

LOCK TABLES `product_tags` WRITE;
/*!40000 ALTER TABLE `product_tags` DISABLE KEYS */;
INSERT INTO `product_tags` VALUES (1,'product tag 2','product-tag-2','2022-09-02 05:29:15','2022-09-02 05:35:33'),(5,'product test','product-test','2022-09-02 05:40:06','2022-09-07 07:59:14');
/*!40000 ALTER TABLE `product_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categories_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `user_id` int NOT NULL,
  `feature_image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `feature_image_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_show_home` int NOT NULL DEFAULT '0',
  `status` int NOT NULL DEFAULT '1',
  `stock` int DEFAULT '1',
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `price` int DEFAULT '0',
  `choose_sale` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sale` int DEFAULT NULL,
  `sale_price` int DEFAULT NULL,
  `view_count` int NOT NULL DEFAULT '0',
  UNIQUE KEY `products_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES ('302d79ba-3775-49d9-b5d0-ec4fc56cb4ff','Giày nike','admin','21','<p><img alt=\"\" src=\"http://127.0.0.1:8000/storage/photos/5/nike-dunk-low-retro-white-black-1.jpg\" style=\"height:600px; width:600px\" /></p>',5,'/storage/products/5/61f26540f0bac6c4b6f3547676179af2.jpg','nike-dunk-low-retro-white-black-1.jpg',1,1,10,'giay-nike','2022-09-30 22:54:07','2022-09-30 22:57:07',2000000,NULL,NULL,2000000,0),('440ccca3-c772-4c7b-a7b5-564528b0fb73','san pham 2','admin','32',NULL,5,'/storage/products/5/a541a1ab1886bdee8934daae16c04a34.jpg','product8.jpg',1,1,NULL,'san-pham-2','2022-09-30 07:29:46','2022-09-30 22:43:11',500000,NULL,NULL,500000,0),('4cfba3cf-1d0d-4b57-bae5-ca111f1721ba','san pham 4','admin','32',NULL,5,'/storage/products/5/7fe9dccef55449fb7902f2f6cc259a37.jpg','product11.jpg',1,1,2,'san-pham-4','2022-09-30 06:48:55','2022-09-30 22:43:22',500000,'sale_price',50000,450000,0),('92fc6e67-9aab-4789-b312-a0230a06dd9e','Túi xách micheal kors','admin','36','<p><img alt=\"\" src=\"http://127.0.0.1:8000/storage/photos/5/Michael-Kors-co-tuoi-doi-kha-non-tre-trong-gioi-thoi-trang.jpg\" style=\"height:640px; width:640px\" /></p>',5,'/storage/products/5/3d649ef95f96541f05fffee9f53364f4.jpg','Michael-Kors-co-tuoi-doi-kha-non-tre-trong-gioi-thoi-trang.jpg',1,1,2,'tui-xach-micheal-kors','2022-09-30 22:56:45','2022-09-30 22:56:49',10000000,NULL,NULL,10000000,0),('a347294e-e4f1-4c6c-9591-da653718f623','san pham 3','admin','32',NULL,5,'/storage/products/5/c1559ab6c88a0427e333468a52ea132e.jpg','product10.jpg',1,1,NULL,'san-pham-3','2022-09-27 07:29:02','2022-09-30 22:43:29',250000,'sale_persent',20,200000,0),('d7ffb662-bf2b-4c63-aa6e-a26f91245bd9','Giày người nhện','admin','35','<p style=\"text-align:center\"><img alt=\"\" src=\"http://127.0.0.1:8000/storage/photos/5/GUEST_1f4378dc-3a47-4128-9569-d535af7ba386.jpg\" style=\"height:400px; width:400px\" /></p>\r\n\r\n<p style=\"text-align:center\">askjdgiuasghdoiasgidusagdiusg</p>',5,'/storage/products/5/b71e40a049f38f397594d5246b153e68.jpg','GUEST_1f4378dc-3a47-4128-9569-d535af7ba386.jpg',1,1,10,'giay-nguoi-nhen','2022-09-30 22:55:32','2022-10-03 06:42:17',500000,NULL,NULL,500000,0),('ea6a5c5f-b598-4ec5-965e-1ad1197b8995','sản phẩm 5','admin','20',NULL,5,'/storage/products/5/3f7ebc685becd6fe0cd72e61adceeefa.jpg','product12.jpg',1,1,2,'san-pham-5','2022-09-27 06:48:39','2022-09-30 22:43:39',250000,'sale_price',20000,230000,5),('ed88c052-923a-49a7-81cf-acb8498d29ef','san pham 6','admin','20',NULL,5,'/storage/products/5/7e538b3634318febaf20b4f0c43430bc.jpg','gallery3.jpg',1,1,20,'san-pham-6','2022-09-30 21:05:46','2022-09-30 22:42:48',2000000,NULL,NULL,2000000,0),('ede0ad49-7f6b-49ab-96c9-622e54c7dfec','sản phẩm 1','admin','20',NULL,5,'/storage/products/5/7fe9dccef55449fb7902f2f6cc259a37.jpg','product11.jpg',1,1,20,'san-pham-1','2022-09-27 06:47:47','2022-09-30 22:44:16',500000,'sale_persent',15,425000,2);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_images`
--

DROP TABLE IF EXISTS `products_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products_images` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `src` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  UNIQUE KEY `products_images_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_images`
--

LOCK TABLES `products_images` WRITE;
/*!40000 ALTER TABLE `products_images` DISABLE KEYS */;
INSERT INTO `products_images` VALUES ('08158a8d-e90b-4587-8130-bc87cc11b614','/storage/products/5/7664ab0b819c87d85d6584b899e213aa.jpg','product9.jpg','440ccca3-c772-4c7b-a7b5-564528b0fb73','2022-09-29 07:00:11','2022-09-29 07:00:11'),('39d912c6-3672-4979-8b38-bc3a5f6cc2a8','/storage/products/5/a541a1ab1886bdee8934daae16c04a34.jpg','product8.jpg','a347294e-e4f1-4c6c-9591-da653718f623','2022-09-29 07:00:25','2022-09-29 07:00:25'),('4c1b7973-2c35-4107-a12a-434b17505769','/storage/products/5/b71e40a049f38f397594d5246b153e68.jpg','GUEST_1f4378dc-3a47-4128-9569-d535af7ba386.jpg','d7ffb662-bf2b-4c63-aa6e-a26f91245bd9','2022-09-30 22:55:32','2022-09-30 22:55:32'),('5bce5f74-026b-4985-bb09-509aedb43fc8','/storage/products/5/b602e370d365f2ea954368469cbc8d7c.jpg','content_popup2.jpg','ed88c052-923a-49a7-81cf-acb8498d29ef','2022-09-30 21:05:46','2022-09-30 21:05:46'),('5bff1fdc-aab7-4cb6-b002-70899568083c','/storage/products/5/c1559ab6c88a0427e333468a52ea132e.jpg','product10.jpg','a347294e-e4f1-4c6c-9591-da653718f623','2022-09-29 07:00:25','2022-09-29 07:00:25'),('64013076-67e7-477f-add8-c4efb9101f4b','/storage/products/5/61f26540f0bac6c4b6f3547676179af2.jpg','nike-dunk-low-retro-white-black-1.jpg','302d79ba-3775-49d9-b5d0-ec4fc56cb4ff','2022-09-30 22:54:07','2022-09-30 22:54:07'),('7b9eb95d-8631-4e2d-9b62-86f8adca1e9f','/storage/products/5/a541a1ab1886bdee8934daae16c04a34.jpg','product8.jpg','4cfba3cf-1d0d-4b57-bae5-ca111f1721ba','2022-09-29 07:00:36','2022-09-29 07:00:36'),('7e219590-3499-418f-99dd-bda0ceb24e6a','/storage/products/5/b976c5dd8df17e869d22297f67f4e018.jpg','product7.jpg','a347294e-e4f1-4c6c-9591-da653718f623','2022-09-29 07:00:25','2022-09-29 07:00:25'),('9181f21c-f331-49cd-95d4-e742b21ed983','/storage/products/5/7fe9dccef55449fb7902f2f6cc259a37.jpg','product11.jpg','440ccca3-c772-4c7b-a7b5-564528b0fb73','2022-09-29 07:00:11','2022-09-29 07:00:11'),('a2d29400-935e-4902-9071-fa2be23c1f0b','/storage/products/5/eee85d6257f47357acdbb81b3323685a.jpg','content_popup1.jpg','ed88c052-923a-49a7-81cf-acb8498d29ef','2022-09-30 21:05:46','2022-09-30 21:05:46'),('be94325b-c407-4ca2-8fee-5e1ae7d3eca8','/storage/products/5/7f2126490d695eeb0f45d825b055aadc.jpg','content_popup2 - Copy.jpg','ed88c052-923a-49a7-81cf-acb8498d29ef','2022-09-30 21:05:46','2022-09-30 21:05:46'),('c91fb52a-a0d1-4d8c-b57c-4b0af1048f46','/storage/products/5/3d649ef95f96541f05fffee9f53364f4.jpg','Michael-Kors-co-tuoi-doi-kha-non-tre-trong-gioi-thoi-trang.jpg','92fc6e67-9aab-4789-b312-a0230a06dd9e','2022-09-30 22:56:45','2022-09-30 22:56:45'),('d7b51afc-7945-4831-ad27-5aee2246c3a4','/storage/products/5/7664ab0b819c87d85d6584b899e213aa.jpg','product9.jpg','a347294e-e4f1-4c6c-9591-da653718f623','2022-09-29 07:00:25','2022-09-29 07:00:25'),('dbf78207-0d05-4bce-9159-51eab745db2f','/storage/products/5/3f7ebc685becd6fe0cd72e61adceeefa.jpg','product12.jpg','ea6a5c5f-b598-4ec5-965e-1ad1197b8995','2022-09-29 07:00:48','2022-09-29 07:00:48'),('dcf0f828-40a0-48f8-92d9-6c1ee68084cf','/storage/products/5/b976c5dd8df17e869d22297f67f4e018.jpg','product7.jpg','4cfba3cf-1d0d-4b57-bae5-ca111f1721ba','2022-09-29 07:00:36','2022-09-29 07:00:36'),('ee5159ad-8151-4a84-b3f0-2d6e7a2f30ee','/storage/products/5/7fe9dccef55449fb7902f2f6cc259a37.jpg','product11.jpg','4cfba3cf-1d0d-4b57-bae5-ca111f1721ba','2022-09-29 07:00:36','2022-09-29 07:00:36');
/*!40000 ALTER TABLE `products_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_customers`
--

DROP TABLE IF EXISTS `role_customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_customers` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  UNIQUE KEY `role_customers_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_customers`
--

LOCK TABLES `role_customers` WRITE;
/*!40000 ALTER TABLE `role_customers` DISABLE KEYS */;
INSERT INTO `role_customers` VALUES ('450bc12f-60f4-441c-986f-4395368defd3','super_vip','2022-09-23 19:58:04','2022-09-23 19:58:04'),('90116c67-a283-4c16-9e3c-a0422b918a2c','vip','2022-09-23 19:58:14','2022-09-23 19:58:14'),('a1030c95-3287-47f0-8f02-6654117674f3','normal','2022-09-23 04:50:00','2022-09-23 04:50:00');
/*!40000 ALTER TABLE `role_customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','Admin','2022-08-22 07:34:47','2022-08-22 07:34:47'),(6,'content','Content','2022-08-25 05:38:43','2022-08-25 05:38:43'),(7,'guest','Guest','2022-08-26 07:15:35','2022-08-26 07:15:35');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `services` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_show_home` int NOT NULL DEFAULT '0',
  `status` int NOT NULL DEFAULT '1',
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `feature_image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `feature_image_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  UNIQUE KEY `services_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES ('dc57edd9-5dd1-44e5-a4e7-31b8f5469acf','dịch vụ 1','<p style=\"text-align:center\"><img alt=\"\" src=\"http://127.0.0.1:8000/storage/photos/5/blog-one.jpg\" style=\"height:398px; width:862px\" /></p>\r\n\r\n<p style=\"text-align:center\">dich vu 1</p>',5,'admin',0,1,'dich-vu-1','/storage/post/5/eea67c62ee461e68b9078763d9ba0df0.jpg','product1.jpg','2022-09-30 03:56:33','2022-10-03 07:14:03'),('f9b63db6-4107-4238-9730-ee4c59055a92','dịch vụ 2','<p style=\"text-align:center\"><img alt=\"\" src=\"http://127.0.0.1:8000/storage/photos/5/blog-three.jpg\" style=\"height:396px; width:866px\" /></p>\r\n\r\n<p style=\"text-align:center\">dịch vụ 2</p>',5,'admin',0,1,'dich-vu-2','/storage/post/5/3a26b16cb085c16a0aac34fa6e6d4189.png','pricing.png','2022-09-30 03:56:46','2022-10-03 07:13:36');
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings_pages`
--

DROP TABLE IF EXISTS `settings_pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings_pages` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `config_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `config_value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  UNIQUE KEY `settings_pages_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings_pages`
--

LOCK TABLES `settings_pages` WRITE;
/*!40000 ALTER TABLE `settings_pages` DISABLE KEYS */;
INSERT INTO `settings_pages` VALUES ('0d1b62a4-c392-4512-94a9-06ed851d8b60','map_config','<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.426992121133!2d106.62933631534338!3d10.855092260703685!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752a272982c30d%3A0xa43cae54d7f69a48!2sNexcel%20Solutions!5e0!3m2!1svi!2s!4v1664605135147!5m2!1svi!2s\" width=\"100%\" height=\"200\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>',5,'admin','2022-09-30 23:19:17','2022-09-30 23:57:58','Textarea'),('20759ff8-8920-4605-bc79-355c94a250c1','email_config','nguyentrongminhman95@gmail.com',5,'admin','2022-09-30 23:07:58','2022-09-30 23:07:58','Text'),('503efa43-12e9-45f0-914b-eb27cc1be52c','contact_config','<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.426992121133!2d106.62933631534338!3d10.855092260703685!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752a272982c30d%3A0xa43cae54d7f69a48!2sNexcel%20Solutions!5e0!3m2!1svi!2s!4v1664605135147!5m2!1svi!2s\" width=\"100%\" height=\"400\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>',5,'admin','2022-10-03 07:30:31','2022-10-03 07:31:58','Textarea'),('5fbdafcf-d55b-48a5-8338-e1d2be791c23','youtube_config','https://www.youtube.com/',5,'admin','2022-09-21 08:28:18','2022-09-21 08:49:14','Text'),('76ac240d-5bdb-4c19-80fb-03dc4d88998f','logo_footer_config','/storage/setings_page/5/c4b0d0e25e021c8acdd4f5d686ce68ea.svg',5,'admin','2022-09-30 23:17:29','2022-09-30 23:17:29','Image'),('a17956b6-e85a-4409-b103-f63398d6cb8b','address_config','Thái hòa - Tân uyên - Bình dương',5,'admin','2022-10-04 06:30:40','2022-10-04 06:30:40','Text'),('aff85517-c9fc-4928-b680-c40ea00d7d44','phone_config','0908096448',5,'admin','2022-09-30 23:07:26','2022-09-30 23:07:41','Text'),('e1f582ce-c1b6-41b2-85c0-d1c606e15643','logo_config','/storage/setings_page/5/1bb87d41d15fe27b500a4bfcde01bb0e.png',5,'admin','2022-09-21 08:41:58','2022-09-30 05:42:36','Image'),('f8afae7e-4f0b-4f5d-9067-426ccaac2547','facebook_config','https://www.facebook.com/',5,'admin','2022-09-21 07:43:57','2022-09-21 07:43:57','Text');
/*!40000 ALTER TABLE `settings_pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sliders`
--

DROP TABLE IF EXISTS `sliders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sliders` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  UNIQUE KEY `sliders_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sliders`
--

LOCK TABLES `sliders` WRITE;
/*!40000 ALTER TABLE `sliders` DISABLE KEYS */;
INSERT INTO `sliders` VALUES ('0e7fd371-9f1f-4d0c-b21c-3cebd798199e','Free E-Commerce Template','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',5,'/storage/slider/5/08d51bd73497e2bfd92890173950b88a.jpg','girl1.jpg','2022-09-30 06:32:13','2022-09-30 06:32:13','admin'),('7e45186b-47be-4950-bacb-aa1fa74ac7ea','Free Ecommerce Template','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',5,'/storage/slider/5/3e936ca316b5a3813bd79c2339d10307.jpg','girl3.jpg','2022-09-30 06:31:59','2022-09-30 06:31:59','admin'),('aa5d26f7-330a-48b7-a30a-03bf7b6d64c2','100% Responsive Design','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',5,'/storage/slider/5/d1067c91f381e0f25ee9b36500ca9c03.jpg','girl2.jpg','2022-09-30 06:31:35','2022-09-30 06:32:22','admin');
/*!40000 ALTER TABLE `sliders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_avatars`
--

DROP TABLE IF EXISTS `user_avatars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_avatars` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `src` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_avatars`
--

LOCK TABLES `user_avatars` WRITE;
/*!40000 ALTER TABLE `user_avatars` DISABLE KEYS */;
INSERT INTO `user_avatars` VALUES (10,'/storage/avartars/7/799bad5a3b514f096e69bbc4a7896cd9.jpg','3.jpg','7','2022-09-20 08:29:51','2022-09-20 08:29:51'),(11,'/storage/avartars/4/8df7b73a7820f4aef47864f2a6c5fccf.jpg','12.jpg','4','2022-09-20 08:33:10','2022-09-20 08:33:10'),(20,'/storage/avartars/8/ab4568a0a8d7987984be59cee93423f9.jpg','1450856212ca phe rang xay.jpg','8','2022-09-20 10:36:01','2022-09-20 10:36:01'),(21,'/storage/avartars/5/b06873260a7ff1a6c3e4fdf639f1e4ae.jpg','tokuda.jpg','5','2022-09-20 10:37:04','2022-09-20 10:37:04');
/*!40000 ALTER TABLE `user_avatars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `password_dehash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (4,'guest','guest@gmail.com',NULL,'$2y$10$W3niPQYbAASfsB6qgt./6.3tWmoGXN34Vs7w8cn/HbPuA5UuyTikq',NULL,'2022-08-26 08:27:11','2022-09-20 08:33:10','minhman'),(5,'admin','admin@gmail.com',NULL,'$2y$10$pWN7a03JOCkzzlPK19xkdOun1t7ugdE47.cjE82jcK3inTdbSfM8u','H7tGuDK5v8SjdHa2Gs3v0IQ9LV1i1lGzZX7g6CSQFS8hdAXLVfVQlrjmqQUe','2022-08-26 20:17:50','2022-09-20 10:37:04','minhman'),(7,'test','man@gmail.com',NULL,'$2y$10$5hFGXJDKe4aLo836cmOwYOEOuWimbOLC/dARerUC0Vu3A6Ov.IFxa',NULL,'2022-09-20 07:42:12','2022-09-20 08:35:21','minhman'),(8,'test nguyen','quangthanhliet@gmail.com',NULL,'$2y$10$qi/52OHb7iOFXp2uo4AbhOHPbE5Gqeg6gCLZIdGfm29QJNALJL7Je',NULL,'2022-09-20 08:38:31','2022-09-23 05:06:21','minhman');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_role`
--

DROP TABLE IF EXISTS `users_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users_role` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `role_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_role`
--

LOCK TABLES `users_role` WRITE;
/*!40000 ALTER TABLE `users_role` DISABLE KEYS */;
INSERT INTO `users_role` VALUES (2,3,6,NULL,NULL),(5,6,6,NULL,NULL),(6,7,6,NULL,NULL),(7,1,1,NULL,NULL),(9,8,1,NULL,NULL),(11,2,7,NULL,NULL),(12,3,1,NULL,NULL),(14,5,1,NULL,NULL),(16,4,7,NULL,NULL),(17,6,6,NULL,NULL),(18,7,7,NULL,NULL),(19,8,7,NULL,NULL);
/*!40000 ALTER TABLE `users_role` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-10-07 20:04:24
