<?php
if (isset($_REQUEST['fonction']) && $_REQUEST['fonction'] != '')
{
    $_REQUEST['fonction']($_REQUEST);
}
function effectuer_critique($data){

    include '../connexion.php';
    $note=$_REQUEST['params'] ['note'];
    $avis=$_REQUEST['params'] ['avis'];
    $pseudoU=$_REQUEST['params'] ['pseudoU'];
    $idsaison=$_REQUEST['params'] ['idsaison'];
    $date=date("Y-m-d");
    $requete="SELECT codeutilisateur FROM utilisateur WHERE pseudou='$pseudoU'";
    $result=pg_query($linkpdo, $requete);
    $codeutilisateurcritiquant=pg_fetch_result($result, 0);
    $avis=pg_escape_string($avis);
    $requete1="INSERT INTO critique (notationcritique, aviscritique, datecritique, estsignalee, codemoderateur, codeutilisateurcritiquant, idsaison) values ('$note', '$avis', '$date', false, 12, '$codeutilisateurcritiquant', '$idsaison')";
    $result=pg_query($linkpdo, $requete1);
    echo $result;
}
?>					