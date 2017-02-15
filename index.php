<?php

 	require_once 'vendor/swiftmailer/swiftmailer/lib/swift_required.php';

 	function mandaEmail($mensagem,$assunto,$xmail){
		
		
		$idmail = time() . '.' . uniqid('prd') . date('YmdHis') . '@voter.com.br' ;
		$array_sender = array('atendimento@voter.com.br' => 'Atendimento Voter') ;
		
		/*  $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')
			-> setUsername('aidemoc@gmail.com')
		 	-> setPassword('');  */

		$transport = Swift_SmtpTransport::newInstance('email-smtp.us-west-2.amazonaws.com', 465, 'ssl')
		 	-> setUsername('')
		 	-> setPassword('');
		
	 	try{

	 		$mailer = Swift_Mailer::newInstance($transport);
			$message = Swift_Message::newInstance()
		            ->setId( $idmail )
		            ->setSender( $array_sender )
		            ->setTo( array($xmail) )
		            ->setReplyTo( $array_sender )
		            ->setSubject($assunto)
		            ->setContentType('text/html')
		            ->setBody($mensagem)
		            ->setFrom( $array_sender );

			return	$status = $mailer->send($message) ;


	 	}catch(Exception $e){  var_dump($e); return 'catcha'; }	
	
	}


	echo mandaEmail('Body of test','This is a Test','aidemoc@gmail.com');