<?php

	error_reporting(E_ALL);
	ini_set("display_errors", "On");

	include_once 'conexao.php';

	$dbpass = $_POST['dbpass'];
  $user_id = $_POST['user_id'];
	$post = array();

	if($dbpass == "PcxtRlor2135@!:.BRO"){

    // Buscar todos chats do usuário logado.
		$all_conversations = $dbcon->query("SELECT * FROM conversations WHERE from_user='$user_id' OR to_user='$user_id' ORDER BY updated_at DESC");

    if (mysqli_num_rows($all_conversations) > 0){
      echo "60ac2074855bcd0c2770132e3fedaeac";

	    while ($fetch = $all_conversations->fetch_array()){
	      $conversation_id = $fetch['id'];
				$demand_id = $fetch['demand_id'];

				if (empty($demand_id))
					$demand_id = "0";

        // Buscar id do outro usuário do chat.
        $other_user_id = '';

        if ($fetch['from_user'] != $user_id){
          $other_user_id = $fetch['from_user'];
        }else{
          $other_user_id = $fetch['to_user'];
        }

        // Nome e foto do outro usuário do chat.
        $other_user_info = $dbcon->query("SELECT * FROM users WHERE id='$other_user_id'");
        $other_user_info_r = $other_user_info->fetch_array();
        $other_user_name = utf8_encode($other_user_info_r['name']);

    		$other_user_photo = ''; $imgname = "foto_avatar_". $other_user_id;
    		if (file_exists($photopath . $imgname . '.jpg'))
    			$other_user_photo = base64_encode(file_get_contents($photopath . $imgname . '.jpg'));

        // Última mensagem e hora entre from_id e to_id.
        $chat_info = $dbcon->query("SELECT * FROM messages WHERE conversation_id='$conversation_id' ORDER BY created_at DESC LIMIT 1");
        $chat_info_r = $chat_info->fetch_array();
        $chat_last_message = utf8_encode($chat_info_r['text']);
        $chat_last_time = date("H:i d/m", strtotime($chat_info_r['created_at']));

				$chat_unread_count = 0;

        $chat_unread = $dbcon->query("SELECT * FROM messages WHERE conversation_id='$conversation_id' AND viewed='0' AND user_id!='$user_id'");
				while ($chat_unread_r = $chat_unread->fetch_array()){
					$chat_unread_count ++;
				}

        // Criação do array jSON com as informações necessárias para criação do ChatList.
				$post['CHAT_LIST'][] = array(
					'conversation_id' => "$conversation_id",
					'demand_id' => "$demand_id",
					'other_user_id' => "$other_user_id",
          'other_user_name' => "$other_user_name",
          'last_message' => "$chat_last_message",
          'last_time' => "$chat_last_time",
					'unread_msg' => "$chat_unread_count",
          'other_user_photo' => $other_user_photo
				);
      }

			echo json_encode($post);

    }else{
			echo "23c611b1d7fc727c381766dd44208f64";
		}

  }

?>
