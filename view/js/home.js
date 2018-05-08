function home(idRoom) {
    var section = document.getElementById(idRoom);
    var rooms = document.getElementsByClassName('roomFactors');

    if (section.style.display == 'block') {
        section.style.display = 'none';
    }
    else if (section.style.display == 'none') {
        for (var i=0; i<rooms.length; i++) {
            rooms[i].style.display = 'none';
        }
        section.style.display = 'block';
    }
    else {
        for (var i=0; i<rooms.length; i++) {
            rooms[i].style.display = 'none';
        }
        section.style.display = 'block';
    }
}