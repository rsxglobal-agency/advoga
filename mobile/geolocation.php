<?php

	error_reporting(E_ALL);
	ini_set("display_errors", "On");

  include_once 'conexao.php';

  $dbpass = $_POST['dbpass'];
  $id = $_POST['id'];

  if($dbpass == "PcxtRlor2135@!:.BRO"){
    $sql = $dbcon->query("SELECT * FROM users WHERE id='$id'");
    $dados = $sql->fetch_array();

    if (mysqli_num_rows($sql) > 0){
      $post = array();

      $id_areasdeatuacao = '';
      $id_servicosprestados = '';
      $aa = '';
      $sp = '';

      $nome = utf8_encode($dados['name']);
      $descricao = utf8_encode($dados['description']);
      $social = utf8_encode($dados['social']);

      $id_titulacao = $dados['titulation_id'];
      $sql_titulacao = $dbcon->query("SELECT name FROM titulations WHERE id='$id_titulacao'");
      $sql_titulacao_r = $sql_titulacao->fetch_array();
      $titulacao = utf8_encode($sql_titulacao_r['name']);

      $id_formacao = $dados['formation_id'];
      $sql_formacao = $dbcon->query("SELECT name FROM formations WHERE id='$id_formacao'");
      $sql_formacao_r = $sql_formacao->fetch_array();
      $formacao = utf8_encode($sql_formacao_r['name']);

      $sql_atuacao_id = $dbcon->query("SELECT atuation_id FROM atuation_user WHERE user_id='$id'");
      while ($sql_atuacao_id_r = $sql_atuacao_id->fetch_array()){
        $id_areasdeatuacao .= $sql_atuacao_id_r['atuation_id']. ',';
      }

      $id_areasdeatuacao = substr($id_areasdeatuacao, 0, -1);
      $aa_splited = explode(",", $id_areasdeatuacao);

      for ($i = 0; $i < sizeof($aa_splited); $i++){
        $sql2 = $dbcon->query("SELECT name FROM atuations WHERE id='$aa_splited[$i]'");
        $result = $sql2->fetch_array();
        $aa .= utf8_encode($result['name'].', ');
      }

      $aa = substr($aa, 0, -2);

      $sql_servico_id = $dbcon->query("SELECT service_id FROM service_user WHERE user_id='$id'");
      while ($sql_servico_id_r = $sql_servico_id->fetch_array()){
        $id_servicosprestados .= $sql_servico_id_r['service_id']. ',';
      }

      $id_servicosprestados = substr($id_servicosprestados, 0, -1);
      $sp_splited = explode(",", trim($id_servicosprestados));

      for ($i = 0; $i < sizeof($sp_splited); $i++){
        $sql2 = $dbcon->query("SELECT name FROM services WHERE id='$sp_splited[$i]'");
        $result = $sql2->fetch_array();
        $sp .= utf8_encode($result['name'].', ');
      }

      $sp = substr($sp, 0, -2);

      $quantidade_de_notas = $dados['total_rating'];
      $nota_total = $dados['total_stars'];
      $nota = $nota_total / $quantidade_de_notas;

      $img = '';
      $imageName = "foto_avatar_". $id;
      if (file_exists($photopath . $imageName . ".jpg")){
        $img = base64_encode(file_get_contents($photopath . $imageName . ".jpg"));
      }

      $post['GEOLOCATION'][] = array(
        'nome' => "$nome",
        'descricao' => "$descricao",
        'social' => "$social",
        'titulacao' => "$titulacao",
        'formacao' => "$formacao",
        'id_aa' => "$id_areasdeatuacao",
        'id_sp' => "$id_servicosprestados",
        'areasdeatuacao' => "$aa",
        'servicosprestados' => "$sp",
        'nota' => "$nota",
        'img' => "$img"
      );

			echo "geolocation_ok";
      echo json_encode($post);

    }else{
      echo "id inexistente.";
    }

  }else{
    echo "sem permissão para acesso ao banco";
  }

?>
