<?php
if (php_sapi_name() === 'cli-server') {
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    if (file_exists(__DIR__ . $path) && is_file(__DIR__ . $path)) {
        return false;
    }
}
spl_autoload_register(function ($class) {
    $baseDir = dirname(__DIR__) . '/';
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
if (file_exists(dirname(__DIR__) . '/vendor/autoload.php')) {
    require_once dirname(__DIR__) . '/vendor/autoload.php';
}
use Core\Application;
$app = new Application();
$db = $app->db;
try {
    if (isset($_GET['force_sync'])) {
        try {
            $syncController = new \App\Controllers\SuperAdminController();
            $syncController->syncDataset(new Core\Request(), clone $app->response);
            echo "SYNC SUCCESS";
        } catch (\Exception $e) {
            echo "SYNC ERROR: " . $e->getMessage() . " at " . $e->getFile() . ":" . $e->getLine();
        }
        exit;
    }
    if (!file_exists(dirname(__DIR__) . '/sync_completed.txt')) {
        $syncController = new \App\Controllers\SuperAdminController();
        $syncController->syncDataset(new Core\Request(), clone $app->response);
        file_put_contents(dirname(__DIR__) . '/sync_completed.txt', '1');
        header("Location: /");
        exit;
    }
} catch (\Throwable $e) { 
    echo "SYNC ERROR: " . $e->getMessage() . " at " . $e->getFile() . ":" . $e->getLine(); 
    exit; 
}

$app->router->get('/login', [App\Controllers\AuthController::class, 'loginView']);
$app->router->post('/login', [App\Controllers\AuthController::class, 'login']);
$app->router->get('/admin/login', [App\Controllers\AuthController::class, 'adminLoginView']);
$app->router->post('/admin/login', [App\Controllers\AuthController::class, 'adminLogin']);
$app->router->get('/login/mfa', [App\Controllers\AuthController::class, 'mfaView']);
$app->router->post('/login/mfa', [App\Controllers\AuthController::class, 'mfaVerify']);
$app->router->get('/register', [App\Controllers\AuthController::class, 'registerView']);
$app->router->post('/register', [App\Controllers\AuthController::class, 'register']);
$app->router->get('/logout', [App\Controllers\AuthController::class, 'logout']);
$app->router->get('/forgot-password', [App\Controllers\AuthController::class, 'forgotPasswordView']);
$app->router->post('/forgot-password', [App\Controllers\AuthController::class, 'forgotPassword']);
$app->router->get('/reset-password', [App\Controllers\AuthController::class, 'resetPasswordView']);
$app->router->post('/reset-password', [App\Controllers\AuthController::class, 'resetPassword']);
$app->router->get('/', [App\Controllers\RetailerController::class, 'index']);
$app->router->get('/categories', [App\Controllers\RetailerController::class, 'categoriesView']);
$app->router->get('/product/{id}', [App\Controllers\RetailerController::class, 'detail']);
$app->router->post('/product/review', [App\Controllers\RetailerController::class, 'addReview']);
$app->router->post('/cart/add', [App\Controllers\RetailerController::class, 'addToCart']);
$app->router->post('/cart/update', [App\Controllers\RetailerController::class, 'updateCart']);
$app->router->post('/cart/remove', [App\Controllers\RetailerController::class, 'removeFromCart']);
$app->router->get('/cart', [App\Controllers\RetailerController::class, 'cartView']);
$app->router->post('/cart/coupon', [App\Controllers\RetailerController::class, 'applyCoupon']);
$app->router->post('/checkout/razorpay/create', [App\Controllers\RetailerController::class, 'createRazorpayOrder']);
$app->router->post('/checkout/razorpay/verify', [App\Controllers\RetailerController::class, 'verifyRazorpayPayment']);
$app->router->post('/checkout/wallet/create', [App\Controllers\RetailerController::class, 'createWalletOrder']);
$app->router->post('/checkout/cod/create', [App\Controllers\RetailerController::class, 'createCodOrder']);
$app->router->get('/orders', [App\Controllers\RetailerController::class, 'orders']);
$app->router->get('/wallet', [App\Controllers\RetailerController::class, 'wallet']);
$app->router->get('/wishlist', [App\Controllers\RetailerController::class, 'wishlist']);
$app->router->get('/customization', [App\Controllers\RetailerController::class, 'customizationView']);
$app->router->get('/profile', [App\Controllers\RetailerController::class, 'profileView']);
$app->router->post('/profile', [App\Controllers\RetailerController::class, 'updateProfile']);
$app->router->post('/profile/2fa/toggle', [App\Controllers\AuthController::class, 'toggle2fa']);
$app->router->post('/profile/sessions/revoke-others', [App\Controllers\RetailerController::class, 'revokeOtherSessions']);
$app->router->post('/profile/delete-account', [App\Controllers\RetailerController::class, 'deleteAccount']);
$app->router->get('/about-us', [App\Controllers\RetailerController::class, 'cmsPage']);
$app->router->get('/contact-us', [App\Controllers\RetailerController::class, 'cmsPage']);
$app->router->get('/privacy-policy', [App\Controllers\RetailerController::class, 'cmsPage']);
$app->router->get('/terms-conditions', [App\Controllers\RetailerController::class, 'cmsPage']);
$app->router->get('/refund-policy', [App\Controllers\RetailerController::class, 'cmsPage']);
$app->router->get('/shipping-policy', [App\Controllers\RetailerController::class, 'cmsPage']);
$app->router->get('/order/invoice/{id}', [App\Controllers\InvoiceController::class, 'printInvoice']);
$app->router->get('/support', [App\Controllers\SupportController::class, 'index']);
$app->router->get('/support/create', [App\Controllers\SupportController::class, 'createView']);
$app->router->post('/support/create', [App\Controllers\SupportController::class, 'create']);
$app->router->get('/support/ticket/{id}', [App\Controllers\SupportController::class, 'viewTicket']);
$app->router->post('/support/ticket/{id}/reply', [App\Controllers\SupportController::class, 'reply']);
$app->router->get('/admin/support', [App\Controllers\SupportController::class, 'adminIndex']);
$app->router->get('/admin/support/ticket/{id}', [App\Controllers\SupportController::class, 'adminViewTicket']);
$app->router->post('/admin/support/ticket/{id}/reply', [App\Controllers\SupportController::class, 'adminReply']);
$app->router->post('/admin/support/ticket/{id}/status', [App\Controllers\SupportController::class, 'adminStatus']);
$app->router->get('/orders/return/{id}', [App\Controllers\ReturnController::class, 'createView']);
$app->router->post('/orders/return/{id}', [App\Controllers\ReturnController::class, 'create']);
$app->router->get('/seller/returns', [App\Controllers\ReturnController::class, 'sellerIndex']);
$app->router->post('/seller/returns/{id}/approve', [App\Controllers\ReturnController::class, 'sellerApprove']);
$app->router->post('/seller/returns/{id}/verify', [App\Controllers\ReturnController::class, 'sellerVerify']);
$app->router->post('/admin/returns/{id}/refund', [App\Controllers\ReturnController::class, 'adminRefund']);
$app->router->get('/admin', [App\Controllers\SuperAdminController::class, 'dashboard']);
$app->router->get('/admin/sellers', [App\Controllers\SuperAdminController::class, 'sellers']);
$app->router->post('/admin/sellers/approve', [App\Controllers\SuperAdminController::class, 'approveSeller']);
$app->router->get('/admin/products', [App\Controllers\SuperAdminController::class, 'products']);
$app->router->post('/admin/products/approve', [App\Controllers\SuperAdminController::class, 'approveProduct']);
$app->router->get('/admin/sync-dataset', [App\Controllers\SuperAdminController::class, 'syncDataset']);
$app->router->get('/admin/kyc', [App\Controllers\SuperAdminController::class, 'kyc']);
$app->router->post('/admin/kyc/verify', [App\Controllers\SuperAdminController::class, 'verifyKyc']);
$app->router->get('/admin/settlements', [App\Controllers\SuperAdminController::class, 'settlements']);
$app->router->post('/admin/settlements/process', [App\Controllers\SuperAdminController::class, 'processSettlements']);
$app->router->get('/admin/commissions', [App\Controllers\SuperAdminController::class, 'commissions']);
$app->router->post('/admin/commissions/rule', [App\Controllers\SuperAdminController::class, 'saveCommissionRule']);
$app->router->get('/admin/settings', [App\Controllers\SuperAdminController::class, 'settings']);
$app->router->post('/admin/settings', [App\Controllers\SuperAdminController::class, 'saveSettings']);
$app->router->get('/admin/cms', [App\Controllers\SuperAdminController::class, 'cms']);
$app->router->get('/admin/cms/edit/{id}', [App\Controllers\SuperAdminController::class, 'cmsEdit']);
$app->router->post('/admin/cms/save', [App\Controllers\SuperAdminController::class, 'cmsSave']);
$app->router->get('/admin/errors', [App\Controllers\SuperAdminController::class, 'errors']);
$app->router->get('/admin/sessions', [App\Controllers\SuperAdminController::class, 'sessions']);
$app->router->post('/admin/sessions/revoke', [App\Controllers\SuperAdminController::class, 'revokeSession']);
$app->router->get('/admin/activity', [App\Controllers\SuperAdminController::class, 'activityLogs']);
$app->router->get('/admin/orders/export', [App\Controllers\SuperAdminController::class, 'exportOrdersCsv']);
$app->router->get('/admin/orders/invoice', [App\Controllers\SuperAdminController::class, 'generateInvoicePdf']);
$app->router->get('/admin/roles', [App\Controllers\SuperAdminController::class, 'rolesView']);
$app->router->post('/admin/roles/create', [App\Controllers\SuperAdminController::class, 'createRole']);
$app->router->post('/admin/roles/assign', [App\Controllers\SuperAdminController::class, 'assignPermission']);
$app->router->get('/seller', [App\Controllers\SellerController::class, 'dashboard']);
$app->router->get('/seller/kyc', [App\Controllers\SellerController::class, 'kycView']);
$app->router->get('/seller/products', [App\Controllers\SellerController::class, 'products']);
$app->router->get('/seller/products/create', [App\Controllers\SellerController::class, 'createProductView']);
$app->router->post('/seller/products/create', [App\Controllers\SellerController::class, 'storeProduct']);
$app->router->get('/seller/products/bulk', [App\Controllers\SellerController::class, 'bulkUploadView']);
$app->router->post('/seller/products/bulk', [App\Controllers\SellerController::class, 'bulkUpload']);
$app->router->get('/seller/inventory', [App\Controllers\SellerController::class, 'inventory']);
$app->router->post('/seller/inventory/update', [App\Controllers\SellerController::class, 'updateInventory']);
$app->router->get('/seller/orders', [App\Controllers\SellerController::class, 'orders']);
$app->router->post('/seller/orders/status', [App\Controllers\SellerController::class, 'updateOrderStatus']);
$app->router->get('/seller/settlements', [App\Controllers\SellerController::class, 'settlements']);
$app->router->get('/delivery', [App\Controllers\DeliveryController::class, 'dashboard']);
$app->router->post('/delivery/status', [App\Controllers\DeliveryController::class, 'updateDeliveryStatus']);
$app->router->post('/delivery/verify-otp', [App\Controllers\DeliveryController::class, 'verifyDeliveryOtp']);
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
$app->router->post('/api/wallet/deposit', [App\Controllers\ApiController::class, 'depositSimulate']);
$app->router->post('/api/kyc/simulate', [App\Controllers\ApiController::class, 'kycSimulate']);
$app->router->get('/api/product-variant/{id}', [App\Controllers\ApiController::class, 'getProductVariant']);
$app->run();
