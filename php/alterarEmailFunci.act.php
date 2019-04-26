<?php
include('connect.php');
session_start();
$codigoo = $_SESSION["codiFunci"];//Pega código do funcionario
$nomeUsuario1 = $_SESSION['nome_usuarioFunci'];//Pega nome de usuario do funcionario

if(isset($_POST['btenviar'])){
	$email1 = mysqli_real_escape_string($con, addslashes($_POST['email']));

	//Verifica se o email mais de 50 dígitos
	$resEmail  = strlen ($email1);
	//-----------------------------------------------------------------------------------//


	//Verifica campo

	if(empty($_POST['email'])){
		echo "<script language='javascript' type='text/javascript'>alert('Erro no campo de email ');window.location.href='../verPerfilFunci.php?cod=$codigoo';</script>";

	}elseif($resEmail > 50){
		echo "<script language='javascript' type='text/javascript'>alert('O email só pode ter 50 caracteres ');window.location.href='../verPerfilFunci.php?cod=$codigoo';</script>";

	}else{

		//Verifica se o EMAIL já existe no Banco

		$query2 = "SELECT * FROM `tbfuncionarios` WHERE email = '$email1'";
		$result2 = mysqli_query($con, $query2);
		$row2 = mysqli_num_rows($result2);
		$registro = false;

		if($row2>0){
			$registro = true; // Se o email já existir o registro fica true
		}

		//-----------------------------------------------------------------//

		if($registro == false){//Verifica se o e-mail já existe


			$emailTrue = mysqli_query($con, "UPDATE `tbfuncionarios` SET email = '$email1', statusEmail = '0'  WHERE  codigo = '$codigoo'");//Atualiza e-mail

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
			$mail->addAddress($email1);

			// Assunto do e-mail
			$mail->Subject = 'CONFIRMAR NOVO E-MAIL';

			// Mensagem que vai no corpo do e-mail
			$mail->Body = '<h1>Ola ' 
			. $nomeUsuario1 . ', voce deve confirmar seu novo e-mail.</h1>
			<h2>Acesse o link abaixo para cofirmar seu novo e-mail.</h2> 
			<P>localhost/ProjetoSpeedyJobs/php/confirmaEmailFunci.act.php?cod=' . $codigoo . '</P>';

			echo "<script language='javascript' type='text/javascript'>
			alert('E-mail alterado com sucesso.');</script>";

			// Envia o e-mail e captura o sucesso ou erro
			if($mail->Send()):
				echo "<script language='javascript' type='text/javascript'>
				alert('Você deve confirmar seu novo e-mail agora.');window.location.href='../verPerfilFunci.php?cod=$codigoo';</script>";//Redireciona usuário para página inicial
				mysqli_close($con);//Fecha consulta ao banco

			else:
				echo "<script language='javascript' type='text/javascript'>
				alert('Erro ao enviar e-mail de confirmação');window.location.href='../VerPerfilFunci.php?cod=$codigoo';</script>";
			endif;

		}else{
			echo "<script language='javascript' type='text/javascript'>
			alert('O e-mail já está cadastrado.');window.location.href='../verPerfilFunci.php?cod=$codigoo';</script>";
		}
	}	

}else{
	echo "<script language='javascript' type='text/javascript'>
	alert('Erro ao enviar dados do formulario.');window.location.href='../verPerfilFunci.php?cod=$codigoo';</script>";
}
?>	