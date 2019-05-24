<?php
include 'head.php';
?>

<body>
    <?php
    //appel des donctions
    include 'header.php';
    include 'fonctionsDeRecherche.php';
if (!est_admin()){
    header('Location: accueil.php');
}
    ?>
    <div class="page">
<h3>Critiques Signalées</h3>
<?php
//appel de la  fonction de connexion
require("connexion.php");

$liste_critiques=rechercher_critiqueSignalees($linkpdo);
if ($liste_critiques != NULL) {
    echo "<form action=\"suppressionCritique.php\" method=\"post\">";
    //Parcour de liste_critiques
    foreach ($liste_critiques as $critique) {
        //affichage des codes utilisateurs et critiques avec checkbox
        echo "Code utilisateur : " . $critique['codeutilisateurcritiquant'] . "<br>";
        echo "Avis critique : " . $critique['aviscritique'] . "<input type=\"checkbox\" name=\"suppr[]\" value=\"" . $critique['idcritique'] . "\">";
        //Requete sql 
        $querymotif = "Select motifsignalement from signalement where idcritique=" . $critique['idcritique'];
        //Requete sur la base
        $result = pg_query($linkpdo, $querymotif);
        //Placement des résultats dans un tableau
        $resulttab = pg_fetch_array($result);
        echo "</br>Motif:</br>";
        //Affichage des résultats
        echo $resulttab['motifsignalement'];
        echo "</br>";
        echo "</br>";
        echo "</br>";


        
    }
        //Affichage des radio boutons
        echo "<div><input type=\"radio\" id=\"dewey\" name=\"choix\" value=\"Laisser\"><label for=\"dewey\">Ignorer</label></div>";
        echo "<div><input type=\"radio\" id=\"dewey\" name=\"choix\" value=\"Supprimer\"><label for=\"dewey\">Supprimer</label></div>";
        //Bouton submit
        echo "<p><input type=\"submit\" value=\"Valider\"></p>";
        echo "</form>";
}else{
    echo "Aucune critique n'est signalee";
}
?>
</div>
     <?php
    include 'footer.php';
    ?>
</body>
