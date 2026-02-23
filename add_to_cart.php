<?php
session_start();
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Debugging: Check if data is received
    if (empty($_POST['variant_id']) || empty($_POST['name']) || empty($_POST['price'])) {
        die("Invalid product data."); 
    }

    $variant_id = trim($_POST['variant_id']);
    $name = trim($_POST['name']);
    $price = floatval($_POST['price']);
    $image_url = trim($_POST['image_url']);
    $quantity = isset($_POST['quantity']) ? max(1, intval($_POST['quantity'])) : 1;

    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['variant_id'] == $variant_id) {
            $item['quantity'] += $quantity;
            $found = true;
            break;
        }
    }

    if (!$found) {
        $_SESSION['cart'][] = [
            'variant_id' => $variant_id,
            'name' => $name,
            'price' => $price,
            'image_url' => $image_url,
            'quantity' => $quantity
        ];
    }

    header("Location: product_detail.php?id=" . $variant_id);
    exit();
}
?>