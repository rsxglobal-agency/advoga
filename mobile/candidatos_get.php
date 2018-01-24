<?php

error_reporting(E_ALL);
ini_set("display_errors", "On");

	include_once 'conexao.php';

	$dbpass = $_POST['dbpass'];
	$id_demanda = $_POST['id_demanda'];

	if($dbpass == "PcxtRlor2135@!:.BRO"){

		$sql = $dbcon->query("SELECT * FROM demand_executor
			JOIN users ON demand_executor.executor_id = users.id
			WHERE demand_id='$id_demanda'");

		if (mysqli_num_rows($sql) > 0){
			echo "7aeef8d0a0861463c1d9d6b1e5877b63";

			$post = array();
			while ($dados = $sql->fetch_array()){

				$id_servicosprestados = '';
				$id_areasdeatuacao = '';
				$aa_tx = '';
				$sp_tx = '';
				$id = $dados['id'];
				$nome = utf8_encode($dados['name']);
				$email = utf8_encode($dados['email']);

				$estado_id = $dados['state_id'];
				$sql_estado = $dbcon->query("SELECT sigla FROM states WHERE id='$estado_id'");
				$sql_estado_r = $sql_estado->fetch_array();
				$estado = utf8_encode($sql_estado_r['sigla']);

				$cidade_id = $dados['city_id'];
				$sql_cidade = $dbcon->query("SELECT name FROM cities WHERE id='$cidade_id'");
				$sql_cidade_r = $sql_cidade->fetch_array();
				$cidade = utf8_encode($sql_cidade_r['name']);

				$descricao = utf8_encode($dados['description']);
				$social = utf8_encode($dados['social']);

				$id_titulacao = $dados['titulation_id'];
				$sql_titulacao = $dbcon->query("SELECT name FROM titulations WHERE id='$id_titulacao'");
				$sql_titulacao_r = $sql_titulacao->fetch_array();
				$titulacao = utf8_encode($sql_titulacao_r['name']);

				$id_formacao = $dados['formation_id'];
				$sql_formacao = $dbcon->query("SELECT name FROM formations WHERE id='$id_formacao'");
				$sql_formacao_r = $sql_formacao->fetch_array();
				$formacao = utf8_encode($sql_formacao_r['name']);

				$sql_atuacao_id = $dbcon->query("SELECT atuation_id FROM atuation_user WHERE user_id='$id'");
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

				$sql_servico_id = $dbcon->query("SELECT service_id FROM service_user WHERE user_id='$id'");
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

				$quantidade_de_notas = $dados['total_rating'];
				$nota_total = $dados['total_stars'];
				$nota = $nota_total / $quantidade_de_notas;

				$img = '';
				$imgname = "foto_avatar_". $id;
				if (file_exists($photopath . $imgname . '.jpg')){
					$img = base64_encode(file_get_contents($photopath . $imgname . '.jpg'));
				}

				$descricao = str_replace("\"", "\\\"", $descricao);

				$post['PROFISSIONAIS'][] = array(
					'id' => "$id",
					'nome' => "$nome",
					'email' => "$email",
					'estado' => "$estado",
					'cidade' => "$cidade",
					'descricao' => "$descricao",
					'social' => "$social",
					'titulacao' => "$titulacao",
					'formacao' => "$formacao",
					'id_aa' => "$id_areasdeatuacao",
					'id_sp' => "$id_servicosprestados",
					'areasdeatuacao' => "$aa_tx",
					'servicosprestados' => "$sp_tx",
					'nota' => "$nota",
					'img' => "$img"
				);
			}

			echo json_encode($post);

		}else{
			echo "6c73f83470f6d4d578430fcc7b025b91";
		}

	}else{
		echo "sem permissão para acesso ao banco";
	}

?>
