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
    
    .box-content form input[type=file]{
        width: 100%;
        padding: 8px;
        margin-top: 8px;
        border: 1px solid #ccc;
    }

    .box-content input[type=submit]{
        width: auto;
        padding: 3px 8px;
        height: 40px;
        cursor: pointer;
        font-size: 14px;
        margin-top: 8px;
        background: #1de9b6; 
        border: 0;
        color: white;
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

    a.btn.order{
        background: #0091ea;
    }

    .paginacao{
        text-align: center;
    }

    .paginacao a{
        font-size: 14px;
        margin: 0 8px;
        display: inline-block;
        padding: 3px 4px;
        border: 1px solid #ccc;
        text-decoration: none;
        color: #666;
    }

    .paginacao a.page-selected{
        background: rgb(220, 220, 220);
    }

    .vencimento{
        padding-right: 10px;
    }
    </style>

<?php
	if(isset($_GET['id'])){
		$id = (int)$_GET['id'];
		$cliente = Painel::select('tb_admin.clientes','id = ?',array($id));
	}else{
		Painel::alert('erro','Você precisa passar o parametro ID.');
		die();
	}
?>
<div class="box-content">
	<h2><i class="fa fa-pencil"></i> Editar Cliente</h2>

	<form class="ajax" atualizar method="post" action="<?php echo INCLUDE_PATH_PAINEL ?>ajax/forms.php" enctype="multipart/form-data">

		<div class="form-group">
			<label>Nome:</label>
			<input type="text" name="nome" value="<?php echo $cliente['Nome']; ?>">
		</div><!--form-group-->
		<div class="form-group">
			<label>E-mail:</label>
			<input type="text" name="email" value="<?php echo $cliente['Email']; ?>">
		</div><!--form-group-->

		<div class="form-group">
			<label>Tipo:</label>
			<select name="tipo_cliente">
				<option <?php if($cliente['tipo'] == 'fisico') echo 'selected'; ?> value="fisico">Fisico</option>
				<option <?php if($cliente['tipo'] == 'juridico') echo 'selected'; ?> value="juridico">Jurídico</option>
			</select>
		</div><!--form-group-->

		<?php
			if($cliente['tipo'] == 'fisico'){
		?>

		<div ref="cpf" class="form-group">
			<label>CPF</label>
			<input type="text" name="cpf" value="<?php echo $cliente['cpf_cnpj']; ?>" />
		</div><!--form-group-->

		<div style="display: none;" ref="cnpj" class="form-group">
			<label>CNPJ</label>
			<input type="text" name="cnpj" />
		</div><!--form-group-->

		<?php }else{ ?>
		<div style="display: none;" ref="cpf" class="form-group">
			<label>CPF</label>
			<input type="text" name="cpf" />
		</div><!--form-group-->

		<div style="display: block;" ref="cnpj" class="form-group">
			<label>CNPJ</label>
			<input type="text" name="cnpj" value="<?php echo $cliente['cpf_cnpj']; ?>" />
		</div><!--form-group-->

		<?php } ?>
		
		<div class="form-group">
			<label>Imagem</label>
			<input type="file" name="imagem"/>
		</div><!--form-group-->

		<div class="form-group">
			<input type="hidden" name="imagem_original" value="<?php echo $cliente['imagem']; ?>">
		</div><!--form-group-->

		<div class="form-group">
			<input type="hidden" name="tipo_acao" value="atualizar_cliente">
		</div>

		<div class="form-group">
			<input type="hidden" name="id" value="<?php echo $cliente['id']; ?>">
		</div>

		<div class="form-group">
			<input type="submit" name="acao" value="Atualizar!">
		</div><!--form-group-->

	</form>


	<h2><i class="fa fa-pencil"></i> Adicionar Pagamentos</h2>

	<form method="post">

	<?php
		if(isset($_POST['acao'])){
			$cliente_id = $id;
			$nome = $_POST['nome_pagto'];
			//$valor = str_replace('.','',$_POST['valor']);
			//$valor = str_replace(',','.',$valor);
			$valor = $_POST['valor'];
			$intervalo = $_POST['intervalo'];
			$numero_parcelas = $_POST['parcelas'];
			$status = 0;
			$vencimentoOriginal = $_POST['vencimento'];

			if(strtotime($vencimentoOriginal) < strtotime(date('Y-m-d'))){
				Painel::alert('erro','Você selecionou uma data negativa!');
			}else{

			for($i = 0; $i < $numero_parcelas; $i++){
				$vencimento = strtotime($vencimentoOriginal) + (($i * $intervalo) *(60));
				$sql = MySql::conectar()->prepare("INSERT INTO `tb_admin.financeiro` VALUES (null,?,?,?,?,?)");
				$sql->execute(array($cliente_id,$nome,$valor,date('Y-m-d',$vencimento),0));
			}
			Painel::alert('sucesso','O(s) pagamento(s) foi inserido com sucesso!');
			}

		}
        if(isset($_GET['pago'])){
            $sql = MySql::conectar()->prepare('UPDATE `tb_admin.financeiro` SET status = 1 WHERE id = ?');
            $sql->execute(array($_GET['pago']));
            Painel::alert('sucesso','O pagamento foi quitado com sucesso!');    
        }

	?>

	    <div class="form-group">
			<label>Nome do pagamento:</label>
			<input type="text" name="nome_pagto" />
	    </div><!--form-group-->
		
	    <div class="form-group">
			<label>Valor do pagamento:</label>
			<input type="text" name="valor" />
	    </div><!--form-group-->
	    <div class="form-group">
			<label>Número de parcelas:</label>
			<input type="text" name="parcelas" />
	    </div><!--form-group-->
	    <div class="form-group">
			<label>Intervalo:</label>
			<input type="text" name="intervalo" />
	    </div><!--form-group-->
		<div class="form-group">
			<label>Vencimento:</label>
			<input class="vencimento" type="text" name="vencimento" />
	    </div><!--form-group-->
        <div class="form-group">
			<input type="hidden" name="pagamento" />
	    </div><!--form-group-->
		<div class="form-group">
			<input type="submit" name="acao" value="Inserir Pagamento">
		</div><!--form-group-->
	</form>

	<?php
	if(isset($_GET['pago'])){
			$sql = MySql::conectar()->prepare("UPDATE `tb_admin.financeiro` SET status = 1 WHERE id = ?");
			$sql->execute(array($_GET['pago']));
			Painel::alert('sucesso','O pagamento foi quitado com sucesso!');
	}
	?>
	<?php
	if(isset($_GET['email'])){
		//Queremos enviar um e-mail avisando o atraso!
		$parcela_id = (int)$_GET['parcela'];
		$cliente_id = (int)$_GET['email'];
		if(isset($_COOKIE['cliente_'.$cliente_id])){
			Painel::alert('erro','Você já enviou um e-mail cobrando desse cliente! Aguarde mais um pouco.');
		}else{
			//Podemos enviar o e-mail
			$sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.financeiro` WHERE id = $parcela_id");
			$sql->execute();
			$infoFinanceiro = $sql->fetch();
			$sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.clientes` WHERE id = $cliente_id");
			$sql->execute();
			$infoCliente = $sql->fetch();
			$corpoEmail = "Olá $infoCliente[Nome], você está com um saldo pendente de $infoFinanceiro[valor] com o vencimento para $infoFinanceiro[vencimento].	Entre em contato conosco para quitar sua parcela!";
			$email = new Email('smtp.gmail.com','eric.hausman.m@gmail.com','oixnmgxegkvkjlnd','Eric');
			$email->addAdress($infoCliente['Email'],$infoCliente['Nome']);
			$email->formatarEmail(array('assunto'=>'Cobrança','corpo'=>$corpoEmail));
			$email->enviarEmail();
			Painel::alert('sucesso','E-mail enviado com sucesso!');
			// setcookie('cliente_'.$cliente_id,'true',time()+30,'/');
		}
	}

?>
	<h2><i class="fa fa-id-card-o"></i> Pagamentos Pendentes</h2>

	<div class="wraper-table">
	<table>
		<tr>
			<td>Nome do pagamento</td>
			<td>Cliente</td>
			<td>Valor</td>
			<td>Vencimento</td>
			<td>Enviar e-mail</td>
			<td>Marcar como pago</td>
		</tr>

		<?php
			$sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.financeiro` WHERE status = 0 AND cliente_id = $id ORDER BY vencimento ASC ");
			$sql->execute();
			$pendentes = $sql->fetchAll();

			foreach ($pendentes as $key => $value) {
			$clienteNome = MySql::conectar()->prepare("SELECT `nome` FROM `tb_admin.clientes` WHERE id = $value[cliente_id]");
			$clienteNome->execute();
			$clienteNome = $clienteNome->fetch()['nome'];
			$style="";
			if(strtotime(date('Y-m-d')) >= strtotime($value['vencimento'])){
				$style = 'style="background-color:#ff7070;font-weight:bold;"';
			}
		?>
		<tr <?php echo $style; ?>>
			<td><?php echo $value['nome']; ?></td>
			<td><?php echo $clienteNome; ?></td>
			<td><?php echo $value['valor']; ?></td>
			<td><?php echo date('d/m/Y',strtotime($value['vencimento'])); ?></td>
			<td><a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL ?>visualizar-pagamentos?email=<?php echo $info['id']; ?>&parcela=<?php echo $value['id'];  ?>"><i class="fa fa-envelope" aria-hidden="true"></i> E-mail</a></td>
			<td><a style="background: #00bfa5;" class="btn" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-cliente?id=<?php echo $id; ?>&pago=<?php echo $value['id'] ?>"><i class="fa fa-check"></i> Pago</a></td>
		</tr>

		<?php } ?>

		

	</table>
	</div>

	<h2><i class="fa fa-id-card-o"></i> Pagamentos Concluidos</h2>

	<div class="wraper-table">
	<table>
		<tr>
			<td>Nome do pagamento</td>
			<td>Cliente</td>
			<td>Valor</td>
			<td>Vencimento</td>
		</tr>

		<?php
			$sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.financeiro` WHERE status = 1 AND cliente_id=$id ORDER BY vencimento ASC");
			$sql->execute();
			$pendentes = $sql->fetchAll();

			foreach ($pendentes as $key => $value) {
			$clienteNome = MySql::conectar()->prepare("SELECT `nome` FROM `tb_admin.clientes` WHERE id = $value[cliente_id]");
			$clienteNome->execute();
			$clienteNome = $clienteNome->fetch()['nome'];
			$style="";
			if(strtotime(date('Y-m-d')) <=> strtotime($value['vencimento'])){
				$style = 'style="background-color:#00bfa5;font-weight:bold;"';
			}
		?>
		<tr <?php echo $style; ?>>
			<td><?php echo $value['nome']; ?></td>
			<td><?php echo $clienteNome; ?></td>
			<td><?php echo $value['valor']; ?></td>
			<td><?php echo date('d/m/Y',strtotime($value['vencimento'])); ?></td>
		</tr>

		<?php } ?>

	</table>
	</div>

</div><!--box-content-->
    
    