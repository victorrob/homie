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

//admin page

function getUser($userTypes, $PDO){
    global $users;
    $users = [];
    foreach ($userTypes as $userType) {
        $req = $PDO->prepare("SELECT `name`, firstName, mail, phone, `type`, birthDate, address, zipCode, city, country FROM `user` WHERE `type` = ?");
        $req->execute([$userType]);
        while($data = $req->fetch()){
            array_push($users, $data);
        }
    }

}
function setUserInfo($PDO){
    if($_REQUEST['deleteUser'] == 'delete'){
        $keys = array_keys($_REQUEST['user']);
        foreach ($keys as $key){
            $req = $PDO->prepare("DELETE FROM user WHERE mail = ?");
            $req->execute([$key]);
            $req->closeCursor();
        }
    }
    else if($_REQUEST['deleteUser'] == 'add'){
        echo var_dump($_REQUEST['type']['new']);
    }
    else{
        $keys = array_keys($_REQUEST['type']);
        foreach ($keys as $key) {
            $req = $PDO->prepare("UPDATE user SET type = ? WHERE mail = ?");
            $req->execute([$_REQUEST['type'][$key], $key]);

        }
    }
}

//get all value and date of historic of one specific room

function getHistoric($PDO){
    $req = $PDO->prepare("SELECT type, date, value FROM sensor INNER JOIN data ON sensor.idSensor = data.idSensor WHERE idRoom = ?");
    $req->execute([$_SESSION['idRoom']]);
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

function getRoomInfo($actuatorList, $sensorList, $PDO){

    $sensorCheck = $actuatorCheck = [];
    foreach ($sensorList as $i){
        array_push($sensorCheck, "");
    }

    foreach ($actuatorList as $i){
        array_push($actuatorCheck, "");
    }
    $req = $PDO->prepare("SELECT room.type AS roomType,name, size FROM room WHERE idRoom = ?");
    $req->execute([$_REQUEST['r']]);
    $data = $req->fetch();
    $req->closeCursor();
    $roomName = $data['name'];
    $roomSize = $data['size'];
    $roomType = $data['roomType'];

    $req = $PDO->prepare("SELECT type AS sensorType FROM sensor WHERE idRoom = ?");
    $req->execute([$_REQUEST['r']]);

    while($data = $req->fetch()){
        for($i=0 ; $i<count($sensorList); $i++){
            if ($data['sensorType'] === $sensorList[$i]){
                $sensorCheck[$i] = "checked";
            }
        }
    }
    $req->closeCursor();
    $req = $PDO->prepare("SELECT type AS actuatorType FROM actuator WHERE idRoom = ?");
    $req->execute([$_REQUEST['r']]);

    while($data = $req->fetch()){
        for($i=0 ; $i<count($actuatorList); $i++){
            if ($data['actuatorType'] === $actuatorList[$i]){
                $actuatorCheck[$i] = "checked";
            }
        }
    }
    $req->closeCursor();

    return [$sensorList, $sensorCheck, $actuatorList, $actuatorCheck, $roomType, $roomSize, $roomName];
}

function setRoomInfo($PDO)
{
    if ($_GET['r'] == -1) {
        $req = $PDO->prepare('INSERT INTO room(idResidence, size, name, type) 
                    VALUES(?,?,?,?)');
        $req->execute([$_SESSION['idResidence'],$_REQUEST['size'], $_REQUEST['name'], $_REQUEST['type']]);
        $idRoom = $PDO->lastInsertId();
        foreach (array_keys($_REQUEST['sensor']) as $sensor) {
            $PDO->exec('INSERT INTO sensor(idRoom,type)
                    VALUES(\'' . $idRoom . '\',\'' . $sensor . '\')');
        }
        foreach (array_keys($_REQUEST['actuator']) as $actuator) {
            $PDO->exec('INSERT INTO actuator(idRoom,type)
                    VALUES(\'' . $idRoom . '\',\'' . $actuator . '\')');
        }
    }
    else if($_REQUEST['deleteRoom'] == 'delete'){
        del('room', $_GET['r'], $PDO);
        del('sensor', $_GET['r'], $PDO);
        del('actuator', $_GET['r'], $PDO);
    }
    else{
        echo '<br/> sensor = '.print_r($_REQUEST['sensor']);
        addOrDont('sensor', array_keys($_REQUEST['sensor']), $_GET['r'], $PDO);
        addOrDont('actuator', array_keys($_REQUEST['actuator']), $_GET['r'], $PDO);
        $req = $PDO->prepare("UPDATE room SET name = ?, type = ?, size = ? WHERE idRoom = ?");
        $req->execute([$_REQUEST['name'], $_REQUEST['type'], $_REQUEST['size'], $_REQUEST['r']]);
    }
}

function del($table, $id, $PDO){
    $req = $PDO->prepare('DELETE FROM '.$table.' WHERE idRoom = ?');
    $req->execute([$id]);
    $req->closeCursor();
}

function addOrDont($table, $values, $id, $PDO){
    $req = $PDO->prepare('SELECT type FROM '.$table.' WHERE idRoom = ?');
    $req->execute([$id]);
    $exist = [];
    while($data = $req->fetch()){
        array_push($exist, $data['type']);
    }
    $req->closeCursor();
    if($values != NULL) {
        $doNotExist = array_diff($exist, $values);
        $add = array_diff($values, $exist);
        foreach ($add as $value) {
            $PDO->exec('INSERT INTO ' . $table . '(type, idRoom) VALUES(\'' . $value . '\',\'' . $id . '\')');

        }
    }
    else{
        $doNotExist = $exist;
    }
    foreach ($doNotExist as $dont) {
        $req = $PDO->prepare('DELETE FROM ' . $table . ' WHERE idRoom = ? AND type = ?');
        $req->execute([$id, $dont]);
        $req->closeCursor();
    }
}

//add user

function signUp($PDO){

    $state = true;

    $name = strip_tags($_POST['name']);

    $firstName = strip_tags($_POST['firstName']);

    $mail = strip_tags($_POST['mail']);
    //verify that the email isn't yet in database

    $confirmEmail = strip_tags($_POST['confirmEmail']);
    if ($confirmEmail != $mail){
        echo 'Erreur, les adresses emails ne sont pas identiques';
        $state = false;
    }


    $phone = strip_tags($_POST['phone']);
    //verify that the phone number isn't yet in database
    $req = $PDO->prepare('SELECT phone FROM user WHERE phone=?');
    $req->execute([$phone]);
    while ($req->fetch()){
        echo "Erreur, numéro de téléphone déjà utilisé";
        $state = false;
    }


    $password = strip_tags($_POST['password']);

    $confirmPassword = strip_tags($_POST['confirmPassword']);
        if ($confirmPassword == $password) {
            $password = hash('sha512', $password);
        }
        else {
            echo 'Erreur, les mots de passes ne sont pas identiques';
            $state = false;
        }

    $type = strip_tags($_POST['type']);

    $birthDate = strip_tags($_POST['birthDate']);

    $address = strip_tags($_POST['address']);

    $zipCode = strip_tags($_POST['zipCode']);

    $city = strip_tags($_POST['city']);

    $country = strip_tags($_POST['country']);

    $productNumber = strip_tags($_POST['productNumber']);

    if ($state) {
        $req = $PDO->prepare("UPDATE user SET name = ?, firstName = ?, phone = ?, password = ?, type = ?, birthDate = ?, address = ?, zipCode = ?, city = ?, country = ? WHERE mail = ? AND productNumber = ?");
        $req->execute([$name, $firstName, $phone, $password, $type, $birthDate, $address, $zipCode, $city, $country, $mail, $productNumber]);
        if ($req->rowCount() == 0) {
            echo 'Erreur, mail et numéro de produits incompatibles';
            return false;
        }
        else {
            return true;
        }
    }
    else {
        return false;
    }
}

//add house in database

function addHouse($PDO){

    $name = strip_tags($_POST['residenceName']);

    $address = strip_tags($_POST['address']);

    $zipCode = strip_tags($_POST['zipCode']);

    $city = strip_tags($_POST['residenceCity']);

    $type = strip_tags($_POST['residenceType']);

    $country = strip_tags($_POST['residenceCountry']);

    $req = $PDO->prepare("INSERT INTO residence(type ,name,address,zipCode,city,country) VALUES(?,?,?,?,?,?)");
    $req->execute([$type, $name, $address, $zipCode, $city, $country]);
    $req->closeCursor();

    $req = $PDO->prepare("INSERT INTO user_residence(idUser, idResidence) VALUES (?,LAST_INSERT_ID())");
    $req->execute([$_SESSION['idClient']]);
    $req->closeCursor();

    $_SESSION["idResidence"] = $PDO->lastInsertId();
}

function deleteHouse($PDO){

    //permet de supprimer une maison, ses pièces, ses capteurs et ses actionneurs

    $req = $PDO -> prepare ("SELECT idRoom FROM room WHERE idResidence = ?");
    $req -> execute($_SESSION['idResidence']);
    while ($id = $req->fetch()){
        del('room', $id, $PDO);
        del('sensor', $id, $PDO);
        del('actuator', $id, $PDO);
    }
    $req -> closeCursor();

    $req = $PDO->prepare('DELETE FROM residence WHERE idResidence = ?');
    $req->execute($_SESSION['idResidence']);

    $req->closeCursor();
}

function getSensorPerRoom($PDO){
    //permet de récupérer le type de pièce, son nom, sa taille, le type de capteur présent pour une pièce donnée
    $req = $PDO->prepare("SELECT room.type AS roomType,name, size, sensor.type AS sensorType, 
                          FROM room INNER JOIN sensor ON room.idRoom = sensor.idRoom 
                          WHERE room.idroom = ?");
    $req->execute([$_SESSION['roomId']]);
    $roomName = "";
    $roomSize = "";
    $roomType = "";
    $sensorList = [];
    while($data = $req->fetch()) {
        $roomName = $data['name'];
        $roomSize = $data['size'];
        $roomType = $data['roomType'];
        array_push($sensorList,$data['sensorType']);
    }
    return [$sensorList, $roomType, $roomSize, $roomName];
}

//home
function getHome($PDO, $id) {
    $residences = [];
    $rooms = [];
    $absent = '';
    $req = $PDO->prepare('SELECT name, residence.idResidence FROM residence INNER JOIN user_residence ON residence.idResidence = user_residence.idResidence WHERE user_residence.idUser = ?');
    $req->execute([$id]);
    if ($req->rowcount()!=0) {
        while ($residence = $req->fetch()) {
            $residence['select'] = '';
            array_push($residences, $residence);
        }
        $req->closeCursor();

        if (isset($_POST['residence'])) {
            $_SESSION['idResidence'] = $_POST['residence'];
        } else {
            $_SESSION['idResidence'] = $residences[0]['idResidence'];
        }

        $numberResidence = array_search($_SESSION['idResidence'], array_column($residences, 'idResidence'));
        $residences[$numberResidence]['select'] = 'selected';

        $req = $PDO->prepare('SELECT absent FROM absent WHERE idResidence = ?');
        $req->execute([$_SESSION['idResidence']]);
        if ($req->fetch()['absent'] == 1) {
            $absent = 'checked';
        } else {
            $absent = '';
        }
        $req->closeCursor();

        $req = $PDO->prepare('SELECT name, idRoom FROM room WHERE idResidence = ?');
        $req->execute([$_SESSION['idResidence']]);
        while ($room = $req->fetch()){
            $req1 = $PDO->prepare('SELECT idActuator, type, state, auto, opening, closing, value FROM actuator WHERE idRoom = ?');
            $req1->execute([$room['idRoom']]);
            $room['lumière']['existence'] = 'none';
            $room['volet']['existence'] = 'none';
            $room['chauffage']['existence'] = 'none';
            $room['ventilation']['existence'] = 'none';
            while ($actuator = $req1->fetch()){
                if ($actuator['type'] == 'lumière'){
                    $room['lumière']['existence'] = 'flex';
                    if ($actuator['state'] == 1){
                        $room['lumière']['state'] = 'checked';
                    }
                    else{
                        $room['lumière']['state'] = '';
                    }
                }
                elseif ($actuator['type'] == 'volet'){
                    $room['volet']['existence'] = 'flex';
                    if ($actuator['state'] == 1){
                        $room['volet']['state'] = 'checked';
                    }
                    else{
                        $room['volet']['state'] = '';
                    }
                    if ($actuator['auto'] == 1){
                        $room['volet']['auto'] = 'checked';
                    }
                    else{
                        $room['volet']['auto'] = '';
                    }
                    $room['volet']['opening'] = $actuator['opening'];
                    $room['volet']['closing'] = $actuator['closing'];
                }
                elseif ($actuator['type'] == 'chauffage'){
                    $room['chauffage']['existence'] = 'flex';
                    $room['chauffage']['value'] = $actuator['value'];
                }
                elseif ($actuator['type'] == 'ventilation'){
                    $room['ventilation']['existence'] = 'flex';
                    $room['ventilation']['value'] = $actuator['value'];
                }
            }
            $req1->closeCursor();
            $req1 = $PDO->prepare('SELECT idSensor, type FROM sensor WHERE idRoom = ?');
            $req1->execute([$room['idRoom']]);
            $room['température']['existence'] = 'none';
            $room['humidité']['existence'] = 'none';
            $room['CO2']['existence'] = 'none';
            $room['pression']['existence'] = 'none';
            $room['luminosité']['existence'] = 'none';
            while ($sensor = $req1->fetch()){
                if ($sensor['type'] == 'température'){
                    $room['température']['existence'] = 'flex';
                    $req2 = $PDO->prepare('SELECT value FROM data WHERE idSensor = ? ORDER BY date DESC LIMIT 1');
                    $req2->execute([$sensor['idSensor']]);
                    $room['température']['value'] = $req2->fetch()['value'];
                    $req2->closeCursor();
                }
                else if ($sensor['type'] == 'humidité'){
                    $room['humidité']['existence'] = 'flex';
                    $req2 = $PDO->prepare('SELECT value FROM data WHERE idSensor = ? ORDER BY date DESC LIMIT 1');
                    $req2->execute([$sensor['idSensor']]);
                    $room['humidité']['value'] = $req2->fetch()['value'];
                    $req2->closeCursor();
                }
                else if ($sensor['type'] == 'CO2'){
                    $room['CO2']['existence'] = 'flex';
                    $req2 = $PDO->prepare('SELECT value FROM data WHERE idSensor = ? ORDER BY date DESC LIMIT 1');
                    $req2->execute([$sensor['idSensor']]);
                    $room['CO2']['value'] = $req2->fetch()['value'];
                    $req2->closeCursor();
                }
                else if ($sensor['type'] == 'pression'){
                    $room['pression']['existence'] = 'flex';
                    $req2 = $PDO->prepare('SELECT value FROM data WHERE idSensor = ? ORDER BY date DESC LIMIT 1');
                    $req2->execute([$sensor['idSensor']]);
                    $room['pression']['value'] = $req2->fetch()['value'];
                    $req2->closeCursor();
                }
                else if ($sensor['type'] == 'luminosité'){
                    $room['luminosité']['existence'] = 'flex';
                    $req2 = $PDO->prepare('SELECT value FROM data WHERE idSensor = ? ORDER BY date DESC LIMIT 1');
                    $req2->execute([$sensor['idSensor']]);
                    $room['luminosité']['value'] = $req2->fetch()['value'];
                    $req2->closeCursor();
                }
            }
            $req1->closeCursor();
            array_push($rooms, $room);
        }
    }
    $req->closeCursor();

    return [$residences, $absent, $rooms];
}

function setHome($PDO) {
    if (isset($_SESSION['idResidence'])) {
        if (isset($_POST['habitationLight'])) {
            if (isset($_POST['light'])) {
                $state = 1;
            } else {
                $state = 0;
            }
            $req = $PDO->prepare('SELECT idRoom FROM room WHERE idResidence = ?');
            $req->execute([$_SESSION['idResidence']]);
            while ($idRoom = $req->fetch()['idRoom']) {
                $req1 = $PDO->prepare('UPDATE actuator SET state = ? WHERE idRoom = ? AND type = ?');
                $req1->execute([$state, $idRoom, 'lumière']);
                $req1->closeCursor();
            }
            $req->closeCursor();
        }
        else if (isset($_POST['habitationShutter'])) {
            if (isset($_POST['shutter'])) {
                $state = 1;
            } else {
                $state = 0;
            }
            if (isset($_POST['auto'])) {
                $auto = 1;
            } else {
                $auto = 0;
            }
            $opening = $_POST['opening'];
            $closing = $_POST['closing'];
            $req = $PDO->prepare('SELECT idRoom FROM room WHERE idResidence = ?');
            $req->execute([$_SESSION['idResidence']]);
            while ($idRoom = $req->fetch()['idRoom']) {
                $req1 = $PDO->prepare('UPDATE actuator SET state = ?, auto = ?, opening = ?, closing = ? WHERE idRoom = ? AND type = ?');
                $req1->execute([$state, $auto, $opening, $closing, $idRoom, 'volet']);
                $req1->closeCursor();
            }
            $req->closeCursor();
        }
        else if (isset($_POST['habitationHeating'])) {
            $heating = $_POST['heating'];
            $req = $PDO->prepare('SELECT idRoom FROM room WHERE idResidence = ?');
            $req->execute([$_SESSION['idResidence']]);
            while ($idRoom = $req->fetch()['idRoom']) {
                $req1 = $PDO->prepare('UPDATE actuator SET value = ? WHERE idRoom = ? AND type = ?');
                $req1->execute([$heating, $idRoom, 'chauffage']);
                $req1->closeCursor();
            }
            $req->closeCursor();
        }
        else if (isset($_POST['habitationVentilation'])) {
            $ventilation = $_POST['ventilation'];
            $req = $PDO->prepare('SELECT idRoom FROM room WHERE idResidence = ?');
            $req->execute([$_SESSION['idResidence']]);
            while ($idRoom = $req->fetch()['idRoom']) {
                $req1 = $PDO->prepare('UPDATE actuator SET value = ? WHERE idRoom = ? AND type = ?');
                $req1->execute([$ventilation, $idRoom, 'ventilation']);
                $req1->closeCursor();
            }
            $req->closeCursor();
        }
        else if (isset($_POST['habitationAbsent'])) {
            $req = $PDO->prepare('UPDATE absent SET absent = ? WHERE idResidence = ?');
            if (isset($_POST['absent'])) {
                $req->execute([1, $_SESSION['idResidence']]);
            } else {
                $req->execute([0, $_SESSION['idResidence']]);
            }
            $req->closeCursor();
        }
    }
}

//absentFactors
function absentFactors($PDO)
{
    if (isset($_POST['absentFactors'])) {
        if (isset($_POST['lightAbsent'])) {
            $light = 1;
        }
        else {
            $light = 0;
        }
        if (isset($_POST['shutterAbsent'])) {
            $shutter = 1;
        }
        else {
            $shutter = 0;
        }
        if (isset($_POST['autoAbsent'])) {
            $auto = 1;
        }
        else {
            $auto = 0;
        }
        if (isset($_POST['openingAbsent'])) {
            $opening = $_POST['openingAbsent'];
        }
        else {
            $opening = null;
        }
        if (isset($_POST['closingAbsent'])) {
            $closing = $_POST['closingAbsent'];
        }
        else {
            $closing = null;
        }
        if (isset($_POST['temperatureAbsent'])) {
            $heating = $_POST['temperatureAbsent'];
        }
        else {
            $heating = null;
        }
        if (isset($_POST['ventilationAbsent'])) {
            $ventilation = $_POST['ventilationAbsent'];
        }
        else {
            $ventilation = null;
        }
        $req = $PDO->prepare('UPDATE absent SET light = ?, shutter = ?, auto = ?, opening = ?, closing = ?, heating = ?, ventilation =? WHERE idResidence = ?');
        $req->execute([$light, $shutter, $auto, $opening, $closing, $heating, $ventilation, $_SESSION['idResidence']]);
        $req->closeCursor();
    }
    $req = $PDO->prepare('SELECT * FROM absent WHERE idResidence = ?');
    $req->execute([$_SESSION['idResidence']]);
    $absent = $req->fetch();
    $absentFactors = [];
    if ($absent['light'] == 1) {
        $absentFactors['light'] = 'checked';
    }
    else {
        $absentFactors['light'] = '';
    }
    if ($absent['shutter'] == 1) {
        $absentFactors['shutter'] = 'checked';
    }
    else {
        $absentFactors['shutter'] = '';
    }
    if ($absent['auto'] == 1) {
        $absentFactors['auto'] = 'checked';
    }
    else {
        $absentFactors['auto'] = '';
    }
    $absentFactors['opening'] = $absent['opening'];
    $absentFactors['closing'] = $absent['closing'];
    $absentFactors['heating'] = $absent['heating'];
    $absentFactors['ventilation'] = $absent['ventilation'];
    $req->closeCursor();
    $req = $PDO->prepare('SELECT name FROM residence WHERE idResidence = ?');
    $req->execute([$_SESSION['idResidence']]);
    $absentFactors['name'] = $req->fetch()['name'];
    $req->closeCursor();
    return $absentFactors;
}

function verify($PDO)
{

    if (isset($_POST['connect']))
    {
        $mail = htmlspecialchars($_POST['mail']);
        $password = hash("sha512",$_POST['password']);
        if(!empty($password) AND !empty($mail)){
            $requser= $PDO->prepare("SELECT * FROM user WHERE mail = ? AND password = ?");
            $requser->execute(array($mail,$password));
            $userexist = $requser->rowCount();
            if($userexist==1){
                $_SESSION['idUser'] = $requser->fetch()['idUser'];
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

function mailSend($PDO){

    $reponse = '';
    if (isset($_POST['okmail']) && verifyMail($PDO)) {
        $passPassword = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $passPassword = str_shuffle($passPassword);

        $header="MIME-Version: 1.0\r\n";
        $header.='From:"gmail.com"<support@gmail.com>'."\n";
        $header.='Content-Type:text/html; charset=utf-8'."\n";
        $header.='Content-Transfer-Encoding: 8bit';

        $message='
<html>
        <body>
            <div align="center">
                    Veuillez appuyer sur le lien, pour changer de mot de passe :
                    <a href="http://localhost/homie/index.php?p=resetPassword&h='.$passPassword.'"> changervotremotdepasse</a>
            </div>
        </body>
</html>

';
        $req= $PDO->prepare("UPDATE user SET passPassword= ? WHERE mail= ?");
        $req->execute(array($passPassword, $_POST['mail']));
        $req->closeCursor();


        mail($_POST['mail'], "Changement de mot de passe", $message, $header);
        $reponse = 'le mail a été envoyé !';



    }

    return $reponse;
}

$erreurPswd='';

function egalPswd(){


    if($_POST['newPassword']!= $_POST['newPassword2']){
        echo 'Vos mots de passes ne correspondents pas !';
        return false;
    }
    else{
        return true;
    }

}

function verifyMail($PDO){
    $mailInput=$_POST['mail'];
    if (isset($_POST['okmail'])){
        $req= $PDO->prepare("SELECT idUser FROM user WHERE mail = ? ");
        $req->execute([$mailInput]);
        $mailExist=$req->rowCount();
        $req->closeCursor();

        if($mailExist==1){
            return true;
        }
        else {
            echo 'Votre adresse mail est introuvable ! ';
            return false;
        }
    }
}


function changePswd($PDO)
{
    $h=$_GET['h'];
    $req= $PDO->prepare("UPDATE user SET password= ? WHERE passPassword= ?");
    $req->execute(array(hash("sha512",$_POST['newPassword']),$h));
    $req->closeCursor();
}



function resetPassPassword($PDO)
{
    $req= $PDO->prepare("UPDATE user SET passPassword= ? WHERE passPassword=? ");
    $req->execute([null, $_GET['h']]);
    $req->closeCursor();

}




function verifyPPswd($PDO)
{

    $req= $PDO->prepare("SELECT passPassword from user WHERE passPassword=? ");
    $req->execute([$_GET['h']]);
    $passPassword=$req->rowCount();
    $req->closeCursor();


    if ($passPassword==1) {
        changePswd($PDO);
        resetPassPassword($PDO);
    } else {
        echo ' Bien tenté !';
    }


}



    function session1($PDO)
    {
        $mailInput=$_POST['mail'];
        $req= $PDO->prepare("SELECT idUser FROM user WHERE mail = ? ");
        $req->execute([$mailInput]);

        echo $req;

    }



function profileGet($PDO,$id){
    $userdata=[];
    $req = $PDO->prepare('SELECT * FROM `user` WHERE `idUser`=?');
    $req->execute([$id]);
    while($userData = $req->fetch()){
        $name = htmlspecialchars($userData['name']);
        $firstName = htmlspecialchars($userData['firstName']);
        $birthDate = htmlspecialchars($userData['birthDate']);
        $email = htmlspecialchars($userData['mail']);
        $address = htmlspecialchars($userData['address']);
        $phone = htmlspecialchars($userData['phone']);
        $password = $userData['password'];
    }
    $req->closeCursor();
    return([$name,$firstName,$birthDate,$email,$address,$phone,$password]);
}

function profilePut($PDO,$namePut,$firstNamePut,$birthPut,$emailPut,$addressPut,$phonePut,$passwordPut,$id){
 
    if ($namePut!=""){
        $req = $PDO->prepare('UPDATE `user` SET `name`= ? WHERE `idUser` = ?');
        $req->execute([$namePut,$id]);
        $req->closeCursor();
    }
    if ($firstNamePut!=""){
        $req = $PDO->prepare('UPDATE `user` SET `firstName`= ? WHERE `idUser` = ?');
        $req->execute([$firstNamePut,$id]);
        $req->closeCursor();
    }
    if ($birthPut!=""){
        $req = $PDO->prepare('UPDATE `user` SET `birthDate`= ? WHERE `idUser` = ?');
        $req->execute([$birthPut,$id]);
        $req->closeCursor();
    }
    if ($emailPut!=""){
        $req = $PDO->prepare('UPDATE `user` SET `mail`= ? WHERE `idUser` = ?');
        $req->execute([$emailPut,$id]);
        $req->closeCursor();
    }
    if ($addressPut!=""){
        $req = $PDO->prepare('UPDATE `user` SET `address`= ? WHERE `idUser` = ?');
        $req->execute([$addressPut,$id]);
        $req->closeCursor();
    }
    if ($phonePut!=""){
        $req = $PDO->prepare('UPDATE `user` SET `phone`= ? WHERE `idUser` = ?');
        $req->execute([$phonePut,$id]);
        $req->closeCursor();
    }
    if ($passwordPut!=""){
        $req = $PDO->prepare('UPDATE `user` SET `password`= ? WHERE `idUser` = ?');
        echo $passwordPut." - ".$id;
        $req->execute([$passwordPut,$id]);
        $req->closeCursor();
    }
}

function verfMail($email){
    $iarg1 = 0;
    $iarg2 = 0;
    if($email == ''){
        return(true);
    }
    for($i = 0; $i <strlen($email);$i++){
        if($email[$i]=='@'){
            $iarg1 = $i;
        }
        if($email[$i]=='.'){
            $iarg2 = $i;
        }
    }
    if($iarg2>=2 && ($iarg2-$iarg1)>2 && (strlen($email)-$iarg2)>2){
        return(true);
    }
    return(false);
}


function verfTel($tel) {
    $number='0123456789';
    if($tel == ''){
        return(true);
    }
    if(strlen($tel)==10){
        for ($i = 0; $i < 10; $i++) {
            if (strpos($number,$tel[$i]) != false) {
                return(true);
            }
        }
    }
    return(false);
}

function profilePOST($PDO){
    $error='';
    if (isset($_POST['name'])|| isset($_POST['firstName'])||isset($_POST['birth'])|| isset($_POST['email'])||isset($_POST['address'])|| isset($_POST['phone'])||isset($_POST['password1'])){
        if ($_POST['name'] != '' ||$_POST['firstName'] != '' ||$_POST['birth'] != '' ||$_POST['email1'] != '' ||$_POST['address'] != '' ||$_POST['phone'] != '' ||$_POST['password1'] != '') {

            $_POST['password']=hash('sha512',$_POST['password']);
            $id = $_SESSION['idUser'];
            [$name,$firstName,$birthDate,$email,$address,$phone,$password] = profileGet($PDO,$id);
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
                if ($_POST['email1'] != ""){
                    if($_POST['email1'] == $_POST['email2']){
                        if(verfMail($_POST['email1'])){
                            $emailModif=$_POST['email1'];   
                        }else{
                            $emailModif="";
                            $error=$error.'ERREUR : mail invalide </br>';
                        }
                    }else{
                        $emailModif="";
                        $error=$error.'ERREUR : les nouveaux mails ne sont pas identiques <br/>';
                    }
                }else{
                    $emailModif="";
                }
                if ($_POST['address'] != ""){
                    $addressModif=$_POST['address'];
                }else{
                    $addressModif="";
                }
                if ($_POST['phone'] != ""){
                    if(verfTel($_POST['phone'])){
                        $phoneModif=$_POST['phone'];
                    }else{
                        $phoneModif="";
                        $error=$error.'ERREUR : numero de telephone invalide';    
                    }
                }else{
                    $phoneModif="";
                }
                if ($_POST['password1'] != ""){
                    if($_POST['password1'] == $_POST['password2']){
                        $password1Modif=hash('sha512',$_POST['password1']);
                    }else{
                        $password1Modif="";
                        $error=$error.'ERREUR : les nouveaux mot de passe ne sont pas identiques <br/>';
                    }
                }else{
                    $password1Modif="";
                }
                profilePut($PDO,$nameModif,$firstNameModif,$birthModif,$emailModif,$addressModif,$phoneModif,$password1Modif,$id);
            }else{
                $error='ERREUR : mauvais mot de passe! <br/>'.$error;
            }
        }

    }
    return([$error]);
}

function installateur($PDO) {
    $req = $PDO->prepare('SELECT type FROM user WHERE idUser = ?');
    $req->execute([$_SESSION['idUser']]);
    $type = $req->fetch()['type'];
    $req->closeCursor();
    return $type;
}

function installateurPage($PDO) {
    $mail = strip_tags($_POST['mailClient']);
    $req = $PDO->prepare('SELECT idUser FROM user WHERE mail = ?');
    $req->execute([$mail]);
    if ($req->rowcount() == 0) {
        $productNumber = randomString(10);
        $req1 = $PDO->prepare('INSERT INTO user (mail,productNumber) VALUES (?,?)');
        $req1->execute([$mail, $productNumber]);
        $req1->closeCursor();
        $idClient = $PDO->lastInsertId();
    }
    else {
        $idClient = $req->fetch()['idUser'];
    }
    $req->closeCursor();
    $_SESSION['idClient'] = $idClient;
}

function randomString($length){
    $chars = '0123456789abcdefghijklmnopqrstuvwxyz';
    $string = '';
    for($i=0; $i<$length; $i++){
        $string .= $chars[rand(0, strlen($chars)-1)];
    }
    return $string;
}



// FONCTIONS NICOLAS
/*
<?php
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=requete;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
*/


//QUESTION FUNCTIONS


function question_title($bdd){
    $req = $bdd->query('SELECT title FROM questions ');
    $title=new ArrayObject(array());
    while ($donnees = $req->fetch()){
        $title->append( $donnees['title']);
    }

    $req->closeCursor();
return $title;
}

function question_text($bdd){
    $req = $bdd->query('SELECT texte FROM questions ');
    $text=new ArrayObject(array());
    while ($donnees = $req->fetch()){
        $text->append( strip_tags($donnees['texte']));
    }

    $req->closeCursor();
return $text;
}

//Nombre de questions à afficher

function question_count($bdd){
    $count=-1;
    $title=new ArrayObject(array());
    $req = $bdd->query('SELECT title FROM questions ');
    while ($donnees = $req->fetch()){
        $title->append( $donnees['title']);
        $count+=1;
    }

    $req->closeCursor();
return $count;
}







//REQUEST FUNCTIONS


//date du problème

function request_date($bdd){
    $req = $bdd->query('SELECT request_date FROM requests ');
    $date=new ArrayObject(array());
    while ($donnees = $req->fetch()){
        $date->append( $donnees['request_date']);
    }

    $req->closeCursor();
return $date;
}




//type du problème

function request_type($bdd,$user_id,$admin){
    if ($admin==true){
            
        $req = $bdd->query('SELECT problem_type FROM requests WHERE answer IS NULL ORDER BY id_user');
        $type=new ArrayObject(array());
        while ($donnees = $req->fetch()){
            $type->append( $donnees['problem_type']);
        }

        $req->closeCursor();
        return $type;           
    }

    else{
        
        $req = $bdd->query('SELECT problem_type FROM requests WHERE id_user ='.$user_id.' ');
        $type=new ArrayObject(array());
        while ($donnees = $req->fetch()){
            $type->append( $donnees['problem_type']);
        }

        $req->closeCursor();
        return $type;
    }




}

function request_id($bdd,$user_id,$admin){
    if ($admin==true){
            
        $req = $bdd->query('SELECT id_request FROM requests WHERE answer IS NULL ORDER BY id_user');
        $id=new ArrayObject(array());
        while ($donnees = $req->fetch()){
            $id->append( $donnees['id_request']);
        }

        $req->closeCursor();
        return $id;         
    }

    else{
        
        $req = $bdd->query('SELECT id_request FROM requests WHERE id_user ='.$user_id.' ');
        $id=new ArrayObject(array());
        while ($donnees = $req->fetch()){
            $id->append( $donnees['id_request']);
        }

        $req->closeCursor();
        return $id;
    }




}


//texte du problème


function request_problem($bdd,$user_id,$admin){
    if ($admin==true){
        
        $req = $bdd->query('SELECT problem FROM requests WHERE answer IS NULL ORDER BY id_user');
        $problem=new ArrayObject(array());
        while ($donnees = $req->fetch()){
            $problem->append( strip_tags($donnees['problem']));
        }

        $req->closeCursor();
        return $problem;            
    }

    else{
        $req = $bdd->query('SELECT problem FROM requests WHERE id_user='.$user_id.' ');
        $problem=new ArrayObject(array());
        while ($donnees = $req->fetch()){
            $problem->append( strip_tags($donnees['problem']));
        }

        $req->closeCursor();
        return $problem;
    }






    
}

//nombre de requetes à afficher

function request_count($bdd,$user_id,$admin){
    if ($admin==true){
        $count=-1;
        $type=new ArrayObject(array());
        $req = $bdd->query('SELECT problem_type FROM requests WHERE answer IS NULL');
        while ($donnees = $req->fetch()){
            $type->append( $donnees['problem_type']);
            $count+=1;
        }

        $req->closeCursor();
        return $count;          
    }

    else{
        $count=-1;
        $type=new ArrayObject(array());
        $req = $bdd->query('SELECT problem_type FROM requests WHERE id_user= '.$user_id.' ');
        while ($donnees = $req->fetch()){
            $type->append( $donnees['problem_type']);
            $count+=1;
        }

        $req->closeCursor();
        return $count;      
    }



    
}

function request_post($bdd){
        if (isset($_POST['type']) AND isset($_POST['problem'])){
                    $req = $bdd->prepare('INSERT INTO requests(id_user, problem_type, problem) VALUES(:id , :type, :texte)');

                    $req->execute(array(

                     'id' => $_SESSION['user_id'],
                     'type' => strip_tags($_POST['type']),
                     'texte' => strip_tags($_POST['problem']),

                    

                     ));

        }
}


//DISCUSS

function discuss_msg_number($bdd,$user_id,$current_request){
        $req = $bdd->prepare('SELECT answer_number FROM discussion WHERE id_request=? ');
        $req->execute(array($current_request));
        $number=new ArrayObject(array());
        while ($donnees = $req->fetch()){
            $number->append( $donnees['answer_number']);
        }

        $req->closeCursor();
        return $number;         




}

function discuss_message($bdd,$user_id,$current_request){
    $req = $bdd->prepare('SELECT answers FROM discussion WHERE id_request=? ');
    $req->execute(array($current_request));
    $answers=new ArrayObject(array());
    while ($donnees = $req->fetch()){
        $answers->append( strip_tags($donnees['answers']));
    }

    $req->closeCursor();
    return $answers;            






    
}

//nombre de msgs à afficher

function discuss_count($bdd,$user_id,$current_request){
    
    $count=-1;
    $number=new ArrayObject(array());
    $req = $bdd->prepare('SELECT answer_number FROM discussion WHERE id_request=? ');
    $req->execute(array($current_request));
    while ($donnees = $req->fetch()){
        $number->append( $donnees['answer_number']);
        $count+=1;
    }

    $req->closeCursor();
    return $count;          
    


    
}

function discuss_post($bdd,$admin,$current_request,$answer_number){
        if (isset($_POST['answer'])){
                    $req = $bdd->prepare('INSERT INTO discussion(id_request,answer_number, answers, origin_admin) VALUES(:id , :answer_number, :texte, :admin)');

                    $req->execute(array(

                     'id' => $current_request,
                     'answer_number' => $answer_number,
                     'texte' => strip_tags($_POST['answer']),
                     'admin' => $admin,

                     ));

        }
}





function discuss_request_problem($bdd,$current_request,$admin){
        $req = $bdd->prepare('SELECT problem FROM requests WHERE id_request=?');
        $req->execute(array($current_request));
        $problem=new ArrayObject(array());
        while ($donnees = $req->fetch()){
            $problem->append( strip_tags($donnees['problem']));
        }

        $req->closeCursor();
        return $problem;            

    
}

function discuss_request_type($bdd,$current_request,$admin){
        $req = $bdd->prepare('SELECT problem_type FROM requests WHERE id_request=?');
        $req->execute(array($current_request));
        $problem_type=new ArrayObject(array());
        while ($donnees = $req->fetch()){
            $problem_type->append( strip_tags($donnees['problem_type']));
        }

        $req->closeCursor();
        return $problem_type;           

    
}









/*
function discuss_id($bdd,$user_id,$admin){
        $req = $bdd->query('SELECT id_answer FROM requests WHERE ?????');
        $number=new ArrayObject(array());
        while ($donnees = $req->fetch()){
            $number->append( $donnees['answer_number']);
        }

        $req->closeCursor();
        return $number;         



*/



function createCookie() {
    if (isset($_POST['cookie'])) {
        setcookie('mail', $_POST['mail'], time() + 30*24*3600, null, null, false, true);
        $password = hash("sha512",$_POST['password']);
        setcookie('password', $password, time() + 30*24*3600, null, null, false, true);
    }
}

function verifCookie($PDO) {
    if (isset($_COOKIE['mail'])) {
        $req = $PDO->prepare('SELECT idUser FROM user WHERE mail = ? AND password = ?');
        $req->execute([$_COOKIE['mail'], $_COOKIE['password']]);
        if ($req->rowCount() == 1) {
            $_SESSION['idUser'] = $req->fetch()['idUser'];
            return true;
        }
        else {
            return false;
        }
    }
}

function destroyCookie() {
    setcookie('mail', '', time(), null, null, false, true);
    setcookie('password', '', time(), null, null, false, true);
    unset($_COOKIE['mail']);
    unset($_COOKIE['password']);
}