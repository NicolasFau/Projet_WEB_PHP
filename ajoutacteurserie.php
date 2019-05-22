<?php
//import des fonction
require 'connexion.php';
include 'head.php';
include 'header.php';

//Récupération des variables
$serie=$_POST['listeSerie'];
echo $serie;
$acteur=$_POST['test'];
echo $acteur;

//Connexion à la base de donnée
$connect=$linkpdo;
$queryid="SELECT * FROM acteur WHERE nomacteur='$acteur'";

$idresult=pg_query($connect,$queryid);
$idligne=pg_fetch_array($idresult);
$id=$idligne['idacteur'];
//Requete
$query="INSERT INTO jouer(nomserie,idacteur)
        VALUES('$serie','$id')";
//Réalisation de la requete
$insert=pg_query($connect,$query);
//Controle sur la requete
if ($insert) {
    header('Location: ajoutacteur.php?info=Acteur ajouté avec succès.');
} else {
    echo "Echec\n";
}


 ?>
