$(function(){

	var open  = true;
	// Pega o tamanho da tela
	var windowSize = $(window)[0].innerWidth;
	var targetSizeMenu = (windowSize <= 400) ? 200 : 250;
	// Operação com a tela <= 768px
	if(windowSize <= 768){
		$('.menu').css('width','0').css('padding','0');
		open = false;
	}
	// Controle do menu lateral
	$('.menu-btn').click(function(){
		if(open){
			//O menu está aberto, precisamos fechar e adaptar nosso conteudo geral do painel
			$('.menu').animate({'width':0,'padding':0},function(){
				open = false;
			});
			$('.content,header').css('width','100%');
			$('.content,header').animate({'left':0},function(){
				open = false;
			});
		}else{
			//O menu está fechado
			$('.menu').css('display','block');
			$('.menu').animate({'width':targetSizeMenu+'px','padding':'10px 0'},function(){
				open = true;
			});
			if(windowSize > 768)
				$('.content,header').css('width','calc(100% - 250px)');
				$('.content,header').animate({'left':targetSizeMenu+'px'},function(){
				open = true;
			});
			
		}
	})
	$(window).resize(function(){
		windowSize = $(window)[0].innerWidth;
		targetSizeMenu = (windowSize <= 400) ? 200 : 250;
		if(windowSize <= 768){
			$('.menu').css('width','0').css('padding','0');
			$('.content,header').css('width','100%').css('left','0');
			open = false;
		}else{
			$('.menu').animate({'width':targetSizeMenu+'px','padding':'10px 0'},function(){
				open = true;
			});

			$('.content,header').css('width','calc(100% - 250px)');
			$('.content,header').animate({'left':targetSizeMenu+'px'},function(){
			open = true;
			});
		}

	})
	// Formatação da data
	$('[formato=data]').mask('99/99/9999');

	// Confirmação da exclusão
	$('[actionBtn=delete]').click(function(){
		var txt;
		var r = confirm("Deseja excluir o registro?");
		if(r == true){
			return true;
		}else{
			return false;
		}
	})

})