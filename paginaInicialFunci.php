<?php require('php/segFunci.php'); require('php/connect.php'); ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>

	<title>Início</title>

    
    <link rel="shortcut icon" href="Imagens/favicon.ico" type="image/x-icon"/>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="css/bootstrap.css" rel="stylesheet" >
	<link href="css/estiloHomeFunci.css" rel="stylesheet" >
	<link href="css/cardslider.css" rel="stylesheet">

</head>
<script src="jquery/jquery-3.3.1.min.js"></script>
<script src="js/functionsPaginaInicialFunci.js"></script>
<script src="js/pesquisaFunci.js"></script>


<script src="js/carregando.js"></script>
<div class="carregando" id="carregando"></div>
<div class="corpoCarregado" id="corpoCarregado">
<body>

<nav class="navbar navbar-expand-lg navbar-light ">
	<div class="container">
		<a href=paginaInicialFunci.php title="Início"><img class="picareta" src=Imagens/picareta.png title="Início" /></a>

		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    	<span class="navbar-toggler-icon"></span>
	    </button>
		
		<div class="collapse navbar-collapse ml-400" id="navbarSupportedContent">
	    	<ul class="navbar-nav">
				<a href="#openModalPesquisar" style="text-decoration: none" title="Pesquisar"><input class="form-control" type="submit" value="Pesquisar" placeholder="Pesquisar"/></a>
	    		<div class="teste">
					<nav class="menunav">

						<ul> 
							<?php

								echo 
								"

									<li title='Visitar Perfil'>
										<a href=verPerfilFunci.php?cod=" . $_SESSION["codiFunci"] . ">
											<u><img class=rounded-circle src= ". $_SESSION["fotoFunci"] ." /></u>
										</a>
									</li>

									<li class=nome title='Visitar Perfil' id=". $_SESSION["codiFunciChat"] .">
										<a href=verPerfilFunci.php?cod=" . $_SESSION["codiFunci"] . ">
											<u>" . $_SESSION["nome_usuarioFunci"] . "</u>
										</a>
									</li>

									<ul class=nots>

										<li class=msgs title='Notificações de Mensagens'>Mensagens
											<div class=ctnotsMsg>0</div>
											<ul class=dpMsg>
												<div class=arrow-downMsg></div>  

												<li class=titlenotMsg>Notificações de Mensagens</li> 
											 	
											 	<div id=resMsg></div>
											</ul> 
										</li> 

										<li class=notifs title='Notificações'>Notificações

											<div class=ctnots>0</div> 
											
											<ul class=dp>
												<div class=arrow-down></div>  

												<li class=titlenot>Notificações</li> 
											 	
											 	<div id=res></div>
											</ul> 
										</li>
									</ul> 
									
									<li>

										<div class=dropdown>

										  <button title='Configurações' class=btn btn-secondary dropdown-toggle type=button id=dropdownMenuButton 
										  data-toggle=dropdown aria-haspopup=true aria-expanded=false>
										    	<u><img src=Imagens/engrenagem.png /></u>
										  </button>

										  <div class=dropdown-menu aria-labelledby=dropdownMenuButton>
											    <a class=dropdown-item href=suporteFunci.php?cod=" . $_SESSION["codiFunci"] . " title='Suporte'>Suporte</a>
											    <a class=dropdown-item href=php/logoffFunci.php title='Sair'>Sair</a>
										  </div>

										</div>
									</li>


								";
							?>

							<script type="text/javascript" src="js/mod_xhr.js"></script>

							<script type="text/javascript" src="js/notificacoesFunci.js"></script>
						</ul>
					</nav>	
				</div>
			</ul>
		</div>	
	<div>
</nav>

        <?php
		//LISTAS DE PEDIDOS DE SERVIÇO

		include('php/connect.php');

		$profissao =  $_SESSION['prof'];

		
		$lista = mysqli_query($con, "Select tbpedidosdeservico.codigo, tbpedidosdeservico.tipoServico, tbpedidosdeservico.descricaoPedido, 
		tbpedidosdeservico.dataDoPedido, tbpedidosdeservico.AceitoPedido, 
		tbclientes.codigo AS 'codiCliente', tbclientes.nomeUsuario, tbclientes.foto, tbvisupedidos.numVisu
		from `tbpedidosdeservico` 
		INNER JOIN tbclientes ON tbclientes.codigo = tbpedidosdeservico.codCliente
		INNER JOIN tbvisupedidos ON tbvisupedidos.codPedido = tbpedidosdeservico.codigo
		WHERE tbpedidosdeservico.tipoServico = '$profissao' AND tbpedidosdeservico.statusPedido = '0'
		ORDER BY `codigo` DESC LIMIT 9");

		$result = false;
		if(mysqli_num_rows($lista) >= 1){
			echo "
		
			<section class='carousel slide' data-ride='carousel' id='postsCarousel'>
			<div class='container p-t-0 m-t-2 carousel-inner'>
			<h1 class=titulo>Os Pedidos de Serviço de sua Profissão</h1>
		
			<a class='btn btn-outline-secondary prev' href='' title='Anterior' id='ante'><<i class='fa fa-lg fa-chevron-left'></i></a>
			<a class='btn btn-outline-secondary next' href='' title='Próximo' id='prox'>><i class='fa fa-lg fa-chevron-right'></i></a>
		
			
			";
			$result=true;
		}else{
			echo"<h1>Não existe nenhum pedido de serviço para sua profisssão.</h1>";
			$result = false;
		}

		if($result == true){

			$contSlider = 0;
			$contFuncionario = 0;
			while($linha = mysqli_fetch_array($lista)){
				if ($contSlider == 0 && $contFuncionario == 0){
					echo '<div class="row row-equal carousel-item active m-t-0">';
				}else if($contFuncionario == 0){
					echo '<div class="row row-equal carousel-item  m-t-0">';
				}

				if($linha['AceitoPedido'] < 5){
					echo "
						<div class=col-md-4>
							<div class=conteudo>
								<div class=box>
									<p><img src=$linha[foto] class=foto_box></p>
									<p><b>Nome do Cliente:</b> $linha[nomeUsuario]</p>
									<p><b>Serviço:</b> $linha[tipoServico]</p>
									<p><b>Descrição:</b> $linha[descricaoPedido]</p>
									<p><b>Visualizações deste pedido:</b> $linha[numVisu]</p>
									<p><b>Data deste pedido:</b>" . date_format(new DateTime($linha['dataDoPedido']), "d/m/Y") . "</p>
									<div class=botao id=$linha[codigo] title='Aceitar Pedido'><a href=php/aceitarPedido.act.php?cod=$linha[codigo]>Aceitar Pedido</a></div>
									<div class=botao2 title='Visitar Perfil'><a href=funciVerPerfilCliente.php?cod=$linha[codiCliente]>Visitar Perfil</a>						
								</div>
							</div>
						</div>
					</div>";
				}

				$contFuncionario++;
				if($contFuncionario == 3){
					echo '</div>';
					$contSlider++;
					$contFuncionario = 0;
				}



				//VISUALIZAÇÕES

				$query2 = "SELECT * FROM `tbvisupedidos` WHERE codPedido = '$linha[codigo]' AND codFunci = '$_SESSION[codiFunci]'";
				$result2 = mysqli_query($con, $query2);
				$row2 = mysqli_num_rows($result2);
				$registro = false;

				if($row2>0){
					$registro = true; 
				}//VERIFICA SE O FUNCIONARIO JÁ DEU UMA VISUALIZAÇÃO PARA AQUELE PEDIDO

				if($registro == false){//se não deu a visualização é contabilizada

					$maiorCodigo = "select numVisu from tbvisupedidos WHERE tbvisupedidos.codPedido = '$linha[codigo]'";
					$resultado_maiorcodigo = mysqli_query ($con, $maiorCodigo);
					$row = mysqli_fetch_array($resultado_maiorcodigo);

					$numeroDeVisualizações = $row['numVisu'];
					$numeroDeVisualizações = $numeroDeVisualizações + 1;

					$visuTrue = mysqli_query($con, "UPDATE `tbvisupedidos` SET codFunci = '$_SESSION[codiFunci]', 
					numVisu = '$numeroDeVisualizações' WHERE  codPedido = '$linha[codigo]'");

					if(!$visuTrue){
						die("Erro ao inserir visualização na tabela pedidos de serviço");

					}
				}
				//-------------------------------------------------------------------------------------------//
			}

			if ($contFuncionario > 0){
				echo '</div>';
			}
		}	
		?>
    </div>
</section>
<script src="jquery/jquery-3.3.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script>
//Galeria de 
$('.carousel').next({
	// options
	cellAlign: 'left',
	contain: true,
	pageDots: false
});

$('.carousel').carousel({
    pause: true,
    interval: false
});

(function($){
	   "use strict";
	   $('.next').click(function(){ $('.carousel').carousel('next');return false; });
	   $('.prev').click(function(){ $('.carousel').carousel('prev');return false; });
   })	
   (jQuery);

//------------------------------------------------------------------------//
</script>

<div class="container2">
	<div class="container">
		<div id="openModalPesquisar" class="modalDialog">
			<div>
				<a href="#close" title="Fechar" class="closeModal"></a>
				<h2>Pesquisar</h2>
				<div class="textos">
					<form  method="post">
						<label for="txt_pesquisar">Digite o nome desejado:</label>
						<input class="pesquisa" type="search" id="txt_pesquisar" onkeyup="pesquisar(this.value)" 
						placeholder="Procure por Clientes."/>
						<div id="retorno">
							
						</div>
					</form>
		    	</div>
			</div>
		</div>
	</div>
</div>

<aside id="chats">
			
</aside>
<script src="js/chatFunci.js"></script>

</body>
</div>
</html>