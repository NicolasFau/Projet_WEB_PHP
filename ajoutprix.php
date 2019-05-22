
<?php
include 'head.php';

 ?>
    <body>

        <?php
        include 'header.php';
        if (!est_admin()){
    header('Location: accueil.php');
}
        ?>
<script>
  $( function() {
    $( "#datepicker" ).datepicker();
	var spinner = $( "#listeSerie" ).selectmenu();
	var spinner = $( "#listePrix" ).selectmenu();
  } );
  </script>
                    <div class="page">
                            <center><h1>Ajout Prix</h1></center>


    <form action="formPrix.php" method="post">
	       <p>Nom <input type="text" name="nom"></p>
	       <p>Ville<input type="text" name="ville"></p>
         <p><a href="ajoutprix.php"><input type="submit" value="Ajouter"></a></p>
    </form>
    <form action="ajoutprixserie.php" method="post">
      <label for="choix_serie">Nom Série </label>
      <?php
      require("connexion.php");

      $queryNomserie="Select * from serie";
      $resulatNomListe=pg_exec($linkpdo, $queryNomserie);
      //datalist dynamique
      echo '<select name="1"  id="listeSerie">';

      while ($data =pg_fetch_array($resulatNomListe)) {
      	// on affiche les résultats
      	echo '<option value="'.$data['nomserie'].'">'.$data['nomserie']."</option>";
      }
      echo  '</select><br><br>';
    ?>

  <label for="choix_prix">Prix </label>
  <?php
  require("connexion.php");

  $queryprix="Select * from prixdecerne";
  $resulatprix=pg_exec($linkpdo, $queryprix);
  //datalist dynamique
  echo '<select name="2"  id="listePrix">';
;
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
        </div>
         <?php
    include 'footer.php';
    ?>
</body>
</html>
