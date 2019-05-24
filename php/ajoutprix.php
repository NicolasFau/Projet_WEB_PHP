
<?php
include 'head.php';

 ?>
    <body>

        <?php
        //Appel du header
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
      //Affichage des series
      //Appel  de la fonction connection
      require("connexion.php");
      //Requete sql
      $queryNomserie="Select * from serie";
      //Soumission de la requete
      $resulatNomListe=pg_exec($linkpdo, $queryNomserie);
      //select dynamique
      echo '<select name="1"  id="listeSerie">';
        //Parcour du tableau
      while ($data =pg_fetch_array($resulatNomListe)) {
      	//Affichage des résultats les résultats
      	echo '<option value="'.$data['nomserie'].'">'.$data['nomserie']."</option>";
      }
      echo  '</select><br><br>';
    ?>

  <label for="choix_prix">Prix </label>
  <?php
  //Affichage des nom des prix
  //Appel de la fonction connexion
  require("connexion.php");
  //Requete sql
  $queryprix="Select * from prixdecerne";
  //Sommission de la requete
  $resulatprix=pg_exec($linkpdo, $queryprix);
  //datalist dynamique
  echo '<select name="2"  id="listePrix">';
//Parcour du tableau
  while ($data =pg_fetch_array($resulatprix)) {
    //Affichage les résultats
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
    //Affichage des Prix
    //Appel de la fonction connexion
    require("connexion.php");
    //Requete sql
    $queryNomserie="Select * from prixdecerne";
    $resulatNomListe=pg_exec($linkpdo, $queryNomserie);
    //select dynamique
    echo '<table>';
    echo "<tr>
       <th>Nom</th>
       <th>Ville</th>
   </tr>";
   //Parcours du tableau
    while ($data =pg_fetch_array($resulatNomListe)) {
      // Affichage des résultats
      echo "<tr>";
      echo '<td>'.$data['nomprix'].'</td>';
      echo '<td>'.$data['villeprix'].'</td>';
      echo "</tr>";
    }
    echo  '</table>';
    ?>
        </div>
         <?php
         //Appel du footer
    include 'footer.php';
    ?>
</body>
</html>
