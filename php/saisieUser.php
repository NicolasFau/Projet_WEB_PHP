<?php
    include 'head.php'; //Inclusion du CSS et Metacharset UTF-8
?>

		<body>
            <?php
                include 'header.php';
            ?>
            <div class="page">
                <center><h1>Inscription</h1></center>
				<fieldset>
                    <div id="infos">
                            <!--Formulaire où sont renseignées les informations pour l'inscription, appelle la page enregistrerUser.php avec la méthode POST-->
                            <form action="enregistrerUser.php" method="post">
                                        <!--Pseudo de l'utilisateur-->
                                        <p>Pseudo <br><input type="text" name="PseudoU" required="required"/></p>
                                        <!--Password de l'utilisateur avec une fonction de vérification de la compléxité du mot de passe sur enregistrerUser.php-->
                                        <p>Password  <br><input type="password" name="PasswordU" required="required" onInvalid="setCustomValidity('Veuillez entrer un mot de passe avec au moins une majuscule et un chiffre')"/></p> 
                                        <!--Champ de saisie du mail avec vérification de la syntaxe, modifiable ultérieurement sur le profil de l'utilisateur-->
                                        <p>Mail <br><input type="email" name="MailU" required="required" placeholder="test@gmail.com" style="text-align: center"/></p>
                                        <!--Description pour le profil de l'utilisateur, modifiable ultérieurement sur le profil de l'utilisateur-->
                                        <p>Description <br><textarea id="Description" name="DescriptionU" required="required" maxlength="255"  style="text-align: center"></textarea></p>
                                        <!--Type de l'utilisateur, modifiable ultérieurement sur le profil de l'utilisateur-->
                                        <p>Type <br><select name="TypeU" id="menu" required="required">
                                        <option>Amateur</option>
                                        <option>Journaliste</option>
                                        <option>Blogeur</option>
                                        </select>
                                        </p>
                                        <!--Date de naissance de l'utilisateur avec une vérification de la validité-->
                                        <p>Date Naissance <br><input type="text" name="DDNU" id="date" required="required" max="2009-01-01" min="1919-01-01" style="text-align: center"/></p>
                                        <?php
                                        //Récupération de l'erreur avec une variable GET
                                        if(isset($_GET['error'])){
                                            $erreur = $_GET['error'];
                                            echo "<p class = 'error'>$erreur</p>";
                                        }
                                        ?>
                                        <p><input type="submit" value="Enregistrer">        <input type="reset" value="Effacer les champs" style="width:150px"></p>
                            </form>
                    </div>
				</fieldset>
            </div>
            <?php
            include 'footer.php';
            
            ?>
            <!--Scipt JQuery pour la sélection de la date de naissance-->
              <script>
  $( function() {
    $( "#date" ).datepicker();
  
    $( "#menu" ).selectmenu();
});
  </script>
		</body>
	</html>

