<?php
//Appel du fichier de fonction
require("connexionbdd.php");
//Récuperation des variables via post
$serie=$_POST['listeSerie'];
$saison=$_POST['listeSaison'];
$nomepisode=$_POST['nom'];
$numeroepisode=$_POST['num'];
$duree=$_POST['duree'];
//Connexion bdd
$connect=connexionbdd('test','test',"123456789");
//Requete d'insertion à affinnée selon correction model
$query="INSERT INTO Episode(idepisode,nomepisode,numeroepisode,duréeeepisode, idsaison)
          VALUES('$idepisode','$nomEpisode','$numeroepisode','$duree','$saison')";
$insert=pg_query($connect,$query);
//Controle d'insertion

if ($insert) {
    echo "Succès.\n";
    header("Location: ajouteepisode.php");
} else {
    echo "Echec\n";
}

 ?>
