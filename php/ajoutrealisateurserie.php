<?php
//import des fonction
require 'connexion.php';
include 'head.php';
include 'header.php';

//Récupération des variables
$serie=$_POST['1'];
$realisateur=$_POST['2'];
//Connexion à la base de donnée

$queryid="SELECT * FROM realisateur WHERE nomrealisateur='$realisateur'";
//Récupération de l'id
$idresult=pg_query($linkpdo,$queryid);
$idligne=pg_fetch_array($idresult);
$id=$idligne['idrealisateur'];

//Requete
$query="INSERT INTO realiser(nomserie,idrealisateur)
        VALUES('$serie','$id')";
//Réalisation de la requete
$queryupdate=pg_query($linkpdo,$query);
//Controle sur la requete
if ($queryupdate) {
    header('Location: ajoutrealisateur.php?info=Realisateur ajouté avec succès.');
} else {
    echo "Echec\n";
}


 ?>
