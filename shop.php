<?php
$conn = new mysqli("localhost", "u992936863_al_nahl", "9WEO@2ScoW!c", "u992936863_al_nahl_store");
session_start();


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT p.*, v.id AS variant_id, v.weight, v.price, v.description, v.image_url
        FROM products p
        LEFT JOIN variants v ON p.id = v.product_id
        ORDER BY v.price ASC";

$result = $conn->query($sql);

$products = [];
$prices = [];

while ($row = $result->fetch_assoc()) {

    // CATEGORY DETECTION (CLEAN & SAFE)
    $name = strtolower($row['name']);
    if (strpos($name, 'tea') !== false) $category = 'tea';
    elseif (strpos($name, 'honey') !== false) $category = 'honey';
    elseif (strpos($name, 'olive') !== false) $category = 'olive oil';
    elseif (strpos($name, 'ghee') !== false) $category = 'ghee';
    elseif (strpos($name, 'salt') !== false) $category = 'salt';
    else $category = 'other';

    $key = preg_replace('/\s-\s\d+.*$/', '', $row['name']);

    $products[$key]['category'] = $category;
    $products[$key]['variants'][] = $row;

    $prices[] = $row['price'];
}

$minPrice = min($prices);
$maxPrice = max($prices);

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Shop</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">

<style>
/* ================= GLOBAL RESET ================= */
*,
*::before,
*::after {
    box-sizing: border-box;
}

html, body {
    margin: 0;
    width: 100%;
    overflow-x: hidden;
    font-family: Arial, sans-serif;
}

/* ================= NAVBAR ================= */
.navbar {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    padding: 6px 1rem;
    min-height: 56px;
    transition: background 0.3s ease;
    z-index: 9999;
}

.navbar.scrolled {
    background: rgba(0, 0, 0, 0.9);
}

.navbar .logo {
    height: 70px;
    width: auto;
}

.navbar .nav-link {
    color: #fff;
    transition: color 0.3s;
}

.navbar .nav-link:hover,
.navbar .nav-link.active {
    color: #ffc107; /* Bootstrap warning yellow */
}

@media (max-width: 576px) {
    .navbar {
        padding: 4px 12px;
        min-height: 52px;
    }

    .navbar .logo {
        height: 55px;
    }
}

/* ================= NAVBAR ================= */
.navbar {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    padding: 6px 1rem;
    min-height: 56px;
    transition: background 0.3s ease;
    z-index: 9999;
}

.navbar.scrolled {
    background: rgba(0, 0, 0, 0.9);
}

.navbar .logo {
    height: 70px;
    width: auto;
}

.navbar .nav-link {
    color: #fff;
    transition: color 0.3s;
}

.navbar .nav-link:hover,
.navbar .nav-link.active {
    color: #ffc107; /* Bootstrap warning yellow */
}

@media (max-width: 576px) {
    .navbar {
        padding: 4px 12px;
        min-height: 52px;
    }

    .navbar .logo {
        height: 55px;
    }
}

/* ================= HERO ================= */
.hero {
    background: #222;
    color: #fff;
    padding: 80px 0 40px 0;
    text-align: center;
}

.hero h1 {
    font-size: 2.5rem;
    margin-bottom: 0.5rem;
}

.hero p {
    font-size: 1.2rem;
}

/* ================= PRODUCT CARDS ================= */
.card {
    border: none;
    border-radius: 16px;
    background: #ffffff;
    overflow: hidden;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
    transition: box-shadow 0.35s ease, transform 0.35s ease;
    display: flex;
    flex-direction: column;
    height: 100%; /* ensures equal height cards */
}

.card:hover {
    transform: translateY(-4px);
    box-shadow: 0 14px 40px rgba(0, 0, 0, 0.15);
}

/* IMAGE */
.card-img-top {
    width: 100%;
    height: auto; /* full image visible */
    max-height: 250px;
    object-fit: contain; /* no cropping */
    transition: transform 0.5s ease;
}

.card:hover .card-img-top {
    transform: scale(1.05);
}

/* CARD BODY */
.card-body {
    padding: 1.25rem;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
}

/* TITLE */
.card-title {
    font-size: 1.05rem;
    font-weight: 700;
    color: #222;
    margin-bottom: 0.4rem;
}

/* PRICE */
.product-price {
    font-size: 1.1rem;
    font-weight: 700;
    color: #c78b00; /* premium gold tone */
}

/* DESCRIPTION */
.product-description {
    font-size: 0.85rem;
    color: #666;
    line-height: 1.4;
    margin-bottom: 0.75rem;
    flex-grow: 1; /* push button down */
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* VARIANT SELECT */
.variant-select {
    border-radius: 10px;
    font-size: 0.85rem;
    margin-bottom: 0.5rem;
}

/* BUTTON */
.view-details-link {
    width: 100%;
    border-radius: 12px;
    font-weight: 600;
    padding: 10px;
    transition: background 0.3s ease, transform 0.3s ease;
}

.view-details-link:hover {
    transform: translateY(-1px);
}

/* INPUTS */
input[type="text"], .form-select, .form-range {
    border-radius: 10px;
}

/* CLEAR BUTTON */
#clearBtn {
    border-radius: 10px;
}

/* RESPONSIVE IMAGE HEIGHT */
@media (max-width: 576px) {
    .card-title {
        font-size: 0.95rem;
    }

    .product-description {
        -webkit-line-clamp: 2;
    }

    .card-img-top {
        max-height: 180px;
    }
}

@media (max-width: 768px) {
    h1 { font-size: 26px; }
    h2 { font-size: 22px; }
    h3 { font-size: 18px; }

    .btn {
        width: 100%;
        margin-bottom: 10px;
    }
}

@media (max-width: 480px) {
    body {
        font-size: 14px;
    }
}

</style>
</head>

<body>
    
    <!-- Navbar Section -->
<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="index.php">
    <img src="images/AL-NAHL.png" alt="Al_NAHL Logo" class="logo">
    </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
                <li class="nav-item"><a class="nav-link" href="php/login.php">login</a></li>
            </ul>
        </div>
    </div>
</nav>

<section class="hero bg-dark text-white py-5 text-center mt-5">
    <h1 class="display-4">Shop</h1>
    <p class="lead">Explore our collection of premium honey products.</p>
</section>

<div class="container my-4">
    <div class="row g-2 align-items-end">

        <!-- SEARCH -->
        <div class="col-md-4">
            <label class="form-label">Search</label>
            <div class="input-group">
                <input type="text" id="search" class="form-control" placeholder="Search products">
                <button class="btn btn-warning" id="searchBtn"><i class="fa fa-search"></i></button>
                <button class="btn btn-outline-secondary" id="clearBtn"><i class="fa fa-times"></i></button>
            </div>
        </div>

        <!-- CATEGORY -->
        <div class="col-md-4">
            <label class="form-label">Category</label>
            <select id="categoryFilter" class="form-select">
                <option value="">All Categories</option>
                <option value="tea">Tea</option>
                <option value="honey">Honey</option>
                <option value="olive oil">Olive Oil</option>
                <option value="ghee">Ghee</option>
                <option value="salt">Salt</option>
            </select>
        </div>

        <!-- PRICE RANGE -->
        <div class="col-md-4">
            <label class="form-label">Max Price: Rs <span id="priceValue"><?= $maxPrice ?></span></label>
            <input type="range" id="priceFilter" class="form-range"
                   min="<?= $minPrice ?>" max="<?= $maxPrice ?>" value="<?= $maxPrice ?>">
        </div>

    </div>
</div>

<section class="py-5">
<div class="container">
<div class="row">

<?php foreach ($products as $title => $data):
$first = $data['variants'][0];
?>
<div class="col-6 col-md-4 col-lg-3 mb-4 product-item"
     data-category="<?= $data['category'] ?>"
     data-price="<?= $first['price'] ?>">

<div class="card">
<img src="<?= $first['image_url'] ?>" class="card-img-top product-image">
<div class="card-body">
<h5 class="card-title"><?= htmlspecialchars($title) ?></h5>
<p>Rs <span class="product-price"><?= $first['price'] ?></span></p>
<p class="product-description"><?= $first['description'] ?></p>

<select class="form-select variant-select mb-2">
<?php foreach ($data['variants'] as $v): ?>
<option value="<?= $v['variant_id'] ?>"
        data-price="<?= $v['price'] ?>"
        data-description="<?= $v['description'] ?>"
        data-image="<?= $v['image_url'] ?>">
<?= $v['weight'] ?>
</option>
<?php endforeach; ?>
</select>

<a href="product_detail.php?id=<?= $first['variant_id'] ?>" class="btn btn-warning view-details-link">View Details</a>
</div>
</div>
</div>
<?php endforeach; ?>

</div>
</div>
</section>

<script>
function filterProducts() {
    const search = document.getElementById('search').value.toLowerCase();
    const category = document.getElementById('categoryFilter').value;
    const maxPrice = parseFloat(document.getElementById('priceFilter').value);

    document.querySelectorAll('.product-item').forEach(p => {
        const title = p.querySelector('.card-title').textContent.toLowerCase();
        const desc = p.querySelector('.product-description').textContent.toLowerCase();
        const price = parseFloat(p.dataset.price);
        const cat = p.dataset.category;

        let show = true;
        if (search && !(title.includes(search) || desc.includes(search))) show = false;
        if (category && category !== cat) show = false;
        if (price > maxPrice) show = false;

        p.style.display = show ? '' : 'none';
    });
}

document.getElementById('search').addEventListener('input', filterProducts);
document.getElementById('searchBtn').addEventListener('click', filterProducts);
document.getElementById('categoryFilter').addEventListener('change', filterProducts);

document.getElementById('priceFilter').addEventListener('input', function(){
    document.getElementById('priceValue').textContent = this.value;
    filterProducts();
});

document.getElementById('clearBtn').addEventListener('click', () => {
    search.value = '';
    categoryFilter.value = '';
    priceFilter.value = priceFilter.max;
    priceValue.textContent = priceFilter.max;
    filterProducts();
});

// Variant switching
document.querySelectorAll('.variant-select').forEach(sel => {
    sel.addEventListener('change', function(){
        const o = this.options[this.selectedIndex];
        const card = this.closest('.card');
        const item = this.closest('.product-item');

        card.querySelector('.product-price').textContent = o.dataset.price;
        card.querySelector('.product-description').textContent = o.dataset.description;
        card.querySelector('.product-image').src = o.dataset.image;
        card.querySelector('.view-details-link').href = 'product_detail.php?id=' + o.value;
        item.dataset.price = o.dataset.price;
    });
});
</script>

</body>
</html>