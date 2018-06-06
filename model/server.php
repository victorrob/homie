<?php

$ch = curl_init("http://projets-tomcat.isep.fr:8080/appService?ACTION=GETLOG&TEAM=0111");

curl_setopt($ch, CURLOPT_HEADER, FALSE);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$data = curl_exec($ch);
curl_close($ch);
$i=0;
$data_tab = [];
$path = [[], [1,4,1,1,2,4,4,2,4,2,2,2,2,2], [], [1,4,1,1,3,2,4,2,2,2,2,2]];
$keys = [[],['TRA','OBJ','REQ','TYP','NUM','VAL','TIM','CHK', 'YYYY', 'MM', 'DD', 'HH', 'mm', 'ss'], [], ['TRA','OBJ', 'TYP','NBR','DAT','CHK', 'YYYY', 'MM', 'DD', 'HH', 'mm', 'ss']];
$data = str_replace('�', '0', $data);
while($i<strlen($data)){
    switch (substr($data,$i,1)){
        case 1:
            array_push($data_tab, substr($data,$i,33));
            $i += 33;
            break;
        case 3:
            array_push($data_tab, substr($data,$i,26));
            $i += 26;
            break;
        default:
            $i += 80;
    }

}

$linkData = [[],[],[],[]];
for($i=0, $size=count($data_tab); $i<$size; $i++){
    $trame = $data_tab[$i];

    $j = 0;
    $list = [];
    for ($h = 0; $h < count($path[substr($trame,0,1)]); $h++){
        $len = $path[substr($trame,0,1)][$h];
        $key = $keys[substr($trame,0,1)][$h];
        $list += [$key => substr($trame,$j, $len)];
        $j += $len;
    }
    $linkData[substr($trame,0,1)] += [count($linkData[substr($trame,0,1)]) => $list];

}
