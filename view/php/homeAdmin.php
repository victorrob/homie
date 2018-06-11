<p id="search"><input type="text" id="searchField" onkeyup="search()" placeholder="Recherche par nom de famille"></p>
<form method="post" action="index.php?p=homeAdmin&d=homeAdmin">
    <section id="userType">
    <?php foreach($userType as $type){
        ?>
    <div class="selectType" onclick="select(this)"><?php echo $type; ?></div>

    <?php
    }
    ?>
    </section>
    <table id="adminTable">
    <tr>
        <?php
        foreach ($userInfo as $key){
                ?>
                <th><?php echo $key; ?></th>
                <?php
        }
        ?>
        <th></th>
    </tr>
    <?php
    $j = 1;
    foreach($users as $user){

        ?>
    <tr>
        <?php
        for ($i = 0; $i<count($userInfo); $i++) {
            if ($userInfo[$i] != 'Type') {
                ?>
                <td><?php echo $user[$i]; ?></td>
                <?
            }
            else{
                ?>
                <td>
                    <select id="<?php echo 'adminSelect'.$j; ?>"
                            name="type[<?php echo $user[2]; ?>]"
                            class="adminSelect" onclick="dropdown(this)"
                            onchange="this.form.submit();">
                        <?php
                        foreach ($userType as $type){
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
            <label class="lblButton"><input type="checkbox" name="user[<?php echo $user[2]; ?>]">
                <span class="checkbox"></span>
            </label>
        </td>
    </tr>

        <?php
        $j++;
    }
    ?>
    <tr>
        <?php
        for ($i = 0; $i<count($userInfo); $i++) {
            if ($userInfo[$i] == 'Mail'){
                ?>
                <td><input type="email" name="userMail" placeholder="jean.dupont@homie.fr"></td>
                <?php
            }
            else    if ($userInfo[$i] != 'Type') {
                ?>
                <td><?php echo $userInfo    [$i]; ?></td>
                <?
            }
            else{
                ?>
                <td>
                    <select id="<?php echo 'adminSelect'.$j; ?>"
                            name="type[new]"
                            class="adminSelect" onclick="dropdown(this)">
                        <?php
                        foreach ($employeeType as $type){
                            ?>
                            <option class="adminOption"
                                    value=<?php echo $type; ?>>
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
            <input id="add" type="submit" value="Ajouter" onclick="send('add')" >
        </td>
</tr>
</table>
<input name="deleteUser" id="hiddenDelete" type="text" value="null">
<input id="delete" type="submit" value="supprimer" onclick="send('delete');">
</form>