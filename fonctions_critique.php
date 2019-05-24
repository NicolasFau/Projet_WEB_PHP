<?php
if (isset($_REQUEST['fonction']) && $_REQUEST['fonction'] != '')//code qui permet l'appel d'une fonction de ce fichier en ajax
{
    $_REQUEST['fonction']($_REQUEST);
}

//Fonction qui permet de critiquer une saison
function effectuer_critique($data){

    include 'connexion.php';
    
    //Recuperation des paramètre passé en ajax
    $note=$_REQUEST['params'] ['note'];
    $avis=$_REQUEST['params'] ['avis'];
    $pseudoU=$_REQUEST['params'] ['pseudoU'];
    $idsaison=$_REQUEST['params'] ['idsaison'];
    
    $date=date("Y-m-d");
    
    //Récupération du code utilisateur de l'utilisateur
    $requete="SELECT codeutilisateur FROM utilisateur WHERE pseudou='$pseudoU'";
    $result=pg_query($linkpdo, $requete);
    $codeutilisateurcritiquant=pg_fetch_result($result, 0);
    
    $avis=pg_escape_string($avis);//echappement des caracteres spéciaux
    
    //Insertion dans la base de la nouvelle critique
    $requete1="INSERT INTO critique (notationcritique, aviscritique, datecritique, estsignalee, codemoderateur, codeutilisateurcritiquant, idsaison) values ('$note', '$avis', '$date', false, 12, '$codeutilisateurcritiquant', '$idsaison')";
    $result=pg_query($linkpdo, $requete1);
    echo $result;
}
?>					