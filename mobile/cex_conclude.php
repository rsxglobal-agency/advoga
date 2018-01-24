<?php

	include_once 'conexao.php';

	$id = $_POST['id'];
	$id_dono = $_POST['userid'];
	$nota = $_POST['nota'];
	$dbpass = $_POST['dbpass'];

	if($dbpass == "PcxtRlor2135@!:.BRO"){

		$sql1 = $dbcon->query("UPDATE demands SET conclude2='1' WHERE id='$id'");
		$sql2 = $dbcon->query("UPDATE users SET
			total_rating=(SELECT SUM(total_rating + 1)),
			total_stars=(SELECT SUM(total_stars + $nota))
			WHERE id='$id_dono'");

		$sql_duserinfo = $dbcon->query("SELECT * FROM users WHERE id='$id_dono'");

		$sql_duserinfo_r = $sql_duserinfo->fetch_array();
		$quantidade_de_notas = $sql_duserinfo_r['total_rating'];
		$nota_total = $sql_duserinfo_r['total_stars'];
		$nota_final = $nota_total / $quantidade_de_notas;

		$sql3 = $dbcon->query("UPDATE users SET rate='$nota_final' WHERE id='$id_dono'");

		if ($sql1 && $sql2 && $sql3){
			echo "f137a863cb57997e2dd5ad6eb44e97e2";
		}else{
			echo "erro";
		}
	}

?>
