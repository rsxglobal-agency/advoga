<?php

	include_once 'conexao.php';

	$dbpass = $_POST['dbpass'];
	$id_demanda = $_POST['id_demanda'];
	$id_usuario = $_POST['id_usuario'];

	if($dbpass == "PcxtRlor2135@!:.BRO"){

		//$sql_del = $dbcon->query("DELETE FROM demand_executor WHERE demand_id='$id_demanda' AND executor_id IS NULL");
		$sql_acpt = $dbcon->query("UPDATE demands SET executor_id='$id_usuario' WHERE id='$id_demanda' AND executor_id IS NULL");

		if($sql_acpt){
			echo "3f2e789d037153ed18b11771a165c714";

			$demand_info = $dbcon->query("SELECT * FROM demands WHERE id='$id_demanda'");
			$demand_info_r = $demand_info->fetch_array();
			$d_title = utf8_encode($demand_info_r['name']);

			$user_accepted_info = $dbcon->query("SELECT * FROM users WHERE id='$id_usuario'");
			$user_accepted_info_r = $user_accepted_info->fetch_array();
			$user_accepted_tokenfb = $user_accepted_info_r['token_fb'];

			$post['ACCEPT_CAND_NOTIFY'][] = array(
				'title' => "$d_title",
				'token_fb' => "$user_accepted_tokenfb"
			);

			echo json_encode($post);
		}else{
			echo "2133bf8baefc4f031f0ce86401f5b7ef";
		}

	}

?>
