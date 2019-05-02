<!DOCTYPE html>
    <html>       
        <head>
        	<meta charset="utf-8" />
            <link rel="stylesheet" href="css/menu.css" />
            <!-- Latest compiled and minified CSS -->
            <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
        </head>
        <?php
        include 'header.php';
        ?>
		<?php

		if(isset($_SESSION['PseudoU']))
		{
			$informations = Array(/*Membre qui essaie de se connecter alors qu'il l'est déjà*/
							true,
							'Vous êtes déjà connecté',
							'Vous êtes déjà connecté avec le pseudo <span class="PseudoU">'.htmlspecialchars($_SESSION['PseudoU'], ENT_QUOTES).'</span>.');
			
			exit();
		}

			if($_POST['validate'] != 'ok')
			{

			$titre = 'Connexion';


			?>
						<center><h3>Connexion</h3></center>
						<center><form action="identification.php" method="post">
                                <fieldset style="width:300px;">
                                <p>Identifiant<input type="text" name="PseudoU" placeholder="Admin" required="required" style="width:200px; display:block; margin:auto; text-align:center;"/></p>    
                                <p>Mot de passe<input type="password" name="PasswordU" placeholder="0000" required="required" style="width:200px; display:block; margin:auto; text-align:center;"/></p>
                            	<input type="hidden" name="validate" value="ok"/>
                                <p><input type="submit" value="Connexion"></p>
                                </fieldset>
                    	</form></center>
			
						<?php
			}			
					else
					{ 
						$result = $linkpdo->prepare('SELECT PasswordU, estAdmin FROM utilisateur WHERE PseudoU = :PseudoU');
						$result->execute(array('PseudoU' => $_POST['PseudoU']));
						$donnees = $result->fetch();
						
							if($_POST['PasswordU'] == $donnees['PasswordU'])
							{
								session_start();
								$_SESSION['PseudoU'] = $_POST['PseudoU'];
								$_SESSION['PasswordU'] = $donnees['PasswordU'];
                                $_SESSION['estAdmin'] = $donnees['estAdministrateur'];
								header('Location: header.php');
								
								if(isset($_POST['cookie']) && $_POST['cookie'] == 'on')
								{
									setcookie('PseudoU', $result['PseudoU'], time()+2*3600);
									setcookie('PasswordU', $result['PasswordU'], time()+2*3600);
								}
								
								$informations = Array(/*Vous êtes bien connecté*/
												false,
												'Connexion réussie',
												'Vous êtes désormais connecté avec le login <span class="PseudoU">'.htmlspecialchars($_SESSION['PseudoU']));
								exit();
							}
							
							else
							{
								header('Location identification.php');
								$_SESSION['PseudoU'] = $_POST['PseudoU'];
								$informations = Array(/*Erreur de mot de passe*/
												true,
												'Mauvais mot de passe',
												'Vous avez fourni un mot de passe incorrect.',
												);
								exit();
							}
					}
					session_commit();
					?>			
				
</html>
