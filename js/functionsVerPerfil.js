//Esconde erros dos formularios
    $(function(e){
        
    	$('#alertNomeVazio').hide();
    	$('#alertNomeCompleto').hide();
    	$('#alertNome50').hide();
        $('#alertEmailVazio').hide();
    	$('#alertEmail50').hide();
    	$('#alertDataVazio').hide();
    	$('#alertMaiorIdade').hide();
    	$('#alertSexo').hide();
    	$('#alertTelefone').hide();
    	$('#alertCEPVazio').hide();
    	$('#alertCEPNaoEncontrado').hide();
        $('#alertCEPFormato').hide();
        $('#alertRuaVazio').hide();
        $('#alertBairroVazio').hide();
        $('#alertCidadeVazio').hide();
        $('#alertUFVazio').hide();
        $('#alertSenhaAntigaVazio').hide();
        $('#alertTamanhoSenha').hide();
        $('#alertConfirmSenha').hide();
        $('#alertFotoVazio').hide();
        $('#alertFotoVazio2').hide();
        $('#alertFotoVazio1').hide();      
    })
//-------------------------------------------------------------------//


//Valida formulario de nome
    function validar_formNome(){

        var nome=document.forms["formNome"]["nome"].value;
        var tamanhoNome = nome.length;
        var count=0;

        if (nome==null || nome==""){//Verifica se o nome está vazio
            $('#alertNomeVazio').show();
            return false;
        }

        for(var i=0; i<nome.length; i++){
            if(nome.charAt(i) == ' ' ){
                count++;   
            }
        }

        if(count < 1){ //Verfica se a pessoa escreveu o Nome Completo
            $('#alertNomeCompleto').show();
            return false;
        }

        if (tamanhoNome > 50){//Verifica se o máximo de dígitos no nome 
            $('#alertNome50').show();
            return false;
        }

        return true;
    }
//----------------------------------------------------------------------------------//

//Valida formualrio de data de nascimento
    function validar_formData(){

        var dataNas=document.forms["formData"]["dataNascimento"].value;
        var data = new Date();

        var partes = dataNas.split("-");
        var diaNas = partes[2]; 
        var mesNas = partes[1]; 
        var anoNas = partes[0];

        var diaAtual = data.getDate();         
        var mesAtual = data.getMonth();        
        var anoAtual = data.getFullYear();       

        var resa = anoAtual - anoNas;
        var resm = mesNas - (mesAtual + 1);
        var resd = diaNas - diaAtual;

        var maior = false;
        
    
        if(resa == 18) {//Verfica se o usuário é maior de idade

            if(resm<0) {
                maior = true;
            }else if(resm == 0){
                if(resd<=0) {
                    maior = true;
                }else{
                maior = false;
                }
            }else {
                maior = false;
            }

        }else if(resa >= 19) {
            maior = true;

        }else{
            maior = false;
        }

        if(maior == false){
            $('#alertMaiorIdade').show();
            return false;
        }

        if (dataNas==null || dataNas==""){//Verifica se o nome está vazio
            $('#alertDataVazio').show();
            return false;
        }

        return true;
    }
//----------------------------------------------------------------------------//

//Valida formulario de sexo

    function validar_formSexo(){

        if (document.formSexo.sexo[0].checked == false && document.formSexo.sexo[1].checked == false) {//Verifica sexo 
            $('#alertSexo').show();
            return false;
        }

        return true;

    }
//----------------------------------------------------------------------------//

//Valida formulario de telefone
    function validar_formNum(){

        var tele=document.forms["formNum"]["telefone"].value;


        if (tele==null || tele==""){//Verifica se o celular está vazio
            $('#alertTelefone').show();
            return false;
        }

        return true;

    }
//---------------------------------------------------------------------------//

//Valida formulario de cep

    function validar_formCEP(){

        var cep=document.forms["formCEP"]["cep"].value;
        var rua=document.forms["formCEP"]["rua"].value;
        var bairro=document.forms["formCEP"]["bairro"].value;
        var cidade=document.forms["formCEP"]["cidade"].value;
        var uf=document.forms["formCEP"]["uf"].value;

        if (cep==null || cep==""){//Verifica se o cep está vazio
            $('#alertCEPVazio').show();
            return false;
        }

        if (rua==null || rua==""){//Verifica se o rua está vazio
            $('#alertRuaVazio').show();
            return false;
        }

        if (bairro==null || bairro==""){//Verifica se o bairro está vazio
            $('#alertBairroVazio').show();
            return false;
        }

        if (cidade==null || cidade==""){//Verifica se o cidade está vazio
            $('#alertCidadeVazio').show();
            return false;
        }

        if (uf==null || uf==""){//Verifica se o estado está vazio
            $('#alertUFVazio').show();
            return false;
        }

        return true;
    }
//----------------------------------------------------------------------//

//Valida formualrio de email
    function validar_formEmail(){

        var email=document.forms["formEmail"]["email"].value;
        var tamanhoEmail = email.length;


        if (email==null || email==""){//Verifica se o e-mail está vazio
            $('#alertEmailVazio').show();
            return false;
        }

        if (tamanhoEmail > 50){//Verifica se o máximo de dígitos no email 
            $('#alertEmail50').show();
            return false;
        }

        return true;
    }

//-------------------------------------------------------------------//

//Valida formulario de senha
    function validar_formSenha(){

        var senha=document.forms["formSenha"]["senha"].value;
        var senhaAnt=document.forms["formSenha"]["senhaAntiga"].value;
        var confirmSenha=document.forms["formSenha"]["confirmSenha"].value;
        var tamanhoSenha = senha.length;

        if (senhaAnt==null || senhaAnt==""){//Verifica se o e-mail está vazio
            $('#alertSenhaAntigaVazio').show();
            return false;
        }

        if(tamanhoSenha < 8){ // Verifica se a senha tem 8 digitos
            $('#alertTamanhoSenha').show();
            return false;
        }

        if(senha != confirmSenha){ // verifica se a senha é igual a confirmação
            $('#alertConfirmSenha').show();
            return false;
        }

        return true;

    }
//----------------------------------------------------------------------------------//

//Valida formulário de foto
    function validar_formFoto(){
        var foto=document.forms["formFoto"]["input_foto"].value;

        if (foto==null || foto==""){//Verifica se a foto está vazio
            $('#alertFotoVazio').show();
            return false;
        }

        return true;
    }
//-----------------------------------------------------------------//

//Valida formulário de foto capa
    function validar_formFotoCapa(){
        var foto=document.forms["formFotoCapa"]["input_fotoCapa"].value;

        if (foto==null || foto==""){//Verifica se a foto está vazio
            $('#alertFotoVazio1').show();
            return false;
        }

        return true;
    }
//-----------------------------------------------------------------//

//Valida formulário de foto
    function validar_formFoto2(){
        var foto=document.forms["formFoto2"]["input_foto"].value;

        if (foto==null || foto==""){//Verifica se a foto está vazio
            $('#alertFotoVazio2').show();
            return false;
        }

        return true;
    }
//-----------------------------------------------------------------//

//Mascaras
    function mascara(t, mask){
        var i = t.value.length;
        var saida = mask.substring(1,0);
        var texto = mask.substring(i)

        if (texto.substring(0,1) != saida){
            t.value += texto.substring(0,1);
        }
    }
//---------------------------------------------------------//


//Validar CEP CLIENTE
    function limpa_formulário_cep_cliente() {
            //Limpa valores do formulário de cep.
            document.getElementById('rua').value=("");
            document.getElementById('bairro').value=("");
            document.getElementById('cidade').value=("");
            document.getElementById('uf').value=("");
    }

    function meu_callback_cliente(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('rua').value=(conteudo.logradouro);
            document.getElementById('bairro').value=(conteudo.bairro);
            document.getElementById('cidade').value=(conteudo.localidade);
            document.getElementById('uf').value=(conteudo.uf);
        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep_cliente();
            $('#alertCEPNaoEncontrado').show();
        }
    }
        
    function pesquisacepCliente(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('rua').value="...";
                document.getElementById('bairro').value="...";
                document.getElementById('cidade').value="...";
                document.getElementById('uf').value="...";

                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = '//viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback_cliente';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                $('#alertCEPFormato').show();
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    };    

//-------------------------------------------------------------------------//