function check() {
    var mail1 = document.getElementById('mailClient').value;
    var mail2 = document.getElementById('confirmationMail').value;
    if (mail1 !== mail2) {
        alert('Erreur : les deux mails entrés sont différents !');
        return false;
    }
    else {
        return true;
    }
}