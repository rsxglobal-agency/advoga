<?php

	include_once 'conexao.php';

	$dbpass = $_POST['dbpass'];
	$id_user = $_POST['id_user'];

	if($dbpass == "PcxtRlor2135@!:.BRO"){
		$sql_name = $dbcon->query("SELECT name FROM users WHERE id='$id_user'");
		$result = $sql_name->fetch_array();
		$nome = utf8_encode($result['name']);

		$sql = $dbcon->query("SELECT * FROM demands WHERE user_id='$id_user' AND executor_id IS NULL ORDER BY created_at DESC");

		if (mysqli_num_rows($sql) > 0){
			echo "6baa8d3513caf76b0982b39672680567";

			$post = array();
			while($fetch = $sql->fetch_array()){
				$id_servicosprestados = '';
				$id_areasdeatuacao = '';
		    $aa_tx = '';
		    $sp_tx = '';

		    $id = $fetch['id'];

				// ÁREAS DE ATUAÇÃO DA DEMANDA
				$sql_atuacao_id = $dbcon->query("SELECT atuation_id FROM atuation_demand WHERE demand_id='$id'");
				while ($sql_atuacao_id_r = $sql_atuacao_id->fetch_array()){
					$id_areasdeatuacao .= $sql_atuacao_id_r['atuation_id']. ',';
				}

				$id_areasdeatuacao = substr($id_areasdeatuacao, 0, -1);
				$aa_splited = explode(",", $id_areasdeatuacao);

				for ($i = 0; $i < sizeof($aa_splited); $i++){
					$sql2 = $dbcon->query("SELECT name FROM atuations WHERE id='$aa_splited[$i]'");
					$result = $sql2->fetch_array();
					$aa_tx .= utf8_encode($result['name'].', ');
				}

				$aa_tx = substr($aa_tx, 0, -2);

				// SERVIÇOS PRESTADOS DA DEMANDA
				$sql_servico_id = $dbcon->query("SELECT service_id FROM demand_service WHERE demand_id='$id'");

				while ($sql_servico_id_r = $sql_servico_id->fetch_array()){
					$id_servicosprestados .= $sql_servico_id_r['service_id']. ',';
				}

				$id_servicosprestados = substr($id_servicosprestados, 0, -1);
				$sp_splited = explode(",", $id_servicosprestados);

				for ($i = 0; $i < sizeof($sp_splited); $i++){
					$sql2 = $dbcon->query("SELECT name FROM services WHERE id='$sp_splited[$i]'");
					$result = $sql2->fetch_array();
					$sp_tx .= utf8_encode($result['name'].', ');
				}

				$sp_tx = substr($sp_tx, 0, -2);

				//
				$titulo = utf8_encode($fetch['name']);
				$descricao = utf8_encode($fetch['description']);
				$titulo = str_replace("\"", "\\\"", $titulo);
				$descricao = str_replace("\"", "\\\"", $descricao);

				$estado_id = $fetch['state_id'];
				$sql_estado = $dbcon->query("SELECT sigla FROM states WHERE id='$estado_id'");
				$sql_estado_r = $sql_estado->fetch_array();
				$estado = utf8_encode($sql_estado_r['sigla']);

				$cidade_id = $fetch['city_id'];
				$sql_cidade = $dbcon->query("SELECT name FROM cities WHERE id='$cidade_id'");
				$sql_cidade_r = $sql_cidade->fetch_array();
				$cidade = utf8_encode($sql_cidade_r['name']);

				$data = date("d/m/Y H:i", strtotime($fetch['created_at']));
				$data .= "h";

		    $post['DEMANDAS_LANCADAS'][] = array(
					'id' => "$id",
					'nome' => "$nome",
					'areasdeatuacao' => "$aa_tx",
					'areasdeatuacao_id' => "$id_areasdeatuacao",
					'servicosprestados' => "$sp_tx",
					'servicosprestados_id' => "$id_servicosprestados",
					'titulodemanda' => "$titulo",
					'descricaodemanda' => "$descricao",
					'estado' => "$estado",
					'cidade' => "$cidade",
					'data' => "$data"
				);

			}

			echo json_encode($post);

		}else{
			echo "32b4af2dbcb3812ff316d0c657c1d2ef";
		}

	}else{
		echo "ACESSO NEGADO!";
	}

?>
