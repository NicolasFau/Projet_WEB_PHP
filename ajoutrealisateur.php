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
      $( "#listeSerie" ).selectmenu();
      $( "#listeRea" ).selectmenu();    
} );
	
    </script>
        <div class="page">
                <center><h1>Ajout Réalisateur</h1></center>

    <form action="formajoutrealisateur.php" method="post">
	       <p>Nom <input type="text" name="nom"></p>
	       <p>Prenom<input type="text" name="prenom"></p>
         <p>Date de naissance<input type="text" name="date" id="datepicker"></p>
         <p><input type="submit" value="Ajouter"></p>
    </form>
    <form action="ajoutrealisateurserie.php" method="post">
      <label for="choix_serie">Nom Série </label>
      <?php
      require("connexion.php");
      $queryNomserie="Select * from serie";
      $resulatNomListe=pg_exec($linkpdo, $queryNomserie);
      //datalist dynamique
      //echo '<input  list="listeSerie" type="text" name="listeSerie">';
      echo '<select id="listeSerie" name="1" >';
      while ($data =pg_fetch_array($resulatNomListe)) {
      	// on affiche les résultats
      	echo '<option value="'.$data['nomserie'].'">'.$data['nomserie']."</option>";
      }
      echo  '</select>';
    ?>

  <label for="choix_realisateur">Nom du réalisateur </label>
  <?php
  require("connexion.php");
  $queryNomserie="Select * from realisateur";
  $resulatNomListe=pg_exec($linkpdo, $queryNomserie);
  //datalist dynamique
 // echo '<input  list="listeRea" type="text" name="listeRea">';
  echo '<select id="listeRea" name="2"  >';
  while ($data =pg_fetch_array($resulatNomListe)) {
    // on affiche les résultats
    echo '<option value="'.$data['nomrealisateur'].'">'.$data['nomrealisateur']."</option>";
  }
  echo  '</select>';
?>
    <p><input type="submit" value="Ajouter"></p>
        <?php
        if(isset($_GET['info'])){
            $info = $_GET['info'];
            echo "<p class = 'error'>$info</p>";
        }
        ?>
    </form>
    <h2>Réalisateur dans la base</h2>
    <?php
    require("connexion.php");
    $connect=$linkpdo;
    $queryNomserie="Select * from realisateur";
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
      echo '<td>'.$data['prenomrealisateur'].'</td>';
      echo '<td>'.$data['nomrealisateur'].'</td>';
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
