<?php
//Import des fichiers de fonctions
require("connexion.php");
include 'head.php';
include 'header.php';
//Récupération des valeurs des champs via POST
$titre=$_POST['titre'];
$pays=$_POST['pays'];
$genre=$_POST['Genre'];
$synopsis=$_POST['synospsis'];
//Control de l'existance de la serie
$querycontrol="SELECT * FROM serie";
//Soumission de la requete
$result=pg_query($linkpdo,$querycontrol);
//Parcour du tableu
while ($tab=pg_fetch_array($result)) {
  if($tab['nomserie']==$titre){
    $exit=1;
  }
}
if($exit!=1){
//Upload du fichier
  $target_dir="\\image\\";
  $target_file=$target_dir . $_FILES["image"]["name"];
//Requete sql
  $query="INSERT INTO serie(nomserie,themeserie,paysorigineserie,urlimageserie)
          VALUES('$titre','$genre','$pays','$target_file')";
//Soumission de la requete
  $queryInsertSerie=pg_query($linkpdo,$query);
  //Control sur la requete
  if($queryInsertSerie){
    //Passage du nom de la serie dans la page suivante
    $url="Location: ajoutsaison.php?nom=".$titre;
    header($url);
  }
  else{
    echo "Location: erreur.php";
  }
}
else{
  echo "La série existe déjà";
}
?>
