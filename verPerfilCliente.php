<?php require('php/segCliente.php'); require('php/connect.php'); ?>
<?php
    if(isset($_GET)){
        if(isset($_SESSION)){
            if(isset($_GET['cod'])){
                if($_GET['cod'] == $_SESSION['codiCliente']){}
                else{header("location:paginaInicialCliente.php");}  
            }else{header("location:paginaInicialCliente.php");}
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>

	<title><?php echo $_SESSION["nome_usuarioCliente"]; ?></title>

    <link rel="shortcut icon" href="Imagens/favicon.ico" type="image/x-icon"/>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/estiloVerPerfilCliente.css" rel="stylesheet">
    <script src="jquery/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</head>


<script src="js/carregando.js"></script>
<div class="carregando" id="carregando"></div>
<div class="corpoCarregado" id="corpoCarregado">
<body>

<script src="js/functionsVerPerfil.js"></script>
<script src="js/pesquisaCliente.js"></script>

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

    <?php 

        include('php/connect.php');

        $codigoo = mysqli_real_escape_string($con, addslashes($_GET['cod']));//Pega código do cliente

        $lista = mysqli_query($con, "Select tbclientes.fotoCapa from `tbclientes` 
        WHERE tbclientes.codigo = $codigoo");


        while($linha = mysqli_fetch_array($lista)){

            if($linha['fotoCapa'] == '0'){
                echo "<div class= 'barra' style= 'background:linear-gradient(white 80%, rgba(0,0,0, .53));'>";

            }else{
                echo "<div class= 'barra' style= 'background: url($linha[fotoCapa]) no-repeat; background-size:cover; '>";
            }

            mysqli_close ($con); 
        }

    ?>
    <div class="container">
         
        <?php

        include('php/connect.php');

        $codigoo = mysqli_real_escape_string($con, addslashes($_GET['cod']));//Pega código do cliente

        $lista = mysqli_query($con, "Select tbclientes.foto, tbclientes.nomeUsuario from `tbclientes` 
        WHERE tbclientes.codigo = $codigoo");


        while($linha = mysqli_fetch_array($lista)){


            echo "

                <div class=centro>
                    <p><img src=$linha[foto] class=rounded-circle></p>
                </div> 

                <div class=centro>
                    <h1>$linha[nomeUsuario]</h1>   
                </div>
                
                ";

            mysqli_close ($con); 

        }
        ?>
    </div>
    <div class="btn-success" >
        <a href="#openModalEdicao" title="Editar Perfil">Editar Perfil</a>  
    </div>
</div>

<div class="container-fluid">
    
    <div class="info"> 
        <div class="form-signin">
            <?php

            include('php/connect.php');

            $codigoo = mysqli_real_escape_string($con, addslashes($_GET['cod']));//Pega código do cliente

            $lista = mysqli_query($con, "Select tbclientes.foto, tbclientes.nome, tbclientes.nomeUsuario, tbclientes.email, tbclientes.dataNascimento,
            tbclientes.sexo,
            tbenderecocliente.cep, tbenderecocliente.rua, tbenderecocliente.bairro, tbenderecocliente.cidade, tbenderecocliente.estado,
            tbtelefonescliente.numero 
            from `tbclientes` 
            INNER JOIN tbenderecocliente ON tbenderecocliente.codCliente = tbclientes.codigo
            INNER JOIN tbtelefonescliente ON tbtelefonescliente.codCliente = tbclientes.codigo 
            WHERE tbclientes.codigo = $codigoo");


            while($linha = mysqli_fetch_array($lista)){


                if($linha["sexo"] == "m"){

                    $sexo = "Masculino";
                }

                if($linha["sexo"] == "f"){

                    $sexo = "Feminino";
                }

                echo "

                    <h1>Informações Gerais</h1>

                    <div class=item>
                        <p><b>Nome Completo:</b> $linha[nome]</p>
                    </div>
                    
                    <p><b>Nome de Usuário:</b> $linha[nomeUsuario]</p>

                    <div class=item>
                        <p><b>E-mail:</b> $linha[email]</p>
                    </div>

                    <div class=item>
                        <p><b>Sexo:</b> $sexo</p>
                    </div>

                    <div class=item>
                        <p><b>Número:</b> $linha[numero]</p>
                    </div>



                    <p><b>Cidade:</b> $linha[cidade]</p>
					<p><b>Estado:</b> $linha[estado]</p>";

                mysqli_close ($con); 

            }
            ?>
        </div>
    </div>

    <div class="pedidos">
        <h3>Últimos pedidos</h3>
        
        <?php

            //LISTA DE PEDIDOS DE SERVIÇO FEITOS PELOS CLIENTES

            include('php/connect.php');

            $codigoo = mysqli_real_escape_string($con, addslashes($_GET['cod']));//Pega código do cliente

            $lista = mysqli_query($con, "Select tbpedidosdeservico.codigo AS codiPed, tbpedidosdeservico.tipoServico, 
            tbpedidosdeservico.descricaoPedido, tbpedidosdeservico.dataDoPedido, tbpedidosdeservico.statusPedido,
            tbclientes.codigo, tbvisupedidos.numVisu
            from `tbpedidosdeservico` 
            INNER JOIN tbclientes ON tbclientes.codigo = tbpedidosdeservico.codCliente
            INNER JOIN tbvisupedidos ON tbvisupedidos.codPedido = tbpedidosdeservico.codigo
            WHERE tbclientes.codigo = '$codigoo' ORDER BY `codiPed` DESC LIMIT 5");

            if(mysqli_num_rows($lista) < 1){
                echo "<div class=form-signin>Você não realizou nenhum pedido de serviço ainda.</div>";
            }

            while($linha = mysqli_fetch_array($lista)){

                if($linha['statusPedido'] == 0){
                    $linha['statusPedido'] = "Pendente";
                }else{
                    $linha['statusPedido'] = "Concluído";
                }
                
          
                echo "
                <div class=form-signin>
                    <div class=conteudo2>
                        <div class=box2>
                            <p><b>Serviço:</b> $linha[tipoServico]</p>
                            <div class=arrumar2> <p><b>Descrição:</b> <v>$linha[descricaoPedido]</v></p></div>
                            <div class=arrumar3><p><c> <b>Visualizações deste pedido:</b> $linha[numVisu]</c></p></div>
                            <div class=arrumar3><p><c> <b>Status do pedido:</b> $linha[statusPedido]</c></p></div>
                            <div class=arrumar3><p><b>Data deste pedido:</b>" . date_format(new DateTime($linha['dataDoPedido']), "d/m/Y") . "</p></div>
                        </div>
                    </div>
                </div>";
            }
        ?>
        
    </div>
</div>

		<div id="openModalPesquisar" class="modalDialog">
			<div>
				<a href="#close" title="Fechar" class="closeModal"></a>
				<h2>Pesquisar</h2>
				<div class="textos">
					<form  method="post">
						<label for="txt_pesquisar">Digite o nome desejado:</label>
						<input class="pesquisa" type="search" id="txt_pesquisar" onkeyup="pesquisar(this.value)" 
						placeholder="Procure por Funcionários ou Profissões."/>
						<div id="retorno">
							
						</div>
					</form>
				</div>
			</div>
		</div>

		<div id="openModalEdicao" class="modalDialog">
            <div>
                <a href="#close" title="Fechar" class="closeModal"></a>
                <h2>Edição de Perfil</h2>
                <div class="textos">
                    
                    <div class="btn-success2 " title="Alterar Foto de Capa" style="height: auto;">
                        <a href="#openModalFotoCapa">Alterar Foto de Capa</a><br/>
                    </div>

                    <div class="btn-success2 " title="Alterar Foto">
                        <a href="#openModalFoto">Alterar Foto</a><br/>
                    </div>

                    <div class="btn-success2 " title="Alterar Nome">
                        <a href="#openModalNome">Alterar Nome</a><br/>
                    </div>

                    <div class="btn-success2 " title="Alterar E-mail">
                        <a href="#openModalEmail">Alterar E-mail</a><br/>
                    </div>

                    <div class="btn-success2 " title="Alterar Data">
                        <a href="#openModalData">Alterar Data</a><br/>
                    </div>

                    <div class="btn-success2 " title="Alterar Sexo">
                        <a href="#openModalSexo">Alterar Sexo</a><br/>
                    </div>

                    <div class="btn-success2 " title="Alterar Telefone">
                        <a href="#openModalNum">Alterar Telefone</a><br/>
                    </div>

                    <div class="btn-success2 " title="Alterar Endereço">
                        <a href="#openModalCEP">Alterar Endereço</a><br/>
                    </div>

                    <div class="btn-success2 " title="Alterar Senha">
                        <a href="#openModalSenha">Alterar Senha</a>
                    </div>
                    
                </div>
            </div>
        </div>

         <div id="openModalFotoCapa" class="modalDialog">
            <div>
                <a href="#close" title="Fechar" class="closeModal"></a>
                <h2>Alterar Foto de Capa</h2>
                    <div class="textos">
                        <form name="formFotoCapa" method="post" enctype="multipart/form-data" 
                        action="php/alterarFotoCapaCliente.act.php" onsubmit="return validar_formFotoCapa(this)">

                        <label for="campo_fotoCapa">Selecione uma Foto:</label>
                        <input type="file" name="input_fotoCapa" id="campo_fotoCapa" /><br />

                        <div id="alertFotoVazio1">
                            <footer class="alert">
                                <span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
                                Selecione algum arquivo.
                            </footer>
                        </div>
                        <br /><input type="submit" name="btenviar" value="Enviar" title="Enviar"> 
                    </form>
                </div>
            </div>
        </div>

        <div id="openModalFoto" class="modalDialog">
        	<div>
        		<a href="#close" title="Fechar" class="closeModal"></a>
        		<h2>Alterar Foto</h2>
        			<div class="textos">
        				<form name="formFoto" method="post" enctype="multipart/form-data" 
        				action="php/alterarFotoCliente.act.php" onsubmit="return validar_formFoto(this)">

        				<label for="campo_foto">Foto:</label>
        				<input type="file" name="input_foto" id="campo_foto" /><br />

        	            <div id="alertFotoVazio">
        	                <footer class="alert">
        	                    <span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
        	                    Selecione algum arquivo.
        	                </footer>
        	            </div>
                        <br /><input type="submit" name="btenviar" value="Enviar" title="Enviar"> 
        	        </form>
        	    </div>
        	</div>
        </div>


        <div id="openModalNome" class="modalDialog">
        	<div>
        		<a href="#close" title="Fechar" class="closeModal"></a>
        		<h2>Alterar Nome</h2>
        			<div class="textos">
        				<form name="formNome" method="post" enctype="multipart/form-data" 
        				action="php/alterarNomeCliente.act.php" onsubmit="return validar_formNome(this)">

        	            <label for="servico">Digite seu nome completo:</label>
        	            <input type="text" name="nome" title="Digite seu nome completo" placeholder="Nome Completo"/><br />

        	            <div id="alertNomeVazio">
        	                <footer class="alert">
        	                    <span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
        	                    O campo está vazio.
        	                </footer>
        	            </div>

        	            <div id="alertNomeCompleto">
        	                <footer class="alert" autofocus>
        	                    <span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
        	                    Digite seu nome completo.
        	                </footer>
                    	</div>

                    	<div id="alertNome50">
        	                <footer class="alert" autofocus>
        	                    <span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
        	                    O nome só pode ter no máximo 50 caracteres.
        	                </footer>
                    	</div>
                        <br /><input type="submit" name="btenviar" value="Enviar" title="Enviar"> 
        	        </form>
        	    </div>
        	</div>
        </div>

        <div id="openModalEmail" class="modalDialog">
        	<div>
        		<a href="#close" title="Fechar" class="closeModal"></a>
        		<h2>Alterar E-mail</h2>
        			<div class="textos">
        				<form name="formEmail" method="post" enctype="multipart/form-data" 
        				action="php/alterarEmailCliente.act.php" onsubmit="return validar_formEmail(this)">

        	            <label for="email">Digite o E-mail:</label>
                    	<input type="email" name="email" title="Digite seu e-mail" placeholder="E-mail"/><br />

        	           

        	            <div id="alertEmailVazio">
        	                <footer class="alert" autofocus>
        	                    <span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
        	                    Preencha o campo de e-mail.
        	                </footer>
        	            </div>

        	            <div id="alertEmail50">
        	                <footer class="alert" autofocus>
        	                    <span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
        	                    O e-mail só pode ter no máximo 50 caracteres.
        	                </footer>
        	            </div>
                        <br /><input type="submit" name="btenviar" value="Enviar" title="Enviar">    
        	        </form>
        	    </div>
        	</div>
        </div>

        <div id="openModalData" class="modalDialog">
        	<div>
        		<a href="#close" title="Fechar" class="closeModal"></a>
        		<h2>Alterar Data de nascimento</h2>
        			<div class="textos">
        				<form name="formData" method="post" enctype="multipart/form-data" 
        				action="php/alterarDataCliente.act.php" onsubmit="return validar_formData(this)">

        	            <label for="dataNascimento">Selecione sua data de nascimento:</label>
                    	<input type="date" name="dataNascimento" title="Selecione sua data de nascimento"/><br />

        	           <div id="alertDataVazio">
        	                <footer class="alert" autofocus>
        	                    <span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
        	                    Selecione sua data de nascimento.
        	                </footer>
                    	</div>

        	            <div id="alertMaiorIdade">
        	                <footer class="alert" autofocus>
        	                    <span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
        	                    Não é permitido o cadastro de menores de idade.
        	                </footer>
                    	</div>
                        <br/><input type="submit" name="btenviar" value="Enviar" title="Enviar">
        	        </form>
        	    </div>
        	</div>
        </div>

        <div id="openModalSexo" class="modalDialog">
        	<div>
        		<a href="#close" title="Fechar" class="closeModal"></a>
        		<h2>Alterar Sexo</h2>
        			<div class="textos">
        				<form name="formSexo" method="post" enctype="multipart/form-data" 
        				action="php/alterarSexoCliente.act.php" onsubmit="return validar_formSexo(this)">

                        <label for="sexo">Selecione seu sexo:</label><br /><br />
                        

                        <div class="radio">
                            <input type="radio" name="sexo" id= "mas" value="m" title="Masculino"/>
                            <label for="mas" class="radio-label">Masculino</label>
                        </div>

        	            <div class="radio4">       
                            <input type="radio" name="sexo" id="fem" value="f" title="Feminino"/>
                            <label for="fem" class="radio-label4">Feminino</label>
                        </div>


        	            <div id="alertSexo">
        	                <footer class="alert" autofocus>
        	                    <span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
        	                    Selecione seu sexo.
        	                </footer>
        	            </div>

                        <br/><input type="submit" name="btenviar" value="Enviar" title="Enviar">
        	        </form>
        	    </div>
        	</div>
        </div>

        <div id="openModalNum" class="modalDialog">
        	<div>
        		<a href="#close" title="Fechar" class="closeModal"></a>
        		<h2>Alterar Número</h2>
        			<div class="textos">
        				<form name="formNum" method="post" enctype="multipart/form-data" 
        				action="php/alterarTelefoneCliente.act.php" onsubmit="return validar_formNum(this)">

        	            <label for="telefone">Digite seu número:</label>
        	            <input type="tel" name="telefone" onkeypress="mascara(this, '## # ####-####')"
        	            maxlength="14" onpaste="return false;" title="Digite seu número" placeholder="Nº Celular"/><br />


        	            <div id="alertTelefone">
        	                <footer class="alert" autofocus>
        	                    <span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
        	                    Preencha o campo de telefone.
        	                </footer>
        	            </div>

                        <br/><input type="submit" name="btenviar" value="Enviar" title="Enviar">

        	        </form>
        	    </div>
        	</div>
        </div>

        <div id="openModalCEP" class="modalDialog">
        	<div>
        		<a href="#close" title="Fechar" class="closeModal"></a>
        		<h2>Alterar Endereço</h2>
        			<div class="textos">
        				<form name="formCEP" method="post" enctype="multipart/form-data" 
        				action="php/alterarEnderecoCliente.act.php" onsubmit="return validar_formCEP(this)">

        		            
        	            <label for="cep">Digite seu CEP:</label>
        	            <input type="text" name="cep" id="cep" onkeypress="mascara(this, '#####-###')" 
        	            onblur="pesquisacepCliente(this.value);" size="10" maxlength="9" 
        	            onpaste="return false;" title="CEP" placeholder="CEP"/><br />

        	            <label for="rua">Rua:</label>
        	            <input name="rua" type="text" name = "rua" id="rua" size="40" title="Rua" placeholder="Rua"/><br />

                        <label for="numero">Número:</label>
                        <input name="numero" type="text" id="numero" size="10" title="Número" placeholder="Nº Casa"/><br />

        	            <label for="bairro">Bairro:</label>
        	            <input type="text" id="bairro" name = "bairro"  size="40" title="Bairro" placeholder="Bairro"/><br />

        	            <label for="cidade">Cidade:</label>
        	            <input name="cidade" type="text" id="cidade" name = "cidade" size="40" title="Cidade" placeholder="Cidade"/></label><br />

        	            <label for ="estado">Estado:</label>
        	            <input name="uf" type="text" id="uf" name = "uf" size="2" title="Estado" placeholder="UF"/></label><br />

        	            <div id="alertCEPVazio">
        	                <footer class="alert" autofocus>
        	                    <span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
        	                    Preencha o campo de CEP.
        	                </footer>
        	            </div>

        	            <div id="alertCEPNaoEncontrado">
        	                <footer class="alert" autofocus>
        	                    <span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
        	                    CEP não encontrado.
        	                </footer>
        	            </div>

        	            <div id="alertCEPFormato">
        	                <footer class="alert" autofocus>
        	                    <span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
        	                    Formato de CEP inválido.
        	                </footer>
        	            </div>

        	            <div id="alertRuaVazio">
        	                <footer class="alert" autofocus>
        	                    <span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
        	                    Preencha o campo de rua.
        	                </footer>
        	            </div>

        	            <div id="alertBairroVazio">
        	                <footer class="alert" autofocus>
        	                    <span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
        	                    Preencha o campo de bairro.
        	                </footer>
        	            </div>

        	            <div id="alertCidadeVazio">
        	                <footer class="alert" autofocus>
        	                    <span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
        	                    Preencha o campo de cidade.
        	                </footer>
        	            </div>

        	            <div id="alertUFVazio">
        	                <footer class="alert" autofocus>
        	                    <span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
        	                    Preencha o campo de Estado.
        	                </footer>
        	            </div>

                        <br/><input type="submit" name="btenviar" value="Enviar" title="Enviar">

        	        </form>
        	    </div>
        	</div>
        </div>

        <div id="openModalSenha" class="modalDialog">
        	<div>
        		<a href="#close" title="Fechar" class="closeModal"></a>
        		<h2>Alterar Senha</h2>
        			<div class="textos">
        				<form name="formSenha" method="post" enctype="multipart/form-data" 
        				action="php/alterarSenhaCliente.act.php" onsubmit="return validar_formSenha(this)">

        				<label for="senhaAntiga">Senha atual:</label>
        	            <input type="password" name="senhaAntiga" title="Digite sua senha atual" placeholder="Senha Atual"/><br />

        	            <label for="senha">Nova senha:</label>
        	            <input type="password" name="senha" title="Digite sua nova senha" placeholder="Nova Senha"/><br />

        	            <label for="confirmSenha">Confirme sua senha:</label>
        	            <input type="password" name="confirmSenha" title="Confirme sua senha" placeholder="Confirmar Senha"/><br />

        	            <div id="alertSenhaAntigaVazio">
        	                <footer class="alert" autofocus>
        	                    <span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
        	                    Preencha sua senha atual.
        	                </footer>
        	            </div>

        	            <div id="alertTamanhoSenha">
        	                <footer class="alert" autofocus>
        	                    <span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
        	                    A senha deve ter no mínimo 8 digitos.
        	                </footer>
        	            </div>

        	            <div id="alertConfirmSenha">
        	                <footer class="alert" autofocus>
        	                    <span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
        	                    A senha é diferente de sua confirmação.
        	                </footer>
        	            </div>

                        <br /><input type="submit" name="btenviar" value="Enviar" title="Enviar">

        	        </form>
        	    </div>
        	</div>
        </div>
    </div>
</div>


<aside id="chats">
            
</aside>
<script type="text/javascript" src="js/chatCliente.js"></script>

</body>
</div>
</html>