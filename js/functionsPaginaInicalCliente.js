//Esconde erros do formulario de postagem de pedidos
document.addEventListener('DOMContentLoaded', function(){
       
        $('#alertServicoVazio').hide();
        $('#alertDescricaoVazio').hide();
        $('#alertServico50').hide();
        $('#alertDescricao100').hide();

    })

//--------------------------------------------//

//Valida formulario de postagem de pedidos

    function validar_formPostarPedido(){

        var servico=document.forms["formPostarPedido"]["servico"].value;
        var descricao=document.forms["formPostarPedido"]["descricao"].value;
        var tamanhoServico = servico.length;
        var tamanhoDes = descricao.length;

        if (servico==null || servico==""){//Verifica se o serviço está vazio
            $('#alertServicoVazio').show();
            
            return false;
        }

        if (descricao==null || descricao==""){//Verifica se a descricao está vazio
            $('#alertDescricaoVazio').show();
            
            return false;
        }

        if (tamanhoServico > 50){//Verifica o máximo de dígitos do tipo de serviço
            $('#alertServico50').show();
            
            return false;
        }

        if (tamanhoDes > 100){//Verifica o máximo de dígitos da descrição
            $('#alertDescricao100').show();
           
            return false;
        }

        return true;
    }
//------------------------------------------------------------------------------------//
