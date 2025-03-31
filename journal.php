<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Journal</title>
    <link rel="stylesheet" href="public/styles.css">
    <link rel="icon" href="public/images/icon.webp" type="image/webp">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
</head>
<body>
    <?php include 'header.php'?>
    <?php include 'profile.php'?>
    <div>
        <h1>New Entry</h1>
        <form action="controller.php" method="post">
            <input type="hidden" name="page" value="Journal">
            <input type="hidden" name="command" value="Submit">

            <label  for="title"><p>Title:</p></label>
            <input  type="text" id="title" name="title" required>
            <br><br>

            <label for="content"><p>Content:</p></label>
            <textarea id="content" name="content" rows="10" cols="40" max="255" required></textarea>

            <button type="submit">Submit</button>
        </form>
        <button id="header" type="button">View Entries</button>
    </div>
    
    <div class="bottom" id="journal"></div>

    <?php include 'footer.php'; ?>
    
    <script>
        // $('#header').on('click', function() {
        //         console.log("Button Clicked!");
        //         // Assuming 'response' is defined elsewhere or replace it with actual data
        //         displayEntries(response);
        //     });

        $(document).ready(function() {
            console.log("Document Ready");


            $.ajax({
                url: 'controller.php',
                type: 'POST',
                data: {
                    page: 'Journal',
                    command: 'View',
                },
                success: function(data) {
                    console.log("AJAX Success:", data);
                    displayEntries(data);
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", error);
                }
            });
            
        });

        function displayEntries(data) {
                $('#journal').empty();

                if (data.status === 'success') {
                    data.entries.forEach(function(entry) {
                        let entryHtml = '<div class="entry">';
                        entryHtml += '<table class="entry-table">';
                        entryHtml += '<tr><th>Title</th><td>' + entry.title + '</td></tr>';
                        entryHtml += '<tr><th>Entry</th><td>' + entry.content + '</td></tr>';
                        entryHtml += '<tr><th>Created On</th><td>' + entry.created_date + '</td></tr>';
                        entryHtml += '</table>';
                        entryHtml += '</div>';
                        $('#journal').append(entryHtml);
                    });
                } else {
                    $('#journal').html('<p>No entries found.</p>');
                }
            }
    </script>
</body>
</html>
