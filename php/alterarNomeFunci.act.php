<?php
include('connect.php');
session_start();
$codigoo = $_SESSION["codiFunci"];//Pega código do funcionario

if(isset($_POST['btenviar'])){
	$nome1 = mysqli_real_escape_string($con, addslashes($_POST['nome']));

	//Verifica campo

	if(empty($_POST['nome'])){
		echo "<script language='javascript' type='text/javascript'>alert('Erro no campo de nome ');window.location.href='../verPerfilFunci.php?cod=$codigoo';</script>";
	}

	//Verifica se o nome tem mais de 50 dígitos
	$resNome  = strlen ($nome1);
	//-----------------------------------------------------------------------------------//

	if($resNome > 50){
		echo "<script language='javascript' type='text/javascript'>alert('O nome só pode ter no máximo 50 caracteres ');window.location.href='../verPerfilFunci.php?cod=$codigoo';</script>";
	}

	//-----------------------------------------------------------------//

	//Verifica se a pessoa escreveu seu NOME COMPLETO

	$resgistro5 = false;
	if(strrpos($nome1, " ") >= 2){
		$resgistro5 = true;//Se existir dois ou espaços ou mais o registro fica true
	}

	//-----------------------------------------------------------------//

	if($resgistro5 == true){//Verifica se a pessoa escreveu seu NOME COMPLETO

		$nomeTrue = mysqli_query($con, "UPDATE `tbfuncionarios` SET nome = '$nome1' WHERE  codigo = '$codigoo'");//Atualiza nome

		if($nomeTrue){
			echo "<script language='javascript' type='text/javascript'>
			alert('Nome alterado com Sucesso.');window.location.href='../verPerfilFunci.php?cod=$codigoo';</script>";
			mysqli_close($con);//Fecha consulta ao banco

		}else{
			echo "<script language='javascript' type='text/javascript'>
			alert('Erro ao alterar nome.');window.location.href='../verPerfilFunci.php?cod=$codigoo';</script>";
			mysqli_close($con);//Fecha consulta ao banco
		}
	}else{
		echo "<script language='javascript' type='text/javascript'>
		alert('Escreva seu nome completo');window.location.href='../verPerfilFunci.php?cod=$codigoo';</script>";
	}

}else{
	echo "<script language='javascript' type='text/javascript'>
	alert('Erro ao enviar dados do formulario.');window.location.href='../verPerfilFunci.php?cod=$codigoo';</script>";
}
?>	