<body>

    <form method="post" action="index.php?p=absentFactors">

        <div id="intro">
            <p>Paramètres du mode absent</p>
            <p><?php echo $absentFactors['name'] ?></p>
        </div>
        <section class="absentFactors" id="absentFactors">
            <div class="factors">
                <div class="ligne">
                    <div>
                        <p>Lumière :</p>
                        <div class="switchButton">
                            <input class="switch" name="lightAbsent" id="lightAbsent"
                                   type="checkbox" <?php echo $absentFactors['light'] ?> />
                            <label for="lightAbsent" class="label">
                                <div class="formeLight">
                                    <div class="rondLight">
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                    <div>
                        <p>Température demandée :</p>
                        <input type="number" name="temperatureAbsent" id="temperatureAbsent" value="<?php echo $absentFactors['heating'] ?>">
                        <p>°C</p>
                    </div>
                    <div>
                        <p>Ventilation :</p>
                        <input type="number" name="ventilationAbsent" id="ventilationAbsent"
                               value="<?php echo $absentFactors['ventilation'] ?>">
                    </div>
                </div>
                <div>
                    <p>Volets :</p>
                    <div class="switchButton">
                        <input class="switch" name="shutterAbsent" id="shutterAbsent"
                               type="checkbox" <?php echo $absentFactors['shutter'] ?> />
                        <label for="shutterAbsent" class="label">
                            <div class="formeShutter">
                                <div class="rondShutter">
                                </div>
                            </div>
                        </label>
                    </div>
                    <div class="switchButton">
                        <input class="switch" name="autoAbsent" id="autoAbsent"
                               type="checkbox" <?php echo $absentFactors['auto'] ?> />
                        <label for="autoAbsent" class="label">
                            <div class="formeAuto">
                                <div class="rondAuto">
                                </div>
                            </div>
                        </label>
                    </div>
                </div>
                <div>
                    <p>Plage horaire :</p>
                    <input type="time" name="openingAbsent" id="openingAbsent"
                           value="<?php echo $absentFactors['opening'] ?>" />
                    <P> - </P>
                    <input type="time" name="closingAbsent" id="closingAbsent"
                           value="<?php echo $absentFactors['closing'] ?>" />
                </div>
            </div>
            <input type="submit" value="Sauvegarder" name="absentFactors" />
        </section>

    </form>

</body>