<?php
//import des fonction
require(connexionbdd.php);
//Récupération des variables
$serie=$_POST('listeSerie');
$acteur=$_POST('listeActeur');
//Connexion à la base de donnée
$connect=connexionbdd('test','test','123456789')
//Requete
$query="INSERT INTO Jouer(nomSerie,idActeur)
        VALUES('$serie','$acteur')";
//Réalisation de la requete
$queryupdate=pg_connect($connect,$query);
//Controle sur la requete
if ($insert) {
    echo "Succès.\n";
} else {
    echo "Echec\n";
}


 ?>
