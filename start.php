   
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

            <button type="submit">Sign In</button>
        </form>

        <p>Don't have an account?</p>
        <form action="controller.php" method="post">
            <input type="hidden" name="page" value="Header">
            <input type="hidden" name="command" value="Register">
            <button id="header" type="submit">Register</button>
        </form>
    </div>
    
    
</body>
</html>
