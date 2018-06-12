$(function () {
    $('.sensorValue').each(function () {
        if ($('.value', this).text() === '') {
            $('.value', this).text('[Problème]');
            $('.value', this).css('color', 'red');
            $('.unité', this).css('visibility', 'hidden');
            $(this).css('width', '450px');
            $(('.value', this)).mouseover(function () {
                $('.value', this).text('La liaison entre le capteur et la base de données est impossible');
                $('.value', this).css('color', 'white');
                $('.value', this).css('background', '#da8232');
            });
            $(('.value', this)).mouseout(function () {
                $('.value', this).text('[Problème]');
                $('.value', this).css('color', 'red');
                $('.value', this).css('background', '');
            });
        }
    });
    $('.carre').click(function () {
        var href = $(this).attr('href');
        if ($(href).css('display') === 'flex') {
            $(href).css('display', 'none');
        }
        else {
            $('.'+$(href).attr('class')).css('display', 'none');
            $(href).css('display', 'flex');
        }
        $('html,body').animate({scrollTop: $(href).offset().top}, 'slow');
    });
    $(':checkbox').change(function () {
        var type = $(this).attr('name');
        var idRoom = ($(this).attr('id')).split(type)[1];
        if ($(this).is(':checked')) {
            var state = 1;
        }
        else {
            var state = 0;
        }
        $.ajax('model/homeTreatment.php', {
            type: 'POST',
            data: {idRoom: idRoom, type: type, state: state}
        });
    });
    $('[type=time]').change(function () {
        var type = $(this).attr('name');
        var idRoom = ($(this).attr('id')).split(type)[1];
        var time = $(this).val();
        $.ajax('model/homeTreatment.php', {
            type: 'POST',
            data: {idRoom: idRoom, type: type, time: time}
        });
    });
    $('[type=number]').change(function () {
        var type = $(this).attr('name');
        var idRoom = ($(this).attr('id')).split(type)[1];
        var value = $(this).val();
        $.ajax('model/homeTreatment.php', {
            type: 'POST',
            data: {idRoom: idRoom, type: type, value: value}
        });
    });
});