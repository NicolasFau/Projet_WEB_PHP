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
            $numsaison=$_GET['numsai'];
            $result = pg_query($linkpdo, "SELECT * FROM Saison WHERE numérosaison = '$numsaison';");
            $row = pg_fetch_array($result);
            echo "Saison numéro ".$numsaison." de la série ".$row['nomserie']."<br>"."<br>";
            echo "<b>Date de parution</b>"."<br>"."<br>";
            echo $row['dateparutionsaison']."<br>"."<br>";
            echo "<b>Note actuelle de la saison :</b>"."<br>"."<br>";
            ?>
        </body>
    </html>