<form>
<table>
    <tr>
        <?php
        $trueKey = [];
        $userKeys = array_keys($users[0]);
        $types = ['installateur', 'admin'];
        foreach ($userKeys as $key){
            if(gettype($key) != 'integer') {
                ?>
                <th><?php echo $key; ?></th>
                <?php
                array_push($trueKey,$key);
            }
        }
        ?>
        <th>selectionner</th>
    </tr>
    <?php
    foreach($users as $user){

        ?>
    <tr>
        <?php
        for ($i = 0; $i<count($trueKey); $i++) {
            if ($trueKey[$i] != 'type') {
                ?>
                <td><?php echo $user[$i]; ?></td>
                <?
            }
            else{
                ?>
                <td>
                    <select id="adminSelect" onclick="dropdown(this)">
                        <?php
                        foreach ($types as $type){
                         ?>
                                 <option class="adminOption"
                                         value=<?php echo $type; ?>
                                     <?php echo ($type==$user[$i])? "selected":"";?>>
                                     <?php echo $type; ?>
                                 </option>
                        <?php
                      }
                      ?>
                    </select>
                </td>
        <?php
            }
        }
        ?>
        <td>
            <label class="lblButton"><input type="checkbox" name="user[<?php echo $i; ?>]">
                <span class="checkbox"></span>
            </label>
        </td>
    </tr>
    <?
    }
    ?>
</table>
<input name="deleteUser" id="hiddenDelete" type="text" value="null">
<input id="delete" type="submit" value="supprimer" onclick="send('delete');">
</form>