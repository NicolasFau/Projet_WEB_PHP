<?php
    //Récupération de la liste des séries présentes dans la base de données
    $requete='SELECT nomserie From Serie';
    $result = pg_exec($linkpdo, $requete);
    $donnees = pg_fetch_all($result);
    $nb=count($donnees); //Nombre de séries trouvées


    $file = fopen((__DIR__ ). '/../autoSuggest/series.js', 'r+');//Ouverture du fichier serie.js
    ftruncate($file,0);//Suppression du contenu du fichier (utilise lorsqu'une série a été supprimée de la base) 

    $titres="var motsClefs = [";
    
    for($i=0 ; $i<$nb ; $i++){//Pour chaque série on concatène avec le nom de série suivant
        $titres= $titres . "\"" . $donnees[$i]['nomserie'] . "\", \r\n";
    }
    
    $titres = $titres . "];" ;
    fputs($file, $titres);//Ecriture dans le fichier de la variable contenant tout les titres
    fclose($file);//fermeture du fichier
?>