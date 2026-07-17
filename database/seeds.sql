SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE product_variants;
TRUNCATE TABLE products;
TRUNCATE TABLE categories;
SET FOREIGN_KEY_CHECKS = 1;
/*!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.11.8-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: pavitra_b2b
-- ------------------------------------------------------
-- Server version	10.11.8-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Dumping data for table `activity_logs`
--

LOCK TABLES `activity_logs` WRITE;
/*!40000 ALTER TABLE `activity_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `activity_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `api_clients`
--

LOCK TABLES `api_clients` WRITE;
/*!40000 ALTER TABLE `api_clients` DISABLE KEYS */;
/*!40000 ALTER TABLE `api_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `api_tokens`
--

LOCK TABLES `api_tokens` WRITE;
/*!40000 ALTER TABLE `api_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `api_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `attribute_values`
--

LOCK TABLES `attribute_values` WRITE;
/*!40000 ALTER TABLE `attribute_values` DISABLE KEYS */;
INSERT INTO `attribute_values` VALUES
(1,1,'Pure Silk'),
(2,1,'Soft Silk'),
(3,1,'Organza'),
(4,1,'Georgette'),
(5,1,'Chiffon'),
(6,1,'Cotton'),
(7,1,'Tissue'),
(8,1,'Linen'),
(9,2,'Wedding Wear'),
(10,2,'Party Wear'),
(11,2,'Festival Wear'),
(12,2,'Office Wear'),
(13,2,'Daily Wear'),
(14,2,'Reception Collection'),
(15,2,'Haldi Collection'),
(16,2,'Mehendi Collection'),
(17,2,'Sangeet Collection');
/*!40000 ALTER TABLE `attribute_values` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `audit_logs`
--

LOCK TABLES `audit_logs` WRITE;
/*!40000 ALTER TABLE `audit_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `audit_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `bank_accounts`
--

LOCK TABLES `bank_accounts` WRITE;
/*!40000 ALTER TABLE `bank_accounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `bank_accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `banks`
--

LOCK TABLES `banks` WRITE;
/*!40000 ALTER TABLE `banks` DISABLE KEYS */;
INSERT INTO `banks` VALUES
(1,'State Bank of India','SBI'),
(2,'HDFC Bank','HDFC'),
(3,'ICICI Bank','ICICI'),
(4,'Axis Bank','AXIS'),
(5,'Punjab National Bank','PNB');
/*!40000 ALTER TABLE `banks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `banner_positions`
--

LOCK TABLES `banner_positions` WRITE;
/*!40000 ALTER TABLE `banner_positions` DISABLE KEYS */;
/*!40000 ALTER TABLE `banner_positions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `banners`
--

LOCK TABLES `banners` WRITE;
/*!40000 ALTER TABLE `banners` DISABLE KEYS */;
/*!40000 ALTER TABLE `banners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `brands`
--

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `bulk_pricing`
--

LOCK TABLES `bulk_pricing` WRITE;
/*!40000 ALTER TABLE `bulk_pricing` DISABLE KEYS */;
/*!40000 ALTER TABLE `bulk_pricing` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `cart_items`
--

LOCK TABLES `cart_items` WRITE;
/*!40000 ALTER TABLE `cart_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `cart_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `carts`
--

LOCK TABLES `carts` WRITE;
/*!40000 ALTER TABLE `carts` DISABLE KEYS */;
INSERT INTO `carts` VALUES
(1,NULL,'30e48e08832d97a3e2261b0681c8a2dd','2026-07-08 10:09:10'),
(2,NULL,'5c74cb26cce6c485620b5f403b3dd31e','2026-07-08 10:12:24'),
(3,NULL,'0da4d58569d9a298b1600cbbb2eaf09b','2026-07-17 10:32:23');
/*!40000 ALTER TABLE `carts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES
(1,'Bandhej Sarees','bandhej-sarees','Explore our latest Bandhej Sarees collection.','/uploads/categories/default.png','2026-07-17 10:14:35'),
(2,'Banarasi Sarees','banarasi-sarees','Explore our latest Banarasi Sarees collection.','/uploads/categories/default.png','2026-07-17 10:14:35'),
(3,'Pittan Work Sarees','pittan-work-sarees','Explore our latest Pittan Work Sarees collection.','/uploads/categories/default.png','2026-07-17 10:14:35'),
(4,'Gota Patti Sarees','gota-patti-sarees','Explore our latest Gota Patti Sarees collection.','/uploads/categories/default.png','2026-07-17 10:14:35'),
(5,'Chunri Sarees','chunri-sarees','Explore our latest Chunri Sarees collection.','/uploads/categories/default.png','2026-07-17 10:14:35'),
(6,'Leheriya Sarees','leheriya-sarees','Explore our latest Leheriya Sarees collection.','/uploads/categories/default.png','2026-07-17 10:14:35'),
(7,'Organza Sarees','organza-sarees','Explore our latest Organza Sarees collection.','/uploads/categories/default.png','2026-07-17 10:14:35'),
(8,'Silk Sarees','silk-sarees','Explore our latest Silk Sarees collection.','/uploads/categories/default.png','2026-07-17 10:14:35'),
(9,'Georgette Sarees','georgette-sarees','Explore our latest Georgette Sarees collection.','/uploads/categories/default.png','2026-07-17 10:14:35'),
(10,'Chiffon Sarees','chiffon-sarees','Explore our latest Chiffon Sarees collection.','/uploads/categories/default.png','2026-07-17 10:14:35'),
(11,'Tissue Sarees','tissue-sarees','Explore our latest Tissue Sarees collection.','/uploads/categories/default.png','2026-07-17 10:14:35'),
(12,'Cotton Sarees','cotton-sarees','Explore our latest Cotton Sarees collection.','/uploads/categories/default.png','2026-07-17 10:14:35'),
(13,'Linen Sarees','linen-sarees','Explore our latest Linen Sarees collection.','/uploads/categories/default.png','2026-07-17 10:14:35'),
(14,'Printed Sarees','printed-sarees','Explore our latest Printed Sarees collection.','/uploads/categories/default.png','2026-07-17 10:14:35'),
(15,'Designer Sarees','designer-sarees','Explore our latest Designer Sarees collection.','/uploads/categories/default.png','2026-07-17 10:14:35'),
(16,'Party Wear Sarees','party-wear-sarees','Explore our latest Party Wear Sarees collection.','/uploads/categories/default.png','2026-07-17 10:14:35'),
(17,'Wedding Collection','wedding-collection','Explore our latest Wedding Collection collection.','/uploads/categories/default.png','2026-07-17 10:14:35'),
(18,'Bridal Sarees','bridal-sarees','Explore our latest Bridal Sarees collection.','/uploads/categories/default.png','2026-07-17 10:14:35'),
(19,'Festive Collection','festive-collection','Explore our latest Festive Collection collection.','/uploads/categories/default.png','2026-07-17 10:14:35'),
(20,'Handloom Sarees','handloom-sarees','Explore our latest Handloom Sarees collection.','/uploads/categories/default.png','2026-07-17 10:14:35');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `cms_blocks`
--

LOCK TABLES `cms_blocks` WRITE;
/*!40000 ALTER TABLE `cms_blocks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cms_blocks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `cms_pages`
--

LOCK TABLES `cms_pages` WRITE;
/*!40000 ALTER TABLE `cms_pages` DISABLE KEYS */;
INSERT INTO `cms_pages` VALUES
(1,'About Us','about-us','<h1>About Pavitra B2B</h1><p>Pavitra B2B is a premier handloom weaver-direct B2B wholesale marketplace, bridging the gap between local master weavers and boutique retailers nationwide. We preserve Indian textile heritage while offering competitive wholesale pricing, dynamic commission systems, and integrated logistics.</p>','About Us - Pavitra B2B Wholesale Saree Marketplace','Learn about Pavitra B2B Wholesale and how we bridge local master weavers and retailers.',1),
(2,'Contact Us','contact-us','<h1>Contact Pavitra Support</h1><p>Need support or assistance with wholesale orders, bulk weaver registration, or shipping status? Reach out to our 24/7 dedicated service desk.</p><ul><li><strong>Support Helpline:</strong> +91 9999999999</li><li><strong>WhatsApp Desk:</strong> +91 9999999999</li><li><strong>Email Address:</strong> wholesale@pavitra.com</li><li><strong>Registered Office:</strong> Varanasi Handloom Cluster, Uttar Pradesh, 221001</li></ul>','Contact Us - Pavitra B2B Support Desk','Get in touch with Pavitra B2B support desk for order tracking and weaver inquiries.',1),
(3,'Privacy Policy','privacy-policy','<h1>Privacy Policy</h1><p>Your privacy is important to us. Pavitra B2B ensures the protection of user accounts, KYC documents, wallet ledger entries, and transaction details with enterprise-grade encryption. We do not sell or share business credentials or financial transaction history with third parties.</p>','Privacy Policy - Pavitra B2B Compliance','Privacy Policy and data security guidelines for Pavitra B2B Wholesale Marketplace.',1),
(4,'Terms & Conditions','terms-conditions','<h1>Terms & Conditions</h1><p>By registering on Pavitra B2B, sellers (weavers), retailers (boutique buyers), and delivery riders agree to abide by our fair transaction guidelines. Wholesale prices apply only above MOQ thresholds. Settlements are disbursed on delivery completion, subject to commission rates and GST rules.</p>','Terms & Conditions - Pavitra B2B Merchant Agreement','Terms and conditions for buying and selling on Pavitra B2B marketplace.',1),
(5,'Refund Policy','refund-policy','<h1>Refund & Return Policy</h1><p>We want you to be completely satisfied with your handloom sarees. Retailers can request returns within 7 days of delivery. Upon seller approval and driver pickup verification, refunds are automatically credited back to the retailer\'s wallet ledger.</p>','Refund & Return Policy - Pavitra B2B','Refund and return guidelines for boutique buyers and weavers on Pavitra B2B.',1),
(6,'Shipping Policy','shipping-policy','<h1>Shipping & Logistics Policy</h1><p>Orders are dispatched by registered weavers within 24-48 hours of acceptance. Our logistics network assigns courier drivers with integrated routing and handover verification via secure 4-digit customer OTP codes.</p>','Shipping Policy - Pavitra B2B Courier Logistics','Shipping and logistics handbook for delivery partners and merchants.',1);
/*!40000 ALTER TABLE `cms_pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `commission_rules`
--

LOCK TABLES `commission_rules` WRITE;
/*!40000 ALTER TABLE `commission_rules` DISABLE KEYS */;
/*!40000 ALTER TABLE `commission_rules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `commissions`
--

LOCK TABLES `commissions` WRITE;
/*!40000 ALTER TABLE `commissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `commissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `coupon_usage`
--

LOCK TABLES `coupon_usage` WRITE;
/*!40000 ALTER TABLE `coupon_usage` DISABLE KEYS */;
/*!40000 ALTER TABLE `coupon_usage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `coupons`
--

LOCK TABLES `coupons` WRITE;
/*!40000 ALTER TABLE `coupons` DISABLE KEYS */;
INSERT INTO `coupons` VALUES
(1,'WELCOMB2B','FLAT',500.00,5000.00,'2026-01-01','2030-12-31',100,1),
(2,'FESTIVE10','PERCENTAGE',10.00,10000.00,'2026-01-01','2030-12-31',100,1);
/*!40000 ALTER TABLE `coupons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `credit_notes`
--

LOCK TABLES `credit_notes` WRITE;
/*!40000 ALTER TABLE `credit_notes` DISABLE KEYS */;
/*!40000 ALTER TABLE `credit_notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `debit_notes`
--

LOCK TABLES `debit_notes` WRITE;
/*!40000 ALTER TABLE `debit_notes` DISABLE KEYS */;
/*!40000 ALTER TABLE `debit_notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `delivery_assignments`
--

LOCK TABLES `delivery_assignments` WRITE;
/*!40000 ALTER TABLE `delivery_assignments` DISABLE KEYS */;
/*!40000 ALTER TABLE `delivery_assignments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `delivery_partner_profiles`
--

LOCK TABLES `delivery_partner_profiles` WRITE;
/*!40000 ALTER TABLE `delivery_partner_profiles` DISABLE KEYS */;
INSERT INTO `delivery_partner_profiles` VALUES
(1,4,'UP-65-AB-1234','Mini Van Truck',0.00,1,'2026-07-08 10:09:07','2026-07-08 10:09:07');
/*!40000 ALTER TABLE `delivery_partner_profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `delivery_proofs`
--

LOCK TABLES `delivery_proofs` WRITE;
/*!40000 ALTER TABLE `delivery_proofs` DISABLE KEYS */;
/*!40000 ALTER TABLE `delivery_proofs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `delivery_routes`
--

LOCK TABLES `delivery_routes` WRITE;
/*!40000 ALTER TABLE `delivery_routes` DISABLE KEYS */;
/*!40000 ALTER TABLE `delivery_routes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `email_logs`
--

LOCK TABLES `email_logs` WRITE;
/*!40000 ALTER TABLE `email_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `email_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `employee_profiles`
--

LOCK TABLES `employee_profiles` WRITE;
/*!40000 ALTER TABLE `employee_profiles` DISABLE KEYS */;
/*!40000 ALTER TABLE `employee_profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `error_logs`
--

LOCK TABLES `error_logs` WRITE;
/*!40000 ALTER TABLE `error_logs` DISABLE KEYS */;
INSERT INTO `error_logs` VALUES
(1,'Class \"App\\Core\\Application\" not found','/','C:\\Users\\YTANNU\\.gemini\\antigravity\\scratch\\meesho-b2b\\src\\Views\\layouts\\main.php',117,NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0','2026-07-17 11:16:21'),
(2,'Class \"App\\Core\\Application\" not found','/','C:\\Users\\YTANNU\\.gemini\\antigravity\\scratch\\meesho-b2b\\src\\Views\\layouts\\main.php',117,NULL,'127.0.0.1','Python-urllib/3.13','2026-07-17 11:26:24'),
(3,'Class \"App\\Core\\Application\" not found','/','C:\\Users\\YTANNU\\.gemini\\antigravity\\scratch\\meesho-b2b\\src\\Views\\layouts\\main.php',117,NULL,'127.0.0.1','Python-urllib/3.13','2026-07-17 11:26:47'),
(4,'Class \"App\\Core\\Application\" not found','','C:\\Users\\YTANNU\\.gemini\\antigravity\\scratch\\meesho-b2b\\src\\Views\\layouts\\main.php',117,NULL,'','','2026-07-17 11:27:43'),
(5,'syntax error, unexpected token \"}\", expecting \"elseif\" or \"else\" or \"endif\"','/','C:\\Users\\YTANNU\\.gemini\\antigravity\\scratch\\meesho-b2b\\src\\Views\\retailer\\catalog.php',63,NULL,'127.0.0.1','Python-urllib/3.13','2026-07-17 11:45:48');
/*!40000 ALTER TABLE `error_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `gst_rates`
--

LOCK TABLES `gst_rates` WRITE;
/*!40000 ALTER TABLE `gst_rates` DISABLE KEYS */;
INSERT INTO `gst_rates` VALUES
(1,'5007',5.00,'Woven fabrics of silk or of silk waste (Saree handloom rate)'),
(2,'5208',5.00,'Woven fabrics of cotton, containing 85% or more by weight of cotton'),
(3,'6214',12.00,'Shawls, scarves, mufflers, mantillas, veils and the like');
/*!40000 ALTER TABLE `gst_rates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `inventory`
--

LOCK TABLES `inventory` WRITE;
/*!40000 ALTER TABLE `inventory` DISABLE KEYS */;
/*!40000 ALTER TABLE `inventory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `inventory_logs`
--

LOCK TABLES `inventory_logs` WRITE;
/*!40000 ALTER TABLE `inventory_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `inventory_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `invoice_items`
--

LOCK TABLES `invoice_items` WRITE;
/*!40000 ALTER TABLE `invoice_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoice_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `invoices`
--

LOCK TABLES `invoices` WRITE;
/*!40000 ALTER TABLE `invoices` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `kyc_documents`
--

LOCK TABLES `kyc_documents` WRITE;
/*!40000 ALTER TABLE `kyc_documents` DISABLE KEYS */;
/*!40000 ALTER TABLE `kyc_documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `kyc_verifications`
--

LOCK TABLES `kyc_verifications` WRITE;
/*!40000 ALTER TABLE `kyc_verifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `kyc_verifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `notification_logs`
--

LOCK TABLES `notification_logs` WRITE;
/*!40000 ALTER TABLE `notification_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `notification_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `offer_products`
--

LOCK TABLES `offer_products` WRITE;
/*!40000 ALTER TABLE `offer_products` DISABLE KEYS */;
INSERT INTO `offer_products` VALUES
(1,1,1),
(2,1,2);
/*!40000 ALTER TABLE `offer_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `offers`
--

LOCK TABLES `offers` WRITE;
/*!40000 ALTER TABLE `offers` DISABLE KEYS */;
INSERT INTO `offers` VALUES
(1,'Varanasi Summer Flash Sale','FLASH_SALE',5.00,'2026-01-01 00:00:00','2030-12-31 23:59:59',1);
/*!40000 ALTER TABLE `offers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `order_items`
--

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `order_status_history`
--

LOCK TABLES `order_status_history` WRITE;
/*!40000 ALTER TABLE `order_status_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_status_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `order_tracking`
--

LOCK TABLES `order_tracking` WRITE;
/*!40000 ALTER TABLE `order_tracking` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_tracking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `payment_transactions`
--

LOCK TABLES `payment_transactions` WRITE;
/*!40000 ALTER TABLE `payment_transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment_transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES
(1,'manage_users','Ability to create, update, block users','2026-07-08 10:09:07'),
(2,'approve_sellers','Verify seller KYC and approve seller profiles','2026-07-08 10:09:07'),
(3,'approve_products','Review and approve catalog items','2026-07-08 10:09:07'),
(4,'manage_commissions','Setup category or seller specific B2B commission rules','2026-07-08 10:09:07'),
(5,'process_settlements','Trigger payouts to weavers and sellers','2026-07-08 10:09:07'),
(6,'manage_inventory','Adjust stock, manage multi-warehouse inventory','2026-07-08 10:09:07'),
(7,'place_orders','Browse products, manage cart, place wholesale orders','2026-07-08 10:09:07'),
(8,'deliver_shipments','Manage pickups, deliveries, and collect OTP/signature proofs','2026-07-08 10:09:07'),
(9,'view_reports','Access sales, tax, settlement, and platform reports','2026-07-08 10:09:07'),
(10,'system_settings','Edit brand, logo, and integration API credentials','2026-07-08 10:09:07');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `product_attributes`
--

LOCK TABLES `product_attributes` WRITE;
/*!40000 ALTER TABLE `product_attributes` DISABLE KEYS */;
INSERT INTO `product_attributes` VALUES
(1,'Fabric','SELECT'),
(2,'Occasion','SELECT');
/*!40000 ALTER TABLE `product_attributes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `product_documents`
--

LOCK TABLES `product_documents` WRITE;
/*!40000 ALTER TABLE `product_documents` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `product_images`
--

LOCK TABLES `product_images` WRITE;
/*!40000 ALTER TABLE `product_images` DISABLE KEYS */;
INSERT INTO `product_images` VALUES
(1,1,'/uploads/products/bandhej---2--jpg.jpg',0),
(2,2,'/uploads/products/bandhej---3--jpg.jpg',0),
(3,3,'/uploads/products/bandhej---4--jpg.jpg',0),
(4,4,'/uploads/products/bandhej---5--jpg.jpg',0),
(5,5,'/uploads/products/bandhej---6--jpg.jpg',0),
(6,6,'/uploads/products/bandhej---7--jpg.jpg',0),
(7,7,'/uploads/products/bandhej---8--jpg.jpg',0),
(8,8,'/uploads/products/bandhej---9--jpg.jpg',0),
(9,9,'/uploads/products/bandhej---10--jpg.jpg',0),
(10,10,'/uploads/products/bandhej---11--jpg.jpg',0),
(11,11,'/uploads/products/bandhej---12--jpg.jpg',0),
(12,12,'/uploads/products/bandhej---18--jpg.jpg',0),
(13,13,'/uploads/products/bandhej---19--jpg.jpg',0),
(14,14,'/uploads/products/bandhej---20--jpg.jpg',0),
(15,15,'/uploads/products/bandhej---21--jpg.jpg',0),
(16,16,'/uploads/products/bandhej---23--jpg.jpg',0),
(17,17,'/uploads/products/bandhej---24--jpg.jpg',0),
(18,18,'/uploads/products/bandhej---26--jpg.jpg',0),
(19,19,'/uploads/products/bandhej---27--jpg.jpg',0),
(20,20,'/uploads/products/bandhej---28--jpg.jpg',0),
(21,21,'/uploads/products/bandhej---30--jpg.jpg',0),
(22,22,'/uploads/products/bandhej---31--jpg.jpg',0),
(23,23,'/uploads/products/bandhej---33--jpg.jpg',0),
(24,24,'/uploads/products/bandhej---35--jpg.jpg',0),
(25,25,'/uploads/products/bandhej---36--jpg.jpg',0),
(26,26,'/uploads/products/bandhej--37--jpg.jpg',0),
(27,27,'/uploads/products/bandhej--38--jpg.jpg',0),
(28,28,'/uploads/products/bandhej--39--jpg.jpg',0),
(29,29,'/uploads/products/bandhej--40--jpg.jpg',0),
(30,30,'/uploads/products/bandhej--41--jpg.jpg',0),
(31,31,'/uploads/products/bandhej--42--jpg.jpg',0),
(32,32,'/uploads/products/bandhej--43--jpg.jpg',0),
(33,33,'/uploads/products/bandhej--44--jpg.jpg',0),
(34,34,'/uploads/products/bandhej---1--jpg.jpg',0),
(35,38,'/uploads/products/gotta-patti--58--jpg.jpg',0),
(36,39,'/uploads/products/gotta-patti--59--jpg.jpg',0),
(37,40,'/uploads/products/gotta-patti--60--jpg.jpg',0),
(38,41,'/uploads/products/gotta-patti--61--jpg.jpg',0),
(39,42,'/uploads/products/gotta-patti--62--jpg.jpg',0),
(40,43,'/uploads/products/gotta-patti--63--jpg.jpg',0),
(41,44,'/uploads/products/gotta-patti--64--jpg.jpg',0),
(42,45,'/uploads/products/gotta-patti--65--jpg.jpg',0),
(43,46,'/uploads/products/gotta-patti--66--jpg.jpg',0),
(44,47,'/uploads/products/gotta-patti--67--jpg.jpg',0),
(45,48,'/uploads/products/gotta-patti--68--jpg.jpg',0),
(46,49,'/uploads/products/gotta-patti--69--jpg.jpg',0),
(47,50,'/uploads/products/gotta-patti--70--jpg.jpg',0),
(48,51,'/uploads/products/gotta-patti--71--jpg.jpg',0),
(49,52,'/uploads/products/gotta-patti--72--jpg.jpg',0),
(50,53,'/uploads/products/gotta-patti--73--jpg.jpg',0),
(51,54,'/uploads/products/gotta-patti--74--jpg.jpg',0),
(52,55,'/uploads/products/gotta-patti--75--jpg.jpg',0),
(53,56,'/uploads/products/gotta-patti--76--jpg.jpg',0),
(54,57,'/uploads/products/gotta-patti--57--jpg.jpg',0),
(55,58,'/uploads/products/gotta-patti-bandhej---2--jpg.jpg',0),
(56,59,'/uploads/products/gotta-patti-bandhej---3--jpg.jpg',0),
(57,60,'/uploads/products/gotta-patti-bandhej---4--jpg.jpg',0),
(58,61,'/uploads/products/gotta-patti-bandhej---6--jpg.jpg',0),
(59,62,'/uploads/products/gotta-patti-bandhej---7--jpg.jpg',0),
(60,63,'/uploads/products/gotta-patti-bandhej---10--jpg.jpg',0),
(61,64,'/uploads/products/gotta-patti-bandhej---11--jpg.jpg',0),
(62,65,'/uploads/products/gotta-patti-bandhej---1--jpg.jpg',0),
(63,66,'/uploads/products/gotta-patti-chunri--2--jpg.jpg',0),
(64,67,'/uploads/products/gotta-patti-chunri--3--jpg.jpg',0),
(65,68,'/uploads/products/gotta-patti-chunri--4--jpg.jpg',0),
(66,69,'/uploads/products/gotta-patti-chunri--5--jpg.jpg',0),
(67,70,'/uploads/products/gotta-patti-chunri--6--jpg.jpg',0),
(68,71,'/uploads/products/gotta-patti-chunri--7--jpg.jpg',0),
(69,72,'/uploads/products/gotta-patti-chunri--8--jpg.jpg',0),
(70,73,'/uploads/products/gotta-patti-chunri--9--jpg.jpg',0),
(71,74,'/uploads/products/gotta-patti-chunri--12--jpg.jpg',0),
(72,75,'/uploads/products/gotta-patti-chunri--13--jpg.jpg',0),
(73,76,'/uploads/products/gotta-patti-chunri--14--jpg.jpg',0),
(74,77,'/uploads/products/gotta-patti-chunri--15--jpg.jpg',0),
(75,78,'/uploads/products/gotta-patti-chunri--16--jpg.jpg',0),
(76,79,'/uploads/products/gotta-patti-chunri--17--jpg.jpg',0),
(77,80,'/uploads/products/gotta-patti-chunri--18--jpg.jpg',0),
(78,81,'/uploads/products/gotta-patti-chunri--19--jpg.jpg',0),
(79,82,'/uploads/products/gotta-patti-chunri--20--jpg.jpg',0),
(80,83,'/uploads/products/gotta-patti-chunri--21--jpg.jpg',0),
(81,84,'/uploads/products/gotta-patti-chunri--22--jpg.jpg',0),
(82,85,'/uploads/products/gotta-patti-chunri--23--jpg.jpg',0),
(83,86,'/uploads/products/gotta-patti-chunri--24--jpg.jpg',0),
(84,87,'/uploads/products/gotta-patti-chunri--25--jpg.jpg',0),
(85,88,'/uploads/products/gotta-patti-chunri--26--jpg.jpg',0),
(86,89,'/uploads/products/gotta-patti-chunri--27--jpg.jpg',0),
(87,90,'/uploads/products/gotta-patti-chunri--28--jpg.jpg',0),
(88,91,'/uploads/products/gotta-patti-chunri--29--jpg.jpg',0),
(89,92,'/uploads/products/gotta-patti-chunri--30--jpg.jpg',0),
(90,93,'/uploads/products/gotta-patti-chunri--31--jpg.jpg',0),
(91,94,'/uploads/products/gotta-patti-chunri--32--jpg.jpg',0),
(92,95,'/uploads/products/gotta-patti-chunri--33--jpg.jpg',0),
(93,96,'/uploads/products/gotta-patti-chunri--34--jpg.jpg',0),
(94,97,'/uploads/products/gotta-patti-chunri--35--jpg.jpg',0),
(95,98,'/uploads/products/gotta-patti-chunri--36--jpg.jpg',0),
(96,99,'/uploads/products/gotta-patti-chunri--37--jpg.jpg',0),
(97,100,'/uploads/products/gotta-patti-chunri--38--jpg.jpg',0),
(98,101,'/uploads/products/gotta-patti-chunri--39--jpg.jpg',0),
(99,102,'/uploads/products/gotta-patti-chunri--40--jpg.jpg',0),
(100,103,'/uploads/products/gotta-patti-chunri--41--jpg.jpg',0),
(101,104,'/uploads/products/gotta-patti-chunri--42--jpg.jpg',0),
(102,105,'/uploads/products/gotta-patti-chunri--43--jpg.jpg',0),
(103,106,'/uploads/products/gotta-patti-chunri--44--jpg.jpg',0),
(104,107,'/uploads/products/gotta-patti-chunri--45--jpg.jpg',0),
(105,108,'/uploads/products/gotta-patti-chunri--46--jpg.jpg',0),
(106,109,'/uploads/products/gotta-patti-chunri--47--jpg.jpg',0),
(107,110,'/uploads/products/gotta-patti-chunri--48--jpg.jpg',0),
(108,111,'/uploads/products/gotta-patti-chunri--49--jpg.jpg',0),
(109,112,'/uploads/products/gotta-patti-chunri--50--jpg.jpg',0),
(110,113,'/uploads/products/gotta-patti-chunri--51--jpg.jpg',0),
(111,114,'/uploads/products/gotta-patti-chunri--52--jpg.jpg',0),
(112,115,'/uploads/products/gotta-patti-chunri--53--jpg.jpg',0),
(113,116,'/uploads/products/gotta-patti-chunri--54--jpg.jpg',0),
(114,117,'/uploads/products/gotta-patti-chunri--55--jpg.jpg',0),
(115,118,'/uploads/products/gotta-patti-chunri--56--jpg.jpg',0),
(116,119,'/uploads/products/gotta-patti-chunri--57--jpg.jpg',0),
(117,120,'/uploads/products/gotta-patti-chunri--58--jpg.jpg',0),
(118,121,'/uploads/products/gotta-patti-chunri--59--jpg.jpg',0),
(119,122,'/uploads/products/gotta-patti-chunri--60--jpg.jpg',0),
(120,123,'/uploads/products/gotta-patti-chunri--61--jpg.jpg',0),
(121,124,'/uploads/products/gotta-patti-chunri--62--jpg.jpg',0),
(122,125,'/uploads/products/gotta-patti-chunri--63--jpg.jpg',0),
(123,126,'/uploads/products/gotta-patti-chunri--64--jpg.jpg',0),
(124,127,'/uploads/products/gotta-patti-chunri--65--jpg.jpg',0),
(125,128,'/uploads/products/gotta-patti-chunri--66--jpg.jpg',0),
(126,129,'/uploads/products/gotta-patti-chunri--67--jpg.jpg',0),
(127,130,'/uploads/products/gotta-patti-chunri--68--jpg.jpg',0),
(128,131,'/uploads/products/gotta-patti-chunri--69--jpg.jpg',0),
(129,132,'/uploads/products/gotta-patti-chunri--70--jpg.jpg',0),
(130,133,'/uploads/products/gotta-patti-chunri--71--jpg.jpg',0),
(131,134,'/uploads/products/gotta-patti-chunri--72--jpg.jpg',0),
(132,135,'/uploads/products/gotta-patti-chunri--73--jpg.jpg',0),
(133,136,'/uploads/products/gotta-patti-chunri--74--jpg.jpg',0),
(134,137,'/uploads/products/gotta-patti-chunri--75--jpg.jpg',0),
(135,138,'/uploads/products/gotta-patti-chunri--76--jpg.jpg',0),
(136,139,'/uploads/products/gotta-patti-chunri--77--jpg.jpg',0),
(137,140,'/uploads/products/gotta-patti-chunri--78--jpg.jpg',0),
(138,141,'/uploads/products/gotta-patti-chunri--79--jpg.jpg',0),
(139,142,'/uploads/products/gotta-patti-chunri--80--jpg.jpg',0),
(140,143,'/uploads/products/gotta-patti-chunri--81--jpg.jpg',0),
(141,144,'/uploads/products/gotta-patti-chunri--82--jpg.jpg',0),
(142,145,'/uploads/products/gotta-patti-chunri--83--jpg.jpg',0),
(143,146,'/uploads/products/gotta-patti-chunri--84--jpg.jpg',0),
(144,147,'/uploads/products/gotta-patti-chunri--85--jpg.jpg',0),
(145,148,'/uploads/products/gotta-patti-chunri--86--jpg.jpg',0),
(146,149,'/uploads/products/gotta-patti-chunri--87--jpg.jpg',0),
(147,150,'/uploads/products/gotta-patti-chunri--88--jpg.jpg',0),
(148,151,'/uploads/products/gotta-patti-chunri--89--jpg.jpg',0),
(149,152,'/uploads/products/gotta-patti-chunri--90--jpg.jpg',0),
(150,153,'/uploads/products/gotta-patti-chunri--91--jpg.jpg',0),
(151,154,'/uploads/products/gotta-patti-chunri--92--jpg.jpg',0),
(152,155,'/uploads/products/gotta-patti-chunri--93--jpg.jpg',0),
(153,156,'/uploads/products/gotta-patti-chunri--94--jpg.jpg',0),
(154,157,'/uploads/products/gotta-patti-chunri--95--jpg.jpg',0),
(155,158,'/uploads/products/gotta-patti-chunri--96--jpg.jpg',0),
(156,159,'/uploads/products/gotta-patti-chunri--97--jpg.jpg',0),
(157,160,'/uploads/products/gotta-patti-chunri--98--jpg.jpg',0),
(158,161,'/uploads/products/gotta-patti-chunri--99--jpg.jpg',0),
(159,162,'/uploads/products/gotta-patti-chunri--100--jpg.jpg',0),
(160,163,'/uploads/products/gotta-patti-chunri--101--jpg.jpg',0),
(161,164,'/uploads/products/gotta-patti-chunri--102--jpg.jpg',0),
(162,165,'/uploads/products/gotta-patti-chunri--103--jpg.jpg',0),
(163,166,'/uploads/products/gotta-patti-chunri--104--jpg.jpg',0),
(164,167,'/uploads/products/gotta-patti-chunri--105--jpg.jpg',0),
(165,168,'/uploads/products/gotta-patti-chunri--106--jpg.jpg',0),
(166,169,'/uploads/products/gotta-patti-chunri--107--jpg.jpg',0),
(167,170,'/uploads/products/gotta-patti-chunri--108--jpg.jpg',0),
(168,171,'/uploads/products/gotta-patti-chunri--109--jpg.jpg',0),
(169,172,'/uploads/products/gotta-patti-chunri--110--jpg.jpg',0),
(170,173,'/uploads/products/gotta-patti-chunri--111--jpg.jpg',0),
(171,174,'/uploads/products/gotta-patti-chunri--112--jpg.jpg',0),
(172,175,'/uploads/products/gotta-patti-chunri--113--jpg.jpg',0),
(173,176,'/uploads/products/gotta-patti-chunri--114--jpg.jpg',0),
(174,177,'/uploads/products/gotta-patti-chunri--115--jpg.jpg',0),
(175,178,'/uploads/products/gotta-patti-chunri--116--jpg.jpg',0),
(176,179,'/uploads/products/gotta-patti-chunri--117--jpg.jpg',0),
(177,180,'/uploads/products/gotta-patti-chunri--118--jpg.jpg',0),
(178,181,'/uploads/products/gotta-patti-chunri--119--jpg.jpg',0),
(179,182,'/uploads/products/gotta-patti-chunri--120--jpg.jpg',0),
(180,183,'/uploads/products/gotta-patti-chunri--121--jpg.jpg',0),
(181,184,'/uploads/products/gotta-patti-chunri--122--jpg.jpg',0),
(182,185,'/uploads/products/gotta-patti-chunri--123--jpg.jpg',0),
(183,186,'/uploads/products/gotta-patti-chunri--124--jpg.jpg',0),
(184,187,'/uploads/products/gotta-patti-chunri--125--jpg.jpg',0),
(185,188,'/uploads/products/gotta-patti-chunri--126--jpg.jpg',0),
(186,189,'/uploads/products/gotta-patti-chunri--127--jpg.jpg',0),
(187,190,'/uploads/products/gotta-patti-chunri--128--jpg.jpg',0),
(188,191,'/uploads/products/gotta-patti-chunri--129--jpg.jpg',0),
(189,192,'/uploads/products/gotta-patti-chunri--130--jpg.jpg',0),
(190,193,'/uploads/products/gotta-patti-chunri--131--jpg.jpg',0),
(191,194,'/uploads/products/gotta-patti-chunri--132--jpg.jpg',0),
(192,195,'/uploads/products/gotta-patti-chunri--133--jpg.jpg',0),
(193,196,'/uploads/products/gotta-patti-chunri--134--jpg.jpg',0),
(194,197,'/uploads/products/gotta-patti-chunri--135--jpg.jpg',0),
(195,198,'/uploads/products/gotta-patti-chunri--136--jpg.jpg',0),
(196,199,'/uploads/products/gotta-patti-chunri--137--jpg.jpg',0),
(197,200,'/uploads/products/gotta-patti-chunri--138--jpg.jpg',0),
(198,201,'/uploads/products/gotta-patti-chunri--139--jpg.jpg',0),
(199,202,'/uploads/products/gotta-patti-chunri--140--jpg.jpg',0),
(200,203,'/uploads/products/gotta-patti-chunri--141--jpg.jpg',0),
(201,204,'/uploads/products/gotta-patti-chunri--142--jpg.jpg',0),
(202,205,'/uploads/products/gotta-patti-chunri--143--jpg.jpg',0),
(203,206,'/uploads/products/gotta-patti-chunri--144--jpg.jpg',0),
(204,207,'/uploads/products/gotta-patti-chunri--145--jpg.jpg',0),
(205,208,'/uploads/products/gotta-patti-chunri-146--jpg.jpg',0),
(206,209,'/uploads/products/gotta-patti-chunri-147--jpg.jpg',0),
(207,210,'/uploads/products/gotta-patti-chunri--1--jpg.jpg',0),
(208,211,'/uploads/products/gotta-patti-saree--2--jpg.jpg',0),
(209,212,'/uploads/products/gotta-patti-saree--3--jpg.jpg',0),
(210,213,'/uploads/products/gotta-patti-saree--4--jpg.jpg',0),
(211,214,'/uploads/products/gotta-patti-saree--5--jpg.jpg',0),
(212,215,'/uploads/products/gotta-patti-saree--6--jpg.jpg',0),
(213,216,'/uploads/products/gotta-patti-saree--7--jpg.jpg',0),
(214,217,'/uploads/products/gotta-patti-saree--8--jpg.jpg',0),
(215,218,'/uploads/products/gotta-patti-saree--9--jpg.jpg',0),
(216,219,'/uploads/products/gotta-patti-saree--10--jpg.jpg',0),
(217,220,'/uploads/products/gotta-patti-saree--11--jpg.jpg',0),
(218,221,'/uploads/products/gotta-patti-saree--12--jpg.jpg',0),
(219,222,'/uploads/products/gotta-patti-saree--13--jpg.jpg',0),
(220,223,'/uploads/products/gotta-patti-saree--14--jpg.jpg',0),
(221,224,'/uploads/products/gotta-patti-saree--15--jpg.jpg',0),
(222,225,'/uploads/products/gotta-patti-saree--16--jpg.jpg',0),
(223,226,'/uploads/products/gotta-patti-saree--17--jpg.jpg',0),
(224,227,'/uploads/products/gotta-patti-saree--18--jpg.jpg',0),
(225,228,'/uploads/products/gotta-patti-saree--19--jpg.jpg',0),
(226,229,'/uploads/products/gotta-patti-saree--20--jpg.jpg',0),
(227,230,'/uploads/products/gotta-patti-saree--21--jpg.jpg',0),
(228,231,'/uploads/products/gotta-patti-saree--22--jpg.jpg',0),
(229,232,'/uploads/products/gotta-patti-saree--23--jpg.jpg',0),
(230,233,'/uploads/products/gotta-patti-saree--24--jpg.jpg',0),
(231,234,'/uploads/products/gotta-patti-saree--25--jpg.jpg',0),
(232,235,'/uploads/products/gotta-patti-saree--26--jpg.jpg',0),
(233,236,'/uploads/products/gotta-patti-saree--27--jpg.jpg',0),
(234,237,'/uploads/products/gotta-patti-saree--28--jpg.jpg',0),
(235,238,'/uploads/products/gotta-patti-saree--29--jpg.jpg',0),
(236,239,'/uploads/products/gotta-patti-saree--30--jpg.jpg',0),
(237,240,'/uploads/products/gotta-patti-saree--31--jpg.jpg',0),
(238,241,'/uploads/products/gotta-patti-saree--32--jpg.jpg',0),
(239,242,'/uploads/products/gotta-patti-saree--33--jpg.jpg',0),
(240,243,'/uploads/products/gotta-patti-saree--34--jpg.jpg',0),
(241,244,'/uploads/products/gotta-patti-saree--35--jpg.jpg',0),
(242,245,'/uploads/products/gotta-patti-saree--36--jpg.jpg',0),
(243,246,'/uploads/products/gotta-patti-saree--37--jpg.jpg',0),
(244,247,'/uploads/products/gotta-patti-saree--38--jpg.jpg',0),
(245,248,'/uploads/products/gotta-patti-saree--39--jpg.jpg',0),
(246,249,'/uploads/products/gotta-patti-saree--40--jpg.jpg',0),
(247,250,'/uploads/products/gotta-patti-saree--41--jpg.jpg',0),
(248,251,'/uploads/products/gotta-patti-saree--42--jpg.jpg',0),
(249,252,'/uploads/products/gotta-patti-saree--43--jpg.jpg',0),
(250,253,'/uploads/products/gotta-patti-saree--44--jpg.jpg',0),
(251,254,'/uploads/products/gotta-patti-saree--45--jpg.jpg',0),
(252,255,'/uploads/products/gotta-patti-saree--46--jpg.jpg',0),
(253,256,'/uploads/products/gotta-patti-saree--47--jpg.jpg',0),
(254,257,'/uploads/products/gotta-patti-saree--48--jpg.jpg',0),
(255,258,'/uploads/products/gotta-patti-saree--49--jpg.jpg',0),
(256,259,'/uploads/products/gotta-patti-saree--50--jpg.jpg',0),
(257,260,'/uploads/products/gotta-patti-saree--51--jpg.jpg',0),
(258,261,'/uploads/products/gotta-patti-saree--52--jpg.jpg',0),
(259,262,'/uploads/products/gotta-patti-saree--53--jpg.jpg',0),
(260,263,'/uploads/products/gotta-patti-saree--54--jpg.jpg',0),
(261,264,'/uploads/products/gotta-patti-saree--55--jpg.jpg',0),
(262,265,'/uploads/products/gotta-patti-saree--56--jpg.jpg',0),
(263,266,'/uploads/products/gotta-patti-saree--57--jpg.jpg',0),
(264,267,'/uploads/products/gotta-patti-saree--59--jpg.jpg',0),
(265,268,'/uploads/products/gotta-patti-saree--60--jpg.jpg',0),
(266,269,'/uploads/products/gotta-patti-saree--61--jpg.jpg',0),
(267,270,'/uploads/products/gotta-patti-saree--62--jpg.jpg',0),
(268,271,'/uploads/products/gotta-patti-saree--63--jpg.jpg',0),
(269,272,'/uploads/products/gotta-patti-saree--64--jpg.jpg',0),
(270,273,'/uploads/products/gotta-patti-saree--65--jpg.jpg',0),
(271,274,'/uploads/products/gotta-patti-saree--66--jpg.jpg',0),
(272,275,'/uploads/products/gotta-patti-saree--67--jpg.jpg',0),
(273,276,'/uploads/products/gotta-patti-saree--68--jpg.jpg',0),
(274,277,'/uploads/products/gotta-patti-saree--69--jpg.jpg',0),
(275,278,'/uploads/products/gotta-patti-saree--70--jpg.jpg',0),
(276,279,'/uploads/products/gotta-patti-saree--71--jpg.jpg',0),
(277,280,'/uploads/products/gotta-patti-saree--72--jpg.jpg',0),
(278,281,'/uploads/products/gotta-patti-saree--73--jpg.jpg',0),
(279,282,'/uploads/products/gotta-patti-saree--74--jpg.jpg',0),
(280,283,'/uploads/products/gotta-patti-saree--75--jpg.jpg',0),
(281,284,'/uploads/products/gotta-patti-saree--76--jpg.jpg',0),
(282,285,'/uploads/products/gotta-patti-saree--77--jpg.jpg',0),
(283,286,'/uploads/products/gotta-patti-saree--78--jpg.jpg',0),
(284,287,'/uploads/products/gotta-patti-saree--79--jpg.jpg',0),
(285,288,'/uploads/products/gotta-patti-saree--1--jpg.jpg',0),
(286,289,'/uploads/products/gotta-patti-saree--81--jpg.jpg',0),
(287,290,'/uploads/products/gotta-patti-saree--82--jpg.jpg',0),
(288,291,'/uploads/products/gotta-patti-saree--80--jpg.jpg',0),
(289,292,'/uploads/products/gottapatti--2--jpg.jpg',0),
(290,293,'/uploads/products/gottapatti--3--jpg.jpg',0),
(291,294,'/uploads/products/gottapatti--4--jpg.jpg',0),
(292,295,'/uploads/products/gottapatti--5--jpg.jpg',0),
(293,296,'/uploads/products/gottapatti--6--jpg.jpg',0),
(294,297,'/uploads/products/gottapatti--7--jpg.jpg',0),
(295,298,'/uploads/products/gottapatti--8--jpg.jpg',0),
(296,299,'/uploads/products/gottapatti--9--jpg.jpg',0),
(297,300,'/uploads/products/gottapatti--10--jpg.jpg',0),
(298,301,'/uploads/products/gottapatti--11--jpg.jpg',0),
(299,302,'/uploads/products/gottapatti--12--jpg.jpg',0),
(300,303,'/uploads/products/gottapatti--13--jpg.jpg',0),
(301,304,'/uploads/products/gottapatti--14--jpg.jpg',0),
(302,305,'/uploads/products/gottapatti--15--jpg.jpg',0),
(303,306,'/uploads/products/gottapatti--16--jpg.jpg',0),
(304,307,'/uploads/products/gottapatti--17--jpg.jpg',0),
(305,308,'/uploads/products/gottapatti--18--jpg.jpg',0),
(306,309,'/uploads/products/gottapatti--19--jpg.jpg',0),
(307,310,'/uploads/products/gottapatti--20--jpg.jpg',0),
(308,311,'/uploads/products/gottapatti--22--jpg.jpg',0),
(309,312,'/uploads/products/gottapatti--23--jpg.jpg',0),
(310,313,'/uploads/products/gottapatti--24--jpg.jpg',0),
(311,314,'/uploads/products/gottapatti--25--jpg.jpg',0),
(312,315,'/uploads/products/gottapatti--26--jpg.jpg',0),
(313,316,'/uploads/products/gottapatti--27--jpg.jpg',0),
(314,317,'/uploads/products/gottapatti--28--jpg.jpg',0),
(315,318,'/uploads/products/gottapatti--29--jpg.jpg',0),
(316,319,'/uploads/products/gottapatti--30--jpg.jpg',0),
(317,320,'/uploads/products/gottapatti--31--jpg.jpg',0),
(318,321,'/uploads/products/gottapatti--32--jpg.jpg',0),
(319,322,'/uploads/products/gottapatti--33--jpg.jpg',0),
(320,323,'/uploads/products/gottapatti--34--jpg.jpg',0),
(321,324,'/uploads/products/gottapatti--35--jpg.jpg',0),
(322,325,'/uploads/products/gottapatti--36--jpg.jpg',0),
(323,326,'/uploads/products/gottapatti--37--jpg.jpg',0),
(324,327,'/uploads/products/gottapatti--39--jpg.jpg',0),
(325,328,'/uploads/products/gottapatti--40--jpg.jpg',0),
(326,329,'/uploads/products/gottapatti--41--jpg.jpg',0),
(327,330,'/uploads/products/gottapatti--42--jpg.jpg',0),
(328,331,'/uploads/products/gottapatti--43--jpg.jpg',0),
(329,332,'/uploads/products/gottapatti--44--jpg.jpg',0),
(330,333,'/uploads/products/gottapatti--45--jpg.jpg',0),
(331,334,'/uploads/products/gottapatti--46--jpg.jpg',0),
(332,335,'/uploads/products/gottapatti--47--jpg.jpg',0),
(333,336,'/uploads/products/gottapatti--48--jpg.jpg',0),
(334,337,'/uploads/products/gottapatti--49--jpg.jpg',0),
(335,338,'/uploads/products/gottapatti--50--jpg.jpg',0),
(336,339,'/uploads/products/gottapatti--51--jpg.jpg',0),
(337,340,'/uploads/products/gottapatti--52--jpg.jpg',0),
(338,341,'/uploads/products/gottapatti--53--jpg.jpg',0),
(339,342,'/uploads/products/gottapatti--54--jpg.jpg',0),
(340,343,'/uploads/products/gottapatti--55--jpg.jpg',0),
(341,344,'/uploads/products/gottapatti--56--jpg.jpg',0),
(342,345,'/uploads/products/gottapatti--1--jpg.jpg',0),
(343,346,'/uploads/products/lehenga--2--jpg.jpg',0),
(344,347,'/uploads/products/lehenga--3--jpg.jpg',0),
(345,348,'/uploads/products/lehenga--4--jpg.jpg',0),
(346,349,'/uploads/products/lehenga--5--jpg.jpg',0),
(347,350,'/uploads/products/lehenga--6--jpg.jpg',0),
(348,351,'/uploads/products/lehenga--7--jpg.jpg',0),
(349,352,'/uploads/products/lehenga--8--jpg.jpg',0),
(350,353,'/uploads/products/lehenga--9--jpg.jpg',0),
(351,354,'/uploads/products/lehenga--10--jpg.jpg',0),
(352,355,'/uploads/products/lehenga--11--jpg.jpg',0),
(353,356,'/uploads/products/lehenga--12--jpg.jpg',0),
(354,357,'/uploads/products/lehenga--13--jpg.jpg',0),
(355,358,'/uploads/products/lehenga--14--jpg.jpg',0),
(356,359,'/uploads/products/lehenga--15--jpg.jpg',0),
(357,360,'/uploads/products/lehenga--16--jpg.jpg',0),
(358,361,'/uploads/products/lehenga--17--jpg.jpg',0),
(359,362,'/uploads/products/lehenga--18--jpg.jpg',0),
(360,363,'/uploads/products/lehenga--19--jpg.jpg',0),
(361,364,'/uploads/products/lehenga--20--jpg.jpg',0),
(362,365,'/uploads/products/lehenga--21--jpg.jpg',0),
(363,366,'/uploads/products/lehenga--22--jpg.jpg',0),
(364,367,'/uploads/products/lehenga--23--jpg.jpg',0),
(365,368,'/uploads/products/lehenga--24--jpg.jpg',0),
(366,369,'/uploads/products/lehenga--1--jpg.jpg',0),
(367,370,'/uploads/products/lehenge-8--jpg.jpg',0),
(368,371,'/uploads/products/lehenge-9--jpg.jpg',0),
(369,372,'/uploads/products/lehenge-10--jpg.jpg',0),
(370,373,'/uploads/products/lehenge-11--jpg.jpg',0),
(371,374,'/uploads/products/lehenge-12--jpg.jpg',0),
(372,375,'/uploads/products/lehenge-13--jpg.jpg',0),
(373,376,'/uploads/products/lehenge-14--jpg.jpg',0),
(374,377,'/uploads/products/lehenge-15--jpg.jpg',0),
(375,378,'/uploads/products/lehenge-16--jpg.jpg',0),
(376,379,'/uploads/products/lehenge-17--jpg.jpg',0),
(377,380,'/uploads/products/lehenge-18--jpg.jpg',0),
(378,381,'/uploads/products/lehenge-19--jpg.jpg',0),
(379,382,'/uploads/products/lehenge-20--jpg.jpg',0),
(380,383,'/uploads/products/lehenge-21--jpg.jpg',0),
(381,384,'/uploads/products/lehenge-22--jpg.jpg',0),
(382,385,'/uploads/products/lehenge-23--jpg.jpg',0),
(383,386,'/uploads/products/lehenge-24--jpg.jpg',0),
(384,387,'/uploads/products/lehenge-25--jpg.jpg',0),
(385,388,'/uploads/products/lehenge-26--jpg.jpg',0),
(386,389,'/uploads/products/lehenge-28--jpg.jpg',0),
(387,390,'/uploads/products/lehenge-29--jpg.jpg',0),
(388,391,'/uploads/products/lehenge-30--jpg.jpg',0),
(389,392,'/uploads/products/lehenge-31--jpg.jpg',0),
(390,393,'/uploads/products/lehenge-32--jpg.jpg',0),
(391,394,'/uploads/products/lehenge-33--jpg.jpg',0),
(392,395,'/uploads/products/lehenge-34--jpg.jpg',0),
(393,396,'/uploads/products/lehenge-35--jpg.jpg',0),
(394,397,'/uploads/products/lehenge-36--jpg.jpg',0),
(395,398,'/uploads/products/lehenge-37--jpg.jpg',0),
(396,399,'/uploads/products/lehenge-38--jpg.jpg',0),
(397,400,'/uploads/products/lehenge-39--jpg.jpg',0),
(398,401,'/uploads/products/lehenge-40--jpg.jpg',0),
(399,402,'/uploads/products/lehenge-41--jpg.jpg',0),
(400,403,'/uploads/products/lehenge-42--jpg.jpg',0),
(401,404,'/uploads/products/lehenge-43--jpg.jpg',0),
(402,405,'/uploads/products/lehenge-47--jpg.jpg',0),
(403,406,'/uploads/products/lehenge-48--jpg.jpg',0),
(404,407,'/uploads/products/lehenge-49--jpg.jpg',0),
(405,408,'/uploads/products/lehenge-50--jpg.jpg',0),
(406,409,'/uploads/products/lehenge-51--jpg.jpg',0),
(407,410,'/uploads/products/lehenge-52--jpg.jpg',0),
(408,411,'/uploads/products/lehenge-53--jpg.jpg',0),
(409,412,'/uploads/products/lehenge-54--jpg.jpg',0),
(410,413,'/uploads/products/lehenge-55--jpg.jpg',0),
(411,414,'/uploads/products/lehenge-56--jpg.jpg',0),
(412,415,'/uploads/products/lehenge-57--jpg.jpg',0),
(413,416,'/uploads/products/lehenge-59--jpg.jpg',0),
(414,417,'/uploads/products/lehenge-60--jpg.jpg',0),
(415,418,'/uploads/products/lehenge-61--jpg.jpg',0),
(416,419,'/uploads/products/lehenge-62--jpg.jpg',0),
(417,420,'/uploads/products/lehenge-63--jpg.jpg',0),
(418,421,'/uploads/products/lehenge-64--jpg.jpg',0),
(419,422,'/uploads/products/lehenge-65--jpg.jpg',0),
(420,423,'/uploads/products/lehenge-67--jpg.jpg',0),
(421,424,'/uploads/products/lehenge-68--jpg.jpg',0),
(422,425,'/uploads/products/lehenge-69--jpg.jpg',0),
(423,426,'/uploads/products/lehenge-70--jpg.jpg',0),
(424,427,'/uploads/products/lehenge-71--jpg.jpg',0),
(425,428,'/uploads/products/lehenge-72--jpg.jpg',0),
(426,429,'/uploads/products/lehenge-73--jpg.jpg',0),
(427,430,'/uploads/products/lehenge-77--jpg.jpg',0),
(428,431,'/uploads/products/lehenge-95--jpg.jpg',0),
(429,432,'/uploads/products/lehenge-7--jpg.jpg',0),
(430,433,'/uploads/products/light-work--2--jpg.jpg',0),
(431,434,'/uploads/products/light-work--3--jpg.jpg',0),
(432,435,'/uploads/products/light-work--4--jpg.jpg',0),
(433,436,'/uploads/products/light-work--5--jpg.jpg',0),
(434,437,'/uploads/products/light-work--6--jpg.jpg',0),
(435,438,'/uploads/products/light-work--7--jpg.jpg',0),
(436,439,'/uploads/products/light-work--8--jpg.jpg',0),
(437,440,'/uploads/products/light-work--1--jpg.jpg',0),
(438,441,'/uploads/products/new--2--jpg.jpg',0),
(439,442,'/uploads/products/new--3--jpg.jpg',0),
(440,443,'/uploads/products/new--4--jpg.jpg',0),
(441,444,'/uploads/products/new--5--jpg.jpg',0),
(442,445,'/uploads/products/new--6--jpg.jpg',0),
(443,446,'/uploads/products/new--7--jpg.jpg',0),
(444,447,'/uploads/products/new--8--jpg.jpg',0),
(445,448,'/uploads/products/new--9--jpg.jpg',0),
(446,449,'/uploads/products/new--10--jpg.jpg',0),
(447,450,'/uploads/products/new--11--jpg.jpg',0),
(448,451,'/uploads/products/new--12--jpg.jpg',0),
(449,452,'/uploads/products/new--13--jpg.jpg',0),
(450,453,'/uploads/products/new--14--jpg.jpg',0),
(451,454,'/uploads/products/new--15--jpg.jpg',0),
(452,455,'/uploads/products/new--16--jpg.jpg',0),
(453,456,'/uploads/products/new--17--jpg.jpg',0),
(454,457,'/uploads/products/new--18--jpg.jpg',0),
(455,458,'/uploads/products/new--19--jpg.jpg',0),
(456,459,'/uploads/products/new--20--jpg.jpg',0),
(457,460,'/uploads/products/new--21--jpg.jpg',0),
(458,461,'/uploads/products/new--22--jpg.jpg',0),
(459,462,'/uploads/products/new--23--jpg.jpg',0),
(460,463,'/uploads/products/new--24--jpg.jpg',0),
(461,464,'/uploads/products/new--1--jpg.jpg',0),
(462,465,'/uploads/products/new-lehenge--2--jpeg.jpg',0),
(463,466,'/uploads/products/new-lehenge--3--jpeg.jpg',0),
(464,467,'/uploads/products/new-lehenge--1--jpeg.jpg',0),
(465,474,'/uploads/products/pittan-work--2--jpg.jpg',0),
(466,475,'/uploads/products/pittan-work--3--jpg.jpg',0),
(467,476,'/uploads/products/pittan-work--4--jpg.jpg',0),
(468,477,'/uploads/products/pittan-work--5--jpg.jpg',0),
(469,478,'/uploads/products/pittan-work--6--jpg.jpg',0),
(470,479,'/uploads/products/pittan-work--7--jpg.jpg',0),
(471,480,'/uploads/products/pittan-work--8--jpg.jpg',0),
(472,481,'/uploads/products/pittan-work--9--jpg.jpg',0),
(473,482,'/uploads/products/pittan-work--10--jpg.jpg',0),
(474,483,'/uploads/products/pittan-work--11--jpg.jpg',0),
(475,484,'/uploads/products/pittan-work--12--jpg.jpg',0),
(476,485,'/uploads/products/pittan-work--13--jpg.jpg',0),
(477,486,'/uploads/products/pittan-work--14--jpg.jpg',0),
(478,487,'/uploads/products/pittan-work--15--jpg.jpg',0),
(479,488,'/uploads/products/pittan-work--16--jpg.jpg',0),
(480,489,'/uploads/products/pittan-work--17--jpg.jpg',0),
(481,490,'/uploads/products/pittan-work--18--jpg.jpg',0),
(482,491,'/uploads/products/pittan-work--1--jpg.jpg',0),
(483,492,'/uploads/products/printed--2--jpg.jpg',0),
(484,493,'/uploads/products/printed--3--jpg.jpg',0),
(485,494,'/uploads/products/printed--4--jpg.jpg',0),
(486,495,'/uploads/products/printed--5--jpg.jpg',0),
(487,496,'/uploads/products/printed--6--jpg.jpg',0),
(488,497,'/uploads/products/printed--7--jpg.jpg',0),
(489,498,'/uploads/products/printed--8--jpg.jpg',0),
(490,499,'/uploads/products/printed--9--jpg.jpg',0),
(491,500,'/uploads/products/printed--10--jpg.jpg',0),
(492,501,'/uploads/products/printed--11--jpg.jpg',0),
(493,502,'/uploads/products/printed--12--jpg.jpg',0),
(494,503,'/uploads/products/printed--13--jpg.jpg',0),
(495,504,'/uploads/products/printed--14--jpg.jpg',0),
(496,505,'/uploads/products/printed--15--jpg.jpg',0),
(497,506,'/uploads/products/printed--16--jpg.jpg',0),
(498,507,'/uploads/products/printed--17--jpg.jpg',0),
(499,508,'/uploads/products/printed--18--jpg.jpg',0),
(500,509,'/uploads/products/printed--19--jpg.jpg',0),
(501,510,'/uploads/products/printed--20--jpg.jpg',0),
(502,511,'/uploads/products/printed--21--jpg.jpg',0),
(503,512,'/uploads/products/printed--22--jpg.jpg',0),
(504,513,'/uploads/products/printed--23--jpg.jpg',0),
(505,514,'/uploads/products/printed--24--jpg.jpg',0),
(506,515,'/uploads/products/printed--25--jpg.jpg',0),
(507,516,'/uploads/products/printed--26--jpg.jpg',0),
(508,517,'/uploads/products/printed--27--jpg.jpg',0),
(509,518,'/uploads/products/printed--28--jpg.jpg',0),
(510,519,'/uploads/products/printed--29--jpg.jpg',0),
(511,520,'/uploads/products/printed--30--jpg.jpg',0),
(512,521,'/uploads/products/printed--31--jpg.jpg',0),
(513,522,'/uploads/products/printed--32--jpg.jpg',0),
(514,523,'/uploads/products/printed--33--jpg.jpg',0),
(515,524,'/uploads/products/printed--34--jpg.jpg',0),
(516,525,'/uploads/products/printed--35--jpg.jpg',0),
(517,526,'/uploads/products/printed--36--jpg.jpg',0),
(518,527,'/uploads/products/printed--37--jpg.jpg',0),
(519,528,'/uploads/products/printed--38--jpg.jpg',0),
(520,529,'/uploads/products/printed--39--jpg.jpg',0),
(521,530,'/uploads/products/printed--40--jpg.jpg',0),
(522,531,'/uploads/products/printed--41--jpg.jpg',0),
(523,532,'/uploads/products/printed--42--jpg.jpg',0),
(524,533,'/uploads/products/printed--43--jpg.jpg',0),
(525,534,'/uploads/products/printed--44--jpg.jpg',0),
(526,535,'/uploads/products/printed--45--jpg.jpg',0),
(527,536,'/uploads/products/printed--46--jpg.jpg',0),
(528,537,'/uploads/products/printed--47--jpg.jpg',0),
(529,538,'/uploads/products/printed--48--jpg.jpg',0),
(530,539,'/uploads/products/printed--49--jpg.jpg',0),
(531,540,'/uploads/products/printed--50--jpg.jpg',0),
(532,541,'/uploads/products/printed--51--jpg.jpg',0),
(533,542,'/uploads/products/printed--52--jpg.jpg',0),
(534,543,'/uploads/products/printed--53--jpg.jpg',0),
(535,544,'/uploads/products/printed--54--jpg.jpg',0),
(536,545,'/uploads/products/printed--55--jpg.jpg',0),
(537,546,'/uploads/products/printed--56--jpg.jpg',0),
(538,547,'/uploads/products/printed--1--jpg.jpg',0),
(539,548,'/uploads/products/pyor-gotta-patti--2--jpg.jpg',0),
(540,549,'/uploads/products/pyor-gotta-patti--3--jpg.jpg',0),
(541,550,'/uploads/products/pyor-gotta-patti--4--jpg.jpg',0),
(542,551,'/uploads/products/pyor-gotta-patti--5--jpg.jpg',0),
(543,552,'/uploads/products/pyor-gotta-patti--6--jpg.jpg',0),
(544,553,'/uploads/products/pyor-gotta-patti--7--jpg.jpg',0),
(545,554,'/uploads/products/pyor-gotta-patti--8--jpg.jpg',0),
(546,555,'/uploads/products/pyor-gotta-patti--9--jpg.jpg',0),
(547,556,'/uploads/products/pyor-gotta-patti--10--jpg.jpg',0),
(548,557,'/uploads/products/pyor-gotta-patti--11--jpg.jpg',0),
(549,558,'/uploads/products/pyor-gotta-patti--12--jpg.jpg',0),
(550,559,'/uploads/products/pyor-gotta-patti--13--jpg.jpg',0),
(551,560,'/uploads/products/pyor-gotta-patti--14--jpg.jpg',0),
(552,561,'/uploads/products/pyor-gotta-patti--15--jpg.jpg',0),
(553,562,'/uploads/products/pyor-gotta-patti--16--jpg.jpg',0),
(554,563,'/uploads/products/pyor-gotta-patti--17--jpg.jpg',0),
(555,564,'/uploads/products/pyor-gotta-patti--18--jpg.jpg',0),
(556,565,'/uploads/products/pyor-gotta-patti--19--jpg.jpg',0),
(557,566,'/uploads/products/pyor-gotta-patti--20--jpg.jpg',0),
(558,567,'/uploads/products/pyor-gotta-patti--21--jpg.jpg',0),
(559,568,'/uploads/products/pyor-gotta-patti--22--jpg.jpg',0),
(560,569,'/uploads/products/pyor-gotta-patti--23--jpg.jpg',0),
(561,570,'/uploads/products/pyor-gotta-patti--24--jpg.jpg',0),
(562,571,'/uploads/products/pyor-gotta-patti--25--jpg.jpg',0),
(563,572,'/uploads/products/pyor-gotta-patti--26--jpg.jpg',0),
(564,573,'/uploads/products/pyor-gotta-patti--27--jpg.jpg',0),
(565,574,'/uploads/products/pyor-gotta-patti--28--jpg.jpg',0),
(566,575,'/uploads/products/pyor-gotta-patti--29--jpg.jpg',0),
(567,576,'/uploads/products/pyor-gotta-patti--30--jpg.jpg',0),
(568,577,'/uploads/products/pyor-gotta-patti--31--jpg.jpg',0),
(569,578,'/uploads/products/pyor-gotta-patti--32--jpg.jpg',0),
(570,579,'/uploads/products/pyor-gotta-patti--33--jpg.jpg',0),
(571,580,'/uploads/products/pyor-gotta-patti--34--jpg.jpg',0),
(572,581,'/uploads/products/pyor-gotta-patti--35--jpg.jpg',0),
(573,582,'/uploads/products/pyor-gotta-patti--36--jpg.jpg',0),
(574,583,'/uploads/products/pyor-gotta-patti--37--jpg.jpg',0),
(575,584,'/uploads/products/pyor-gotta-patti--38--jpg.jpg',0),
(576,585,'/uploads/products/pyor-gotta-patti--39--jpg.jpg',0),
(577,586,'/uploads/products/pyor-gotta-patti--40--jpg.jpg',0),
(578,587,'/uploads/products/pyor-gotta-patti--41--jpg.jpg',0),
(579,588,'/uploads/products/pyor-gotta-patti--42--jpg.jpg',0),
(580,589,'/uploads/products/pyor-gotta-patti--43--jpg.jpg',0),
(581,590,'/uploads/products/pyor-gotta-patti--44--jpg.jpg',0),
(582,591,'/uploads/products/pyor-gotta-patti--45--jpg.jpg',0),
(583,592,'/uploads/products/pyor-gotta-patti--46--jpg.jpg',0),
(584,593,'/uploads/products/pyor-gotta-patti--47--jpg.jpg',0),
(585,594,'/uploads/products/pyor-gotta-patti--48--jpg.jpg',0),
(586,595,'/uploads/products/pyor-gotta-patti--49--jpg.jpg',0),
(587,596,'/uploads/products/pyor-gotta-patti--50--jpg.jpg',0),
(588,597,'/uploads/products/pyor-gotta-patti--51--jpg.jpg',0),
(589,598,'/uploads/products/pyor-gotta-patti--52--jpg.jpg',0),
(590,599,'/uploads/products/pyor-gotta-patti--53--jpg.jpg',0),
(591,600,'/uploads/products/pyor-gotta-patti--54--jpg.jpg',0),
(592,601,'/uploads/products/pyor-gotta-patti--55--jpg.jpg',0),
(593,602,'/uploads/products/pyor-gotta-patti---56--jpg.jpg',0),
(594,603,'/uploads/products/pyor-gotta-patti---57--jpg.jpg',0),
(595,604,'/uploads/products/pyor-gotta-patti---58--jpg.jpg',0),
(596,605,'/uploads/products/pyor-gotta-patti--1--jpg.jpg',0),
(597,607,'/uploads/products/sifon-chunri--2--jpg.jpg',0),
(598,608,'/uploads/products/sifon-chunri--3--jpg.jpg',0),
(599,609,'/uploads/products/sifon-chunri--4--jpg.jpg',0),
(600,610,'/uploads/products/sifon-chunri--5--jpg.jpg',0),
(601,611,'/uploads/products/sifon-chunri--6--jpg.jpg',0),
(602,612,'/uploads/products/sifon-chunri--7--jpg.jpg',0),
(603,613,'/uploads/products/sifon-chunri--8--jpg.jpg',0),
(604,614,'/uploads/products/sifon-chunri--9--jpg.jpg',0),
(605,615,'/uploads/products/sifon-chunri--10--jpg.jpg',0),
(606,616,'/uploads/products/sifon-chunri--11--jpg.jpg',0),
(607,617,'/uploads/products/sifon-chunri--12--jpg.jpg',0),
(608,618,'/uploads/products/sifon-chunri--1--jpg.jpg',0),
(609,619,'/uploads/products/sitarawork--2--jpg.jpg',0),
(610,620,'/uploads/products/sitarawork--3--jpg.jpg',0),
(611,621,'/uploads/products/sitarawork-6--jpg.jpg',0),
(612,622,'/uploads/products/sitarawork-7--jpg.jpg',0),
(613,623,'/uploads/products/sitarawork-8--jpg.jpg',0),
(614,624,'/uploads/products/sitarawork-9--jpg.jpg',0),
(615,625,'/uploads/products/sitarawork-10--jpg.jpg',0),
(616,626,'/uploads/products/sitarawork-11--jpg.jpg',0),
(617,627,'/uploads/products/sitarawork--1--jpg.jpg',0);
/*!40000 ALTER TABLE `product_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `product_variants`
--

LOCK TABLES `product_variants` WRITE;
/*!40000 ALTER TABLE `product_variants` DISABLE KEYS */;
INSERT INTO `product_variants` VALUES
(1,1,'PAV-ITEM-0001',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/bandhej---1--jpg.jpg'),
(2,2,'PAV-ITEM-0002',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/bandhej---2--jpg.jpg'),
(3,3,'PAV-ITEM-0003',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/bandhej---3--jpg.jpg'),
(4,4,'PAV-ITEM-0004',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/bandhej---4--jpg.jpg'),
(5,5,'PAV-ITEM-0005',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/bandhej---5--jpg.jpg'),
(6,6,'PAV-ITEM-0006',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/bandhej---6--jpg.jpg'),
(7,7,'PAV-ITEM-0007',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/bandhej---7--jpg.jpg'),
(8,8,'PAV-ITEM-0008',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/bandhej---8--jpg.jpg'),
(9,9,'PAV-ITEM-0009',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/bandhej---9--jpg.jpg'),
(10,10,'PAV-ITEM-0010',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/bandhej---10--jpg.jpg'),
(11,11,'PAV-ITEM-0011',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/bandhej---11--jpg.jpg'),
(12,12,'PAV-ITEM-0012',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/bandhej---12--jpg.jpg'),
(13,13,'PAV-ITEM-0013',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/bandhej---18--jpg.jpg'),
(14,14,'PAV-ITEM-0014',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/bandhej---19--jpg.jpg'),
(15,15,'PAV-ITEM-0015',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/bandhej---20--jpg.jpg'),
(16,16,'PAV-ITEM-0016',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/bandhej---21--jpg.jpg'),
(17,17,'PAV-ITEM-0017',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/bandhej---23--jpg.jpg'),
(18,18,'PAV-ITEM-0018',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/bandhej---24--jpg.jpg'),
(19,19,'PAV-ITEM-0019',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/bandhej---26--jpg.jpg'),
(20,20,'PAV-ITEM-0020',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/bandhej---27--jpg.jpg'),
(21,21,'PAV-ITEM-0021',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/bandhej---28--jpg.jpg'),
(22,22,'PAV-ITEM-0022',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/bandhej---30--jpg.jpg'),
(23,23,'PAV-ITEM-0023',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/bandhej---31--jpg.jpg'),
(24,24,'PAV-ITEM-0024',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/bandhej---33--jpg.jpg'),
(25,25,'PAV-ITEM-0025',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/bandhej---35--jpg.jpg'),
(26,26,'PAV-ITEM-0026',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/bandhej---36--jpg.jpg'),
(27,27,'PAV-ITEM-0027',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/bandhej--37--jpg.jpg'),
(28,28,'PAV-ITEM-0028',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/bandhej--38--jpg.jpg'),
(29,29,'PAV-ITEM-0029',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/bandhej--39--jpg.jpg'),
(30,30,'PAV-ITEM-0030',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/bandhej--40--jpg.jpg'),
(31,31,'PAV-ITEM-0031',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/bandhej--41--jpg.jpg'),
(32,32,'PAV-ITEM-0032',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/bandhej--42--jpg.jpg'),
(33,33,'PAV-ITEM-0033',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/bandhej--43--jpg.jpg'),
(34,34,'PAV-ITEM-0034',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/bandhej--44--jpg.jpg'),
(35,35,'PAV-ITEM-0035',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/c635a240-4520-46ff-95a0-a77f5037b447-jpg.jpg'),
(36,36,'PAV-ITEM-0036',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/c6641a80-7778-4324-baba-2685154e68a5-jpg.jpg'),
(37,37,'PAV-ITEM-0037',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/c7b6473d-35fb-462e-9884-c32adf87b0c3-jpg.jpg'),
(38,38,'PAV-ITEM-0038',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/gotta-patti--57--jpg.jpg'),
(39,39,'PAV-ITEM-0039',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/gotta-patti--58--jpg.jpg'),
(40,40,'PAV-ITEM-0040',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/gotta-patti--59--jpg.jpg'),
(41,41,'PAV-ITEM-0041',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/gotta-patti--60--jpg.jpg'),
(42,42,'PAV-ITEM-0042',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/gotta-patti--61--jpg.jpg'),
(43,43,'PAV-ITEM-0043',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/gotta-patti--62--jpg.jpg'),
(44,44,'PAV-ITEM-0044',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/gotta-patti--63--jpg.jpg'),
(45,45,'PAV-ITEM-0045',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/gotta-patti--64--jpg.jpg'),
(46,46,'PAV-ITEM-0046',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/gotta-patti--65--jpg.jpg'),
(47,47,'PAV-ITEM-0047',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/gotta-patti--66--jpg.jpg'),
(48,48,'PAV-ITEM-0048',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/gotta-patti--67--jpg.jpg'),
(49,49,'PAV-ITEM-0049',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/gotta-patti--68--jpg.jpg'),
(50,50,'PAV-ITEM-0050',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/gotta-patti--69--jpg.jpg'),
(51,51,'PAV-ITEM-0051',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/gotta-patti--70--jpg.jpg'),
(52,52,'PAV-ITEM-0052',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/gotta-patti--71--jpg.jpg'),
(53,53,'PAV-ITEM-0053',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/gotta-patti--72--jpg.jpg'),
(54,54,'PAV-ITEM-0054',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/gotta-patti--73--jpg.jpg'),
(55,55,'PAV-ITEM-0055',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/gotta-patti--74--jpg.jpg'),
(56,56,'PAV-ITEM-0056',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/gotta-patti--75--jpg.jpg'),
(57,57,'PAV-ITEM-0057',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/gotta-patti--76--jpg.jpg'),
(58,58,'PAV-ITEM-0058',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/gotta-patti-bandhej---1--jpg.jpg'),
(59,59,'PAV-ITEM-0059',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/gotta-patti-bandhej---2--jpg.jpg'),
(60,60,'PAV-ITEM-0060',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/gotta-patti-bandhej---3--jpg.jpg'),
(61,61,'PAV-ITEM-0061',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/gotta-patti-bandhej---4--jpg.jpg'),
(62,62,'PAV-ITEM-0062',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/gotta-patti-bandhej---6--jpg.jpg'),
(63,63,'PAV-ITEM-0063',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/gotta-patti-bandhej---7--jpg.jpg'),
(64,64,'PAV-ITEM-0064',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/gotta-patti-bandhej---10--jpg.jpg'),
(65,65,'PAV-ITEM-0065',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/gotta-patti-bandhej---11--jpg.jpg'),
(66,66,'PAV-ITEM-0066',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/gotta-patti-chunri--1--jpg.jpg'),
(67,67,'PAV-ITEM-0067',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/gotta-patti-chunri--2--jpg.jpg'),
(68,68,'PAV-ITEM-0068',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/gotta-patti-chunri--3--jpg.jpg'),
(69,69,'PAV-ITEM-0069',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/gotta-patti-chunri--4--jpg.jpg'),
(70,70,'PAV-ITEM-0070',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/gotta-patti-chunri--5--jpg.jpg'),
(71,71,'PAV-ITEM-0071',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/gotta-patti-chunri--6--jpg.jpg'),
(72,72,'PAV-ITEM-0072',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/gotta-patti-chunri--7--jpg.jpg'),
(73,73,'PAV-ITEM-0073',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/gotta-patti-chunri--8--jpg.jpg'),
(74,74,'PAV-ITEM-0074',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/gotta-patti-chunri--9--jpg.jpg'),
(75,75,'PAV-ITEM-0075',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/gotta-patti-chunri--12--jpg.jpg'),
(76,76,'PAV-ITEM-0076',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/gotta-patti-chunri--13--jpg.jpg'),
(77,77,'PAV-ITEM-0077',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/gotta-patti-chunri--14--jpg.jpg'),
(78,78,'PAV-ITEM-0078',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/gotta-patti-chunri--15--jpg.jpg'),
(79,79,'PAV-ITEM-0079',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/gotta-patti-chunri--16--jpg.jpg'),
(80,80,'PAV-ITEM-0080',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/gotta-patti-chunri--17--jpg.jpg'),
(81,81,'PAV-ITEM-0081',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/gotta-patti-chunri--18--jpg.jpg'),
(82,82,'PAV-ITEM-0082',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/gotta-patti-chunri--19--jpg.jpg'),
(83,83,'PAV-ITEM-0083',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/gotta-patti-chunri--20--jpg.jpg'),
(84,84,'PAV-ITEM-0084',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/gotta-patti-chunri--21--jpg.jpg'),
(85,85,'PAV-ITEM-0085',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/gotta-patti-chunri--22--jpg.jpg'),
(86,86,'PAV-ITEM-0086',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/gotta-patti-chunri--23--jpg.jpg'),
(87,87,'PAV-ITEM-0087',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/gotta-patti-chunri--24--jpg.jpg'),
(88,88,'PAV-ITEM-0088',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/gotta-patti-chunri--25--jpg.jpg'),
(89,89,'PAV-ITEM-0089',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/gotta-patti-chunri--26--jpg.jpg'),
(90,90,'PAV-ITEM-0090',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/gotta-patti-chunri--27--jpg.jpg'),
(91,91,'PAV-ITEM-0091',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/gotta-patti-chunri--28--jpg.jpg'),
(92,92,'PAV-ITEM-0092',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/gotta-patti-chunri--29--jpg.jpg'),
(93,93,'PAV-ITEM-0093',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/gotta-patti-chunri--30--jpg.jpg'),
(94,94,'PAV-ITEM-0094',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/gotta-patti-chunri--31--jpg.jpg'),
(95,95,'PAV-ITEM-0095',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/gotta-patti-chunri--32--jpg.jpg'),
(96,96,'PAV-ITEM-0096',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/gotta-patti-chunri--33--jpg.jpg'),
(97,97,'PAV-ITEM-0097',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/gotta-patti-chunri--34--jpg.jpg'),
(98,98,'PAV-ITEM-0098',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/gotta-patti-chunri--35--jpg.jpg'),
(99,99,'PAV-ITEM-0099',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/gotta-patti-chunri--36--jpg.jpg'),
(100,100,'PAV-ITEM-0100',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/gotta-patti-chunri--37--jpg.jpg'),
(101,101,'PAV-ITEM-0101',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/gotta-patti-chunri--38--jpg.jpg'),
(102,102,'PAV-ITEM-0102',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/gotta-patti-chunri--39--jpg.jpg'),
(103,103,'PAV-ITEM-0103',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/gotta-patti-chunri--40--jpg.jpg'),
(104,104,'PAV-ITEM-0104',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/gotta-patti-chunri--41--jpg.jpg'),
(105,105,'PAV-ITEM-0105',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/gotta-patti-chunri--42--jpg.jpg'),
(106,106,'PAV-ITEM-0106',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/gotta-patti-chunri--43--jpg.jpg'),
(107,107,'PAV-ITEM-0107',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/gotta-patti-chunri--44--jpg.jpg'),
(108,108,'PAV-ITEM-0108',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/gotta-patti-chunri--45--jpg.jpg'),
(109,109,'PAV-ITEM-0109',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/gotta-patti-chunri--46--jpg.jpg'),
(110,110,'PAV-ITEM-0110',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/gotta-patti-chunri--47--jpg.jpg'),
(111,111,'PAV-ITEM-0111',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/gotta-patti-chunri--48--jpg.jpg'),
(112,112,'PAV-ITEM-0112',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/gotta-patti-chunri--49--jpg.jpg'),
(113,113,'PAV-ITEM-0113',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/gotta-patti-chunri--50--jpg.jpg'),
(114,114,'PAV-ITEM-0114',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/gotta-patti-chunri--51--jpg.jpg'),
(115,115,'PAV-ITEM-0115',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/gotta-patti-chunri--52--jpg.jpg'),
(116,116,'PAV-ITEM-0116',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/gotta-patti-chunri--53--jpg.jpg'),
(117,117,'PAV-ITEM-0117',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/gotta-patti-chunri--54--jpg.jpg'),
(118,118,'PAV-ITEM-0118',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/gotta-patti-chunri--55--jpg.jpg'),
(119,119,'PAV-ITEM-0119',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/gotta-patti-chunri--56--jpg.jpg'),
(120,120,'PAV-ITEM-0120',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/gotta-patti-chunri--57--jpg.jpg'),
(121,121,'PAV-ITEM-0121',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/gotta-patti-chunri--58--jpg.jpg'),
(122,122,'PAV-ITEM-0122',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/gotta-patti-chunri--59--jpg.jpg'),
(123,123,'PAV-ITEM-0123',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/gotta-patti-chunri--60--jpg.jpg'),
(124,124,'PAV-ITEM-0124',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/gotta-patti-chunri--61--jpg.jpg'),
(125,125,'PAV-ITEM-0125',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/gotta-patti-chunri--62--jpg.jpg'),
(126,126,'PAV-ITEM-0126',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/gotta-patti-chunri--63--jpg.jpg'),
(127,127,'PAV-ITEM-0127',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/gotta-patti-chunri--64--jpg.jpg'),
(128,128,'PAV-ITEM-0128',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/gotta-patti-chunri--65--jpg.jpg'),
(129,129,'PAV-ITEM-0129',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/gotta-patti-chunri--66--jpg.jpg'),
(130,130,'PAV-ITEM-0130',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/gotta-patti-chunri--67--jpg.jpg'),
(131,131,'PAV-ITEM-0131',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/gotta-patti-chunri--68--jpg.jpg'),
(132,132,'PAV-ITEM-0132',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/gotta-patti-chunri--69--jpg.jpg'),
(133,133,'PAV-ITEM-0133',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/gotta-patti-chunri--70--jpg.jpg'),
(134,134,'PAV-ITEM-0134',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/gotta-patti-chunri--71--jpg.jpg'),
(135,135,'PAV-ITEM-0135',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/gotta-patti-chunri--72--jpg.jpg'),
(136,136,'PAV-ITEM-0136',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/gotta-patti-chunri--73--jpg.jpg'),
(137,137,'PAV-ITEM-0137',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/gotta-patti-chunri--74--jpg.jpg'),
(138,138,'PAV-ITEM-0138',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/gotta-patti-chunri--75--jpg.jpg'),
(139,139,'PAV-ITEM-0139',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/gotta-patti-chunri--76--jpg.jpg'),
(140,140,'PAV-ITEM-0140',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/gotta-patti-chunri--77--jpg.jpg'),
(141,141,'PAV-ITEM-0141',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/gotta-patti-chunri--78--jpg.jpg'),
(142,142,'PAV-ITEM-0142',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/gotta-patti-chunri--79--jpg.jpg'),
(143,143,'PAV-ITEM-0143',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/gotta-patti-chunri--80--jpg.jpg'),
(144,144,'PAV-ITEM-0144',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/gotta-patti-chunri--81--jpg.jpg'),
(145,145,'PAV-ITEM-0145',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/gotta-patti-chunri--82--jpg.jpg'),
(146,146,'PAV-ITEM-0146',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/gotta-patti-chunri--83--jpg.jpg'),
(147,147,'PAV-ITEM-0147',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/gotta-patti-chunri--84--jpg.jpg'),
(148,148,'PAV-ITEM-0148',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/gotta-patti-chunri--85--jpg.jpg'),
(149,149,'PAV-ITEM-0149',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/gotta-patti-chunri--86--jpg.jpg'),
(150,150,'PAV-ITEM-0150',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/gotta-patti-chunri--87--jpg.jpg'),
(151,151,'PAV-ITEM-0151',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/gotta-patti-chunri--88--jpg.jpg'),
(152,152,'PAV-ITEM-0152',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/gotta-patti-chunri--89--jpg.jpg'),
(153,153,'PAV-ITEM-0153',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/gotta-patti-chunri--90--jpg.jpg'),
(154,154,'PAV-ITEM-0154',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/gotta-patti-chunri--91--jpg.jpg'),
(155,155,'PAV-ITEM-0155',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/gotta-patti-chunri--92--jpg.jpg'),
(156,156,'PAV-ITEM-0156',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/gotta-patti-chunri--93--jpg.jpg'),
(157,157,'PAV-ITEM-0157',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/gotta-patti-chunri--94--jpg.jpg'),
(158,158,'PAV-ITEM-0158',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/gotta-patti-chunri--95--jpg.jpg'),
(159,159,'PAV-ITEM-0159',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/gotta-patti-chunri--96--jpg.jpg'),
(160,160,'PAV-ITEM-0160',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/gotta-patti-chunri--97--jpg.jpg'),
(161,161,'PAV-ITEM-0161',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/gotta-patti-chunri--98--jpg.jpg'),
(162,162,'PAV-ITEM-0162',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/gotta-patti-chunri--99--jpg.jpg'),
(163,163,'PAV-ITEM-0163',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/gotta-patti-chunri--100--jpg.jpg'),
(164,164,'PAV-ITEM-0164',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/gotta-patti-chunri--101--jpg.jpg'),
(165,165,'PAV-ITEM-0165',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/gotta-patti-chunri--102--jpg.jpg'),
(166,166,'PAV-ITEM-0166',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/gotta-patti-chunri--103--jpg.jpg'),
(167,167,'PAV-ITEM-0167',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/gotta-patti-chunri--104--jpg.jpg'),
(168,168,'PAV-ITEM-0168',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/gotta-patti-chunri--105--jpg.jpg'),
(169,169,'PAV-ITEM-0169',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/gotta-patti-chunri--106--jpg.jpg'),
(170,170,'PAV-ITEM-0170',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/gotta-patti-chunri--107--jpg.jpg'),
(171,171,'PAV-ITEM-0171',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/gotta-patti-chunri--108--jpg.jpg'),
(172,172,'PAV-ITEM-0172',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/gotta-patti-chunri--109--jpg.jpg'),
(173,173,'PAV-ITEM-0173',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/gotta-patti-chunri--110--jpg.jpg'),
(174,174,'PAV-ITEM-0174',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/gotta-patti-chunri--111--jpg.jpg'),
(175,175,'PAV-ITEM-0175',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/gotta-patti-chunri--112--jpg.jpg'),
(176,176,'PAV-ITEM-0176',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/gotta-patti-chunri--113--jpg.jpg'),
(177,177,'PAV-ITEM-0177',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/gotta-patti-chunri--114--jpg.jpg'),
(178,178,'PAV-ITEM-0178',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/gotta-patti-chunri--115--jpg.jpg'),
(179,179,'PAV-ITEM-0179',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/gotta-patti-chunri--116--jpg.jpg'),
(180,180,'PAV-ITEM-0180',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/gotta-patti-chunri--117--jpg.jpg'),
(181,181,'PAV-ITEM-0181',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/gotta-patti-chunri--118--jpg.jpg'),
(182,182,'PAV-ITEM-0182',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/gotta-patti-chunri--119--jpg.jpg'),
(183,183,'PAV-ITEM-0183',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/gotta-patti-chunri--120--jpg.jpg'),
(184,184,'PAV-ITEM-0184',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/gotta-patti-chunri--121--jpg.jpg'),
(185,185,'PAV-ITEM-0185',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/gotta-patti-chunri--122--jpg.jpg'),
(186,186,'PAV-ITEM-0186',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/gotta-patti-chunri--123--jpg.jpg'),
(187,187,'PAV-ITEM-0187',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/gotta-patti-chunri--124--jpg.jpg'),
(188,188,'PAV-ITEM-0188',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/gotta-patti-chunri--125--jpg.jpg'),
(189,189,'PAV-ITEM-0189',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/gotta-patti-chunri--126--jpg.jpg'),
(190,190,'PAV-ITEM-0190',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/gotta-patti-chunri--127--jpg.jpg'),
(191,191,'PAV-ITEM-0191',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/gotta-patti-chunri--128--jpg.jpg'),
(192,192,'PAV-ITEM-0192',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/gotta-patti-chunri--129--jpg.jpg'),
(193,193,'PAV-ITEM-0193',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/gotta-patti-chunri--130--jpg.jpg'),
(194,194,'PAV-ITEM-0194',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/gotta-patti-chunri--131--jpg.jpg'),
(195,195,'PAV-ITEM-0195',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/gotta-patti-chunri--132--jpg.jpg'),
(196,196,'PAV-ITEM-0196',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/gotta-patti-chunri--133--jpg.jpg'),
(197,197,'PAV-ITEM-0197',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/gotta-patti-chunri--134--jpg.jpg'),
(198,198,'PAV-ITEM-0198',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/gotta-patti-chunri--135--jpg.jpg'),
(199,199,'PAV-ITEM-0199',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/gotta-patti-chunri--136--jpg.jpg'),
(200,200,'PAV-ITEM-0200',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/gotta-patti-chunri--137--jpg.jpg'),
(201,201,'PAV-ITEM-0201',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/gotta-patti-chunri--138--jpg.jpg'),
(202,202,'PAV-ITEM-0202',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/gotta-patti-chunri--139--jpg.jpg'),
(203,203,'PAV-ITEM-0203',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/gotta-patti-chunri--140--jpg.jpg'),
(204,204,'PAV-ITEM-0204',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/gotta-patti-chunri--141--jpg.jpg'),
(205,205,'PAV-ITEM-0205',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/gotta-patti-chunri--142--jpg.jpg'),
(206,206,'PAV-ITEM-0206',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/gotta-patti-chunri--143--jpg.jpg'),
(207,207,'PAV-ITEM-0207',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/gotta-patti-chunri--144--jpg.jpg'),
(208,208,'PAV-ITEM-0208',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/gotta-patti-chunri--145--jpg.jpg'),
(209,209,'PAV-ITEM-0209',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/gotta-patti-chunri-146--jpg.jpg'),
(210,210,'PAV-ITEM-0210',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/gotta-patti-chunri-147--jpg.jpg'),
(211,211,'PAV-ITEM-0211',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/gotta-patti-saree--1--jpg.jpg'),
(212,212,'PAV-ITEM-0212',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/gotta-patti-saree--2--jpg.jpg'),
(213,213,'PAV-ITEM-0213',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/gotta-patti-saree--3--jpg.jpg'),
(214,214,'PAV-ITEM-0214',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/gotta-patti-saree--4--jpg.jpg'),
(215,215,'PAV-ITEM-0215',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/gotta-patti-saree--5--jpg.jpg'),
(216,216,'PAV-ITEM-0216',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/gotta-patti-saree--6--jpg.jpg'),
(217,217,'PAV-ITEM-0217',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/gotta-patti-saree--7--jpg.jpg'),
(218,218,'PAV-ITEM-0218',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/gotta-patti-saree--8--jpg.jpg'),
(219,219,'PAV-ITEM-0219',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/gotta-patti-saree--9--jpg.jpg'),
(220,220,'PAV-ITEM-0220',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/gotta-patti-saree--10--jpg.jpg'),
(221,221,'PAV-ITEM-0221',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/gotta-patti-saree--11--jpg.jpg'),
(222,222,'PAV-ITEM-0222',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/gotta-patti-saree--12--jpg.jpg'),
(223,223,'PAV-ITEM-0223',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/gotta-patti-saree--13--jpg.jpg'),
(224,224,'PAV-ITEM-0224',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/gotta-patti-saree--14--jpg.jpg'),
(225,225,'PAV-ITEM-0225',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/gotta-patti-saree--15--jpg.jpg'),
(226,226,'PAV-ITEM-0226',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/gotta-patti-saree--16--jpg.jpg'),
(227,227,'PAV-ITEM-0227',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/gotta-patti-saree--17--jpg.jpg'),
(228,228,'PAV-ITEM-0228',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/gotta-patti-saree--18--jpg.jpg'),
(229,229,'PAV-ITEM-0229',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/gotta-patti-saree--19--jpg.jpg'),
(230,230,'PAV-ITEM-0230',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/gotta-patti-saree--20--jpg.jpg'),
(231,231,'PAV-ITEM-0231',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/gotta-patti-saree--21--jpg.jpg'),
(232,232,'PAV-ITEM-0232',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/gotta-patti-saree--22--jpg.jpg'),
(233,233,'PAV-ITEM-0233',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/gotta-patti-saree--23--jpg.jpg'),
(234,234,'PAV-ITEM-0234',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/gotta-patti-saree--24--jpg.jpg'),
(235,235,'PAV-ITEM-0235',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/gotta-patti-saree--25--jpg.jpg'),
(236,236,'PAV-ITEM-0236',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/gotta-patti-saree--26--jpg.jpg'),
(237,237,'PAV-ITEM-0237',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/gotta-patti-saree--27--jpg.jpg'),
(238,238,'PAV-ITEM-0238',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/gotta-patti-saree--28--jpg.jpg'),
(239,239,'PAV-ITEM-0239',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/gotta-patti-saree--29--jpg.jpg'),
(240,240,'PAV-ITEM-0240',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/gotta-patti-saree--30--jpg.jpg'),
(241,241,'PAV-ITEM-0241',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/gotta-patti-saree--31--jpg.jpg'),
(242,242,'PAV-ITEM-0242',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/gotta-patti-saree--32--jpg.jpg'),
(243,243,'PAV-ITEM-0243',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/gotta-patti-saree--33--jpg.jpg'),
(244,244,'PAV-ITEM-0244',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/gotta-patti-saree--34--jpg.jpg'),
(245,245,'PAV-ITEM-0245',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/gotta-patti-saree--35--jpg.jpg'),
(246,246,'PAV-ITEM-0246',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/gotta-patti-saree--36--jpg.jpg'),
(247,247,'PAV-ITEM-0247',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/gotta-patti-saree--37--jpg.jpg'),
(248,248,'PAV-ITEM-0248',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/gotta-patti-saree--38--jpg.jpg'),
(249,249,'PAV-ITEM-0249',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/gotta-patti-saree--39--jpg.jpg'),
(250,250,'PAV-ITEM-0250',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/gotta-patti-saree--40--jpg.jpg'),
(251,251,'PAV-ITEM-0251',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/gotta-patti-saree--41--jpg.jpg'),
(252,252,'PAV-ITEM-0252',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/gotta-patti-saree--42--jpg.jpg'),
(253,253,'PAV-ITEM-0253',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/gotta-patti-saree--43--jpg.jpg'),
(254,254,'PAV-ITEM-0254',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/gotta-patti-saree--44--jpg.jpg'),
(255,255,'PAV-ITEM-0255',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/gotta-patti-saree--45--jpg.jpg'),
(256,256,'PAV-ITEM-0256',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/gotta-patti-saree--46--jpg.jpg'),
(257,257,'PAV-ITEM-0257',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/gotta-patti-saree--47--jpg.jpg'),
(258,258,'PAV-ITEM-0258',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/gotta-patti-saree--48--jpg.jpg'),
(259,259,'PAV-ITEM-0259',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/gotta-patti-saree--49--jpg.jpg'),
(260,260,'PAV-ITEM-0260',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/gotta-patti-saree--50--jpg.jpg'),
(261,261,'PAV-ITEM-0261',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/gotta-patti-saree--51--jpg.jpg'),
(262,262,'PAV-ITEM-0262',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/gotta-patti-saree--52--jpg.jpg'),
(263,263,'PAV-ITEM-0263',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/gotta-patti-saree--53--jpg.jpg'),
(264,264,'PAV-ITEM-0264',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/gotta-patti-saree--54--jpg.jpg'),
(265,265,'PAV-ITEM-0265',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/gotta-patti-saree--55--jpg.jpg'),
(266,266,'PAV-ITEM-0266',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/gotta-patti-saree--56--jpg.jpg'),
(267,267,'PAV-ITEM-0267',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/gotta-patti-saree--57--jpg.jpg'),
(268,268,'PAV-ITEM-0268',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/gotta-patti-saree--59--jpg.jpg'),
(269,269,'PAV-ITEM-0269',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/gotta-patti-saree--60--jpg.jpg'),
(270,270,'PAV-ITEM-0270',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/gotta-patti-saree--61--jpg.jpg'),
(271,271,'PAV-ITEM-0271',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/gotta-patti-saree--62--jpg.jpg'),
(272,272,'PAV-ITEM-0272',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/gotta-patti-saree--63--jpg.jpg'),
(273,273,'PAV-ITEM-0273',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/gotta-patti-saree--64--jpg.jpg'),
(274,274,'PAV-ITEM-0274',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/gotta-patti-saree--65--jpg.jpg'),
(275,275,'PAV-ITEM-0275',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/gotta-patti-saree--66--jpg.jpg'),
(276,276,'PAV-ITEM-0276',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/gotta-patti-saree--67--jpg.jpg'),
(277,277,'PAV-ITEM-0277',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/gotta-patti-saree--68--jpg.jpg'),
(278,278,'PAV-ITEM-0278',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/gotta-patti-saree--69--jpg.jpg'),
(279,279,'PAV-ITEM-0279',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/gotta-patti-saree--70--jpg.jpg'),
(280,280,'PAV-ITEM-0280',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/gotta-patti-saree--71--jpg.jpg'),
(281,281,'PAV-ITEM-0281',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/gotta-patti-saree--72--jpg.jpg'),
(282,282,'PAV-ITEM-0282',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/gotta-patti-saree--73--jpg.jpg'),
(283,283,'PAV-ITEM-0283',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/gotta-patti-saree--74--jpg.jpg'),
(284,284,'PAV-ITEM-0284',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/gotta-patti-saree--75--jpg.jpg'),
(285,285,'PAV-ITEM-0285',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/gotta-patti-saree--76--jpg.jpg'),
(286,286,'PAV-ITEM-0286',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/gotta-patti-saree--77--jpg.jpg'),
(287,287,'PAV-ITEM-0287',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/gotta-patti-saree--78--jpg.jpg'),
(288,288,'PAV-ITEM-0288',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/gotta-patti-saree--79--jpg.jpg'),
(289,289,'PAV-ITEM-0289',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/gotta-patti-saree--80--jpg.jpg'),
(290,290,'PAV-ITEM-0290',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/gotta-patti-saree--81--jpg.jpg'),
(291,291,'PAV-ITEM-0291',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/gotta-patti-saree--82--jpg.jpg'),
(292,292,'PAV-ITEM-0292',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/gottapatti--1--jpg.jpg'),
(293,293,'PAV-ITEM-0293',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/gottapatti--2--jpg.jpg'),
(294,294,'PAV-ITEM-0294',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/gottapatti--3--jpg.jpg'),
(295,295,'PAV-ITEM-0295',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/gottapatti--4--jpg.jpg'),
(296,296,'PAV-ITEM-0296',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/gottapatti--5--jpg.jpg'),
(297,297,'PAV-ITEM-0297',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/gottapatti--6--jpg.jpg'),
(298,298,'PAV-ITEM-0298',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/gottapatti--7--jpg.jpg'),
(299,299,'PAV-ITEM-0299',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/gottapatti--8--jpg.jpg'),
(300,300,'PAV-ITEM-0300',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/gottapatti--9--jpg.jpg'),
(301,301,'PAV-ITEM-0301',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/gottapatti--10--jpg.jpg'),
(302,302,'PAV-ITEM-0302',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/gottapatti--11--jpg.jpg'),
(303,303,'PAV-ITEM-0303',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/gottapatti--12--jpg.jpg'),
(304,304,'PAV-ITEM-0304',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/gottapatti--13--jpg.jpg'),
(305,305,'PAV-ITEM-0305',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/gottapatti--14--jpg.jpg'),
(306,306,'PAV-ITEM-0306',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/gottapatti--15--jpg.jpg'),
(307,307,'PAV-ITEM-0307',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/gottapatti--16--jpg.jpg'),
(308,308,'PAV-ITEM-0308',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/gottapatti--17--jpg.jpg'),
(309,309,'PAV-ITEM-0309',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/gottapatti--18--jpg.jpg'),
(310,310,'PAV-ITEM-0310',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/gottapatti--19--jpg.jpg'),
(311,311,'PAV-ITEM-0311',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/gottapatti--20--jpg.jpg'),
(312,312,'PAV-ITEM-0312',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/gottapatti--22--jpg.jpg'),
(313,313,'PAV-ITEM-0313',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/gottapatti--23--jpg.jpg'),
(314,314,'PAV-ITEM-0314',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/gottapatti--24--jpg.jpg'),
(315,315,'PAV-ITEM-0315',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/gottapatti--25--jpg.jpg'),
(316,316,'PAV-ITEM-0316',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/gottapatti--26--jpg.jpg'),
(317,317,'PAV-ITEM-0317',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/gottapatti--27--jpg.jpg'),
(318,318,'PAV-ITEM-0318',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/gottapatti--28--jpg.jpg'),
(319,319,'PAV-ITEM-0319',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/gottapatti--29--jpg.jpg'),
(320,320,'PAV-ITEM-0320',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/gottapatti--30--jpg.jpg'),
(321,321,'PAV-ITEM-0321',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/gottapatti--31--jpg.jpg'),
(322,322,'PAV-ITEM-0322',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/gottapatti--32--jpg.jpg'),
(323,323,'PAV-ITEM-0323',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/gottapatti--33--jpg.jpg'),
(324,324,'PAV-ITEM-0324',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/gottapatti--34--jpg.jpg'),
(325,325,'PAV-ITEM-0325',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/gottapatti--35--jpg.jpg'),
(326,326,'PAV-ITEM-0326',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/gottapatti--36--jpg.jpg'),
(327,327,'PAV-ITEM-0327',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/gottapatti--37--jpg.jpg'),
(328,328,'PAV-ITEM-0328',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/gottapatti--39--jpg.jpg'),
(329,329,'PAV-ITEM-0329',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/gottapatti--40--jpg.jpg'),
(330,330,'PAV-ITEM-0330',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/gottapatti--41--jpg.jpg'),
(331,331,'PAV-ITEM-0331',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/gottapatti--42--jpg.jpg'),
(332,332,'PAV-ITEM-0332',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/gottapatti--43--jpg.jpg'),
(333,333,'PAV-ITEM-0333',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/gottapatti--44--jpg.jpg'),
(334,334,'PAV-ITEM-0334',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/gottapatti--45--jpg.jpg'),
(335,335,'PAV-ITEM-0335',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/gottapatti--46--jpg.jpg'),
(336,336,'PAV-ITEM-0336',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/gottapatti--47--jpg.jpg'),
(337,337,'PAV-ITEM-0337',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/gottapatti--48--jpg.jpg'),
(338,338,'PAV-ITEM-0338',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/gottapatti--49--jpg.jpg'),
(339,339,'PAV-ITEM-0339',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/gottapatti--50--jpg.jpg'),
(340,340,'PAV-ITEM-0340',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/gottapatti--51--jpg.jpg'),
(341,341,'PAV-ITEM-0341',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/gottapatti--52--jpg.jpg'),
(342,342,'PAV-ITEM-0342',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/gottapatti--53--jpg.jpg'),
(343,343,'PAV-ITEM-0343',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/gottapatti--54--jpg.jpg'),
(344,344,'PAV-ITEM-0344',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/gottapatti--55--jpg.jpg'),
(345,345,'PAV-ITEM-0345',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/gottapatti--56--jpg.jpg'),
(346,346,'PAV-ITEM-0346',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/lehenga--1--jpg.jpg'),
(347,347,'PAV-ITEM-0347',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/lehenga--2--jpg.jpg'),
(348,348,'PAV-ITEM-0348',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/lehenga--3--jpg.jpg'),
(349,349,'PAV-ITEM-0349',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/lehenga--4--jpg.jpg'),
(350,350,'PAV-ITEM-0350',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/lehenga--5--jpg.jpg'),
(351,351,'PAV-ITEM-0351',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/lehenga--6--jpg.jpg'),
(352,352,'PAV-ITEM-0352',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/lehenga--7--jpg.jpg'),
(353,353,'PAV-ITEM-0353',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/lehenga--8--jpg.jpg'),
(354,354,'PAV-ITEM-0354',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/lehenga--9--jpg.jpg'),
(355,355,'PAV-ITEM-0355',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/lehenga--10--jpg.jpg'),
(356,356,'PAV-ITEM-0356',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/lehenga--11--jpg.jpg'),
(357,357,'PAV-ITEM-0357',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/lehenga--12--jpg.jpg'),
(358,358,'PAV-ITEM-0358',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/lehenga--13--jpg.jpg'),
(359,359,'PAV-ITEM-0359',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/lehenga--14--jpg.jpg'),
(360,360,'PAV-ITEM-0360',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/lehenga--15--jpg.jpg'),
(361,361,'PAV-ITEM-0361',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/lehenga--16--jpg.jpg'),
(362,362,'PAV-ITEM-0362',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/lehenga--17--jpg.jpg'),
(363,363,'PAV-ITEM-0363',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/lehenga--18--jpg.jpg'),
(364,364,'PAV-ITEM-0364',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/lehenga--19--jpg.jpg'),
(365,365,'PAV-ITEM-0365',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/lehenga--20--jpg.jpg'),
(366,366,'PAV-ITEM-0366',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/lehenga--21--jpg.jpg'),
(367,367,'PAV-ITEM-0367',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/lehenga--22--jpg.jpg'),
(368,368,'PAV-ITEM-0368',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/lehenga--23--jpg.jpg'),
(369,369,'PAV-ITEM-0369',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/lehenga--24--jpg.jpg'),
(370,370,'PAV-ITEM-0370',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/lehenge-7--jpg.jpg'),
(371,371,'PAV-ITEM-0371',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/lehenge-8--jpg.jpg'),
(372,372,'PAV-ITEM-0372',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/lehenge-9--jpg.jpg'),
(373,373,'PAV-ITEM-0373',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/lehenge-10--jpg.jpg'),
(374,374,'PAV-ITEM-0374',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/lehenge-11--jpg.jpg'),
(375,375,'PAV-ITEM-0375',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/lehenge-12--jpg.jpg'),
(376,376,'PAV-ITEM-0376',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/lehenge-13--jpg.jpg'),
(377,377,'PAV-ITEM-0377',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/lehenge-14--jpg.jpg'),
(378,378,'PAV-ITEM-0378',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/lehenge-15--jpg.jpg'),
(379,379,'PAV-ITEM-0379',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/lehenge-16--jpg.jpg'),
(380,380,'PAV-ITEM-0380',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/lehenge-17--jpg.jpg'),
(381,381,'PAV-ITEM-0381',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/lehenge-18--jpg.jpg'),
(382,382,'PAV-ITEM-0382',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/lehenge-19--jpg.jpg'),
(383,383,'PAV-ITEM-0383',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/lehenge-20--jpg.jpg'),
(384,384,'PAV-ITEM-0384',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/lehenge-21--jpg.jpg'),
(385,385,'PAV-ITEM-0385',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/lehenge-22--jpg.jpg'),
(386,386,'PAV-ITEM-0386',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/lehenge-23--jpg.jpg'),
(387,387,'PAV-ITEM-0387',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/lehenge-24--jpg.jpg'),
(388,388,'PAV-ITEM-0388',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/lehenge-25--jpg.jpg'),
(389,389,'PAV-ITEM-0389',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/lehenge-26--jpg.jpg'),
(390,390,'PAV-ITEM-0390',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/lehenge-28--jpg.jpg'),
(391,391,'PAV-ITEM-0391',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/lehenge-29--jpg.jpg'),
(392,392,'PAV-ITEM-0392',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/lehenge-30--jpg.jpg'),
(393,393,'PAV-ITEM-0393',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/lehenge-31--jpg.jpg'),
(394,394,'PAV-ITEM-0394',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/lehenge-32--jpg.jpg'),
(395,395,'PAV-ITEM-0395',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/lehenge-33--jpg.jpg'),
(396,396,'PAV-ITEM-0396',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/lehenge-34--jpg.jpg'),
(397,397,'PAV-ITEM-0397',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/lehenge-35--jpg.jpg'),
(398,398,'PAV-ITEM-0398',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/lehenge-36--jpg.jpg'),
(399,399,'PAV-ITEM-0399',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/lehenge-37--jpg.jpg'),
(400,400,'PAV-ITEM-0400',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/lehenge-38--jpg.jpg'),
(401,401,'PAV-ITEM-0401',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/lehenge-39--jpg.jpg'),
(402,402,'PAV-ITEM-0402',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/lehenge-40--jpg.jpg'),
(403,403,'PAV-ITEM-0403',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/lehenge-41--jpg.jpg'),
(404,404,'PAV-ITEM-0404',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/lehenge-42--jpg.jpg'),
(405,405,'PAV-ITEM-0405',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/lehenge-43--jpg.jpg'),
(406,406,'PAV-ITEM-0406',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/lehenge-47--jpg.jpg'),
(407,407,'PAV-ITEM-0407',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/lehenge-48--jpg.jpg'),
(408,408,'PAV-ITEM-0408',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/lehenge-49--jpg.jpg'),
(409,409,'PAV-ITEM-0409',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/lehenge-50--jpg.jpg'),
(410,410,'PAV-ITEM-0410',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/lehenge-51--jpg.jpg'),
(411,411,'PAV-ITEM-0411',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/lehenge-52--jpg.jpg'),
(412,412,'PAV-ITEM-0412',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/lehenge-53--jpg.jpg'),
(413,413,'PAV-ITEM-0413',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/lehenge-54--jpg.jpg'),
(414,414,'PAV-ITEM-0414',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/lehenge-55--jpg.jpg'),
(415,415,'PAV-ITEM-0415',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/lehenge-56--jpg.jpg'),
(416,416,'PAV-ITEM-0416',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/lehenge-57--jpg.jpg'),
(417,417,'PAV-ITEM-0417',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/lehenge-59--jpg.jpg'),
(418,418,'PAV-ITEM-0418',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/lehenge-60--jpg.jpg'),
(419,419,'PAV-ITEM-0419',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/lehenge-61--jpg.jpg'),
(420,420,'PAV-ITEM-0420',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/lehenge-62--jpg.jpg'),
(421,421,'PAV-ITEM-0421',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/lehenge-63--jpg.jpg'),
(422,422,'PAV-ITEM-0422',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/lehenge-64--jpg.jpg'),
(423,423,'PAV-ITEM-0423',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/lehenge-65--jpg.jpg'),
(424,424,'PAV-ITEM-0424',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/lehenge-67--jpg.jpg'),
(425,425,'PAV-ITEM-0425',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/lehenge-68--jpg.jpg'),
(426,426,'PAV-ITEM-0426',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/lehenge-69--jpg.jpg'),
(427,427,'PAV-ITEM-0427',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/lehenge-70--jpg.jpg'),
(428,428,'PAV-ITEM-0428',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/lehenge-71--jpg.jpg'),
(429,429,'PAV-ITEM-0429',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/lehenge-72--jpg.jpg'),
(430,430,'PAV-ITEM-0430',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/lehenge-73--jpg.jpg'),
(431,431,'PAV-ITEM-0431',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/lehenge-77--jpg.jpg'),
(432,432,'PAV-ITEM-0432',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/lehenge-95--jpg.jpg'),
(433,433,'PAV-ITEM-0433',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/light-work--1--jpg.jpg'),
(434,434,'PAV-ITEM-0434',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/light-work--2--jpg.jpg'),
(435,435,'PAV-ITEM-0435',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/light-work--3--jpg.jpg'),
(436,436,'PAV-ITEM-0436',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/light-work--4--jpg.jpg'),
(437,437,'PAV-ITEM-0437',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/light-work--5--jpg.jpg'),
(438,438,'PAV-ITEM-0438',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/light-work--6--jpg.jpg'),
(439,439,'PAV-ITEM-0439',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/light-work--7--jpg.jpg'),
(440,440,'PAV-ITEM-0440',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/light-work--8--jpg.jpg'),
(441,441,'PAV-ITEM-0441',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/new--1--jpg.jpg'),
(442,442,'PAV-ITEM-0442',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/new--2--jpg.jpg'),
(443,443,'PAV-ITEM-0443',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/new--3--jpg.jpg'),
(444,444,'PAV-ITEM-0444',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/new--4--jpg.jpg'),
(445,445,'PAV-ITEM-0445',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/new--5--jpg.jpg'),
(446,446,'PAV-ITEM-0446',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/new--6--jpg.jpg'),
(447,447,'PAV-ITEM-0447',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/new--7--jpg.jpg'),
(448,448,'PAV-ITEM-0448',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/new--8--jpg.jpg'),
(449,449,'PAV-ITEM-0449',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/new--9--jpg.jpg'),
(450,450,'PAV-ITEM-0450',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/new--10--jpg.jpg'),
(451,451,'PAV-ITEM-0451',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/new--11--jpg.jpg'),
(452,452,'PAV-ITEM-0452',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/new--12--jpg.jpg'),
(453,453,'PAV-ITEM-0453',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/new--13--jpg.jpg'),
(454,454,'PAV-ITEM-0454',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/new--14--jpg.jpg'),
(455,455,'PAV-ITEM-0455',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/new--15--jpg.jpg'),
(456,456,'PAV-ITEM-0456',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/new--16--jpg.jpg'),
(457,457,'PAV-ITEM-0457',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/new--17--jpg.jpg'),
(458,458,'PAV-ITEM-0458',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/new--18--jpg.jpg'),
(459,459,'PAV-ITEM-0459',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/new--19--jpg.jpg'),
(460,460,'PAV-ITEM-0460',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/new--20--jpg.jpg'),
(461,461,'PAV-ITEM-0461',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/new--21--jpg.jpg'),
(462,462,'PAV-ITEM-0462',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/new--22--jpg.jpg'),
(463,463,'PAV-ITEM-0463',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/new--23--jpg.jpg'),
(464,464,'PAV-ITEM-0464',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/new--24--jpg.jpg'),
(465,465,'PAV-ITEM-0465',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/new-lehenge--1--jpeg.jpg'),
(466,466,'PAV-ITEM-0466',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/new-lehenge--2--jpeg.jpg'),
(467,467,'PAV-ITEM-0467',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/new-lehenge--3--jpeg.jpg'),
(468,468,'PAV-ITEM-0468',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/pavitra-png.jpg'),
(469,469,'PAV-ITEM-0469',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/photo-6280397288601489454-y-jpg.jpg'),
(470,470,'PAV-ITEM-0470',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/photo-6280397288601489455-y-jpg.jpg'),
(471,471,'PAV-ITEM-0471',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/photo-6280397288601489456-y-jpg.jpg'),
(472,472,'PAV-ITEM-0472',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/photo-6280397288601489489-y-jpg.jpg'),
(473,473,'PAV-ITEM-0473',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/photo-6280397288601489490-y-jpg.jpg'),
(474,474,'PAV-ITEM-0474',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/pittan-work--1--jpg.jpg'),
(475,475,'PAV-ITEM-0475',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/pittan-work--2--jpg.jpg'),
(476,476,'PAV-ITEM-0476',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/pittan-work--3--jpg.jpg'),
(477,477,'PAV-ITEM-0477',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/pittan-work--4--jpg.jpg'),
(478,478,'PAV-ITEM-0478',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/pittan-work--5--jpg.jpg'),
(479,479,'PAV-ITEM-0479',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/pittan-work--6--jpg.jpg'),
(480,480,'PAV-ITEM-0480',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/pittan-work--7--jpg.jpg'),
(481,481,'PAV-ITEM-0481',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/pittan-work--8--jpg.jpg'),
(482,482,'PAV-ITEM-0482',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/pittan-work--9--jpg.jpg'),
(483,483,'PAV-ITEM-0483',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/pittan-work--10--jpg.jpg'),
(484,484,'PAV-ITEM-0484',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/pittan-work--11--jpg.jpg'),
(485,485,'PAV-ITEM-0485',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/pittan-work--12--jpg.jpg'),
(486,486,'PAV-ITEM-0486',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/pittan-work--13--jpg.jpg'),
(487,487,'PAV-ITEM-0487',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/pittan-work--14--jpg.jpg'),
(488,488,'PAV-ITEM-0488',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/pittan-work--15--jpg.jpg'),
(489,489,'PAV-ITEM-0489',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/pittan-work--16--jpg.jpg'),
(490,490,'PAV-ITEM-0490',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/pittan-work--17--jpg.jpg'),
(491,491,'PAV-ITEM-0491',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/pittan-work--18--jpg.jpg'),
(492,492,'PAV-ITEM-0492',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/printed--1--jpg.jpg'),
(493,493,'PAV-ITEM-0493',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/printed--2--jpg.jpg'),
(494,494,'PAV-ITEM-0494',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/printed--3--jpg.jpg'),
(495,495,'PAV-ITEM-0495',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/printed--4--jpg.jpg'),
(496,496,'PAV-ITEM-0496',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/printed--5--jpg.jpg'),
(497,497,'PAV-ITEM-0497',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/printed--6--jpg.jpg'),
(498,498,'PAV-ITEM-0498',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/printed--7--jpg.jpg'),
(499,499,'PAV-ITEM-0499',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/printed--8--jpg.jpg'),
(500,500,'PAV-ITEM-0500',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/printed--9--jpg.jpg'),
(501,501,'PAV-ITEM-0501',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/printed--10--jpg.jpg'),
(502,502,'PAV-ITEM-0502',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/printed--11--jpg.jpg'),
(503,503,'PAV-ITEM-0503',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/printed--12--jpg.jpg'),
(504,504,'PAV-ITEM-0504',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/printed--13--jpg.jpg'),
(505,505,'PAV-ITEM-0505',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/printed--14--jpg.jpg'),
(506,506,'PAV-ITEM-0506',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/printed--15--jpg.jpg'),
(507,507,'PAV-ITEM-0507',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/printed--16--jpg.jpg'),
(508,508,'PAV-ITEM-0508',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/printed--17--jpg.jpg'),
(509,509,'PAV-ITEM-0509',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/printed--18--jpg.jpg'),
(510,510,'PAV-ITEM-0510',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/printed--19--jpg.jpg'),
(511,511,'PAV-ITEM-0511',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/printed--20--jpg.jpg'),
(512,512,'PAV-ITEM-0512',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/printed--21--jpg.jpg'),
(513,513,'PAV-ITEM-0513',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/printed--22--jpg.jpg'),
(514,514,'PAV-ITEM-0514',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/printed--23--jpg.jpg'),
(515,515,'PAV-ITEM-0515',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/printed--24--jpg.jpg'),
(516,516,'PAV-ITEM-0516',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/printed--25--jpg.jpg'),
(517,517,'PAV-ITEM-0517',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/printed--26--jpg.jpg'),
(518,518,'PAV-ITEM-0518',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/printed--27--jpg.jpg'),
(519,519,'PAV-ITEM-0519',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/printed--28--jpg.jpg'),
(520,520,'PAV-ITEM-0520',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/printed--29--jpg.jpg'),
(521,521,'PAV-ITEM-0521',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/printed--30--jpg.jpg'),
(522,522,'PAV-ITEM-0522',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/printed--31--jpg.jpg'),
(523,523,'PAV-ITEM-0523',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/printed--32--jpg.jpg'),
(524,524,'PAV-ITEM-0524',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/printed--33--jpg.jpg'),
(525,525,'PAV-ITEM-0525',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/printed--34--jpg.jpg'),
(526,526,'PAV-ITEM-0526',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/printed--35--jpg.jpg'),
(527,527,'PAV-ITEM-0527',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/printed--36--jpg.jpg'),
(528,528,'PAV-ITEM-0528',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/printed--37--jpg.jpg'),
(529,529,'PAV-ITEM-0529',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/printed--38--jpg.jpg'),
(530,530,'PAV-ITEM-0530',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/printed--39--jpg.jpg'),
(531,531,'PAV-ITEM-0531',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/printed--40--jpg.jpg'),
(532,532,'PAV-ITEM-0532',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/printed--41--jpg.jpg'),
(533,533,'PAV-ITEM-0533',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/printed--42--jpg.jpg'),
(534,534,'PAV-ITEM-0534',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/printed--43--jpg.jpg'),
(535,535,'PAV-ITEM-0535',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/printed--44--jpg.jpg'),
(536,536,'PAV-ITEM-0536',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/printed--45--jpg.jpg'),
(537,537,'PAV-ITEM-0537',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/printed--46--jpg.jpg'),
(538,538,'PAV-ITEM-0538',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/printed--47--jpg.jpg'),
(539,539,'PAV-ITEM-0539',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/printed--48--jpg.jpg'),
(540,540,'PAV-ITEM-0540',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/printed--49--jpg.jpg'),
(541,541,'PAV-ITEM-0541',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/printed--50--jpg.jpg'),
(542,542,'PAV-ITEM-0542',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/printed--51--jpg.jpg'),
(543,543,'PAV-ITEM-0543',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/printed--52--jpg.jpg'),
(544,544,'PAV-ITEM-0544',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/printed--53--jpg.jpg'),
(545,545,'PAV-ITEM-0545',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/printed--54--jpg.jpg'),
(546,546,'PAV-ITEM-0546',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/printed--55--jpg.jpg'),
(547,547,'PAV-ITEM-0547',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/printed--56--jpg.jpg'),
(548,548,'PAV-ITEM-0548',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/pyor-gotta-patti--1--jpg.jpg'),
(549,549,'PAV-ITEM-0549',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/pyor-gotta-patti--2--jpg.jpg'),
(550,550,'PAV-ITEM-0550',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/pyor-gotta-patti--3--jpg.jpg'),
(551,551,'PAV-ITEM-0551',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/pyor-gotta-patti--4--jpg.jpg'),
(552,552,'PAV-ITEM-0552',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/pyor-gotta-patti--5--jpg.jpg'),
(553,553,'PAV-ITEM-0553',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/pyor-gotta-patti--6--jpg.jpg'),
(554,554,'PAV-ITEM-0554',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/pyor-gotta-patti--7--jpg.jpg'),
(555,555,'PAV-ITEM-0555',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/pyor-gotta-patti--8--jpg.jpg'),
(556,556,'PAV-ITEM-0556',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/pyor-gotta-patti--9--jpg.jpg'),
(557,557,'PAV-ITEM-0557',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/pyor-gotta-patti--10--jpg.jpg'),
(558,558,'PAV-ITEM-0558',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/pyor-gotta-patti--11--jpg.jpg'),
(559,559,'PAV-ITEM-0559',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/pyor-gotta-patti--12--jpg.jpg'),
(560,560,'PAV-ITEM-0560',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/pyor-gotta-patti--13--jpg.jpg'),
(561,561,'PAV-ITEM-0561',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/pyor-gotta-patti--14--jpg.jpg'),
(562,562,'PAV-ITEM-0562',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/pyor-gotta-patti--15--jpg.jpg'),
(563,563,'PAV-ITEM-0563',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/pyor-gotta-patti--16--jpg.jpg'),
(564,564,'PAV-ITEM-0564',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/pyor-gotta-patti--17--jpg.jpg'),
(565,565,'PAV-ITEM-0565',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/pyor-gotta-patti--18--jpg.jpg'),
(566,566,'PAV-ITEM-0566',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/pyor-gotta-patti--19--jpg.jpg'),
(567,567,'PAV-ITEM-0567',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/pyor-gotta-patti--20--jpg.jpg'),
(568,568,'PAV-ITEM-0568',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/pyor-gotta-patti--21--jpg.jpg'),
(569,569,'PAV-ITEM-0569',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/pyor-gotta-patti--22--jpg.jpg'),
(570,570,'PAV-ITEM-0570',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/pyor-gotta-patti--23--jpg.jpg'),
(571,571,'PAV-ITEM-0571',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/pyor-gotta-patti--24--jpg.jpg'),
(572,572,'PAV-ITEM-0572',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/pyor-gotta-patti--25--jpg.jpg'),
(573,573,'PAV-ITEM-0573',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/pyor-gotta-patti--26--jpg.jpg'),
(574,574,'PAV-ITEM-0574',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/pyor-gotta-patti--27--jpg.jpg'),
(575,575,'PAV-ITEM-0575',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/pyor-gotta-patti--28--jpg.jpg'),
(576,576,'PAV-ITEM-0576',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/pyor-gotta-patti--29--jpg.jpg'),
(577,577,'PAV-ITEM-0577',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/pyor-gotta-patti--30--jpg.jpg'),
(578,578,'PAV-ITEM-0578',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/pyor-gotta-patti--31--jpg.jpg'),
(579,579,'PAV-ITEM-0579',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/pyor-gotta-patti--32--jpg.jpg'),
(580,580,'PAV-ITEM-0580',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/pyor-gotta-patti--33--jpg.jpg'),
(581,581,'PAV-ITEM-0581',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/pyor-gotta-patti--34--jpg.jpg'),
(582,582,'PAV-ITEM-0582',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/pyor-gotta-patti--35--jpg.jpg'),
(583,583,'PAV-ITEM-0583',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/pyor-gotta-patti--36--jpg.jpg'),
(584,584,'PAV-ITEM-0584',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/pyor-gotta-patti--37--jpg.jpg'),
(585,585,'PAV-ITEM-0585',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/pyor-gotta-patti--38--jpg.jpg'),
(586,586,'PAV-ITEM-0586',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/pyor-gotta-patti--39--jpg.jpg'),
(587,587,'PAV-ITEM-0587',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/pyor-gotta-patti--40--jpg.jpg'),
(588,588,'PAV-ITEM-0588',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/pyor-gotta-patti--41--jpg.jpg'),
(589,589,'PAV-ITEM-0589',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/pyor-gotta-patti--42--jpg.jpg'),
(590,590,'PAV-ITEM-0590',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/pyor-gotta-patti--43--jpg.jpg'),
(591,591,'PAV-ITEM-0591',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/pyor-gotta-patti--44--jpg.jpg'),
(592,592,'PAV-ITEM-0592',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/pyor-gotta-patti--45--jpg.jpg'),
(593,593,'PAV-ITEM-0593',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/pyor-gotta-patti--46--jpg.jpg'),
(594,594,'PAV-ITEM-0594',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/pyor-gotta-patti--47--jpg.jpg'),
(595,595,'PAV-ITEM-0595',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/pyor-gotta-patti--48--jpg.jpg'),
(596,596,'PAV-ITEM-0596',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/pyor-gotta-patti--49--jpg.jpg'),
(597,597,'PAV-ITEM-0597',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/pyor-gotta-patti--50--jpg.jpg'),
(598,598,'PAV-ITEM-0598',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/pyor-gotta-patti--51--jpg.jpg'),
(599,599,'PAV-ITEM-0599',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/pyor-gotta-patti--52--jpg.jpg'),
(600,600,'PAV-ITEM-0600',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/pyor-gotta-patti--53--jpg.jpg'),
(601,601,'PAV-ITEM-0601',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/pyor-gotta-patti--54--jpg.jpg'),
(602,602,'PAV-ITEM-0602',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/pyor-gotta-patti--55--jpg.jpg'),
(603,603,'PAV-ITEM-0603',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/pyor-gotta-patti---56--jpg.jpg'),
(604,604,'PAV-ITEM-0604',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/pyor-gotta-patti---57--jpg.jpg'),
(605,605,'PAV-ITEM-0605',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/pyor-gotta-patti---58--jpg.jpg'),
(606,606,'PAV-ITEM-0606',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/pyor-gotta-patti--58--jpg.jpg'),
(607,607,'PAV-ITEM-0607',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/sifon-chunri--1--jpg.jpg'),
(608,608,'PAV-ITEM-0608',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/sifon-chunri--2--jpg.jpg'),
(609,609,'PAV-ITEM-0609',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/sifon-chunri--3--jpg.jpg'),
(610,610,'PAV-ITEM-0610',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/sifon-chunri--4--jpg.jpg'),
(611,611,'PAV-ITEM-0611',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/sifon-chunri--5--jpg.jpg'),
(612,612,'PAV-ITEM-0612',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/sifon-chunri--6--jpg.jpg'),
(613,613,'PAV-ITEM-0613',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/sifon-chunri--7--jpg.jpg'),
(614,614,'PAV-ITEM-0614',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/sifon-chunri--8--jpg.jpg'),
(615,615,'PAV-ITEM-0615',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/sifon-chunri--9--jpg.jpg'),
(616,616,'PAV-ITEM-0616',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/sifon-chunri--10--jpg.jpg'),
(617,617,'PAV-ITEM-0617',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/sifon-chunri--11--jpg.jpg'),
(618,618,'PAV-ITEM-0618',NULL,NULL,NULL,NULL,1900.00,1600.00,5,10,'/uploads/products/sifon-chunri--12--jpg.jpg'),
(619,619,'PAV-ITEM-0619',NULL,NULL,NULL,NULL,1950.00,1650.00,5,10,'/uploads/products/sitarawork--1--jpg.jpg'),
(620,620,'PAV-ITEM-0620',NULL,NULL,NULL,NULL,1500.00,1200.00,5,10,'/uploads/products/sitarawork--2--jpg.jpg'),
(621,621,'PAV-ITEM-0621',NULL,NULL,NULL,NULL,1550.00,1250.00,5,10,'/uploads/products/sitarawork--3--jpg.jpg'),
(622,622,'PAV-ITEM-0622',NULL,NULL,NULL,NULL,1600.00,1300.00,5,10,'/uploads/products/sitarawork-6--jpg.jpg'),
(623,623,'PAV-ITEM-0623',NULL,NULL,NULL,NULL,1650.00,1350.00,5,10,'/uploads/products/sitarawork-7--jpg.jpg'),
(624,624,'PAV-ITEM-0624',NULL,NULL,NULL,NULL,1700.00,1400.00,5,10,'/uploads/products/sitarawork-8--jpg.jpg'),
(625,625,'PAV-ITEM-0625',NULL,NULL,NULL,NULL,1750.00,1450.00,5,10,'/uploads/products/sitarawork-9--jpg.jpg'),
(626,626,'PAV-ITEM-0626',NULL,NULL,NULL,NULL,1800.00,1500.00,5,10,'/uploads/products/sitarawork-10--jpg.jpg'),
(627,627,'PAV-ITEM-0627',NULL,NULL,NULL,NULL,1850.00,1550.00,5,10,'/uploads/products/sitarawork-11--jpg.jpg');
/*!40000 ALTER TABLE `product_variants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `product_videos`
--

LOCK TABLES `product_videos` WRITE;
/*!40000 ALTER TABLE `product_videos` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_videos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES
(1,'Bandhej','Beautiful Bandhej made of Soft Silk suitable for Party Wear.',2,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:43','2026-07-17 11:14:43'),
(2,'Bandhej','Beautiful Bandhej made of Organza suitable for Festival Wear.',3,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:43','2026-07-17 11:14:43'),
(3,'Bandhej','Beautiful Bandhej made of Georgette suitable for Office Wear.',4,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:43','2026-07-17 11:14:43'),
(4,'Bandhej','Beautiful Bandhej made of Chiffon suitable for Daily Wear.',5,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:43','2026-07-17 11:14:43'),
(5,'Bandhej','Beautiful Bandhej made of Cotton suitable for Reception Collection.',6,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:43','2026-07-17 11:14:43'),
(6,'Bandhej','Beautiful Bandhej made of Tissue suitable for Haldi Collection.',7,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:43','2026-07-17 11:14:43'),
(7,'Bandhej','Beautiful Bandhej made of Linen suitable for Mehendi Collection.',8,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:43','2026-07-17 11:14:43'),
(8,'Bandhej','Beautiful Bandhej made of Pure Silk suitable for Sangeet Collection.',9,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:43','2026-07-17 11:14:43'),
(9,'Bandhej','Beautiful Bandhej made of Soft Silk suitable for Wedding Wear.',10,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:43','2026-07-17 11:14:43'),
(10,'Bandhej','Beautiful Bandhej made of Organza suitable for Party Wear.',11,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:43','2026-07-17 11:14:43'),
(11,'Bandhej','Beautiful Bandhej made of Georgette suitable for Festival Wear.',12,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:43','2026-07-17 11:14:43'),
(12,'Bandhej','Beautiful Bandhej made of Chiffon suitable for Office Wear.',13,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:43','2026-07-17 11:14:43'),
(13,'Bandhej','Beautiful Bandhej made of Cotton suitable for Daily Wear.',14,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:43','2026-07-17 11:14:43'),
(14,'Bandhej','Beautiful Bandhej made of Tissue suitable for Reception Collection.',15,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:43','2026-07-17 11:14:43'),
(15,'Bandhej','Beautiful Bandhej made of Linen suitable for Haldi Collection.',16,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:43','2026-07-17 11:14:43'),
(16,'Bandhej','Beautiful Bandhej made of Pure Silk suitable for Mehendi Collection.',17,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:43','2026-07-17 11:14:43'),
(17,'Bandhej','Beautiful Bandhej made of Soft Silk suitable for Sangeet Collection.',18,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:43','2026-07-17 11:14:43'),
(18,'Bandhej','Beautiful Bandhej made of Organza suitable for Wedding Wear.',19,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:43','2026-07-17 11:14:43'),
(19,'Bandhej','Beautiful Bandhej made of Georgette suitable for Party Wear.',20,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:43','2026-07-17 11:14:43'),
(20,'Bandhej','Beautiful Bandhej made of Chiffon suitable for Festival Wear.',1,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:43','2026-07-17 11:14:43'),
(21,'Bandhej','Beautiful Bandhej made of Cotton suitable for Office Wear.',2,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:43','2026-07-17 11:14:43'),
(22,'Bandhej','Beautiful Bandhej made of Tissue suitable for Daily Wear.',3,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(23,'Bandhej','Beautiful Bandhej made of Linen suitable for Reception Collection.',4,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(24,'Bandhej','Beautiful Bandhej made of Pure Silk suitable for Haldi Collection.',5,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(25,'Bandhej','Beautiful Bandhej made of Soft Silk suitable for Mehendi Collection.',6,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(26,'Bandhej','Beautiful Bandhej made of Organza suitable for Sangeet Collection.',7,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(27,'Bandhej','Beautiful Bandhej made of Georgette suitable for Wedding Wear.',8,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(28,'Bandhej','Beautiful Bandhej made of Chiffon suitable for Party Wear.',9,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(29,'Bandhej','Beautiful Bandhej made of Cotton suitable for Festival Wear.',10,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(30,'Bandhej','Beautiful Bandhej made of Tissue suitable for Office Wear.',11,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(31,'Bandhej','Beautiful Bandhej made of Linen suitable for Daily Wear.',12,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(32,'Bandhej','Beautiful Bandhej made of Pure Silk suitable for Reception Collection.',13,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(33,'Bandhej','Beautiful Bandhej made of Soft Silk suitable for Haldi Collection.',14,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(34,'Bandhej','Beautiful Bandhej made of Organza suitable for Mehendi Collection.',15,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(35,'c635a240-4520-46ff-95a0-a77f5037b447','Beautiful c635a240-4520-46ff-95a0-a77f5037b447 made of Georgette suitable for Sangeet Collection.',16,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(36,'c6641a80-7778-4324-baba-2685154e68a5','Beautiful c6641a80-7778-4324-baba-2685154e68a5 made of Chiffon suitable for Wedding Wear.',17,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(37,'c7b6473d-35fb-462e-9884-c32adf87b0c3','Beautiful c7b6473d-35fb-462e-9884-c32adf87b0c3 made of Cotton suitable for Party Wear.',18,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(38,'Gotta Patti','Beautiful Gotta Patti made of Tissue suitable for Festival Wear.',19,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(39,'Gotta Patti','Beautiful Gotta Patti made of Linen suitable for Office Wear.',20,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(40,'Gotta Patti','Beautiful Gotta Patti made of Pure Silk suitable for Daily Wear.',1,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(41,'Gotta Patti','Beautiful Gotta Patti made of Soft Silk suitable for Reception Collection.',2,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(42,'Gotta Patti','Beautiful Gotta Patti made of Organza suitable for Haldi Collection.',3,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(43,'Gotta Patti','Beautiful Gotta Patti made of Georgette suitable for Mehendi Collection.',4,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(44,'Gotta Patti','Beautiful Gotta Patti made of Chiffon suitable for Sangeet Collection.',5,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(45,'Gotta Patti','Beautiful Gotta Patti made of Cotton suitable for Wedding Wear.',6,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(46,'Gotta Patti','Beautiful Gotta Patti made of Tissue suitable for Party Wear.',7,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(47,'Gotta Patti','Beautiful Gotta Patti made of Linen suitable for Festival Wear.',8,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(48,'Gotta Patti','Beautiful Gotta Patti made of Pure Silk suitable for Office Wear.',9,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(49,'Gotta Patti','Beautiful Gotta Patti made of Soft Silk suitable for Daily Wear.',10,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(50,'Gotta Patti','Beautiful Gotta Patti made of Organza suitable for Reception Collection.',11,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(51,'Gotta Patti','Beautiful Gotta Patti made of Georgette suitable for Haldi Collection.',12,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(52,'Gotta Patti','Beautiful Gotta Patti made of Chiffon suitable for Mehendi Collection.',13,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(53,'Gotta Patti','Beautiful Gotta Patti made of Cotton suitable for Sangeet Collection.',14,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(54,'Gotta Patti','Beautiful Gotta Patti made of Tissue suitable for Wedding Wear.',15,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(55,'Gotta Patti','Beautiful Gotta Patti made of Linen suitable for Party Wear.',16,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(56,'Gotta Patti','Beautiful Gotta Patti made of Pure Silk suitable for Festival Wear.',17,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(57,'Gotta Patti','Beautiful Gotta Patti made of Soft Silk suitable for Office Wear.',18,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(58,'gotta patti Bandhej','Beautiful gotta patti Bandhej made of Organza suitable for Daily Wear.',19,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(59,'gotta patti Bandhej','Beautiful gotta patti Bandhej made of Georgette suitable for Reception Collection.',20,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(60,'gotta patti Bandhej','Beautiful gotta patti Bandhej made of Chiffon suitable for Haldi Collection.',1,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(61,'gotta patti Bandhej','Beautiful gotta patti Bandhej made of Cotton suitable for Mehendi Collection.',2,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(62,'gotta patti Bandhej','Beautiful gotta patti Bandhej made of Tissue suitable for Sangeet Collection.',3,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(63,'gotta patti Bandhej','Beautiful gotta patti Bandhej made of Linen suitable for Wedding Wear.',4,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(64,'gotta patti Bandhej','Beautiful gotta patti Bandhej made of Pure Silk suitable for Party Wear.',5,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(65,'gotta patti Bandhej','Beautiful gotta patti Bandhej made of Soft Silk suitable for Festival Wear.',6,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(66,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Organza suitable for Office Wear.',7,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(67,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Georgette suitable for Daily Wear.',8,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(68,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Chiffon suitable for Reception Collection.',9,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(69,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Cotton suitable for Haldi Collection.',10,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(70,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Tissue suitable for Mehendi Collection.',11,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(71,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Linen suitable for Sangeet Collection.',12,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(72,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Pure Silk suitable for Wedding Wear.',13,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(73,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Soft Silk suitable for Party Wear.',14,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(74,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Organza suitable for Festival Wear.',15,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(75,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Georgette suitable for Office Wear.',16,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(76,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Chiffon suitable for Daily Wear.',17,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(77,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Cotton suitable for Reception Collection.',18,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(78,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Tissue suitable for Haldi Collection.',19,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(79,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Linen suitable for Mehendi Collection.',20,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(80,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Pure Silk suitable for Sangeet Collection.',1,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(81,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Soft Silk suitable for Wedding Wear.',2,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(82,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Organza suitable for Party Wear.',3,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(83,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Georgette suitable for Festival Wear.',4,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(84,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Chiffon suitable for Office Wear.',5,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(85,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Cotton suitable for Daily Wear.',6,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(86,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Tissue suitable for Reception Collection.',7,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(87,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Linen suitable for Haldi Collection.',8,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(88,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Pure Silk suitable for Mehendi Collection.',9,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(89,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Soft Silk suitable for Sangeet Collection.',10,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(90,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Organza suitable for Wedding Wear.',11,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(91,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Georgette suitable for Party Wear.',12,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(92,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Chiffon suitable for Festival Wear.',13,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(93,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Cotton suitable for Office Wear.',14,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(94,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Tissue suitable for Daily Wear.',15,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(95,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Linen suitable for Reception Collection.',16,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(96,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Pure Silk suitable for Haldi Collection.',17,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(97,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Soft Silk suitable for Mehendi Collection.',18,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(98,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Organza suitable for Sangeet Collection.',19,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(99,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Georgette suitable for Wedding Wear.',20,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(100,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Chiffon suitable for Party Wear.',1,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(101,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Cotton suitable for Festival Wear.',2,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(102,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Tissue suitable for Office Wear.',3,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(103,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Linen suitable for Daily Wear.',4,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(104,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Pure Silk suitable for Reception Collection.',5,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(105,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Soft Silk suitable for Haldi Collection.',6,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(106,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Organza suitable for Mehendi Collection.',7,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(107,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Georgette suitable for Sangeet Collection.',8,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(108,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Chiffon suitable for Wedding Wear.',9,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(109,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Cotton suitable for Party Wear.',10,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(110,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Tissue suitable for Festival Wear.',11,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(111,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Linen suitable for Office Wear.',12,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(112,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Pure Silk suitable for Daily Wear.',13,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(113,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Soft Silk suitable for Reception Collection.',14,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(114,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Organza suitable for Haldi Collection.',15,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(115,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Georgette suitable for Mehendi Collection.',16,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(116,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Chiffon suitable for Sangeet Collection.',17,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(117,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Cotton suitable for Wedding Wear.',18,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(118,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Tissue suitable for Party Wear.',19,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(119,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Linen suitable for Festival Wear.',20,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(120,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Pure Silk suitable for Office Wear.',1,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(121,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Soft Silk suitable for Daily Wear.',2,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(122,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Organza suitable for Reception Collection.',3,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(123,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Georgette suitable for Haldi Collection.',4,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(124,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Chiffon suitable for Mehendi Collection.',5,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(125,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Cotton suitable for Sangeet Collection.',6,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(126,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Tissue suitable for Wedding Wear.',7,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(127,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Linen suitable for Party Wear.',8,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(128,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Pure Silk suitable for Festival Wear.',9,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(129,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Soft Silk suitable for Office Wear.',10,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(130,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Organza suitable for Daily Wear.',11,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(131,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Georgette suitable for Reception Collection.',12,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(132,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Chiffon suitable for Haldi Collection.',13,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(133,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Cotton suitable for Mehendi Collection.',14,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(134,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Tissue suitable for Sangeet Collection.',15,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(135,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Linen suitable for Wedding Wear.',16,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(136,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Pure Silk suitable for Party Wear.',17,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(137,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Soft Silk suitable for Festival Wear.',18,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(138,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Organza suitable for Office Wear.',19,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(139,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Georgette suitable for Daily Wear.',20,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(140,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Chiffon suitable for Reception Collection.',1,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(141,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Cotton suitable for Haldi Collection.',2,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(142,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Tissue suitable for Mehendi Collection.',3,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(143,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Linen suitable for Sangeet Collection.',4,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(144,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Pure Silk suitable for Wedding Wear.',5,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(145,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Soft Silk suitable for Party Wear.',6,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(146,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Organza suitable for Festival Wear.',7,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(147,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Georgette suitable for Office Wear.',8,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(148,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Chiffon suitable for Daily Wear.',9,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(149,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Cotton suitable for Reception Collection.',10,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(150,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Tissue suitable for Haldi Collection.',11,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(151,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Linen suitable for Mehendi Collection.',12,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(152,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Pure Silk suitable for Sangeet Collection.',13,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(153,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Soft Silk suitable for Wedding Wear.',14,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(154,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Organza suitable for Party Wear.',15,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(155,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Georgette suitable for Festival Wear.',16,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(156,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Chiffon suitable for Office Wear.',17,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(157,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Cotton suitable for Daily Wear.',18,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(158,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Tissue suitable for Reception Collection.',19,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(159,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Linen suitable for Haldi Collection.',20,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(160,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Pure Silk suitable for Mehendi Collection.',1,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(161,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Soft Silk suitable for Sangeet Collection.',2,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(162,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Organza suitable for Wedding Wear.',3,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(163,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Georgette suitable for Party Wear.',4,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(164,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Chiffon suitable for Festival Wear.',5,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(165,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Cotton suitable for Office Wear.',6,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(166,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Tissue suitable for Daily Wear.',7,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(167,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Linen suitable for Reception Collection.',8,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(168,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Pure Silk suitable for Haldi Collection.',9,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(169,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Soft Silk suitable for Mehendi Collection.',10,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(170,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Organza suitable for Sangeet Collection.',11,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(171,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Georgette suitable for Wedding Wear.',12,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(172,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Chiffon suitable for Party Wear.',13,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(173,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Cotton suitable for Festival Wear.',14,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(174,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Tissue suitable for Office Wear.',15,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(175,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Linen suitable for Daily Wear.',16,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(176,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Pure Silk suitable for Reception Collection.',17,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(177,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Soft Silk suitable for Haldi Collection.',18,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(178,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Organza suitable for Mehendi Collection.',19,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(179,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Georgette suitable for Sangeet Collection.',20,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(180,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Chiffon suitable for Wedding Wear.',1,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(181,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Cotton suitable for Party Wear.',2,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(182,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Tissue suitable for Festival Wear.',3,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(183,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Linen suitable for Office Wear.',4,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(184,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Pure Silk suitable for Daily Wear.',5,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(185,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Soft Silk suitable for Reception Collection.',6,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(186,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Organza suitable for Haldi Collection.',7,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(187,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Georgette suitable for Mehendi Collection.',8,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(188,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Chiffon suitable for Sangeet Collection.',9,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(189,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Cotton suitable for Wedding Wear.',10,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(190,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Tissue suitable for Party Wear.',11,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(191,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Linen suitable for Festival Wear.',12,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(192,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Pure Silk suitable for Office Wear.',13,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(193,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Soft Silk suitable for Daily Wear.',14,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(194,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Organza suitable for Reception Collection.',15,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(195,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Georgette suitable for Haldi Collection.',16,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(196,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Chiffon suitable for Mehendi Collection.',17,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(197,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Cotton suitable for Sangeet Collection.',18,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(198,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Tissue suitable for Wedding Wear.',19,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(199,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Linen suitable for Party Wear.',20,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(200,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Pure Silk suitable for Festival Wear.',1,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(201,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Soft Silk suitable for Office Wear.',2,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(202,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Organza suitable for Daily Wear.',3,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(203,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Georgette suitable for Reception Collection.',4,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(204,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Chiffon suitable for Haldi Collection.',5,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(205,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Cotton suitable for Mehendi Collection.',6,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(206,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Tissue suitable for Sangeet Collection.',7,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(207,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Linen suitable for Wedding Wear.',8,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(208,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Pure Silk suitable for Party Wear.',9,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(209,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Soft Silk suitable for Festival Wear.',10,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(210,'Gotta Patti Chunri','Beautiful Gotta Patti Chunri made of Organza suitable for Office Wear.',11,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(211,'gotta patti saree','Beautiful gotta patti saree made of Georgette suitable for Daily Wear.',12,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(212,'gotta patti saree','Beautiful gotta patti saree made of Chiffon suitable for Reception Collection.',13,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(213,'gotta patti saree','Beautiful gotta patti saree made of Cotton suitable for Haldi Collection.',14,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(214,'gotta patti saree','Beautiful gotta patti saree made of Tissue suitable for Mehendi Collection.',15,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(215,'gotta patti saree','Beautiful gotta patti saree made of Linen suitable for Sangeet Collection.',16,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(216,'gotta patti saree','Beautiful gotta patti saree made of Pure Silk suitable for Wedding Wear.',17,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(217,'gotta patti saree','Beautiful gotta patti saree made of Soft Silk suitable for Party Wear.',18,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(218,'gotta patti saree','Beautiful gotta patti saree made of Organza suitable for Festival Wear.',19,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(219,'gotta patti saree','Beautiful gotta patti saree made of Georgette suitable for Office Wear.',20,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(220,'gotta patti saree','Beautiful gotta patti saree made of Chiffon suitable for Daily Wear.',1,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(221,'gotta patti saree','Beautiful gotta patti saree made of Cotton suitable for Reception Collection.',2,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(222,'gotta patti saree','Beautiful gotta patti saree made of Tissue suitable for Haldi Collection.',3,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(223,'gotta patti saree','Beautiful gotta patti saree made of Linen suitable for Mehendi Collection.',4,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(224,'gotta patti saree','Beautiful gotta patti saree made of Pure Silk suitable for Sangeet Collection.',5,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(225,'gotta patti saree','Beautiful gotta patti saree made of Soft Silk suitable for Wedding Wear.',6,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(226,'gotta patti saree','Beautiful gotta patti saree made of Organza suitable for Party Wear.',7,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(227,'gotta patti saree','Beautiful gotta patti saree made of Georgette suitable for Festival Wear.',8,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(228,'gotta patti saree','Beautiful gotta patti saree made of Chiffon suitable for Office Wear.',9,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(229,'gotta patti saree','Beautiful gotta patti saree made of Cotton suitable for Daily Wear.',10,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(230,'gotta patti saree','Beautiful gotta patti saree made of Tissue suitable for Reception Collection.',11,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(231,'gotta patti saree','Beautiful gotta patti saree made of Linen suitable for Haldi Collection.',12,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(232,'gotta patti saree','Beautiful gotta patti saree made of Pure Silk suitable for Mehendi Collection.',13,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(233,'gotta patti saree','Beautiful gotta patti saree made of Soft Silk suitable for Sangeet Collection.',14,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(234,'gotta patti saree','Beautiful gotta patti saree made of Organza suitable for Wedding Wear.',15,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(235,'gotta patti saree','Beautiful gotta patti saree made of Georgette suitable for Party Wear.',16,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(236,'gotta patti saree','Beautiful gotta patti saree made of Chiffon suitable for Festival Wear.',17,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(237,'gotta patti saree','Beautiful gotta patti saree made of Cotton suitable for Office Wear.',18,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(238,'gotta patti saree','Beautiful gotta patti saree made of Tissue suitable for Daily Wear.',19,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(239,'gotta patti saree','Beautiful gotta patti saree made of Linen suitable for Reception Collection.',20,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(240,'gotta patti saree','Beautiful gotta patti saree made of Pure Silk suitable for Haldi Collection.',1,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(241,'gotta patti saree','Beautiful gotta patti saree made of Soft Silk suitable for Mehendi Collection.',2,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(242,'gotta patti saree','Beautiful gotta patti saree made of Organza suitable for Sangeet Collection.',3,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(243,'gotta patti saree','Beautiful gotta patti saree made of Georgette suitable for Wedding Wear.',4,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(244,'gotta patti saree','Beautiful gotta patti saree made of Chiffon suitable for Party Wear.',5,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(245,'gotta patti saree','Beautiful gotta patti saree made of Cotton suitable for Festival Wear.',6,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(246,'gotta patti saree','Beautiful gotta patti saree made of Tissue suitable for Office Wear.',7,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(247,'gotta patti saree','Beautiful gotta patti saree made of Linen suitable for Daily Wear.',8,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(248,'gotta patti saree','Beautiful gotta patti saree made of Pure Silk suitable for Reception Collection.',9,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(249,'gotta patti saree','Beautiful gotta patti saree made of Soft Silk suitable for Haldi Collection.',10,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(250,'gotta patti saree','Beautiful gotta patti saree made of Organza suitable for Mehendi Collection.',11,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(251,'gotta patti saree','Beautiful gotta patti saree made of Georgette suitable for Sangeet Collection.',12,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(252,'gotta patti saree','Beautiful gotta patti saree made of Chiffon suitable for Wedding Wear.',13,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(253,'gotta patti saree','Beautiful gotta patti saree made of Cotton suitable for Party Wear.',14,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(254,'gotta patti saree','Beautiful gotta patti saree made of Tissue suitable for Festival Wear.',15,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(255,'gotta patti saree','Beautiful gotta patti saree made of Linen suitable for Office Wear.',16,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(256,'gotta patti saree','Beautiful gotta patti saree made of Pure Silk suitable for Daily Wear.',17,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(257,'gotta patti saree','Beautiful gotta patti saree made of Soft Silk suitable for Reception Collection.',18,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(258,'gotta patti saree','Beautiful gotta patti saree made of Organza suitable for Haldi Collection.',19,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(259,'gotta patti saree','Beautiful gotta patti saree made of Georgette suitable for Mehendi Collection.',20,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(260,'gotta patti saree','Beautiful gotta patti saree made of Chiffon suitable for Sangeet Collection.',1,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(261,'gotta patti saree','Beautiful gotta patti saree made of Cotton suitable for Wedding Wear.',2,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(262,'gotta patti saree','Beautiful gotta patti saree made of Tissue suitable for Party Wear.',3,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(263,'gotta patti saree','Beautiful gotta patti saree made of Linen suitable for Festival Wear.',4,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(264,'gotta patti saree','Beautiful gotta patti saree made of Pure Silk suitable for Office Wear.',5,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(265,'gotta patti saree','Beautiful gotta patti saree made of Soft Silk suitable for Daily Wear.',6,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(266,'gotta patti saree','Beautiful gotta patti saree made of Organza suitable for Reception Collection.',7,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(267,'gotta patti saree','Beautiful gotta patti saree made of Georgette suitable for Haldi Collection.',8,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(268,'gotta patti saree','Beautiful gotta patti saree made of Chiffon suitable for Mehendi Collection.',9,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(269,'gotta patti saree','Beautiful gotta patti saree made of Cotton suitable for Sangeet Collection.',10,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(270,'gotta patti saree','Beautiful gotta patti saree made of Tissue suitable for Wedding Wear.',11,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(271,'gotta patti saree','Beautiful gotta patti saree made of Linen suitable for Party Wear.',12,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(272,'gotta patti saree','Beautiful gotta patti saree made of Pure Silk suitable for Festival Wear.',13,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(273,'gotta patti saree','Beautiful gotta patti saree made of Soft Silk suitable for Office Wear.',14,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(274,'gotta patti saree','Beautiful gotta patti saree made of Organza suitable for Daily Wear.',15,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(275,'gotta patti saree','Beautiful gotta patti saree made of Georgette suitable for Reception Collection.',16,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(276,'gotta patti saree','Beautiful gotta patti saree made of Chiffon suitable for Haldi Collection.',17,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(277,'gotta patti saree','Beautiful gotta patti saree made of Cotton suitable for Mehendi Collection.',18,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(278,'gotta patti saree','Beautiful gotta patti saree made of Tissue suitable for Sangeet Collection.',19,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(279,'gotta patti saree','Beautiful gotta patti saree made of Linen suitable for Wedding Wear.',20,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(280,'gotta patti saree','Beautiful gotta patti saree made of Pure Silk suitable for Party Wear.',1,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(281,'gotta patti saree','Beautiful gotta patti saree made of Soft Silk suitable for Festival Wear.',2,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(282,'gotta patti saree','Beautiful gotta patti saree made of Organza suitable for Office Wear.',3,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(283,'gotta patti saree','Beautiful gotta patti saree made of Georgette suitable for Daily Wear.',4,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(284,'gotta patti saree','Beautiful gotta patti saree made of Chiffon suitable for Reception Collection.',5,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(285,'gotta patti saree','Beautiful gotta patti saree made of Cotton suitable for Haldi Collection.',6,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(286,'gotta patti saree','Beautiful gotta patti saree made of Tissue suitable for Mehendi Collection.',7,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(287,'gotta patti saree','Beautiful gotta patti saree made of Linen suitable for Sangeet Collection.',8,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(288,'gotta patti saree','Beautiful gotta patti saree made of Pure Silk suitable for Wedding Wear.',9,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(289,'Gotta Patti saree','Beautiful Gotta Patti saree made of Soft Silk suitable for Party Wear.',10,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(290,'Gotta Patti saree','Beautiful Gotta Patti saree made of Organza suitable for Festival Wear.',11,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(291,'Gotta Patti saree','Beautiful Gotta Patti saree made of Georgette suitable for Office Wear.',12,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(292,'GottaPatti','Beautiful GottaPatti made of Chiffon suitable for Daily Wear.',13,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(293,'GottaPatti','Beautiful GottaPatti made of Cotton suitable for Reception Collection.',14,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(294,'GottaPatti','Beautiful GottaPatti made of Tissue suitable for Haldi Collection.',15,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(295,'GottaPatti','Beautiful GottaPatti made of Linen suitable for Mehendi Collection.',16,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(296,'GottaPatti','Beautiful GottaPatti made of Pure Silk suitable for Sangeet Collection.',17,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(297,'GottaPatti','Beautiful GottaPatti made of Soft Silk suitable for Wedding Wear.',18,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(298,'GottaPatti','Beautiful GottaPatti made of Organza suitable for Party Wear.',19,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(299,'GottaPatti','Beautiful GottaPatti made of Georgette suitable for Festival Wear.',20,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(300,'GottaPatti','Beautiful GottaPatti made of Chiffon suitable for Office Wear.',1,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(301,'GottaPatti','Beautiful GottaPatti made of Cotton suitable for Daily Wear.',2,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(302,'GottaPatti','Beautiful GottaPatti made of Tissue suitable for Reception Collection.',3,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(303,'GottaPatti','Beautiful GottaPatti made of Linen suitable for Haldi Collection.',4,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(304,'GottaPatti','Beautiful GottaPatti made of Pure Silk suitable for Mehendi Collection.',5,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(305,'GottaPatti','Beautiful GottaPatti made of Soft Silk suitable for Sangeet Collection.',6,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(306,'GottaPatti','Beautiful GottaPatti made of Organza suitable for Wedding Wear.',7,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(307,'GottaPatti','Beautiful GottaPatti made of Georgette suitable for Party Wear.',8,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(308,'GottaPatti','Beautiful GottaPatti made of Chiffon suitable for Festival Wear.',9,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(309,'GottaPatti','Beautiful GottaPatti made of Cotton suitable for Office Wear.',10,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(310,'GottaPatti','Beautiful GottaPatti made of Tissue suitable for Daily Wear.',11,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(311,'GottaPatti','Beautiful GottaPatti made of Linen suitable for Reception Collection.',12,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(312,'GottaPatti','Beautiful GottaPatti made of Pure Silk suitable for Haldi Collection.',13,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(313,'GottaPatti','Beautiful GottaPatti made of Soft Silk suitable for Mehendi Collection.',14,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(314,'GottaPatti','Beautiful GottaPatti made of Organza suitable for Sangeet Collection.',15,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:44','2026-07-17 11:14:44'),
(315,'GottaPatti','Beautiful GottaPatti made of Georgette suitable for Wedding Wear.',16,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(316,'GottaPatti','Beautiful GottaPatti made of Chiffon suitable for Party Wear.',17,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(317,'GottaPatti','Beautiful GottaPatti made of Cotton suitable for Festival Wear.',18,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(318,'GottaPatti','Beautiful GottaPatti made of Tissue suitable for Office Wear.',19,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(319,'GottaPatti','Beautiful GottaPatti made of Linen suitable for Daily Wear.',20,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(320,'GottaPatti','Beautiful GottaPatti made of Pure Silk suitable for Reception Collection.',1,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(321,'GottaPatti','Beautiful GottaPatti made of Soft Silk suitable for Haldi Collection.',2,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(322,'GottaPatti','Beautiful GottaPatti made of Organza suitable for Mehendi Collection.',3,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(323,'GottaPatti','Beautiful GottaPatti made of Georgette suitable for Sangeet Collection.',4,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(324,'GottaPatti','Beautiful GottaPatti made of Chiffon suitable for Wedding Wear.',5,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(325,'GottaPatti','Beautiful GottaPatti made of Cotton suitable for Party Wear.',6,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(326,'GottaPatti','Beautiful GottaPatti made of Tissue suitable for Festival Wear.',7,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(327,'GottaPatti','Beautiful GottaPatti made of Linen suitable for Office Wear.',8,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(328,'GottaPatti','Beautiful GottaPatti made of Pure Silk suitable for Daily Wear.',9,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(329,'GottaPatti','Beautiful GottaPatti made of Soft Silk suitable for Reception Collection.',10,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(330,'GottaPatti','Beautiful GottaPatti made of Organza suitable for Haldi Collection.',11,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(331,'GottaPatti','Beautiful GottaPatti made of Georgette suitable for Mehendi Collection.',12,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(332,'GottaPatti','Beautiful GottaPatti made of Chiffon suitable for Sangeet Collection.',13,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(333,'GottaPatti','Beautiful GottaPatti made of Cotton suitable for Wedding Wear.',14,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(334,'GottaPatti','Beautiful GottaPatti made of Tissue suitable for Party Wear.',15,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(335,'GottaPatti','Beautiful GottaPatti made of Linen suitable for Festival Wear.',16,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(336,'GottaPatti','Beautiful GottaPatti made of Pure Silk suitable for Office Wear.',17,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(337,'GottaPatti','Beautiful GottaPatti made of Soft Silk suitable for Daily Wear.',18,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(338,'GottaPatti','Beautiful GottaPatti made of Organza suitable for Reception Collection.',19,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(339,'GottaPatti','Beautiful GottaPatti made of Georgette suitable for Haldi Collection.',20,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(340,'GottaPatti','Beautiful GottaPatti made of Chiffon suitable for Mehendi Collection.',1,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(341,'GottaPatti','Beautiful GottaPatti made of Cotton suitable for Sangeet Collection.',2,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(342,'GottaPatti','Beautiful GottaPatti made of Tissue suitable for Wedding Wear.',3,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(343,'GottaPatti','Beautiful GottaPatti made of Linen suitable for Party Wear.',4,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(344,'GottaPatti','Beautiful GottaPatti made of Pure Silk suitable for Festival Wear.',5,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(345,'GottaPatti','Beautiful GottaPatti made of Soft Silk suitable for Office Wear.',6,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(346,'lehenga','Beautiful lehenga made of Organza suitable for Daily Wear.',7,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(347,'lehenga','Beautiful lehenga made of Georgette suitable for Reception Collection.',8,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(348,'lehenga','Beautiful lehenga made of Chiffon suitable for Haldi Collection.',9,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(349,'lehenga','Beautiful lehenga made of Cotton suitable for Mehendi Collection.',10,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(350,'lehenga','Beautiful lehenga made of Tissue suitable for Sangeet Collection.',11,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(351,'lehenga','Beautiful lehenga made of Linen suitable for Wedding Wear.',12,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(352,'lehenga','Beautiful lehenga made of Pure Silk suitable for Party Wear.',13,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(353,'lehenga','Beautiful lehenga made of Soft Silk suitable for Festival Wear.',14,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(354,'lehenga','Beautiful lehenga made of Organza suitable for Office Wear.',15,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(355,'lehenga','Beautiful lehenga made of Georgette suitable for Daily Wear.',16,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(356,'lehenga','Beautiful lehenga made of Chiffon suitable for Reception Collection.',17,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(357,'lehenga','Beautiful lehenga made of Cotton suitable for Haldi Collection.',18,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(358,'lehenga','Beautiful lehenga made of Tissue suitable for Mehendi Collection.',19,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(359,'lehenga','Beautiful lehenga made of Linen suitable for Sangeet Collection.',20,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(360,'lehenga','Beautiful lehenga made of Pure Silk suitable for Wedding Wear.',1,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(361,'lehenga','Beautiful lehenga made of Soft Silk suitable for Party Wear.',2,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(362,'lehenga','Beautiful lehenga made of Organza suitable for Festival Wear.',3,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(363,'lehenga','Beautiful lehenga made of Georgette suitable for Office Wear.',4,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(364,'lehenga','Beautiful lehenga made of Chiffon suitable for Daily Wear.',5,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(365,'lehenga','Beautiful lehenga made of Cotton suitable for Reception Collection.',6,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(366,'lehenga','Beautiful lehenga made of Tissue suitable for Haldi Collection.',7,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(367,'lehenga','Beautiful lehenga made of Linen suitable for Mehendi Collection.',8,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(368,'lehenga','Beautiful lehenga made of Pure Silk suitable for Sangeet Collection.',9,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(369,'lehenga','Beautiful lehenga made of Soft Silk suitable for Wedding Wear.',10,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(370,'lehenge','Beautiful lehenge made of Organza suitable for Party Wear.',11,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(371,'lehenge','Beautiful lehenge made of Georgette suitable for Festival Wear.',12,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(372,'lehenge','Beautiful lehenge made of Chiffon suitable for Office Wear.',13,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(373,'lehenge','Beautiful lehenge made of Cotton suitable for Daily Wear.',14,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(374,'lehenge','Beautiful lehenge made of Tissue suitable for Reception Collection.',15,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(375,'lehenge','Beautiful lehenge made of Linen suitable for Haldi Collection.',16,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(376,'lehenge','Beautiful lehenge made of Pure Silk suitable for Mehendi Collection.',17,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(377,'lehenge','Beautiful lehenge made of Soft Silk suitable for Sangeet Collection.',18,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(378,'lehenge','Beautiful lehenge made of Organza suitable for Wedding Wear.',19,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(379,'lehenge','Beautiful lehenge made of Georgette suitable for Party Wear.',20,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(380,'lehenge','Beautiful lehenge made of Chiffon suitable for Festival Wear.',1,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(381,'lehenge','Beautiful lehenge made of Cotton suitable for Office Wear.',2,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(382,'lehenge','Beautiful lehenge made of Tissue suitable for Daily Wear.',3,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(383,'lehenge','Beautiful lehenge made of Linen suitable for Reception Collection.',4,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(384,'lehenge','Beautiful lehenge made of Pure Silk suitable for Haldi Collection.',5,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(385,'lehenge','Beautiful lehenge made of Soft Silk suitable for Mehendi Collection.',6,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(386,'lehenge','Beautiful lehenge made of Organza suitable for Sangeet Collection.',7,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(387,'lehenge','Beautiful lehenge made of Georgette suitable for Wedding Wear.',8,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(388,'lehenge','Beautiful lehenge made of Chiffon suitable for Party Wear.',9,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(389,'lehenge','Beautiful lehenge made of Cotton suitable for Festival Wear.',10,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(390,'lehenge','Beautiful lehenge made of Tissue suitable for Office Wear.',11,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(391,'lehenge','Beautiful lehenge made of Linen suitable for Daily Wear.',12,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(392,'lehenge','Beautiful lehenge made of Pure Silk suitable for Reception Collection.',13,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(393,'lehenge','Beautiful lehenge made of Soft Silk suitable for Haldi Collection.',14,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(394,'lehenge','Beautiful lehenge made of Organza suitable for Mehendi Collection.',15,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(395,'lehenge','Beautiful lehenge made of Georgette suitable for Sangeet Collection.',16,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(396,'lehenge','Beautiful lehenge made of Chiffon suitable for Wedding Wear.',17,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(397,'lehenge','Beautiful lehenge made of Cotton suitable for Party Wear.',18,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(398,'lehenge','Beautiful lehenge made of Tissue suitable for Festival Wear.',19,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(399,'lehenge','Beautiful lehenge made of Linen suitable for Office Wear.',20,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(400,'lehenge','Beautiful lehenge made of Pure Silk suitable for Daily Wear.',1,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(401,'lehenge','Beautiful lehenge made of Soft Silk suitable for Reception Collection.',2,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(402,'lehenge','Beautiful lehenge made of Organza suitable for Haldi Collection.',3,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(403,'lehenge','Beautiful lehenge made of Georgette suitable for Mehendi Collection.',4,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(404,'lehenge','Beautiful lehenge made of Chiffon suitable for Sangeet Collection.',5,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(405,'lehenge','Beautiful lehenge made of Cotton suitable for Wedding Wear.',6,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(406,'lehenge','Beautiful lehenge made of Tissue suitable for Party Wear.',7,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(407,'lehenge','Beautiful lehenge made of Linen suitable for Festival Wear.',8,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(408,'lehenge','Beautiful lehenge made of Pure Silk suitable for Office Wear.',9,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(409,'lehenge','Beautiful lehenge made of Soft Silk suitable for Daily Wear.',10,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(410,'lehenge','Beautiful lehenge made of Organza suitable for Reception Collection.',11,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(411,'lehenge','Beautiful lehenge made of Georgette suitable for Haldi Collection.',12,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(412,'lehenge','Beautiful lehenge made of Chiffon suitable for Mehendi Collection.',13,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(413,'lehenge','Beautiful lehenge made of Cotton suitable for Sangeet Collection.',14,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(414,'lehenge','Beautiful lehenge made of Tissue suitable for Wedding Wear.',15,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(415,'lehenge','Beautiful lehenge made of Linen suitable for Party Wear.',16,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(416,'lehenge','Beautiful lehenge made of Pure Silk suitable for Festival Wear.',17,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(417,'lehenge','Beautiful lehenge made of Soft Silk suitable for Office Wear.',18,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(418,'lehenge','Beautiful lehenge made of Organza suitable for Daily Wear.',19,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(419,'lehenge','Beautiful lehenge made of Georgette suitable for Reception Collection.',20,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(420,'lehenge','Beautiful lehenge made of Chiffon suitable for Haldi Collection.',1,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(421,'lehenge','Beautiful lehenge made of Cotton suitable for Mehendi Collection.',2,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(422,'lehenge','Beautiful lehenge made of Tissue suitable for Sangeet Collection.',3,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(423,'lehenge','Beautiful lehenge made of Linen suitable for Wedding Wear.',4,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(424,'lehenge','Beautiful lehenge made of Pure Silk suitable for Party Wear.',5,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(425,'lehenge','Beautiful lehenge made of Soft Silk suitable for Festival Wear.',6,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(426,'lehenge','Beautiful lehenge made of Organza suitable for Office Wear.',7,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(427,'lehenge','Beautiful lehenge made of Georgette suitable for Daily Wear.',8,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(428,'lehenge','Beautiful lehenge made of Chiffon suitable for Reception Collection.',9,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(429,'lehenge','Beautiful lehenge made of Cotton suitable for Haldi Collection.',10,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(430,'lehenge','Beautiful lehenge made of Tissue suitable for Mehendi Collection.',11,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(431,'lehenge','Beautiful lehenge made of Linen suitable for Sangeet Collection.',12,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(432,'lehenge','Beautiful lehenge made of Pure Silk suitable for Wedding Wear.',13,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(433,'light work','Beautiful light work made of Soft Silk suitable for Party Wear.',14,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(434,'light work','Beautiful light work made of Organza suitable for Festival Wear.',15,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(435,'light work','Beautiful light work made of Georgette suitable for Office Wear.',16,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(436,'light work','Beautiful light work made of Chiffon suitable for Daily Wear.',17,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(437,'light work','Beautiful light work made of Cotton suitable for Reception Collection.',18,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(438,'light work','Beautiful light work made of Tissue suitable for Haldi Collection.',19,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(439,'light work','Beautiful light work made of Linen suitable for Mehendi Collection.',20,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(440,'light work','Beautiful light work made of Pure Silk suitable for Sangeet Collection.',1,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(441,'new','Beautiful new made of Soft Silk suitable for Wedding Wear.',2,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(442,'new','Beautiful new made of Organza suitable for Party Wear.',3,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(443,'new','Beautiful new made of Georgette suitable for Festival Wear.',4,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(444,'new','Beautiful new made of Chiffon suitable for Office Wear.',5,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(445,'new','Beautiful new made of Cotton suitable for Daily Wear.',6,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(446,'new','Beautiful new made of Tissue suitable for Reception Collection.',7,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(447,'new','Beautiful new made of Linen suitable for Haldi Collection.',8,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(448,'new','Beautiful new made of Pure Silk suitable for Mehendi Collection.',9,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(449,'new','Beautiful new made of Soft Silk suitable for Sangeet Collection.',10,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(450,'new','Beautiful new made of Organza suitable for Wedding Wear.',11,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(451,'new','Beautiful new made of Georgette suitable for Party Wear.',12,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(452,'new','Beautiful new made of Chiffon suitable for Festival Wear.',13,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(453,'new','Beautiful new made of Cotton suitable for Office Wear.',14,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(454,'new','Beautiful new made of Tissue suitable for Daily Wear.',15,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(455,'new','Beautiful new made of Linen suitable for Reception Collection.',16,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(456,'new','Beautiful new made of Pure Silk suitable for Haldi Collection.',17,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(457,'new','Beautiful new made of Soft Silk suitable for Mehendi Collection.',18,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(458,'new','Beautiful new made of Organza suitable for Sangeet Collection.',19,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(459,'new','Beautiful new made of Georgette suitable for Wedding Wear.',20,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(460,'new','Beautiful new made of Chiffon suitable for Party Wear.',1,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(461,'new','Beautiful new made of Cotton suitable for Festival Wear.',2,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(462,'new','Beautiful new made of Tissue suitable for Office Wear.',3,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(463,'new','Beautiful new made of Linen suitable for Daily Wear.',4,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(464,'new','Beautiful new made of Pure Silk suitable for Reception Collection.',5,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(465,'new lehenge','Beautiful new lehenge made of Soft Silk suitable for Haldi Collection.',6,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(466,'new lehenge','Beautiful new lehenge made of Organza suitable for Mehendi Collection.',7,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(467,'new lehenge','Beautiful new lehenge made of Georgette suitable for Sangeet Collection.',8,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(468,'pavitra','Beautiful pavitra made of Chiffon suitable for Wedding Wear.',9,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(469,'photo_6280397288601489454_y','Beautiful photo_6280397288601489454_y made of Cotton suitable for Party Wear.',10,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(470,'photo_6280397288601489455_y','Beautiful photo_6280397288601489455_y made of Tissue suitable for Festival Wear.',11,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(471,'photo_6280397288601489456_y','Beautiful photo_6280397288601489456_y made of Linen suitable for Office Wear.',12,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(472,'photo_6280397288601489489_y','Beautiful photo_6280397288601489489_y made of Pure Silk suitable for Daily Wear.',13,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(473,'photo_6280397288601489490_y','Beautiful photo_6280397288601489490_y made of Soft Silk suitable for Reception Collection.',14,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(474,'Pittan work','Beautiful Pittan work made of Organza suitable for Haldi Collection.',15,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(475,'Pittan work','Beautiful Pittan work made of Georgette suitable for Mehendi Collection.',16,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(476,'Pittan work','Beautiful Pittan work made of Chiffon suitable for Sangeet Collection.',17,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(477,'Pittan work','Beautiful Pittan work made of Cotton suitable for Wedding Wear.',18,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(478,'Pittan work','Beautiful Pittan work made of Tissue suitable for Party Wear.',19,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(479,'Pittan work','Beautiful Pittan work made of Linen suitable for Festival Wear.',20,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(480,'Pittan work','Beautiful Pittan work made of Pure Silk suitable for Office Wear.',1,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(481,'Pittan work','Beautiful Pittan work made of Soft Silk suitable for Daily Wear.',2,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(482,'Pittan work','Beautiful Pittan work made of Organza suitable for Reception Collection.',3,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(483,'Pittan work','Beautiful Pittan work made of Georgette suitable for Haldi Collection.',4,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(484,'Pittan work','Beautiful Pittan work made of Chiffon suitable for Mehendi Collection.',5,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(485,'Pittan work','Beautiful Pittan work made of Cotton suitable for Sangeet Collection.',6,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(486,'Pittan work','Beautiful Pittan work made of Tissue suitable for Wedding Wear.',7,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(487,'Pittan work','Beautiful Pittan work made of Linen suitable for Party Wear.',8,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(488,'Pittan work','Beautiful Pittan work made of Pure Silk suitable for Festival Wear.',9,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(489,'Pittan work','Beautiful Pittan work made of Soft Silk suitable for Office Wear.',10,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(490,'Pittan work','Beautiful Pittan work made of Organza suitable for Daily Wear.',11,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(491,'Pittan work','Beautiful Pittan work made of Georgette suitable for Reception Collection.',12,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(492,'Printed','Beautiful Printed made of Chiffon suitable for Haldi Collection.',13,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(493,'Printed','Beautiful Printed made of Cotton suitable for Mehendi Collection.',14,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(494,'Printed','Beautiful Printed made of Tissue suitable for Sangeet Collection.',15,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(495,'Printed','Beautiful Printed made of Linen suitable for Wedding Wear.',16,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(496,'Printed','Beautiful Printed made of Pure Silk suitable for Party Wear.',17,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(497,'Printed','Beautiful Printed made of Soft Silk suitable for Festival Wear.',18,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(498,'Printed','Beautiful Printed made of Organza suitable for Office Wear.',19,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(499,'Printed','Beautiful Printed made of Georgette suitable for Daily Wear.',20,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(500,'Printed','Beautiful Printed made of Chiffon suitable for Reception Collection.',1,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(501,'Printed','Beautiful Printed made of Cotton suitable for Haldi Collection.',2,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(502,'Printed','Beautiful Printed made of Tissue suitable for Mehendi Collection.',3,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(503,'Printed','Beautiful Printed made of Linen suitable for Sangeet Collection.',4,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(504,'Printed','Beautiful Printed made of Pure Silk suitable for Wedding Wear.',5,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(505,'Printed','Beautiful Printed made of Soft Silk suitable for Party Wear.',6,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(506,'Printed','Beautiful Printed made of Organza suitable for Festival Wear.',7,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(507,'Printed','Beautiful Printed made of Georgette suitable for Office Wear.',8,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(508,'Printed','Beautiful Printed made of Chiffon suitable for Daily Wear.',9,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(509,'Printed','Beautiful Printed made of Cotton suitable for Reception Collection.',10,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(510,'Printed','Beautiful Printed made of Tissue suitable for Haldi Collection.',11,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(511,'Printed','Beautiful Printed made of Linen suitable for Mehendi Collection.',12,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(512,'Printed','Beautiful Printed made of Pure Silk suitable for Sangeet Collection.',13,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(513,'Printed','Beautiful Printed made of Soft Silk suitable for Wedding Wear.',14,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(514,'Printed','Beautiful Printed made of Organza suitable for Party Wear.',15,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(515,'Printed','Beautiful Printed made of Georgette suitable for Festival Wear.',16,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(516,'Printed','Beautiful Printed made of Chiffon suitable for Office Wear.',17,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(517,'Printed','Beautiful Printed made of Cotton suitable for Daily Wear.',18,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(518,'Printed','Beautiful Printed made of Tissue suitable for Reception Collection.',19,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(519,'Printed','Beautiful Printed made of Linen suitable for Haldi Collection.',20,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(520,'Printed','Beautiful Printed made of Pure Silk suitable for Mehendi Collection.',1,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(521,'Printed','Beautiful Printed made of Soft Silk suitable for Sangeet Collection.',2,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(522,'Printed','Beautiful Printed made of Organza suitable for Wedding Wear.',3,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(523,'Printed','Beautiful Printed made of Georgette suitable for Party Wear.',4,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(524,'Printed','Beautiful Printed made of Chiffon suitable for Festival Wear.',5,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(525,'Printed','Beautiful Printed made of Cotton suitable for Office Wear.',6,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(526,'Printed','Beautiful Printed made of Tissue suitable for Daily Wear.',7,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(527,'Printed','Beautiful Printed made of Linen suitable for Reception Collection.',8,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(528,'Printed','Beautiful Printed made of Pure Silk suitable for Haldi Collection.',9,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(529,'Printed','Beautiful Printed made of Soft Silk suitable for Mehendi Collection.',10,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(530,'Printed','Beautiful Printed made of Organza suitable for Sangeet Collection.',11,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(531,'Printed','Beautiful Printed made of Georgette suitable for Wedding Wear.',12,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(532,'Printed','Beautiful Printed made of Chiffon suitable for Party Wear.',13,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(533,'Printed','Beautiful Printed made of Cotton suitable for Festival Wear.',14,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(534,'Printed','Beautiful Printed made of Tissue suitable for Office Wear.',15,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(535,'Printed','Beautiful Printed made of Linen suitable for Daily Wear.',16,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(536,'Printed','Beautiful Printed made of Pure Silk suitable for Reception Collection.',17,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(537,'Printed','Beautiful Printed made of Soft Silk suitable for Haldi Collection.',18,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(538,'Printed','Beautiful Printed made of Organza suitable for Mehendi Collection.',19,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(539,'Printed','Beautiful Printed made of Georgette suitable for Sangeet Collection.',20,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(540,'Printed','Beautiful Printed made of Chiffon suitable for Wedding Wear.',1,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(541,'Printed','Beautiful Printed made of Cotton suitable for Party Wear.',2,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(542,'Printed','Beautiful Printed made of Tissue suitable for Festival Wear.',3,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(543,'Printed','Beautiful Printed made of Linen suitable for Office Wear.',4,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(544,'Printed','Beautiful Printed made of Pure Silk suitable for Daily Wear.',5,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(545,'Printed','Beautiful Printed made of Soft Silk suitable for Reception Collection.',6,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(546,'Printed','Beautiful Printed made of Organza suitable for Haldi Collection.',7,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(547,'Printed','Beautiful Printed made of Georgette suitable for Mehendi Collection.',8,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(548,'Pyor Gotta Patti','Beautiful Pyor Gotta Patti made of Chiffon suitable for Sangeet Collection.',9,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(549,'Pyor Gotta Patti','Beautiful Pyor Gotta Patti made of Cotton suitable for Wedding Wear.',10,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(550,'Pyor Gotta Patti','Beautiful Pyor Gotta Patti made of Tissue suitable for Party Wear.',11,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(551,'Pyor Gotta Patti','Beautiful Pyor Gotta Patti made of Linen suitable for Festival Wear.',12,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(552,'Pyor Gotta Patti','Beautiful Pyor Gotta Patti made of Pure Silk suitable for Office Wear.',13,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(553,'Pyor Gotta Patti','Beautiful Pyor Gotta Patti made of Soft Silk suitable for Daily Wear.',14,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(554,'Pyor Gotta Patti','Beautiful Pyor Gotta Patti made of Organza suitable for Reception Collection.',15,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(555,'Pyor Gotta Patti','Beautiful Pyor Gotta Patti made of Georgette suitable for Haldi Collection.',16,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(556,'Pyor Gotta Patti','Beautiful Pyor Gotta Patti made of Chiffon suitable for Mehendi Collection.',17,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(557,'Pyor Gotta Patti','Beautiful Pyor Gotta Patti made of Cotton suitable for Sangeet Collection.',18,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(558,'Pyor Gotta Patti','Beautiful Pyor Gotta Patti made of Tissue suitable for Wedding Wear.',19,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(559,'Pyor Gotta Patti','Beautiful Pyor Gotta Patti made of Linen suitable for Party Wear.',20,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(560,'Pyor Gotta Patti','Beautiful Pyor Gotta Patti made of Pure Silk suitable for Festival Wear.',1,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(561,'Pyor Gotta Patti','Beautiful Pyor Gotta Patti made of Soft Silk suitable for Office Wear.',2,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(562,'Pyor Gotta Patti','Beautiful Pyor Gotta Patti made of Organza suitable for Daily Wear.',3,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(563,'Pyor Gotta Patti','Beautiful Pyor Gotta Patti made of Georgette suitable for Reception Collection.',4,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(564,'Pyor Gotta Patti','Beautiful Pyor Gotta Patti made of Chiffon suitable for Haldi Collection.',5,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(565,'Pyor Gotta Patti','Beautiful Pyor Gotta Patti made of Cotton suitable for Mehendi Collection.',6,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(566,'Pyor Gotta Patti','Beautiful Pyor Gotta Patti made of Tissue suitable for Sangeet Collection.',7,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(567,'Pyor Gotta Patti','Beautiful Pyor Gotta Patti made of Linen suitable for Wedding Wear.',8,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(568,'Pyor Gotta Patti','Beautiful Pyor Gotta Patti made of Pure Silk suitable for Party Wear.',9,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(569,'Pyor Gotta Patti','Beautiful Pyor Gotta Patti made of Soft Silk suitable for Festival Wear.',10,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(570,'Pyor Gotta Patti','Beautiful Pyor Gotta Patti made of Organza suitable for Office Wear.',11,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(571,'Pyor Gotta Patti','Beautiful Pyor Gotta Patti made of Georgette suitable for Daily Wear.',12,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(572,'Pyor Gotta Patti','Beautiful Pyor Gotta Patti made of Chiffon suitable for Reception Collection.',13,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(573,'Pyor Gotta Patti','Beautiful Pyor Gotta Patti made of Cotton suitable for Haldi Collection.',14,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(574,'Pyor Gotta Patti','Beautiful Pyor Gotta Patti made of Tissue suitable for Mehendi Collection.',15,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(575,'Pyor Gotta Patti','Beautiful Pyor Gotta Patti made of Linen suitable for Sangeet Collection.',16,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(576,'Pyor Gotta Patti','Beautiful Pyor Gotta Patti made of Pure Silk suitable for Wedding Wear.',17,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(577,'Pyor Gotta Patti','Beautiful Pyor Gotta Patti made of Soft Silk suitable for Party Wear.',18,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(578,'Pyor Gotta Patti','Beautiful Pyor Gotta Patti made of Organza suitable for Festival Wear.',19,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(579,'Pyor Gotta Patti','Beautiful Pyor Gotta Patti made of Georgette suitable for Office Wear.',20,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(580,'Pyor Gotta Patti','Beautiful Pyor Gotta Patti made of Chiffon suitable for Daily Wear.',1,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(581,'Pyor Gotta Patti','Beautiful Pyor Gotta Patti made of Cotton suitable for Reception Collection.',2,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(582,'Pyor Gotta Patti','Beautiful Pyor Gotta Patti made of Tissue suitable for Haldi Collection.',3,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(583,'Pyor Gotta Patti','Beautiful Pyor Gotta Patti made of Linen suitable for Mehendi Collection.',4,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(584,'Pyor Gotta Patti','Beautiful Pyor Gotta Patti made of Pure Silk suitable for Sangeet Collection.',5,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(585,'Pyor Gotta Patti','Beautiful Pyor Gotta Patti made of Soft Silk suitable for Wedding Wear.',6,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(586,'Pyor Gotta Patti','Beautiful Pyor Gotta Patti made of Organza suitable for Party Wear.',7,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(587,'Pyor Gotta Patti','Beautiful Pyor Gotta Patti made of Georgette suitable for Festival Wear.',8,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(588,'Pyor Gotta Patti','Beautiful Pyor Gotta Patti made of Chiffon suitable for Office Wear.',9,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(589,'Pyor Gotta Patti','Beautiful Pyor Gotta Patti made of Cotton suitable for Daily Wear.',10,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(590,'Pyor Gotta Patti','Beautiful Pyor Gotta Patti made of Tissue suitable for Reception Collection.',11,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(591,'Pyor Gotta Patti','Beautiful Pyor Gotta Patti made of Linen suitable for Haldi Collection.',12,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(592,'Pyor Gotta Patti','Beautiful Pyor Gotta Patti made of Pure Silk suitable for Mehendi Collection.',13,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(593,'Pyor Gotta Patti','Beautiful Pyor Gotta Patti made of Soft Silk suitable for Sangeet Collection.',14,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(594,'Pyor Gotta Patti','Beautiful Pyor Gotta Patti made of Organza suitable for Wedding Wear.',15,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(595,'Pyor Gotta Patti','Beautiful Pyor Gotta Patti made of Georgette suitable for Party Wear.',16,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(596,'Pyor Gotta Patti','Beautiful Pyor Gotta Patti made of Chiffon suitable for Festival Wear.',17,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(597,'Pyor Gotta Patti','Beautiful Pyor Gotta Patti made of Cotton suitable for Office Wear.',18,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:45','2026-07-17 11:14:45'),
(598,'Pyor Gotta Patti','Beautiful Pyor Gotta Patti made of Tissue suitable for Daily Wear.',19,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:46','2026-07-17 11:14:46'),
(599,'Pyor Gotta Patti','Beautiful Pyor Gotta Patti made of Linen suitable for Reception Collection.',20,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:46','2026-07-17 11:14:46'),
(600,'Pyor Gotta Patti','Beautiful Pyor Gotta Patti made of Pure Silk suitable for Haldi Collection.',1,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:46','2026-07-17 11:14:46'),
(601,'Pyor Gotta Patti','Beautiful Pyor Gotta Patti made of Soft Silk suitable for Mehendi Collection.',2,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:46','2026-07-17 11:14:46'),
(602,'Pyor Gotta Patti','Beautiful Pyor Gotta Patti made of Organza suitable for Sangeet Collection.',3,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:46','2026-07-17 11:14:46'),
(603,'Pyor Gotta Patti','Beautiful Pyor Gotta Patti made of Georgette suitable for Wedding Wear.',4,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:46','2026-07-17 11:14:46'),
(604,'Pyor Gotta Patti','Beautiful Pyor Gotta Patti made of Chiffon suitable for Party Wear.',5,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:46','2026-07-17 11:14:46'),
(605,'Pyor Gotta Patti','Beautiful Pyor Gotta Patti made of Cotton suitable for Festival Wear.',6,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:46','2026-07-17 11:14:46'),
(606,'pyor Gotta Patti','Beautiful pyor Gotta Patti made of Tissue suitable for Office Wear.',7,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:46','2026-07-17 11:14:46'),
(607,'Sifon chunri','Beautiful Sifon chunri made of Linen suitable for Daily Wear.',8,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:46','2026-07-17 11:14:46'),
(608,'Sifon chunri','Beautiful Sifon chunri made of Pure Silk suitable for Reception Collection.',9,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:46','2026-07-17 11:14:46'),
(609,'Sifon chunri','Beautiful Sifon chunri made of Soft Silk suitable for Haldi Collection.',10,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:46','2026-07-17 11:14:46'),
(610,'Sifon chunri','Beautiful Sifon chunri made of Organza suitable for Mehendi Collection.',11,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:46','2026-07-17 11:14:46'),
(611,'Sifon chunri','Beautiful Sifon chunri made of Georgette suitable for Sangeet Collection.',12,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:46','2026-07-17 11:14:46'),
(612,'Sifon chunri','Beautiful Sifon chunri made of Chiffon suitable for Wedding Wear.',13,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:46','2026-07-17 11:14:46'),
(613,'Sifon chunri','Beautiful Sifon chunri made of Cotton suitable for Party Wear.',14,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:46','2026-07-17 11:14:46'),
(614,'Sifon chunri','Beautiful Sifon chunri made of Tissue suitable for Festival Wear.',15,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:46','2026-07-17 11:14:46'),
(615,'Sifon chunri','Beautiful Sifon chunri made of Linen suitable for Office Wear.',16,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:46','2026-07-17 11:14:46'),
(616,'Sifon chunri','Beautiful Sifon chunri made of Pure Silk suitable for Daily Wear.',17,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:46','2026-07-17 11:14:46'),
(617,'Sifon chunri','Beautiful Sifon chunri made of Soft Silk suitable for Reception Collection.',18,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:46','2026-07-17 11:14:46'),
(618,'Sifon chunri','Beautiful Sifon chunri made of Organza suitable for Haldi Collection.',19,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:46','2026-07-17 11:14:46'),
(619,'SitaraWork','Beautiful SitaraWork made of Georgette suitable for Mehendi Collection.',20,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:46','2026-07-17 11:14:46'),
(620,'SitaraWork','Beautiful SitaraWork made of Chiffon suitable for Sangeet Collection.',1,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:46','2026-07-17 11:14:46'),
(621,'SitaraWork','Beautiful SitaraWork made of Cotton suitable for Wedding Wear.',2,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:46','2026-07-17 11:14:46'),
(622,'SitaraWork','Beautiful SitaraWork made of Tissue suitable for Party Wear.',3,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:46','2026-07-17 11:14:46'),
(623,'SitaraWork','Beautiful SitaraWork made of Linen suitable for Festival Wear.',4,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:46','2026-07-17 11:14:46'),
(624,'SitaraWork','Beautiful SitaraWork made of Pure Silk suitable for Office Wear.',5,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:46','2026-07-17 11:14:46'),
(625,'SitaraWork','Beautiful SitaraWork made of Soft Silk suitable for Daily Wear.',6,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:46','2026-07-17 11:14:46'),
(626,'SitaraWork','Beautiful SitaraWork made of Organza suitable for Reception Collection.',7,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:46','2026-07-17 11:14:46'),
(627,'SitaraWork','Beautiful SitaraWork made of Georgette suitable for Haldi Collection.',8,NULL,NULL,2,'ACTIVE',1,'2026-07-17 11:14:46','2026-07-17 11:14:46');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `refunds`
--

LOCK TABLES `refunds` WRITE;
/*!40000 ALTER TABLE `refunds` DISABLE KEYS */;
/*!40000 ALTER TABLE `refunds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `replacement_requests`
--

LOCK TABLES `replacement_requests` WRITE;
/*!40000 ALTER TABLE `replacement_requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `replacement_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `reports_cache`
--

LOCK TABLES `reports_cache` WRITE;
/*!40000 ALTER TABLE `reports_cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `reports_cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `retailer_profiles`
--

LOCK TABLES `retailer_profiles` WRITE;
/*!40000 ALTER TABLE `retailer_profiles` DISABLE KEYS */;
INSERT INTO `retailer_profiles` VALUES
(1,3,'Heritage Boutique Retail Point',100000.00,25000.00,'2026-07-08 10:09:07','2026-07-08 10:09:07');
/*!40000 ALTER TABLE `retailer_profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `return_items`
--

LOCK TABLES `return_items` WRITE;
/*!40000 ALTER TABLE `return_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `return_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `returns`
--

LOCK TABLES `returns` WRITE;
/*!40000 ALTER TABLE `returns` DISABLE KEYS */;
/*!40000 ALTER TABLE `returns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `role_permissions`
--

LOCK TABLES `role_permissions` WRITE;
/*!40000 ALTER TABLE `role_permissions` DISABLE KEYS */;
INSERT INTO `role_permissions` VALUES
(1,1),
(1,2),
(1,3),
(1,4),
(1,5),
(1,6),
(1,7),
(1,8),
(1,9),
(1,10),
(2,1),
(2,2),
(2,3),
(2,6),
(2,9),
(3,6),
(3,7),
(3,9),
(4,7),
(5,8);
/*!40000 ALTER TABLE `role_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES
(1,'SUPER_ADMIN','Super Administrator with full control over the platform','2026-07-08 10:09:07'),
(2,'ADMIN','Administrator with user approval and KYC permissions','2026-07-08 10:09:07'),
(3,'SELLER','Weaver / Manufacturer / Wholesaler','2026-07-08 10:09:07'),
(4,'RETAILER','Boutique owner / Buyer / Retail Retailer','2026-07-08 10:09:07'),
(5,'DELIVERY','Logistics and delivery partner','2026-07-08 10:09:07'),
(6,'EMPLOYEE','Support or operations employee','2026-07-08 10:09:07');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `seller_profiles`
--

LOCK TABLES `seller_profiles` WRITE;
/*!40000 ALTER TABLE `seller_profiles` DISABLE KEYS */;
INSERT INTO `seller_profiles` VALUES
(1,2,'Pavitra Weavers & Artisans Guild','Pavitra Loom','REG-12345','BBBBB2222B','09BBBBB2222B2Z2',8.50,150000.00,'2026-07-08 10:09:07','2026-07-08 10:09:07');
/*!40000 ALTER TABLE `seller_profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `seller_settlements`
--

LOCK TABLES `seller_settlements` WRITE;
/*!40000 ALTER TABLE `seller_settlements` DISABLE KEYS */;
/*!40000 ALTER TABLE `seller_settlements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `settlements`
--

LOCK TABLES `settlements` WRITE;
/*!40000 ALTER TABLE `settlements` DISABLE KEYS */;
/*!40000 ALTER TABLE `settlements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `shipment_items`
--

LOCK TABLES `shipment_items` WRITE;
/*!40000 ALTER TABLE `shipment_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `shipment_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `shipments`
--

LOCK TABLES `shipments` WRITE;
/*!40000 ALTER TABLE `shipments` DISABLE KEYS */;
/*!40000 ALTER TABLE `shipments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `sms_logs`
--

LOCK TABLES `sms_logs` WRITE;
/*!40000 ALTER TABLE `sms_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `sms_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `stock_transfer_items`
--

LOCK TABLES `stock_transfer_items` WRITE;
/*!40000 ALTER TABLE `stock_transfer_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `stock_transfer_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `stock_transfers`
--

LOCK TABLES `stock_transfers` WRITE;
/*!40000 ALTER TABLE `stock_transfers` DISABLE KEYS */;
/*!40000 ALTER TABLE `stock_transfers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `subcategories`
--

LOCK TABLES `subcategories` WRITE;
/*!40000 ALTER TABLE `subcategories` DISABLE KEYS */;
/*!40000 ALTER TABLE `subcategories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `support_tickets`
--

LOCK TABLES `support_tickets` WRITE;
/*!40000 ALTER TABLE `support_tickets` DISABLE KEYS */;
/*!40000 ALTER TABLE `support_tickets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `system_settings`
--

LOCK TABLES `system_settings` WRITE;
/*!40000 ALTER TABLE `system_settings` DISABLE KEYS */;
INSERT INTO `system_settings` VALUES
('brand_name','Pavitra B2B','2026-07-08 10:09:07'),
('cin_number','U17110UP2026PTC123456','2026-07-08 10:09:07'),
('company_name','Pavitra Textiles Private Limited','2026-07-08 10:09:07'),
('gst_number','09AAAAA1111A1Z1','2026-07-08 10:09:07'),
('logo_url','/assets/images/logo-pink.png','2026-07-08 10:09:07'),
('office_address','Pavitra Textiles & Crafts Association, Varanasi Handloom Cluster, Uttar Pradesh, 221001','2026-07-08 10:09:07'),
('pan_number','AAAAA1111A','2026-07-08 10:09:07'),
('payment_gateway_key','YOUR_PAYMENT_GATEWAY_KEY','2026-07-08 10:09:07'),
('payment_gateway_secret','YOUR_PAYMENT_GATEWAY_SECRET','2026-07-08 10:09:07'),
('smtp_host','smtp.mailtrap.io','2026-07-08 10:09:07'),
('smtp_password','YOUR_SMTP_PASSWORD','2026-07-08 10:09:07'),
('smtp_port','2525','2026-07-08 10:09:07'),
('smtp_user','YOUR_SMTP_USER','2026-07-08 10:09:07'),
('support_email','wholesale@pavitra.com','2026-07-08 10:09:07'),
('support_mobile','+91 9999999999','2026-07-08 10:09:07'),
('whatsapp_number','+91 9999999999','2026-07-08 10:09:07');
/*!40000 ALTER TABLE `system_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `ticket_attachments`
--

LOCK TABLES `ticket_attachments` WRITE;
/*!40000 ALTER TABLE `ticket_attachments` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket_attachments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `ticket_messages`
--

LOCK TABLES `ticket_messages` WRITE;
/*!40000 ALTER TABLE `ticket_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `user_addresses`
--

LOCK TABLES `user_addresses` WRITE;
/*!40000 ALTER TABLE `user_addresses` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `user_sessions`
--

LOCK TABLES `user_sessions` WRITE;
/*!40000 ALTER TABLE `user_sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(1,'System Administrator','admin@pavitrab2b.com','+91 9876543210','$2y$10$GjE39Zvikuw6YeSAHdCoCuK/XXFgqM4PTTqbPWbEyutmifai9gql.',1,'ACTIVE',NULL,1,1,NULL,'2026-07-08 10:09:07','2026-07-08 10:09:07'),
(2,'Pavitra Weavers Ltd.','weaver@pavitrab2b.com','+91 8888888888','$2y$10$GjE39Zvikuw6YeSAHdCoCuK/XXFgqM4PTTqbPWbEyutmifai9gql.',3,'ACTIVE',NULL,1,1,NULL,'2026-07-08 10:09:07','2026-07-08 10:09:07'),
(3,'Heritage Saree Boutique','boutique@pavitrab2b.com','+91 7777777777','$2y$10$GjE39Zvikuw6YeSAHdCoCuK/XXFgqM4PTTqbPWbEyutmifai9gql.',4,'ACTIVE',NULL,1,1,NULL,'2026-07-08 10:09:07','2026-07-08 10:09:07'),
(4,'Express Logistics','delivery@pavitrab2b.com','+91 6666666666','$2y$10$GjE39Zvikuw6YeSAHdCoCuK/XXFgqM4PTTqbPWbEyutmifai9gql.',5,'ACTIVE',NULL,1,1,NULL,'2026-07-08 10:09:07','2026-07-08 10:09:07');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `wallet_limits`
--

LOCK TABLES `wallet_limits` WRITE;
/*!40000 ALTER TABLE `wallet_limits` DISABLE KEYS */;
/*!40000 ALTER TABLE `wallet_limits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `wallet_requests`
--

LOCK TABLES `wallet_requests` WRITE;
/*!40000 ALTER TABLE `wallet_requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `wallet_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `wallet_transactions`
--

LOCK TABLES `wallet_transactions` WRITE;
/*!40000 ALTER TABLE `wallet_transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `wallet_transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `wallets`
--

LOCK TABLES `wallets` WRITE;
/*!40000 ALTER TABLE `wallets` DISABLE KEYS */;
INSERT INTO `wallets` VALUES
(1,1,0.00,0.00,'2026-07-08 10:09:07','2026-07-08 10:09:07'),
(2,2,150000.00,0.00,'2026-07-08 10:09:07','2026-07-08 10:09:07'),
(3,3,25000.00,0.00,'2026-07-08 10:09:07','2026-07-08 10:09:07'),
(4,4,0.00,0.00,'2026-07-08 10:09:07','2026-07-08 10:09:07');
/*!40000 ALTER TABLE `wallets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `warehouse_stock`
--

LOCK TABLES `warehouse_stock` WRITE;
/*!40000 ALTER TABLE `warehouse_stock` DISABLE KEYS */;
/*!40000 ALTER TABLE `warehouse_stock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `warehouses`
--

LOCK TABLES `warehouses` WRITE;
/*!40000 ALTER TABLE `warehouses` DISABLE KEYS */;
/*!40000 ALTER TABLE `warehouses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `whatsapp_logs`
--

LOCK TABLES `whatsapp_logs` WRITE;
/*!40000 ALTER TABLE `whatsapp_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `whatsapp_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `wishlist_items`
--

LOCK TABLES `wishlist_items` WRITE;
/*!40000 ALTER TABLE `wishlist_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `wishlist_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `wishlists`
--

LOCK TABLES `wishlists` WRITE;
/*!40000 ALTER TABLE `wishlists` DISABLE KEYS */;
/*!40000 ALTER TABLE `wishlists` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-07-17 20:57:01
