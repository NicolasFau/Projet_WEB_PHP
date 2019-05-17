<?php
include '/head.php';
include '/header.php';
if (!est_admin()){
    header('Location: accueil.php');
}
 ?>
<!DOCTYPE html>
<html>
<head>
    <title>PHP</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $( function() {
            $( "#datepicker" ).datepicker();
        } );
    </script>
</head>
<body>
<form action="formajoutsaison.php" method="post">
    <p>Date Sortie <input type="text" name="date" id="datepicker"></p>
    <p>Numéro Saison<input type="number" id="tentacles" name="num" min="1" max="100"></p>

    <label for="choix_serie">Nom Série </label>

    <?php
    if(isset($_GET['nom'])){
        echo "<input list=\"listeSerie\" type=\"text\" name=\"listeSerie\" value=\"".$_GET['nom']."\">";
    }
    else{

        require("/connexion.php");
        $connect=$linkpdo;
        $queryNomserie="Select * from serie";
        $resulatNomListe=pg_exec($connect, $queryNomserie);
        //datalist dynamique
        echo '<input  list="listeSerie" type="text" name="listeSerie">';
        echo '<datalist id="listeSerie">';
        while ($data =pg_fetch_array($resulatNomListe)) {
            // on affiche les résultats
            echo '<option value="'.$data['nomserie'].'">';
        }
        echo  '</datalist>';
    }
    ?>


    <p><input type="submit" value="Ajouter"></p>
</form>

</body>
</html>