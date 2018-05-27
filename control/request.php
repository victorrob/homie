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
                if (installateur($PDO)) {
                    $php = 'installateurPage';
                }
                else {
                    $php = 'home';
                }
            }
            break;
        case 'installateurPage':
            installateurPage($PDO);
            $php = 'homeInstallateur';
            break;
        case 'logout':
            session_destroy();
            break;
        case 'resetPassword':
           if (egalPswd()){
               changePswd($PDO);
               $php='ChangePswdOk';
           }
           else{
               $php='resetPassword';
           }
            break;
        case 'addHouse':
            addHouse($PDO);
            break;


        case "profile":
        
            $error = "ERROR: test";
            [$error]=profilePOST($PDO,$_POST);
            echo ($error);
            break;

        case 'sensor':
            $_SESSION['idResidence'] = 2;
            setRoomInfo($PDO);
            $_GET['d']=null;
            break;
    }
}
// Action to perform when loading the page
switch ($php) {
    case "statistic":
        [$sensorName, $sensorHistoric] = getHistoric($PDO);
        break;
    case "home":
        [$residences, $absent, $rooms] = home($PDO, $_SESSION['idUser']);
        break;
    case "homeInstallateur":
        [$residences, $absent, $rooms] = home($PDO, $_SESSION['idClient']);
        break;
    case "absentFactors":
        $absentFactors = absentFactors($PDO);
        break;
    case "sensor":
        [$sensorList, $sensorCheck, $actuatorList, $actuatorCheck, $roomType, $roomSize, $roomName] = getRoomInfo($PDO);
        break;
    case "profile":
        [$name,$firstName,$birthDate,$email,$address,$phone,$password] = profileGet($PDO);
        if (!isset($error)) {
            $error = '';
        }
        break;
    case "login":
        break;
    case "forgottenPswd":
        $reponse = mailSend($PDO);
        echo $reponse;
        break;
    case 'resetPassword':
        $h=$_GET['h'];
        break;
    case "ChangePswdOk":
        break;

}