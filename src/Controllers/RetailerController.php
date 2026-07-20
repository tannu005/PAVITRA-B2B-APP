<?php
namespace App\Controllers;
use Core\Controller;
use Core\Request;
use Core\Response;
use Core\Application;
class RetailerController extends Controller {
    public function index(Request $request, Response $response) {
        $body = $request->getBody();
        $category = $body['category'] ?? '';
        $search = $body['search'] ?? '';
        $sort = $body['sort'] ?? '';
        $minPrice = floatval($body['min_price'] ?? 0);
        $maxPrice = floatval($body['max_price'] ?? 0);
        $db = Application::$app->db;
        $sql = "
            SELECT p.*, 
                   MIN(pv.id) as variant_id, 
                   MIN(pv.wholesale_price) as wholesale_price, 
                   MAX(pv.price) as price, 
                   MIN(pv.image_url) as image_url, 
                   MIN(pv.bulk_threshold) as bulk_threshold, 
                   MIN(pv.stock) as stock, 
                   MIN(pv.sku) as sku, 
                   GROUP_CONCAT(pv.color ORDER BY pv.id ASC SEPARATOR '|') as all_colors, 
                   MIN(pv.weight) as weight, 
                   MIN(pv.dimensions) as dimensions, 
                   c.name as category_name 
            FROM products p 
            JOIN product_variants pv ON pv.product_id = p.id
            JOIN categories c ON p.category_id = c.id
            WHERE p.status = 'ACTIVE'
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
        $sql .= " GROUP BY p.id";
        if ($sort === 'price_low') {
            $sql .= " ORDER BY MIN(pv.wholesale_price) ASC";
        } else if ($sort === 'price_high') {
            $sql .= " ORDER BY MIN(pv.wholesale_price) DESC";
        } else {
            $sql .= " ORDER BY p.id DESC";
        }
        $cacheKey = "catalog_products_v2_" . md5(serialize([$category, $search, $sort, $minPrice, $maxPrice]));
        $products = Application::$app->cache->remember($cacheKey, 60, function() use ($db, $sql, $params) {
            $stmt = $db->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll() ?: [];
        });
        $categoriesList = Application::$app->cache->remember('categories_list_v2', 3600, function() use ($db) {
            $stmtCat = $db->query("SELECT id, name FROM categories");
            return $stmtCat->fetchAll() ?: [];
        });
        return $this->render('retailer/catalog', [
            'title' => 'Pavitra Designer Wholesale - Pavitra Style Shop',
            'products' => $products,
            'categoriesList' => $categoriesList,
            'selectedCategory' => $category,
            'searchQuery' => $search,
            'sort' => $sort,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice
        ]);
    }
    public function detail(Request $request, Response $response, array $params) {
        $id = intval($params['id'] ?? 0);
        $db = Application::$app->db;
        $stmt = $db->prepare("
            SELECT p.*, c.name as category_name
            FROM products p
            JOIN categories c ON p.category_id = c.id
            WHERE p.id = ? AND p.status = 'ACTIVE'
        ");
        $stmt->execute([$id]);
        $product = $stmt->fetch();
        if (!$product) {
            $response->redirect('/');
            return;
        }
        $stmtVariants = $db->prepare("SELECT * FROM product_variants WHERE product_id = ? ORDER BY id ASC");
        $stmtVariants->execute([$id]);
        $variants = $stmtVariants->fetchAll();
        
        $body = $request->getBody();
        $requestedColor = isset($body['color']) ? strtolower(trim($body['color'])) : '';
        $selectedVariantIndex = 0;

        if (!empty($variants)) {
            if ($requestedColor) {
                foreach ($variants as $idx => $v) {
                    if (strtolower(trim($v['color'])) === $requestedColor) {
                        $selectedVariantIndex = $idx;
                        break;
                    }
                }
            }

            $product['variant_id'] = $variants[$selectedVariantIndex]['id'];
            $product['sku'] = $variants[$selectedVariantIndex]['sku'];
            $product['color'] = $variants[$selectedVariantIndex]['color'];
            $product['size'] = $variants[$selectedVariantIndex]['size'];
            $product['weight'] = $variants[$selectedVariantIndex]['weight'];
            $product['dimensions'] = $variants[$selectedVariantIndex]['dimensions'];
            $product['wholesale_price'] = $variants[$selectedVariantIndex]['wholesale_price'];
            $product['price'] = $variants[$selectedVariantIndex]['price'];
            $product['bulk_threshold'] = $variants[$selectedVariantIndex]['bulk_threshold'];
            $product['stock'] = $variants[$selectedVariantIndex]['stock'];
            $product['image_url'] = $variants[$selectedVariantIndex]['image_url'];
        }
        $stmtImg = $db->prepare("SELECT image_url, is_primary FROM product_images WHERE product_id = ? ORDER BY is_primary DESC, id ASC");
        $stmtImg->execute([$id]);
        $images = $stmtImg->fetchAll();
        $stmtVid = $db->prepare("SELECT video_url FROM product_videos WHERE product_id = ?");
        $stmtVid->execute([$id]);
        $videos = $stmtVid->fetchAll();

        $stmtReviews = $db->prepare("
            SELECT pr.*, u.name as user_name
            FROM product_reviews pr
            JOIN users u ON pr.user_id = u.id
            WHERE pr.product_id = ?
            ORDER BY pr.created_at DESC
        ");
        $stmtReviews->execute([$id]);
        $reviews = $stmtReviews->fetchAll();

        return $this->render('retailer/product_detail', [
            'product' => $product,
            'variants' => $variants,
            'images' => $images,
            'videos' => $videos,
            'reviews' => $reviews
        ]);
    }

    public function addReview(Request $request, Response $response) {
        $user = Application::$app->getSessionUser();
        if (!$user) {
            $response->setStatusCode(401);
            return json_encode(['success' => false, 'error' => 'You must be logged in to leave a review.']);
        }

        $body = $request->getBody();
        $productId = intval($body['product_id'] ?? 0);
        $rating = intval($body['rating'] ?? 0);
        $comment = trim($body['comment'] ?? '');

        if ($productId <= 0 || $rating < 1 || $rating > 5 || empty($comment)) {
            $response->setStatusCode(400);
            return json_encode(['success' => false, 'error' => 'Invalid review data.']);
        }

        try {
            $db = Application::$app->db;
            $stmt = $db->prepare("INSERT INTO product_reviews (product_id, user_id, rating, comment) VALUES (?, ?, ?, ?)");
            $stmt->execute([$productId, $user['id'], $rating, $comment]);
            return json_encode(['success' => true]);
        } catch (\Exception $e) {
            $response->setStatusCode(500);
            return json_encode(['success' => false, 'error' => 'Failed to submit review.']);
        }
    }
    protected function getOrCreateCartId(): int {
        $db = Application::$app->db;
        $user = Application::$app->getSessionUser();
        $sessionId = session_id();
        if ($user) {
            $stmt = $db->prepare("SELECT id FROM carts WHERE user_id = ?");
            $stmt->execute([$user['id']]);
            $cart = $stmt->fetch();
            if ($cart) {
                return $cart['id'];
            }
            $stmtInsert = $db->prepare("INSERT INTO carts (user_id, session_id) VALUES (?, ?)");
            $stmtInsert->execute([$user['id'], $sessionId]);
            return $db->lastInsertId();
        } else {
            $stmt = $db->prepare("SELECT id FROM carts WHERE session_id = ? AND user_id IS NULL");
            $stmt->execute([$sessionId]);
            $cart = $stmt->fetch();
            if ($cart) {
                return $cart['id'];
            }
            $stmtInsert = $db->prepare("INSERT INTO carts (user_id, session_id) VALUES (NULL, ?)");
            $stmtInsert->execute([$sessionId]);
            return $db->lastInsertId();
        }
    }
    public function cartView(Request $request, Response $response) {
        $cartId = $this->getOrCreateCartId();
        $db = Application::$app->db;
        $stmt = $db->prepare("
            SELECT ci.quantity, pv.id as variant_id, pv.wholesale_price, pv.price, pv.bulk_threshold, pv.image_url, p.title,
            (SELECT image_url FROM product_images pi WHERE pi.product_id = p.id LIMIT 1) as hover_image_url
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
    public function addToCart(Request $request, Response $response) {
        $body = $request->getBody();
        $variantId = intval($body['variant_id'] ?? 0);
        $qty = intval($body['quantity'] ?? 1);
        if ($variantId <= 0 || $qty <= 0) {
            return $response->json(['error' => 'Invalid product variant or quantity'], 400);
        }
        $db = Application::$app->db;
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
    public function removeFromCart(Request $request, Response $response) {
        $body = $request->getBody();
        $variantId = intval($body['variant_id'] ?? 0);
        $cartId = $this->getOrCreateCartId();
        $db = Application::$app->db;
        $stmt = $db->prepare("DELETE FROM cart_items WHERE cart_id = ? AND product_variant_id = ?");
        $stmt->execute([$cartId, $variantId]);
        return $this->cartView($request, $response);
    }
    private function calculateCartTotals(int $cartId): array|string {
        $db = Application::$app->db;
        $stmt = $db->prepare("
            SELECT ci.quantity, pv.id as variant_id, pv.wholesale_price, pv.price, pv.bulk_threshold, pv.stock
            FROM cart_items ci
            JOIN product_variants pv ON ci.product_variant_id = pv.id
            WHERE ci.cart_id = ?
        ");
        $stmt->execute([$cartId]);
        $cartItems = $stmt->fetchAll();
        if (empty($cartItems)) {
            return 'Your wholesale cart is empty.';
        }
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $qty = intval($item['quantity']);
            if ($item['stock'] < $qty) {
                return "Stock limit exceeded for variant SKU: #{$item['variant_id']}";
            }
            $isWholesale = ($qty >= intval($item['bulk_threshold']));
            $price = $isWholesale ? floatval($item['wholesale_price']) : floatval($item['price']);
            $subtotal += $price * $qty;
        }
        $discountAmount = 0.00;
        if (isset($_SESSION['applied_coupon'])) {
            $sessCoupon = $_SESSION['applied_coupon'];
            $stmtC = $db->prepare("SELECT * FROM coupons WHERE id = ? AND active = 1 AND start_date <= CURDATE() AND end_date >= CURDATE()");
            $stmtC->execute([$sessCoupon['id']]);
            $coupon = $stmtC->fetch();
            if ($coupon && $subtotal >= floatval($coupon['min_cart_value'])) {
                if ($coupon['type'] === 'FLAT') {
                    $discountAmount = floatval($coupon['value']);
                } else if ($coupon['type'] === 'PERCENTAGE') {
                    $discountAmount = ($subtotal * floatval($coupon['value'])) / 100.00;
                }
                if ($discountAmount > $subtotal) $discountAmount = $subtotal;
            }
        }
        $netSubtotal = $subtotal - $discountAmount;
        return [
            'subtotal' => $subtotal,
            'discountAmount' => $discountAmount,
            'netSubtotal' => $netSubtotal
        ];
    }
    public function createRazorpayOrder(Request $request, Response $response) {
        $user = $this->checkAuth(['RETAILER']);
        if (!$user) return;
        $cartId = $this->getOrCreateCartId();
        $totals = $this->calculateCartTotals($cartId);
        if (is_string($totals)) {
            return $response->json(['error' => $totals], 400);
        }
        $netSubtotal = $totals['netSubtotal'];
        $key = Application::$app->config['payment_gateway_key'] ?? '';
        if (empty($key) || $key === 'YOUR_PAYMENT_GATEWAY_KEY') $key = getenv('PAYMENT_GATEWAY_KEY') ?: '';
        $secret = Application::$app->config['payment_gateway_secret'] ?? '';
        if (empty($secret) || $secret === 'YOUR_PAYMENT_GATEWAY_SECRET') $secret = getenv('PAYMENT_GATEWAY_SECRET') ?: '';
        if (empty($key) || empty($secret)) {
            return $response->json(['error' => 'Payment gateway keys are not configured in system settings.'], 500);
        }
        $amountInPaise = intval(round($netSubtotal * 100));
        error_log("Razorpay Checkout Started. Net Subtotal: $netSubtotal, Key: $key");
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.razorpay.com/v1/orders');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            'amount' => $amountInPaise,
            'currency' => 'INR',
            'receipt' => 'rcpt_' . time()
        ]));
        curl_setopt($ch, CURLOPT_USERPWD, $key . ':' . $secret);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4); 
        curl_setopt($ch, CURLOPT_TIMEOUT, 10); 
        $headers = ['Content-Type: application/json'];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            error_log("Razorpay CURL Error: " . curl_error($ch));
            return $response->json(['error' => 'Payment gateway error: ' . curl_error($ch)], 500);
        }
        curl_close($ch);
        $rzp = json_decode($result, true);
        if (isset($rzp['error'])) {
            error_log("Razorpay API Error: " . json_encode($rzp['error']));
            return $response->json(['error' => 'Razorpay Error: ' . $rzp['error']['description']], 500);
        }
        error_log("Razorpay Order Created: " . $rzp['id']);
        return $response->json([
            'order_id' => $rzp['id'],
            'amount' => $amountInPaise,
            'key' => $key,
            'name' => Application::$app->config['company_name'] ?? 'Pavitra Designer',
            'prefill' => [
                'name' => $user['name'],
                'email' => $user['email'],
                'contact' => $user['mobile']
            ]
        ]);
    }
    public function createWalletOrder(Request $request, Response $response) {
        $user = $this->checkAuth(['RETAILER']);
        if (!$user) return;
        $body = $request->getBody();
        $address = trim($body['address'] ?? '');
        if (empty($address)) {
            return $response->json(['error' => 'Delivery shipping address is required.'], 400);
        }
        $cartId = $this->getOrCreateCartId();
        $totals = $this->calculateCartTotals($cartId);
        if (is_string($totals)) {
            return $response->json(['error' => $totals], 400);
        }
        $db = Application::$app->db;
        $netSubtotal = $totals['netSubtotal'];
        try {
            $db->beginTransaction();
            $stmtWallet = $db->prepare("SELECT id, balance FROM wallets WHERE user_id = ? FOR UPDATE");
            $stmtWallet->execute([$user['id']]);
            $wallet = $stmtWallet->fetch();
            if (!$wallet || floatval($wallet['balance']) < $netSubtotal) {
                $db->rollBack();
                return $response->json(['error' => 'Insufficient wallet balance.'], 400);
            }
            $checkoutResult = $this->processConfirmedCheckout($user, $address, 'WALLET_TXN', 'WALLET', 'PAID', $db);
            if (isset($checkoutResult['error'])) {
                $db->rollBack();
                return $response->json($checkoutResult, 400);
            }
            $stmtUpWallet = $db->prepare("UPDATE wallets SET balance = balance - ? WHERE id = ?");
            $stmtUpWallet->execute([$netSubtotal, $wallet['id']]);
            $stmtTx = $db->prepare("
                INSERT INTO wallet_transactions (wallet_id, type, amount, description, reference_type, balance_after)
                VALUES (?, 'DEBIT', ?, ?, 'ORDER_PAYMENT', (SELECT balance FROM wallets WHERE id = ?))
            ");
            $stmtTx->execute([$wallet['id'], $netSubtotal, "Payment for Wholesale Order", $wallet['id']]);
            $db->commit();
            return $response->json(['success' => true]);
        } catch (\Throwable $e) {
            if ($db->inTransaction()) {
                $db->rollBack();
            }
            error_log($e);
            return $response->json(['error' => 'Server error processing wallet order.'], 500);
        }
    }
    public function createCodOrder(Request $request, Response $response) {
        $user = $this->checkAuth(['RETAILER']);
        if (!$user) return;
        $body = $request->getBody();
        $address = trim($body['address'] ?? '');
        if (empty($address)) {
            return $response->json(['error' => 'Delivery shipping address is required.'], 400);
        }
        $cartId = $this->getOrCreateCartId();
        $totals = $this->calculateCartTotals($cartId);
        if (is_string($totals)) {
            return $response->json(['error' => $totals], 400);
        }
        try {
            $db = Application::$app->db;
            $db->beginTransaction();
            $checkoutResult = $this->processConfirmedCheckout($user, $address, null, 'COD', 'PENDING', $db);
            if (isset($checkoutResult['error'])) {
                $db->rollBack();
                return $response->json($checkoutResult, 400);
            }
            $db->commit();
            return $response->json(['success' => true]);
        } catch (\Throwable $e) {
            if ($db->inTransaction()) {
                $db->rollBack();
            }
            error_log($e);
            return $response->json(['error' => 'Server error processing COD order.'], 500);
        }
    }
    public function verifyRazorpayPayment(Request $request, Response $response) {
        $user = $this->checkAuth(['RETAILER']);
        if (!$user) return;
        $body = $request->getBody();
        $razorpayPaymentId = $body['razorpay_payment_id'] ?? '';
        $razorpayOrderId = $body['razorpay_order_id'] ?? '';
        $razorpaySignature = $body['razorpay_signature'] ?? '';
        $address = trim($body['address'] ?? '');
        if (empty($address)) {
            return $response->json(['error' => 'Delivery shipping address is required.'], 400);
        }
        $secret = Application::$app->config['payment_gateway_secret'] ?? '';
        if (empty($secret) || $secret === 'YOUR_PAYMENT_GATEWAY_SECRET') $secret = getenv('PAYMENT_GATEWAY_SECRET') ?: '';
        $generatedSignature = hash_hmac('sha256', $razorpayOrderId . "|" . $razorpayPaymentId, $secret);
        if ($generatedSignature !== $razorpaySignature) {
            return $response->json(['error' => 'Payment signature verification failed.'], 400);
        }
        $db = Application::$app->db;
        $checkoutResult = $this->processConfirmedCheckout($user, $address, $razorpayPaymentId, 'RAZORPAY', 'PAID', $db);
        if (isset($checkoutResult['error'])) {
            return $response->json($checkoutResult, 400);
        }
        return $response->json($checkoutResult);
    }
    private function processConfirmedCheckout($user, $address, $paymentId, $paymentMethod = 'RAZORPAY', $paymentStatus = 'PAID', $db = null) {
        try {
            $db = Application::$app->db;
            $cartId = $this->getOrCreateCartId();
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
                return ['error' => 'Your wholesale cart is empty.'];
            }
            $subtotal = 0;
            $groupedItems = [];
            foreach ($cartItems as $item) {
                $qty = intval($item['quantity']);
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
            $hasActiveTransaction = $db->inTransaction();
            if (!$hasActiveTransaction) {
                $db->beginTransaction();
            }
            $stmtAddr = $db->prepare("INSERT INTO user_addresses (user_id, address_line1, city, state, pin_code) VALUES (?, ?, 'Varanasi', 'Uttar Pradesh', '221001')");
            $stmtAddr->execute([$user['id'], $address]);
            $addressId = $db->lastInsertId();
            foreach ($groupedItems as $sellerId => $items) {
                $orderNumber = 'ORD-' . strtoupper(bin2hex(random_bytes(4))) . '-' . time();
                $orderTotal = array_sum(array_column($items, 'total'));
                $orderDiscount = ($subtotal > 0) ? ($orderTotal / $subtotal) * $discountAmount : 0;
                $orderNet = $orderTotal - $orderDiscount;
                $stmtOrder = $db->prepare("
                    INSERT INTO orders (order_number, user_id, seller_id, status, total_amount, discount_amount, net_amount, payment_status, payment_method, address_id)
                    VALUES (?, ?, ?, 'PLACED', ?, ?, ?, ?, ?, ?)
                ");
                $stmtOrder->execute([$orderNumber, $user['id'], $sellerId, $orderTotal, $orderDiscount, $orderNet, $paymentStatus, $paymentMethod, $addressId]);
                $orderId = $db->lastInsertId();
                if ($couponId) {
                    $stmtCouponUsage = $db->prepare("INSERT INTO coupon_usage (coupon_id, user_id, order_id) VALUES (?, ?, ?)");
                    $stmtCouponUsage->execute([$couponId, $user['id'], $orderId]);
                }
                $stmtHistory = $db->prepare("
                    INSERT INTO order_status_history (order_id, status, comments, created_by)
                    VALUES (?, 'PLACED', ?, ?)
                ");
                $paymentComment = ($paymentMethod === 'COD') ? "Order Placed via COD" : "Paid via {$paymentMethod} (Txn: {$paymentId})";
                $stmtHistory->execute([$orderId, $paymentComment, $user['id']]);
                foreach ($items as $item) {
                    $stmtItem = $db->prepare("
                        INSERT INTO order_items (order_id, product_variant_id, quantity, price, wholesale_price)
                        VALUES (?, ?, ?, ?, ?)
                    ");
                    $stmtItem->execute([$orderId, $item['variant_id'], $item['quantity'], $item['price'], $item['wholesale_price']]);
                    $stmtStock = $db->prepare("UPDATE product_variants SET stock = stock - ? WHERE id = ?");
                    $stmtStock->execute([$item['quantity'], $item['variant_id']]);
                    $stmtInvLog = $db->prepare("
                        INSERT INTO inventory_logs (product_variant_id, type, quantity, reason)
                        VALUES (?, 'OUT', ?, ?)
                    ");
                    $stmtInvLog->execute([$item['variant_id'], $item['quantity'], "Sold on Order #{$orderNumber}"]);
                }
            }
            $stmtClear = $db->prepare("DELETE FROM cart_items WHERE cart_id = ?");
            $stmtClear->execute([$cartId]);
            unset($_SESSION['applied_coupon']);
            if (!$hasActiveTransaction) {
                \Core\NotificationService::dispatchOrderPlaced($user['id'], $orderId, $cartTotal);
                $db->commit();
            }
            return ['success' => true];
        } catch (\Throwable $e) {
            if (isset($db) && $db->inTransaction() && (!isset($hasActiveTransaction) || !$hasActiveTransaction)) {
                $db->rollBack();
            }
            return ['error' => 'Checkout execution crashed: ' . $e->getMessage()];
        }
    }
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
            'title' => 'My Bulk Orders - Pavitra Designer',
            'orders' => $ordersList
        ]);
    }
    public function wallet(Request $request, Response $response) {
        $user = $this->checkAuth(['RETAILER', 'SELLER', 'DELIVERY']);
        if (!$user) return;
        $db = Application::$app->db;
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
            'title' => 'Wallet Ledger - Pavitra Designer',
            'wallet' => $wallet,
            'transactions' => $transactions
        ]);
    }
    public function wishlist(Request $request, Response $response) {
        $user = $this->checkAuth(['RETAILER', 'SELLER']);
        if (!$user) return;
        return $this->render('retailer/wishlist', [
            'title' => 'My Wishlist ÔÇö Pavitra Designer',
        ]);
    }
    public function customizationView(Request $request, Response $response) {
        $user = $this->checkAuth(['RETAILER', 'SELLER']);
        if (!$user) return;
        return $this->render('retailer/customization', [
            'title' => 'Saree Customization Request ÔÇö Pavitra Designer',
            'user' => $user
        ]);
    }
    public function profileView(Request $request, Response $response) {
        $user = $this->checkAuth();
        if (!$user) return;
        $db = Application::$app->db;
        $stmtSessions = $db->prepare("SELECT * FROM user_sessions WHERE user_id = ? ORDER BY last_active DESC");
        $stmtSessions->execute([$user['id']]);
        $activeSessions = $stmtSessions->fetchAll(\PDO::FETCH_ASSOC) ?: [];
        return $this->render('retailer/profile', [
            'title' => 'Account Settings - Pavitra Designer',
            'user' => $user,
            'activeSessions' => $activeSessions
        ]);
    }
    public function revokeOtherSessions(Request $request, Response $response) {
        $user = $this->checkAuth();
        if (!$user) return;
        $db = Application::$app->db;
        $currentToken = $_SESSION['session_token'] ?? '';
        $stmt = $db->prepare("DELETE FROM user_sessions WHERE user_id = ? AND token != ?");
        $stmt->execute([$user['id'], $currentToken]);
        $_SESSION['settings_success'] = 'Signed out of all other devices successfully.';
        $response->redirect('/profile');
    }
    public function updateProfile(Request $request, Response $response) {
        $user = $this->checkAuth();
        if (!$user) return;
        $body = $request->getBody();
        $name = trim($body['name'] ?? '');
        $email = trim($body['email'] ?? '');
        $emailOptIn = isset($body['email_opt_in']) ? 1 : 0;
        $errors = [];
        if (empty($name)) $errors[] = 'Full name is required.';
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Valid email address is required.';
        $db = Application::$app->db;
        if (empty($errors)) {
            $stmt = $db->prepare("UPDATE users SET name = ?, email = ?, email_opt_in = ? WHERE id = ?");
            $stmt->execute([$name, $email, $emailOptIn, $user['id']]);
            $response->redirect('/profile');
            return;
        }
        return $this->render('retailer/profile', [
            'title' => 'Account Settings - Pavitra Designer',
            'errors' => $errors,
            'user' => $user
        ]);
    }
    public function deleteAccount(Request $request, Response $response) {
        $user = $this->checkAuth();
        if (!$user) return;
        $db = Application::$app->db;
        try {
            $db->beginTransaction();
            $userId = $user['id'];
            $stmtSessions = $db->prepare("DELETE FROM user_sessions WHERE user_id = ?");
            $stmtSessions->execute([$userId]);
            $stmtLogs = $db->prepare("DELETE FROM activity_logs WHERE user_id = ?");
            $stmtLogs->execute([$userId]);
            $stmtSeller = $db->prepare("DELETE FROM seller_profiles WHERE user_id = ?");
            $stmtSeller->execute([$userId]);
            $stmtRetailer = $db->prepare("DELETE FROM retailer_profiles WHERE user_id = ?");
            $stmtRetailer->execute([$userId]);
            $stmtDelivery = $db->prepare("DELETE FROM delivery_partner_profiles WHERE user_id = ?");
            $stmtDelivery->execute([$userId]);
            $stmtWallet = $db->prepare("DELETE FROM wallets WHERE user_id = ?");
            $stmtWallet->execute([$userId]);
            $stmtUser = $db->prepare("DELETE FROM users WHERE id = ?");
            $stmtUser->execute([$userId]);
            $db->commit();
            unset($_SESSION['user_id']);
            unset($_SESSION['session_token']);
            unset($_SESSION['session_device']);
            session_destroy();
            $response->redirect('/login');
        } catch (\Throwable $e) {
            $db->rollBack();
            return $this->render('retailer/profile', [
                'title' => 'Account Settings - Pavitra Designer',
                'errors' => ['Failed to delete account: ' . $e->getMessage()],
                'user' => $user
            ]);
        }
    }
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
                'error' => "Minimum cart subtotal of Ôé╣" . number_format($coupon['min_cart_value'], 2) . " is required to apply this coupon."
            ], 400);
        }
        $discount = 0.00;
        if ($coupon['type'] === 'FLAT') {
            $discount = floatval($coupon['value']);
        } else if ($coupon['type'] === 'PERCENTAGE') {
            $discount = ($cartSubtotal * floatval($coupon['value'])) / 100.00;
        }
        if ($discount > $cartSubtotal) {
            $discount = $cartSubtotal;
        }
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
    public function categoriesView(Request $request, Response $response) {
        $db = Application::$app->db;
        $sareeTypes = ['Bandhej Sarees', 'Banarasi Sarees', 'Pittan Work Sarees', 'Gota Patti Sarees', 'Chunri Sarees', 'Leheriya Sarees', 'Organza Sarees', 'Silk Sarees', 'Georgette Sarees', 'Chiffon Sarees', 'Tissue Sarees', 'Cotton Sarees', 'Linen Sarees', 'Printed Sarees', 'Designer Sarees', 'Handloom Sarees'];
        $occasionTypes = ['Wedding Wear', 'Bridal Sarees', 'Party Wear', 'Festival Wear', 'Office Wear', 'Daily Wear', 'Reception Collection', 'Haldi Collection', 'Mehendi Collection', 'Sangeet Collection'];
        $fabricTypes = ['Pure Silk', 'Soft Silk', 'Organza', 'Georgette', 'Chiffon', 'Cotton', 'Tissue', 'Linen'];

        $requiredCats = array_merge($sareeTypes, $occasionTypes, $fabricTypes);

        $stmtExisting = $db->query("SELECT name FROM categories");
        $existing = $stmtExisting->fetchAll(\PDO::FETCH_COLUMN) ?: [];

        foreach ($requiredCats as $reqCat) {
            if (!in_array($reqCat, $existing)) {
                $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $reqCat)));
                $stmtInsert = $db->prepare("INSERT INTO categories (name, slug) VALUES (?, ?)");
                $stmtInsert->execute([$reqCat, $slug]);
            }
        }

        $stmtCats = $db->query("SELECT id, name, slug FROM categories ORDER BY id ASC");
        $allCats = $stmtCats->fetchAll();

        $sidebar = [
            'Saree Categories' => [],
            'Shop by Occasion' => [],
            'Fabric' => []
        ];

        foreach ($allCats as $c) {
            $name = $c['name'];
            if (in_array($name, $sareeTypes)) {
                $sidebar['Saree Categories'][] = $c;
            } elseif (in_array($name, $occasionTypes)) {
                $sidebar['Shop by Occasion'][] = $c;
            } elseif (in_array($name, $fabricTypes)) {
                $sidebar['Fabric'][] = $c;
            }
        }

        $groupedCategories = array_filter($sidebar, function($g) { return !empty($g); });
        
        $body = $request->getBody();
        $activeCategory = $body['category'] ?? '';
        
        // If no active category, pick the first one from the first group
        if (empty($activeCategory) && !empty($groupedCategories)) {
            $firstGroup = reset($groupedCategories);
            if (!empty($firstGroup)) {
                $activeCategory = $firstGroup[0]['slug'];
            }
        }

        $sql = "
            SELECT p.*, 
                   MIN(pv.id) as variant_id, 
                   MIN(pv.wholesale_price) as wholesale_price, 
                   MAX(pv.price) as price, 
                   MIN(pv.image_url) as image_url, 
                   MIN(pv.bulk_threshold) as bulk_threshold, 
                   MIN(pv.stock) as stock, 
                   MIN(pv.sku) as sku, 
                   GROUP_CONCAT(pv.color ORDER BY pv.id ASC SEPARATOR '|') as all_colors, 
                   MIN(pv.weight) as weight, 
                   MIN(pv.dimensions) as dimensions, 
                   c.name as category_name 
            FROM products p 
            JOIN product_variants pv ON pv.product_id = p.id
            JOIN categories c ON p.category_id = c.id
            WHERE p.status = 'ACTIVE'
        ";
        $params = [];
        if (!empty($activeCategory)) {
            $sql .= " AND c.slug = ?";
            $params[] = $activeCategory;
        }
        $sql .= " GROUP BY p.id ORDER BY p.id DESC";
        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        $products = $stmt->fetchAll();

        return $this->render('retailer/categories', [
            'groupedCategories' => $groupedCategories,
            'products' => $products,
            'activeCategory' => $activeCategory
        ]);
    }
}
