<?php

// Action to perform when leaving the page
if(isset($_GET['d'])) {
    switch (strip_tags($_GET['d'])) {
        case "signUp":
            $php=login;


            //mettre alert
            /*$signUp == signUp($PDO);
            if ($signUp == true){
                echo $signUp;
            }
           */
            break;

        case 'login':
            if (verify($PDO)){
                $php = 'home';
            }
            break;

       /* case "resetPassword":
            if (egalPswd()) {
                $php = 'home';
            }
            break;*/

        case "profile":
            profilePOST();
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
        [$residences, $rooms] = home($PDO, $_SESSION['idUser']);
        break;
    case "sensor":
        [$sensorList, $sensorCheck, $actuatorList, $actuatorCheck, $roomType, $roomSize, $roomName] = getRoomInfo($PDO);
        break;
    case "profile":
        $name; $firstName; $birthDate; $email; $address; $phone; $password;
        profileGet();
    case "login":
        break;
    case "forgottenPswd":
        $reponse = mailSend();
        break;
    case "resetPswd":
        $erreurPswd = egalPswd();
        break;
}