<style>
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
    .box-chat-online{
        height: 300px;
        overflow-y: scroll;
        padding: 40px 10px 20px 10px;
        margin: 20px 0;
        border: 1px solid #ccc;
    }
    .mensagem-chat{
        padding: 8px 0;
        border-bottom: 1px dotted rgb(210, 210, 210);
    }
    .mensagem-chat span{
        background: #00bfa5;
        padding: 2px 8px;
        border-radius: 10px;
    }
    .mensagem-chat p{
        font-size: 15px;
        color: #646464;
        padding: 2px 8px;
    }
</style>

<div class="box-content">
	<h2><i class="fa fa-comments" aria-hidden="true"></i> Chat Online</h2>
	<div class="box-chat-online">

		<?php
			$mensagens = MySql::conectar()->prepare("SELECT * FROM `tb_admin.chat` ORDER BY id DESC LIMIT 10");
			$mensagens->execute();
			$mensagens = $mensagens->fetchAll();
			$mensagens = array_reverse($mensagens);
			foreach ($mensagens as $key => $value) {
			$nomeUsuario = MySql::conectar()->prepare("SELECT nome FROM `tb_admin.usuarios` WHERE id = $value[user_id]");
			$nomeUsuario->execute();
			$nomeUsuario = $nomeUsuario->fetch()['nome'];
			$lastId = $value['id'];
		?>
		<div class="mensagem-chat">
			<span><?php echo $nomeUsuario ?>:</span>
			<p><?php echo $value['mensagem']; ?></p>
		</div><!--mensagem-chat-->
		<?php 
			$_SESSION['lastIdChat'] = $lastId;
		} ?>

	</div><!--box-chat-online-->
	<form method="post" action="<?php echo INCLUDE_PATH_PAINEL ?>ajax/chat.php">
		<textarea name="mensagem"></textarea>
		<input type="submit" name="acao" value="Enviar">
	</form>
</div>