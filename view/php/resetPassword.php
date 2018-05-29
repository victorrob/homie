
<html>

<body>
<br><br>
<br>
<br>
<br>
<div align="center">

   <form method="post" action=<?php echo("index.php?p=ChangePswdOk&d=resetPassword&h=".$h); ?> >
       <div class="erreurPswd"> <?php echo $erreurEgalPswd ?> </div>
        <p><label>Nouveau mot de passe :</label></p>
        <p><input class="complete largeText" type="password" name="newPassword" required /></p>
        <p><label>Confirmer le mot de passe :</label></p>
        <p><input class="complete largeText" type="password" name="newPassword2" required /></p>

        <p><input type="submit" name="okPassword" value="OK" /></p>
    </form>

</div>

</body>


</html>

