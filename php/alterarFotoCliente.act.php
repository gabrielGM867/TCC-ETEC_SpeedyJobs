<?php
include('connect.php');
session_start();
$codigoo = $_SESSION["codiCliente"];//Pega c�digo do cliente

if(isset($_POST['btenviar'])){

	$dados_foto = $_FILES['input_foto'];//Pega a foto
	$nomeFoto = $_FILES['input_foto']['name'];//Pega o nome da foto

	if(isset($_FILES['input_foto'])){

		// Pega a extens�o
	    $extensao = pathinfo ($nomeFoto, PATHINFO_EXTENSION);
	 
	    // Converte a extens�o para min�sculo
	    $extensao = strtolower ( $extensao );

	    // Somente imagens, .jpg;.jpeg;.png;.jfif
	    // Aqui eu enfileiro as extens�es permitidas e separo por ';'
	    // Isso serve apenas para eu poder pesquisar dentro desta String
	    if (strstr( '.jpg;.jpeg;.png;.jfif', $extensao)) {

	    	$foto_salvar = "../fotosUsuarios/".md5($dados_foto['size']).".jpg";
			$novaFoto = "fotosUsuarios/".md5($dados_foto['size']).".jpg";

			if(move_uploaded_file($dados_foto['tmp_name'],$foto_salvar)){

				$fotoTrue = mysqli_query($con, "UPDATE `tbclientes` SET foto = '$novaFoto' WHERE  codigo = '$codigoo'");
				//Atualiza foto
				$_SESSION["fotoCliente"] = $novaFoto;

				if($fotoTrue){
					echo "<script language='javascript' type='text/javascript'>
					alert('Foto alterada com Sucesso.');window.location.href='../verPerfilCliente.php?cod=$codigoo';</script>";
					mysqli_close($con);//Fecha consulta ao banco

				}else{
					echo "<script language='javascript' type='text/javascript'>
					alert('Erro ao alterar foto.');window.location.href='../VerPerfilCliente.php?cod=$codigoo';</script>";
					mysqli_close($con);//Fecha consulta ao banco
				}

			}else{
				echo "<script language='javascript' type='text/javascript'>alert('Erro ao fazer upload de foto.');window.location.href='../verPerfilCliente.php?cod=$codigoo';</script>";
			}     

	    }else{
			echo "<script language='javascript' type='text/javascript'>alert('Formato inv�lido.');window.location.href='../verPerfilCliente.php?cod=$codigoo';</script>";
		}

	}else{
		echo "<script language='javascript' type='text/javascript'>alert('Voc� n�o selecionou nenhuma foto.');window.location.href='../verPerfilCliente.php?cod=$codigoo';</script>";
	}

}else{
	echo "<script language='javascript' type='text/javascript'>
	alert('Erro ao enviar dados do formulario.');window.location.href='../verPerfilCliente.php?cod=$codigoo';</script>";
}
?>	