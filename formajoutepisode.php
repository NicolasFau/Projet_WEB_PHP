<?php
//Appel du fichier de fonction
require("connexion.php");
include 'head.php';
include 'header.php';
//Récuperation des variables via post
$serie=$_POST['listeSerie'];
$saison=$_POST['listeSaison'];
$nomepisode=$_POST['nom'];
$numeroepisode=$_POST['num'];
$duree=$_POST['duree'];

$querysaison="SELECT * FROM saison WHERE  numérosaison='$saison'";
$resultid=pg_query($linkpdo,$querysaison);
$tabid=pg_fetch_array($resultid);
$idsaison=$tabid['idsaison'];

//Controle
$querycontrol="SELECT * FROM episode WHERE idsaison='$idsaison'";
$result=pg_query($linkpdo,$querycontrol);

while ($tab=pg_fetch_array($result)) {
       
        if($tab['numeroepisode']==$numeroepisode){
        $exit=1;
      }

}
if($exit!=1){
//Requete d'insertion à affinnée selon correction model

$query="INSERT INTO episode(nomepisode,numeroepisode,duréeepisode, idsaison)
          VALUES('$nomepisode','$numeroepisode','$duree','$idsaison')";
$insert=pg_query($linkpdo,$query);
//Controle d'insertion

if ($insert) {
    echo "Succès.\n";
    header("Location: ajoutepisode.php");
} else {
    echo header("Location: erreur.php");
}
}
else{
	echo "L episode existe deja";
}
 ?>
