<?php

	include_once 'conexao.php';

	$id = $_POST['id'];
	$dbpass = $_POST['dbpass'];

	if($dbpass == "PcxtRlor2135@!:.BRO"){
		
		$sql1 = $dbcon->query("DELETE FROM atuation_demand WHERE demand_id='$id'");
		$sql2 = $dbcon->query("DELETE FROM demand_service WHERE demand_id='$id'");
		$sql3 = $dbcon->query("DELETE FROM demand_executor WHERE demand_id='$id'");
		$sql_del = $dbcon->query("DELETE FROM demands WHERE id='$id'");

		if ($sql1 && $sql2 && $sql3 && $sql_del){
			echo "3bbe674584e5e49a37b124acb4826481";
		}else{
			echo "erro";
		}
	}

?>
