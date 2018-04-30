<?php
switch ($php){
    case "statistic":
        global $sensorType,$sensorName, $sensorHistoric;
        [$sensorType,$sensorName, $sensorHistoric] = getHistoric($GLOBALS['roomId'], $PDO);
        break;
    case "signUp":
        signUp($PDO);
        break;
}
