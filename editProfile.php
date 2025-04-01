<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="public/styles.css">
    <link rel="icon" href="public/images/icon.webp" type="image/webp">
</head>
<body>
    <?php include 'header.php'?>
    <?php include 'profile.php'?>
    <div class="edit-profile-form">
        <h1>Edit Your Profile</h1>
        <form action="controller.php" method="POST">
            <input type="hidden" name="page" value="StartPage">
            <input type="hidden" name="command" value="UpdateProfile">
            
            <table>
            <tr>
                <th><label for="username">Username:</label></th>
                <td><input type="text" id="username" name="username" value="<?php echo htmlspecialchars($_COOKIE['username']); ?>" required></td>
            </tr>
            <tr>
                <th><label for="email">Email:</label></th>
                <td><input type="email" id="email" name="email" required></td>
            </tr>
            <tr>
                <th><label for="password">Password:</label></th>
                <td><input type="password" id="password" name="password" pattern="(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,}"required></td>
            </tr>
            <tr>
                <th><label for="confirm_password">Confirm Password:</label></th>
                <td><input type="password" id="confirm_password" name="confirm_password" pattern="(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,}"required></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">
                <button style="width: 180px;"type="submit">Save Changes</button>
                </td>
            </tr>
            </table>
        </form>
    </div>


    <?php include 'footer.php'?>
</body>
</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
        $('form').on('submit', function(e) {
            let password = $('#password').val();
            let confirmPassword = $('#confirm_password').val();
            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Passwords do not match!');
            }
        });
