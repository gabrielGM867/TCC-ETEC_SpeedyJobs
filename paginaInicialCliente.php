<?php require('php/segCliente.php'); require('php/connect.php'); ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>

	<title>Início</title>

    <link rel="shortcut icon" href="Imagens/favicon.ico" type="image/x-icon"/>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="css/bootstrap.css" rel="stylesheet" >
	<link href="css/estiloHome.css" rel="stylesheet" >
    <link href="css/cardslider.css" rel="stylesheet">

</head>

<script src="jquery/jquery-3.3.1.min.js"></script>
<script src="js/functionsPaginaInicalCliente.js"></script>
<script src="js/pesquisaCliente.js"></script>


<script src="js/carregando.js"></script>
<div class="carregando" id="carregando"></div>
<div class="corpoCarregado" id="corpoCarregado">
<body>

<div class="div2">
	<nav class="navbar navbar-expand-lg navbar-light ">
		<div class="container">
			<a href=paginaInicialCliente.php title="Início"><img class="picareta" src=Imagens/picareta.png /></a>

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
											<a href=verPerfilCliente.php?cod=" . $_SESSION["codiCliente"] . ">
												<u><img class=rounded-circle src= ". $_SESSION["fotoCliente"] ." /></u>
											</a>
										</li>

										<li class=nome title='Visitar Perfil' id=" . $_SESSION["codiClienteChat"] .">
											<a href=verPerfilCliente.php?cod=" . $_SESSION["codiCliente"] . ">
												<u>" . $_SESSION["nome_usuarioCliente"] . "</u>
											</a>
										</li>

										
											<ul class=nots title='Notificações de Mensagens'>

												<li class=msgs>Mensagens
													<div class=ctnotsMsg>0</div>
													<ul class=dpMsg>
														<div class=arrow-downMsg></div>  

														<li class=titlenotMsg>Notificações de Mensagens</li> 
													 	
													 	<div id=resMsg>
														</div>
													</ul> 
												</li> 
											
												<li class=notifs title='Notificações de Pedidos de Serviço'>Notificações

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
												    <a class=dropdown-item href=suporteCliente.php?cod=" . $_SESSION["codiCliente"] . " title='Suporte'>Suporte</a>
												    <a class=dropdown-item href=php/logoffCliente.php title='Sair'>Sair</a>
											  </div>

											</div>
										</li>

									";
								?>


								<script type="text/javascript" src="js/mod_xhr.js"></script>
								<script type="text/javascript" src="js/notificacoesCliente.js"></script>
	
							</ul>
						<nav>	
					</div>
				</ul>
			</div>	
		<div>
	</nav>
</div>

<?php
		//LISTAS DE FUNCIONÁRIOS

		include('php/connect.php');
		
		$lista = mysqli_query($con, "Select tbfuncionarios.codigo, tbfuncionarios.nome, tbfuncionarios.nomeUsuario, tbfuncionarios.profissao,
		tbfuncionarios.foto, tbenderecofuncionario.cidade, tbenderecofuncionario.estado
		from `tbfuncionarios` 
		INNER JOIN `tbenderecofuncionario` ON tbenderecofuncionario.codFunci = tbfuncionarios.codigo ORDER BY `codigo` DESC LIMIT 9");

		$result = false;
		if(mysqli_num_rows($lista) >= 1){
			echo "
		
			<section class='carousel slide' data-ride='carousel' id='postsCarousel'>
			<div class='container p-t-0 m-t-2 carousel-inner'>
			<h1 class=titulo>Os Funcionários Mais Bem Avaliados</h1>
		
			<a class='btn btn-outline-secondary prev' href='' title='Anterior' id='ante'><<i class='fa fa-lg fa-chevron-left'></i></a>
			<a class='btn btn-outline-secondary next' href='' title='Próximo' id='prox'>><i class='fa fa-lg fa-chevron-right'></i></a>
		
			
			";
			$result=true;
		}else{
			echo"<h1>Não existe nenhum funcionário cadastrado ainda.</h1>";
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
							
				echo "
				<div class=col-md-4>
					<div class=conteudo>
						<div class=box>
							<p><img src=$linha[foto] class=foto_box>$linha[nome]</p>
							<p><b>Usuário:</b> $linha[nomeUsuario]</p>
							<p><b>Profissão:</b> $linha[profissao]</p>
							<p><b>Localização:</b> $linha[cidade] - $linha[estado]</p>
							<div class=botao><a href=clienteVerPerfilFunci.php?cod=$linha[codigo] title='Visitar Perfil'>Visitar Perfil</a></div>
							<div class=botao2><a href=# title='Contatar'>Contatar</a></div>
						</div>
					</div>
					</div>";
				$contFuncionario++;

				if($contFuncionario == 3){
					echo '</div>';
					$contSlider++;
					$contFuncionario = 0;
				}
				
			}
			if ($contFuncionario > 0){
				echo '</div>';
			}
		}
		?>
		
    </div>
</section>
<br />
<br />

<?php
		//LISTAS DE FUNCIONÁRIOS JERDINEIROS

		include('php/connect.php');
		
		$lista = mysqli_query($con, "Select 
		tbfuncionarios.codigo, tbfuncionarios.nome, tbfuncionarios.nomeUsuario, tbfuncionarios.profissao,
		tbfuncionarios.foto, tbenderecofuncionario.cidade, tbenderecofuncionario.estado
		from `tbfuncionarios` 
		INNER JOIN `tbenderecofuncionario` ON tbenderecofuncionario.codFunci = tbfuncionarios.codigo 
		WHERE tbfuncionarios.profissao = 'Jardineiro' or tbfuncionarios.profissao = 'Jardineira' 
		ORDER BY `codigo` DESC LIMIT 9" );

		$result = false;
		if(mysqli_num_rows($lista) >= 1){
			echo "
		
			<section class='carousel slide' data-ride='carousel' id='postsCarousel'>
			<div class='container p-t-0 m-t-2 carousel-inner'>
			<h1 class=titulo>Os Jardineiros Mais Bem Avaliados</h1>
		
			<a class='btn btn-outline-secondary prev' href='' title='Anterior' id='ante'><<i class='fa fa-lg fa-chevron-left'></i></a>
			<a class='btn btn-outline-secondary next' href='' title='Próximo' id='prox'>><i class='fa fa-lg fa-chevron-right'></i></a>
		
			
			";
			$result=true;
		}else{
			echo"<h1>Não existe nenhum funcionário cadastrado ainda.</h1>";
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
							
				echo "
				<div class=col-md-4>
					<div class=conteudo>
						<div class=box>
							<p><img src=$linha[foto] class=foto_box>$linha[nome]</p>
							<p><b>Usuário:</b> $linha[nomeUsuario]</p>
							<p><b>Profissão:</b> $linha[profissao]</p>
							<p><b>Localização:</b> $linha[cidade] - $linha[estado]</p>
							<div class=botao><a href=clienteVerPerfilFunci.php?cod=$linha[codigo] title='Visitar Perfil'>Visitar Perfil</a></div>
							<div class=botao2><a href=# title='Contatar'>Contatar</a></div>
						</div>
					</div>
					</div>";
				$contFuncionario++;

				if($contFuncionario == 3){
					echo '</div>';
					$contSlider++;
					$contFuncionario = 0;
				}
				
			}
			if ($contFuncionario > 0){
				echo '</div>';
			}
		}
		?>
		
    </div>
</section>
<br />
<br />

<?php
		//LISTAS DE FUNCIONÁRIOS CARPINTEIROS

		include('php/connect.php');
		
		$lista = mysqli_query($con, "Select 
		tbfuncionarios.codigo, tbfuncionarios.nome, tbfuncionarios.nomeUsuario, tbfuncionarios.profissao,
		tbfuncionarios.foto, tbenderecofuncionario.cidade, tbenderecofuncionario.estado
		from `tbfuncionarios` 
		INNER JOIN `tbenderecofuncionario` ON tbenderecofuncionario.codFunci = tbfuncionarios.codigo 
		WHERE tbfuncionarios.profissao = 'Carpinteiro' or tbfuncionarios.profissao = 'Carpinteira' 
		ORDER BY `codigo` DESC LIMIT 9" );

		$result = false;
		if(mysqli_num_rows($lista) >= 1){
			echo "
		
			<section class='carousel slide' data-ride='carousel' id='postsCarousel'>
			<div class='container p-t-0 m-t-2 carousel-inner'>
			<h1 class=titulo>Os Carpinteiros Mais Bem Avaliados</h1>
		
			<a class='btn btn-outline-secondary prev' href='' title='Anterior' id='ante'><<i class='fa fa-lg fa-chevron-left'></i></a>
			<a class='btn btn-outline-secondary next' href='' title='Próximo' id='prox'>><i class='fa fa-lg fa-chevron-right'></i></a>
		
			
			";
			$result=true;
		}else{
			echo"<h1>Não existe nenhum funcionário cadastrado ainda.</h1>";
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
							
				echo "
				<div class=col-md-4>
					<div class=conteudo>
						<div class=box>
							<p><img src=$linha[foto] class=foto_box>$linha[nome]</p>
							<p><b>Usuário:</b> $linha[nomeUsuario]</p>
							<p><b>Profissão:</b> $linha[profissao]</p>
							<p><b>Localização:</b> $linha[cidade] - $linha[estado]</p>
							<div class=botao><a href=clienteVerPerfilFunci.php?cod=$linha[codigo] title='Visitar Perfil'>Visitar Perfil</a></div>
							<div class=botao2><a href=# title='Contatar'>Contatar</a></div>
						</div>
					</div>
					</div>";
				$contFuncionario++;

				if($contFuncionario == 3){
					echo '</div>';
					$contSlider++;
					$contFuncionario = 0;
				}
				
			}
			if ($contFuncionario > 0){
				echo '</div>';
			}
		}
		?>
		
    </div>
</section>
<br />
<br />

<?php
		//LISTAS DE FUNCIONÁRIOS ELETRICISTA

		include('php/connect.php');
		
		$lista = mysqli_query($con, "Select 
		tbfuncionarios.codigo, tbfuncionarios.nome, tbfuncionarios.nomeUsuario, tbfuncionarios.profissao,
		tbfuncionarios.foto, tbenderecofuncionario.cidade, tbenderecofuncionario.estado
		from `tbfuncionarios` 
		INNER JOIN `tbenderecofuncionario` ON tbenderecofuncionario.codFunci = tbfuncionarios.codigo 
		WHERE tbfuncionarios.profissao = 'Eletricista' 
		ORDER BY `codigo` DESC LIMIT 9" );

		$result = false;
		if(mysqli_num_rows($lista) >= 1){
			echo "
		
			<section class='carousel slide' data-ride='carousel' id='postsCarousel'>
			<div class='container p-t-0 m-t-2 carousel-inner'>
			<h1 class=titulo>Os Eletricistas Mais Bem Avaliados</h1>
		
			<a class='btn btn-outline-secondary prev' href='' title='Anterior' id='ante'><<i class='fa fa-lg fa-chevron-left'></i></a>
			<a class='btn btn-outline-secondary next' href='' title='Próximo' id='prox'>><i class='fa fa-lg fa-chevron-right'></i></a>
		
			
			";
			$result=true;
		}else{
			echo"<h1>Não existe nenhum funcionário cadastrado ainda.</h1>";
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
							
				echo "
				<div class=col-md-4>
					<div class=conteudo>
						<div class=box>
							<p><img src=$linha[foto] class=foto_box>$linha[nome]</p>
							<p><b>Usuário:</b> $linha[nomeUsuario]</p>
							<p><b>Profissão:</b> $linha[profissao]</p>
							<p><b>Localização:</b> $linha[cidade] - $linha[estado]</p>
							<div class=botao><a href=clienteVerPerfilFunci.php?cod=$linha[codigo] title='Visitar Perfil'>Visitar Perfil</a></div>
							<div class=botao2><a href=# title='Contatar'>Contatar</a></div>
						</div>
					</div>
					</div>";
				$contFuncionario++;

				if($contFuncionario == 3){
					echo '</div>';
					$contSlider++;
					$contFuncionario = 0;
				}
				
			}
			if ($contFuncionario > 0){
				echo '</div>';
			}
		}
		?>
		
    </div>
</section>
<br />
<br />

<?php
		//LISTAS DE FUNCIONÁRIOS MARCENEIROS

		include('php/connect.php');
		
		$lista = mysqli_query($con, "Select 
		tbfuncionarios.codigo, tbfuncionarios.nome, tbfuncionarios.nomeUsuario, tbfuncionarios.profissao,
		tbfuncionarios.foto, tbenderecofuncionario.cidade, tbenderecofuncionario.estado
		from `tbfuncionarios` 
		INNER JOIN `tbenderecofuncionario` ON tbenderecofuncionario.codFunci = tbfuncionarios.codigo 
		WHERE tbfuncionarios.profissao = 'Marceneiro' 
		ORDER BY `codigo` DESC LIMIT 9" );

		$result = false;
		if(mysqli_num_rows($lista) >= 1){
			echo "
		
			<section class='carousel slide' data-ride='carousel' id='postsCarousel'>
			<div class='container p-t-0 m-t-2 carousel-inner'>
			<h1 class=titulo>Os Marceneiros Mais Bem Avaliados</h1>
		
			<a class='btn btn-outline-secondary prev' href='' title='Anterior' id='ante'><<i class='fa fa-lg fa-chevron-left'></i></a>
			<a class='btn btn-outline-secondary next' href='' title='Próximo' id='prox'>><i class='fa fa-lg fa-chevron-right'></i></a>
		
			
			";
			$result=true;
		}else{
			echo"<h1>Não existe nenhum funcionário cadastrado ainda.</h1>";
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
							
				echo "
				<div class=col-md-4>
					<div class=conteudo>
						<div class=box>
							<p><img src=$linha[foto] class=foto_box>$linha[nome]</p>
							<p><b>Usuário:</b> $linha[nomeUsuario]</p>
							<p><b>Profissão:</b> $linha[profissao]</p>
							<p><b>Localização:</b> $linha[cidade] - $linha[estado]</p>
							<div class=botao><a href=clienteVerPerfilFunci.php?cod=$linha[codigo] title='Visitar Perfil'>Visitar Perfil</a></div>
							<div class=botao2><a href=# title='Contatar'>Contatar</a></div>
						</div>
					</div>
					</div>";
				$contFuncionario++;

				if($contFuncionario == 3){
					echo '</div>';
					$contSlider++;
					$contFuncionario = 0;
				}
				
			}
			if ($contFuncionario > 0){
				echo '</div>';
			}
		}
		?>
		
    </div>
</section>
<br />
<br />

<?php
		//LISTAS DE FUNCIONÁRIOS faxineiros

		include('php/connect.php');
		
		$lista = mysqli_query($con, "Select 
		tbfuncionarios.codigo, tbfuncionarios.nome, tbfuncionarios.nomeUsuario, tbfuncionarios.profissao,
		tbfuncionarios.foto, tbenderecofuncionario.cidade, tbenderecofuncionario.estado
		from `tbfuncionarios` 
		INNER JOIN `tbenderecofuncionario` ON tbenderecofuncionario.codFunci = tbfuncionarios.codigo 
		WHERE tbfuncionarios.profissao = 'Faxineira' 
		ORDER BY `codigo` DESC LIMIT 9" );

		$result = false;
		if(mysqli_num_rows($lista) >= 1){
			echo "
		
			<section class='carousel slide' data-ride='carousel' id='postsCarousel'>
			<div class='container p-t-0 m-t-2 carousel-inner'>
			<h1 class=titulo>Os Faxineiros Mais Bem Avaliados</h1>
		
			<a class='btn btn-outline-secondary prev' href='' title='Anterior' id='ante'><<i class='fa fa-lg fa-chevron-left'></i></a>
			<a class='btn btn-outline-secondary next' href='' title='Próximo' id='prox'>><i class='fa fa-lg fa-chevron-right'></i></a>
		
			
			";
			$result=true;
		}else{
			echo"<h1>Não existe nenhum funcionário cadastrado ainda.</h1>";
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
							
				echo "
				<div class=col-md-4>
					<div class=conteudo>
						<div class=box>
							<p><img src=$linha[foto] class=foto_box>$linha[nome]</p>
							<p><b>Usuário:</b> $linha[nomeUsuario]</p>
							<p><b>Profissão:</b> $linha[profissao]</p>
							<p><b>Localização:</b> $linha[cidade] - $linha[estado]</p>
							<div class=botao><a href=clienteVerPerfilFunci.php?cod=$linha[codigo] title='Visitar Perfil'>Visitar Perfil</a></div>
							<div class=botao2><a href=# title='Contatar'>Contatar</a></div>
						</div>
					</div>
					</div>";
				$contFuncionario++;

				if($contFuncionario == 3){
					echo '</div>';
					$contSlider++;
					$contFuncionario = 0;
				}
				
			}
			if ($contFuncionario > 0){
				echo '</div>';
			}
		}
		?>
		
    </div>
</section>
<br />
<br />

<script src="jquery/jquery-3.3.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script>
//Galeria de funcionarios
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

<div class="pull-right">
	<a href="#openModal" class="scrollup" title="Postar Pedido de Serviço"><img src="Imagens/pMartelo.png" /></a>

	<div id="openModalPesquisar" class="modalDialog">
		<div>
			<a href="#close" title="Fechar" class="closeModal"></a>
			<h2>Pesquisar</h2>
			<div class="textos">
				<form  method="post">
					<label for="txt_pesquisar">Digite o nome desejado:</label>
					<input title="Pesquisar" class="pesquisa" type="search" id="txt_pesquisar" onkeyup="pesquisar(this.value)" 
					placeholder="Procure por Funcionários ou Profissões."/>
					<div id="retorno">
						
					</div>
				</form>
	    	</div>
		</div>
	</div>
	
	<div id="openModal" class="modalDialog">
		<div>
			<a href="#close" title="Fechar" class="closeModal"></a>
			<h2>Postar Seu Pedido</h2>
				<div class="textos">
					<form name="formPostarPedido" method="post" enctype="multipart/form-data" action="php/incluirPedidoServico.act.php"
			        onsubmit="return validar_formPostarPedido(this)">

		            <label for="servico">Digite o tipo de serviço desejado:</label>
		            <input type="text" name="servico" title="Digite uma profissão" placeholder="Serviço"/><br />

		            <label for="descricao">Digite uma descrição de seu pedido:</label>
		         	<textarea name="descricao" title="Digite uma descrição para seu pedido" placeholder="Descrição"></textarea><br />
		            
		            <div id="alertServicoVazio">
		                <footer class="alert">
		                    <span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
		                    O campo de serviço está vazio.
		                </footer>
		            </div>

		            <div id="alertDescricaoVazio">
		                <footer class="alert">
		                    <span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
		                    O campo descrição do pedido está vazio.
		                </footer>
		            </div>

		            <div id="alertServico50">
		                <footer class="alert">
		                    <span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
		                    O tipo de serviço só pode ter no máximo 50 caracteres.
		                </footer>
		            </div>

		            <div id="alertDescricao100">
		                <footer class="alert">
		                    <span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
		                    A descrição do pedido só pode ter no máximo 100 caracteres.
		                </footer>
		            </div>
		            <br /><input type="submit" name="btenviar_pedido" value="Enviar" title="Enviar">
		        </form>
		    </div>
		</div>
	</div>
</div>


<aside id="chats">
			
</aside>
<script src="js/chatCliente.js"></script>

</body>
</div>
</html>