<?php
session_start();
include('connect.php');
$opcao = mysqli_real_escape_string($con, addslashes($_POST['entrada']));//Pega opcao de entrada do usuario
$email = mysqli_real_escape_string($con, addslashes($_POST['email']));//Pega email

if($opcao == "Cliente"){//Verifica se usuario é CLIENTE

	$busca = mysqli_query($con,"Select * from `tbclientes` where `email` like '$email'");
	$usuario = mysqli_fetch_array($busca);
	$_SESSION['id'] = $usuario['codigo'];//Pega codigo do cliente
	$_SESSION['status'] = $usuario['statusEmail'];//Pega status de confirmação de email
	$codigoC = $_SESSION['id'];
	
	$busca = mysqli_query($con,"Select * from `tbclientes` where `email` like '$email'");
	$row = mysqli_num_rows($busca);

		
		if($row == 1){//Verifica se usuario existe

			if($_SESSION['status'] == 1){//Verifica se o usuario já confirmou o email

				//Cria nova senha
				$str = "abcdefghijqlmnopqrstuvwxyz1234567890";
				$embaralhado = str_shuffle($str);
				$novSenha = substr($embaralhado, 0, 8);

				require ('phpmailer/PHPMailerAutoload.php');

				// Instância do objeto PHPMailer
				$mail = new PHPMailer;

				// Configura para envio de e-mails usando SMTP
				$mail->isSMTP();

				// Servidor SMTP
				$mail->Host = 'smtp.gmail.com';

				// Usar autenticação SMTP
				$mail->SMTPAuth = true;

				// Usuário da conta
				$mail->Username = 'speedyjobsetec@gmail.com';

				// Senha da conta
				$mail->Password = 'speedyjobsetec00';

				// Tipo de encriptação que será usado na conexão SMTP
				$mail->SMTPSecure = 'ssl';

				// Porta do servidor SMTP
				$mail->Port = 465;

				// Informa se vamos enviar mensagens usando HTML
				$mail->IsHTML(true);

				// Email do Remetente
				$mail->From = 'speedyjobsetec@gmail.com';

				// Nome do Remetente
				$mail->FromName = 'SpeedyJobs';

				// Endereço do e-mail do destinatário
				$mail->addAddress($email);

				// Assunto do e-mail
				$mail->Subject = 'RECUPERACAO DE SENHA';

				// Mensagem que vai no corpo do e-mail
				$mail->Body = '<h1>Sua nova senha e ' . $novSenha . ' ,tente mudar ela o mais rapido possivel.</h1>';

				// Envia o e-mail e captura o sucesso ou erro
				if($mail->Send()):
				    echo "<script language='javascript' type='text/javascript'>
					alert('Sua nova senha está no seu e-mail.');window.location.href='../login.php';</script>";
				else:
				    echo "<script language='javascript' type='text/javascript'>
					alert('Erro ao enviar e-mail.');window.location.href='../login.php';</script>";
				endif;

				//Atualiza senha no banco
				$novasenhaa = md5($novSenha);
				mysqli_query($con, "UPDATE `tbclientes` SET senha = '$novasenhaa' WHERE  codigo = '$codigoC'");

				mysqli_close($con);//Fecha consulta ao banco

		}else{
			echo "<script language='javascript' type='text/javascript'>
			alert('Você deve confirmar seu e-mail para recuperar sua senha.');window.location.href='../login.php';</script>";
			mysqli_close($con);//Fecha consulta ao banco
			exit();
		}

	}else{
		echo "<script language='javascript' type='text/javascript'>
		alert('E-mail não encontrado.');window.location.href='../login.php';</script>";
		mysqli_close($con);//Fecha consulta ao banco
		exit();
	}

}else if($opcao == "Funcionário"){//Verifica se usuario é FUNCIONARIO

	$busca = mysqli_query($con,"Select * from `tbfuncionarios` where `email` like '$email'");
	$usuario = mysqli_fetch_array($busca);
	$_SESSION['id'] = $usuario['codigo'];//Pega codigo do funcionario
	$_SESSION['status'] = $usuario['statusEmail'];//Pega status de confirmação de email
	$codigoC = $_SESSION['id'];


	$busca = mysqli_query($con,"Select * from `tbfuncionarios` where `email` like '$email'");
	$row = mysqli_num_rows($busca);

	if($row == 1){//Verifica se usuario existe

		if($_SESSION['status'] == 1){//Verifica se usuario confirmou o email

			//Cria nova senha
			$str = "abcdefghijqlmnopqrstuvwxyz1234567890";
			$embaralhado = str_shuffle($str);
			$novSenha = substr($embaralhado, 0, 8);

			require ('phpmailer/PHPMailerAutoload.php');

			// Instância do objeto PHPMailer
			$mail = new PHPMailer;

			// Configura para envio de e-mails usando SMTP
			$mail->isSMTP();

			// Servidor SMTP
			$mail->Host = 'smtp.gmail.com';

			// Usar autenticação SMTP
			$mail->SMTPAuth = true;

			// Usuário da conta
			$mail->Username = 'speedyjobsetec@gmail.com';

			// Senha da conta
			$mail->Password = 'speedyjobsetec00';

			// Tipo de encriptação que será usado na conexão SMTP
			$mail->SMTPSecure = 'ssl';

			// Porta do servidor SMTP
			$mail->Port = 465;

			// Informa se vamos enviar mensagens usando HTML
			$mail->IsHTML(true);

			// Email do Remetente
			$mail->From = 'speedyjobsetec@gmail.com';

			// Nome do Remetente
			$mail->FromName = 'SpeedyJobs';

			// Endereço do e-mail do destinatário
			$mail->addAddress($email);

			// Assunto do e-mail
			$mail->Subject = 'RECUPERACAO DE SENHA';

			// Mensagem que vai no corpo do e-mail
			$mail->Body = '<h1>Sua nova senha e ' . $novSenha . ' ,tente mudar ela o mais rapido possivel.</h1>';

			// Envia o e-mail e captura o sucesso ou erro
			if($mail->Send()):
			    echo "<script language='javascript' type='text/javascript'>
				alert('Sua nova senha está no seu e-mail.');window.location.href='../login.php';</script>";
			else:
			    echo "<script language='javascript' type='text/javascript'>
				alert('Erro ao enviar e-mail.');window.location.href='../login.php';</script>";
				mysqli_close($con);//Fecha consulta ao banco
			endif;

			//Atualiza senha no banco
			$novasenhaa = md5($novSenha);
			mysqli_query($con, "UPDATE `tbfuncionarios` SET senha = '$novasenhaa' WHERE  codigo = '$codigoC'");

			mysqli_close($con);//Fecha consulta ao banco

		}else{
			echo "<script language='javascript' type='text/javascript'>
			alert('Você deve confirmar seu e-mail para recuperar sua senha.');window.location.href='../login.php';</script>";
			mysqli_close($con);//Fecha consulta ao banco
			exit();
		}

	}else{
		echo "<script language='javascript' type='text/javascript'>
		alert('E-mail não encontrado.');window.location.href='../login.php';</script>";
		mysqli_close($con);//Fecha consulta ao banco
		exit();
	}

}else{
	echo "<script language='javascript' type='text/javascript'>
	alert('Selecione seu tipo de conta.');window.location.href='../login.php';</script>";
	exit();
}
?>