<?php
//$_SESSION['PseudoU'] = 'Reda';
//$_SESSION['estAdministrateur'] = true;

?>

<header class="">
    <link rel="stylesheet" href="./css/css.css">
    
        <a class="" href="/accueil.php"><img src="./image/logo.png"></a>
    <div>
        <ul class="optionsSecondaires">            
            <?php if ( est_connecte() ) { ?>
                <li><a class="" href="/deconnexion.php">Déconnexion</a></li>
                <li><a class="" href="/compte.php"><img src="./image/rouage.png" width="20px"></a></li>
            <?php } else{ ?>
                <li><a class="" href="/connexion.php">Connexion  </a></li>
                <li><a class="" href="/inscription.php"> Inscription</a></li>
            <?php } ?>
        </ul>    </div>
        <div><ul class="rechercheRapide">
            <li><a class="" href="/aide.php"><img src="./image/aide.png" width="20px"></a></li>
            <li><div id="barre-recherche">
                <form class="" action="/recherche.php" method="get">
                        <input id="" type="text" class="" name="recherche" placeholder="Nom de la série"/>
                        <input class="" type="submit" value="Rechercher" />
            </form>
            </div></li>


            </ul></div>
    <div><nav>    
        <ul >
            
            <li><a href="/accueil.php">Accueil</a></li>
            <li><a href="/serie.php">Série</a></li>
            <li><a href="/rechercheAvancee.php">Recherche Avancée</a></li>
            <li><a href="/propserSerie.php">Proposer une Série</a></li>  
            <?php if ( est_admin() ) { ?>
                    <li class="sous-menu"><a class="" href="/administration.php">Administration</a>
                    <div class="contenu-sous-menu">
                    <a href="./ajouterSerie.php">Ajouter une Série</a>
                    <a href="./ajouterSaison.php">Ajouter une Saison</a>
                    </div></li>
            <?php } ?>
            
        </ul>
    </nav>
    </div>
        
    
</header>


<?php


    function est_connecte(){
        if (isset($_SESSION['PseudoU'])){
            return true;
        }
        return false;
    }

    function est_admin() {
    if ( est_connecte() ) {
        if ( $_SESSION['estAdministrateur'] ) {
            return true;
        }
    }
    return false;
}


?>