<body>
    <section id="statisticSection">
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
                <section id="timeRange">
                    <div onclick="selectTimeRange(0,<?php echo $i; ?>)" class="timeRangeButton" id=<?php echo '5years'.$i; ?>>5 ans</div>
                    <div onclick="selectTimeRange(1,<?php echo $i; ?>)" class="timeRangeButton" id=<?php echo '1year'.$i; ?>>1 an</div>
                    <div onclick="selectTimeRange(2,<?php echo $i; ?>)" class="timeRangeButton" id=<?php echo '6month'.$i; ?>>6 mois</div>
                    <div onclick="selectTimeRange(3,<?php echo $i; ?>)" class="timeRangeButton" id=<?php echo '30days'.$i; ?>>30 jours</div>
                    <div onclick="selectTimeRange(4,<?php echo $i; ?>)" class="timeRangeButton" id=<?php echo '7days'.$i; ?>>7 jours</div>
                </section>
                <p id="verticalLine"></p>
                <?php
                    $maxDiv = max(count($sensor['value']),30);
                    for($j = 0; $j < $maxDiv; $j++){
                        ?>
                            <div onmouseout="showValue(<?php echo $i; ?>, null, false)"
                                 onmouseover="showValue(<?php echo $i; ?>,<?php echo $j; ?>, true)"
                                 class=<?php echo 'graph'.$i; ?>  id=<?php echo 'sensorHistoric'.$i.'+'.$j; ?>>
                                <div class="date" id=<?php echo 'date'.$i.'+'.$j; ?>>
                                </div>
                            </div>

                     <?php
                    }
                     ?>
                <section id = "valuesSection">
                    <p  class="values" id=<?php echo 'maxValue'.$i; ?> >12</p>
                    <p class="values" id=<?php echo 'meanValue'.$i; ?> >6</p>
                    <p class="values" id=<?php echo 'maxValue'.$i; ?> >0</p>
                </section>
                <p class="triangle" id=<?php echo 'triangle'.$i; ?>></p>
                <p class="idValue" id=<?php echo 'showValue'.$i; ?>></p>
            </div>
        <?php
            $i++; 
        }
        ?>
    </section>
    <script>
        var sensorType = <?php echo json_encode($sensorName); ?>;
        var sensorHistoricOriginal = <?php echo json_encode($sensorHistoric); ?>;
        var sensorHistoric = [].concat(sensorHistoricOriginal);
        alert(JSON.stringify(sensorHistoric));
        alert(JSON.stringify(sensorType));
    </script>
    <script type="text/javascript" src="view/js/statistic.js"></script>
</body>