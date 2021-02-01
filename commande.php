<?php
session_start();
require 'panier.class.php';
require 'db.class.php';
$DB = new DB();
$panier = new panier($DB);

if (isset ($_GET['ref'])) {
    $_SESSION['commande'] = checkInput($_GET['ref']);
}

function checkInput($data) 
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Pizza en ligne</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="../css/styles.css">
    </head>
    
    <body>
        <h1 class="text-logo"><span class="glyphicon glyphicon-cutlery"></span> Pizza en ligne <span class="glyphicon glyphicon-cutlery"></span></h1>
         <div class="container admin">
            <div class="row">
                <h1><strong>Commande </strong></h1>
                <br>

                <?php

                require '../admin/database.php';
                $db = Database::connect();
                $refCommande =$_SESSION['commande'];
                $login =checkInput($_SESSION['user']);
                $recettesId = array_keys($_SESSION['panier']);
                $risR = implode(',', $recettesId);
                #var_dump($recettesId);

             if (isset($recettesId)) {
             
             if (!isset($login)) 
             {
	             	die("Vous n'êtes pas connectés !!") ;
	             }else{
	             	$userId = $DB->query('SELECT * FROM users WHERE users.login="'.$login.'"');
	             	if(empty($risR)){
							$rid = array();
						}else{
							
							$rid = $DB->query('SELECT rid FROM recettes WHERE recettes.rid IN ('.$risR.')');
						}
	             	// var_dump($userId);
	                // var_dump($rid);
	             }
	                
	                #var_dump($userId[0]->uid);
	                #var_dump($rid[0]->rid);

	                for ($i=0; $i< count($rid); $i++)
	                {
	                	
	                	 $db->query('INSERT INTO commandes (ref, uid, rid, date) VALUES ("'.$refCommande.'",'.$userId[0]->uid.','.$rid[$i]->rid.',NOW())');

	                }
            }

              ?>

                <form class="form" action="<?php echo'delete.php?id='.$id; ?> " role="form" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <p class="alert alert-succes">Votre commande est enregistrée sous la reference: <strong> <?= $refCommande  ?></strong></p>
                    <div class="form-actions">
                       <a href="../index.php" class="btn btn-info"> Retourner au catalogue </a>
                       <a class="btn btn-sucess" href="../accueil.php">Accueil</a>
                   </div>
                </form>
            </div>
        </div>   
    </body>
</html>