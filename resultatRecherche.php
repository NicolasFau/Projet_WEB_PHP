    <?php
    include 'head.php';
    include 'header.php';
    include 'fonctionsDeRecherche.php';
    $titre = 'Rasultat recherche';


?>
<?php
if(isset($_GET['nomserie']) and $_GET['nomserie']!=null){
    $nomserie=pg_escape_string($_GET['nomserie']);
    $nomserie=$_GET['nomserie'];
}else{
    $nomserie="%";
}
if(isset($_GET['categorie']) and $_GET['categorie']!=null){
    $categorie=pg_escape_string($_GET['categorie']);
    $categorie=$_GET['categorie'];
}else{
    $categorie="%";
}
if(isset($_GET['nbsaison']) and $_GET['nbsaison']!=null){
    $nbsaison=$_GET['nbsaison'];
}else{
    $nbsaison=0;
}

$requete="select  serie.nomserie, serie.urlimageserie from serie inner join saison on saison.nomserie=serie.nomserie and serie.nomserie like '$nomserie' and serie.themeserie like '$categorie' group by serie.nomserie having count(serie.nomserie)>=$nbsaison";
$resultat=pg_query($linkpdo, $requete);
$resultat=pg_fetch_all($resultat);
    
    
?>

<body>

        <div style="display:block">
        <center><ul style=" width: inherite ; height: 200; margin: 0; padding: 0;  list-style-type: none; ">
            <?php
            if($resultat!=null){
                foreach($resultat as $serie){
        foreach($resultat as $serie){
            
          ?>  
         <li style ="float: left; margin-left: 30px; margin-right:30px ; margin-top:20px; margin-bottom:5px" > 
             <div><a href="afficherSerie.php?search=<?php echo $serie['nomserie']; ?>"> <img src="<?php echo $serie['urlimageserie']; ?>" heigth="268" width ="182"></a></div> 
             <div><center><a href="afficherSerie.php?search=<?php echo $serie['nomserie']; ?>"><?php echo $serie['nomserie']; ?></a></center></div>
        </li>

        <?php 
        }
    ?>
        </ul></center>
           <?php }else{
                echo '<p> Aucune série ne correspond à la recherche <br></p>';
                echo '<a href="./rechercheavancee.php">Effectuer une nouvelle recherche</a>';
                
            }
            
            
            ?>
        
    </div>


</body>


<?php
include 'footer.php';
?>
</html>
