<?php
session_start();
if(isset($_SESSION)){

    if(isset($_SESSION['usuarioCliente'])){
        if($_SESSION['loginCliente'] == true){
            header("location:paginaInicialCliente.php");
        }else{}
    }else{}

    if(isset($_SESSION['usuarioFunci'])){
        if($_SESSION['loginFunci'] == true){
            header("location:paginaInicialFunci.php");
        }else{}
    }else{}
}
?>