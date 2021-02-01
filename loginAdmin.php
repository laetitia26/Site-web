<?php


  $erreur = null;
  
if (!empty($_POST['username']) && !empty($_POST['password'])) 
   {
   		  $login = checkInput($_POST['username']);
  	    $password = checkInput($_POST['password']);
  
		  if ($login ==='admin' && $password ==='admin') {
		   //on se connecte 
		  	session_start();

		  	$_SESSION ['connecte'] = 1;

		    header ('Location: index.php');
		  }else{
		    $erreur = "identification incorrect!";
		  }
   }


require_once 'auth.php';
if (est_connecte()) {
	header('Location: index.php');
		exit();
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

              <nav>
                    <ul class="nav nav-pills">
                        
                        <li role="presentation" class="active" style="margin-left: 280px" ><a href="" data-toggle="tab" > Administration </a> </li>
                          
                    </ul>
                </nav>
               <div class= "tab-pane active">
           
          <!-- Material form login -->
               <div class="col-sm-8 site" style="margin-left: 150px">

               <hr>
               <hr>

                        <div class="card">

                          <h5 class="card-header info-color white-text text-center py-4">
                            <strong> Se connecter </strong>
                          </h5>

                          <!--Card content-->
                            <!-- Form -->

                             <?php  if ($erreur):   ?>
                                
                                  <div class="alert alert-danger">
                                     <?= $erreur ?>
                                  </div>
                            

                             <?php endif ?>

                            <form class="text-center" style="color: #757575" method="POST" action="">

                              <!-- login -->
                              <div class="md-form">
                                <input name="username" type="username" id="materialLoginFormPassword" class="form-control" placeholder="login admin" required="required">
                                
                              </div>
                              <br><br>

                              <!-- Password -->
                              <div class="md-form">
                                <input name="password" type="password" id="materialLoginFormPassword" class="form-control" placeholder="Mot de passe" required="required">
                               
                              </div>

                              <div class="d-flex justify-content-around">
                                <div>
                                  <!-- Remember me -->
                                  <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="materialLoginFormRemember">
                                    <label class="form-check-label" for="materialLoginFormRemember">Se souvenir de moi! </label>
                                  </div>
                                </div>
                                </div>

                              <!-- Sign in button -->
                             <!-- <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit"> Connexion </button> -->
                              <button type="submit" name="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Connection</button>

                            </form>
      

                   </div>
                        <!-- Material form login -->
              </div>

            
        </div> 
    </div> 
    
            <div class="col-lg-12">
               <div class="copyright" style="margin-top: 80px "><center style="color: #fff">Copyright © Tous droits réservés.</center></div>
            </div>
      

</body>

</html>>