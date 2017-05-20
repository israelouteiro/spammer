<?php

	require_once '../vendor/swiftmailer/swiftmailer/lib/swift_required.php';
	require_once( "includes/conexao.php" ) ; 



	$total_act= mysql_query(" SELECT * FROM targets WHERE active='true' ");	
	$total_dact= mysql_query(" SELECT * FROM targets WHERE active!='true' ");	
	$total_deliv = mysql_query(" SELECT * FROM targets WHERE delivered='true' ");	

		$tac = 0 ;
		$tdac = 0 ;
		$ted = 0 ;

	if(haveResults($total_act)){ $tac = mysql_num_rows($total_act) ; }
	if(haveResults($total_act)){ $tdac = mysql_num_rows($total_dact) ; }
	if(haveResults($total_deliv)){ $ted = mysql_num_rows($total_deliv) ; }

	$response = Array( 'actives' => $tac ,
					'deactives' => $tdac ,
					'deliveries'=> $ted );

	echo json_encode($response);