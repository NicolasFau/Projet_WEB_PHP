<?php
include 'head.php';
include 'header.php';
if(!est_connecte() || !est_admin()) {header('deconnexion.php');}
if (isset($_GET['PseudoU']) && isset($_SESSION['PseudoU'])){
if ($_GET['PseudoU']==$_SESSION['PseudoU']){
    $modifs=TRUE;
}else{
    $modifs=FALSE;
}
}else{
    $modifs=FALSE;
}

?>


<body>
    
    <?php
    $resultats_utilisateur = rechercher_utilisateur($linkpdo, $_GET['PseudoU']);
    $liste_critiques = rechercher_critiques($linkpdo, $_GET['PseudoU']);
    if($resultats_utilisateur != NULL){
        foreach ($resultats_utilisateur as $utilisateur){
            ?>
            <h1>Profil</h1>
    
            <h2>Pseudo</h2>
    
                <p>
                    <?php
                    echo $utilisateur['pseudou'];
                    ?>
                </p>
    
            <h2>Fonction</h2>
    
                <?php
                    echo $utilisateur['typeu'];
                    if ($modifs){
                        ?> 
                        <dialog id="dialogMajType">
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
                                    <button id="confirmBtnType" value="<?php echo $utilisateur['typeu']; ?>">Confirmer</button>
                                </menu>
                            </form>
                        </dialog>
                        <menu>
                            <button id="modifierType">Modifier</button>
                        </menu>
                        <output id="retourType" aria-live="polite"></output>
                        <?php
                            }
                        ?>
    
            <h2>Date de Création du Compte</h2>
    
                <p>
                    <?php
                        echo $utilisateur['datecreationu'];
                    ?>
                </p>
    
            <h2>Description</h2>
    
                <?php
                    echo $utilisateur['descriptionu'];                
                    if ($modifs){
                        ?>
                        <dialog id="dialogMajDesc">
                            <form method="dialog">
                                <p><label>Modifier la description:</label></p>
                                    <textarea id="description" maxlength="255"></textarea>
                                
                                <menu>
                                    <button value="<?php echo $utilisateur['descriptionu']; ?>">Annuler</button>
                                    <button id="confirmBtn1" value="<?php echo $utilisateur['descriptionu']; ?>">Confirmer</button>
                                </menu>
                            </form>
                        </dialog>
                        <menu>
                            <button id="modifierDesc">Modifier</button>
                        </menu>
                        <output id="retourDesc" aria-live="polite"></output>
                        <?php
                    }
                ?>
    
    
                <!--Modification du mot passe si c est la page de l utilisateur connecté-->

        <?php
        if($modifs){?>
            <h2>Mot de Passe</h2>
               <dialog id="dialogMajMdp">
                            <form method="dialog">
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
                        <menu>
                            <button id="modifierMdp">Modifier</button>
                        </menu>
                        <output id="retourMdp" aria-live="polite"></output>

        <?php
        }
        ?>
            <h2>Critiques</h2>
    
                <?php      
                if ($liste_critiques != NULL){
                    ?>
                    <output id="retourCritique" aria-live="polite"></output>
                    <?php
                    $i=0;
                    foreach($liste_critiques as $critique){
                        $donnees=rechercher_saison_critique($linkpdo, $critique['idsaison']);
                        foreach($donnees as $saison){   
                            echo 'Critique faite sur la saison ' . $saison['numérosaison'] . ' de la série ' . $saison['nomserie'] . ' le ' . $critique['datecritique'] . '</br>';
                            echo '  ' . $critique['aviscritique'] . '</br>';
                            
                            if($modifs){
                                echo '<button name="supp" id="supprimerCritique' . $i . '" class="suppimer" value="' . $critique['idcritique'] . '" onclick="supprimer(\''. $critique['idcritique'] . '\');">Supprimer cette critique</button> </br> </br>';
                            $i++;
                            }    
                        }
                    }
                }else{
                    echo 'Aucun critique n\'est associée à cet utilisateur';
                }
            }
        }
    
    include 'dialogModifs.js';

        ?>

</body>
<?php
include 'footer.php';
?>