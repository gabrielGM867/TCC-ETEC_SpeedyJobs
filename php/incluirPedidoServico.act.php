<?php

include('connect.php');
session_start();

if(isset($_POST['btenviar_pedido'])){//Verifica se o cliente apertou o botao de enviar

	$tipoServico = mysqli_real_escape_string($con, addslashes($_POST['servico']));//Pega o tipo de serviço(PROFISSÃO)
	$descricaoPedido = mysqli_real_escape_string($con, addslashes($_POST['descricao']));//Pega descrição do pedido
	$codUsuarioCliente = $_SESSION['codiCliente'];//Pega código do cliente

	//Verifica se o tipo de serviço tem mais de 50 dígitos
	$resTipo  = strlen ($tipoServico);
	//-----------------------------------------------------------------------------------//

	//Verifica se a descrição do pedido tem mais de 100 dígitos
	$resDes  = strlen ($descricaoPedido);
	//-----------------------------------------------------------------------------------//

	//Verifica campos

	if(empty($_POST['servico'])){
		echo "<script language='javascript' type='text/javascript'>alert('Erro no campo de serviço');window.location.href='../postarPedidoServico.php';</script>";
	}

	if(empty($_POST['descricao'])){
		echo "<script language='javascript' type='text/javascript'>alert('Erro no campo de descrição de pedido');window.location.href='../PostarPedidoServico.php';</script>";
	}

	if($resTipo > 50){
		echo "<script language='javascript' type='text/javascript'>alert('O tipo de serviço só pode ter no máximo 50 caracteres ');window.location.href='../PostarPedidoServico.php';</script>";
	}

	if($resDes > 100){
		echo "<script language='javascript' type='text/javascript'>alert('A descrição do pedido só pode ter no máximo 100 caracteres ');window.location.href='../PostarPedidoServico.php';</script>";
	}

	//----------------------------------------------------------------------//

	$inserir = "INSERT INTO tbpedidosdeservico";
	$inserir .= "(`codCliente`, `tipoServico`, `descricaoPedido`, `dataDoPedido`,  `AceitoPedido`, 
	`statusPedido`, `visNotificacao`)";
	$inserir .= "VALUES ";
	$inserir .= "('$codUsuarioCliente', '$tipoServico', '$descricaoPedido', NOW(), '0', '0', '0')";

	$operacao_inserir = mysqli_query ($con, $inserir);//Insere pedido de serviço

	if(!$operacao_inserir){
		die("Erro ao inserir pedido ao banco de dados");
		mysqli_close($con);//Fecha consulta ao banco
		exit;
	}

	$maiorCodigo = "select max(codigo) as maiorCod from tbpedidosdeservico";
	$resultado_maiorcodigo = mysqli_query ($con, $maiorCodigo);
	$row = mysqli_fetch_array($resultado_maiorcodigo);
	$row[0] = "";
	$row[1] = "";
	$str = implode("", $row);

	$inserir2 = "INSERT INTO tbvisupedidos";
	$inserir2 .= "(`codFunci`, `codPedido`, `numVisu`)";
	$inserir2 .= "VALUES ";
	$inserir2 .= "('0', '$str', '0')";

	$operacao_inserir2 = mysqli_query ($con, $inserir2);//Insere pedido de serviço

	if(!$operacao_inserir2){
		die("Erro ao inserir pedido ao banco de dados");
		mysqli_close($con);//Fecha consulta ao banco
		exit;
	}

	
	echo "<script language='javascript' type='text/javascript'>
	alert('Pedido postado com sucesso!.');window.location.href='../paginaInicialCliente.php';</script>";//Redireciona usuário para página inicial

	mysqli_close($con);//Fecha consulta ao banco


}else{
	echo "<script language='javascript' type='text/javascript'>
	alert('Erro ao enviar dados do formulario.');window.location.href='../postarPedidoServico.php';</script>";
	mysqli_close($con);//Fecha consulta ao banco
	exit;
}

?>