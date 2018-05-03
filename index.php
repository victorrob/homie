<?php
session_start();
?>
<!DOCTYPE HTML>
<html>
    <head>
<?php

include('model/treatment.php');

$php = isset($_GET['p']) ? strip_tags($_GET['p']) : "login";
$dataNeeded = isset($dataNeeded) ? strip_tags($dataNeeded) : "";

$GLOBALS['homeId'] = 1;
$GLOBALS['roomId'] = 10;
include("control/request.php");
$_POST = array();
$_SESSION['lastPage'] = $php;
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
