<!DOCTYPE html>
<html>
    <head>
        <title>PHP</title>
        <meta charset="utf-8" />
    </head>
    <body>
      
    <form action="formPrix.php" method="post">
	       <p>Nom <input type="text" name="nom"></p>
	       <p>Ville<input type="text" name="ville"></p>
         <p>Date<input type="date" name="date"></p>
         <p><a href="ajoutprix.php"<input type="submit" value="Ajouter"></a></p>
    </form>
    <form action="ajoutprixserie.php" method="post">
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

  <label for="choix_prix">Prix </label>
  <?
  $n="test";
  $u="test";
  $p="123456789";
  $connect=pg_connect("host=localhost port=5432 dbname=$n user=$u password=$p");
  $queryprix="Select * from prixdecerne";
  $resulatprix=pg_exec($connect, $queryprix);
  //datalist dynamique
  echo '<input  list="listePrix" type="text" name="listePrix">';
  echo '<datalist id="listePrix">';
  while ($data =pg_fetch_array($resulatprix)) {
    // on affiche les résultats
    echo '<option value='.$data['nomPrix'].'>';
  }
  echo  '</datalist>';
?>
    <p><a href="ajoutprix.php"><input type="submit" value="Ajouter"></a></p>
    </form>
