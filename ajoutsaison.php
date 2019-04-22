<!DOCTYPE html>
<html>
    <head>
        <title>PHP</title>
        <meta charset="utf-8" />
    </head>
    <body>
    <form action="ajout.php" method="post">
	       <p>Date Sortie <input type="date" name="date"></p>
	       <p>Numéro Saison<input type="number" id="tentacles" name="num" min="1" max="100"></p>

  <label for="choix_serie">Nom Série </label>

  <?
  $n="test";
  $u="test";
  $p="123456789";
  $connect=pg_connect("host=localhost port=5432 dbname=$n user=$u password=$p");
  $queryNomserie="Select * from serie";
  $resulatNomListe=pg_exec($connect, $queryNomserie);
  //datalist dynamique
  echo '<input  list="listeSerie" type="text" name="listeSerie">';
  echo '<datalist id="listeSerie">';
  while ($data =pg_fetch_array($resulatNomListe)) {
  	// on affiche les résultats
  	echo '<option value='.$data['nomserie'].'>';
  }
  echo  '</datalist>';
?>

<p><input type="submit" value="Ajouter"></p>
        </form>

    </body>
</html>
