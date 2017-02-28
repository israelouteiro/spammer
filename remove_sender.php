<?php
 
 	require_once 'service/includes/conexao.php';
 	$postdata = file_get_contents("php://input");
	$request = json_decode($postdata); 
	
mysql_query(" UPDATE targets SET active='false' WHERE email='".$request->target_mail."' ");	
