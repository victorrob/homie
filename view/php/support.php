
	<body>
		<main>
			<form action="index.php?p=requests&d=requests" method="POST">

				<label> Votre problème :</label>
				<select name='type'>
					<option selected> Panne du système </option>
					<option> Option 2</option>
					<option> Autre</option>
				</select>
				<br/>
				<br/>
				<label> Description du problème<br/>
				<textarea name='problem' cols="50" rows="10"></textarea>
                </label>
				<br/>

				<input class="customButton submit" type="submit" name="Valider">



			</form>

			

		</main>

	</body>


