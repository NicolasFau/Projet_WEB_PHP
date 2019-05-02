<?php

function rechercher_serie($linkpdo, $recherche){
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
}

function rechercher_categorie($linkpdo, $recherche){
    
}




$recherche = strtolower($_GET['search']);

$resultatsSeries = rechercher_serie($linkpdo, $recherche);

if($resultatsSeries != NULL){
    foreach($resultatsSeries as $Serie) {
            echo $Serie['NomSerie'];
            echo $Serie['ThemeSerie'];
            echo $Serie['SynopsisSerie'];
    }
else{
    echo 'Aucun réultat pour cette recherche';
}

?>					