<!DOCTYPE html>
<html>
    <head>
        <title>PHP</title>
        <meta charset="utf-8" />
    </head>
    <body>
    <label for="choix_serie">Nom Série </label>
    <form action="formajoutepisode.php" method="post">
            <?
            $n="test";
            $u="test";
            $p="123456789";
            $connect=pg_connect("host=localhost port=5432 dbname=$n user=$u password=$p");
            $queryNomserie="Select * from serie";
            $resulatNomListe=pg_exec($connect, $queryNomserie);
            //datalist dynamique
            echo '<input  list="listeSerie" type="text" name="listeSerie">';
            echo '<datalist id="listeSerie">';
            while ($data =pg_fetch_array($resulatNomListe)) {
              // on affiche les résultats
              echo '<option value='.$data['nomserie'].'>';
            }
            echo  '</datalist>';
          ?>
          <label for="choix_saison">Saison </label>
          <?
          $n="test";
          $u="test";
          $p="123456789";
          $connect=pg_connect("host=localhost port=5432 dbname=$n user=$u password=$p");
          $queryNomserie="Select * from Serie,Saison WHERE Serie.NomSerie=Saison.idSaison";
          $resulatNomListe=pg_exec($connect, $queryNomserie);
          //datalist dynamique
          echo '<input  list="listeSaison" type="text" name="listeSaison">';
          echo '<datalist id="listeSaison">';
          while ($data =pg_fetch_array($resulatNomListe)) {
          	// on affiche les résultats
          	echo '<option value='.$data['numeroSaison'].'>';
          }
          echo  '</datalist>';
        ?>
	       <p>Nom Episode <input type="text" name="nom"></p>
	       <p>Numéro Episode<input type="number" id="tentacles" name="num" min="1" max="100"></p>
         <p>Durée épisode<input type="text" name="duree"></p>
         <p><a href="ajoutepisode.php"><input type="submit" value="Ajouter"></a></p>
         <p><a href="admin.php"><input type="submit" value="Terminer"></a></p>

    </form>
