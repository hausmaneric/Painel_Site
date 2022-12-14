
<style>
.wraper-table{
    overflow-x: auto;
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

.gerar-pdf{display:block;margin: 8px 0px;}
.gerar-pdf a{
    color: white;
    padding: 3px 8px;
    background: #e05c4e;
    text-decoration: none;
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

</style>
<div class="box-content">

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


	<?php
	if(isset($_GET['pago'])){
			$sql = MySql::conectar()->prepare("UPDATE `tb_admin.financeiro` SET status = 1 WHERE id = ?");
			$sql->execute(array($_GET['pago']));
			Painel::alert('sucesso','O pagamento foi quitado com sucesso!');
	}
	?>

	<h2><i class="fa fa-id-card"></i> Pagamentos Pendentes</h2>
	<div class="gerar-pdf">
		<a target="_blank" href="<?php echo INCLUDE_PATH_PAINEL ?>gerar-pdf.php?pagamento=pendentes">Gerar PDF</a>
	</div>

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
			$sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.financeiro` WHERE status = 0 ORDER BY vencimento ASC");
			$sql->execute();
			$pendentes = $sql->fetchAll();

			foreach ($pendentes as $key => $value) {
			$clienteNome = MySql::conectar()->prepare("SELECT `nome`,`id` FROM `tb_admin.clientes` WHERE id = $value[cliente_id]");
			$clienteNome->execute();
			$info = $clienteNome->fetch();
			$clienteNome = $info['nome'];
			$idCliente = $info['id'];
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
			<td><a style="background: #00bfa5;" class="btn" href="<?php echo INCLUDE_PATH_PAINEL ?>visualizar-pagamentos?pago=<?php echo $value['id'] ?>"><i class="fa fa-check"></i> Pago</a></td>
		</tr>

		<?php } ?>
	</table>
	</div>


	<h2><i class="fa fa-id-card"></i> Pagamentos Concluidos</h2>
	<div class="gerar-pdf">
		<a href="<?php echo INCLUDE_PATH_PAINEL ?>gerar-pdf.php?pagamento=concluidos" target="_blank">Gerar PDF</a>
	</div>
	<div class="wraper-table">
	<table>
		<tr>
			<td>Nome do pagamento</td>
			<td>Cliente</td>
			<td>Valor</td>
			<td>Vencimento</td>
		</tr>

		<?php
			$sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.financeiro` WHERE status = 1 ORDER BY vencimento ASC");
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