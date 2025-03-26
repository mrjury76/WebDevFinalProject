<?php
    
    $page = $_POST['page'];
    if ($page === 'StartPage') {  // If the data came from StartPage
        $command = $_POST['command'];
        
        switch ($command) {
            case 'SignIn':  // SignIn case
                echo 'Username = ' . $_POST['username'] . ', Password = ' . $_POST['password'] . '<br>';
                
                require_once 'model.php';  // Include the model file
                if (isValid($_POST['username'], $_POST['password'])) {  // isValid() is defined in model.php
                    echo 'Valid username and password<br>';
                } else {
                    echo 'Invalid username and password<br>';
                }
                
                exit();  // or break when there is something more to do after switch
            
            case 'Join':  // or 'SignUp'
                // Handle sign-up logic here
                echo 'Sign-up functionality is not implemented yet.<br>';
                exit();
            
            case 'ForgotPassword':
                // Handle password reset logic here
                echo 'Forgot password functionality is not implemented yet.<br>';
                exit();
            
            default:
                echo 'Unknown command<br>';
                exit();
        }
    }

?>
