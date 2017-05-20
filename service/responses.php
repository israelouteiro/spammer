<?php

	require_once '../vendor/swiftmailer/swiftmailer/lib/swift_required.php';
	require_once( "includes/conexao.php" ) ;

		$all = file_get_contents('php://input');

	$response = json_decode($all, true);
	
	// Delivery
	// Bounce
	// Complaint


	if( $response ){ 
		$mail_bounce = json_decode( $response['Message'] , true );
		$notificationStatus = $mail_bounce['notificationType']; 
		$email_response = '';

		if( $notificationStatus == 'Delivery' ){
			$email_response = $mail_bounce['mail']['source'];
			setDelivered($email_response);
			mysql_query(" INSERT INTO sender_status SET status='delivered::$email_response' ");
		}

		if( $notificationStatus == 'Bounce' ){
			$bounce_received = $mail_bounce['bounce'];
			foreach ($bounce_received['bouncedRecipients'] as $key => $value) {
				$email_response = $value['emailAddress'];
				setDeactive($email_response);
				mysql_query(" INSERT INTO sender_status SET status='bounced::$email_response' ");
			}
		} 
	}


	function setDeactive($email){
		mysql_query(" UPDATE targets SET active='false' WHERE email='$email' ");	
	} 

	function setDelivered($email){
		mysql_query(" UPDATE targets SET delivered='true' WHERE email='$email' ");	
	} 


	mysql_query(" INSERT INTO sender_status SET status='fuiNotificado' ");

	//

	mysql_query(" INSERT INTO sender_status SET status='genericResponse::$response' ");