<?php
$PDO = new PDO('mysql:host=victorropttest.mysql.db;dbname=victorropttest;charset=utf8', 'victorropttest', 'Homie2018', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

if (isset($_POST['connect']))
{
    $mail = htmlspecialchars($_POST['identifiant']);
    $password = $_POST['mot_de_passe'];
    if(!empty($password) AND !empty($mail)){
        $requser= $PDO->prepare("SELECT * FROM user WHERE mail = ? AND password = ?");
        $requser->execute([$mail,$password]);
        $userexist = $requser->rowCount();
        if($userexist==1){
            echo 'VOUS ETES CONNECTER ';
        }
        else {
            echo 'Mauvais identifiant ou mot de passe ';
        }
    }
    else{
        echo "un des champs n'est pas rempli";
    }
}
?>

<form method="post" action="index.php?p=home" >
<p><label for="identifiant">Identifiant :</label></p>
<p><input type="text" name="identifiant" id="identifiant" placeholder="Nom d'utilisateur" /></p>
<p><label for="mot_de_passe">Mot de passe :</label></p>
<p><input type="password" name="mot_de_passe" id="mot_de_passe" placeholder="Mot de passe" /></p>
<p><input type="submit" name="connect" value="Connexion" /></p>
<hr />
<p><a href="index.php?p=signUp">Créer un compte</a></p>
<p><a href="index.php?p=forgottenPswd">Mot de passe oublié</a></p>
</form>