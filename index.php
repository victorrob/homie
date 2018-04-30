<!DOCTYPE HTML>
<html>
    <head>
<?php

include('model/treatment.php');
$php = isset($_GET['p']) ? strip_tags($_GET['p']) : "login";
$doSmth = (isset($_GET['d'])  and is_bool($_GET['d'])) ? strip_tags($_GET['d']) : false;
$dataNeeded = isset($dataNeeded) ? strip_tags($dataNeeded) : "";
$GLOBALS['homeId'] = 1;
$GLOBALS['roomId'] = 10;
$doSmth = true;
if($doSmth){
    include("control/request.php");
}
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
