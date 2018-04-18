<?php

$PDO = new PDO('mysql:host=localhost:3306;dbname=homie;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

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
    /*$getRoomId = $PDO->prepare('SELECT room_id FROM room WHERE home_id = :homeId AND roomName = :roomName');
    $getRoomId->execute(array(':homeId' => $homeId, ':roomName' => $roomName));
    $roomId = $getRoomId->fetch()['room_id'];
    $getRoomId->closeCursor();*/
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
            array_push($sensorHistoric, [['value'], ['day']]);
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
        $name=$_POST['name'];
    else
        $name="";

    if (isset($_POST['firstName']))
        $firstName=$_POST['firstName'];
    else
        $firstName="";

    if (isset($_POST['mail']))
        $mail=$_POST['mail'];
    else
        $mail="";

    if (isset($_POST['phone']))
        $phone=$_POST['phone'];
    else
        $phone="";

    if (isset($_POST['password']))
        $password=$_POST['password'];
    else
        $password="";

    if (isset($_POST['type']))
        $type=$_POST['type'];
    else
        $type="";

    if (isset($_POST['birthDate']))
        $birthDate=$_POST['birthDate'];
    else
        $birthDate="";

    if (isset($_POST['address']))
        $address=$_POST['address'];
    else
        $address="";

    if (isset($_POST['zipCode']))
        $zipCode=$_POST['zipCode'];
    else
        $zipCode="";

    if (isset($_POST['city']))
        $city=$_POST['city'];
    else
        $city="";

    if (isset($_POST['country']))
        $country=$_POST['country'];
    else
        $country="";

    $PDO->exec("INSERT INTO user(idUser,name,firstName,mail,phone,password,type,birthDate,address,zipCode,city,country) 
                VALUES('','$name','$firstName','$mail','$phone','$password','$type','$birthDate','$address','$zipCode','$city','$country')");
}