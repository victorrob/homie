<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="view/css/signup.css" />
		<title>Inscription</title>
	</head>
	<body>
		<header>
			<img src="image/LogoHOMIEweb.png" alt="Logo Homie" />
		</header>
		<div>
			<form method="post" action="model/php/traitement.php">
				<p><label for="nom">Nom :</label></p>
				<p><input type="text" name="nom" id="nom" placeholder="Nom" /></p>
				<p><label for="prenom">Prénom :</label></p>
				<p><input type="text" name="prenom" id="prenom" placeholder="Prénom" /></p>
				<p><label for="mail">Adresse mail :</label></p>
				<p><input type="email" name="mail" id="mail" placeholder="Adresse mail" /></p>
				<p><label for="mot_de_passe">Mot de passe :</label></p>
				<p><input type="password" name="mot_de_passe" id="mot_de_passe" placeholder="Mot de passe" /></p>
				<p><label for="tel">Numéro de téléphone</label></p>
				<p><input type="tel" name="tel" id="tel" placeholder="06 XX XX XX XX" /></p>
				<p><label for="num_produit">Numéro de produit :</label></p>
				<p><input type="text" name="num_produit" id="num_produit" placeholder="XXX-XXX-XXX" /></p>
				<p><input type="submit" value="OK" /></p>
			</form>
			<p id="explication">
				Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
			</p>
		</div>
	</body>
</html>