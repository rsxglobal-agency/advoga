<?php

	include_once 'conexao.php';

	$id = $_POST['id'];
	$id_executor = $_POST['userid'];
	$nota = $_POST['nota'];
	$dbpass = $_POST['dbpass'];

	if($dbpass == "PcxtRlor2135@!:.BRO"){

		$sql1 = $dbcon->query("UPDATE demands SET conclude1='1' WHERE id='$id'");
		$sql2 = $dbcon->query("UPDATE users SET
			total_rating=(SELECT SUM(total_rating + 1)),
			total_stars=(SELECT SUM(total_stars + $nota))
			WHERE id='$id_executor'");

		$sql_duserinfo = $dbcon->query("SELECT * FROM users WHERE id='$id_executor'");

		$sql_duserinfo_r = $sql_duserinfo->fetch_array();
		$quantidade_de_notas = $sql_duserinfo_r['total_rating'];
		$nota_total = $sql_duserinfo_r['total_stars'];
		$nota_final = $nota_total / $quantidade_de_notas;

		$sql3 = $dbcon->query("UPDATE users SET rate='$nota_final' WHERE id='$id_executor'");

		if ($sql1 && $sql2 && $sql3){
			echo "31ed3ba1d0c8ec4d69f91d1f9a0aa344";
		}else{
			echo "erro";
		}
	}

?>
