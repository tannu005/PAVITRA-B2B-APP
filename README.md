# Pavitra Designer B2B Marketplace

A robust, enterprise-grade B2B wholesale marketplace platform built from scratch. Inspired by leading Indian B2B platforms like Meesho and Udaan, this application connects local master weavers with boutique retailers, facilitating bulk ordering, logistics management, and role-based access control.

## Tech Stack

*   **Backend architecture:** Custom PHP 8.3+ MVC framework (PSR-4 compliant)
*   **Database:** MySQL 8+ / MariaDB (relational schema with strict foreign key constraints)
*   **Frontend:** HTML5, CSS3, Bootstrap 5.3+, vanilla JS / jQuery for dynamic UI states
*   **Security:** PDO prepared statements, CSRF protection, secure session management, RBAC

## Key Features

*   **Custom MVC Framework:** Built entirely from scratch without external PHP frameworks (like Laravel). Includes a custom router, request/response handlers, and a database abstraction layer.
*   **Role-Based Access Control (RBAC):** Distinct dashboards and access limits for Super Admins, Sellers (Weavers), Retailers (Buyers), and Delivery Partners.
*   **Dynamic AJAX Cart & Checkout:** Real-time cart updates without page reloads. Includes a dynamic pricing engine that automatically applies wholesale discounts when minimum order quantities (MOQ) are met.
*   **Logistics & Order Handover Flow:** Secure OTP-based delivery verification process for courier partners.
*   **Wallet & Settlement Engine:** A double-entry accounting ledger system for managing weaver payouts, platform commissions, and GST deductions.
*   **Compliance & Invoicing:** Automatic generation of print-optimized HSN GST tax invoices.

## System Architecture

The application is structured around a clean, scalable MVC pattern:

*   `/core`: Contains the custom framework logic (`Router`, `Database`, `Controller`, `Application`).
*   `/src/Controllers`: Contains the business logic for each domain (Auth, Retailer, Seller, Admin).
*   `/src/Views`: Contains the PHP templates organized by user role.
*   `/public`: The web root, containing `index.php` (front controller) and compiled static assets.
*   `/database`: Contains the SQL schema definitions and initial seed data.

## Installation & Setup

1.  **Requirements:** PHP 8.3+ and a MySQL/MariaDB server (port 3306).
2.  **Configuration:** Update the database credentials in `config/db.php`.
3.  **Migration & Seeding:** Run the installer by navigating to `http://localhost/install.php` in your browser. This will automatically generate the schema and populate test data.
4.  **Local Server:** You can serve the application using PHP's built-in server:
    ```bash
    php -S localhost:8000 -t public
    ```

### Demo Accounts

Use the password `password123` for all test accounts:
*   **Admin Console:** `admin@meeshob2b.com` -> `/admin`
*   **Seller Panel:** `weaver@meeshob2b.com` -> `/seller`
*   **Retailer Storefront:** `boutique@meeshob2b.com` -> `/`
*   **Logistics App:** `delivery@meeshob2b.com` -> `/delivery`
