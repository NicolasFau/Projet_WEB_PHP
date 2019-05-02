<?php
include 'connexion.php';

function est_connecte(){
    if ( session_status() == PHP_SESSION_DISABLED  ) {
        return false;
    }

    if (isset($_SESSION['PseudoU'])){
        return true;
    }
    return false;
}

function est_admin() {
    if (est_connecte()) {
        if ($_SESSION['estadmin']) {
            return true;
        }
    }
    return false;
}

function rechercher_utilisateur($linkpdo, $pseudoU){
    $requete='SELECT * FROM utilisateur WHERE pseudou=\'' .$pseudoU.'\'';
    $result=pg_exec($linkpdo,$requete);
    $donnees = pg_fetch_all($result);
    return $donnees;
}

function rechercher_critiques($linkpdo, $pseudoU){
    $requete='SELECT * FROM critique WHERE codeutilisateurcritiquant = (SELECT codeutilisateur FROM utilisateur WHERE pseudou= \'admin\')';
    $result=pg_exec($linkpdo,$requete);
    $donnees = pg_fetch_All($result);
    print_r($donnees);
    return $donnees;
}

function supprimer_critique($linkpdo, $IDCritique){
$result = $db->prepare("DELETE FROM Critique WHERE IDCritique=:IDCritique");
  $result->bindParam(':IDCritique', $IDCritique, PDO::PARAM_STR);
  $donnees = $req->execute();
  return $reqOk;
}

function rechercher_saison_critique($linkpdo, $IDsaison){
    $requete= 'SELECT nomserie, numérosaison FROM saison WHERE idsaison=\''.$IDsaison.'\'' ;
    $result=pg_exec($linkpdo,$requete);
    $donnees=pg_fetch_all($result);
    return $donnees;
}

?>