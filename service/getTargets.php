<?php

	require_once '../vendor/swiftmailer/swiftmailer/lib/swift_required.php';
	require_once( "includes/conexao.php" ) ;

		$mode = addslashes($_GET['mode']);
		
		if($mode=='production'){
			$results = mysql_query(" SELECT * FROM targets WHERE mode='$mode' AND active='true' AND delivered='false' AND sended!='true' LIMIT 1000 ");	
		}else{
			$results = mysql_query(" SELECT * FROM targets WHERE mode='$mode' AND active='true' LIMIT 1000 ");	
		}
	

	if(haveResults($results)){
		echo json_encode( array( 'status' => 'success' , 'data' =>  my2array($results) , 'mode' => $mode ) );
	}else{
		echo json_encode( array( 'status' => 'error' , 'message' => 'not found' ) );
	}

