<?php
session_start();
require 'db.class.php';
require 'panier.class.php';
$DB = new DB();
$panier = new panier($DB);
if (isset($_GET['id'])) 
{
   $products = $DB ->query('SELECT rid FROM recettes WHERE rid =:id',array('id'=>$_GET['id']));
   
   var_dump($products);
		if (empty($products)) 
		{
			die("Ce produit n'existe pas!");
			echo' <p class="alert alert-warning"> Ce produit n\'existe pas !</p>';
        }
    $panier->add($products[0]->rid);
    
    #die('Le produit a bien été ajouté à votre panier <a href="../index.php"> Retourner sur la catalogue </a> ');
    #echo' <p class="alert alert-warning"> Ce produit a bien été ajouté à votre panier !<a href="../index.php"> Retourner sur la catalogue </a></p>';

}else
  {
	  die("Vous n'avez pas selectionné de produit à ajouter au panier");

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
            <div class="container admin">
            <div class="row">
                <h1><strong>Ajouter un produit au panier</strong></h1>
                <br>

                   <?php echo'
                    <p class="alert alert-success"> Produit Ajouté au panier avec succés</p><a href="../index.php"><button type="button" class="btn btn-success">Retourner sur la catalogue</button>  </a>';
                    ?> 

                   </div>
                </form>
            </div>
        </div>   

   </body>
   
   </html> 	