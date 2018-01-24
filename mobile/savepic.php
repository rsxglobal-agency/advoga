<?php

	include_once 'conexao.php';

  $imageName = $_POST['imageName'];
  $image = $_POST['image'];
  $dbpass = $_POST['dbpass'];

	if($dbpass == "PcxtRlor2135@!:.BRO"){

		$id = str_replace("foto_avatar_", "", $imageName);

		$sql = $dbcon->query("UPDATE users SET image='$imageName.jpg' WHERE id='$id'");

		if($sql){
	    $image = str_replace(' ','+', $image);
	    $decodedImage = base64_decode("$image");
	    file_put_contents($photopath . $imageName . ".jpg", $decodedImage);
		}
  }

?>
