<?php
//Appel du fichier de fonction
require("connexionbdd.php");
//Récuperation des variables via post
$nom=$_POST['nom'];
$prenom=$_POST['prenom'];
$date=$_POST['date'];
//Connexion bdd
$connect=connexionbdd('test','test',"123456789");
//Requete d'insertion
$query="INSERT INTO Acteur(idacteur,nomacteur,prenomacteur, ddnacteur)
        VALUES('4','$nom','$prenom','$date')";
$insert=pg_query($connect,$query);
//Controle d'insertion

    if ($insert) {
        header("Location: ajoutacteur.php");
    } else {
        echo "Echec\n";
    }

?>
