<?php
//Appel du fichier de fonctions
require("connexion.php");
include 'head.php';
include 'header.php';
//Récuperation des variables via post
$nomprix=$_POST['nom'];
$villeprix=$_POST['ville'];

//Control de l'existance du prix dans la base
$querycontrol="SELECT * FROM prixdecerne";
//Soumission de requete
$result=pg_query($linkpdo,$querycontrol);
//Parcours du tableau
while ($tab=pg_fetch_array($result)) {
    if($tab['nomprix']==$nomprix && $tab['villeprix']==$villeprix){
        $exit=1;
    }
}
if($exit!=1){
    //Requete sql
    $query="INSERT INTO prixdecerne(nomprix, villeprix) VALUES('$nomprix','$villeprix')";
    //Soumission de requete
    $insert=pg_query($linkpdo,$query);
    //Controle d'insertion
    if ($insert) {
        header("Location: ajoutprix.php");
    } else {
        echo "Location: erreur.php";
    }
}
else{
    echo "Le prix existe déjà";
}
?>
