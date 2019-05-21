
<?php
include 'head.php';
include 'header.php';
if (!est_admin()){
    header('Location: accueil.php');
}
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
	var spinner = $( "#listeSerie" ).selectmenu();
	var spinner = $( "#listePrix" ).selectmenu();

  } );
  </script>

    </head>
    <body>

    <form action="formPrix.php" method="post">
	       <p>Nom <input type="text" name="nom"></p>
	       <p>Ville<input type="text" name="ville"></p>
         <p>Date<input type="text" name="date" id="datepicker"></p>
         <p><a href="ajoutprix.php"><input type="submit" value="Ajouter"></a></p>
    </form>
    <form action="ajoutprixserie.php" method="post">
      <label for="choix_serie">Nom Série </label>
      <?php
      require("connexion.php");
      $queryNomserie="Select * from serie";
      $resulatNomListe=pg_exec($linkpdo, $queryNomserie);
      //datalist dynamique
      //echo '<input  list="listeSerie" type="text" name="listeSerie">';
      echo '<select id="listeSerie">';
      while ($data =pg_fetch_array($resulatNomListe)) {
      	// on affiche les résultats
      	echo '<option value="'.$data['nomserie'].'">'.$data['nomserie']."</option>";
      }
      echo  '</select>';
    ?>

  <label for="choix_prix">Prix </label>
  <?php
  require("connexion.php");
  $queryprix="Select * from prixdecerne";
  $resulatprix=pg_exec($linkpdo, $queryprix);
  //datalist dynamique
  //echo '<input  list="listePrix" type="text" name="listePrix">';
  echo '<select id="listePrix">';
  while ($data =pg_fetch_array($resulatprix)) {
    // on affiche les résultats
    echo '<option value="'.$data['nomprix'].'">'.$data['nomprix']."</option>";
  }
  echo  '</select>';
?>
    <p><a href="ajoutprix.php"><input type="submit" value="Ajouter"></a></p>
        <?php
        if(isset($_GET['info'])){
            $info = $_GET['info'];
            echo "<p class = 'error'>$info</p>";
        }
        ?>
    </form>
    <h2>Prix dans la base</h2>
    <?php
    require("connexion.php");
    $connect=$linkpdo;
    $queryNomserie="Select * from prixdecerne";
    $resulatNomListe=pg_exec($connect, $queryNomserie);
    //datalist dynamique
    echo '<table>';
    echo "<tr>
       <th>Nom</th>
       <th>Ville</th>
   </tr>";
    while ($data =pg_fetch_array($resulatNomListe)) {
      // on affiche les résultats
      echo "<tr>";
      echo '<td>'.$data['nomprix'].'</td>';
      echo '<td>'.$data['villeprix'].'</td>';
      echo "</tr>";
    }
    echo  '</table>';
    ?>
