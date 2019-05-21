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
//Control d'Acteur
$querycontrol="SELECT * FROM Acteur";
$result=pg_query($linkpdo,$querycontrol);
while ($tab=pg_fetch_array($result)) {
    if($tab['nomacteur']==$nom && $tab['prenomacteur']==$prenom){
        $exit=1;
    }
}
echo "exit:".$exit;
if($exit!=1){
//Requete d'insertion
    $query="INSERT INTO Acteur(nomacteur,prenomacteur, ddnacteur)
                  VALUES('$nom','$prenom','$date')";
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