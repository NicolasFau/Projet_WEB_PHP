<?php
//import des fichiers de fonctions
require(connexionbdd.php);
//Récupération des valeurs des champs
$titre=$_POST['titre'];
$pays=$_POST['pays'];
$genre=$_POST['Genre'];
$synopsis=$_POST['synospsis'];

//Upload fichiers
$target_dir="images/";
$target_file=$target_dir . basename($_FILES["image"]["name"]);
echo $target_file;
//Connexion Bdd
$connect=connexionbdd(test,test,'123456789');
//Test du contenue de la variable acteur

  $query="INSERT INTO Serie(nomSerie,themeSerie,paysOrigine,synopsis,urlImageSerie)
          VALUES('$titre','$genre','$pays','$synopsis','$target_file')";

//requete d'insertion
$queryInsertSerie=pg_query($connect,$query);
if($queryInsertSerie){
  echo "Succès";
}
else{
  echo "Echec";
}
?>
