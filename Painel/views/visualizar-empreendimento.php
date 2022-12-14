
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

.wraper-table{
    overflow-x: auto;
}

table{
    width: 100%;
    margin: 20px 0;
    border-collapse: collapse;
    min-width: 900px;
}

table tr:nth-of-type(1){
   background:#0091ea;
   color: white;
}

table tr{
    color: #555;
    border-bottom: 1px solid #ccc;
}

table td{
    padding: 8px;
}

table a.btn{
    text-decoration: none;
    padding: 4px 6px;
    background: #f4b03e;   
    color: white;
    font-size: 15px;   
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
	.row1,.row2{
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
	$id = $par[2];
	$sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.empreendimentos` WHERE id = ?");
	$sql->execute(array($id));

	$infoEmpreend = $sql->fetch();

	if($infoEmpreend['nome'] == ''){
		header('Location: '.INCLUDE_PATH_PAINEL);
		die();
	}

?>
<div class="box-content">
	<h2><i class="fa fa-id-card-o" aria-hidden="true"></i> Empreendimento: <?php echo $infoEmpreend['nome'] ?></h2>
	<div class="info-item">

		<div class="row1">
				<div class="card-title"><i class="fa fa-rocket"></i> Imagem do empreendimento:</div>
				<img src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $infoEmpreend['imagem'] ?>" />
		</div><!--row1-->

		<div class="row2">
				<div class="card-title"><i class="fa fa-rocket"></i> Informações do Empreendimento:</div>
				<p><i class="fa fa-pencil"></i> Nome do empreendimento: <?php echo $infoEmpreend['nome'] ?></p>
				<p><i class="fa fa-pencil"></i> Tipo: <?php echo ucfirst($infoEmpreend['tipo']) ?></p>
		</div><!--row2-->

		<div class="clear"></div>
	
	</div><!--info-item-->



	<div class="card-title"><i class="fa fa-rocket"></i> Cadastrar Imóvel:</div>
	<form method="post" enctype="multipart/form-data">
	<?php
		if(isset($_POST['acao'])){
			$empreendId = $id;
			$nome = $_POST['nome'];
			$preco = Painel::formatarMoedaBd($_POST['preco']);
			$area = $_POST['area'];

			$imagens = array();
			$amountFiles = count($_FILES['imagens']['name']);

			$sucesso = true;

			if($_FILES['imagens']['name'][0] != ''){

			for($i =0; $i < $amountFiles; $i++){
				$imagemAtual = ['type'=>$_FILES['imagens']['type'][$i],
				'size'=>$_FILES['imagens']['size'][$i]];
				if(Painel::imagemValida($imagemAtual) == false){
					$sucesso = false;
					Painel::alert('erro','Uma das imagens selecionadas são inválidas!');
					break;
				}
			}

			}else{
				$sucesso = false;
				Painel::alert('erro','Você precisa selecionar pelo menos uma imagem!');
			}


			if($sucesso){
				//TODO: Cadastrar informacoes e imagens e realizar upload.
				for($i =0; $i < $amountFiles; $i++){
					$imagemAtual = ['tmp_name'=>$_FILES['imagens']['tmp_name'][$i],
						'name'=>$_FILES['imagens']['name'][$i]];
					$imagens[] = Painel::uploadFile($imagemAtual);
				}

				$sql = MySql::conectar()->prepare("INSERT INTO `tb_admin.imoveis` VALUES (null,?,?,?,?,0)");
				$sql->execute(array($empreendId,$nome,$preco,$area));
				$lastId = MySql::conectar()->lastInsertId();
				foreach ($imagens as $key => $value) {
					MySql::conectar()->exec("INSERT INTO `tb_admin.imagens_imoveis` VALUES (null,$lastId,'$value')");
				}
				Painel::alert('sucesso','O imóvel foi cadastrado com sucesso!');
			}
		}

	?>
		<div class="form-group">
			<label>Nome:</label>
			<input type="text" name="nome">
		</div><!--form-group-->
		<div class="form-group">
			<label>Área:</label>
			<input type="number" name="area" min="0" max="2000" step="1" value="0">
		</div><!--form-group-->
		<div class="form-group">
			<label>Preco:</label>
			<input type="text" name="preco">
		</div><!--form-group-->
		<div class="form-group">
			<label>Selecione Imagens:</label>
			<input type="file" multiple name="imagens[]">
		</div><!--form-group-->
		<div class="form-group">
			<input type="submit" name="acao" value="Cadastrar Imóvel!">
		</div><!--form-group-->
	</form>
	<div class="wraper-table">
	<table>
		<tr style="background: #00bfa5;">
			<td>Nome</td>
			<td>Preço</td>
			<td>Área</td>
			<td>#</td>
		</tr>

		<?php
			$pegaImoveis = Painel::selectQuery('tb_admin.imoveis','empreend_id=?',array($id));
			foreach($pegaImoveis as $key=>$value){
		?>
		<tr>
			<td><?php echo $value['nome']; ?></td>
			<td>R$<?php echo $value['preco']; ?></td>
			<td><?php echo $value['area']; ?>m²</td>
			<td><a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-imovel?id=<?php echo $value['id']; ?>"><i class="fa fa-eye"></i> Visualizar</a></td>
		</tr>
		<?php } ?>
		

	</table>
	</div>
</div><!--box-content-->