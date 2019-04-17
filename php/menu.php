<!DOCTYPE html>
    <html>       
        <head>
        	<meta charset="utf-8" />
            <link rel="stylesheet" href="css/menu.css" />
            <!-- Latest compiled and minified CSS -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        </head>

        <?php
            session_start();
            if(!isset($_SESSION['login']) AND !isset($_SESSION['password'])){
                header('Location: index.php');
            }
        ?>

        <body>
		
        	<ul id="menu-demo2">
				<li><a href="accueil.php">Accueil</a></li>
				<li><a href="#">Users</a>
					<ul>
						<li><img src="image/plus.png" id="img" href="saisieUser.php" alt="ajouter" /><a href="saisieUSer.php">Ajouter utilisateur</a></li>
					</ul>
				</li>
                <li><a href="deconnexion.php">Deconnexion</a></li>
			</ul>
			<!--<hr>--> 
        </body>
    </html>
