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
		
		if( $notificationStatus == 'Delivery' ){
			$mail_bounce = 'delivered';
		}

		if( $notificationStatus == 'Bounce' ){
			$bounce_received = $mail_bounce['bounce'];
			$mail_bounce = '';
			foreach ($bounce_received['bouncedRecipients'] as $key => $value) {
				$email_bounced = $value['emailAddress'];
				setDeactive($email_bounced);
				mysql_query(" INSERT INTO sender_status SET status='bounced::$email_bounced' ");
			}
		}
	}


	function setDeactive($email){
		mysql_query(" UPDATE targets SET active='false' WHERE email='$email' ");	
	} 