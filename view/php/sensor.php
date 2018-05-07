<body>
    <form id="customForm" method="post" action="index.php?p=home">
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
                <input name="name" class="inputText" type="text" value=<?php echo $roomName; ?> required>
            </label>
            <br/>
            <label>
                Type de pièce : <br/>
                <input class="inputText" type="text" value=<?php echo $roomType; ?> required>
            </label>
            <br/>
            <label>
                Taille de la pièce (en m²) : <br/>
                <input class="inputText" type="text" value=<?php echo $roomSize; ?> required>
            </label>
        </fieldset>
        <input id="submit" type="submit">
    </form>
</body>