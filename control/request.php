<?php

// Action to perform when leaving the page
if($php === $_SESSION['lastPage']) {
    switch ($_SESSION['lastPage']) {
        case "signUp":
            signUp($PDO);
            break;
        case 'addRoom':

    }
}
// Action to perform when loading the page
switch ($php) {
    case "statistic":
        global $sensorType, $sensorName, $sensorHistoric;
        [$sensorType, $sensorName, $sensorHistoric] = getHistoric($GLOBALS['roomId'], $PDO);
        break;
    case "home":
        [$residences, $select, $rooms, $light, $shutter, $auto, $opening, $closing, $temperature, $ventilation] = home($PDO, $GLOBALS['idUser']);
}