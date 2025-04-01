<?php
    $conn = mysqli_connect('localhost', 'w3pthrower', 'w3pthrower136', 'C354_w3pthrower');
    if (!$conn) {
        echo "<script>console.error('Could not connect: ' . mysqli_connect_error());</script>";
        exit();
    }
    
function createUser($username, $pwd, $email) { 
    global $conn;

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (USERNAME, PWD, EMAIL, JOIN_DATE) VALUES ('$username', '$hashedPwd', '$email', SYSDATE())";
    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        return true;
    } else {
        echo "<script>console.error('ErrorMODEL: " . mysqli_error($conn) . "');</script>";
        mysqli_close($conn);
        return false;
    }
}

function isValid($u, $p) {
    global $conn;

    if (mysqli_connect_errno()) {
        echo "<script>console.error('Failed to connect to MySQL: " . mysqli_connect_error() . "');</script>";
        return false;
    }

    if (!empty($u) && !empty($p)) {
        $sql = "SELECT PWD FROM users WHERE username='$u'";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($p, $row['PWD'])) {
                return true;
            } else {
                return false;
            }
        }
    }

    return false;
}

function getRandomValue($column) {
    global $conn; // = mysqli_connect('localhost', 'w3pthrower', 'w3pthrower136', 'C354_w3pthrower');  
    if (mysqli_connect_errno()) {
        echo "<script>console.error('Failed to connect to MySQL: " . mysqli_connect_error() . "');</script>";
    } else {
        $sql = "SELECT `$column` FROM npcs ORDER BY RAND() LIMIT 1";
        $result = mysqli_query($conn, $sql);
        
        if ($result && mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            echo "<script>console.log('SUCCESS!');</script>";
            return $row[$column];
        }
    }
    mysqli_close($conn);
    exit(); //        return null;
}

function createEntry($title, $content) {
    global $conn;
    $username = $_COOKIE['username'];
    $sql = "INSERT INTO journals (username, title, content, date_created) VALUES ('$username', '$title', '$content', SYSDATE())";
    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        return true;
    } else {
        mysqli_close($conn);
        echo "<script>console.error('Error: " . mysqli_error($conn) . "');</script>";
        return false;
    }
}

function deleteUser($username) {
    global $conn;
    $sql = "DELETE FROM users WHERE username='$username'";
    if (mysqli_query($conn, $sql)) {
        echo "<script>console.log('Deleting user...');</script>";

        $sql = "DELETE FROM journals WHERE username='$username'";
        echo "<script>console.log('Deleting journals...');</script>";
        mysqli_query($conn, $sql);

        $sql = "DELETE FROM characters WHERE username='$username'";
        echo "<script>console.log('Deleting characters...');</script>";
        mysqli_query($conn, $sql);
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
    mysqli_close($conn);

    return $entries;
}

function queryCharacter($username) {
    global $conn;

    $sql = "SELECT name, level, class, race, str, dex, con, intc, wis, cha FROM characters WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
    } else {
        echo "<script>console.error('Error querying character: " . mysqli_error($conn) . "');</script>";
    }
    
    $character = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $character[] = [
                'name' => $row['name'],
                'level' => $row['level'],
                'class' => $row['class'],
                'race' => $row['race'],
                'str' => $row['str'],
                'dex' => $row['dex'],
                'con' => $row['con'],
                'intc' => $row['intc'],
                'wis' => $row['wis'],
                'cha' => $row['cha'],
            ];
        }
        mysqli_close($conn);

    return $character;
}

function queryCharacterWithID($username) {
    global $conn;

    $sql = "SELECT * FROM characters WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $character = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $character[] = [
                'id' => $row['id'],
                'name' => $row['name'],
                'level' => $row['level'],
                'class' => $row['class'],
                'race' => $row['race'],
                'str' => $row['str'],
                'dex' => $row['dex'],
                'con' => $row['con'],
                'intc' => $row['intc'],
                'wis' => $row['wis'],
                'cha' => $row['cha'],
            ];
        }
    } else {
        echo "<script>console.error('Error querying character: " . mysqli_error($conn) . "');</script>";
    }
        mysqli_close($conn);

    return $character;
}


function createCharacter($username, $name, $level, $class, $race, $strength, $dexterity, $constitution, $intelligence, $wisdom, $charisma) {
    global $conn;

    $sql = "INSERT INTO characters (username, name, level, class, race, str, dex, con, intc, wis, cha) 
            VALUES ('$username', '$name', $level, '$class', '$race', $strength, $dexterity, $constitution, $intelligence, $wisdom, $charisma)";
    
    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        return true;
    } else {
        echo "<script>console.error('Error: " . mysqli_error($conn) . "');</script>";
        mysqli_close($conn);
        return false;
    }
}

function deleteCharacter($character, $username){
    global $conn;
    $sql = "DELETE FROM characters WHERE name='$character' AND username='$username'";
    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        return true;
    } else {
        echo "<script>console.error('Error: " . mysqli_error($conn) . "');</script>";
        mysqli_close($conn);
        return false;
    }
}

function queryCharacterById($username, $id) {
    global $conn;
    $sql = "SELECT * FROM characters WHERE username = '$username' AND id = '$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $character = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $character[] = [
                'id' => $row['id'],
                'name' => $row['name'],
                'level' => $row['level'],
                'class' => $row['class'],
                'race' => $row['race'],
                'str' => $row['str'],
                'dex' => $row['dex'],
                'con' => $row['con'],
                'intc' => $row['intc'],
                'wis' => $row['wis'],
                'cha' => $row['cha'],
            ];
        }
    } else {
        echo "<script>console.error('Error querying character: " . mysqli_error($conn) . "');</script>";
    }
        mysqli_close($conn);

    return $character;
}


?>
