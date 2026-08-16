
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
DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admins` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'super_admin',
  `permissions` json DEFAULT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'Miswan Super Admin','admin@miswanfashion.com','+8801700000001','$2y$12$dr.Sb8YLHAMrruweLfniu.akLy6YsqhKqiBcyWPG9E9c.XgH2Y8W2','super_admin',NULL,NULL,1,NULL,'2026-08-15 14:27:10','2026-08-15 14:27:10');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `banners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `banners` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_id` bigint unsigned DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `banners_product_id_foreign` (`product_id`),
  CONSTRAINT `banners_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `banners` WRITE;
/*!40000 ALTER TABLE `banners` DISABLE KEYS */;
INSERT INTO `banners` VALUES (1,'Promo Card 1',NULL,'middle_banner','/product-category/man-fashion',NULL,NULL,'/uploads/image_directory/banner_image/2f432beec3-2026-02-22.jpeg',1,'2026-08-15 14:27:10','2026-08-15 14:27:10'),(2,'Promo Card 2',NULL,'middle_banner','/product-category/fashion-women',NULL,NULL,'/uploads/image_directory/banner_image/ead3cd2e4d-2026-02-22.jpg',1,'2026-08-15 14:27:10','2026-08-15 14:27:10');
/*!40000 ALTER TABLE `banners` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `priority` int NOT NULL DEFAULT '0',
  `is_featured` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Perfume','perfume','/uploads/category_image/cat_img958a5d386c-2026-02-23.jpg',NULL,NULL,NULL,1,1,1,'2026-08-15 14:27:10','2026-08-15 14:27:10'),(2,'Jewellery','jewellery','/uploads/category_image/cat_img05797dce33-2026-02-23.webp',NULL,NULL,NULL,2,1,1,'2026-08-15 14:27:10','2026-08-15 14:27:10'),(3,'Fashion','fashion-women','/uploads/category_image/cat_imge39cb94793-2025-12-03.jpg',NULL,NULL,NULL,3,1,1,'2026-08-15 14:27:10','2026-08-15 14:27:10'),(4,'Chocolates','choco-lates','/uploads/category_image/cat_imge70f7ac4e9-2026-02-23.webp',NULL,NULL,NULL,4,1,1,'2026-08-15 14:27:10','2026-08-15 14:27:10'),(5,'Sharee','shar-ee','/uploads/category_image/cat_img31b7e998c2-2026-02-23.jpg',NULL,NULL,NULL,5,1,1,'2026-08-15 14:27:10','2026-08-15 14:27:10'),(6,'Man Fashion','man-fashion','/uploads/category_image/cat_imgfb98d10171-2026-02-23.jpg',NULL,NULL,NULL,6,1,1,'2026-08-15 14:27:10','2026-08-15 14:27:10'),(7,'Formal Shirt','formal-shirt','/uploads/category_image/cat_imga7ab9a34a6-2026-05-04.webp',NULL,NULL,NULL,7,1,1,'2026-08-15 14:27:10','2026-08-15 14:27:10');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `coupons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coupons` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'fixed',
  `value` decimal(10,2) NOT NULL,
  `min_purchase` decimal(10,2) NOT NULL DEFAULT '0.00',
  `start_date` date DEFAULT NULL,
  `expire_date` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `coupons_code_unique` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `coupons` WRITE;
/*!40000 ALTER TABLE `coupons` DISABLE KEYS */;
/*!40000 ALTER TABLE `coupons` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `districts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `districts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bn_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_cost` decimal(10,2) NOT NULL DEFAULT '100.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `districts` WRITE;
/*!40000 ALTER TABLE `districts` DISABLE KEYS */;
INSERT INTO `districts` VALUES (1,'Dhaka','ঢাকা',60.00,'2026-08-15 14:27:10','2026-08-15 14:27:10'),(2,'Chattogram','চট্টগ্রাম',120.00,'2026-08-15 14:27:10','2026-08-15 14:27:10'),(3,'Sylhet','সিলেট',120.00,'2026-08-15 14:27:10','2026-08-15 14:27:10'),(4,'Rajshahi','রাজশাহী',120.00,'2026-08-15 14:27:10','2026-08-15 14:27:10'),(5,'Khulna','খুলনা',120.00,'2026-08-15 14:27:10','2026-08-15 14:27:10'),(6,'Barishal','বরিশাল',120.00,'2026-08-15 14:27:10','2026-08-15 14:27:10'),(7,'Rangpur','রংপুর',120.00,'2026-08-15 14:27:10','2026-08-15 14:27:10'),(8,'Mymensingh','ময়মনসিংহ',120.00,'2026-08-15 14:27:10','2026-08-15 14:27:10'),(9,'Gazipur','গাজীপুর',80.00,'2026-08-15 14:27:10','2026-08-15 14:27:10'),(10,'Narayanganj','নারায়ণগঞ্জ',80.00,'2026-08-15 14:27:10','2026-08-15 14:27:10'),(11,'Cumilla','কুমিল্লা',120.00,'2026-08-15 14:27:10','2026-08-15 14:27:10'),(12,'Bogura','বগুড়া',120.00,'2026-08-15 14:27:10','2026-08-15 14:27:10');
/*!40000 ALTER TABLE `districts` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2026_01_01_000001_create_users_table',1),(2,'2026_01_01_000002_create_admins_table',1),(3,'2026_01_01_000003_create_categories_table',1),(4,'2026_01_01_000004_create_sub_categories_table',1),(5,'2026_01_01_000005_create_products_table',1),(6,'2026_01_01_000006_create_product_galleries_table',1),(7,'2026_01_01_000007_create_product_attributes_and_variants_tables',1),(8,'2026_01_01_000008_create_orders_and_order_items_tables',1),(9,'2026_01_01_000009_create_banners_and_sliders_tables',1),(10,'2026_01_01_000010_create_coupons_districts_settings_tables',1),(11,'2026_08_16_160820_add_colors_to_products_table',2),(12,'2026_08_16_175800_add_product_id_to_sliders_and_banners_tables',2),(13,'2026_08_16_181000_add_permissions_to_admins_table',3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned DEFAULT NULL,
  `variant_id` bigint unsigned DEFAULT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `variant_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `subtotal` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_items_order_id_foreign` (`order_id`),
  KEY `order_items_product_id_foreign` (`product_id`),
  KEY `order_items_variant_id_foreign` (`variant_id`),
  CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL,
  CONSTRAINT `order_items_variant_id_foreign` FOREIGN KEY (`variant_id`) REFERENCES `product_variants` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `customer_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `upazila` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `shipping_cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `discount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `grand_total` decimal(10,2) NOT NULL,
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Cash on Delivery',
  `payment_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `order_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `order_notes` text COLLATE utf8mb4_unicode_ci,
  `transaction_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orders_order_number_unique` (`order_number`),
  KEY `orders_user_id_foreign` (`user_id`),
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pages_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,'About Us','About-Us-2','<h3>About Miswan Fashion</h3><p>Miswan Fashion is one of the leading lifestyle and fashion e-commerce platforms in Bangladesh, delivering premium quality apparel, fragrances, and accessories directly to your doorstep with guaranteed authenticity.</p>',1,'2026-08-15 14:27:10','2026-08-15 14:27:10'),(2,'Terms & Conditions','Terms-&-Conditions-4','<h3>Terms and Conditions</h3><p>Welcome to Miswan Fashion. By accessing and placing an order on our platform, you agree to our standard terms of service, delivery policies, and cash-on-delivery guidelines.</p>',1,'2026-08-15 14:27:10','2026-08-15 14:27:10'),(3,'Refund & Return Policy','Refund-&-Return-Policy-5','<h3>Return & Refund Policy</h3><p>We provide a 7-day hassle-free return policy if you receive a damaged, defective, or incorrect product. Please contact customer support with your invoice number to initiate a return.</p>',1,'2026-08-15 14:27:10','2026-08-15 14:27:10'),(4,'Privacy Policy','Privacy-Policy-3','<h3>Privacy Policy</h3><p>We respect your privacy and protect your personal data. We will never sell or share your contact numbers or addresses with third parties.</p>',1,'2026-08-15 14:27:10','2026-08-15 14:27:10');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `product_attribute_values`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_attribute_values` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `attribute_id` bigint unsigned NOT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_attribute_values_attribute_id_foreign` (`attribute_id`),
  CONSTRAINT `product_attribute_values_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `product_attributes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `product_attribute_values` WRITE;
/*!40000 ALTER TABLE `product_attribute_values` DISABLE KEYS */;
INSERT INTO `product_attribute_values` VALUES (1,1,'M (38)','2026-08-15 14:27:10','2026-08-15 14:27:10'),(2,1,'L (40)','2026-08-15 14:27:10','2026-08-15 14:27:10'),(3,1,'XL (42)','2026-08-15 14:27:10','2026-08-15 14:27:10'),(4,1,'XXL (44)','2026-08-15 14:27:10','2026-08-15 14:27:10'),(5,2,'M (38)','2026-08-15 14:27:10','2026-08-15 14:27:10'),(6,2,'L (40)','2026-08-15 14:27:10','2026-08-15 14:27:10'),(7,2,'XL (42)','2026-08-15 14:27:10','2026-08-15 14:27:10'),(8,2,'XXL (44)','2026-08-15 14:27:10','2026-08-15 14:27:10'),(9,3,'M (38)','2026-08-15 14:27:10','2026-08-15 14:27:10'),(10,3,'L (40)','2026-08-15 14:27:10','2026-08-15 14:27:10'),(11,3,'XL (42)','2026-08-15 14:27:10','2026-08-15 14:27:10'),(12,3,'XXL (44)','2026-08-15 14:27:10','2026-08-15 14:27:10'),(13,4,'M (38)','2026-08-15 14:27:10','2026-08-15 14:27:10'),(14,4,'L (40)','2026-08-15 14:27:10','2026-08-15 14:27:10'),(15,4,'XL (42)','2026-08-15 14:27:10','2026-08-15 14:27:10'),(16,4,'XXL (44)','2026-08-15 14:27:10','2026-08-15 14:27:10'),(17,5,'M (38)','2026-08-15 14:27:10','2026-08-15 14:27:10'),(18,5,'L (40)','2026-08-15 14:27:10','2026-08-15 14:27:10'),(19,5,'XL (42)','2026-08-15 14:27:10','2026-08-15 14:27:10'),(20,5,'XXL (44)','2026-08-15 14:27:10','2026-08-15 14:27:10'),(21,6,'M (38)','2026-08-15 14:27:10','2026-08-15 14:27:10'),(22,6,'L (40)','2026-08-15 14:27:10','2026-08-15 14:27:10'),(23,6,'XL (42)','2026-08-15 14:27:10','2026-08-15 14:27:10'),(24,6,'XXL (44)','2026-08-15 14:27:10','2026-08-15 14:27:10');
/*!40000 ALTER TABLE `product_attribute_values` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `product_attributes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_attributes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_attributes_product_id_foreign` (`product_id`),
  CONSTRAINT `product_attributes_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `product_attributes` WRITE;
/*!40000 ALTER TABLE `product_attributes` DISABLE KEYS */;
INSERT INTO `product_attributes` VALUES (1,135,'Size','2026-08-15 14:27:10','2026-08-15 14:27:10'),(2,26,'Size','2026-08-15 14:27:10','2026-08-15 14:27:10'),(3,72,'Size','2026-08-15 14:27:10','2026-08-15 14:27:10'),(4,87,'Size','2026-08-15 14:27:10','2026-08-15 14:27:10'),(5,84,'Size','2026-08-15 14:27:10','2026-08-15 14:27:10'),(6,141,'Size','2026-08-15 14:27:10','2026-08-15 14:27:10');
/*!40000 ALTER TABLE `product_attributes` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `product_galleries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_galleries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_galleries_product_id_foreign` (`product_id`),
  CONSTRAINT `product_galleries_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `product_galleries` WRITE;
/*!40000 ALTER TABLE `product_galleries` DISABLE KEYS */;
INSERT INTO `product_galleries` VALUES (1,135,'/uploads/image_directory/product_image/1510192199-2026-05-14.webp','2026-08-15 14:27:10','2026-08-15 14:27:10'),(2,26,'/uploads/image_directory/product_image/94c8ab818d-2026-03-13.webp','2026-08-15 14:27:10','2026-08-15 14:27:10'),(3,72,'/uploads/image_directory/product_image/ba344ec300-2026-02-23.jpg','2026-08-15 14:27:10','2026-08-15 14:27:10'),(4,87,'/uploads/image_directory/product_image/8794df99b8-2026-05-02.webp','2026-08-15 14:27:10','2026-08-15 14:27:10'),(5,84,'/uploads/image_directory/product_image/0821823ca6-2025-12-24.png','2026-08-15 14:27:10','2026-08-15 14:27:10'),(6,82,'/uploads/image_directory/product_image/2b83726ac6-2026-02-16.jpg','2026-08-15 14:27:10','2026-08-15 14:27:10'),(7,141,'/uploads/image_directory/product_image/ad527e7051-2026-05-02.jpeg','2026-08-15 14:27:10','2026-08-15 14:27:10'),(8,114,'/uploads/image_directory/product_image/7f8ef60f2e-2026-08-07.jpeg','2026-08-15 14:27:10','2026-08-15 14:27:10');
/*!40000 ALTER TABLE `product_galleries` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `product_variants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_variants` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `variant_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `stock` int NOT NULL DEFAULT '50',
  `sku` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attr_info` json DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_variants_product_id_foreign` (`product_id`),
  CONSTRAINT `product_variants_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `product_variants` WRITE;
/*!40000 ALTER TABLE `product_variants` DISABLE KEYS */;
INSERT INTO `product_variants` VALUES (1,135,'M (38)',399.00,50,NULL,NULL,'{\"Size\": \"M (38)\"}',1,'2026-08-15 14:27:10','2026-08-15 14:27:10'),(2,135,'L (40)',399.00,50,NULL,NULL,'{\"Size\": \"L (40)\"}',1,'2026-08-15 14:27:10','2026-08-15 14:27:10'),(3,135,'XL (42)',399.00,50,NULL,NULL,'{\"Size\": \"XL (42)\"}',1,'2026-08-15 14:27:10','2026-08-15 14:27:10'),(4,135,'XXL (44)',399.00,50,NULL,NULL,'{\"Size\": \"XXL (44)\"}',1,'2026-08-15 14:27:10','2026-08-15 14:27:10'),(5,26,'M (38)',450.00,50,NULL,NULL,'{\"Size\": \"M (38)\"}',1,'2026-08-15 14:27:10','2026-08-15 14:27:10'),(6,26,'L (40)',450.00,50,NULL,NULL,'{\"Size\": \"L (40)\"}',1,'2026-08-15 14:27:10','2026-08-15 14:27:10'),(7,26,'XL (42)',450.00,50,NULL,NULL,'{\"Size\": \"XL (42)\"}',1,'2026-08-15 14:27:10','2026-08-15 14:27:10'),(8,26,'XXL (44)',450.00,50,NULL,NULL,'{\"Size\": \"XXL (44)\"}',1,'2026-08-15 14:27:10','2026-08-15 14:27:10'),(9,72,'M (38)',350.00,50,NULL,NULL,'{\"Size\": \"M (38)\"}',1,'2026-08-15 14:27:10','2026-08-15 14:27:10'),(10,72,'L (40)',350.00,50,NULL,NULL,'{\"Size\": \"L (40)\"}',1,'2026-08-15 14:27:10','2026-08-15 14:27:10'),(11,72,'XL (42)',350.00,50,NULL,NULL,'{\"Size\": \"XL (42)\"}',1,'2026-08-15 14:27:10','2026-08-15 14:27:10'),(12,72,'XXL (44)',350.00,50,NULL,NULL,'{\"Size\": \"XXL (44)\"}',1,'2026-08-15 14:27:10','2026-08-15 14:27:10'),(13,87,'M (38)',1250.00,50,NULL,NULL,'{\"Size\": \"M (38)\"}',1,'2026-08-15 14:27:10','2026-08-15 14:27:10'),(14,87,'L (40)',1250.00,50,NULL,NULL,'{\"Size\": \"L (40)\"}',1,'2026-08-15 14:27:10','2026-08-15 14:27:10'),(15,87,'XL (42)',1250.00,50,NULL,NULL,'{\"Size\": \"XL (42)\"}',1,'2026-08-15 14:27:10','2026-08-15 14:27:10'),(16,87,'XXL (44)',1250.00,50,NULL,NULL,'{\"Size\": \"XXL (44)\"}',1,'2026-08-15 14:27:10','2026-08-15 14:27:10'),(17,84,'M (38)',1850.00,50,NULL,NULL,'{\"Size\": \"M (38)\"}',1,'2026-08-15 14:27:10','2026-08-15 14:27:10'),(18,84,'L (40)',1850.00,50,NULL,NULL,'{\"Size\": \"L (40)\"}',1,'2026-08-15 14:27:10','2026-08-15 14:27:10'),(19,84,'XL (42)',1850.00,50,NULL,NULL,'{\"Size\": \"XL (42)\"}',1,'2026-08-15 14:27:10','2026-08-15 14:27:10'),(20,84,'XXL (44)',1850.00,50,NULL,NULL,'{\"Size\": \"XXL (44)\"}',1,'2026-08-15 14:27:10','2026-08-15 14:27:10'),(21,141,'M (38)',550.00,50,NULL,NULL,'{\"Size\": \"M (38)\"}',1,'2026-08-15 14:27:10','2026-08-15 14:27:10'),(22,141,'L (40)',550.00,50,NULL,NULL,'{\"Size\": \"L (40)\"}',1,'2026-08-15 14:27:10','2026-08-15 14:27:10'),(23,141,'XL (42)',550.00,50,NULL,NULL,'{\"Size\": \"XL (42)\"}',1,'2026-08-15 14:27:10','2026-08-15 14:27:10'),(24,141,'XXL (44)',550.00,50,NULL,NULL,'{\"Size\": \"XXL (44)\"}',1,'2026-08-15 14:27:10','2026-08-15 14:27:10');
/*!40000 ALTER TABLE `product_variants` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint unsigned DEFAULT NULL,
  `sub_category_id` bigint unsigned DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `previous_price` decimal(10,2) DEFAULT NULL,
  `discount_percent` int NOT NULL DEFAULT '0',
  `stock` int NOT NULL DEFAULT '100',
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `thumbnail` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `colors` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `is_bestseller` tinyint(1) NOT NULL DEFAULT '0',
  `is_hot` tinyint(1) NOT NULL DEFAULT '0',
  `is_new` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `views` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_slug_unique` (`slug`),
  UNIQUE KEY `products_sku_unique` (`sku`),
  KEY `products_category_id_foreign` (`category_id`),
  KEY `products_sub_category_id_foreign` (`sub_category_id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  CONSTRAINT `products_sub_category_id_foreign` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=142 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (26,6,NULL,'Slim Wallet','Slim-Wallet-26','MSW-WLT-26',450.00,950.00,53,520,'Genuine leather ultra-slim bifold wallet with RFID blocking and card slots.','Sleek and compact genuine leather wallet. Designed to easily slip into front and back pockets while accommodating all your cards and cash effortlessly.','/uploads/image_directory/product_image/94c8ab818d-2026-03-13.webp',NULL,NULL,1,1,0,1,1,0,'2026-08-15 14:27:10','2026-08-15 14:27:10'),(72,6,NULL,'T-Shirt (Rubber Printed)','T-Shirt-Rubber-Printed-72','MSW-TSH-72',350.00,750.00,53,340,'100% organic cotton drop-shoulder rubber printed t-shirt.','High quality 180+ GSM combed cotton with premium rubber print that will not crack or fade over washes.','/uploads/image_directory/product_image/ba344ec300-2026-02-23.jpg',NULL,NULL,1,1,1,1,1,0,'2026-08-15 14:27:10','2026-08-15 14:27:10'),(82,2,NULL,'ইন্ডিয়ান বেইলি পায়েল','Indian-Beli-Rupar-Payel-82','MSW-JWL-82',499.00,999.00,50,210,'Traditional silver plated bell anklet with intricate craftsmanship.','Handcrafted silver-tone payel with chime bells that produce a melodious sound. Non-tarnish protective coating.','/uploads/image_directory/product_image/2b83726ac6-2026-02-16.jpg',NULL,NULL,1,1,0,1,1,0,'2026-08-15 14:27:10','2026-08-15 14:27:10'),(84,5,NULL,'Black Elite Eligance Sharee','Black-Elite-Eligance-Sharee-84','MSW-SHR-84',1850.00,3500.00,47,85,'Exclusive designer silk sharee with zari border work.','Gorgeous party wear black silk sharee with detailed embroidery on aanchal and borders. Comes with matching unstitched blouse piece.','/uploads/image_directory/product_image/0821823ca6-2025-12-24.png',NULL,NULL,1,1,1,1,1,0,'2026-08-15 14:27:10','2026-08-15 14:27:10'),(87,6,NULL,'Man Watch-Olives (Premium)','Man-Watch-Olives-Premium-87','MSW-WTC-87',1250.00,2500.00,50,120,'Luxury analog quartz wrist watch for men with stainless steel strap.','Elegant Olives branded men watch crafted with high precision quartz movement, mineral glass lens, and waterproof casing.','/uploads/image_directory/product_image/8794df99b8-2026-05-02.webp',NULL,NULL,1,1,0,1,1,0,'2026-08-15 14:27:10','2026-08-15 14:27:10'),(114,1,NULL,'After You 30 ML 5 Flavour Set','After-You-30-ML-5-Flavour-Set-114','MSW-PRF-114',999.00,1999.00,50,95,'Luxury 5-in-1 French Eau De Parfum collection (30ml x 5 bottles).','Long-lasting premium perfume gift set containing 5 signature fragrances ranging from fresh citrus to woody oriental notes.','/uploads/image_directory/product_image/7f8ef60f2e-2026-08-07.jpeg',NULL,NULL,1,1,1,1,1,0,'2026-08-15 14:27:10','2026-08-15 14:27:10'),(135,6,NULL,'Pant Cut Premium Pajama','Pant-Cut-Premium-Pajama-135','MSW-PAJ-135',399.00,850.00,54,17439,'Premium quality cotton pant cut pajama with modern fitting and comfortable waist.','Premium Pant Cut Pajama made from 100% fine combed cotton. Features deep pockets, reinforced seams, and breathable fabric suitable for all seasons.','/uploads/image_directory/product_image/1510192199-2026-05-14.webp',NULL,NULL,1,1,1,1,1,2,'2026-08-15 14:27:10','2026-08-15 14:28:23'),(141,6,NULL,'Gentle Belt-Leather','Gentle-Belt-Leather-141','MSW-BLT-141',550.00,1100.00,50,180,'Premium top-grain cowhide leather belt with metallic automatic buckle.','Durable and formal leather belt crafted from selected full grain hide. Adjustable automatic buckle system for perfect fit.','/uploads/image_directory/product_image/ad527e7051-2026-05-02.jpeg',NULL,NULL,1,1,0,1,1,0,'2026-08-15 14:27:10','2026-08-15 14:27:10');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
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

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `site_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Miswan Fashion',
  `site_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Miswanfashion | Bangladesh’s Leading Fashion Brand',
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '+8801700000000',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'support@miswanfashion.com',
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Dhaka, Bangladesh',
  `currency_symbol` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'TK',
  `shipping_inside_city` decimal(10,2) NOT NULL DEFAULT '60.00',
  `shipping_outside_city` decimal(10,2) NOT NULL DEFAULT '120.00',
  `facebook_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `announcement_text` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'Sija World','Sija World | Bangladesh’s Leading Fashion Brand','https://www.sijaworld.com/core/public/storage/images/l4WGlogo.png','/uploads/image_directory/site/685ed7e04a0218.78429304.png','+8801700000000','support@miswanfashion.com','House #12, Road #5, Dhanmondi, Dhaka, Bangladesh','TK',60.00,120.00,'https://www.facebook.com/p/Miswan-Fashion-61550113106815/',NULL,NULL,'Upto 50% Discount on selected product. Ending Soon.','2026-08-15 14:27:10','2026-08-15 14:27:10');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `sliders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sliders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_id` bigint unsigned DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `button_text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sliders_product_id_foreign` (`product_id`),
  CONSTRAINT `sliders_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `sliders` WRITE;
/*!40000 ALTER TABLE `sliders` DISABLE KEYS */;
INSERT INTO `sliders` VALUES (1,'Ramadan Special Offer','Premium Wallets, Sunglasses & Watches','/product-category/man-fashion',NULL,'/uploads/image_directory/banner_image/2f432beec3-2026-02-22.jpeg',2,NULL,1,'2026-08-15 14:27:10','2026-08-15 14:45:26'),(2,'Men\'s Formal & Casual Fits','Premium Chinese Cotton Fabrics','/product-category/man-fashion',NULL,'/uploads/image_directory/banner_image/ead3cd2e4d-2026-02-22.jpg',3,NULL,1,'2026-08-15 14:27:10','2026-08-15 14:45:26'),(3,'Luxury Perfumes & Fragrances','Long Lasting French Fragrance Sets','/product-category/perfume',NULL,'/uploads/image_directory/banner_image/d63e0858df-2026-02-22.jpeg',4,NULL,1,'2026-08-15 14:27:10','2026-08-15 14:45:26'),(4,'Hot Summer Deal 50%-80% OFF','Exclusive Summer Collection','/product-category/fashion-women',NULL,'/uploads/image_directory/banner_image/3f82e680e88-2026-06-09.jpeg',1,NULL,1,'2026-08-15 14:45:26','2026-08-15 14:45:26');
/*!40000 ALTER TABLE `sliders` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `sub_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sub_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority` int NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sub_categories_slug_unique` (`slug`),
  KEY `sub_categories_category_id_foreign` (`category_id`),
  CONSTRAINT `sub_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `sub_categories` WRITE;
/*!40000 ALTER TABLE `sub_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `sub_categories` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `upazilas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `upazilas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `district_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bn_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `upazilas_district_id_foreign` (`district_id`),
  CONSTRAINT `upazilas_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `upazilas` WRITE;
/*!40000 ALTER TABLE `upazilas` DISABLE KEYS */;
INSERT INTO `upazilas` VALUES (1,1,'Dhaka Sadar','ঢাকা সদর','2026-08-15 14:27:10','2026-08-15 14:27:10'),(2,2,'Chattogram Sadar','চট্টগ্রাম সদর','2026-08-15 14:27:10','2026-08-15 14:27:10'),(3,3,'Sylhet Sadar','সিলেট সদর','2026-08-15 14:27:10','2026-08-15 14:27:10'),(4,4,'Rajshahi Sadar','রাজশাহী সদর','2026-08-15 14:27:10','2026-08-15 14:27:10'),(5,5,'Khulna Sadar','খুলনা সদর','2026-08-15 14:27:10','2026-08-15 14:27:10'),(6,6,'Barishal Sadar','বরিশাল সদর','2026-08-15 14:27:10','2026-08-15 14:27:10'),(7,7,'Rangpur Sadar','রংপুর সদর','2026-08-15 14:27:10','2026-08-15 14:27:10'),(8,8,'Mymensingh Sadar','ময়মনসিংহ সদর','2026-08-15 14:27:10','2026-08-15 14:27:10'),(9,9,'Gazipur Sadar','গাজীপুর সদর','2026-08-15 14:27:10','2026-08-15 14:27:10'),(10,10,'Narayanganj Sadar','নারায়ণগঞ্জ সদর','2026-08-15 14:27:10','2026-08-15 14:27:10'),(11,11,'Cumilla Sadar','কুমিল্লা সদর','2026-08-15 14:27:10','2026-08-15 14:27:10'),(12,12,'Bogura Sadar','বগুড়া সদর','2026-08-15 14:27:10','2026-08-15 14:27:10');
/*!40000 ALTER TABLE `upazilas` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `upazila` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_phone_unique` (`phone`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Demo Customer','01711112222','customer@example.com',NULL,'$2y$12$ptDY0BjhE6P1ONqwtPNSaOfGkxguvMZoPwCPKESDsnz/2UZmCl5yW','House 10, Road 4, Dhanmondi, Dhaka','Dhaka','Dhaka Sadar',NULL,1,NULL,'2026-08-15 14:27:10','2026-08-15 14:27:10');
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

