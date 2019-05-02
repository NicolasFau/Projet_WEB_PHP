<?php
//import des fonction
require("connexion.php");
//Récupération des variables
$serie=$_POST['listeSerie'];
$prix=$_POST['listePrix'];
//Connexion à la base de donnée
$connect=$linkpdo;
$queryid="SELECT * FROM prixdecerne WHERE nomprix='$prix'";

$idresult=pg_query($connect,$queryid);
$idligne=pg_fetch_array($idresult);
$id=$idligne['idprix'];
echo $id;

//Requete
$query="INSERT INTO decerner(nomserie,idrealisateur)
        VALUES('$serie','$prix')";
//Réalisation de la requete
$queryupdate=pg_connect($connect,$query);
//Controle sur la requete
if ($insert) {
    echo "Succès.\n";
} else {
    echo "Echec\n";
}


 ?>
