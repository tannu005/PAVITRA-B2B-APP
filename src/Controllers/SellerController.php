<?php

namespace App\Controllers;

use Core\Controller;
use Core\Request;
use Core\Response;
use Core\Application;

class SellerController extends Controller {

    public function __construct() {
        $this->setLayout('main');
    }

    public function dashboard(Request $request, Response $response) {
        $user = $this->checkAuth(['SELLER']);
        if (!$user) return;

        $db = Application::$app->db;

        $stmtBalance = $db->prepare("SELECT balance FROM seller_profiles WHERE user_id = ?");
        $stmtBalance->execute([$user['id']]);
        $balance = $stmtBalance->fetchColumn() ?: 0.00;

        $stmtProducts = $db->prepare("SELECT COUNT(*) FROM products WHERE seller_id = ?");
        $stmtProducts->execute([$user['id']]);
        $totalProducts = $stmtProducts->fetchColumn() ?: 0;

        $stmtOrders = $db->prepare("SELECT COUNT(*) FROM orders WHERE seller_id = ?");
        $stmtOrders->execute([$user['id']]);
        $totalOrders = $stmtOrders->fetchColumn() ?: 0;

        $stmtEarnings = $db->prepare("SELECT SUM(net_amount) FROM orders WHERE seller_id = ? AND payment_status = 'PAID'");
        $stmtEarnings->execute([$user['id']]);
        $totalEarnings = $stmtEarnings->fetchColumn() ?: 0.00;

        $stmtRecent = $db->prepare("
            SELECT o.*, u.name as buyer_name 
            FROM orders o
            JOIN users u ON o.user_id = u.id
            WHERE o.seller_id = ?
            ORDER BY o.id DESC LIMIT 5
        ");
        $stmtRecent->execute([$user['id']]);
        $recentOrders = $stmtRecent->fetchAll() ?: [];

        return $this->render('seller/dashboard', [
            'title' => 'Weaver Hub Dashboard - Pavitra Designer',
            'balance' => $balance,
            'totalProducts' => $totalProducts,
            'totalOrders' => $totalOrders,
            'totalEarnings' => $totalEarnings,
            'recentOrders' => $recentOrders,
            'user' => $user
        ]);
    }

    public function products(Request $request, Response $response) {
        $user = $this->checkAuth(['SELLER']);
        if (!$user) return;

        $db = Application::$app->db;
        $stmt = $db->prepare("
            SELECT p.*, pv.sku, pv.wholesale_price, pv.price, pv.stock, c.name as category_name
            FROM products p
            JOIN product_variants pv ON pv.product_id = p.id
            JOIN categories c ON p.category_id = c.id
            WHERE p.seller_id = ?
            ORDER BY p.id DESC
        ");
        $stmt->execute([$user['id']]);
        $products = $stmt->fetchAll() ?: [];

        return $this->render('seller/products', [
            'title' => 'My Saree Catalog - Weaver Hub',
            'products' => $products
        ]);
    }

    public function createProductView(Request $request, Response $response) {
        $user = $this->checkAuth(['SELLER']);
        if (!$user) return;

        $db = Application::$app->db;
        $categories = $db->query("SELECT id, name FROM categories")->fetchAll();

        return $this->render('seller/create_product', [
            'title' => 'Upload Saree - Weaver Hub',
            'categories' => $categories
        ]);
    }

    public function storeProduct(Request $request, Response $response) {
        $user = $this->checkAuth(['SELLER']);
        if (!$user) return;

        $body = $request->getBody();
        $title = trim($body['title'] ?? '');
        $description = trim($body['description'] ?? '');
        $categoryId = intval($body['category_id'] ?? 0);
        $sku = trim($body['sku'] ?? '');
        $color = trim($body['color'] ?? '');
        $size = trim($body['size'] ?? '');
        $price = floatval($body['price'] ?? 0);
        $wholesalePrice = floatval($body['wholesale_price'] ?? 0);
        $bulkThreshold = intval($body['bulk_threshold'] ?? 5);
        $stock = intval($body['stock'] ?? 0);
        $imageUrl = trim($body['image_url'] ?? '');

        $errors = [];
        if (empty($title)) $errors[] = 'Product Title is required.';
        if ($categoryId <= 0) $errors[] = 'Please select a Category.';
        if (empty($sku)) $errors[] = 'SKU is required.';
        if ($price <= 0) $errors[] = 'Retail price must be greater than zero.';
        if ($wholesalePrice <= 0 || $wholesalePrice >= $price) $errors[] = 'Wholesale price must be greater than zero and less than retail price.';
        if ($stock < 0) $errors[] = 'Stock cannot be negative.';

        $db = Application::$app->db;

        if (empty($errors)) {
            $stmtCheck = $db->prepare("SELECT id FROM product_variants WHERE sku = ?");
            $stmtCheck->execute([$sku]);
            if ($stmtCheck->fetch()) {
                $errors[] = 'A product variant with this SKU code already exists.';
            }
        }

        if (empty($errors)) {
            try {
                $db->beginTransaction();

                $stmtProd = $db->prepare("
                    INSERT INTO products (title, description, category_id, seller_id, status, is_approved)
                    VALUES (?, ?, ?, ?, 'ACTIVE', 0)
                ");
                $stmtProd->execute([$title, $description, $categoryId, $user['id']]);
                $productId = $db->lastInsertId();

                $stmtVariant = $db->prepare("
                    INSERT INTO product_variants (product_id, sku, color, size, price, wholesale_price, bulk_threshold, stock, image_url)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
                ");
                $stmtVariant->execute([$productId, $sku, $color, $size, $price, $wholesalePrice, $bulkThreshold, $stock, $imageUrl]);
                $variantId = $db->lastInsertId();

                $stmtInv = $db->prepare("INSERT INTO inventory (product_variant_id, stock, min_alert_stock) VALUES (?, ?, 5)");
                $stmtInv->execute([$variantId, $stock]);

                $stmtInvLog = $db->prepare("INSERT INTO inventory_logs (product_variant_id, type, quantity, reason) VALUES (?, 'IN', ?, 'Initial stock creation')");
                $stmtInvLog->execute([$variantId, $stock]);

                $db->commit();
                $response->redirect('/seller/products');
                return;

            } catch (\Throwable $e) {
                $db->rollBack();
                $errors[] = 'Failed to create product: ' . $e->getMessage();
            }
        }

        $categories = $db->query("SELECT id, name FROM categories")->fetchAll();
        return $this->render('seller/create_product', [
            'title' => 'Upload Saree - Weaver Hub',
            'errors' => $errors,
            'categories' => $categories,
            'title_val' => $title,
            'description_val' => $description,
            'sku_val' => $sku,
            'color_val' => $color,
            'size_val' => $size,
            'price_val' => $price,
            'wholesale_price_val' => $wholesalePrice,
            'bulk_threshold_val' => $bulkThreshold,
            'stock_val' => $stock,
            'image_url_val' => $imageUrl
        ]);
    }

    public function inventory(Request $request, Response $response) {
        $user = $this->checkAuth(['SELLER']);
        if (!$user) return;

        $db = Application::$app->db;
        $stmt = $db->prepare("
            SELECT pv.id as variant_id, pv.sku, pv.color, pv.size, pv.stock, p.title
            FROM product_variants pv
            JOIN products p ON pv.product_id = p.id
            WHERE p.seller_id = ?
            ORDER BY pv.id DESC
        ");
        $stmt->execute([$user['id']]);
        $variants = $stmt->fetchAll() ?: [];

        return $this->render('seller/inventory', [
            'title' => 'Inventory Management - Weaver Hub',
            'variants' => $variants
        ]);
    }

    public function updateInventory(Request $request, Response $response) {
        $user = $this->checkAuth(['SELLER']);
        if (!$user) return;

        $body = $request->getBody();
        $variantId = intval($body['variant_id'] ?? 0);
        $qty = intval($body['qty'] ?? 0);

        if ($variantId <= 0 || $qty <= 0) {
            return $response->json(['error' => 'Invalid parameters'], 400);
        }

        $db = Application::$app->db;
        
        $stmt = $db->prepare("
            SELECT pv.id FROM product_variants pv 
            JOIN products p ON pv.product_id = p.id 
            WHERE pv.id = ? AND p.seller_id = ?
        ");
        $stmt->execute([$variantId, $user['id']]);
        if (!$stmt->fetch()) {
            return $response->json(['error' => 'Permission denied'], 403);
        }

        try {
            $db->beginTransaction();

            $stmtUpdate = $db->prepare("UPDATE product_variants SET stock = stock + ? WHERE id = ?");
            $stmtUpdate->execute([$qty, $variantId]);

            $stmtLog = $db->prepare("INSERT INTO inventory_logs (product_variant_id, type, quantity, reason) VALUES (?, 'IN', ?, 'Manual Restock update')");
            $stmtLog->execute([$variantId, $qty]);

            $db->commit();
            return $response->json(['success' => true]);

        } catch (\Throwable $e) {
            $db->rollBack();
            return $response->json(['error' => 'Failed to adjust stock count'], 500);
        }
    }

    public function orders(Request $request, Response $response) {
        $user = $this->checkAuth(['SELLER']);
        if (!$user) return;

        $db = Application::$app->db;
        $stmt = $db->prepare("
            SELECT o.*, u.name as buyer_name 
            FROM orders o
            JOIN users u ON o.user_id = u.id
            WHERE o.seller_id = ?
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

        return $this->render('seller/orders', [
            'title' => 'Incoming Orders - Weaver Hub',
            'orders' => $ordersList
        ]);
    }

    public function updateOrderStatus(Request $request, Response $response) {
        $user = $this->checkAuth(['SELLER']);
        if (!$user) return;

        $body = $request->getBody();
        $orderId = intval($body['order_id'] ?? 0);
        $newStatus = trim($body['status'] ?? '');

        $allowedStatuses = ['ACCEPTED', 'PACKED', 'SHIPPED', 'CANCELLED'];
        if ($orderId <= 0 || !in_array($newStatus, $allowedStatuses)) {
            return $response->json(['error' => 'Invalid parameters'], 400);
        }

        $db = Application::$app->db;

        $stmt = $db->prepare("SELECT id, status, total_amount, user_id, order_number FROM orders WHERE id = ? AND seller_id = ?");
        $stmt->execute([$orderId, $user['id']]);
        $order = $stmt->fetch();

        if (!$order) {
            return $response->json(['error' => 'Order not found or permission denied'], 403);
        }

        try {
            $db->beginTransaction();

            $stmtUpdate = $db->prepare("UPDATE orders SET status = ? WHERE id = ?");
            $stmtUpdate->execute([$newStatus, $orderId]);

            $stmtHistory = $db->prepare("
                INSERT INTO order_status_history (order_id, status, comments, created_by)
                VALUES (?, ?, ?, ?)
            ");
            $stmtHistory->execute([$orderId, $newStatus, "Order status advanced to {$newStatus} by seller", $user['id']]);

            if ($newStatus === 'SHIPPED') {
                $shipNum = 'SHIP-' . strtoupper(bin2hex(random_bytes(4))) . '-' . time();
                $stmtShip = $db->prepare("INSERT INTO shipments (order_id, shipment_number, status) VALUES (?, ?, 'SHIPPED')");
                $stmtShip->execute([$orderId, $shipNum]);
                $shipId = $db->lastInsertId();

                $stmtRider = $db->query("SELECT id FROM users WHERE role_id = 5 LIMIT 1");
                $riderId = $stmtRider->fetchColumn();

                if ($riderId) {
                    $stmtAssign = $db->prepare("INSERT INTO delivery_assignments (shipment_id, delivery_partner_id, status) VALUES (?, ?, 'ASSIGNED')");
                    $stmtAssign->execute([$shipId, $riderId]);
                    $assignId = $db->lastInsertId();

                    $otp = rand(1000, 9999);
                    $stmtProof = $db->prepare("INSERT INTO delivery_proofs (delivery_assignment_id, otp_code) VALUES (?, ?)");
                    $stmtProof->execute([$assignId, $otp]);
                }
            }

            if ($newStatus === 'CANCELLED') {
                $stmtRetailer = $db->prepare("SELECT balance FROM retailer_profiles WHERE user_id = ?");
                $stmtRetailer->execute([$order['user_id']]);
                $retBalance = floatval($stmtRetailer->fetchColumn() ?: 0);

                $newRetBalance = $retBalance + floatval($order['total_amount']);
                $stmtUpdateRet = $db->prepare("UPDATE retailer_profiles SET balance = ? WHERE user_id = ?");
                $stmtUpdateRet->execute([$newRetBalance, $order['user_id']]);

                $stmtUpdateWallet = $db->prepare("UPDATE wallets SET balance = ? WHERE user_id = ?");
                $stmtUpdateWallet->execute([$newRetBalance, $order['user_id']]);

                $stmtRetWalletId = $db->prepare("SELECT id FROM wallets WHERE user_id = ?");
                $stmtRetWalletId->execute([$order['user_id']]);
                $retWalletId = $stmtRetWalletId->fetchColumn();

                $stmtTx = $db->prepare("
                    INSERT INTO wallet_transactions (wallet_id, type, amount, description, reference_type, reference_id, balance_after)
                    VALUES (?, 'CREDIT', ?, ?, 'ORDER_CANCELLED', ?, ?)
                ");
                $stmtTx->execute([$retWalletId, $order['total_amount'], "Refund for cancelled order #{$order['order_number']}", $orderId, $newRetBalance]);
            }

            $db->commit();
            return $response->json(['success' => true]);

        } catch (\Throwable $e) {
            $db->rollBack();
            return $response->json(['error' => 'Order status transition crashed: ' . $e->getMessage()], 500);
        }
    }

    public function settlements(Request $request, Response $response) {
        $user = $this->checkAuth(['SELLER']);
        if (!$user) return;

        $db = Application::$app->db;
        $stmt = $db->prepare("
            SELECT ss.*, o.order_number, s.settlement_number
            FROM seller_settlements ss
            JOIN orders o ON ss.order_id = o.id
            JOIN settlements s ON ss.settlement_id = s.id
            WHERE ss.seller_id = ?
            ORDER BY ss.id DESC
        ");
        $stmt->execute([$user['id']]);
        $settlements = $stmt->fetchAll() ?: [];

        return $this->render('seller/settlements', [
            'title' => 'Settlements & GST - Weaver Hub',
            'settlements' => $settlements
        ]);
    }

    public function bulkUploadView(Request $request, Response $response) {
        $user = $this->checkAuth(['SELLER']);
        if (!$user) return;

        return $this->render('seller/bulk_upload', [
            'title' => 'Bulk Product Upload - Weaver Hub'
        ]);
    }

    public function bulkUpload(Request $request, Response $response) {
        $user = $this->checkAuth(['SELLER']);
        if (!$user) return;

        $errors = [];
        $successCount = 0;
        $rowErrors = [];

        if (empty($_FILES['csv_file']['tmp_name'])) {
            $errors[] = 'Please choose a CSV file to upload.';
        } else {
            $file = $_FILES['csv_file']['tmp_name'];
            $handle = fopen($file, 'r');
            if ($handle === false) {
                $errors[] = 'Failed to open the uploaded file.';
            } else {
                $db = Application::$app->db;
                
                $headers = fgetcsv($handle);
                if (!$headers) {
                    $errors[] = 'The uploaded file is empty or invalid.';
                } else {
                    $headers = array_map(function($h) {
                        return strtolower(trim(str_replace(' ', '_', $h)));
                    }, $headers);

                    $rowNum = 1;
                    while (($row = fgetcsv($handle)) !== false) {
                        $rowNum++;
                        $data = @array_combine($headers, $row);
                        if (!$data) {
                            $rowErrors[] = "Row {$rowNum}: Column count mismatch.";
                            continue;
                        }

                        $title = trim($data['title'] ?? '');
                        $description = trim($data['description'] ?? '');
                        $categoryId = intval($data['category_id'] ?? 0);
                        $sku = trim($data['sku'] ?? '');
                        $color = trim($data['color'] ?? '');
                        $size = trim($data['size'] ?? '');
                        $price = floatval($data['price'] ?? 0);
                        $wholesalePrice = floatval($data['wholesale_price'] ?? 0);
                        $bulkThreshold = intval($data['bulk_threshold'] ?? 5);
                        $stock = intval($data['stock'] ?? 0);
                        $imageUrl = trim($data['image_url'] ?? '');

                        if (empty($title)) {
                            $rowErrors[] = "Row {$rowNum}: Product Title is required.";
                            continue;
                        }
                        if ($categoryId <= 0) {
                            $rowErrors[] = "Row {$rowNum}: Category ID is required and must be valid.";
                            continue;
                        }
                        if (empty($sku)) {
                            $rowErrors[] = "Row {$rowNum}: SKU is required.";
                            continue;
                        }
                        if ($price <= 0) {
                            $rowErrors[] = "Row {$rowNum}: Retail price must be greater than zero.";
                            continue;
                        }
                        if ($wholesalePrice <= 0 || $wholesalePrice >= $price) {
                            $rowErrors[] = "Row {$rowNum}: Wholesale price must be greater than zero and less than retail price.";
                            continue;
                        }
                        if ($stock < 0) {
                            $rowErrors[] = "Row {$rowNum}: Stock cannot be negative.";
                            continue;
                        }

                        $stmtCheck = $db->prepare("SELECT id FROM product_variants WHERE sku = ?");
                        $stmtCheck->execute([$sku]);
                        if ($stmtCheck->fetch()) {
                            $rowErrors[] = "Row {$rowNum}: A product variant with SKU '{$sku}' already exists.";
                            continue;
                        }

                        try {
                            $db->beginTransaction();

                            $stmtProd = $db->prepare("
                                INSERT INTO products (title, description, category_id, seller_id, status, is_approved)
                                VALUES (?, ?, ?, ?, 'ACTIVE', 0)
                            ");
                            $stmtProd->execute([$title, $description, $categoryId, $user['id']]);
                            $productId = $db->lastInsertId();

                            $stmtVariant = $db->prepare("
                                INSERT INTO product_variants (product_id, sku, color, size, price, wholesale_price, bulk_threshold, stock, image_url)
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
                            ");
                            $stmtVariant->execute([$productId, $sku, $color, $size, $price, $wholesalePrice, $bulkThreshold, $stock, $imageUrl]);

                            $db->commit();
                            $successCount++;
                        } catch (\Throwable $e) {
                            $db->rollBack();
                            $rowErrors[] = "Row {$rowNum}: Database insertion failed: " . $e->getMessage();
                        }
                    }
                }
                fclose($handle);
            }
        }

        return $this->render('seller/bulk_upload', [
            'title' => 'Bulk Product Upload - Weaver Hub',
            'errors' => $errors,
            'rowErrors' => $rowErrors,
            'successCount' => $successCount,
            'submitted' => true
        ]);
    }
}

