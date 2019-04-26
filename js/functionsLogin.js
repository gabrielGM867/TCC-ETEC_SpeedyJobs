//Esconde erros do formulario 
    $(function(e){
                
        $('#alertEmailVazio').hide();
        $('#alertEmailVazio1').hide();
        $('#alertSenhaVazio').hide();
        $('#alertREVazio').hide();
        
    })
//---------------------------------------------------//


//Valida formulario de login
    function validar_form(){

        var email=document.forms["formLogar"]["email"].value;
        var senha=document.forms["formLogar"]["password"].value;
        
        if (email==null || email==""){//Verifica se o e-mail está vazio
            $('#alertEmailVazio').show();
            window.location.hash = '#alertEmailVazio';
            return false;
        }

        if (senha==null || senha==""){//Verifica se o cpf está vazio
            $('#alertSenhaVazio').show();
            window.location.hash = '#alertSenhaVazio';
            return false;
        }

        if (grecaptcha.getResponse() == ""){
            $('#alertREVazio').show();
            window.location.hash = '#alertREVazio';
            return false;
        }

        return true;
    }
//------------------------------------------------------------//


//Valida formulario de senha
    function validar_formSenha(){

        var email=document.forms["formRecuperar"]["email"].value;

        if (email==null || email==""){//Verifica se o e-mail está vazio
            $('#alertEmailVazio1').show();
            return false;
        }

        return true;
    }

//----------------------------------------------------------------------//
