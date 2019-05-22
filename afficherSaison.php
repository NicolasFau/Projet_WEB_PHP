<?php
$titre='Saison';
require 'connexion.php';
include 'head.php';
include 'fonctionsDeRecherche.php';
include 'fonctions_critique.php';
?>

<body>
<?php
include 'header.php';
    ?>
    <div class="page">
    <?php
    $numsaison=$_GET['numsai'];
$nomSerie=$_GET['nomserie'];
$result = pg_query($linkpdo, "SELECT * FROM Saison WHERE numérosaison = '$numsaison' AND nomserie= '$nomSerie';");
$row = pg_fetch_array($result);
echo "Saison numéro ".$numsaison." de la série ".$row['nomserie']."<br>"."<br>";
echo "<b>Date de parution</b>"."<br>"."<br>";
echo $row['dateparutionsaison']."<br>"."<br>";
echo "<b>Note actuelle de la saison :</b>"."<br>"."<br>";
$idsaison=$row['idsaison'];
$moyenne=pg_query("SELECT AVG(notationcritique) FROM critique WHERE idsaison=".$idsaison);
$moyenne=pg_fetch_result($moyenne,0);
$moyenne=number_format($moyenne,2);
echo $moyenne;
echo '<br />';

?>

<br />
<b>Critiques :</b><br /><hr>
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
            if($row['pseudou']==$_SESSION['PseudoU']){
                echo 'Vous ne pouvez pas signaler votre critique mais rendez vous sur votre page pour la supprimer';
                echo "<br />";
                echo "<br />";
            }else{
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


if(est_connecte()){?>
<fieldset>
    <!--<form action"ajouter_critique">-->
    <h3>Effectuez une critique vous aussi</h3>
    <label>Note :</label>
    <input name="note" id="note" type="number" min="0" max="5" value="" required/>

    <br />
    <label>Avis :</label>
    <textarea name="avis" id="avis" maxlength="255" value="" required ></textarea>
    <button  onclick="ajouter_critique()" >Envoyer</button>


    <?php
    }else{
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