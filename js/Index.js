$(function(){
    // menu
        $('nav.mobile').click(function() {
            // O que vai acontecer quando clicarmos no nav.mobile
            var listaMenu = $('nav.mobile ul');
            // Abrir menu com o fadeIn
                /*if(listaMenu.is(':hidden') == true){
                    listaMenu.fadeIn();
                }else{
                    listaMenu.fadeOut();
                }*/
            // Abrir menu com o slideToggle
                if(listaMenu.is(':hidden') == true){                    
                    var icone = $('.botao-menu-mobile').find('i');
                    // Remover class
                    icone.removeClass('fa-solid fa-bars')
                    // Adicionar class
                    icone.addClass('fa-solid fa-xmark')
                    listaMenu.slideToggle();
                }else{
                    var icone = $('.botao-menu-mobile').find('i');
                    // Remover class
                    icone.removeClass('fa-solid fa-xmark')
                    // Adicionar class
                    icone.addClass('fa-solid fa-bars')
                    listaMenu.slideToggle();
                }
        });
        // Controle do scroll
        if ($('target').length > 0) {
            
           // O elemento existe, portanto precisamos dar o scroll em algum elemento
           var elemento = '#'+$('target').attr('target');
           var divScroll = $(elemento).offset().top;

           $('html,body').animate({'scrollTop':divScroll},2000);
        }

        //Carregar pagina sem atualizar a pagina
        carregarDinamico();
        function carregarDinamico() {
            $('[realtime]').click(function() {
                var pagina = $(this).attt('realtime');
                $('.container-principal').load('/Site_Dinamico_Marcacoes/pages/'+pagina+'.php');
                return false;
            })  
        }
})