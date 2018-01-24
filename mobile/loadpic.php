<?php

	include_once 'conexao.php';

	$imageName = $_POST['imageName'];
	$dbpass = $_POST['dbpass'];

	if($dbpass == "PcxtRlor2135@!:.BRO"){

		if (file_exists($photopath . $imageName . ".jpg")){
			echo "8e4876a40c4d9c97917045bb214f243f:".base64_encode(file_get_contents($photopath . $imageName . ".jpg"));
		}
	}

?>
