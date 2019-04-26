<?php
include('connect.php');
$codigoo = mysqli_real_escape_string($con, addslashes($_GET['cod']));//Pega código do funci
$codigo2 = mysqli_real_escape_string($con, addslashes($_GET['cod2']));//Pega código do pedido



if(isset($_GET['cod']) and isset($_GET['cod2']) and $codigoo != "" and $codigo2 != "" ){

	$query2 = "SELECT * FROM `tbdetalhespedido` WHERE codPedido = '$codigo2' and codFuncionario = '$codigoo' and status = '1' ";//Verifica o pedido ja foi fechado
	$result2 = mysqli_query($con, $query2);
	$row2 = mysqli_num_rows($result2);
	$registro = false;

	if($row2>0){
		$registro = true; // Se o pedido já foi fechado fica true
	}

	if($registro == false){

		$atualizaTrue = mysqli_query($con, "UPDATE `tbdetalhespedido` SET status = '1' WHERE  codFuncionario = '$codigoo' AND codPedido = '$codigo2'");
		if($atualizaTrue){
			echo "<script language='javascript' type='text/javascript'>
			alert('Enviamos um formulário para o funcionário, aguarde a resposta dele.');window.location.href='../paginaInicialCliente.php';</script>";
			mysqli_close($con);//Fecha consulta ao banco

		}else{
			die('Erro ao fechar négocio.');
		}

	}else{
		echo "<script language='javascript' type='text/javascript'>
		alert('Você já fechou négocio com este funcionário.');window.location.href='../paginaInicialCliente.php';</script>";
	}



}else{
	echo "<script language='javascript' type='text/javascript'>
	alert('Erro ao enviar códigos.');window.location.href='../paginaInicialCliente.php';</script>";	
}


?>