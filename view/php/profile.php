<!DOCTYPE html>
<html>

<!-- a modif pout index.php ( NE PAS SUPPRIMER!! )-->
<!-- j'aimerais modifier quand je serais la -->
<header>
	<link rel="stylesheet" href="view/css/profile.css" />
	<script type="text/javascript" src="view/js/profile.js"></script>
</header>
<!-- a modif pout index.php -->

<body id="bodyProfile">
	<div id = error><?php echo($error) ?></div>
	<form id="formProfile" method="POST" action="index.php?p=profile&d=profile">
		<div id="name" class="categoryForm">
			<div>
				<label for="name">Nom : <?php echo($name); ?></label>
				<input class="button" type="button" value="Modifier" id="nameButton"/>
			</div>
			<input id="nameModif" type="text" placeholder="Nouvau nom" name="name" />
		</div>
		<div id="firstName" class="categoryForm">
			<div>
				<label for="firstName">Prénom : <?php echo($firstName); ?></label>
				<input class="button" type="button" value="Modifier" id="firstNameButton"/>
			</div>
			<input id="firstNameModif" type="text" placeholder="Nouvau prénom" name="firstName" />
		</div>
		<div id="birth" class="categoryForm">
			<div>
				<label for="birth">Date d'aniversaire : <?php echo($birthDate); ?></label>
				<input class="button" type="button" value="Modifier" id="birthButton"/>
			</div>
			<input id="birthModif" type="text" placeholder="Nouvelle date d'anniversair" name="birth" />
		</div>
		<div id="email" class="categoryForm">
			<div>
				<label for="email">Email : <?php echo($email); ?></label>
				<input class="button" type="button" value="Modifier" id="emailButton"/>
			</div>
			<input id="emailModif" type="text" placeholder="Nouvelle email" name="email" />
		</div>
		<div id="address" class="categoryForm">
			<div>
				<label for="address">Adresse : <?php echo($address); ?></label>
				<input class="button" type="button" value="Modifier" id="addressButton"/>
			</div>
			<input id="addressModif" type="text" placeholder="Nouvelle adresse" name="address" />
		</div>
		<div id="phone" class="categoryForm">
			<div>
				<label for="phone">Téléphone : <?php echo($phone); ?></label>
				<input class="button" type="button" value="Modifier" id="phoneButton"/>
			</div>
			<input id="phoneModif" type="text" placeholder="Nouvau téléphone" name="phone" />
		</div>
		<div id="password" class="categoryForm">
			<div>
				<label for="password">mot de passe : ••••••••••</label>
				<input class="button" type="button" value="Modifier" id="passwordButton"/>
			</div>
			<input id="password1Modif" type="password" placeholder="Nouvau mot de passe" name="password1" />
			<input id="password2Modif" type="password" placeholder="Confirmer mot de passe" name="password2" />
		</div>
		<div id="validate" class="categoryForm">
			<input id="passwordValidation" type="password" placeholder="Mot de passe" name="password" />
			<input class="button" type="submit" value="Valider" id="validateButton"/> <!-- submit -->
		</div>
	</form>
	<script type="text/javascript">start();</script>
</body>
</html>