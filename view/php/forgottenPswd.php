<?php


$header="MIME-Version: 1.0\r\n";
$header.='From:"gmail.com"<support@gmail.com>'."\n";
$header.='Content-Type:text/html; charset=utf-8'."\n";
$header.='Content-Transfer-Encoding: 8bit';

$message='
<html>
        <body>
            <div align="center">
                    Veuillez appuyer sur le lien, pour changer de mot de passe :
                    <a href="http://localhost/homie/view/php/resetPassword.php"> changervotremotdepasse.com</a>
            </div>
        </body>
</html>

';
if (isset($_POST['okmail'])) {
    mail($_POST['mail'], "Changement de mot de passe", $message, $header);
}
?>

	<body>
		<form method="post" action="index.php?p=forgottenPswd">
			<p><label for="mail">Adresse mail :</label></p>
			<p><input class="complete largeText" type="email" name="mail"   required /></p>
			<p>Nous vous enverrons un lien permettant de changer votre mot de passe </p>
			<p><input type="submit" name="okmail" value="OK" /></p>
		</form>
	</body>