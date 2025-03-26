username VARCHAR(30) NOT NULL,

<?php
    function createUser($username, $pwd, $email){ 
        $conn = mysqli_connect('localhost', 'w3pthrower', 'w3pthrower136', 'C354_w3pthrower');  
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            return;
        }
    
        $sql = "CREATE TABLE IF NOT EXISTS Users (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(30) NOT NULL UNIQUE,
            pwd VARCHAR(255) NOT NULL,
            email VARCHAR(50) NOT NULL UNIQUE,
            reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
    
        if (mysqli_query($conn, $sql)) {
            echo "Table Users created successfully";
        } else {
            echo "Error creating table: " . mysqli_error($conn);
        }
    
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
        $sql = "INSERT INTO Users (username, pwd) VALUES ('$username', '$hashedPwd')";
        if (mysqli_query($conn, $sql)) {
            echo "New user created successfully";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    
        mysqli_close($conn);
    
    }

    function isValid($u, $p) {
        // $servername = "localhost";
        // $username = "w3pthrower";
        // $password = "w3pthrower136";
        // $dbname = "C354_w3pthrower";

        $conn = mysqli_connect('localhost', 'w3pthrower', 'w3pthrower136', 'C354_w3pthrower');  
        if (mysqli_connect_errno())  // or if (!$conn)
            echo "Failed to connect to C354_test: " . mysqli_connect_error();
        else
            echo "Succeeded to connect to C354_test";
        //code here

        if (mysqli_query($conn, $sql))
            echo 'Table Persons created';
        else
            echo 'Error creating table: ' . mysqli_error($conn);
        mysqli_close($conn);


        return $isValid;
    }
?>