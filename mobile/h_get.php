<?php
include_once 'conexao.php';

$dbpass = $_POST['dbpass'];
$id_user = $_POST['id_user'];
$post = array();
$imgcache = array();

if($dbpass == "PcxtRlor2135@!:.BRO"){
	$sql_name = $dbcon->query("SELECT name FROM users WHERE id='$id_user'");
	$result = $sql_name->fetch_array();
	$nome = utf8_encode($result['name']);

	$sql_dl = $dbcon->query("SELECT * FROM demands WHERE user_id='$id_user' AND conclude1='1' ORDER BY created_at DESC");
	$sql_c = $dbcon->query("SELECT * FROM demands WHERE executor_id='$id_user' AND conclude2='1' ORDER BY created_at DESC");

	if (mysqli_num_rows($sql_dl) > 0 || mysqli_num_rows($sql_c) > 0){
		echo "1d46bc04ec3452b5a48aa7dd4b6d17e8";

		$pass1 = false;
		$pass2 = false;

		while($fetch = $sql_dl->fetch_array()){
			$pass1 = true;
			$id_servicosprestados = '';
			$id_areasdeatuacao = '';
			$aa_tx = '';
			$sp_tx = '';

			$id = $fetch['id'];

			// ÁREAS DE ATUAÇÃO DA DEMANDA
			$sql_atuacao_id = $dbcon->query("SELECT atuation_id FROM atuation_demand WHERE demand_id='$id'");
			while ($sql_atuacao_id_r = $sql_atuacao_id->fetch_array()){
				$id_areasdeatuacao .= $sql_atuacao_id_r['atuation_id']. ',';
			}

			$id_areasdeatuacao = substr($id_areasdeatuacao, 0, -1);
			$aa_splited = explode(",", $id_areasdeatuacao);

			for ($i = 0; $i < sizeof($aa_splited); $i++){
				$sql2 = $dbcon->query("SELECT name FROM atuations WHERE id='$aa_splited[$i]'");
				$result = $sql2->fetch_array();
				$aa_tx .= utf8_encode($result['name'].', ');
			}

			$aa_tx = substr($aa_tx, 0, -2);

			// SERVIÇOS PRESTADOS DA DEMANDA
			$sql_servico_id = $dbcon->query("SELECT service_id FROM demand_service WHERE demand_id='$id'");

			while ($sql_servico_id_r = $sql_servico_id->fetch_array()){
				$id_servicosprestados .= $sql_servico_id_r['service_id']. ',';
			}

			$id_servicosprestados = substr($id_servicosprestados, 0, -1);
			$sp_splited = explode(",", $id_servicosprestados);

			for ($i = 0; $i < sizeof($sp_splited); $i++){
				$sql2 = $dbcon->query("SELECT name FROM services WHERE id='$sp_splited[$i]'");
				$result = $sql2->fetch_array();
				$sp_tx .= utf8_encode($result['name'].', ');
			}

			$sp_tx = substr($sp_tx, 0, -2);

			//
			$titulo = utf8_encode($fetch['name']);
			$descricao = utf8_encode($fetch['description']);
			$titulo = str_replace("\"", "\\\"", $titulo);
			$descricao = str_replace("\"", "\\\"", $descricao);

			$estado_id = $fetch['state_id'];
			$sql_estado = $dbcon->query("SELECT sigla FROM states WHERE id='$estado_id'");
			$sql_estado_r = $sql_estado->fetch_array();
			$estado = utf8_encode($sql_estado_r['sigla']);

			$cidade_id = $fetch['city_id'];
			$sql_cidade = $dbcon->query("SELECT name FROM cities WHERE id='$cidade_id'");
			$sql_cidade_r = $sql_cidade->fetch_array();
			$cidade = utf8_encode($sql_cidade_r['name']);

			$data = date("d-m-Y H:i", strtotime($fetch['created_at']));
			$data .= "H";

			$post['DEMANDAS_CONCLUIDAS'][] =
			array(
				'id' => "$id",
				'nome' => "$nome",
				'areasdeatuacao' => "$aa_tx",
				'servicosprestados' => "$sp_tx",
				'titulodemanda' => "$titulo",
				'descricaodemanda' => "$descricao",
				'estado' => "$estado",
				'cidade' => "$cidade",
				'data' => "$data"
			);
		}

		while($fetch2 = $sql_c->fetch_array()){
			$pass2 = true;
			$id_servicosprestados = '';
			$id_areasdeatuacao = '';
			$aa_tx = '';
			$sp_tx = '';

			$id = $fetch2['id'];
			$id_enviou = $fetch2['user_id'];

			$sql_duserinfo = $dbcon->query("SELECT * FROM users WHERE id='$id_enviou'");
			$sql_duserinfo_r = $sql_duserinfo->fetch_array();
			$nome = $sql_duserinfo_r['name'];

			// ÁREAS DE ATUAÇÃO DA DEMANDA
			$sql_atuacao_id = $dbcon->query("SELECT atuation_id FROM atuation_demand WHERE demand_id='$id'");
			while ($sql_atuacao_id_r = $sql_atuacao_id->fetch_array()){
				$id_areasdeatuacao .= $sql_atuacao_id_r['atuation_id']. ',';
			}

			$id_areasdeatuacao = substr($id_areasdeatuacao, 0, -1);
			$aa_splited = explode(",", $id_areasdeatuacao);

			for ($i = 0; $i < sizeof($aa_splited); $i++){
				$sql2 = $dbcon->query("SELECT name FROM atuations WHERE id='$aa_splited[$i]'");
				$result = $sql2->fetch_array();
				$aa_tx .= utf8_encode($result['name'].', ');
			}

			$aa_tx = substr($aa_tx, 0, -2);

			// SERVIÇOS PRESTADOS DA DEMANDA
			$sql_servico_id = $dbcon->query("SELECT service_id FROM demand_service WHERE demand_id='$id'");

			while ($sql_servico_id_r = $sql_servico_id->fetch_array()){
				$id_servicosprestados .= $sql_servico_id_r['service_id']. ',';
			}

			$id_servicosprestados = substr($id_servicosprestados, 0, -1);
			$sp_splited = explode(",", $id_servicosprestados);

			for ($i = 0; $i < sizeof($sp_splited); $i++){
				$sql2 = $dbcon->query("SELECT name FROM services WHERE id='$sp_splited[$i]'");
				$result = $sql2->fetch_array();
				$sp_tx .= utf8_encode($result['name'].', ');
			}

			$sp_tx = substr($sp_tx, 0, -2);

			//
			$titulo = utf8_encode($fetch2['name']);
			$descricao = utf8_encode($fetch2['description']);
			$titulo = str_replace("\"", "\\\"", $titulo);
			$descricao = str_replace("\"", "\\\"", $descricao);

			$estado_id = $fetch2['state_id'];
			$sql_estado = $dbcon->query("SELECT sigla FROM states WHERE id='$estado_id'");
			$sql_estado_r = $sql_estado->fetch_array();
			$estado = utf8_encode($sql_estado_r['sigla']);

			$cidade_id = $fetch2['city_id'];
			$sql_cidade = $dbcon->query("SELECT name FROM cities WHERE id='$cidade_id'");
			$sql_cidade_r = $sql_cidade->fetch_array();
			$cidade = utf8_encode($sql_cidade_r['name']);

			$data = date("d-m-Y H:i", strtotime($fetch2['created_at']));
			$data .= "H";

			$quantidade_de_notas = $sql_duserinfo_r['total_rating'];
			$nota_total = $sql_duserinfo_r['total_stars'];
			$nota = $nota_total / $quantidade_de_notas;

			$img = '';
			$imgname = "foto_avatar_". $id_enviou;
			if (empty($imgcache[$imgname][0])){
				if (file_exists($photopath . $imgname . '.jpg')){
					$imgcache[$imgname][] = base64_encode(file_get_contents($photopath . $imgname . '.jpg'));
				}
			}

			if (array_key_exists($imgname, $imgcache))
				$img = $imgcache[$imgname][0];

			$post['DILIGENCIAS_CONCLUIDAS'][] = array(
				'id' => "$id",
				'nome' => "$nome",
				'areasdeatuacao' => "$aa_tx",
				'servicosprestados' => "$sp_tx",
				'titulodemanda' => "$titulo",
				'descricaodemanda' => "$descricao",
				'estado' => "$estado",
				'cidade' => "$cidade",
				'data' => "$data",
				'nota' => "$nota",
				'img' => "$img"
			);
		}

		if ($pass1 == false){
			if ($pass2){
				echo "80489f7d1854bdf2e90a08ccd6192bac";}

			$post['DEMANDAS_CONCLUIDAS'][] = array(
				'vazio' => "S"
			);
		}

		if ($pass2 == false){
			if ($pass1){
				echo "d445de4fde26c543366e3b6afc93c30b";}

			$post['DILIGENCIAS_CONCLUIDAS'][] = array(
				'vazio' => "S"
			);
		}

		echo json_encode($post);

	}else{
		echo "dc94c0c44868cadf04bad3910b791b9a";
	}

}else{
	echo "ACESSO NEGADO!";
}

?>
