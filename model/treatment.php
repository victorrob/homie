<?php
/**
 * Created by PhpStorm.
 * User: victo
 * Date: 09/04/2018
 * Time: 16:55
 */

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

//add value to the sensor historic's table
for($i = 0; $i<10; $i++){
    $PDO->exec('INSERT INTO historic(sensor_id,room_id,value,day) VALUES(1,10,'.mt_rand(0,50).',\''.adjustDate(2018,4,13+$i).'\')');
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
            array_push($sensorHistoric, 1);
        }
    }
    return $sensorHistoric;
}
