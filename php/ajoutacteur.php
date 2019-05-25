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

    <h2>Ajouter un acteur dans la base</h2>
    <form action="formacteur.php" method="post">
        <p>Nom</p>
        <input type="text" name="nom">
        <p>Prenom</p>
        <input type="text" name="prenom">
        <p>Date de naissance</p>
        <input type="text" name="date" id="datepicker">
         <p><a href="ajoutacteur.php"><input type="submit" name="1" value="Ajouter"></a></p>
    </form>
                        <h2>Lier un acteur à une série</h2>
    <form action="ajoutacteurserie.php" method="post">
        <p>Nom série</p>
      <label for="choix_serie"></label>
      <?php
      //Affichage des séries de la base
      //Appel de la fonction de connection
      require("connexion.php");
      //Requete sql
      $queryNomserie="Select * from serie";
      //Soumission de la requetes
      $resulatNomListe=pg_exec($linkpdo, $queryNomserie);
      //select dynamique
      echo '<select name="listeSerie"  id="listeSerie">';
      while ($data =pg_fetch_array($resulatNomListe)) {
      	//Affiche des résultats
      	echo '<option value="'.$data['nomserie'].'">'.$data['nomserie']."</option>";
      }
      echo  '</select><br>';
    ?>

<p>Acteur</p>
  <label for="choix_acteur"></label>
  <?php
  //Affichage des acteurs de la base
  //Appel de la fonction de connection
  require("connexion.php");
  //Requete sql
  $queryacteur="Select * from acteur";
  //Soumission de la requetes
  $resulatacteur=pg_exec($linkpdo, $queryacteur);
  //select dynamique
  echo '<select name="test"  id="listeActeur">';
  while ($data =pg_fetch_array($resulatacteur)) {
    //Affichage les résultats
    echo '<option value="'.$data['nomacteur'].'">'.$data['nomacteur']."</option>";
  }
  echo  '</select>';
?>
    <p><a href="ajoutacteur.php"><input type="submit" name="2" value="Ajouter"></a></p>
        <?php
        //Test sur la variable GET
        if(isset($_GET['info'])){
            $info = $_GET['info'];
            echo "<p class = 'error'>$info</p>";
        }
        ?>
    </form>
    <h2>Acteur dans la base</h2>
    <?php
    //Affichage des acteurs
    //Appel de la fonction connection
    require("connexion.php");
    //Requete sql
    $queryNomserie="Select * from acteur";
    //Soumission de la requete
    $resulatNomListe=pg_exec($linkpdo, $queryNomserie);
    //select dynamique
    echo '<table>';
    echo "<tr>
       <th>Prenom</th>
       <th>Nom</th>
   </tr>";
    while ($data =pg_fetch_array($resulatNomListe)) {
      //Affichage les résultats
      echo "<tr>";
      echo '<td>'.$data['prenomacteur'].'</td>';
      echo '<td>'.$data['nomacteur'].'</td>';
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
