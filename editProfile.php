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
        <h2>Edit Your Profile</h2>
        <form action="updateProfile.php" method="POST">
            <input type="hidden" name="page" value="StartPage">
            <input type="hidden" name="command" value="UpdateProfile">
            
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
            
            <button type="submit">Save Changes</button>
        </form>
    </div>


    <?php include 'footer.php'?>
</body>
</html>