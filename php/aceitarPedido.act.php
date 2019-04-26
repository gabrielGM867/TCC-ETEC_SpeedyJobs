<?php

include('connect.php');
$codigoo = mysqli_real_escape_string($con, addslashes($_GET['cod']));//Pega código do pedido
session_start();
$codUsuarioFunci = $_SESSION['codiFunci'];//Pega código do funcionário


$query2 = "SELECT * FROM `tbdetalhespedido` WHERE codPedido = '$codigoo' and codFuncionario = '$codUsuarioFunci'";//Verifica se funcionário já aceitou o pedido
$result2 = mysqli_query($con, $query2);
$row2 = mysqli_num_rows($result2);
$registro = false;

if($row2>0){
	$registro = true; // Se o funcionário já tiver aceito o pedido o registro fica true
}

$busca = mysqli_query($con,"Select * from `tbpedidosdeservico` where codigo = '$codigoo' ");
$usuario = mysqli_fetch_array($busca);

$codigoooPedido = $usuario['codigo'];//Pega código do pedido
$codClienteDoPedido = $usuario['codCliente'];//Pega código do cliente
$result = $usuario['AceitoPedido'];//Pega o número de funcionário que aceitaram o pedido
$result = $result + 1;

if($registro == false){//Verifica se funcionário já aceitou o pedido
	if($result < 6){//Verifica o número de funcionários que aceitaram o pedido

		$TipoServicoTrue = mysqli_query($con, "UPDATE `tbpedidosdeservico` SET AceitoPedido = '$result' WHERE  codigo = '$codigoo'");

		if($codigoo == $codigoooPedido){

			$inserir = "INSERT INTO tbdetalhespedido";
			$inserir .= "(`codPedido`, `codCliente`, `codFuncionario`, `status`)";
			$inserir .= "VALUES ";
			$inserir .= "('$codigoooPedido', '$codClienteDoPedido', '$codUsuarioFunci', '0')";

			$operacao_inserir = mysqli_query ($con, $inserir);//Insere pedido de serviço

			if(!$operacao_inserir){
				die("Erro ao inserir detalhe de pedido ao banco de dados");
				mysqli_close($con);//Fecha consulta ao banco
				exit;
			}

			if($TipoServicoTrue){
				echo "<script language='javascript' type='text/javascript'>
				alert('Pedido Aceito com Sucesso.');window.location.href='../paginaInicialFunci.php';</script>";
				mysqli_close($con);//Fecha consulta ao banco		
			}else{
				echo "<script language='javascript' type='text/javascript'>
				alert('Erro ao aceitar pedido.');window.location.href='../paginaInicialFunci.php';</script>";
				mysqli_close($con);//Fecha consulta ao banco
				exit;
			}

		}

	}else{
		echo "<script language='javascript' type='text/javascript'>
		alert('Máximo de prestadores de serviço atingido.');window.location.href='../paginaInicialFunci.php';</script>";
		mysqli_close($con);//Fecha consulta ao banco
		exit;	
	}

}else{
	echo "<script language='javascript' type='text/javascript'>
	alert('Você já aceitou este pedido.');window.location.href='../paginaInicialFunci.php';</script>";
	mysqli_close($con);//Fecha consulta ao banco
	exit;
}

?>