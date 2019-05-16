<?php
//Récupération des variables
require("connexion.php");
include 'head.php';
include 'header.php';
$date=$_POST['date'];
$numeroSaison=$_POST['num'];
$listeSerie=$_POST['listeSerie'];


$querycontrol="SELECT * FROM saison WHERE nomserie='$listeSerie'";
$result=pg_query($linkpdo,$querycontrol);

while ($tab=pg_fetch_array($result)) {
        //echo $tab['numérosaison'];
        if($tab['numérosaison']==$numeroSaison){
        $exit=1;
      }

}
if($exit!=1){
//Insertion du numéro de la Saison
$queryinsert="INSERT INTO saison(numérosaison, dateparutionsaison, nomserie) VALUES('$numeroSaison','$date','$listeSerie')";
$queryNomserie=pg_query($linkpdo,$queryinsert);

if ($queryNomserie) {
    $url="Location: ajoutepisode.php?nom=".$listeSerie."&saison=".$numeroSaison;
    header($url);

} else {
    echo "Location: erreur.php";
}

}
else{
    echo "La saison existe déjà";
}

  <?php
        if(isset($_GET['nom'])){
        echo "<input list=\"listeSerie\" type=\"text\" name=\"listeSerie\" value=\"".$_GET['nom']."\">";
}

else{


 ?>
