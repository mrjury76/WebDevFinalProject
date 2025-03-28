<a href="profile.php" class="profile-icon">
    <img id="profile" src="public/images/profilePic.webp" alt="Profile Icon">
</a>
<div id="profile-div">
    <p>Welcome <?php echo $_COOKIE['username']; ?></p>
    <button id="logout" type="submit" name="command" value="Logout">Logout</button>
    <button id="settings" type="button">Settings</button>
</div>