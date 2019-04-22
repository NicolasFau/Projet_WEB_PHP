<?php
//import des fichiers de fonctions
require(connexionbdd.php);
//Récupération des valeurs des champs
$titre=$_POST['titre'];
$pays=$_POST['pays'];
$genre=$_POST['Genre'];
$synopsis=$_POST['synospsis'];
$realisateur=$_POST['realisateur'];
$acteurs=$_POST['acteurs'];
$ville=$_POST['ville'];
//Upload fichiers
$target_dir="images/";
$target_file=$target_dir . basename($_FILES["image"]["name"]);
echo $target_file;
//Connexion Bdd
$connect=connexionbdd(test,test,'123456789');
//Test du contenue de la variable acteur
if(empty($acteurs)){
  $query="INSERT INTO Serie()";
}
else {
  $query;
}
//requete d'insertion
$queryInsertSerie=pg_query($connect,$query);

?>
