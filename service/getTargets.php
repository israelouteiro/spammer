<?php


	require_once( "includes/conexao.php" ) ;

		$mode = addslashes($_GET['mode']);
	$results = mysql_query(" SELECT * FROM targets WHERE mode='$mode' AND active='true' ");	

	if(haveResults($results)){
		echo json_encode( array( 'status' => 'success' , 'data' =>  my2array($results) , 'mode' => $mode ) );
	}else{
		echo json_encode( array( 'status' => 'error' , 'message' => 'not found' ) );
	}

