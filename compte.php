<?php
$titre='Compte';
include 'head.php';//Appel du head
?>
<body>
    <?php
    include 'header.php';
    if(!est_connecte() || !est_admin()) {header('deconnexion.php');}

    if (isset($_GET['PseudoU']) && isset($_SESSION['PseudoU'])){ //Si le pseudo lié à cette page compte est le même que celui qui est connecté alors il peut effecuter des modifications sur son profil
    if ($_GET['PseudoU']==$_SESSION['PseudoU']){
        $modifs=TRUE;
    }else{
        $modifs=FALSE;
    }
    }else{
        $modifs=FALSE;
    }

    ?>
        <div class="page">
            <center><h1>Profil</h1></center>
            <table style="width: 100%">
                <tr>
                    <td><?php echo "<img src='./image/compte.png' style='float : right; margin-right: 100px; margin-top : 0px;' >" . "<br>" . "<br>"; ?></td>
                    <td><?php
                        $resultats_utilisateur = rechercher_utilisateur($linkpdo, $_GET['PseudoU']);//appel de la foncition de recherche de recherche de l'utilisateur
                        $liste_critiques = rechercher_critiques($linkpdo, $_GET['PseudoU']);////appel de la foncition de recherche de critiques faites par cet utilisateur
                        if($resultats_utilisateur != NULL){//Si l'utilisateur existe
                            foreach ($resultats_utilisateur as $utilisateur){
                        ?>

                    <div><!--infos de l'utilisateur-->  
                        <p>
                            <b><u>Pseudo :</u></b> <?php echo $utilisateur['pseudou'];?>
                        </p>

                        <p>
                            <b><u>Fonction :</u></b> <?php echo $utilisateur['typeu'];
                                if ($modifs){//Affichage du bouton de modification si la page est celle de l'utilisateur connecté
                                    ?> 
                                    <button id="modifierType" style="float:right; margin-top:0px;">Modifier</button>
                        </p>
                                    <dialog id="dialogMajType"> <!--Boite de dialogue qui s'ouvre uniquement quand l'utilisateur presse le bouton modifier -->
                                        <form method="dialog">
                                            <p><label>Modifier le type d'utilisateur:
                                            <select>
                                                <option></option>
                                                <option>Journaliste</option>
                                                <option>Amateur</option>
                                                <option>Réalisateur</option>
                                            </select>
                                            </label></p>
                                            <menu>
                                                <button value="<?php echo $utilisateur['typeu']; ?>">Annuler</button>
                                                <button id="confirmBtnType" value="<?php echo $utilisateur['typeu']; ?>" style="float:right">Confirmer</button>
                                            </menu>
                                        </form>
                                    </dialog>
                                <?php
                                }
                                ?>
                        <p>
                            <b><u>Date de Création du Compte :</u></b> <?php echo $utilisateur['datecreationu']; ?>
                        </p>
                        
                        <p>
                            <b><u>Description :</u></b><br>

                            <?php echo '<div style="width:500px; float:left; overflow:hidden; overflow-wrap:break-word;">'; //div de descritpion de l'utilisateur
                                  echo $utilisateur['descriptionu'];
                                  echo '</div><br>';

                            if ($modifs){//Affichage du bouton de modification si la page est celle de l'utilisateur connecté
                            ?>
                                <button id="modifierDesc" style="float:right; margin-top:0px;">Modifier</button>
                        </p>
                            <dialog id="dialogMajDesc"><!--Boite de dialogue qui s'ouvre uniquement quand l'utilisateur presse le bouton modifier -->
                                <form method="dialog">
                                    <p><label>Modifier la description:</label></p>
                                        <textarea id="description" maxlength="255"><?php echo $utilisateur['descriptionu'];?></textarea>
                                    <menu>
                                        <button value="<?php echo $utilisateur['descriptionu']; ?>">Annuler</button>
                                        <button id="confirmBtn1" value="<?php echo $utilisateur['descriptionu']; ?>">Confirmer</button>
                                    </menu>
                                </form>
                            </dialog>
                            <?php
                            }
                            ?>
                </div>

                <?php
                if($modifs){?>  <!--Modification du mot passe si c est la page de l utilisateur connecté-->
                   <dialog id="dialogMajMdp">
                        <form method="dialog"><!--Boite de dialogue qui s'ouvre uniquement quand l'utilisateur presse le bouton modifier le mot de passe -->
                            <p><label>Modifier le mot de passe :</label></p>
                            <p>Mot de Passe : </p><input type="password" name="PasswordU" value="" required/>
                            <br>
                            <p>Confirmation</p><input type="password" id="confirmation" value="" required/>
                            <div id="Type_erreur"></div>
                            <menu>
                                <button type="cancel" value="<?php echo $utilisateur['passwordu']; ?>">Annuler</button>
                                <button type="button" id="confirmBtnMdp" value="<?php echo $utilisateur['passwordu']; ?>">Confirmer</button>
                                <input class='btnsubmit' type='submit' value='Envoyer' style="display:none">
                            </menu>
                        </form>
                    </dialog>
                    <br>
                    <br>
                    <menu>
                        <button id="modifierMdp" style="width:150px">Modifier le mot de passe</button>
                    </menu>
                <?php
                }
                ?>
                </td>
            </tr>
        </table>

                            <!--Affichage des critique faites par l'ulisateur-->

        <h2>Critiques</h2><hr>
            <?php      
            if ($liste_critiques != NULL){// Si la liste n'est pas vide (si l'utilisateur a fait des critiques)
                $i=0; //numéro de la critique
                foreach($liste_critiques as $critique){//Recherche de infos sur la saison et la serie pour chaque critque de la liste des critiques 
                    $donnees=rechercher_saison_critique($linkpdo, $critique['idsaison']);
                    foreach($donnees as $saison){ // Affichage de la critique  
                        echo 'Saison '.$saison['numérosaison'] . ' de <a href="./afficherSerie.php?nomserie='.$saison['nomserie'].'">' .$saison['nomserie'] . '</a><br>le ' . $critique['datecritique'] . '</br>';
                        echo '  ' . $critique['aviscritique'] . '</br>';

                        if($modifs){ //Suppression de la critique possible si c est la page de l utilisateur connecté
                            echo '<button name="supp" style="float: right;" id="supprimerCritique' . $i . '" class="suppimer" value="' . $critique['idcritique'] . '" onclick="supprimer(\''. $critique['idcritique'] . '\');">Supprimer </button> </br> </br>'; //Si le bouton est pressé appelle de la fonction de supression de la critique
                            $i++;
                            }    
                        }
                    echo '<hr>';
                }
            }else{
                if ($modifs){//Si c'est la page de l'utilisateur connecté et qu'aucune critique n'a été faite
                    echo 'Vous n\'avez encore fait aucune critique';
                }else{//Si ce n'est la page de l'utilisateur connecté et qu'aucune critiqun'a été faite
                    echo 'Aucun critique n\'est associée à cet utilisateur';
                }
            }
        }
    }else{
        echo 'Cet utilisateur n\'existe pas';                        
    }

    include 'dialogModifs.js'; //appel de la page contenant les scripts de modification et de suppression

    ?>
    </div>   
    <?php
        include 'footer.php';//Appel du footer
    ?>
</body>