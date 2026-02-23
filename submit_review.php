<?php
session_start();
include "php/db.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $product_id = $_POST['product_id'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];
    $user_id = $_SESSION['user_id'] ?? 0; // Get user ID from session

    if ($user_id == 0) {
        die("Error: You must be logged in to submit a review.");
    }

    $stmt = $conn->prepare("INSERT INTO reviews (product_id, user_id, rating, comment) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiis", $product_id, $user_id, $rating, $comment);
    $stmt->execute();
    $stmt->close();

    header("Location: product_detail.php?id=$product_id");
    exit();
}

?>
