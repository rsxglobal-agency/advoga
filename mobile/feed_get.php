<?php

	include_once 'conexao.php';

	$dbpass = $_POST['dbpass'];
	$id_user = $_POST['id_user'];
	$estado = $_POST['estado'];
	$cidade = utf8_decode($_POST['cidade']);
	$aa = $_POST['aa'];
	$sp = $_POST['sp'];
	$post = array();
	$imgcache = array();

	$id_demandas = array();
	$id_demandasAceitas = array();
	$w1count = 0;
	$w2count = 0;

	if($dbpass == "PcxtRlor2135@!:.BRO"){

		$filter = "";
		$join_aa = "";
		$join_sp = "";
		$bool = false;

		if ($cidade != "*"){
			$sql_estado_id = $dbcon->query("SELECT id FROM states WHERE sigla='$estado'");
			$sql_estado_id_r = $sql_estado_id->fetch_array();
			$estado_id = $sql_estado_id_r['id'];

			$sql_cidade_id = $dbcon->query("SELECT id FROM cities WHERE state_id='$estado_id' AND name='$cidade'");
			$sql_cidade_id_r = $sql_cidade_id->fetch_array();
			$cidade_id = $sql_cidade_id_r['id'];
			$filter = "AND city_id='$cidade_id'";
			$bool = true;

		}else{
			if($estado != "*"){
				$sql_estado_id = $dbcon->query("SELECT id FROM states WHERE sigla='$estado'");
				$sql_estado_id_r = $sql_estado_id->fetch_array();
				$estado_id = $sql_estado_id_r['id'];
				$filter = "AND state_id='$estado_id'";
				$bool = true;
			}
		}

		if ($aa != "*"){
			$join_aa = "JOIN atuation_demand ON atuation_demand.demand_id = demands.id";
			if ($bool){
				$filter .= " AND atuation_demand.atuation_id IN ('$aa')";
			}else{
				$filter = " AND atuation_demand.atuation_id IN ('$aa')";
				$bool = true;
			}
		}

		if ($sp != "*"){
			$join_sp = "JOIN demand_service ON demand_service.demand_id = demands.id";
			if ($bool){
				$filter .= " AND demand_service.service_id IN ('$sp')";
			}else{
				$filter = " AND demand_service.service_id IN ('$sp')";
			}
		}

		$sql = $dbcon->query(
		 "SELECT * FROM demands
		 	$join_aa
			$join_sp
			WHERE user_id!='$id_user' AND executor_id IS NULL $filter
			ORDER BY created_at DESC
			LIMIT 40");

		$sql2 = $dbcon->query(
		"SELECT * FROM demand_executor
		 JOIN demands ON demand_executor.demand_id = demands.id
		 $join_aa
		 $join_sp
		 WHERE demand_executor.executor_id='$id_user' AND demands.executor_id IS NULL $filter");

		// $sql = demandas de outros usuários que não estão em execução
		while ($demandas = $sql->fetch_array()){
			$id_demandas[$w1count] = $demandas['id'];
			$w1count++;
		}

		// $sql2 = demandas aceitas pelo usuário
		while ($demandas_ac = $sql2->fetch_array()){
			$id_demandasAceitas[$w2count] = $demandas_ac['demand_id'];
			$w2count++;
		}

		$fullDiff = array_merge(array_diff($id_demandas, $id_demandasAceitas), array_diff($id_demandasAceitas, $id_demandas));

		if(count($fullDiff) > 0){
			for ($i = 0; $i < count($fullDiff); $i++){

				$sql_demandas = $dbcon->query("SELECT * FROM demands WHERE id='$fullDiff[$i]'");
				$d = $sql_demandas->fetch_array();

				$id_areasdeatuacao = '';
				$id_servicosprestados = '';
				$aa_tx = '';
				$sp_tx = '';

				$id = $d['id'];
				$id_u = $d['user_id'];

				$sql_atuacao_id = $dbcon->query("SELECT atuation_id FROM atuation_demand WHERE demand_id='$id'");
				while ($sql_atuacao_id_r = $sql_atuacao_id->fetch_array()){
					$id_areasdeatuacao .= $sql_atuacao_id_r['atuation_id']. ',';
				}

				$id_areasdeatuacao = substr($id_areasdeatuacao, 0, -1);
				$aa_splited = explode(",", $id_areasdeatuacao);

				for ($i2 = 0; $i2 < sizeof($aa_splited); $i2++){
					$sql3 = $dbcon->query("SELECT name FROM atuations WHERE id='$aa_splited[$i2]'");
					$result = $sql3->fetch_array();
					$aa_tx .= utf8_encode($result['name'].', ');
				}

				$aa_tx = substr($aa_tx, 0, -2);

				$sql_servico_id = $dbcon->query("SELECT service_id FROM demand_service WHERE demand_id='$id'");
				while ($sql_servico_id_r = $sql_servico_id->fetch_array()){
					$id_servicosprestados .= $sql_servico_id_r['service_id']. ',';
				}

				$id_servicosprestados = substr($id_servicosprestados, 0, -1);
				$sp_splited = explode(",", $id_servicosprestados);

				for ($i2 = 0; $i2 < sizeof($sp_splited); $i2++){
					$sql3 = $dbcon->query("SELECT name FROM services WHERE id='$sp_splited[$i2]'");
					$result = $sql3->fetch_array();
					$sp_tx .= utf8_encode($result['name'].', ');
				}

				$sp_tx = substr($sp_tx, 0, -2);

				$sql_name = $dbcon->query("SELECT name FROM users WHERE id='$id_u'");
				$result = $sql_name->fetch_array();
				$nome = utf8_encode($result['name']);

				$titulo = utf8_encode($d['name']);
				$descricao = utf8_encode($d['description']);
				$titulo = str_replace("\"", "\\\"", $titulo);
				$descricao = str_replace("\"", "\\\"", $descricao);

				$estado_id = $d['state_id'];
				$sql_estado = $dbcon->query("SELECT sigla FROM states WHERE id='$estado_id'");
				$sql_estado_r = $sql_estado->fetch_array();
				$estado = utf8_encode($sql_estado_r['sigla']);

				$cidade_id = $d['city_id'];
				$sql_cidade = $dbcon->query("SELECT name FROM cities WHERE id='$cidade_id'");
				$sql_cidade_r = $sql_cidade->fetch_array();
				$cidade = utf8_encode($sql_cidade_r['name']);

				$data = date("d-m-Y H:i", strtotime($d['created_at']));
				$data .= "H";

				$sql_nota = $dbcon->query("SELECT * FROM users WHERE id='$id_u'");
				$result2 = $sql_nota->fetch_array();

				$quantidade_de_notas = $result2['total_rating'];
				$nota_total = $result2['total_stars'];
				$nota = $nota_total / $quantidade_de_notas;

				$img = '';
				$imgname = "foto_avatar_". $id_u;
				if (empty($imgcache[$imgname][0])){
					if (file_exists($photopath . $imgname . '.jpg')){
						$imgcache[$imgname][] = base64_encode(file_get_contents($photopath . $imgname . '.jpg'));
					}
				}

				if (array_key_exists($imgname, $imgcache))
					$img = $imgcache[$imgname][0];

				$post['TODAS_DEMANDAS'][] = array(
					'id' => "$id",
					'iduser' => "$id_u",
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

			if ($post != null){
				echo "dfc3b0cfd10d5b1aba28c62bbe287d49";
				echo json_encode($post);
			}

		}else{
			echo "c288d0365f0f81b6140b57c6ce823607";
		}
	}else{
		echo "ACESSO NEGADO!";
	}
?>
