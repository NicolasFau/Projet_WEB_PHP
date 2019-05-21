<?php

require("connexion.php");
include 'head.php';
include 'header.php';

$nom=$_POST['nom'];
$prenom=$_POST['prenom'];
$date=$_POST['date'];
$querycontrol="SELECT * FROM realisateur";
$result=pg_query($linkpdo,$querycontrol);
while ($tab=pg_fetch_array($result)) {
    if($tab['nomrealisateur']==$nom && $tab['prenomrealisateur']==$prenom){
        $exit=1;
    }
}
if($exit!=1){
//Requete
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