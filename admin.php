<?php
include 'head.php';
include 'header.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>PHP</title>
    <meta charset="utf-8" />
</head>
<body>
<p><a href="ajoutserie.php"><input type="submit" name="1" value="Ajouter Serie"></a></p>
<p><a href="ajoutsaison.php"><input type="submit" name="1" value="Ajouter Saison"></a></p>
<p><a href="ajoutrealisateur.php"><input type="submit" name="1" value="Ajouter Réalisateur"></a></p>
<p><a href="ajoutprix.php"><input type="submit" name="1" value="Ajouter Prix"></a></p>
<p><a href="ajoutacteur.php"><input type="submit" name="1" value="Ajouter Acteur"></a></p>
<p><a href="supprimerUtilisateur.php"><input type="submit" name="1" value="Supprimer Utilisateur"></a></p>
<h3>Critiques Signalées</h3>
<?php
require("connexion.php");
$querycritique="Select * from critique where estsignalee='True'";
$result=pg_query($linkpdo,$querycritique);
echo "<form action=\"suppressionCritique.php\" method=\"post\">";
while ($data = pg_fetch_array($result)) {
    echo $data['codeutilisateurcritiquant'];
    echo $data['aviscritique']."<input type=\"checkbox\" name=\"suppr[]\" value=\"".$data['idcritique']."\">";
    $querymotif="Select motifsignalement from signalement where idcritique=".$data['idcritique'];
    $result=pg_query($linkpdo,$querymotif);
    $resulttab=pg_fetch_array($result);
    echo "</br>Motif:</br>";
    echo $resulttab['motifsignalement'];
}
echo "<div><input type=\"radio\" id=\"dewey\" name=\"choix\" value=\"Laisser\"><label for=\"dewey\">Laisser</label></div>";
echo "<div><input type=\"radio\" id=\"dewey\" name=\"choix\" value=\"Supprimer\"><label for=\"dewey\">Supprimer</label></div>";
echo "<p><input type=\"submit\" value=\"Valider\"></p>";
echo "</form>";
?>

</body>
