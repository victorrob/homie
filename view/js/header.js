window.onload = function header() {
    var parametre = document.getElementById('parametre');
    parametre.onclick = function menu() {
        var d = document.getElementById('menu');
        var visibility = getComputedStyle(d, null).visibility;

        if (visibility !== "hidden") {
            document.getElementById('menu').style.visibility = "hidden";
        }
        else {
            document.getElementById('menu').style.visibility = "visible";
        }
    }
}