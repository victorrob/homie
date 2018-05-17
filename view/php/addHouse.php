<form>
    <fieldset>
        <legend>Informations sur le domicile</legend>
        <label>Nom de la propriété <br>
            <input type="text" name="residenceName" placeholder="Exemple : Appartement Paris" required/>
        </label>

        <label>Adresse : <br>
            <input type="text" name="address" id="address" placeholder="Exemple : 10 rue de Vanves" required/>
        </label>

        <label>Ville :<br>
            <input type="text" name="residenceCity" placeholder="Exemple : Issy-les-Moulineaux" required />
        </label>

        <label>Code postal :<br>
            <input type="text" name="residenceCity" placeholder="Exemple : 92130" required />
        </label>

        <label>Type de résidence :
            <select class="complete" name="residenceType" required>
                <option value="belgium">Belgique</option>
                <option value="france">Fance</option>
                <option value="luxembourg">Luxembourg</option>
                <option value="switzerland">Suisse</option>
            </select>
        </label>
    </fieldset>

    <input type="submit" value="Ajouter maison" id="submit" />
</form>