<?php

  error_reporting(E_ALL);
  ini_set("display_errors", "On");

	include_once 'conexao.php';

	$dbpass = $_POST['dbpass'];
  $conversation_id = $_POST['conversation_id'];
  $demand_id = $_POST['demand_id'];
  $from_user = $_POST['from_user'];
  $to_user = $_POST['to_user'];
  $message = utf8_decode($_POST['message']);
  $created_at = $_POST['created_at'];
  $special = $_POST['special'];
	$post = array();

	if($dbpass == "PcxtRlor2135@!:.BRO"){

    // Verificar 'assunto' da conversa.
    if ($conversation_id == "0"){
      if ($demand_id == "0"){
        /*
        // Conversa não existe, chat aberto pelo buscar profissionais.
        // Criar conversa linkada ao conversation_id.
        $create_conversation = $dbcon->query(
          "INSERT INTO conversations(from_user, to_user, created_at, updated_at)
           VALUES ('$from_user', '$to_user', '$created_at', '$created_at')"
         );

      	$new_conversation_id = $dbcon->insert_id;

        // Enviar mensagem na conversa criada.
        $send_msg = $dbcon->query(
         "INSERT INTO messages(conversation_id, user_id, special, text, created_at, updated_at)
          VALUES ('$new_conversation_id', '$from_user', '$special', '$message', '$created_at', '$created_at')"
        );

        if ($create_conversation && $send_msg){
          echo "f2f6eb5201ff4067a414c91a27620429";

          $receiver_info_sql = $dbcon->query("SELECT token_fb FROM users WHERE id='$to_user'");
          $receiver_info_sql_r = $receiver_info_sql->fetch_array();

          $receiver_token = $receiver_info_sql_r['token_fb'];

          $post['MSG_NOTIFY'][] = array(
            'receiver_token' => "$receiver_token",
            'message' => "$message"
          );
        }
        */
      }else{
        // Verificar se a conversa já existe.
        $conversation_exists = $dbcon->query("SELECT id FROM conversations WHERE demand_id='$demand_id'");

        if (mysqli_num_rows($conversation_exists) > 0){
          // Conversa linkada a um demand_id
          $fetch = $conversation_exists->fetch_array();
          $this_conversation_id = $fetch['id'];

          // Enviar mensagem na conversa.
          $send_msg = $dbcon->query(
           "INSERT INTO messages(conversation_id, user_id, special, text, created_at, updated_at)
            VALUES ('$this_conversation_id', '$from_user', '$special', '$message', '$created_at', '$created_at')"
          );

          $conversation_update = $dbcon->query("UPDATE conversations SET updated_at='$created_at' WHERE id='$this_conversation_id'");

          if ($send_msg && $conversation_update){
            echo "f2f6eb5201ff4067a414c91a27620429";

            $receiver_info_sql = $dbcon->query("SELECT token_fb FROM users WHERE id='$to_user'");
            $receiver_info_sql_r = $receiver_info_sql->fetch_array();

            $receiver_token = $receiver_info_sql_r['token_fb'];

    				$post['MSG_NOTIFY'][] = array(
    					'receiver_token' => "$receiver_token",
              'message' => "$message"
            );
          }

        }else{

          // Conversa não existe, chat aberto por alguma demanda.
          // Criar conversa linkada ao demand_id.
          $create_conversation = $dbcon->query(
            "INSERT INTO conversations(demand_id, from_user, to_user, created_at, updated_at)
             VALUES ('$demand_id', '$from_user', '$to_user', '$created_at', '$created_at')"
           );

        	$new_conversation_id = $dbcon->insert_id;

          // Enviar mensagem na conversa criada.
          $send_msg = $dbcon->query(
           "INSERT INTO messages(conversation_id, user_id, special, text, created_at, updated_at)
            VALUES ('$new_conversation_id', '$from_user', '$special', '$message', '$created_at', '$created_at')"
          );

          $conversation_update = $dbcon->query("UPDATE conversations SET updated_at='$created_at' WHERE id='$new_conversation_id'");

          if ($create_conversation && $send_msg && $conversation_update){
            echo "f2f6eb5201ff4067a414c91a27620429";

            $receiver_info_sql = $dbcon->query("SELECT token_fb FROM users WHERE id='$to_user'");
            $receiver_info_sql_r = $receiver_info_sql->fetch_array();

            $receiver_token = $receiver_info_sql_r['token_fb'];

    				$post['MSG_NOTIFY'][] = array(
    					'receiver_token' => "$receiver_token",
              'message' => "$message"
            );
          }
        }
      }
    }else{
      // Conversa linkada a um conversation_id
      // Enviar mensagem na conversa.
      $send_msg = $dbcon->query(
       "INSERT INTO messages(conversation_id, user_id, special, text, created_at, updated_at)
        VALUES ('$conversation_id', '$from_user', '$special', '$message', '$created_at', '$created_at')"
      );

      $conversation_update = $dbcon->query("UPDATE conversations SET updated_at='$created_at' WHERE id='$conversation_id'");

      if ($send_msg && $conversation_update){
        echo "f2f6eb5201ff4067a414c91a27620429";

        $receiver_info_sql = $dbcon->query("SELECT * FROM users WHERE id='$to_user'");
        $receiver_info_sql_r = $receiver_info_sql->fetch_array();

        $receiver_token = $receiver_info_sql_r['token_fb'];

        $post['MSG_NOTIFY'][] = array(
          'receiver_token' => "$receiver_token",
          'message' => "$message"
        );
      }
    }

    if (!empty($post))
      echo json_encode($post);

  }

?>
