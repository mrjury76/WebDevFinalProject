<?php
    include 'model.php';

    $page = $_POST['page'];
    $command = $_POST['command'];

    if (empty($page)) {  
        include("index.php"); 
        exit();
    } 

    elseif ($page === 'StartPage') {  // If the data came from StartPage
        
        switch ($command) {
            case 'SignIn':  // SignIn case
                echo 'Username = ' . $_POST['username'] . ', Password = ' . $_POST['password'] . '<br>';
                
                if (isValid($_POST['username'], $_POST['password'])) {  // isValid() is defined in model.php
                    echo 'Valid username and password<br>';
                    include 'home.php';
                } else {
                    echo 'Invalid username and password<br>';
                }
                
                exit();  // or break when there is something more to do after switch
            
            case 'Join':  
                // echo 'Sign-up functionality is not implemented yet.<br>';
                createUser($_POST['username'], $_POST['password'], $_POST['email']);  // createUser() is defined in model.php
                include 'home.php';
                exit();
            
            // case 'ForgotPassword':
            //     // Handle password reset logic here
            //     echo 'Forgot password functionality is not implemented yet.<br>';
            //     exit();
            
            default:
                echo 'Unknown command<br>';
                exit();
        }
    }
    else {
        include 'index.php';
    }

?>
