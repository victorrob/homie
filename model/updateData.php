<?php

function getLog($obj, $numThread, $PDO){
    $req = $PDO->prepare("SELECT lastThread FROM `server` WHERE obj = ?");
    $req->execute([$obj]);
    while($test = $req->fetch()){
        $lastThread = $test['lastThread'];
    }

    if(!isset($test)){
        $lastThread = 0;
    }
    $req->closeCursor();
    $linkData = getData();

    $keys = ['YYYY', 'MM', 'DD', 'HH', 'mm', 'ss'];
    $threadKey = ['TRA', 'OBJ', 'REQ', 'TYP', 'NUM', 'VAL', 'TIM', 'CHK'];
    $time = [];
    $i=0;
    do{
        foreach ($keys as $key){
            array_push($time, $linkData[1][$i][$key]);
        }
        $thread = implode($time);
        $i++;
        $time = [];
    }while ($lastThread>$thread);
    while ($i < count($linkData[1][$i])){
        $req = $PDO->prepare("SELECT idSensor FROM sensor WHERE idRoom = ? AND type = ?");
        $req->execute([1, $numThread[intval($linkData[1][$i]['NUM'])]]);
        $idSensor = 0;
        while($data = $req->fetch()){
            $idSensor = $data['idSensor'];
        }
        $req->closeCursor();
        $req = $PDO->prepare("INSERT INTO data(idSensor, date, value) VALUES(?, ?, ?)");
        $req->execute([intval($idSensor), $linkData[1][$i]['YYYY'].'-'.$linkData[1][$i]['MM'].'-'.$linkData[1][$i]['DD'], $linkData[1][$i]['VAL']]);
        $req->closeCursor();
        $i++;
    }
    $time = [];
    foreach ($keys as $key){
        array_push($time, $linkData[1][$i-1][$key]);
    }
    $thread = implode($time);
    $req = $PDO->prepare("INSERT INTO server(obj, lastThread) VALUES (?,?) ON DUPLICATE KEY UPDATE lastThread = ?");
    $req->execute([$obj, $thread, $thread]);

}