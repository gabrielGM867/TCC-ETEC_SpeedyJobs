
<?php

include('connect.php');
session_start();

if(isset($_POST)){
	if(isset($_SESSION) and isset($_GET)){

		$dataInicio = mysqli_real_escape_string($con, addslashes($_POST['dataInicioPedido']));
		$horaInicio = mysqli_real_escape_string($con, addslashes($_POST['horaInicioPedido']));
		$dataFinal = mysqli_real_escape_string($con, addslashes($_POST['dataFinalPedido']));
		$horaFinal = mysqli_real_escape_string($con, addslashes($_POST['horaFinalPedido']));
		$agencia = mysqli_real_escape_string($con, addslashes($_POST['agencia']));
		$tipoConta = mysqli_real_escape_string($con, addslashes($_POST['tipoConta']));
		$valor = mysqli_real_escape_string($con, addslashes($_POST['valor']));
		$servico = mysqli_real_escape_string($con, addslashes($_POST['tipoPedido']));
		$codigoo = $_SESSION['codiFunci'];
		$codigoCliente = $_GET['cod'];
		$codServico = $_GET['cod2'];


		$result = false;

		if(empty($_POST['dataInicioPedido'])){
			echo "<script language='javascript' type='text/javascript'>alert('Erro no campo de data início ');window.location.href='../paginaInicialFunci.php';</script>";
			$result = true;
		}

		if(empty($_POST['horaInicioPedido'])){
			echo "<script language='javascript' type='text/javascript'>alert('Erro no campo de nome de hora início ');window.location.href='../paginaInicialFunci.php';</script>";
			$result = true;
		}

		if(empty($_POST['dataFinalPedido'])){
			echo "<script language='javascript' type='text/javascript'>alert('Erro no campo de data final ');window.location.href='../paginaInicialFunci.php';</script>";
			$result = true;
		}

		if(empty($_POST['horaFinalPedido'])){
			echo "<script language='javascript' type='text/javascript'>alert('Erro no campo de hora final ');window.location.href='../paginaInicialFunci.php';</script>";
			$result = true;
		}

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

		if(empty($_POST['tipoPedido'])){
			echo "<script language='javascript' type='text/javascript'>alert('Erro no campo de serviço ');window.location.href='../paginaInicialFunci.php';</script>";
			$result = true;
		}

		if($result == false){

			$query2 = "SELECT * FROM `tbformfunci` WHERE codFunci = '$codigoo' and codServico = '$codServico'";
			$result2 = mysqli_query($con, $query2);
			$row2 = mysqli_num_rows($result2);
			$registro = false;

			if($row2>0){
				$registro = true; // Se o funciona já respondeu o fomulario o registro fica true
			}

			if($registro == false){


				$inserir = "INSERT INTO tbformfunci";
				$inserir .= "(`codFunci`, `codCliente`, `codServico`, `dataInicio`, `horaInicio`, `dataFinal`, `horaFinal`,  `agencia`, `conta`, `valor`, `negocioFechado`)";
				$inserir .= "VALUES ";
				$inserir .= "('$codigoo', '$codigoCliente', '$codServico', '$dataInicio', '$horaInicio', '$dataFinal', 
				'$horaFinal', '$agencia', '$tipoConta', '$valor', '0')";

				$operacao_inserir = mysqli_query ($con, $inserir);

				if(!$operacao_inserir){
					die("Erro ao inserir dados ao banco de dados");
				}else{
					echo "<script language='javascript' type='text/javascript'>
					alert('Obrigado por responder, aguarde o cliente responder o formulário de confirmação de serviço.');window.location.href='../paginaInicialFunci.php';</script>";
					mysqli_close($con);
				}

			}else{
				echo "<script language='javascript' type='text/javascript'>
				alert('Você já respondeu o formulário deste pedido.');window.location.href='../paginaInicialFunci.php';</script>";
			}
		}
	}else{
		echo "erro";
	}

}else{
	echo "Erro ao enviar dados do formulário";
}

?>