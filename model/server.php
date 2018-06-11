<?php
function getData()
{
    $ch = curl_init("http://projets-tomcat.isep.fr:8080/appService?ACTION=GETLOG&TEAM=G10E");

    curl_setopt($ch, CURLOPT_HEADER, FALSE);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $data = curl_exec($ch);
    curl_close($ch);
    $i = 0;
    $data_tab = [];
    $path = [[], [1, 4, 1, 1, 2, 4, 4, 2, 4, 2, 2, 2, 2, 2], [], [1, 4, 1, 1, 3, 2, 4, 2, 2, 2, 2, 2]];
    $keys = [[], ['TRA', 'OBJ', 'REQ', 'TYP', 'NUM', 'VAL', 'TIM', 'CHK', 'YYYY', 'MM', 'DD', 'HH', 'mm', 'ss'], [], ['TRA', 'OBJ', 'TYP', 'NBR', 'DAT', 'CHK', 'YYYY', 'MM', 'DD', 'HH', 'mm', 'ss']];
    $data = str_replace('�', 'z', $data);
    while ($i < strlen($data)) {
        switch (substr($data, $i, 1)) {
            case 1:
                array_push($data_tab, substr($data, $i, 33));
                $i += 33;
                break;
            case 3:
                array_push($data_tab, substr($data, $i, 25));
                $i += 25;
                break;
            default:
                $i += 80;
        }

    }

    $linkData = [[], [], [], []];
    for ($i = 0, $size = count($data_tab); $i < $size; $i++) {
        $trame = $data_tab[$i];

        $j = 0;
        $list = [];
        for ($h = 0; $h < count($path[substr($trame, 0, 1)]); $h++) {
            $len = $path[substr($trame, 0, 1)][$h];
            $key = $keys[substr($trame, 0, 1)][$h];
            $list += [$key => substr($trame, $j, $len)];
            $j += $len;
        }
        $linkData[substr($trame, 0, 1)] += [count($linkData[substr($trame, 0, 1)]) => $list];
    }
    return $linkData;
}

$linkData = getData();
function sendData($TYP, $NUM, $VAL){

    [$TRA,$OBJ,$REQ] = setBasics();
    $thread = [$TRA , $OBJ , $REQ , fill($TYP, 1) , fill($NUM,2) , fill($VAL, 4)];
    array_push($thread,fill(CHK(implode($thread)), 2));
    $thread = implode($thread);
    $ch = curl_init('http://projets-tomcat.isep.fr:8080/appService?ACTION=COMMAND&TEAM=G10E&TRAME='.$thread);

    curl_setopt($ch, CURLOPT_HEADER, FALSE);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}

function fill($data, $len){
    if(gettype($data)== 'integer'){

    }
    else if(gettype($data) == 'double'){
        $data = round($data * 10) /10;
    }
    else if(gettype($data) == 'string'){
    }
    else{
        echo 'error invalid argument $data';
    }
    $data = strval($data);
    if(strlen($data)>$len){
        return 'error $data is too large';
    }
    else{
        $data = strval($data);
        return sprintf('%\'.0'.$len.'s', $data);
    }
}

function setBasics(){
    $TRA = '1';
    $OBJ = 'G10E';
    $REQ = '1';
    return [$TRA,$OBJ,$REQ];
}

function CHK($thread){
    $threads = str_split($thread);
    $sum = 0;
    foreach ($threads as $val){
        $sum += ord($val);
    }
    $CHK = $sum%256;
    $CHK = ord($CHK);
    return $CHK;
}
