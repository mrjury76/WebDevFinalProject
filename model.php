<?php
    $conn = mysqli_connect('localhost', 'w3pthrower', 'w3pthrower136', 'C354_w3pthrower');  
    if (!$conn) {
        die('Could not connect: ' . mysqli_connect_error());
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
                echo "<script>alert('Youve reached the isvalid function')</script>";
                return true;
            }
        }
    }
    else{
        echo "<script>alert('Invalid username or password!')</script>";
        mysqli_close($conn);
        return false;
    }
}

function generateNPC() {
    $conn = mysqli_connect('localhost', 'w3pthrower', 'w3pthrower136', 'C354_w3pthrower');  
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        return;
    }

    function getRandomValue($conn, $column, $table) {
        $sql = "SELECT `$column` FROM `$table` ORDER BY RAND() LIMIT 1";
        $result = mysqli_query($conn, $sql);
        if ($result && mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            return $row[$column];
        }
        return "Unknown";
    }

    $fname = getRandomValue($conn, 'fname', 'NPCs');
    $lname = getRandomValue($conn, 'lname', 'NPCs');
    $race = getRandomValue($conn, 'race', 'NPCs');
    $class = getRandomValue($conn, 'class', 'NPCs');
    $quirk = getRandomValue($conn, 'quirk', 'NPCs');
    $alignment = getRandomValue($conn, 'alignment', 'NPCs');
    $motivation = getRandomValue($conn, 'motivation', 'NPCs');

    echo "<div class='npc'>";
    echo "<h1 class='npc'>Random NPC:</h1>";
    echo "<ul>";
    echo "<li><p>First Name:</p> $fname</li>";
    echo "<li><p>Last Name:</p> $lname</li>";
    echo "<li><p>Race:</p> $race</li>";        
    echo "<li><p>Class:</p> $class</li>";
    echo "<li><p>Quirk:</p> $quirk</li>";
    echo "<li><p>Alignment:</p> $alignment</li>";
    echo "<li><p>Motivation:</p> $motivation</li>";
    echo "<br>";
    echo "</ul>";
    echo "</div>";

    mysqli_close($conn);
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
