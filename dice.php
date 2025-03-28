<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dice Roller</title>
    <link rel="stylesheet" href="public/styles.css">

    <link rel="icon" href="images/icon.webp" type="image/webp">


</head>
<body>
    <?php include 'header.php'?>;
    <div>
        <h1>Dice Roller</h1>
        <form method="post" action="controller.php">
            <input type="hidden" name="page" value="Dice">
            <input type="hidden" name="command" value="Roll">
            <label for="dice">Number of dice:</label>
            <input type="number" id="dice" name="dice" min="1" required>

            <label for="sides">Number of sides per die:</label>
            <input type="number" id="sides" name="sides" min="2" required>

            
            <div class="dice-buttons">
                <button type="button" onclick="setDice(2); setNumber(1)">Coin</button>
                <button type="button" onclick="setDice(4)">D4</button>
                <button type="button" onclick="setDice(6)">D6</button>
                <button type="button" onclick="setDice(8)">D8</button>
                <button type="button" onclick="setDice(10)">D10</button>
                <button type="button" onclick="setDice(12)">D12</button>
                <button type="button" onclick="setDice(20)">D20</button>
                <button type="button" onclick="setDice(100)">D100</button>
            </div>
            <button type="submit">Roll</button>
        </form>
            <script>
                function setDice(sides) {
                    document.getElementById('sides').value = sides;
                }

                function setNumber(dice) {
                    document.getElementById('dice').value = dice;
                }
            </script>

            <br>
    </div>

    <?php include 'footer.php'?>
</body>
</html>