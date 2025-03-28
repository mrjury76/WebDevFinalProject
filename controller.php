<link rel="icon" href="public/images/icon.webp" type="image/webp">

<?php

if (empty($_POST['page'])) { 
    include 'index.php'; 
    exit();
} 

require_once 'model.php';
$page = $_POST['page'];
$command = $_POST['command'];
session_start();


if ($page === 'StartPage') {
    if (!isset($_SESSION['signedin'])) {
        include 'index.php';
        exit;
    }
        switch ($command) {
            case 'SignIn':
                $username = $_POST['username'];
                $password = $_POST['password'];
                if (isValid($username, $password)) {
                    $username = $_POST['username'];
                    setcookie('username', $username, time() + 30 * 24 * 60 * 60); //keeps cookie for a month
                    $_SESSION['signedin'] = 'YES';
                    $_SESSION['username'] = $username;
                    if ($_SESSION['signedin'] === 'YES') {
                    }
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
                    include 'register.php';
                    exit();
                }
                elseif (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
                    echo "<script>alert('All fields are required!')</script>";
                    include 'register.php';
                    exit();
                }
                else{
                    createUser($_POST['username'], $_POST['password'], $_POST['email']);
                    include 'home.php';
                }
                exit();
            
            default:
                echo "<script>alert('Unknown Command: Error 404')</script>";
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
                $columns = ['fname', 'lname', 'race', 'class', 'quirk', 'alignment', 'motivation'];
                $npc = [];

                foreach ($columns as $column) {
                    $npc[$column] = getRandomValue($column);
                }

                echo "<div class='npc'>";
                echo "<h1 class='npc'>Random NPC:</h1>";
                echo "<ul>";
                echo "<li><p>First Name:</p> " . $npc['fname'] . "</li>";
                echo "<li><p>Last Name:</p> " . $npc['lname'] . "</li>";
                echo "<li><p>Race:</p> " . $npc['race'] . "</li>";
                echo "<li><p>Class:</p> " . $npc['class'] . "</li>";
                echo "<li><p>Quirk:</p> " . $npc['quirk'] . "</li>";
                echo "<li><p>Alignment:</p> " . $npc['alignment'] . "</li>";
                echo "<li><p>Motivation:</p> " . $npc['motivation'] . "</li>";
                echo "</ul>";
                echo "</div>";
                exit();
            
            default:
                echo "<script>alert(Unknown command)</script>";
                exit();
        }
    }

    elseif ($_POST['page'] === 'Header') {
        switch ($_POST['command']) {
            case 'Characters':
                include 'home.php';
                exit();
            
            case 'Dice':
                include 'dice.php';
                exit();
            
            case 'Journal':
                include 'journal.php';
                exit();
            
            case 'NpcGenerator':
                include 'npcGenerator.php';
                exit();
            
            case 'GameTables':
                include 'gameTables.php';
                exit();
            
            case 'EditCharacter':
                include 'editCharacter.php';
                exit();
            
            case 'Register':
                include 'register.php';
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