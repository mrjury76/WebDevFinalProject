<?php

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (!isset($_POST['page'])) { 
        include 'start.php'; 
        exit();
    } 

    require_once 'model.php';
    $page = $_POST['page'];
    $command = $_POST['command'];

    switch ($page) {
        case '':
            // if (!empty($_COOKIE['username'])) { 
            //     include 'home.php'; 
            // } else {
                include 'start.php';
            // }
            exit();

        case 'StartPage':
            switch ($command) {
                case 'SignIn':
                    $username = trim($_POST['username']);
                    $password = $_POST['password'];
                    if (isValid($username, $password)) {
                        setcookie('username', $username, time() + 30 * 24 * 60 * 60); // keeps cookie for a month
                        session_start();
                        $_SESSION['username'] = $username;
                        $_SESSION['signedin'] = 'YES';
                        include 'home.php';
                        exit();
                    } else {
                        include 'start.php';
                        echo "<script>alert('Invalid username or password!')</script>";
                        exit();
                    }

                case 'Join':
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $email = $_POST['email'];

                    if (empty($username) || empty($password) || empty($email)) {
                        echo "<script>alert('All fields are required!')</script>";
                        include 'register.php';
                        exit();
                    } elseif (createUser($username, $password, $email)) {
                        setcookie('username', $username, time() + 30 * 24 * 60 * 60); // keeps cookie for a month
                        session_start();
                        echo "<script> console.log('USERCREATEd') </script>";
                        $_SESSION['username'] = $username;
                        $_SESSION['signedin'] = 'YES';
                        include 'home.php';
                    }
                    exit();

                case 'Logout':
                    if (isset($_COOKIE['username'])) {
                        setcookie('username', $_COOKIE['username'], time() - 3600);
                        // session_unset();
                        // session_destroy(); 
                        include 'start.php';
                        exit();
                    } else {
                        include 'start.php';
                        echo "<script>alert('No user is logged in!')</script>";
                    }
                    exit();

                case '_DELETE':
                    $username = $_COOKIE['username'];
                    if (isset($username)) {
                        include 'start.php';
                        if (deleteUser($username)) {
                            echo "<script>alert('User deleted!')</script>";
                        } else {
                            echo "<script>alert('Error deleting user!')</script>";
                        }
                        setcookie($username, '', time() - 3600);
                        unset($_SESSION['username']);
                        unset($_SESSION['signedin']);
                        session_unset();
                        session_destroy(); 
                        exit();
                    } else {
                        include 'start.php';
                        echo "<script>alert('No user is logged in!')</script>";
                        exit();
                    }

                default:
                    echo "<script>alert('Unknown Command')</script>";
                    exit();
            }

        case 'Characters':
            switch ($command) {
                case 'Create':
                    $username = $_COOKIE['username'];
                    $name = $_POST['characterName'];
                    $level = $_POST['level'];
                    $class = $_POST['class'];
                    $race = $_POST['race'];
                    $strength = $_POST['Strength'];
                    $dexterity = $_POST['Dexterity'];
                    $constitution = $_POST['Constitution'];
                    $intelligence = $_POST['Intelligence'];
                    $wisdom = $_POST['Wisdom'];
                    $charisma = $_POST['Charisma'];
                    if (createCharacter($username, $name, $level, $class, $race, $strength, $dexterity, $constitution, $intelligence, $wisdom, $charisma)) {
                        include 'home.php';
                        echo "<script>alert('Character created!')</script>";
                        exit();
                    } else {
                        include 'home.php';
                        echo "<script>alert('Error creating character!')</script>";
                        exit();
                    }

                case 'ShowCharacter':
                    $username = $_COOKIE['username'];
                    $character = queryCharacter($username);
                    if (!empty($character)) {
                        header('Content-Type: application/json');
                        echo json_encode(['status' => 'success', 'character' => $character]);
                        exit();
                    } else {
                        echo json_encode(['status' => 'error', 'message' => 'No character found.']);
                        exit();
                    }

                case 'DeleteCharacter':
                    $username = $_COOKIE['username'];
                    $delete = deleteCharacter($_POST['characterName'], $username);
                    if ($delete) {
                        include 'home.php';
                        echo "<script>alert('Character deleted!')</script>";
                        exit();
                    } else {
                        include 'home.php';
                        echo "<script>alert('Error deleting character!')</script>";
                        exit();
                    }
            }

        case 'Dice':
            include 'dice.php';
            switch ($command) {
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
                    $average = $sum / $numDice;
                    if ($numDice > 1) {
                        echo "<p><strong>Sum of all dice:</strong> " . $sum . "</p>";
                        echo "<p><strong>Average roll:</strong> " . number_format($average, 2) . "</p>";
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

        case 'Journal':
            switch ($command) {
                case 'Submit':
                    if (empty($_POST['title']) || empty($_POST['content'])) {
                        include 'journal.php';
                        echo "<script>alert('All fields are required!')</script>";
                        exit();
                    }
                    if (empty($_COOKIE['username'])) { 
                        require 'start.php';
                        echo "<script>alert('You must signed in to use that feature!')</script>";
                        exit();
                    } else {
                        if (createEntry($_POST['title'], $_POST['content'])) {
                            include 'journal.php';
                            echo "<script>alert('Entry created!')</script>";
                            exit();
                        } else {
                            include 'journal.php';
                            echo "<script>alert('Error creating entry!')</script>";
                            exit();
                        }
                    }

                case 'View':
                    $username = $_COOKIE['username'];
                    $entries = queryEntries($username);
                    if (!empty($entries)) {
                        header('Content-Type: application/json');
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

        case 'NPC':
            switch ($command) {
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

        case 'Header':
            switch ($command) {
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
                    include 'start.php';
                    exit();

                default:
                    echo "<p>Unknown command</p>";
                    exit();
            }

        case 'EditCharacter':
            switch ($command) {
                case 'ShowCharacters':
                    $username = $_COOKIE['username'];
                    $character = queryCharacterWithID($username);
                    if (!empty($character)) {
                        header('Content-Type: application/json');
                        echo json_encode(['status' => 'success', 'character' => $character]);
                        exit();
                    } else {
                        echo json_encode(['status' => 'error', 'message' => 'No character found.']);
                        exit();
                    }

                case 'EditCharacter':
                    $username = $_COOKIE['username'];
                    $characterId = $_POST['characterId'];
                    $character = queryCharacterById($username, $characterId);
                    if (!empty($character)) {
                        header('Content-Type: application/json');
                        echo json_encode(['status' => 'success', 'character' => $character]);
                        exit();
                    } else {
                        echo json_encode(['status' => 'error', 'message' => 'No character found.']);
                        exit();
                    }

                    case 'Update':
                        $id = $_POST['characterId'];
                        $username = $_COOKIE['username'];
                        $name = $_POST['characterName'];
                        $level = $_POST['level'];
                        $class = $_POST['class'];
                        $race = $_POST['race'];
                        $strength = $_POST['Strength'];
                        $dexterity = $_POST['Dexterity'];
                        $constitution = $_POST['Constitution'];
                        $intelligence = $_POST['Intelligence'];
                        $wisdom = $_POST['Wisdom'];
                        $charisma = $_POST['Charisma'];
                        
                        $character = updateCharacter($id, $name, $level, $class, $race, $strength, $dexterity, $constitution, $intelligence, $wisdom, $charisma);
                        if (!empty($character)) {
                            include 'editCharacter.php';
                            exit();
                        } else {
                            echo json_encode(['status' => 'error', 'message' => 'No character found.']);
                            exit();
                        }
    
                    default:
                        echo "<p>Unknown command</p>";
                        exit();
                }
    
            default:
                include 'start.php';
                exit();
        
    }
}

if (!empty($_COOKIE['username'])) { 
    include 'home.php'; 
} else {
    include 'start.php';
}
?>
