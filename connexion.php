<?php

                    try {
                        $linkpdo = pg_connect("host=villemurvincent.postgres.database.azure.com port=5432 dbname=ProjetPHP user=vincent@villemurvincent password=JKll!#vDD");
                        //$linkpdo = new PDO('pgsql:host=localhost;port=5432;dbname=ProjetPHP', 'postgres', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                    } 
                    catch (Exception $e) { 
                        die('Erreur : '. $e->getMessage());
                    }

?>
