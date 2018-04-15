<!DOCTYPE HTML>
<html>
    <head>
<?php
include('model/treatment.php');
$t = getHistoric(10, $PDO);
$sensorHistoric1 = $t[1]['value'];
echo print_r($t).'<br\><br\><br\><br\><br\><br\>';
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
