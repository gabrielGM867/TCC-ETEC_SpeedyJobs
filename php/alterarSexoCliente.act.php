<?php
include('connect.php');
session_start();
$codigoo = $_SESSION["codiCliente"];//Pega código do cliente

if(isset($_POST['btenviar'])){
	$sexo1 = mysqli_real_escape_string($con, addslashes($_POST['sexo']));

	//Verifica campo

	if(empty($_POST['sexo'])){
		echo "<script language='javascript' type='text/javascript'>alert('Erro no campo de sexo ');window.location.href='../verPerfilCliente.php?cod=$codigoo';</script>";
	}else{

		$sexoTrue = mysqli_query($con, "UPDATE `tbclientes` SET sexo = '$sexo1' WHERE  codigo = '$codigoo'");//Atualiza sexo

		if($sexoTrue){
			echo "<script language='javascript' type='text/javascript'>
			alert('Sexo alterado com Sucesso.');window.location.href='../verPerfilCliente.php?cod=$codigoo';</script>";
			mysqli_close($con);//Fecha consulta ao banco

		}else{
			echo "<script language='javascript' type='text/javascript'>
			alert('Erro ao alterar sexo.');window.location.href='../VerPerfilCliente.php?cod=$codigoo';</script>";
			mysqli_close($con);//Fecha consulta ao banco
		}
	}

}else{
	echo "<script language='javascript' type='text/javascript'>
	alert('Erro ao enviar dados do formulario.');window.location.href='../verPerfilCliente.php?cod=$codigoo';</script>";
}
?>	