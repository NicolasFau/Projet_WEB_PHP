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
                <select name="categorie" id="menu" ><!--Menu déroulant de choix de catégories présentes dans la bd -->
                    <option value=""></option>
                    <?php
                        $liste_categorie=listeTheme($linkpdo);//Récupération de la liste des catégories dans la BD
                        foreach($liste_categorie as $categorie){ //Pour chaque catégorie on affiche une option
                            echo '<option value="'.$categorie['themeserie'].'">'.$categorie['themeserie'].'</option>';
                        }
                    ?>
                </select>
            </p>
            <p>Nombre de saison minimum<br><input type="number" name="nbsaison" id="spinner" min="0"/></p>
            <p><input type="submit" value="Rechercher"></p>
        </form>
    </div>
    <?php
        include 'footer.php';
    ?>
    <!--JQuery de style-->
    <script>
        $( function() {
        $( "#menu" ).selectmenu();
	   var spinner = $( "#spinner" ).spinner();
        });
    </script>
</body>
</html>