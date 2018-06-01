<?php
session_start();
?>
<!DOCTYPE HTML>
<html>
    <head>
<?php
include ('control/variable.php');
include('model/treatment.php');
$php = isset($_GET['p']) ? strip_tags($_GET['p']) : "login";
$_SESSION['idRoom'] = isset($_GET['r']) ? strip_tags($_GET['r']) : "";

$headerLogin = ['login', 'forgottenPswd', 'resetPassword', 'signUp', 'ChangePswdOk', 'conditionsOfUse', 'signUpInstallateur'];

if (!isset($_SESSION['idUser']) && !in_array($php, $headerLogin)) {
    $php = 'login';
}


include("control/request.php");

if(isset($_SESSION['idUser']) && in_array($php, $headerLogin)){
    $php = 'home';
}
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

if (in_array($php, $headerLogin)) {
    include('view/php/headerLogin.php');
}
else {
    if (installateur($PDO)) {
        include('view/php/headerInstallateur.php');
    }
    else {
        include('view/php/header.php');
    }
}
if(FALSE == (include 'view/php/' . $php . '.php')){
    include 'view/php/404.php';
}

?>
</body>
<script type="text/javascript" src="view/js/<?php echo $php ?>.js"></script>
</html>
