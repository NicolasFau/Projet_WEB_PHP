<?php
//Appel du fichier de fonction
require("connexion.php");
//Récuperation des variables via post
$serie=$_POST['listeSerie'];
$saison=$_POST['listeSaison'];
$nomepisode=$_POST['nom'];
$numeroepisode=$_POST['num'];
$duree=$_POST['duree'];
//Connexion bdd
$connect=$linkpdo;
//Requete d'insertion à affinnée selon correction model
$query="INSERT INTO episode(nomepisode,numeroepisode,duréeeepisode, idsaison)
          VALUES('$nomEpisode','$numeroepisode','$duree','$saison')";
$insert=pg_query($connect,$query);
//Controle d'insertion

if ($insert) {
    echo "Succès.\n";
    header("Location: ajouteepisode.php");
} else {
    echo "Echec\n";
}

 ?>
