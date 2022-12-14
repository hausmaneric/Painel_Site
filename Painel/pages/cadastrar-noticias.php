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
    </style>

    <div class="box-content">
        <h2><i class="fa fa-pencil"></i> Cadastrar Noticias</h2>    
        <form method="post" enctype="multipart/form-data">
        <?php
              if(isset($_POST['acao'])){
                $categoria_id = $_POST['categoria_id'];
                $titulo = $_POST['titulo'];
                $conteudo = $_POST['conteudo'];
                $capa = $_FILES['capa'];

                if($titulo == '' ){
                    Painel::alert('erro','Campos vazios não são permitidos');
                }else if($capa['tmp_name'] == ''){
                    Painel::alert('erro','A imagem de capa precisa ser selecionada');    
                }else{
                    if(Painel::imagemValida($capa)){
                        $verifica = MySql::conectar()->prepare("SELECT * FROM `tb_site.noticias` WHERE titulo=?");
                        $verifica->execute(array($titulo));
                        if($verifica->rowCount() == 0){
                            $imagem = Painel::uploadFile($capa);
                            $slug = Painel::generateSlug($titulo);
                            $arr = [
                                'categoria_id'=>$categoria_id,
                                'data'=>date('Y-m-d'),
                                'titulo'=>$titulo,
                                'conteudo'=>$conteudo,
                                'capa'=>$imagem,
                                'slug'=>$slug,
                                'order_id'=>'0',
                                'nome_tabela'=>'tb_site.noticias'];
                            if(Painel::insert($arr)){
                                Painel::alert('sucesso','Cadastro da noticia foi realizado com sucesso!');
                            }
                        }else{
                            Painel::alert('erro','Já existe uma noticia com esse nome');    
                        }
                    }else{
                        Painel::alert('erro','Seleciona uma imagem válida!');      
                    }
                     
                }
              }   
            ?>    
            <div class="form-group"> 
                <label>Categoria:</label>
                <select name="categoria_id">
                    <?php 
                        $categorias = Painel::selectAll('tb_site.categorias');
                        foreach ($categorias as $key => $value) {
                    ?>
                    <option value="<?php echo $value['id'] ?>"><?php echo $value['nome']; ?></option>
                    <?php } ?>
                </select>
            </div>   
            <div class="form-group">
                <label>Titulo:</label>   
                <input type="text" name="titulo" >
            </div>
            <div class="form-group">
                <label>Conteúdo:</label>   
                <textarea class="tinymce" type="text" name="conteudo"></textarea>
            </div>
            <div class="form-group">
                <label>Imagem:</label>   
                <input type="file" name="capa" />
            </div>
            <div class="form-group"> 
                <input type="hidden" name="order_id" value="0" />
                <input type="hidden" name="nome_tabela" value="tb_site.noticias" />
                <input type="submit" value="Cadastrar!" name="acao" />
            </div>
        </form>
    </div>
    
    