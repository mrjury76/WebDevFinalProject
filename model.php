<?php
function createUser($username, $pwd, $email) { 
    $conn = mysqli_connect('localhost', 'w3pthrower', 'w3pthrower136', 'C354_w3pthrower');  
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        return;
    }

    // Escape user input to prevent SQL injection
    $username = mysqli_real_escape_string($conn, $username);
    $email = mysqli_real_escape_string($conn, $email);
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    // Insert user into table
    $sql = "INSERT INTO Users (username, pwd, email) VALUES ('$username', '$hashedPwd', '$email')";
    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        header("Location: home.php");
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
?>
