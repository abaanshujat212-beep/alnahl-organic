<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "al_nahl_store");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

// Fetch all products and their variants, ordered by weight (from the variants table)
$sql = "SELECT p.*, v.weight, v.price, v.description, v.image_url 
        FROM products p
        LEFT JOIN variants v ON p.id = v.product_id
        ORDER BY v.weight ASC"; // Sorting by weight in the variants table

$result = $conn->query($sql);

$grouped_products = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Extract product name prefix (e.g., "AL NAHL Premium Family Mixture Tea")
        $name_parts = explode(' - ', $row['name']);
        $product_prefix = $name_parts[0]; // Use the prefix for grouping

        // Group products by their prefix
        $grouped_products[$product_prefix][] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Al_NAHL Honey Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/shop.css">
    <style>
        /* Remove hover effect from product cards */
        .card:hover {
            transform: none !important;
            box-shadow: none !important;
        }
    </style>
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

    <!-- Hero Section -->
    <section class="hero bg-dark text-white py-5 text-center">
        <h1 class="display-4">Shop</h1>
        <p class="lead">Explore our collection of premium honey products, carefully crafted for you.</p>
    </section>

<!-- Google Translator -->
<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}
</script>

<div id="google_translate_element"></div>
</div>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    <!-- Search Bar -->
    <div class="container my-4">
        <input type="text" id="search" class="form-control" placeholder="Search for products...">
    </div>

    <!-- Products Section -->
    <section id="products" class="py-5">
        <div class="container">
            <div class="row">
                <?php
                if (!empty($grouped_products)) {
                    foreach ($grouped_products as $product_prefix => $variants) {
                        $first_variant = $variants[0]; // Default variant

                        // Display product card
                        echo "
                        <div class='col-md-4 mb-4'>
                            <div class='card'>
                                <img src='{$first_variant['image_url']}' class='card-img-top product-image' alt='{$product_prefix}'>
                                <div class='card-body'>
                                    <h5 class='card-title'>{$product_prefix}</h5>
                                    <p class='card-text'><strong>Price:</strong> Rs. <span class='product-price'>{$first_variant['price']}</span></p>
                                    <p class='card-text product-description'>{$first_variant['description']}</p>
                                    <select class='form-select variant-select mb-3'>";

                                    foreach ($variants as $variant) {
                                        echo "<option value='{$variant['id']}' 
                                            data-price='{$variant['price']}' 
                                            data-description='{$variant['description']}' 
                                            data-image='{$variant['image_url']}'>
                                            {$variant['weight']}
                                        </option>";
                                    }

                                    echo "</select>
                                    <?php $product_id = $first_variant['id']; ?>
        <a id="viewDetailsLink" class="btn btn-warning view-details-link" data-product-id="<?php echo $product_id; ?>">View Details</a>
                                </div>
                            </div>
                        </div>"
                    }
                } else {
                    echo "<p>No products found.</p>";
                }
                ?>
            </div>
        </div>
    </section>

   <!-- Footer Section -->
<footer class="bg-dark text-white py-4">
    <div class="container text-center">
        <div class="row">
            <div class="col-md-4">
                <h5 class="text-warning">Contact Us</h5>
                <p>Email: info@alnahlhoney.com</p>
                <p>Phone: +92 300 1234567</p>
                <p>Address: 123 Honey Street, Islamabad, Pakistan</p>
            </div>
            <div class="col-md-4">
                <h5 class="text-warning">Follow Us</h5>
                <a href="#" class="text-white me-3 social-icon" style="hover: color: #1877F2;"><i class="fa-brands fa-facebook fs-2"></i></a>
                <a href="#" class="text-white me-3 social-icon"><i class="bi bi-whatsapp fs-2"></i></a>
                <a href="#" class="text-white me-3 social-icon"><i class="bi bi-linkedin fs-2"></i></a>
                <a href="#" class="text-white me-3 social-icon"><i class="bi bi-instagram fs-2"></i></a>
                <a href="#" class="text-white me-3 social-icon"><i class="bi bi-youtube fs-2"></i></a>
                <a href="#" class="text-white me-3 social-icon"><i class="fa-brands fa-tiktok fs-2"></i></a>


            </div>
            <div class="col-md-4">
                <h5 class="text-warning">Quick Links</h5>
                <a href="about.php" class="text-white d-block">About Us</a>
                <a href="contact.php" class="text-white d-block">Contact</a>
                <a href="shop.php" class="text-white d-block">Shop</a>
                <a href="blogs.php" class="text-white d-block">Blog</a>
            </div>
        </div>
        <div class="mt-3">
            <p>&copy; 2025 Al_NAHL Honey Store. All Rights Reserved.</p>
        </div>
    </div>
</footer>

    <!-- JavaScript for Variant Selection -->
    <script>
document.addEventListener('DOMContentLoaded', function () {
    // Search functionality
    document.getElementById('search').addEventListener('input', function () {
        let searchQuery = this.value.toLowerCase();
        let products = document.querySelectorAll('#products .col-md-4');

        products.forEach(product => {
            let title = product.querySelector('.card-title').textContent.toLowerCase();
            let description = product.querySelector('.product-description').textContent.toLowerCase();

            if (title.includes(searchQuery) || description.includes(searchQuery)) {
                product.style.display = 'block'; // Show matching products
            } else {
                product.style.display = 'none'; // Hide non-matching products
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
    // Variant selection functionality
    document.querySelectorAll('.variant-select').forEach(select => {
        select.addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            const card = this.closest('.card');

            // Update price
            card.querySelector('.product-price').textContent = selectedOption.getAttribute('data-price');

            // Update description
            card.querySelector('.product-description').textContent = selectedOption.getAttribute('data-description');

            // Update image with cache-busting technique
            const productImage = card.querySelector('.product-image');
            if (productImage) {
                const newImageUrl = selectedOption.getAttribute('data-image') + "?t=" + new Date().getTime();
                productImage.src = newImageUrl;
            }

            // Update the "View Details" link with the selected variant ID
            const viewDetailsLink = card.querySelector('.view-details-link');
            if (viewDetailsLink) {
                const variantId = selectedOption.value;
                viewDetailsLink.href = `product_detail.php?id=${variantId}`;
            }
        });
    });
});

    // Variant selection functionality (unchanged)
    document.querySelectorAll('.variant-select').forEach(select => {
        select.addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            const card = this.closest('.card');

            // Update price
            card.querySelector('.product-price').textContent = selectedOption.getAttribute('data-price');

            // Update description
            card.querySelector('.product-description').textContent = selectedOption.getAttribute('data-description');

            // Update image with cache-busting technique
            const productImage = card.querySelector('.product-image');
            if (productImage) {
                const newImageUrl = selectedOption.getAttribute('data-image') + "?t=" + new Date().getTime();
                productImage.src = newImageUrl;
            }
        });
    });
});
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let viewDetailsLink = document.getElementById("viewDetailsLink");

        // Get the product ID from the data attribute
        let productId = viewDetailsLink.getAttribute("data-product-id");

        // Set the href dynamically
        viewDetailsLink.href = "product_detail.php?id=" + productId;
    });
</script>

<!-- Google Translator -->
<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}
</script>

    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>
