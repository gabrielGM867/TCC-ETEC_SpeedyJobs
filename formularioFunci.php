<?php require('php/segFunci.php'); require('php/connect.php'); ?>
<?php
    if(isset($_GET)){
        if(isset($_SESSION)){
            if(isset($_GET['cod']) and isset($_GET['nomePedido'])){
                  
            }else{header("location:paginaInicialFunci.php");}
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>

	<title>Formulário</title>

    <link rel="shortcut icon" href="Imagens/favicon.ico" type="image/x-icon"/>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/estiloFormFunci.css" rel="stylesheet">
	<script src="jquery/jquery-3.3.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/popper.min.js"></script>

</head>

<script src="js/pesquisaFunci.js"></script>

<script src="js/carregando.js"></script>

<div class="carregando" id="carregando"></div>
<div class="corpoCarregado" id="corpoCarregado">
	<body>

		
<nav class="navbar navbar-expand-lg navbar-light ">
    <div class="container">
       <a href=paginaInicialFunci.php title="Início"> <img class="picareta" src=Imagens/picareta.png /></a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse ml-400" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <a href="#openModalPesquisar" title="Pesquisar" style="text-decoration: none"><input class="form-control" type="submit" value="Pesquisar" placeholder="Pesquisar"/></a>
                <div class="teste">
                    <nav class="menunav">

                        <ul>
                			<?php

                				echo 
                				"

                					<li title='Ver Perfil'>
                                        <a href=verPerfilFunci.php?cod=" . $_SESSION["codiFunci"] . ">
                                            <u><img class=rounded-circle src= ". $_SESSION["fotoFunci"] ." /></u>
                                        </a>
                                    </li>

                                    <li class=nome title='Ver Perfil' id=". $_SESSION["codiFunciChat"] .">
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
                    <nav>   
                </div>
            </ul>
        </div>  
    <div>
</nav>


		<div class="resp"></div>
		 <?php
            $codigoFunci = mysqli_real_escape_string($con, addslashes($_GET['cod']));//Pega código do cliente
            $codigoServico = mysqli_real_escape_string($con, addslashes($_GET['cod2']));//Pega código do serviço
            echo'
                <form method=post id=formulario name=formulario enctype=multipart/form-data action=php/incluirFormFunci.act.php?cod='. $codigoFunci .'&cod2='. $codigoServico .'>
            ';
        ?>
			<ul id="progress">
				<li class="ativo">Pedido</li>
				<li>Conta Bancária</li>
				<li>Confirmação</li>
			</ul>
				<fieldset>
					<h2>Detalhes do pedido</h2>
					<h3>Insira abaixo os detalhes necessários</h3>
					<input type="text" name="tipoPedido" placeholder="Tipo do pedido" 
					value="<?php echo $_GET['nomePedido']; ?>" readonly/><br><br>
					<h4>Insira a data de início do pedido</h4>
					<input type="date" name="dataInicioPedido" placeholder="Insira a data de início do pedido" />
                    <h4>Insira a hora de início do pedido</h4>
                    <input type="time" name="horaInicioPedido" placeholder="Insira a hora de início do pedido" />
					<br><h4>Insira a data prevista para término</h4>
					<input type="date" name="dataFinalPedido" placeholder="Insira a data prevista para término" />
                    <h4>Insira a hora prevista para término</h4>
                    <input type="time" name="horaFinalPedido" placeholder="Insira a hora prevista para término" />
					<input type="button" name="next1" class="next acao" value="Proximo">
				</fieldset>

				<fieldset>
					<h2>Dados Financeiros</h2>
					<h3>Insira abaixo os dados de sua conta bancária</h3>
                    <h4>Insira o número da sua agência</h4>
					<input type="number" name="agencia" placeholder="Nº da Agência" maxlength="4"/>
                    <h4>Insira sua conta</h4>
					<input type="text" name="tipoConta" placeholder="Ex.: Conta" maxlength="8"/>
                    <h4>Insira o valor cobrado pelo serviço</h4> 
					<input type="text" name="valor" placeholder="Valor do serviço. Ex.: R$ 150,00" />
					<input type="button" name="prev" class="prev acao" value="Anterior">
					<input type="button" name="next2" class="next acao" value="Proximo">
				</fieldset>

				<fieldset>
					<h2>Confirmação</h2>
					<h3>Confirme seus dados financeiros</h3>
                    <h4>Confirme o número da sua agência</h4>
					<input type="number" name="agencia" placeholder="Nº da Agência" maxlength="4"/>
                    <h4>Confirme sua conta</h4>
                    <input type="text" name="tipoConta" placeholder="Ex.: Conta" maxlength="8"/> 
                    <h4>Confirme o valor cobrado pelo serviço</h4>
                    <input type="text" name="valor" placeholder="Valor do serviço. Ex.: R$ 150,00" />
					<input type="button" name="prev" class="prev acao" value="Anterior">
					<input id="botaoSubmit" type="submit" name="next" class="acao" value="Enviar" 
                    style="background: rgb(18, 142, 229)">
				</fieldset>
		</form>
	
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
		<script src="js/functionsFormFunci.js"></script>

	</body>
</div>
</html>