<?php
//import des fichiers de fonctions
require("connexion.php");
//Récupération des valeurs des champs
$titre=$_POST['titre'];
$pays=$_POST['pays'];
$genre=$_POST['Genre'];
$synopsis=$_POST['synospsis'];

//Upload fichiers
$target_dir=".\\image\\";
$target_file=$target_dir . $_FILES["image"]["name"];
//Connexion Bdd
$connect=$linkpdo;
//Test du contenue de la variable acteur

  $query="INSERT INTO serie(nomserie,themeserie,paysorigineserie,urlimageserie)
          VALUES('$titre','$genre','$pays','$target_file')";

//requete d'insertion
$queryInsertSerie=pg_query($connect,$query);
if($queryInsertSerie){
  header("Location: ajoutsaison.php");
}
else{
  echo "Echec";
}
?>
