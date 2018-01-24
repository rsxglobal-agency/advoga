<?php

	include_once 'conexao.php';

	$demand_id = $_POST['demand_id'];
	$user_id = $_POST['user_id'];
	$dbpass = $_POST['dbpass'];

	if($dbpass == "PcxtRlor2135@!:.BRO"){

		$sql1 = $dbcon->query("DELETE FROM demand_executor WHERE demand_id='$demand_id' AND executor_id='$user_id'");

		if ($sql1){
			echo "08f680017e5dae4776ecfbdb5832c619";
		}else{
			echo "erro";
		}
	}

?>
