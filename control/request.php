<?php

// Action to perform when leaving the page
if(isset($_SESSION['lastPage']) && $php === $_SESSION['lastPage']) {
    switch ($_SESSION['lastPage']) {
        case "signUp":

            //mettre alert
            $signUp == signUp($PDO);
            $php = 'login';
            break;
        case 'addRoom':

    }
}
// Action to perform when loading the page
switch ($php) {
    case "statistic":
        global $sensorName, $sensorHistoric;
        [$sensorName, $sensorHistoric] =getHistoric($GLOBALS['roomId'], $PDO);
        break;
    case "home":
        [$residences, $select, $rooms, $light, $shutter, $auto, $opening, $closing, $temperature, $ventilation] = home($PDO, $GLOBALS['idUser']);
}


