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
        
        $requete='UPDATE utilisateur SET DescriptionU=\'' . $nouvelle_description . '\'WHERE PseudoU=\'' .$pseudoU. '\'';
        $donnees=pg_exec($linkpdo, $requete);
        
        /*
        $result = $linkpdo->prepare('UPDATE utilisateur SET DescriptionU=:nouvelle_description WHERE PseudoU=:pseudoU');
        $result->bindParam(':pseudoU', $pseudoU, PDO::PARAM_STR);
        $result->bindParam(':nouvelle_description', $nouvelle_description, PDO::PARAM_STR);
        $donnees = $result->execute();
        */
        
        if ($donnees == null){
            echo 'Une erreur est survenue, veuillez réessayer plus tard';
        }else{
            echo 'La modification a bien été prise en compte, rafraichissez la page';
        }
        return $donnees;

    }
  

if (isset($_POST['nouveau_mdp'])){
    
    $nouveau_mdp=$_POST['nouveau_mdp'];
    $result = $linkpdo->prepare('UPDATE utilisateur SET passwordu=:nouveau_mdp WHERE PseudoU=:pseudoU');
    $result->bindParam(':pseudoU', $pseudoU, PDO::PARAM_STR);
    $result->bindParam(':nouveau_mdp', $nouveau_mdp, PDO::PARAM_STR);
    $donnees = $result->execute();

}

    
    function supprimer_critique($data){
        include 'connexion.php';
        $idcritique=$_REQUEST['params'] ['idcritique'];
        $pseudoU=$_REQUEST['params'] ['pseudoU'];
        $requete='DELETE FROM critique WHERE idcritique=' . $idcritique . 'AND codeutilisateurcritiquant = (SELECT codeutilisateur FROM utilisateur WHERE PseudoU=\'' . $pseudoU . '\' ) ';
        $donnees=pg_exec($linkpdo, $requete);
        echo('L\'opération a été effectuée, rechargez la page' );
        /*
        $result = $linkpdo->prepare("DELETE FROM critique WHERE idcritique=:idcritique AND codeutilisateurcritiquant = (SELECT codeutilisateur FROM utilisateur WHERE PseudoU=:pseudoU)");
        $result->bindParam(':idcritique', $idcritique);
        $donnees = $result->execute();*/
        return $donnees;
    }
    



?>