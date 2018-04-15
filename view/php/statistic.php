<body>
    <section id="statisticSection" class="abc def">
        <?php
            $sensorHistoric0 = array(80, 62, 12, 30, 87, 70, 51, 96, 89, 82, 2, 8, 74, 61, 1, 42, 4, 27);

            $sensorHistoric2 = array(22, 62, 12, 30, 87, 70, 51, 96, 89, 82, 2, 8, 74, 61, 1, 42, 4, 27);
            $sensorHistoric = array($sensorHistoric0, $sensorHistoric1, $sensorHistoric2);
            $sensorNumber = 3;
            echo print_r($sensorHistoric1);
        for($sensor = 0; $sensor<$sensorNumber; $sensor++)
                {
                    ?>
            <h1 id=<?php echo 'sensorTitle'.$sensor; ?>
                onclick=<?php echo 'onOff('.$sensor.','.$sensorNumber.')';?>>
                <?php echo 'sensor'.$sensor; ?>
            </h1>
            <div class=<?php echo "grapSection$sensor"; ?> id=<?php echo 'sensorValue'.$sensor; ?>>
                <?php
                    for($i = 0; $i < count($sensorHistoric[$sensor]); $i++){
                        ?>
                        <div class=<?php echo 'graph'.$sensor; ?>  id=<?php echo 'sensorHistoric'.$sensor.$i; ?>>
                        </div>
                     <?php
                    }
                     ?>
            </div>
        <?php
                }
        ?>
    </section>
    <script>
        var sensorHistoric = <?php echo json_encode($sensorHistoric); ?>;
    </script>
    <script type="text/javascript" src="/view/js/statistic.js"></script>
</body>