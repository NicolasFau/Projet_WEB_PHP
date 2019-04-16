<?php
//Récupération des vriables
$nomSerie=$_POST['nomsaison'];
$numeroSaison=$_POST['num'];
$listeSerie=$_POST['listeSerie'];
echo $nomSerie;
echo $numeroSaison;
echo $listeSerie;
//Connection à la base de donnée
$n="postgres";
$u="postgres";
$p="123456789";
$connect=pg_connect("dbname=$n user=$u password=$p");
$queryNomserie="Select nomserie from serie";
$resulatNomListe=pg_exec($connect, $query);
//datalist dynamique

if(!$resulatNomListe){
		echo  "erreur";
  }
	else{
		while( $row = $resulatNomListe->fetch_object() )
			echo "<option value='".$row->name."'>";
}

//Insertion du numéro de la Saison
$queryNomserie=pg_insert($connect, 'Saison', $numeroSaison, PG_DML_ESCAPE);
if ($queryNomserie) {
    echo "Les données POSTées ont pu être enregistrées avec succès.\n";
} else {
    echo "Il y a un problème avec les données.\n";
}


 ?>
