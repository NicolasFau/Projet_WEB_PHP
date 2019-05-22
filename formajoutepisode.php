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



$queryid="SELECT * FROM saison WHERE nomserie = '$serie'";
$resultid=pg_query($linkpdo,$queryid);
$tab=pg_fetch_array($resultid);
$id=$tab['idsaison'];
echo $id;

//Requete d'insertion à affinnée selon correction model
$query="INSERT INTO episode(nomepisode,numeroepisode,duréeepisode, idsaison)
          VALUES('$nomepisode','$numeroepisode','$duree','$id')";
$insert=pg_query($linkpdo,$query);
//Controle d'insertion

if ($insert) {
    echo "Succès.\n";
    header("Location: ajoutepisode.php");
} else {
    echo "Echec\n";
}

 ?>