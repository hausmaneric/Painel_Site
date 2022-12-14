<style>
    .table-responsive{
        margin:20px auto;
        font-weight: 300;
    }

    .table-responsive .row:nth-of-type(1){
        font-weight: normal;
        background: #00bfa5;
        padding: 10px;
        color: white;
    }

    .table-responsive .row{
        color: #777;
        padding: 8px;
        border-bottom: 1px solid #ccc;
    }

    .col{
        float: left;
        width: 50%;
    }
</style>

<?php 
    $usuarioOnline = Painel::listarUsuariosOnline();

    $pegarVisitasTotais = MySql::conectar()->prepare("SELECT * FROM `tb_admin.visitas`");
    $pegarVisitasTotais->execute();

    $pegarVisitasTotais = $pegarVisitasTotais->rowCount();

    $pegarVisitasHoje = MySql::conectar()->prepare("SELECT * FROM `tb_admin.visitas` WHERE dia = ?");
    $pegarVisitasHoje->execute(array(date('Y-m-d')));

    $pegarVisitasHoje = $pegarVisitasHoje->rowCount();
?>

<div class=" box-content left w100">
    <h2><i class="fa fa-home"></i> Painel de Controle - <?php echo NOME_EMPRESA ?></h2>
    <div class="box-metricas">
        <div class="box-metrica-single">
            <div class="box-metrica-wraper">
                <h2>Usuários Online</h2>
                <p><?php echo count($usuarioOnline);?></p>
            </div>
        </div>
        <div class="box-metrica-single">
            <div class="box-metrica-wraper">
                <h2>Total de Visitas</h2>
                <p><?php echo $pegarVisitasTotais; ?></p>
            </div>
        </div>   
        <div class="box-metrica-single">
            <div class="box-metrica-wraper">
                <h2>Visitas Hoje</h2>
                <p><?php echo $pegarVisitasHoje; ?></p>
            </div>
        </div> 
        <div class="clear"></div>               
    </div>
</div> 

<div class=" box-content left w100">
    <h2><i class="fa fa-rocket"></i> Usuários Online</h2>
    <div class="table-responsive">
        <div class="row">
            <div class="col">
                <span>IP</span>
            </div>
            <div class="col">
                <span>Última ação</span>
            </div>
            <div class="clear"></div>
        </div> 
        <?php foreach ($usuarioOnline as $key => $value) {            
        ?>
        <div class="row">
            <div class="col">
                <span><?php echo $value['ip'];?></span>
            </div>
            <div class="col">
                <span><?php echo date('d/m/Y H:i:s',strtotime($value['ultima_acao']));?></span>
            </div>
            <div class="clear"></div>
        </div> 
        <?php } ?>
    </div>
</div>

<div class=" box-content left w100">
    <h2><i class="fa fa-rocket"></i> Usuários do Painel</h2>
    <div class="table-responsive">
        <div class="row">
            <div class="col">
                <span>Nome</span>
            </div>
            <div class="col">
                <span>Cargo</span>
            </div>
            <div class="clear"></div>
        </div> 
        <?php 
            $usuarioPainel = MySql::conectar()->prepare("SELECT * FROM `tb_admin.usuarios`");
            $usuarioPainel->execute();
            $usuarioPainel = $usuarioPainel->fetchAll();
            foreach ($usuarioPainel as $key => $value) {
            
        ?>
        <div class="row">
            <div class="col">
                <span><?php echo $value['user'];?></span>
            </div>
            <div class="col">
                <span><?php echo pegaCargo($value['cargo']);?></span>
            </div>
            <div class="clear"></div>
        </div> 
        <?php } ?>
    </div>
</div>
<div class="clear"></div>