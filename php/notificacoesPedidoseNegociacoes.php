<?php 
	include('connect.php');
	session_start();
	$GET = strip_tags(trim($_GET['acao']));
	$codigo = $_SESSION['codiCliente'];

	switch ($GET) {
		
		case 'verificar':

			$novosPedidos = mysqli_query($con, "Select tbdetalhespedido.codPedido, tbdetalhespedido.codCliente,
			tbdetalhespedido.codFuncionario, 
			tbfuncionarios.codigo, tbfuncionarios.nomeUsuario, tbfuncionarios.foto,
			tbpedidosdeservico.tipoServico, tbpedidosdeservico.AceitoPedido, tbpedidosdeservico.visNotificacao
			from `tbdetalhespedido`
			INNER JOIN tbfuncionarios ON tbfuncionarios.codigo = tbdetalhespedido.codFuncionario
			INNER JOIN tbpedidosdeservico ON tbpedidosdeservico.codigo = tbdetalhespedido.codPedido 
			WHERE tbdetalhespedido.codCliente = $codigo AND `AceitoPedido` <= 5 AND `visNotificacao` = 0");

			$novasNegociacoes = mysqli_query($con, "Select tbformfunci.codigo AS 'cod', tbdetalhespedido.codPedido, tbdetalhespedido.codCliente, tbdetalhespedido.codFuncionario, tbdetalhespedido.status AS 'statusNegociacao', tbfuncionarios.codigo, tbfuncionarios.nomeUsuario, tbfuncionarios.foto, tbpedidosdeservico.tipoServico, tbpedidosdeservico.AceitoPedido, tbpedidosdeservico.visNotificacao 
				from `tbformfunci` 
				INNER JOIN tbdetalhespedido ON tbdetalhespedido.codFuncionario = tbformFunci.codFunci 
				INNER JOIN tbfuncionarios ON tbfuncionarios.codigo = tbdetalhespedido.codFuncionario 
				INNER JOIN tbpedidosdeservico ON tbpedidosdeservico.codigo = tbformfunci.codServico 
				WHERE tbdetalhespedido.codCliente = '$codigo' AND `status` = 1 ORDER BY `codigo` DESC");



			$numeroDePedidosAceitoseNegociacoes = mysqli_num_rows($novosPedidos) + mysqli_num_rows($novasNegociacoes);

			echo $numeroDePedidosAceitoseNegociacoes;

			break;

		case 'getnots' :

			$get = mysqli_query($con, "Select tbdetalhespedido.codPedido, tbdetalhespedido.codCliente,
			tbdetalhespedido.codFuncionario, 
			tbfuncionarios.codigo, tbfuncionarios.nomeUsuario, tbfuncionarios.foto,
			tbpedidosdeservico.tipoServico, tbpedidosdeservico.AceitoPedido, tbpedidosdeservico.visNotificacao
			from `tbdetalhespedido`
			INNER JOIN tbfuncionarios ON tbfuncionarios.codigo = tbdetalhespedido.codFuncionario
			INNER JOIN tbpedidosdeservico ON tbpedidosdeservico.codigo = tbdetalhespedido.codPedido 
			WHERE tbdetalhespedido.codCliente = $codigo AND `AceitoPedido` <= 5 ORDER BY `codigo` DESC");

			$get2 = mysqli_query($con, "Select tbformfunci.codigo AS 'cod', tbdetalhespedido.codPedido, tbdetalhespedido.codCliente, tbdetalhespedido.codFuncionario, tbdetalhespedido.status AS 'statusNegociacao', tbfuncionarios.codigo, tbfuncionarios.nomeUsuario, tbfuncionarios.foto, tbpedidosdeservico.tipoServico, tbpedidosdeservico.AceitoPedido, tbpedidosdeservico.visNotificacao 
				from `tbformfunci` 
				INNER JOIN tbdetalhespedido ON tbdetalhespedido.codFuncionario = tbformFunci.codFunci 
				INNER JOIN tbfuncionarios ON tbfuncionarios.codigo = tbdetalhespedido.codFuncionario 
				INNER JOIN tbpedidosdeservico ON tbpedidosdeservico.codigo = tbformfunci.codServico 
				WHERE tbdetalhespedido.codCliente = '$codigo' AND `status` = 1 ORDER BY `codigo` DESC");



			$li = '';

			if(mysqli_num_rows($get2) > 0){


				while($linha = mysqli_fetch_array($get) and $linha = mysqli_fetch_array($get2)){

					//NOTIFICACOES DE NEGOCIACAO

					$li .= '<li class="n" id="'.$linha['cod'].' class="rounded-circle" ">';
					$li .= '<div class="imgn"><img src=' . $linha['foto'] .' /></div>'; 

					$li .= '<div class="contn">';
						$li .= '<span> O usuário '. $linha['nomeUsuario'].'</span><span> já respondeu o formulário de negociação.</span>';
					$li .= '</div>';

					$li .= '<a href=formularioCliente.php?cod=' . $linha['codFuncionario'] . '&cod2=' . $linha['codPedido'] . '&nomePedido=' . $linha['tipoServico'] . '>Responda este formulário de confirmação.</a>';

					$li .= '</li>';

					//---------------------------------------------------------------------------//

					//NOTIFICACOES DE PEDIDOS

					$li .= '<li class="n" id="'.$linha['codigo'].' class="rounded-circle" ">';
					$li .= '<div class="imgn"><img src=' . $linha['foto'] .' /></div>'; 

					$li .= '<div class="contn">';
						$li .= '<span> O usuário '. $linha['nomeUsuario'].'</span><span> aceitou seu pedido de serviço.</span>';
					$li .= '</div>';

					$li .= '<a href=clienteVerPerfilFunci.php?cod=' . $linha['codigo'] . '>Visitar Perfil</a>';
					$li .= '<a href=php/fecharNegocio.act.php?cod='.$linha['codigo'].'&cod2='.$linha['codPedido'].'>Fechar négocio com este funcionário</a>';

					$li .= '</li>';

					//--------------------------------------------------------------------------------------------//
			
				}

				echo $li;

			}else{

				while($linha = mysqli_fetch_array($get)){

					//NOTIFICACOES DE PEDIDOS

					$li .= '<li class="n" id="'.$linha['codigo'].' class="rounded-circle" ">';
					$li .= '<div class="imgn"><img src=' . $linha['foto'] .' /></div>'; 

					$li .= '<div class="contn">';
						$li .= '<span> O usuário '. $linha['nomeUsuario'].'</span><span> aceitou seu pedido de serviço.</span>';
					$li .= '</div>';

					$li .= '<a href=clienteVerPerfilFunci.php?cod=' . $linha['codigo'] . '>Visitar Perfil</a>';
					$li .= '<a href=php/fecharNegocio.act.php?cod='.$linha['codigo'].'&cod2='.$linha['codPedido'].'>Fechar négocio com este funcionário</a>';

					$li .= '</li>';

					//--------------------------------------------------------------------------------------------//

				}

				echo $li;

			}

			break;
		
		default:
			echo 'Erro';
		break;
	} 
?>