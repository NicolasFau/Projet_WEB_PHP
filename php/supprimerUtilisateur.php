<?php
include 'head.php'; //Inclusion du CSS et Metacharset UTF-8
include 'fonctionsDeRecherche.php'; //Inclusion du fichier avec les fonctions de recherches dans la BD

 ?>
    <body>


          <script>/**FonctionJQuery utilisée pour le menu déroulant pour sélectionner un utilisateur**/
  $( function() {
    $( "#listeUser" ).selectmenu();
});
</script>


    <?php
    include 'header.php';//Inclusion du header avec le menu
        if (!est_admin()){
    header('Location: accueil.php'); //Si la variable de session d'administration est fausse alors on redirige l'utilisateur vers l'accueil
}
    ?>
        <div class="page">
                <center><h1>Supprimer Utilisateur</h1></center>

<?php
    //Si le champ de formulaire avec le nom de l'utilisateur est saisi
    if(isset($_POST['listeUser'])){
         //On récupère le nom de l'utilisateur à supprimer
        $pseudo=$_POST['listeUser']; 
        //Vérifie que l'utilisateur existe bien dans la base (Fonction devenue inutile avec l'ajout du JQuery)
        $queryTestExistance= "Select * from utilisateur where pseudou='$pseudo'";
        $res=pg_exec($linkpdo, $queryTestExistance);
        $test=pg_fetch_row($res);
        if($test!=false) {
            //On cherche le code d'utilisateur pour pouvoir aller supprimer toutes les tables liées dans la base
            $queryNumUser = "Select codeutilisateur from utilisateur where pseudou='$pseudo'";
            $result = pg_exec($linkpdo, $queryNumUser);
            $row = pg_fetch_row($result);
            //On récupère le code utilisateur
            $numUser = $row[0];
            //On supprime toutes les critiques faites par l'utilisateur
            $querySuppCritique = "Delete from critique where codeutilisateurcritiquant='$numUser'";
            pg_exec($linkpdo, $querySuppCritique);
            //On supprime tous les signalements effectués par l'utilisateur
            $querySuppSignalement = "Delete from signalement where codeutilisateur='$numUser'";
            pg_exec($linkpdo, $querySuppSignalement);
            //On supprime toutes les consultations en relation avec l'utilisateur
            $querySuppConsultation = "Delete from consulter where codeutilisateur='$numUser'";
            pg_exec($linkpdo, $querySuppConsultation);
            //On supprime l'utilisateur de la base
            $queryNomserie = "DELETE from utilisateur where pseudou='$pseudo'";
            pg_exec($linkpdo, $queryNomserie);
        }else{
          //Sinon on affiche un message comme quoi l'utilisateur n'existe pas dans la base (Devenu inutile avec l'ajout du JQuery car l'administrateur ne pas sélectionner que les utilisateurs dans la liste)
            header('Location: supprimerUtilisateur.php?error=Cet utilisateur n\'existe pas dans la base');
        }

    }
    ?>
    <!--Formulaire pour sélectionner un utilisateur, on utilise une variable POST qui appelle la même page pour le traitement-->
    <form action="supprimerUtilisateur.php" method="post">
      <?php
      echo "Veuillez rentrer le pseudo de l'utilisateur à supprimer : " . "<br>";
      require("./connexion.php");
      //On appelle la fonction listeUser de fonctionsDeRecherche.php qui cherche tous les utilisateurs de la base sauf les admins
      $userList=listeUser($linkpdo);
      if ($userList != NULL) {
          echo '<select id="listeUser">';
          //Affichage des données
          foreach ($userList as $user) {
              echo '<option value="' . $user['pseudou'] . '">'.$user['pseudou'].'</option>';
          }
          echo '</select>';
      } else {
        //si aucun utilisateur dans la base alors on affiche un message d'erreur
          echo "Aucun utilisateur dans la base";
      }

      if (isset($_GET['error'])) {
          $erreur = $_GET['error'];
          echo "<p class = 'error'>$erreur</p>";
      }

      ?>

    <p><input type="submit" value="Supprimer"></p>
    </form>
        </div>
         <?php
    include 'footer.php';
    ?>
</body>
</html>