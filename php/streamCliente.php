<?php

	include('connect.php');
	header('Content-Type: text/html; charset=utf-8');
	if(isset($_GET)){
		
		$userOnline = (int)$_GET['user'];
		$timestamp = ($_GET['timestamp'] == 0) ? time() : strip_tags(trim($_GET['timestamp']));
		$lastid = (isset($_GET['lastid']) && !empty($_GET['lastid'])) ? $_GET['lastid'] : 0;

		if(empty($timestamp)){
			die(json_encode(array('status' => 'erro')));
		}

		$tempoGasto = 0;
		$lastidQuery = '';

		if(!empty($lastid)){
			$lastidQuery = ' AND `codigo` > '.$lastid;
		}

		if($_GET['timestamp'] == 0){
			$verifica = "SELECT * FROM `tbmensagens` WHERE lido = 0 ORDER BY `codigo` DESC";
			$verifica = mysqli_query($con, $verifica); 
		}else{
			$verifica = "SELECT * FROM `tbmensagens` WHERE `time` >= $timestamp".$lastidQuery." AND lido = 0 ORDER BY `codigo` DESC";
			$verifica = mysqli_query($con, $verifica); 
		}
		$resultados = mysqli_num_rows($verifica);


		if($resultados <= 0){
			while($resultados <= 0){
				if($resultados <= 0){
					//durar 30 segundos verificando
					if($tempoGasto >= 30){
						die(json_encode(array('status' => 'vazio', 'lastid' => 0, 'timestamp' => time())));
						exit;
					}

					//descansar o script por um segundo
					sleep(1);
					$verifica = "SELECT * FROM `tbmensagens` WHERE `time` >= $timestamp".$lastidQuery." AND `lido` = 0 ORDER BY `codigo` DESC";
					$verifica = mysqli_query($con, $verifica); 

					$resultados = mysqli_num_rows($verifica);
					$tempoGasto += 1;
				}
			}
		}

		$novasMensagens = array();
		if($resultados >= 1){
			
			while($row = mysqli_fetch_array($verifica)){
				$fotoUser = '';
				$janela_de = 0;

				if($userOnline == $row['id_de']){
					$janela_de = $row['id_para'];

				}elseif($userOnline == $row['id_para']){
					$janela_de = $row['id_de'];
					$pegaFoto = "SELECT `foto` FROM `tbfuncionarios` WHERE `codigo` = '$row[id_de]'";
					$result5 = mysqli_query($con, $pegaFoto); 

					while($usr = mysqli_fetch_array($result5)){
						$fotoUser = $usr['foto'];
					}
				}

				if($fotoUser == ""){
					$fotoUser = "fotosUsuarios/user.png";
				}

				$msg = $row['mensagem'];
				$novasMensagens[] = array(
					'id' => $row['codigo'],
					'mensagem' => $msg,
					'fotoUser' => $fotoUser,
					'id_de' => $row['id_de'],
					'id_para' => $row['id_para'],
					'janela_de' => $janela_de
				);
			}
		}

		$ultimaMsg = end($novasMensagens);
		$ultimoId = $ultimaMsg['id'];
		die(json_encode(array('status' => 'resultados', 'timestamp' => time(), 'lastid' => $ultimoId, 'dados' => $novasMensagens)));
	}
	
?>