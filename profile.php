<div class="profile-container">
    <img id="profile" src="public/images/profilePic.webp">
    <div id="profile-div">
        <h1 id="profile-h1">Welcome <?php echo isset($_COOKIE['username']) ? htmlspecialchars($_COOKIE['username']) : 'Guest'; ?></h1>
        <form action="controller.php" method="post">
            <input type="hidden" name="page" value="StartPage">
            <button type="submit" name="command" value="Logout">Logout</button>
            <button id="delete" type="submit" name="command" value="_DELETE">DELETE USER</button>
        </form>
    </div>
</div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            console.log("Welcome <?php echo isset($_COOKIE['username']) ? htmlspecialchars($_COOKIE['username']) : 'Guest'; ?>");
            let container = document.querySelector(".profile-container");
            let profile = document.getElementById("profile");
            let profileDiv = document.getElementById("profile-div");
            let deleteButton = document.getElementById("delete");

            profile.addEventListener("click", function () {
                if (profileDiv.style.display === "block") {
                    profileDiv.style.display = "none";
                } else {
                    profileDiv.style.display = "block";
                }
            });


            container.addEventListener("mouseleave", function () {
                profileDiv.style.display = "none";
            });

            deleteButton.addEventListener("click", function (event) {
                let confirmDelete = confirm("Are you sure you want to delete your account? This action cannot be undone.");
                if (!confirmDelete) {
                    event.preventDefault();
                }
            });
        });
    </script>