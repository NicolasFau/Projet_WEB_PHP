<?php
include 'head.php';
include 'header.php';
include 'fonctionsDeRecherche.php';
$titre = 'Rasultat recherche';
?>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <style>
    fieldset {
      border: 0;
    }
    label {
      display: block;
      margin: 30px 0 0 0;
    }
    .overflow {
      height: 200px;
    }
  </style>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  $( function() {
    $( "#menu" ).selectmenu();
	var spinner = $( "#spinner" ).spinner();
});
</script>

<body>
<form action="resultatRecherche.php" method="get">
    <p>Nom de la serie<br><input type="text" name="nomserie"/></p>
    <p>Selectionnez une categorie <br>
        <select name="categorie" id="menu" >
            <option value=""></option>
            <?php
            $liste_categorie=listeTheme($linkpdo);
            foreach($liste_categorie as $categorie){
                echo '<option value="'.$categorie['themeserie'].'">'.$categorie['themeserie'].'</option>';
            }
            ?>
        </select></p>
    <p>Nombre de saison minimum<br><input type="number" name="nbsaison" id="spinner"/></p>


    <p><input type="submit" value="Rechercher"></p>
</form>

</body>
<?php
include 'footer.php';
?>
</html>
