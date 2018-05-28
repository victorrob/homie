function surligne(field, error)
{
    if(error)
        field.style.backgroundColor = "#fba";
    else
        field.style.backgroundColor = "";
}

function checkPassword(field)
{
    if(field.value.length < 6 )
    {
        surligne(field, true);
        alert('Votre mot de passe doit faire 6 caractères minimum');
        return false;
    }
    else
    {
        surligne(field, false);
        return true;
    }
}

