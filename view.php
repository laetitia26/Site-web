<?php
require 'database.php';
if (!empty($_GET['id'])) {
	$id =checkInput($_GET['id']);

}
 
 $db = Database::connect();
 $statement = $db->prepare("SELECT rid, nom, prix FROM recettes WHERE rid = ?");

 $statement->execute(array($id));

#une seule ligne 
 	$recettes = $statement->fetch();
 	Database::disconnect();



function checkInput($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Pizza En Ligne </title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="../css/styles.css">
    </head>
    
    <body>

        <h1 class="text-logo"><span class="glyphicon glyphicon-cutlery"></span> Pizzas Italiennes <span class="glyphicon glyphicon-cutlery"></span></h1>

        <div class="container admin">
        	
            <div class="row">

            <div class="col-sm-6">
            	 <h1><strong>Voir le Produit </strong></h1>
            	 <hr>
            	 <hr>
            	 <FORM>
            	 	<div class="form-group">
            	 		<label>Nom:</label><?php echo ' '.$recettes['nom'];  ?>
            	 		
            	 	</div>
            	 	<div class="form-group">
            	 	<!--	<label>Description:</label><?php echo ' '.$recettes['description']; ?>  -->
            	 	<label>Description: </label><p> pâte pizza, tomate, fromage mozza, viandes .......</p>
            	 		
            	 	</div>
            	 	<div class="form-group">
            	 		<label>prix:</label><?php echo ' '.$recettes['prix'].' €';  ?>
            	 		
            	 	</div>
            	 	<div class="form-group">
            	 	<!--	<label>Categorie:</label><?php echo ' '.$recettes['category']; ?>  -->
            	 	<label>Categorie:</label><p> PIZZA</p>
            	 		
            	 	</div>
            	 	<div class="form-group">
            	 	<!--	<label>Image:</label><?php echo ' '.$recettes['image']; ?>  -->
            	 	
            	 		
            	 		
            	 	</div>
            	 </FORM>

            	 <div>

            	 	<a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
            	 </div>

            </div>

             <div class="col-sm-6 site" >
                                <div class="thumbnail">
             <!-- <img src=" <?php echo '../images/'. $recettes['image'] ?>" alt="PIZZA">  -->
             <img src="../images/pizza.png">
                                    <div class="price"><?php echo number_format($recettes['prix'], 2, '.', ''); ?> €</div>
                                    <div class="caption">
                                        <h4> <?php echo $recettes['nom'];  ?> </h4>
                                    <!--    <p> <?php echo $recettes['description']; ?> </p>  -->
                                    <p> pâte pizza, tomate, fromage mozza, viandes </p>
                                        <a href="#" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"></span>Commander</a>  
                                        
                                    </div>
                                </div>

                            </div>
       
                
            </div>
        </div>



    </body>

</html>