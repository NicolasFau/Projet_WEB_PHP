<?php
require("connexion.php");
$nom=$_POST['nom'];
$prenom=$_POST['prenom'];
$date=$_POST['date'];
//Connexion bdd
$connect=$linkpdo;
//Requete
$query="INSERT INTO realisateur(nomrealisateur, prenomrealisateur, ddnrealisateur)
        VALUES('$nom',''$prenom','$date')";
//Insertion dans la base
$queryinsert=pg_query($connect,$query);
//Controle de l'insertion

if ($queryinsert) {
  header("Location: ajoutrealisateur.php");
} else {
    echo "Echec";
}

 ?>
