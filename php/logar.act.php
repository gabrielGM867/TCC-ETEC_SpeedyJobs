<?php
session_start();
include('connect.php');
$opcao = mysqli_real_escape_string($con, addslashes($_POST['entrada']));//Pega opção de entrada
$senha = mysqli_real_escape_string($con, addslashes($_POST['password']));//Pega senha do login
$email = mysqli_real_escape_string($con, addslashes($_POST['email']));//Pega email do login
$senha = md5($senha);//Criptografa a senha

if (isset($_POST['g-recaptcha-response'])) {//Verifica se o RECAPTCHA foi selecionado
    $captcha_data = mysqli_real_escape_string($con, addslashes($_POST['g-recaptcha-response']));//Pega RECAPTCHA
}

// Se nenhum valor foi recebido, o usuário não realizou o captcha
if (!$captcha_data) {
    echo "<script language='javascript' type='text/javascript'>alert('Você não clicou no reCAPTCHA, por favor, faça!');window.location.href='../login.php';</script>";	
    exit;
}

$resposta = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LdLFm4UAAAAACYwZhawO0OTzsCiztL3iEvKER6c&response=".$captcha_data."&remoteip=".$_SERVER['REMOTE_ADDR']);//Pega resposta do usuário no RECAPTCHA

// Verifica campos vazios

	if(empty($_POST['email'])) {
		echo "<script language='javascript' type='text/javascript'>alert('Campo E-mail Vazio. ');window.location.href='../login.php';</script>";
	}

	if(empty($_POST['password'])) {
		echo "<script language='javascript' type='text/javascript'>alert('Campo Senha Vazio. ');window.location.href='../login.php';</script>";
	}

//----------------------------------------------------------------------------------//


if($opcao == "Cliente"){//Verifica se usuario é CLIENTE

	
	$busca = mysqli_query($con,"Select * from `tbclientes` where `email` like '$email' and `senha` like '$senha'");
	$usuario = mysqli_fetch_array($busca);
	

	if($usuario['email'] == $email && $usuario['senha'] = $senha){//Verifica e-mail e senha do usuario CLIENTE
		$_SESSION['usuarioCliente'] = $usuario['email'];//Pega e-mail
		$_SESSION['nomeCompletoCliente'] = $usuario['nome'];//Pega nome completo
		$_SESSION['codiCliente'] = $usuario['codigo'];//Pega codigo do cliente
		$_SESSION['nome_usuarioCliente'] = $usuario['nomeUsuario'];//Pega nome de usuario
		$_SESSION['dataNasCliente'] = $usuario['dataNascimento'];//Pega data de nascimento
		$_SESSION['sexCliente'] = $usuario['sexo'];//Pega sexo 
		$_SESSION['fotoCliente'] = $usuario['foto'];//Pega foto
		$_SESSION['loginCliente'] = true;
		$codigoCliente = $usuario['codigo'];


		$buscaChat = mysqli_query($con,"Select tbusuarioschat.codigo AS 'codUsuario' from `tbusuarioschat` INNER JOIN tbclientes ON tbclientes.codigo = tbusuarioschat.codUsuario 
		where `codUsuario` = '$codigoCliente' AND `grupo` = 'c'");
		$usuarioChat = mysqli_fetch_array($buscaChat);

		$_SESSION['codiClienteChat'] = $usuarioChat['codUsuario'];

		header("location:../paginaInicialCliente.php");//Move usuario CLIENTE para página inicial*/
		mysqli_close($con);//Fecha consulta ao banco

	}else{
		echo "<script language='javascript' type='text/javascript'>
		alert('E-mail ou Senha Inválidos.');window.location.href='../login.php';</script>";
		mysqli_close($con);//Fecha consulta ao banco
		exit();
	}

}else if($opcao == "Funcionário"){//Verifica se usuario é CLIENTE

	$busca = mysqli_query($con,"Select * from `tbfuncionarios` where `email` like '$email' and `senha` like '$senha'");
	$usuario = mysqli_fetch_array($busca);

	if($usuario['email'] == $email && $usuario['senha'] = $senha){//Verifica e-mail e senha do usuario FUNCIONARIO
		$_SESSION['usuarioFunci'] = $usuario['email'];//Pega e-mail
		$_SESSION['codiFunci'] = $usuario['codigo'];//Pega codigo do FUNCIONARIO
		$_SESSION['nomeCompletoFunci'] = $usuario['nome'];//Pega nome completo
		$_SESSION['nome_usuarioFunci'] = $usuario['nomeUsuario'];//Pega nome de usuario
		$_SESSION['dataNasFunci'] = $usuario['dataNascimento'];//Pega data de nascimento
		$_SESSION['sexFunci'] = $usuario['sexo'];//Pega sexo
		$_SESSION['fotoFunci'] = $usuario['foto'];//Pega foto 
		$_SESSION['prof'] = $usuario['profissao'];//Pega profissão   
		$_SESSION['loginFunci'] = true;
		$codigoFuncionario = $usuario['codigo'];


		$buscaChat = mysqli_query($con,"Select tbusuarioschat.codigo AS 'codUsuario' from `tbusuarioschat` INNER JOIN tbfuncionarios ON tbfuncionarios.codigo = tbusuarioschat.codUsuario 
		where `codUsuario` = '$codigoFuncionario' AND `grupo` = 'f'");
		$usuarioChat = mysqli_fetch_array($buscaChat);

		$_SESSION['codiFunciChat'] = $usuarioChat['codUsuario'];


		header("location:../paginaInicialFunci.php");//Move usuario FUNCIONARIO para página inicial
		mysqli_close($con);//Fecha consulta ao banco

	}else{
		echo "<script language='javascript' type='text/javascript'>
		alert('E-mail ou Senha Inválidos.');window.location.href='../login.php';</script>";
		mysqli_close($con);//Fecha consulta ao banco
		exit();
	}

}else{
	echo "<script language='javascript' type='text/javascript'>
	alert('Selecione um tipo de entrada.');window.location.href='../login.php';</script>";
	exit();
}


?>