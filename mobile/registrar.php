<?php

	include_once 'conexao.php';

	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$estado = $_POST['estado'];
	$cidade = $_POST['cidade'];
	$descricao = $_POST['descricao'];
	$linkedin = $_POST['linkedin'];
	$id_formacao = $_POST['id_formacao'];
	$id_titulacao = $_POST['id_titulacao'];
	$id_areasdeatuacao = $_POST['id_areasdeatuacao'];
	$id_servicosprestados = $_POST['id_servicosprestados'];
	$dbpass = $_POST['dbpass'];

	if($dbpass == "PcxtRlor2135@!:.BRO"){

		$name = str_replace("'","", $name);
		$name = str_replace("\"","", $name);
		$descricao = str_replace("'","", $descricao);
		$descricao = str_replace("\"","", $descricao);
		$linkedin = str_replace("'","", $linkedin);
		$linkedin = str_replace("\"","", $linkedin);

		$sql1 = $dbcon->query("SELECT * FROM users WHERE email='$email'");

		if (mysqli_num_rows($sql1) > 0){
			echo "72e537013fe684a2d4f9e9d0941e62bb";
		}else{
			$sql2 = $dbcon->query("
				INSERT INTO users(name, email, password, estado, cidade, linkedin, descricao, id_formacao, id_titulacao, id_areasdeatuacao, id_servicosprestados)
				VALUES('$name', '$email', '$password', '$estado', '$cidade','$linkedin', '$descricao', '$id_formacao', '$id_titulacao', '$id_areasdeatuacao', '$id_servicosprestados')");

			if ($sql2){
				echo "8cbbd13c3daf5ad5791674f4572e3fff";
			}else{
				echo "erro";
			}
		}
	}else{
		echo "ACESSO NEGADO";
	}

?>
