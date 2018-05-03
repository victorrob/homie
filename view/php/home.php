<body>
        <div id="tete" class="menu_tete">
				<form class="form" method="post" action="/index.php">
					<label for="habitation">Habitation :</label><br />
					<select name="habitation" id="habitation">

                        <?php

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
                    ?>

		</section>
        <section id="roomFactors">
            <div id="pieceName"></div>
            <br id="la" />
            <div id="ligne">
                <div>
                    Lumière :
                    <input class="switch" name="lumiere" id="lumiere" type="checkbox" checked />
                    <label for="lumiere" class="ui-content" >
                        <div class="ui-switch-range">
                            <div class="ui-switch-handle">
                            </div>
                        </div>
                    </label>
                </div>
                <div>
                    Chauffage : <form><input type="number" name="chauffage"> °C</form>
                </div>
                <div>
                    Ventilation : <form><input type="number" name="ventilation"></form>
                </div>
            </div>
            <div>
                Volets :
                <div>
                    <input class="switch" name="volets1" id="volets1" type="checkbox" checked />
                    <label for="volets1" class="ui-content" >
                        <div class="ui-switch-range">
                            <div class="ui-switch-handle">
                            </div>
                        </div>
                    </label>
                </div>
                <div>
                    <input class="switch" name="volets2" id="volets2" type="checkbox" checked />
                    <label for="volets2" class="ui-content" >
                        <div class="ui-switch-range">
                            <div class="ui-switch-handle">
                            </div>
                        </div>
                    </label>
                </div>
            </div>
            <div>
                Plage horaire : <form><input type="time" name="ouverture" /> - <input type="time" name="fermeture" /></form>
            </div>
            <div><a href="#"><p>Statistiques</p></a></div>
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

        <script type="text/javascript" src="/view/js/roomFactors.js"></script>

</body>