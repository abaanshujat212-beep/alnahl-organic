<?php
// Connect to the database
$conn = new mysqli("localhost", "u992936863_al_nahl", "9WEO@2ScoW!c", "u992936863_al_nahl_store");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

// Fetch blogs without filtering by language
$sql = "SELECT * FROM blogs ORDER BY created_at DESC";
$result = $conn->query($sql);

// Error handling
if (!$result) {
    die("Error fetching blogs: " . $conn->error);
}
?>
<!DOCTYPE html><html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us - Al Nahl Organic</title>
  <link rel="stylesheet" href="abut.css">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>


  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      line-height: 1.7;
      color: #333;
    }
    .container {
      max-width: 1200px;
      margin: auto;
      padding: 60px 20px;
    }
    .section {
      display: flex;
      align-items: center;
      gap: 40px;
      margin-bottom: 80px;
    }
    .section.reverse {
      flex-direction: row-reverse;
    }
    .section.center {
      flex-direction: column;
      text-align: center;
    }
    .section img {
      width: 100%;
      max-width: 480px;
      border-radius: 12px;
    }
    .content h2 {
      font-size: 32px;
      margin-bottom: 20px;
      color: #2f5d3a;
    }
    .content p {
      font-size: 16px;
      margin-bottom: 16px;
    }
    @media (max-width: 768px) {
      .section, .section.reverse {
        flex-direction: column;
        text-align: center;
      }
    }
  </style>
</head>
<body>

<div class="container">

  <!-- Section 1 -->
  <div class="section">
    <img src="images/shop.jpg" alt="Al Nahl Organic Shop">
    <div class="content">
      <h2>Our Beginning</h2>
      <p>
        Al Nahl Organic was born from a simple family concern — the lack of truly pure and trustworthy food products in today’s markets. What started as a small family effort soon transformed into a purpose-driven brand focused on honesty, purity, and natural living.
      </p>
      <p>
        The name <strong>Al Nahl</strong> means “The Honey Bee” — a symbol of purity, discipline, and benefit to humanity. Just like the bee, we believe in providing only what is beneficial, natural, and pure.
      </p>
    </div>
  </div>

  <!-- Section 2 -->
  <div class="section reverse">
    <img src="images/family.jpg" alt="Al Nahl Family">
    <div class="content">
      <h2>A Family-Run Business</h2>
      <p>
        Al Nahl Organic is proudly managed by our family. Our father’s guidance, our brothers’ dedication, and our shared values form the backbone of this brand.
      </p>
      <p>
        Being a family business means every product carries our name, our reputation, and our responsibility. We work together daily to ensure consistency, quality, and trust.
      </p>
    </div>
  </div>

  <!-- Section 3 -->
  <div class="section">
    <img src="images/work.jpg" alt="Daily Work at Al Nahl">
    <div class="content">
      <h2>Hands-On & Honest Work</h2>
      <p>
        From sourcing to packaging, every step is handled with care. We believe quality is not claimed — it is practiced daily through honest work and attention to detail.
      </p>
      <p>
        Our team personally checks products, seals bottles, and prepares orders so that what reaches you meets our own household standards.
      </p>
    </div>
  </div>

  <!-- Section 4 -->
  <div class="section reverse">
    <img src="images/honey.jpg" alt="Pure Honey">
    <div class="content">
      <h2>Our Product Philosophy</h2>
      <p>
        Each Al Nahl product is selected with one principle in mind: nourishment without compromise. Our honey, oils, ghee, tea, and salts are chosen to retain their natural taste, aroma, and benefits.
      </p>
      <p>
        We avoid unnecessary processing and additives, keeping products as close to their natural form as possible.
      </p>
    </div>
  </div>

  <!-- Section 5 -->
  <div class="section center">
    <div class="content">
      <h2>Our Commitment to Trust</h2>
      <p>
        Trust is the foundation of Al Nahl Organic. We remain transparent about sourcing, handling, and usage because we believe honesty builds long-term relationships.
      </p>
      <p>
        When you choose Al Nahl Organic, you’re not just buying a product — you’re supporting a family that values integrity above all.
      </p>
    </div>
  </div>

  <!-- Section 6 -->
  <div class="section center">
    <div class="content">
      <h2>Looking Ahead</h2>
      <p>
        Our vision is to grow responsibly while staying true to our roots. We aim to expand our product range, improve sustainability, and educate our community about natural living.
      </p>
      <p>
        From our family to yours — thank you for trusting Al Nahl Organic.
      </p>
    </div>
  </div>

</div>

</body>
</section><!-- Bootstrap JS --><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script></body>
</html>