<link rel="icon" href="public/images/icon.webp" type="image/webp">

<?php
if (empty($_POST['page'])) { 
    include 'index.php'; 
    exit();
} 
// if (!isset($_COOKIE['username'])) {
//     include 'index.php';
//     exit;
// }

require_once 'model.php';
$page = $_POST['page'];
$command = $_POST['command'];
session_start();


if ($page === 'StartPage') {
    
        switch ($command) {
            case 'SignIn':
                $username = trim($_POST['username']);
                $password = $_POST['password'];
                if (isValid($username, $password)) {
                    $username = $_POST['username'];
                    setcookie('username', $username, time() + 30 * 24 * 60 * 60); //keeps cookie for a month
                    $_SESSION['username'] = $username;
                    $_SESSION['signedin'] = 'YES';
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
                    if(createUser($_POST['username'], $_POST['password'], $_POST['email'])) {
                        include 'home.php';
                        exit();
                    }
                    else{
                        echo "<script>alert('Username already exists!')</script>";
                        include 'index.php';
                        exit();
                    }
                }
            
            case 'Logout':
                setcookie('username', '', time() - 3600);
                unset($_COOKIE['username']);
                session_unset();
                session_destroy(); 
                include 'index.php';
                exit();

            case '_DELETE':
                $username = $_COOKIE['username'];
                if (isset($username)) {
                    deleteUser($username);
                    setcookie($username, '', time() - 3600);
                    unset($username);
                    session_unset();
                    session_destroy(); 
                    include 'index.php';
                    exit();
                } else {
                    echo "<script>alert('No user is logged in!')</script>";
                    include 'index.php';
                    exit();
                }

            default:
                echo "<script>alert('Unknown Command')</script>";
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
                    echo "<div class='bottom'>";
                    echo "<h1>Results:</h1>";
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

    elseif ($page === 'Journal') {
        include 'journal.php';
        switch ($command) {
            case 'Submit':
                if (empty($_POST['title']) || empty($_POST['content']) || empty($_COOKIE['username'])) {
                    echo "<script>alert('All fields are required!')</script>";
                    exit();
                }
                else {
                    if (createEntry($_POST['title'], $_POST['content'])) {
                        echo "<script>alert('Entry created!')</script>";
                        exit();
                    } else {
                        echo "<script>alert('Error creating entry!')</script>";
                        exit();
                    }
                }

            case 'View':
                // header('Content-Type: application/json');
                $username = $_COOKIE['username'];
                $entries = queryEntries($username);
                if (!empty($entries)) {
                    echo json_encode(['status' => 'success', 'entries' => $entries]);
                    exit();
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'No entries found.']);
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
                echo "<div class='bottom'>";
                echo "<table border='1'><th>Random NPC:</th></table>";
                echo "<table border='1' class='npc-table'>";
                echo "<tr><th>Attribute</th><th>Value</th></tr>";
                echo "<tr><td>First Name</td><td>" . $npc['fname'] . "</td></tr>";
                echo "<tr><td>Last Name</td><td>" . $npc['lname'] . "</td></tr>";
                echo "<tr><td>Race</td><td>" . $npc['race'] . "</td></tr>";
                echo "<tr><td>Class</td><td>" . $npc['class'] . "</td></tr>";
                echo "<tr><td>Quirk</td><td>" . $npc['quirk'] . "</td></tr>";
                echo "<tr><td>Alignment</td><td>" . $npc['alignment'] . "</td></tr>";
                echo "<tr><td>Motivation</td><td>" . $npc['motivation'] . "</td></tr>";
                echo "</table>";
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

            case 'SignIn':
                include 'index.php';
                exit();
            
            default:
                echo "<p>Unknown command</p>";
                exit();
        }
    }

    else {
        include 'index.php';
        exit();
    }
?>