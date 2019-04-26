<?php
session_start();

//Se algum usuario cliente tentar entrar em alguma pagina de usuario funcionario
if(isset($_SESSION['usuarioCliente'])){
	if($_SESSION['loginCliente'] == true){
		header("location:paginaInicialCliente.php");	
	}else{}

}else{}

if(isset($_SESSION['usuarioFunci'])){
	if($_SESSION['loginFunci'] == true){
		
	}else{
	echo "<script language='javascript' type='text/javascript'>
		alert('Você precisa se logar primeiro.');window.location.href='login.php';</script>";	
	}

}else{
	echo "<script language='javascript' type='text/javascript'>
		alert('Você precisa se logar primeiro.');window.location.href='login.php';</script>";	
}

?>