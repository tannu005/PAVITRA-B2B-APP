SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(50) NOT NULL UNIQUE,
  `description` TEXT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL UNIQUE,
  `description` TEXT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `role_permissions` (
  `role_id` INT NOT NULL,
  `permission_id` INT NOT NULL,
  PRIMARY KEY (`role_id`, `permission_id`),
  FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(150) NOT NULL UNIQUE,
  `mobile` VARCHAR(20) NOT NULL UNIQUE,
  `password_hash` VARCHAR(255) NOT NULL,
  `role_id` INT NOT NULL,
  `status` ENUM('ACTIVE', 'PENDING', 'BLOCKED') DEFAULT 'ACTIVE',
  `referral_code` VARCHAR(20) UNIQUE,
  `is_verified_email` TINYINT(1) DEFAULT 0,
  `is_verified_mobile` TINYINT(1) DEFAULT 0,
  `two_factor_secret` VARCHAR(100) DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  INDEX (`status`),
  INDEX (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `user_sessions` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT NOT NULL,
  `token` VARCHAR(255) NOT NULL UNIQUE,
  `ip_address` VARCHAR(45) DEFAULT NULL,
  `user_agent` TEXT DEFAULT NULL,
  `last_active` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `seller_profiles` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT NOT NULL UNIQUE,
  `company_name` VARCHAR(150) NOT NULL,
  `brand_name` VARCHAR(100) DEFAULT NULL,
  `registration_number` VARCHAR(100) DEFAULT NULL,
  `pan_number` VARCHAR(20) DEFAULT NULL,
  `gst_number` VARCHAR(20) DEFAULT NULL,
  `commission_rate` DECIMAL(5,2) DEFAULT 5.00,
  `balance` DECIMAL(15,2) DEFAULT 0.00,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `retailer_profiles` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT NOT NULL UNIQUE,
  `shop_name` VARCHAR(150) NOT NULL,
  `credit_limit` DECIMAL(15,2) DEFAULT 0.00,
  `balance` DECIMAL(15,2) DEFAULT 0.00,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `delivery_partner_profiles` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT NOT NULL UNIQUE,
  `vehicle_number` VARCHAR(30) DEFAULT NULL,
  `vehicle_type` VARCHAR(50) DEFAULT NULL,
  `balance` DECIMAL(15,2) DEFAULT 0.00,
  `is_online` TINYINT(1) DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `employee_profiles` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT NOT NULL UNIQUE,
  `department` VARCHAR(100) DEFAULT NULL,
  `designation` VARCHAR(100) DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `kyc_documents` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT NOT NULL,
  `document_type` ENUM('AADHAAR', 'PAN', 'GST', 'SHOP_LICENSE', 'MSME', 'BANK_PASSBOOK') NOT NULL,
  `document_number` VARCHAR(50) NOT NULL,
  `file_path` VARCHAR(255) NOT NULL,
  `status` ENUM('SUBMITTED', 'PENDING', 'VERIFIED', 'REJECTED') DEFAULT 'SUBMITTED',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  INDEX (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `kyc_verifications` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `kyc_document_id` INT NOT NULL,
  `verified_by` INT NOT NULL,
  `status` ENUM('VERIFIED', 'REJECTED') NOT NULL,
  `comments` TEXT,
  `verified_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`kyc_document_id`) REFERENCES `kyc_documents` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`verified_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `user_addresses` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT NOT NULL,
  `label` VARCHAR(50) DEFAULT 'Home',
  `address_line1` TEXT NOT NULL,
  `address_line2` TEXT,
  `city` VARCHAR(100) NOT NULL,
  `state` VARCHAR(100) NOT NULL,
  `pin_code` VARCHAR(20) NOT NULL,
  `country` VARCHAR(50) DEFAULT 'India',
  `is_default` TINYINT(1) DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `banks` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(150) NOT NULL,
  `code` VARCHAR(20) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `bank_accounts` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT NOT NULL,
  `bank_id` INT NOT NULL,
  `account_number` VARCHAR(50) NOT NULL,
  `account_holder` VARCHAR(100) NOT NULL,
  `ifsc_code` VARCHAR(20) NOT NULL,
  `status` ENUM('PENDING', 'ACTIVE', 'INACTIVE') DEFAULT 'PENDING',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`bank_id`) REFERENCES `banks` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `wallets` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT NOT NULL UNIQUE,
  `balance` DECIMAL(15,2) DEFAULT 0.00,
  `promo_balance` DECIMAL(15,2) DEFAULT 0.00,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `wallet_transactions` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `wallet_id` INT NOT NULL,
  `type` ENUM('CREDIT', 'DEBIT') NOT NULL,
  `amount` DECIMAL(15,2) NOT NULL,
  `description` TEXT,
  `reference_type` VARCHAR(50) DEFAULT NULL,
  `reference_id` INT DEFAULT NULL,
  `balance_after` DECIMAL(15,2) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`wallet_id`) REFERENCES `wallets` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `wallet_requests` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT NOT NULL,
  `type` ENUM('WITHDRAWAL', 'DEPOSIT') NOT NULL,
  `amount` DECIMAL(15,2) NOT NULL,
  `status` ENUM('PENDING', 'APPROVED', 'REJECTED') DEFAULT 'PENDING',
  `admin_notes` TEXT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `wallet_limits` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT NOT NULL UNIQUE,
  `daily_limit` DECIMAL(15,2) DEFAULT 50000.00,
  `transaction_limit` DECIMAL(15,2) DEFAULT 20000.00,
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL UNIQUE,
  `slug` VARCHAR(100) NOT NULL UNIQUE,
  `description` TEXT,
  `image_url` VARCHAR(255) DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `subcategories` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `category_id` INT NOT NULL,
  `name` VARCHAR(100) NOT NULL,
  `slug` VARCHAR(100) NOT NULL UNIQUE,
  `description` TEXT,
  `image_url` VARCHAR(255) DEFAULT NULL,
  FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `brands` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL UNIQUE,
  `slug` VARCHAR(100) NOT NULL UNIQUE,
  `logo_url` VARCHAR(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `product_attributes` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL UNIQUE,
  `type` ENUM('SELECT', 'TEXT', 'NUMBER', 'BOOLEAN') DEFAULT 'SELECT'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `attribute_values` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `attribute_id` INT NOT NULL,
  `value` VARCHAR(255) NOT NULL,
  FOREIGN KEY (`attribute_id`) REFERENCES `product_attributes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `products` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(200) NOT NULL,
  `description` TEXT,
  `category_id` INT NOT NULL,
  `subcategory_id` INT DEFAULT NULL,
  `brand_id` INT DEFAULT NULL,
  `seller_id` INT NOT NULL,
  `status` ENUM('ACTIVE', 'DRAFT', 'INACTIVE') DEFAULT 'DRAFT',
  `is_approved` TINYINT(1) DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`),
  FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`),
  FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`),
  INDEX (`status`),
  INDEX (`is_approved`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `product_variants` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `product_id` INT NOT NULL,
  `sku` VARCHAR(100) NOT NULL UNIQUE,
  `color` VARCHAR(50) DEFAULT NULL,
  `size` VARCHAR(30) DEFAULT NULL,
  `weight` DECIMAL(8,2) DEFAULT NULL,
  `dimensions` VARCHAR(50) DEFAULT NULL,
  `price` DECIMAL(12,2) NOT NULL,
  `wholesale_price` DECIMAL(12,2) NOT NULL,
  `bulk_threshold` INT DEFAULT 5,
  `stock` INT DEFAULT 0,
  `image_url` VARCHAR(255) DEFAULT NULL,
  FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  INDEX (`wholesale_price`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `product_images` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `product_id` INT NOT NULL,
  `image_url` VARCHAR(255) NOT NULL,
  `is_primary` TINYINT(1) DEFAULT 0,
  FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `product_videos` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `product_id` INT NOT NULL,
  `video_url` VARCHAR(255) NOT NULL,
  FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `product_documents` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `product_id` INT NOT NULL,
  `doc_url` VARCHAR(255) NOT NULL,
  FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `bulk_pricing` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `product_variant_id` INT NOT NULL,
  `min_quantity` INT NOT NULL,
  `price` DECIMAL(12,2) NOT NULL,
  FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `inventory` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `product_variant_id` INT NOT NULL UNIQUE,
  `stock` INT DEFAULT 0,
  `min_alert_stock` INT DEFAULT 5,
  FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `inventory_logs` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `product_variant_id` INT NOT NULL,
  `type` ENUM('IN', 'OUT') NOT NULL,
  `quantity` INT NOT NULL,
  `reason` VARCHAR(255) DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `warehouses` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL UNIQUE,
  `address` TEXT NOT NULL,
  `manager_name` VARCHAR(100) DEFAULT NULL,
  `manager_phone` VARCHAR(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `warehouse_stock` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `warehouse_id` INT NOT NULL,
  `product_variant_id` INT NOT NULL,
  `stock` INT DEFAULT 0,
  FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`) ON DELETE CASCADE,
  UNIQUE KEY `wh_variant` (`warehouse_id`, `product_variant_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `stock_transfers` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `from_warehouse_id` INT NOT NULL,
  `to_warehouse_id` INT NOT NULL,
  `status` ENUM('PENDING', 'SENT', 'RECEIVED') DEFAULT 'PENDING',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`from_warehouse_id`) REFERENCES `warehouses` (`id`),
  FOREIGN KEY (`to_warehouse_id`) REFERENCES `warehouses` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `stock_transfer_items` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `stock_transfer_id` INT NOT NULL,
  `product_variant_id` INT NOT NULL,
  `quantity` INT NOT NULL,
  FOREIGN KEY (`stock_transfer_id`) REFERENCES `stock_transfers` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `carts` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT DEFAULT NULL,
  `session_id` VARCHAR(255) DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `cart_items` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `cart_id` INT NOT NULL,
  `product_variant_id` INT NOT NULL,
  `quantity` INT NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`) ON DELETE CASCADE,
  UNIQUE KEY `cart_variant` (`cart_id`, `product_variant_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `wishlists` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT NOT NULL UNIQUE,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `wishlist_items` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `wishlist_id` INT NOT NULL,
  `product_variant_id` INT NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`wishlist_id`) REFERENCES `wishlists` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`) ON DELETE CASCADE,
  UNIQUE KEY `wishlist_variant` (`wishlist_id`, `product_variant_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `order_number` VARCHAR(50) NOT NULL UNIQUE,
  `user_id` INT NOT NULL,
  `seller_id` INT NOT NULL,
  `status` ENUM('PLACED', 'ACCEPTED', 'PACKED', 'SHIPPED', 'OUT_FOR_DELIVERY', 'DELIVERED', 'CANCELLED', 'RETURNED', 'REFUNDED', 'REPLACED') DEFAULT 'PLACED',
  `total_amount` DECIMAL(12,2) NOT NULL,
  `discount_amount` DECIMAL(12,2) DEFAULT 0.00,
  `shipping_fee` DECIMAL(8,2) DEFAULT 0.00,
  `tax_amount` DECIMAL(12,2) DEFAULT 0.00,
  `net_amount` DECIMAL(12,2) NOT NULL,
  `payment_status` ENUM('PENDING', 'PAID', 'FAILED', 'REFUNDED') DEFAULT 'PENDING',
  `payment_method` VARCHAR(50) DEFAULT NULL,
  `address_id` INT DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`),
  FOREIGN KEY (`address_id`) REFERENCES `user_addresses` (`id`),
  INDEX (`status`),
  INDEX (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `order_id` INT NOT NULL,
  `product_variant_id` INT NOT NULL,
  `quantity` INT NOT NULL,
  `price` DECIMAL(12,2) NOT NULL,
  `wholesale_price` DECIMAL(12,2) NOT NULL,
  `gst_percentage` DECIMAL(5,2) DEFAULT 5.00,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `order_status_history` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `order_id` INT NOT NULL,
  `status` VARCHAR(50) NOT NULL,
  `comments` TEXT,
  `created_by` INT DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`created_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `order_tracking` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `order_id` INT NOT NULL,
  `location` VARCHAR(255) DEFAULT NULL,
  `description` TEXT,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `shipments` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `order_id` INT NOT NULL,
  `shipment_number` VARCHAR(50) NOT NULL UNIQUE,
  `carrier_name` VARCHAR(100) DEFAULT NULL,
  `tracking_number` VARCHAR(100) DEFAULT NULL,
  `status` VARCHAR(50) DEFAULT 'SHIPPED',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `shipment_items` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `shipment_id` INT NOT NULL,
  `order_item_id` INT NOT NULL,
  `quantity` INT NOT NULL,
  FOREIGN KEY (`shipment_id`) REFERENCES `shipments` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`order_item_id`) REFERENCES `order_items` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `delivery_assignments` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `shipment_id` INT NOT NULL,
  `delivery_partner_id` INT NOT NULL,
  `status` ENUM('ASSIGNED', 'PICKED_UP', 'OUT_FOR_DELIVERY', 'DELIVERED', 'FAILED') DEFAULT 'ASSIGNED',
  `assigned_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `completed_at` TIMESTAMP NULL DEFAULT NULL,
  FOREIGN KEY (`shipment_id`) REFERENCES `shipments` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`delivery_partner_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `delivery_routes` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `delivery_assignment_id` INT NOT NULL,
  `route_coords` TEXT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`delivery_assignment_id`) REFERENCES `delivery_assignments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `delivery_proofs` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `delivery_assignment_id` INT NOT NULL,
  `otp_code` VARCHAR(10) DEFAULT NULL,
  `signature_url` VARCHAR(255) DEFAULT NULL,
  `photo_url` VARCHAR(255) DEFAULT NULL,
  `verified_at` TIMESTAMP NULL DEFAULT NULL,
  FOREIGN KEY (`delivery_assignment_id`) REFERENCES `delivery_assignments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `returns` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `order_id` INT NOT NULL,
  `return_number` VARCHAR(50) NOT NULL UNIQUE,
  `reason` TEXT NOT NULL,
  `status` ENUM('REQUESTED', 'APPROVED', 'PICKED_UP', 'VERIFIED', 'COMPLETED', 'REJECTED') DEFAULT 'REQUESTED',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `return_items` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `return_id` INT NOT NULL,
  `order_item_id` INT NOT NULL,
  `quantity` INT NOT NULL,
  `status` VARCHAR(50) DEFAULT 'PENDING',
  FOREIGN KEY (`return_id`) REFERENCES `returns` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`order_item_id`) REFERENCES `order_items` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `refunds` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `return_id` INT DEFAULT NULL,
  `amount` DECIMAL(12,2) NOT NULL,
  `payment_method` VARCHAR(50) DEFAULT NULL,
  `status` ENUM('PENDING', 'SUCCESS', 'FAILED') DEFAULT 'PENDING',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`return_id`) REFERENCES `returns` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `replacement_requests` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `order_id` INT NOT NULL,
  `reason` TEXT NOT NULL,
  `status` ENUM('REQUESTED', 'APPROVED', 'DISPATCHED', 'COMPLETED', 'REJECTED') DEFAULT 'REQUESTED',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `payments` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `payment_number` VARCHAR(50) NOT NULL UNIQUE,
  `order_id` INT NOT NULL,
  `amount` DECIMAL(12,2) NOT NULL,
  `payment_method` VARCHAR(50) NOT NULL,
  `transaction_id` VARCHAR(150) DEFAULT NULL,
  `status` ENUM('PENDING', 'SUCCESS', 'FAILED') DEFAULT 'PENDING',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `payment_transactions` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `payment_id` INT NOT NULL,
  `gateway` VARCHAR(50) NOT NULL,
  `raw_response` TEXT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `settlements` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `settlement_number` VARCHAR(50) NOT NULL UNIQUE,
  `status` ENUM('PENDING', 'SETTLED', 'FAILED') DEFAULT 'PENDING',
  `total_amount` DECIMAL(15,2) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `seller_settlements` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `settlement_id` INT NOT NULL,
  `seller_id` INT NOT NULL,
  `order_id` INT NOT NULL,
  `sales_amount` DECIMAL(12,2) NOT NULL,
  `commission_deducted` DECIMAL(12,2) NOT NULL,
  `tax_deducted` DECIMAL(12,2) NOT NULL,
  `net_payout` DECIMAL(12,2) NOT NULL,
  `status` ENUM('PENDING', 'SUCCESS', 'FAILED') DEFAULT 'PENDING',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`settlement_id`) REFERENCES `settlements` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`),
  FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `commissions` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `order_item_id` INT NOT NULL UNIQUE,
  `rate` DECIMAL(5,2) NOT NULL,
  `amount` DECIMAL(12,2) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`order_item_id`) REFERENCES `order_items` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `commission_rules` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `category_id` INT DEFAULT NULL,
  `seller_id` INT DEFAULT NULL,
  `rate` DECIMAL(5,2) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `gst_rates` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `hsn_code` VARCHAR(20) NOT NULL UNIQUE,
  `percentage` DECIMAL(5,2) NOT NULL,
  `description` TEXT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `invoices` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `invoice_number` VARCHAR(50) NOT NULL UNIQUE,
  `order_id` INT NOT NULL,
  `type` ENUM('B2B', 'B2C') DEFAULT 'B2B',
  `billing_name` VARCHAR(100) NOT NULL,
  `billing_address` TEXT NOT NULL,
  `gst_number` VARCHAR(20) DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `invoice_items` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `invoice_id` INT NOT NULL,
  `name` VARCHAR(200) NOT NULL,
  `hsn_code` VARCHAR(20) DEFAULT NULL,
  `quantity` INT NOT NULL,
  `unit_price` DECIMAL(12,2) NOT NULL,
  `gst_amount` DECIMAL(12,2) NOT NULL,
  `total_amount` DECIMAL(12,2) NOT NULL,
  FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `credit_notes` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `invoice_id` INT NOT NULL,
  `amount` DECIMAL(12,2) NOT NULL,
  `reason` TEXT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `debit_notes` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `invoice_id` INT NOT NULL,
  `amount` DECIMAL(12,2) NOT NULL,
  `reason` TEXT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `coupons` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `code` VARCHAR(30) NOT NULL UNIQUE,
  `type` ENUM('FLAT', 'PERCENTAGE', 'FREE_SHIPPING', 'CASHBACK') NOT NULL,
  `value` DECIMAL(10,2) NOT NULL,
  `min_cart_value` DECIMAL(10,2) DEFAULT 0.00,
  `start_date` DATE NOT NULL,
  `end_date` DATE NOT NULL,
  `max_uses` INT DEFAULT 100,
  `active` TINYINT(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `coupon_usage` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `coupon_id` INT NOT NULL,
  `user_id` INT NOT NULL,
  `order_id` INT NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `offers` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(150) NOT NULL,
  `type` ENUM('FLASH_SALE', 'FESTIVAL_SALE', 'PRODUCT_OFFER', 'CATEGORY_OFFER', 'SELLER_OFFER') NOT NULL,
  `discount_value` DECIMAL(10,2) NOT NULL,
  `start_date` DATETIME NOT NULL,
  `end_date` DATETIME NOT NULL,
  `active` TINYINT(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `offer_products` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `offer_id` INT NOT NULL,
  `product_id` INT NOT NULL,
  FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `banners` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(100) DEFAULT NULL,
  `image_url` VARCHAR(255) NOT NULL,
  `link_url` VARCHAR(255) DEFAULT NULL,
  `position_id` INT NOT NULL,
  `sort_order` INT DEFAULT 0,
  `active` TINYINT(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `banner_positions` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL UNIQUE,
  `key` VARCHAR(50) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT NOT NULL,
  `title` VARCHAR(150) NOT NULL,
  `message` TEXT NOT NULL,
  `read` TINYINT(1) DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  INDEX (`user_id`),
  INDEX (`read`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `notification_logs` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `notification_id` INT NOT NULL,
  `channel` ENUM('SMS', 'EMAIL', 'WHATSAPP', 'PUSH') NOT NULL,
  `status` ENUM('PENDING', 'SENT', 'FAILED') DEFAULT 'PENDING',
  `sent_at` TIMESTAMP NULL DEFAULT NULL,
  FOREIGN KEY (`notification_id`) REFERENCES `notifications` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `sms_logs` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `phone_number` VARCHAR(20) NOT NULL,
  `message` TEXT NOT NULL,
  `provider` VARCHAR(50) DEFAULT NULL,
  `status` VARCHAR(20) DEFAULT 'SENT',
  `sent_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `email_logs` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `email` VARCHAR(150) NOT NULL,
  `subject` VARCHAR(255) NOT NULL,
  `body` TEXT NOT NULL,
  `status` VARCHAR(20) DEFAULT 'SENT',
  `sent_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `whatsapp_logs` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `phone_number` VARCHAR(20) NOT NULL,
  `template_name` VARCHAR(100) DEFAULT NULL,
  `raw_data` TEXT,
  `status` VARCHAR(20) DEFAULT 'SENT',
  `sent_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `support_tickets` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `ticket_number` VARCHAR(50) NOT NULL UNIQUE,
  `user_id` INT NOT NULL,
  `subject` VARCHAR(200) NOT NULL,
  `status` ENUM('OPEN', 'IN_PROGRESS', 'RESOLVED', 'CLOSED') DEFAULT 'OPEN',
  `priority` ENUM('LOW', 'MEDIUM', 'HIGH', 'CRITICAL') DEFAULT 'LOW',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `ticket_messages` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `ticket_id` INT NOT NULL,
  `sender_id` INT NOT NULL,
  `message` TEXT NOT NULL,
  `is_internal` TINYINT(1) DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`ticket_id`) REFERENCES `support_tickets` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `ticket_attachments` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `ticket_message_id` INT NOT NULL,
  `file_path` VARCHAR(255) NOT NULL,
  FOREIGN KEY (`ticket_message_id`) REFERENCES `ticket_messages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `cms_pages` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(150) NOT NULL,
  `slug` VARCHAR(150) NOT NULL UNIQUE,
  `content` TEXT NOT NULL,
  `meta_title` VARCHAR(150) DEFAULT NULL,
  `meta_description` TEXT,
  `active` TINYINT(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `cms_blocks` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `identifier` VARCHAR(100) NOT NULL UNIQUE,
  `content` TEXT NOT NULL,
  `active` TINYINT(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `reports_cache` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `report_type` VARCHAR(100) NOT NULL,
  `data` LONGTEXT,
  `generated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `audit_logs` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `table_name` VARCHAR(100) NOT NULL,
  `record_id` INT NOT NULL,
  `action` ENUM('INSERT', 'UPDATE', 'DELETE') NOT NULL,
  `old_values` LONGTEXT,
  `new_values` LONGTEXT,
  `user_id` INT DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `activity_logs` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT DEFAULT NULL,
  `activity` VARCHAR(255) NOT NULL,
  `details` TEXT,
  `ip_address` VARCHAR(45) DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `api_clients` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `client_key` VARCHAR(100) NOT NULL UNIQUE,
  `client_secret` VARCHAR(255) NOT NULL,
  `active` TINYINT(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `api_tokens` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `api_client_id` INT NOT NULL,
  `token` VARCHAR(255) NOT NULL UNIQUE,
  `expires_at` TIMESTAMP NOT NULL,
  FOREIGN KEY (`api_client_id`) REFERENCES `api_clients` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `system_settings` (
  `setting_key` VARCHAR(100) PRIMARY KEY,
  `setting_value` TEXT,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS `error_logs` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `message` TEXT NOT NULL,
  `url` VARCHAR(255) DEFAULT NULL,
  `file_name` VARCHAR(255) DEFAULT NULL,
  `line_number` INT DEFAULT NULL,
  `user_id` INT DEFAULT NULL,
  `ip_address` VARCHAR(45) DEFAULT NULL,
  `browser` TEXT DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;
CREATE TABLE IF NOT EXISTS subscribers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE IF NOT EXISTS coupons (
    id INT AUTO_INCREMENT PRIMARY KEY,
    seller_id INT NOT NULL,
    code VARCHAR(50) NOT NULL UNIQUE,
    discount_percent INT NOT NULL,
    valid_from DATE NOT NULL,
    valid_to DATE NOT NULL,
    usage_limit INT DEFAULT 0,
    used_count INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (seller_id) REFERENCES users(id) ON DELETE CASCADE
);
CREATE TABLE IF NOT EXISTS applied_coupons (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    coupon_id INT NOT NULL,
    discount_amount DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (coupon_id) REFERENCES coupons(id) ON DELETE CASCADE
);

ALTER TABLE users ADD COLUMN email_opt_in TINYINT(1) DEFAULT 1;


CREATE TABLE IF NOT EXISTS `devices` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT NOT NULL,
  `device_token` VARCHAR(255) NOT NULL,
  `device_type` ENUM('ANDROID', 'IOS', 'WEB') DEFAULT 'ANDROID',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY `unique_device_token` (`device_token`),
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
