<!DOCTYPE html>
<html>
    <head>
        <title>PHP</title>
        <meta charset="utf-8" />
    </head>
    <body>
        <form action="ajouterserie.php" method="post">
	  <p>Nom Saison <input type="text" name="nomsaison"/></p>
	<p>Numéro Saison
    <input type="number" id="tentacles" name="tentacles"
         min="1" max="100"></p>
	<p>Nom Série <input type=text list=browsers >
  <datalist id=browsers >
     <option> Série 1
     <option> Série 2
  </datalist>
</p>

          <p><input type="submit" value="Ajouter" /></p>
        </form>

    </body>
</html>
