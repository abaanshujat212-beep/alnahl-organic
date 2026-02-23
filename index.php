<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Al_NAHL Honey Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="css/index.css" rel="stylesheet">
</head>
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
    background: rgba(0, 0, 0, 0.35); /* semi-transparent overlay */
    backdrop-filter: blur(6px);
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

/* ================= HERO / CAROUSEL ================= */
#heroCarousel,
.carousel-item {
    width: 100%;
    height: 100vh; /* full viewport height */
}

.carousel-item picture,
.carousel-item picture img {
    width: 100%;
    height: 100%;
    display: block;
    object-fit: cover; /* fill container, no black bars */
}

/* Carousel controls */
.carousel-control-prev,
.carousel-control-next {
    width: 10%;
}

/* ================= ABOUT SECTION ================= */
.about-us {
    padding: 5rem 0;
    background-color: #f8f9fa;
}

.about-us h2 {
    font-size: 2.5rem;
    margin-bottom: 1rem;
}

.about-us p {
    font-size: 1.1rem;
    color: #6c757d;
}

/* ================= FEATURED PRODUCTS ================= */

/* CSS for product card images */
.product-card img {
    width: 100%;       /* Full width of the card */
    height: auto;      /* Maintain aspect ratio */
    object-fit: cover; /* Ensure it covers nicely if needed */
    display: block;    /* Removes inline spacing issues */
}

.featured-products {
    padding: 5rem 0;
    background-color: #212529;
}

.featured-products h2 {
    color: #ffc107;
    margin-bottom: 2rem;
    text-align: center;
}

.featured-products .card {
    border-radius: 10px;
    overflow: hidden;
}

.featured-products .card .card-body {
    text-align: center;
}

.featured-products .card .card-text {
    color: #fff !important;
}

/* ================= CUSTOMER REVIEWS ================= */
.customer-reviews {
    padding: 5rem 0;
    background-color: #f8f9fa;
}

.customer-reviews h2 {
    text-align: center;
    margin-bottom: 2rem;
}

.customer-reviews .card {
    border-radius: 10px;
    padding: 1rem;
    text-align: center;
}

.customer-reviews .card img {
    width: 80px;
    height: 80px;
    margin: 0 auto 1rem auto;
}

/* ================= CTA SECTION ================= */
.cta-section {
    padding: 5rem 0;
    text-align: center;
    background-color: #ffc107;
    color: #fff;
}

.cta-section h2 {
    font-size: 2.5rem;
    margin-bottom: 1rem;
}

.cta-section p {
    font-size: 1.2rem;
    margin-bottom: 2rem;
}

/* ================= HOW IT WORKS ================= */
.how-it-works {
    padding: 5rem 0;
    background-color: #f8f9fa;
}

.how-it-works h2 {
    text-align: center;
    margin-bottom: 3rem;
}

.how-it-works .card {
    border-radius: 10px;
    overflow: hidden;
    text-align: center;
    margin-bottom: 2rem;
}

.how-it-works .card i {
    margin-bottom: 1rem;
}

/* ================= NEWSLETTER ================= */
.newsletter {
    padding: 5rem 0;
    background-color: #212529;
    text-align: center;
}

.newsletter h2 {
    margin-bottom: 1rem;
}

.newsletter p {
    margin-bottom: 2rem;
}

.newsletter .form-control {
    max-width: 400px;
    margin: 0 auto 1rem auto;
}

/* ================= FAQ ================= */
.faq {
    padding: 5rem 0;
}

.faq h2 {
    text-align: center;
    margin-bottom: 2rem;
}

/* ================= FOOTER ================= */
footer {
    background-color: #212529;
    color: #fff;
    padding: 2rem 0;
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
}

footer h5 {
    color: #ffc107;
    margin-bottom: 1rem;
}

/* LINKS IN LINE */
footer .footer-links {
    display: flex;
    flex-wrap: wrap; /* wrap on small screens */
    gap: 1.5rem; /* space between links */
    justify-content: center;
    margin-bottom: 1rem;
}

footer .footer-links a {
    color: #fff;
    text-decoration: none;
    display: inline-block; /* inline links */
    transition: color 0.3s;
}

footer .footer-links a:hover {
    color: #ffc107;
}

/* SOCIAL ICONS */
footer .social-icons {
    display: flex;
    gap: 0.8rem;
    justify-content: center;
}

footer .social-icon {
    color: #fff;
    font-size: 1.2rem;
    transition: color 0.3s;
}

footer .social-icon:hover {
    color: #ffc107;
}

/* RESPONSIVE */
@media (max-width: 576px) {
    footer .footer-links {
        gap: 1rem;
        flex-wrap: wrap;
    }
}


/* ================= CARDS & IMAGES ================= */
.card img {
    object-fit: cover;
}

img {
    max-width: 100%;
    height: auto;
}

/* ================= TABLES ================= */
table {
    width: 100%;
    display: block;
    overflow-x: auto;
}

/* ================= RESPONSIVE ADJUSTMENTS ================= */
@media (max-width: 991px) {
    #heroCarousel,
    .carousel-item {
        height: 100vh; /* tablet */
    }
}

@media (max-width: 576px) {
    #heroCarousel,
    .carousel-item {
        height: 100vh; /* mobile full height */
    }
}
</style>

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

<!-- Hero Section with Slider -->
<div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
    <div class="carousel-inner">

        <!-- Slide 1 -->
        <div class="carousel-item active">
            <picture>
                <source srcset="images/hero-mb1.png" media="(max-width: 576px)">
                <img src="images/hero-bg1.jpg" class="hero-img" alt="Al Nahl Honey">
            </picture>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item">
            <picture>
                <source srcset="images/hero-mb2.png" media="(max-width: 576px)">
                <img src="images/hero-bg2.jpg" class="hero-img" alt="Natural Honey">
            </picture>
        </div>

        <!-- Slide 3 -->
        <div class="carousel-item">
            <picture>
                <source srcset="images/hero-mb3.png" media="(max-width: 576px)">
                <img src="images/hero-bg3.jpg" class="hero-img" alt="Pure Honey">
            </picture>
        </div>

    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>

    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>


<section class="py-5 bg-light">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6">
        <img src="images/honey.jpg" class="img-fluid rounded shadow" alt="Premium Honey">
      </div>
      <div class="col-md-6">
        <h2 class="fw-bold">Pure Natural Honey</h2>
        <p class="text-muted">
          100% raw, unfiltered honey sourced directly from trusted beekeepers.
          No sugar. No additives.
        </p>
        <a href="shop.php" class="btn btn-warning btn-lg">Buy Now</a>
      </div>
    </div>
  </div>
</section>



<section class="about-us py-5 bg-light">
    <div class="container">
        <div class="row">
            <!-- Text Section -->
            <div class="col-md-6 d-flex align-items-end" >
                <div style="margin-bottom:99px;">
                   <h2 class="display-4 text-dark">Why Al‑NAHL?</h2>
                    <p class="lead text-muted">At Al_NAHL, we pride ourselves on providing the highest quality natural honey straight from the hives to your table. Our honey is pure, unfiltered, and rich in flavor.</p>
                </div>
            </div>
            <!-- Image Section with Text at Bottom -->
<div class="col-md-6 position-relative">
    <img src="images/2.png" 
         alt="About Al_NAHL Honey" 
         class="img-fluid rounded shadow-lg" 
         style="max-width: 50%; height: auto; display: block; margin: 0 auto;">
</div>
        </div>
    </div>
</section>

<!-- Featured Products Section -->
<section class="featured-products py-5 bg-dark">
    <div class="container">
        <h2 class="text-center text-warning">Explore are Products</h2>
        <div class="row">
            <!-- Product 1: Premium Honey -->
            <div class="col-md-4">
                <div class="card product-card">
                    <img src="images/honey.jpg" alt="Premium Honey" class="card-img-top">
                    <div class="card-body text-center">
                        <h5 class="card-title">Premium Honey - 500g</h5>
                        <p class="card-text" style="color:white !important;">Pure, raw, and organic honey sourced from the best beekeepers.</p>
                        <a href="shop.php" class="btn btn-warning">Shop Now</a>
                    </div>
                </div>
            </div>
            <!-- Product 2: Palosa Honey -->
            <div class="col-md-4">
                <div class="card product-card">
                    <img src="images/palosa.jpg" alt="Palosa Honey" class="card-img-top">
                    <div class="card-body text-center">
                        <h5 class="card-title">Palosa Honey - 500g</h5>
                        <p class="card-text" style="color:white !important;">A unique floral honey with a delightful taste, perfect for daily use.</p>
                        <a href="shop.php" class="btn btn-warning">Shop Now</a>
                    </div>
                </div>
            </div>
            <!-- Product 3: Extra Virgin Olive Oil -->
            <div class="col-md-4">
                <div class="card product-card">
                    <img src="images/olive-oil.jpg" alt="Extra Virgin Olive Oil" class="card-img-top">
                    <div class="card-body text-center">
                        <h5 class="card-title">Extra Virgin Olive Oil - 500ml</h5>
                        <p class="card-text" style="color:white !important;">Cold-pressed, 100% pure olive oil for a healthy lifestyle.</p>
                        <a href="shop.php" class="btn btn-warning">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Best Sellers Section -->
<section class="featured-products py-5 bg-light">
    <div class="container">
        <h2 class="text-center text-dark mb-4">Best Sellers</h2>

        <div class="row justify-content-center">
            <!-- Product 1 -->
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card product-card shadow">
                    <img src="images/palosa.jpg" class="card-img-top" alt="Best Seller Product 1">
                    <div class="card-body text-center">
                        <h5 class="card-title">Natural Honey 500g</h5>
                        <p class="card-text text-muted">
                            Pure & raw honey – customer favorite.
                        </p>
                        <a href="shop.php" class="btn btn-warning">View Product</a>
                    </div>
                </div>
            </div>

            <!-- Product 2 -->
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card product-card shadow">
                    <img src="images/irani-dates.jpeg" class="card-img-top" alt="Best Seller Product 2">
                    <div class="card-body text-center">
                        <h5 class="card-title">Irani Dates</h5>
                        <p class="card-text text-muted">
                            Fresh & premium quality dates.
                        </p>
                        <a href="shop.php" class="btn btn-warning">View Product</a>
                    </div>
                </div>
            </div>

            <!-- Product 3 -->
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card product-card shadow">
                    <img src="images/desi-ghee.jpeg" class="card-img-top" alt="Best Seller Product 3">
                    <div class="card-body text-center">
                        <h5 class="card-title">Desi Ghee</h5>
                        <p class="card-text text-muted">
                            Traditional & pure desi ghee.
                        </p>
                        <a href="shop.php" class="btn btn-warning">View Product</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>





<section class="how-it-works py-5 bg-light">
    <div class="container">
        <h2 class="text-center text-dark">How We Do It</h2>
        <div class="row text-center">
            <!-- Step 1: Harvesting -->
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm hover-zoom">
                    <img src="images/harvesting.jpg" class="card-img-top img-fluid" alt="Harvesting">
                    <div class="card-body">
                        <i class="bi bi-flower3 text-warning" style="font-size: 50px;"></i>
                        <h5 class="card-title" style="color:white !important;">Harvesting</h5>
                        <p class="card-text" style="color:white !important;">We source our honey from the best beekeepers who use sustainable and ethical methods to harvest the honey.</p>
                    </div>
                </div>
            </div>
            <!-- Step 2: Packaging -->
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm hover-zoom">
                    <img src="images/packaging.jpg" class="card-img-top img-fluid" alt="Packaging">
                    <div class="card-body">
                        <i class="bi bi-basket text-warning" style="font-size: 50px;"></i>
                        <h5 class="card-title" style="color:white !important;">Packaging</h5>
                        <p class="card-text" style="color:white !important;">Once harvested, we carefully package the honey to ensure it remains fresh and retains its natural flavor.</p>
                    </div>
                </div>
            </div>
            <!-- Step 3: Delivery -->
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm hover-zoom">
                    <img src="images/delivery.jpg" class="card-img-top img-fluid" alt="Delivery">
                    <div class="card-body">
                        <i class="bi bi-truck text-warning" style="font-size: 50px;"></i>
                        <h5 class="card-title" style="color:white !important;">Delivery</h5>
                        <p class="card-text" style="color:white !important;">Your honey is delivered to your doorstep with utmost care and attention. We offer flexible shipping options.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Customer Reviews Section -->
<section class="customer-reviews py-5 bg-light">
    <div class="container">
        <h2 class="text-center text-dark">What Our Customers Say</h2>
        <div class="row">

            <div class="col-md-4">
                <div class="card text-center p-3" style="color:white;">
                    <img src="images/customer1.jpg" alt="Customer 1" class="rounded-circle" style="width: 80px; height: 80px;">
                    <div class="card-body">
                        <p class="card-text text-dark" style="color:white !important;">"The honey is absolutely amazing! It's pure and sweet, and I can taste the difference. Highly recommended!"</p>
                        <h5 class="card-title text-dark" style="color:white !important;">Sarah L.</h5>
                    </div>
                </div>
            </div>
            <!-- Review 2 -->
            <div class="col-md-4">
                <div class="card text-center p-3">
                    <img src="images/customer2.jpg" alt="Customer 2" class="rounded-circle" style="width: 80px; height: 80px;">
                    <div class="card-body">
                        <p class="card-text text-dark" style="color:white !important;">"Al_NAHL's honey is the best I've ever had. It’s so fresh and delicious. I’ll definitely be ordering again!"</p>
                        <h5 class="card-title text-dark" style="color:white !important;">John D.</h5>
                    </div>
                </div>
            </div>
            <!-- Review 3 -->
            <div class="col-md-4">
                <div class="card text-center p-3">
                    <img src="images/customer3.jpg" alt="Customer 3" class="rounded-circle" style="width: 80px; height: 80px;">
                    <div class="card-body">
                        <p class="card-text text-dark" style="color:white !important;">"Fantastic quality honey. You can really tell it's organic. It’s a staple in our house now!"</p>
                        <h5 class="card-title text-dark" style="color:white !important;">Alice P.</h5>
                    </div>
                    
                    <div class="text-center mt-4">
  <a href="reviews.php" class="btn btn-outline-dark">
    View All Reviews
  </a>
</div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Call to Action Section -->
<section class="cta-section text-center py-5 bg-warning text-light">
    <div class="container">
        <h2 class="display-4">Ready to Taste the Sweetness?</h2>
        <p class="lead">Order your favorite honey today and experience the pure, unfiltered goodness!</p>
        <a href="shop.php" class="btn btn-dark btn-lg">Shop Now</a>
    </div>
</section>


<section class="newsletter py-5 bg-dark text-white">
    <div class="container text-center">
        <h2>Stay Updated with Al_NAHL</h2>
        <p>Sign up for our newsletter and be the first to know about new products, exclusive offers, and more.</p>
        <form action="#" method="POST">
            <input type="email" class="form-control mb-3" placeholder="Enter your email" required>
            <button type="submit" class="btn btn-warning">Subscribe</button>
        </form>
    </div>
</section>

<section class="faq py-5">
    <div class="container">
        <h2 class="text-center" >Frequently Asked Questions</h2>
        <div class="accordion" id="faqAccordion">
            <!-- Question 1 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="faqOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        What is the shelf life of your honey?
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="faqOne" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Our honey has a long shelf life and can be stored for up to two years. Just keep it in a cool, dry place!
                    </div>
                </div>
            </div>
            <!-- Question 2 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="faqTwo">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Do you offer international shipping?
                    </button>
                     <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="faqTwo" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Currently, we only offer shipping within Pakistan, but we’re working on expanding our delivery options!
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer Section -->
<footer class="bg-dark text-white py-5">
    <div class="container">
        <div class="row text-center text-md-start">

            <!-- Contact -->
            <div class="col-md-4 mb-4">
                <h5 class="text-warning mb-3">Contact Us</h5>
                <p class="mb-1">Email: info@alnahlhoney.com</p>
                <p class="mb-1">Phone: +92 331 2041608</p>
                <p class="mb-0">Address: R338 Block 8, Azizabad, Karachi</p>
            </div>

            <!-- Social -->
            <div class="col-md-4 mb-4 text-center">
                <h5 class="text-warning mb-3">Follow Us</h5>
                <div class="d-flex justify-content-center gap-3">
                    <a href="https://www.facebook.com/ALNAHL.official" class="footer-icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="https://wa.me/03312041608" class="footer-icon"><i class="fa-brands fa-whatsapp"></i></a>
                    <a href="https://www.linkedin.com/company/al-nahl/" class="footer-icon"><i class="fa-brands fa-linkedin-in"></i></a>
                    <a href="https://www.instagram.com/al_nahl_2025" class="footer-icon"><i class="fa-brands fa-instagram"></i></a>
                    <a href="https://youtube.com/@alnahl-20" class="footer-icon"><i class="fa-brands fa-youtube"></i></a>
                    <a href="https://www.tiktok.com/@al.nahl" class="footer-icon"><i class="fa-brands fa-tiktok"></i></a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-md-4 mb-4">
                <h5 class="text-warning mb-3">Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="about.php" class="footer-link">About Us</a></li>
                    <li><a href="contact.php" class="footer-link">Contact</a></li>
                    <li><a href="shop.php" class="footer-link">Shop</a></li>
                    <li><a href="blogs.php" class="footer-link">Blog</a></li>
                </ul>
            </div>

        </div>

        <!-- Bottom -->
        <div class="text-center border-top pt-3 mt-3">
            <div id="google_translate_element" class="mb-2"></div>
            <p class="mb-0 small">&copy; 2025 Al_NAHL Honey Store. All Rights Reserved.</p>
        </div>
    </div>
    
    <script type="text/javascript">
function googleTranslateElementInit() {
    new google.translate.TranslateElement(
        { pageLanguage: 'en' },
        'google_translate_element'
    );
}
</script>

<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

</footer>