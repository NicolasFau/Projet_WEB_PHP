<?php
//import des fonction
require("connexionbdd.php");
//Récupération des variables
$serie=$_POST['listeSerie'];
$realisateur=$_POST['listeRea'];
//Connexion à la base de donnée
$connect=connexionbdd('test','test','123456789')
//Requete
$query="INSERT INTO realise(nomSerie,idRealisateur)
        VALUES('$serie','$realisateur')";
//Réalisation de la requete
$queryupdate=pg_connect($connect,$query);
//Controle sur la requete
if ($insert) {
    echo "Succès.\n";
} else {
    echo "Echec\n";
}


 ?>
