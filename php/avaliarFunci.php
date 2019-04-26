<?php
session_start();
include_once("connect.php");

if(isset($_POST['votar'])){
	$codigoo = (int)$_POST['funcionario'];
	$estrela = (int)$_POST['ponto'];


	$lista = mysqli_query($con, "Select tbfuncionarios.classificacao, tbfuncionarios.quantClass from `tbfuncionarios` 
	WHERE tbfuncionarios.codigo = $codigoo");
	
	while($linha = mysqli_fetch_array($lista)){
		$quantidadePontos = $linha['classificacao'];
		$quantidadeClassificacao = $linha["quantClass"];
		$quantidadeFinalPontos = $quantidadePontos + $estrela;
		$quantidadeFinalVotos = $quantidadeClassificacao + 1;

		$avaliacaoTrue = mysqli_query($con, "UPDATE `tbfuncionarios` SET classificacao = '$quantidadeFinalPontos', quantClass = '$quantidadeFinalVotos'
		WHERE  codigo = '$codigoo'");//Atualiza avaliacao

		if($avaliacaoTrue){
			$calculo = round(($quantidadeFinalPontos/$quantidadeFinalVotos),1);
			die(json_encode(array('average' => $calculo, 'votos' => $quantidadeFinalVotos)));
		}
	
	}
}
?>


