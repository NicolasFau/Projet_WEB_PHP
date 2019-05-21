<?php
//import des fichiers de fonctions

require("connexion.php");
include 'head.php';
include 'header.php';

//Récupération des valeurs des champs
$titre=$_POST['titre'];
$pays=$_POST['pays'];
$genre=$_POST['Genre'];
$synopsis=$_POST['synospsis'];
$querycontrol="SELECT * FROM serie";
$result=pg_query($linkpdo,$querycontrol);
while ($tab=pg_fetch_array($result)) {
  if($tab['nomserie']==$titre){
    $exit=1;
  }
}
if($exit!=1){
//Upload fichiers
  $target_dir="\\image\\";
  $target_file=$target_dir . $_FILES["image"]["name"];
//Test du contenue de la variable acteur
  $query="INSERT INTO serie(nomserie,themeserie,paysorigineserie,urlimageserie)
          VALUES('$titre','$genre','$pays','$target_file')";
//requete d'insertion
  $queryInsertSerie=pg_query($linkpdo,$query);
  if($queryInsertSerie){
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
