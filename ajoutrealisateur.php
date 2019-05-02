<?php require("header.php");

 ?>

<!DOCTYPE html>
<html>
    <head>
        <title>PHP</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
    $( function() {
      $( "#datepicker" ).datepicker();
    } );
    </script>

    </head>
    <body>
    <form action="formajoutrealisateur.php" method="post">
	       <p>Nom <input type="text" name="nom"></p>
	       <p>Prenom<input type="text" name="prenom"></p>
         <p>Date de naissance<input type="text" name="date" id="datepicker"></p>
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
      	echo '<option value="'.$data['nomserie'].'">';
      }
      echo  '</datalist>';
    ?>

  <label for="choix_realisateur">Nom du réalisateur </label>
  <?
  require("connexion.php");
  $connect=$linkpdo;
  $queryNomserie="Select * from realisateur";
  $resulatNomListe=pg_exec($connect, $queryNomserie);
  //datalist dynamique
  echo '<input  list="listeRea" type="text" name="listeRea">';
  echo '<datalist id="listeRea">';
  while ($data =pg_fetch_array($resulatNomListe)) {
    // on affiche les résultats
    echo '<option value="'.$data['nomrealisateur'].'">';
  }
  echo  '</datalist>';
?>
    <p><input type="submit" value="Ajouter"></p>
    </form>
