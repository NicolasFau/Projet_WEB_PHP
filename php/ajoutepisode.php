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
            var spinner = $( "#listeSaison" ).selectmenu();
	        var spinner = $( "#tentacles" ).spinner();
        });
    </script>
            <div class="page">
    <center><h1>Ajout Episode</h1></center>

<label for="choix_serie">Nom Série </label>
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

    <label for="choix_saison">Saison </label>
    <?php
    if(isset($_GET['saison'])){
        echo "<input list=\"listeSaison\" type=\"text\" name=\"listeSaison\" value=\"".$_GET['saison']."\">";
    }
    else{
        //Affichage des numéros de saisons
        //Appel de la fonction de connexion
        require("connexion.php");
        //Requete sql
        $query="Select * from Serie,Saison WHERE serie.nomserie=saison.nomserie";
        //Soumission de la requete
        $resulat=pg_exec($linkpdo, $query);
        //select dynamique
        echo '<select id="listeSaison">';
        while ($data =pg_fetch_array($resulat)) {
            //Affichage des résultats
            echo '<option value='.$data['numérosaison'].'>'.$data['numérosaison']."</option>";
        }
        echo  '</select>';
    }
    ?>

    <p>Nom Episode <input type="text" name="nom"></p>
    <p>Numéro Episode<input type="number" id="tentacles" name="num" min="1" max="100"></p>
    <p>Durée épisode<input type="text" name="duree"></p>
    <p><a href="ajoutepisode.php"><input type="submit" value="Ajouter"></a></p>
    <p><a href=".dmin.php"><input type="submit" value="Terminer"></a></p>

</form>
    </div>
     <?php
     //Appel du footer
    include 'footer.php';
    ?>
</body>
</html>
