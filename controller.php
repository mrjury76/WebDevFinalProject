<link rel="icon" href="images/icon.webp" type="image/webp">
<?php
require_once 'model.php';
    if (empty($_POST['page'])) {  
        header("Location: index.php"); 
        exit();
    } 

    elseif ($_POST['page'] === 'StartPage') {  
        
        switch ($_POST['command']) {
            case 'SignIn':
                
                if (isValid($_POST['username'], $_POST['password'])) {
                    include 'home.php';
                    exit();
                } else {
                    include 'index.php';
                    echo "<script>alert (Invalid username or password!)</script>";
                    exit();
                }
            
            case 'Join':  
                if($_POST['password'] !== $_POST['confirm_password']) {
                    echo "<script>alert('Passwords do not match!');</script>";
                    include 'views/register.php';
                    exit();
                }
                elseif (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
                    echo "All fields are required!<br>";
                    include 'views/register.php';
                    exit();
                }
                else{
                    createUser($_POST['username'], $_POST['password'], $_POST['email']);
                    include 'views/home.php';
                }
                exit();
            
            default:
                echo "Unknown command<br>";
                exit();
        }
    }

    elseif($_POST['page'] === 'Dice'){
        include 'dice.php';
        switch ($_POST['command']) {
            case 'Roll':
                    $sum = 0;
                    $numDice = $_POST['dice'];
                    $sides = $_POST['sides'];
                    echo "<div>";
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
                        echo "</div>";
                        }
                    }
                
                
                exit();
            
            default:
                echo "Unknown command<br>";
                exit();
        }

    }

    elseif ($_POST['page'] === 'Journal') {
        include 'journal.php';
        switch ($_POST['command']) {
            case 'Submit':
                if (empty($_POST['title']) || empty($_POST['content'])) {
                    echo "All fields are required!<br>";
                    exit();
                }
                else {
                    createEntry($_POST['title'], $_POST['content']);
                    include 'journal.php';
                    exit();
                }
            
            default:
                echo "Unknown command<br>";
                exit();
        }
    }

    elseif ($_POST['page'] === 'NPC') {

        switch ($_POST['command']) {
            case 'Generate':
                include 'npcGenerator.php';
                generateNPC();
                exit();
            
            default:
                echo "Unknown command<br>";
                exit();
        }
    }


    else {
        include 'index.php';
        exit();
    }
?>
