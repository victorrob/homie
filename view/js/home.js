function home(id, className) {
    var section = document.getElementById(id);
    var sections = document.getElementsByClassName(className);
    if (section.style.display == 'flex') {
        section.style.display = 'none';
    }
    else {
        for (var i=0; i<sections.length; i++) {
            sections[i].style.display = 'none';
        }
        section.style.display = 'flex';
    }
}