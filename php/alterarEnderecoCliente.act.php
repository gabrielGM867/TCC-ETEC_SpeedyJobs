<?php

function arrumarString($string) {//Função para tirar ESPAÇOS EM BRANCO E CARACTERES ESPECIAIS
    
    $caracteres = array(' ', '-', '.');
 
    $remove   = array('', '', '');

    // devolver a string
    return str_replace($caracteres, $remove, $string);
}

?>


<?php
include('connect.php');
session_start();
$codigoo = $_SESSION["codiCliente"];//Pega código do cliente

if(isset($_POST['btenviar'])){
	$cep1 = mysqli_real_escape_string($con, addslashes($_POST['cep']));
	$rua1 = mysqli_real_escape_string($con, addslashes($_POST['rua']));
	$numero11 = mysqli_real_escape_string($con, addslashes($_POST['numero']));
	$bairro1 = mysqli_real_escape_string($con, addslashes($_POST['bairro']));
	$cidade1 = mysqli_real_escape_string($con, addslashes($_POST['cidade']));
	$estado1 = mysqli_real_escape_string($con, addslashes($_POST['uf']));

	//Tira ESPAÇOS E CARACTERES ESPECIAS DAS STRINGS

	$cep1 = arrumarString($cep1);
	
	//-----------------------------------------------//


	//Verifica campo

	if(empty($_POST['cep'])){
		echo "<script language='javascript' type='text/javascript'>alert('Erro no campo de CEP ');window.location.href='../verPerfilCliente.php?cod=$codigoo';</script>";
	}else{

		$cepTrue = mysqli_query($con, "UPDATE `tbenderecocliente` SET cep = '$cep1', rua = '$rua1', numero = '$numero11', bairro = '$bairro1', cidade = '$cidade1', 
		estado = '$estado1' WHERE codCliente = '$codigoo'");//Atualiza endereco

		if($cepTrue){
			echo "<script language='javascript' type='text/javascript'>
			alert('Endereço alterado com Sucesso.');window.location.href='../verPerfilCliente.php?cod=$codigoo';</script>";
			mysqli_close($con);//Fecha consulta ao banco

		}else{
			echo "<script language='javascript' type='text/javascript'>
			alert('Erro ao alterar endereço.');window.location.href='../VerPerfilCliente.php?cod=$codigoo';</script>";
			mysqli_close($con);//Fecha consulta ao banco
		}
	}
		
}else{
	echo "<script language='javascript' type='text/javascript'>
	alert('Erro ao enviar dados do formulario.');window.location.href='../verPerfilCliente.php?cod=$codigoo';</script>";
}
?>	