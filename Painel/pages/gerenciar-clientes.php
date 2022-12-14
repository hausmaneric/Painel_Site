
<style rel="stylesheet">
    .box-single-wrapper{
        float: left;
        width: 33.3%;
        padding: 20px;
    }
    .box-single{
        width: 100%;
        border: 1px solid #ccc;
        min-height: 250px;  
        overflow-x: auto;
    }
    .topo-box{
        text-align: center;
        color: #ccc;
        padding: 8px 0;
        border-bottom: 1px solid #ccc;   
    }

    .topo-box img{
        display: block;
        max-width: 150px;
        margin: 0 auto;
    }

    .topo-box h2{
        font-size: 36px;
    }
    .body-box{
        padding: 10px;
    }
    .body-box p{
        color: #646464;
        font-size: 15px;
        margin-bottom: 8px;
    }

    .group-btn{
        margin-top: 15px;
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

	.busca{
		width: 100%;
		padding: 4px 10px;
		margin: 10px 0;
	}

	.busca h4{
		color: white;
		font-size: 25px;
		font-weight: light;
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

    @media screen and (max-width:768px) {
        .box-single-wrapper{
            width: 100%;
        }
    }
</style>
<div class="box-content">
	<h2><i class="fa fa-id-card" aria-hidden="true"></i> Clientes Cadastrados</h2>
	<div class="busca">
		<h4><i class="fa fa-search"></i> Realizar uma busca</h4>
		<form method="post">
			<input placeholder="Procure por: nome, email, cpf ou cnpj" type="text" name="busca">
			<input type="submit" name="acao" value="Buscar!">
		</form>
	</div>
	<div class="boxes">
	<?php
		$query = "";
		if(isset($_POST['acao'])){
			$busca = $_POST['busca'];
			$query = " WHERE nome LIKE '%$busca%' OR email LIKE '%$busca%' OR cpf_cnpj LIKE '%$busca%'";
		}
		$clientes = MySql::conectar()->prepare("SELECT * FROM `tb_admin.clientes` $query");
		$clientes->execute();
		$clientes = $clientes->fetchAll();
		if(isset($_POST['acao'])){
			echo '<div style="width:100%;" class="busca-result"><p>Foram encontrados <b>'.count($clientes).'</b> resultado(s)</p></div>';
		}
		foreach($clientes as $value){
	?>
		<div class="box-single-wrapper">
			<div class="box-single">
				<div class="topo-box">
					<?php
						if($value['imagem'] == ''){
					?>
					<h2><i class="fa fa-user"></i></h2>
					<?php }else{ ?>
						<img src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $value['imagem']; ?>" />
					<?php } ?>
				</div><!--topo-box-->
				<div class="body-box">
					<p><b><i class="fa fa-pencil"></i> Nome do cliente:</b> <?php echo $value['Nome']; ?></p>
					<p><b><i class="fa fa-pencil"></i> E-mail:</b> <?php echo $value['Email']; ?></p>
					<p><b><i class="fa fa-pencil"></i> Tipo:</b> <?php echo ucfirst($value['tipo']); ?></p>
					<p><b><i class="fa fa-pencil"></i> <?php
						if($value['tipo'] == 'fisico')
							echo 'CPF: ';
						else
							echo 'CNPJ: ';
					 ?>:</b> <?php echo $value['cpf_cnpj']; ?></p>
					<div class="group-btn">
						<a class="btn deletar" item_id="<?php echo $value['id'];?>" href="<?php echo INCLUDE_PATH_PAINEL ?>"><i class="fa fa-times"></i> Excluir</a>
						<a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-cliente?id=<?php echo $value['id']; ?>"><i class="fa fa-pencil"></i> Editar</a>
					</div><!--group-btn-->
				</div><!--body-box-->
			</div><!--box-single-->
		</div><!--box-single-wraper-->

		<?php } ?>

		<div class="clear"></div>

	</div><!--boxes-->

</div><!--box-content-->