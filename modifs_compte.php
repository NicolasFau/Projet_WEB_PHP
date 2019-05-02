<?php 

    //include 'connexion.php';
    //include'header.php';
    //$pseudoU=$_SESSION['PseudoU'];

if (isset($_REQUEST['fonction']) && $_REQUEST['fonction'] != '')
{
    $_REQUEST['fonction']($_REQUEST);
}

function modif_type($data){
    include 'connexion.php';
    $nouveau_type=$_REQUEST['params'] ['nouveau_type'];
    $pseudoU=$_REQUEST['params'] ['pseudoU'];
        
    $requete='UPDATE utilisateur SET TypeU=\'' . $nouveau_type . '\'WHERE PseudoU=\'' .$pseudoU. '\'';
    $donnees=pg_exec($linkpdo, $requete);
    /*
    $result = $linkpdo->prepare('UPDATE utilisateur SET TypeU=:nouveau_type WHERE PseudoU=:pseudoU');
    $result->bindParam(':pseudoU', $pseudoU, PDO::PARAM_STR);
    $result->bindParam(':nouveau_type', $nouveau_type, PDO::PARAM_STR);
    $donnees = $result->execute();*/
        
        
    if ($donnees == null){
        echo 'Une erreur est survenue, veuillez réessayer plus tard';
    }else{
        echo 'La modification a bien été prise en compte, rafraichissez la page';
    }
    return $donnees;
}



function modif_description($data){
    include 'connexion.php';
    $nouvelle_description=$_REQUEST['params'] ['nouvelle_description'];
    $pseudoU=$_REQUEST['params'] ['pseudoU'];
    $nouvelle_description=pg_escape_string($nouvelle_description);
    $requete='UPDATE utilisateur SET DescriptionU=\'' . $nouvelle_description . '\'WHERE PseudoU=\'' .$pseudoU. '\'';
    $donnees=pg_exec($linkpdo, $requete);
        
    if ($donnees != 1){
        echo 'Une erreur est survenue, veuillez réessayer plus tard';
    }else{
        echo 'La modification a bien été prise en compte, rafraichissez la page';
    }
    return $donnees;
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

/*
function modif_mdp($data){
    include'connexion.php';
    $nouveau_mdp=$_REQUEST['params'] ['nouveau_mdp'];
    $pseudoU=$_REQUEST['params'] ['pseudoU'];
    $requete='UPDATE utilisateur SET passwordu=\' ' . $nouveau_mdp . ' \' WHERE PseudoU=\' ' . $pseudoU . '\'';
    $donnees=pg_exec($linkpdo, $requete);
    echo('L\'opération a été effectuée' );        
}*/
    
function supprimer_critique($data){
    include 'connexion.php';
    $idcritique=$_REQUEST['params'] ['idcritique'];
    $pseudoU=$_REQUEST['params'] ['pseudoU'];
    $requete='DELETE FROM critique WHERE idcritique=' . $idcritique . 'AND codeutilisateurcritiquant = (SELECT codeutilisateur FROM utilisateur WHERE PseudoU=\'' . $pseudoU . '\' ) ';
    $donnees=pg_exec($linkpdo, $requete);
    echo('L\'opération a été effectuée' );
    /*
    $result = $linkpdo->prepare("DELETE FROM critique WHERE idcritique=:idcritique AND codeutilisateurcritiquant = (SELECT codeutilisateur FROM utilisateur WHERE PseudoU=:pseudoU)");
    $result->bindParam(':idcritique', $idcritique);
    $donnees = $result->execute();*/
    return $donnees;
    }
?>