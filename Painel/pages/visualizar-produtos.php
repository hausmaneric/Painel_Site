
<style rel="stylesheet">
.boxes{
	display: flex;
	flex-wrap: wrap;
}

.box-single-wraper{
	width: 33.3%;
	padding:20px;
}

.box-single{
	overflow-x: auto;
	width: 100%;
	height: 100%;
	border: 1px solid #ccc;
}

.box-imgs img{
	width: 100%;
}

.box-imgs img.img-square{
	width: 200px;
	height: 160px;
	display: block;
	margin:8px auto;
}

.box-imgs{
	text-align: center;
}

.box-imgs h1{
	color: #ccc;
	font-size: 70px;
	margin:10px 0;
}

.card-title{
	width: 100%;
	padding:6px;
	color: white;
	margin:10px 0;
	font-size: 17px;
	font-weight: lighter;
	background: #0091ea;
}

.row1{
	float: left;
	width: 30%;
	padding:8px 10px;
}

.row1 img{
	width: 100%;
}
.row2{
	float: left;
	width: 70%;
	padding:8px 10px;
}

.row2 p{
	padding:8px 0;
	color: #646464;
	border-bottom: 1px solid #ccc;
}

.topo-box{
	text-align: center;
	color: #ccc;
	padding:8px 0;
	border-bottom: 1px solid #ccc;
}

.topo-box img{
	display: block;
	max-width: 150px;
	margin:0 auto;
}

.topo-box h2{
	font-size: 36px;
}

.body-box{
	padding:10px;
}

.body-box p{
	color: #646464;
	font-size: 15px;
	margin-bottom: 8px;
}
.group-btn{margin-top: 15px;}

.busca{
	margin: 10px 0;
	width: 100%;
	padding:8px 10px;
}

.busca form{
	margin: 0;
}

.busca h4{
	font-weight: lighter;
	font-size: 23px;
	color: #646464;
}

.busca-result{
	color: #646464;
	border-top:3px solid #ccc;
}

.busca-result p{
	font-size: 16px;
}


.group-btn a:nth-child(2){
    background: #f4b03e;
}

.group-btn a:nth-child(1){
    background: #e05c4e;
}

.group-btn a{
    display: inline-block;
    text-decoration: none;
    color: white;
    padding: 3px 8px;	
}

.box-content form input[type=text]{
    font-size: 16px;
    font-weight: normal;
    color: black;
    width: 100%;
    height: 40px;
    border: 1px solid #ccc;
    padding-left: 8px;
}
.box-content form input[type=number]{
    font-size: 16px;
    font-weight: normal;
    color: black;
    width: 100%;
    height: 40px;
    border: 1px solid #ccc;
    padding-left: 8px;  
	padding-right: 8px; 
}

.box-content input[type=submit]{
    width: 100px;
    height: 40px;
    cursor: pointer;
    font-size: 14px;
    margin-top: 8px;
    background: #1de9b6; 
    border: 0;
    color: white;
}

.busca-result{
    color: #646464;
    border-top: 3px solid #ccc;
}

.busca-result p{
    font-size: 16px;
}

.busca h4{
    color: black;
    margin-bottom: 8px;
    font-size: 18px;
}


.box-alert{
    width: 100%;
    padding: 8px 0;   
    margin-bottom: 8px;  
}

.box-alert a{
    color: white;
    font-weight: bold;    
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

.atencao{
    text-align: center;
    background: #f4a742;
    color: white;
}
@media screen and (max-width:768px) {
    .box-single-wrapper{
        width: 100%;
    }
}
@media screen and (max-width:500px) {
    .box-imgs,.box-single{
        width: 100% !important;
    }
}
</style>

<?php
	if(isset($_GET['pendentes']) == false){
?>

<div class="box-content">
	<h2><i class="fa fa-id-card" aria-hidden="true"></i> Produtos no estoque</h2>
	<div class="busca">
		<h4><i class="fa fa-search"></i> Realizar uma busca</h4>
		<form method="post">
			<input style="font-size: 15px;" placeholder="Procure pelo nome do produto" type="text" name="busca">
			<input type="submit" name="acao" value="Buscar!">
		</form>
	</div><!--busca-->
	<?php

		if(isset($_GET['deletar'])){
			//queremos deletar algum produto.
			$id = (int)$_GET['deletar'];
			$imagens = MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque_imagens` WHERE produto_id = $id");
			$imagens->execute();
			$imagens = $imagens->fetchAll();
			foreach ($imagens as $key => $value) {
				@unlink(BASE_DIR_PAINEL.'/uploads/'.$value['imagem']);
			}
			MySql::conectar()->exec("DELETE FROM `tb_admin.estoque_imagens` WHERE produto_id = $id");
			MySql::conectar()->exec("DELETE FROM `tb_admin.estoque` WHERE id = $id");
			Painel::alert('sucesso',"O produto foi deletado do estoque com sucesso!");
		}

		if(isset($_POST['atualizar'])){
			$quantidade = $_POST['quantidade'];
			$produto_id = $_POST['produto_id'];
			if($quantidade < 0){
				Painel::alert('erro','Você não pode atualizar a quantidade para igual ou menor a 0!');
			}else{
				MySql::conectar()->exec("UPDATE `tb_admin.estoque` SET quantidade = $quantidade WHERE id = $produto_id");
				Painel::alert('sucesso','Você atualizou a quantidade do produto com ID: <b>'.$_POST['produto_id'].'</b>');
			}
		}

		$sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque` WHERE quantidade = 0");
		$sql->execute();
		if($sql->rowCount() > 0){
		Painel::alert('atencao','Você está com produtos em falta! Clique <a href="'.INCLUDE_PATH_PAINEL.'visualizar-produtos?pendentes">aqui</a> para visualiza-los!');
		}

	?>
	<div class="boxes">
		<?php
			$query = "";
			if(isset($_POST['acao']) && $_POST['acao'] == 'Buscar!'){
				$nome = $_POST['busca'];
				$query = "WHERE (nome LIKE '%$nome%' OR descricao LIKE '%$nome%')";
			}
			if($query == ''){
				$query2 = "WHERE quantidade > 0";
			}else{
				$query2 = " AND quantidade > 0";
			}
			$sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque` $query $query2");

			$sql->execute();
			$produtos = $sql->fetchAll();
			if($query != ''){
				echo '<div style="width:100%;" class="busca-result"><p>Foram encontrados <b>'.count($produtos).'</b> resultado(s)</p></div>';
			}
			foreach ($produtos as $key => $value) {
			$imagemSingle = MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque_imagens` WHERE produto_id = $value[id] LIMIT 1");
			$imagemSingle->execute();
			$imagemSingle = $imagemSingle->fetch()['imagem'];
		?>
		<div class="box-single-wraper">
			<div style="border: 1px solid #ccc;padding:8px 15px;height: 95%;">
			<div style="width: 100%;float: left;" class="box-imgs">
				<?php
					if($imagemSingle == ''){

				?>
					<h1><i class="fa fa-pencil-square"></i></h1>

				<?php }else{ ?>
					<img class="img-square" src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $imagemSingle ?>" />
				<?php } ?>
			</div><!--box-imgs-->
			<div style="width: 100%;float: left;border: 0;" class="box-single">
				<div class="body-box">
					<p><b><i class="fa fa-pencil"></i> Nome do produto:</b> <?php echo $value['nome'] ?></p>
					<p><b><i class="fa fa-pencil"></i> Descrição:</b> <?php echo $value['descricao'] ?></p>
					<p><b><i class="fa fa-pencil"></i> Largura:</b> <?php echo $value['largura'] ?>cm</p>
					<p><b><i class="fa fa-pencil"></i> Altura:</b> <?php echo $value['altura'] ?>cm</p>
					<p><b><i class="fa fa-pencil"></i> Comprimento:</b> <?php echo $value['comprimento'] ?>cm</p>
					<p><b><i class="fa fa-pencil"></i> Peso:</b> <?php echo $value['peso'] ?></p>
					<p><b><i class="fa fa-pencil"></i> Preço:</b> R$<?php echo $value['preco'] ?></p>
					<div style="padding:8px 0;border-bottom: 1px solid #ccc;" class="group-btn">
						<form method="post" style="margin: 0;">
							<p><b><i class="fa fa-pencil"></i> Quantidade atual:</b></p>
							<input type="number" name="quantidade" min="0" max="900" step="1" value="<?php echo $value['quantidade'] ?>">
							<input type="hidden" name="produto_id" value="<?php echo $value['id']; ?>">
							<input style="background: #0091ea;" type="submit" name="atualizar" value="Atualizar!">
						</form>
					</div><!--group-btn-->
					<div class="group-btn">
						<a class="btn" href="<?php echo INCLUDE_PATH_PAINEL ?>visualizar-produtos?deletar=<?php echo $value['id']; ?>"><i class="fa fa-times"></i> Excluir</a>
						<a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-produto?id=<?php echo $value['id'] ?>"><i class="fa fa-pencil"></i> Editar</a>
					</div><!--group-btn-->
				</div><!--body-box-->
			</div><!--box-single-->
			<div class="clear"></div>
			</div>
		</div><!--box-single-wraper-->

		<?php } ?>
		

		

	</div><!--boxes-->

</div><!--box-content-->

<?php }else{ ?>
<div class="box-content">
	<h2><i class="fa fa-id-card" aria-hidden="true"></i> <a style="text-decoration:none;color:black;" href="<?php echo INCLUDE_PATH_PAINEL ?>visualizar-produtos">Produtos no estoque</a> » Produtos em falta</h2>
	<?php
		if(isset($_POST['atualizar'])){
			$quantidade = $_POST['quantidade'];
			$produto_id = $_POST['produto_id'];
			if($quantidade < 0){
				Painel::alert('erro','Você não pode atualizar a quantidade para igual ou menor a 0!');
			}else{
				MySql::conectar()->exec("UPDATE `tb_admin.estoque` SET quantidade = $quantidade WHERE id = $produto_id");
				Painel::alert('sucesso','Você atualizou a quantidade do produto com ID: <b>'.$_POST['produto_id'].'</b>');
			}
		}
		echo '<br />';
		$sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque` WHERE quantidade = 0");
		$sql->execute();
		$produtos = $sql->fetchAll();
		if(count($produtos) > 0)
			Painel::alert('atencao','Todos os produtos listados abaixo estão em falta no seu estoque!');
		else
			Painel::alert('sucesso','Tudo okay, você não tem nenhum produto em falta!');
	?>

	<div class="boxes">
		<?php
			foreach ($produtos as $key => $value) {
			$imagemSingle = MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque_imagens` WHERE produto_id = $value[id] LIMIT 1");
			$imagemSingle->execute();
			$imagemSingle = $imagemSingle->fetch()['imagem'];
		?>
		<div class="box-single-wraper">
			<div style="border: 1px solid #ccc;height: 95%;">
			<div style="width: 100%;float: left;" class="box-imgs">
				<?php
					if($imagemSingle == ''){

				?>
					<h1><i class="fa fa-pencil-square-o" aria-hidden="true"></i></h1>

				<?php }else{ ?>
					<img class="img-square" src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $imagemSingle ?>" />
				<?php } ?>
			</div><!--box-imgs-->
			<div style="width: 100%;float: left;border: 0;" class="box-single">
				<div class="body-box">
					<p><b><i class="fa fa-pencil"></i> Nome do produto:</b> <?php echo $value['nome'] ?></p>
					<p><b><i class="fa fa-pencil"></i> Descrição:</b> <?php echo $value['descricao'] ?></p>
					<p><b><i class="fa fa-pencil"></i> Largura:</b> <?php echo $value['largura'] ?>cm</p>
					<p><b><i class="fa fa-pencil"></i> Altura:</b> <?php echo $value['altura'] ?>cm</p>
					<p><b><i class="fa fa-pencil"></i> Comprimento:</b> <?php echo $value['comprimento'] ?>cm</p>
					<p><b><i class="fa fa-pencil"></i> Peso:</b> <?php echo $value['peso'] ?></p>
					<div style="padding:8px 0;border-bottom: 1px solid #ccc;" class="group-btn">
						<form method="post" style="margin: 0;">
							<p><b><i class="fa fa-pencil"></i> Quantidade atual:</b></p>
							<input type="number" name="quantidade" min="0" max="900" step="1" value="<?php echo $value['quantidade'] ?>">
							<input type="hidden" name="produto_id" value="<?php echo $value['id']; ?>">
							<input style="background: #0091ea;" type="submit" name="atualizar" value="Atualizar!">
						</form>
					</div><!--group-btn-->
					<div class="group-btn">
						<a class="btn" href="<?php echo INCLUDE_PATH_PAINEL ?>visualizar-produtos?deletar=<?php echo $value['id']; ?>"><i class="fa fa-times"></i> Excluir</a>
						<a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-produto?id=<?php echo $value['id'] ?>"><i class="fa fa-pencil"></i> Editar</a>
					</div><!--group-btn-->
				</div><!--body-box-->
			</div><!--box-single-->
			<div class="clear"></div>
			</div>
		</div><!--box-single-wraper-->

		<?php } ?>
		
	</div><!--boxes-->
</div>

<?php } ?>