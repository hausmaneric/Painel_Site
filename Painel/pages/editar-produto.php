<style>
.box-content form{
    margin: 30px 0;
}

.box-content form label{
    font-size: 17px;
    font-weight: 300;
    color: black;
    display: block;
    border: 1px solid #ccc;
    padding: 5px;
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

.box-content .form-group{
    margin: 15px 0;
}

.box-content form input[type=text],
.box-content form input[type=password]{
    font-size: 16px;
    font-weight: normal;
    color: black;
    width: 100%;
    height: 40px;
    border: 1px solid #ccc;
    padding-left: 8px;
}

textarea{
    font-size: 16px;
    font-weight: normal;
    color: black;
    width: 100%;
    height: 150px;
    border: 1px solid #ccc;
    padding-left: 8px; 
    padding-top: 5px;
    resize: vertical;
}


.box-content form select{
    font-size: 16px;
    font-weight: normal;
    color: black;
    width: 100%;
    height: 40px;
    border: 1px solid #ccc;
    padding-left: 8px;
}
    
.box-content form input[type=file]{
    width: 100%;
    padding: 8px;
    margin-top: 8px;
    border: 1px solid #ccc;
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
    width: auto;
    height: 40px;
    padding: 3px 8px;
    cursor: pointer;
    font-size: 14px;
    margin-top: 8px;
    background: #1de9b6; 
    border: 0;
    color: white;
}

.group-btn a:nth-child(2){
    background: #f4b03e;
}

.group-btn a:nth-child(1){
    background: #e05c4e;
}

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
.group-btn a{
    display: inline-block;
    text-decoration: none;
    color: white;
    padding: 3px 8px;
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
	$id = (int)$_GET['id'];
	$sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque` WHERE id = ?");
	$sql->execute(array($id));
	if($sql->rowCount() == 0){
		Painel::alert('erro','O produto que você quer editar não existe!');
		die();
	}

	$infoProduto = $sql->fetch();

	$pegaImagens = MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque_imagens` WHERE produto_id = $id");
	$pegaImagens->execute();
	$pegaImagens = $pegaImagens->fetchAll();

?>

<div class="box-content">
	<h2><i class="fa fa-pencil"></i> Editando Produto: <?php echo $id; ?></h2>
	<div style="margin-top: 15px;" class="card-title"><i class="fa fa-rocket"></i> Informações do produto:</div>
	<?php
	if(isset($_GET['deletarImagem'])){
		$idImagem = $_GET['deletarImagem'];
		@unlink(BASE_DIR_PAINEL.'/uploads/'.$idImagem);
		MySql::conectar()->exec("DELETE FROM `tb_admin.estoque_imagens` WHERE imagem = '$idImagem'");
		Painel::alert('sucesso','A imagem foi deletada com sucesso!');
		$pegaImagens = MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque_imagens` WHERE produto_id = $id");
		$pegaImagens->execute();
		$pegaImagens = $pegaImagens->fetchAll();
	}
	?>
	<form method="post" action="<?php echo INCLUDE_PATH_PAINEL ?>editar-produto?id=<?php echo $id; ?>" enctype="multipart/form-data">
	<?php
		if(isset($_POST['acao'])){
			$nome = $_POST['nome'];
			$descricao = $_POST['descricao'];
			$largura = $_POST['largura'];
			$altura = $_POST['altura'];
			$comprimento = $_POST['comprimento'];
			$peso = $_POST['peso'];
			$quantidade = $_POST['quantidade'];
			$preco = $_POST['preco'];

			$imagens = [];

			$sucesso = true;
			$amountFiles = count($_FILES['imagem']['name']);
			if($_FILES['imagem']['name'][0] != ''){
				//Nosso usuário quer adicionar mais imagens no produto!
				for($i =0; $i < $amountFiles; $i++){
					$imagemAtual = ['type'=>$_FILES['imagem']['type'][$i],
					'size'=>$_FILES['imagem']['size'][$i]];
					if(Painel::imagemValida($imagemAtual) == false){
						$sucesso = false;
						Painel::alert('erro','Uma das imagens selecionadas são inválidas!');
						break;
					}
				}
			}

			if($sucesso){
				if($_FILES['imagem']['name'][0] != ''){
					for($i =0; $i < $amountFiles; $i++){
						$imagemAtual = ['tmp_name'=>$_FILES['imagem']['tmp_name'][$i],
							'name'=>$_FILES['imagem']['name'][$i]];
						$imagens[] = Painel::uploadFile($imagemAtual);
					}

					foreach ($imagens as $key => $value) {
						MySql::conectar()->exec("INSERT INTO `tb_admin.estoque_imagens` VALUES (null,$id,'$value')");
					}
				}

				$sql = MySql::conectar()->prepare("UPDATE `tb_admin.estoque` SET nome = ?,descricao = ?, altura = ?,
				largura = ?, comprimento = ?, peso = ?, quantidade = ?, preco = ? WHERE id = $id");
				$sql->execute(array($nome,$descricao,$altura,$largura,$comprimento,$peso,$quantidade,$preco));

				Painel::alert('sucesso','Você atualizou seu produto com sucesso!');
				$sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque` WHERE id = ?");
				$sql->execute(array($id));
				$infoProduto = $sql->fetch();
				$pegaImagens = MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque_imagens` WHERE produto_id = $id");
				$pegaImagens->execute();
				$pegaImagens = $pegaImagens->fetchAll();
			}
		}
	?>
		<div class="form-group">
			<label>Nome do produto:</label>
			<input type="text" name="nome" value="<?php echo $infoProduto['nome']; ?>">
		</div><!--form-group-->

		<div class="form-group">
			<label>Descrição do produto:</label>
			<textarea name="descricao"><?php echo $infoProduto['descricao']; ?></textarea>
		</div><!--form-group-->

		<div class="form-group">
			<label>Largura do produto:</label>
			<input type="number" name="largura" min="0" max="900" step="1" value="<?php echo $infoProduto['largura']; ?>">
		</div><!--form-group-->


		<div class="form-group">
			<label>Altura do produto:</label>
			<input type="number" name="altura" min="0" max="900" step="1" value="<?php echo $infoProduto['altura']; ?>">
		</div><!--form-group-->

		<div class="form-group">
			<label>Comprimento do produto:</label>
			<input type="number" name="comprimento" min="0" max="900" step="1" value="<?php echo $infoProduto['comprimento']; ?>">
		</div><!--form-group-->

		<div class="form-group">
			<label>Peso do produto:</label>
			<input type="number" name="peso" min="0" max="900" step="1" value="<?php echo $infoProduto['peso']; ?>">
		</div><!--form-group-->

		<div class="form-group">
			<label>Quantidade atual do produto:</label>
			<input type="number" name="quantidade" min="0" max="900" step="1" value="<?php echo $infoProduto['quantidade']; ?>">
		</div><!--form-group-->

		<div class="form-group">
			<label>Preço do produto:</label>
			<input type="text" name="preco" value="<?php echo $infoProduto['preco']; ?>">
		</div><!--form-group-->


		<div class="form-group">
			<label>Selecione as imagens:</label>
			<input multiple type="file" name="imagem[]">
		</div><!--form-group-->
		<input type="submit" name="acao" value="Atualizar Produto!">
	</form>
		<div class="card-title"><i class="fa fa-rocket"></i> Imagens do produto:</div>
	<div class="boxes">
		<?php
			foreach ($pegaImagens as $key => $value){
		?>
		<div class="box-single-wraper">
			<div style="border: 1px solid #ccc;padding:8px 15px;">
			<div style="width: 100%;float: left;" class="box-imgs">
				<img class="img-square" src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $value['imagem'] ?>" />
			</div><!--box-imgs-->
			<div class="clear"></div>
			<div style="text-align: center;" class="group-btn">
				<a class="btn delete" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-produto?id=<?php echo $id; ?>&deletarImagem=<?php echo $value['imagem'] ?>"><i class="fa fa-times"></i> Excluir</a>
			</div><!--group-btn-->
			
			</div>
		</div><!--box-single-wraper-->
		<?php } ?>
	</div><!--boxes-->
</div>