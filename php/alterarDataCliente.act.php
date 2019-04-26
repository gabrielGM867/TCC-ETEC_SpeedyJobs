<?php
include('connect.php');
session_start();
$codigoo = $_SESSION["codiCliente"];//Pega código do cliente

if(isset($_POST['btenviar'])){
	$dataNascimento1 = mysqli_real_escape_string($con, addslashes($_POST['dataNascimento']));

	//Verifica data de nascimento

	$dataArrumada = date('d/m/Y', strtotime($dataNascimento1));

	$diaNas = substr($dataArrumada,0,2);
	$mesNas = substr($dataArrumada,3,2);
	$anoNas = substr($dataArrumada,6,4);

	$diaAtual = date('d');
	$mesAtual = date('m');
	$anoAtual = date('Y');

	$resa = $anoAtual - $anoNas;
	$resm = $mesNas - $mesAtual;
	$resd = $diaNas - $diaAtual;

	$maior = false;
	
	if($resa == 18) {//Verfica se o usuário é maior de idade
		if($resm<0) {
			$maior = true;
		}else if($resm == 0){
	  		if($resd<=0) {
				$maior = true;
			}else{
			  $maior = false;
		  	}
		}else {
			$maior = false;
		}
	}else if($resa >= 19) {
		$maior = true;

	}else{
		$maior = false;
	}	 
	
	//-----------------------------------------------------------------------------------//


	//Verifica campo

	if(empty($_POST['dataNascimento'])){
		echo "<script language='javascript' type='text/javascript'>alert('Erro no campo de data ');window.location.href='../verPerfilCliente.php?cod=$codigoo';</script>";
	}

	//-----------------------------------------------------------------------------------//
	
	if($maior == true){//Verifica se a pessoa é maior de idade

		$dataTrue = mysqli_query($con, "UPDATE `tbclientes` SET dataNascimento = '$dataNascimento1' WHERE  codigo = '$codigoo'");//Atualiza data

		if($dataTrue){
			echo "<script language='javascript' type='text/javascript'>
			alert('Data de nascimento alterada com Sucesso.');window.location.href='../verPerfilCliente.php?cod=$codigoo';</script>";
			mysqli_close($con);//Fecha consulta ao banco

		}else{
			echo "<script language='javascript' type='text/javascript'>
			alert('Erro ao alterar data de nascimento.');window.location.href='../VerPerfilCliente.php?cod=$codigoo';</script>";
			mysqli_close($con);//Fecha consulta ao banco
		}
	}else{
		echo "<script language='javascript' type='text/javascript'>
		alert('Não é permitido menores de idade');window.location.href='../verPerfilCliente.php?cod=$codigoo';</script>";
	}

}else{
	echo "<script language='javascript' type='text/javascript'>
	alert('Erro ao enviar dados do formulario.');window.location.href='../verPerfilCliente.php?cod=$codigoo';</script>";
}
?>	