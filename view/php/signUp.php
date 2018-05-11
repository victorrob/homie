
	<body>

    <h1>Inscription</h1>
        <form method="post" action="index.php?p=signUp">
            <span class="container">
            <fieldset>
                <legend>Vos coordonnées</legend>

               <p><label for="name">Nom :
                    <input type="text" name="name" placeholder="Exemple : Pierre" required />
                </label></p>

                <p><label for="prenom">Prénom :
                    <input type="text" name="firstName" placeholder="Exemple : Dupond" required />
                </label></p>

                <p><label for="phone">Numéro de téléphone :
                    <input type="tel" name="phone" placeholder="Exemple : 0601020304" required />
                </label></p>

                <p><label for="birthDate">Date de naissance :
                    <input type="date" name="birthDate" required>
                </label></p>
            </fieldset>

            <fieldset>
                <legend>Vos informations de connexion</legend>

                <p><label for="email">Adresse e-mail :
                    <input type="email" name="mail"  placeholder="Exemple : homie@gmail.com" required />
                </label></p>

                <p><label for="confirmEmail">Confirmer votre adresse e-mail :
                    <input type="email" name="confirmEmail" placeholder="homie@gmail.com" required/>
                </label></p>

                <p><label for="password">Mot de passe :
                    <input type="password" name="password" placeholder="Mot de passe" required />
                </label></p>

                <p><label for="confirmPassword">Confirmer votre mot de passe :
                    <input type="password" name="confirmPassword" placeholder="Confirmation" required />
                </label></p>

                <p><label for="type">Type d'utilisateur :
                    <select name="type">
                        <option value="owner">Propriétaire</option>
                        <option value="guest">Invité</option>
                    </select>
                </label></p>
            </fieldset>

            <fieldset>
                <legend>Informations sur votre domicile</legend>
                <p><label for="address">Adresse :
                    <input type="text" name="address" placeholder="Exemple 10 rue de Vanves" required />
                </label></p>

                <p><label for="zipCode">Code postal :
                    <input type="text" name="zipCode" placeholder="Exemple : 92130" required/>
                </label></p>

                <p><label for="city">Ville :
                    <input type="text" name="city" placeholder="Exemple : Issy-les-Moulineaux" required />
                </label></p>

               <p><label for="country">Pays :
                    <select name="country" required>
                        <option value="belgium">Belgique</option>
                        <option value="france">Fance</option>
                        <option value="luxembourg">Luxembourg</option>
                        <option value="switzerland">Suisse</option>
                    </select>
                </label></p>

                <p><label for="productNumber">Numéro de produit :
                    <input type="text" name="productNumber" placeholder="123456789" required/>
                </label></p>
            </fieldset>
            </span>

            <label for="termOfUse" class="button">J'accepte les <a href="index.php?p=conditionsOfUse">C.G.U</a><input type="checkbox" name="termOfUse" required /><span class="checkbox"></span>
            </label>

            <input type="submit" value="S'enregistrer" id="submit" />
        </form>
    </body>
