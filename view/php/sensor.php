<body>
    <?php
    $sensorList = ["temperature", "humidite", "CO2", "pression", "lumière"];
    $actuatorList = ["chauffage", "lumière", "ventilation"];

    $sensorCheck = ["checked", "", "checked", "", "checked"];
    $actuatorCheck = ["", "checked", ""];

    $roomName = "";
    $roomSize = "";
    ?>

    <form id="sensorForm" method="post" action="index.php?p=home">
        <fieldset class="checkboxSection">
            <legend>capteurs</legend>
        <?php
        for($i = 0; $i<count($sensorList); $i++){
            ?>
            <label class="button">
                <?php echo $sensorList[$i]; ?>
                <input type="checkbox" name=<?php echo $sensorList[$i]; ?>
                <?php echo $sensorCheck[$i]; ?>>
                <span class="checkbox"></span>
            </label>
    <?php
    }
        ?>
        </fieldset>
        <fieldset class="checkboxSection">
            <legend>actionneurs</legend>
            <?php
            for($i = 0; $i<count($actuatorList); $i++){
                ?>
                <label class="button">
                    <?php echo $sensorList[$i]; ?>
                    <input type="checkbox" name=<?php echo $actuatorList[$i]; ?>
                        <?php echo $actuatorCheck[$i]; ?>>
                    <span class="checkbox"></span>
                </label>
                <?php
            }
            ?>

        </fieldset>
        <fieldset id="textfield">
            <legend>caracteristique</legend>
            <label>
                Nom de la pièce : <br/>
                <input class="inputText" type="text" value=<?php echo $roomName; ?>>
            </label>
            <br/>
            <label>
                Taille de la pièce (en m²) : <br/>
                <input class="inputText" type="text" value=<?php echo $roomSize; ?>>
            </label>
        </fieldset>
        <input id="submit" type="submit">
    </form>
</body>