
	<body>
		<main>
			<section>
				<?php 
				if ($admin==true){
					echo('<h1> Requêtes à traiter </h1>');
				}
				else{
					echo('<h1> Mes requêtes </h1>');
				}
				?>
				


				<?php for($i=0;$i<=request_count($bdd,$_SESSION['id_user'],$admin);$i++){
				?>
				<div class="quest">
					<article class="cadre">
						<h2> <?php echo(request_type($bdd,$_SESSION['id_user'],$admin)[$i]); ?> </h2>
						<p> <?php echo(request_problem($bdd,$_SESSION['id_user'],$admin)[$i]); ?> </p>
						<?php $id= request_id($bdd,$_SESSION['id_user'],$admin)[$i]; 
						echo($id); ?>
					</article>
					<a href=<?php echo "discuss.php?idrequest=".$id; ?>>Consulter</a>
				</div>
				<?php } ?>




		</main>
