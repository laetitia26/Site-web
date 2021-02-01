<?php
    require 'database.php';
    if (!empty($_GET['id'])) {
       $id = checkInput($_GET['id']);
    }
    if (!empty($_POST)) {
       $id = checkInput($_POST['id']);
       $db = Database::connect();
       $statement = $db->prepare("DELETE FROM recettes WHERE rid = ?");
       $statement->execute(array($id));
       Database::disconnect();
       header("location: index.php");
    }
 
 #Vérification saisie
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
                <h1><strong>Supprimer un produit</strong></h1>
                <br>
                <form class="form" action="<?php echo'delete.php?id='.$id; ?> " role="form" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <p class="alert alert-warning"> Êtes vous sûrs de vouloir supprimer ?</p>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-warning">Oui</button>
                        <a class="btn btn-default" href="index.php">Non</a>
                   </div>
                </form>
            </div>
        </div>   
    </body>
</html>