

	<body>
		<main>
			<section>
				
				
				<article class="cadre">
						<h2> <?php echo(discuss_request_type($PDO,$current_request,$admin)[0]); ?> </h2>
						<p> <?php echo(discuss_request_problem($PDO,$current_request,$admin)[0]); ?> </p>
				</article>

				<?php for($i=0;$i<=discuss_count($PDO,$_SESSION['idUser'],$current_request);$i++){
				?>

					<article class="cadre">
						<h2> <?php echo(discuss_msg_number($PDO,$_SESSION['idUser'],$current_request)[$i]); ?> </h2>
						<p> <?php echo(discuss_message($PDO,$_SESSION['idUser'],$current_request)[$i]); ?> </p>
					</article>
				<?php } ?>
				</br>
				<form action=<?php echo("index.php?p=discuss&d=discuss&idrequest=".$current_request)?>  method="POST">

					<label> Votre réponse</label>
					<br/>
					<textarea name='answer' cols="50" rows="10"></textarea>
					<br/>
					<input type="submit" name="Valider">
				</form>
			






			</section>
		</main>

	</body>