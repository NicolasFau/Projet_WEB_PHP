<?php
//import des fonction
require 'connexion.php';
include 'head.php';
include 'header.php';

//Récupération des variables
$serie=$_POST['listeSerie'];
$realisateur=$_POST['listeRea'];
//Connexion à la base de donnée
$connect=$linkpdo;
$queryid="SELECT * FROM realisateur WHERE nomrealisateur='$realisateur'";

$idresult=pg_query($connect,$queryid);
$idligne=pg_fetch_array($idresult);
$id=$idligne['idrealisateur'];
echo $id;
//Requete
$query="INSERT INTO realiser(nomserie,idrealisateur)
        VALUES('$serie','$id')";
//Réalisation de la requete
$queryupdate=pg_query($connect,$query);
//Controle sur la requete
if ($queryupdate) {
    header('Location: ajoutrealisateur.php?info=Realisateur ajouté avec succès.');
} else {
    echo "Echec\n";
}


 ?>
