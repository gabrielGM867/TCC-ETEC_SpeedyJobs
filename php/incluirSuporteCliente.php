<?php
    include('connect.php');

    if(isset($_POST['bt-enviar'])){
        $nome = mysqli_real_escape_string($con, addslashes($_POST['nome']));
        $email = mysqli_real_escape_string($con, addslashes($_POST['email']));
        $assunto = mysqli_real_escape_string($con, addslashes($_POST['opcao']));
        $mensagem = mysqli_real_escape_string($con, addslashes($_POST['mensagem']));
        $codigoo = mysqli_real_escape_string($con, addslashes($_GET['cod']));//Pega código do cliente
        $result = true;
        
        //Verifica campos
        if(empty($_POST['nome'])){
            $result=false;
            echo "<script language='javascript' type='text/javascript'>alert('Erro no campo de nome ');window.location.href='../suporteCliente.php?cod=$codigoo';</script>";
        }

        if(empty($_POST['email'])){
            $result=false;
			echo "<script language='javascript' type='text/javascript'>alert('Erro no campo de e-mail ');window.location.href='../suporteCliente.php?cod=$codigoo';</script>";
        }

        if(empty($_POST['opcao'])){
            $result=false;
			echo "<script language='javascript' type='text/javascript'>alert('Erro no campo de assunto ');window.location.href='../suporteCliente.php?cod=$codigoo';</script>";
        }
        
        if(empty($_POST['mensagem'])){
            $result=false;
			echo "<script language='javascript' type='text/javascript'>alert('Erro no campo de mensagem ');window.location.href='../suporteCliente.php?cod=$codigoo';</script>";
        }

        if($result == true){
        
            //INSERE MENSAGEM
            $inserir = "INSERT INTO tbsuporte";
            $inserir .= "(`codUsuario`, `nome`, `email`, `grupo`, `assunto`,  `mensagem`)";
            $inserir .= "VALUES ";
            $inserir .= "('$codigoo', '$nome', '$email', 'c', '$assunto', '$mensagem')";

            $operacao_inserir = mysqli_query ($con, $inserir);

            if(!$operacao_inserir){
                die("Erro ao inserir mensagem ao banco de dados");

            }else{
                echo "<script language='javascript' type='text/javascript'>
                alert('Dados enviados, irão ser analisados por nossa equipe de suporte.');window.location.href='../suporteCliente.php?cod=$codigoo';</script>";
            }
            //Fecha conexão
            mysqli_close($con);
        }
        
    }else{
        echo "<script language='javascript' type='text/javascript'>
	    alert('Erro ao enviar dados do formulário.');window.location.href='../suporteCliente.php?cod=$codigoo';</script>";
    }

?>