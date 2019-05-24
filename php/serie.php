<?php
    $titre = 'Série';
    include 'head.php';
?>
<body style=" position : absolute;">
    <?php
        include 'header.php';
        include 'fonctionsDeRecherche.php';

        //Requete de récupération de toutes les informations sur une série trié par ordre alphabétique de série
        $requete= "SELECT * FROM serie ORDER BY nomserie";
        $resultat=pg_query($linkpdo, $requete);
        $resultat=pg_fetch_all($resultat);
    ?>
    <div class="page">
        <div>
        <center><ul style=" width: inherite ; height: 205px; margin: 0; padding: 0;  list-style-type: none; ">
            <?php
            foreach($resultat as $serie){ //Affichage pour chaque série 
                $synopsis=$serie['synopsisserie'];
                $synopsis=substr($synopsis, 0 ,  202);//Récupération des premiers caractères du synopsis
                $fin=substr($synopsis, strlen($synopsis)-2);//Récupération des deux derniers caractères du synopsis réduit
                if($fin!=".."){// Si les deux derniers caractères ne sont pas des points alors
                    $synopsis.="..."; //Ajout des points de suspension à la fin du synosis réduit
                }
            ?>
            
            <!--AFFICHAGE DES SERIE ET LEUR SYNOPSIS SOUS FORME DE LISTE -->
            
                <li style ="float: left; margin-left: 30px; margin-right:30px ; margin-top:20px; margin-bottom:5px" >
                    <div><a href="afficherSerie.php?nomserie=<?php echo $serie['nomserie']; ?>"> <img src="<?php echo $serie['urlimageserie']?>" heigth="268" width ="182"></a></div>
                    <div><center><a href="afficherSerie.php?nomserie=<?php echo $serie['nomserie']; ?>"><?php echo $serie['nomserie']; ?></a></center></div>
                    <div style=" width:200px; heigth:100px;">
                        <p style="width: 200px; height:150px; overflow-wrap: break-word; text-align: justify; overflow :hidden; text-overflow: ellipsis ;">
                            <?php 
                                echo $synopsis; 
                            ?>
                        </p>
                    </div>
                </li>

            <?php
            }
            ?>
            </ul></center>
        </div>
    </div>
    <?php
        include 'footer.php';
    ?>
</body>
</html>