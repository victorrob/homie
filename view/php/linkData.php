<?php

foreach ($linkData as $data){
    if(count($data)>0){
        $keys = array_keys($data[0]);
        ?>
        <table id="adminTable">
            <tr>
                <?php
                foreach ($keys as $key){
                    ?>
                    <th><?php echo $key; ?></th>
                    <?php
                }
                ?>
            </tr>
            <?php
            foreach($data as $line){

            ?>
            <tr>
                <?php
                foreach($line as $value) {
                    ?>
                    <td><?php echo $value; ?></td>
                    <?php
                }
                ?>
            </tr>

            <?php
            }
            ?>
        </table>
<?php
    }
}