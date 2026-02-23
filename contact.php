<?php

// Form handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Simple validation
    if (!empty($name) && !empty($email) && !empty($message)) {
        // Save or send the message (this can be extended to send an email or store in database)
        echo "<p class='success-message'>Thank you for contacting us, we will get back to you shortly!</p>";
    } else {
        echo "<p class='error-message'>Please fill in all the fields.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Al_NAHL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/contact.css"> <!-- Separate CSS file for this page -->
</head>
<style>
    /* GLOBAL RESPONSIVE FIXES */
* {
    box-sizing: border-box;
}

html, body {
    width: 100%;
    overflow-x: hidden;
}

/* IMAGES */
img {
    max-width: 100%;
    height: auto;
}

/* TABLES */
table {
    width: 100%;
    overflow-x: auto;
    display: block;
}

/* FORMS */
input, select, textarea, button {
    max-width: 100%;
}

/* FLEX FIX */
.row {
    margin-left: 0;
    margin-right: 0;
}

/* RESPONSIVE CONTAINERS */
.container, .container-fluid {
    padding-left: 15px;
    padding-right: 15px;
}

/* MOBILE */
@media (max-width: 768px) {
    h1 { font-size: 26px; }
    h2 { font-size: 22px; }
    h3 { font-size: 18px; }

    .btn {
        width: 100%;
        margin-bottom: 10px;
    }

    nav ul {
        flex-direction: column;
        width: 100%;
    }

    nav ul li {
        width: 100%;
        text-align: center;
    }
}

/* EXTRA SMALL DEVICES */
@media (max-width: 480px) {
    body {
        font-size: 14px;
    }

    .card {
        margin-bottom: 15px;
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
              </ul>
          </div>
      </div>
  </nav>

<!-- Contact Form -->
<div class="container mt-5">
    <h1 class="text-center" style="margin-top: 90px;">Contact Us</h1>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="name" class="form-label text-white">Your Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label text-white">Your Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email address" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label text-white">Your Message</label>
                    <textarea class="form-control" id="message" name="message" rows="4" placeholder="Write your message here" required></textarea>
                </div>
                <button type="submit" class="btn btn-warning w-100">Submit</button>
            </form>
        </div>
    </div>
</div>


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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
