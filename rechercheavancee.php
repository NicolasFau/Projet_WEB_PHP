<?php
$titre = 'Recherche Avancée';
include 'head.php';
include 'fonctionsDeRecherche.php';
?>
<body>
    <?php
    include 'header.php';
    ?>
    <div class="page">
        <center><h1>Recherche Avancée</h1></center>
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

    
    </div>
<?php
include 'footer.php';
?>
</body>

</html>