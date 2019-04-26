<?php

$texto = $_GET['valor'];

include('connect.php');

if(empty($_GET['valor'])){//Verifica se o textos pesquisado está vazio

	echo "";//Se estiver vázio ele não faz nada

}else{//Senao estiver vazio ele faz a pesquisa no banco pelo nome de usuario ou a profissao 

	$lista = mysqli_query($con, "Select * from `tbfuncionarios` where `nomeUsuario` like '%$texto%' or `profissao` 
		like '%$texto%'");//Pesquisa

	if(mysqli_num_rows($lista) > 0 ){//Verifica resultado da pesquisa
		
	
		while($linha = mysqli_fetch_array($lista)){//Mostra resultado
		
			echo "
				
				<div class=box1>
					<p><img src=$linha[foto] class=foto_box1 ></p>
					<p>Usuário: $linha[nomeUsuario]</p>
					<p>Profissão: $linha[profissao]</p>
					<div class=botao1 title='Visitar Perfil'>
					<a href=clienteVerPerfilFunci.php?cod=$linha[codigo]>Visitar Perfil</a></div>
				</div>
			";	
		}

	}else{//Senao encontrar nada ele faz isso

		echo "
			
			<div class=box1>
				<p>Nenhum resultado encontrado.</p>
			</div>
			
		";
	}

}

?>