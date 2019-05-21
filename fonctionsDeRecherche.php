<?php
include 'connexion.php';


function listeTheme($linkpdo){
    $requete='SELECT distinct themeserie FROM serie' ;
    $result=pg_exec($linkpdo,$requete);
    $donnees = pg_fetch_all($result);
    return $donnees;
}
function rechercheParTheme($linkpdo, $theme){
    $requete='SELECT * FROM serie WHERE themeserie=\''.$theme.'\'';
    $result=pg_exec($linkpdo,$requete);
    $donnees = pg_fetch_all($result);
    return $donnees;
}
function rechercher_critiqueSaison($linkpdo, $idsaison){
    $requete="Select * FROM critique WHERE idsaison= '$idsaison' ORDER BY datecritique DESC";
    $result=pg_exec($linkpdo, $requete);
    $donnees=pg_fetch_all($result);
    return $donnees;
}

function rechercher_critiqueSignalees($linkpdo){
    $requete="Select * from critique where estsignalee='True'";
    $result=pg_exec($linkpdo, $requete);
    $donnees=pg_fetch_all($result);
    return $donnees;
}

function listeUser($linkpdo){
    $requete="Select * from utilisateur";
    $result=pg_exec($linkpdo, $requete);
    $donnees=pg_fetch_all($result);
    return $donnees;
}

function rechercher_critiqueRecente($linkpdo){
    $requete="Select * FROM critique ORDER BY datecritique DESC limit 5";
    $result=pg_exec($linkpdo, $requete);
    $donnees=pg_fetch_all($result);
    return $donnees;
}

?>					