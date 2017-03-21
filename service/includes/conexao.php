<?php


	ob_start(); 

/*
 $cxn = new conexao;
 $cxn-> host= "localhost";
 $cxn-> user= "spammer";
 $cxn-> senha= "spammy12#$";
 $cxn-> banco= "spammer";

*/

 $cxn = new conexao;
 $cxn-> host= "mysql.israelouteiro.com";
 $cxn-> user= "israelouteiro";
 $cxn-> senha= "israel12!@";
 $cxn-> banco= "israelouteiro";



	  $cxn->conecta_banco(); 
 

 	class conexao
	{
		var $host;
		var $user;
		var $senha;
		var $banco;
		function conecta_banco()
		{
			mysql_connect($this->host, $this->user, $this->senha) or die (mysql_error());
			mysql_select_db($this->banco) or die (mysql_error());
			mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
		}
	}

	function haveResults($query){
		if($query&&mysql_num_rows($query)>0){
			return true;
		}
		return false;
	}

	function getAgora(){
		date_default_timezone_set('America/Sao_Paulo');
		return date('Y-m-d H:i:s');
	}

	function my2array($sth){
		$rows = array();
		while($r = mysql_fetch_assoc($sth)) {
		    $rows[] = $r;
		}
		return json_encode($rows);
	}


	function sendMail($message, $subject, $target_mail){
		
		$idmail = time() . '.' . uniqid('prd') . date('YmdHis') . '@domain.co' ; 
		$email_sender = 'divulga@brasilutopia.com.br';  

		$array_sender = array( $email_sender => 'Projeto Uma Nova Utopia para o Brasil') ;  

		$transport = Swift_SmtpTransport::newInstance('email-smtp.us-east-1.amazonaws.com', 465, 'ssl')
		 	-> setUsername('AKIAJRXMNCWRIC2LKEMQ')
		 	-> setPassword('Ao5UNSulHa0AarjkTLK+v1xUm3DwLyMACdLi9NyFj24n'); 
	 	try{

	 		$mailer = Swift_Mailer::newInstance( $transport );
			$message = Swift_Message::newInstance()
		            ->setId( $idmail )
		            ->setTo( array( $target_mail) )
		            ->setSubject( $subject )
		            ->setContentType('text/html')
		            ->setBody( $message )
		            ->setSender( $email_sender )
		            ->setReplyTo( $email_sender )
		            ->setReturnPath( $email_sender )
		            ->setFrom( $array_sender );

		    $headers = $message->getHeaders();
			$headers->addPathHeader( 'Return-Path' , $email_sender );

			return	$status = $mailer->send( $message ) ;

	 	}catch(Exception $e){    
	 		return 'catch';
	 	}	
	
	}



?>

