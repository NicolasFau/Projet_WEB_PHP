<!DOCTYPE html>
<html>
    <head>
        <title>PHP</title>
        <meta charset="utf-8" />
    </head>
    <body>

    <form action="formActeur.php" method="post">
	       <p>Nom <input type="text" name="nom"></p>
	       <p>Prenom<input type="text" name="prenom"></p>
         <p>Date de naissance<input type="date" name="date"></p>
         <p><a href="ajoutacteur.php"<input type="submit" value="Ajouter"></a></p>
    </form>
    <form action="ajoutacteurserie.php" method="post">
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

  <label for="choix_acteur">Acteur </label>
  <?
  $n="test";
  $u="test";
  $p="123456789";
  $connect=pg_connect("host=localhost port=5432 dbname=$n user=$u password=$p");
  $queryacteur="Select * from prixdecerne";
  $resulatacteur=pg_exec($connect, $queryacteur);
  //datalist dynamique
  echo '<input  list="listeActeur type="text" name="listeActeur">';
  echo '<datalist id="listeActeur">';
  while ($data =pg_fetch_array($resulatacteur)) {
    // on affiche les résultats
    echo '<option value='.$data['nomActeur'].'>';
  }
  echo  '</datalist>';
?>
    <p><a href="ajoutacteur.php"><input type="submit" value="Ajouter"></a></p>
    </form>
