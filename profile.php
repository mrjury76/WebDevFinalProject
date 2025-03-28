<div class="profile-container">
    <img id="profile" src="public/images/profilePic.webp">
    <div id="profile-div">
        <p>Welcome <?php echo $_COOKIE['username']; ?></p>
        <button id="logout" type="button">Logout</button>
        <button id="settings" type="button">Settings</button>
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