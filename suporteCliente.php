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

	<title>Suporte</title>

    <link rel="shortcut icon" href="Imagens/favicon.ico" type="image/x-icon"/>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/estiloSuporteCliente.css" rel="stylesheet">
    <script src="jquery/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</head>


<script src="js/carregando.js"></script>
<div class="carregando" id="carregando"></div>
<div class="corpoCarregado" id="corpoCarregado"> 
<body>

<script src="js/pesquisaCliente.js"></script>
<script src="js/functionsSuporte.js"></script>

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


<div class="container">
     
    <div class="form-signin">
        <h1>Suporte</h1>

        <?php
            $codigoo = mysqli_real_escape_string($con, addslashes($_GET['cod']));//Pega código do cliente
            echo'
                <form method=post name=formCliente onsubmit="return validar_formCliente(this)" enctype=multipart/form-data action=php/incluirSuporteCliente.php?cod='. $codigoo .'>
            ';
        ?>
            <div class="textos">
                <label for="nome">Digite seu nome:</label>
                <input type="text" name="nome" class="form-control1" value="<?php echo $_SESSION['nomeCompletoCliente']; ?>" title="Digite seu nome" placeholder="Escreva seu nome."/>
            </div> 

            <div class="textos">        
                <label for="email">Digite seu e-mail:</label>
                <input type="email" name="email" class="form-control1" value="<?php echo $_SESSION['usuarioCliente']; ?>" title="Digite seu e-mail" placeholder="Escreva seu e-mail."/>
            </div>
                    
            <div class="opcoes">
                <label>Selecione um assunto:</label>
            </div>  

            <div class="opcoes">
                <label for="problema">Problemas com serviços:</label>
                <input type="radio" id="problema" name="opcao" value="se" checked/>
            </div>

            <div class="opcoes">
                <label for="problemaPag">Problemas com pagamentos:</label>
                <input type="radio" id="problemaPag" name="opcao" value="pa" />
            </div>

            <div class="opcoes">
                <label for="sugestoes">Sugestões:</label>
                <input type="radio" id="sugestoes" name="opcao" value="su"  />
            </div>

            <div class="opcoes">
                <label for="outro">Outros:</label>
                <input type="radio" id="outro" name="opcao" value="ou"  />
            </div>
                    
            <div class="textos">
                </br><label for="textos">Mensagem:</label></br>
                <textarea name="mensagem" id="textos" value="" placeholder="Escreva uma mensagem." title="Digite uma mensagem"></textarea>
            </div>

            <button type="submit" name="bt-enviar"  class="btn btn-success" value="Enviar" title="Enviar">Enviar</button>
        
        <div id="alertNomeVazio">
            <footer class="alert">
                <span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
                Preencha seu nome.
            </footer>
        </div>

        <div id="alertEmailVazio">
            <footer class="alert">
                <span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
                Preencha seu e-mail.
            </footer>
        </div>

        <div id="alertAssuntoVazio">
            <footer class="alert">
                <span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
                Selecione algum assunto.
            </footer>
        </div>

        <div id="alertMensagemVazio">
            <footer class="alert">
                <span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
                Digite alguma mensagem.
            </footer>
        </div>
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


<aside id="chats">

</aside>
<script type="text/javascript" src="js/chatCliente.js"></script>

</body>
</div>
</html>