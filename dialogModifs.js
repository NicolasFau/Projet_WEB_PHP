<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script> 
<script> 

    //Fonction qui permet la suppression d'une critique
    function supprimer(idcritique){
        var pseudoU= '<?php echo $_SESSION['PseudoU']; ?>';
        if (confirm('Etes-vous sûr de vouloir supprimer cette critique')){ //Demande de confirmation de la suppression Si oui poursuite du processus de suppression
            $.ajax({ //Appel de la fonction de suppression en ajax
                type : "POST",
                url: "fonctions_compte.php",
                data:{
                    fonction:'supprimer_critique',
                    params: {pseudoU, idcritique}, //Passage des paramètres
                    },
                    success: function(data)
                    {
                        alert(data); //Affichage du retour de la fonction supprimer_critique()
                        location.reload(); //Mise à jour de la page
                    }
            }); 
        }                    
    }

    (function() {
    
                    /*-----------TRAITEMENT MODIFICATION TYPE UTILISATEUR-------------*/
    
        var pseudoU= '<?php echo $_SESSION['PseudoU']; ?>'; //Récupération du pseudo
        var modifierType = document.getElementById('modifierType');//Bouton de modification du type d'utilisateur
        var dialogMajType = document.getElementById('dialogMajType');//Boite de dialogue
        var selectEl = document.getElementsByTagName('select')[0];//Menu de selection du type d'utilisateur
        var confirmBtnType = document.getElementById('confirmBtnType');//Bouton de confirmation
             
        if (modifierType != null){ //Si le bouton modifier existe
            modifierType.addEventListener('click', function onOpen() { //Lorsque le bouton est pressé
            if (typeof dialogMajType.showModal === "function") {//Vérification de la prise en charge des boites de dialogue
                dialogMajType.showModal();
            } else {
                console.error("L'API dialog n'est pas prise en charge par votre navigateur");
            }
            });
        }
    
        if (selectEl !=null){//Si un élément a été sélectionné
            selectEl.addEventListener('change', function onSelect(e) {//Lorsque la valeur change
                confirmBtnType.value = selectEl.value;//Le bouton de confirmation prends la valeur de la séléction
            });   
        }
    
        if (dialogMajType != null){
            dialogMajType.addEventListener('close', function onClose() {//Lorsque la boite de dialogue se ferme
                var nouveau_type = dialogMajType.returnValue;//la variable prends la valeur de la séléction faite par l'utilisateur
                $.ajax({//Appel de la fonction de mise à jour du type d'utilisateur en ajax
                    type: "POST",
                    url: "fonctions_compte.php",
                    data: {
                        fonction:'modif_type',
                        params: {pseudoU, nouveau_type}, //Passage des variables à la fonction
                        },
                        success: function(data)
                        {
                            location.reload();//En cas de réussite rafraichissement de la page
                        }
                })
            });
        }
    
    
    
                    /*-----------TRAITEMENT MODIFICATION DESCRIPTION UTILISATEUR-------------*/

        var modifierDesc = document.getElementById('modifierDesc');//Bouton de modification de la description
        var dialogMajDesc = document.getElementById('dialogMajDesc');//Boite de dialogue
        var textarea = document.getElementsByTagName('textarea')[0];//Zone de texte
        var confirmBtn1 = document.getElementById('confirmBtn1');//Bouton de confirmation

        if (modifierDesc != null){//Si le bouton modifier existe
            modifierDesc.addEventListener('click', function onOpen() {//Lorsque le bouton est pressé
            if (typeof dialogMajDesc.showModal === "function") {//Vérification de la prise en charge des boites de dialogue
                dialogMajDesc.showModal();
            } else {
                console.error("L'API dialog n'est pas prise en charge par votre navigateur");
            }
            });   
        }

        if (dialogMajDesc != null){ 
            confirmBtn1.addEventListener('click', function(){//Lorsque le bouton de confirmation est pressé
                if ((textarea.value != "") && (textarea.value != " ")){//Si la zone de texte n'est pas vide
                    var nouvelle_description = textarea.value; //Recuperation du contenu de la zone de texte
                    $.ajax({//Appel de la fonction de modification de la description en ajax
                        type: "POST",
                        url: "fonctions_compte.php",
                        data: {
                            fonction:'modif_description',
                            params: {pseudoU, nouvelle_description},//Passage des variables à la fonction
                        },
                        success: function(data)
                        {
                            location.reload();//Si l'appel à focntionné rafraichissement de la page
                        }
                    }) 
                }        
            });
        }  
    
    
    
    
                    /*-----------TRAITEMENT MODIFICATION MOT DE PASSE-------------*/

        var modifierMdp = document.getElementById('modifierMdp');//Bouton de modification du mot de passe
        var dialogMajMdp = document.getElementById('dialogMajMdp');//Boite de dialogue
        var retourMdp = document.getElementById('retourMdp');//Zone de texte où les retours sont affiché
        var passwordu = document.getElementsByTagName('input')[3];//nouveau mot de passe
        var confirmationMdp = document.getElementById('confirmation');//confirmation du nouveau mot de passe
        var confirmBtnMdp = document.getElementById('confirmBtnMdp');//Bouton pour confirmer le changement

        if (modifierMdp !=null){//Si le bouton modifier existe
            modifierMdp.addEventListener('click', function onOpen() {//Lorsque le bouton est pressé
                if (confirm('Etes vous sûr de vouloir modifier le mot de passe ?')){
                    if (typeof dialogMajMdp.showModal === "function") {//Vérification de la prise en charge des boites de dialogue
                        dialogMajMdp.showModal();
                    } else {
                        console.error("L'API dialog n'est pas prise en charge par votre navigateur");   
                    }            
                }
            });   
        }
    
        if(confirmBtnMdp !=null){
           confirmBtnMdp.addEventListener('click', function(){
           var mdp = passwordu.value;//Valeur du champ nouveau mdp
           var confirmation_mdp = confirmationMdp.value; //valeur du champ confirmation mdp
            $.ajax({
                type: "POST",
                url: "fonctions_compte.php",
                data: {
                    fonction:'verification_mdp', //appel de la fonction de vérification du mdp qui appelera la fonction de modification mdp
                    params: {mdp, confirmation_mdp, pseudoU},
                    },
                    success: function(data)
                    {
                        var retour= data;
                        retour = parseInt(retour);//Traduction du retour en int

                        switch(retour){// En fonction du retour de la fonction de modification de mdp
                            case -1 : //Champ différent
                                document.getElementById('Type_erreur').innerHTML = 'Champs différents';//Ecriture de l'erreur dans la boite de dialogue
                                passwordu.value = "";//Champ vidé
                                confirmationMdp.value="";//Champ vidé
                                break;
                            case -2 ://Erreur de traitement
                                document.getElementById('Type_erreur').innerHTML = 'Erreur dans le traitement de la requête';//Ecriture de l'erreur dans la boite de dialogue
                                passwordu.value = "";//Champ vidé
                                confirmationMdp.value="";//Champ vidé
                                break;
                            case -3:// Mdp non conforme
                                document.getElementById('Type_erreur').innerHTML = 'Il faut une majuscule et un chiffre';//Ecriture de l'erreur dans la boite de dialogue
                                passwordu.value = "";//Champ vidé
                                confirmationMdp.value="";//Champ vidé
                                break;
                            case 0:// Mdp modifié
                                document.getElementById('Type_erreur').innerHTML = '';
                                $('.btnsubmit').click();
                                alert('Les changements ont été pris en compte');//Affichage message succes
                                break;
                        }   
                    }
            }) 
            });     
        } 

})();
</script>