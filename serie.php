<?php
    include 'head.php';
    include 'header.php';
    include 'fonctionsDeRecherche.php';
    $titre = 'Série';


?>
<body style=" position : absolute;">
    <?php
        $requete= "SELECT * FROM serie ORDER BY nomserie";
        $resultat=pg_query($linkpdo, $requete);
        $resultat=pg_fetch_all($resultat);
    ?>
        <div style="display:block">
            <center><ul style=" width: inherite ; height: 200; margin: 0; padding: 0;  list-style-type: none; ">
            <?php
        foreach($resultat as $serie){
          
            $synopsis=$serie['synopsisserie'];
            $synopsis=substr($synopsis, 0 ,  202);
            $fin=substr($synopsis, strlen($synopsis)-2);

            if($fin!=".."){
                   $synopsis.="...";
            }
            
          ?>  
         <li style ="float: left; margin-left: 30px; margin-right:30px ; margin-top:20px; margin-bottom:5px" > 
             <div><a href="afficherSerie.php?search=<?php echo $serie['nomserie']; ?>"> <img src="<?php echo $serie['urlimageserie']?>" heigth="268" width ="182"></a></div> 
             <div><center><a href="afficherSerie.php?search=<?php echo $serie['nomserie']; ?>"><?php echo $serie['nomserie']; ?></a></center></div>
             <div style=" width:200;
                         heigth:100;
		          "><p style="width: 200px; height:140;
                    overflow-wrap: break-word;
                    text-align: justify;
                    overflow :hidden;
		            text-overflow: ellipsis ;
                 "><?php echo $synopsis; ?></p>
             
             </div>
            </li>

        <?php 
        }
    ?>
            </ul></center>
    </div>


</body>


<?php
include 'footer.php';
?>
</html>
