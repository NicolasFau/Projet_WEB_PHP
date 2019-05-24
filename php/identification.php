

<?php
$titre='Identification';
require 'connexion.php'; //Connexion avec la base de données PostGreSQL
include 'head.php'; //Inclusion du CSS et Metacharset UTF-8
?>
<body>
<?php
include 'header.php'; //Inclusion du header avec le menu
?>
    <div class="page">
        <center><h1>Connexion</h1></center>
<fieldset>
    <div id="infos">
        <!-- Formulaire pour la connexion d'un membre sur la plateforme, on appelle la même page avec les variables POST du pseudo et du mot de passe-->
        <form action="identification.php" method="post">
            <p>Identifiant<br><input type="text" name="PseudoU"  required="required" style="text-align: center"/></p>
            <p>Mot de passe<br><input type="password" name="PasswordU"  required="required" style="text-align: center"/></p>
            <input type="hidden" name="validate" value="ok"/>
            <?php
            //Récupération d'une erreur si la connexion ne marche pas avec une variable GET
            if(isset($_GET['error'])){
                $erreur = $_GET['error'];
                echo "<p class = 'error'>$erreur</p>";
            }
            ?>
            <p><input type="submit" value="Connexion"></p>
            <!--Invitation à l'inscription si l'utilisateur n'a pas de compte, redirection vers saisieUser.php-->
            <p id="enregistrer">Si vous n'avez pas de compte <a href="./saisieUser.php" title="Créer un compte">cliquez ici</a>.</p>

        </form>
    </div>
</fieldset>
<?php
//Si la variable de session du pseudo n'existe pas et que le pseudo a été saisi dans le formulaire
if(!isset($_SESSION['PseudoU'])) {
    if (isset($_POST['PseudoU'])) {
        //On récupère le pseudo et le mot de passe
        $pseudo = $_POST['PseudoU'];
        $pass = $_POST['PasswordU'];
        //On récupère le password et on regarde si l'utilisateur est un administrateur en fonction du pseudo renseigné
        $result = pg_query($linkpdo, "SELECT Passwordu, estAdministrateur FROM utilisateur WHERE Pseudou = '$pseudo';");
        if ($result) {
            $donnees = pg_fetch_array($result);
            //On vérifie la cohérence du mot de passe 
            if (!strcmp($donnees["passwordu"], $pass)) {
                //on initialise les variables de sessions pseudo, et password
                //On initialise la variable de session estadmin pour différencier un utilisateur normal d'un administrateur
                $_SESSION['PseudoU'] = $pseudo;
                $_SESSION['PasswordU'] = $pass;
                $_SESSION['estadmin'] = $donnees['estadministrateur'];
                //redirection vers la page d'accueil
                header("location: accueil.php");
                //Création des variables COOKIES (potentiellement utilisable)
                if (isset($_POST['cookie']) && $_POST['cookie'] == 'on') {
                    setcookie('login', $result['PseudoU'], time() + 2 * 3600);
                    setcookie('password', $result['PasswordU'], time() + 2 * 3600);
                }
                
            } else {
                //En cas d'erreur d'identification on redirige vers la même pas avec une erreur dans le GET
                header('Location: identification.php?error=Login ou mot de passe invalide.');
            }
        } else {
            header('Location: identification.php?error=Login ou mot de passe invalide.');
        }
    }
}else{
    //Si la session avec le pseudo renseigné existe deja alors on redirige vers l'accueil
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
