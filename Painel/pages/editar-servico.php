<?php 
    if(isset($_GET['id'])){
        $id = (int)$_GET['id'];
        $servico = Painel::select('tb_site.servicos','id = ?',array($id));
    }else{
        Painel::alert('erro','Você precisa passar o paramentro ID.');
        die();
    }   
?>

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
        <h2><i class="fa fa-pencil"></i> Editar Serviço</h2>    
        <form method="post" enctype="multipart/form-data">
        <?php
            if(isset($_POST['acao'])){
                if(Painel::update($_POST)){
                    Painel::alert('sucesso','O serviço foi editado com sucesso!');
                    if(isset($_GET['id'])){
                        $id = (int)$_GET['id'];
                        $servico = Painel::select('tb_site.servicos','id = ?',array($id));
                    }else{
                        Painel::alert('erro','Você precisa passar o paramentro ID.');
                        die();
                    } 
                }else{
                    Painel::alert('erro','Campos vazios não permitidos.');
                }
            }   
        ?>  
        <div class="form-group">
            <label>Serviço:</label>   
            <textarea name="servico"><?php echo $servico['servico']; ?></textarea>
        </div>
        <div class="form-group"> 
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="nome_tabela" value="tb_site.servicos" />
            <input type="submit" value="Atualizar" name="acao" />
        </div>
        </form>
    </div>
    
    