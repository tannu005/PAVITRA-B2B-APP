<?php
$key = 'rzp_test_TBKUWPzEekzepj';
$secret = '78gaRHCdHhtI5BZk5hhM513v';

$amountInPaise = 10000;

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
$headers = ['Content-Type: application/json'];
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Curl error: ' . curl_error($ch);
}
curl_close($ch);

echo $result;
