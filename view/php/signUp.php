
	<body>

    <h1>Inscription</h1>
        <form method="post" action="index.php?p=login&d=signUp">
            <span class="container">
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

                <label>Type d'utilisateur :
                    <select class="complete" name="type">
                        <option value="owner">Propriétaire</option>
                        <option value="guest">Invité</option>
                    </select>
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

                <label>Numéro de produit : <br>
                    <input type="text" name="productNumber" placeholder="123456789" required/>
                </label>
            </fieldset>
            </span>
            <label class="button">J'accepte les <a href="index.php?p=conditionsOfUse">C.G.U</a><input type="checkbox" name="termOfUse" class="checkbox" required /><span class="checkbox"></span>
            </label>

            <input type="submit" value="S'enregistrer" id="submit" required/>
        </form>
    <script type="text/javascript" src="view/js/signUp.js"></script>
    </body>
