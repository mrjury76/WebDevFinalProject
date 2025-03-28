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


// function equalPasswords() {
//     var password = document.getElementById('password').value;
//     var confirmPassword = document.getElementById('confirm_password').value;

//     if (password === confirmPassword) {
//         return true;
//     } else {
//         return false;
//     }
// }