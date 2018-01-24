<?php

	include_once 'conexao.php';

	$id_user = $_POST['id_user'];
	$nome = utf8_decode($_POST['nome']);
	$estado = utf8_decode($_POST['estado']);
	$cidade = utf8_decode($_POST['cidade']);
	$id_titulacao = $_POST['titulacao'];
	$id_formacao = $_POST['formacao'];
	$descricao = utf8_decode($_POST['descricao']);
	$social = utf8_decode($_POST['social']);
	$id_areasdeatuacao = $_POST['id_areasdeatuacao'];
	$id_servicosprestados = $_POST['id_servicosprestados'];
	$dbpass = $_POST['dbpass'];

	if($dbpass == "PcxtRlor2135@!:.BRO"){
		$nome = str_replace("\"","\\\"", $nome);
		$descricao = str_replace("\"","\\\"", $descricao);
		$social = str_replace("\"","\\\"", $social);
		$cidade = str_replace("'","\'", $cidade);
		$pass = false;

		$sql_estado_id = $dbcon->query("SELECT id FROM states WHERE sigla='$estado'");
		$sql_estado_id_r = $sql_estado_id->fetch_array();
		$estado_id = $sql_estado_id_r['id'];

		$sql_cidade_id = $dbcon->query("SELECT id FROM cities WHERE name='$cidade'");
		$sql_cidade_id_r = $sql_cidade_id->fetch_array();
		$cidade_id = $sql_cidade_id_r['id'];

		$aa_splited = explode(",", $id_areasdeatuacao);

		// reset
		$sql_delete = $dbcon->query("DELETE FROM atuation_user WHERE user_id='$id_user'");

		for ($i = 0; $i < sizeof($aa_splited); $i++){
			$sql_insert = $dbcon->query("INSERT INTO atuation_user(atuation_id, user_id) VALUES ('$aa_splited[$i]', '$id_user')");

			if ($sql_delete && $sql_insert){
				$pass = true;
			}
		}

		$sp_splited = explode(",", $id_servicosprestados);

		// reset
		$sql_delete = $dbcon->query("DELETE FROM service_user WHERE user_id='$id_user'");

		for ($i = 0; $i < sizeof($sp_splited); $i++){
			$sql_insert = $dbcon->query("INSERT INTO service_user(service_id, user_id) VALUES ('$sp_splited[$i]', '$id_user')");

			if ($sql_delete && $sql_insert){
				$pass = true;
			}
		}

		$sql = $dbcon->query("UPDATE users SET name='$nome', state_id='$estado_id', city_id='$cidade_id', titulation_id='$id_titulacao', formation_id='$id_formacao',
		description='$descricao', social='$social' WHERE id='$id_user'");

		if ($sql && $pass){
			echo "d1eeac3ad055024407903b4ecaba86ce";

			$sql1 = $dbcon->query("SELECT * FROM users WHERE id='$id_user'");

			$post = array();
			$dados = $sql1->fetch_array();

			$id_areasdeatuacao = '';
			$id_servicosprestados = '';
			$aa = '';
			$sp = '';
			$id = $dados['id'];

			$nome = utf8_encode($dados['name']);
			$email = utf8_encode($dados['email']);
			$descricao = utf8_encode($dados['description']);
			$social = utf8_encode($dados['social']);

			$estado_id = $dados['state_id'];
			$sql_estado = $dbcon->query("SELECT sigla FROM states WHERE id='$estado_id'");
			$sql_estado_r = $sql_estado->fetch_array();
			$estado = utf8_encode($sql_estado_r['sigla']);

			$cidade_id = $dados['city_id'];
			$sql_cidade = $dbcon->query("SELECT name FROM cities WHERE id='$cidade_id'");
			$sql_cidade_r = $sql_cidade->fetch_array();
			$cidade = utf8_encode($sql_cidade_r['name']);

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
				$aa .= utf8_encode($result['name'].', ');
			}

			$aa = substr($aa, 0, -2);

			$sql_servico_id = $dbcon->query("SELECT service_id FROM service_user WHERE user_id='$id'");
			while ($sql_servico_id_r = $sql_servico_id->fetch_array()){
				$id_servicosprestados .= $sql_servico_id_r['service_id']. ',';
			}

			$id_servicosprestados = substr($id_servicosprestados, 0, -1);
			$sp_splited = explode(",", trim($id_servicosprestados));

			for ($i = 0; $i < sizeof($sp_splited); $i++){
				$sql2 = $dbcon->query("SELECT name FROM services WHERE id='$sp_splited[$i]'");
				$result = $sql2->fetch_array();
				$sp .= utf8_encode($result['name'].', ');
			}

			$sp = substr($sp, 0, -2);

			$post['USUARIO'][] = array(
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
				'areasdeatuacao' => "$aa",
				'servicosprestados' => "$sp"
			);

			echo json_encode($post);

		}else{
			echo "erro";
		}
	}

?>
