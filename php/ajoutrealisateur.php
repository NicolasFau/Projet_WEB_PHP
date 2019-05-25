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
            <h2>Ajouter un réalisateur dans la base</h2>
    <form action="formajoutrealisateur.php" method="post">
        <p>Nom</p>
        <input type="text" name="nom">
        <p>Prenom</p>
        <input type="text" name="prenom">
        <p>Date de naissance</p>
        <input type="text" name="date" id="datepicker">
         <p><input type="submit" value="Ajouter"></p>
    </form>
            <h2>Lier un réalisateur à une série</h2>
    <form action="ajoutrealisateurserie.php" method="post">
        <p>Nom série</p>
      <label for="choix_serie"></label>
      <?php
      //Affichage des series
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

    ?>
        <p>Nom du réalisateur</p>
  <label for="choix_realisateur"></label>
  <?php
  //Affichage des réalisateur
  //Appel de la fonction connexion
  require("connexion.php");
  //Requete sql
  $queryNomserie="Select * from realisateur";
  //Soumission de la requete
  $resulatNomListe=pg_exec($linkpdo, $queryNomserie);
  //select dynamique

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
    //Affichage des réaalisateurs
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
