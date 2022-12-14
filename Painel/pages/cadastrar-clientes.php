<style type="text/css" rel="stylesheet">
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
        verificaPermissaoMenu(2);
    ?>
    
    <div class="box-content">
        <h2><i class="fa fa-pencil"></i> Cadastrar Clientes</h2>    
        <form class="ajax" action="<?php echo INCLUDE_PATH_PAINEL ?>ajax/forms.php" method="post" enctype="multipart/form-data">          
            <div class="form-group">
                <label>Nome:</label>   
                <input type="text" name="nome" />
            </div>
            <div class="form-group">
                <label>Email:</label>   
                <input type="text" name="email" />
            </div>  
            <div class="form-group">
                <label>Tipo:</label>   
                <select name="tipo_cliente">
                    <option value="fisico">Fisico</option>
                    <option value="juridico">Juridico</option>
                </select>
            </div>
            <div ref="cpf" class="form-group">
                <label>CPF:</label>   
                <input type="text" name="cpf" />
            </div>  
            <div style="display:none;" ref="cnpj" class="form-group">
                <label>CNPJ:</label>   
                <input type="text" name="cnpj" />
            </div>  
            <div class="form-group">
                <label>Imagem:</label>   
                <input type="file" name="imagem" />
                <input type="hidden" name="imagem_atual" />
            </div>
            <div class="form-group"> 
                <input type="hidden" value="cadastrar_cliente" name="tipo_acao" />
            </div>
            <div class="form-group"> 
                <input type="submit" value="Cadastrar" name="acao" />
            </div>
        </form>
    </div>
    
    