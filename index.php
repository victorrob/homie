<!DOCTYPE HTML>
<html>
    <head>
<?php

include('model/treatment.php');

$php = isset($_GET['p']) ? strip_tags($_GET['p']) : "login";
$doSmth = (isset($_GET['d'])  and ($_GET['d']==="false" or $_GET['d']==="true")) ? strip_tags($_GET['d']) : "true";
$dataNeeded = isset($dataNeeded) ? strip_tags($dataNeeded) : "";
echo $doSmth;

$GLOBALS['homeId'] = 1;
$GLOBALS['roomId'] = 10;

if($doSmth = "true"){
    include("control/request.php");
}

?>
<link rel="stylesheet" href="view/css/header.css" />
<link rel="stylesheet" href="view/css/<?php echo $php ?>.css" />
<title>
    <?php echo $php ?>
</title>
</head>
<?php
include('view/php/header.php');

include('view/php/'. $php . '.php');
?>
</html>
