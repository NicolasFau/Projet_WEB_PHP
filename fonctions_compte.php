    <?php
include 'connexion.php';

if (isset($_REQUEST['fonction']) && $_REQUEST['fonction'] != '')
{
    $_REQUEST['fonction']($_REQUEST);
}

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
        if (isset($_SESSION['estadmin']) && $_SESSION['estadmin']=='t') {
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
        $requete='SELECT * FROM critique, utilisateur WHERE codeutilisateurcritiquant = codeutilisateur AND pseudou =\'' .$pseudoU. '\'';
        $result=pg_exec($linkpdo,$requete);
        $donnees = pg_fetch_All($result);
        return $donnees;
}


function rechercher_saison_critique($linkpdo, $IDsaison){
    $requete= 'SELECT nomserie, numérosaison FROM saison WHERE idsaison=\''.$IDsaison.'\'' ;
    $result=pg_exec($linkpdo,$requete);
    $donnees=pg_fetch_all($result);
    return $donnees;
}


function modif_type($data){
    include 'connexion.php';
    $nouveau_type=$_REQUEST['params'] ['nouveau_type'];
    $pseudoU=$_REQUEST['params'] ['pseudoU'];
        
    $requete='UPDATE utilisateur SET TypeU=\'' . $nouveau_type . '\'WHERE PseudoU=\'' .$pseudoU. '\'';
    $donnees=pg_exec($linkpdo, $requete);
    $result=pg_result_error($donnees);

    if ($result == ""){
        echo 'La modification a bien été prise en compte, rafraichissez la page';
    }else{
        echo 'Une erreur est survenue, veuillez réessayer plus tard';
    }
}



function modif_description($data){
    include 'connexion.php';
    $nouvelle_description=$_REQUEST['params'] ['nouvelle_description'];
    $pseudoU=$_REQUEST['params'] ['pseudoU'];
    $nouvelle_description=pg_escape_string($nouvelle_description);
    $requete='UPDATE utilisateur SET DescriptionU=\'' . $nouvelle_description . '\'WHERE PseudoU=\'' .$pseudoU. '\'';
    $donnees=pg_exec($linkpdo, $requete);
    $result=pg_result_error($donnees);
    if ($result == ""){
        echo 'Une erreur est survenue, veuillez réessayer plus tard';
    }else{
        echo 'La modification a bien été prise en compte, rafraichissez la page';
    }
}
  
function verification_mdp($data){
    $mdp=$_REQUEST['params'] ['mdp'];
    $confirmation=$_REQUEST['params'] ['confirmation_mdp'];
    $pseudoU=$_REQUEST['params'] ['pseudoU'];
    if ($confirmation==$mdp){
        if (preg_match("#(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{6,30}$#", $mdp)){
            $modif = modif_mdp($mdp, $pseudoU);
            echo $modif; 
        }else{
            echo -3;   
        }
    }else{
        echo -1;
    }
}

function modif_mdp($nouveau_mdp, $pseudoU){
    include'connexion.php';
    $requete='UPDATE utilisateur SET passwordu= \'' . $nouveau_mdp . '\' WHERE PseudoU= \'' . $pseudoU . '\'';
    $donnees=pg_query($linkpdo, $requete);
    $result=pg_result_error($donnees);
    if ($result==""){
        echo 0;
    }else{
        echo -2;
    }
}

    function supprimer_critique($data){
        include 'connexion.php';
        $idcritique=$_REQUEST['params'] ['idcritique'];
        $pseudoU=$_REQUEST['params'] ['pseudoU'];
        $requete2='DELETE FROM signalement WHERE idcritique='.$idcritique;
        $donnees=pg_exec($linkpdo,$requete2);
        $requete='DELETE FROM critique WHERE idcritique=' . $idcritique . 'AND codeutilisateurcritiquant = (SELECT codeutilisateur FROM utilisateur WHERE PseudoU=\'' . $pseudoU . '\' ) ';
        $donnees=pg_exec($linkpdo, $requete);
        $result=pg_result_error($donnees);
        if ($result==""){
            echo 'L\'opération a été effectuée';
        }else{
            echo 'L\'opération a échouée';
        }
    }

?>