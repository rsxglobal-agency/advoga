<?php

	include_once 'conexao.php';

	$id = $_POST['id'];
	$dbpass = $_POST['dbpass'];

	if($dbpass == "PcxtRlor2135@!:.BRO"){

		$sql = $dbcon->query("UPDATE demands SET executor_id=NULL WHERE id='$id' AND conclude1 IS NULL AND conclude2 IS NULL");

		if (($dbcon->affected_rows) > 0){
			echo "8786324c0893da974689d0c6aee50aa0";
		}else{
			echo "ba64d0619dc5d7805768508e4f5cbaff";
		}
	}

?>
