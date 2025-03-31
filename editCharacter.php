

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <link rel="stylesheet" href="public/styles.css">
    <link rel="icon" href="public/images/icon.webp" type="image/webp">
</head>
<body>
    <?php include 'header.php'?>;
    <?php include 'profile.php'?>

    <div>
        <h1>Edit Character</h1>
        <div id="editableCharacter"></div>
    </div>

    <?php include 'footer.php'?>
</body>
</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    $(document).ready(function() {
            $.ajax({
                url: 'controller.php',
                type: 'POST',
                data: {
                    page: 'EditCharacter',
                    command: 'Edit',
                },
                success: function(data) {
                    console.log("AJAX Success:", data);
                    displayEdits(data);
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", error);
                }
            });
    });

    function displayEdits(data) {
        $('editableCharacter').empty();
        if (data.status === 'success') {
            data.character.forEach(function(character) {
                let characterHtml = '<div>';
                characterHtml += '<button style="height: 90px; width: 180px;" id="editCharacter_' + character.id + '" type="button">' + character.name + '</button>';
                $('#editableCharacter').append(characterHtml);
            });
        } else {
            $('#editableCharacter').html('<p>No characters found.</p>');
        }

    }

</script>