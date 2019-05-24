<!DOCTYPE html>
    <html>

        <head>
            <meta charset="utf-8" />
            <!-- Latest compiled and minified CSS -->
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        </head>

        <?php
            require 'connexion.php';
        ?>

        <body>

                <?php
                //On récupère la variable POST du pseudo renseignée sur saisieUSER
                    $pseudo=$_POST['PseudoU'];
                    //On recupère la variable POST du mail en minuscule et avec la gestion des ''
                    $mail=strtolower(htmlentities(pg_escape_string ($_POST['MailU'])));
                    //On récupère la variable POST du password renseignée sur saisieUSER
                    $pass=$_POST['PasswordU'];
                    //Si le password valide la regex suivante alors on peut enregistrer l'utilisateur
                    if(preg_match("#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{6,}$#",$pass)) {
                        //Date de création du compte initialisée à la date du jour
                        $dateCrea = date("Y-m-d");
                        //On récupère la variable POST de la description renseignée sur saisieUSER
                        $description = pg_escape_string($_POST['DescriptionU']);
                        //On récupère la variable POST de la date de naissance renseignée sur saisieUSER
                        $ddn = $_POST['DDNU'];
                        //On récupère la variable POST du type renseignée sur saisieUSER
                        $type = $_POST['TypeU'];
                        //Si la session avec le pseudo renseigné n'est pas déjà active
                        if (!isset($_SESSION['PseudoU'])) {
                            if (isset($pseudo)) {
                                //On vérifie que l'utilisateur n'existe pas dejà dans la BD
                                $result = pg_query($linkpdo, "SELECT CodeUtilisateur FROM utilisateur WHERE PseudoU = '$pseudo' AND MailU = '$mail'  AND PasswordU = '$pass' AND DateCreationU = '$dateCrea' AND DescriptionU = '$description' AND DDNU = '$ddn' AND TypeU = '$type';");
                                $row = pg_fetch_array($result);
                                if (!strcmp($row['PseudoU'], $pseudo)) {
                                    //Si l'utilisateur existe déjà, c'est à dire si le pseudo renseigné est dejà existant dans la BD alors on invite l'utilisteur à en choisir un autre
                                    header('Location: saisieUser.php?error=Login déjà utilisé.');
                                } else {
                                    //Sinon on rajoute l'utilisateur avec toutes ses informations dans la BD
                                    $result = pg_query($linkpdo, "INSERT INTO utilisateur (PseudoU,MailU,PasswordU,DateCreationU,DescriptionU,DDNU,estadministrateur,TYPEU) VALUES('$pseudo', '$mail', '$pass','$dateCrea', '$description', '$ddn',false , '$type');");
                                    if ($result) {
                                        //Une fois l'inscription effectuée l'utilisateur est redirigé vers la page de connexion
                                        header('Location: identification.php');
                                    } else {
                                        //Si l'inscription s'est mal passée alors on affiche un message d'erreur dans le GET
                                        header('Location: saisieUser.php?error=Erreur lors de la création du compte.');
                                    }
                                }
                            }
                        } else {
                            //Si la session avec le pseudo renseigné est déjà active alors on redirige vers l'accueil
                            header('Location: accueil.php');
                        }
                        //Si le mot de passe ne respecte pas la Regex alors on redirige vers la page saisieUser.php
                    }else {
                        header('Location: saisieUser.php?error=Mot de passe invalide.');
                    }

                ?>
        </body>
    </html>
