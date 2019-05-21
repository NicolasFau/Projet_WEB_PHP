<!DOCTYPE html>
    <html>		
		<head>
			<meta charset="utf-8" />
		        <link rel="stylesheet" href="./css/style.css" />
		        <!-- Latest compiled and minified CSS -->
			<meta charset="utf-8">
			 <meta name="viewport" content="width=device-width, initial-scale=1">
  			
  			<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  			<link rel="stylesheet" href="/resources/demos/style.css">
  			<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  			<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#date" ).datepicker();
  
    $( "#menu" ).selectmenu();
});
  </script>
		</head>
        <?php
        include 'head.php';
        include 'header.php';
        ?>

		<body>
				<fieldset>
                    <legend>Inscription</legend>
                    <div id="infos">
                            <form action="enregistrerUser.php" method="post">
                                        <p>Pseudo <br><input type="text" name="PseudoU" required="required"/></p>
                                        <p>Password  <br><input type="password" name="PasswordU" required="required" onInvalid="setCustomValidity('Veuillez entrer un mot de passe avec au moins une majuscule et un chiffre')"/></p>
                                        <p>Mail <br><input type="email" name="MailU" required="required" placeholder="test@gmail.com" style="text-align: center"/></p>
                                        <p>Description <br><textarea rows = "5" cols = "50" name="DescriptionU" required="required" maxlength="255" placeholder="Entrer votre description" style="text-align: center"></textarea></p>
                                        <p>Type <br><select name="TypeU" id="menu" required="required"/>
                                        <option>Amateur</option>
                                        <option>Journaliste</option>
                                        <option>Blogeur</option>
                                        </select></p>
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
		</body>
	</html>

