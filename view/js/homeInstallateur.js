function home(id, className) {
    var form = document.getElementById(id);
    var forms = document.getElementsByClassName(className);
    if (form.style.display === 'flex') {
        form.style.display = 'none';
    }
    else {
        for (var i=0; i<forms.length; i++) {
            forms[i].style.display = 'none';
        }
        form.style.display = 'flex';
    }
}