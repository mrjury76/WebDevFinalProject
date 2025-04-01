

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

    <div style="width: 85%">
        <h1>Edit Character</h1>
        <div style="width: 100%;" id="editableCharacter"></div>
        <div id="characterDisplay" style="width:100%; margin-bottom: 30px;"></div>
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
                    command: 'ShowCharacters',
                },
                success: function(data) {
                    console.log("AJAX Success:", data);
                    displayEdits(data);
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", error);
                }
            });

        $(document).on('click', '[id^="editCharacter_"]', function() {
            let characterId = $(this).attr('id').split('_')[1];
            $.ajax({
                url: 'controller.php',
                type: 'POST',   
                data: {
                    page: 'EditCharacter',
                    command: 'EditCharacter',
                    characterId: characterId
                },
                success: function(data) {
                    console.log("AJAX Success:", data);
                    if (data.status === 'success') {
                        displayEditCharacter(data);
                    } else {
                        alert('Error loading character data.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", error);
                }
            });
        });
    });

    

    function displayEdits(data) {
        $('#editableCharacter').empty();
        if (data.status === 'success') {
            data.character.forEach(function(character) {
                let characterHtml = '<div style="display: inline">';
                characterHtml += '<button style="display: inline; height: 90px; width: 250px;" id="editCharacter_' + character.id + '" type="button">' + character.name + '</button></div>';
                $('#editableCharacter').append(characterHtml);
            });
        } else {
            $('#editableCharacter').html('<p>No characters found.</p>');
        }

    }

    function displayEditCharacter(data) {
        $('#characterDisplay').empty();
        if (data.status === 'success') {
            data.character.forEach(function(character) {
                let characterHtml = '<div class="bottom" style="margin: auto;">';
                characterHtml += '<h1 style="width: 400px;">Edit ' + character.name + '</h1>';
                characterHtml += '<form id="editCharacterForm" action="controller.php" method="post">';
                characterHtml += '<input type="hidden" name="page" value="EditCharacter">';
                characterHtml += '<input type="hidden" name="command" value="Update">';
                characterHtml += '<input type="hidden" name="characterId" value="' + character.id + '">';

                characterHtml += '<table>';
                characterHtml += '<tr>';
                characterHtml += '<th colspan="3"><label>Character Name:</label></th>';
                characterHtml += '<td colspan="3"><input type="text" id="characterName" name="characterName" value="' + character.name + '" required></td>';
                characterHtml += '</tr>';
                characterHtml += '<tr>';
                characterHtml += '<th colspan="3"><label>Level:</label></th>';
                characterHtml += '<td colspan="3">';
                characterHtml += '<input type="number" name="level" value="' + character.level + '" min="1" max="10" required>';
                characterHtml += '</td>';
                characterHtml += '</tr>';
                characterHtml += '<tr>';
                characterHtml += '<th colspan="3"><label>Class:</label></th>';
                characterHtml += '<td colspan="3">';
                characterHtml += '<select name="class" value="' + character.class + '">';
                characterHtml += '<option value="barbarian">Barbarian</option>';
                characterHtml += '<option value="bard">Bard</option>';
                characterHtml += '<option value="cleric">Cleric</option>';
                characterHtml += '<option value="druid">Druid</option>';
                characterHtml += '<option value="fighter">Fighter</option>';
                characterHtml += '<option value="monk">Monk</option>';
                characterHtml += '<option value="paladin">Paladin</option>';
                characterHtml += '<option value="ranger">Ranger</option>';
                characterHtml += '<option value="rogue">Rogue</option>';
                characterHtml += '<option value="sorcerer">Sorcerer</option>';
                characterHtml += '<option value="warlock">Warlock</option>';
                characterHtml += '<option value="wizard">Wizard</option>';
                characterHtml += '</select>';
                characterHtml += '</td>';
                characterHtml += '</tr>';
                characterHtml += '<tr>';
                characterHtml += '<th colspan="3"><label>Race:</label></th>';
                characterHtml += '<td colspan="3">';
                characterHtml += '<select name="race" value="' + character.race + '">';
                characterHtml += '<option value="human">Human</option>';
                characterHtml += '<option value="elf">Elf</option>';
                characterHtml += '<option value="dwarf">Dwarf</option>';
                characterHtml += '<option value="halfling">Halfling</option>';
                characterHtml += '<option value="gnome">Gnome</option>';
                characterHtml += '<option value="half-orc">Half-Orc</option>';
                characterHtml += '<option value="tiefling">Tiefling</option>';
                characterHtml += '<option value="dragonborn">Dragonborn</option>';
                characterHtml += '<option value="half-elf">Half-Elf</option>';
                characterHtml += '<option value="aasimar">Aasimar</option>';
                characterHtml += '</select>';
                characterHtml += '</td>';
                characterHtml += '</tr>';
                characterHtml += '<tr>';
                characterHtml += '<th><label for="strength">Strength:</label></th>';
                characterHtml += '<th><label for="dexterity">Dexterity:</label></th>';
                characterHtml += '<th><label for="constitution">Constitution:</label></th>';
                characterHtml += '<th><label for="intelligence">Intelligence:</label></th>';
                characterHtml += '<th><label for="wisdom">Wisdom:</label></th>';
                characterHtml += '<th><label for="charisma">Charisma:</label></th>';
                characterHtml += '</tr>';
                characterHtml += '<tr>';
                characterHtml += '<td><input type="number" name="Strength" value="' + character.str + '" min="1" max="20" required></td>';
                characterHtml += '<td><input type="number" name="Dexterity" value="' + character.dex + '" min="1" max="20" required></td>';
                characterHtml += '<td><input type="number" name="Constitution" value="' + character.con + '" min="1" max="20" required></td>';
                characterHtml += '<td><input type="number" name="Intelligence" value="' + character.intc + '" min="1" max="20" required></td>';
                characterHtml += '<td><input type="number" name="Wisdom" value="' + character.wis + '" min="1" max="20" required></td>';
                characterHtml += '<td><input type="number" name="Charisma" value="' + character.cha + '" min="1" max="20" required></td>';
                characterHtml += '</tr>';
                characterHtml += '<tr>';
                characterHtml += '<th colspan="6" style="text-align: center;">';
                characterHtml += '<button type="submit" style="height: 80px; font-weight: bold; background-color: black">Update Character</button>';
                characterHtml += '</th>';
                characterHtml += '</tr>';
                characterHtml += '</table>';
                characterHtml += '</form>';    
                characterHtml += '</div>';
                $('#characterDisplay').append(characterHtml);
            });
        } else {
            $('#characterDisplay').html('<p>No characters found.</p>');
        }
    }

</script>