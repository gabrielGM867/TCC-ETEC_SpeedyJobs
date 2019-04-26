<?php
include('connect.php');
session_start();
$codigoo = $_SESSION["codiFunci"];//Pega código do funcionário

if(isset($_POST['btenviar'])){

    $dados_foto = $_FILES['input_foto2'];//Pega a foto
    $nomeFoto = $_FILES['input_foto2']['name'];//Pega o nome da foto

    if(isset($_FILES['input_foto2'])){

        // Pega a extensão
        $extensao = pathinfo ($nomeFoto, PATHINFO_EXTENSION);
     
        // Converte a extensão para minúsculo
        $extensao = strtolower ( $extensao );

        // Somente imagens, .jpg;.jpeg;.png;.jfif
        // Aqui eu enfileiro as extensões permitidas e separo por ';'
        // Isso serve apenas para eu poder pesquisar dentro desta String
        if (strstr( '.jpg;.jpeg;.png;.jfif', $extensao)) {

            $foto_salvar = "../postagemFotos/".md5($dados_foto['size']).".jpg";
            $novaFoto = "postagemFotos/".md5($dados_foto['size']).".jpg";

            if(move_uploaded_file($dados_foto['tmp_name'],$foto_salvar)){


                $inserir = "INSERT INTO tbpostagemfotos";
                $inserir .= "(`codUsuario`, `foto`)";
                $inserir .= "VALUES ";
                $inserir .= "('$codigoo', '$novaFoto')";

                $operacao_inserir = mysqli_query ($con, $inserir);//Insere foto

                if(!$operacao_inserir){
                    die("Erro ao inserir foto ao banco de dados");
                    mysqli_close($con);//Fecha consulta ao banco
                    exit;
                }


                if($operacao_inserir){
                    echo "<script language='javascript' type='text/javascript'>
                    alert('Foto postada com sucesso.');window.location.href='../verPerfilFunci.php?cod=$codigoo';</script>";
                    mysqli_close($con);//Fecha consulta ao banco

                }else{
                    echo "<script language='javascript' type='text/javascript'>
                    alert('Erro ao postar foto.');window.location.href='../VerPerfilFunci.php?cod=$codigoo';</script>";
                    mysqli_close($con);//Fecha consulta ao banco
                }

            }else{
                echo "<script language='javascript' type='text/javascript'>alert('Erro ao fazer upload de foto.');window.location.href='../verPerfilFunci.php?cod=$codigoo';</script>";
            }     

        }else{
            echo "<script language='javascript' type='text/javascript'>alert('Formato inválido.');window.location.href='../verPerfilFunci.php?cod=$codigoo';</script>";
        }

    }else{
        echo "<script language='javascript' type='text/javascript'>alert('Você não selecionou nenhuma foto.');window.location.href='../verPerfilFunci.php?cod=$codigoo';</script>";
    }

}else{
    echo "<script language='javascript' type='text/javascript'>
    alert('Erro ao enviar foto.');window.location.href='../verPerfilFunci.php?cod=$codigoo';</script>";
}
?>  