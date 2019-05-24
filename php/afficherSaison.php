<?php
$titre='Saison';
require 'connexion.php';//Connexion avec la base de données PostGreSQL
include 'head.php';//Inclusion du CSS et Metacharset UTF-8
include 'fonctionsDeRecherche.php';//Fonctions de recherche dans la BD
include 'fonctions_critique.php';//Fonction pour effectuer une critique
?>

<body>

    <?php
        include 'header.php';//Inclusion du header avec le menu
        ?>
        <div class="page">
        <?php
        //On récupère le numéro de saison renseigné dans la variable GET depuis afficherSerie
        $numsaison=$_GET['numsai'];
        //On récupère le nom de la série renseigné dans la variable GET depuis afficherSerie
        $nomSerie=$_GET['nomserie'];
        //On affiche de nouveau l'image de la série concernée en allant chercher l'URL dans la base de données
        $resulturl = pg_query($linkpdo, "SELECT * FROM Serie WHERE nomserie = '$nomSerie';");
        $rowurl = pg_fetch_array($resulturl);
            
        $urlimage=$rowurl['urlimageserie'];
    ?>
    <center><h1><?php echo $nomSerie?></h1></center>
        <table>
            <tr>
                <td>
                <!--En légende de l'image on renseigne le numéro de saison-->
                <figure>
                    <img src="<?php echo $urlimage?>" alt='' height= 268 width=182>
                    <figcaption><?php echo "Saison ".$numsaison?></figcaption>
                </figure>
                </td>
                <td>
                <?php
                //On sélectionne dans la BD toutes les informations relatives à la saison donnée
                $result = pg_query($linkpdo, "SELECT * FROM Saison WHERE numérosaison = '$numsaison' AND nomserie= '$nomSerie';");
                $row = pg_fetch_array($result);
                //On affiche de nouveau le synonpsis de la série
                echo "<b>Synopsis de la série</b>"."<br>";
                $result2 = pg_query($linkpdo, "SELECT synopsisserie FROM Serie WHERE nomSerie = '$nomSerie';");
                $row2 = pg_fetch_array($result2);
                $synopsisSerie=$row2['synopsisserie'];
                echo $synopsisSerie."<br>"."<br>";
                //On affiche la date de parution de la saison
                echo "<b>Date de parution de la saison</b>"."<br>";
                echo $row['dateparutionsaison']."<br>"."<br>";
                //On affiche la note moyenne attribuée à la saison en effectuant une moyenne des notes de toutes les critiques effectuées
                echo "<b>Note actuelle de la saison</b>"."<br>";
                $idsaison=$row['idsaison'];
                $moyenne=pg_query("SELECT AVG(notationcritique) FROM critique WHERE idsaison=".$idsaison);
                $moyenne=pg_fetch_result($moyenne,0);
                $moyenne=number_format($moyenne,2);
                echo $moyenne;
                echo '<br /> <br />';
                ?>
                </td>
            </tr>
         </table>

    <br />
    <?php
        //On affiche tous les épisodes relatifs à la saison donnée
        echo "<b>Episodes:</b>";
        echo '<div style="height:100px; width : 50%; background-color:#f8f8f8;overflow-y: scroll;"';

        $idsaison=$row['idsaison'];
        //En fonction de l'ID de la saison on effectue une requete SELECT dans la BD sur la table épisode
        $queryepisode="SELECT * FROM episode WHERE idsaison='$idsaison'";
        $resultepisode=pg_query($linkpdo,$queryepisode);
        echo "</br>";
        //Affichage de tous les épisodes avec les données correspondantes
        while($data=pg_fetch_array($resultepisode)){
            echo $data['numeroepisode']." ";
            echo "        ";
            echo $data['nomepisode']." ";
            echo "        ";
            echo "Durée: ".$data['duréeepisode'];
            echo "</br>";
        }
        echo "</div></br>";
    ?>
    <!--Affichage des critiques sur la saison-->
    <b>Critiques :</b><br /><hr>
    <br />

    <?php
        //Affichage des critiques déjà effectuées sur la saison
        $liste_critiques=rechercher_critiqueSaison($linkpdo, $row['idsaison']);
        if ($liste_critiques != NULL){
    
            //Pour chaque critique déjà effectuée
            foreach($liste_critiques as $critique){
                $result = pg_query($linkpdo, "SELECT Pseudou FROM utilisateur WHERE codeutilisateur='".$critique['codeutilisateurcritiquant']."'");
                $row = pg_fetch_array($result);
                //On affiche le nom de l'utilisateur critiquant avec la possibilité d'aller consulter son profl
                echo 'Critique faite le '.$critique['datecritique'] .' par <a href="./compte.php?PseudoU='. $row['pseudou'].'">'.$row['pseudou'].'</a>';
                echo "<br />";
                //Affichage de la notation 
                echo "Note : " .$critique['notationcritique'];
                echo "<br />";
                //Affichage de l'avis
                echo $critique['aviscritique'];
                echo "<br />";
                //Si l'utilisateur est connecté
                if (est_connecte()){
                    //Si la critique affichée est celle de l'utilisateur connecté alors on l'invite à aller sur sa page si il souhaite la supprimer
                    if($row['pseudou']==$_SESSION['PseudoU']){
                        echo '<br><i>Vous ne pouvez pas signaler votre critique mais rendez vous sur votre page pour la supprimer</i>';
                        echo "<br />";
                        echo "<br />";
                    }else{
                        //Sinon on lui propose la possibilité de signaler la critique (ouverture d'une autre page qui permet de renseigner le motif du signalement)
                        echo '<a href="./signaler.php?idcritique='.$critique['idcritique'].'"> <input type="submit" style="float : right;"value="Signaler"/></a>';
                        echo "<br />";
                        echo "<br />";
                    }
                }
            echo '<hr>';
            }
        }else{
            echo 'Aucun critique n\'est associée à cette saison';
            echo '<br><hr><br>';
        }
        //Si l'utilisateur est connecté 
    if(est_connecte()){
    ?>
        <fieldset>
            <!--Il a la possibilité d'ffectuer une critique en renseignant une note de 1 à 5 ainsi qu'un avis-->
            <h3>Effectuez une critique vous aussi</h3>
            <label>Note :</label>
            <select id="note">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>



                <br />
            <label>Avis :</label>
            <textarea name="avis" id="avis" maxlength="255" value="" required ></textarea>
            <!--Appel du script ajouter_critique en ajax pour pouvoir renseigner les informations-->
            <button  onclick="ajouter_critique()" >Envoyer</button>


            <?php
                }else{
                //On invite l'utilisateur à se connecter pour pouvoir bénéficier de l'espace critique
                echo '<a href="identification.php">Connectez-vous</a> si vous souhaitez faire une critique sur cette saison';
                }
            ?>

        </fieldset>
    </div>
    <?php
        include 'footer.php';
    ?>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>

    <script>
        //Fonction qui appelle la fonction ajouter_critique() de fonctions_critiques.php pour ajouter la critique à la base de données
        function ajouter_critique(){
            var note = document.getElementById('note').value;
            var avis = document.getElementById('avis').value;
            var pseudoU='<?php echo $_SESSION['PseudoU']; ?>';
            var idsaison=<?php echo $idsaison; ?>;
            if((note!="") && (avis!="")){
                $.ajax({
                    type : "POST",
                    url: "fonctions_critique.php",
                    data:{
                        fonction:'effectuer_critique',
                        params: {note, avis,pseudoU, idsaison},
                    },
                    success: function(data)
                    {
                        document.location.reload();
                    }
                });
            }
        }
    </script>
    </body>
</html>
