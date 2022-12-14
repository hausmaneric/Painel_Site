<?php
    if(isset($_GET['addCart'])){
        $idProduto = (int)$_GET['addCart'];
        if(isset($_SESSION['carrinho']) == false){
            $_SESSION['carrinho'] = array();
        }
        if(isset($_SESSION['carrinho'][$idProduto]) == false){
            $_SESSION['carrinho'][$idProduto] = 1;
        }else{
            $_SESSION['carrinho']['idProduto']++;
        }
    }
    
    function getTotalItemsCarrinho(){
        if(isset($_SESSION['carrinho'])){
            $amount = 0;
            foreach ($_SESSION['carrinho'] as $key => $value) {
                $amount+= $value;
            }
        }else{
            return 0;
        }        
        return $amount;
    }
    
?>
<header class="header-loja">
    <div class="container-loja">
        <div class="logo-loja"><a href="<?php echo INCLUDE_PATH ?>">Loja Virtual</a></div>
        <nav class="desktop-loja">
            <ul>
                <li><a href="javascript:void(0);"><i class="fa fa-shopping-cart"></i> Carrinho(<?php echo getTotalItemsCarrinho(); ?>)</a></li>
                <li style="background: #1e88e5;"><a href="<?php echo INCLUDE_PATH ?>finalizar">Finalizar Pedido</a></li>
            </ul>
        </nav>   
        <div class="clear-loja"></div>     
    </div> 
</header>
<section class="corpo">
    <div class="chamada-escolher">
        <div class="container-loja">
            <h2>Escolha seus produtos e compre agora!</h2>
        </div>
    </div> 
    <div class="lista-itens">
        <div class="container-loja">
            <?php  
                $sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque`");
                $sql->execute();
                $itens = $sql->fetchAll();
                foreach ($itens as $key => $value) {
                $imagem = MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque_imagens` WHERE produto_id = $value[id]");
                $imagem->execute();
                $imagem = $imagem->fetch()['imagem'];
            ?>
            <div class="produto-single-box">
                <img src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $imagem ?>" />
                <p><?php echo $value['nome']; ?></p>
                <p>R$<?php echo $value['preco']; ?></p>
                <div class="clear-loja"></div>
                <a href="?addCart=<?php echo $value['id']; ?>">Adicionar no carrinho</a>
            </div>            
            <?php } ?>
            <div class="clear-loja"></div>
        </div>
    </div>
</section>