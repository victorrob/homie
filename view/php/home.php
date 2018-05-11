<body>

        <div id="tete" class="menu_tete">
				<form class="form" method="post" action="index.php?p=home">
					<label for="habitation">Habitation :</label><br />
					<select name="habitation" id="habitation" onchange="this.form.submit();">

                        <?php

                            foreach ($residences as $residence){
                            ?>
                            <option value="<?php echo $residence["idResidence"] ?>"
                                <?php echo $select[$residence["idResidence"]] ?>><?php echo $residence["name"] ?></option>
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
                <div onclick="home(<?php echo $room['idRoom'] ?>)"><p><?php echo $room['name'] ?></p></div>
                <?php  }
            ?>
            <a href="index.php?p=sensor"><div><p id="plus">+</p></div></a>

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
                                <input class="switch" name="lumiere" id="lumiere"
                                       type="checkbox" <?php echo $light[$room['idRoom']] ?> />
                                <label for="lumiere" class="label" id="labelLight">
                                    <div class="forme" id="formeLight">
                                        <div class="rond" id="rondLight">
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div>
                            <p>Chauffage :</p>
                            <form><input type="number" name="chauffage" class="input"
                                         value="<?php echo $temperature[$room['idRoom']] ?>"> °C
                            </form>
                        </div>
                        <div>
                            <p>Ventilation :</p>
                            <form><input type="number" name="ventilation" class="input"
                                         value="<?php echo $ventilation[$room['idRoom']] ?>"></form>
                        </div>
                    </div>
                    <div>
                        <p>Volets :</p>
                        <div class="switchButton">
                            <input class="switch" name="shutter" id="shutter"
                                   type="checkbox" <?php echo $shutter[$room['idRoom']] ?> />
                            <label for="shutter" class="label" id="labelShutter">
                                <div class="forme" id="formeShutter">
                                    <div class="rond" id="rondShutter">
                                    </div>
                                </div>
                            </label>
                        </div>
                        <div class="switchButton">
                            <input class="switch" name="auto" id="auto"
                                   type="checkbox" <?php echo $auto[$room['idRoom']] ?> />
                            <label for="auto" class="label" id="labelAuto">
                                <div class="forme" id="formeAuto">
                                    <div class="rond" id="rondAuto">
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                    <div>
                        <p>Plage horaire :</p>
                        <form><input type="time" name="ouverture" value="<?php echo $opening[$room['idRoom']] ?>"/> -
                            <input type="time" name="fermeture" value="<?php echo $closing[$room['idRoom']] ?>"/></form>
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