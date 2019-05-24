<?php
//Appel du fichier de fonction
require("connexion.php");
include 'head.php';
include 'header.php';
//Récuperation des variables via post
$nom=$_POST['nom'];
$prenom=$_POST['prenom'];
$date=$_POST['date'];
$exit=0;
//Control de l'existance de l'acteur dans la base
//Requete sql
$querycontrol="SELECT * FROM Acteur";
//Soumission de la requete
$result=pg_query($linkpdo,$querycontrol);
//Parcours du tableau
while ($tab=pg_fetch_array($result)) {
    if($tab['nomacteur']==$nom && $tab['prenomacteur']==$prenom){
        $exit=1;
    }
}

if($exit!=1){
//Requete d'insertion
    $query="INSERT INTO Acteur(nomacteur,prenomacteur, ddnacteur)
                  VALUES('$nom','$prenom','$date')";
    //Soumission de la requete
    $insert=pg_query($linkpdo,$query);
    //Controle d'insertion
    if ($insert) {
        header("Location: ajoutacteur.php");
    } else {
        header("Location: erreur.php");
    }
}
else{
    echo "L'acteur existe deja";
}
?>
