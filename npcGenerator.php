

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NPC Generator</title>
    <link rel="stylesheet" href="public/styles.css">
    <link rel="icon" href="images/icon.webp" type="image/png">
</head>
<body>
<?php include 'header.php'?>
<?php include 'profile.php'?>
    <div>
        <h1>NPC Generator</h1>
        <p>Generate a random NPC for your campaign!</p>
        <form action="controller.php" method="post">
            <input type="hidden" name="page" value="NPC">
            <input type="hidden" name="command" value="Generate">
            <button id="NPC" type="submit">Generate NPC</button>
        </form>
        <br>
    </div>
<?php include 'footer.php'?>
</body>

