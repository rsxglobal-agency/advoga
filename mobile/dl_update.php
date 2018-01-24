<?php

	include_once 'conexao.php';

	$id = $_POST['id'];
	$titulodemanda =  utf8_decode($_POST['titulo']);
	$descricaodemanda =  utf8_decode($_POST['descricao']);
	$estado = utf8_decode($_POST['estado']);
	$cidade = utf8_decode($_POST['cidade']);
	$id_areasdeatuacao = $_POST['areasdeatuacao'];
	$id_servicosprestados = $_POST['servicosprestados'];
	$dbpass = $_POST['dbpass'];

	if($dbpass == "PcxtRlor2135@!:.BRO"){

		$titulodemanda = str_replace("\"","\\\"", $titulodemanda);
		$descricaodemanda = str_replace("\"","\\\"", $descricaodemanda);
		$titulodemanda = str_replace("'","\'", $titulodemanda);
		$descricaodemanda = str_replace("'","\'", $descricaodemanda);
		$cidade = str_replace("'","\'", $cidade);

		$aa_splited = explode(",", $id_areasdeatuacao);
		// reset
		$sql_delete = $dbcon->query("DELETE FROM atuation_demand WHERE demand_id='$id'");
		for ($i = 0; $i < sizeof($aa_splited); $i++){
			$sql_insert = $dbcon->query("INSERT INTO atuation_demand (atuation_id, demand_id) VALUES ('$aa_splited[$i]', '$id')");
		}

		$sp_splited = explode(",", $id_servicosprestados);
		// reset
		$sql_delete = $dbcon->query("DELETE FROM demand_service WHERE demand_id='$id'");
		for ($i = 0; $i < sizeof($sp_splited); $i++){
			$sql_insert = $dbcon->query("INSERT INTO demand_service (service_id, demand_id) VALUES ('$sp_splited[$i]', '$id')");
		}

		$sql_estado_id = $dbcon->query("SELECT id FROM states WHERE sigla='$estado'");
		$sql_estado_id_r = $sql_estado_id->fetch_array();
		$estado_id = $sql_estado_id_r['id'];

		$sql_cidade_id = $dbcon->query("SELECT id FROM cities WHERE name='$cidade'");
		$sql_cidade_id_r = $sql_cidade_id->fetch_array();
		$cidade_id = $sql_cidade_id_r['id'];

		echo "UPDATE demands SET name='$titulodemanda', description='$descricaodemanda', city_id='$cidade_id', state_id='$estado_id' WHERE id='$id'";
		$sql = $dbcon->query("UPDATE demands SET name='$titulodemanda', description='$descricaodemanda', city_id='$cidade_id', state_id='$estado_id' WHERE id='$id'");

		if ($sql){
			echo "8b9ec2f9b81068fcba2f6fc69e533856";
		}else{
			echo "erro";
		}

	}

?>
