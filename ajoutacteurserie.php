<?php
//import des fonction
require("connexion.php");
//Récupération des variables
$serie=$_POST['listeSerie'];
$acteur=$_POST['listeActeur'];
//Connexion à la base de donnée
$connect=$linkpdo;
//Requete
$query="INSERT INTO jouer(nomserie,idacteur)
        VALUES('$serie','$acteur')";
//Réalisation de la requete
$insert=pg_connect($connect,$query);
//Controle sur la requete
if ($insert) {
    header("Location: ajoutacteur.php");
} else {
    echo "Echec\n";
}


 ?>
