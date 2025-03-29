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
        <h2>New Entry</h2>
        <form action="controller.php" method="post">
            <input type="hidden" name="page" value="Journal">
            <input type="hidden" name="command" value="Submit">

            <label style="display: block; margin: 10px auto" for="title"><p>Title:</p></label>
            <input style="display: block; margin: 10px auto" type="text" id="title" name="title" required>

            <label style="display: block; margin: 10px auto" for="content"><p>Content:</p></label>
            <textarea style="display: block; margin: 10px auto" id="content" name="content" rows="10" cols="40" max="255" required></textarea>

            <button type="submit">Submit</button>
            <button id="header" type="button">View Entries</button>
        </form>
    </div>
    
    <div id="journal"></div>

    <?php include 'footer.php'; ?>

    <script>
        $(document).ready(function() {
            getEntries2(); // Call the function to get journal entries on page load
            console.log("Document Ready");

            // Ensure the button click triggers
            $('#header').click(function(e) {
                e.preventDefault(); // Prevent form submission
                console.log("Button clicked!");
                getEntries2(); // Call the function to get journal entries
            });

            function getEntries2() {
                console.log("AJAX request initiated");

                var controller = "controller.php";
                
                $.ajax({
                    url: controller,  // jQuery AJAX request to the controller
                    type: 'POST',  // The method type
                    data: { page: 'Journal', command: 'View' },
                    success: function(response) {
                        console.log("AJAX Response:", response); // Log the server response for debugging
                        let data = JSON.parse(response);  // Parse the JSON response

                        // Clear the #journal div before adding new entries
                        $('#journal').empty();

                        if (data.status === 'success') {
                            // Loop through the entries and display them
                            data.entries.forEach(function(entry) {
                                var entryHtml = '<div class="entry">';
                                entryHtml += '<h2>' + entry.title + '</h2>';
                                entryHtml += '<p>' + entry.content + '</p>';
                                entryHtml += '<p><em>Created on: ' + entry.created_date + '</em></p>';
                                entryHtml += '</div>';
                                $('#journal').append(entryHtml);  // Append each entry to the div
                            });
                        } else {
                            // Display error message if no entries were found
                            $('#journal').html('<p>' + data.message + '</p>');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error: " + status + " - " + error);
                    }
                });
            }
        });
    </script>
</body>
</html>
