<?php

require 'database.php';


if(isset($_POST['submit'])) {
 $nom = checkInput($_POST['nom']) ;
 $prenom = checkInput($_POST['prenom']);
 $login = checkInput($_POST['login']);
 $mdp = checkInput($_POST['password']);
 $repeatmdp = checkInput($_POST['repeatpassword']);
 $role = 'user';
 
     if ($login&&$mdp&&$repeatmdp&&$nom&&$prenom) 
     {
        if ($mdp == $repeatmdp) 
        {
              $mdp = md5($mdp);
              #On se connecte pour insérer les données 
              $db = Database::connect();

              #S'assurer qu'il le login n'existe pas dans la bdd
              $statement = $db->query("SELECT * FROM users WHERE login = '$login' ") ;
              if ($users = $statement->fetch())
               {
                echo' <script type="text/javascript">
                        alert("Ce login est déja pris par un autre utilisateur!")
                            
                         </script>';
               }else

                   {
                     $statement = $db->prepare("INSERT INTO users(nom, prenom, login, mdp, role) VALUES(?, ?, ?, ?,?)");
                     $statement->execute(array($nom,$prenom,$login,$mdp, $role));
                     Database::disconnect();
                     header("Location: login.php");
                  }
             
         
        }else echo '<script type="text/javascript">
                   // Mon code Javascript
                    alert("Les deux champs mot de passe doivent être les mêmes !!")
                  </script>';
       
     }else echo '<script type="text/javascript">
                   // Mon code Javascript
                    alert("Veuiller saisir tout les champs !")
                  </script>';

           
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

            <div class="container admin" >

              <nav>
                    <ul class="nav nav-pills">
                        <li role="presentation" class="active"><a href="#1" data-toggle="tab"> Clients </a> </li>

                        <li role="presentation" ><a href="#2" data-toggle="tab">Administration </a> </li>
                          
                    </ul>
                </nav>

         <div class="tab-content">  

           <div class= "tab-pane active" id="1" >
            
          <!-- Material form login -->
          
               <div class="col-sm-6 md-form site"  >
                 
                <h1><strong> Inscription  </strong></h1>
               <hr>
               <hr>
                        <div class="card" >

                          <h5 class="card-header info-color white-text text-center py-4">
                            <strong> Enregistrement </strong>
                          </h5>

                          <!--Card content-->
                          <div class="card-body px-lg-5 pt-0">

                            <!-- Form -->
                            <form class="text-center" style="color: #757575;" method="POST" action="#" >

                              <!-- Nom -->
                              <div class="md-form">
                                <input name="nom" type="username" id="materialLoginFormEmail" class="form-control" placeholder="Nom">
                                
                              </div>


                              <!-- Prenom -->
                              <div class="md-form">
                                <input name="prenom" type="username" id="materialLoginFormEmail" class="form-control" placeholder="Prenom">
                                
                              </div>

                              <!-- login -->
                              <div class="md-form">
                                <input name="login" type="username" id="materialLoginFormPassword" class="form-control" placeholder="login" required="required">
                                
                              </div>

                              <!-- Password -->
                              <div class="md-form">
                                <input name="password" type="password" id="materialLoginFormPassword" class="form-control" placeholder="Mot de passe" required="required">
                               
                              </div>

                               <!-- Password -->
                              <div class="md-form">
                                <input name="repeatpassword" type="password" id="materialLoginFormPassword" class="form-control" placeholder="Mot de passe" required="required">
                              </div>

                              <div class="d-flex justify-content-around">
                                <div>
                                  <!-- Remember me -->
                                  <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="materialLoginFormRemember">
                                    <label class="form-check-label" for="materialLoginFormRemember">Se souvenir de moi! </label>
                                  </div>
                                </div>

                               

                              <!-- Sign in button -->
                             <!-- <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit"> Connexion </button> -->
                              <button type="submit" name="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Valider mes données</button>

                              
                            </form>
                            <!-- Form -->

                          </div>

                        </div>
                        <!-- Material form login -->
                    
 

        </div>

 </div>

        <div class= "tab-pane " id="2" >
          

          <!-- Material form login -->

               <div class="col-sm-6 md-form site" >
                <h1><strong> Inscription  </strong></h1>
               <hr>
               <hr>
                        <div class="card" >

                          <h5 class="card-header info-color white-text text-center py-4">
                            <strong> Enregistrement </strong>
                          </h5>

                          <!--Card content-->
                          <div class="card-body px-lg-5 pt-0">

                            <!-- Form -->
                            <form class="text-center" style="color: #757575;" method="POST" action="#" >

                              <!-- Nom -->
                              <div class="md-form">
                                <input name="nom" type="username" id="materialLoginFormEmail" class="form-control" placeholder="Nom">
                                
                              </div>


                              <!-- Prenom -->
                              <div class="md-form">
                                <input name="prenom" type="username" id="materialLoginFormEmail" class="form-control" placeholder="Prenom">
                                
                              </div>

                              <!-- login -->
                              <div class="md-form">
                                <input name="login" type="username" id="materialLoginFormPassword" class="form-control" placeholder="login" required="required">
                                
                              </div>

                              <!-- Password -->
                              <div class="md-form">
                                <input name="password" type="password" id="materialLoginFormPassword" class="form-control" placeholder="Mot de passe" required="required">
                               
                              </div>

                               <!-- Password -->
                              <div class="md-form">
                                <input name="repeatpassword" type="password" id="materialLoginFormPassword" class="form-control" placeholder="Mot de passe" required="required">
                              </div>

                              <div class="d-flex justify-content-around">
                                <div>
                                  <!-- Remember me -->
                                  <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="materialLoginFormRemember">
                                    <label class="form-check-label" for="materialLoginFormRemember">Se souvenir de moi! </label>
                                  </div>
                                </div>

                               

                              <!-- Sign in button -->
                             <!-- <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit"> Connexion </button> -->
                              <button type="submit" name="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Valider mes données</button>

                              
                            </form>
                            <!-- Form -->

                          </div>

                        </div>
                        <!-- Material form login -->
                      </div>
                
                 </div>
            </div> 

    
     
    </body>
</html>