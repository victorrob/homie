
    <body>
    <br><br>
        <div class="reponse">  <?php echo $reponse ?>   </div>
		<form method="post" action="index.php?p=forgottenPswd&d=forgottenPswd">
			<p><label for="mail">Adresse mail :</label></p>
			<p><input class="complete largeText" type="email" name="mail"   required /></p>
			<p>Nous vous enverrons un lien permettant de changer votre mot de passe </p>
			<p><input type="submit" name="okmail" value="OK" /></p>
		</form>
	</body>