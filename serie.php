<?php
    include 'head.php';
    include 'header.php';
    include 'fonctionsDeRecherche.php';
    $titre = 'Série';


?>
<body style="margin=1500">
    <?php
        $requete= "SELECT * FROM serie ORDER BY nomserie";
        $resultat=pg_query($linkpdo, $requete);
        $resultat=pg_fetch_all($resultat);
    ?>
        <ul style=" width: 1500; height: 270; margin: 0; padding: 0;  list-style-type: none; ">
            <?php
        foreach($resultat as $serie){
          ?>
            
         <li style ="float: left; margin: 30px;" > 
             <div><a href="afficherSerie.php?search=<?php echo $serie['nomserie']; ?>"> <img src="<?php echo $serie['urlimageserie']?>"></a></div> 
             <div><center><a href="afficherSerie.php?search=<?php echo $serie['nomserie']; ?>"><?php echo $serie['nomserie']; ?></a></center></div>
             <div style=" width:200;
                         heigth:160;
		          "><p style="width: 200px; height:160;
                    text-align: justify;
                    overflow :hidden;
		            text-overflow: ellipsis ;
                 "><?php echo $serie['synopsisserie'];?></p></div></li>

        <?php 
        }
    ?>
            </ul>


</body>

</html>
<?php
//include 'footer.php';
?>