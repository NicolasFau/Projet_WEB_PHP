<?php
include 'head.php';
include 'fonctionsDeRecherche.php';
if (!est_admin()){
    header('Location: accueil.php');
}
 ?>
    <body>
          <script>
  $( function() {
    $( "#listeUser" ).selectmenu();
});
</script>

    <?php
    include 'header.php';
    if(isset($_POST['listeUser'])){
        $pseudo=$_POST['listeUser'];
        $queryTestExistance= "Select * from utilisateur where pseudou='$pseudo'";
        $res=pg_exec($linkpdo, $queryTestExistance);
        $test=pg_fetch_row($res);
        if($test!=false) {
            $queryNumUser = "Select codeutilisateur from utilisateur where pseudou='$pseudo'";
            $result = pg_exec($linkpdo, $queryNumUser);
            $row = pg_fetch_row($result);
            $numUser = $row[0];
            $querySuppCritique = "Delete from critique where codeutilisateurcritiquant='$numUser'";
            pg_exec($linkpdo, $querySuppCritique);
            $querySuppSignalement = "Delete from signalement where codeutilisateur='$numUser'";
            pg_exec($linkpdo, $querySuppSignalement);
            $querySuppConsultation = "Delete from consulter where codeutilisateur='$numUser'";
            pg_exec($linkpdo, $querySuppConsultation);
            $queryNomserie = "DELETE from utilisateur where pseudou='$pseudo'";
            pg_exec($linkpdo, $queryNomserie);
        }else{
            header('Location: supprimerUtilisateur.php?error=Cet utilisateur n\'existe pas dans la base');
        }

    }
    ?>

    <form action="supprimerUtilisateur.php" method="post">
      <?php
      echo "Veuillez rentrer le pseudo de l'utilisateur à supprimer : " . "<br>";
      require("./connexion.php");
      $userList=listeUser($linkpdo);
      if ($userList != NULL) {
          echo '<select id="listeUser">';

          foreach ($userList as $user) {
              echo '<option value="' . $user['pseudou'] . '">'.$user['pseudou'].'</option>';
          }
          echo '</select>';
      } else {
          echo "Aucun utilisateur dans la base";
      }

      if (isset($_GET['error'])) {
          $erreur = $_GET['error'];
          echo "<p class = 'error'>$erreur</p>";
      }

      ?>

    <p><input type="submit" value="Supprimer"></p>
    </form>
</body>
</html>