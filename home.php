

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D&D Homepage</title>
    <link rel="stylesheet" href="public/styles.css">
    <link rel="icon" href="images/icon.webp" type="image/png">
</head>
<body>
    <?php include 'header.php'?>
    <?php include 'profile.php'?>
        <div class="bottom">
            <div>
                <h1 style="width: 250px;">Welcome to D&D Character Creator</h1>
                <button id="create" style="height: 80px; width: 160px; margin-bottom: 20px;"> Create New Character</button>
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
                        <td colspan="6" style="text-align: center; background-color: black">
                            <button type="submit" style="height: 80px; font-weight: bold;">Create Character</button>    </td>
                    </tr>
                </table>
            </form>






            <!-- <table>
                    <tr>
                        <th>Character Name</th>
                        <th>Class</th>
                        <th>Level</th>
                    </tr>
                    <tr>
                        <td>Example Name</td>
                        <td>Example Class</td>
                        <td>1</td>    
                    </tr>
            </table>
            <table>
                    <tr>
                        <th>Strength</th>
                        <th>Dexterity</th>
                        <th>Constitution</th>
                        <th>Intelligence</th>
                        <th>Wisdom</th>
                        <th>Charisma</th>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td>10</td>
                        <td>10</td>
                        <td>10</td>
                        <td>10</td>
                        <td>10</td>
                    </tr>
            </table> -->
        </div>
    <?php include 'footer.php'?>
</body>
</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        console.log("Document Ready");

        $('#create').on('click', function() {
            console.log("Button Clicked!");
            // $('#createCharacter').toggle();
            let createCharacter = $('#createCharacter');
            if (createCharacter.css('display') === "none") {
                createCharacter.css('display', 'block');
                $(this).text('Close Character Creation')
                $(this).css('height', '100px');
                $(this).css('width', '200px');
                
            } else {
                createCharacter.css('display', 'none');
                $(this).text('Create New Character');
                $(this).css('height', '80px');
                $(this).css('width', '160px');
                
            }
        });
    });
</script>



<!-- <script>
    $(document).ready(function() {
        console.log("Document Ready");

        $('#create').on('click', function() {
            console.log("Button Clicked!");
            let characterName = $('#characterName').val();
            let className = $('#class').val();
            let level = $('select[name="level"]').val();
            let race = $('select[name="race"]').val();
            let strength = $('input[name="Strength"]').val();
            let dexterity = $('input[name="Dexterity"]').val();
            let constitution = $('input[name="Constitution"]').val();
            let intelligence = $('input[name="Intelligence"]').val();
            let wisdom = $('input[name="Wisdom"]').val();
            let charisma = $('input[name="Charisma"]').val();

            if (characterName && className) {
                $.ajax({
                    url: 'controller.php',
                    type: 'POST',
                    data: {
                        page: 'Characters',
                        command: 'CreateCharacter',
                        characterName: characterName,
                        class: className,
                        level: level,
                        race: race,
                        strength: strength,
                        dexterity: dexterity,
                        constitution: constitution,
                        intelligence: intelligence,
                        wisdom: wisdom,
                        charisma: charisma
                    },
                    success: function(data) {
                        console.log("AJAX Success:", data);
                        // Handle success response here
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error:", error);
                    }
                });
            } else {
                alert("Please fill in all fields.");
            }
        });
    }); -->