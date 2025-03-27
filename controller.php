<?php
    include 'model.php';

    if (empty($_POST['page'])) {  
        header("Location: index.php"); 
        exit();
    } 

    elseif ($_POST['page'] === 'StartPage') {  
        
        switch ($_POST['command']) {
            case 'SignIn':
                if (empty($_POST['username']) || empty($_POST['password'])) {
                    echo "Username and password are required!<br>";
                    exit();
                }
                
                if (isValid($_POST['username'], $_POST['password'])) {
                    header("Location: home.php");
                    exit();
                } else {
                    echo "Invalid username or password.<br>";
                    exit();
                }
            
            case 'Join':  
                if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
                    echo "All fields are required!<br>";
                    exit();
                }

                createUser($_POST['username'], $_POST['password'], $_POST['email']);
                header("Location: home.php");
                exit();
            
            default:
                echo "Unknown command<br>";
                exit();
        }
    }
    else {
        header("Location: index.php");
        exit();
    }
?>
