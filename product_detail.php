<?php
include "php/db.php";
session_start();

// Get product ID
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($product_id <= 0) {
    die("Invalid product ID.");
}

// Fetch product details
$sql = "SELECT * FROM products WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$product = $stmt->get_result()->fetch_assoc();
$stmt->close();

// Fetch product variants
$variants_sql = "SELECT * FROM variants WHERE product_id = ?";
$stmt = $conn->prepare($variants_sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$variants = $stmt->get_result();
$stmt->close();

// Fetch customer reviews
$reviews_sql = "SELECT r.*, u.name AS username 
                FROM reviews r 
                JOIN users u ON r.user_id = u.id 
                WHERE r.product_id = ? 
                ORDER BY r.created_at DESC";

$stmt = $conn->prepare($reviews_sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$reviews = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product['name']; ?> - Al_NAHL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/product_detail.css">
</head>
<body>

<!-- Navbar Section -->
<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="index.php">
            <img src="images/AL-NAHL.png" alt="Al_NAHL Logo" class="logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="shop.php">Shop</a></li>
                <li class="nav-item"><a class="nav-link" href="blogs.php">Blogs</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
                <li class="nav-item"><a class="nav-link" href="show_cart.php">Cart</a></li>
                <li class="nav-item"><a class="nav-link" href="php/logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="row">
        <!-- Product Image -->
        <div class="col-md-6">
            <img id="product-image" src="<?php echo $product['image_url']; ?>" class="img-fluid product-image" alt="<?php echo $product['name']; ?>">
        </div>

        <!-- Product Details -->
        <div class="col-md-6">
            <h2><?php echo $product['name']; ?></h2>
            <p><strong>Weight:</strong> <span id="variant-weight"></span></p>
            <p><strong>Price:</strong> Rs. <span id="product-price"><?php echo $product['price']; ?></span></p>
            <p><?php echo $product['description']; ?></p>

            <!-- Select Variant -->
            <label for="variant-select">Selected Weight:</label>
            <select class="form-select mb-3" id="variant-select" onchange="updateVariant()">
                <?php
                while ($variant = $variants->fetch_assoc()) {
                    echo "<option value='{$variant['id']}' 
                            data-price='{$variant['price']}' 
                            data-image='{$variant['image_url']}'
                            data-weight='{$variant['weight']}'>
                            {$variant['weight']} - Rs. {$variant['price']}
                          </option>";
                }
                ?>
            </select>

            <!-- Buttons -->
            <form action="add_to_cart.php" method="POST">
    <input type="hidden" name="variant_id" id="variant-id">
    <input type="hidden" name="name" value="<?php echo htmlspecialchars($product['name']); ?>">
    <input type="hidden" name="price" id="variant-price">
    <input type="hidden" name="image_url" id="variant-image">

    <label for="quantity">Quantity:</label>
    <input type="number" name="quantity" value="1" min="1" class="form-control" style="width: 60px;">

    <button type="submit" class="btn btn-primary">Add to Cart</button>
</form>

<a id="checkout-link" href="#" class="btn btn-primary" 
   style="background-color: #007bff; border: none; padding: 10px 20px; 
          font-size: 16px; border-radius: 5px; text-decoration: none; 
          color: white; display: inline-block; margin-top: 10px;">
   Buy Now
</a>

        </div>
    </div>

    <!-- Reviews Section -->
<h3 class="mt-5">Customer Reviews</h3>
<div class="reviews">
    <?php
    if ($reviews->num_rows > 0) {
        while ($review = $reviews->fetch_assoc()) {
            echo "<div class='review'>
                    <p><strong>{$review['username']}</strong></p>
                    <div class='star-rating'>";
            for ($i = 1; $i <= 5; $i++) {
                $starClass = ($i <= $review['rating']) ? "filled-star" : "empty-star";
                echo "<span class='$starClass'>&#9733;</span>"; // Unicode for star
            }
            echo "</div>
                  <p>{$review['comment']}</p>
                  <hr>
                  </div>";
        }
    } else {
        echo "<p>No reviews yet.</p>";
    }
    ?>
</div>

   <!-- Add Review Form -->
<h4>Add a Review</h4>
<form action="submit_review.php" method="post">
    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">

    <div class="mb-3">
        <label>Rating:</label>
        <div class="rating">
            <input type="radio" name="rating" id="star5" value="5">
            <label for="star5">&#9733;</label>

            <input type="radio" name="rating" id="star4" value="4">
            <label for="star4">&#9733;</label>

            <input type="radio" name="rating" id="star3" value="3">
            <label for="star3">&#9733;</label>

            <input type="radio" name="rating" id="star2" value="2">
            <label for="star2">&#9733;</label>

            <input type="radio" name="rating" id="star1" value="1">
            <label for="star1">&#9733;</label>
        </div>
    </div>

    <div class="mb-3">
        <label>Comment:</label>
        <textarea name="comment" class="form-control" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit Review</button>
</form>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- JavaScript -->
<script>
function updateVariant() {
    let select = document.getElementById("variant-select");
    let selected = select.options[select.selectedIndex];

    let price = selected.getAttribute("data-price");
    let image = selected.getAttribute("data-image");
    let weight = selected.getAttribute("data-weight");
    let variantId = selected.value;

    document.getElementById("product-price").textContent = price;
    document.getElementById("product-image").src = image;
    document.getElementById("variant-weight").textContent = weight;

    document.getElementById("variant-id").value = variantId;
    document.getElementById("variant-price").value = price;
    document.getElementById("variant-image").value = image;

    // Fix Buy Now button
    document.getElementById("checkout-link").href = "checkout.php?variant_id=" + variantId;
}

// Auto-select first variant on page load
document.addEventListener("DOMContentLoaded", () => updateVariant());

</script>

</body>
</html>
