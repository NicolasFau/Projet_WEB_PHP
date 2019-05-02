

        <?php
            include 'head.php';
            include 'header.php';
            require 'connexion.php';
        ?>

        <body>

                        <h1>L'utilisateur a bien été enregistré.</h1>

                <?php
                    $pseudo=$_POST['PseudoU'];
                    $mail=$_POST['MailU'];
                    $pass=$_POST['PasswordU'];
                    $dateCrea=date("Y-m-d");
                    $description=$_POST['DescriptionU'];
                    $ddn=$_POST['DDNU'];
                    $type=$_POST['TypeU'];
                    if(!isset($_SESSION['PseudoU'])) {
                        if (isset($pseudo)) {
                                $result = pg_query($linkpdo, "SELECT CodeUtilisateur FROM utilisateur WHERE PseudoU = '$pseudo' AND MailU = '$mail'  AND PasswordU = '$pass' AND DateCreationU = '$dateCrea' AND DescriptionU = '$description' AND DDNU = '$ddn' AND TypeU = '$type';");
                                $row = pg_fetch_array($result);
                                if (!strcmp($row['PseudoU'], $pseudo)) {
                                    header('Location: acueil.php?error=Login déjà utilisé.');
                                } else {
                                    $result = pg_query($linkpdo, "INSERT INTO utilisateur (PseudoU,MailU,PasswordU,DateCreationU,DescriptionU,DDNU,estadministrateur,TYPEU) VALUES('$pseudo', '$mail', '$pass','$dateCrea', '$description', '$ddn',false , '$type');");
                                    if ($result) {
                                        header('Location: accueil.php');
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
