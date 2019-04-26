<?php

	include('connect.php');
	header('Content-Type: text/html; charset=utf-8');

	if(isset($_POST['mensagem'])){

		$mensagem = strip_tags(trim(filter_input(INPUT_POST, 'mensagem', FILTER_SANITIZE_STRING)));
		$de = (int)$_POST['de'];
		$para = (int)$_POST['para'];

		if($mensagem != ''){

			$inserir = "INSERT INTO tbmensagens";
			$inserir .= "(`id_de`, `id_para`, `mensagem`, `time`, `lido`, `visNotificacao`)";
			$inserir .= "VALUES ";
			$inserir .= "('$de', '$para', '$mensagem', ". time() .", 0, 0)";

			$operacao_inserir = mysqli_query ($con, $inserir);

			if($operacao_inserir){
				echo "ok";
			}else{
				echo "no";
			}	
		}
	}else{
		echo "mensagem não encontrada";
	}
	
?>