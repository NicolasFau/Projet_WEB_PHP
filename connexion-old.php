<?php
                  /*  try { 
                            $linkpdo = new PDO('mysql:host=localhost;dbname=projetphp', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); 
                    } 
                    catch (Exception $e) { 
                        die('Erreur : '. $e->getMessage()); 
                    } */

                    try {
                        $linkpdo = pg_connect("host=localhost port=5432 dbname=ProjetPHP user=postgres password=0000");
                        //$linkpdo = new PDO('pgsql:host=localhost;port=5432;dbname=ProjetPHP', 'postgres', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                    } 
                    catch (Exception $e) { 
                        die('Erreur : '. $e->getMessage());
                    }
/*
 try {
            $linkpdo = new PDO("pgsql:dbname=ProjetPHP;host=localhost", 'postgres', '0000' , array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
            catch(Exception $e)  {
                die('Une erreur c\'est produit avec la base de données.<br>Merci de contacter un administrateur.');
        } */
?>