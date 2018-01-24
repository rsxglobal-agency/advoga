<?php

  error_reporting(E_ALL);
  ini_set("display_errors", "On");

	include_once 'conexao.php';

	$dbpass = $_POST['dbpass'];
  $user_id = $_POST['user_id'];
  $conversation_count = 0;
  $messages_count = 0;
	$post = array();

	if($dbpass == "PcxtRlor2135@!:.BRO"){

    // Buscar todas as conversas  do usuário
		$all_conversations = $dbcon->query("SELECT * FROM conversations WHERE from_user='$user_id' OR to_user='$user_id'");
    if (mysqli_num_rows($all_conversations) > 0){

      // filtrar apenas conversas que contenham mensagens não visualizadas.
      while ($fetch = $all_conversations->fetch_array()){

        $id = $fetch['id'];
        $unread_conversation = $dbcon->query("SELECT * FROM messages WHERE conversation_id='$id' AND viewed='0' AND user_id!='$user_id'");

        // Contar quantas conversas contem mensagens não lidas
        if (mysqli_num_rows($unread_conversation) > 0){
          $conversation_count++;
        }

      }
    }


    $all_conversations = $dbcon->query("SELECT * FROM conversations WHERE from_user='$user_id' OR to_user='$user_id'");
    if ($conversation_count == 1){
      echo "335a78e2f99c25af67df0986705a2c44";

      // Buscar todas as conversas  do usuário
      while ($fetch = $all_conversations->fetch_array()){
        // CHAT NÃO LIDO
        $id = $fetch['id'];
        $unread_msgs = $dbcon->query("SELECT * FROM messages WHERE conversation_id='$id' AND viewed='0' AND user_id!='$user_id'");
        $messages_count = mysqli_num_rows($unread_msgs);

        if ($messages_count > 0){
          // Buscar id do outro usuário do chat.
          $other_user_id = '';

          if ($fetch['from_user'] != $user_id){
            $other_user_id = $fetch['from_user'];
          }else{
            $other_user_id = $fetch['to_user'];
          }

          // Nome do outro usuário que chamou no chat.
          $other_user_info = $dbcon->query("SELECT * FROM users WHERE id='$other_user_id'");
          $other_user_info_r = $other_user_info->fetch_array();
          $other_user_name = utf8_encode($other_user_info_r['name']);

          // Última mensagem e hora entre from_id e to_id.
          $chat_info = $dbcon->query("SELECT * FROM messages WHERE conversation_id='$id' ORDER BY created_at DESC LIMIT 1");
          $chat_info_r = $chat_info->fetch_array();
          $chat_last_message = utf8_encode($chat_info_r['text']);

          // Criação do array jSON
          $post['NOTIFY'][] = array(
            'other_user_name' => "$other_user_name",
            'last_message' => "$chat_last_message",
            'conversation_count' => "$conversation_count",
            'msg_count' => "$messages_count"
          );

          echo json_encode($post);

        }

      }

    }else if ($conversation_count > 1){
      echo "335a78e2f99c25af67df0986705a2c44";

      while ($fetch = $all_conversations->fetch_array()){
        // MENSAGENS NÃO LIDAS
        $id = $fetch['id'];
        $unread_msgs = $dbcon->query("SELECT * FROM messages WHERE conversation_id='$id' AND viewed='0' AND user_id!='$user_id'");
        $messages_count += mysqli_num_rows($unread_msgs);
      }

      if ($messages_count > 0){

        // Criação do array jSON
        $post['NOTIFY'][] = array(
          'other_user_name' => "",
          'last_message' => "",
          'conversation_count' => "$conversation_count",
          'msg_count' => "$messages_count"
        );

        echo json_encode($post);

      }else{
        echo " MAIS DE UMA CONVERSA - TODAS MENSAGENS FORAM LIDAS!";
      }

    }else{
      echo " NENHUMA CONVERSA";
    }

  }

?>
