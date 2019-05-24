<?php
    $titre = 'Resultat recherche';
    include 'head.php';
?>
<body>
    <?php
        include 'header.php';
    
        if(isset($_GET['nomserie']) and $_GET['nomserie']!=null){ //Si la variable nomserie est définie
            $nomserie=pg_escape_string($_GET['nomserie']);//echappement des caractères spéciaux
        }else{
            $nomserie="%";//Sinon nomserie prends la valeur du caractère joker
        }
        if(isset($_GET['categorie']) and $_GET['categorie']!=null){//Si la variable categorie est définie
            $categorie=pg_escape_string($_GET['categorie']);//echappement des caractères spéciaux
        }else{
            $categorie="%";//Sinon categorie prends la valeur du caractère joker
        }
        if(isset($_GET['nbsaison']) and $_GET['nbsaison']!=null){//Si la variable nbsaison est définie
            $nbsaison=$_GET['nbsaison'];
        }else{
            $nbsaison=0;//Sinon nbsaison minimum prends la valeur 0
        }

        //Requete sql insensible à la casse prenant trois paramètres de recherche : nomserie, categorie et nombre de saison minmum
        $requete="select  serie.nomserie, serie.urlimageserie from serie inner join saison on saison.nomserie=serie.nomserie and (lower(serie.nomserie) like lower('%$nomserie%') or lower(serie.nomserie) like lower('%$nomserie') or lower(serie.nomserie) like '$nomserie' or lower(serie.nomserie) like lower('$nomserie')) and serie.themeserie like '$categorie' group by serie.nomserie having count(serie.nomserie)>=$nbsaison";
        $resultat=pg_query($linkpdo, $requete);
        $resultat=pg_fetch_all($resultat);
    ?>
    <div class="page">
        <div style="display:block">
            <center><ul style=" width: inherite ; height: 200; margin: 0; padding: 0;  list-style-type: none; ">
                <?php
                    if($resultat!=null){//Si un résultat est trouvé
                        
                        //AFFICHAGE DES RESULTATS SOUS FORME DE MOSAIQUE
                        foreach($resultat as $serie){//Pour chaque série trouvé on affiche les informations

                    ?>
                        <li style ="float: left; margin-left: 30px; margin-right:30px ; margin-top:20px; margin-bottom:5px" >
                        <div><a href="afficherSerie.php?nomserie=<?php echo $serie['nomserie']; ?>"> <img src="<?php echo $serie['urlimageserie']; ?>" heigth="268" width ="182"></a></div>
                        <div><center><a href="afficherSerie.php?nomserie=<?php echo $serie['nomserie']; ?>"><?php echo $serie['nomserie']; ?></a></center></div>
                        </li>
                    <?php
                    }
                    ?>
                    </ul></center>
                        <?php 
                        }else{// Si aucun résultat n'est trouvé
                            echo '<p> Aucune série ne correspond à la recherche <br></p>';
                            echo '<a href="./rechercheavancee.php">Effectuer une nouvelle recherche</a>';
                        }
                    ?>

        </div>
    </div>
    <?php
        include 'footer.php';
    ?>
</body>
</html>