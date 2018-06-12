
	<body>
		<main>
			
			<section>
				<h1> Questions fréquentes </h1>

				<article class="cadre">
					<h2> <?php echo (question_title($bdd)[0]) ; ?> </h2>
					<p> <?php echo (question_text($bdd)[0]) ; ?>
					</p>
				</article>

				<article class="cadre">
					<h2> <?php echo (question_title($bdd)[1]) ; ?> </h2>
					<p><?php echo (question_text($bdd)[1]) ; ?>
					</p>

				</article>
				<article>
					<br/>
					<a href="forum.php"> Accéder à toutes les questions</a>
				</article>
				
			</section>
			
			<aside>
				<div id="part">
					<h2> Nous contacter</h2>
					<p> Téléphone : 01 11 11 11 11
						<br/>
						Mail: contact@homie.fr
					</p>
				</div>
				<div class="link">
					<a class="linkrequete" href="Support.php"> Envoyer une requête </a>
					
				</div>
				<div class="link2">
					<a class="linkrequete" href="Request.php"> Mes requêtes </a>
				</div>
			</aside>
		</main>
		<footer>
			
		</footer>
	</body>


