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
            $slide = Painel::select('tb_site.slides','id = ?',array($id));
        }else{
            Painel::alert('erro','Você precisa passar o paramentro ID.');
            die();
        }   
    ?>    
    <div class="box-content">
        <h2><i class="fa fa-pencil"></i> Editar Slide</h2>    
        <form method="post" enctype="multipart/form-data">
        <?php
              if(isset($_POST['acao'])){
                $nome = $_POST['nome'];
                $imagem = $_FILES['imagem'];
                $imagem_atual = $_POST['imagem_atual'];
                if($imagem['name'] != ''){                    
                    if(Painel::imagemValida($imagem)){
                        Painel::deleteFile($imagem);
                        $imagem = Painel::uploadFile($imagem);   
                        $arr = ['nome'=>$nome,'slide'=>$imagem,'id'=>$id,'nome_tabela'=>'tb_site.slides'];
                        Painel::update($arr);         
                        Painel::alert('sucesso','O slide foi atualizado com sucesso');            
                    }else{
                        Painel::alert('erro','O formato não é válido');
                    }
                }else{
                    $imagem = $imagem_atual;
                    $arr = ['nome'=>$nome,'slide'=>$imagem,'id'=>$id,'nome_tabela'=>'tb_site.slides'];
                    Painel::update($arr);  
                    if(isset($_GET['id'])){
                        $id = (int)$_GET['id'];
                        $slide = Painel::select('tb_site.slides','id = ?',array($id));
                    }else{
                        Painel::alert('erro','Você precisa passar o paramentro ID.');
                        die();
                    }
                    Painel::alert('sucesso','O slide foi atualizado com sucesso');   
                }
              }  
            ?>            
            <div class="form-group">
                <label>Nome do Slide:</label>   
                <input type="text" required name="nome" value="<?php echo $slide['nome']; ?>" />
            </div>
            <div class="form-group">
                <label>Imagem:</label>   
                <input type="file" name="imagem" />
                <input type="hidden" name="imagem_atual" value="<?php echo $slide['slide']; ?>"/>
            </div>
            <div class="form-group"> 
                <input type="submit" value="Atualizar" name="acao" />
            </div>
        </form>
    </div>
    
    