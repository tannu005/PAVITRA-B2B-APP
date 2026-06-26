-- MySQL 8+ Database Seeds for Meesho-style B2B Wholesale Marketplace

-- 1. Insert default roles
INSERT INTO `roles` (`id`, `name`, `description`) VALUES
(1, 'SUPER_ADMIN', 'Super Administrator with full control over the platform'),
(2, 'ADMIN', 'Administrator with user approval and KYC permissions'),
(3, 'SELLER', 'Weaver / Manufacturer / Wholesaler'),
(4, 'RETAILER', 'Boutique owner / Buyer / Retail Retailer'),
(5, 'DELIVERY', 'Logistics and delivery partner'),
(6, 'EMPLOYEE', 'Support or operations employee');

-- 2. Insert standard permissions
INSERT INTO `permissions` (`id`, `name`, `description`) VALUES
(1, 'manage_users', 'Ability to create, update, block users'),
(2, 'approve_sellers', 'Verify seller KYC and approve seller profiles'),
(3, 'approve_products', 'Review and approve catalog items'),
(4, 'manage_commissions', 'Setup category or seller specific B2B commission rules'),
(5, 'process_settlements', 'Trigger payouts to weavers and sellers'),
(6, 'manage_inventory', 'Adjust stock, manage multi-warehouse inventory'),
(7, 'place_orders', 'Browse products, manage cart, place wholesale orders'),
(8, 'deliver_shipments', 'Manage pickups, deliveries, and collect OTP/signature proofs'),
(9, 'view_reports', 'Access sales, tax, settlement, and platform reports'),
(10, 'system_settings', 'Edit brand, logo, and integration API credentials');

-- 3. Link permissions to Super Admin role
INSERT INTO `role_permissions` (`role_id`, `permission_id`) VALUES
(1, 1), (1, 2), (1, 3), (1, 4), (1, 5), (1, 6), (1, 7), (1, 8), (1, 9), (1, 10),
(2, 1), (2, 2), (2, 3), (2, 6), (2, 9),
(3, 6), (3, 7), (3, 9),
(4, 7),
(5, 8);

-- 4. Insert default bank list
INSERT INTO `banks` (`id`, `name`, `code`) VALUES
(1, 'State Bank of India', 'SBI'),
(2, 'HDFC Bank', 'HDFC'),
(3, 'ICICI Bank', 'ICICI'),
(4, 'Axis Bank', 'AXIS'),
(5, 'Punjab National Bank', 'PNB');

-- 5. Insert default category and subcategories
INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `image_url`) VALUES
(1, 'Kanjeevaram Silk', 'kanjeevaram-silk', 'Authentic temple gold border sarees from Tamil Nadu', '/uploads/categories/kanji.png'),
(2, 'Banarasi Brocade', 'banarasi-brocade', 'Fine woven silk sarees from Varanasi with gold and silver zari', '/uploads/categories/banarasi.png'),
(3, 'Patola Silk', 'patola-silk', 'Double ikat woven heritage sarees from Patan, Gujarat', '/uploads/categories/patola.png'),
(4, 'Chanderi Weave', 'chanderi-weave', 'Lightweight sheer textured sarees from Madhya Pradesh', '/uploads/categories/chanderi.png'),
(5, 'Organza Silk', 'organza-silk', 'Modern lightweight sheer silk sarees with print or embroidery', '/uploads/categories/organza.png'),
(6, 'Mysore Crepe Silk', 'mysore-crepe-silk', 'Pure soft crepe silk sarees from Karnataka with gold border', '/uploads/categories/mysore.png'),
(7, 'Jamdani Muslin', 'jamdani-muslin', 'Intricately figured transparent cotton/silk sarees from Bengal', '/uploads/categories/jamdani.png');

INSERT INTO `subcategories` (`id`, `category_id`, `name`, `slug`, `description`) VALUES
(1, 1, 'Kanjeevaram Bridal', 'kanjeevaram-bridal', 'Heavy brocade bridal sarees'),
(2, 2, 'Banarasi Katan Silk', 'banarasi-katan-silk', 'Pure katan silk with silver zari'),
(3, 3, 'Patan Double Ikat', 'patan-double-ikat', 'Traditional geometric double ikat patterns'),
(4, 4, 'Chanderi Cotton Silk', 'chanderi-cotton-silk', 'Summer sheer blends');

-- 6. Insert default HSN/GST rates
INSERT INTO `gst_rates` (`id`, `hsn_code`, `percentage`, `description`) VALUES
(1, '5007', 5.00, 'Woven fabrics of silk or of silk waste (Saree handloom rate)'),
(2, '5208', 5.00, 'Woven fabrics of cotton, containing 85% or more by weight of cotton'),
(3, '6214', 12.00, 'Shawls, scarves, mufflers, mantillas, veils and the like');

-- 7. Insert default company settings
INSERT INTO `system_settings` (`setting_key`, `setting_value`) VALUES
('company_name', 'Viraasat Textiles Private Limited'),
('brand_name', 'Viraasat B2B'),
('logo_url', '/assets/images/logo-pink.png'),
('gst_number', '09AAAAA1111A1Z1'),
('cin_number', 'U17110UP2026PTC123456'),
('pan_number', 'AAAAA1111A'),
('support_email', 'wholesale@viraasat.com'),
('support_mobile', '+91 9999999999'),
('whatsapp_number', '+91 9999999999'),
('office_address', 'Viraasat Textiles & Crafts Association, Varanasi Handloom Cluster, Uttar Pradesh, 221001'),
('smtp_host', 'smtp.mailtrap.io'),
('smtp_port', '2525'),
('smtp_user', 'YOUR_SMTP_USER'),
('smtp_password', 'YOUR_SMTP_PASSWORD'),
('payment_gateway_key', 'YOUR_PAYMENT_GATEWAY_KEY'),
('payment_gateway_secret', 'YOUR_PAYMENT_GATEWAY_SECRET');

-- 8. Seed Super Admin account (Password is "password123" encrypted with bcrypt)
-- Hash: $2y$10$GjE39Zvikuw6YeSAHdCoCuK/XXFgqM4PTTqbPWbEyutmifai9gql.
INSERT INTO `users` (`id`, `name`, `email`, `mobile`, `password_hash`, `role_id`, `status`, `is_verified_email`, `is_verified_mobile`) VALUES
(1, 'System Administrator', 'admin@meeshob2b.com', '+91 9876543210', '$2y$10$GjE39Zvikuw6YeSAHdCoCuK/XXFgqM4PTTqbPWbEyutmifai9gql.', 1, 'ACTIVE', 1, 1);

INSERT INTO `wallets` (`id`, `user_id`, `balance`) VALUES (1, 1, 0.00);

-- 9. Seed some demo users
-- Seller / Weaver
INSERT INTO `users` (`id`, `name`, `email`, `mobile`, `password_hash`, `role_id`, `status`, `is_verified_email`, `is_verified_mobile`) VALUES
(2, 'Viraasat Weavers Ltd.', 'weaver@meeshob2b.com', '+91 8888888888', '$2y$10$GjE39Zvikuw6YeSAHdCoCuK/XXFgqM4PTTqbPWbEyutmifai9gql.', 3, 'ACTIVE', 1, 1);

INSERT INTO `seller_profiles` (`user_id`, `company_name`, `brand_name`, `registration_number`, `pan_number`, `gst_number`, `commission_rate`, `balance`) VALUES
(2, 'Viraasat Weavers & Artisans Guild', 'Viraasat Loom', 'REG-12345', 'BBBBB2222B', '09BBBBB2222B2Z2', 8.50, 150000.00);

INSERT INTO `wallets` (`id`, `user_id`, `balance`) VALUES (2, 2, 150000.00);

-- Retailer / Buyer
INSERT INTO `users` (`id`, `name`, `email`, `mobile`, `password_hash`, `role_id`, `status`, `is_verified_email`, `is_verified_mobile`) VALUES
(3, 'Heritage Saree Boutique', 'boutique@meeshob2b.com', '+91 7777777777', '$2y$10$GjE39Zvikuw6YeSAHdCoCuK/XXFgqM4PTTqbPWbEyutmifai9gql.', 4, 'ACTIVE', 1, 1);

INSERT INTO `retailer_profiles` (`user_id`, `shop_name`, `credit_limit`, `balance`) VALUES
(3, 'Heritage Boutique Retail Point', 100000.00, 25000.00);

INSERT INTO `wallets` (`id`, `user_id`, `balance`) VALUES (3, 3, 25000.00);

-- Delivery Driver
INSERT INTO `users` (`id`, `name`, `email`, `mobile`, `password_hash`, `role_id`, `status`, `is_verified_email`, `is_verified_mobile`) VALUES
(4, 'Express Logistics', 'delivery@meeshob2b.com', '+91 6666666666', '$2y$10$GjE39Zvikuw6YeSAHdCoCuK/XXFgqM4PTTqbPWbEyutmifai9gql.', 5, 'ACTIVE', 1, 1);

INSERT INTO `delivery_partner_profiles` (`user_id`, `vehicle_number`, `vehicle_type`, `balance`, `is_online`) VALUES
(4, 'UP-65-AB-1234', 'Mini Van Truck', 0.00, 1);

INSERT INTO `wallets` (`id`, `user_id`, `balance`) VALUES (4, 4, 0.00);

-- 10. Seed Demo Products
-- Product 1: Kanjeevaram Green
INSERT INTO `products` (`id`, `title`, `description`, `category_id`, `subcategory_id`, `brand_id`, `seller_id`, `status`, `is_approved`) VALUES
(1, 'Authentic Kanjeevaram Emerald Silk Saree', 'Traditional handloomed Kanjeevaram silk saree in emerald green with broad temple gold borders, woven with 2-ply pure zari threads.', 1, 1, NULL, 2, 'ACTIVE', 1);

INSERT INTO `product_variants` (`id`, `product_id`, `sku`, `color`, `size`, `weight`, `dimensions`, `price`, `wholesale_price`, `bulk_threshold`, `stock`, `image_url`) VALUES
(1, 1, 'KAN-GRN-001', 'Emerald Green', '6.3 Meters (With Blouse)', 750.00, '6.3m x 1.2m', 15000.00, 12000.00, 5, 25, '/kanjeevaram.png');

-- Product 2: Patola Maroon
INSERT INTO `products` (`id`, `title`, `description`, `category_id`, `subcategory_id`, `brand_id`, `seller_id`, `status`, `is_approved`) VALUES
(2, 'Traditional Patan Double Ikat Patola Saree', 'Exquisite double ikat Patola saree featuring classic geometric grids and animal motifs in maroon and natural dye tints.', 3, 3, NULL, 2, 'ACTIVE', 1);

INSERT INTO `product_variants` (`id`, `product_id`, `sku`, `color`, `size`, `weight`, `dimensions`, `price`, `wholesale_price`, `bulk_threshold`, `stock`, `image_url`) VALUES
(2, 2, 'PAT-MAR-002', 'Classic Maroon', '6.3 Meters (With Blouse)', 800.00, '6.3m x 1.2m', 22000.00, 18500.00, 3, 10, '/patola.png');

-- Product 3: Banarasi Blue
INSERT INTO `products` (`id`, `title`, `description`, `category_id`, `subcategory_id`, `brand_id`, `seller_id`, `status`, `is_approved`) VALUES
(3, 'Imperial Banarasi Katan Silk Royal Blue Saree', 'Royal blue saree woven with fine katan silk warps and real gold brocade kadwa motifs across the body and heavy pallu.', 2, 2, NULL, 2, 'ACTIVE', 1);

INSERT INTO `product_variants` (`id`, `product_id`, `sku`, `color`, `size`, `weight`, `dimensions`, `price`, `wholesale_price`, `bulk_threshold`, `stock`, `image_url`) VALUES
(3, 3, 'BAN-BLU-003', 'Royal Blue', '6.3 Meters', 850.00, '6.3m x 1.2m', 18000.00, 14800.00, 4, 15, '/banarasi.png');

-- Product 4: Tissue Ivory
INSERT INTO `products` (`id`, `title`, `description`, `category_id`, `subcategory_id`, `brand_id`, `seller_id`, `status`, `is_approved`) VALUES
(4, 'Bridal Tissue Ivory Silk Brocade Saree', 'Sheer tissue silk saree in ivory with delicate gold and silver zari floral jall weaves across the entire canvas.', 5, NULL, NULL, 2, 'ACTIVE', 1);

INSERT INTO `product_variants` (`id`, `product_id`, `sku`, `color`, `size`, `weight`, `dimensions`, `price`, `wholesale_price`, `bulk_threshold`, `stock`, `image_url`) VALUES
(4, 4, 'TIS-IVO-004', 'Ivory Gold', '6.3 Meters', 600.00, '6.3m x 1.2m', 25000.00, 21000.00, 3, 8, '/tissue.png');

-- 11. Seed CMS Pages
INSERT INTO `cms_pages` (`title`, `slug`, `content`, `meta_title`, `meta_description`, `active`) VALUES
('About Us', 'about-us', '<h1>About Viraasat B2B</h1><p>Viraasat B2B is a premier handloom weaver-direct B2B wholesale marketplace, bridging the gap between local master weavers and boutique retailers nationwide. We preserve Indian textile heritage while offering competitive wholesale pricing, dynamic commission systems, and integrated logistics.</p>', 'About Us - Viraasat B2B Wholesale Saree Marketplace', 'Learn about Viraasat B2B Wholesale and how we bridge local master weavers and retailers.', 1),
('Contact Us', 'contact-us', '<h1>Contact Viraasat Support</h1><p>Need support or assistance with wholesale orders, bulk weaver registration, or shipping status? Reach out to our 24/7 dedicated service desk.</p><ul><li><strong>Support Helpline:</strong> +91 9999999999</li><li><strong>WhatsApp Desk:</strong> +91 9999999999</li><li><strong>Email Address:</strong> wholesale@viraasat.com</li><li><strong>Registered Office:</strong> Varanasi Handloom Cluster, Uttar Pradesh, 221001</li></ul>', 'Contact Us - Viraasat B2B Support Desk', 'Get in touch with Viraasat B2B support desk for order tracking and weaver inquiries.', 1),
('Privacy Policy', 'privacy-policy', '<h1>Privacy Policy</h1><p>Your privacy is important to us. Viraasat B2B ensures the protection of user accounts, KYC documents, wallet ledger entries, and transaction details with enterprise-grade encryption. We do not sell or share business credentials or financial transaction history with third parties.</p>', 'Privacy Policy - Viraasat B2B Compliance', 'Privacy Policy and data security guidelines for Viraasat B2B Wholesale Marketplace.', 1),
('Terms & Conditions', 'terms-conditions', '<h1>Terms & Conditions</h1><p>By registering on Viraasat B2B, sellers (weavers), retailers (boutique buyers), and delivery riders agree to abide by our fair transaction guidelines. Wholesale prices apply only above MOQ thresholds. Settlements are disbursed on delivery completion, subject to commission rates and GST rules.</p>', 'Terms & Conditions - Viraasat B2B Merchant Agreement', 'Terms and conditions for buying and selling on Viraasat B2B marketplace.', 1),
('Refund Policy', 'refund-policy', '<h1>Refund & Return Policy</h1><p>We want you to be completely satisfied with your handloom sarees. Retailers can request returns within 7 days of delivery. Upon seller approval and driver pickup verification, refunds are automatically credited back to the retailer\'s wallet ledger.</p>', 'Refund & Return Policy - Viraasat B2B', 'Refund and return guidelines for boutique buyers and weavers on Viraasat B2B.', 1),
('Shipping Policy', 'shipping-policy', '<h1>Shipping & Logistics Policy</h1><p>Orders are dispatched by registered weavers within 24-48 hours of acceptance. Our logistics network assigns courier drivers with integrated routing and handover verification via secure 4-digit customer OTP codes.</p>', 'Shipping Policy - Viraasat B2B Courier Logistics', 'Shipping and logistics handbook for delivery partners and merchants.', 1);
