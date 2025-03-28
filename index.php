<<<<<<< HEAD
<?php
session_start(); // Start session at the very beginning

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'model.php';

    if (isset($_POST['username'], $_POST['password']) && isValid($_POST['username'], $_POST['password'])) {
        $_SESSION['username'] = $_POST['username']; // Store username in session
        header("Location: home.php");
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}
=======
<?php // Start the session
session_start();
include '/controller.php';
>>>>>>> ae90175b90c8ac26dc78f38c7a77a308eeff38ad
?>

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
        <form action="index.php" method="post">
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

            <button type="submit">Sign In</button>
        </form>

        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>

        <p style="position: relative; bottom: 0; text-align: center;">
            Don't have an account? <a href="views/register.php">Register</a>
        </p>
    </div>
</body>
</html>
<<<<<<< HEAD
=======

<?php

?>
>>>>>>> ae90175b90c8ac26dc78f38c7a77a308eeff38ad
