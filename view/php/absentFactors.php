<body>

    <form method="post" action="index.php?p=absentFactors.php">

        <section class="absentFactors" id="absentFactors">
            <div class="factors">
                <div><p>Paramètres du mode absent</p></div>
                <div class="ligne">
                    <div>
                        <p>Lumière :</p>
                        <div class="switchButton">
                            <input class="switch" name="absentLight" id="absentLight"
                                   type="checkbox" <?php ?> />
                            <label for="absentLight" class="label">
                                <div class="formeLight">
                                    <div class="rondLight">
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                    <div class="temperature">
                        <p>Température demandée :</p>
                        <input type="number" name="temperatureAbsent" id="temperatureAbsent" value="<?php echo $room['heating'] ?>">
                        <p>°C</p>
                    </div>
                    <div>
                        <p>Ventilation :</p>
                        <input type="number" name="ventilationAbsent" id="ventilationAbsent"
                               value="<?php echo $room['ventilation'] ?>">
                    </div>
                </div>
                <div>
                    <p>Volets :</p>
                    <div class="switchButton">
                        <input class="switch" name="shutterAbsent" id="shutterAbsent"
                               type="checkbox" <?php echo $room['shutter'] ?> />
                        <label for="shutterAbsent" class="label">
                            <div class="formeShutter">
                                <div class="rondShutter">
                                </div>
                            </div>
                        </label>
                    </div>
                    <div class="switchButton">
                        <input class="switch" name="autoAbsent" id="autoAbsent"
                               type="checkbox" <?php echo $room['auto'] ?> />
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
                           value="<?php echo $room['opening'] ?>" />
                    <P> - </P>
                    <input type="time" name="closingAbsent" id="closingAbsent"
                           value="<?php echo $room['closing'] ?>" />
                </div>
            </div>
            <input type="submit" value="Sauvegarder" name="roomModification" />
        </section>

    </form>

</body>