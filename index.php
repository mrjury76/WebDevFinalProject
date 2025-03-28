<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="public/styles.css">
    <link rel="icon" href="public/images/icon.webp" type="image/webp">
</head>
<body>
    <div class="login-container">
        <h1>Sign In</h1>
        <form action="controller.php" method="post">
            <input type="hidden" name="page" value="StartPage">
            <input type="hidden" name="command" value="SignIn">
            
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <label for="remember_me">Remember Me:</label>
            <input type="checkbox" name="remember_me" id="remember_me">

            <button type="submit">Sign In</button>
        </form>

        <p>Don't have an account?</p>
        <form method="post" action="controller.php">
            <button id="header" type="submit" name="command" value="Register">Register</button>
        </form>
    </div>
    <!-- <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require 'controller.php';

        if (isset($_POST['username'], $_POST['password']) && isValid($_POST['username'], $_POST['password'])) {
            $_SESSION['username'] = $_POST['username'];
            exit();
        } else {
            $error = "Invalid username or password.";
        }
    }
?> -->
</body>
</html>
