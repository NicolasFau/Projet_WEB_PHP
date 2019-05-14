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
include 'fonctions_critique.php';
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
$idsaison=$row['idsaison'];
$moyenne=pg_query("SELECT AVG(notationcritique) FROM critique WHERE idsaison=".$idsaison);
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
            if($row['pseudou']==$_SESSION['PseudoU']){
                echo 'Vous ne pouvez pas signaler votre critique mais rendez vous sur votre page pour la supprimer';
                echo "<br />";
                echo "<br />";
            }else{
                echo '<a href="./signaler.php?idcritique='.$critique['idcritique'].'"> <input type="button" value="Signaler"/></a>';
                echo "<br />";
                echo "<br />";
            }
        }
    }
}else{

    echo 'Aucun critique n\'est associée à cette saison';
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
    }
    //if(isset($_POST['note']) and isset($_POST['avis']) and $_POST['note']!=null and $_POST['avis']!=null){
    //    effectuer_critique($linkpdo, $_POST['note'], $_POST['avis'], $_SESSION['PseudoU'], $idsaison);
    //    $_POST['note']=null;
    //    $_POST['avis']=null;
    //    echo $_POST['note'];
    //}

    ?>
    <!-- </form> -->

</fieldset>
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