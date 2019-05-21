<?php
include 'head.php';
include 'header.php';
if (!est_admin()){
    header('Location: accueil.php');
}
 ?>

<!DOCTYPE html>
<html>
<head>
    <title>PHP</title>
    <meta charset="utf-8" />
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="/resources/demos/external/jquery-mousewheel/jquery.mousewheel.js"></script>
  <script>
$( function() {
    var spinner = $( "#listeSerie" ).selectmenu();
	var spinner = $( "#listeSaison" ).selectmenu();
	var spinner = $( "#tentacles" ).spinner();

});
</script>
</head>
<body>
<label for="choix_serie">Nom Série </label>
<form action="formajoutepisode.php" method="post">
    <?php
    if(isset($_GET['nom'])){
        echo "<input list=\"listeSerie\" type=\"text\" name=\"listeSerie\" value=\"".$_GET['nom']."\">";
    }
    else{
        require("connexion.php");
        $queryNomserie="Select * from serie";
        $resulatNomListe=pg_exec($linkpdo, $queryNomserie);
        //datalist dynamique
        //echo '<input  list="listeSerie" type="text" name="listeSerie">';
        echo '<select id="listeSerie">';
        while ($data =pg_fetch_array($resulatNomListe)) {
            // on affiche les résultats
            echo '<option value="'.$data['nomserie'].'">'.$data['nomserie']."</option>";
        }
        echo  '</select>';
    }
    ?>

    <label for="choix_saison">Saison </label>
    <?php
    if(isset($_GET['saison'])){
        echo "<input list=\"listeSaison\" type=\"text\" name=\"listeSaison\" value=\"".$_GET['saison']."\">";
    }
    else{
        require("connexion.php");
        $query="Select * from Serie,Saison WHERE serie.nomserie=saison.nomserie";
        $resulat=pg_exec($linkpdo, $query);
        //datalist dynamique
        //echo '<input  list="listeSaison" type="text" name="listeSaison">';
        echo '<select id="listeSaison">';
        while ($data =pg_fetch_array($resulat)) {
            // on affiche les résultats
            echo '<option value='.$data['numérosaison'].'>'.$data['numérosaison']."</option>";
        }
        echo  '</select>';
    }
    ?>

    <p>Nom Episode <input type="text" name="nom"></p>
    <p>Numéro Episode<input type="number" id="tentacles" name="num" min="1" max="100"></p>
    <p>Durée épisode<input type="text" name="duree"></p>
    <p><a href="ajoutepisode.php"><input type="submit" value="Ajouter"></a></p>
    <p><a href=".dmin.php"><input type="submit" value="Terminer"></a></p>

</form>
