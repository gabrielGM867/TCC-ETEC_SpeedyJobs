<?php

function verficaCPF($valor){ // função pra validar cpf 
	$n[1] = substr($valor,0,1); // armazena em um vetor os números do cpf
	$n[2] = substr($valor,1,1);
	$n[3] = substr($valor,2,1);
	$n[4] = substr($valor,3,1);
	$n[5] = substr($valor,4,1);
	$n[6] = substr($valor,5,1);
	$n[7] = substr($valor,6,1);
	$n[8] = substr($valor,7,1);
	$n[9] = substr($valor,8,1);
	$n[10] = substr($valor,9,1);
	$n[11] = substr($valor,10,1);

	$soma1 = ($n[1] * 10) + ($n[2] * 9) + ($n[3] * 8) + ($n[4] * 7) + ($n[5] * 6) + ($n[6] * 5) + ($n[7] * 4) + ($n[8] * 3) + ($n[9] * 2); // Variavel de + e * com os números do cpf

	$dgt1 = 11 - ($soma1%11);

	if($dgt1 == 10 or $dgt1==11){

		$dgt1=0;
	}

	$soma2 = ($n[1] * 11) + ($n[2] * 10) + ($n[3] * 9) + ($n[4] * 8) + ($n[5] * 7) + ($n[6] * 6) + ($n[7] * 5) + ($n[8] * 4) + ($n[9] * 3) + ($dgt1*2); 
	// Variavel de + e * com os números do cpf


	$dgt2 = 11 - ($soma2%11);

	if($dgt2 == 10 or $dgt2==11){

		$dgt2=0;
	}


	if($dgt1<>$n[10] or $dgt2<>$n[11]){

		$erro = true;

	}else{
		$erro = false;
	}
	return $erro;// Encerra a função
}

?>

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

if(isset($_POST['btenviar'])){
	$nome1 = mysqli_real_escape_string($con, addslashes($_POST['nome']));
	$nomeUsuario1 = mysqli_real_escape_string($con, addslashes($_POST['nomeUsuario']));
	$email1 = mysqli_real_escape_string($con, addslashes($_POST['email']));
	$cpf1 = mysqli_real_escape_string($con, addslashes($_POST['cpf']));
	$cep1 = mysqli_real_escape_string($con, addslashes($_POST['cep']));
	$rua1 = mysqli_real_escape_string($con, addslashes($_POST['rua']));
	$numero11 = mysqli_real_escape_string($con, addslashes($_POST['numero']));
	$bairro1 = mysqli_real_escape_string($con, addslashes($_POST['bairro']));
	$cidade1 = mysqli_real_escape_string($con, addslashes($_POST['cidade']));
	$estado1 = mysqli_real_escape_string($con, addslashes($_POST['uf']));
	$dataNascimento1 = mysqli_real_escape_string($con, addslashes($_POST['dataNascimento']));
	$telefone1 = mysqli_real_escape_string($con, addslashes($_POST['telefone']));
	$sexo1 = mysqli_real_escape_string($con, addslashes($_POST['sexo']));
	$senha1 = mysqli_real_escape_string($con, addslashes($_POST['senha']));
	$confirmSenha1 = mysqli_real_escape_string($con, addslashes($_POST['confirmSenha']));
	$foto_vazia = "fotosUsuarios/"."user".".png";

	
	//Tira ESPAÇOS E CARACTERES ESPECIAS DAS STRINGS

	$cpf1 = arrumarString($cpf1);	
	$cep1 = arrumarString($cep1);
	$telefone1 = arrumarString($telefone1);
	
	//-----------------------------------------------//

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

	//Verifica se a senha tem no mínimo 8 dígitos
	$resS  = strlen ($senha1);
	//-----------------------------------------------------------------------------------//

	//Verifica se o nome tem mais de 50 dígitos
	$resNome  = strlen ($nome1);
	//-----------------------------------------------------------------------------------//

	//Verifica se o nome de usuario tem mais de 50 dígitos
	$resNomeUsuario  = strlen ($nomeUsuario1);
	//-----------------------------------------------------------------------------------//

	//Verifica se o email mais de 50 dígitos
	$resEmail  = strlen ($email1);
	//-----------------------------------------------------------------------------------//

	if(verficaCPF($cpf1) || 
		$cpf1 == "00000000000" || 
		$cpf1 == "11111111111" || 
		$cpf1 == "22222222222" || 
		$cpf1 == "33333333333" || 
		$cpf1 == "44444444444" || 
		$cpf1 == "55555555555" || 
		$cpf1 == "66666666666" || 
		$cpf1 == "77777777777" || 
		$cpf1 == "88888888888" || 
		$cpf1 == "99999999999"){//Verfica se o cpf é válido

		echo "<script language='javascript' type='text/javascript'>alert('CPF inválido.');window.location.href='../cadastro.php';</script>";
		exit;
		
	}else{

		//Verifica campos

		if(empty($_POST['nome'])){
			echo "<script language='javascript' type='text/javascript'>alert('Erro no campo de nome ');window.location.href='../cadastro.php';</script>";
		}

		if(empty($_POST['nomeUsuario'])){
			echo "<script language='javascript' type='text/javascript'>alert('Erro no campo de nome de usuário ');window.location.href='../cadastro.php';</script>";
		}

		if(empty($_POST['email'])){
			echo "<script language='javascript' type='text/javascript'>alert('Erro no campo de e-mail ');window.location.href='../cadastro.php';</script>";
		}

		if(empty($_POST['cpf'])){
			echo "<script language='javascript' type='text/javascript'>alert('Erro no campo de cpf ');window.location.href='../cadastro.php';</script>";
		}

		if(empty($_POST['cep'])){
			echo "<script language='javascript' type='text/javascript'>alert('Erro no campo de cep ');window.location.href='../cadastro.php';</script>";
		}

		if(empty($_POST['rua'])){
			echo "<script language='javascript' type='text/javascript'>alert('Erro no campo de rua ');window.location.href='../cadastro.php';</script>";
		}

		if(empty($_POST['bairro'])){
			echo "<script language='javascript' type='text/javascript'>alert('Erro no campo de bairro ');window.location.href='../cadastro.php';</script>";
		}

		if(empty($_POST['cidade'])){
			echo "<script language='javascript' type='text/javascript'>alert('Erro no campo de cidade ');window.location.href='../cadastro.php';</script>";
		}

		if(empty($_POST['uf'])){
			echo "<script language='javascript' type='text/javascript'>alert('Erro no campo de estado ');window.location.href='../cadastro.php';</script>";
		}

		if(empty($_POST['dataNascimento'])){
			echo "<script language='javascript' type='text/javascript'>alert('Selecione uma data de nascimento ');window.location.href='../cadastro.php';</script>";
		}

		if(empty($_POST['telefone'])){
			echo "<script language='javascript' type='text/javascript'>alert('Erro no campo de telefone ');window.location.href='../cadastro.php';</script>";
		}

		if(empty($_POST['sexo'])){
			echo "<script language='javascript' type='text/javascript'>alert('Erro no campo de sexo ');window.location.href='../cadastro.php';</script>";
		}

		if(empty($_POST['senha'])){
			echo "<script language='javascript' type='text/javascript'>alert('Erro no campo de senha ');window.location.href='../cadastro.php';</script>";
		}

		if(empty($_POST['confirmSenha'])){
			echo "<script language='javascript' type='text/javascript'>alert('Erro no campo de confirmar senha ');window.location.href='../cadastro.php';</script>";
		}

		if($resNome > 50){
			echo "<script language='javascript' type='text/javascript'>alert('O nome só pode ter no máximo 50 caracteres ');window.location.href='../cadastro.php';</script>";
		}

		if($resNomeUsuario > 50){
			echo "<script language='javascript' type='text/javascript'>alert('O nome de usuario só pode ter no máximo 50 caracteres ');window.location.href='../cadastro.php';</script>";
		}

		if($resEmail > 50){
			echo "<script language='javascript' type='text/javascript'>alert('O email só pode ter 50 caracteres ');window.location.href='../cadastro.php';</script>";
		}

		//-----------------------------------------------------------------//

		//Verifica se o EMAIL já existe no Banco

		$query2 = "SELECT * FROM `tbclientes` WHERE email = '$email1'";
		$result2 = mysqli_query($con, $query2);
		$row2 = mysqli_num_rows($result2);
		$registro = false;

		if($row2>0){
			$registro = true; // Se o email já existir o registro fica true
		}

		//-----------------------------------------------------------------//

		//Verifica se o NOME DE USUÁRIO já existe no Banco

		$query3 = "SELECT * FROM `tbclientes` WHERE nomeUsuario = '$nomeUsuario1'";
		$result3 = mysqli_query($con, $query3);
		$row3 = mysqli_num_rows($result3);
		$registro3 = false;

		if($row3>0){
			$registro3 = true; // Se o nome usuario já existir o registro fica true
		}

		$query11 = "SELECT * FROM `tbfuncionarios` WHERE nomeUsuario = '$nomeUsuario1'";
		$result11 = mysqli_query($con, $query11);
		$row11 = mysqli_num_rows($result11);
		$registro11 = false;

		if($row11>0){
			$registro11 = true; // Se o nome usuario já existir o registro fica true
		}

		//-----------------------------------------------------------------//
		
		//Verifica se o CPF já existe no Banco

		$query4 = "SELECT * FROM `tbclientes` WHERE cpf = '$cpf1'";
		$result4 = mysqli_query($con, $query4);
		$row4 = mysqli_num_rows($result4);
		$registro4 = false;

		if($row4>0){
			$registro4 = true; // Se o cpf já existir o registro fica true
		}

		//-----------------------------------------------------------------//

		//Verifica se a pessoa escreveu seu NOME COMPLETO

		$resgistro5 = false;
		if(strrpos($nome1, " ") >= 2){
			$resgistro5 = true;//Se existir dois ou espaços ou mais o registro fica true
		}

		//-----------------------------------------------------------------//
		
		if($senha1 == $confirmSenha1){//Verifica se a senha e igual a confirmação de senha
			if($maior == true){//Verfica se o usuário é maior de idade
				if($resS >= 8){//Verifica se a senha possui 8 digitos
					if($registro == false){//Verifica se o e-mail já existe
						if($registro3 == false and $registro11 == false){//Verifica se o nome de usuario já existe
							if($registro4 == false){//Verifica se o cpf já existe
								if($resgistro5 == true){//Verifica se a pessoa escreveu seu NOME COMPLETO

									$senha1 = md5($senha1);//Criptografa SENHA

									
									//INSERE USUÁRIO

									$inserir = "INSERT INTO tbclientes";
									$inserir .= "(`nome`, `nomeUsuario`, `email`, `cpf`, `dataNascimento`,  `sexo`, `senha`, 
									`foto`, `fotoCapa`, `statusEmail`)";
									$inserir .= "VALUES ";
									$inserir .= "('$nome1', '$nomeUsuario1', '$email1', '$cpf1', '$dataNascimento1', '$sexo1', '$senha1', 
									'$foto_vazia', '0', '0')";

									$operacao_inserir = mysqli_query ($con, $inserir);

									if(!$operacao_inserir){
										die("Erro ao inserir usuario ao banco de dados");
									}

									//------------------------------------------------------------------//

									//INSERIR TELEFONE e ENDEREÇO

									//Encontra maior codigo de cliente
									$maiorCodigo = "select max(codigo) as maiorCod from tbclientes";
									$resultado_maiorcodigo = mysqli_query ($con, $maiorCodigo);
									$row = mysqli_fetch_array($resultado_maiorcodigo);
									$row[0] = "";
									$row[1] = "";
									$str = implode("", $row);

									//-----------------------------------------------------------//

									//INSERIR USARIO NO CHAT

									$inserirClienteNoChat = "INSERT INTO tbusuarioschat";
									$inserirClienteNoChat .= "(`codUsuario`, `grupo`)";
									$inserirClienteNoChat .= "VALUES ";
									$inserirClienteNoChat .= "('$str', 'c')";

									$operacapInserirClienteChat = mysqli_query ($con, $inserirClienteNoChat);

									if(!$operacapInserirClienteChat){
										die("Erro ao inserir usuario na tabela usuarios chat");

									}

									//Encontra maior codigo de cliente no chat
									$maiorCodigo = "select max(codigo) as maiorCod from tbusuarioschat WHERE tbusuarioschat.grupo = 'c'";
									$resultado_maiorcodigo = mysqli_query ($con, $maiorCodigo);
									$row = mysqli_fetch_array($resultado_maiorcodigo);
									$row[0] = "";
									$row[1] = "";
									$codigoChatt = implode("", $row);


									$senhaTrue = mysqli_query($con, "UPDATE `tbclientes` SET codtbUsuarios = '$codigoChatt' WHERE  codigo = '$str'");//Coloca codigo do chat na tabela de clientes

									if(!$senhaTrue){
										die("Erro ao colocar código da tabela chat na tabela clientes.");

									}

									//--------------------------------------------------------------------------//

									//Insere o telefone

									$inserir = "INSERT INTO tbtelefonescliente";
									$inserir .= "(`codCliente`, `numero`, `tipo`)";
									$inserir .= "VALUES ";
									$inserir .= "('$str', '$telefone1', 'Celular')";

									$operacao_inserir = mysqli_query ($con, $inserir);

									if(!$operacao_inserir){
										die("Erro ao inserir telefone ao banco de dados");
									}

									//--------------------------------------------------------------//

									//Insere o endereço

									$inserir = "INSERT INTO tbenderecocliente";
									$inserir .= "(`codCliente`, `cep`, `rua`, `numero`, `bairro`, `cidade`, `estado`)";
									$inserir .= "VALUES ";
									$inserir .= "('$str', '$cep1', '$rua1', '$numero11', '$bairro1', '$cidade1', '$estado1')";

									$operacao_inserir = mysqli_query ($con, $inserir);

									if(!$operacao_inserir){
										die("Erro ao inserir endereco ao banco de dados");
									}

									//--------------------------------------------------------------//



									$busca = mysqli_query($con,"Select * from `tbclientes` where codigo = '$str' ");
									$usuario = mysqli_fetch_array($busca);

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
									$mail->Subject = 'CONFIRMAR E-MAIL';

									// Mensagem que vai no corpo do e-mail
									$mail->Body = '<h1>Ola ' 
									. $nomeUsuario1 . ', obrigado por criar uma conta no SpeedyJobs.</h1>
									<h2>Acesse o link abaixo para cofirmar seu e-mail.</h2> 
									<P>localhost/ProjetoSpeedyJobs/php/confirmaEmailCliente.act.php?cod=' . $str . '</P>';

									echo "<script language='javascript' type='text/javascript'>
									alert('Cadastro concluído.');</script>";

									// Envia o e-mail e captura o sucesso ou erro
									if($mail->Send()):
										echo "<script language='javascript' type='text/javascript'>
										alert('Você deve confirmar seu e-mail agora.');window.location.href='../index.php';</script>";//Redireciona usuário para página de login
										mysqli_close($con);//Fecha consulta ao banco

									else:
										echo "<script language='javascript' type='text/javascript'>
										alert('Erro ao enviar e-mail de confirmação');window.location.href='../cadastro.php';</script>";
									endif;

								}else{
									echo "<script language='javascript' type='text/javascript'>
									alert('Escreva seu nome completo');window.location.href='../cadastro.php';</script>";

								}		
							}else{
								echo "<script language='javascript' type='text/javascript'>
								alert('O CPF já está cadastrado.');window.location.href='../cadastro.php';</script>";
								
							}
							
						}else{
							echo "<script language='javascript' type='text/javascript'>
							alert('O nome de usuário já está cadastrado.');window.location.href='../cadastro.php';</script>";
						}

					}else{
						echo "<script language='javascript' type='text/javascript'>
						alert('O e-mail já está cadastrado.');window.location.href='../cadastro.php';</script>";
					}

				}else{
					echo "<script language='javascript' type='text/javascript'>
					alert('A senha deve ter no mínimo 8 dígitos.');window.location.href='../cadastro.php';</script>";
				}

			}else{
				echo "<script language='javascript' type='text/javascript'>
				alert('Não é permitido o cadstro de menores de idade.');window.location.href='../cadastro.php';</script>";
			}

		}else{
			echo "<script language='javascript' type='text/javascript'>
			alert('Senha inválida.');window.location.href='../cadastro.php';</script>";
		}
	}
}else{
	echo "<script language='javascript' type='text/javascript'>
	alert('Erro ao enviar dados do formulario.');window.location.href='../cadastro.php';</script>";
}
?>