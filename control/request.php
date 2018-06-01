<?php

// Action to perform when leaving the page
if(isset($_GET['d'])) {
    switch (strip_tags($_GET['d'])) {
        case "signUp":
            if(signUp($PDO))
                $php='login';
            else
                $php='signUp';
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
               if(verifyPPswd($PDO)){
                   changePswd($PDO);
                   resetPassPassword($PDO);
                   $php='ChangePswdOk';
               }
           }
           else{
               $php='resetPassword';
             //  $erreurEgalPswd='Vos mots de passes ne correspondent pas !';
           }
            break;

        case 'addHouse':
            addHouse($PDO);
            break;


        case "profile":
        
            $error = "ERROR: test";
            [$error]=profilePOST($PDO);
            echo ($error);
            break;

        case 'sensor':
            setRoomInfo($PDO);
            break;
        case 'homeAdmin':
            setUserInfo($PDO);
            break;
    }
}
$erreurEgalPswd='';
$erreurMail='';

// Action to perform when loading the page
switch ($php) {
    case "statistic":
        [$sensorName, $sensorHistoric] = getHistoric($PDO);
        break;
    case "homeAdmin":
        getUser($userType, $PDO);
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
        [$sensorList, $sensorCheck, $actuatorList, $actuatorCheck, $roomType, $roomSize, $roomName] = getRoomInfo($actuatorList, $sensorList, $PDO);
        break;
    case "profile":
        [$name,$firstName,$birthDate,$email,$address,$phone,$password] = profileGet($PDO,$_SESSION['idUser']);
        if (!isset($error)) {
            $error = '';
        }
        break;
    case "login":
        break;
    case "forgottenPswd":
        $reponse = mailSend($PDO);
        break;
    case 'resetPassword':
        $h=$_GET['h'];
        break;
    case "ChangePswdOk":
        break;


}