<?php require("header.php");

 ?>

<!DOCTYPE html>
<html>
    <head>
        <title>PHP</title>
        <meta charset="utf-8" />
    </head>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>
    <body>

    <form action="formacteur.php" method="post">
	       <p>Nom <input type="text" name="nom"></p>
	       <p>Prenom<input type="text" name="prenom"></p>
         <p>Date de naissance<input type="text" name="date" id="datepicker"></p>
         <p><a href="ajoutacteur.php"><input type="submit" name="1" value="Ajouter Acteur"></a></p>
    </form>
    <form action="ajoutacteurserie.php" method="post">
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

  <label for="choix_acteur">Acteur </label>
  <?
  require("connexion.php");
  $connect=$linkpdo;
  $queryacteur="Select * from acteur";
  $resulatacteur=pg_exec($connect, $queryacteur);
  //datalist dynamique
  echo '<input  list="listeActeur" type="text" name="listeActeur">';
  echo '<datalist id="listeActeur">';
  while ($data =pg_fetch_array($resulatacteur)) {
    // on affiche les résultats
    echo '<option value="'.$data['nomacteur'].'">';
  }
  echo  '</datalist>';
?>
    <p><a href="ajoutacteur.php"><input type="submit" name="2" value="Ajouter Acteur/Serie"></a></p>
    </form>
