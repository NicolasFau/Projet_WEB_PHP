<?php
include 'head.php';
include 'header.php';
 ?>

<!DOCTYPE html>
<html>
    <head>
        <title>PHP</title>
        <meta charset="utf-8" />
    </head>
    <body>
    <label for="choix_serie">Nom Série </label>
    <form action="formajoutepisode.php" method="post">
            <?php
            if(isset($_GET['nom'])){
                echo "<input list=\"listeSerie\" type=\"text\" name=\"listeSerie\" value=\"".$_GET['nom']."\">";
                }
            else{
            require("connexion.php");
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

          <label for="choix_saison">Saison </label>
          <?php 
          if(isset($_GET['saison'])){
                echo "<input list=\"listeSaison\" type=\"text\" name=\"listeSaison\" value=\"".$_GET['saison']."\">";
                }
          else{

          require("connexion.php");
          $connect=$linkpdo;
          $query="Select * from Serie,Saison WHERE serie.nomserie=saison.nomserie";
          $resulat=pg_exec($connect, $query);
          //datalist dynamique
          echo '<input  list="listeSaison" type="text" name="listeSaison">';
          echo '<datalist id="listeSaison">';
          while ($data =pg_fetch_array($resulat)) {
                // on affiche les résultats
                echo '<option value='.$data['numérosaison'].'>';
          }
          echo  '</datalist>';
                }        
?>

	       <p>Nom Episode <input type="text" name="nom"></p>
	       <p>Numéro Episode<input type="number" id="tentacles" name="num" min="1" max="100"></p>
         <p>Durée épisode<input type="text" name="duree"></p>
         <p><a href="ajoutepisode.php"><input type="submit" value="Ajouter"></a></p>
         <p><a href="admin.php"><input type="submit" value="Terminer"></a></p>

    </form>
