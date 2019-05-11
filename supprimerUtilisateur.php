<?php
include 'head.php';
include 'header.php';
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
    <?php
    if(isset($_POST['pseudoU'])){
        $queryNomserie="DELETE from utilisateur where pseudou=".$_POST['$pseudoU'];
        $resulatPseudo=pg_exec($linkpdo, $queryNomserie);
    }
    ?>
    <form action="supprimerUtilisateur.php" method="post">
      <label for="pseudoU">Pseudo </label>
      <?php
      require("connexion.php");
      $queryPseudo="Select * from utilisateur";
      $resulatPseudo=pg_exec($linkpdo, $queryPseudo);
      echo '<input  list="listeUser" type="text" name="listeUser">';
      echo '<datalist id="listeUser">';
      $data =pg_fetch_array($resulatPseudo);
      var_dump($data);
      while ($data) {
      	// on affiche les résultats
          echo '<option value="'.$data['pseudoU'].'">';
      }
      echo  '</datalist>';
    ?>

    <p><input type="submit" value="Supprimer"></p>
    </form>
