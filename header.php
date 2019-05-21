<?php

include 'connexion.php';
include 'fonctions_compte.php';
include 'autoSuggest/autoSuggestSeries.php';

session_start();
?>

<header>
    <script type="text/javascript" src="./autoSuggest/autoSuggest.js"></script>
    <script type="text/javascript" src="./autoSuggest/series.js"></script>

    <a href="./accueil.php"><img src="./image/logo.png" width="150px" ></a>
    <div class="options">
        <ul class="optionsSecondaires">
            <li> <a href="./aPropos.php"><img src="./image/aide.png" width="20px"></a></li>
            <?php if ( est_connecte() ) {
                $PseudoU=$_SESSION['PseudoU'];?>
                <li><a href="<?php echo"compte.php?PseudoU=" . $PseudoU; ?> "><img src="./image/rouage.png" width="20px"></a></li>
                <li> <form name="deconnexion" id="deconnexion" method="post" action="deconnexion.php">
                        <input type="hidden" name="validate" id="validate" value="ko" />
                        <input type="submit" value="Se deconnecter" class="optionsConnexion"/>
                    </form>
                </li>
            <?php } else{ ?>
                <li>
                    <form name="connexion" id="connexion" method="post" action="identification.php">
                        <input type="hidden" name="validate" id="validate" value="ko" />
                        <input type="submit" value="Se connecter" class="optionsConnexion"/>
                    </form>
                </li>
                <li>
                    <form name="inscription" id="inscription" method="post" action="./saisieUser.php">
                        <input type="hidden" name="validate" id="validate" value="ko"/>
                        <input type="submit" value="S'inscrire" class="optionsConnexion"/>
                    </form>
                </li>
            <?php } ?>
        </ul>

        <form id="auto-suggest" action="./resultatRecherche.php" method="get">
            <input type="text" class="search" name="nomserie" value="Rechercher..." onfocus="if(this.value=='Rechercher...')this.value=''" onblur="if(this.value=='')this.value='Rechercher...'" autocomplete="off"/>
        </form>


    </div>
    <nav>
        <ul >
            <li><a href="./accueil.php">Accueil</a></li>
            <li><a href="./serie.php">Série</a></li>
            <li><a href="./rechercheavancee.php">Recherche Avancée</a></li>
            <li><a href="./proposer_Serie.php">Proposer une Série</a></li>

            <?php if ( est_admin() ) { ?>
                <li class="sous-menu"><a class="" href="./admin.php">Administration</a>
                    <div class="contenu-sous-menu">
                        <a href="./ajoutserie.php">Ajouter une Série</a>
                        <a href="./ajoutsaison.php">Ajouter une Saison</a>
                        <a href="./ajoutepisode.php">Ajouter un épisode</a>
                        <a href="./ajoutacteur.php">Ajouter un acteur</a>
                        <a href="./ajoutrealisateur.php">Ajouter un realisateur</a>
                        <a href="./ajoutprix.php">Ajouter un prix</a>
                        <a href="./supprimerUtilisateur.php">Supprimer un utilisateur</a>
                        <a href="./admin.php">Voir les critiques signalées</a>
                    </div></li>
            <?php }  ?>
        </ul>
    </nav>
</header>