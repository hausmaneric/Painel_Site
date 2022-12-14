<?php 
    if(isset($_GET['loggout'])){
        Painel::loggout();
    }
?>
<!doctype html>
<html>
    <head>
        <title>Painel de Controle</title>
        <meta charset="urf-8" />
        <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0">
        <meta name="description" content="Descrição do meu web site" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Roboto:wght@100&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/zebra_datepicker@latest/dist/css/bootstrap/zebra_datepicker.min.css">
        <link href="css/style.css" rel="stylesheet"/>
        <link href="css/jquery-ui.min.css" rel="stylesheet"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
    <base base="<?php echo INCLUDE_PATH_PAINEL; ?>" />
        <div class="menu">
            <div class="menu-wraper">
                <div class="box-usuario">
                    <?php 
                        if($_SESSION['img'] == ''){                            
                    ?>
                        <div class="avatar-usuario">
                            <i class="fa fa-user"></i>
                        </div>
                    <?php }else{ ?>
                        <div class="imagem-usuario">
                            <img src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $_SESSION['img']; ?> " />
                        </div>
                    <?php } ?>
                    <div class="nome-usuario">
                        <p><?php echo $_SESSION['nome'] ?></p>
                        <p><?php echo pegaCargo($_SESSION['cargo']); ?></p>
                    </div>
                </div>
                <div class="items-menu">
                    <h2>Cadastro</h2>
                    <a <?php selecionadoMenu('cadastra-depoimento'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>cadastrar-depoimento"><i class="fa-solid fa-comment"></i> Cadastrar Depoimento</a>
                    <a <?php selecionadoMenu('cadastra-servico'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>cadastrar-servico"><i class="fa-solid fa-briefcase"></i> Cadastrar Serviço</a>
                    <a <?php selecionadoMenu('casdastrar-slides'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>casdastrar-slides"><i class="fa-solid fa-sliders"></i> Cadastrar Slides</a>
                    <h2>Gestão</h2>
                    <a <?php selecionadoMenu('listar-depoimentos'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>listar-depoimentos"><i class="fa-solid fa-list-ul"></i> Listar Depoimento</a>
                    <a <?php selecionadoMenu('listar-servicos'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>listar-servicos"><i class="fa-solid fa-list-ul"></i> Listar Serviço</a>
                    <a <?php selecionadoMenu('listar-slides'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>listar-slides"><i class="fa-solid fa-list-ul"></i> Listar Slides</a>
                    <h2>Administração do painel</h2>
                    <a <?php selecionadoMenu('editar-usuario'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>editar-usuario"><i class="fa-solid fa-user-pen"></i> Editar Usuário</a>
                    <a <?php selecionadoMenu('adicionar-usuario'); ?> <?php verificaPermissaoMenu(2); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>adicionar-usuario"><i class="fa-solid fa-user-plus"></i> Adicionar Usuários</a>
                    <h2>Configuração Geral</h2>
                    <a <?php selecionadoMenu('editar-site'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>editar-site"><i class="fa-solid fa-sitemap"></i> Editar Site</a>
                    <h2>Gestão de Notícia</h2>
                    <a <?php selecionadoMenu('cadastra-categorias'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>cadastrar-categorias">Cadastrar Categorias</a>
                    <a <?php selecionadoMenu('gerenciar-categorias'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>gerenciar-categorias"><i class="fa-solid fa-newspaper"></i> Gerenciar Categorias</a>
                    <a <?php selecionadoMenu('cadastra-noticias'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>cadastrar-noticias"> Cadastrar Notícias</a>
                    <a <?php selecionadoMenu('gerenciar-noticias'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>gerenciar-noticias"><i class="fa-solid fa-calendar"></i> Gerenciar Notícias</a>
                    <h2>Gestão de Clientes</h2>
                    <a <?php selecionadoMenu('cadastra-clientes'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>cadastrar-clientes"><i class="fa-solid fa-person-circle-plus"></i> Cadastrar Clientes</a>
                    <a <?php selecionadoMenu('gerenciar-clientes'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-clientes"><i class="fa-solid fa-person"></i> Gerenciar Clientes</a>
                    <h2>Controle Financeiro</h2>
                    <a <?php selecionadoMenu('visualizar-pagamentos'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>visualizar-pagamentos"><i class="fa-solid fa-money-bill-1-wave"></i> Visualizar Pagamentos</a>
                    <h2>Controle Estoque</h2>
                    <a <?php selecionadoMenu('cadastrar-produtos'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>cadastrar-produtos"><i class="fa fa-pencil-square"></i> Cadastrar Produtos</a>
                    <a <?php selecionadoMenu('visualizar-produtos'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>visualizar-produtos"><i class="fa fa-square"></i> Visualizar Produtos</a>
                    <h2>Gestão Imóveis</h2>
                    <a <?php selecionadoMenu('cadastrar-empreendimento'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>cadastrar-empreendimento"> Cadastrar Empreendimento</a>
                    <a <?php selecionadoMenu('listar-empreendimentos'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>listar-empreendimentos">Listar Empreendimentos</a>
                    <h2>E-mail Marketing</h2>
                    <a <?php selecionadoMenu('gerenciar-lista'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>gerenciar-lista">Gerenciar listas</a>
                    <a <?php selecionadoMenu('gerenciar-contatos'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>gerenciar-contatos">Gerenciar contatos</a>
                    <a <?php selecionadoMenu('criar-campanha'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>criar-campanha">Criar campanha</a>
                </div>
            </div>
        </div>
        <header>
            <div class="center">
                <div class="menu-btn">
                    <i class="fa fa-bars"></i>
                </div>
                <div  class="loggout">
                    <a <?php if(@$_GET['url'] == 'calendario'){?> style="background: #60727a; padding: 10px 8px;" <?php } ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>calendario"><i class="fa fa-comments"></i> <span>Calendário</span></a>
                    <a <?php if(@$_GET['url'] == 'chat'){?> style="background: #60727a; padding: 10px 8px;" <?php } ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>chat"><i class="fa fa-calendar"></i> <span>Chat Online</span></a>
                    <a <?php if(@$_GET['url'] == ''){?> style="background: #60727a; padding: 10px 8px;" <?php } ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>"><i class="fa fa-home"></i> <span>Pagina Inicial</span></a>
                    <div style="padding: 0 5px; display: inline;"></div>
                    <a href="<?php echo INCLUDE_PATH_PAINEL; ?>?loggout"><i class="fa fa-window-close"></i> <span>Sair</span> </a>
                </div>
                <div class="clear"></div>
            </div>  
        </header>
        <div class="content">
            <?php Painel::carregarPagina(); ?>
        </div> 
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="<?php echo INCLUDE_PATH_PAINEL ?>/js/jquery-ui.min.js"></script>  
        <script src="https://cdn.jsdelivr.net/npm/zebra_datepicker@1.9.13/dist/zebra_datepicker.min.js"></script>
        <script src="<?php echo INCLUDE_PATH_PAINEL ?>js/jquery.maskMoney.js"></script>  
        <script src="<?php echo INCLUDE_PATH_PAINEL ?>js/jquery.mask.js"></script>  
        <script src="<?php echo INCLUDE_PATH_PAINEL ?>/js/jquery.ajaxform.js"></script>          
        <script src="<?php echo INCLUDE_PATH_PAINEL ?>js/main.js"></script> 
        <script src="<?php echo INCLUDE_PATH ?>js/constants.js"></script>
        <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>       
        <script> tinymce.init({ selector:'.tinymce',plugins:'image'}); </script> 
        <script src="<?php echo INCLUDE_PATH_PAINEL ?>js/helperMask.js"></script> 
        <script src="<?php echo INCLUDE_PATH_PAINEL ?>js/ajax.js"></script>  
        <script src="<?php echo INCLUDE_PATH_PAINEL ?>js/financeiroCliente.js"></script>  
        
        <?php Painel::loadJS(array('ajax.js'),'gerenciar-clientes'); ?>
        <?php Painel::loadJS(array('ajax.js'),'cadastra-clientes'); ?>
        <?php Painel::loadJS(array('ajax.js'),'editar-clientes'); ?>
        <?php Painel::loadJS(array('financeiroCliente.js'),'editar-clientes'); ?>
        <?php Painel::loadJS(array('chat.js'),'chat'); ?>
        <?php Painel::loadJS(array('calendario.js'),'calendario'); ?>
        <script src="<?php echo INCLUDE_PATH_PAINEL ?>/js/empreendimentos.js"></script> 
    </body>
</html>