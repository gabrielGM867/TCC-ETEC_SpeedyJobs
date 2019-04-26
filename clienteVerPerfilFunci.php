<?php require('php/segCliente.php'); require('php/connect.php'); ?>
<?php
    if(isset($_GET)){
        if(isset($_SESSION)){
            if(isset($_GET['cod'])){
            }else{header("location:paginaInicialCliente.php");}
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
    <link rel="stylesheet" href="css/lightbox.min.css">
	<link href="css/estiloClienteVerPerfilFunci.css" rel="stylesheet">
	<script src="jquery/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</head>

<script src="js/pesquisaCliente.js"></script>

<script src="js/carregando.js"></script>
<div class="carregando" id="carregando"></div>
<div class="corpoCarregado" id="corpoCarregado">
<body>

<nav class="navbar navbar-expand-lg navbar-light ">
    <div class="container">
       <a href=paginaInicialCliente.php title="Início"> <img class="picareta" src=Imagens/picareta.png /></a>

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

        $codigoo = mysqli_real_escape_string($con, addslashes($_GET['cod']));//Pega código do funci

        $lista = mysqli_query($con, "Select tbfuncionarios.fotoCapa from `tbfuncionarios` 
        WHERE tbfuncionarios.codigo = $codigoo");

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

        $lista = mysqli_query($con, "Select tbfuncionarios.codigo, tbfuncionarios.foto, tbfuncionarios.nomeUsuario, tbfuncionarios.classificacao, 
        tbfuncionarios.quantClass from `tbfuncionarios` 
        WHERE tbfuncionarios.codigo = $codigoo");



        while($linha = mysqli_fetch_array($lista)){

            if($linha["classificacao"] == 0){
                $calculo = 0;
            }else{
                $calculo = round(($linha["classificacao"]/$linha["quantClass"]), 1);
            }

            echo "

                <div class=centro>
                    <p><img src=$linha[foto] class=rounded-circle></p>
                </div> 

                <div class=centro>
                    <h1>$linha[nomeUsuario]</h1> 
                    <span class='ratingAverage' data-average='$calculo'></span>
                    <span class='article' data-id=$linha[codigo]></span>

                   <div class='barra3'>
                        <span class='bg3'></span>
                        <span class='stars3'> ";
                         for($i=1; $i<=5; $i++){

                            echo "<span class='star3' data-vote='<?php echo $i?>'>
                                <span class='starAbsolute3'></span>
                            </span>";
                          }
                          echo"
                        </span>
                    </div>
                </div>";
                  
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

    		$codigoo = mysqli_real_escape_string($con, addslashes($_GET['cod']));//Pega código do funcionario

    		$lista = mysqli_query($con, "Select tbfuncionarios.foto, tbfuncionarios.nome, tbfuncionarios.profissao, tbfuncionarios.nomeUsuario, tbfuncionarios.email, tbfuncionarios.dataNascimento, tbfuncionarios.sexo, tbfuncionarios.classificacao, tbenderecofuncionario.cep, tbenderecofuncionario.rua, tbenderecofuncionario.bairro, tbenderecofuncionario.cidade, tbenderecofuncionario.estado, tbtelefonesfuncionario.numero, tbusuarioschat.codigo AS 'codiFunciChat', tbusuarioschat.grupo
                from `tbfuncionarios` 
                INNER JOIN tbusuarioschat ON tbfuncionarios.codigo = tbusuarioschat.codUsuario 
                INNER JOIN tbenderecofuncionario ON tbenderecofuncionario.codFunci = tbfuncionarios.codigo 
                INNER JOIN tbtelefonesfuncionario ON tbtelefonesfuncionario.codFunci = tbfuncionarios.codigo
                WHERE tbfuncionarios.codigo = '$codigoo' AND grupo = 'f'");


    		while($linha = mysqli_fetch_array($lista)){

				if($linha["sexo"] == "m"){

					$sexo = "Masculino";
				}

				if($linha["sexo"] == "f"){

					$sexo = "Feminino";
				}

				echo "
					<h1>Perfil do Funcionário</h1>

                    <div class=item>
					   <p><b>Nome Completo:</b> $linha[nome]</p>
                    </div>


                    <div class=item>
					   <p><b>Nome de usuário:</b> $linha[nomeUsuario]</p>
                    </div>

                    <div class=item>
					   <p><b>Profissão:</b> $linha[profissao]</p>
                    </div>

                    <div class=item>
					   <p><b>E-mail: </b> $linha[email]</p>
                    </div>

                    <div class=item>
					   <p><b>Data de nascimento:</b> " . date_format(new DateTime($linha['dataNascimento']), "d/m/Y") . "</p>
                    </div>

                    <div class=item>
					   <p><b>Sexo:</b> $sexo</p>
                    </div>


					<p><b>Cidade:</b> $linha[cidade]</p>
                    <p><b>Estado:</b> $linha[estado]</p>

                    ";

                    $lista2 = mysqli_query($con, "Select tbfuncionarios.codigo,
                    tbformfunci.negocioFechado, tbformfunci.codFunci, tbformfunci.codCliente 
                    from `tbfuncionarios` 
                    INNER JOIN tbformfunci ON tbformfunci.codFunci = tbfuncionarios.codigo 
                    WHERE tbfuncionarios.codigo = '$codigoo' AND tbformfunci.codFunci = '$codigoo' 
                    AND tbformfunci.codCliente = '$_SESSION[codiCliente]'");

                    while ($linha2 = mysqli_fetch_array($lista2)) {

                        if($linha2['negocioFechado'] == '1'){
                            echo "<p><a href=#openModalAvaliacao class=avaliar>Avaliar Funcionário</a></p>";
                        }
                    }


					echo "
					<span class=user_online id=$_SESSION[codiClienteChat]>
						<aside id=users_online>
							<div class=botao2><a href=# id=$_SESSION[codiClienteChat]:$linha[codiFunciChat] title=" . $linha["nomeUsuario"] . " >Entre em contato</a></div>
						</aside>
					</span>
					";

				mysqli_close ($con);
    		}
    		?>
    	</div>
    </div>


    <div class="fotos">
        <h3>Fotos de Serviço</h3>
        <div class="form-signin">
        <?php

            //LISTA DE FOTOS POSTADAS PELO FUNCIONÁRIO

            include('php/connect.php');

            $codigoo = mysqli_real_escape_string($con, addslashes($_GET['cod']));//Pega código do funcionario

            $lista = mysqli_query($con, "Select tbpostagemfotos.codigo AS codiFoto, tbpostagemfotos.foto, 
            tbfuncionarios.codigo
            from `tbpostagemfotos` 
            INNER JOIN tbfuncionarios ON tbfuncionarios.codigo = tbpostagemfotos.codUsuario
            WHERE tbfuncionarios.codigo = '$codigoo' ORDER BY `codiFoto` DESC");

            if(mysqli_num_rows($lista) < 1){
                echo "Este funcionário não postou nenhuma foto de serviço ainda.";
            }


            while($linha = mysqli_fetch_array($lista)){
                
          
                echo "

                        <a class=example-image-link href=$linha[foto] data-lightbox=example-1>
                            <img class=example-image src=$linha[foto] alt=image-1 />
                        </a>
                    ";
            }
        ?> 
        </div>
    </div> 
</div>

<div id="openModalAvaliacao" class="modalDialog">
    <div>
        <a href="#close" title="Fechar" class="closeModal"></a>
        <h2>Avaliar Funcionário</h2>
        <div class="textos">
            <form  method="post" action="php/avaliarFunci.php?cod=<?php echo $codigoo?>" enctype="multipart/form-data">
                    <p>Escolha o número de estrelas para sua avaliação:</p><br />
                    <div class="barra2">

                        <span class="bg"></span>
                        <span class="stars">
                            <?php for($i=1; $i<=5; $i++):?>

                            <span class="star" data-vote="<?php echo $i?>">
                                <span class="starAbsolute"></span>
                            </span>
                            <?php 
                                endfor;
                            ?>
                        </span>
                    </div>                    
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="js/avaliar.js"></script>

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


<aside id="chats">
			
</aside>
<script src="js/lightbox-plus-jquery.min.js"></script>
<script type="text/javascript" src="js/chatCliente.js"></script>

</body>
</div>
</html>