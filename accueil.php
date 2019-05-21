<?php
    $titre = 'accueil';
    include 'head.php';
    include 'header.php';
    include 'fonctionsDeRecherche.php';
?>

<body>
    <div class="contenu">
        <div class="leftcolumn">
            <div class="card">
            <?php
                echo ' <h3>Catégories : </h3><hr>';
                $liste_categorie=listeTheme($linkpdo);
                foreach($liste_categorie as $liste){
                    echo '<a href=\'resultatRecherche.php?categorie='.$liste['themeserie'].'\'>'.$liste['themeserie'].'</a> <br>';
                }
            ?>
        </div>
        </div>

        <div class="centercolumn">
            <div class="card">
            <center><img src="image/logo.png" style="width: 30%;" /></center>
            <center><h1>Bienvenue sur le site de critique d'oeuvres</h1></center>
            <?php
                echo '<h2>Sélection aléatoire de séries </h><hr>';
                $requete="SELECT nomserie,urlimageserie FROM serie order by RANDOM() limit 10";
                $result=pg_query($linkpdo, $requete);
                $listeserie=pg_fetch_all($result);
            ?>

            <div class="liste">
            <ul class="ul_liste">
            <?php
                foreach($listeserie as $serie){
            ?>
                    <li style ="float: left; margin: 7px;" > <a href="afficherSerie.php?nomserie=<?php echo $serie['nomserie']; ?>"> <img src="<?php echo $serie['urlimageserie']?>"></a></li>
            <?php
                }
            ?>
            </ul>
            </div>

            <?php
                echo '<h2>Séries les plus consultés la semaine dernière</h2><hr>';
                $dateSemaineDerniere = date("Y-m-d",strtotime("-1 week") );
                $requete= "SELECT distinct serie.nomserie, urlimageserie from consulter inner join serie on serie.nomserie=consulter.nomserie and dateconsultation > '".$dateSemaineDerniere."'  limit 10 ";
                $resultat=pg_query($linkpdo, $requete);
                $listeserie=pg_fetch_all($resultat);
            ?>
            <div class="liste">
            <ul class="ul_liste">
            <?php
                foreach($listeserie as $serie){
            ?>
                    <li style ="float: left; margin: 7px;" > <a href="afficherSerie.php?nomserie=<?php echo $serie['nomserie']; ?>"> <img src="<?php echo $serie['urlimageserie']?>"></a></li>
            <?php
                }
            ?>
            </ul>
            </div>

            <?php
                echo '<h2>Séries les plus critiquées</h2><hr>';
                $requete= "select distinct serie.nomserie , count( serie.nomserie) as nbcritique, serie.urlimageserie from serie inner join saison  on saison.nomserie=serie.nomserie inner join critique on critique.idsaison=saison.idsaison group by serie.nomserie order by nbcritique DESC limit 10";
                $resultat=pg_query($linkpdo, $requete);
                $listeserie=pg_fetch_all($resultat);
            ?>
            <div class="liste">
            <ul class="ul_liste">
            <?php
                if ($listeserie!=null){
                    foreach($listeserie as $serie){
            ?>
                        <li style ="float: left; margin: 7px;" > <a href="afficherSerie.php?nomserie=<?php echo $serie['nomserie']; ?>"> <img src="<?php echo $serie['urlimageserie']?>"></a></li>
            <?php
                    }
                }else{
                    echo "Aucune critique n'a été effectuée";
                }
            ?>
            </ul>
            </div>
        </div>
    </div>
    
    <div class="rightcolumn">
        
        <div class="card">
                <h2>Critiques récentes :</h2>
                <?php
                    $liste_critiques=rechercher_critiqueRecente($linkpdo);
                    if($liste_critiques!=null){
                        foreach($liste_critiques as $critique){
                            echo '<p><hr>';
                            $result = pg_query($linkpdo, "SELECT Pseudou FROM utilisateur WHERE codeutilisateur='".$critique['codeutilisateurcritiquant']."'");
                            $row = pg_fetch_array($result);
                            $result2 = pg_query($linkpdo, "SELECT nomserie, numérosaison from saison WHERE idsaison=".$critique['idsaison']);
                            $row2=pg_fetch_array($result2);
                            echo '<a href="./compte.php?PseudoU='. $row['pseudou'].'">'.$row['pseudou'].'</a> <br>le '.$critique['datecritique'] .' <br> Saison '.$row2['numérosaison'].' de <a href="./afficherserie.php?nomserie='. $row2['nomserie'].'">'.$row2['nomserie'].'</a>';
                            echo "<br />";
                            echo "Note : " .$critique['notationcritique'];
                            echo "<br />";
                            echo $critique['aviscritique'];
                            echo "<br /><hr></p>";
                        }
                    }else{
                        echo '<p>La base de données est vide...</p>';
                    }
                ?>
            </div>
        
        </div>
</div>
<div>
    <?php
        include 'footer.php';
    ?>  
</div>

 </body>
</html>