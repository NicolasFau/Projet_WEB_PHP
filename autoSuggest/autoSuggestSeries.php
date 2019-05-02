<?php
/*
$result = $linkpdo->prepare('SELECT nomserie FROM Serie ');
$result->execute();
$donnees = $result->fetchAll();
*/

    $requete='SELECT nomserie From Serie';
    $result = pg_exec($linkpdo, $requete);
    $donnees = pg_fetch_all($result);


$nb=count($donnees);
$file = fopen('./autoSuggest/series.js', 'r+');
$titres="var motsClefs = [";

for($i=0 ; $i<$nb ; $i++){
    $titres= $titres . "'" . $donnees[$i]['nomserie'] . "', \r\n";

}
$titres = $titres . "];" ;
fputs($file, $titres);
fclose($file);

?>