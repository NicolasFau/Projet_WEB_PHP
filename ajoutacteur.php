<?php
include 'head.php';

?>

    <body>

            <script>
            $( function() {
            $( "#datepicker" ).datepicker();
	       var spinner = $( "#listeSerie" ).selectmenu();
	       var spinner = $( "#listeActeur" ).selectmenu();
            } );
            </script>
        <?php
            include 'header.php';
if (!est_admin()){
    header('Location: accueil.php');
}
        ?>
                    <div class="page">
    <center><h1>Ajout Acteur</h1></center>


    <form action="formacteur.php" method="post">
	       <p>Nom <input type="text" name="nom"></p>
	       <p>Prenom<input type="text" name="prenom"></p>
         <p>Date de naissance<input type="text" name="date" id="datepicker"></p>
         <p><a href="ajoutacteur.php"><input type="submit" name="1" value="Ajouter Acteur"></a></p>
    </form>
    <form action="ajoutacteurserie.php" method="post">
      <label for="choix_serie">Nom Série </label>
      <?php
      require("connexion.php");
      $queryNomserie="Select * from serie";
      $resulatNomListe=pg_exec($linkpdo, $queryNomserie);
      //datalist dynamique
      echo '<select id="listeSerie">';
      while ($data =pg_fetch_array($resulatNomListe)) {
      	// on affiche les résultats
      	echo '<option value="'.$data['nomserie'].'">'.$data['nomserie']."</option>";
      }
      echo  '</select><br><br>';
    ?>

  <label for="choix_acteur">Acteur </label>
  <?php
  require("connexion.php");
  $queryacteur="Select * from acteur";
  $resulatacteur=pg_exec($linkpdo, $queryacteur);
  //datalist dynamique
  echo '<select id="listeActeur">';
  while ($data =pg_fetch_array($resulatacteur)) {
    // on affiche les résultats
    echo '<option value="'.$data['nomacteur'].'">'.$data['nomacteur']."</option>";
  }
  echo  '</select>';
?>
    <p><a href="ajoutacteur.php"><input type="submit" name="2" value="Ajouter Acteur/Serie"></a></p>
        <?php
        if(isset($_GET['info'])){
            $info = $_GET['info'];
            echo "<p class = 'error'>$info</p>";
        }
        ?>
    </form>
    <h2>Acteur dans la base</h2>
    <?php
    require("connexion.php");
    $connect=$linkpdo;
    $queryNomserie="Select * from acteur";
    $resulatNomListe=pg_exec($connect, $queryNomserie);
    //datalist dynamique
    echo '<table>';
    echo "<tr>
       <th>Prenom</th>
       <th>Nom</th>
   </tr>";
    while ($data =pg_fetch_array($resulatNomListe)) {
      // on affiche les résultats
      echo "<tr>";
      echo '<td>'.$data['prenomacteur'].'</td>';
      echo '<td>'.$data['nomacteur'].'</td>';
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
