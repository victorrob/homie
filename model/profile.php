<?php
	include 'loginMysql.php';
	$data = $bdd->query("FROM 'user' SELECT *");
	while($userData = $data->fetch()){}
	$name = $userData['name'];		//$userData['name'] 
	$firstName = $userData['firstName'];
	$birthDate = $userData['birthDate'];
	$email = $userData['email'];
	$address = $userData['address'];
	$phone = $userData['phone'];
	$password = $userData['password'];


?>