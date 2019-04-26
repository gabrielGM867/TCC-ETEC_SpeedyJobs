
<?php

	include('connect.php');
	header('Content-Type: text/html; charset=utf-8');


	if(isset($_GET['conversacom'])){
		
		$mensagens = array('');
		$id_conversa = (int)$_GET['conversacom'];
		$online = (int)$_GET['online'];

		$pegaConversas = "SELECT 
		tbmensagens.codigo AS 'codiMsg', tbmensagens.id_de, tbmensagens.id_para, tbmensagens.mensagem, 
		tbmensagens.time, tbmensagens.lido, tbmensagens.visNotificacao, 
		tbclientes.nomeUsuario, tbclientes.foto,
		tbusuarioschat.codigo AS 'codiChatCliente', tbusuarioschat.codUsuario, tbusuarioschat.grupo
		FROM `tbmensagens` 
		INNER JOIN tbusuarioschat ON tbusuarioschat.codigo = tbmensagens.id_de
		INNER JOIN tbclientes ON tbclientes.codigo = tbusuarioschat.codUsuario 
		WHERE 
		(id_de = '$online' AND id_para = '$id_conversa' AND `grupo` = 'f') 
		OR (id_de = '$id_conversa' AND id_para = '$online' AND `grupo` = 'c') 
		ORDER BY `codiMsg` DESC LIMIT 10";

		$result4 = mysqli_query($con, $pegaConversas);


		while($row = mysqli_fetch_array($result4)){
			$fotoUser = '';

			if($online == $row['id_de']){
				$janela_de = $row['id_para'];

			}elseif($online == $row['id_para']){
				$janela_de = $row['id_de'];

				$pegaFoto = "SELECT foto FROM `tbclientes` WHERE codigo = '$row[id_de]'";
				$result5 = mysqli_query($con, $pegaFoto); 

				while($usr = mysqli_fetch_array($result5)){
					$fotoUser = $usr['foto'];
					
				}
			}

			if($fotoUser == ""){
				$fotoUser = "fotosUsuarios/user.png";
			}

			$msg = $row['mensagem'];
			$mensagens[] = array(
				'id' => $row['codiMsg'],
				'mensagem' => $msg,
				'fotoUser' => $fotoUser,
				'id_de' => $row['id_de'],
				'id_para' => $row['id_para'],
				'janela_de' => $janela_de
			);

		}

		die( json_encode($mensagens) );
	}else{
		die(json_encode('error'));
	}
	
?>