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

<div class="chamada-escolher">
	<div class="container">
		<h2>Feche o seu pedido</h2>
	</div><!--container-->
</div><!--chamada-->

<div class="tabela-pedidos">
	<div class="container-loja">
	<h2><i class="fa fa-shopping-cart"></i> Carrinho:</h2>
		<table>
			<tr>
				<td>Nome do produto</td>
				<td>Quantidade</td>
				<td>Valor</td>
			</tr>
			<?php
				$itemsCarrinho = $_SESSION['carrinho'];
				$total = 0;
				foreach ($itemsCarrinho as $key => $value) {
				$idProduto = $key;
				$produto = MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque` WHERE id = $idProduto");
				$produto->execute();
				$produto = $produto->fetch();
				$valor = $value * $produto['preco'];
				$total+=$valor;
			?>
			<tr>
				<td><?php echo $produto['nome']; ?></td>
				<td><?php echo $value; ?></td>
				<td>R$<?php echo ($valor); ?></td>
			</tr>

			<?php } ?>
		</table>
	</div><!--container-->
</div><!--tabela-pedidos-->

	<div class="finalizar-pedido">
		<div class="container-loja">
			<h2>Total: R$<?php echo ($total); ?></h2>
			<div class="clear-loja"></div>
			<a href="" class="btn-pagamento">Pagar Agora</a>
			<div class="clear-loja"></div>
		</div>
	</div><!--finalizar-pedido-->
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js"></script>
	<script src="<?php echo INCLUDE_PATH; ?>js/constants.js"></script>
	<script src="<?php echo INCLUDE_PATH; ?>js/scripts.js"></script>
    <script src="<?php echo INCLUDE_PATH; ?>js/Index.js"></script>

