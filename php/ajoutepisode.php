<?php
//Appel du head
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
            var spinner = $( "#listeSerie" ).selectmenu();
        });
    </script>
            <div class="page">
    <center><h1>Ajout Episode</h1></center>
<p>Nom série</p>
<label for="choix_serie"></label>
<form action="formajoutepisode.php" method="post">
    <?php
    if(isset($_GET['nom'])){
        echo "<input list=\"listeSerie\" type=\"text\" name=\"listeSerie\" value=\"".$_GET['nom']."\">";
    }
    else{
        //Affichage des nom des séries
        //Appel de la fonction de connexion
        require("connexion.php");
        //Requete sql
        $queryNomserie="Select * from serie";
        //Soumission de la requete
        $resulatNomListe=pg_exec($linkpdo, $queryNomserie);
        //select dynamique
        echo '<select id="listeSerie">';
        while ($data =pg_fetch_array($resulatNomListe)) {
            //Affichage des résultats
            echo '<option value="'.$data['nomserie'].'">'.$data['nomserie']."</option>";
        }
        echo  '</select><br><br>';
    }
    ?>
    <p>Saison </p>
    <label for="choix_saison"></label>
    <?php
    if(isset($_GET['saison'])){
        echo "<input list=\"listeSaison\" type=\"text\" name=\"listeSaison\" value=\"".$_GET['saison']."\">";
    }
    else{
        ?>
        <input type="number" id="listeSaison" name="listeSaison" min="1" max="100">
        <?php
    }
    ?>

    <p>Nom Episode</p>
    <input type="text" name="nom" placeholder="La revanche des Siths">
    <p>Numéro Episode</p>
    <input type="number" id="tentacles" name="num" min="1" max="100">
    <p>Durée épisode</p>
    <input type="text" name="duree" placeholder="00:45:00">
    <p><a href="ajoutepisode.php"><input type="submit" value="Ajouter"></a></p>
    <p><a href="admin.php"><input type="submit" value="Terminer"></a></p>

</form>
    </div>
     <?php
     //Appel du footer
    include 'footer.php';
    ?>
</body>
</html>
