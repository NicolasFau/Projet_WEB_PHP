<?php
include 'connexion.php';

//Fonction qui permet de signaler une critique
function signaler_critique($linkpdo, $idcritique, $motif){
    $datesig=date("Y-m-d");
    $motif=pg_escape_string($motif);//Echappement des carctères spéciaux
    
    //Recherche du codeutilisateur de l'auteur de la critqueq
    $requete1= "SELECT codeutilisateurcritiquant FROM critique WHERE idcritique='". $idcritique ."'";
    $donnees=pg_exec($linkpdo, $requete1);
    
    if(pg_result_error($donnees)==''){//Si la requete est passée
        $donnees=pg_fetch_all($donnees);
        //Insertion du signalement dans la base de données
        $requete ="INSERT INTO signalement (datesignalement, motifsignalement, idcritique, codeutilisateur) VALUES ('".$datesig."', '".$motif."', '".$idcritique."', '".$donnees[0]['codeutilisateurcritiquant']."')";
        $donnees=pg_exec($linkpdo, $requete);
        
        //Si l'insertion a été effectué
        if(pg_result_error($donnees)==''){
            //Mise à jour du statut de la critique à "signalé"
            $requete2="UPDATE critique SET estsignalee='true' WHERE idcritique='" .$idcritique. "'";
            $donnees=pg_exec($linkpdo, $requete2);
            echo '<p>Signalement effectué</p>';
        }else{
            echo '<p>Erreur dans le traitement de la requete</p>';
        }
    }else{
        echo '<p>Erreur dans le traitement de la requete</p>';
    }
}

//Fonction qui permet d'ignorer un signalement
function ignorer_signalement($linkpdo, $idsignalement){
    $requete="SELECT * FROM signalement WHERE idsignalement='".$idsignalement."'";
    $donnees=pg_exec($linkpdo, $requete);
    $donnees=pg_fetch_all($donnees);
    if(pg_result_error($donnees)==''){
        $idcritique=$donnees[0]['idcritique'];
        $requete2="UPDATE critique SET estsignalee='false' WHERE idcritique='" .$idcritique. "'";
        $donnees=pg_exec($linkpdo, $requete2);

        if(pg_result_error($donnees)==''){
            $requete3="DELETE FROM signalement WHERE idcritique='".$idcritique."' AND idsignalement='".$idsignalement."'";
            $donnees=pg_exec($linkpdo, $requete3);
            echo '<p>Signalement retiré</p>';
        }else{
            echo'<p>Erreur dans le traitement de la requete</p>';
        }
    }else{
        echo'<p>Erreur dans le traitement de la requete</p>';
    }
}
?>