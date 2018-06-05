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
    $('html,body').animate({scrollTop:$(form).offset().top}, 'slow');
}

function maj(idRoom, type) {
    var id = type + idRoom;
    var element = document.getElementById(id);
    if (element.type === 'checkbox') {
        if (element.checked === true) {
            var state = 1;
        }
        else {
            var state = 0;
        }
        if (type === 'volet_state') {
            var actuator = 'volet';
        }
        else if (type === 'volet_auto') {
            var actuator = 'auto';
        }
        else {
            var actuator = 'lumière';
        }
        $.ajax('model/homeTreatment.php', {
            type: 'POST',
            data: {idRoom: idRoom, type: actuator, state: state}
        });
    }
    else if (element.type === 'time') {
        var time = element.value;
        if (type === 'volet_opening') {
            var actuator = 'opening';
        }
        else if (type === 'volet_closing') {
            var actuator = 'closing';
        }
        $.ajax('model/homeTreatment.php', {
            type: 'POST',
            data: {idRoom: idRoom, type: actuator, time: time}
        });
    }
    else if (element.type === 'number') {
        var value = element.value;
        var actuator = type;
        $.ajax('model/homeTreatment.php', {
            type: 'POST',
            data: {idRoom: idRoom, type: actuator, value: value}
        });
    }
}