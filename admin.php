<?php

include 'head.php';
include 'header.php';
include 'fonctionsDeRecherche.php';

if (!est_admin()){
    header('Location: accueil.php');
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>PHP</title>
    <meta charset="utf-8" />
</head>
<body>
<h3>Critiques Signalées</h3>
<?php
require("connexion.php");

$liste_critiques=rechercher_critiqueSignalees($linkpdo);
if ($liste_critiques != NULL) {
    echo "<form action=\"suppressionCritique.php\" method=\"post\">";
    foreach ($liste_critiques as $critique) {
        echo "Code utilisateur : " . $critique['codeutilisateurcritiquant'] . "<br>";
        echo "Avis critique : " . $critique['aviscritique'] . "<input type=\"checkbox\" name=\"suppr[]\" value=\"" . $critique['idcritique'] . "\">";
        $querymotif = "Select motifsignalement from signalement where idcritique=" . $critique['idcritique'];
        $result = pg_query($linkpdo, $querymotif);
        $resulttab = pg_fetch_array($result);
        echo "</br>Motif:</br>";
        echo $resulttab['motifsignalement'];

        echo "<div><input type=\"radio\" id=\"dewey\" name=\"choix\" value=\"Laisser\"><label for=\"dewey\">Ignorer</label></div>";
        echo "<div><input type=\"radio\" id=\"dewey\" name=\"choix\" value=\"Supprimer\"><label for=\"dewey\">Supprimer</label></div>";
        echo "<p><input type=\"submit\" value=\"Valider\"></p>";
        echo "</form>";
    }
}else{
    echo "Aucune critique n'est signalee";
}
?>

</body>
