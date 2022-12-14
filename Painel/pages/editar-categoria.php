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
    <?php 
        if(isset($_GET['id'])){
            $id = (int)$_GET['id'];
            $categoria = Painel::select('tb_site.categorias','id = ?',array($id));
        }else{
            Painel::alert('erro','Você precisa passar o paramentro ID.');
            die();
        }   
    ?>
    <div class="box-content">
        <h2><i class="fa fa-pencil"></i> Editar Serviço</h2>    
        <form method="post" enctype="multipart/form-data">
        <?php
            if(isset($_POST['acao'])){
                $slug = Painel::generateSlug($_POST['nome']);
                $arr = array_merge($_POST,array('slug'=>$slug));
                $verificar = Mysql::conectar()->prepare("SELECT * FROM `tb_site.categorias` WHERE nome = ? AND id != ?");
                $verificar->execute(array($_POST['nome'],$id));
                if($verificar->rowCount() == 0){
                    Painel::alert('erro','Já existe uma categoria com esse nome');
                }else{
                    if(Painel::update($arr)){
                        Painel::alert('sucesso','A categoria foi editado com sucesso!');
                        if(isset($_GET['id'])){
                            $id = (int)$_GET['id'];
                            $categoria = Painel::select('tb_site.categorias','id = ?',array($id));
                        }else{
                            Painel::alert('erro','Você precisa passar o paramentro ID.');
                            die();
                        } 
                    }else{
                        Painel::alert('erro','Campos vazios não permitidos.');
                    }
                }                
            }   
        ?>  
        <div class="form-group">
            <label>Categoria:</label>   
            <input type="text" name="nome" value="<?php echo $categoria['nome'];?>"  />
        </div>
        <div class="form-group"> 
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="nome_tabela" value="tb_site.categorias" />
            <input type="submit" value="Atualizar" name="acao" />
        </div>
        </form>
    </div>
    
    