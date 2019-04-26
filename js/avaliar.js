$(function(){
	var average = $('.ratingAverage').attr('data-average');
	function avaliacao(average){
		average = (Number(average)*20);
		if (average == 0){
			$('.star').removeClass('full');
		}

		$('.bg').css('width', 0);		
		$('.barra3 .bg3').animate({width:average+'%'}, 500);
	}
	
	avaliacao(average);

	$('.star').on('mouseover', function(){
		var indexAtual = $('.star').index(this);
		for(var i=0; i<= indexAtual; i++){
			$('.star:eq('+i+')').addClass('full');
		}
	});
	$('.star').on('mouseout', function(){
		$('.star').removeClass('full');
	});


	$('.star').on('click', function(){
		
		var idArticle = $('.article').attr('data-id');
		var voto = $(this).attr('data-vote');
		$.post('php/avaliarFunci.php', {votar: 'sim', funcionario: idArticle, ponto: voto}, function(retorno){
			avaliacao(retorno.average);
			$('.votos span').html(retorno.votos);
		}, 'jSON');
		alert("Obrigado por avaliar.");
		

	});
});