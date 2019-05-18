<?php

/*function rechercher_serie($linkpdo, $recherche){
    $result = $linkpdo->prepare('SELECT * FROM Serie WHERE NomSerie LIKE :recherche ORDER BY NomSerie ASC');
    $result->execute(array('recherche' => $recherche));
    $donnees = $result->fetchAll();
    return $donnees;
}


function rechercher_acteur($linkpdo, $recherche){
    $result = $linkpdo->prepare('SELECT * FROM Acteur WHERE NomActeur LIKE :recherche ORDER BY NomActeur ASC');
    $result->execute(array('recherche' => $recherche));
    $donnees = $result->fetchAll();
    return $donnees;
}*/

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

function rechercher_critiqueRecente($linkpdo){
    $requete="Select * FROM critique ORDER BY datecritique DESC limit 5";
    $result=pg_exec($linkpdo, $requete);
    $donnees=pg_fetch_all($result);
    return $donnees;
}

?>					