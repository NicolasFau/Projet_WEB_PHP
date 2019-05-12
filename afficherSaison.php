<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8" />
            <link rel="stylesheet" href="css/style.css" />
            <!-- Latest compiled and minified CSS -->
        </head>

        <?php
        require 'connexion.php';
        include 'head.php';
        include 'header.php';
        include 'fonctionsDeRecherche.php';
        ?>

        <body>
            <?php
            $numsaison=$_GET['numsai'];
            $nomSerie=$_GET['nomserie'];
            $result = pg_query($linkpdo, "SELECT * FROM Saison WHERE numérosaison = '$numsaison' AND nomserie= '$nomSerie';");
            $row = pg_fetch_array($result);
            echo "Saison numéro ".$numsaison." de la série ".$row['nomserie']."<br>"."<br>";
            echo "<b>Date de parution</b>"."<br>"."<br>";
            echo $row['dateparutionsaison']."<br>"."<br>";
            echo "<b>Note actuelle de la saison :</b>"."<br>"."<br>";
            $moyenne=pg_query("SELECT AVG(notationcritique) FROM critique WHERE idsaison=".$row['idsaison']);
            $moyenne=pg_fetch_result($moyenne,0);
            $moyenne=number_format($moyenne,2);
            echo $moyenne;
            echo '<br />';
            
            ?>
            
            <br />
            <b>Critiques :</b><br />
            <br />

            <?php
            $liste_critiques=rechercher_critiqueSaison($linkpdo, $row['idsaison']);
                if ($liste_critiques != NULL){
                    ?>
                    <?php
                    
                    foreach($liste_critiques as $critique){
                        $result = pg_query($linkpdo, "SELECT Pseudou FROM utilisateur WHERE codeutilisateur='".$critique['codeutilisateurcritiquant']."'");
                        $row = pg_fetch_array($result);
                        echo 'Critique faite le '.$critique['datecritique'] .' par <a href="./compte.php?PseudoU='. $row['pseudou'].'">'.$row['pseudou'].'</a>';
                        echo "<br />";
                        echo "Note : " .$critique['notationcritique'];
                        echo "<br />";
                        echo $critique['aviscritique'];
                        echo "<br />";
                        if (est_connecte()){
                            echo '<a href="./signaler.php?idcritique='.$critique['idcritique'].'"> <input type="button" value="Signaler"/></a>';
                            echo "<br />";
                            echo "<br />";

                        }
                    }
                }else{
              
                        echo 'Aucun critique n\'est associée à cette saison';
                    }
                
            ?>
        </body>
    </html>