<?php

error_reporting(E_ALL);
ini_set("display_errors", "On");

	include_once 'conexao.php';
	//$json = file_get_contents('php://input');
	//$obj = json_decode($json,true);
	var_dump($obj);

	echo json_encode(array('message'=>'ok'));
	die();


	
	die('fim');

	if($obj){
		$email 		= $obj[0]['value'];
		$password 	= $obj[1]['value'];
		$dbpass 	= $obj[2]['value'];
		$token_fb 	= $obj[3]['value'];
	}else
	{
		$dbpass = $_POST['dbpass'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$token_fb = $_POST['token_fb'];
	}


	if($dbpass == "PcxtRlor2135@!:.BRO"){
		$sql = $dbcon->query("SELECT * FROM users WHERE email='$email'");
		$dados = $sql->fetch_array();
		$pass = $dados['password'];

		if (mysqli_num_rows($sql) > 0){
			if (password_verify ($password , $pass)){
				echo "ebf3a41dd773705b5ba44ae696169d23";

				$post = array();

				$id_areasdeatuacao = '';
				$id_servicosprestados = '';
				$aa = '';
				$sp = '';
				$id = $dados['id'];

				$insert_token = $dbcon->query("UPDATE users SET token_fb='$token_fb' WHERE id='$id'");

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

				$quantidade_de_notas = $dados['total_rating'];
				$nota_total = $dados['total_stars'];
				$nota = $nota_total / $quantidade_de_notas;

				$img = '';
				$imageName = "foto_avatar_". $id;
				if (file_exists($photopath . $imageName . ".jpg")){
					$img = base64_encode(file_get_contents($photopath . $imageName . ".jpg"));
				}
				$token = $dados['remember_token'];

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
					'servicosprestados' => "$sp",
					'nota' => "$nota",
					'img' => "$img",
					'token'=> $token
				);

				echo json_encode($post);

			}else{
				echo "cc23b6fd6bf2d095119704349e00acad";
			}
		}else{
			echo "cc23b6fd6bf2d095119704349e00acad";
		}

	}else{
		echo "sem permissão para acesso ao banco";
	}

?>
