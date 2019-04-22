<?php
//Appel du fichier de fonction
require(connexionbdd.php);
//Récuperation des variablezs via post
$serie=$_POST['listeSerie'];
$saison=$_POST['listeSaison'];
$nomepisode=$_POST['nom'];
$numeroepisode=$_POST['num'];
$duree=$_POST['duree'];
//Connexion bdd
$connect=connexionbdd(test,test,"123456789");
//Requete d'insertion à affinnée delon correction model
$query="INSERT INTO Episode(idSerie,idSaison,nomEpisode,numeroEpisode,dureeEpisode)
          VALUES('$serie','$saison','$nomEpisode','$numeroepisode','$duree')";
$insert=pg_query($connect,$query);
//Controle d'insertion

if ($insert) {
    echo "Succès.\n";
} else {
    echo "Echec\n";
}

 ?>
