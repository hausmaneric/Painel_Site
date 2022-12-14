<style>
    .box-alert{
        width: 100%;
        padding: 8px 0;     
    }

    .sucesso{
        background: #a5d6a7;
        text-align: center;
        color: white;
    }

    .erro{
        text-align: center;
        background: #F75353;
        color: white;
    }
    </
</style>

<div class="box-content">
    <?php Painel::alert('erro','Você não tem permissão para visualizar esta página!'); ?>
</div>