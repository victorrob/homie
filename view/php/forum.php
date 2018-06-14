
	<body>
		<main>

			<section>
				<h1> Questions fréquentes </h1>
				<?php for($i=0;$i<=question_count($PDO);$i++){
				?>

					<article class="cadre">
						<h2> <?php echo(question_title($PDO)[$i]); ?> </h2>
						<p> <?php echo(question_text($PDO)[$i]); ?> </p>
					</article>
				<?php
				}
				?>
				
				
				
			</section>
			
		
		</main>
	</body>

