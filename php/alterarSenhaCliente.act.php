
<?php
include('connect.php');
session_start();
$codigoo = $_SESSION["codiCliente"];//Pega código do cliente

if(isset($_POST['btenviar'])){

	$senhaAntiga = mysqli_real_escape_string($con, addslashes($_POST['senhaAntiga']));
	$senhaAntiga1 = md5($senhaAntiga);

	$senha1 = mysqli_real_escape_string($con, addslashes($_POST['senha']));
	$confirmSenha1 = mysqli_real_escape_string($con, addslashes($_POST['confirmSenha']));

	//Verifica campo
	if(empty($_POST['senhaAntiga'])){//Verifica se a senha e igual a confirmação de senha
		echo "<script language='javascript' type='text/javascript'>alert('Erro no campo de Senha Antiga ');window.location.href='../verPerfilCliente.php?cod=$codigoo';</script>";

	}elseif(empty($_POST['senha'])){//Verifica se a senha e igual a confirmação de senha
		echo "<script language='javascript' type='text/javascript'>alert('Erro no campo de Senha ');window.location.href='../verPerfilCliente.php?cod=$codigoo';</script>";

	}elseif($senha1 == $confirmSenha1){

		//Verifica se a SENHA ANTIGA é verdadeira coma a do Banco

		$query2 = "SELECT * FROM `tbclientes` WHERE senha = '$senhaAntiga1'";
		$result2 = mysqli_query($con, $query2);
		$row2 = mysqli_num_rows($result2);
		$registro = false;

		if($row2>0){
			$registro = true; // Se a senha for verdadeira o registro fica true
		}

		//-----------------------------------------------------------------//

		if($registro == true){

			$senhaNova = md5($senha1);//Criptografa SENHA

			$senhaTrue = mysqli_query($con, "UPDATE `tbclientes` SET senha = '$senhaNova' WHERE  codigo = '$codigoo'");//Atualiza senha


			if($senhaTrue){
				echo "<script language='javascript' type='text/javascript'>
				alert('Senha alterada com Sucesso.');window.location.href='../verPerfilCliente.php?cod=$codigoo';</script>";
				mysqli_close($con);//Fecha consulta ao banco

			}else{
				echo "<script language='javascript' type='text/javascript'>
				alert('Erro ao alterar senha.');window.location.href='../VerPerfilCliente.php?cod=$codigoo';</script>";
				mysqli_close($con);//Fecha consulta ao banco
			}

		}else{
			echo "<script language='javascript' type='text/javascript'>
			alert('Senha antiga inválida');window.location.href='../VerPerfilCliente.php?cod=$codigoo';</script>";
		}
	}
		
}else{
	echo "<script language='javascript' type='text/javascript'>
	alert('Erro ao enviar dados do formulario.');window.location.href='../verPerfilCliente.php?cod=$codigoo';</script>";
}
?>	