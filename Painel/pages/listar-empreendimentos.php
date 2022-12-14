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


.box-imgs{
	text-align: center;
}

.box-imgs h1{
	color: #ccc;
	font-size: 70px;
	margin:10px 0;
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
<div class="box-content">
	<h2><i class="fa fa-id-card" aria-hidden="true"></i> Empreendimentos</h2>
	<div class="busca">
		<h4><i class="fa fa-search"></i> Realizar uma busca</h4>
		<form method="post">
			<input style="font-size: 15px;" placeholder="Procure pelo nome do empreendimento" type="text" name="busca">
			<input type="submit" name="acao" value="Buscar!">
		</form>
	</div><!--busca-->
	<?php

		if(isset($_GET['deletar'])){
			$id = (int)$_GET['deletar'];
			$imagens = MySql::conectar()->prepare("SELECT `imagem` FROM `tb_admin.empreendimentos` WHERE id = $id");
			$imagens->execute();
			$imagens = $imagens->fetch();
			@unlink(BASE_DIR_PAINEL.'/uploads/'.$imagens['imagem']);

			$imoveis = MySql::conectar()->prepare("SELECT * FROM `tb_admin.imoveis` WHERE empreend_id = $id");
			$imoveis->execute();
			$imoveis = $imoveis->fetchAll();
			foreach ($imoveis as $key => $value) {
				$imagens = MySql::conectar()->prepare("SELECT * FROM `tb_admin.imagens_imoveis` WHERE imovel_id = $value[id]");
				$imagens->execute();
				$imagens = $imagens->fetchAll();
				foreach ($imagens as $key2 => $value2) {
					@unlink(BASE_DIR_PAINEL.'/uploads/'.$value2['imagem']);
					MySql::conectar()->exec("DELETE FROM `tb_admin.imagens_imoveis` WHERE id = $value2[id]");
				}
			}
			MySql::conectar()->exec("DELETE FROM `tb_admin.imoveis` WHERE empreend_id = $id");
			MySql::conectar()->exec("DELETE FROM `tb_admin.empreendimentos` WHERE id = $id");
			Painel::alert('sucesso',"O empreendimento foi deletado com sucesso!");
		}

	?>
	<div class="boxes">
		<?php
			$query = "";
			if(isset($_POST['acao']) && $_POST['acao'] == 'Buscar!'){
				$nome = $_POST['busca'];
				$query = "WHERE (nome LIKE '%$nome%')";
			}
			if($query == ''){
				$query2 = "";
			}else{
				$query2 = "";
			}
			$sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.empreendimentos` $query ORDER BY order_id ASC");

			$sql->execute();
			$produtos = $sql->fetchAll();
			if($query != ''){
				echo '<div style="width:100%;" class="busca-result"><p>Foram encontrados <b>'.count($produtos).'</b> resultado(s)</p></div>';
			}
			foreach ($produtos as $key => $value) {
		?>
		<div id="item-<?php echo $value['id']; ?>" class="box-single-wraper" style="padding:10px 20px;">
			<div style="border: 1px solid #ccc;padding:8px 15px;height: 55%;">
			<div style="width: 100%;float: left;" class="box-imgs">

			<img style="height: 100%;max-height:250px;" src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $value['imagem'] ?>" />
				
			</div><!--box-imgs-->
			<div style="width: 70%;float: left;border: 0;" class="box-single">
				<div class="body-box">
					<p><b><i class="fa fa-pencil"></i> Nome:</b> <?php echo $value['nome'] ?></p>
					<p><b><i class="fa fa-pencil"></i> Tipo:</b> <?php echo ucfirst($value['tipo']) ?></p>
					<div class="group-btn">
						<a class="btn" href="<?php echo INCLUDE_PATH_PAINEL ?>listar-empreendimentos?deletar=<?php echo $value['id']; ?>"><i class="fa fa-times"></i> Excluir</a>
						<a style="background: #0091ea" class="btn" href="<?php echo INCLUDE_PATH_PAINEL ?>visualizar-empreendimento/<?php echo $value['id']; ?>"><i class="fa fa-eye"></i> Visualizar</a>
					</div><!--group-btn-->
				</div><!--body-box-->
			</div><!--box-single-->
			<div class="clear"></div>
			</div>
		</div><!--box-single-wraper-->

		<?php } ?>
    </div><!--boxes-->
</div><!--box-content-->