<?php
    include 'head.php';
?>

		<body>
            <?php
                include 'header.php';
            ?>
            <div class="page">
                <center><h1>Inscription</h1></center>
				<fieldset>
                    <div id="infos">
                            <form action="enregistrerUser.php" method="post">
                                        <p>Pseudo <br><input type="text" name="PseudoU" required="required"/></p>
                                        <p>Password  <br><input type="password" name="PasswordU" required="required" onInvalid="setCustomValidity('Veuillez entrer un mot de passe avec au moins une majuscule et un chiffre')"/></p>
                                        <p>Mail <br><input type="email" name="MailU" required="required" placeholder="test@gmail.com" style="text-align: center"/></p>
                                        <p>Description <br><textarea id="Description" name="DescriptionU" required="required" maxlength="255"  style="text-align: center"></textarea></p>
                                        <p>Type <br><select name="TypeU" id="menu" required="required">
                                        <option>Amateur</option>
                                        <option>Journaliste</option>
                                        <option>Blogeur</option>
                                        </select>
                                        </p>
                                
                                        <p>Date Naissance <br><input type="text" name="DDNU" id="date" required="required" max="2009-01-01" min="1919-01-01" style="text-align: center"/></p>
                                        <?php
                                        if(isset($_GET['error'])){
                                            $erreur = $_GET['error'];
                                            echo "<p class = 'error'>$erreur</p>";
                                        }
                                        ?>
                                        <p><input type="submit" value="Enregistrer">        <input type="reset" value="Effacer les champs"></p>
                            </form>
                    </div>
				</fieldset>
            </div>
            <?php
            include 'footer.php';
            
            ?>
              <script>
  $( function() {
    $( "#date" ).datepicker();
  
    $( "#menu" ).selectmenu();
});
  </script>
		</body>
	</html>

