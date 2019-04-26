<?php
include('connect.php');
$codigoo = mysqli_real_escape_string($con, addslashes($_GET['cod']));//Pega código do funcionario
session_start();
	
$busca = mysqli_query($con,"Select * from `tbfuncionarios` where codigo = '$codigoo' ");
$usuario = mysqli_fetch_array($busca);

$_SESSION['status'] = $usuario['statusEmail'];//Pega o status de confirmação do email do funcionário

if($_SESSION['status'] == 0){//Verifica se o funcionário já confirmou ou não o e-mail		

	$statusTrue = mysqli_query($con, "UPDATE `tbfuncionarios` SET statusEmail = '1' WHERE  codigo = '$codigoo'");//Confirma o e-mail

	if($statusTrue){
		echo "<script language='javascript' type='text/javascript'>
		alert('Obrigado por confirmar seu e-mail.');window.location.href='../index.php';</script>";
		mysqli_close($con);//Fecha consulta ao banco

	}else{
		echo "<script language='javascript' type='text/javascript'>
		alert('Erro ao confirmar e-mail no banco de dados.');window.location.href='../index.php';</script>";
		mysqli_close($con);//Fecha consulta ao banco
	}

}else{
	echo "<script language='javascript' type='text/javascript'>
	alert('Seu e-mail já está confirmado.');window.location.href='../index.php';</script>";
	mysqli_close($con);//Fecha consulta ao banco
	
}

?>