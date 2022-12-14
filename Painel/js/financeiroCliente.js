$(function(){
   $('[name=parcelas],[name=intervalo]').mask('99'); 
   $('[name=valor]').maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false}); 

   $(document).ready(function() {
        var name = document.getElementsByName("vencimento");
        $(name).Zebra_DatePicker();
    });
})