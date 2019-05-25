<?php
//Récupération des fichiers de fonctions
require("connexion.php");
include 'head.php';
include 'header.php';
//Récupération des variables via POST
$date=$_POST['date'];
$numeroSaison=$_POST['num'];
$listeSerie=$_POST['listeSerie'];
//Control d'existance de la saison dans la base
//Requete sql
        $querycontrol = "SELECT * FROM saison WHERE nomserie='$listeSerie'";
        $result = pg_query($linkpdo, $querycontrol);
        while ($tab = pg_fetch_array($result)) {

            if ($tab['numérosaison'] == $numeroSaison) {
                $exit = 1;
            }
        }
        if ($exit != 1) {
            //Requete sql
            $queryinsert = "INSERT INTO saison(numérosaison, dateparutionsaison, nomserie) VALUES('$numeroSaison','$date','$listeSerie')";
            //Soumission de la requete
            $queryNomserie = pg_query($linkpdo, $queryinsert);
            //Control sur la requete
            if ($queryNomserie) {
                //Passage du nom de la serie et du numero de saison dans la page suivante
                $url = "Location: ajoutepisode.php?nom=" . $listeSerie . "&saison=" . $numeroSaison;
                header($url);
            } else {
                echo "Location: erreur.php";
            }
        } else {
            echo "La saison existe déjà";
        }
        //Récuperation du nom de la série via GET
        if (isset($_GET['nom'])) {
            echo "<input list=\"listeSerie\" type=\"text\" name=\"listeSerie\" value=\"" . $_GET['nom'] . "\">";
        }

 ?>
