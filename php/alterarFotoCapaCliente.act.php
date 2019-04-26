<?php
include('connect.php');
session_start();
$codigoo = $_SESSION["codiCliente"];//Pega código do cliente

if(isset($_POST['btenviar'])){

	$dados_foto = $_FILES['input_fotoCapa'];//Pega a foto
	$nomeFoto = $_FILES['input_fotoCapa']['name'];//Pega o nome da foto

	if(isset($_FILES['input_fotoCapa'])){

		// Pega a extensão
	    $extensao = pathinfo ($nomeFoto, PATHINFO_EXTENSION);
	 
	    // Converte a extensão para minúsculo
	    $extensao = strtolower ( $extensao );

	    // Somente imagens, .jpg;.jpeg;.png;.jfif
	    // Aqui eu enfileiro as extensões permitidas e separo por ';'
	    // Isso serve apenas para eu poder pesquisar dentro desta String
	    if (strstr( '.jpg;.jpeg;.png;.jfif', $extensao)) {

	    	$foto_salvar = "../fotosUsuarios/fotosCapa/".md5($dados_foto['size']).".jpg";
			$novaFoto = "fotosUsuarios/fotosCapa/".md5($dados_foto['size']).".jpg";

			if(move_uploaded_file($dados_foto['tmp_name'],$foto_salvar)){

				$fotoTrue = mysqli_query($con, "UPDATE `tbclientes` SET fotoCapa = '$novaFoto' WHERE  codigo = '$codigoo'");

				if($fotoTrue){
					echo "<script language='javascript' type='text/javascript'>
					alert('Foto de capa alterada com Sucesso.');window.location.href='../verPerfilCliente.php?cod=$codigoo';</script>";
					mysqli_close($con);//Fecha consulta ao banco

				}else{
					echo "<script language='javascript' type='text/javascript'>
					alert('Erro ao alterar foto de capa.');window.location.href='../VerPerfilCliente.php?cod=$codigoo';</script>";
					mysqli_close($con);//Fecha consulta ao banco
				}

			}else{
				echo "<script language='javascript' type='text/javascript'>alert('Erro ao fazer upload da foto.');window.location.href='../verPerfilCliente.php?cod=$codigoo';</script>";
			}     

	    }else{
			echo "<script language='javascript' type='text/javascript'>alert('Formato inválido.');window.location.href='../verPerfilCliente.php?cod=$codigoo';</script>";
		}

	}else{
		echo "<script language='javascript' type='text/javascript'>alert('Você não selecionou nenhuma foto.');window.location.href='../verPerfilCliente.php?cod=$codigoo';</script>";
	}

}else{
	echo "<script language='javascript' type='text/javascript'>
	alert('Erro ao enviar dados do formulario.');window.location.href='../verPerfilCliente.php?cod=$codigoo';</script>";
}
?>	