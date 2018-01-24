<?php

  error_reporting(E_ALL);
  ini_set("display_errors", "On");

	include_once 'conexao.php';

	$dbpass = $_POST['dbpass'];
  $from_user = $_POST['from_user'];
  $to_user = $_POST['to_user'];
  $created_at = $_POST['created_at'];

	if($dbpass == "PcxtRlor2135@!:.BRO"){
    $conversation_exists = $dbcon->query("SELECT id FROM conversations
    WHERE from_user='$from_user' AND to_user='$to_user' OR from_user='$to_user' AND to_user='$from_user' AND demand_id IS NULL");

    // CONVERSA JÁ EXISTE ENTRE OS USUÁRIOS.
    if (mysqli_num_rows($conversation_exists) > 0){
      $conversation_exists_r = $conversation_exists->fetch_array();
      $conversation_id = $conversation_exists_r['id'];

      echo "cd4f2ceb922c3717a9a4fef21adc618e".$conversation_id;

    }else{
      $new_conversation = $dbcon->query(
        "INSERT INTO conversations (from_user, to_user, created_at, updated_at)
         VALUES ('$from_user', '$to_user', '$created_at', '$created_at')"
       );

      $conversation_id = $dbcon->insert_id;

      echo "cd4f2ceb922c3717a9a4fef21adc618e".$conversation_id;
    }
  }

?>
