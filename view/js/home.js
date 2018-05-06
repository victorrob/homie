function home(idRoom) {

    var section = document.getElementById(idRoom);

    if (section.style.display == "none") {
        section.style.display = "block";
    }
    else {
        section.style.display = "none";
    }
}