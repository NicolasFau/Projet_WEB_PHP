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

//Récupération de l'id
//Requete sql
$queryid="SELECT * FROM saison WHERE nomserie = '$serie'";
//Soumission de la requete
$resultid=pg_query($linkpdo,$queryid);
//Passage du résultat dans un tableau
$tab=pg_fetch_array($resultid);
$id=$tab['idsaison'];


//Requete d'insertion
$query="INSERT INTO episode(nomepisode,numeroepisode,duréeepisode, idsaison)
          VALUES('$nomepisode','$numeroepisode','$duree','$id')";
//Soumission de la requete
$insert=pg_query($linkpdo,$query);
//Controle d'insertion

if ($insert) {
    echo "Succès.\n";
    header("Location: ajoutepisode.php");
} else {
    echo "Echec\n";
}

 ?>
