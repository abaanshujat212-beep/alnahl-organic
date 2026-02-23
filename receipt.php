<?php
session_start();
include "../php/db.php";

// Debugging: Check if order_id is coming in the URL
if (!isset($_GET['order_id'])) {
    die("Error: order_id is NOT SET in the URL.");
}

$order_id = intval($_GET['order_id']);
if ($order_id <= 0) {
    die("Error: Invalid order ID value. Order ID received: " . $_GET['order_id']);
}

// Fetch the order details from the database
$sql = "SELECT * FROM orders WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$order = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$order) {
    die("Order not found.");
}

// Map payment method to readable format
$payment_methods = [
    'php/cod.php' => 'Cash on Delivery',
    'php/easypaisa.php' => 'EasyPaisa',
    'php/jazzcash.php' => 'JazzCash',
    'php/bank.php' => 'Bank Transfer'
];

$payment_method_display = isset($payment_methods[$order['payment_method']]) ? $payment_methods[$order['payment_method']] : 'Unknown';

// Update the order status to 'Completed' after processing
if ($order['status'] == 'Pending') {
    $update_sql = "UPDATE orders SET status = 'Completed' WHERE id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("i", $order_id);
    $update_stmt->execute();
    $update_stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Receipt - Al_NAHL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .receipt-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border: 1px solid #ddd;
        }
        h1 {
            color: #333;
            text-align: center;
            font-size: 28px;
            font-weight: bold;
        }
        h3 {
            color: #333;
            font-size: 20px;
            margin-bottom: 10px;
        }
        .details {
            font-size: 18px;
            color: #555;
            margin-bottom: 20px;
        }
        .details p {
            margin: 5px 0;
        }
        .receipt-item {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }
        .receipt-item:last-child {
            border-bottom: none;
        }
        .total {
            font-size: 20px;
            font-weight: bold;
            color: #333;
            text-align: right;
        }
        .btn-back {
            display: block;
            width: 100%;
            max-width: 200px;
            margin: 20px auto;
            text-align: center;
        }
        .receipt-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .receipt-header h2 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
        }
        .logo {
            max-width: 120px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="receipt-container">
    <div class="receipt-header">
        <!-- Add your logo here -->
        <img src="../images/2.png" alt="Al_NAHL Logo" class="logo">
        <h2>Al_NAHL</h2>
        <p>Honey Purchase Receipt</p>
        <hr>
    </div>

    <h3>Order Details</h3>
    <div class="details">
        <p><strong>Order ID:</strong> #<?php echo htmlspecialchars($order['id']); ?></p>
        <p><strong>Payment Method:</strong> <?php echo htmlspecialchars($payment_method_display); ?></p>
        <p><strong>Status:</strong> <?php echo htmlspecialchars($order['status']); ?></p>
        <p><strong>Delivery Address:</strong> <?php echo htmlspecialchars($order['shipping_address']); ?></p>
    </div>

    <div class="receipt-item">
    </div>

    <div class="total">
        <p>Total Amount: Rs. <?php echo htmlspecialchars($order['total_price']); ?></p>
    </div>

    <div class="btn-back">
        <a href="../index.php" class="btn btn-primary">Back to Home</a>
    </div>
</div>

</body>
</html>
