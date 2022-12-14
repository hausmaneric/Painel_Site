<?php
	$url = explode('/',$_GET['url']);
	

	$verifica_categoria = MySql::conectar()->prepare("SELECT * FROM `tb_site.categorias` WHERE slug = ?");
	$verifica_categoria->execute(array($url[1]));
	if($verifica_categoria->rowCount() == 0){
		Painel::redirect(INCLUDE_PATH.'noticias');
	}
	$categoria_info = $verifica_categoria->fetch();

	$post = MySql::conectar()->prepare("SELECT * FROM `tb_site.noticias` WHERE slug = ? AND categoria_id = ?");
	$post->execute(array($url[2],$categoria_info['id']));
	if($post->rowCount() == 0){
		Painel::redirect(INCLUDE_PATH.'noticias');
	}

	//É POR QUE MINHA NOTICIA EXISTE
	$post = $post->fetch();

?>
<section class="noticia-single">
	<div class="center">
	<header>
		<h1><i class="fa fa-calendar"></i> <?php echo $post['data'] ?> - <?php echo $post['titulo'] ?></h1>
	</header>
	<article>
		<?php echo $post['conteudo']; ?>
	</article>
	<?php 
		if(Painel::logado() == false){
	?>
		<div class="container-erro-login">
			<p><i class="fa fa-times"></i> Você precisa estar logado para comentar, clique <a href="<?php echo INCLUDE_PATH ?>painel">aqui</a> para efetuar o login.</p>
		</div>
	<?php 
		}else{
	?>	
	<?php
		if(isset($_POST['postar_comentario'])){
			$usuario = $_POST['nome'];
			$comentario = $_POST['mensagem'];
			$noticia_id = $_POST['noticia_id'];

			$sql = MySql::conectar()->prepare("INSERT INTO `tb_site.comentarios` VALUES (null,?,?,?) ");
			$sql->execute(array($usuario,$comentario,$noticia_id));
			echo '<script>alert("Comentário realizado com sucesso")</script>';
		}
	?>
		<h2 class="postar-comentario">Faça um comentário <i class="fa fa-comment"></i></h2>
		<form method="post">
			<input type="text" name="nome" value="<?php echo $_SESSION['nome']; ?>" >
			<textarea name="mensagem" placeholder="Seu comentário..."></textarea>
			<input type="hidden" name="noticia_id" value="<?php echo $post['id'] ?>" >
			<input type="submit" name="postar_comentario" value="Comentar" >
		</form>

		<h2 class="postar-comentario">Comentários existentes <i class="fa fa-comment"></i></h2>
		<?php
			$comentarios = MySql::conectar()->prepare("SELECT * FROM `tb_site.comentarios` WHERE noticia_id = ?");
			$comentarios->execute(array($post['id']));
			$comentarios = $comentarios->fetchAll();
			foreach ($comentarios as $key => $value) {
		?>
		<div class="box-coment-noticia">
			<h3><?php echo $value['nome']; ?></h3>
			<p><?php echo $value['comentario']; ?><p>

			<?php
				if(isset($_POST['resposta_comentario'])){
					$comentarioId = $_POST['comentario_id'];
					$nome = $_POST['nome'];
					$comentario = $_POST['mensagem'];					

					$sql = MySql::conectar()->prepare("INSERT INTO `tb_site.resposta_comentarios` VALUES (null,?,?,?) ");
					$sql->execute(array($comentarioId,$nome,$comentario));
					echo '<script>alert("Resposta realizado com sucesso")</script>';
				}
			?>
				<form method="post" style="margin-top:10px;">
					<input type="text" name="nome" value="<?php echo $_SESSION['nome']; ?>" >
					<textarea name="mensagem" placeholder="Seu comentário..."></textarea>
					<input type="hidden" name="comentario_id" value="<?php echo $value['id']; ?>">
					<input type="submit" name="resposta_comentario" value="Responder" >
				</form>
		</div>

			<h2 class="postar-comentario">Respostas existentes <i class="fa fa-comment"></i></h2>
			<?php
				$respostas = MySql::conectar()->prepare("SELECT * FROM `tb_site.resposta_comentarios` WHERE comentario_id = comentario_id");
				$respostas->execute();
				$respostas = $respostas->fetchAll();
				foreach ($respostas as $key => $value) {
			?>
			<div class="box-respost-noticia">
				<h3><?php echo $value['nome']; ?></h3>
				<p><?php echo $value['comentario']; ?><p>
			</div>

			<?php } ?> 
		<?php } ?>

		
		
	<?php
		}
	?>
	</div>
</section>
