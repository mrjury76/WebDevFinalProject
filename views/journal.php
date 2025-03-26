<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Journal</title>
    <link rel="stylesheet" href="../public/styles.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <main>
        <div>
            <h2>New Entry</h2>
            <form action="controller.php" method="post">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required>

                <label for="content">Content:</label>
                <textarea id="content" name="content" rows="10" required></textarea>

                <button type="submit">Submit</button>
            </form>
        </div>

    </main>
    <?php include 'footer.php'; ?>
</body>
</html>