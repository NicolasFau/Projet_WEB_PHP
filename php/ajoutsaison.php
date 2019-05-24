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
            $( "#datepicker" ).datepicker();
		$( "#listeSerie" ).selectmenu();
		var spinner = $( "#tentacles" ).spinner();
        } );
    </script>
            <div class="page">
    <center><h1>Ajout Saison</h1></center>

<form action="formajoutsaison.php" method="post">
    <p>Date Sortie <input type="text" name="date" id="datepicker"></p>
    <p>Numéro Saison<input type="number" id="tentacles" name="num"></p>

    <label for="choix_serie">Nom Série </label>

    <?php
    if(isset($_GET['nom'])){
        //Affichage de la série entrée dans le formulaire précédent 
        echo "<input list=\"listeSerie\" type=\"text\" name=\"listeSerie\" value=\"".$_GET['nom']."\">";
    }
    else{
        //Affichage des series
        require("connexion.php");
        //Requete sql
        $queryNomserie="Select * from serie";
        //Soumission de la requete
        $resulatNomListe=pg_exec($linkpdo, $queryNomserie);
        //select dynamique
        echo '<select id="listeSerie" >';
        while ($data =pg_fetch_array($resulatNomListe)) {
            //Affichage des résultats
            echo '<option value="'.$data['nomserie'].'">'.$data['nomserie']."</option>";
        }
        echo  '</select>';
    }
    ?>


    <p><input type="submit" value="Ajouter"></p>
</form>
    </div>
     <?php
     //Appel du footer
    include 'footer.php';
    ?>
</body>
</html>
