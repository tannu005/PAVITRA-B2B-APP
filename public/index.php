<?php

// 1. Fallback Autoloader (PSR-4 compliant)
spl_autoload_register(function ($class) {
    // Project root directory
    $baseDir = dirname(__DIR__) . '/';

    // Map namespaces to directories
    $prefixes = [
        'Core\\' => 'core/',
        'App\\' => 'src/'
    ];

    foreach ($prefixes as $prefix => $dir) {
        $len = strlen($prefix);
        if (strncmp($prefix, $class, $len) !== 0) {
            continue;
        }

        $relativeClass = substr($class, $len);
        $file = $baseDir . $dir . str_replace('\\', '/', $relativeClass) . '.php';

        if (file_exists($file)) {
            require $file;
            return;
        }
    }
});

// Try to load Composer autoloader if it exists (for vendor dependencies)
if (file_exists(dirname(__DIR__) . '/vendor/autoload.php')) {
    require_once dirname(__DIR__) . '/vendor/autoload.php';
}

// 2. Instantiate and Run Application
use Core\Application;

$app = new Application();

// --- DEFINING WEB ROUTES ---

// Centralized Auth Routes
$app->router->get('/login', [App\Controllers\AuthController::class, 'loginView']);
$app->router->post('/login', [App\Controllers\AuthController::class, 'login']);
$app->router->get('/register', [App\Controllers\AuthController::class, 'registerView']);
$app->router->post('/register', [App\Controllers\AuthController::class, 'register']);
$app->router->get('/logout', [App\Controllers\AuthController::class, 'logout']);

// Retailer (Buyer / Customer) Storefront Routes
$app->router->get('/', [App\Controllers\RetailerController::class, 'index']);
$app->router->get('/product/{id}', [App\Controllers\RetailerController::class, 'detail']);
$app->router->post('/cart/add', [App\Controllers\RetailerController::class, 'addToCart']);
$app->router->post('/cart/update', [App\Controllers\RetailerController::class, 'updateCart']);
$app->router->post('/cart/remove', [App\Controllers\RetailerController::class, 'removeFromCart']);
$app->router->get('/cart', [App\Controllers\RetailerController::class, 'cartView']);
$app->router->post('/cart/coupon', [App\Controllers\RetailerController::class, 'applyCoupon']);
$app->router->post('/checkout', [App\Controllers\RetailerController::class, 'checkout']);
$app->router->get('/orders', [App\Controllers\RetailerController::class, 'orders']);
$app->router->get('/wallet', [App\Controllers\RetailerController::class, 'wallet']);
$app->router->get('/profile', [App\Controllers\RetailerController::class, 'profileView']);
$app->router->post('/profile', [App\Controllers\RetailerController::class, 'updateProfile']);

// Dynamic CMS Routes
$app->router->get('/about-us', [App\Controllers\RetailerController::class, 'cmsPage']);
$app->router->get('/contact-us', [App\Controllers\RetailerController::class, 'cmsPage']);
$app->router->get('/privacy-policy', [App\Controllers\RetailerController::class, 'cmsPage']);
$app->router->get('/terms-conditions', [App\Controllers\RetailerController::class, 'cmsPage']);
$app->router->get('/refund-policy', [App\Controllers\RetailerController::class, 'cmsPage']);
$app->router->get('/shipping-policy', [App\Controllers\RetailerController::class, 'cmsPage']);

// HSN GST Invoices Routes
$app->router->get('/order/invoice/{id}', [App\Controllers\InvoiceController::class, 'printInvoice']);

// Support Helpdesk Routes
$app->router->get('/support', [App\Controllers\SupportController::class, 'index']);
$app->router->get('/support/create', [App\Controllers\SupportController::class, 'createView']);
$app->router->post('/support/create', [App\Controllers\SupportController::class, 'create']);
$app->router->get('/support/ticket/{id}', [App\Controllers\SupportController::class, 'viewTicket']);
$app->router->post('/support/ticket/{id}/reply', [App\Controllers\SupportController::class, 'reply']);
$app->router->get('/admin/support', [App\Controllers\SupportController::class, 'adminIndex']);
$app->router->get('/admin/support/ticket/{id}', [App\Controllers\SupportController::class, 'adminViewTicket']);
$app->router->post('/admin/support/ticket/{id}/reply', [App\Controllers\SupportController::class, 'adminReply']);
$app->router->post('/admin/support/ticket/{id}/status', [App\Controllers\SupportController::class, 'adminStatus']);

// Returns & Refunds Routes
$app->router->get('/orders/return/{id}', [App\Controllers\ReturnController::class, 'createView']);
$app->router->post('/orders/return/{id}', [App\Controllers\ReturnController::class, 'create']);
$app->router->get('/seller/returns', [App\Controllers\ReturnController::class, 'sellerIndex']);
$app->router->post('/seller/returns/{id}/approve', [App\Controllers\ReturnController::class, 'sellerApprove']);
$app->router->post('/seller/returns/{id}/verify', [App\Controllers\ReturnController::class, 'sellerVerify']);
$app->router->post('/admin/returns/{id}/refund', [App\Controllers\ReturnController::class, 'adminRefund']);

// Super Admin Suite Routes
$app->router->get('/admin', [App\Controllers\SuperAdminController::class, 'dashboard']);
$app->router->get('/admin/sellers', [App\Controllers\SuperAdminController::class, 'sellers']);
$app->router->post('/admin/sellers/approve', [App\Controllers\SuperAdminController::class, 'approveSeller']);
$app->router->get('/admin/products', [App\Controllers\SuperAdminController::class, 'products']);
$app->router->post('/admin/products/approve', [App\Controllers\SuperAdminController::class, 'approveProduct']);
$app->router->get('/admin/kyc', [App\Controllers\SuperAdminController::class, 'kyc']);
$app->router->post('/admin/kyc/verify', [App\Controllers\SuperAdminController::class, 'verifyKyc']);
$app->router->get('/admin/settlements', [App\Controllers\SuperAdminController::class, 'settlements']);
$app->router->post('/admin/settlements/process', [App\Controllers\SuperAdminController::class, 'processSettlements']);
$app->router->get('/admin/commissions', [App\Controllers\SuperAdminController::class, 'commissions']);
$app->router->post('/admin/commissions/rule', [App\Controllers\SuperAdminController::class, 'saveCommissionRule']);
$app->router->get('/admin/settings', [App\Controllers\SuperAdminController::class, 'settings']);
$app->router->post('/admin/settings', [App\Controllers\SuperAdminController::class, 'saveSettings']);
$app->router->get('/admin/errors', [App\Controllers\SuperAdminController::class, 'errors']);
$app->router->get('/admin/sessions', [App\Controllers\SuperAdminController::class, 'sessions']);
$app->router->post('/admin/sessions/revoke', [App\Controllers\SuperAdminController::class, 'revokeSession']);
$app->router->get('/admin/activity', [App\Controllers\SuperAdminController::class, 'activityLogs']);

// Seller (Weaver) Dashboard Routes
$app->router->get('/seller', [App\Controllers\SellerController::class, 'dashboard']);
$app->router->get('/seller/products', [App\Controllers\SellerController::class, 'products']);
$app->router->get('/seller/products/create', [App\Controllers\SellerController::class, 'createProductView']);
$app->router->post('/seller/products/create', [App\Controllers\SellerController::class, 'storeProduct']);
$app->router->get('/seller/inventory', [App\Controllers\SellerController::class, 'inventory']);
$app->router->post('/seller/inventory/update', [App\Controllers\SellerController::class, 'updateInventory']);
$app->router->get('/seller/orders', [App\Controllers\SellerController::class, 'orders']);
$app->router->post('/seller/orders/status', [App\Controllers\SellerController::class, 'updateOrderStatus']);
$app->router->get('/seller/settlements', [App\Controllers\SellerController::class, 'settlements']);

// Delivery Partner App Routes
$app->router->get('/delivery', [App\Controllers\DeliveryController::class, 'dashboard']);
$app->router->post('/delivery/status', [App\Controllers\DeliveryController::class, 'updateDeliveryStatus']);
$app->router->post('/delivery/verify-otp', [App\Controllers\DeliveryController::class, 'verifyDeliveryOtp']);


// --- DEFINING REST API ENDPOINTS ---
$app->router->post('/api/auth/login', [App\Controllers\ApiController::class, 'login']);
$app->router->post('/api/auth/register', [App\Controllers\ApiController::class, 'register']);
$app->router->get('/api/categories', [App\Controllers\ApiController::class, 'getCategories']);
$app->router->get('/api/products', [App\Controllers\ApiController::class, 'getProducts']);
$app->router->get('/api/inventory', [App\Controllers\ApiController::class, 'getInventory']);
$app->router->post('/api/inventory/update', [App\Controllers\ApiController::class, 'updateInventory']);
$app->router->get('/api/orders', [App\Controllers\ApiController::class, 'getOrders']);
$app->router->post('/api/orders/create', [App\Controllers\ApiController::class, 'createOrder']);
$app->router->get('/api/wallet/balance', [App\Controllers\ApiController::class, 'getWalletBalance']);
$app->router->post('/api/payments/charge', [App\Controllers\ApiController::class, 'chargePayment']);
$app->router->post('/api/kyc/upload', [App\Controllers\ApiController::class, 'uploadKyc']);
$app->router->get('/api/notifications', [App\Controllers\ApiController::class, 'getNotifications']);
$app->router->get('/api/reports/sales', [App\Controllers\ApiController::class, 'getSalesReport']);
$app->router->post('/api/delivery/update', [App\Controllers\ApiController::class, 'updateDelivery']);

// Mock triggers
$app->router->post('/api/wallet/deposit', [App\Controllers\ApiController::class, 'depositSimulate']);
$app->router->post('/api/kyc/simulate', [App\Controllers\ApiController::class, 'kycSimulate']);

// Run the application
$app->run();

