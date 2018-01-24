<?php

	error_reporting(E_ALL);
	ini_set("display_errors", "On");

	include_once 'conexao.php';

	$dbpass = $_POST['dbpass'];
	$user_id = $_POST['user_id'];
	$message_id = $_POST['message_id'];
  $conversation_id = $_POST['conversation_id'];
  $demand_id = $_POST['demand_id'];
	$post = array();

	if($dbpass == "PcxtRlor2135@!:.BRO"){

    if ($conversation_id == "0"){
      if ($demand_id == "0"){
        echo "no messagi";

      }else{
        // Verificar se a conversa já existe.
        $conversation_exists = $dbcon->query("SELECT id FROM conversations WHERE demand_id='$demand_id'");

        if (mysqli_num_rows($conversation_exists) > 0){
          echo "7da7dd013e34861cd91c102f300ac72b";

          // Conversa linkada a um demand_id
          $fetch = $conversation_exists->fetch_array();
          $this_conversation_id = $fetch['id'];

					// Buscar messagis
					$filter = '';
					if ($message_id != "0")
						$filter = " AND id > '$message_id'";

      		$all_messages = $dbcon->query("SELECT * FROM messages WHERE conversation_id='$this_conversation_id'$filter");

					if (mysqli_num_rows($all_messages) > 0){

	          while ($fetch = $all_messages->fetch_array()){
							$id = $fetch['id'];

							$message_read = $dbcon->query("UPDATE messages SET viewed='1' WHERE id='$id' AND user_id!='$user_id' AND viewed!='1'");
							$user_messages = $dbcon->query("SELECT viewed FROM messages WHERE id='$id' AND user_id='$user_id'");

							$user_messages_r = $user_messages->fetch_array();

	            $from_user = $fetch['user_id'];
	            $message = utf8_encode($fetch['text']);
							$viewed = $user_messages_r['viewed'];

							//$created_at = date("H:i", strtotime($fetch['created_at']));

							$created_at_fr = $fetch['created_at'];
							$created_at = new DateTime($created_at_fr);
					    $today = new DateTime();

					    $interval = $today->diff($created_at);
					    $age = $interval->format('%d%');

							if ($age > 0){
								$created_at = date("d/m/Y", strtotime($created_at_fr));
							}else{
								$created_at = date("H:i", strtotime($created_at_fr));
							}

	    				$post['CHAT_MSG'][] = array(
								'message_id' => "$id",
	    					'from_user' => "$from_user",
	    					'message' => "$message",
	              'created_at' => "$created_at",
								'viewed' => "$viewed"
	            );
	          }

	          echo json_encode($post);
					}

        }else{
          echo "sem mensagens";
        }
      }

    }else{
      echo "7da7dd013e34861cd91c102f300ac72b";

			// Buscar messagis
			$filter = '';
			if ($message_id != "0")
				$filter = " AND id > '$message_id'";

			$all_messages = $dbcon->query("SELECT * FROM messages WHERE conversation_id='$conversation_id'$filter");

			if (mysqli_num_rows($all_messages) > 0){

        while ($fetch = $all_messages->fetch_array()){
					$id = $fetch['id'];

					$message_read = $dbcon->query("UPDATE messages SET viewed='1' WHERE id='$id' AND user_id!='$user_id' AND viewed!='1'");
					$user_messages = $dbcon->query("SELECT viewed FROM messages WHERE id='$id' AND user_id='$user_id'");

					$user_messages_r = $user_messages->fetch_array();

					$from_user = $fetch['user_id'];
					$message = utf8_encode($fetch['text']);
					$viewed = $user_messages_r['viewed'];

					//$created_at = date("H:i", strtotime($fetch['created_at']));

					$created_at_fr = $fetch['created_at'];
					$created_at = new DateTime($created_at_fr);
			    $today = new DateTime();

			    $interval = $today->diff($created_at);
			    $age = $interval->format('%d%');

					if ($age > 0){
						$created_at = date("d/m/Y", strtotime($created_at_fr));
					}else{
						$created_at = date("H:i", strtotime($created_at_fr));
					}

					$post['CHAT_MSG'][] = array(
						'message_id' => "$id",
						'from_user' => "$from_user",
						'message' => "$message",
						'created_at' => "$created_at",
						'viewed' => "$viewed"
					);
        }

        echo json_encode($post);
			}
    }

  }
?>
