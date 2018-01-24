<?php

	include_once 'conexao.php';

  $ids = $_POST['ids'];
  $dbpass = $_POST['dbpass'];

	if($dbpass == "PcxtRlor2135@!:.BRO"){

    $id = explode(",", $ids);
    $post = array();

    for($i = 0; $i < count($id); $i++){

			$sql = $dbcon->query("SELECT name FROM users WHERE id='$id[$i]'");
			$fetch = $sql->fetch_array();
			$nome = $fetch['name'];

			$img = '';
			$imgname = "foto_avatar_". $id[$i];
			if (file_exists($photopath . $imgname . '.jpg')){
				$img = base64_encode(file_get_contents($photopath . $imgname . '.jpg'));
			}

			$post['CHAT_INFO'][] = array(
				'nome' => "$nome",
				'img' => "$img"
			);

    }

    echo "5c296359574dc2e88e7836de53a0967f";
    echo json_encode($post);
  }

?>
