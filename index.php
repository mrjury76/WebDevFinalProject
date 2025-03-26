<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="../public/styles.css">
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
            <button type="button">Register</button>
        </form>
    </div>
</body>
</html>

<?php
// Start the session
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the submitted form data
    $submittedUsername = $_POST['username'];
    $submittedPassword = $_POST['password'];

    // Include the controller file
    require_once '/controller.php';

    if ($isAuthenticated) {
        // Set session variables
        $_SESSION['username'] = $submittedUsername;
        // Redirect to a protected page
        header('Location: /dashboard.php');
        exit;
    } else {
        $error = 'Invalid username or password';
    }
    if ($submittedUsername === $username && $submittedPassword === $password) {
        // Set session variables
        $_SESSION['username'] = $submittedUsername;
        // Redirect to a protected page
        header('Location: /dashboard.php');
        exit;
    } else {
        $error = 'Invalid username or password';
    }
}
?>
