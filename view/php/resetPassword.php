<html>

<body>
<br><br>
<br>
<br>
<br>
<div class="reponse">  <?php echo $erreurPswd?>   </div>
<div align="center">

    <form method="post" action="index.php?p=resetPswd&d=resetPswd">
        <p><label>Nouveau mot de passe :</label></p>
        <p><input class="complete largeText" type="password" name="newPassword"  /></p>
        <p><label>Confirmer le mot de passe :</label></p>
        <p><input class="complete largeText" type="password" name="newPassword2"  /></p>

        <p><input type="submit" name="okPassword" value="OK" /></p>
    </form>

</div>

</body>


</html>

