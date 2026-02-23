<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Include database connection
include "../php/db.php";

// Fetch order details (example: assuming order_id is passed via GET)
$order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;
if ($order_id <= 0) {
    die("Invalid order ID.");
}

// Fetch order details from the database
$sql = "SELECT * FROM orders WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$order = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$order) {
    die("Order not found.");
}

// EasyPaisa API credentials (replace with your actual credentials)
$store_id = "YOUR_STORE_ID";
$hash_key = "YOUR_HASH_KEY";
$transaction_amount = $order['total_amount']; // Amount to charge
$transaction_id = uniqid(); // Unique transaction ID
$mobile_number = "USER_MOBILE_NUMBER"; // User's mobile number (fetch from session or database)
$email = "USER_EMAIL"; // User's email (fetch from session or database)

// Generate hash for the API request
$data_to_hash = $store_id . $transaction_id . $transaction_amount . $mobile_number . $email . $hash_key;
$merchant_hashed_req = hash('sha256', $data_to_hash);

// EasyPaisa API endpoint
$api_url = "https://easypaisa.com.pk/api/v1/payment";

// Prepare API request data
$request_data = [
    'storeId' => $store_id,
    'amount' => $transaction_amount,
    'orderId' => $order_id,
    'transactionId' => $transaction_id,
    'mobileAccountNo' => $mobile_number,
    'emailAddress' => $email,
    'transactionDateTime' => date('YmdHis'),
    'paymentMethod' => 'MA', // MA for Mobile Account
    'merchantHashedReq' => $merchant_hashed_req
];

// Send API request to EasyPaisa
$ch = curl_init($api_url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request_data));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

// Decode API response
$response_data = json_decode($response, true);

// Check if payment was successful
if ($response_data['responseCode'] == '0000') {
    // Payment successful
    $transaction_status = "Success";
    $transaction_message = "Payment completed successfully.";
} else {
    // Payment failed
    $transaction_status = "Failed";
    $transaction_message = $response_data['responseMessage'] ?? "Payment failed. Please try again.";
}

// Update order status in the database (example)
if ($transaction_status == "Success") {
    $update_sql = "UPDATE orders SET status = 'paid', transaction_id = ? WHERE id = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("si", $transaction_id, $order_id);
    $stmt->execute();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyPaisa Payment - Al_NAHL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
            text-align: center;
        }
        .receipt {
            margin-top: 20px;
        }
        .receipt p {
            font-size: 18px;
            color: #555;
        }
        .btn-back {
            display: block;
            width: 100%;
            max-width: 200px;
            margin: 20px auto;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>EasyPaisa Payment</h1>
        <div class="receipt">
    <?php if ($transaction_status == "Success"): ?>
        <p><strong>Order ID:</strong> <?php echo htmlspecialchars($order_id); ?></p>
        <p><strong>Status:</strong> <span class="text-success"><?php echo htmlspecialchars($transaction_status); ?></span></p>
        <p><strong>Transaction ID:</strong> <?php echo htmlspecialchars($transaction_id); ?></p>
        <p><strong>Amount:</strong> Rs. <?php echo htmlspecialchars($transaction_amount); ?></p>
        <p><strong>Message:</strong> <?php echo htmlspecialchars($transaction_message); ?></p>
        <p>Thank you for your payment. Your order will be processed shortly.</p>
    <?php else: ?>
        <p><strong>Order ID:</strong> <?php echo htmlspecialchars($order_id); ?></p>
        <p><strong>Status:</strong> <span class="text-danger"><?php echo htmlspecialchars($transaction_status); ?></span></p>
        <p><strong>Message:</strong> <?php echo htmlspecialchars($transaction_message); ?></p>
        <p>Please try again or contact support if the issue persists.</p>
    <?php endif; ?>
</div>
        <a href="index.php" class="btn btn-primary btn-back">Back to Home</a>
    </div>
</body>
</html>