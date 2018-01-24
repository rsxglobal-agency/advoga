<?php

	include_once 'conexao.php';

	$dbpass = $_POST['dbpass'];
	$id_user = $_POST['id_user'];
	$imgcache = array();

	if($dbpass == "PcxtRlor2135@!:.BRO"){
		$sql_name = $dbcon->query("SELECT name FROM users WHERE id='$id_user'");
		$result = $sql_name->fetch_array();
		$nome = $result['name'];

		$sql = $dbcon->query("SELECT * FROM demands WHERE user_id='$id_user' AND executor_id IS NOT NULL AND conclude1 IS NULL ORDER BY created_at DESC");

		if (mysqli_num_rows($sql) > 0){
			echo "e9eb98f8bd2a6e57b2b544cb92ad09b7";

			$post = array();
			while($fetch = $sql->fetch_array()){
				$id_servicosprestados = '';
				$id_areasdeatuacao = '';
		    $aa_tx = '';
		    $sp_tx = '';

		    $id = $fetch['id'];
				$id_e = $fetch['executor_id'];

				$sql_e = $dbcon->query("SELECT * FROM users WHERE id='$id_e'");
				$result_e = $sql_e->fetch_array();
				$nome_e = utf8_encode($result_e['name']);

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

				$e_img = '';
				$imgname = "foto_avatar_". $id_e;
				if (empty($imgcache[$imgname][0])){
					if (file_exists($photopath . $imgname . '.jpg')){
						$imgcache[$imgname][] = base64_encode(file_get_contents($photopath . $imgname . '.jpg'));
					}
				}

				if (array_key_exists($imgname, $imgcache))
					$e_img = $imgcache[$imgname][0];

		    $post['DL_EM_EXECUCAO'][] = array(
					'id' => "$id",
					'id_executor' => "$id_e",
					'nome' => "$nome",
					'nome_executor' => "$nome_e",
					'areasdeatuacao' => "$aa_tx",
					'areasdeatuacao_id' => "$id_areasdeatuacao",
					'servicosprestados' => "$sp_tx",
					'servicosprestados_id' => "$id_servicosprestados",
					'titulodemanda' => "$titulo",
					'descricaodemanda' => "$descricao",
					'estado' => "$estado",
					'cidade' => "$cidade",
					'data' => "$data",
					'img_executor' => "$e_img"
				);

			}

			echo json_encode($post);

		}else{
			echo "143623b0905fad5f1704811e620aace6";
		}

	}else{
		echo "ACESSO NEGADO!";
	}

?>
