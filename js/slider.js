$(function () {

    var curSlide = 0;
    var maxSlide = $('.banner-single').length - 1;
    var delay = 4;

    initSlider();
    changeSlide();
    // Puxar cada banner
    function initSlider() {
        $('.banner-single').hide();
        $('.banner-single').eq(0).show();
        for(i = 0; i < maxSlide+1; i++){
            // Adicionar um componente, bullets
            var content = $('.bullets').html();
            if(i == 0)
                content+='<span class="active-slider"></span>';
            else
                content+='<span></span>';
            $('.bullets').html(content);
        }
    }   

    function changeSlide() {
        setInterval(function () {
            // Mudar o slide
            $('.banner-single').eq(curSlide).stop().fadeOut(2000);
            curSlide++;
            if (curSlide > maxSlide) {
                curSlide = 0;                
            }
            $('.banner-single').eq(curSlide).stop().fadeIn(2000);
            // Trocar bullets da navegacao do slider
            $('.bullets span').removeClass('active-slider');
            $('.bullets span').eq(curSlide).addClass('active-slider');
        },delay * 1000);
    }
    // Trocar o bullets ativo clicando
    $('body').on('click','.bullets span', function(){
        var currentBullet = $(this);
        $('.banner-single').eq(curSlide).stop().fadeOut(1000);
        curSlide = currentBullet.index();
        $('.banner-single').eq(curSlide).stop().fadeIn(1000);
        $('.bullets span').removeClass('active-slider');
        currentBullet.addClass('active-slider');
    });

})