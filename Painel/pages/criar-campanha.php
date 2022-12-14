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
	if(isset($_POST['acao']))
	{
		$conteudo = $_POST['conteudo'];
		$assunto = $_POST['assunto'];
		$contatos = \MySql::conectar()->prepare("SELECT * FROM `tb_admin.contatos` WHERE lista_id = ?");
		$contatos->execute(array($_POST['lista_id']));
		$contatos = $contatos->fetchAll();
		foreach ($contatos as $key => $value) {
			$mail = new \Email('smtp.gmail.com','eric.hausman.m@gmail.com','oixnmgxegkvkjlnd','Eric');
			$mail->formatarEmail(array('assunto'=>$assunto,'corpo'=>$conteudo));
			$email_atual = $value['email'];
			$mail->addAdress($email_atual,'');
			$mail->enviarEmail();
			sleep(1);
		}
		Painel::alert('sucesso','Campanha enviada com sucesso!');
	}
	
?>

<h2><i class="fa fa-pencil"></i> Enviar e-mail para lista</h2>

	<form method="post">
		
		<div class="form-group">
		<label>Escolha a lista:</label>
			<select name="lista_id">
				<?php
						$listas = \MySql::conectar()->prepare("SELECT * FROM `tb_admin.listas_email`");
						$listas->execute();
						$listas = $listas->fetchAll();
						foreach ($listas as $key => $value) {
				?>
						<option value="<?php echo $value['id'] ?>"><?php echo $value['nome_lista'] ?></option>
				<?php } ?>
			</select>
		</div><!--form-group-->
		<div class="form-group">
			<label>Assunto:</label>
			<input type="text" name="assunto">
		</div>
		<div class="form-group">
		<label>Texto do seu e-mail:</label>
		<textarea name="conteudo"></textarea>
		</div>
		<div class="form-group">
			<input type="submit" name="acao" value="Disparar">
		</div><!--form-group-->
	</form>
</div>