<?php
include 'head.php';
include 'header.php';
include 'fonctions_signalement.php';
?>
<body>
    <div class="page">
        <center><h1>Signaler</h1></center>
    <fieldset>
    <form method="post">
        <label>Motif du signalement:</label><br>
        <textarea name="motif" id ="avis" required></textarea><br>
        <input type="submit" value ="Envoyer">
    </form>
</fieldset>
<?php
if (isset($_GET['idcritique'])){
    if (isset($_POST['motif'])){
        $signalement=signaler_critique($linkpdo, $_GET['idcritique'], $_POST['motif']);
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