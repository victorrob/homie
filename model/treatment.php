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
    $req = $PDO->prepare('SELECT value, day, sensor_id FROM historic WHERE room_id = ? ');
    $req->execute([$roomId]);
    $sensorHistoric = [];
    $sensorType = [1];
    while ($data = $req->fetch()) {
        $sensorId = $data['sensor_id'];
        if(in_array($sensorId, $sensorType)) {
            $sensorHistoric[$sensorId]['value'][] = $data ['value'];
            $sensorHistoric[$sensorId]['day'][] = $data ['day'];
        }
        else{
            array_push($sensorType, $sensorId);
            $sensorHistoric[$sensorId]['value'][] = $data ['value'];
            $sensorHistoric[$sensorId]['day'][] = $data ['day'];
        }
    }
    $req->closeCursor();
    $req = $PDO->prepare('SELECT type, sensor_id FROM sensor');
    $req->execute();
    $sensorName = [];
    for($i = 0; $i<count($sensorType); $i++){
        while ($data = $req->fetch()){
            if($data['sensor_id'] == $sensorType[$i]){
                array_push($sensorName, $data['type']);
                break;
            }
        $req->closeCursor();
    }
    }
    return [$sensorType,$sensorName, $sensorHistoric];
}

//add user
function signUp($PDO){
    if (isset($_POST['name']))
        $name= strip_tags($_POST['name']);
    else
        $name="";

    if (isset($_POST['firstName']))
        $firstName=strip_tags($_POST['firstName']);
    else
        $firstName="";

    if (isset($_POST['mail']))
        $mail=strip_tags($_POST['mail']);
    else
        $mail="";

    if (isset($_POST['phone']))
        $phone= strip_tags($_POST['phone']);
    else
        $phone="";

    if (isset($_POST['password']))
        $password= strip_tags($_POST['password']);
    else
        $password="";

    if (isset($_POST['type']))
        $type=strip_tags($_POST['type']);
    else
        $type="";

    if (isset($_POST['birthDate']))
        $birthDate= strip_tags($_POST['birthDate']);
    else
        $birthDate="";

    if (isset($_POST['address']))
        $address= strip_tags($_POST['address']);
    else
        $address="";

    if (isset($_POST['zipCode']))
        $zipCode= strip_tags($_POST['zipCode']);
    else
        $zipCode="";

    if (isset($_POST['city']))
        $city= strip_tags($_POST['city']);
    else
        $city="";

    if (isset($_POST['country']))
        $country= strip_tags($_POST['country']);
    else
        $country="";

    $PDO->exec("INSERT INTO user(idUser,name,firstName,mail,phone,password,type,birthDate,address,zipCode,city,country) 
                VALUES('','$name','$firstName','$mail','$phone','$password','$type','$birthDate','$address','$zipCode','$city','$country')");
}