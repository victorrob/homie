<!DOCTYPE html>
<html>


<body id="bodyProfile">
	<div id = error><?php echo($error) ?></div>
	<fieldset>
		<form id="formProfile" method="POST" action="index.php?p=profile&d=profile">
			<div id="name" class="categoryForm">
				<div class="formText">
					<label for="name">Nom : <?php echo($name); ?></label>
					<input class="button" type="button" value="Modifier" id="nameButton"/>
				</div>
				<input id="nameModif" type="text" placeholder="Nouveau nom" name="name" />
			</div>
			<div id="firstName" class="categoryForm">
				<div class="formText">
					<label for="firstName">Prénom : <?php echo($firstName); ?></label>
					<input class="button" type="button" value="Modifier" id="firstNameButton"/>
				</div>
				<input id="firstNameModif" type="text" placeholder="Nouveau prénom" name="firstName" />
			</div>
			<div id="birth" class="categoryForm">
				<div class="formText">
					<label for="birth">Date d'anniversaire : <?php echo($birthDate); ?></label>
					<input class="button" type="button" value="Modifier" id="birthButton"/>
				</div>
				<input id="birthModif" type="date" placeholder="Nouvelle date d'anniversaire" name="birth" />
			</div>
			<div id="email" class="categoryForm">
				<div class="formText">
					<label for="email">Email : <?php echo($email); ?></label>
					<input class="button" type="button" value="Modifier" id="emailButton"/>
				</div>
				<input id="email1Modif" type="email" placeholder="Nouvelle email" name="email1" />
				<input id="email2Modif" type="email" placeholder="Nouvelle email" name="email2" />
			</div>
			<div id="address" class="categoryForm">
				<div class="formText">
					<label for="address">Adresse : <?php echo($address); ?></label>
					<input class="button" type="button" value="Modifier" id="addressButton"/>
				</div>
				<input id="addressModif" type="text" placeholder="Nouvelle adresse" name="address" />
			</div>
			<div id="phone" class="categoryForm">
				<div class="formText">
					<label for="phone">Téléphone : <?php echo($phone); ?></label>
					<input class="button" type="button" value="Modifier" id="phoneButton"/>
				</div>
				<input id="phoneModif" type="tel" placeholder="Nouveau téléphone" name="phone" />
			</div>
			<div id="password" class="categoryForm">
				<div class="formText">
					<label for="password">mot de passe : ••••••••••</label>
					<input class="button" type="button" value="Modifier" id="passwordButton"/>
				</div>
				<input id="password1Modif" type="password" placeholder="Nouveau mot de passe" name="password1" />
				<input id="password2Modif" type="password" placeholder="Confirmer mot de passe" name="password2" />
			</div>
			<div id="validate" class="categoryForm">
				<input id="passwordValidation" type="password" placeholder="Mot de passe" name="password" />
				<input class="button" type="submit" value="Valider" id="validateButton"/> <!-- submit -->
			</div>
		</form>
		<form method="POST" action="index.php?p=home">
			<input class="button" type="submit" value="Annuler" id="validateButton"/> <!-- anuler -->
		</form>
	</fieldset>
</body>
</html>

    <script type="text/javascript" src="view/js/profile.js"></script>
    <script type="text/javascript">
      	start();
      	setInterval('checkForm();', 1000);
      	
    </script>