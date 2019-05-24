<?php
include 'head.php';
include 'header.php';
include 'fonctions_signalement.php';
?>
<body>
    <div class="page">
        <center><h1>Signaler</h1></center>
        <fieldset>
            <form method="post"><!--Formulaire de signalement-->
                <label>Motif du signalement:</label><br>
                <textarea name="motif" id ="avis" required></textarea><br>
                <input type="submit" value ="Envoyer">
            </form>
        </fieldset>
        <?php
            if (isset($_GET['idcritique'])){//Si le numéro de la critique à signaler a été récupéré
                if (isset($_POST['motif'])){//Si un motif a été laissé
                    $signalement=signaler_critique($linkpdo, $_GET['idcritique'], $_POST['motif']);//Appel de la fonction de signalement
                }
            }else{
                echo '<p>Erreur.</p>';
            }
        ?>
    </div>
    <?php
        include 'footer.php';
    ?>
</body>