<body>

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
            <div id="addHouse"><a href="index.php?p=addHouse"><p>+</p></a></div>
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
        <div onclick="home(<?php echo $room['idRoom'] ?>, 'roomFactors')"><a href="<?php echo '#'.$room['idRoom'] ?>" class="carre"><p><?php echo $room['name'] ?></p></a></div>
    <?php  }
    ?>
    <div id="plus"><a href="index.php?p=sensor&r=-1"><p>+</p></a></div>

</section>

<form method="post" action="index.php?p=homeInstallateur">
    <?php
    foreach ($rooms as $room) {
        ?>

        <section class="roomFactors" id="<?php echo $room['idRoom'] ?>">
            <div class="factors">
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
                    <div class="temperature">
                        <div>
                            <p>Température demandée :</p>
                            <input type="number" name="<?php echo "heating".$room['idRoom'] ?>" id="<?php echo "heating".$room['idRoom'] ?>"
                                   value="<?php echo $room['heating'] ?>">
                            <p>°C</p>
                        </div>
                        <div>
                            <p>Température actuelle : <?php echo $room['temperature'] ?> °C</p>
                        </div>
                    </div>
                    <div>
                        <p>Ventilation :</p>
                        <input type="number" name="<?php echo "ventilation".$room['idRoom'] ?>" id="<?php echo "ventilation".$room['idRoom'] ?>"
                               value="<?php echo $room['ventilation'] ?>">
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
                <div class="ligne">
                    <div>
                        <p>Plage horaire :</p>
                        <input type="time" name="<?php echo "opening".$room['idRoom'] ?>" id="<?php echo "opening".$room['idRoom'] ?>"
                               value="<?php echo $room['opening'] ?>" />
                        <P> - </P>
                        <input type="time" name="<?php echo "closing".$room['idRoom'] ?>" id="<?php echo "closing".$room['idRoom'] ?>"
                               value="<?php echo $room['closing'] ?>" />
                    </div>
                    <a id="modifierPiece" href="index.php?p=sensor&r=<?php echo $room['idRoom'] ?>"><p>Modifier Pièce</p></a>
                </div>
                <div><a href="index.php?p=statistic&r=<?php echo $room['idRoom'] ?>"><p>Statistiques</p></a></div>
            </div>
            <input type="submit" value="Sauvegarder" name="roomModification" />
        </section>
        <?php
    }
    ?>
</form>

<div class="entete">
    <hr />
    <h1>Habitation</h1>
    <hr />
</div>
<section id="habitationSection">
    <div onclick="home('lumiere', 'habitationFactors');"><a href="#lumiere" class="carre"><p>Lumières</p></a></div>
    <div onclick="home('volets', 'habitationFactors');"><a href="#volets" class="carre"><p>Volets</p></a></div>
    <div onclick="home('chauffage', 'habitationFactors');"><a href="#chauffage" class="carre"><p>Chauffage</p></a></div>
    <div onclick="home('ventilation', 'habitationFactors');"><a href="#ventilaton" class="carre"><p>Ventilation</p></a></div>
    <div onclick="home('modeAbsent', 'habitationFactors');"><a href="#modeAbsent" class="carre"><p>Absent</p></a></div>
</section>

<form method="post" action="index.php?p=homeInstallateur">

    <section class="habitationFactors" id="lumiere">
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
    </section>

    <section class="habitationFactors" id="volets">
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
    </section>

    <section class="habitationFactors" id="chauffage">
        <p>Gérez ici toutes les températures demandées de votre habitation :</p>
        <input type="number" name="heating" id="heating" />
        <p>°C</p>
        <input type="submit" value="Appliquer" name="habitationHeating" />
    </section>

    <section class="habitationFactors" id="ventilation">
        <p>Gérez ici toutes les ventilations de votre habitation :</p>
        <input type="number" name="ventilation" id="ventilation" />
        <input type="submit" value="Appliquer" name="habitationVentilation" />
    </section>

    <section class="habitationFactors" id="modeAbsent">
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
    </section>

</form>

<script type="text/javascript" src="view/js/home.js"></script>

</body>