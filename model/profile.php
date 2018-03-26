<?php
	include 'loginMysql.php';
	$data = $bdd->query("FROM 'user' SELECT *");
?>