<?php
include "php/db.php";
session_start();

// Get variant ID
$variant_id = isset($_GET['variant_id']) ? intval($_GET['variant_id']) : 0;
if ($variant_id <= 0) {
    die("Invalid variant ID.");
}

// Fetch variant details
$sql = "SELECT v.*, p.name AS product_name 
        FROM variants v 
        JOIN products p ON v.product_id = p.id 
        WHERE v.id = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("SQL Error: " . $conn->error);
}

$stmt->bind_param("i", $variant_id);
$stmt->execute();
$variant = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$variant) {
    die("Product variant not found.");
}

// Process order on form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $quantity = intval($_POST['quantity']);
    $total_price = $variant['price'] * $quantity;
    $payment_method = $_POST['payment_method'];
    $shipping_address = trim($_POST['shipping_address']);

    if ($quantity <= 0 || empty($shipping_address) || empty($payment_method)) {
        echo "<script>alert('Invalid quantity, address, or payment method.');</script>";
    } else {
        $order_sql = "INSERT INTO orders (user_id, variant_id, quantity, total_price, payment_method, shipping_address, status)
                      VALUES (?, ?, ?, ?, ?, ?, 'Pending')";
        $stmt = $conn->prepare($order_sql);

        if (!$stmt) {
            die("SQL Error: " . $conn->error);
        }

        $stmt->bind_param("iiisss", $user_id, $variant_id, $quantity, $total_price, $payment_method, $shipping_address);

        if ($stmt->execute()) {
            // Get the newly inserted order ID
            $order_id = $stmt->insert_id;
            $stmt->close();

            // Redirect to the selected payment page with order_id
            header("Location: {$payment_method}?order_id={$order_id}");
            exit();
        } else {
            echo "<script>alert('Order failed. Please try again.');</script>";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Checkout - Al_NAHL</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background:#f5f6f8;
}
.checkout-box{
    background:white;
    padding:30px;
    border-radius:15px;
    box-shadow:0 10px 30px rgba(0,0,0,0.08);
}
.order-summary{
    background:#f8f9fa;
    padding:25px;
    border-radius:15px;
}
.place-btn{
    background:#0d3b2e;
    color:white;
    border:none;
    padding:12px;
    width:100%;
    border-radius:10px;
}
.place-btn:hover{
    background:#145c47;
}
.qty-box{
    display:flex;
    align-items:center;
    gap:10px;
}
.qty-box button{
    width:35px;
    height:35px;
}
</style>
</head>

<body>

<div class="container mt-5 mb-5">
<h2 class="mb-4">Checkout</h2>

<div class="row">

<!-- LEFT SIDE BILLING -->
<div class="col-md-7">
<div class="checkout-box p-4 bg-white rounded shadow-sm">

<h4 class="mb-3">Billing Details</h4>

<form method="POST">

<div class="row">
<div class="col-md-6 mb-3">
<label>Full Name</label>
<input type="text" name="full_name" class="form-control" required>
</div>

<div class="col-md-6 mb-3">
<label>Phone</label>
<input type="text" name="phone" class="form-control" required>
</div>
</div>

<div class="mb-3">
<label>Email</label>
<input type="email" name="email" class="form-control">
</div>

<div class="mb-3">
<label>Shipping Address</label>
<textarea name="shipping_address" class="form-control" required></textarea>
</div>

<input type="hidden" name="quantity" id="quantity" value="1">

</div>
</div>


<!-- RIGHT SIDE ORDER SUMMARY -->
<div class="col-md-5">
<div class="p-4 bg-light rounded shadow-sm">

<h5>Your Order</h5>
<hr>

<div class="d-flex align-items-center gap-3 mb-3">
<img src="<?php echo htmlspecialchars($variant['image_url']); ?>" width="70">
<div>
<strong><?php echo htmlspecialchars($variant['product_name']); ?></strong><br>
<small><?php echo htmlspecialchars($variant['weight']); ?></small>
</div>
</div>

<div class="d-flex align-items-center mb-3 gap-2">
<label>Qty:</label>
<button type="button" class="btn btn-outline-secondary btn-sm" onclick="changeQty(-1)">-</button>
<span id="qty-display">1</span>
<button type="button" class="btn btn-outline-secondary btn-sm" onclick="changeQty(1)">+</button>
</div>

<hr>

<p>Price: Rs. <?php echo $variant['price']; ?></p>
<p><strong>Total: Rs. <span id="total-price"><?php echo $variant['price']; ?></span></strong></p>

<hr>

<h6>Shipping Method</h6>
<div class="form-check">
<input class="form-check-input" type="radio" name="shipping_method" value="standard" checked>
<label class="form-check-label">Standard Delivery (Free)</label>
</div>

<div class="form-check mb-3">
<input class="form-check-input" type="radio" name="shipping_method" value="express">
<label class="form-check-label">Express Delivery (+ Rs. 200)</label>
</div>

<h6>Payment Method</h6>

<div class="form-check">
<input class="form-check-input" type="radio" name="payment_method" value="php/cod.php" required>
<label class="form-check-label">Cash on Delivery</label>
</div>

<div class="form-check">
<input class="form-check-input" type="radio" name="payment_method" value="php/easypaisa.php">
<label class="form-check-label">EasyPaisa</label>
</div>

<div class="form-check">
<input class="form-check-input" type="radio" name="payment_method" value="php/jazzcash.php">
<label class="form-check-label">JazzCash</label>
</div>

<div class="form-check mb-3">
<input class="form-check-input" type="radio" name="payment_method" value="php/bank.php">
<label class="form-check-label">Bank Transfer</label>
</div>

<button type="submit" class="btn btn-success w-100">Place Order</button>

</form>

</div>
</div>

</div>
</div>


<script>
let price = <?php echo $variant['price']; ?>;
let quantity = 1;

function changeQty(val){
    quantity += val;
    if(quantity < 1) quantity = 1;

    document.getElementById("qty-display").innerText = quantity;
    document.getElementById("quantity").value = quantity;
    document.getElementById("total-price").innerText = price * quantity;
}
</script>

</body>
</html>
