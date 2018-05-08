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
$GLOBALS['roomId'] = 1;
$GLOBALS['idUser'] = 1;

include("control/request.php");
$_POST = array();
$_SESSION['lastPage'] = $php;
?>
<link rel="stylesheet" href="view/css/<?php echo $php ?>.css" />
<link rel="stylesheet" href="view/css/header.css" />
<link rel="stylesheet" href="view/css/form.css" />
<title>
    <?php echo $php ?>
</title>
</head>
<?php

include('view/php/header.php');

if(FALSE == (include 'view/php/' . $php . '.php')){
    include 'view/php/404.php';
}
?>
</html>
