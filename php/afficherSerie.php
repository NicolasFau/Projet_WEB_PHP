<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8" />
            <link rel="stylesheet" href="css/style.css" />
            <!-- Latest compiled and minified CSS -->
        </head>

        <?php
        require 'connexion.php';
        ?>

        <body>
            <?php
            $nomserie=$_GET['NomSerie'];
            $result = pg_query($linkpdo, "SELECT * FROM Serie WHERE NomSerie = '$nomserie';");
            $row = pg_fetch_array($result);
            echo $nomserie;
            echo $row['themeserie'];
            echo $row['paysorigineserie'];
            $urlimage=$row['urlimageserie'];
            echo "<img src=".$urlimage." alt=''>";
            ?>
        </body>
    </html>