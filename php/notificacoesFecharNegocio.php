<?php 
	include('connect.php');
	session_start();
	$GET = strip_tags(trim($_GET['acao']));
	$codigo = $_SESSION['codiFunci'];

	switch ($GET) {
		
		case 'verificar':

			$novosPedidos = mysqli_query($con, "Select tbdetalhespedido.codPedido, tbdetalhespedido.codCliente,
			tbdetalhespedido.codFuncionario, tbdetalhespedido.status AS 'statusNegociacao', 
			tbfuncionarios.codigo, tbpedidosdeservico.tipoServico, tbpedidosdeservico.AceitoPedido, tbpedidosdeservico.visNotificacao
			from `tbdetalhespedido`
			INNER JOIN tbfuncionarios ON tbfuncionarios.codigo = tbdetalhespedido.codFuncionario
			INNER JOIN tbpedidosdeservico ON tbpedidosdeservico.codigo = tbdetalhespedido.codPedido 
			WHERE tbdetalhespedido.codFuncionario = $codigo AND `status` = 1");

			$novasNegociacoes = mysqli_query($con, "Select tbformcliente.codigo AS 'cod',
				tbdetalhespedido.codPedido, tbdetalhespedido.codCliente, 
				tbdetalhespedido.codFuncionario, tbdetalhespedido.status AS 'statusNegociacao', 
				tbclientes.codigo, tbclientes.nomeUsuario, tbclientes.foto, 
				tbpedidosdeservico.tipoServico, tbpedidosdeservico.AceitoPedido, tbpedidosdeservico.visNotificacao,
				tbformfunci.dataInicio, tbformfunci.horaInicio, tbformfunci.dataFinal, tbformfunci.horaFinal  
				from `tbformcliente` 
				INNER JOIN tbdetalhespedido ON tbdetalhespedido.codCliente = tbformcliente.codCliente 
				INNER JOIN tbclientes ON tbclientes.codigo = tbdetalhespedido.codCliente 
				INNER JOIN tbpedidosdeservico ON tbpedidosdeservico.codigo = tbformcliente.codServico 
				INNER JOIN tbformfunci ON tbformfunci.codServico = tbformcliente.codServico
				WHERE tbdetalhespedido.codFuncionario = '$codigo' AND `status` = 1 
				ORDER BY `codigo` DESC");

			
			$numeroDePedidosAceitoseNegociacoes = mysqli_num_rows($novosPedidos) + mysqli_num_rows($novasNegociacoes);

			echo $numeroDePedidosAceitoseNegociacoes;

			break;

		case 'getnots' :

			$get = mysqli_query($con, "Select tbdetalhespedido.codPedido, tbdetalhespedido.codCliente,
			tbdetalhespedido.codFuncionario, tbdetalhespedido.status AS 'statusNegociacao',
			tbclientes.codigo, tbclientes.nomeUsuario, tbclientes.foto,
			tbpedidosdeservico.tipoServico, tbpedidosdeservico.AceitoPedido, tbpedidosdeservico.visNotificacao
			from `tbdetalhespedido`
			INNER JOIN tbclientes ON tbclientes.codigo = tbdetalhespedido.codCliente
			INNER JOIN tbpedidosdeservico ON tbpedidosdeservico.codigo = tbdetalhespedido.codPedido 
			WHERE tbdetalhespedido.codFuncionario = $codigo AND `status` = 1 ORDER BY `codigo` DESC");

			$get2 = mysqli_query($con, "Select tbformcliente.codigo AS 'cod',
				tbdetalhespedido.codPedido, tbdetalhespedido.codCliente, 
				tbdetalhespedido.codFuncionario, tbdetalhespedido.status AS 'statusNegociacao', 
				tbclientes.codigo, tbclientes.nomeUsuario, tbclientes.foto, 
				tbpedidosdeservico.tipoServico, tbpedidosdeservico.AceitoPedido, tbpedidosdeservico.visNotificacao,
				tbformfunci.dataInicio, tbformfunci.horaInicio, tbformfunci.dataFinal, tbformfunci.horaFinal  
				from `tbformcliente` 
				INNER JOIN tbdetalhespedido ON tbdetalhespedido.codCliente = tbformcliente.codCliente 
				INNER JOIN tbclientes ON tbclientes.codigo = tbdetalhespedido.codCliente 
				INNER JOIN tbpedidosdeservico ON tbpedidosdeservico.codigo = tbformcliente.codServico 
				INNER JOIN tbformfunci ON tbformfunci.codServico = tbformcliente.codServico
				WHERE tbdetalhespedido.codFuncionario = '$codigo' AND `status` = 1 
				ORDER BY `codigo` DESC");


			$li = '';

			if(mysqli_num_rows($get2) > 0){


				while($linha = mysqli_fetch_array($get) and $linha = mysqli_fetch_array($get2)){

					//NOTIFICACOES DE NEGOCIACAO

					$li .= '<li class="n" id="'.$linha['cod'].' class="rounded-circle" ">';
					$li .= '<div class="imgn"><img src=' . $linha['foto'] .' /></div>'; 

					$li .= '<div class="contn">';
						$li .= '<span> O usuário '. $linha['nomeUsuario'].'</span><span> já respondeu o formulário de negociação.</span>';
					$li .= '</div>';

					$li .= '<div class="contn">';
						$li .= '<h5> Vá até o endereço dele na data 
						'. date_format(new DateTime($linha['dataInicio']), "d/m/Y") .'
						para fazer o serviço, após 2 horas depois do termíno do serviço(' 
						. $linha['horaFinal'] .') seu pagamento será liberado.</h5>';
					$li .= '</div>';

					

					$li .= '</li>';

					//---------------------------------------------------------------------------//


					//NOTIFICACOES DE FORMULÁRIOS

					$li .= '<li class="n" id="'.$linha['codigo'].' class="rounded-circle" ">';
					$li .= '<div class="imgn"><img src=' . $linha['foto'] .' /></div>'; 

					$li .= '<div class="contn">';
						$li .= '<span> O usuário '. $linha['nomeUsuario'].'</span><span> aceitou você como prestador de serviço.</span>';
					$li .= '</div>';

					$li .= '<a href=formularioFunci.php?cod=' . $linha['codCliente'] . '&cod2=' . $linha['codPedido'] . '&nomePedido=' . $linha['tipoServico'] . '>Responda este formulário com algumas informações.</a>';


					$li .= '</li>';

					//------------------------------------------------------------------------------------------------//
						
				}

				echo $li;

			}else{

				while($linha = mysqli_fetch_array($get)){



					//NOTIFICACOES DE FORMULÁRIOS

					$li .= '<li class="n" id="'.$linha['codigo'].' class="rounded-circle" ">';
					$li .= '<div class="imgn"><img src=' . $linha['foto'] .' /></div>'; 

					$li .= '<div class="contn">';
						$li .= '<span> O usuário '. $linha['nomeUsuario'].'</span><span> aceitou você como prestador de serviço.</span>';
					$li .= '</div>';

					$li .= '<a href=formularioFunci.php?cod=' . $linha['codCliente'] . '&cod2=' . $linha['codPedido'] . '&nomePedido=' . $linha['tipoServico'] . '>Responda este formulário com algumas informações.</a>';

					$li .= '</li>';

					//------------------------------------------------------------------------------------------------//

				}

				echo $li;
			}

			break;

		default:
			echo 'Erro';
		break;
	} 
?>