<!DOCTYPE html>
<?php
if(!$name){$name = 'undefined';}
if(!$firstName){$firstName = 'undefined';}
if(!$email){$email = 'undefined';}
if(!$phone){$phone = 'undefined';}
if(!$password){$password = 'undefined';}
if(!$birthDate){$birthDate = 'undefined';
if(!$address){$address = 'undefined';}
}
?>
<html>
<body id="bodyProfile">
	<div id="formAndCharter">
		<form id="formProfile">
			<div id="name" class="categoryForm">
				<div>
					<label for="name">Nom : <?php echo($name); ?></label>
					<input class="button" type="button" value="Modifier" id="nameButton"/>
				</div>
				<input id="nameModif" type="text" placeholder="Nouvau nom"/>
			</div>
			<div id="firstName" class="categoryForm">
				<div>
					<label for="firstName">Prénom : <?php echo($firstName); ?></label>
					<input class="button" type="button" value="Modifier" id="firstNameButton"/>
				</div>
				<input id="firstNameModif" type="text" placeholder="Nouvau prénom"/>
			</div>
			<div id="birth" class="categoryForm">
				<div>
					<label for="birth">Date d'aniversaire : <?php echo($birthDate); ?></label>
					<input class="button" type="button" value="Modifier" id="birthButton"/>
				</div>
				<input id="birthModif" type="text" placeholder="Nouvelle date d'anniversair"/>
			</div>
			<div id="email" class="categoryForm">
				<div>
					<label for="email">Email : <?php echo($email); ?></label>
					<input class="button" type="button" value="Modifier" id="emailButton"/>
				</div>
				<input id="emailModif" type="text" placeholder="Nouvelle email"/>
			</div>
			<div id="address" class="categoryForm">
				<div>
					<label for="address">Adresse : <?php echo($address); ?></label>
					<input class="button" type="button" value="Modifier" id="addressButton"/>
				</div>
				<input id="addressModif" type="text" placeholder="Nouvelle adresse"/>
			</div>
			<div id="phone" class="categoryForm">
				<div>
					<label for="phone">Téléphone : <?php echo($phone); ?></label>
					<input class="button" type="button" value="Modifier" id="phoneButton"/>
				</div>
				<input id="phoneModif" type="text" placeholder="Nouvau téléphone"/>
			</div>
			<div id="password" class="categoryForm">
				<div>
					<label for="password">mot de passe : ••••••••••</label>
					<input class="button" type="button" value="Modifier" id="passwordButton"/>
				</div>
				<input id="password1Modif" type="password" placeholder="Nouvau mot de passe"/>
				<input id="password2Modif" type="password" placeholder="Confirmer mot de passe"/>
			</div>
			<div id="validate" class="categoryForm">
				<input id="passwordValidation" type="password" placeholder="Mot de passe"/>
				<input class="button" type="button" value="Valider" id="validateButton"/>
			</div>
		</form>

		<div id = "charter">
			<p>
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi non sodales sem, sit amet fermentum mauris. Aliquam sed placerat dui. Phasellus ullamcorper, sapien et porta varius, ex sapien porttitor enim, non imperdiet neque velit eu ipsum. Donec iaculis, nisl nec lacinia malesuada, ex turpis laoreet risus, id elementum odio quam sed massa. In nec tortor viverra, sagittis risus non, hendrerit tellus. In scelerisque dui orci, eget posuere orci aliquam eu. Nulla facilisi. Vivamus neque turpis, dapibus vel ipsum venenatis, pellentesque sollicitudin erat. In sagittis, risus non commodo convallis, dolor libero luctus lorem, vitae luctus eros quam sit amet sem. Phasellus laoreet gravida mattis. Vestibulum eu dictum ipsum. Integer ut est ex. Duis congue sagittis massa in faucibus.

				Donec auctor lorem sit amet maximus suscipit. Proin in purus eu urna malesuada hendrerit a interdum elit. Integer a accumsan dui. Quisque faucibus quis magna eget pharetra. Etiam vel augue ultricies, ultrices quam sit amet, ornare metus. Donec molestie enim nunc, id pellentesque erat facilisis ultrices. Quisque in neque velit. Suspendisse id felis sit amet eros pulvinar aliquam et nec magna. Suspendisse nisi augue, cursus sit amet volutpat a, rutrum in ipsum. Maecenas blandit erat quis finibus auctor. Aenean mollis mi eget magna pretium fringilla ut id felis. Vivamus id mauris nunc. Aenean porttitor augue non justo scelerisque gravida.

				Sed purus urna, faucibus sed lorem quis, congue aliquet nisi. Mauris imperdiet leo ac ex cursus, vitae vestibulum felis maximus. Pellentesque id metus felis. Phasellus et faucibus risus, eu vehicula justo. Proin eget ante non nisl porttitor facilisis sed sed mauris. Nunc auctor ut lectus in mollis. Vestibulum sed ullamcorper enim, ut gravida orci. 
			<p>
		</div>
	</div>

</body>
<script type="text/javascript" src="../js/profile.js"></script>
</html>