//Mascaras para os campos
function moeda(a, e, r, t) {
    let n = ""
      , h = j = 0
      , u = tamanho2 = 0
      , l = ajd2 = ""
      , o = window.Event ? t.which : t.keyCode;
    if (13 == o || 8 == o)
        return !0;
    if (n = String.fromCharCode(o),
    -1 == "0123456789".indexOf(n))
        return !1;
    for (u = a.value.length,
    h = 0; h < u && ("0" == a.value.charAt(h) || a.value.charAt(h) == r); h++)
        ;
    for (l = ""; h < u; h++)
        -1 != "0123456789".indexOf(a.value.charAt(h)) && (l += a.value.charAt(h));
    if (l += n,
    0 == (u = l.length) && (a.value = ""),
    1 == u && (a.value = "0" + r + "0" + l),
    2 == u && (a.value = "0" + r + l),
    u > 2) {
        for (ajd2 = "",
        j = 0,
        h = u - 3; h >= 0; h--)
            3 == j && (ajd2 += e,
            j = 0),
            ajd2 += l.charAt(h),
            j++;
        for (a.value = "",
        tamanho2 = ajd2.length,
        h = tamanho2 - 1; h >= 0; h--)
            a.value += ajd2.charAt(h);
        a.value += r + l.substr(u - 2, u)
    }
    return !1
}
//------------------------------------------------------------------------//

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



$(function(){
	
	var atual_fs, next_fs, prev_fs;
	var formulario = $('form[name=formulario]');

		function next(elem){
		atual_fs = $(elem).parent();
		next_fs = $(elem).parent().next();


		$('#progress li').eq($('fieldset').index(next_fs)).addClass('ativo');
		atual_fs.hide(800);
		next_fs.show(800);
		}

	$('.prev').click(function(){
		atual_fs = $(this).parent();
		prev_fs = $(this).parent().prev();


		$('#progress li').eq($('fieldset').index(atual_fs)).removeClass('ativo');
		atual_fs.hide(800);
		prev_fs.show(800);
	});

	$('input[name=next1]').click(function(){
		var array = formulario.serializeArray();
	

			if(array[0].value == '' || array[1].value == '' || array[2].value == '' || array[3].value == '' || array[4].value == ''){
				$('.resp').html('<div class="erros"><p>Para continuar, preencha os dados da 1ª etapa!</p></div>');
			}else{
				$('.resp').html('');
				next($(this));
			}
		
	});

		$('input[name=next2]').click(function(){
			var array = formulario.serializeArray();

				if(array[5].value == '' || array[6].value == '' || array[7].value == ''){
					$('.resp').html('<div class="erros"><p>Para continuar, preencha os dados da 2ª etapa!</p></div>');
				}else{
					$('.resp').html('');


					next($(this));
				}
		
		});

		$('#botaoSubmit').click(function(){
			event.preventDefault();
			var array = formulario.serializeArray();
			
				if(array[8].value == '' || array[9].value == '' || array[10].value == ''){
					$('.resp').html('<div class="erros"><p>Para continuar, preencha os dados da 3ª etapa!</p></div>');
				}else{

					if(array[5].value != array[8].value || array[6].value != array[9].value || array[7].value != array[10].value){
						$('.resp').html('<div class="erros"><p>Os dados bancários não estão iguais a sua confirmação</p></div>');
					}else{
						 document.formulario.submit();
					}
					
				}
			
		});

    
})