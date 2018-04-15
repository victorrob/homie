<!DOCTYPE HTML>
<html>
    <head>
<?php

include('model/treatment.php');
[$sensorType, $sensorName, $sensorHistoric] = getHistoric(1, 'chambre', $PDO);
$php = isset($_GET['p']) ? $_GET['p'] : 'login';
?>
<link rel="stylesheet" href="/view/css/header.css" />
<link rel="stylesheet" href="/view/css/<?php echo $php ?>.css" />
<title>
    <?php echo $php ?>
</title>
</head>
<?php
include('view/php/header.php');
include('view/php/'. $php . '.php');
?>
</html>
