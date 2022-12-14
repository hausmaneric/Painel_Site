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
        $site = Painel::select('tb_site.config',false);
    ?>
    
    <div class="box-content">
        <h2><i class="fa fa-pencil"></i> Editar Configurações do Site</h2>    
        <form method="post" enctype="multipart/form-data">
        <?php
            if(isset($_POST['acao'])){
                if(Painel::update($_POST,true)){
                    Painel::alert('sucesso','O depoimento foi editado com sucesso!');
                }else{
                    Painel::alert('erro','Campos vazios não permitidos.');
                }
            }   
        ?> 
        <div class="form-group">
            <label>Titulo:</label>   
            <input type="text" name="titulo" value="<?php echo $site['titulo']; ?>" />
        </div> 
        <div class="form-group">
            <label>Nome do autor do site:</label>   
            <input type="text" name="nome" value="<?php echo $site['nome']; ?>" />
        </div>
        <div class="form-group">
            <label>Descrição do autor do site:</label>   
            <textarea name="descricao"><?php echo $site['descricao']; ?></textarea>
        </div>
        <div class="form-group">
            <label>Icone 1:</label>   
            <input type="text" name="icone1" value="<?php echo $site['icone1']; ?>" />
        </div>
        <div class="form-group">
            <label>Descrição 1 Especialidades:</label>   
            <textarea name="descricao1"><?php echo $site['descricao1']; ?></textarea>
        </div>
        <div class="form-group">
            <label>Icone 2:</label>   
            <input type="text" name="icone1" value="<?php echo $site['icone1']; ?>" />
        </div>
        <div class="form-group">
            <label>Descrição 2 Especialidades:</label>   
            <textarea name="descricao2"><?php echo $site['descricao2']; ?></textarea>
        </div>
        <div class="form-group">
            <label>Icone 3:</label>   
            <input type="text" name="icone3" value="<?php echo $site['icone3']; ?>" />
        </div>
        <div class="form-group">
            <label>Descrição 3 Especialidades:</label>   
            <textarea name="descricao3"><?php echo $site['descricao3']; ?></textarea>
        </div>
        <div class="form-group"> 
            <input type="hidden" name="nome_tabela" value="tb_site.config" />
            <input type="submit" value="Atualizar" name="acao" />
        </div>
        </form>
    </div>
    
    