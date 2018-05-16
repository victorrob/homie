<?php

// Action to perform when leaving the page
if(isset($_GET['d'])) {
    switch (strip_tags($_GET['d'])) {
        case "signUp":
            if(signUp($PDO))
                $php='login';
            break;

        case 'login':
            if (verify($PDO)){
                $php = 'home';
            }
            break;

        case "profile":
            [$error]=profilePOST($PDO,$_POST);
            break;

        case 'sensor':
            echo "fi";
            $_SESSION['roomId'] = -1;
            $_SESSION['idResidence'] = 2;
            setRoomInfo($PDO);
            $_GET['d']=null;
            break;
    }
}
// Action to perform when loading the page
switch ($php) {
    case "statistic":
        //[$sensorName, $sensorHistoric] = getHistoric($PDO);

        break;
    case "home":
        [$residences, $select, $rooms, $light, $shutter, $auto, $opening, $closing, $temperature, $ventilation] = home($PDO, $_SESSION['idUser']);
        break;
    case "sensor":
        [$sensorList, $sensorCheck, $actuatorList, $actuatorCheck, $roomType, $roomSize, $roomName] = getRoomInfo($PDO);
        break;
    case "profile":
        [$name,$firstName,$birthDate,$email,$address,$phone,$password] = profileGet($PDO);
        if (is_null($error)) {
            $error = '';
        }
        break;
    case "login":
        break;
}