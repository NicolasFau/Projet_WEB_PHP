<?php
//Récupération des variables
require("connexion.php");
require("header.php");
$date=$_POST['date'];
$numeroSaison=$_POST['num'];
$listeSerie=$_POST['listeSerie'];

$connect=$linkpdo;

//Insertion du numéro de la Saison
$queryinsert="INSERT INTO Saison(idsaison, numéroSaison, dateparutionsaison,nomSerie) VALUES(2,'$numeroSaison','$date','$listeSerie')";
$queryNomserie=pg_query($connect,$queryinsert);

if ($queryNomserie) {
    header("Location: ajoutepisode.php");
} else {
    echo "Echec";
}


 ?>
