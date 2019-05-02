<?php
//Appel du fichier de fonction
require("connexion.php");
require("header.php");
//Récuperation des variables via post
$nom=$_POST['nom'];
$ville=$_POST['ville'];
$date=$_POST['date'];
//Connexion bdd
$connect=$linkpdo;
//Requete d'insertion
$query="INSERT INTO prixdecerne(nomprix, villeprix)
        VALUES('$nom','$ville')";
$insert=pg_query($connect,$query);
//Controle d'insertion

    if ($insert) {
        header("Location: ajoutprix.php");
    } else {
        echo "Echec\n";
    }

?>
