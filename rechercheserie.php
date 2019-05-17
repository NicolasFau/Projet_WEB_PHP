
<?php
include '/head.php';
include '/header.php';
?>

<body>    
     <h1>   Les meilleures series sont chez nous ! </h1>
     </br>

     <div id="formulaire">
     <h3> Replissez le formulaire ci-dessous pour trouver votre serie ! </h3>

     <form method="get" action="resultatrechercheserie.php">
          <label for="nom">Type de série: </label>
          Policier <input type = "radio" name = "Type" value = "Policier" checked="checked" />
          Thriller<input type = "radio" name = "Type" value = "Thriller"/>
          Drame <input type = "radio" name = "Type" value = "Drame"/>
          Aventure <input type = "radio" name = "Type" value = "Aventure"/>

           
          <p>  
               <label for="nom">Nom de la Serie: </label> <input type = "texte" name = "NomS" /> 
          </p>
          
          <p>     
               <label for="nom">Nom acteur: </label> <input type = "texte" name = "NomA" />  
          </p>

           <p>     
               <label for="nom">Nom realisteur: </label> <input type = "texte" name = "NomR" /> 
           </p>
            
            <p>    
               <label for="nom">Nom prix: </label> <input type = "texte" name = "NomP" />
            </p>  

          <input type = "submit" value = "Rechercher"   name ="submit" />
    </form>
    </div>
</body>
</html>