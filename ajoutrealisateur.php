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
      //Appel de la fonction connection
      require("connexion.php");
      //Requete sql
      $queryNomserie="Select * from serie";
      //Soumission de la requete
      $resulatNomListe=pg_exec($linkpdo, $queryNomserie);
      //select dynamique
      echo '<select id="listeSerie" name="1" >';
      while ($data =pg_fetch_array($resulatNomListe)) {
      	//Affichage les résultats
      	echo '<option value="'.$data['nomserie'].'">'.$data['nomserie']."</option>";
      }
      echo  '</select>';
	echo "</br>";
	echo "</br>";

    ?>

  <label for="choix_realisateur">Nom du réalisateur </label>
  <?php
  //Appel de la fonction connexion
  require("connexion.php");
  //Requete sql
  $queryNomserie="Select * from realisateur";
  //Soumisson de la requete
  $resulatNomListe=pg_exec($linkpdo, $queryNomserie);
  //selectlist dynamique
 
  echo '<select id="listeRea" name="2"  >';
  //Parcour du tableau
  while ($data =pg_fetch_array($resulatNomListe)) {
    //Affichage des résultats
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
    //Appel de la fonction connection
    require("connexion.php");
    $queryNomserie="Select * from realisateur";
    //Soumission de la requete
    $resulatNomListe=pg_exec($linkpdo, $queryNomserie);
    //select dynamique
    echo '<table>';
    echo "<tr>
       <th>Prenom</th>
       <th>Nom</th>
   </tr>";
   //Parcour du tableau
    while ($data =pg_fetch_array($resulatNomListe)) {
      //Affichage les résultats
      echo "<tr>";
      echo '<td>'.$data['prenomrealisateur'].'</td>';
      echo '<td>'.$data['nomrealisateur'].'</td>';
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
