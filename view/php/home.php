<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="view/css/home.css" />
		<title>accueil</title>
	</head>
	<body>
		<header>
			<a href="index.php?p=home" <img src="image/LogoHOMIEweb.png" alt="Logo Homie" />
		</header>
		<div id="tete" class="menu_tete">
				<form class="form" method="post" action="index.php">
					<label for="habitation">Habitation :</label><br />
					<select name="habitation" id="habitation">
						<option value="maison_brest">Maison Brest</option>
						<option value="appartement_paris">Appartement Paris</option>
					</select>
				</form>
			<div id="roue">
				<img src="image/parametre.png" alt="Bouton paramètre" id="parametre" />
					<ul id="menu">
						<li><a href="index.php?p=profile">Paramètres</a></li>
						<li><a href="index.php?p=contact">Nous contacter</a></li>
						<li><a href="index.php?p=logOut">Déconnexion</a></li>
					</ul>
			</div>
		</div>
		<div class="entete">
			<hr />
			<h1>Pièces</h1>
			<hr />
		</div>
		<section>
			<div><p>Cuisine</p></div>
			<div><p>Chambre 1</p></div>
			<div><p>Salon</p></div>
			<div><p>Chambre 2</p></div>
			<div><p>Bureau</p></div>
		</section>
        <section id="piece">
            <div><p>Cuisine</p></div>
            <div id="ligne">
                <div><p>Lumière :</p></div>
                <div><p>Chauffage :</p></div>
                <div><p>Ventilation :</p></div>
            </div>
            <div><p>Volets :</p></div>
            <div><p>Plage horaire :</p></div>
            <div><p>Statistiques</p></div>
        </section>
		<div class="entete">
			<hr />
			<h1>Habitation</h1>
			<hr />
		</div>
		<section>
			<div><p>Lumières</p></div>
			<div><p>Volets</p></div>
			<div><p>Absent</p></div>
		</section>

		<script type="text/javascript" src="view/js/home.js"></script>

	</body>
</html>