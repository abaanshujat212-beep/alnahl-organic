<?php
// Database connection code
$servername = "localhost";
$username = "u992936863_al_nahl";
$password = "9WEO@2ScoW!c";
$dbname = "u992936863_al_nahl_store"; // Database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
