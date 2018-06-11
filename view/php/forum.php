
	<body>
		<main>

			<section>
				<h1> Questions fréquentes </h1>
				<?php for($i=0;$i<=question_count($bdd);$i++){
				?>

					<article class="cadre">
						<h2> <?php echo(question_title($bdd)[$i]); ?> </h2>
						<p> <?php echo(question_text($bdd)[$i]); ?> </p>
					</article>
				<?php
				}
				?>
				
				
				
			</section>
			
		
		</main>
	</body>

