<!DOCTYPE html>
<html>
    <head>
        <title>PHP</title>
        <meta charset="utf-8" />
    </head>
    <body>
    <form action="formajoutrealisateur.php" method="post">
	       <p>Nom <input type="text" name="nom"></p>
	       <p>Prenom<input type="text" name="prenom"></p>
         <p>Date de naissance<input type="date" name="date"></p>
         <p><input type="submit" value="Ajouter"></p>
    </form>
    <form action="ajoutrealisateurserie.php" method="post">
      <label for="choix_serie">Nom Série </label>
      <?
      require("connexion.php");
      $connect=$linkpdo;
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
    <label for="choix_serie">Sélectionner une Saison </label>
    <?
    require("connexion.php");
    $connect=$linkpdo;
    $queryNomserie="Select * from Serie,Saison WHERE Serie.idSerie=Saison.idSerie";
    $resulatNomListe=pg_exec($connect, $queryNomserie);
    //datalist dynamique
    echo '<input  list="listeSaison" type="text" name="listeSaison">';
    echo '<datalist id="listeSaison">';
    while ($data =pg_fetch_array($resulatNomListe)) {
    	// on affiche les résultats
    	echo '<option value='.$data['numeroSaison'].'>';
    }
    echo  '</datalist>';
  ?>
  <label for="choix_realisateur">Nom du réalisateur </label>
  <?
  $n="test";
  $u="test";
  $p="123456789";
  $connect=pg_connect("host=localhost port=5432 dbname=$n user=$u password=$p");
  $queryNomserie="Select * from realisateur";
  $resulatNomListe=pg_exec($connect, $queryNomserie);
  //datalist dynamique
  echo '<input  list="listeRea" type="text" name="listeRea">';
  echo '<datalist id="listeRea">';
  while ($data =pg_fetch_array($resulatNomListe)) {
    // on affiche les résultats
    echo '<option value='.$data['nomrealisateur'].'>';
  }
  echo  '</datalist>';
?>
    <p><input type="submit" value="Ajouter"></p>
    </form>
