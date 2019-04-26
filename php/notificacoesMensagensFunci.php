<?php 

	include('connect.php');
	session_start();
	$GET = strip_tags(trim($_GET['acao']));
	$codigo = $_SESSION['codiFunci'];
	$codigoChat = $_SESSION['codiFunciChat'];

	switch ($GET) {
		
		case 'verificar':

			$novasMensagens = mysqli_query($con, "Select 
			tbmensagens.id_de, tbmensagens.id_para, tbmensagens.mensagem,
			tbmensagens.time, tbmensagens.lido, tbmensagens.visNotificacao, 
			tbclientes.codigo AS codiCliente, tbclientes.nomeUsuario, tbclientes.foto,  
			tbusuarioschat.codigo as codiClienteChat, tbusuarioschat.grupo
			from `tbmensagens` 
			INNER JOIN tbusuarioschat ON tbusuarioschat.codigo = tbmensagens.id_de
			INNER JOIN tbclientes ON tbusuarioschat.codUsuario = tbclientes.codigo 
			WHERE id_para = $codigoChat AND `lido` = 0 AND grupo = 'c'");

			$numeroDeNovasMensagens = mysqli_num_rows($novasMensagens);
			
			echo $numeroDeNovasMensagens;

			break;

		case 'getnots' :

			
			$get = mysqli_query($con, "Select tbmensagens.codigo AS codiMsg, tbmensagens.id_de, tbmensagens.id_para, tbmensagens.mensagem, tbmensagens.time, tbmensagens.lido, tbmensagens.visNotificacao, tbclientes.codigo AS codiCliente, tbclientes.nomeUsuario, tbclientes.foto, tbusuarioschat.codigo as codiClienteChat, tbusuarioschat.grupo 
				from `tbmensagens` 
				INNER JOIN tbusuarioschat ON tbusuarioschat.codigo = tbmensagens.id_de 
				INNER JOIN tbclientes ON tbusuarioschat.codUsuario = tbclientes.codigo 
				WHERE id_para = '$codigoChat' AND grupo = 'c' GROUP BY tbusuarioschat.codUsuario ORDER BY `codiMsg` DESC");

			$i = 0;
			$li = '';


			while($linha = mysqli_fetch_array($get)){


				if($linha['id_de'] == $linha['codiClienteChat']){

					$novasMensagens = mysqli_query($con, "Select tbmensagens.codigo AS codiMsg, tbmensagens.id_de, tbmensagens.id_para, tbmensagens.mensagem, tbmensagens.time, tbmensagens.lido, tbmensagens.visNotificacao, tbclientes.codigo AS codiCliente, tbclientes.nomeUsuario, tbclientes.foto, tbusuarioschat.codigo as codiClienteChat, tbusuarioschat.grupo 
						from `tbmensagens` 
						INNER JOIN tbusuarioschat ON tbusuarioschat.codigo = tbmensagens.id_de 
						INNER JOIN tbclientes ON tbusuarioschat.codUsuario = tbclientes.codigo 
						WHERE id_para = '$codigoChat' AND grupo = 'c' AND tbmensagens.id_de = '$linha[id_de]' AND `lido` = 0 ORDER BY `codiMsg` DESC");


					$numeroDeNovasMensagens = mysqli_num_rows($novasMensagens);

					$li .= '<li class="nMsg" id="'.$codigoChat.'  class="rounded-circle" ">';
					$li .= '<div class="imgnMsg"><img src=' . $linha['foto'] .' /></div>'; 

					$li .= '<div class="contnMsg">';
						$li .= '<span> Você tem '.  $numeroDeNovasMensagens . ' mensagem do usuário ' . $linha['nomeUsuario'].'</span>';
					$li .= '</div>';

					$li .= '<span class="user_online" id='. $codigoChat .'>
								<aside id="users_online">
									<a href=# id='. $codigoChat . ':' . $linha['codiClienteChat'] . ' title=' . $linha["nomeUsuario"] . ' >Visualizar
									</a>
								</aside>
					</span>';

					$li .= '</li>';

					$i = $i + 1;
					if($i == 1){

						continue;
					}
				}

			}
		

			echo $li;

			break;
		
		default:
			echo 'Erro';
		break;
	} 
?> 