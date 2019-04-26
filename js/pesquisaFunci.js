//Pesquisa de funcionario
function pesquisar(texto){

    $.ajax({
        url:'php/pesquisarFunci.act.php?valor=' + texto,
        success: function(retorno){
            $('#retorno').html(retorno);	
        }
    });
}
//--------------------------------------------//