<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 20px;
            font-size: 14px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #1a1a1a;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #1a1a1a;
            letter-spacing: 1px;
        }
        .header p {
            margin: 5px 0;
            color: #666;
            font-size: 12px;
        }
        .invoice-details {
            width: 100%;
            margin-bottom: 30px;
        }
        .invoice-details td {
            vertical-align: top;
            width: 50%;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        .table th {
            background-color: #f8f9fa;
            font-weight: bold;
        }
        .totals {
            width: 100%;
        }
        .totals td {
            padding: 5px;
            text-align: right;
        }
        .totals .grand-total {
            font-weight: bold;
            font-size: 18px;
            border-top: 2px solid #1a1a1a;
            padding-top: 10px;
        }
        .footer {
            text-align: center;
            margin-top: 50px;
            font-size: 11px;
            color: #888;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>PAVITRA B2B</h1>
        <p>GSTIN: 27AABCT3518Q1Z4 | Udyam: UDYAM-MH-18-0000000</p>
        <p>123 Weaver Street, Textile Park, Surat, Gujarat 395002</p>
    </div>
    
    <table class="invoice-details">
        <tr>
            <td>
                <strong>Billed To:</strong><br>
                Retailer Store Name<br>
                Address Line 1<br>
                City, State, PIN<br>
                GSTIN: 24DEFGH1234F1Z9
            </td>
            <td>
                <strong>Invoice Number:</strong> INV-<?= htmlspecialchars($orderId) ?><br>
                <strong>Date:</strong> <?= date('Y-m-d') ?><br>
                <strong>Place of Supply:</strong> Gujarat<br>
                <strong>Payment Mode:</strong> Online (Razorpay)
            </td>
        </tr>
    </table>
    
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Item Description</th>
                <th>HSN Code</th>
                <th>Qty</th>
                <th>Unit Price</th>
                <th>Taxable Value</th>
                <th>GST (5%)</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Premium Banarasi Silk Saree</td>
                <td>5007</td>
                <td>2</td>
                <td>₹2,500.00</td>
                <td>₹5,000.00</td>
                <td>₹250.00</td>
                <td>₹5,250.00</td>
            </tr>
            
        </tbody>
    </table>
    
    <table class="totals">
        <tr>
            <td style="width: 70%;"></td>
            <td><strong>Subtotal:</strong></td>
            <td>₹5,000.00</td>
        </tr>
        <tr>
            <td></td>
            <td><strong>CGST (2.5%):</strong></td>
            <td>₹125.00</td>
        </tr>
        <tr>
            <td></td>
            <td><strong>SGST (2.5%):</strong></td>
            <td>₹125.00</td>
        </tr>
        <tr>
            <td></td>
            <td class="grand-total"><strong>Grand Total:</strong></td>
            <td class="grand-total">₹5,250.00</td>
        </tr>
    </table>
    
    <div class="footer">
        <p>This is a computer-generated document. No signature is required.</p>
        <p>All disputes are subject to Surat jurisdiction only. Goods once sold will not be taken back except in case of damage, provided an unboxing video is shared.</p>
    </div>
</body>
</html>
