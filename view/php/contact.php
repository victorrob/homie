
	<body>
		<main>
			
			<section>
				<h1> Questions fréquentes </h1>

				<article class="cadre">
					<h2> <?php echo (question_title($PDO)[0]) ; ?> </h2>
					<p> <?php echo (question_text($PDO)[0]) ; ?>
					</p>
				</article>

				<article class="cadre">
					<h2> <?php echo (question_title($PDO)[1]) ; ?> </h2>
					<p><?php echo (question_text($PDO)[1]) ; ?>
					</p>

				</article>
				<article class="cadre">
					<h2> <?php echo (question_title($PDO)[2]) ; ?> </h2>
					<p><?php echo (question_text($PDO)[2]) ; ?>
					</p>

				</article>

				<article>
					<br/>
					<a href="index.php?p=forum"> Accéder à toutes les questions</a>
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
					<a class="linkrequete" href="index.php?p=support"> Envoyer une requête </a>
					
				</div>
				<div class="link2">
					<a class="linkrequete" href="index.php?p=requests"> Mes requêtes </a>
				</div>
			</aside>
		</main>

	</body>


