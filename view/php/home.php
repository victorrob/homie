<div id="tete" class="menu_tete">
    <form class="form" method="post" action="index.php?p=homeInstallateur">
        <label for="residence">Résidence :</label><br />
        <div id="select">
            <select name="residence" id="residence" onchange="this.form.submit();">

                <?php
                foreach ($residences as $residence){
                    ?>
                    <option value="<?php echo $residence['idResidence'] ?>" <?php echo $residence['select'] ?>><?php echo $residence['name'] ?></option>
                <?php }
                ?>

            </select>
        </div>
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
        <div><a class="carre" href="<?php echo '#'.$room['idRoom'] ?>"><p><?php echo $room['name'] ?></p></a></div>
    <?php  }
    ?>

</section>

<?php
foreach ($rooms as $room) {
    ?>

    <section class="roomFactors" id="<?php echo $room['idRoom'] ?>">
        <div class="statistiques">
            <div><p><?php echo $room['name'] ?></p></div>
            <div class="factors">
                <div class="divFactors" style="display: <?php echo $room['lumière']['existence'] ?>">
                    <p>Lumière :</p>
                    <div class="switchButton">
                        <input class="switch" name="lumière" id="<?php echo "lumière".$room['idRoom']?>"
                               type="checkbox" <?php echo $room['lumière']['state'] ?> />
                        <label for="<?php echo "lumière".$room['idRoom']?>" class="label">
                            <div class="formeLight">
                                <div class="rondLight">
                                </div>
                            </div>
                        </label>
                    </div>
                </div>
                <div class="divFactors" style="display: <?php echo $room['chauffage']['existence'] ?>">
                    <p>Température demandée :</p>
                    <input type="number" name="chauffage" id="<?php echo "chauffage".$room['idRoom']?>"
                           value="<?php echo $room['chauffage']['value'] ?>" />
                    <p>°C</p>
                </div>
                <div class="divFactors" style="display: <?php echo $room['température']['existence'] ?>">
                    <p>Température actuelle :</p>
                    <div class="sensorValue">
                        <p class="value"><?php echo $room['température']['value'] ?></p>
                        <p class="unité">°C</p>
                    </div>
                </div>
                <div class="divFactors" style="display: <?php echo $room['ventilation']['existence'] ?>">
                    <p>Ventilation :</p>
                    <input type="number" name="ventilation" id="<?php echo "ventilation".$room['idRoom']?>"
                           value="<?php echo $room['ventilation']['value'] ?>" />
                </div>
                <div class="divFactors" style="display: <?php echo $room['volet']['existence'] ?>">
                    <p>Volets :</p>
                    <div class="divVolet" class="switchButton">
                        <input class="switch" name="volet_state" id="<?php echo "volet_state".$room['idRoom']?>"
                               type="checkbox" <?php echo $room['volet']['state'] ?> />
                        <label for="<?php echo "volet_state".$room['idRoom']?>" class="label">
                            <div class="formeShutter">
                                <div class="rondShutter">
                                </div>
                            </div>
                        </label>
                    </div>
                    <div class="divVolet" class="switchButton">
                        <input class="switch" name="volet_auto" id="<?php echo "volet_auto".$room['idRoom']?>"
                               type="checkbox" <?php echo $room['volet']['auto'] ?> />
                        <label for="<?php echo "volet_auto".$room['idRoom']?>" class="label">
                            <div class="formeAuto">
                                <div class="rondAuto">
                                </div>
                            </div>
                        </label>
                    </div>
                    <div class="divVolet">
                        <p>Plage horaire :</p>
                        <input type="time" name="volet_opening" id="<?php echo "volet_opening".$room['idRoom']?>"
                               value="<?php echo $room['volet']['opening'] ?>" />
                        <P> - </P>
                        <input type="time" name="volet_closing" id="<?php echo "volet_closing".$room['idRoom']?>"
                               value="<?php echo $room['volet']['closing'] ?>" />
                    </div>
                </div>
                <div class="divFactors" style="display: <?php echo $room['humidité']['existence'] ?>">
                    <p>Humidité :</p>
                    <div class="sensorValue">
                        <p class="value"><?php echo $room['humidité']['value'] ?></p>
                        <p class="unité">%</p>
                    </div>
                </div>
                <div class="divFactors" style="display: <?php echo $room['CO2']['existence'] ?>">
                    <p>CO2 :</p>
                    <div class="sensorValue">
                        <p class="value"><?php echo $room['CO2']['value'] ?></p>
                        <p class="unité">ppm</p>
                    </div>
                </div>
                <div class="divFactors" style="display: <?php echo $room['pression']['existence'] ?>">
                    <p>Pression :</p>
                    <div class="sensorValue">
                        <p class="value"><?php echo $room['pression']['value'] ?></p>
                        <p class="unité">bar</p>
                    </div>
                </div>
                <div class="divFactors" style="display: <?php echo $room['luminosité']['existence'] ?>">
                    <p>Luminosité :</p>
                    <div class="sensorValue">
                        <p class="value"><?php echo $room['luminosité']['value'] ?></p>
                        <p class="unité">lux</p>
                    </div>
                </div>
            </div>
            <div><a href="index.php?p=statistic&r=<?php echo $room['idRoom'] ?>"><p>Statistiques</p></a></div>
        </div>
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
    <div><a href="#lumiereForm" class="carre"><p>Lumières</p></a></div>
    <div><a href="#voletForm" class="carre"><p>Volets</p></a></div>
    <div><a href="#chauffageForm" class="carre"><p>Chauffage</p></a></div>
    <div><a href="#ventilationForm" class="carre"><p>Ventilation</p></a></div>
    <div><a href="#modeAbsentForm" class="carre"><p>Absent</p></a></div>
</section>

<form method="post" action="index.php?p=homeInstallateur&d=homeInstallateur" class="habitationFactors" id="lumiereForm">
    <p>Gérez ici toutes les lumières de votre habitation :</p>
    <div class="switchButton">
        <input class="switch" name="light" id="light"
               type="checkbox" />
        <label for="light" class="label">
            <div class="formeLight">
                <div class="rondLight">
                </div>
            </div>
        </label>
    </div>
    <input type="submit" value="Appliquer" name="habitationLight" />
</form>

<form method="post" action="index.php?p=homeInstallateur&d=homeInstallateur" class="habitationFactors" id="voletForm">
    <div>
        <div>
            <p>Gérez ici tous les volets de votre habitation :</p>
        </div>
        <div class="divLigne">
            <div class="switchButton">
                <input class="switch" name="shutter" id="shutter" type="checkbox" />
                <label for="shutter" class="label">
                    <div class="formeShutter">
                        <div class="rondShutter">
                        </div>
                    </div>
                </label>
            </div>
            <div class="switchButton">
                <input class="switch" name="auto" id="auto" type="checkbox" />
                <label for="auto" class="label">
                    <div class="formeAuto">
                        <div class="rondAuto">
                        </div>
                    </div>
                </label>
            </div>
        </div>
        <div class="divLigne">
            <p>Plage horaire :</p>
            <input type="time" name="opening" id="opening" />
            <P> - </P>
            <input type="time" name="closing" id="closing" />
        </div>
    </div>
    <input type="submit" value="Appliquer" name="habitationShutter" />
</form>

<form method="post" action="index.php?p=homeInstallateur&d=homeInstallateur" class="habitationFactors" id="chauffageForm">
    <p>Gérez ici toutes les températures demandées de votre habitation :</p>
    <input type="number" name="heating" id="heating" required />
    <p>°C</p>
    <input type="submit" value="Appliquer" name="habitationHeating" />
</form>

<form method="post" action="index.php?p=homeInstallateur&d=homeInstallateur" class="habitationFactors" id="ventilationForm">
    <p>Gérez ici toutes les ventilations de votre habitation :</p>
    <input type="number" name="ventilation" id="ventilation" required />
    <input type="submit" value="Appliquer" name="habitationVentilation" />
</form>

<form method="post" action="index.php?p=homeInstallateur&d=homeInstallateur" class="habitationFactors" id="modeAbsentForm">
    <div class="divLigne">
        <p>Gérez ici le mode absent de votre habitation :</p>
        <div class="switchButton">
            <input class="switch" name="absent" id="absent"
                   type="checkbox" <?php echo $absent ?> />
            <label for="absent" class="label">
                <div class="formeLight">
                    <div class="rondLight">
                    </div>
                </div>
            </label>
        </div>
        <input type="submit" value="Appliquer" name="habitationAbsent" />
    </div>
    <div>
        <p>Lorsque le mode absent est activé, les lumières, les volets, le chauffage et la ventilation respectent les paramètres enregistrés.</p>
        <p><a href="index.php?p=absentFactors">Modifier les paramètres</a></p>
    </div>
</form>

<script type="text/javascript" src="lib/jquery-3.3.1.min.js"></script>