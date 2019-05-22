<?php
include 'head.php';

 ?>
<body>
    <?php
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
    
<form action="formajoutsaison.php" method="post">
    <p>Date Sortie <input type="text" name="date" id="datepicker"></p>
    <p>Numéro Saison<input type="number" id="tentacles" name="num"></p>

    <label for="choix_serie">Nom Série </label>

    <?php
    if(isset($_GET['nom'])){
        echo "<input list=\"listeSerie\" type=\"text\" name=\"listeSerie\" value=\"".$_GET['nom']."\">";
    }
    else{

        require("connexion.php");
        $queryNomserie="Select * from serie";
        $resulatNomListe=pg_exec($linkpdo, $queryNomserie);
        //datalist dynamique
        echo '<select id="listeSerie" >';
        while ($data =pg_fetch_array($resulatNomListe)) {
            // on affiche les résultats
            echo '<option value="'.$data['nomserie'].'">'.$data['nomserie']."</option>";
        }
        echo  '</select>';
    }
    ?>


    <p><input type="submit" value="Ajouter"></p>
</form>

</body>
</html>