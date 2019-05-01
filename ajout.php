<?php
//Récupération des variables
$date=$_POST['date'];
$numeroSaison=$_POST['num'];
$listeSerie=$_POST['listeSerie'];
/*Debug
echo $nomSerie;
echo $numeroSaison;
echo $listeSerie;
//Connection à la base de donnée
echo $date;*/

$n="test";
$u="test";
$p="123456789";
$connect=pg_connect("host=localhost port=5432 dbname=$n user=$u password=$p");

//Insertion du numéro de la Saison
$queryinsert="INSERT INTO Saison(idsaison, numéroSaison, dateparutionsaison,nomSerie) VALUES(2,'$numeroSaison','$date','$listeSerie')";
$queryNomserie=pg_query($connect,$queryinsert);

if ($queryNomserie) {
    header("Location: ajoutepisode.php");
} else {
    echo "Echec";
}


 ?>
