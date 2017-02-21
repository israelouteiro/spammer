<?php

 	require_once 'vendor/swiftmailer/swiftmailer/lib/swift_required.php';

 	function sendMail($message, $subject, $target_mail){
		
		$idmail = time() . '.' . uniqid('prd') . date('YmdHis') . '@domain.co' ;
		$array_sender = array('' => '') ;

		$transport = Swift_SmtpTransport::newInstance('', 465, 'ssl')
		 	-> setUsername('')
		 	-> setPassword(''); 
	 	try{

	 		$mailer = Swift_Mailer::newInstance($transport);
			$message = Swift_Message::newInstance()
		            ->setId( $idmail )
		            ->setSender( $array_sender )
		            ->setTo( array($target_mail) )
		            ->setReplyTo( $array_sender )
		            ->setSubject($subject)
		            ->setContentType('text/html')
		            ->setBody($message)
		            ->setFrom( $array_sender );

			return	$status = $mailer->send($message) ;

	 	}catch(Exception $e){  
	 		var_dump($e); 
	 		return '<br><br>##catcha';
	 	}	
	
	}

	echo sendMail( $_POST['body'], $_POST['subject'], $_POST['target_mail'] );