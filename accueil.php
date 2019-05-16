<?php
    include 'head.php';
    include 'header.php';
    include 'fonctionsDeRecherche.php';
    $titre = 'accueil';
?>
<body>
    <center><img src="image/logo.png" style="width: 30%;" /></center>
    <center><h1>Bienvenue sur le site de critique d'oeuvres</h1></center>
    
    <?php
        echo ' <h2>Recherche rapide par catégorie : </h2>';
        $liste_categorie=listeTheme($linkpdo);
        foreach($liste_categorie as $liste){
            echo '<a href=\'recherche.php?categorie='.$liste['themeserie'].'\'>'.$liste['themeserie'].'</a>';
        }
    
        echo '<h2>Sélection aléatoire de séries </h2>';
        $requete="SELECT nomserie,urlimageserie FROM serie order by RANDOM() limit 10";
        $result=pg_query($linkpdo, $requete);
        $listeserie=pg_fetch_all($result);
    ?>

    <div class="liste" style="width: 800; height: 300; overflow-x: scroll; overflow-y: hidden;">
        <ul style=" width :1500; height: 270; margin: 0; padding: 0;list-style-type: none;">
        <?php
            foreach($listeserie as $serie){
        ?>
            <li style ="float: left; margin: 7px;" > <a href="afficherSerie.php?search=<?php echo $serie['nomserie']; ?>"> <img src="<?php echo $serie['urlimageserie']?>"></a></li>
        <?php
            }
        ?>
        </ul>
    </div>
    
    <?php
        echo '<h2>Séries les plus consultés la semaine dernière</h2>';
        $dateSemaineDerniere = date("Y-m-d",strtotime("-1 week") );
        $requete= "SELECT distinct serie.nomserie, urlimageserie from consulter inner join serie on serie.nomserie=consulter.nomserie and dateconsultation > '".$dateSemaineDerniere."'  limit 10 ";
        $resultat=pg_query($linkpdo, $requete);
        $listeserie=pg_fetch_all($resultat);
    ?>
    <div class="liste" style="width: 800; height: 300; overflow-x: scroll; overflow-y: hidden;">
        <ul style=" width: 1500; height: 270; margin: 0; padding: 0;list-style-type: none;">
        <?php
            foreach($listeserie as $serie){
        ?>
            <li style ="float: left; margin: 7px;" > <a href="afficherSerie.php?search=<?php echo $serie['nomserie']; ?>"> <img src="<?php echo $serie['urlimageserie']?>"></a></li>
        <?php
            }
        ?>
        </ul>
    </div>
    
     <?php
        echo '<h2>Séries les plus critiquées</h2>';
        $requete= "select distinct serie.nomserie , count( serie.nomserie) as nbcritique, serie.urlimageserie from serie inner join saison  on saison.nomserie=serie.nomserie inner join critique on critique.idsaison=saison.idsaison group by serie.nomserie order by nbcritique DESC limit 10";
        $resultat=pg_query($linkpdo, $requete);
        $listeserie=pg_fetch_all($resultat);
    ?>
        <div class="liste" style="width: 800; height: 300; overflow-x: scroll; overflow-y: hidden;">
            <ul style=" width: 1500; height: 270; margin: 0; padding: 0;list-style-type: none;">
            <?php
            foreach($listeserie as $serie){
            ?>
            <li style ="float: left; margin: 7px;" > <a href="afficherSerie.php?search=<?php echo $serie['nomserie']; ?>"> <img src="<?php echo $serie['urlimageserie']?>"></a></li>
            <?php
            }
        ?>
            </ul>
        </div>
</body>