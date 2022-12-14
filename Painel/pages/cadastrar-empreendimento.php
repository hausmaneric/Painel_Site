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
                $nome= $_POST['nome'];
                $tipo= $_POST['tipo'];
                $preco= $_POST['preco'];
                $imagem = $_FILES['imagem'];

                if($_FILES['imagem']['name'] == ''){
                    Painel::alert('erro','Você precisar selecionar uma imagem');
                }else{
                    if(Painel::imagemValida($imagem) == false){
                        Painel::alert('erro','Ops. Imagem inválida');
                    }else{
                        $idImagem = Painel::uploadFile($imagem);
                        $slug = Painel::generateSlug($nome);
                        $sql = MySql::conectar()->prepare("INSERT INTO `tb_admin.empreendimentos` VALUES (null,?,?,?,?,?,?)");
                        $sql->execute(array($nome,$tipo,$preco,$idImagem,$slug,0));
                        $lastId = MySql::conectar()->lastInsertId();
                        MySql::conectar()->exec("UPDATE `tb_admin.empreendimentos` SET order_id = $lastId WHERE id = $lastId");
                        Painel::alert('sucesso','Cadastro do empreendimento foi feito com sucesso!');
                    }                    
                }                
            }
        ?>
        <div class="form-group">
            <label>Nome:</label>
            <input type="text" name="nome" />
        </div>
        <div class="form-group">
            <label>Tipo:</label>
            <select name="tipo">
                <option value="residencial">Residencial</option>
                <option value="comercial">Comercial</option>
            </select>
        </div>
        <div class="form-group">
            <label>Preço:</label>
            <input type="text" name="preco" />
        </div>
        <div class="form-group">
            <label>Imagem:</label>
            <input type="file" name="imagem" />
        </div>
        <div class="form-group">
            <input type="submit" name="acao" value="Cadastrar" />
        </div>
    </form>
</div>