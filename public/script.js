// document.getElementById('register-button').addEventListener('click', function() {
//     createUser();
//     alert('Register button clicked');
// });

function setDice(sides) {
    document.getElementById('sides').innerHTML = sides;
}

function setNumber(dice) {
    document.getElementById('dice').innerHTML = dice;
}

// Function to roll dice with the number of dice and sides and returns them as a list
function rollDice(numDice, sides){
    output = "";

    //the number of sides it 2 (coin flip) return heads or tails
    if (sides === 2) {
        var result = roll === 1 ? 'Heads' : 'Tails';
        return result;
    } else {
        for (var i = 0; i < numDice; i++) {
            var roll = Math.random(1, sides) + 1;
            sum += roll;
            output[i] = roll;
        }
        return output, sum;
    }
}

function averages(sum, numDice, sides) {
    var average = sum / numDice;
    var averages = {
        4: 2.5,
        6: 3.5,
        8: 4.5,
        10: 5.5,
        12: 6.5,
        20: 10.5,
        100: 50.5
    };
    if (numDice > 1) {
        output += '<p><strong>Sum of all dice:</strong> ' + sum + '</p>';
        output += '<p><strong>Average roll:</strong> ' + average.toFixed(2) + '</p>';
        
    
        if (averages[sides]) {
            output += '<p><strong>Mathematical Average: ' + averages[sides] + '</strong></p>';
            output += '<br>';
        }
    }
}
// function equalPasswords() {
//     var password = document.getElementById('password').value;
//     var confirmPassword = document.getElementById('confirm_password').value;

//     if (password === confirmPassword) {
//         return true;
//     } else {
//         return false;
//     }
// }