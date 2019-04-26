
<?php

include('connect.php');
session_start();

if(isset($_POST)){
	if(isset($_SESSION) and isset($_GET)){

		$agencia = mysqli_real_escape_string($con, addslashes($_POST['agencia']));
		$tipoConta = mysqli_real_escape_string($con, addslashes($_POST['tipoConta']));
		$valor = mysqli_real_escape_string($con, addslashes($_POST['valor']));
		$servico = mysqli_real_escape_string($con, addslashes($_POST['tipoPedido']));
		$codigoo = $_SESSION['codiCliente'];
		$codFunci = $_GET['cod'];
		$codServico = $_GET['cod2'];


		$result = false;

		if(empty($_POST['agencia'])){
			echo "<script language='javascript' type='text/javascript'>alert('Erro no campo de agencia ');window.location.href='../paginaInicialFunci.php';</script>";
			$result = true;
		}

		if(empty($_POST['tipoConta'])){
			echo "<script language='javascript' type='text/javascript'>alert('Erro no campo de conta ');window.location.href='../paginaInicialFunci.php';</script>";
			$result = true;
		}

		if(empty($_POST['valor'])){
			echo "<script language='javascript' type='text/javascript'>alert('Erro no campo de valor ');window.location.href='../paginaInicialFunci.php';</script>";
			$result = true;
		}

		
		if($result == false){

			$query2 = "SELECT * FROM `tbformcliente` WHERE codCliente = '$codigoo' and codServico = '$codServico'";
			$result2 = mysqli_query($con, $query2);
			$row2 = mysqli_num_rows($result2);
			$registro = false;

			if($row2>0){
				$registro = true; // Se o cliente já respondeu o fomulario o registro fica true
			}

			if($registro == false){


				$inserir = "INSERT INTO tbformcliente";
				$inserir .= "(`codCliente`, `codFunci`, `codServico`, `agencia`, `conta`, `valor`)";
				$inserir .= "VALUES ";
				$inserir .= "('$codigoo', '$codFunci', '$codServico', '$agencia', '$tipoConta', '$valor')";

				$operacao_inserir = mysqli_query ($con, $inserir);

				$pedidoTrue = mysqli_query($con, "UPDATE `tbpedidosdeservico` SET statusPedido = '1'
				WHERE  codigo = '$codServico'");//Atualiza status do serviço

				$negocioTrue = mysqli_query($con, "UPDATE `tbformfunci` SET negocioFechado = '1'
				WHERE codServico = '$codServico'");//Atualiza status do serviço


				if(!$operacao_inserir and !$pedidoTrue and !$negocioTrue){
					die("Erro ao inserir dados ao banco de dados");
				}else{
					echo "<script language='javascript' type='text/javascript'>
					alert('Obrigado por responder, avisaremos o funcionário quando for o serviço.');window.location.href='../paginaInicialCliente.php';</script>";
					mysqli_close($con);
				}

			}else{
				echo "<script language='javascript' type='text/javascript'>
				alert('Você já respondeu o formulário de confirmação deste pedido.');window.location.href='../paginaInicialCliente.php';</script>";
			}
		}
	}else{
		echo "erro";
	}

}else{
	echo "Erro ao enviar dados do formulário";
}

?>