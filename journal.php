

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Journal</title>
    <link rel="stylesheet" href="public/styles.css">
    <link rel="icon" href="public/images/incon.webp" type="image/webp">
</head>
<body>
    <?php include 'header.php'; 
    if (!isset($_COOKIE['username'])) {include 'index.php';} ?>
    <main>
        <div>
            <h2>New Entry</h2>
            <form action="controller.php" method="post">
                <input type="hidden" name="page" value="Journal">
                <input type="hidden" name="command" value="Submit">

                <label style="display: block; margin: 10px auto" for="title"><p>Title:</p></label>
                <input style="display: block; margin: 10px auto" type="text" id="title" name="title" required>

                <label style="display: block; margin: 10px auto" for="content"><p>Content:</p></label>
                <textarea style="display: block; margin: 10px auto" id="content" name="content" rows="10" max="255" required></textarea>

                <button type="submit">Submit</button>
            </form>
        </div>

    </main>
    <?php include 'footer.php'; ?>
</body>
</html>