<?php
session_start();

// Check if cart exists
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "<div class='empty-cart'>
            <h2>Your cart is empty.</h2>
            <a href='shop.php'>Continue Shopping</a>
          </div>";
    exit();
}

// Handle quantity updates
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_cart'])) {
    foreach ($_POST['quantity'] as $variant_id => $qty) {
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['variant_id'] == $variant_id) {
                $item['quantity'] = max(1, intval($qty)); // Ensure quantity is at least 1
                break;
            }
        }
    }
    header("Location: show_cart.php");
    exit();
}

// Handle item removal
if (isset($_GET['remove'])) {
    $variant_id = $_GET['remove'];
    $_SESSION['cart'] = array_filter($_SESSION['cart'], function($item) use ($variant_id) {
        return $item['variant_id'] != $variant_id;
    });
    header("Location: show_cart.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - Al_NAHL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/cart.css">
</head>
<body>
     <!-- Navbar -->
     <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="images/AL-NAHL.png" alt="Al_NAHL Logo" class="logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link active" href="shop.php">Shop</a></li>
                    <li class="nav-item"><a class="nav-link" href="blogs.php">Blogs</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="show_cart.php">Cart</a></li>
                    <li class="nav-item"><a class="nav-link" href="php/logout.php">logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2>Your Shopping Cart</h2>

        <form method="post">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total = 0; ?>
                    <?php foreach ($_SESSION['cart'] as $item): ?>
                        <?php 
                            $variant_id = $item['variant_id'] ?? 'N/A';
                            $name = htmlspecialchars($item['name'] ?? 'Unknown Product');
                            $price = isset($item['price']) ? floatval($item['price']) : 0; // Ensure price is a number
                            $quantity = isset($item['quantity']) ? intval($item['quantity']) : 1;
                            $image_url = $item['image_url'] ?? 'placeholder.jpg';
                            $subtotal = $price * $quantity;
                        ?>
                        <tr>
                            <td><img src="<?php echo htmlspecialchars($image_url); ?>" width="50"></td>
                            <td><?php echo $name; ?></td>
                            <td>Rs. <?php echo number_format($price, 2); ?></td>
                            <td>
                                <input type="number" name="quantity[<?php echo $variant_id; ?>]" value="<?php echo $quantity; ?>" min="1" class="form-control" style="width: 70px;">
                            </td>
                            <td>Rs. <?php echo number_format($subtotal, 2); ?></td>
                            <td><a href="show_cart.php?remove=<?php echo $variant_id; ?>" class="btn btn-danger">Remove</a></td>
                        </tr>
                        <?php $total += $subtotal; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <h4>Total: Rs. <?php echo number_format($total, 2); ?></h4>
            <button type="submit" name="update_cart" class="btn btn-primary">Update Cart</button>
            <a href="checkout.php" class="btn btn-success">Proceed to Checkout</a>
            <a href="shop.php" class="btn btn-secondary">Continue Shopping</a>
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>