<?php
include 'head.php';
include 'header.php';
include 'fonctionsDeRecherche.php';
?>
    <body>
    <?php
    if (isset($_GET['categorie'])){
        $liste_serie=rechercheParTheme($linkpdo, $_GET['categorie']);
        foreach($liste_serie as $serie){
            echo'<h2>Nom serie : </h2>';
            echo ucfirst($serie['nomserie']);
            echo '</br></br>';
        }
    }
    ?>
    </body>
<?php
include 'footer.php';
?>