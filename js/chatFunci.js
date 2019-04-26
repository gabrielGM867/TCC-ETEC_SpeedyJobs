
jQuery(function(){
	var userOnline = Number(jQuery('li.nome').attr('id'));
	var clicou = [];

	function in_array(valor, array){
		for(var i =0; i<array.length;i++){
			if(array[i] == valor){
				return true;
			}
		}

		return false;
	}

	function add_janela(id, nome){
		var pixels = 10;
		var style = 'float:none; position:absolute; bottom:0; left:'+pixels+'px';

		var splitDados = id.split(':');
		var id_user = Number(splitDados[1]);

		var janela = '<div class="window" id="janela_'+id_user+'" style="'+style+'">';
		janela += '<div class="header_window"><a href="#" class="close" title="Fechar">X</a> <span class="name">'+nome+'</span> <span id="'+id_user+'"></span></div>';
		janela += '<div class="body"><div class="mensagens"><ul></ul></div>';
		janela += '<div class="send_message" id="'+id+'"><input type="text" name="mensagem" class="msg" id="'+id+'" /></div></div></div>';

		jQuery('#chats').append(janela);
	}


	//RETORNA MENSAGENS
	function retorna_historico(id_conversa){
		$.ajax({
			url: 'php/historico.php?conversacom='+id_conversa+"&online="+userOnline,
			success: function(retorno){
				jQuery.each(JSON.parse(retorno), function(i, msg){
					if(jQuery('#janela_'+msg.janela_de).length > 0){
						if(userOnline == msg.id_de){
							jQuery('#janela_'+msg.janela_de+' .mensagens ul').append('<li id="'+msg.id+'" class="eu"><p>'+msg.mensagem+'</p></li>');
						}else{
							jQuery('#janela_'+msg.janela_de+' .mensagens ul').append('<li id="'+msg.id+'"><div class="imgSmall"><img src="'+msg.fotoUser+'" /></div><p>'+msg.mensagem+'</p></li>');
						}
					}
				});

				[].reverse.call(jQuery('#janela_'+id_conversa+' .mensagens li')).appendTo(jQuery('#janela_'+id_conversa+' .mensagens ul'));
				jQuery('#janela_'+id_conversa+' .mensagens').animate({scrollTop: 230}, '500');		
			}		
		});
	}

	//ABRIR JANELA

	jQuery('#resMsg').on('click', '#users_online a', function(){
		var id = jQuery(this).attr('id');

		var splitIds = id.split(':');
		var idJanela = Number(splitIds[1]);

		if(jQuery('#janela_'+idJanela).length == 0){
			var nome = jQuery(this).attr('title');
			add_janela(id, nome);
			retorna_historico(idJanela);
		}

	});

	//ABRIR JANELA

   jQuery('body').on('click', '#users_online a', function(){
        var id = jQuery(this).attr('id');

        var splitIds = id.split(':');
        var idJanela = Number(splitIds[1]);
        if(jQuery('#janela_'+idJanela).length == 0){
            var nome = jQuery(this).attr('title');
            add_janela(id, nome);
            retorna_historico(idJanela);
        }

    });

	//MINIMIZAR JANELA

	jQuery('body').on('click', '.header_window', function(){
		var next = jQuery(this).next();
		next.toggle(100);
	});

	//FECHAR JANELA

	jQuery('body').on('click', '.close', function(){
		var parent = jQuery(this).parent().parent();
		var idParent = parent.attr('id');
		var splitParent = idParent.split('_');
		var idJanelaFechada = Number(splitParent[1]);

		var contagem = Number(jQuery('.window').length)-1;
		var indice = Number(jQuery('.close').index(this));
		var restamAfrente = contagem-indice;

		for(var i = 1; i <= restamAfrente; i++){
			jQuery('.window:eq('+(indice+i)+')').animate({left:"-=275"}, 200);
		}
		parent.remove();
		jQuery('#users_online li#'+idJanelaFechada+' a').addClass('comecar');
	});

	//ENVIA MENSAGEM

	jQuery('body').on('keyup', '.msg', function(e){
		if(e.which == 13){
			var texto = jQuery(this).val();
			var id = jQuery(this).attr('id');
			var split = id.split(':');
			var para = Number(split[1]);

			jQuery.ajax({
				type: 'POST',
				url: 'php/enviarMensagem.act.php',
				data: {mensagem: texto, de: userOnline, para: para},
				success: function(retorno){
					if(retorno == 'ok'){
						jQuery('.msg').val('');
					}else{
						alert("Ocorreu um erro ao enviar a mensagem");
					}
				}
			});
		}
	});

	//MARCA SE A PESSOA JÁ LEU A MENSAGEM

	jQuery('body').on('click', '.mensagens', function(){
		var janela = jQuery(this).parent().parent();
		var janelaId = janela.attr('id');
		var idConversa = janelaId.split('_');
		idConversa = Number(idConversa[1]);

		jQuery.ajax({
			url: 'php/ler.php',
			type: 'POST',
			data: {ler: 'sim', online: userOnline, user: idConversa},
			success: function(retorno){}
		});
	});

	function verifica(timestamp, lastid, user){
		var t;
		jQuery.ajax({
			url: 'php/stream.php',
			type: 'GET',
			data: 'timestamp='+timestamp+'&lastid='+lastid+'&user='+user,
			dataType: 'json',
			success: function(retorno){
				clearInterval(t);
				if(retorno.status == 'resultados' || retorno.status == 'vazio'){
					t =setTimeout(function(){
						verifica(retorno.timestamp, retorno.lastid, userOnline);
					},1000);

					if(retorno.status == 'resultados'){
						jQuery.each(retorno.dados, function(i, msg){

							if(jQuery('#janela_'+msg.janela_de).length == 0){
								jQuery('#users_online #'+msg.janela_de+' .comecar').click();
								clicou.push(msg.janela_de);
							}

							if(!in_array(msg.janela_de, clicou)){
								if(jQuery('.mensagens ul li#'+msg.id).length == 0 && msg.janela_de > 0){
									if(userOnline == msg.id_de){
										jQuery('#janela_'+msg.janela_de+' .mensagens ul').append('<li class="eu" id="'+msg.id+'"><p>'+msg.mensagem+'</p></li>');
									}else{
										jQuery('#janela_'+msg.janela_de+' .mensagens ul').append('<li id="'+msg.id+'"><div class="imgSmall"><img src="'+msg.fotoUser+'" border="0"/></div><p>'+msg.mensagem+'</p></li>');
									}
								}
							}
						});
						jQuery('.mensagens').animate({scrollTop: 230}, '500');
						console.log(clicou);
					}
					clicou = [];	
				}else if(retorno.status == 'erro'){
					alert('Ficamos confusos, atualize a pagina');
				}
			},
			error: function(){
				clearInterval(t);
				t=setTimeout(function(){
					verifica(retorno.timestamp, retorno.lastid, userOnline);
				},15000);
			}
		});
	}

	verifica(0,0,userOnline);
});
