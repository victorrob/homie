function home() {
    var section = document.getElementById('roomFactors');

    if (section.style.display == "none") {
        section.style.display = "block";
    }
    else {
        section.style.display = "none";
    }
}