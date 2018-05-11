<?php
// Action to perform when leaving the page
if(isset($_GET['d'])) {
    switch (strip_tags($_GET['d'])) {
        case "signUp":

            //mettre alert
            /*$signUp == signUp($PDO);
            if ($signUp == true){
                echo $signUp;
            }
           */
            $php = 'login';
            break;
        case 'sensor':
            echo "fi";
            $_SESSION['roomId'] = -1;
            $_SESSION['idResidence'] = 2;
            setRoomInfo($PDO);
            break;
    }
}
// Action to perform when loading the page
switch ($php) {
    case "statistic":
        [$sensorName, $sensorHistoric] =getHistoric($PDO);

        break;
    case "home":
        [$residences, $select, $rooms, $light, $shutter, $auto, $opening, $closing, $temperature, $ventilation] = home($PDO, $_SESSION['idUser']);
        break;
    case "sensor":
        [$sensorList, $sensorCheck, $actuatorList, $actuatorCheck, $roomType, $roomSize, $roomName] = getRoomInfo($PDO);
        break;
    case "login":
        break;
}