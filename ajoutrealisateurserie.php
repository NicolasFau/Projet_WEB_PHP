<?php
//import des fonction
require("connexion.php");
//Récupération des variables
$serie=$_POST['listeSerie'];
$realisateur=$_POST['listeRea'];
//Connexion à la base de donnée
$connect=$linkpdo;
//Requete
$query="INSERT INTO realise(nomserie,idrealisateur)
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
