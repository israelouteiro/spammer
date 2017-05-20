<?php

  require_once '../vendor/swiftmailer/swiftmailer/lib/swift_required.php';
	require_once( "../service/includes/conexao.php" ) ;
	require_once('../envoriment.php'); 

		$mode = addslashes($_GET['e']);
	$results = mysql_query(" UPDATE targets SET active='false' WHERE email='$mode' ");	 


   $email_sender = 'divulga@brasilutopia.com.br'; 
   // $email_sender = 'aidemoc@gmail.com'; 

   $message = 'Olá, o email ('.$mode.') acaba de ser removido da lista';

  // sendMail($message, 'Email removido da lista - Projeto Uma Nova Utopia para o Brasil', $email_sender );



?>

<html lang="en" >
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="charset" content="utf-8">
  <title><?php echo APPLICATION_NAME; ?></title>

  <!-- Angular Material style sheet -->
  <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.css">

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="../style.css">
  <link rel="icon" href="../favicon.png">
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
        Ok, você não var mais receber mensagens de Projeto Uma Nova Utopia para o Brasil
      </h1> 

  </div> 
  
</body>
</html>

<!--
Copyright 2016 Google Inc. All Rights Reserved. 
Use of this source code is governed by an MIT-style license that can be in foundin the LICENSE file at http://material.angularjs.org/license.
-->