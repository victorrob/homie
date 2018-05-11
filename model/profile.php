<?php
function profileGet(){
	$req = $PDO->prepare('FROM "user" SELECT * WHERE id=?');
	$data = $req->execute([$_SESSION['id']])
	while($userData = $data->fetch()){}

	$name = htmlspecialchars($userData['name']);		//$userData['name'] 
	$firstName = htmlspecialchars($userData['firstName']);
	$birthDate = htmlspecialchars($userData['birthDate']);
	$email = htmlspecialchars($userData['email']);
	$address = htmlspecialchars($userData['address']);
	$phone = htmlspecialchars($userData['phone']);
	$password = $userData['password'];
}

function profilePut($namePut,$firstNamePut,$birthPut,$emailPut,$addressPut,$phonePut,$passwordPut){
	if ($namePut!=0){
		$req = $PDO->prepare('UPDATE "user" SET "name"=? WHERE id=?');
		$req->execute([$namePut,$_SESSION['id']]);
	}
	if ($firstNamePut!=0){
		$req = $PDO->prepare('UPDATE "user" SET "firstName"=? WHERE id=?');
		$req->execute([$firstNamePut,$_SESSION['id']]);
	}
	if ($birthPut!=0){
		$req = $PDO->prepare('UPDATE "user" SET "birth"=? WHERE id=?');
		$req->execute([$birthPut,$_SESSION['id']]);
	}
	if ($emailPut!=0){
		$req = $PDO->prepare('UPDATE "user" SET "email"=? WHERE id=?');
		$req->execute([$emailPut,$_SESSION['id']]);
	}
	if ($addressPut!=0){
		$req = $PDO->prepare('UPDATE "user" SET "address"=? WHERE id=?');
		$req->execute([$addressPut,$_SESSION['id']]);
	}
	if ($phonePut!=0){
		$req = $PDO->prepare('UPDATE "user" SET "phone"=? WHERE id=?');
		$req->execute([$phonePut,$_SESSION['id']]);
	}
	if ($passwordPut!=0){
		$req = $PDO->prepare('UPDATE "user" SET "password"=? WHERE id=?');
		$req->execute([$passwordPut,$_SESSION['id']]);
	}
}
function profilePOST(){ // mdp a cripte et gestion des erreur a faire (dans les else) !
	if (isset($_POST['name'])|| isset($_POST['firstName'])||isset($_POST['birth'])|| isset($_POST['email'])||isset($_POST['address'])|| isset($_POST['phone'])||isset($_POST['password1'])){
		$_POST['password']=$_POST['password'];	// mdp a cripte !!!!!
		if($_POST['password']=$password;){
			if (isset($_POST['name'])){
				$nameModif=$_POST['name'];
			}else{
				$nameModif=0;
			}
			if (isset($_POST['firstName'])){
				$firstNameModif=$_POST['firstName'];
			}else{
				$firstNameModif=0;
			}
			if (isset($_POST['birth'])){
				$birthModif=$_POST['birth'];
			}else{
				$birthModif=0;
			}
			if (isset($_POST['email'])){
				$emailModif=$_POST['email'];
			}else{
				$emailModif=0;
			}
			if (isset($_POST['address'])){
				$addressModif=$_POST['address'];
			}else{
				$addressModif=0;
			}
			if (isset($_POST['phone'])){
				$phoneModif=$_POST['phone'];
			}else{
				$phoneModif=0;
			}
			if (isset($_POST['password1']) && ($_POST['password1'] == $_POST['password2'])){
				$password1Modif=$_POST['password1']
			}else{
				$password1Modif=0;
			}
			profilePut($nameModif,$firstNameModif,$birthModif,$emailModif,$addressModif,$phoneModif,$password1Modif);
		}

	}

}
?>


$name $firstName $birthDate $email $address $phone $password
profilePOST();
profileGet();