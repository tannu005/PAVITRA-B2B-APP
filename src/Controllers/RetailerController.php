<?php

namespace App\Controllers;

use Core\Controller;
use Core\Request;
use Core\Response;
use Core\Application;

class RetailerController extends Controller {
    
    // Storefront homepage (Meesho-style Catalog)
    public function index(Request $request, Response $response) {
        $body = $request->getBody();
        $category = $body['category'] ?? '';
        $search = $body['search'] ?? '';
        $sort = $body['sort'] ?? '';
        $minPrice = floatval($body['min_price'] ?? 0);
        $maxPrice = floatval($body['max_price'] ?? 0);
        
        $db = Application::$app->db;
        
        // Build query
        $sql = "
            SELECT p.*, pv.id as variant_id, pv.wholesale_price, pv.price, pv.image_url, pv.bulk_threshold, pv.stock, pv.sku, pv.color, pv.weight, pv.dimensions, c.name as category_name 
            FROM products p 
            JOIN product_variants pv ON pv.product_id = p.id
            JOIN categories c ON p.category_id = c.id
            WHERE p.status = 'ACTIVE' AND p.is_approved = 1
        ";
        $params = [];
        
        if (!empty($category)) {
            $sql .= " AND c.name = ?";
            $params[] = $category;
        }
        
        if (!empty($search)) {
            $sql .= " AND (p.title LIKE ? OR p.description LIKE ?)";
            $params[] = "%{$search}%";
            $params[] = "%{$search}%";
        }

        if ($minPrice > 0) {
            $sql .= " AND pv.wholesale_price >= ?";
            $params[] = $minPrice;
        }

        if ($maxPrice > 0) {
            $sql .= " AND pv.wholesale_price <= ?";
            $params[] = $maxPrice;
        }

        // Sorting
        if ($sort === 'price_low') {
            $sql .= " ORDER BY pv.wholesale_price ASC";
        } else if ($sort === 'price_high') {
            $sql .= " ORDER BY pv.wholesale_price DESC";
        } else {
            $sql .= " ORDER BY p.id DESC";
        }

        // Cache products query for 60 seconds to support 25K concurrent users
        $cacheKey = "catalog_products_" . md5(serialize([$category, $search, $sort, $minPrice, $maxPrice]));
        $products = Application::$app->cache->remember($cacheKey, 60, function() use ($db, $sql, $params) {
            $stmt = $db->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll() ?: [];
        });

        // Cache categories list for 1 hour
        $categoriesList = Application::$app->cache->remember('categories_list', 3600, function() use ($db) {
            $stmtCat = $db->query("SELECT id, name FROM categories");
            return $stmtCat->fetchAll() ?: [];
        });

        return $this->render('retailer/catalog', [
            'title' => 'Pavitra B2B Wholesale - Meesho Style Shop',
            'products' => $products,
            'categoriesList' => $categoriesList,
            'selectedCategory' => $category,
            'searchQuery' => $search,
            'sort' => $sort,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice
        ]);
    }

    // Detail JSON/Modal data
    public function detail(Request $request, Response $response, array $params) {
        $id = intval($params['id'] ?? 0);
        $db = Application::$app->db;
        
        $stmt = $db->prepare("
            SELECT p.*, pv.id as variant_id, pv.sku, pv.color, pv.size, pv.weight, pv.dimensions, pv.wholesale_price, pv.price, pv.bulk_threshold, pv.stock, pv.image_url, c.name as category_name
            FROM products p
            JOIN product_variants pv ON pv.product_id = p.id
            JOIN categories c ON p.category_id = c.id
            WHERE p.id = ? AND p.status = 'ACTIVE'
        ");
        $stmt->execute([$id]);
        $product = $stmt->fetch();
        
        if (!$product) {
            return $response->json(['error' => 'Product not found'], 404);
        }
        
        return $response->json($product);
    }

    // Cart Helper: get or create cart
    protected function getOrCreateCartId(): int {
        $db = Application::$app->db;
        $user = Application::$app->getSessionUser();
        $sessionId = session_id();

        if ($user) {
            // Find user cart
            $stmt = $db->prepare("SELECT id FROM carts WHERE user_id = ?");
            $stmt->execute([$user['id']]);
            $cart = $stmt->fetch();
            if ($cart) {
                return $cart['id'];
            }
            // Create user cart
            $stmtInsert = $db->prepare("INSERT INTO carts (user_id, session_id) VALUES (?, ?)");
            $stmtInsert->execute([$user['id'], $sessionId]);
            return $db->lastInsertId();
        } else {
            // Find guest session cart
            $stmt = $db->prepare("SELECT id FROM carts WHERE session_id = ? AND user_id IS NULL");
            $stmt->execute([$sessionId]);
            $cart = $stmt->fetch();
            if ($cart) {
                return $cart['id'];
            }
            // Create guest cart
            $stmtInsert = $db->prepare("INSERT INTO carts (user_id, session_id) VALUES (NULL, ?)");
            $stmtInsert->execute([$sessionId]);
            return $db->lastInsertId();
        }
    }

    // View Cart JSON payload (Ajax handler)
    public function cartView(Request $request, Response $response) {
        $cartId = $this->getOrCreateCartId();
        $db = Application::$app->db;

        $stmt = $db->prepare("
            SELECT ci.quantity, pv.id as variant_id, pv.wholesale_price, pv.price, pv.bulk_threshold, pv.image_url, p.title
            FROM cart_items ci
            JOIN product_variants pv ON ci.product_variant_id = pv.id
            JOIN products p ON pv.product_id = p.id
            WHERE ci.cart_id = ?
        ");
        $stmt->execute([$cartId]);
        $items = $stmt->fetchAll() ?: [];

        $subtotal = 0;
        $processedItems = [];

        foreach ($items as $item) {
            $qty = intval($item['quantity']);
            $threshold = intval($item['bulk_threshold']);
            $isWholesale = ($qty >= $threshold);
            $unitPrice = $isWholesale ? floatval($item['wholesale_price']) : floatval($item['price']);
            $total = $unitPrice * $qty;
            $subtotal += $total;

            $processedItems[] = [
                'variant_id' => $item['variant_id'],
                'title' => $item['title'],
                'image_url' => $item['image_url'],
                'quantity' => $qty,
                'bulk_threshold' => $threshold,
                'is_wholesale' => $isWholesale,
                'price' => $unitPrice,
                'total' => $total
            ];
        }

        $discount = 0.00;
        $couponCode = '';
        if (isset($_SESSION['applied_coupon'])) {
            $sessCoupon = $_SESSION['applied_coupon'];
            $stmtC = $db->prepare("SELECT * FROM coupons WHERE id = ? AND active = 1 AND start_date <= CURDATE() AND end_date >= CURDATE()");
            $stmtC->execute([$sessCoupon['id']]);
            $coupon = $stmtC->fetch();
            if ($coupon && $subtotal >= floatval($coupon['min_cart_value'])) {
                $couponCode = $coupon['code'];
                if ($coupon['type'] === 'FLAT') {
                    $discount = floatval($coupon['value']);
                } else if ($coupon['type'] === 'PERCENTAGE') {
                    $discount = ($subtotal * floatval($coupon['value'])) / 100.00;
                }
                if ($discount > $subtotal) $discount = $subtotal;
                $_SESSION['applied_coupon']['discount'] = $discount;
            } else {
                // Remove coupon if cart subtotal dropped below threshold
                unset($_SESSION['applied_coupon']);
            }
        }

        return $response->json([
            'items' => $processedItems,
            'subtotal' => $subtotal,
            'discount' => $discount,
            'coupon_code' => $couponCode,
            'total' => $subtotal - $discount
        ]);
    }

    // Add To Cart
    public function addToCart(Request $request, Response $response) {
        $body = $request->getBody();
        $variantId = intval($body['variant_id'] ?? 0);
        $qty = intval($body['quantity'] ?? 1);

        if ($variantId <= 0 || $qty <= 0) {
            return $response->json(['error' => 'Invalid product variant or quantity'], 400);
        }

        $db = Application::$app->db;
        // Verify stock
        $stmt = $db->prepare("SELECT stock, sku FROM product_variants WHERE id = ?");
        $stmt->execute([$variantId]);
        $variant = $stmt->fetch();
        
        if (!$variant) {
            return $response->json(['error' => 'Product variant not found'], 404);
        }
        
        if ($variant['stock'] < $qty) {
            return $response->json(['error' => "Only {$variant['stock']} units available in inventory."], 400);
        }

        $cartId = $this->getOrCreateCartId();
        
        // Check if item already exists in cart
        $stmtCheck = $db->prepare("SELECT id, quantity FROM cart_items WHERE cart_id = ? AND product_variant_id = ?");
        $stmtCheck->execute([$cartId, $variantId]);
        $existing = $stmtCheck->fetch();

        if ($existing) {
            $newQty = $existing['quantity'] + $qty;
            if ($variant['stock'] < $newQty) {
                return $response->json(['error' => "Cannot add more. Total in cart ({$newQty}) exceeds stock."], 400);
            }
            $stmtUpdate = $db->prepare("UPDATE cart_items SET quantity = ? WHERE id = ?");
            $stmtUpdate->execute([$newQty, $existing['id']]);
        } else {
            $stmtInsert = $db->prepare("INSERT INTO cart_items (cart_id, product_variant_id, quantity) VALUES (?, ?, ?)");
            $stmtInsert->execute([$cartId, $variantId, $qty]);
        }

        return $this->cartView($request, $response);
    }

    // Update Cart Qty
    public function updateCart(Request $request, Response $response) {
        $body = $request->getBody();
        $variantId = intval($body['variant_id'] ?? 0);
        $change = intval($body['change'] ?? 0);

        if ($variantId <= 0 || $change === 0) {
            return $response->json(['error' => 'Invalid parameters'], 400);
        }

        $cartId = $this->getOrCreateCartId();
        $db = Application::$app->db;

        $stmt = $db->prepare("SELECT ci.id, ci.quantity, pv.stock FROM cart_items ci JOIN product_variants pv ON ci.product_variant_id = pv.id WHERE ci.cart_id = ? AND ci.product_variant_id = ?");
        $stmt->execute([$cartId, $variantId]);
        $item = $stmt->fetch();

        if ($item) {
            $newQty = $item['quantity'] + $change;
            if ($newQty <= 0) {
                $stmtDel = $db->prepare("DELETE FROM cart_items WHERE id = ?");
                $stmtDel->execute([$item['id']]);
            } else {
                if ($item['stock'] < $newQty) {
                    return $response->json(['error' => "Stock limit reached. Only {$item['stock']} items available."], 400);
                }
                $stmtUpdate = $db->prepare("UPDATE cart_items SET quantity = ? WHERE id = ?");
                $stmtUpdate->execute([$newQty, $item['id']]);
            }
        }

        return $this->cartView($request, $response);
    }

    // Remove From Cart
    public function removeFromCart(Request $request, Response $response) {
        $body = $request->getBody();
        $variantId = intval($body['variant_id'] ?? 0);
        $cartId = $this->getOrCreateCartId();
        $db = Application::$app->db;

        $stmt = $db->prepare("DELETE FROM cart_items WHERE cart_id = ? AND product_variant_id = ?");
        $stmt->execute([$cartId, $variantId]);

        return $this->cartView($request, $response);
    }

    // Checkout Flow: Places order and deducts balance
    public function checkout(Request $request, Response $response) {
        $user = $this->checkAuth(['RETAILER']);
        if (!$user) return;

        $body = $request->getBody();
        $address = trim($body['address'] ?? '');

        if (empty($address)) {
            return $response->json(['error' => 'Delivery shipping address is required.'], 400);
        }

        $db = Application::$app->db;
        $cartId = $this->getOrCreateCartId();

        // Get cart items
        $stmt = $db->prepare("
            SELECT ci.quantity, pv.id as variant_id, pv.wholesale_price, pv.price, pv.bulk_threshold, pv.stock, p.seller_id, p.id as product_id
            FROM cart_items ci
            JOIN product_variants pv ON ci.product_variant_id = pv.id
            JOIN products p ON pv.product_id = p.id
            WHERE ci.cart_id = ?
        ");
        $stmt->execute([$cartId]);
        $cartItems = $stmt->fetchAll();

        if (empty($cartItems)) {
            return $response->json(['error' => 'Your wholesale cart is empty.'], 400);
        }

        // Calculate Totals & Group by Seller
        $subtotal = 0;
        $groupedItems = [];
        
        foreach ($cartItems as $item) {
            $qty = intval($item['quantity']);
            if ($item['stock'] < $qty) {
                return $response->json(['error' => "Stock limit exceeded for variant SKU: #{$item['variant_id']}"], 400);
            }
            
            $isWholesale = ($qty >= intval($item['bulk_threshold']));
            $price = $isWholesale ? floatval($item['wholesale_price']) : floatval($item['price']);
            $itemTotal = $price * $qty;
            $subtotal += $itemTotal;

            $groupedItems[$item['seller_id']][] = [
                'variant_id' => $item['variant_id'],
                'quantity' => $qty,
                'price' => $item['price'],
                'wholesale_price' => $item['wholesale_price'],
                'price_used' => $price,
                'total' => $itemTotal
            ];
        }

        // Coupon discount validation
        $discountAmount = 0.00;
        $couponId = null;
        if (isset($_SESSION['applied_coupon'])) {
            $sessCoupon = $_SESSION['applied_coupon'];
            $stmtC = $db->prepare("SELECT * FROM coupons WHERE id = ? AND active = 1 AND start_date <= CURDATE() AND end_date >= CURDATE()");
            $stmtC->execute([$sessCoupon['id']]);
            $coupon = $stmtC->fetch();
            if ($coupon && $subtotal >= floatval($coupon['min_cart_value'])) {
                $couponId = $coupon['id'];
                if ($coupon['type'] === 'FLAT') {
                    $discountAmount = floatval($coupon['value']);
                } else if ($coupon['type'] === 'PERCENTAGE') {
                    $discountAmount = ($subtotal * floatval($coupon['value'])) / 100.00;
                }
                if ($discountAmount > $subtotal) $discountAmount = $subtotal;
            }
        }
        $netSubtotal = $subtotal - $discountAmount;

        // Check Retailer Profile Balance & Credit Limit
        $stmtProfile = $db->prepare("SELECT * FROM retailer_profiles WHERE user_id = ?");
        $stmtProfile->execute([$user['id']]);
        $profile = $stmtProfile->fetch();

        if (!$profile) {
            return $response->json(['error' => 'Retailer profile not found.'], 404);
        }

        $availableBalance = floatval($profile['balance']);
        if ($availableBalance < $netSubtotal) {
            return $response->json(['error' => "Insufficient wallet balance. You need ₹" . number_format($netSubtotal, 2) . " but only have ₹" . number_format($availableBalance, 2) . " in your wallet."], 400);
        }

        try {
            $db->beginTransaction();

            // 1. Deduct from retailer wallet
            $newBalance = $availableBalance - $netSubtotal;
            $stmtUpdateProfile = $db->prepare("UPDATE retailer_profiles SET balance = ? WHERE user_id = ?");
            $stmtUpdateProfile->execute([$newBalance, $user['id']]);

            // Deduct user wallet table too
            $stmtWallet = $db->prepare("UPDATE wallets SET balance = ? WHERE user_id = ?");
            $stmtWallet->execute([$newBalance, $user['id']]);

            // Get user wallet id
            $stmtWalletId = $db->prepare("SELECT id FROM wallets WHERE user_id = ?");
            $stmtWalletId->execute([$user['id']]);
            $walletId = $stmtWalletId->fetchColumn();

            // Insert transaction entry
            $stmtTx = $db->prepare("
                INSERT INTO wallet_transactions (wallet_id, type, amount, description, reference_type, balance_after)
                VALUES (?, 'DEBIT', ?, ?, 'ORDER_PURCHASE', ?)
            ");
            $stmtTx->execute([$walletId, $netSubtotal, "Bulk order payment for Pavitra catalog sarees", $newBalance]);

            // Create shipping address entry if new
            $stmtAddr = $db->prepare("INSERT INTO user_addresses (user_id, address_line1, city, state, pin_code) VALUES (?, ?, 'Varanasi', 'Uttar Pradesh', '221001')");
            $stmtAddr->execute([$user['id'], $address]);
            $addressId = $db->lastInsertId();

            // 2. Place Split Orders (one order per weaver/seller)
            foreach ($groupedItems as $sellerId => $items) {
                $orderNumber = 'ORD-' . strtoupper(bin2hex(random_bytes(4))) . '-' . time();
                
                $orderTotal = array_sum(array_column($items, 'total'));
                $orderDiscount = ($subtotal > 0) ? ($orderTotal / $subtotal) * $discountAmount : 0;
                $orderNet = $orderTotal - $orderDiscount;
                
                // Create order
                $stmtOrder = $db->prepare("
                    INSERT INTO orders (order_number, user_id, seller_id, status, total_amount, discount_amount, net_amount, payment_status, payment_method, address_id)
                    VALUES (?, ?, ?, 'PLACED', ?, ?, ?, 'PAID', 'WALLET', ?)
                ");
                $stmtOrder->execute([$orderNumber, $user['id'], $sellerId, $orderTotal, $orderDiscount, $orderNet, $addressId]);
                $orderId = $db->lastInsertId();

                if ($couponId) {
                    $stmtCouponUsage = $db->prepare("INSERT INTO coupon_usage (coupon_id, user_id, order_id) VALUES (?, ?, ?)");
                    $stmtCouponUsage->execute([$couponId, $user['id'], $orderId]);
                }

                // Create status log
                $stmtHistory = $db->prepare("
                    INSERT INTO order_status_history (order_id, status, comments, created_by)
                    VALUES (?, 'PLACED', 'Order placed successfully by retailer', ?)
                ");
                $stmtHistory->execute([$orderId, $user['id']]);

                // Create items
                foreach ($items as $item) {
                    $stmtItem = $db->prepare("
                        INSERT INTO order_items (order_id, product_variant_id, quantity, price, wholesale_price)
                        VALUES (?, ?, ?, ?, ?)
                    ");
                    $stmtItem->execute([$orderId, $item['variant_id'], $item['quantity'], $item['price'], $item['wholesale_price']]);

                    // Deduct inventory stock
                    $stmtStock = $db->prepare("UPDATE product_variants SET stock = stock - ? WHERE id = ?");
                    $stmtStock->execute([$item['quantity'], $item['variant_id']]);

                    // Log inventory reduction
                    $stmtInvLog = $db->prepare("
                        INSERT INTO inventory_logs (product_variant_id, type, quantity, reason)
                        VALUES (?, 'OUT', ?, ?)
                    ");
                    $stmtInvLog->execute([$item['variant_id'], $item['quantity'], "Sold on Order #{$orderNumber}"]);
                }
            }

            // 3. Clear cart and session coupon
            $stmtClear = $db->prepare("DELETE FROM cart_items WHERE cart_id = ?");
            $stmtClear->execute([$cartId]);
            unset($_SESSION['applied_coupon']);

            $db->commit();
            return $response->json(['success' => true]);

        } catch (\Throwable $e) {
            $db->rollBack();
            return $response->json(['error' => 'Checkout execution crashed: ' . $e->getMessage()], 500);
        }
    }

    // View past orders list
    public function orders(Request $request, Response $response) {
        $user = $this->checkAuth(['RETAILER']);
        if (!$user) return;

        $db = Application::$app->db;
        $stmt = $db->prepare("
            SELECT o.*, u.name as seller_name 
            FROM orders o
            JOIN users u ON o.seller_id = u.id
            WHERE o.user_id = ?
            ORDER BY o.id DESC
        ");
        $stmt->execute([$user['id']]);
        $ordersList = $stmt->fetchAll() ?: [];

        // Gather items for each order
        foreach ($ordersList as &$order) {
            $stmtItems = $db->prepare("
                SELECT oi.quantity, oi.price, oi.wholesale_price, pv.image_url, p.title
                FROM order_items oi
                JOIN product_variants pv ON oi.product_variant_id = pv.id
                JOIN products p ON pv.product_id = p.id
                WHERE oi.order_id = ?
            ");
            $stmtItems->execute([$order['id']]);
            $order['items'] = $stmtItems->fetchAll() ?: [];
        }

        return $this->render('retailer/orders', [
            'title' => 'My Bulk Orders - Pavitra B2B',
            'orders' => $ordersList
        ]);
    }

    // Wallet transaction ledger history
    public function wallet(Request $request, Response $response) {
        $user = $this->checkAuth(['RETAILER', 'SELLER', 'DELIVERY']);
        if (!$user) return;

        $db = Application::$app->db;
        
        // Get wallet details
        $stmtWallet = $db->prepare("SELECT * FROM wallets WHERE user_id = ?");
        $stmtWallet->execute([$user['id']]);
        $wallet = $stmtWallet->fetch();

        $transactions = [];
        if ($wallet) {
            $stmtTx = $db->prepare("SELECT * FROM wallet_transactions WHERE wallet_id = ? ORDER BY id DESC");
            $stmtTx->execute([$wallet['id']]);
            $transactions = $stmtTx->fetchAll() ?: [];
        }

        return $this->render('retailer/wallet', [
            'title' => 'Wallet Ledger - Pavitra B2B',
            'wallet' => $wallet,
            'transactions' => $transactions
        ]);
    }

    // Wishlist page — renders saved product IDs from client localStorage via PHP shell
    public function wishlist(Request $request, Response $response) {
        $user = $this->checkAuth(['RETAILER', 'SELLER']);
        if (!$user) return;

        return $this->render('retailer/wishlist', [
            'title' => 'My Wishlist — Pavitra B2B',
        ]);
    }

    // Profile detail manager view
    public function profileView(Request $request, Response $response) {
        $user = $this->checkAuth();
        if (!$user) return;
        return $this->render('retailer/profile', [
            'title' => 'Account Settings - Pavitra B2B',
            'user' => $user
        ]);
    }

    public function updateProfile(Request $request, Response $response) {
        $user = $this->checkAuth();
        if (!$user) return;

        $body = $request->getBody();
        $name = trim($body['name'] ?? '');
        $email = trim($body['email'] ?? '');

        $errors = [];
        if (empty($name)) $errors[] = 'Full name is required.';
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Valid email address is required.';

        $db = Application::$app->db;
        if (empty($errors)) {
            // Update
            $stmt = $db->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
            $stmt->execute([$name, $email, $user['id']]);
            
            // Redirect
            $response->redirect('/profile');
            return;
        }

        return $this->render('retailer/profile', [
            'title' => 'Account Settings - Pavitra B2B',
            'errors' => $errors,
            'user' => $user
        ]);
    }

    // Apply coupon code via POST JSON
    public function applyCoupon(Request $request, Response $response) {
        $body = $request->getBody();
        $code = strtoupper(trim($body['code'] ?? ''));
        $cartSubtotal = floatval($body['subtotal'] ?? 0);

        if (empty($code)) {
            return $response->json(['error' => 'Coupon code is required.'], 400);
        }

        $db = Application::$app->db;
        $stmt = $db->prepare("
            SELECT * FROM coupons 
            WHERE code = ? AND active = 1 AND start_date <= CURDATE() AND end_date >= CURDATE()
        ");
        $stmt->execute([$code]);
        $coupon = $stmt->fetch();

        if (!$coupon) {
            return $response->json(['error' => 'Invalid or expired coupon code.'], 400);
        }

        if ($cartSubtotal < floatval($coupon['min_cart_value'])) {
            return $response->json([
                'error' => "Minimum cart subtotal of ₹" . number_format($coupon['min_cart_value'], 2) . " is required to apply this coupon."
            ], 400);
        }

        // Calculate discount
        $discount = 0.00;
        if ($coupon['type'] === 'FLAT') {
            $discount = floatval($coupon['value']);
        } else if ($coupon['type'] === 'PERCENTAGE') {
            $discount = ($cartSubtotal * floatval($coupon['value'])) / 100.00;
        }

        // Clip discount to subtotal
        if ($discount > $cartSubtotal) {
            $discount = $cartSubtotal;
        }

        // Store coupon details in session for checkout
        $_SESSION['applied_coupon'] = [
            'id' => $coupon['id'],
            'code' => $coupon['code'],
            'type' => $coupon['type'],
            'value' => floatval($coupon['value']),
            'discount' => $discount
        ];

        return $response->json([
            'success' => true,
            'code' => $coupon['code'],
            'discount' => $discount,
            'new_total' => $cartSubtotal - $discount
        ]);
    }

    // Dynamic CMS Page Handler
    public function cmsPage(Request $request, Response $response, array $params) {
        $slug = $params['slug'] ?? '';
        
        if (empty($slug)) {
            $path = trim($request->getPath(), '/');
            $slug = $path;
        }

        $db = Application::$app->db;
        $stmt = $db->prepare("SELECT * FROM cms_pages WHERE slug = ? AND active = 1");
        $stmt->execute([$slug]);
        $page = $stmt->fetch();

        if (!$page) {
            $response->setStatusCode(404);
            return $this->render('_404', ['title' => 'Page Not Found']);
        }

        return $this->render('retailer/cms', [
            'title' => ($page['meta_title'] ?? $page['title']),
            'page' => $page
        ]);
    }

    // Shop by category listing view (replaces about-us/theory page in bottom nav)
    public function categoriesView(Request $request, Response $response) {
        $categories = [
            ['name' => 'Banarasi Brocade', 'image' => '/banarasi_1782883519429.png', 'slug' => 'Banarasi+Brocade', 'desc' => 'Bridal luxury zari drapes'],
            ['name' => 'Kanjeevaram Silk', 'image' => '/kanjeevaram_1782883481838.png', 'slug' => 'Kanjeevaram+Silk', 'desc' => 'Classic South Indian heritage'],
            ['name' => 'Patola Silk', 'image' => '/patola_1782883499288.png', 'slug' => 'Patola+Silk', 'desc' => 'Traditional double ikat weaves'],
            ['name' => 'Organza Silk', 'image' => '/tissue_1782883588057.png', 'slug' => 'Organza+Silk', 'desc' => 'Lightweight sheer sophistication'],
            ['name' => 'Chanderi Weave', 'image' => '/banarasi_1782883568122.png', 'slug' => 'Chanderi+Weave', 'desc' => 'Delicate textures and patterns'],
            ['name' => 'Mysore Crepe Silk', 'image' => '/kanjeevaram_1782883536799.png', 'slug' => 'Mysore+Crepe+Silk', 'desc' => 'Smooth, rich royal silk'],
            ['name' => 'Jamdani Muslin', 'image' => '/patola_1782883552751.png', 'slug' => 'Jamdani+Muslin', 'desc' => 'Fine transparent artistic weave']
        ];
        
        return $this->render('retailer/categories', [
            'title' => 'Shop by Category - Pavitra B2B',
            'categories' => $categories
        ]);
    }
}

