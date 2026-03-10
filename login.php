<?php
include "db.php";
session_start();

// Redirect logged-in users
if (isset($_SESSION["user_id"])) {
    header("Location: ../index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $password = trim($_POST["password"]);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } else {
        $sql = "SELECT id, name, password FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $stmt->bind_result($id, $username, $hashed_password);
                $stmt->fetch();

                if (password_verify($password, $hashed_password)) {
                    // Regenerate session ID for security
                    session_regenerate_id(true);

                    $_SESSION["user_id"] = $id;
                    $_SESSION["username"] = $username;

                    header("Location: ../index.php");
                    exit();
                } else {
                    $error = "Invalid email or password.";
                }
            } else {
                $error = "User not found.";
            }

            $stmt->close();
        } else {
            $error = "Database error: " . $conn->error;
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        
        <?php if (isset($error)) : ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="post">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="register.php">Register</a></p>
    </div>
</body>
</html>
