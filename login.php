<?php require('php/segLogin.php'); ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>

	<title>Login</title>

    <link rel="shortcut icon" href="Imagens/favicon.ico" type="image/x-icon"/>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/estiloLogin.css" rel="stylesheet">

</head>

<script src="jquery/jquery-3.3.1.min.js"></script>
<script src="js/carregando.js"></script>
<div class="carregando" id="carregando"></div>
<div class="corpoCarregado" id="corpoCarregado">
<body>

<div class="container">
    <div class="form-signin">
        <script src='https://www.google.com/recaptcha/api.js'></script>
        

        <script type="text/javascript" src="js/functionsLogin.js"></script>

        <div>
            <a href="index.php" style="text-decoration: none;" title="Início"><h1>SpeedyJobS</h1></a>
        </div>

        <div class="loginBox">
        	<img src="Imagens/user.png" class="user">
        	<h2>Entre aqui</h2>
        	<form name="formLogar" method="POST" action="php/logar.act.php" onsubmit= "return validar_form(this)">
               
                <p>Selecione o tipo de entrada:</p>
                 <div class="caja">
                <select name="entrada" title="Selecione seu tipo de conta">
                    <option selected="selected" value="Cliente">Cliente</option>
                    <option value="Funcionário">Funcionário</option>
                </select>
            </div>
        		<p>E-mail:</p>
        		<input type="text" name="email" placeholder="Digite o e-mail" class="form-control" title="Digite seu e-mail">
        		<p>Senha:</p>
        		<input type="password" name="password" placeholder="••••••••" class="form-control" title="Digite sua senha">
                <div class="g-recaptcha" data-sitekey="6LdLFm4UAAAAACYwZhawO0OTzsCiztL3iEvKER6c" ></div>
                <p>Esqueceu sua senha?<a href="#openModalSenha" style="color:rgb(15, 119, 192);" title="Esqueceu sua senha?"> Clique aqui</a></p>

                <input type="submit" name="Logar" value="Entrar" class="btn btn-success" title="Entrar">

                <div id="alertEmailVazio">
                    <footer class="alert">
                        <span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
                        Preencha o campo de e-mail.
                    </footer>
                </div>

                <div id="alertSenhaVazio">
                    <footer class="alert">
                        <span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
                        Preencha o campo de senha.
                    </footer>
                </div>

                <div id="alertREVazio">
                    <footer class="alert">
                        <span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
                        Clique no ReCaptcha.
                    </footer>
                </div>
        	</form>
        </div>
    </div>
</div>


<div id="openModalSenha" class="modalDialog">
    <div>
        <a href="#close" title="Fechar" class="closeModal"></a>
         <div class="textos"> 
            <h2>Recuperar Senha</h2>
            <form name="formRecuperar" method="POST" action="php/recuperarSenha.act.php" onsubmit= "return validar_formSenha(this)">
                <p>Selecione seu tipo de conta:</p>
                <div class="caja">
                    <select name="entrada" title="Selecione seu tipo de conta">
                            <option selected="selected" value="Cliente">Cliente</option>
                            <option value="Funcionário">Funcionário</option>
                    </select>
                </div>
                <p>Digite o e-mail utilizado no seu cadastro:</p>
                <input type="text" id="email" name="email" placeholder="E-mail" title="Digite o seu e-mail de cadastro">

                 <div id="alertEmailVazio1">
                    <footer class="alert">
                        <span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
                        Preencha o campo de e-mail.
                    </footer>
                </div>
                <br /><input type="submit" name="enviar" value="Enviar" title="Enviar">
            </form>
        </div> 
    </div>
</div>


</body>
</div>
</html>