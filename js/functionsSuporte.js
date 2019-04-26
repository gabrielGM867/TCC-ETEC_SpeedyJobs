//Esconde erros dos formularios
$(function(e){
        
    $('#alertNomeVazio').hide();
    $('#alertEmailVazio').hide();
    $('#alertAssuntoVazio').hide();
    $('#alertMensagemVazio').hide();
 
})
//-------------------------------------------------------------------//

//Valida formularios 
function validar_formCliente(){

    var nome=document.forms["formCliente"]["nome"].value;
    var email=document.forms["formCliente"]["email"].value;
    var mensagem=document.forms["formCliente"]["mensagem"].value;

    if (nome==null || nome==""){//Verifica se o nome está vazio
        $('#alertNomeVazio').show();
        window.location.hash = '#alertNomeVazio';
        return false;
    }

    if (email==null || email==""){//Verifica se o email está vazio
        $('#alertEmailVazio').show();
        window.location.hash = '#alertEmailVazio';
        return false;
    }

    if (document.formCliente.opcao[0].checked == false && document.formCliente.opcao[1].checked == false
        && document.formCliente.opcao[2].checked == false && document.formCliente.opcao[3].checked == false) {//Verifica sexo 
        $('#alertAssuntoVazio').show();
        window.location.hash = '#alertAssuntoVazio';
        return false;
    }

    if (mensagem==null || mensagem==""){//Verifica se a mensagem está vazia
        $('#alertMensagemVazio').show();
        window.location.hash = '#alertMensagemVazio';
        return false;
    }

    return true;
}
//----------------------------------------------------------------------------------//

//Valida formularios 
function validar_formFunci(){

    var nome=document.forms["formFunci"]["nome"].value;
    var email=document.forms["formFunci"]["email"].value;
    var mensagem=document.forms["formFunci"]["mensagem"].value;
   
    if (nome==null || nome==""){//Verifica se o nome está vazio
        $('#alertNomeVazio').show();
        window.location.hash = '#alertNomeVazio';
        return false;
    }

    if (email==null || email==""){//Verifica se o email está vazio
        $('#alertEmailVazio').show();
        window.location.hash = '#alertEmailVazio';
        return false;
    }

    if (document.formCliente.opcao[0].checked == false && document.formCliente.opcao[1].checked == false
        && document.formCliente.opcao[2].checked == false && document.formCliente.opcao[3].checked == false) {//Verifica sexo 
        $('#alertAssuntoVazio').show();
        window.location.hash = '#alertAssuntoVazio';
        return false;
    }

    if (mensagem==null || mensagem==""){//Verifica se a mensagem está vazia
        $('#alertMensagemVazio').show();
        window.location.hash = '#alertMensagemVazio';
        return false;
    }

    return true;
}
//----------------------------------------------------------------------------------//

