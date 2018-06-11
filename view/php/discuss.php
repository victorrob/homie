<?php
/* session_start();
$current_request=$_GET['idrequest'];
*/
?>



	<body>
		<main>
			<section>
				<?php 
				if ($_SESSION['admin']==true){
					$admin=true;
				}
				else{
					
					$admin=false;
				}
				?>
				
				<article class="cadre">
						<h2> <?php echo(discuss_request_type($bdd,$current_request,$admin)[0]); ?> </h2>
						<p> <?php echo(discuss_request_problem($bdd,$current_request,$admin)[0]); ?> </p>
				</article>

				<?php for($i=0;$i<=discuss_count($bdd,$_SESSION['id_user'],$current_request);$i++){
				?>

					<article class="cadre">
						<h2> <?php echo(discuss_msg_number($bdd,$_SESSION['id_user'],$current_request)[$i]); ?> </h2>
						<p> <?php echo(discuss_message($bdd,$_SESSION['id_user'],$current_request)[$i]); ?> </p>
					</article>
				<?php } ?>
				
				<form action=<?php echo("discuss.php?idrequest=$current_request")?>  method="POST">

					<label> Votre réponse</label>
					<br/>
					<textarea name='answer' cols="50" rows="10"></textarea>
					<br/>
					<input type="submit" name="Valider">
				</form>







			</section>
		</main>

	</body>