<?php
//Appel des fichiers fonctions
require("connexion.php");
include 'head.php';
include 'header.php';
//Récupération des variables via POST
$nom=$_POST['nom'];
$prenom=$_POST['prenom'];
$date=$_POST['date'];
//Control de l'existance du réalisateur
//Requete sql
$querycontrol="SELECT * FROM realisateur";
//Soumission de la requete
$result=pg_query($linkpdo,$querycontrol);
//Parcours du tableau de résultats
while ($tab=pg_fetch_array($result)) {
    if($tab['nomrealisateur']==$nom && $tab['prenomrealisateur']==$prenom){
        $exit=1;
    }
}
if($exit!=1){
//Requete sql
    $query="INSERT INTO realisateur(nomrealisateur, prenomrealisateur, ddnrealisateur)
        VALUES('$nom','$prenom','$date')";
//Insertion dans la base
    $queryinsert=pg_query($linkpdo,$query);
//Controle de l'insertion
    if ($queryinsert) {
        header("Location: ajoutrealisateur.php");
    } else {
        echo "Location: erreur.php";
    }
}
else{
    echo "Le réalisateur existe déjà";
}
?>
