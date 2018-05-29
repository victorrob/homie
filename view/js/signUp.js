function surligne(field, error)
{
    if(error)
        field.style.backgroundColor = "#fba";
    else
        field.style.backgroundColor = "";
}

function checkLength(field, length)
{
    if(field.value.length < length )
    {
        surligne(field, true);
        alert("Ce champ doit faire " + length + " caractères minimum");
        return false;
    }
    else
    {
        surligne(field, false);
        return true;
    }
}

function checkPhoneLength(field, length)
{
    if(field.value.length != length )
    {
        surligne(field, true);
        alert("Votre téléphone doit faire " + length + " caractères");
        return false;
    }
    else
    {
        surligne(field, false);
        return true;
    }
}

