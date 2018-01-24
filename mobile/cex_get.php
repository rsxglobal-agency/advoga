<?php

	include_once 'conexao.php';

	$dbpass = $_POST['dbpass'];
	$id_user = $_POST['id_user'];
	$post = array();
	$imgcache = array();

	if($dbpass == "PcxtRlor2135@!:.BRO"){

		$sql = $dbcon->query("SELECT * FROM demands WHERE executor_id='$id_user' AND conclude2 IS NULL");

		if (mysqli_num_rows($sql) > 0){
			echo "4fdb073849a39b66ade8ed0b947031ba";

			while($fetch = $sql->fetch_array()){
				$id_servicosprestados = '';
				$id_areasdeatuacao = '';
				$aa_tx = '';
				$sp_tx = '';

				$id = $fetch['id'];
				$id_enviou = $fetch['user_id'];

				$sql_duserinfo = $dbcon->query("SELECT * FROM users WHERE id='$id_enviou'");
				$sql_duserinfo_r = $sql_duserinfo->fetch_array();
				$nome = utf8_encode($sql_duserinfo_r['name']);

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

				$sql_nota = $dbcon->query("SELECT * FROM users WHERE id='$id_enviou'");
				$result2 = $sql_nota->fetch_array();
				$quantidade_de_notas = $result2['total_rating'];
				$nota_total = $result2['total_stars'];
				$nota = $nota_total / $quantidade_de_notas;

				$img = '';
				$imgname = "foto_avatar_". $id_enviou;
				if (empty($imgcache[$imgname][0])){
					if (file_exists($photopath . $imgname . '.jpg')){
						$imgcache[$imgname][] = base64_encode(file_get_contents($photopath . $imgname . '.jpg'));
					}
				}

				if (array_key_exists($imgname, $imgcache))
					$img = $imgcache[$imgname][0];

				$post['CANDIDATURAS_EM_EXECUCAO'][] = array(

					'id' => "$id",
					'id_dono' => "$id_enviou",
					'nome' => "$nome",
					'areasdeatuacao' => "$aa_tx",
					'servicosprestados' => "$sp_tx",
					'titulodemanda' => "$titulo",
					'descricaodemanda' => "$descricao",
					'estado' => "$estado",
					'cidade' => "$cidade",
					'data' => "$data",
					'nota' => "$nota",
					'img' => "$img"
				);
			}

			echo json_encode($post);

		}else{
			echo "a802fbc724afbaa4a3bd6a3a89751786";
		}

	}else{
		echo "ACESSO NEGADO!";
	}

?>
