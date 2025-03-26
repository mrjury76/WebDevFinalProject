<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="public/styles.css">
    <link rel="icon" href="public/images/incon.webp" type="image/webp">

</head>
<body>
    <div class="login-container">
        <h1>Sign In</h1>
        <form action="controller.php" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Sign In</button>
            <a href="views\register.php">Register</a>
        </form>
    </div>
</body>
</html>

<?php
// Start the session
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Include the controller file
    require '/controller.php';

}
?>
