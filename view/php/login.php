<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="view/css/login.css" />
		<title>login</title>
	</head>
	<body>
		<header>
			<img src="image/LogoHOMIEweb.png" alt="Logo Homie" />
		</header>
		<form method="post" action="index.php">
			<p><label for="identifiant">Identifiant :</label></p>
			<p><input type="text" name="identifiant" id="identifiant" placeholder="Nom d'utilisateur" /></p>
			<p><label for="mot_de_passe">Mot de passe :</label></p>
			<p><input type="password" name="mot_de_passe" id="mot_de_passe" placeholder="Mot de passe" /></p>
			<p><input type="submit" value="Connexion" /></p>
			<hr />
			<p><a href="index.php?p=signup">Créer un compte</a></p>
			<p><a href="index.php?p=forgottenPswd">Mot de passe oublié</a></p>
		</form>
	</body>
</html>