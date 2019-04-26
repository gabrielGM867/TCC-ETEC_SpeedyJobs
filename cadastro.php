<!DOCTYPE html>
<html lang="pt-BR">
<head>

	<title>Cadastro</title>

    <link rel="shortcut icon" href="Imagens/favicon.ico" type="image/x-icon"/>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/estiloCadastro.css" rel="stylesheet">

</head>

<script src="jquery/jquery-3.3.1.min.js"></script>
<script src="js/carregando.js"></script>
<div class="carregando" id="carregando"></div>
<div class="corpoCarregado" id="corpoCarregado">    
<body>
<div class="container">
	<div class="form-signin">
		<script src="js/functionsCadastro.js"></script>
		
		<div>
		  <a href="index.php" style="text-decoration: none;" title="Início"><h1 >SpeedyJobS</h1></a>
		</div>

		<div class="borda">

		<div class="op">
			<label for="opcao" class="janela1">Selecione uma opção</label><br />
			
			<div class="radio2">
			
				<input type="radio" id="cliente" name="opcao" title="Cliente" checked/>
				<label class="radio-label2" for="cliente">Cliente</label>
				
			</div>

			<div class="radio">
			
				<input type="radio" id="funcionario" name="opcao" title="Funcionário" />
				<label class="radio-label" for="funcionario">Funcionário</label>
				
			</div>

		</div>

		<div id="janela">
			<form name="formCliente" method="post" enctype="multipart/form-data" action="php/incluirCliente.act.php" 
			onsubmit="return validar_formCliente(this)">
			
				<h3>Cliente</h3>

				<label for="nome">Digite seu nome:</label>
				<input type="text" name="nome" class="form-control" title="Digite seu nome completo" placeholder="Nome Completo"/><br />

				<label for="nomeUsuario">Digite um nome de usuário:</label>
				<input type="text" name="nomeUsuario" class="form-control" title="Digite seu nome de usuário" placeholder="Nome Usuário"/><br />

				<label for="email">Digite seu E-mail:</label>
				<input type="email" name="email" class="form-control" title="Digite seu e-mail" placeholder="E-mail"/><br />

				<label for="cpf">Digite seu CPF:</label>
				<input type="text" name="cpf" id="cpf"  onkeypress="mascara(this, '###.###.###-##')"
				size="14" maxlength="14" onpaste="return false;" class="form-control" title="Digite seu CPF" placeholder="CPF"/><br />

				<label for="cep">Digite seu CEP:</label>
				<input type="text" name="cep" id="cep" onkeypress="mascara(this, '#####-###')" 
				onblur="pesquisacepCliente(this.value);" size="10" maxlength="9" 
				onpaste="return false;" class="form-control" title="CEP" placeholder="CEP"/><br />

				<label for="rua">Rua:</label>
				<input name="rua" type="text" name = "rua" id="rua" size="60" class="form-control" title="Rua" placeholder="Rua"/><br />

				<label for="numero">Número:</label>
				<input name="numero" type="text" id="numero" size="10" class="form-control" title="Número" placeholder="Nº Casa"/><br />

				<label for="bairro">Bairro:</label>
				<input type="text" id="bairro" name = "bairro"  size="40" class="form-control" title="Bairro" placeholder="Bairro"/><br />

				<label for="cidade">Cidade:</label>
				<input name="cidade" type="text" id="cidade" name = "cidade" size="40" class="form-control" title="Cidade" placeholder="Cidade"/></label><br />

				<label for ="estado">Estado:</label>
				<input name="uf" type="text" id="uf" name = "uf" size="2" class="form-control" title="Estado" placeholder="Estado"/></label><br />

				<label for="dataNascimento">Selecione sua data de nascimento:</label>
				<input type="date" name="dataNascimento" class="form-control" title="Selecione sua data de nascimento"/><br />

				<label for="telefone">Digite seu celular:</label>
				<input type="tel" name="telefone" onkeypress="mascara(this, '## # ####-####')"
				maxlength="14" onpaste="return false;" class="form-control" title="Digite seu número" placeholder="Nº Celular"/><br />

				<label for="sexo">Selecione seu sexo:</label><br /><br />

				<div class="radio">
					
					<input type="radio" name="sexo" id= "mas" value="m" title="Masculino"/>
					<label for="mas" class="radio-label">Masculino</label>
				</div>

				<div class="radio4">
							   
					<input type="radio" name="sexo" id="fem" value="f" title="Feminino"/>
					<label for="fem" class="radio-label4">Feminino</label>	
				</div>

				<br /><label for="senha">Digite uma senha:</label>
				<input type="password" name="senha" class="form-control" title="Digite uma senha" placeholder="Senha"/><br />

				<label for="confirmSenha">Confirme sua senha:</label>
				<input type="password" name="confirmSenha" class="form-control" title="Confirme a senha" placeholder="Confirmar Senha"/><br />

				<input type="submit" name="btenviar" value="Cadastrar"  class="btn btn-success" title="Cadastrar" />

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
					
				<div id="alertSexo">
					<footer class="alert" autofocus>
						<span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
						Selecione seu sexo.
					</footer>
				</div>

				<div id="alertNomeCompleto">
					<footer class="alert" autofocus>
						<span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
						Digite seu nome completo.
					</footer>
				</div>

				<div id="alertNomeVazio">
					<footer class="alert" autofocus>
						<span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
						Preencha o campo de nome.
					</footer>
				</div>

				<div id="alertNomeUsuarioVazio">
					<footer class="alert" autofocus>
						<span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
						Preencha o campo de nome de usuário.
					</footer>
				</div>

				<div id="alertEmailVazio">
					<footer class="alert" autofocus>
						<span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
						Preencha o campo de e-mail.
					</footer>
				</div>

				<div id="alertCPFVazio">
					<footer class="alert" autofocus>
						<span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
						Preencha o campo de CPF.
					</footer>
				</div>

				<div id="alertCEPVazio">
					<footer class="alert" autofocus>
						<span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
						Preencha o campo de CEP.
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

				<div id="alertDataVazio">
					<footer class="alert" autofocus>
						<span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
						Selecione sua data de nascimento.
					</footer>
				</div>

				<div id="alertTelefone">
					<footer class="alert" autofocus>
						<span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
						Preencha o campo de telefone.
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

				<div id="alertCPFinvalido">
					<footer class="alert" autofocus>
						<span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
						CPF Inválido.
					</footer>
				</div>

				<div id="alertMaiorIdade">
					<footer class="alert" autofocus>
						<span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
						Não é permitido o cadastro de menores de idade.
					</footer>
				</div>

				<div id="alertNome50">
					<footer class="alert" autofocus>
						<span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
						O nome só pode ter no máximo 50 caracteres.
					</footer>
				</div>

				<div id="alertNomeU50">
					<footer class="alert" autofocus>
						<span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
						O nome de usuário só pode ter no máximo 50 caracteres.
					</footer>
				</div>

				<div id="alertEmail50">
					<footer class="alert" autofocus>
						<span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
						O e-mail só pode ter no máximo 50 caracteres.
					</footer>
				</div>    
			</form>
		</div>

		<div id="janela2">
			<form name="formFuncionario" method="post" enctype="multipart/form-data" action="php/incluirFuncionario.act.php"
			onsubmit="return validar_formFunci(this)">

				<h3>Funcionário</h3>

				<label for="nome2">Digite seu nome:</label>
				<input type="text" name="nome2" class="form-control" title="Digite seu nome completo" placeholder="Nome Completo"/><br />

				<label for="nomeUsuario2">Digite um nome de usuário:</label>
				<input type="text" name="nomeUsuario2" class="form-control" title="Digite seu nome de usuário" placeholder="Nome Usuário"/><br />

				<label for="email2">Digite seu E-mail:</label>
				<input type="email" name="email2" class="form-control" title="Digite seu e-mail" placeholder="E-mail"/><br />

				<label for="profissao">Digite sua profissão:</label>
				<input type="text" name="profissao" class="form-control" title="Digite sua profissão" placeholder="Profissão"/><br />

				<label for="cpf2">Digite seu CPF:</label>
				<input type="text" name="cpf2" size="14" onkeypress="mascara(this, '###.###.###-##')"
				size="14" maxlength="14" onpaste="return false;" class="form-control" title="Digite seu CPF" placeholder="CPF"/><br />

				<label for="cep2">Digite seu CEP:</label>
				<input type="text" name="cep2" id="cep2" onblur="pesquisacepFuncionario(this.value);" 
				onkeypress="mascara(this, '#####-###')" size="10" maxlength="9" onpaste="return false;" class="form-control" title="CEP" placeholder="CEP"/><br />

				<label for="rua2">Rua:</label>
				<input type="text" name = "rua2" id="rua2" size="60" class="form-control" title="Rua" placeholder="Rua"/><br />

				<label for="numero2">Número:</label>
				<input name="numero2" type="text" id="numero2" size="10" class="form-control" title="Número" placeholder="Nº Casa"/><br />

				<label for="bairro2">Bairro:</label>
				<input type="text" id="bairro2" name = "bairro2" size="40" class="form-control" title="Bairro" placeholder="Bairro"/><br />

				<label for="cidade2">Cidade:</label>
				<input type="text" id="cidade2" name = "cidade2" size="40" class="form-control" title="Cidade" placeholder="Cidade"/><br />

				<label for ="uf2">Estado:</label>
				<input type="text" id="uf2" name = "uf2" size="2" class="form-control" title="Estado" placeholder="Estado"/><br />

				<label for="dataNascimento2">Selecione sua data de nascimento:</label>
				<input type="date" name="dataNascimento2" class="form-control" title="Selecione sua data de nascimento"/><br />

				<label for="telefone2">Digite seu celular:</label>
				<input type="tel" name="telefone2" onkeypress="mascara(this, '## # ####-####')"
				maxlength="14" onpaste="return false;" class="form-control" title="Digite seu número" placeholder="Nº Celular"/><br />

				<label for="sexo2">Selecione seu sexo:</label><br /><br />

				<div class="radio">
					<input type="radio" id="mas2" name="sexo2" value="m" title="Masculino"/>
					<label for="mas2" class="radio-label">Masculino</label>
				</div>

				<div class="radio4">	   
					<input type="radio"  id="fem2" name="sexo2" value="f" title="Feminino"/>
					<label for="fem2" class="radio-label4">Feminino</label>
				</div>

				<br /><label for="senha2">Digite uma senha:</label>
				<input type="password" name="senha2" class="form-control" title="Digite uma senha" placeholder="Senha"/><br />

				<label for="confirmSenha2">Confirme sua senha:</label>
				<input type="password" name="confirmSenha2" class="form-control" title="Confirme a senha" placeholder="Confirmar Senha"/><br />

				<input type="submit" name="btenviar2" value="Cadastrar" class="btn btn-success2" title="Cadastrar" />

				<div id="alertTamanhoSenha1">
					<footer class="alert">
						<span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
						A senha deve ter no mínimo 8 digitos.
					</footer>
				</div>

				<div id="alertConfirmSenha1">
					<footer class="alert">
						<span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
						A senha é diferente de sua confirmação.
					</footer>
				</div>

				<div id="alertSexo1">
					<footer class="alert">
						<span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
						Selecione seu sexo.
					</footer>
				</div>

				<div id="alertNomeCompleto1">
					<footer class="alert">
						<span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
						Digite seu nome completo.
					</footer>
				</div>

				<div id="alertNomeVazio1">
					<footer class="alert">
						<span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
						Preencha o campo de nome.
					</footer>
				</div>

				<div id="alertNomeUsuarioVazio1">
					<footer class="alert">
						<span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
						Preencha o campo de nome de usuário.
					</footer>
				</div>

				<div id="alertEmailVazio1">
					<footer class="alert">
						<span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
						Preencha o campo de e-mail.
					</footer>
				</div>

				<div id="alertCPFVazio1">
					<footer class="alert">
						<span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
						Preencha o campo de CPF.
					</footer>
				</div>

				<div id="alertCEPVazio1">
					<footer class="alert">
						<span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
						Preencha o campo de CEP.
					</footer>
				</div>

				<div id="alertRuaVazio1">
					<footer class="alert">
						<span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
						Preencha o campo de rua.
					</footer>
				</div>

				<div id="alertBairroVazio1">
					<footer class="alert">
						<span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
						Preencha o campo de bairro.
					</footer>
				</div>

				<div id="alertCidadeVazio1">
					<footer class="alert">
						<span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
						Preencha o campo de cidade.
					</footer>
				</div>

				<div id="alertUFVazio1">
					<footer class="alert">
						<span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
						Preencha o campo de Estado.
					</footer>
				</div>

				 <div id="alertProfissaoVazio1">
					<footer class="alert">
						<span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
						Preencha o campo de Profissão.
					</footer>
				</div>

				<div id="alertDataVazio1">
					<footer class="alert">
						<span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
						Selecione sua data de nascimento.
					</footer>
				</div>

				<div id="alertTelefone1">
					<footer class="alert">
						<span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
						Preencha o campo de telefone.
					</footer>
				</div>

				 <div id="alertCEPNaoEncontrado1">
					<footer class="alert">
						<span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
						CEP não encontrado.
					</footer>
				</div>

				<div id="alertCEPFormato1">
					<footer class="alert">
						<span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
						Formato de CEP inválido.
					</footer>
				</div>

				<div id="alertCPFinvalido1">
					<footer class="alert">
						<span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
						CPF Inválido.
					</footer>
				</div>

				<div id="alertMaiorIdade1">
					<footer class="alert">
						<span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
						Não é permitido o cadastro de menores de idade.
					</footer>
				</div>

				<div id="alertNome501">
					<footer class="alert" autofocus>
						<span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
						O nome só pode ter no máximo 50 caracteres.
					</footer>
				</div>

				<div id="alertNomeU501">
					<footer class="alert" autofocus>
						<span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
						O nome de usuário só pode ter no máximo 50 caracteres.
					</footer>
				</div>

				<div id="alertEmail501">
					<footer class="alert" autofocus>
						<span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
						O e-mail só pode ter no máximo 50 caracteres.
					</footer>
				</div>

				<div id="alertPro50">
					<footer class="alert" autofocus>
						<span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
						A profissão só pode ter no máximo 50 caracteres.
					</footer>
				</div>    
			</form>
		</div>
	</div>
</div>
</div>
</body>
</div>
</html>