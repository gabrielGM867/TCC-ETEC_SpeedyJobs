<?php

	$con = mysqli_connect("localhost", "root", "", "bd_speedyjobs");

	if( mysqli_connect_errno() ){
		die("Conexão falhou: " . mysqli_connect_errno() );
	}

	if(!$con = mysqli_connect("localhost",'root','')){
		echo "Erro ao se conectar ao banco de dados!";
	}
	
	if(!mysqli_select_db($con,'bd_speedyjobs')){
		echo "Erro ao selecionar a base de dados";
	}

	mysqli_query($con,"SET NAMES utf8");

?>