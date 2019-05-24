<?php
include 'connexion.php'; //Appel de la page de connexion à la base de données

if (isset($_REQUEST['fonction']) && $_REQUEST['fonction'] != '')//code qui permet l'appel d'une fonction de ce fichier en ajax
{
    $_REQUEST['fonction']($_REQUEST);
}


//Fonction qui vérifie si l'utilisateur est connecté ou non 
function est_connecte(){ 
    if ( session_status() == PHP_SESSION_DISABLED  ) {
        return false;
    }

    if (isset($_SESSION['PseudoU'])){ //Si la variable de seesion est définie alors il est connecté
        return true;
    }
    return false;
}

//Fonction qui vérifie si l'utilisateur est un admin 
function est_admin() { 
    if (est_connecte()) { // Si l'utilisateur est connecté
        if (isset($_SESSION['estadmin']) && $_SESSION['estadmin']=='t') { // Et que la variable session estadmin est sur vrai 
            return true; //Alors c'est un admin
        }
    }
    return false;
}

//Fonction qui récupère les données d'un utilisateur grace au pseudo
function rechercher_utilisateur($linkpdo, $pseudoU){
    $requete='SELECT * FROM utilisateur WHERE pseudou=\'' .$pseudoU.'\'';
    $result=pg_exec($linkpdo,$requete);
    $donnees = pg_fetch_all($result);
    return $donnees;
}

//Fonction qui recherche toutes les critiques faites par un utilisateur grace au pseudo
function rechercher_critiques($linkpdo, $pseudoU){
        $requete='SELECT * FROM critique, utilisateur WHERE codeutilisateurcritiquant = codeutilisateur AND pseudou =\'' .$pseudoU. '\'';
        $result=pg_exec($linkpdo,$requete);
        $donnees = pg_fetch_All($result);
        return $donnees;
}

//Fonction qui recherche toutes les critiques faites sur une saison
function rechercher_saison_critique($linkpdo, $IDsaison){
    $requete= 'SELECT nomserie, numérosaison FROM saison WHERE idsaison=\''.$IDsaison.'\'' ;
    $result=pg_exec($linkpdo,$requete);
    $donnees=pg_fetch_all($result);
    return $donnees;
}

//Fonction qui modifie le type d'un utilisateur
function modif_type($data){
    include 'connexion.php';
    
    //Recuperation des paramètre passé en ajax
    $nouveau_type=$_REQUEST['params'] ['nouveau_type'];
    $pseudoU=$_REQUEST['params'] ['pseudoU'];
    
    //Requete sql
    $requete='UPDATE utilisateur SET TypeU=\'' . $nouveau_type . '\'WHERE PseudoU=\'' .$pseudoU. '\'';
    $donnees=pg_exec($linkpdo, $requete);
    $result=pg_result_error($donnees);
    
    if ($result == ""){//Si la requete est passée
        echo 'La modification a bien été prise en compte, rafraichissez la page';
    }else{//Si la requete n'est pas passée
        echo 'Une erreur est survenue, veuillez réessayer plus tard';
    }
}


//Fonction qui permet la modification de la description d'un utilisateur
function modif_description($data){
    include 'connexion.php';
    
    //Recuperation des paramètre passé en ajax
    $nouvelle_description=$_REQUEST['params'] ['nouvelle_description'];
    $pseudoU=$_REQUEST['params'] ['pseudoU'];
    
    $nouvelle_description=pg_escape_string($nouvelle_description); //Echappement des caractères spéciaux
    $requete='UPDATE utilisateur SET DescriptionU=\'' . $nouvelle_description . '\'WHERE PseudoU=\'' .$pseudoU. '\'';
    $donnees=pg_exec($linkpdo, $requete);
    $result=pg_result_error($donnees);
    
    if ($result == ""){//Si la requete est passée
        echo 'Une erreur est survenue, veuillez réessayer plus tard';
    }else{//Si la requete n'est pas passée
        echo 'La modification a bien été prise en compte, rafraichissez la page';
    }
}


//Fonction qui permet la vérification du mot de passe et qui appelle la fonction de modification de mdp
function verification_mdp($data){
    
    //Recuperation des paramètre passé en ajax    
    $mdp=$_REQUEST['params'] ['mdp'];
    $confirmation=$_REQUEST['params'] ['confirmation_mdp'];
    $pseudoU=$_REQUEST['params'] ['pseudoU'];
    
    if ($confirmation==$mdp){//Si le mot de passe et la confirmation ne sont pas identiques retour -1
        if (preg_match("#(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{6,30}$#", $mdp)){//RegEx pour savoir si le mdp est conforme
            $modif = modif_mdp($mdp, $pseudoU);//Si mdp conforme appel de la fonction de modification du mdp
            echo $modif; 
        }else{// Si md non conforme retour -3
            echo -3;   
        }
    }else{
        echo -1;
    }
}

//Fonction de modification du mdp
function modif_mdp($nouveau_mdp, $pseudoU){
    include'connexion.php';
    
    //requete de modification du mdp
    $requete='UPDATE utilisateur SET passwordu= \'' . $nouveau_mdp . '\' WHERE PseudoU= \'' . $pseudoU . '\'';
    $donnees=pg_query($linkpdo, $requete);
    $result=pg_result_error($donnees);
    
    if ($result==""){//Si la requete est passée retour 0
        echo 0;
    }else{//Si la requete n'est pas passée retour -2
        echo -2;
    }
}

//Fonction de suppression d'une critique
function supprimer_critique($data){
    include 'connexion.php';
    
    //Recuperation des paramètre passé en ajax    
    $idcritique=$_REQUEST['params'] ['idcritique'];
    $pseudoU=$_REQUEST['params'] ['pseudoU'];
    
    //suppression tout les signalements relatifs à cette critique de al base de données
    $requete2='DELETE FROM signalement WHERE idcritique='.$idcritique;
    $donnees=pg_exec($linkpdo,$requete2);
    
    //Suprression de la critique 
    $requete='DELETE FROM critique WHERE idcritique=' . $idcritique . 'AND codeutilisateurcritiquant = (SELECT codeutilisateur FROM utilisateur WHERE PseudoU=\'' . $pseudoU . '\' ) ';
    $donnees=pg_exec($linkpdo, $requete);
    $result=pg_result_error($donnees);
    
    if ($result==""){//Si la requete est passée
        echo 'L\'opération a été effectuée';
    }else{//Si la requete n'est pas passée
        echo 'L\'opération a échouée';
    }
}

?>