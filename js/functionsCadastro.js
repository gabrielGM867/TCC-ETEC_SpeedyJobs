//Mostrar formularios e escode erros deles
    $(function(e){
        $('#janela').show();
        $('#janela2').hide();

        $('#alertTamanhoSenha').hide();
        $('#alertConfirmSenha').hide();
        $('#alertNomeCompleto').hide();
        $('#alertNomeUsuarioVazio').hide();
        $('#alertSexo').hide();
        $('#alertNomeVazio').hide();
        $('#alertEmailVazio').hide();
        $('#alertCPFVazio').hide();
        $('#alertCEPVazio').hide();
        $('#alertRuaVazio').hide();
        $('#alertBairroVazio').hide();
        $('#alertCidadeVazio').hide();
        $('#alertUFVazio').hide();
        $('#alertDataVazio').hide();
        $('#alertTelefone').hide();
        $('#alertCEPNaoEncontrado').hide();
        $('#alertCEPFormato').hide();
        $('#alertProfissaoVazio1').hide();
        $('#alertCPFinvalido').hide();
        $('#alertMaiorIdade').hide();
        $('#alertNome50').hide();
        $('#alertNomeU50').hide();
        $('#alertEmail50').hide();

        $('#cliente').click(mostrarFormularioCliente);
        $('#funcionario').click(mostrarFormularioFuncionario);
    })
//--------------------------------------------------------------//

//Mostra formulario do cliente

    function mostrarFormularioCliente(e){

        $('#alertTamanhoSenha').hide();
        $('#alertConfirmSenha').hide();
        $('#alertNomeCompleto').hide();
        $('#alertNomeUsuarioVazio').hide();
        $('#alertSexo').hide();
        $('#alertNomeVazio').hide();
        $('#alertEmailVazio').hide();
        $('#alertCPFVazio').hide();
        $('#alertCEPVazio').hide();
        $('#alertRuaVazio').hide();
        $('#alertBairroVazio').hide();
        $('#alertCidadeVazio').hide();
        $('#alertUFVazio').hide();
        $('#alertDataVazio').hide();
        $('#alertTelefone').hide();
        $('#alertCEPNaoEncontrado').hide();
        $('#alertCEPFormato').hide();
        $('#alertCPFinvalido').hide();
        $('#alertProfissaoVazio1').hide();
        $('#alertMaiorIdade').hide();
        $('#alertNome50').hide();
        $('#alertNomeU50').hide();
        $('#alertEmail50').hide();


        $('#janela2').hide();
        $('#janela').show();
    };
//------------------------------------------------------------------------------//

//Mostra formulario do funcionario

    function mostrarFormularioFuncionario(e){

        $('#alertTamanhoSenha1').hide();
        $('#alertConfirmSenha1').hide();
        $('#alertNomeCompleto1').hide();
        $('#alertNomeUsuarioVazio1').hide();
        $('#alertSexo1').hide();
        $('#alertNomeVazio1').hide();
        $('#alertEmailVazio1').hide();
        $('#alertCPFVazio1').hide();
        $('#alertProfissaoVazio1').hide();
        $('#alertCEPVazio1').hide();
        $('#alertRuaVazio1').hide();
        $('#alertBairroVazio1').hide();
        $('#alertCidadeVazio1').hide();
        $('#alertUFVazio1').hide();
        $('#alertDataVazio1').hide();
        $('#alertTelefone1').hide();
        $('#alertCEPNaoEncontrado1').hide();
        $('#alertCEPFormato1').hide();
        $('#alertCPFinvalido1').hide();
        $('#alertMaiorIdade1').hide();
        $('#alertNome501').hide();
        $('#alertNomeU501').hide();
        $('#alertEmail501').hide();
        $('#alertPro50').hide();

        $('#janela').hide();
        $('#janela2').show();
    };
//-----------------------------------------------------------------------//
    

//Mascaras para os campos
    function mascara(t, mask){
        var i = t.value.length;
        var saida = mask.substring(1,0);
        var texto = mask.substring(i)

            if (texto.substring(0,1) != saida){
            t.value += texto.substring(0,1);
            }
    }
//------------------------------------------------------------------------//
    

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
//-----------------------------------------------------------------------------//    
    

//Validar CEP FUNCIONARIO
    function limpa_formulário_cep_funci() {
            //Limpa valores do formulário de cep.
            document.getElementById('rua2').value=("");
            document.getElementById('bairro2').value=("");
            document.getElementById('cidade2').value=("");
            document.getElementById('uf2').value=("");
    }

    function meu_callback_funci(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('rua2').value=(conteudo.logradouro);
            document.getElementById('bairro2').value=(conteudo.bairro);
            document.getElementById('cidade2').value=(conteudo.localidade);
            document.getElementById('uf2').value=(conteudo.uf);
        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            $('#alertCEPNaoEncontrado1').show();
        }
    }
        
    function pesquisacepFuncionario(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('rua2').value="...";
                document.getElementById('bairro2').value="...";
                document.getElementById('cidade2').value="...";
                document.getElementById('uf2').value="...";

                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = '//viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback_funci';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                $('#alertCEPFormato1').show();
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    };  
//--------------------------------------------------------------------------//  
    


//Valida CPF
    function validarCPF(cpf) {

        cpf = cpf.replace(/[^\d]+/g,'');    
        if(cpf == '') return false; 
        // Elimina CPFs invalidos conhecidos    
        if (cpf.length != 11 || 
            cpf == "00000000000" || 
            cpf == "11111111111" || 
            cpf == "22222222222" || 
            cpf == "33333333333" || 
            cpf == "44444444444" || 
            cpf == "55555555555" || 
            cpf == "66666666666" || 
            cpf == "77777777777" || 
            cpf == "88888888888" || 
            cpf == "99999999999")
                return false;       
        // Valida 1o digito 
        add = 0;    
        for (i=0; i < 9; i ++)      
            add += parseInt(cpf.charAt(i)) * (10 - i);  
            rev = 11 - (add % 11);  
            if (rev == 10 || rev == 11)     
                rev = 0;    
            if (rev != parseInt(cpf.charAt(9)))     
                return false;       
        // Valida 2o digito 
        add = 0;    
        for (i = 0; i < 10; i ++)       
            add += parseInt(cpf.charAt(i)) * (11 - i);  
        rev = 11 - (add % 11);  
        if (rev == 10 || rev == 11) 
            rev = 0;    
        if (rev != parseInt(cpf.charAt(10)))
            return false;       
        return true;   
    }
//------------------------------------------------------------------------------//

//Valida formulario do Cliente
    function validar_formCliente(){

        var nome=document.forms["formCliente"]["nome"].value;
        var nomeUsuario=document.forms["formCliente"]["nomeUsuario"].value;
        var email=document.forms["formCliente"]["email"].value;
        var cpf=document.forms["formCliente"]["cpf"].value;
        var cep=document.forms["formCliente"]["cep"].value;
        var rua=document.forms["formCliente"]["rua"].value;
        var bairro=document.forms["formCliente"]["bairro"].value;
        var cidade=document.forms["formCliente"]["cidade"].value;
        var uf=document.forms["formCliente"]["uf"].value;
        var dataNas=document.forms["formCliente"]["dataNascimento"].value;
        var tele=document.forms["formCliente"]["telefone"].value;
        var senha=document.forms["formCliente"]["senha"].value;
        var confirmSenha=document.forms["formCliente"]["confirmSenha"].value;
        var tamanhoSenha = senha.length;
        var tamanhoNome = nome.length;
        var tamanhoNomeU = nomeUsuario.length;
        var tamanhoEmail = email.length;
        var count = 0;
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
            window.location.hash = '#alertMaiorIdade';
            return false;
        }

        if (nome==null || nome==""){//Verifica se o nome está vazio
            $('#alertNomeVazio').show();
            window.location.hash = '#alertNomeVazio';
            return false;
        }

        if (tamanhoNome > 50){//Verifica se o máximo de dígitos no nome 
            $('#alertNome50').show();
            window.location.hash = '#alertNome50';
            return false;
        }

        if (nomeUsuario==null || nomeUsuario==""){//Verifica se o nome de usuário está vazio
            $('#alertNomeUsuarioVazio').show();
            window.location.hash = '#alertNomeUsuarioVazio';
            return false;
        }

        if (tamanhoNomeU > 50){//Verifica se o máximo de dígitos no nome usuário 
            $('#alertNomeU50').show();
            window.location.hash = '#alertNomeU50';
            return false;
        }

        if (email==null || email==""){//Verifica se o e-mail está vazio
            $('#alertEmailVazio').show();
            window.location.hash = '#alertEmailVazio';
            return false;
        }

        if (tamanhoEmail > 50){//Verifica se o máximo de dígitos no email 
            $('#alertEmail50').show();
            window.location.hash = '#alertEmail50';
            return false;
        }

        if (cpf==null || cpf==""){//Verifica se o cpf está vazio
            $('#alertCPFVazio').show();
            window.location.hash = '#alertCPFVazio';
            return false;
        }

        if(validarCPF(cpf) == false){ //Valida CPF
            $('#alertCPFinvalido').show();
            window.location.hash = '#alertCPFinvalido';
            return false;
        }

        if (cep==null || cep==""){//Verifica se o cep está vazio
            $('#alertCEPVazio').show();
            window.location.hash = '#alertCEPVazio';
            return false;
        }

        if (rua==null || rua==""){//Verifica se o rua está vazio
            $('#alertRuaVazio').show();
            window.location.hash = '#alertRuaVazio';
            return false;
        }

        if (bairro==null || bairro==""){//Verifica se o bairro está vazio
            $('#alertBairroVazio').show();
            window.location.hash = '#alertBairroVazio';
            return false;
        }

        if (cidade==null || cidade==""){//Verifica se o cidade está vazio
            $('#alertCidadeVazio').show();
            window.location.hash = '#alertCidadeVazio';
            return false;
        }

        if (uf==null || uf==""){//Verifica se o estado está vazio
            $('#alertUFVazio').show();
            window.location.hash = '#alertUFVazio';
            return false;
        }

        if (dataNas==null || dataNas==""){//Verifica se o data nascimento está vazio
            $('#alertDataVazio').show();
            window.location.hash = '#alertDataVazio';
            return false;
        }

        if (tele==null || tele==""){//Verifica se o celular está vazio
            $('#alertTelefone').show();
            window.location.hash = '#alertTelefone';
            return false;
        }

        if (document.formCliente.sexo[0].checked == false && document.formCliente.sexo[1].checked == false) {//Verifica sexo 
            $('#alertSexo').show();
            window.location.hash = '#alertSexo';
            return false;
        }

        for(var i=0; i<nome.length; i++){
            if(nome.charAt(i) == ' ' ){
                count++;   
            }
        }

        if(count < 1){ //Verfica se a pessoa escreveu o Nome Completo
            $('#alertNomeCompleto').show();
            window.location.hash = '#alertNomeCompleto';
            return false;
        }


        if(tamanhoSenha < 8){ // Verifica se a senha tem 8 digitos
            $('#alertTamanhoSenha').show();
            window.location.hash = '#alertTamanhoSenha';
            return false;
        }

        if(senha != confirmSenha){ // verifica se a senha é igual a confirmação
            $('#alertConfirmSenha').show();
            window.location.hash = '#alertConfirmSenha';
            return false;
        }

        return true;
    }
//--------------------------------------------------------------------------------------------//

//Valida formulario do FUNCIONARIO

    function validar_formFunci(){

        var nome=document.forms["formFuncionario"]["nome2"].value;
        var nomeUsuario=document.forms["formFuncionario"]["nomeUsuario2"].value;
        var email=document.forms["formFuncionario"]["email2"].value;
        var profiss = document.forms["formFuncionario"]["profissao"].value;
        var cpf=document.forms["formFuncionario"]["cpf2"].value;
        var cep=document.forms["formFuncionario"]["cep2"].value;
        var rua=document.forms["formFuncionario"]["rua2"].value;
        var bairro=document.forms["formFuncionario"]["bairro2"].value;
        var cidade=document.forms["formFuncionario"]["cidade2"].value;
        var uf=document.forms["formFuncionario"]["uf2"].value;
        var dataNas=document.forms["formFuncionario"]["dataNascimento2"].value;
        var tele=document.forms["formFuncionario"]["telefone2"].value;
        var senha=document.forms["formFuncionario"]["senha2"].value;
        var confirmSenha=document.forms["formFuncionario"]["confirmSenha2"].value;
        var tamanhoSenha = senha.length;
        var tamanhoNome = nome.length;
        var tamanhoNomeU = nomeUsuario.length;
        var tamanhoEmail = email.length;
        var tamanhoPro = profiss.length;
        var count = 0;
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
            $('#alertMaiorIdade1').show();
            window.location.hash = '#alertMaiorIdade1';
            return false;
        } 

        
        if (nome==null || nome==""){//Verifica se o nome está vazio
            $('#alertNomeVazio1').show();
            window.location.hash = '#alertNomeVazio1';
            return false;
        }

        if (tamanhoNome > 50){//Verifica se o máximo de dígitos no nome 
            $('#alertNome501').show();
            window.location.hash = '#alertNome501';
            return false;
        }

        if (nomeUsuario==null || nomeUsuario==""){//Verifica se o nome de usuário está vazio
            $('#alertNomeUsuarioVazio1').show();
            window.location.hash = '#alertNomeUsuarioVazio1';
            return false;
        }

        if (tamanhoNomeU > 50){//Verifica se o máximo de dígitos no nome usuário 
            $('#alertNomeU501').show();
            window.location.hash = '#alertNomeU501';
            return false;
        }

        if (email==null || email==""){//Verifica se o e-mail está vazio
            $('#alertEmailVazio1').show();
            window.location.hash = '#alertEmailVazio1';
            return false;
        }

        if (tamanhoEmail > 50){//Verifica se o máximo de dígitos no email 
            $('#alertEmail501').show();
            window.location.hash = '#alertEmail501';
            return false;
        }

        if (profiss==null || profiss==""){//Verifica se a profissão está vazio
            $('#alertProfissaoVazio1').show();
            window.location.hash = '#alertProfissaoVazio1';
            return false;
        }

        if (tamanhoPro > 50){//Verifica se o máximo de dígitos na profissão 
            $('#alertPro50').show();
            window.location.hash = '#alertPro50';
            return false;
        }

        if (cpf==null || cpf==""){//Verifica se o cpf está vazio
            $('#alertCPFVazio1').show();
            window.location.hash = '#alertCPFVazio1';
            return false;
        }

        if(validarCPF(cpf) == false){//Valida CPF
            $('#alertCPFinvalido1').show();
            window.location.hash = '#alertCPFinvalido1';
            return false;
        }

        if (cep==null || cep==""){//Verifica se o cep está vazio
            $('#alertCEPVazio1').show();
            window.location.hash = '#alertCEPVazio1';
            return false;
        }

            if (rua==null || rua==""){//Verifica se o rua está vazio
            $('#alertRuaVazio1').show();
            window.location.hash = '#alertRuaVazio1';
            return false;
        }

        if (bairro==null || bairro==""){//Verifica se o bairro está vazio
            $('#alertBairroVazio1').show();
            window.location.hash = '#alertBairroVazio1';
            return false;
        }

        if (cidade==null || cidade==""){//Verifica se o cidade está vazio
            $('#alertCidadeVazio1').show();
            window.location.hash = '#alertCidadeVazio1';
            return false;
        }

        if (uf==null || uf==""){//Verifica se o estado está vazio
            $('#alertUFVazio1').show();
            window.location.hash = '#alertUFVazio1';
            return false;
        }

        if (dataNas==null || dataNas==""){//Verifica se o data nascimento está vazio
            $('#alertDataVazio1').show();
            window.location.hash = '#alertDataVazio1';
            return false;
        }

        if (tele==null || tele==""){//Verifica se o celular está vazio
            $('#alertTelefone1').show();
            window.location.hash = '#alertTelefone1';
            return false;
        }

        if (document.formFuncionario.sexo2[0].checked == false && document.formFuncionario.sexo2[1].checked == false) {//Verifica sexo 
            $('#alertSexo1').show();
            window.location.hash = '#alertSexo1';
            return false;
        }

        for(var i=0; i<nome.length; i++){
            if(nome.charAt(i) == ' ' ){
                count++;   
            }
        }

        if(count < 1){ //Verfica se a pessoa escreveu o Nome Completo
            $('#alertNomeCompleto1').show();
            window.location.hash = '#alertNomeCompleto1';
            return false;
        }


        if(tamanhoSenha < 8){ // Verifica se a senha tem 8 digitos
            $('#alertTamanhoSenha1').show();
            window.location.hash = '#alertTamnhoSenha1';
            return false;
        }

        if(senha != confirmSenha){ // verifica se a senha é igual a confirmação
            $('#alertConfirmSenha1').show();
            window.location.hash = '#alertConfirmSenha1';
            return false;
        }

        return true;
    }
//----------------------------------------------------------------------------------//
    
// Para fechar o botão de aviso
var close = document.getElementsByClassName("closebtn");
var i;

// Para fechar todos avisos
for (i = 0; i < close.length; i++) {

        close[i].onclick = function(){
        
        var div = this.parentElement;
        
        div.style.opacity = "0";

        setTimeout(function(){ div.style.display = "none"; }, 600);
    }
}
