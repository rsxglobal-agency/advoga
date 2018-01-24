<?php

	include_once 'conexao.php';

  $email = $_POST['email'];
  $dbpass = $_POST['dbpass'];

	if($dbpass == "PcxtRlor2135@!:.BRO"){

		$sql = $dbcon->query("SELECT password FROM users WHERE email='$email'");

    if($sql){
      echo "rec_ok";

      $result_sql = $sql->fetch_array();
      $senha = $result_sql['password'];

      mail($email, "AdvogaAPP solicitação da senha!", "Sua senha é: "+ $senha);
      
    }

  }

?>
