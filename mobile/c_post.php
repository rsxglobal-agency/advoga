<?php

error_reporting(E_ALL);
ini_set("display_errors", "On");

	include_once 'conexao.php';

	$id_demanda = $_POST['id_demanda'];
	$id_user_aceitou = $_POST['id_user_aceitou'];
	$dbpass = $_POST['dbpass'];
	$post = array();

	if($dbpass == "PcxtRlor2135@!:.BRO"){

		$sql = $dbcon->query("SELECT * FROM demands WHERE id='$id_demanda' AND executor_id IS NULL");

		if (mysqli_num_rows($sql) > 0){
			$sql1 = $dbcon->query("
				INSERT INTO demand_executor(executor_id, demand_id)
				VALUES('$id_user_aceitou', '$id_demanda')");

			if ($sql1){
				echo "9bb531595b80e2501693597ecb958b9f";

				$demand_info = $dbcon->query("SELECT * FROM demands WHERE id='$id_demanda'");
				$demand_info_r = $demand_info->fetch_array();
				$d_title = utf8_encode($demand_info_r['name']);
				$d_ownerid = $demand_info_r['user_id'];

				$owner_demand_info = $dbcon->query("SELECT * FROM users WHERE id='$d_ownerid'");
				$owner_demand_info_r = $owner_demand_info->fetch_array();
				$d_owner_tokenfb = $owner_demand_info_r['token_fb'];

				$post['CAND_NOTIFY'][] = array(
					'title' => "$d_title",
					'token_fb' => "$d_owner_tokenfb"
				);

				echo json_encode($post);

			}else{
				echo "erro";
			}
		}else{
			echo "0e0192545f0f12e61e59ec1bd253b029";
		}

	}

?>
