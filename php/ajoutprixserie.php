<?php
//Import des fonction
require 'connexion.php';
include 'head.php';
include 'header.php';
//Récupération des variables
$serie=$_POST['1'];
$prix=$_POST['2'];
//Requete sql
$queryid="SELECT * FROM prixdecerne WHERE nomprix='$prix'";
//Récupération de l'id
$idresult=pg_query($linkpdo,$queryid);
$idligne=pg_fetch_array($idresult);
$id=$idligne['idprix'];
//Requete sql
$query="INSERT INTO decerner(nomserie,idprix) VALUES('$serie','$id');";
//Réalisation de la requete
$queryupdate=pg_query($linkpdo,$query);
//Controle sur la requete
if ($queryupdate) {
    header('Location: ajoutprix.php?info=Prix ajouté avec succès.');
} else {
    echo "Echec\n";
}


 ?>
