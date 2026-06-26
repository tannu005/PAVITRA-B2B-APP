# Viraasat B2B - Meesho-Style Wholesale Marketplace Platform

Welcome to **Viraasat B2B**, a complete, production-ready, enterprise-grade B2B wholesale marketplace platform built from scratch. This platform is modeled after leading B2B marketplaces like Meesho, IndiaMART, and Udaan, and is designed to bridge the gap between local master weavers and boutique retailers.

This project features a **custom lightweight PHP 8.3+ MVC framework**, a robust **MySQL 8+ relational database**, and a highly responsive **Bootstrap 5.3+ frontend** powered by jQuery and AJAX.

---

## Table of Contents
1. [Project Overview & Technology Stack](#1-project-overview--technology-stack)
2. [Directory Structure](#2-directory-structure)
3. [Frontend-Backend Wiring & Connectivity](#3-frontend-backend-wiring--connectivity)
4. [Step-by-Step: How this Project was Built from Scratch](#4-step-by-step-how-this-project-was-built-from-scratch)
5. [Deep Dive: Core Code Explanations](#5-deep-dive-core-code-explanations)
6. [Database Schema & Roles (RBAC)](#6-database-schema--roles-rbac)
7. [Installation & Local Deployment Guide](#7-installation--local-deployment-guide)

---

## 1. Project Overview & Technology Stack

Viraasat B2B is built using a modern, scalable architecture designed for high performance, ease of deployment, and clean code separation.

*   **Backend**: PHP 8.3+ utilizing custom Object-Oriented Programming (OOP), Model-View-Controller (MVC) architecture, PSR-4 compliant autoloading, and transaction-based accounting.
*   **Database**: MySQL 8+ / MariaDB with 86 tables, strict foreign keys, indexes, triggers, and audit logs.
*   **Frontend**: HTML5, CSS3, Bootstrap 5.3+, JavaScript ES6+, and jQuery AJAX for dynamic cart management and live dashboard operations.
*   **Compliance Suite**: Full coupons checkout engine, support ticketing desk system, multi-party returns/refund workflow, settings console, and print-optimized HSN GST invoice generation.
*   **Aesthetics**: Styled to match Meesho’s look-and-feel (pink brand accents `#F43397`, clean product cards, responsive grid structures, and interactive drawers).

---

## 2. Directory Structure

The project code is organized under a single codebase containing all panels, MVC core classes, and database schemas:

```text
meesho-b2b/
├── config/
│   └── db.php                  # Database connection credentials (host, port, username, password)
├── core/                       # Custom lightweight MVC core framework
│   ├── Application.php         # Global Service Container & System Exception Logger
│   ├── Controller.php          # Base controller for rendering templates and checking roles
│   ├── Database.php            # PDO wrapper with auto-database creation fallbacks
│   ├── Model.php               # Base model for database interactions
│   ├── Request.php             # Input/Header sanitization and request parsing
│   ├── Response.php            # HTTP status codes and JSON payload formatter
│   └── Router.php              # Clean SEO URL regex router (maps paths like /product/{id})
├── database/
│   ├── schema.sql              # Definition of all 86 relational tables, indexes, and audits
│   └── seeds.sql               # Default settings, categories, GI sarees, and test users
├── public/                     # Web server public root directory
│   ├── assets/
│   │   └── css/
│   │       └── meesho.css      # Core styles, pink accents, cards, and animations
│   ├── .htaccess               # Apache URL rewriting rule (strips .php extensions for SEO URLs)
│   ├── index.php               # Front Controller (entry point for all HTTP requests)
│   ├── install.php             # Interactive migrations wizard and database setup seeder
│   └── php-error.php           # Graceful error page shown to users during exceptions
└── src/                        # Main MVC application logic
    ├── Controllers/            # Controllers containing business logic
    │   ├── ApiController.php   # Token-based REST API endpoints for Flutter/Mobile Apps
    │   ├── AuthController.php  # Registration, centralized login, and session controllers
    │   ├── DeliveryController.php# Courier dispatcher, tracking, and OTP verification handlers
    │   ├── InvoiceController.php# GST HSN details retriever and invoice printer
    │   ├── RetailerController.php# Storefront catalog, AJAX cart operations, and checkouts
    │   ├── ReturnController.php # Retailer returns portal and seller approval workflow
    │   ├── SellerController.php # Saree creations, inventory updates, and order dispatches
    │   ├── SupportController.php# Retailer helpdesk tickets and admin notes workspace
    │   └── SuperAdminController.php # KYC approvals, settings UI, settlements ledger, and commission controls
    └── Views/                  # PHP Views templates
        ├── admin/              # Super Admin screens (Sellers, Products, KYC, Settlements, Commissions, Trace Logs)
        ├── auth/               # Centralized Log-in & Registration pages
        ├── delivery/           # Logistics driver mobile portal
        ├── layouts/
        │   └── main.php        # Main app shell (Header, alerts, categories, AJAX cart drawer, and footer)
        ├── retailer/           # Storefront catalog, orders tracker, wallet, and CMS views
        └── seller/             # Weaver dashboards, variant creation forms, and inventory sheets
```

---

## 3. Frontend-Backend Wiring & Connectivity

The frontend and backend are **completely wired, dynamic, and connected to each other**. There are **no static mockups**; every action interacts with the database.

### How they communicate:
1.  **Request Lifecycle**:
    *   The retailer interacts with the UI (e.g., clicks "Add to Wholesale Cart").
    *   A jQuery AJAX function catches this event, serializes the parameters into a JSON string, and fires an asynchronous `POST` request to `/cart/add`.
    *   The Apache web server handles the request, rewrites the URL through `.htaccess`, and forwards it to `public/index.php`.
    *   The `Router` parses the URL, initializes the `RetailerController`, and executes the `addToCart` method.

2.  **Database Validation & Processing**:
    *   The `RetailerController` calls the `Database` wrapper to verify stock limits for the selected variant.
    *   If valid, it updates the `cart_items` table.
    *   The controller queries the updated cart items, calculates totals, and applies the wholesale discount automatically if the item count exceeds the **Minimum Order Quantity (MOQ)** threshold.
    *   The controller returns a clean JSON response containing the updated items list and totals.

3.  **Dynamic Frontend Rendering**:
    *   The AJAX `success` callback receives the JSON payload.
    *   It dynamically wipes the old cart drawer HTML and regenerates the cart list elements using JS string templates, updating the badge counts and wholesale price indicators.
    *   This provides a smooth single-page application experience without reloading the window.

---

## 4. Step-by-Step: How this Project was Built from Scratch

To help you understand how this platform was constructed, here is the development roadmap:

### Step 1: Core Framework Foundation (OOP & PSR-4)
We started by establishing a clean object-oriented architecture.
*   **Autoloading**: Created a custom autoloader inside `public/index.php` using `spl_autoload_register` mapping `Core\` to `core/` and `App\` to `src/`. This avoids cluttering files with manual `require_once` statements.
*   **Request & Response**: Wrote helpers to sanitize inputs (`Request::getBody()`) and format outputs (`Response::json()`).
*   **Router**: Built a routing map using regular expressions so that routes like `/product/{id}` map dynamic variables automatically.

### Step 2: Relational Database Schema Design
We translated the Meesho-style B2B marketplace requirement into an optimal 86-table schema.
*   Created `schema.sql` defining relational tables for Roles (RBAC), Users, Profiles (Sellers, Retailers, Drivers), Catalog (Products, Variants, Images), Inventory (Stock, Warehouses, Logs), Orders, Shipments, Wallets (Ledger entries), and Audit Logs.
*   Setup foreign key constraints (`ON DELETE CASCADE`) to guarantee referential integrity and avoid dangling references.

### Step 3: Authentication & RBAC Middleware
*   Built a centralized authentication system (`AuthController.php`) using PHP sessions.
*   Implemented secure password storage using `password_hash($pass, PASSWORD_BCRYPT)`.
*   Created an RBAC validation filter (`Controller::checkAuth($roles)`) to protect dashboards, ensuring retailers cannot access admin controls and drivers cannot modify inventory.

### Step 4: Core B2B Business Logic
*   **Wholesale Pricing Rule**: Coded logic inside `RetailerController::cartView` where unit price dynamically toggles between retail price and wholesale price depending on whether the cart item quantity meets the variant's `bulk_threshold`.
*   **Double-Entry Wallet Ledger**: Created a secure transaction logging system (`wallet_transactions`). The wallet balance is never updated without inserting an audit trail entry, protecting against cash leakage.
*   **Logistics Handover Flow**: Developed an OTP-verification system. When a weaver packs an order, a logistics rider is assigned. The delivery is only completed when the rider verifies the buyer's 4-digit OTP, triggering payouts.
*   **Admin Settlements Room**: Built a settlement engine. Super admin selects delivered orders, deducts platform commission (e.g. 8.5%) and tax (5% GST), and deposits the net payout directly into the weaver's wallet ledger.

### Step 5: User Interface Layout & Styling
*   Imported Bootstrap 5.3 and FontAwesome.
*   Created `public/assets/css/meesho.css` defining Meesho Pink brand colors and hover animations.
*   Constructed a master shell layout (`src/Views/layouts/main.php`) enclosing a header with search inputs, a category nav bar, a sliding cart drawer, and a compliance footer.

### Step 6: Installer & Auto-Migration System
*   Coded `public/install.php` to allow one-click setups, checking SQL connection integrity, creating databases, and loading schemas and seeds.

### Step 7: Phase 15 Compliance Suite Integration
*   **Coupons Checkout Validation**: Integrated a dynamic coupon check at cart views and split pro-rated deductions during order placement.
*   **Ticketing Helpdesk**: Constructed support ticket creation, category categorization, and administrator notes workspaces.
*   **Returns Workflow**: Enabled return request submissions on delivered items, seller reviews, courier collection assignments, and automatic wallet credit reversals.
*   **GST Invoice Sheet**: Programmed a print-optimized tax invoice layout rendering HSN codes, split CGST/SGST taxes, pro-rated discounts, and auto-printing on load.
*   **Settings Editor Panel**: Developed an admin configuration control view to update legal parameters and SMS/email credentials.

---

## 5. Deep Dive: Core Code Explanations

Here is how the core files of the MVC framework function:

### `core/Router.php`
The router acts as the traffic controller for all requests.
*   It registers routes with `get()` and `post()`:
    ```php
    $this->routes['GET']['/product/{id}'] = [App\Controllers\RetailerController::class, 'detail'];
    ```
*   When a request comes in, it matches the path against the registered routes. If the route contains `{param}`, it translates it into a regular expression (`(?P<id>[^/]+)`) to extract the variables and execute the controller method.

### `core/Database.php`
Handles all PDO database interactions.
*   It reads credentials from `config/db.php`.
*   If the database `meesho_b2b` does not exist, it runs a query to create the database automatically before connecting, facilitating zero-config installations.

### `core/Application.php`
The main application class acting as a service locator.
*   It captures uncaught exceptions globally using a `try-catch` block inside the `run()` loop.
*   In case of errors, it automatically creates an audit entry in the `error_logs` table (storing message, file, line, browser, IP) and redirects users to `/php-error.php`.

---

## 6. Database Schema & Roles (RBAC)

The system enforces Role-Based Access Control using these seeded roles:
1.  **SUPER_ADMIN** / **ADMIN**: Has access to `/admin` to verify seller KYC, approve catalog products, setup commissions, and run weaver settlements.
2.  **SELLER**: Accesses `/seller` to manage product variant specs, update stock counts, and ship packages.
3.  **RETAILER**: Accesses the main storefront `/` to search, filter by price, add items to cart, and checkout using wallet credits.
4.  **DELIVERY**: Accesses `/delivery` to claim courier shipments, navigate delivery routes, and enter buyer handover OTPs.

---

## 7. Installation & Local Deployment Guide

Follow these steps to run Viraasat B2B locally:

### Prerequisites:
*   PHP 8.3+ installed on your machine.
*   MySQL 8+ or MariaDB server running on port `3306` (with username `root` and no password, or custom credentials configured in `config/db.php`).

### Setup Steps:
1.  **Clone the Repository**:
    ```bash
    git clone https://github.com/tannu005/B2B-APP.git
    cd B2B-APP
    ```
2.  **Run migrations and seed data**:
    *   Open your web browser and navigate to: `http://localhost/install.php` (or your local port, e.g., `http://127.0.0.1:8000/install.php`).
    *   Click the **Setup Database & Migrate Tables** button.
    *   This will automatically create the `meesho_b2b` database and populate all tables, categories, sample sarees, and test users.

3.  **Access Demo Accounts**:
    Use the following credentials (password is `password123` for all) to test different panels:
    *   **Super Admin Console**: Login with `admin@meeshob2b.com` -> Access `/admin`
    *   **Weaver / Seller Panel**: Login with `weaver@meeshob2b.com` -> Access `/seller`
    *   **Retailer Storefront**: Login with `boutique@meeshob2b.com` -> Access `/`
    *   **Courier Logistics App**: Login with `delivery@meeshob2b.com` -> Access `/delivery`
