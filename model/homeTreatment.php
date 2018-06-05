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

if (isset($_POST['state'])) {
    if ($_POST['type'] === 'auto') {
        $type = 'volet';
        $req = $PDO->prepare('UPDATE actuator SET auto = ? WHERE idRoom = ? AND type = ?');
    } else {
        $type = $_POST['type'];
        $req = $PDO->prepare('UPDATE actuator SET state = ? WHERE idRoom = ? AND type = ?');
    }
    $req->execute([$_POST['state'], $_POST['idRoom'], $type]);
    $req->closeCursor();
}

if (isset($_POST['time'])) {
    $type = 'volet';
    if ($_POST['type'] === 'opening') {
        $req = $PDO->prepare('UPDATE actuator SET opening = ? WHERE idRoom = ? AND type = ?');
    }
    else if ($_POST['type'] === 'closing') {
        $req = $PDO->prepare('UPDATE actuator SET closing = ? WHERE idRoom = ? AND type = ?');
    }
    $req->execute([$_POST['time'], $_POST['idRoom'], $type]);
    $req->closeCursor();
}

if (isset($_POST['value'])) {
    $req = $PDO->prepare('UPDATE actuator SET value = ? WHERE idRoom = ? AND type = ?');
    $req->execute([$_POST['value'], $_POST['idRoom'], $_POST['type']]);
    $req->closeCursor();
}