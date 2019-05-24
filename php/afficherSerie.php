<?php
$titre=$_GET['nomserie'];//Récupération du nom de la série par la variable GET de la recherche pour l'afficher en titre
require 'connexion.php';//Connexion avec la base de données PostGreSQL
include 'head.php';//Inclusion du CSS et Metacharset UTF-8
?>


<body>

<?php
    include 'header.php';//Inclusion du header avec le menu
?>
<div class="page">
<?php
            //Récupération du nom de la série renseigné dans la variable GET de la recherche sans les caractères d'échappement
            $nomserie=pg_escape_string($_GET['nomserie']);
            //On sélectionne toutes les infos relatives à la série dans la base de données
            $result = pg_query($linkpdo, "SELECT * FROM Serie WHERE NomSerie = '$nomserie';");
            $row = pg_fetch_array($result);
            $test=count($row);
            //Si la série est bien existante avec toutes les infos
                if($test != 1) {
                    ?>
                    <!--On affiche le nom de la série en titre-->
        <center><h1><?php echo $nomserie?></h1></center>
                    <table>
                        <tr>
                            <td><?php
                            //On récupère l'url de l'image la série pour l'afficher
                    $urlimage = $row['urlimageserie'];
                    echo "<img src=" . $urlimage . " alt='' height= 268 width=182>" . "<br>" . "<br>";
                    
                       ?>
                            </td>
                            <td><?php
                            //On affiche toutes les informations récupérées dans la requete
                                echo "<b>Theme de la série </b>" . "<br>" . "<br>";
                                echo $row['themeserie'] . "<br>" . "<br>";
                                echo "<b>Pays d'origine de la série </b>" . "<br>" . "<br>";
                                echo $row['paysorigineserie'] . "<br>" . "<br>";
                                echo "<b>Synopsis série</b>" . "<br>" . "<br>";
                                echo $row['synopsisserie'] . "<br>" . "<br>";
                                ?>
                               
                            </td>
                        </tr>
                        </table>
    <div style="margin:15px;">
     <?php
            //on selectionne tous les réalisateurs en rapport avec la série et on les affiches
		    $queryrea="SELECT nomrealisateur, prenomrealisateur FROM realisateur, realiser WHERE realisateur.idrealisateur=realiser.idrealisateur AND nomserie='$nomserie'"; 		    
		    $resultrea=pg_query($linkpdo,$queryrea);
		    
			echo "<b>Réalisateur</b>"."</br>";
			while($data=pg_fetch_array($resultrea)){
				echo $data['nomrealisateur']." ";
				echo $data['prenomrealisateur'];
				echo ", ";
			}
             echo "<br>";

            //on selectionne tous les acteurs en rapport avec la série et on les affiches
			 $queryacteur="SELECT nomacteur, prenomacteur FROM acteur, jouer WHERE acteur.idacteur=jouer.idacteur AND nomserie='$nomserie'";
                    $resultacteur=pg_query($linkpdo,$queryacteur);

                        echo "<b>Acteur</b>"."</br>";
                        while($data=pg_fetch_array($resultacteur)){
                                echo $data['nomacteur']." ";
                                echo $data['prenomacteur'];
                                echo ", ";
                        }
                    echo "<br>";

            //on selectionne tous les prix en rapport avec la série et on les affiches
			 $queryprix="SELECT nomprix, villeprix FROM prixdecerne, decerner WHERE prixdecerne.idprix=decerner.idprix AND nomserie='$nomserie'";
                    $resultprix=pg_query($linkpdo,$queryprix);

                        echo "<b>Prix</b>"."</br>";
                        $data=pg_fetch_array($resultprix);
                        if($data){
                           while($data){
                                echo $data['nomprix']." de ";
                                echo $data['villeprix']."</br>";
                        }
                        }  else {
                            echo "Cette série n'a pas reçu de prix"."</br>";
                        }
                   
                    
			?>
    </div>
                    <div style="margin: 15px;">
                        <?php
                        //On affiche toutes les saisons concernant cette série
                    echo "<b>Saisons existantes :</b>" . "<br>";
                    $result2 = pg_query($linkpdo, "SELECT numérosaison FROM Saison WHERE nomSerie = '$nomserie' order by numérosaison;");
                    $row2 = pg_fetch_all($result2);
                    if($row2!=null){
                    //Pour chaque saison on affiche un lien de redirection en fonction du numéro de la saison
                    //On renseigne dans une variable GET le numéro de la saison et la série associée
                    $count = count($row2);
                        for ($i = 0; $i < $count; $i++) {
                            $s = $row2[$i]['numérosaison'];
                            echo "<a href='afficherSaison.php?numsai=$s&nomserie=$nomserie'>Saison $s</a>" . "<br>";
                             }?>
			
                    </div>
                    <?php
                    //Si l'utilisateur est connecté
                    //On renseigne une consultation de la série par celui-ci
                    //Pour pouvoir obtenir les séries les plus consultées
                     if (est_connecte()){
                        $requete= "SELECT * FROM consulter inner join utilisateur on consulter.codeutilisateur=utilisateur.codeutilisateur and dateconsultation='".date("Y-m-d")."' and nomserie='".$nomserie."' and pseudou='".$_SESSION['PseudoU']."'";
                        $resultat=pg_query($linkpdo, $requete);
                        $resultat=pg_fetch_all($resultat);
                        if($resultat==null){
                               //if(count($resultat)==0){
                                    $requete="SELECT codeutilisateur, typeu FROM utilisateur WHERE pseudou='". $_SESSION['PseudoU']."'";
                                    $resultat=pg_query($linkpdo, $requete);
                                    $resultat=pg_fetch_array($resultat);
                                    $date=date("Y-m-d");
                                    $requete="INSERT INTO consulter VALUES ('".$resultat['codeutilisateur']."', '". $nomserie . "','".$date."','".$resultat['typeu']."')";
                                    $resultat=pg_query($linkpdo, $requete);
                                //}
                            }
                        }
                        


                    }
                    }
                else{
                    echo("Série introuvable");
                }
    ?>
    </div>
    <?php
    include 'footer.php';
            ?>
</body>
</html>
