<?php
include 'head.php';
include 'header.php';
include 'fonctionsDeRecherche.php';
?>
<body>
<fieldset>
    <form method="post">
        <label>Proposez la série</label><br>
        <label>Titre</label><br>
        <textarea name="titre"></textarea><br>
        <label>Description</label><br>
        <textarea name="description"></textarea><br>
        <label>Email</label><br>
        <input type="email" name="email" required><br>
        <input type="submit" value ="Envoyer">
    </form>
</fieldset>


<?php
if (isset($_POST['titre'])/* and (isset($POST['description']))*/) {
    $position_arobase = strpos($_POST['email'], '@');
    if($position_arobase === false)
        echo '<p>Votre email doit comporter un arobase.</p>';
    else {
        $retour=mail('reda.douieb@gmail.com', /*$_POST['titre'] .*/ $_POST['description'], 'From : ' . $_POST['email']);
        if($retour)
            echo '<p>Votre message a été envoyé.</p>';
        else
            echo '<p>Erreur.</p>';
    }
}
?>
</body>