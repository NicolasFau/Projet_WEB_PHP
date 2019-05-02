<?php
//Récupération des variables
require("connexion.php");
$date=$_POST['date'];
$numeroSaison=$_POST['num'];
$listeSerie=$_POST['listeSerie'];
/*Debug
echo $nomSerie;
echo $numeroSaison;
echo $listeSerie;
//Connection à la base de donnée
echo $date;*/


$connect=$linkpdo;

//Insertion du numéro de la Saison
$queryinsert="INSERT INTO Saison(numeroSaison, dateParution) VALUES($numeroSaison','$date')";
$queryNomserie=pg_query($connect,$queryinsert);

if ($queryNomserie) {
    echo "Succès";
    header("Location: ajoutepisode.php");
} else {
    echo "Echec";
}


 ?>
