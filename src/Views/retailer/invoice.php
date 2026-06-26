<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tax Invoice - <?= htmlspecialchars($order['order_number']) ?></title>
    <!-- Modern typography -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #9d1c5d; /* Meesho Pink theme color */
            --dark-color: #212529;
            --light-color: #f8f9fa;
            --border-color: #dee2e6;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            font-size: 13px;
            line-height: 1.5;
            color: var(--dark-color);
            margin: 0;
            padding: 0;
            background-color: #e9ecef;
        }

        /* Invoice Container */
        .invoice-wrapper {
            max-width: 850px;
            margin: 30px auto;
            background: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            position: relative;
        }

        /* Top Action Bar (hidden during printing) */
        .action-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            background: #f8f9fa;
            padding: 12px 20px;
            border-radius: 8px;
            border: 1px solid var(--border-color);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 500;
            font-size: 13px;
            padding: 8px 16px;
            border-radius: 6px;
            border: 1px solid transparent;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: #83144d;
        }

        .btn-secondary {
            background-color: white;
            border-color: var(--border-color);
            color: var(--dark-color);
        }

        .btn-secondary:hover {
            background-color: #f1f3f5;
        }

        .btn svg {
            margin-right: 6px;
        }

        /* Invoice Sheet Layout */
        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 20px;
            margin-bottom: 25px;
        }

        .company-logo {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary-color);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .invoice-title {
            text-align: right;
        }

        .invoice-title h1 {
            margin: 0 0 5px 0;
            font-size: 22px;
            font-weight: 700;
            letter-spacing: 0.5px;
            color: var(--primary-color);
        }

        .invoice-title p {
            margin: 0;
            color: #6c757d;
            font-size: 12px;
        }

        /* Info Grid (Seller / Buyer details) */
        .details-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }

        .details-card {
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 18px;
            background-color: #fafbfc;
        }

        .details-card h3 {
            margin: 0 0 10px 0;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #495057;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 6px;
        }

        .details-card p {
            margin: 4px 0;
            font-size: 12.5px;
        }

        .meta-label {
            font-weight: 500;
            color: #6c757d;
            display: inline-block;
            width: 110px;
        }

        /* Items Table */
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .invoice-table th {
            background-color: #343a40;
            color: white;
            font-weight: 500;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 0.5px;
            padding: 10px 12px;
            text-align: left;
            border: 1px solid #495057;
        }

        .invoice-table td {
            padding: 12px;
            border: 1px solid var(--border-color);
            vertical-align: middle;
        }

        .invoice-table tr:nth-child(even) {
            background-color: #fcfdfe;
        }

        .text-right {
            text-align: right !important;
        }

        .text-center {
            text-align: center !important;
        }

        /* Summary Calculations Layout */
        .summary-container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 40px;
            gap: 40px;
        }

        .payment-notes {
            flex: 1;
            font-size: 12px;
            color: #6c757d;
            border: 1px dashed var(--border-color);
            border-radius: 8px;
            padding: 15px;
            background-color: #fdfdfd;
        }

        .payment-notes h4 {
            margin: 0 0 6px 0;
            color: var(--dark-color);
            font-weight: 600;
        }

        .totals-box {
            width: 320px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            background-color: #fdfdfd;
            overflow: hidden;
        }

        .totals-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 15px;
            font-size: 13px;
            border-bottom: 1px solid #f1f3f5;
        }

        .totals-row:last-child {
            border-bottom: none;
        }

        .totals-row-bold {
            font-weight: 700;
            font-size: 15px;
            color: white;
            background-color: var(--primary-color);
            border-top: 1px solid var(--primary-color);
        }

        /* Footer Declaration & Sign */
        .invoice-footer {
            border-top: 1px solid var(--border-color);
            padding-top: 25px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-top: 20px;
        }

        .declaration {
            max-width: 450px;
            font-size: 11px;
            color: #6c757d;
        }

        .signature-area {
            text-align: center;
            width: 220px;
        }

        .signature-line {
            border-bottom: 1px solid var(--dark-color);
            margin-bottom: 8px;
            height: 45px;
        }

        .signature-title {
            font-size: 11px;
            font-weight: 600;
            color: #495057;
            text-transform: uppercase;
        }

        /* Print Media Styles Override */
        @media print {
            body {
                background-color: #fff;
                color: #000;
                font-size: 12px;
            }

            .invoice-wrapper {
                margin: 0;
                padding: 0;
                box-shadow: none;
                max-width: 100%;
                border-radius: 0;
            }

            .action-bar {
                display: none !important;
            }

            .invoice-table th {
                background-color: #e9ecef !important;
                color: #000 !important;
                border: 1px solid #000 !important;
            }

            .invoice-table td {
                border: 1px solid #000 !important;
            }

            .totals-row-bold {
                color: #000 !important;
                background-color: #fff !important;
                border-top: 2px double #000 !important;
                border-bottom: 2px double #000 !important;
                padding-left: 0;
                padding-right: 0;
            }

            .details-card {
                background-color: #fff !important;
                border: 1px solid #000 !important;
            }
        }
    </style>
</head>
<body>

<div class="invoice-wrapper">
    <!-- Top Action Bar -->
    <div class="action-bar">
        <a href="/orders" class="btn btn-secondary">
            <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
            </svg>
            Go Back
        </a>
        <button onclick="window.print()" class="btn btn-primary">
            <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
            </svg>
            Print Tax Invoice
        </button>
    </div>

    <!-- Invoice Header -->
    <div class="invoice-header">
        <div>
            <div class="company-logo">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                    <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                    <line x1="12" y1="22.08" x2="12" y2="12"></line>
                </svg>
                <span><?= htmlspecialchars($companyName) ?></span>
            </div>
            <p style="margin: 8px 0 0 0; color: #6c757d; font-size: 11px;">
                Platform Operator: <?= htmlspecialchars($companyName) ?><br>
                GSTIN: <?= htmlspecialchars($companyGst) ?><br>
                <?= htmlspecialchars($companyAddress) ?>
            </p>
        </div>
        <div class="invoice-title">
            <h1>TAX INVOICE</h1>
            <p><span class="meta-label" style="width: auto;">Invoice No:</span> <strong>INV-<?= htmlspecialchars($order['order_number']) ?></strong></p>
            <p><span class="meta-label" style="width: auto;">Date:</span> <?= date('d-M-Y H:i', strtotime($order['created_at'])) ?></p>
            <p><span class="meta-label" style="width: auto;">Status:</span> <span style="text-transform: uppercase; font-weight: 600; color: #2b8a3e;"><?= htmlspecialchars($order['payment_status']) ?></span></p>
        </div>
    </div>

    <!-- Details Grid -->
    <div class="details-grid">
        <!-- Weaver (Seller) Information -->
        <div class="details-card">
            <h3>Sold By (Weaver)</h3>
            <p><strong><?= htmlspecialchars($order['seller_company'] ?: $order['seller_name']) ?></strong></p>
            <p><span class="meta-label">GSTIN:</span> <?= htmlspecialchars($order['seller_gst'] ?: 'N/A') ?></p>
            <p><span class="meta-label">Email:</span> <?= htmlspecialchars($order['buyer_email']) /* Using user details dynamically */ ?></p>
            <p><span class="meta-label">Dispatched From:</span> Varanasi Weaver Cluster, UP</p>
        </div>

        <!-- Buyer (Retailer) Billing & Shipping -->
        <div class="details-card">
            <h3>Billed & Shipped To</h3>
            <p><strong><?= htmlspecialchars($order['buyer_name']) ?></strong></p>
            <p><span class="meta-label">Contact No:</span> +91 <?= htmlspecialchars($order['buyer_mobile']) ?></p>
            <p><span class="meta-label">Address:</span> <?= htmlspecialchars($order['address_line1'] ?: 'Varanasi Weaver Hub') ?></p>
            <p><span class="meta-label">Location:</span> <?= htmlspecialchars($order['city'] ?: 'Varanasi') ?>, <?= htmlspecialchars($order['state'] ?: 'Uttar Pradesh') ?> - <?= htmlspecialchars($order['pin_code'] ?: '221001') ?></p>
        </div>
    </div>

    <!-- Items Table -->
    <table class="invoice-table">
        <thead>
            <tr>
                <th class="text-center" style="width: 5%">S.No</th>
                <th style="width: 45%">Description of Goods</th>
                <th class="text-center" style="width: 10%">HSN Code</th>
                <th class="text-center" style="width: 8%">Qty</th>
                <th class="text-right" style="width: 12%">Unit Price</th>
                <th class="text-right" style="width: 10%">GST Rate</th>
                <th class="text-right" style="width: 10%">Total Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $serial = 1;
            $calculatedSubtotal = 0;
            $totalGst = 0;
            $totalTaxable = 0;
            
            foreach ($items as $item):
                $qty = intval($item['quantity']);
                // Determine actual price paid per unit
                $unitPrice = ($qty >= intval($item['bulk_threshold'])) ? floatval($item['wholesale_price']) : floatval($item['price']);
                $itemTotal = $unitPrice * $qty;
                $calculatedSubtotal += $itemTotal;

                // Calculate pro-rated discount for this item
                $itemDiscount = ($order['total_amount'] > 0) ? ($itemTotal / floatval($order['total_amount'])) * floatval($order['discount_amount']) : 0;
                $netItemTotal = $itemTotal - $itemDiscount;

                // Compute GST backward since prices are inclusive
                $gstRate = floatval($item['gst_percentage'] ?? 5.00);
                $taxableValue = $netItemTotal / (1 + ($gstRate / 100.00));
                $gstAmount = $netItemTotal - $taxableValue;

                $totalTaxable += $taxableValue;
                $totalGst += $gstAmount;
            ?>
            <tr>
                <td class="text-center"><?= $serial++ ?></td>
                <td>
                    <strong><?= htmlspecialchars($item['title']) ?></strong>
                    <div style="font-size: 11px; color: #6c757d; margin-top: 2px;">SKU: <?= htmlspecialchars($item['sku'] ?: 'VRS-SARI-00' . $item['product_variant_id']) ?></div>
                </td>
                <td class="text-center">5007</td> <!-- HSN 5007 represents woven fabrics of silk -->
                <td class="text-center"><?= $qty ?></td>
                <td class="text-right">₹<?= number_format($unitPrice, 2) ?></td>
                <td class="text-right"><?= number_format($gstRate, 1) ?>%</td>
                <td class="text-right">₹<?= number_format($netItemTotal, 2) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Summary Section -->
    <div class="summary-container">
        <!-- Notes / Payment Info -->
        <div class="payment-notes">
            <h4>Terms & Conditions:</h4>
            <ul style="margin: 0; padding-left: 15px; font-size: 11px; line-height: 1.4;">
                <li>The goods supplied are woven directly under Varanasi Handloom Cluster initiatives.</li>
                <li>This is a computer-generated tax invoice and requires no physical signatures.</li>
                <li>Settlement cycles: Payout processed automatically on buyer acceptance or return window closure.</li>
                <li>For any disputes or support, please open a ticket under the Support Desk using Reference #<?= htmlspecialchars($order['order_number']) ?>.</li>
            </ul>
        </div>

        <!-- Totals Calculations -->
        <div class="totals-box">
            <div class="totals-row">
                <span>Gross Subtotal:</span>
                <span>₹<?= number_format($calculatedSubtotal, 2) ?></span>
            </div>
            <div class="totals-row">
                <span>Coupon Discount:</span>
                <span style="color: #c92a2a;">- ₹<?= number_format(floatval($order['discount_amount']), 2) ?></span>
            </div>
            <div class="totals-row" style="border-top: 1px dashed var(--border-color); font-weight: 500;">
                <span>Total Taxable Value:</span>
                <span>₹<?= number_format($totalTaxable, 2) ?></span>
            </div>
            <div class="totals-row">
                <span>Central GST (CGST @ 2.5%):</span>
                <span>₹<?= number_format($totalGst / 2.0, 2) ?></span>
            </div>
            <div class="totals-row">
                <span>State GST (SGST @ 2.5%):</span>
                <span>₹<?= number_format($totalGst / 2.0, 2) ?></span>
            </div>
            <div class="totals-row">
                <span>Shipping & Delivery:</span>
                <span>₹0.00</span>
            </div>
            <div class="totals-row totals-row-bold">
                <span>Grand Total:</span>
                <span>₹<?= number_format(floatval($order['net_amount']), 2) ?></span>
            </div>
        </div>
    </div>

    <!-- Signatures -->
    <div class="invoice-footer">
        <div class="declaration">
            <p><strong>Declaration:</strong> We declare that this invoice shows the actual price of the goods described and that all particulars are true and correct. Taxes have been computed under GST guidelines for handicraft handlooms.</p>
        </div>
        <div class="signature-area">
            <div class="signature-line"></div>
            <div class="signature-title">Authorized Signatory</div>
            <div style="font-size: 10px; color: #6c757d; margin-top: 4px;"><?= htmlspecialchars($order['seller_company'] ?: $order['seller_name']) ?></div>
        </div>
    </div>
</div>

<script>
    // Auto-invoke print dialog on page load
    window.onload = function() {
        // Wait a small moment to ensure CSS/Fonts render
        setTimeout(function() {
            window.print();
        }, 500);
    };
</script>
</body>
</html>
