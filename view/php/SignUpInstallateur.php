<h1>Inscription installateur</h1>
<form method="post" action="index.php?p=login&d=signUp">
            <section class="container">
            <fieldset class="left">
                <legend>Vos coordonnées</legend>

               <label>Nom :<br>
                    <input type="text" name="name" placeholder="Exemple : Pierre" required />
               </label>

                <label>Prénom :<br>
                    <input type="text" name="firstName" placeholder="Exemple : Dupond" required />
                </label>

                <label>Numéro de téléphone :<br>
                    <input class="complete" type="tel" name="phone" placeholder="Exemple : 0601020304" required />
                </label>

                <label>Date de naissance :<br>
                    <input class="complete date" type="date" name="birthDate" required>
                </label>
            </fieldset>

            <fieldset>
                <legend>Vos informations de connexion</legend>

                <label>Adresse e-mail : <br>
                    <input class="complete largeText" type="email" name="mail"  placeholder="Exemple : homie@gmail.com" required />
                </label>

                <label>Confirmer votre adresse e-mail :<br>
                    <input class="complete" type="email" name="confirmEmail" placeholder="homie@gmail.com" required/>
                </label>

                <label>Mot de passe :<br>
                    <input class="complete" type="password" name="password" placeholder="Mot de passe" onblur="checkPassword(this)" required />
                </label>

                <label>Confirmer votre mot de passe :<br>
                    <input class="complete" type="password" name="confirmPassword" placeholder="Confirmation" required />
                </label>
            </fieldset>

            <fieldset>
                <legend>Informations sur votre domicile</legend>
                <label>Adresse :<br>
                    <input class="largeText" type="text" name="address" placeholder="Exemple 10 rue de Vanves" required />
                </label>

                <label>Code postal :<br>
                    <input type="text" name="zipCode" placeholder="Exemple : 92130" required/>
                </label>

                <label>Ville :<br>
                    <input class="largeText" type="text" name="city" placeholder="Exemple : Issy-les-Moulineaux" required />
                </label>

               <label>Pays :
                    <select class="complete" name="country" required>
                        <option value="belgium">Belgique</option>
                        <option value="france">Fance</option>
                        <option value="luxembourg">Luxembourg</option>
                        <option value="switzerland">Suisse</option>
                    </select>
                </label>
            </fieldset>
            </section>

    <input type="submit" value="S'enregistrer" id="submit" required/>
</form>
<script type="text/javascript" src="view/js/signUp.js"></script>