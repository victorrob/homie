<body>

        <div id="tete" class="menu_tete">
				<form class="form" method="post" action="index.php?p=home">
					<label for="residence">Résidence :</label><br />
					<select name="residence" id="residence" onchange="this.form.submit();">

                        <?php
                            foreach ($residences as $residence){
                            ?>
                            <option value="<?php echo $residence['idResidence'] ?>" <?php echo $residence['select'] ?>><?php echo $residence['name'] ?></option>
                            <?php }
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
                <div onclick="home(<?php echo $room['idRoom'] ?>)"><p><?php echo $room['name'] ?></p></div>
                <?php  }
            ?>
            <div id="plus"><a href="index.php?p=sensor"><p>+</p></a></div>

		</section>

        <?php
            foreach ($rooms as $room) {
                ?>

                <section class="roomFactors" id="<?php echo $room['idRoom'] ?>">
                    <div><p><?php echo $room['name'] ?></p></div>
                    <div class="ligne">
                        <div>
                            <p>Lumière :</p>
                            <div class="switchButton">
                                <input class="switch" name="<?php echo "light".$room['idRoom'] ?>" id="<?php echo "light".$room['idRoom'] ?>"
                                       type="checkbox" <?php echo $room['light'] ?> />
                                <label for="<?php echo "light".$room['idRoom'] ?>" class="label">
                                    <div class="formeLight">
                                        <div class="rondLight">
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div>
                            <p>Chauffage :</p>
                            <form><input type="number" name="chauffage" class="input"
                                         value="<?php echo $room['temperature'] ?>"> °C
                            </form>
                        </div>
                        <div>
                            <p>Ventilation :</p>
                            <form><input type="number" name="ventilation" class="input"
                                         value="<?php echo $room['ventilation'] ?>"></form>
                        </div>
                    </div>
                    <div>
                        <p>Volets :</p>
                        <div class="switchButton">
                            <input class="switch" name="<?php echo "shutter".$room['idRoom'] ?>" id="<?php echo "shutter".$room['idRoom'] ?>"
                                   type="checkbox" <?php echo $room['shutter'] ?> />
                            <label for="<?php echo "shutter".$room['idRoom'] ?>" class="label">
                                <div class="formeShutter">
                                    <div class="rondShutter">
                                    </div>
                                </div>
                            </label>
                        </div>
                        <div class="switchButton">
                            <input class="switch" name="<?php echo "auto".$room['idRoom'] ?>" id="<?php echo "auto".$room['idRoom'] ?>"
                                   type="checkbox" <?php echo $room['auto'] ?> />
                            <label for="<?php echo "auto".$room['idRoom'] ?>" class="label">
                                <div class="formeAuto">
                                    <div class="rondAuto">
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                    <div>
                        <p>Plage horaire :</p>
                        <form><input type="time" name="ouverture" value="<?php echo $room['opening'] ?>"/> -
                            <input type="time" name="fermeture" value="<?php echo $room['closing'] ?>"/></form>
                    </div>
                    <div><a href="index.php?p=statistic"><p>Statistiques</p></a></div>
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

        <script type="text/javascript" src="view/js/home.js"></script>

</body>