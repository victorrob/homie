
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
				

				<?php for($i=0;$i<=request_count($PDO,$_SESSION['idUser'],$admin);$i++){
				?>
				<div class="quest">
					<article class="cadre">
						<h2> <?php echo(request_type($PDO,$_SESSION['idUser'],$admin)[$i]); ?> </h2>
						<p> <?php echo(request_problem($PDO,$_SESSION['idUser'],$admin)[$i]); ?> </p>
						<?php $id= request_id($PDO,$_SESSION['idUser'],$admin)[$i]; 
						echo($id); ?>
					</article>
					<a class="rqt" href=<?php echo "index.php?p=discuss&idrequest=".$id; ?>>Consulter</a>
				</div>
				<?php } ?>




		</main>
