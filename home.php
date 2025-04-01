

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D&D Homepage</title>
    <link rel="stylesheet" href="public/styles.css">
    <link rel="icon" href="public/images/icon.webp" type="image/webp">
</head>
<body>
    <?php include 'header.php'?>
    <?php include 'profile.php'?>
        <div class="bottom">
            <div>
                <h1 id="index" style="width: 250px;">Welcome to D&D Character Creator</h1>
                <button class="character" id="create"     style="display: inline; height: 80px; width: 160px;">Character Creator</button>
                <button class="character" id="showButton" style="display: inline; height: 80px; width: 160px;">View Characters</button>
                <button class="character" id="deleteButton"     style="display: inline; height: 80px; width: 160px;">Delete Characters</button>
            </div>
            <form style="display: none;" id="createCharacter" action="controller.php" method="post">
                <input type="hidden" name="page" value="Characters">
                <input type="hidden" name="command" value="Create">
                <table>
                    <tr>
                        <th colspan="3"><label>Character Name:</label></th>
                        <td colspan="3"><input type="text" id="characterName" name="characterName" required></td>
                    </tr>
                    <tr>
                        <th colspan="3"><label>Level:</label></th>
                        <td colspan="3">
                            <select name="level">
                                <option value=1>Level 1</option>
                                <option value=2>Level 2</option>
                                <option value=3>Level 3</option>
                                <option value=4>Level 4</option>
                                <option value=5>Level 5</option>
                                <option value=6>Level 6</option>
                                <option value=7>Level 7</option>
                                <option value=8>Level 8</option>
                                <option value=9>Level 9</option>
                                <option value=10>Level 10</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th colspan="3"><label>Class:</label></th>
                        <td colspan="3">
                            <select name="class">
                                <option value="barbarian">Barbarian</option>
                                <option value="bard">Bard</option>
                                <option value="cleric">Cleric</option>
                                <option value="druid">Druid</option>
                                <option value="fighter">Fighter</option>
                                <option value="monk">Monk</option>
                                <option value="paladin">Paladin</option>
                                <option value="ranger">Ranger</option>
                                <option value="rogue">Rogue</option>
                                <option value="sorcerer">Sorcerer</option>
                                <option value="warlock">Warlock</option>
                                <option value="wizard">Wizard</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th colspan="3"><label>Race:</label></th>
                        <td colspan="3">
                            <select name="race">
                                <option value="human">Human</option>
                                <option value="elf">Elf</option>
                                <option value="dwarf">Dwarf</option>
                                <option value="halfling">Halfling</option>
                                <option value="gnome">Gnome</option>
                                <option value="half-orc">Half-Orc</option>
                                <option value="tiefling">Tiefling</option>
                                <option value="dragonborn">Dragonborn</option>
                                <option value="half-elf">Half-Elf</option>
                                <option value="aasimar">Aasimar</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="strength">Strength:</label></th>
                        <th><label for="dexterity">Dexterity:</label></th>
                        <th><label for="constitution">Constitution:</label></th>
                        <th><label for="intelligence">Intelligence:</label></th>
                        <th><label for="wisdom">Wisdom:</label></th>
                        <th><label for="charisma">Charisma:</label></th>
                    </tr>
                    <tr>
                        <td><input type="number" name="Strength" min="1" max="20" required></td>
                        <td><input type="number" name="Dexterity" min="1" max="20" required></td>
                        <td><input type="number" name="Constitution" min="1" max="20" required></td>
                        <td><input type="number" name="Intelligence" min="1" max="20" required></td>
                        <td><input type="number" name="Wisdom" min="1" max="20" required></td>
                        <td><input type="number" name="Charisma" min="1" max="20" required></td>
                        
                    </tr>
                    <tr>
                        <th colspan="6" style="text-align: center;">
                            <button type="submit" style="height: 80px; font-weight: bold; background-color: black">Create Character</button>    
                        </th>
                    </tr>
                </table>
            </form>

            <div id="showDiv" style="display: none; width: 90%;"></div>

            <form id="deleteCharacter" style="display: none;" action="controller.php" method="post">
                <input type="hidden" name="page" value="Characters">
                <input type="hidden" name="command" value="DeleteCharacter">
                <label for="characterName">Character Name:</label>
                <input type="text" id="characterName" name="characterName" required>
                <div id="characterList"></div>
                <button id="deleteSubmit" type="submit">Delete</button>
            </form>

            </div>
        </div>
        <?php include 'footer.php'?>
    </body>
    </html>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let showCharacter = $('#showDiv');
        let createCharacter = $('#createCharacter');
        let deleteCharacter = $('#deleteCharacter');
        let header = $('#index');

        $('#deleteButton').on('click', function() {
            if (deleteCharacter.css('display') === "none") {
                header.text('Delete Character');
                deleteCharacter.css('display', 'block');
                createCharacter.css('display', 'none');
                showCharacter.css('display', 'none');
                
            } else {
                deleteCharacter.css('display', 'none');
            }
        });

        $('#showButton').on('click', function() {
            if(showCharacter.css('display') === "none") {
                $('#createCharacter').css('display', 'none');
                $('#deleteCharacter').css('display', 'none');
                $.ajax({
                    url: 'controller.php',
                    type: 'POST',
                    data: { 
                        page: 'Characters',
                        command: 'ShowCharacter' },
                    success: function(data) {
                        console.log("AJAX Success", data);
                        displayCharacter(data);
                    },

                    error: function(xhr, status, error) {
                        console.error("AJAX Error: " + error);
                    }
                }); 
                header.text('Character Viewer');
                showCharacter.css('display', 'block');
            } else {
                showCharacter.css('display', 'none');
            }
        });

        $('#create').on('click', function() {
            if (createCharacter.css('display') === "none") {
                showCharacter.css('display', 'none');
                deleteCharacter.css('display', 'none');
                header.text('Character Creator');
                createCharacter.css('display', 'block');
                
            } else {
                createCharacter.css('display', 'none');
            }
        });
        
        

            function displayCharacter(data) {
                showCharacter.empty();

                if (data.status === 'success') {
                    data.character.forEach(function(character) {
                    let characterHtml = '<table style="border: 1px solid black; margin-bottom: 20px;">';
                    characterHtml += '<tr><th colspan="3">Character Name:</th><td colspan="3">' + character.name + '</td></tr>';
                    characterHtml += '<tr><th colspan="3">Level:</th><td colspan="3">' + character.level + '</td></tr>';
                    characterHtml += '<tr><th colspan="3">Class:</th><td colspan="3">' + character.class + '</td></tr>';
                    characterHtml += '<tr><th colspan="3">Race:</th><td colspan="3">' + character.race + '</td></tr>';
                    characterHtml += '<tr>';
                    characterHtml += '<th>Strength:</th>';
                    characterHtml += '<th>Dexterity:</th>';
                    characterHtml += '<th>Constitution:</th>';
                    characterHtml += '<th>Intelligence:</th>';
                    characterHtml += '<th>Wisdom:</th>';
                    characterHtml += '<th>Charisma:</th>';
                    characterHtml += '</tr>';
                    characterHtml += '<tr>';
                    characterHtml += '<td>' + character.str + '</td>';
                    characterHtml += '<td>' + character.dex + '</td>';
                    characterHtml += '<td>' + character.con + '</td>';
                    characterHtml += '<td>' + character.intc + '</td>';
                    characterHtml += '<td>' + character.wis + '</td>';
                    characterHtml += '<td>' + character.cha + '</td>';
                    characterHtml += '</tr>';
                    characterHtml += '</table>';
                    showCharacter.append(characterHtml);
                    });
                    
                } else {
                    $('#showDiv').html('<p>No characters found.</p>');
                }
            }
        

</script>