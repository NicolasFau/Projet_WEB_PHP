

<?php
$titre='Identification';
require 'connexion.php';
include 'head.php';
?>
<body>
<?php
include 'header.php';
?>
    <div class="page">
        <center><h1>Connexion</h1></center>
<fieldset>
    <div id="infos">
        <form action="identification.php" method="post">
            <p>Identifiant<br><input type="text" name="PseudoU"  required="required" style="text-align: center"/></p>
            <p>Mot de passe<br><input type="password" name="PasswordU"  required="required" style="text-align: center"/></p>
            <input type="hidden" name="validate" value="ok"/>
            <?php
            if(isset($_GET['error'])){
                $erreur = $_GET['error'];
                echo "<p class = 'error'>$erreur</p>";
            }
            ?>
            <p><input type="submit" value="Connexion"></p>
            <p id="enregistrer">Si vous n'avez pas de compte <a href="./saisieUser.php" title="Créer un compte">cliquez ici</a>.</p>

        </form>
    </div>
</fieldset>
<?php

if(!isset($_SESSION['PseudoU'])) {
    if (isset($_POST['PseudoU'])) {
        $pseudo = $_POST['PseudoU'];
        $pass = $_POST['PasswordU'];
        $result = pg_query($linkpdo, "SELECT Passwordu, estAdministrateur FROM utilisateur WHERE Pseudou = '$pseudo';");
        if ($result) {
            $donnees = pg_fetch_array($result);
            if (!strcmp($donnees["passwordu"], $pass)) {
                $_SESSION['PseudoU'] = $pseudo;
                $_SESSION['PasswordU'] = $pass;
                $_SESSION['estadmin'] = $donnees['estadministrateur'];
                header("location: accueil.php");
                if (isset($_POST['cookie']) && $_POST['cookie'] == 'on') {
                    setcookie('login', $result['PseudoU'], time() + 2 * 3600);
                    setcookie('password', $result['PasswordU'], time() + 2 * 3600);
                }
                
            } else {
                header('Location: identification.php?error=Login ou mot de passe invalide.');
            }
        } else {
            header('Location: identification.php?error=Login ou mot de passe invalide.');
        }
    }
}else{
     header("location: accueil.php");

}
session_commit();
?>
    </div>
    <?php
    include 'footer.php';
    ?>
</body>

</html>
