<?php
include 'head.php';
include 'header.php';
include 'fonctionsDeRecherche.php';
$titre = 'Rasultat recherche';
?>
<body>
<form action="resultatRecherche.php" method="get">
    <p>Nom de la serie<br><input type="text" name="nomserie"/></p>
    <p>Selectionnez une categorie <br>
        <select name="categorie" >
            <option value=""></option>
            <?php
            $liste_categorie=listeTheme($linkpdo);
            foreach($liste_categorie as $categorie){
                echo '<option value="'.$categorie['themeserie'].'">'.$categorie['themeserie'].'</option>';
            }
            ?>
        </select></p>
    <p>Nombre de saison minimum<br><input type="number" name="nbsaison" min="0" max="100"/></p>


    <p><input type="submit" value="Rechercher"></p>
</form>

</body>
<?php
include 'footer.php';
?>
</html>