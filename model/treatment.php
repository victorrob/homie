<?php
try {
    $PDO = new PDO('mysql:host=localhost:3306;dbname=homie;charset=utf8', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
}
catch (Exception $e){
    $PDO = new PDO('mysql:host=victorropttest.mysql.db;dbname=victorropttest;charset=utf8', 'victorropttest', 'Homie2018', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
}

//statistic
function adjustDate($year, $month, $day){
    while($day>28){
        $day = $day-28;
        $month++;
    }
    while($month>12){
        $month = $month-12;
        $year++;
    }
    return $year.'-'.$month.'-'.$day;
}

//get all value and date of historic of one specific room

function getHistoric($roomId, $PDO){
    $req = $PDO->prepare("SELECT type, date, value FROM sensor INNER JOIN data ON sensor.idSensor = data.idSensor WHERE idPiece = ?");
    $req->execute([$roomId]);
    while($data = $req->fetch()){
       $sensorName[count($sensorName)] = $data['type'];
        $sensorHistoric[$data['type']]['value'][count($sensorHistoric[$data['type']]['value'])] = $data['value'];
        $sensorHistoric[$data['type']]['day'][count($sensorHistoric[$data['type']]['day'])] = explode(" ",$data['date'])[0];
    }
    $req->closeCursor();
    return [$sensorName, $sensorHistoric];
}

//add user

function signUp($PDO)
{
    if (isset($_POST['name']))
        $name = strip_tags($_POST['name']);
    else
        return('Erreur, veuillez rentrer un nom');

    if (isset($_POST['firstName']))
        $firstName = strip_tags($_POST['firstName']);
    else
        return ('Erreur, veuillez rentrer un prénom');

    if (isset($_POST['mail']))
        $mail = strip_tags($_POST['mail']);
    else
        return ('Erreur, veuillez rentrer une adresse e-mail');

    if (isset($_POST['phone']))
        $phone = strip_tags($_POST['phone']);
    else
        return ('Erreur, veuillez rentrer un numéro de téléphone');

    if (isset($_POST['password']))
        $password = strip_tags($_POST['password']);
    else
        return('Erreur, veuillez rentrer un mot de passe');

    if (isset($_POST['confirmPassword'])) {
        $confirmPassword = strip_tags($_POST['confirmPassword']);
        if ($confirmPassword == $password)
            $password = hash('sha512', $password);
        else
            return ('Erreur, les mots de passes ne sont pas identiques');
        }
    else
        return('Erreur, veuillez confirmer votre mot de passe');

    if (isset($_POST['type']))
        $type = strip_tags($_POST['type']);


    if (isset($_POST['birthDate'])) {
        $birthDate = strip_tags($_POST['birthDate']);
        if ($birthDate == "0000-00-00")
            return ('Erreur, veuillez entrer votre date de naissance');
    }

    if (isset($_POST['address']))
        $address = strip_tags($_POST['address']);
    else
        return ('Erreur, veuillez entrer votre adresse');

    if (isset($_POST['zipCode'])) {
        $zipCode = strip_tags($_POST['zipCode']);
        if ($zipCode == 0)
            return ('Erreur, veuillez entrer votre code postal');
    }

    if (isset($_POST['city']))
        $city = strip_tags($_POST['city']);
    else
        return ('Erreur, veuillez entrer votre ville');

    if (isset($_POST['country']))
        $country = strip_tags($_POST['country']);
    else
        return('Erreur, veuillez entrer votre pays');

    $PDO->exec("INSERT INTO user(name,firstName,mail,phone,password,type,birthDate,address,zipCode,city,country) 

                VALUES('$name','$firstName','$mail','$phone','$password','$type','$birthDate','$address','$zipCode','$city','$country')");
}

function home($PDO, $idUser)
{
    $req = $PDO->prepare('SELECT name, residence.idResidence FROM residence JOIN user_residence WHERE residence.idResidence = user_residence.idResidence AND user_residence.idUser = ?');
    $req->execute([$idUser]);
    $residences = [];
    $select = [];
    while ($residence = $req->fetch()){
        array_push($residences, $residence);
        $select[$residence['idResidence']] = '';
    }
    $req->closeCursor();

    if (isset($_POST['habitation'])){
        $idResidence = $_POST['habitation'];
        $select[$idResidence] = 'selected';
    }
    else{
        $idResidence = $residences[0]['idResidence'];
    }

    $req = $PDO->prepare('SELECT name, idRoom FROM room WHERE idResidence = ?');
    $req->execute([$idResidence]);
    $rooms = [];
    while ($room = $req->fetch()){
        array_push($rooms, $room);
    }
    $req->closeCursor();

    $light = [];
    $shutter = [];
    $auto = [];
    $opening = [];
    $closing = [];
    $temperature = [];
    $ventilation = [];
    foreach ($rooms as $room){
        $req = $PDO->prepare('SELECT type, state, auto, opening, closing FROM actuator WHERE idRoom = ?');
        $req->execute([$room['idRoom']]);
        while ($actuator = $req->fetch()){
            if ($actuator['type'] == 'light'){
                if ($actuator['state'] == 1){
                    $light[$room['idRoom']] = 'checked';
                }
                else{
                    $light[$room['idRoom']] = '';
                }
            }
            elseif ($actuator['type'] == 'shutter'){
                if ($actuator['state'] == 1){
                    $shutter[$room['idRoom']] = 'checked';
                }
                else{
                    $shutter[$room['idRoom']] = '';
                }
                if ($actuator['auto'] == 1){
                    $auto[$room['idRoom']] = 'checked';
                }
                else{
                    $auto[$room['idRoom']] = '';
                }
                $opening[$room['idRoom']] = $actuator['opening'];
                $closing[$room['idRoom']] = $actuator['closing'];
            }
        }
        $req->closeCursor();
        $req = $PDO->prepare('SELECT idSensor, type FROM sensor WHERE idRoom = ?');
        $req->execute([$room['idRoom']]);
        $req->closeCursor();
        while ($sensor = $req->fetch()){
            if ($sensor['type'] == 'temperature'){
                $req = $PDO->prepare('SELECT date, value FROM data WHERE idSensor = ? SORT BY date DESC');
                $req->execute([$sensor['idSensor']]);
                $temperature[$room['idRoom']] = $req->fetch();
            }
            elseif ($sensor['type'] == 'ventilation'){
                $req = $PDO->prepare('SELECT date, value FROM data WHERE idSensor = ? SORT BY date DESC');
                $req->execute([$sensor['idSensor']]);
                $ventilation[$room['idRoom']] = $req->fetch();
            }
            $req->closeCursor();
        }
        $req->closeCursor();
    }

    return [$residences, $select, $rooms, $light, $shutter, $auto, $opening, $closing, $temperature, $ventilation];
}

function verify($PDO)
{

    if (isset($_POST['connect']))
    {
        $mail = htmlspecialchars($_POST['identifiant']);
        $password = hash('sha512',$_POST['mot_de_passe']);
        if(!empty($password) AND !empty($mail)){
            $requser= $PDO->prepare("SELECT * FROM users WHERE identifiant = ? AND mot_de_passe = ?");
            $requser->execute(array($mail,$password));
            $userexist = $requser->rowCount();
            if($userexist==1){

            }
            else {
                echo 'lauvais identifiant ou mot de passe ';
            }
        }
        else{
            echo "un des champs n'est pas rempli";
        }
    }
}

/*
function profileGet(){
    $req = $PDO->prepare('FROM "user" SELECT * WHERE id=?');
    $data = $req->execute([$_SESSION['id']]);
    while($userData = $data->fetch()){}

    $name = htmlspecialchars($userData['name']);        //$userData['name'] 
    $firstName = htmlspecialchars($userData['firstName']);
    $birthDate = htmlspecialchars($userData['birthDate']);
    $email = htmlspecialchars($userData['email']);
    $address = htmlspecialchars($userData['address']);
    $phone = htmlspecialchars($userData['phone']);
    $password = $userData['password'];
}

function profilePut($namePut,$firstNamePut,$birthPut,$emailPut,$addressPut,$phonePut,$passwordPut){
    if ($namePut!=0){
        $req = $PDO->prepare('UPDATE "user" SET "name"=? WHERE id=?');
        $req->execute([$namePut,$_SESSION['id']]);
    }
    if ($firstNamePut!=0){
        $req = $PDO->prepare('UPDATE "user" SET "firstName"=? WHERE id=?');
        $req->execute([$firstNamePut,$_SESSION['id']]);
    }
    if ($birthPut!=0){
        $req = $PDO->prepare('UPDATE "user" SET "birth"=? WHERE id=?');
        $req->execute([$birthPut,$_SESSION['id']]);
    }
    if ($emailPut!=0){
        $req = $PDO->prepare('UPDATE "user" SET "email"=? WHERE id=?');
        $req->execute([$emailPut,$_SESSION['id']]);
    }
    if ($addressPut!=0){
        $req = $PDO->prepare('UPDATE "user" SET "address"=? WHERE id=?');
        $req->execute([$addressPut,$_SESSION['id']]);
    }
    if ($phonePut!=0){
        $req = $PDO->prepare('UPDATE "user" SET "phone"=? WHERE id=?');
        $req->execute([$phonePut,$_SESSION['id']]);
    }
    if ($passwordPut!=0){
        $req = $PDO->prepare('UPDATE "user" SET "password"=? WHERE id=?');
        $req->execute([$passwordPut,$_SESSION['id']]);
    }
}

function profilePOST($userPost){ // mdp a cripte et gestion des erreur a faire (dans les else) !
    if (isset($_POST['name'])|| isset($_POST['firstName'])||isset($_POST['birth'])|| isset($_POST['email'])||isset($_POST['address'])|| isset($_POST['phone'])||isset($_POST['password1'])){
        $_POST['password']=$_POST['password'];  // mdp a cripte !!!!!
        if($_POST['password']=$password){
            if (isset($_POST['name'])){
                $nameModif=$_POST['name'];
            }else{
                $nameModif=0;
            }
            if (isset($_POST['firstName'])){
                $firstNameModif=$_POST['firstName'];
            }else{
                $firstNameModif=0;
            }
            if (isset($_POST['birth'])){
                $birthModif=$_POST['birth'];
            }else{
                $birthModif=0;
            }
            if (isset($_POST['email'])){
                $emailModif=$_POST['email'];
            }else{
                $emailModif=0;
            }
            if (isset($_POST['address'])){
                $addressModif=$_POST['address'];
            }else{
                $addressModif=0;
            }
            if (isset($_POST['phone'])){
                $phoneModif=$_POST['phone'];
            }else{
                $phoneModif=0;
            }
            if (isset($_POST['password1']) && ($_POST['password1'] == $_POST['password2'])){
                $password1Modif=$_POST['password1'];
            }else{
                $password1Modif=0;
            }
            profilePut($nameModif,$firstNameModif,$birthModif,$emailModif,$addressModif,$phoneModif,$password1Modif);
        }

    }
>>>>>>> 278cd02ef14c1698332522c020d656f85b9403e9

}
*/