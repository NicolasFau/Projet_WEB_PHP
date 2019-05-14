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
<?php
        require("connexion.php");
        $querycritique="Select * from critique where estsignalee=True";
        $querymotif="Select motifsignalement from signalement where idcritique='$data['idcritique']'";
        $result=pg_query($linkpdo,$query);
        echo "<form action=\"supressionCritique.php\" methode\"post\">";
        while ($date = pg_fetch_array($result)) {
          echo "<input type=\"checkbox\" name=\"supr[]\" value=\"".$data['codeutilisateurcritiquant']."\">".$data['aviscritique'];
          $querymotif="Select motifsignalement from signalement where idcritique='$data['idcritique']'";
          $result=pg_query($linkpdo,$querymotif);
          $resulttab=pg_fetch_array($result);
          echo "$resulttab['motifsignalement']";
        }
        echo "</form>";
        echo "<p><input type=\"submit\" value=\"Supprimer\"></p>";
       ?>

</body>
