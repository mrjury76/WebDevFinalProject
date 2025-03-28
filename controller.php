<?php

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
                    include 'register.php';
                    exit();
                }

                createUser($_POST['username'], $_POST['password'], $_POST['email']);
                include 'home.php';
                exit();
            
            default:
                echo "Unknown command<br>";
                exit();
        }
    }

    elseif($_POST['page'] === 'Dice'){
        switch ($_POST['command']) {
            case 'Roll':
                    $sum = 0;
                    $numDice = $_POST['dice'];
                    $sides = $_POST['sides'];
                    echo "<h2>Results:</h2>";
                    echo "<ul>";
                    for ($i = 0; $i < $numDice; $i++) {
                    $roll = rand(1, $sides);
                    $sum += $roll;
                    if ($sides == 2) {
                        $result = $roll == 1 ? 'Heads' : 'Tails';
                        echo "<li>Coin " . ($i + 1) . ": " . "<p><strong>" . $result . "</p></strong>" . "</li>";
                    } else {
                        echo "<li>Dice " . ($i + 1) . ": " . "<p><strong>" . $roll . "</p></strong>" . "</li>";
                    }
                    }
                    echo "</ul>";
                    //only displays sum and average if more than one die is rolled
                    $average = $sum / $numDice;
                    if ($numDice > 1){
                        echo "<p><strong>Sum of all dice:</strong> " . $sum . "</p>";
                        echo "<p><strong>Average roll:</strong> " . number_format($average, 2) . "</p>";
                        
                        //array of mathematical averages for each die type
                        $averages = [
                        4 => 2.5,
                        6 => 3.5,
                        8 => 4.5,
                        10 => 5.5,
                        12 => 6.5,
                        20 => 10.5,
                        100 => 50.5
                        ];
                    
                        if (array_key_exists($sides, $averages)) {
                        echo "<p><strong>Mathematical Average: " . $averages[$sides] . "</strong></p>";
                        echo "<br>";
                        }
                    }
                
                include 'dice.php';
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
