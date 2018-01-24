<?php

error_reporting(E_ALL);
ini_set("display_errors", "On");

	include_once 'conexao.php';

	$dbpass = $_POST['dbpass'];
	$id = $_POST['id'];
	$nome = utf8_decode($_POST['nome']);
	$estado =  $_POST['estado'];
	$cidade = utf8_decode($_POST['cidade']);
	$titulacao = utf8_decode($_POST['titulacao']);
	$aa = $_POST['aa'];
	$sp = $_POST['sp'];
	$ordem = $_POST['ordem'];
	$post = array();
	$imgcache = array();

	if($dbpass == "PcxtRlor2135@!:.BRO"){

		$filter = "";
		$order = "";
		$join_aa = "";
		$join_sp = "";
		$bool = false;

		if ($ordem != "*"){
			$order = $ordem;
		}

		if ($nome != "*"){
			$filter = "AND name LIKE '%{$nome}%'";
			$bool = true;
		}

		if ($cidade != "*"){
			$sql_cidade_id = $dbcon->query("SELECT id FROM cities WHERE name='$cidade'");
			$sql_cidade_id_r = $sql_cidade_id->fetch_array();
			$cidade_id = $sql_cidade_id_r['id'];

			if ($bool){
				$filter .= " AND city_id='$cidade_id'";
			}else{
				$filter = "AND city_id='$cidade_id'";
				$bool = true;
			}

		}else{
			if($estado != "*"){
				$sql_estado_id = $dbcon->query("SELECT id FROM states WHERE sigla='$estado'");
				$sql_estado_id_r = $sql_estado_id->fetch_array();
				$estado_id = $sql_estado_id_r['id'];

				if ($bool){
					$filter .= " AND state_id='$estado_id'";
				}else{
					$filter = "AND state_id='$estado_id'";
					$bool = true;
				}
			}
		}

		if ($aa != "*"){
			$join_aa = "JOIN atuation_user ON atuation_user.user_id = users.id";
			if ($bool){
				$filter .= " AND atuation_user.atuation_id IN ('$aa')";
			}else{
				$filter = " AND atuation_user.atuation_id IN ('$aa')";
				$bool = true;
			}
		}

		if ($sp != "*"){
			$join_sp = "JOIN service_user ON service_user.user_id = users.id";
			if ($bool){
				$filter .= " AND service_user.service_id IN ('$sp')";
			}else{
				$filter = " AND service_user.service_id IN ('$sp')";
			}
		}

		$sql = $dbcon->query(
		 "SELECT * FROM users
		  $join_aa
			$join_sp
			WHERE id!='$id' $filter $order");

		if (mysqli_num_rows($sql) > 0){
			echo "2b0ab73e69dfbe7e030f1e828fd6d102";

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
				if (empty($imgcache[$imgname][0])){
					if (file_exists($photopath . $imgname . '.jpg')){
						$imgcache[$imgname][] = base64_encode(file_get_contents($photopath . $imgname . '.jpg'));
					}
				}

				if (array_key_exists($imgname, $imgcache))
					$img = $imgcache[$imgname][0];

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
			echo "1fa9d37309c72308298e12e124575585";
		}

	}else{
		echo "sem permissão para acesso ao banco";
	}

?>
