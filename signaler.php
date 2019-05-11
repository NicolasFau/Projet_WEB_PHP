<?php
include 'head.php';
include 'header.php';
include 'fonctions_signalement.php';
?>
<body>
<fieldset>
    <form method="post">
        <label>Motif du signalement</label><br>
        <textarea name="motif" required></textarea><br>
        <input type="submit" value ="Envoyer">
    </form>
</fieldset>
<?php
if (isset($_GET['idcritique']) and isset($_POST['motif'])){
    $signalement=signaler_critique($linkpdo, $_GET['idcritique'], $_POST['motif']);
}else{
    echo '<p>Erreur.</p>';
}
?>
</body>