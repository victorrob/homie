<?php
try {
    $PDO = new PDO('mysql:host=localhost:3306;dbname=homie;charset=utf8', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
}
catch (Exception $e){
    try{
        $PDO = new PDO('mysql:host=victorropttest.mysql.db;dbname=victorropttest;charset=utf8', 'victorropttest', 'Homie2018', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    }
    catch (Exception $e){
        $PDO = new PDO('mysql:host=localhost:3306;dbname=homie;charset=utf8', 'root', 'root', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
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

function setRoomInfo($PDO)
{
    echo "in";
    if ($_SESSION['roomId'] == +-1) {
        echo '<br/>' . var_dump($_REQUEST) . '<br/>';
        $PDO->exec('INSERT INTO room(idResidence, size, name, type) 
                    VALUES(\'' . $_SESSION['idResidence'] . '\',\'' . $_REQUEST['size'] . '\',\'' . $_REQUEST['name'] . '\',\'' . $_REQUEST['type'] . '\')');
        $idRoom = $PDO->lastInsertId();
        foreach (array_keys($_REQUEST['sensor']) as $sensor) {
            $PDO->exec('INSERT INTO sensor(idRoom,type)
                    VALUES(\'' . $idRoom . '\',\'' . $sensor . '\')');
        }
    }
}

//add user

function signUp($PDO){

    $name = strip_tags($_POST['name']);

    $firstName = strip_tags($_POST['firstName']);

    $mail = strip_tags($_POST['mail']);

    $confirmEmail = strip_tags($_POST['confirmEmail']);
    if ($confirmEmail == $mail)
        return true;
    else{
        echo 'Erreur, les adresses emails ne sont pas identiques';
        return false;
    }

    $phone = strip_tags($_POST['phone']);

    $password = strip_tags($_POST['password']);

    $confirmPassword = strip_tags($_POST['confirmPassword']);
        if ($confirmPassword == $password) {
            $password = hash('sha512', $password);
            return true;
        }
        else
            echo 'Erreur, les mots de passes ne sont pas identiques';
            return false;

    $type = strip_tags($_POST['type']);

    $birthDate = strip_tags($_POST['birthDate']);

    $address = strip_tags($_POST['address']);

    $zipCode = strip_tags($_POST['zipCode']);

    $city = strip_tags($_POST['city']);

    $country = strip_tags($_POST['country']);

    $req = $PDO->prepare("INSERT INTO user(name ,firstName,mail,phone,password,type,birthDate,address,zipCode,city,country) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
    $req->execute([$name,$firstName,$mail,$phone,$password,$type,$birthDate,$address,$zipCode,$city,$country]);
}

//home
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

    $req = $PDO->prepare('SELECT absent FROM absent WHERE idResidence = ?');
    $req->execute([$idResidence]);
    if ($req->fetch()['absent'] == 1) {
        $absent = 'checked';
    }
    else {
        $absent = '';
    }
    $req->closeCursor();

    $req = $PDO->prepare('SELECT name, idRoom FROM room WHERE idResidence = ?');
    $req->execute([$idResidence]);
    $rooms = [];
    while ($room = $req->fetch()){
        $req1 = $PDO->prepare('SELECT type, state, auto, opening, closing, value FROM actuator WHERE idRoom = ?');
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
            elseif ($actuator['type'] == 'Heating'){
                $room['heating'] = $actuator['value'];
            }
            elseif ($actuator['type'] == 'Ventilation'){
                $room['ventilation'] = $actuator['value'];
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
        }
        $req1->closeCursor();
        array_push($rooms, $room);
    }
    $req->closeCursor();

    if (isset($_POST['roomModification'])) {
        for ($i = 0; $i < count($rooms); $i++) {
            if (isset($_POST["light" . $rooms[$i]['idRoom']])) {
                $light = 1;
                $rooms[$i]['light'] = 'checked';
            } else {
                $light = 0;
                $rooms[$i]['light'] = '';
            }
            if (isset($_POST["shutter" . $rooms[$i]['idRoom']])) {
                $shutter = 1;
                $rooms[$i]['shutter'] = 'checked';
            } else {
                $shutter = 0;
                $rooms[$i]['shutter'] = '';
            }
            if (isset($_POST["auto" . $rooms[$i]['idRoom']])) {
                $auto = 1;
                $rooms[$i]['auto'] = 'checked';
            } else {
                $auto = 0;
                $rooms[$i]['auto'] = '';
            }
            if (isset($_POST["opening" . $rooms[$i]['idRoom']])) {
                $opening = $_POST["opening" . $rooms[$i]['idRoom']];
                $rooms[$i]['opening'] = $opening;
            } else {
                $opening = $rooms[$i]['opening'];
            }
            if (isset($_POST["closing" . $rooms[$i]['idRoom']])) {
                $closing = $_POST["closing" . $rooms[$i]['idRoom']];
                $rooms[$i]['closing'] = $closing;
            } else {
                $closing = $rooms[$i]['closing'];
            }
            if (isset($_POST["heating" . $rooms[$i]['idRoom']])) {
                $heating = $_POST["heating" . $rooms[$i]['idRoom']];
                $rooms[$i]['heating'] = $heating;
            }
            else {
                $heating = $rooms[$i]['heating'];
            }
            if (isset($_POST["ventilation" . $rooms[$i]['idRoom']])) {
                $ventilation = $_POST["ventilation" . $rooms[$i]['idRoom']];
                $rooms[$i]['ventilation'] = $ventilation;
            }
            else {
                $ventilation = $rooms[$i]['ventilation'];
            }
            $req = $PDO->prepare('UPDATE actuator SET state = ? WHERE idRoom = ? AND type = ?');
            $req->execute([$light, $rooms[$i]['idRoom'], "Light"]);
            $req->closeCursor();
            $req = $PDO->prepare('UPDATE actuator SET state = ?, auto = ?, opening = ?, closing = ? WHERE idRoom = ? AND type = ?');
            $req->execute([$shutter, $auto, $opening, $closing, $rooms[$i]['idRoom'], "Shutter"]);
            $req->closeCursor();
            $req = $PDO->prepare('UPDATE actuator SET value = ? WHERE idRoom = ? AND type = ?');
            $req->execute([$heating, $rooms[$i]['idRoom'], "Heating"]);
            $req->execute([$ventilation, $rooms[$i]['idRoom'], "Ventilation"]);
            $req->closeCursor();
        }
    }

    if (isset($_POST['habitationLight'])) {
        if (isset($_POST['light'])) {
            $light = 1;
            $checkbox = 'checked';
        } else {
            $light = 0;
            $checkbox = '';
        }
        $req = $PDO->prepare('UPDATE actuator SET state = ? WHERE idRoom = ? AND type = ?');
        for ($i = 0; $i < count($rooms); $i++) {
            $req->execute([$light, $rooms[$i]['idRoom'], "Light"]);
            $rooms[$i]['light'] = $checkbox;
        }
        $req->closeCursor();
    }

    if (isset($_POST['habitationShutter'])) {
        if (isset($_POST['shutter'])) {
            $shutter = 1;
            $checkboxShutter = 'checked';
        } else {
            $shutter = 0;
            $checkboxShutter = '';
        }
        if (isset($_POST['auto'])) {
            $auto = 1;
            $checkboxAuto = 'checked';
        } else {
            $auto = 0;
            $checkboxAuto = '';
        }
        if (isset($_POST['opening'])) {
            $opening = $_POST['opening'];
        }
        else {
            $opening = null;
        }
        if (isset($_POST['closing'])) {
            $closing = $_POST['closing'];
        }
        else {
            $closing = null;
        }
        $req = $PDO->prepare('UPDATE actuator SET state = ?, auto = ?, opening = ?, closing = ? WHERE idRoom = ? AND type = ?');
        for ($i = 0; $i < count($rooms); $i++) {
            $req->execute([$shutter, $auto, $opening, $closing, $rooms[$i]['idRoom'], "Shutter"]);
            $rooms[$i]['shutter'] = $checkboxShutter;
            $rooms[$i]['auto'] = $checkboxAuto;
            $rooms[$i]['opening'] = $opening;
            $rooms[$i]['closing'] = $closing;
        }
        $req->closeCursor();
    }

    if (isset($_POST['habitationHeating'])) {
        if (isset($_POST['heating'])) {
            $heating = $_POST['heating'];
        }
        else {
            $heating = null;
        }
        $req = $PDO->prepare('UPDATE actuator SET value = ? WHERE idRoom = ? AND type = ?');
        for ($i = 0; $i < count($rooms); $i++) {
            $req->execute([$heating, $rooms[$i]['idRoom'], "Heating"]);
            $rooms[$i]['heating'] = $heating;
        }
        $req->closeCursor();
    }

    if (isset($_POST['habitationVentilation'])) {
        if (isset($_POST['ventilation'])) {
            $ventilation = $_POST['ventilation'];
        }
        else {
            $ventilation = null;
        }
        $req = $PDO->prepare('UPDATE actuator SET value = ? WHERE idRoom = ? AND type = ?');
        for ($i = 0; $i < count($rooms); $i++) {
            $req->execute([$ventilation, $rooms[$i]['idRoom'], "Ventilation"]);
            $rooms[$i]['ventilation'] = $ventilation;
        }
        $req->closeCursor();
    }

    if (isset($_POST['habitationAbsent'])) {
        $req = $PDO->prepare('UPDATE absent SET absent = ? WHERE idResidence = ?');
        if (isset($_POST['absent'])) {
            $req->execute([1, $idResidence]);
            $absent = 'checked';
        }
        else {
            $req->execute([0, $idResidence]);
            $absent = '';
        }
        $req->closeCursor();
    }

    return [$residences, $absent, $rooms];
}

//absentFactors
function absentFactors()
{
    
}

function verify($PDO)
{

    if (isset($_POST['connect']))
    {
        $mail = htmlspecialchars($_POST['mail']);
        $password = $_POST['password'];
        if(!empty($password) AND !empty($mail)){
            $requser= $PDO->prepare("SELECT * FROM users WHERE mail = ? AND password = ?");
            $requser->execute(array($mail,$password));
            $userexist = $requser->rowCount();
            if($userexist==1){
                return true;
            }
            else {
                echo 'Mauvais identifiant ou mot de passe ';
                return false;
            }
        }
        else{
            echo "un des champs n'est pas rempli";
        }
    }
}


function profileGet($PDO){
    $id =1;
    $userdata=[];
    $req = $PDO->prepare('SELECT * FROM `user` WHERE `idUser`=?');
    $req->execute([$id]); // $_SESSION['id']
    while($userData = $req->fetch()){
        $name = htmlspecialchars($userData['name']);
        $firstName = htmlspecialchars($userData['firstName']);
        $birthDate = htmlspecialchars($userData['birthDate']);
        $email = htmlspecialchars($userData['mail']);
        $address = htmlspecialchars($userData['address']);
        $phone = htmlspecialchars($userData['phone']);
        $password = $userData['password'];
    }
    return([$name,$firstName,$birthDate,$email,$address,$phone,$password]);
}

function profilePut($PDO,$namePut,$firstNamePut,$birthPut,$emailPut,$addressPut,$phonePut,$passwordPut,$id){
 
    if ($namePut!=""){
        $req = $PDO->prepare('UPDATE `user` SET `name`= ? WHERE `idUser` = ?');
        $req->execute([$namePut,$id]);
    }
    if ($firstNamePut!=""){
        $req = $PDO->prepare('UPDATE `user` SET `firstName`= ? WHERE `idUser` = ?');
        print_r($req);
        $req->execute([$firstNamePut,$id]);
    }
    if ($birthPut!=""){
        $req = $PDO->prepare('UPDATE `user` SET `birthDate`= ? WHERE `idUser` = ?');
        $req->execute([$birthPut,$id]);
    }
    if ($emailPut!=""){
        $req = $PDO->prepare('UPDATE `user` SET `mail`= ? WHERE `idUser` = ?');
        $req->execute([$emailPut,$id]);
    }
    if ($addressPut!=""){
        $req = $PDO->prepare('UPDATE `user` SET `address`= ? WHERE `idUser` = ?');
        $req->execute([$addressPut,$id]);
    }
    if ($phonePut!=""){
        $req = $PDO->prepare('UPDATE `user` SET `phone`= ? WHERE `idUser` = ?');
        $req->execute([$phonePut,$id]);
    }
    if ($passwordPut!=""){
        $req = $PDO->prepare('UPDATE `user` SET `phone`= ? WHERE `idUser` = ?');
        $req->execute([$passwordPut,$id]);
    }
}

function profilePOST($PDO){ // mdp a cripte et gestion des erreur a faire (dans les else) !
    if (isset($_POST['name'])|| isset($_POST['firstName'])||isset($_POST['birth'])|| isset($_POST['email'])||isset($_POST['address'])|| isset($_POST['phone'])||isset($_POST['password1'])){

        [$name,$firstName,$birthDate,$email,$address,$phone,$password] = profileGet($PDO);

        $_POST['password']=$_POST['password'];  // mdp a cripte !!!!!
        // $id = $_SESSION['id'];
        $id = 1; // a supprimer plus tartd
        if($_POST['password']==$password){
            if ($_POST['name'] != ""){
                $nameModif=$_POST['name'];
            }else{
                $nameModif="";
            }
            if ($_POST['firstName'] != ""){
                $firstNameModif=$_POST['firstName'];
            }else{
                $firstNameModif="";
            }
            if ($_POST['birth'] != ""){
                $birthModif=$_POST['birth'];
            }else{
                $birthModif="";
            }
            if ($_POST['email'] != ""){
                $emailModif=$_POST['email'];
            }else{
                $emailModif="";
            }
            if ($_POST['address'] != ""){
                $addressModif=$_POST['address'];
            }else{
                $addressModif="";
            }
            if ($_POST['phone'] != ""){
                $phoneModif=$_POST['phone'];
            }else{
                $phoneModif="";
            }
            if ($_POST['password1'] != "" && ($_POST['password1'] == $_POST['password2'])){
                $password1Modif=$_POST['password1'];
            }else{
                $password1Modif="";
            }
            profilePut($PDO,$nameModif,$firstNameModif,$birthModif,$emailModif,$addressModif,$phoneModif,$password1Modif,$id);
        }else{
            return('ERREUR : movais mot de passe!');
        }

    }
}
function getRoomInfo($idRoom, $PDO){
    $sensorList = ["Temperature", "humidite", "CO2", "pression", "lumière"];
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
    $req->execute([$idRoom]);
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