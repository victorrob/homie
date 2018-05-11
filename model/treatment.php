<?php
try {
    $PDO = new PDO('mysql:host=localhost:3306;dbname=homie;charset=utf8', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
}
catch (Exception $e){
    try{
        $PDO = new PDO('mysql:host=victorropttest.mysql.db;dbname=victorropttest;charset=utf8', 'victorropttest', 'Homie2018', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    }
    catch (Exception $e){
        $PDO = new PDO('mysql:host=localhost.mysql.db;dbname=homie;charset=utf8', 'root', 'bonjour', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    }
    
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

function getHistoric($PDO){
    $req = $PDO->prepare("SELECT type, date, value FROM sensor INNER JOIN data ON sensor.idSensor = data.idSensor WHERE idRoom = ?");
    $req->execute([$_SESSION['roomId']]);
    $sensorName = [];
    $sensorHistoric =[];
    while($data = $req->fetch()){
        if(!in_array($data['type'],$sensorName)) {
            $sensorName[count($sensorName)] = $data['type'];
        }
        $sensorHistoric[$data['type']]['value'][count($sensorHistoric[$data['type']]['value'])] = $data['value'];
        $sensorHistoric[$data['type']]['day'][count($sensorHistoric[$data['type']]['day'])] = explode(" ",$data['date'])[0];
    }
    $req->closeCursor();
    return [$sensorName, $sensorHistoric];
}

//add user

function signUp($PDO){
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

//HOME
function home($PDO, $idUser)
{
    $req = $PDO->prepare('SELECT name, residence.idResidence FROM residence JOIN user_residence WHERE residence.idResidence = user_residence.idResidence AND user_residence.idUser = ?');
    $req->execute([$idUser]);
    $residences = [];
    while ($residence = $req->fetch()){
        $residence['select'] = '';
        array_push($residences, $residence);
    }
    $req->closeCursor();

    if (isset($_POST['residence'])){
        $idResidence = $_POST['residence'];
        $numberResidence = array_search($idResidence, array_column($residences, 'idResidence'));
        $residences[$numberResidence]['select'] = 'selected';
    }
    else{
        $idResidence = $residences[0]['idResidence'];
    }

    $req = $PDO->prepare('SELECT name, idRoom FROM room WHERE idResidence = ?');
    $req->execute([$idResidence]);
    $rooms = [];
    while ($room = $req->fetch()){
        $req1 = $PDO->prepare('SELECT type, state, auto, opening, closing FROM actuator WHERE idRoom = ?');
        $req1->execute([$room['idRoom']]);
        while ($actuator = $req1->fetch()){
            if ($actuator['type'] == 'Light'){
                if ($actuator['state'] == 1){
                    $room['light'] = 'checked';
                }
                else{
                    $room['light'] = '';
                }
            }
            elseif ($actuator['type'] == 'Shutter'){
                if ($actuator['state'] == 1){
                    $room['shutter'] = 'checked';
                }
                else{
                    $room['shutter'] = '';
                }
                if ($actuator['auto'] == 1){
                    $room['auto'] = 'checked';
                }
                else{
                    $room['auto'] = '';
                }
                $room['opening'] = $actuator['opening'];
                $room['closing'] = $actuator['closing'];
            }
        }
        $req1->closeCursor();
        $req1 = $PDO->prepare('SELECT idSensor, type FROM sensor WHERE idRoom = ?');
        $req1->execute([$room['idRoom']]);
        while ($sensor = $req1->fetch()){
            if ($sensor['type'] == 'Temperature'){
                $req2 = $PDO->prepare('SELECT value FROM data WHERE idSensor = ? ORDER BY date DESC LIMIT 1');
                $req2->execute([$sensor['idSensor']]);
                $data = $req2->fetch();
                $room['temperature'] = $data['value'];
                $req2->closeCursor();
            }
            elseif ($sensor['type'] == 'Ventilation'){
                $req2 = $PDO->prepare('SELECT value FROM data WHERE idSensor = ? ORDER BY date DESC LIMIT 1');
                $req2->execute([$sensor['idSensor']]);
                $data = $req2->fetch();
                $room['ventilation'] = $data['value'];
                $req2->closeCursor();
            }
        }
        $req1->closeCursor();
        array_push($rooms, $room);
    }
    $req->closeCursor();

    return [$residences, $rooms];
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

function getRoomInfo($PDO){
    $sensorList = ["Temperature", "humidite", "CO2", "pression", "lumière", "camera"];
    $sensorCheck = $actuatorCheck = [];
    foreach ($sensorList as $i){
        array_push($sensorCheck, "");
    }
    $actuatorList = ["chauffage", "lumière", "ventilation"];
    foreach ($actuatorList as $i){
        array_push($actuatorCheck, "");
    }
    $req = $PDO->prepare("SELECT room.type AS roomType,name, size, sensor.type AS sensorType, actuator.type AS actuatorType 
                          FROM room INNER JOIN sensor INNER JOIN actuator ON room.idRoom = sensor.idRoom AND 
                          room.idRoom = actuator.idRoom where room.idroom = ?");
    $req->execute([$_SESSION['roomId']]);
    $roomName = "";
    $roomSize = "";
    $roomType = "";
    while($data = $req->fetch()){
        $roomName = $data['name'];
        $roomSize = $data['size'];
        $roomType = $data['roomType'];
        for($i=0 ; $i<count($sensorList); $i++){
            if ($data['sensorType'] === $sensorList[$i]){
                $sensorCheck[$i] = "checked";
            }
        }
        for($i=0 ; $i<count($actuatorList); $i++){
            if ($data['sensorType'] === $actuatorList[$i]){
                $actuatorCheck[$i] = "checked";
            }
        }

    }
    return [$sensorList, $sensorCheck, $actuatorList, $actuatorCheck, $roomType, $roomSize, $roomName];
}

function setRoomInfo($PDO){
    echo "in";
    if($_SESSION['roomId'] ==+ -1){
        echo '<br/>'.var_dump($_REQUEST).'<br/>';
        $PDO->exec('INSERT INTO room(idResidence, size, name, type) 
                    VALUES(\''.$_SESSION['idResidence'].'\',\''.$_REQUEST['size'].'\',\''.$_REQUEST['name'].'\',\''.$_REQUEST['type'].'\')');
        $idRoom = $PDO->lastInsertId();
        foreach (array_keys($_REQUEST['sensor']) as $sensor) {
            $PDO->exec('INSERT INTO sensor(idRoom,type)
                    VALUES(\'' . $idRoom . '\',\'' . $sensor . '\')');
        }
    }
}