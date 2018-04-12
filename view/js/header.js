window.onload = function() {
    var parametre = document.getElementById('parametre');
    parametre.onclick = function menu() {
        var div = document.getElementById('menu');
        var visibility = getComputedStyle(div, null).visibility;

        if (visibility !== "hidden") {
            document.getElementById('menu').style.visibility = "hidden";
        }
        else {
            document.getElementById('menu').style.visibility = "visible";
        }
    }
}