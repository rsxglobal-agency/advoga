<?php

	error_reporting(E_ALL);
	ini_set("display_errors", "On");

	$photopath = "../../advogateste/public/uploads/avatars/";

	$host = "mysql.advoga.adv.br";
	$usuario = "advoga";
	$senha = "advoga950843";
	$bd = "advoga";

	$dbcon = new MySQLi($host, $usuario, $senha, $bd);

	if ($dbcon->connect_error){
		echo "conexao_erro";
	}

?>
