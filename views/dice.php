<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dice Roller</title>
    <link rel="stylesheet" href="../public/styles.css">

</head>
<body>
    <header>
        <div class="container">
            <h1>D&D Interactive</h1>
            <a href="home.php">Characters</a></li>
            <a href="dice.php">Dice</a></li> 
            <a href="journal.php">Journal</a></li> 
            <a href="npnGenerator.php">NPC Generator</a></li>
            <a href="gameTables.php">Game Tables</a></li>
            <a href="editCharacter.php">Edit Character</a></li>
        </div>
    </header>
    <div>
        <h1>Dice Roller</h1>
        <form method="post" action="">
            <label for="dice">Number of dice:</label>
            <input type="number" id="dice" name="dice" min="1" required>

            <label for="sides">Number of sides per die:</label>
            <input type="number" id="sides" name="sides" min="2" required>

            <button type="submit">Roll</button>

            <div class="dice-buttons">
                <button type="submit" onclick="setDice(2); setNumber(1)">Coin</button>
                <button type="button" onclick="setDice(4)">D4</button>
                <button type="button" onclick="setDice(6)">D6</button>
                <button type="button" onclick="setDice(8)">D8</button>
                <button type="button" onclick="setDice(10)">D10</button>
                <button type="button" onclick="setDice(12)">D12</button>
                <button type="button" onclick="setDice(20)">D20</button>
                <button type="button" onclick="setDice(100)">D100</button>
            </div>

            <script>
                function setDice(sides) {
                    document.getElementById('sides').value = sides;
                }
                function setNumber(dice) {
                    document.getElementById('dice').value = dice;
                }
            </script>
            <br>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
            }
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
    

        ?>
    </div>

    <footer>
        <p>Patrick Thrower</p>
    </footer>
</body>
</html>