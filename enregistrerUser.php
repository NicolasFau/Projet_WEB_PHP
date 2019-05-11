<!DOCTYPE html>
    <html>

        <head>
            <meta charset="utf-8" />
            <link rel="stylesheet" href="css/menu.css" />
            <!-- Latest compiled and minified CSS -->
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        </head>

        <?php
            require 'connexion.php';
        ?>

        <body>

                        <h1>L'utilisateur a bien été enregistré.</h1>

                <?php
                    $pseudo=$_POST['PseudoU'];
                    $mail=strtolower(htmlentities(pg_escape_string ($_POST['MailU'])));
                    $pass=$_POST['PasswordU'];
                    $dateCrea=date("Y-m-d");
                    $description=pg_escape_string($_POST['DescriptionU']);
                    $ddn=$_POST['DDNU'];
                    $type=$_POST['TypeU'];
                    if(!isset($_SESSION['PseudoU'])) {
                        if (isset($pseudo)) {
                                $result = pg_query($linkpdo, "SELECT CodeUtilisateur FROM utilisateur WHERE PseudoU = '$pseudo' AND MailU = '$mail'  AND PasswordU = '$pass' AND DateCreationU = '$dateCrea' AND DescriptionU = '$description' AND DDNU = '$ddn' AND TypeU = '$type';");
                                $row = pg_fetch_array($result);
                                if (!strcmp($row['PseudoU'], $pseudo)) {
                                    header('Location: index.php?error=Login déjà utilisé.');
                                } else {
                                    $result = pg_query($linkpdo, "INSERT INTO utilisateur (PseudoU,MailU,PasswordU,DateCreationU,DescriptionU,DDNU,estadministrateur,TYPEU) VALUES('$pseudo', '$mail', '$pass','$dateCrea', '$description', '$ddn',false , '$type');");
                                    if ($result) {
                                        header('Location: index.php');
                                    } else {
                                        header('Location: saisieUser.php?error=Erreur lors de la création du compte.');
                                    }
                                }
                        }
                    }else{
                        header('Location: accueil.php');
                    }

                ?>
        </body>
    </html>
