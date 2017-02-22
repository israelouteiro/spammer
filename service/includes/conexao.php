<?php
ob_start(); 

 $cxn = new conexao;
 $cxn-> host= "localhost";
 $cxn-> user= "spammer";
 $cxn-> senha= "spammy12#$";
 $cxn-> banco= "spammer";

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

?>
