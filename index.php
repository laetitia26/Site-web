 <?php

require_once 'auth.php';

forcer_utilisateur_connecte()

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
      
                <nav style="margin-left: 450px">
                    <ul class="nav nav-pills">

                    <?php   if (est_connecte()): ?>
                        <li ><a href="logout.php"><button type="button" class="btn btn-danger">Se déconnecter</button></a></li> 
                     <?php  endif ?>

                    </ul>

                </nav>
                 


        <div class="container admin">

            <div class="row">

                <div  class="col-sm-12">

                <h1><strong>produits</strong><a href="insert.php" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-plus"></span> Ajouter </a></h1>
                
                <table class="table table-striped table-bordered">
                    <thead>
                        <th>rid</th>
                        <th>Nom</th>
                        <th>Prix</th>
                        <th>Catégorie</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php

                        require 'database.php';

                        $db = Database::connect();
                       
                        $statement = $db->query('SELECT rid, nom, prix FROM recettes ORDER BY rid DESC');
                        $count = $statement->rowCount();
                        #$recettes = $statement->fetch();
                        echo '<button type="button" class="btn btn-info">Il reste :  <strong>'. $count .'</strong>  Pizzas au stock.</button>';
                        echo "<hr>";
                        echo "<hr>";
                        
                        Database::disconnect();
                     
                        $db = Database::connect();
                        $statement = $db->query('SELECT rid, nom, prix FROM recettes ORDER BY rid DESC');
                        while($recettes = $statement->fetch()) 
                        {
                            echo '<tr>';
                            echo '<td>'. $recettes['rid'] . '</td>';
                            echo '<td>'. $recettes['nom'] . '</td>';
                            echo '<td>'. number_format($recettes['prix'], 2, '.', '') . '</td>';
                            echo '<td>pizza</td>';
                            echo '<td width=300>';
                            echo '<a class="btn btn-default" href="view.php?id='.$recettes['rid'].'"><span class="glyphicon glyphicon-eye-open"></span> Voir</a>';
                            echo ' ';
                            echo '<a class="btn btn-primary" href="update.php?id='.$recettes['rid'].'"><span class="glyphicon glyphicon-pencil"></span> Modifier</a>';
                            echo ' ';
                            echo '<a class="btn btn-danger" href="delete.php?id='.$recettes['rid'].'"><span class="glyphicon glyphicon-remove"></span> Supprimer</a>';
                            echo '</td>';
                            echo '</tr>';


                        }

                        Database::disconnect();
                      ?>
                        
                    </tbody>
                </table>
                
            </div>

          </div>

                <div class="row">

                <div  class="col-sm-12">

                
                <table class="table table-striped table-bordered">
                    <thead>
                        <th>LOGIN CLIENT</th>
                        <th>PIZZA</th>
                        <th>PRIX</th>
                        <th>REF COMMANDE</th>
                        <th>DATE</th>
                         <th>STATUT</th>
                    </thead>
                    <tbody>

                 <?php
                     $prixTotal = 0;       
                     $statement = $db->query("SELECT users.login, recettes.nom AS pizza,recettes.prix,commandes.ref, commandes.statut,commandes.date FROM users INNER JOIN commandes ON users.uid = commandes.uid  INNER JOIN recettes ON recettes.rid = commandes.rid");

                        while($commande = $statement->fetch()) 
                        {
                           

                            echo '<tr>';
                            echo '<td>'. $commande['login'] . '</td>';
                            echo '<td>'. $commande['pizza'] . '</td>';
                            echo '<td>'. $commande['prix'] . '</td>';
                            echo '<td>'. $commande['ref'] . '</td>';
                            echo '<td>'. $commande['date'] . '</td>';
                            echo '<td>' .$commande['statut'];echo'</td>';
                            echo '</td>';
                            echo '</tr>';
                            $prixTotal += $commande['prix'];

                        }
                        echo' <h1><strong>commandes</strong><a class="btn btn-success btn-lg"><span class="glyphicon glyphicon-plus"></span> Prix total:'.$prixTotal.'€</a></h1>';
                        echo "<hr>";
                        echo "<hr>";

                        Database::disconnect();
                       
                  ?>
                        
                    </tbody>
                </table>
                
            </div>

          </div>

          <div class="row">

                <div  class="col-sm-12">

                <h1><strong>Suppléments</strong><a href="addSupplement.php" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-plus"></span> Ajouter un supplément</a></h1>
                
                
                <table class="table table-striped table-bordered">
                    <thead>
                        <th>SID</th>
                        <th>Nom</th>
                        <th>Prix</th>
                        <th>Action</th>
                    
                    </thead>
                    <tbody>
                        <?php
                        Database::connect();
                        $statement = $db->query('SELECT * FROM supplements ORDER BY sid DESC');
                        
                        $supplement = $statement->fetch();
                        $count = $statement->rowCount();

                        echo '<button type="button" class="btn btn-info">Vous proposez :  <strong>'. $count .'</strong>  supplements.</button>';
                        echo "<hr>";
                        echo "<hr>";
                        Database::disconnect();

                        Database::connect();
                       $statement = $db->query('SELECT * FROM supplements ORDER BY sid DESC');
                        while($supplement = $statement->fetch()) 
                        {
                            echo '<tr>';
                            echo '<td>'. $supplement['sid'] . '</td>';
                            echo '<td>'. $supplement['nom'] . '</td>';
                            echo '<td>'. number_format($supplement['prix'], 2, '.', '') . '</td>';
                            echo '<td width=300>';
                            #echo '<a class="btn btn-default" href="view.php?id='.$supplement['sid'].'"><span class="glyphicon glyphicon-eye-open"></span> Voir</a>';
                            echo ' ';
                            echo '<a class="btn btn-primary" href="updateSupplement.php?id='.$supplement['sid'].'"><span class="glyphicon glyphicon-pencil"></span> Modifier</a>';
                            echo ' ';
                            echo '<a class="btn btn-danger" href="deleteSupplement.php?id='.$supplement['sid'].'"><span class="glyphicon glyphicon-remove"></span> Supprimer</a>';
                            echo '</td>';
                            echo '</tr>';


                        }

                        Database::disconnect();
                      ?>
                        
                    </tbody>
                </table>
                
            </div>

          </div>



        </div>

   
            <div class="col-lg-12">
               <div class="copyright" style="margin-top: 100px "><center style="color: #fff">Copyright © Tous droits réservés.</center></div>
            </div>
     

    </body>

</html>