<body>
    <section id="statisticSection" class="abc def">
        <?php
            $sensorNumber = count($sensorHistoric);
            $i = 0;
        foreach($sensorHistoric as $sensor){

                    ?>

            <h1 id=<?php echo 'sensorTitle'.$i; ?>
                onclick=<?php echo 'onOff('.$i.','.$sensorNumber.')';?>>
                <?php echo $sensorName[$i]; ?>
            </h1>
            <div class='graphSection' id=<?php echo 'sensorValue'.$i; ?>>
                <?php
                    for($j = 0; $j < count($sensor['value']); $j++){
                        ?>
                        <div class=<?php echo 'graph'.$i; ?>  id=<?php echo 'sensorHistoric'.$i.$j; ?>>
                        </div>
                     <?php
                    }
                     ?>
            </div>
        <?php
            $i++; 
        }
        ?>
    </section>
    <script>
        var sensorType = <?php echo json_encode($sensorType); ?>;
        var sensorHistoric = <?php echo json_encode($sensorHistoric); ?>;
    </script>
    <script type="text/javascript" src="/view/js/statistic.js"></script>
</body>