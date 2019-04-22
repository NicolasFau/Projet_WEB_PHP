<?php
//Appel du fichier de fonction
require(connexionbdd.php);
//Récuperation des variables via post
$nom=$_POST('nom');
$ville=$_POST('ville');
$date=$_POST('date');
//Connexion bdd
$connect=connexionbdd('test','test',"123456789");
//Requete d'insertion
$query="INSERT INTO PrixDecerne(nomPrix, villePrix)
        VALUES('$nom','$ville')";
$insert=pg_query($connect,$query);
//Controle d'insertion

    if ($insert) {
        echo "Succès.\n";
    } else {
        echo "Echec\n";
    }

?>
