<body>
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
    <div class="page">
                    <center><h1>Profil</h1></center>

         <table style="width: 100%">
                        <tr>
                            <td><?php
                    echo "<img src='./image/compte.png' style='float : right; margin-right: 100px; margin-top : 0px;' >" . "<br>" . "<br>";
                    
                       ?>
                            </td>
                            <td><?php
    $resultats_utilisateur = rechercher_utilisateur($linkpdo, $_GET['PseudoU']);
    $liste_critiques = rechercher_critiques($linkpdo, $_GET['PseudoU']);
    if($resultats_utilisateur != NULL){
        foreach ($resultats_utilisateur as $utilisateur){
            ?>
      <div>  
          <p><b><u>Pseudo :</u></b>
               
                    <?php
                    echo $utilisateur['pseudou'];
                    ?>
                </p>
    
            <p><b><u>Fonction :</u></b> 
    
                <?php
                    echo $utilisateur['typeu'];
                    
                    if ($modifs){
                        ?> 
                <button id="modifierType" style="float:right; margin-top:0px;">Modifier</button></p>

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
                                    <button id="confirmBtnType" value="<?php echo $utilisateur['typeu']; ?>" style="float:right">Confirmer</button>
                                </menu>
                            </form>
                        </dialog>
                        <output id="retourType" aria-live="polite"></output>
                        <?php
                            }
                        ?>
    
            <p><b><u>Date de Création du Compte :</u></b> 
    
                    <?php
                        echo $utilisateur['datecreationu'];
                    ?>
                </p>
    
            <p><b><u>Description :</u></b> <br>
    
                <?php
            echo '<div style="width:500px; float:left; overflow:hidden; overflow-wrap:break-word;">';
                    echo $utilisateur['descriptionu'];
                        echo '</div><br>';

                    if ($modifs){
                        ?>
                                      <button id="modifierDesc" style="float:right; margin-top:0px;">Modifier</button></p>



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
                        <output id="retourDesc" aria-live="polite"></output>
                        <?php
                    }
                ?>
    </div>
    
                <!--Modification du mot passe si c est la page de l utilisateur connecté-->

        <?php
        if($modifs){?>
                               
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
                        <br>
                        <br>
                        <menu>
                            <button id="modifierMdp" style="width:150px">Modifier le mot de passe</button>
                        </menu>
                        <output id="retourMdp" aria-live="polite"></output>

        <?php
        }
        ?>
                            </td>
                        </tr>
                        </table>
         
    
            <h2>Critiques</h2>
            <hr>
    
                <?php      
                if ($liste_critiques != NULL){
                    ?>
                    <output id="retourCritique" aria-live="polite"></output>
                    <?php
                    $i=0;
                    foreach($liste_critiques as $critique){
                        $donnees=rechercher_saison_critique($linkpdo, $critique['idsaison']);
                        foreach($donnees as $saison){   
                            echo 'Saison '.$saison['numérosaison'] . ' de <a href="./afficherSerie.php?nomserie='.$saison['nomserie'].'">' .$saison['nomserie'] . '<a/><br>le ' . $critique['datecritique'] . '</br>';
                            echo '  ' . $critique['aviscritique'] . '</br>';
                            
                            if($modifs){
                                echo '<button name="supp" style="float: right;" id="supprimerCritique' . $i . '" class="suppimer" value="' . $critique['idcritique'] . '" onclick="supprimer(\''. $critique['idcritique'] . '\');">Supprimer </button> </br> </br>';
                            $i++;
                            }    
                        }
                        echo '<hr>';
                    }
                }else{
                    if ($modifs){
                        echo 'Vous n\'avez encore fait aucune critique';
                    }else{
                        echo 'Aucun critique n\'est associée à cet utilisateur';
                    }
                }
            }
        }
    
    include 'dialogModifs.js';

        ?>

    </div>
   

<?php
include 'footer.php';
?>
</body>