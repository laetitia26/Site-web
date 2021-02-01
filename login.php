
<?php
session_start();
require 'panier/db.class.php';
require 'panier/panier.class.php';
#connexion client 
require_once  'admin/database.php';
 $erreur = null;

if (isset($_POST['submit'])) 

{
      $login = checkInput($_POST['login']);
      $mdpBrut = $_POST['password'];

      $mdp = sha1($mdpBrut);

        if ($login && $mdpBrut) 
        {
         
            #On se connecte pour verifier les données 
            $db = Database::connect();
            $statement = $db->query("SELECT uid FROM users WHERE login ='$login' && mdp ='$mdp'");             
            
          if ( $users = $statement->fetchAll()) {

            $_SESSION['user'] = $_POST['login'];
            $_SESSION['Auth']  = array(
             'login' =>$login,
             'pass' => $mdp
            );
            
            header("Location:index.php");
           
          }else
                { 
                       $erreur = "identification incorrect!";
                }
       
     }
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
        <link rel="stylesheet" href="css/styles.css">
      
    </head>

    <body>
     

      <h1 class="text-logo"><span class="glyphicon glyphicon-cutlery"></span> Pizzas Italiennes <span class="glyphicon glyphicon-cutlery"></span></h1>

       <div style="margin-right:100px">
        
          <center >
            <li style="margin-bottom: 50px ">
            <a href="admin"><button type="button" class="btn btn-danger" >Administration du site</button></a>
          </li>
        </center> 

      </div>

            <div class="container admin">

              <nav>
                    <ul class="nav nav-pills">
                        <li role="presentation" class="active" style="margin-left: 295px" ><a href="#" data-toggle="tab"> Clients </a> </li>
                          
                    </ul>
                </nav>

   <div class="tab-content">

           <div class= "tab-pane active" id="1">
           
           
          <!-- Material form login -->
               <div class="col-sm-8 site" style="margin-left: 150px">
               
               <hr> <hr>
                  <div class="card">

                          <h5 class="card-header info-color white-text text-center py-4">
                            <strong> Se connecter </strong>
                          </h5>

                           <?php  if ($erreur):   ?>
                                
                                  <div class="alert alert-danger">
                                     <?= $erreur ?>
                                  </div>
                            

                             <?php endif ?>

                          <!--Card content-->
                            <!-- Form -->
                            <form class="text-center" style="color: #757575;" method="POST" action="">

                              <!-- login -->
                              <div class="md-form">
                                <input name="login" type="username" id="materialLoginFormUsernam" class="form-control" placeholder="login client" required="required">
                                
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
                              <button type="submit" name="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Connexion</button>

        
                              <p>Nouvel utilisateur?<a href="identification.php"> Inscription </a></p>

                            </form>
                   </div>
                        
              </div>
            
         </div>
      </div>
   </div>  
 </body>


            <div class="col-lg-12">
               <div class="copyright" style="margin-top: 100px "><center style="color: #fff">Copyright © Tous droits réservés.</center></div>
            </div>
     
  
</html>