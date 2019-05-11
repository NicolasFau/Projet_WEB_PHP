<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8" />
            <link rel="stylesheet" href="css/style.css" />
            <!-- Latest compiled and minified CSS -->
        </head>

        <?php
        require 'connexion.php';
        include 'head.php';
        include 'header.php';
        ?>

        <body>
            <?php
            $nomserie=$_GET['search'];
            $result = pg_query($linkpdo, "SELECT * FROM Serie WHERE NomSerie = '$nomserie';");
            $row = pg_fetch_array($result);
            $test=count($row);
                if($test != 1) {
                    echo "<b>Nom de la série :</b>" . "<br>" . "<br>";
                    echo $nomserie . "<br>" . "<br>";
                    echo "<b>Theme de la série :</b>" . "<br>" . "<br>";
                    echo $row['themeserie'] . "<br>" . "<br>";
                    echo "<b>Pays d'origine de la série :</b>" . "<br>" . "<br>";
                    echo $row['paysorigineserie'] . "<br>" . "<br>";
                    echo "<b>Synopsis :</b>" . "<br>" . "<br>";
                    echo $row['synopsisserie'] . "<br>" . "<br>";
                    $urlimage = $row['urlimageserie'];
                    echo "<img src=" . $urlimage . " alt=''>" . "<br>" . "<br>";
                    echo "<b>Saisons existantes :</b>" . "<br>" . "<br>";
                    $result2 = pg_query($linkpdo, "SELECT numérosaison FROM Saison WHERE nomSerie = '$nomserie';");
                    $row2 = pg_fetch_all($result2);
                    $count = count($row2);
                    for ($i = 0; $i < $count; $i++) {
                        $s = $row2[$i]['numérosaison'];
                        echo "<a href='afficherSaison.php?numsai=$s'>Saison $s</a>" . "<br>";
                    }
                }else{
                    echo("Série introuvable");
                }
            ?>
        </body>
    </html>