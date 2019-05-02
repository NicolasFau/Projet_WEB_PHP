   <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script> 
<script> 
function supprimer(idcritique){
   var pseudoU= '<?php echo $_SESSION['PseudoU']; ?>';
   if (confirm('Etes-vous sûr de vouloir supprimer cette critique')){
       $.ajax({
           type : "POST",
           url: "fonctions_compte.php",
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
             
    if (modifierType != null){
        modifierType.addEventListener('click', function onOpen() {
        if (typeof dialogMajType.showModal === "function") {
            dialogMajType.showModal();
        } else {
            console.error("L'API dialog n'est pas prise en charge par votre navigateur");
        }
    });
    }
    if (selectEl !=null){
        selectEl.addEventListener('change', function onSelect(e) {
        confirmBtnType.value = selectEl.value;
        });   
    }
    
    if (dialogMajType != null){
        dialogMajType.addEventListener('close', function onClose() {
        var nouveau_type = dialogMajType.returnValue;
        $.ajax({
            type: "POST",
            url: "fonctions_compte.php",
            data: {
                fonction:'modif_type',
                params: {pseudoU, nouveau_type},
                },
                success: function(data)
                {
                    location.reload();
                }
        })
        });
    }
    
       
    var modifierDesc = document.getElementById('modifierDesc');
    var dialogMajDesc = document.getElementById('dialogMajDesc');
    var retourDesc = document.getElementById('retourDesc');
    var textarea = document.getElementsByTagName('textarea')[0];
    var confirmBtn1 = document.getElementById('confirmBtn1');

    if (modifierDesc != null){
        modifierDesc.addEventListener('click', function onOpen() {
        if (typeof dialogMajDesc.showModal === "function") {
            dialogMajDesc.showModal();
        } else {
            console.error("L'API dialog n'est pas prise en charge par votre navigateur");
        }
        });   
    }

     if (dialogMajDesc != null){
        dialogMajDesc.addEventListener('close', function onClose() {
        if ((textarea.value != "") && (textarea.value != " ")){
           var nouvelle_description = textarea.value;
           $.ajax({
            type: "POST",
            url: "fonctions_compte.php",
            data: {
                fonction:'modif_description',
                params: {pseudoU, nouvelle_description},
                },
                success: function(data)
                {
                    location.reload();
                }
            }) 
            }
        });   
     }  
    
       
    var modifierMdp = document.getElementById('modifierMdp');
    var dialogMajMdp = document.getElementById('dialogMajMdp');
    var retourMdp = document.getElementById('retourMdp');
    var verification =document.getElementById('verification');
    var passwordu = document.getElementsByTagName('input')[3];
    var confirmationMdp = document.getElementById('confirmation');
    var confirmBtnMdp = document.getElementById('confirmBtnMdp');
       
    if (modifierMdp !=null){
        modifierMdp.addEventListener('click', function onOpen() {
            if (confirm('Etes vous sûr de vouloir modifier le mot de passe ?')){
                if (typeof dialogMajMdp.showModal === "function") {
                    dialogMajMdp.showModal();
                } else {
                    console.error("L'API dialog n'est pas prise en charge par votre navigateur");   
                }            
            }
        });   
    }
    
    if(confirmBtnMdp !=null){
       confirmBtnMdp.addEventListener('click', function(){
       var mdp = passwordu.value;
       var confirmation_mdp = confirmationMdp.value;
        $.ajax({
            type: "POST",
            url: "fonctions_compte.php",
            data: {
                fonction:'verification_mdp',
                params: {mdp, confirmation_mdp, pseudoU},
                },
                success: function(data)
                {
                    switch (data){
                        case '-1' : 
                            document.getElementById('Type_erreur').innerHTML = 'Champs différents';
                            passwordu.value = "";
                            confirmationMdp.value="";
                            break;
                        case '-2' :
                            document.getElementById('Type_erreur').innerHTML = 'Erreur dans le traitement de la requête';
                            passwordu.value = "";
                            confirmationMdp.value="";
                            break;
                        case '-3':
                            document.getElementById('Type_erreur').innerHTML = 'Il faut une majuscule et un chiffre';
                            passwordu.value = "";
                            confirmationMdp.value="";
                            break;
                        case '0':
                            document.getElementById('Type_erreur').innerHTML = '';
                            $('.btnsubmit').click();
                            retourMdp.value = 'Les changements ont été pris en compte';
                            break;
                    }   
                }
        }) 
        });     
    } 
    
})();
</script>