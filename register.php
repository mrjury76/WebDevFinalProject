<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="public/styles.css">
    <link rel="icon" href="images/icon.webp" type="image/webp">
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <form action="controller.php" method="POST">
            <input type="hidden" name="page" value="StartPage">
            <input type="hidden" name="command" value="Join">

            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            
            <button id="submit" type="submit">Register</button>
            <br>
    </div>

    <script>

        $(document).ready(function() {
            pass
            $('#submit').on('click', function(eobj) {
            let password = $('#password').val();
            let confirmPassword = $('#confirm_password').val();
            if (password !== confirmPassword) {
                eobj.preventDefault();
                alert('Passwords do not match!');
                <?php include 'index.php'; ?>
            }
            });
        });
    </script>

    <?php include 'footer.php'; ?>
</body>
</html>
