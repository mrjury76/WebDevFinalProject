<?php
function createUser($username, $pwd, $email) { 
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    $conn = mysqli_connect('localhost', 'w3pthrower', 'w3pthrower136', 'C354_w3pthrower');  
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        return;
    }

    // Insert user into table
    $sql = "INSERT INTO Users (username, pwd, email) VALUES ('$username', '$hashedPwd', '$email')";
    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        include 'home.php';
        exit(); // Prevent further execution
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}

function isValid($u, $p) {
    $conn = mysqli_connect('localhost', 'w3pthrower', 'w3pthrower136', 'C354_w3pthrower');  
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        return false;
    }

    // Escape username input
    $u = mysqli_real_escape_string($conn, $u);

    $sql = "SELECT pwd FROM Users WHERE username='$u'";
    $result = mysqli_query($conn, $sql);
    
    if ($result && mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($p, $row['pwd'])) {
            mysqli_close($conn);
            header("Location: home.php");
            exit();
        }
    }

    mysqli_close($conn);
    return false;
}

function generateNPC() {
    $conn = mysqli_connect('localhost', 'w3pthrower', 'w3pthrower136', 'C354_w3pthrower');  
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        return;
    }

    $sql = "SELECT * FROM NPCs ORDER BY RAND() LIMIT 1";
    $result = mysqli_query($conn, $sql);
    
    if ($result && mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        echo "<div>";
        echo "<h2>NPC:</h2>";
        echo "<ul>";
        echo "<li>Name: " . $row['name'] . "</li>";
        echo "<li>Class: " . $row['class'] . "</li>";
        echo "<li>Quirk: " . $row['quirk'] . "</li>";
        echo "</ul>";
        echo "</div>";
    }

    mysqli_close($conn);
}
?>
