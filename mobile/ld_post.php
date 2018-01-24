<?php

error_reporting(E_ALL);
ini_set("display_errors", "On");

	include_once 'conexao.php';

	$id_user = $_POST['id_user'];
	$id_areasdeatuacao = $_POST['id_areasdeatuacao'];
	$id_servicosprestados = $_POST['id_servicosprestados'];
	$titulodemanda = utf8_decode($_POST['titulodemanda']);
	$descricaodemanda = utf8_decode($_POST['descricaodemanda']);
	$estado = $_POST['estado'];
	$cidade = utf8_decode($_POST['cidade']);
	$data = $_POST['data'];
	$dbpass = $_POST['dbpass'];

	if($dbpass == "PcxtRlor2135@!:.BRO"){

		$titulodemanda = str_replace("\"","\\\"", $titulodemanda);
		$descricaodemanda = str_replace("\"","\\\"", $descricaodemanda);
		$pass = false;

		$sql_estado_id = $dbcon->query("SELECT id FROM states WHERE sigla='$estado'");
		$sql_estado_id_r = $sql_estado_id->fetch_array();
		$estado_id = $sql_estado_id_r['id'];

		$sql_cidade_id = $dbcon->query("SELECT id FROM cities WHERE name='$cidade'");
		$sql_cidade_id_r = $sql_cidade_id->fetch_array();
		$cidade_id = $sql_cidade_id_r['id'];

		$sql1 = $dbcon->query("
			INSERT INTO demands (name, description, user_id, state_id, city_id, created_at)
			VALUES ('$titulodemanda', '$descricaodemanda', '$id_user', '$estado_id', '$cidade_id', '$data')");

		if ($sql1){

			$id = $dbcon->insert_id;

			$aa_splited = explode(",", $id_areasdeatuacao);
			for ($i = 0; $i < sizeof($aa_splited); $i++){
				$sql_insert = $dbcon->query("
				INSERT INTO atuation_demand(atuation_id, demand_id)
				VALUES ('$aa_splited[$i]', '$id')");
				if ($sql_insert)
					$pass = true;
			}

			$sp_splited = explode(",", $id_servicosprestados);
			for ($i = 0; $i < sizeof($sp_splited); $i++){
				$sql_insert = $dbcon->query("
				INSERT INTO demand_service(service_id, demand_id)
				VALUES ('$sp_splited[$i]', '$id')");
				if ($sql_insert)
					$pass = true;
			}

			if ($pass)
					echo "caf833fe93e37b5e770f4cd2e3cb46fa";

		}else{
			echo "erro";
		}
	}

?>
