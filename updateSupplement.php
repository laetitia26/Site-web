<?php
     
    require 'database.php';

    if (!empty($_GET['id'])) {
       $id = checkInput($_GET['id']);
    }
 
    $nameError =  $priceError =  $name =  $price =  "";

    if(!empty($_POST)) 
    {
        $name               = checkInput($_POST['name']);
        $price              = checkInput($_POST['price']);
        $isSuccess          = true;
        
        
        if(empty($name)) 
        {
            $nameError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
       
        if(empty($price) || $price < 0) 
        {
            $priceError = 'Ce champ ne peut pas être vide , ou negatif!!';
            $isSuccess = false;
        } 
       
        if($isSuccess) 
        {
            $db = Database::connect();
            $statement = $db->prepare("UPDATE  supplements SET nom = ?, prix = ? WHERE sid = ?");
            $statement->execute(array($name,$price,$id));
            Database::disconnect();
            header("Location: index.php");
        }
    }else{

            $db = Database::connect();
            $statement = $db->prepare("SELECT * FROM  supplements WHERE sid = ?");
            $statement->execute(array($id));
            $item = $statement->fetch();
            $name = $item['nom'];
            $price = $item['prix'];


            Database::disconnect();
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
                <h1><strong>Modifier un supplement</strong></h1>
                <br>
                <form class="form" action="<?php echo'updateSupplement.php?id='.$id; ?> " role="form" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Nom:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nom" value="<?php echo $name;?>">
                        <span class="help-inline"><?php echo $nameError;?></span>
                    </div>
                   
                    <div class="form-group">
                        <label for="price">Prix: (en €)</label>
                        <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="Prix" value="<?php echo $price;?>">
                        <span class="help-inline"><?php echo $priceError;?></span>
                    </div>
            
                    </div>
                    
                    <br>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Modifier</button>
                        <a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                   </div>
                </form>
            </div>
        </div>   
    </body>
</html>