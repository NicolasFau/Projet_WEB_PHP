<?php
$nom=$_POST['nom'];
$prenom=$_POST['prenom'];
$date=$_POST['date'];
//Connexion bdd
$connect=connexionbdd('test','test','123456789');
//Requete
$query="INSERT INTO realisateur(nomrealisateur, prenomrealisateur, ddnrealisateur)
        VALUES('$nom',''$prenom','$date')";
//Insertion dans la base
$queryinsert=pg_query($connect,$query);
//Controle de l'insertion

if ($queryinsert) {
    echo "Succès";
} else {
    echo "Echec";
}

 ?>