<?php echo "test" ?>
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