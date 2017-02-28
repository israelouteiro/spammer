<?php
	if( isset($_POST['mail']) && !empty($_POST['mail']) 
	&&  isset($_POST['passwd']) && !empty($_POST['passwd']) ){

    include "service/includes/conexao.php";

    $mail = addslashes($_POST['mail']);
    $pass = sha1( ($_POST['passwd']) ) ;

      $logou = mysql_query(" SELECT * FROM users_sender WHERE email='$mail' AND password='$pass' ");

		if(haveResults($logou)){

			$_SESSION['spammer_logged']['authorized'] = 'yeah' ;
      $_SESSION['spammer_logged']['mail'] = $mail ;

      $oid = mysql_result(" MYSQL ");
      $now = getAgora();
        mysql_query(" UPDATE users_sender SET last_access='$now' WHERE id='$oid' ");

			header('Location:index.php');
		}else{
      $error = "Credenciais inválidas" ;
    }
	} 
?>  
<html lang="en" >
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo APPLICATION_NAME; ?></title>
  <!-- Angular Material style sheet -->
  <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.css">

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <link rel="icon" href="favicon.png">
</head>
<body ng-app="BlankApp" ng-cloak>
  <!--
    Your HTML content here
  -->  
  
  <!-- Angular Material requires Angular.js Libraries -->
  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-animate.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-aria.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-messages.min.js"></script>

  <!-- Angular Material Library -->
  <script src="http://ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  
  <!-- Your application bootstrap  -->
  <script type="text/javascript">    
    /**
     * You must include the dependency on 'ngMaterial' 
     */
    angular.module('BlankApp', ['ngMaterial']);
  </script>


  <div class="container">
      
      <h1 class="text-center header-spammer">
        <?php echo APPLICATION_NAME; ?>
      </h1>

      <h3><?php echo $error; ?></h3>

      <form action="" method="post">
        <div class="col-sm-6 col-sm-offset-3">
          <md-input-container class="cool-input">
            <label>Email</label>
            <input name="mail" type="email">
          </md-input-container>
          <md-input-container class="cool-input">
            <label>Password</label>
            <input name="passwd" type="password">
          </md-input-container>

          <div class="text-center">
            <md-button type="submit" class="md-raised md-primary">Entrar</md-button>
          </div>

        </div>

        

      </form>

  </div>

  
</body>
</html>

<!--
Copyright 2016 Google Inc. All Rights Reserved. 
Use of this source code is governed by an MIT-style license that can be in foundin the LICENSE file at http://material.angularjs.org/license.
-->