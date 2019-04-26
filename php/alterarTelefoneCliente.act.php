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
	$telefone1 = mysqli_real_escape_string($con, addslashes($_POST['telefone']));

	//Tira ESPAÇOS E CARACTERES ESPECIAS DAS STRINGS

	$telefone1 = arrumarString($telefone1);
	
	//-----------------------------------------------//


	//Verifica campo

	if(empty($_POST['telefone'])){
		echo "<script language='javascript' type='text/javascript'>alert('Erro no campo de telefone ');window.location.href='../verPerfilCliente.php?cod=$codigoo';</script>";
	}else{

	
		$delTelefoneTrue = mysqli_query($con, "DELETE FROM `tbtelefonescliente` WHERE codCliente = '$codigoo'");//Deleta telefone


		//Insere o novo telefone

		$inserir = "INSERT INTO tbtelefonescliente";
		$inserir .= "(`codCliente`, `numero`, `tipo`)";
		$inserir .= "VALUES ";
		$inserir .= "('$codigoo', '$telefone1', 'Celular')";

		$operacao_inserir = mysqli_query ($con, $inserir);

		if(!$operacao_inserir){
			die("Erro ao inserir telefone ao banco de dados");
		}

		//--------------------------------------------------------------//

		if($operacao_inserir){
			echo "<script language='javascript' type='text/javascript'>
			alert('Telefone alterado com Sucesso.');window.location.href='../verPerfilCliente.php?cod=$codigoo';</script>";
			mysqli_close($con);//Fecha consulta ao banco

		}else{
			echo "<script language='javascript' type='text/javascript'>
			alert('Erro ao alterar telefone.');window.location.href='../VerPerfilCliente.php?cod=$codigoo';</script>";
			mysqli_close($con);//Fecha consulta ao banco
		}

	}
	
}else{
	echo "<script language='javascript' type='text/javascript'>
	alert('Erro ao enviar dados do formulario.');window.location.href='../verPerfilCliente.php?cod=$codigoo';</script>";
}
?>	