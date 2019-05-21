
<?php
include 'head.php';
include 'header.php';
include 'fonctionsDeRecherche.php';
if (!est_admin()){
    header('Location: accueil.php');
}
 ?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <style>
    fieldset {
      border: 0;
    }
    label {
      display: block;
      margin: 30px 0 0 0;
    }
    .overflow {
      height: 200px;
    }
  </style>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#listeUser" ).selectmenu();
});
</script>

<!DOCTYPE html>
<html>
    <body>
    <?php
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
          //echo '<input  list="listeUser" type="text" name="listeUser">';
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
