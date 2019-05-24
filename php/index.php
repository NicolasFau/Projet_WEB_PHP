<!DOCTYPE html>
<html>
    <head>
        <title>PHP</title>
        <meta charset="utf-8" />
    </head>
    <body>
        <form action="ajout.php" method="post">
	  <p>Nom Saison <input type="text" name="nomsaison"/></p>
	<p>Numéro Saison
    <input type="number" id="tentacles" name="num"
         min="1" max="100"></p>
  <label for="choix_serie">Nom Série </label>
  <input  list="listeSerie" type="text" name="listeSerie" >
  <datalist id="browsers" >
     <option value="Série 1">
     <option value="Série 2">
  </datalist>


          <p><input type="submit" value="Ajouter" /></p>
        </form>

    </body>
</html>
