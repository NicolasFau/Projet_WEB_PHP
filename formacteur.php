<?php
//Appel du fichier de fonction
require("connexion.php");
//Récuperation des variables via post
$nom=$_POST['nom'];
$prenom=$_POST['prenom'];
$date=$_POST['date'];
//Connexion bdd
$connect=$linkpdo;
//Requete d'insertion
$query="INSERT INTO Acteur(nomacteur,prenomacteur, ddnacteur)
        VALUES($nom','$prenom','$date')";
$insert=pg_query($connect,$query);
//Controle d'insertion

    if ($insert) {
        header("Location: ajoutacteur.php");
    } else {
        echo "Echec\n";
    }

?>
