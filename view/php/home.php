<body>
        <div id="tete" class="menu_tete">
				<form class="form" method="post" action="/index.php?p=home">
					<label for="habitation">Habitation :</label><br />
					<select name="habitation" id="habitation" onchange="this.form.submit();">

                        <?php
                            foreach ($residences as $residence){
                            ?>
                            <option value="<?php echo $residence["idResidence"] ?>" <?php echo $select[$residence["idResidence"]] ?>><?php echo $residence["name"] ?></option>
                            <?php  }
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
                foreach ($rooms as $room){
                ?>
                <div onclick="home()"><p><?php echo $room['name'] ?></p></div>
                <?php  }
            ?>

		</section>

        <?php
            foreach ($rooms as $room) {
                ?>

                <section class="roomFactors" id="<?php echo $room['idRoom'] ?>">
                    <div><?php echo $room['name'] ?></div>
                    <br/>
                    <div class="ligne">
                        <div>
                            Lumière :
                            <input class="switch" name="lumiere" id="lumiere"
                                   type="checkbox" <?php echo $light[$room['idRoom']] ?> />
                            <label for="lumiere" class="ui-content">
                                <div class="ui-switch-range">
                                    <div class="ui-switch-handle">
                                    </div>
                                </div>
                            </label>
                        </div>
                        <div>
                            Chauffage :
                            <form><input type="number" name="chauffage"
                                         value="<?php echo $temperature[$room['idRoom']] ?>"> °C
                            </form>
                        </div>
                        <div>
                            Ventilation :
                            <form><input type="number" name="ventilation"
                                         value="<?php echo $ventilation[$room['idRoom']] ?>"></form>
                        </div>
                    </div>
                    <div>
                        Volets :
                        <div>
                            <input class="switch" name="volets1" id="volets1"
                                   type="checkbox" <?php echo $shutter[$room['idRoom']] ?> />
                            <label for="volets1" class="ui-content">
                                <div class="ui-switch-range">
                                    <div class="ui-switch-handle">
                                    </div>
                                </div>
                            </label>
                        </div>
                        <div>
                            <input class="switch" name="volets2" id="volets2"
                                   type="checkbox" <?php echo $auto[$room['idRoom']] ?> />
                            <label for="volets2" class="ui-content">
                                <div class="ui-switch-range">
                                    <div class="ui-switch-handle">
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                    <div>
                        Plage horaire :
                        <form><input type="time" name="ouverture" value="<?php echo $opening[$room['idRoom']] ?>"/> -
                            <input type="time" name="fermeture" value="<?php echo $closing[$room['idRoom']] ?>"/></form>
                    </div>
                    <div><a href="#"><p>Statistiques</p></a></div>
                </section>
                <?php
            }
        ?>

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

        <script type="text/javascript" src="/view/js/home.js"></script>

</body>