<?php
//import des fonction
require("connexion.php");
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
$queryupdate=pg_connect($connect,$query);
//Controle sur la requete
if ($insert) {
    echo "Succès.\n";
} else {
    echo "Echec\n";
}


 ?>
