<?php
include 'connexion.php';
include 'fonctions_compte.php';
include '../autoSuggest/autoSuggestSeries.php';//Appel du fichier qui récupère la liste des séries présentes sur le site et les écrit dans le fichier serie.js 
session_start();//Ouverture de session
?>

<header>
    <script type="text/javascript" src="../autoSuggest/autoSuggest.js"></script> <!--Appel du script d'autocomplétion-->
    <script type="text/javascript" src="../autoSuggest/series.js"></script><!--Appel de la liste des séries-->
                
    <!--Menu Principal-->

    <nav class="navigation">
        <ul >
            <li class="logo"><a href="./accueil.php"><img src="../image/nomsite.png" height="50px" ></a></li>
            <li><a href="./serie.php">Série</a></li>
            <li><a href="./rechercheavancee.php">Recherche Avancée</a></li>
            <li><a href="./proposer_Serie.php">Proposer une Série</a></li>

            <?php if ( est_admin() ) { //Affichage du menu pour les admins ?>
                <li class="sous-menu"><a class="" href="./admin.php">Administration</a><!-- Sous menu d'administraion-->
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
        <li>
            
            </li>
            
            <!--Options de connextion/déconnexionn et d'accès au compte perso-->
         <ul class="optionsSecondaires">
            <li> <a href="./aPropos.php"><img src="../image/aide.png" width="18px"></a></li>
            <?php if ( est_connecte() ) {//Affichage du menu pour les utilisateurs connectés
                $PseudoU=$_SESSION['PseudoU'];?>
                <li><a href="<?php echo"compte.php?PseudoU=" . $PseudoU; ?> "><img src="../image/rouage.png" width="20px"></a></li>
                <li> <form class="connexion" name="deconnexion" id="deconnexion" method="post" action="deconnexion.php">
                        <input type="hidden" name="validate" id="validate" value="ko" />
                        <input type="submit" value="Se deconnecter" class="optionsConnexion"/>
                    </form>
                </li>
            <?php } else{ ?>
                <li>
                    <form class="connexion" name="connexion" id="connexion" method="post" action="identification.php">
                        <input type="hidden" name="validate" id="validate" value="ko" />
                        <input type="submit" value="Se connecter" class="optionsConnexion"/>
                    </form>
                </li>
                <li>
                    <form class="connexion" name="inscription" id="inscription" method="post" action="./saisieUser.php">
                        <input type="hidden" name="validate" id="validate" value="ko"/>
                        <input type="submit" value="S'inscrire" class="optionsConnexion"/>
                    </form>
                </li>
            <?php } ?>
        </ul>
            </ul>
    </nav>
    
    <!--Recherche Rapide-->
    <div class="recherche">
    <form id="auto-suggest" action="./resultatRecherche.php" method="get">
            <input type="text" class="search" name="nomserie" value="Rechercher..." onfocus="if(this.value=='Rechercher...')this.value=''" onblur="if(this.value=='')this.value='Rechercher...'" autocomplete="off"/>
        </form>
    </div>
    
</header>