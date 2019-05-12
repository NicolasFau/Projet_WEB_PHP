<?php

$requete='SELECT nomserie From Serie';
$result = pg_exec($linkpdo, $requete);
$donnees = pg_fetch_all($result);


$nb=count($donnees);
$file = fopen((__DIR__ ). '/../autoSuggest/series.js', 'r+');
$titres="var motsClefs = [";

for($i=0 ; $i<$nb ; $i++){
    $titres= $titres . "'" . $donnees[$i]['nomserie'] . "', \r\n";

}
$titres = $titres . "];" ;
fputs($file, $titres);
fclose($file);

?>