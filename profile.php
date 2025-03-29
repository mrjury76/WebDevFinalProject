<div class="profile-container">
    <img id="profile" src="public/images/profilePic.webp">
    <div id="profile-div">
        <p>Welcome <?php echo isset($_COOKIE['username']) ? htmlspecialchars($_COOKIE['username']) : 'Guest'; ?></p>
        <form action="controller.php" method="post">
            <input type="hidden" name="page" value="StartPage">
            <input type="hidden" name="command" value="Logout">
            <button type="submit" id="logout" type="button">Logout</button>
        </form>
    </div>
</div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let container = document.querySelector(".profile-container");
            let profile = document.getElementById("profile");
            let profileDiv = document.getElementById("profile-div");

            profile.addEventListener("click", function () {
                profileDiv.style.display = "block";
            });

            container.addEventListener("mouseleave", function () {
                profileDiv.style.display = "none";
        });
    });

    </script>