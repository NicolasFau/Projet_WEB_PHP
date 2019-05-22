<?php
//Appel du fichier de fonction
require("connexion.php");
include 'head.php';
include 'header.php';
//Récuperation des variables via post
$nomprix=$_POST['nom'];
$villeprix=$_POST['ville'];
//$date=$_POST['date'];
//Connexion bdd
$querycontrol="SELECT * FROM prixdecerne";
$result=pg_query($linkpdo,$querycontrol);
while ($tab=pg_fetch_array($result)) {
    if($tab['nomprix']==$nomprix && $tab['villeprix']==$villeprix){
        $exit=1;
    }
}
if($exit!=1){
//Requete d'insertion
    $query="INSERT INTO prixdecerne(nomprix, villeprix)
        VALUES('$nomprix','$villeprix')";
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