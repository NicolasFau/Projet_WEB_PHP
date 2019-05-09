<?php
    include 'head.php';
    include 'header.php';
    include 'fonctionsDeRecherche.php';
    $titre = 'accueil';
?>
<body>

            

            <center><img src="image/allocine.png" style="width: 30%;" /></center>
            <center><h1>Bienvenue sur le site de critique d'oeuvres</h1></center>
    <?php
    echo ' <h2>Recherche rapide par catégorie : </h2>';
    $liste_categorie=listeTheme($linkpdo);
    foreach($liste_categorie as $liste){
        echo '<a href=\'recherche.php?categorie='.$liste['themeserie'].'\'>'.$liste['themeserie'].'</a>';
    }
    ?>

</body>