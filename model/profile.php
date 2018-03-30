<?php
	include 'loginMysql.php';
	$data = $bdd->query("FROM 'user' SELECT *");
	while($userData = $data->fetch()){}
	$name = $userData['name'];		//$userData['name'] 
	$firstName = $userData['firstName'];
	$email = $userData['email'];
	$phone = $userData['phone'];
	$password = $userData['password'];
	$birthDate = $userData['birthDate'];
	$address = $userData['address'];


?>