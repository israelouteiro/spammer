<?php
	ob_start();
	session_start();
	session_set_cookie_params((60*30*1024),'/','.'.str_replace('www','',$_SERVER['HTTP_HOST']),true,true);
	session_destroy();
	header('Location:index.php');
	
?>