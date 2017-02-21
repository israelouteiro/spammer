<?php
	ob_start();
	session_start();
	session_set_cookie_params((60*30*1024),'/','.'.str_replace('www','',$_SERVER['HTTP_HOST']),true,true);

	require_once('envoriment.php'); 

		if( isset( $_SESSION['spammer_logged']['authorized'] ) 
		&& !empty( $_SESSION['spammer_logged']['authorized'] ) 
		&&   $_SESSION['spammer_logged']['authorized'] != '' ){
			require_once('dashboard.php');
		}else{
			require_once('login.php');
		}

?>