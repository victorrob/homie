<?php
session_start();
?>
<!DOCTYPE HTML>
<html>
    <head>
<?php

include('model/treatment.php');
$php = isset($_GET['p']) ? strip_tags($_GET['p']) : "login";
$_SESSION['homeId'] = 1;
$_SESSION['roomId'] = 1;
$_SESSION['idUser'] = 1;

include("control/request.php");
?>
        <link rel="stylesheet" href="view/css/header.css" />
        <link rel="stylesheet" href="view/css/form.css" />
        <link rel="stylesheet" href="view/css/<?php echo $php ?>.css" />


<title>
    <?php echo $php ?>
</title>
</head>
<body>
<?php

include('view/php/header.php');

if(FALSE == (include 'view/php/' . $php . '.php')){
    include 'view/php/404.php';
}
?>
</body>
</html>
