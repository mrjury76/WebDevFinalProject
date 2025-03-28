<?php
    $conn = mysqli_connect('localhost', 'w3pthrower', 'w3pthrower136', 'C354_w3pthrower');  
    if (!$conn) {
        echo "<script>console.error('Could not connect: ' . mysqli_connect_error());</script>";
        exit();
    }
    
function createUser($username, $pwd, $email) { 
    global $conn;
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    if (mysqli_connect_errno()) {
        echo "<script>console.error('Failed to connect to MySQL: " . mysqli_connect_error() . "');</script>";
        return;
    }
    else {
        $sql = "INSERT INTO Users (username, pwd, email) VALUES ('$username', '$hashedPwd', '$email')";
        if (mysqli_query($conn, $sql)) {
            mysqli_close($conn);
            exit();
        } else {
            echo "<script>console.error('Error: " . mysqli_error($conn) . "');</script>";
        }
    }

    mysqli_close($conn);
}

function isValid($u, $p) {
    $conn = mysqli_connect('localhost', 'w3pthrower', 'w3pthrower136', 'C354_w3pthrower');  
    if (mysqli_connect_errno()) {
        echo "<script>console.error('Failed to connect to MySQL: " . mysqli_connect_error() . "');</script>";
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
        echo "<script>console.error('Failed to connect to MySQL: " . mysqli_connect_error() . "');</script>";
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
    $username = $_COOKIE['username'];
    $sql = "INSERT INTO journals (title, content, username) VALUES ('$title', '$content', '$username')";
    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        return true;
    } else {
        return false;
    }
}

function deleteUser($username) {
    global $conn;
    $sql = "DELETE FROM Users WHERE username='$username'";
    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        return true;
    } else {
        return false;
    }
}

function queryEntries($username) {
    global $conn;

    $sql = "SELECT title, content, date_created FROM journals WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    
    $entries = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $entries[] = [
            'title' => $row['title'],
            'content' => $row['content'],
            'created_date' => $row['date_created']
        ];
    }

    return $entries;
}


?>
