   <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script> 
<script> 
function supprimer(idcritique){
   var pseudoU= '<?php echo $_SESSION['PseudoU']; ?>';
   if (confirm('Etes-vous sûr de vouloir supprimer cette critique')){
       $.ajax({
           type : "POST",
           url: "modifs_compte.php",
           data:{
                fonction:'supprimer_critique',
                params: {pseudoU, idcritique},
                },
                success: function(data)
                {
                    alert(data);
                }
       }); 
    }                    
}

(function() {
    var pseudoU= '<?php echo $_SESSION['PseudoU']; ?>';   
    var modifierType = document.getElementById('modifierType');
    var dialogMajType = document.getElementById('dialogMajType');
    var retourType = document.getElementById('retourType');
    var selectEl = document.getElementsByTagName('select')[0];
    var confirmBtnType = document.getElementById('confirmBtnType');
             
    // Le bouton "modifier" ouvre la boîte de dialogue
    modifierType.addEventListener('click', function onOpen() {
        if (typeof dialogMajType.showModal === "function") {
            dialogMajType.showModal();
        } else {
            console.error("L'API dialog n'est pas prise en charge par votre navigateur");
        }
    });
    // Le champ "animal préféré" définit la valeur pour le bouton submit
    selectEl.addEventListener('change', function onSelect(e) {
        confirmBtnType.value = selectEl.value;
    });
    // Le bouton "Confirmer" déclenche l'évènement "close" sur le dialog avec [method="dialog"]
    dialogMajType.addEventListener('close', function onClose() {
        var nouveau_type = dialogMajType.returnValue;
        $.ajax({
            type: "POST",
            url: "modifs_compte.php",
            data: {
                fonction:'modif_type',
                params: {pseudoU, nouveau_type},
                },
                success: function(data)
                {
                    if (retourType.value == ''){
                        retourType.value += data;
                    }
                }
        })
    });
       
    var modifierDesc = document.getElementById('modifierDesc');
    var dialogMajDesc = document.getElementById('dialogMajDesc');
    var retourDesc = document.getElementById('retourDesc');
    var textarea = document.getElementsByTagName('textarea')[0];
    var confirmBtn1 = document.getElementById('confirmBtn1');

    // Le bouton "mettre à jour les détails" ouvre la boîte de dialogue
    modifierDesc.addEventListener('click', function onOpen() {
    if (typeof dialogMajDesc.showModal === "function") {
        dialogMajDesc.showModal();
    } else {
        console.error("L'API dialog n'est pas prise en charge par votre navigateur");
    }
    });
       
    // Le bouton "Confirmer" déclenche l'évènement "close" sur le dialog avec [method="dialog"]
    dialogMajDesc.addEventListener('close', function onClose() {
    var nouvelle_description = textarea.value;
    $.ajax({
            type: "POST",
            url: "modifs_compte.php",
            data: {
                fonction:'modif_description',
                params: {pseudoU, nouvelle_description},
                },
                success: function(data)
                {
                    if (retourDesc.value == ''){
                        retourDesc.value += data;
                    }
                }
            })
    });
       
    var modifierMdp = document.getElementById('modifierMdp');
    var dialogMajMdp = document.getElementById('dialogMajMdp');
    var retourMdp = document.getElementById('retourMdp');
    var verification =document.getElementById('verification');
    var passwordu = document.getElementsByTagName('input')[3];
    var confirmationMdp = document.getElementById('confirmation');
    var confirmBtnMdp = document.getElementById('confirmBtnMdp');
    var val_pwd_origin = passwordu.value;
    var val_cfm_origin = confirmationMdp.value;
    // Le bouton "mettre à jour les détails" ouvre la boîte de dialogue
        
    modifierMdp.addEventListener('click', function onOpen() {
        if (typeof dialogMajMdp.showModal === "function") {
            dialogMajMdp.showModal();
        } else {
            console.error("L'API dialog n'est pas prise en charge par votre navigateur");   
        } 
    });
    confirmBtnMdp.addEventListener('click', function(){
       if(confirmationMdp.value == passwordu.value){
            dialogMajMdp.addEventListener('close', function onClose() {
                $.ajax({
                        type: "POST",
                        url: "modifs_compte.php",
                        data: 'nouveau_mdp=' + passwordu.value
                    })
                    if (retourMdp.value == ''){
                        retourMdp.value += "Rafraichissez la page pour voir les modifications ";
                    }
                });
           }else{
               if (verification.value == ''){
                    verification.value = "Les champs ne sont pas identiques";
               }
               confirmationMdp.value == val_cfm_origin;
               passwordu.value = val_pwd_origin;
           } 
       });
    })();
</script>