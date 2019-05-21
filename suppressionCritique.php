<?php
//print_r($_POST);

require("connexion.php");

$tab =$_POST['suppr'];
if($_POST['choix']=='Supprimer'){
    foreach($tab as $value){
        $querycritique="DELETE FROM critique WHERE idcritique='".$value."'";
        $querysignalement="DELETE FROM signalement WHERE idcritique='".$value."'";
        pg_query($linkpdo,$querysignalement);
        pg_query($linkpdo,$querycritique);
    }
}
if($_POST['choix']=='Laisser'){
    foreach($tab as $value){
        $querycritique="UPDATE critique SET estsignalee='false'  WHERE idcritique='".$value."'";
        $querysignalement="DELETE FROM signalement WHERE idcritique='".$value."'";
        pg_query($linkpdo,$querysignalement);
        pg_query($linkpdo,$querycritique);
    }
}
header('Location: admin.php');
?>
