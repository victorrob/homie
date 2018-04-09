<!DOCTYPE HTML>
<html>
    <head>
<?php
$php = isset($_GET['p']) ? $_GET['p'] : 'login';
echo '<link rel="stylesheet" href="/view/css/'.$php.'.css" />';
?>
<title>
    <?php echo $php ?>
</title>
</head>
<?php
include('view/php/header.php');
include('view/php/'. $php . '.php');
?>
</html>
