
<?php

include 'head.php';
include 'header.php';
require("connexion.php");
?>
<body>
   
      <h1>   Les meilleures </br> séries sont chez nous ! </h1>
      </br>

		<?php
		$type = $_GET['Type'];
		$nomA = $_GET ['NomA'] ;
		$nomR = $_GET ['NomR'] ;
		$nomS = $_GET ['NomS'] ; 
		$prix = $_GET ['NomP'] ;

//recherche par le nom realisateur et le type       
if (isset ($_GET ['NomR']) && isset ($_GET['Type'])){
    $requete= " select serie.nomserie , serie.themeserie, 
                series.paysorigineserie,serie.urlimageserie
                from serie , realiser , realisateur  where 
                realiser.nomserie = serie.nomserie and
                realisateur.idrealisateur = realiser.idrealisateur and 
                realisateur.nomrealisateur = '$nomR' and serie.themeserie = '$type' " ;
} 
// recherche par le nom acteur et le type 
if (isset ($_GET ['NomA']) && isset ($_GET['Type'])) {
    $requete= " select serie.nomserie, serie.themeserie,
               serie.paysorigineserie,serie.urlimageserie  
                from serie , jouer , acteur
                where acteur.idacteur=jouer.idacteur 
                and jouer.nomserie=serie.nomserie and acteur.nomacteur='$nomA' 
                and serie.themeserie = '$type' " ;
} 
// recherche par le nom serie et type 
if (isset ($_GET ['NomS']) && isset ($_GET['Type'])) {
   $requete= "select serie.nomserie , serie.themeserie,  
              serie.paysorigineserie,serie.urlimageserie
              from serie where  serie.nomserie='$nomS' and 
              serie.themeserie = '$type' " ;      	      
} 

// recherche par nom prix et type 
if (isset($_GET ['NomP'])  && isset($_GET['Type'])) {
    $requete= " select serie.nomserie , serie.themeserie,
                serie.paysorigineserie,serie.urlimageserie
                from serie , prixdecerne, decerner  
                where decerner.nomserie= serie.nomserie and 
               prixdecerne.idprix=decerner.idprix and prixdecerne.nomprix= '$prix' 
               and serie.themeserie = '$type' ";                       
  } 

//recherche par le type le nom acteur et nom serie 
if (isset($_GET['Type']) && isset($_GET ['NomA']) && isset($_GET ['NomS'])) {
   $requete= "select serie.nomserie, serie.themeserie,
              serie.paysorigineserie,serie.urlimageserie
              from serie, jouer, acteur  where serie.themeserie='$type' and 
              acteur.nomacteur='$nomA' and serie.nomserie='$nomS' and
              serie.nomserie=jouer.nomserie and acteur.idacteur=jouer.idacteur ";
  } 

// recherche par le nom de prix et nom de l'acteur  
if (isset($_GET ['NomP'])&&isset($_GET ['NomA'])) {
    $requete="select serie.nomserie, serie.themeserie,
               serie.paysorigineserie,serie.urlimageserie
              from serie,jouer,acteur,decerner,prixdecerne 
              where serie.themeserie='$type' and acteur.nomacteur='$nomA' and 
              prixdecerne.nomprix='$prix' and acteur.idacteur=jouer.idacteur  
              and decerner.idprix=prixdecerne.idprix  ";   
}
 //recherche par le nom acteur et nom prix et nom realisateur  
if (isset($_GET ['NomA']) && isset($_GET ['NomR']) && isset($_GET ['NomP'])) {
    $requete="select distinct serie.nomserie, serie.themeserie,  
               serie.paysorigineserie,serie.urlimageserie
              from serie,realiser,realisateur,jouer,acteur,decerner,prixdecerne
              where serie.themeserie='$type' and acteur.nomacteur='nomA' 
              and realisateur.nomrealisateur='nomR' and prixdecerne.nomprix='$prix'
              and acteur.idacteur=jouer.idacteur 
              and realiser.idrealisateur=realisateur.idrealisateur 
              and decerner.idprix=prixdecerne.idprix ";  
 }

// recherche par nom de l'acteur et le nom de realisateur 
if (isset($_GET ['NomA']) && isset($_GET ['NomR'])) {
   $requete="select distinct serie.nomserie, serie.themeserie, 
              serie.paysorigineserie,serie.urlimageserie
             from serie,realiser,realisateur,jouer,acteur
             where serie.themeserie='$type' and acteur.nomacteur='$nomA' 
             and realisateur.nomrealisateur='$nomR'
             and acteur.idacteur=jouer.idacteur 
             and realiser.idrealisateur=realisateur.idrealisateur ";       
}
// par le nom de realisateur et le nom prix 
if (isset($_GET ['NomR']) && $_GET ['NomP'] ) {
    $requete="select distinct serie.nomserie, serie.themeserie, 
              serie.paysorigineserie,serie.urlimageserie
              from serie,realiser,realisateur,decerner,prixdecerne 
              where serie.themeserie='$type' and prixdecerne.nomprix='$prix'
               and realisateur.nomrealisateur='$nomR'
               and decerner.idprix=prixdecerne.idprix
             and realiser.idrealisateur=realisateur.idrealisateur ";        
      }
// recherche par type 
if (isset ($_GET['Type'])) {
   $requete= "select serie.nomserie, serie.themeserie,   
              serie.paysorigineserie,serie.urlimageserie
               from serie where serie.themeserie='$type'  " ;
                
}      
     ?>

<?php
$rech=pg_query($linkpdo,$requete);

if ($rech){
    $nbUtilisateur = pg_num_rows($rech);
   if($nbUtilisateur > 0) {
	//récuperation de chaque ligne 
	echo"<table border='5'>\n";
	echo "<tr>\n";
	echo "<td> <strong>  Nom </strong></td>\n";
	echo "<td> <strong>  type </strong></td>\n";
	echo "<td> <strong>  Pays </strong></td>\n";
  echo "<td> <strong>  Image </strong></td>\n";
  //echo "<td> <strong>  Nombre de saison </strong></td>\n";
  
	echo "</tr>\n";
	while ( $res = pg_fetch_array($rech)) {
		   echo "<tr>\n";
		   echo "<td>" . $res['nomserie'] .  "</td>";
       $urlimage = $res['urlimageserie'];
            echo "<td>". "<img src=". $urlimage . ">". "</td>";
		  // echo "<td>"  . $res['count_saison'] . "</td>";  
		   echo "</tr>\n"; 
	}

	echo"</table>\n"; 
}else{ 
	 echo " Desole, il y a pas de reponse correspondant a votre recherche . ";
}   

} else {
	   echo "erreur dans l'execution de la requete  </br>";
	   echo"le message d'erreur est:";
}
?> 
</body>
</html>