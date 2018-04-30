<body>
        <div id="tete" class="menu_tete">
				<form class="form" method="post" action="/index.php">
					<label for="habitation">Habitation :</label><br />
					<select name="habitation" id="habitation">

                        <?php
                        $connection = mysqli_connect("localhost","root","","homie");
                        $sql = "SELECT name FROM residence";
                        $habitations = mysqli_query($connection, $sql);

                        if (mysqli_num_rows($habitations) > 0) {
                            while ($habitation = mysqli_fetch_assoc($habitations)) {
                                ?>
                                <option><?php echo $habitation["name"] ?></option>
                            <?php  }
                        }
                        mysqli_close($connection);
                        ?>


                    </select>
				</form>
        </div>
		<div class="entete">
			<hr />
			<h1>Pièces</h1>
			<hr />
		</div>
		<section id="roomSection">

            <?php
            $connection = mysqli_connect("localhost","root","","homie");
            $sql = "SELECT name FROM room";
            $pieces = mysqli_query($connection, $sql);

            if (mysqli_num_rows($pieces) > 0) {
            while ($piece = mysqli_fetch_assoc($pieces)) {
            ?>
            <div onclick="home();"><p><?php echo $piece["name"] ?></p></div>
                    <?php  }
                    }
                    mysqli_close($connection)
                    ?>

		</section>
        <section id="roomFactors">
            <?php include("roomFactors.php");?>
        </section>
		<div class="entete">
			<hr />
			<h1>Habitation</h1>
			<hr />
		</div>
		<section id="habitationSection">
			<div><p>Lumières</p></div>
			<div><p>Volets</p></div>
			<div><p>Absent</p></div>
		</section>

</body>