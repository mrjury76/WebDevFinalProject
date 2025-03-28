<?php
    $conn = mysqli_connect('localhost', 'w3pthrower', 'w3pthrower136', 'C354_w3pthrower');  
    if (!$conn) {
        echo 'Could not connect: ' . mysqli_connect_error();
    }
    
function createUser($username, $pwd, $email) { 
    global $conn;
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        return;
    }
    else {
        $sql = "INSERT INTO Users (username, pwd, email) VALUES ('$username', '$hashedPwd', '$email')";
        if (mysqli_query($conn, $sql)) {
            mysqli_close($conn);
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
}

function isValid($u, $p) {
    $conn = mysqli_connect('localhost', 'w3pthrower', 'w3pthrower136', 'C354_w3pthrower');  
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        return false;
    }

    elseif (!empty($u) && !empty($p)) {
        $sql = "SELECT pwd FROM Users WHERE username='$u'";
        $result = mysqli_query($conn, $sql);
        
        if ($result && mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($p, $row['pwd'])) {
                mysqli_close($conn);
                return true;
            }
        }
    }
    else{
        mysqli_close($conn);
        return false;
    }
}

function getRandomValue($column) {
    $conn = mysqli_connect('localhost', 'w3pthrower', 'w3pthrower136', 'C354_w3pthrower');  
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    } else {
        $sql = "SELECT `$column` FROM NPCs ORDER BY RAND() LIMIT 1";
        $result = mysqli_query($conn, $sql);
        
        if ($result && mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            return $row[$column];
        }
    }
    mysqli_close($conn);
    return null;
}

function createEntry($title, $content) {
    global $conn;
    $username = $_SESSION['username'];
    $sql = "INSERT INTO journals (title, content, username) VALUES ('$title', '$content', '$username')";
    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

?>
