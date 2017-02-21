<html lang="en" >
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo APPLICATION_NAME; ?></title>
  <!-- Angular Material style sheet -->
  <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.css">

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
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
    var app = angular.module('BlankApp', ['ngMaterial'])

    .controller('AppCtrl', ['$scope', '$interval', function($scope, $interval) {
    var self = this, j= 0, counter = 0;

    self.mode = 'query';
    self.activated = true;
    self.determinateValue = 30; 

    self.showList = [ ];

    /**
     * Turn off or on the 5 themed loaders
     */
    self.toggleActivation = function() {
        if ( !self.activated ) self.showList = [ ];
        if (  self.activated ) {
          j = counter = 0;
          self.determinateValue = 30; 
        }
    };

    $interval(function() {
      self.determinateValue += 1; 

      if (self.determinateValue > 100) self.determinateValue = 30; 

        // Incrementally start animation the five (5) Indeterminate,
        // themed progress circular bars

        if ( (j < 2) && !self.showList[j] && self.activated ) {
          self.showList[j] = true;
        }
        if ( counter++ % 4 === 0 ) j++;

        // Show the indicator in the "Used within Containers" after 200ms delay
        if ( j == 2 ) self.contained = "indeterminate";

    }, 100, 0, true);

    $interval(function() {
      self.mode = (self.mode == 'query' ? 'determinate' : 'query');
    }, 7200, 0, true);
  }]);
  </script>	

  <!-- include summernote css/js-->
	<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
	<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>

  <script>
  	$(document).ready(function(){
  		$('textarea').summernote({
  		  height: 420,
		  focus: true       
  		});
  	})
  </script>


  <div class="container" ng-controller="AppCtrl as vm" >
      
      <div class="text-right m-top-20">
      	<md-button class="md-fab" aria-label="Sair" onclick="location.href='logout.php'">
            <md-icon class="material-icons" >
            	exit_to_app
            </md-icon>
        </md-button>
      </div>

      <h1 class="text-center header-spammer-dash">
        <?php echo APPLICATION_NAME; ?>
      </h1>
 		
 	  <div>
 	  		<md-progress-linear md-mode="determinate" value="{{ vm.determinateValue }}"></md-progress-linear>
 	  </div> 

 	  <textarea style="480px">
 	  	
 	  </textarea>


 	  <div class="text-right">
        <md-button type="submit" class="md-raised md-primary">Enviar</md-button>
      </div>


  </div>

  
</body>
</html>

<!--
Copyright 2016 Google Inc. All Rights Reserved. 
Use of this source code is governed by an MIT-style license that can be in foundin the LICENSE file at http://material.angularjs.org/license.
-->