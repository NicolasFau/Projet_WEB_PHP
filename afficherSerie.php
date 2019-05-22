<?php
$titre=$_GET['nomserie'];
require 'connexion.php';
include 'head.php';
?>


<body>

<?php
    include 'header.php';
?>
<div class="page">
<?php
            $nomserie=pg_escape_string($_GET['nomserie']);
            $result = pg_query($linkpdo, "SELECT * FROM Serie WHERE NomSerie = '$nomserie';");
            $row = pg_fetch_array($result);
            $test=count($row);
                if($test != 1) {
                    ?>
        <center><h1><?php echo $nomserie?></h1></center>
                    <table>
                        <tr>
                            <td><?php
                    $urlimage = $row['urlimageserie'];
                    echo "<img src=" . $urlimage . " alt='' height= 268 width=182>" . "<br>" . "<br>";
                    
                       ?>
                            </td>
                            <td><?php
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
                    <div style="margin: 15px;">
                        <?php
                    echo "<b>Saisons existantes :</b>" . "<br>";
                    $result2 = pg_query($linkpdo, "SELECT numérosaison FROM Saison WHERE nomSerie = '$nomserie' order by numérosaison;");
                    $row2 = pg_fetch_all($result2);
                    if($row2!=null){
                    $count = count($row2);
                        for ($i = 0; $i < $count; $i++) {
                            $s = $row2[$i]['numérosaison'];
                            echo "<a href='afficherSaison.php?numsai=$s&nomserie=$nomserie'>Saison $s</a>" . "<br>";
                             }?>
			<?php
		    $queryrea="SELECT nomrealisateur, prenomrealisateur FROM realisateur, realiser WHERE realisateur.idrealisateur=realiser.idrealisateur AND nomserie='$nomserie'"; 		    
		    $resultrea=pg_query($linkpdo,$queryrea);
		    
			echo "Réalisateur:"."</br>";
			while($data=pg_fetch_array($resultrea)){
				echo $data['nomrealisateur']." ";
				echo $data['prenomrealisateur'];
				echo "</br>";
			}
			 $queryacteur="SELECT nomacteur, prenomacteur FROM acteur, jouer WHERE acteur.idacteur=jouer.idacteur AND nomserie='$nomserie'";
                    $resultacteur=pg_query($linkpdo,$queryacteur);

                        echo "Acteur:"."</br>";
                        while($data=pg_fetch_array($resultacteur)){
                                echo $data['nomacteur']." ";
                                echo $data['prenomacteur'];
                                echo "</br>";
                        }

			 $queryprix="SELECT nomprix, villeprix FROM prixdecerne, decerner WHERE prixdecerne.idprix=decerner.idprix AND nomserie='$nomserie'";
                    $resultprix=pg_query($linkpdo,$queryprix);

                        echo "Prix:"."</br>";
                        while($data=pg_fetch_array($resultrea)){
                                echo $data['nomprix']."</br>";
                                echo $data['villeprix']."</br>";
                                echo "</br>";
                        }
			?>
                    </div>
                    <?php
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
