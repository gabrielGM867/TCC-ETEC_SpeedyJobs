<?php require('php/segFunci.php'); require('php/connect.php'); ?>
<?php
    if(isset($_GET)){
        if(isset($_SESSION)){
            if(isset($_GET['cod'])){
            }else{header("location:paginaInicialFunci.php");}
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>

	<title>Perfil</title>

   <link rel="shortcut icon" href="Imagens/favicon.ico" type="image/x-icon"/>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/estiloFunciVerPerfilCliente.css" rel="stylesheet">
    <script src="jquery/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

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

        $codigoo = mysqli_real_escape_string($con, addslashes($_GET['cod']));//Pega código do funcionario

        $lista = mysqli_query($con, "Select tbclientes.foto, tbclientes.nomeUsuario
        from `tbclientes` 
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
</div>

<div class="container-fluid">
    
    <div class="info"> 
        <div class="form-signin">
            <?php

            include('php/connect.php');

            $codigoo = mysqli_real_escape_string($con, addslashes($_GET['cod']));//Pega código do cliente


            $lista = mysqli_query($con, "Select 
            tbclientes.foto, tbclientes.nome, tbclientes.nomeUsuario, tbclientes.email, tbclientes.dataNascimento,
            tbclientes.sexo,
            tbenderecocliente.cep, tbenderecocliente.rua, tbenderecocliente.bairro, 
            tbenderecocliente.cidade, tbenderecocliente.estado,
            tbtelefonescliente.numero, tbusuarioschat.codigo AS 'codiClienteChat', tbusuarioschat.grupo 
            from `tbclientes`
            INNER JOIN tbusuarioschat ON tbusuarioschat.codUsuario = tbclientes.codigo 
            INNER JOIN tbenderecocliente ON tbenderecocliente.codCliente = tbclientes.codigo
            INNER JOIN tbtelefonescliente ON tbtelefonescliente.codCliente = tbclientes.codigo 
            WHERE tbclientes.codigo = $codigoo AND grupo = 'c'");


            while($linha = mysqli_fetch_array($lista)){


            	if($linha["sexo"] == "m"){

            		$sexo = "Masculino";
            	}

            	if($linha["sexo"] == "f"){

            		$sexo = "Feminino";
            	}

            	echo "
            		<h1>Perfil do Cliente</h1>

                    <div class=item>
                       <p><b>Nome Completo:</b> $linha[nome]</p>
                    </div>


                    <div class=item>
                       <p><b>Nome de usuário:</b> $linha[nomeUsuario]</p>
                    </div>

                    <div class=item>
                       <p> <b>E-mail:</b> $linha[email]</p>
                    </div>

                    <div class=item>
                       <p><b>Data de nascimento:</b> " . date_format(new DateTime($linha['dataNascimento']), "d/m/Y") . "</p>
                    </div>

                    <div class=item>
                       <p><b>Sexo:</b> $sexo</p>
                    </div>


                    <p><b>Cidade:</b> $linha[cidade]</p>
                    <p><b>Estado:</b> $linha[estado]</p>
           
            		<span class=user_online id=$_SESSION[codiFunciChat]>
            				<aside id=users_online>
            					<div class=botao2><a href=# id=$_SESSION[codiFunciChat]:$linha[codiClienteChat] title=" . $linha["nomeUsuario"] . " > Entre em contato</a></div>
            				</aside>
            			</span>
            

            		";

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
                echo "<div class=form-signin>Este cliente não realizou nenhum pedido ainda.</div>";
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
                placeholder="Procure por Clientes."/>
                <div id="retorno">
                    
                </div>
            </form>
        </div>
    </div>
</div>

<aside id="chats">
			
</aside>
<script type="text/javascript" src="js/chatFunci.js"></script>

</body>
</div>
</html>