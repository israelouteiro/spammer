<html lang="en" >
<head>
  <meta name="charset" content="utf-8">
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

    .controller('AppCtrl', ['$scope', '$interval', '$http','$mdDialog', function($scope, $interval, $http, $mdDialog) {
	var self = this, j= 0, counter = 0;
 
		self.mode_type;
    	self.determinateValue = 0; 
    	self.totalSended = 0;
    	self.totalReceived = 0;
    	self.mode_production = false;
    	self.production_emails = [ ];
    	self.development_emails = [ ]; 
    	self.sending = false;
    	self.carregando = false;

	    self.changeMode = function(){ 
	    	self.current_mode = self.mode_production ? "Modo Produção" : "Modo Teste";
	    	self.target_emails = self.mode_production ? self.production_emails : self.development_emails ;
	    	// console.info( "Switched to: ", self.current_mode );
	    }	

	    function init(){ 
	    	self.carregando = true;
	    	getTarget('development');
	    	getTarget('production');
	    	//	Just for animation ..
	    	$interval(function() {
		      self.determinateValue += 0; 
		      if (self.determinateValue > 100) self.determinateValue = 1; 
		    }, 100, 0, true);
	    };

	    self.sentMails = function(){
	    	self.sending = true;
		    	$('html, body').animate({
		    		scrollTop: 0
		    	},'fast');
	    	for( var ch in self.target_emails ){
	    		var target =  self.target_emails[ch]
	    		// console.log('target',target)
	    		sendTo(target.email);
	    	}
	    };

	    self.verifySending = function(){
	    	return self.sending;
	    }

	    self.showAlert = function() { 
		    $mdDialog.show(
		      $mdDialog.alert()
		        .parent(angular.element(document.querySelector('#popupContainer')))
		        .clickOutsideToClose(true)
		        .title('<?php echo APPLICATION_NAME; ?>')
		        .textContent('Envio concluido!')
		        .ariaLabel('Alert')
		        .ok('OK')
		    );
		};

	    init();

	    function getTarget(mode){
	    	$http.get( "service/getTargets.php?mode=" + mode )
	    	.then(function(response){
	    		if(response.data.status == 'success'){
	    			if(response.data.mode == 'production'){
	    				self.production_emails = JSON.parse( response.data.data );
	    				self.changeMode();
	    				self.carregando = false;
	    			}else{
	    				self.development_emails = JSON.parse( response.data.data );
	    			} 
	    		}else{
	    			console.warn('error-success', response );
	    		}
	    	}).catch(function(error){
	    		console.warn('error', error);
	    	});
	    } 

	    function sendTo(email){
	    	var body = $('#mail_content').val();
	    	var subject = $('#mail_subject').val();
	    	self.totalSended++;
	    	$http.post( "sender.php", {  body: body, subject: subject, target_mail: email } )
	    	.then(function(response){
	    		receiveResponse()
	    		// console.log('sender-sucess',response);
	    		if(response=='remove'){
	    			removeItem(email);
	    		}
	    	}).catch(function(error){
	    		receiveResponse()
	    		console.warn('error', error);
	    	});
	    }

	    function receiveResponse(){
	    	self.totalReceived ++; 
    		if( self.totalReceived >= self.totalSended ){
    			self.sending = false;
    			self.totalReceived = 0;
    			self.totalSended = 0;
    			self.determinateValue = 0; 
    			self.showAlert()
    		}else{
    			self.determinateValue = Math.round((self.totalReceived*100)/self.totalSended);
    		}
	    }

	    function removeItem(email){
	    	$http.post( "remove_sender.php", { target_mail: email } )
	    	.then(function(response){}).fail(function(){});
	    }

	    $scope.removeTarget = function(tar){

	    	var indexRemove = self.target_emails.indexOf(tar) ;
	 		self.target_emails.splice(	indexRemove , 1 );
 
	    }

  }]);
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
 	  <h4 class="text-center" ng-if="vm.verifySending()"> ( {{ vm.totalReceived }} / {{ vm.totalSended }} ) </h4>

 	  <div>
 	  		<md-progress-linear md-mode="determinate" class="custom-loaders" ng-if="vm.verifySending()"
 	  		value="{{ vm.determinateValue }}"></md-progress-linear>
 	  </div> 

      <div class="col-sm-4 col-xs-12" style="overflow: auto; height: 558px;" ng-if="!vm.carregando">
 
	        
        <h4 class="colorido">{{ vm.current_mode }}</h4>

        <md-switch ng-change="vm.changeMode()" ng-model="vm.mode_production" aria-label="Switch 1">
		  <b>{{ vm.target_emails.length }}</b> Emails Encontrados 
		</md-switch>
 
      	<md-list ng-if="!vm.mode_production">
      		<md-list-item ng-repeat=" target in  vm.target_emails " class="secondary-button-padding">
			    <p>{{ target.email }}</p>
			    <md-button class="md-icon-button" ng-click="removeTarget(target)">
			    	<md-icon class="material-icons" >
		            	delete
		            </md-icon>
			    </md-button>
			</md-list-item>
      	</md-list>
      </div>

      <div class="col-sm-4 col-xs-12" ng-if="vm.carregando"> 
      	<md-progress-circular md-mode="indeterminate" style="margin:60px auto;"></md-progress-circular>
      </div>
      
      <div class="col-sm-8 col-xs-12">

	 	  <md-input-container class="subject">
	        <label>Assunto</label>
	        <input id="mail_subject" value="Uma Nova Utopia para o Brasil">
	      </md-input-container>  
	      
		    <md-input-container class="md-block">
	          <label>Digite o email aqui</label>
	          <textarea rows="5" md-select-on-focus id="mail_content"></textarea>
	        </md-input-container>
 
	 	  <div class="text-center col-xs-12"> 

	 	   	<md-progress-circular ng-if="vm.verifySending()" style="margin:auto;" md-mode="indeterminate"></md-progress-circular>

	        <md-button type="submit" class="md-raised md-primary m-top-13" 
	        ng-disabled="vm.verifySending()" ng-click="vm.sentMails()" >Enviar</md-button>

	      </div>

      </div>

      


  </div>

  
</body>
</html>

<!--

Copyright 2016 Google Inc. All Rights Reserved. 
Use of this source code is governed by an MIT-style license that can be in foundin the LICENSE file at 
http://material.angularjs.org/license.

-->