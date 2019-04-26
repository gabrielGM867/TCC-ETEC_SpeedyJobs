//Pesquisar
function pesquisar(texto){

    $.ajax({
        url:'php/pesquisarCliente.act.php?valor=' + texto,
        success: function(retorno){
            $('#retorno').html(retorno);    
        }
    });
}
//-------------------------------------------------------------------//