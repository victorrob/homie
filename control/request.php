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
                createCookie();
                if (installateur($PDO) === 'Installateur') {
                    $php = 'installateurPage';
                }
                else if (installateur($PDO) === 'Administrateur') {
                    $php = 'homeAdmin';
                }
                else {
                    $php = 'home';
                }
            }
            break;
        case 'home':
            setHome($PDO);
            break;
        case 'homeInstallateur':
            setHome($PDO);
            break;
        case 'installateurPage':
            installateurPage($PDO);
            sendNumProduct($PDO);
            $php = 'homeInstallateur';
            break;
        case 'logout':
            $_SESSION = array();
            session_destroy();
            destroyCookie();
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
        case 'deleteHouse':
            deleteHouse($PDO);
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
        case 'contact':
            break;
        case 'discuss':
            $answerNumber= discuss_count($bdd,$_SESSION['user_id'],$current_request) +1;
            discuss_post($bdd,$admin,$current_request,$answer_number);
            break;
        case 'support':
            break;
        case 'requests':
            request_post($bdd);
            break;
        case 'forum':
            break;

    }
}
$erreurEgalPswd='';
$erreurMail='';

// Action to perform when loading the page
switch ($php) {
    case 'login':
        if (verifCookie($PDO)) {
            if (installateur($PDO) === 'Installateur') {
                $php = 'installateurPage';
            }
            else if (installateur($PDO) === 'Administrateur') {
                $php = 'homeAdmin';
            }
            else {
                $php = 'home';
            }
        }
        break;
    case "statistic":
        [$sensorName, $sensorHistoric] = getHistoric($PDO);
        break;
    case "homeAdmin":
        getUser($userType, $PDO);
        break;
    case "home":
        [$residences, $absent, $rooms] = getHome($PDO, $_SESSION['idUser']);
        break;
    case "homeInstallateur":
        [$residences, $absent, $rooms] = getHome($PDO, $_SESSION['idClient']);
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
    case "forgottenPswd":
        $reponse = mailSend($PDO);
        break;
    case 'resetPassword':
        $h=$_GET['h'];
        break;
    case "ChangePswdOk":
        break;
    case 'contact':
        break;
    case 'requests':
        if (installateur($PDO)=='Administrateur'){
                    $admin=true;
                }
                else{
                    $admin=false;
                }
        break;
    case 'discuss':
        if (installateur($PDO)=='Administrateur'){
                    $admin=true;
                }
                else{
                    $admin=false;
                }
        break;
    case 'support':
        break;
    case 'forum':
        break;

}