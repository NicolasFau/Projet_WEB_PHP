<!DOCTYPE html>
    <html>       
        <head>
        	<meta charset="utf-8" />
            <link rel="stylesheet" href="css/menu.css" />
            <!-- Latest compiled and minified CSS -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        </head>

        <center><h1>Cliquer sur le bouton pour se connecter</h1></center>
        <hr>
        <center><form name="connexion" id="connexion" method="post" action="identification.php">
        	<input type="hidden" name="validate" id="validate" value="ko"/>
			<input type="submit" value="Se connecter" />
		</form><br>
            <form name="inscription" id="inscription" method="post" action="saisieUser.php">
        	<input type="hidden" name="validate" id="validate" value="ko"/>
			<input type="submit" value="S'inscrire" />
		</form>
        </center>

	</html>
