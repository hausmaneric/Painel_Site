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
        margin-top: 8px;
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

    a.btn.edit{
        background: #f4b03e;      
    }

    a.btn.delete{
        background: #e05c4e;
    } 

</style>
<div class="box-content">
<?php
	if(isset($_POST['acao'])){
		$nome_lista = $_POST['nome_lista'];
		$sql = \MySql::conectar()->prepare("INSERT INTO `tb_admin.listas_email` VALUES (null,?)");
		$sql->execute(array($nome_lista));
		Painel::alert('sucesso','A lista foi criada com sucesso!');
	}
?>

	<h2><i class="fa fa-pencil"></i> Adicionar nova lista</h2>

	<form method="post">
		
		<div class="form-group">
			<label>Nome da lista:</label>
			<input type="text" name="nome_lista">
		</div><!--form-group-->
		<div class="form-group">
			<input type="submit" name="acao" value="Criar Lista">
		</div><!--form-group-->
	</form>


	<h2><i class="fa fa-pencil"></i> Listas Disponíveis</h2>

	<div class="wraper-table">
	<table>

		<tr>
			<td>Nome</td>
			<td>#</td>
		</tr>

		<?php
			$listas = \MySql::conectar()->prepare("SELECT * FROM `tb_admin.listas_email`");
			$listas->execute();
			$listas = $listas->fetchAll();
			foreach ($listas as $key => $value) {
		?>

		<tr>
			<td><?php echo $value['nome_lista']; ?></td>
			<td><a actionBtn="delete" class="btn delete" href="<?php echo INCLUDE_PATH_PAINEL ?>listar-servicos?excluir=<?php echo $value['id']; ?>"><i class="fa fa-times"></i> Excluir</a></td>
		</tr>

		<?php } ?>

	</table>

	</div><!--wraper-table-->

</div>