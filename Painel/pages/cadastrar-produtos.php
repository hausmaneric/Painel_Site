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

    .box-content form input[type=number]{
        font-size: 16px;
        font-weight: normal;
        color: black;
        width: 100%;
        height: 40px;
        border: 1px solid #ccc;
        padding-left: 8px;  
        padding-right: 8px;  
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
        <h2><i class="fa fa-pencil"></i> Cadastrar Produto</h2>         
        <form method="post" enctype="multipart/form-data"> 
            <?php
                if(isset($_POST['acao'])){
                    $nome        = $_POST['nome'];
                    $descricao   = $_POST['descricao'];
                    $largura     = $_POST['largura'];
                    $altura      = $_POST['altura'];
                    $comprimento = $_POST['comprimento'];
                    $peso        = $_POST['peso'];
                    $quantidade  = $_POST['quantidade'];
                    $preco       = $_POST['preco'];

                    $imagens= array();
                    $amoutFiles = count($_FILES['imagem']['name']);

                    $sucesso = true;

                    if($_FILES['imagem']['name'][0]){
                    for($i = 0; $i < $amoutFiles; $i++){
                        $imagemAtual = ['type'=>$_FILES['imagem']['type'][$i],
                        'size'=>$_FILES['imagem']['size'][$i]];
                        if(Painel::imagemValida($imagemAtual) == false){
                            $sucesso = false;
                            Painel::alert('erro','Uma das imagens é inválida');
                            break;
                        }
                    }  
                    }else{
                        $sucesso = false;
                        Painel::alert('erro','Você precisa selecionar pelo menos uma imagem!');
                    }                 
                    if($sucesso){
                        for($i = 0; $i < $amoutFiles; $i++){
                            $imagemAtual = ['tmp_name'=>$_FILES['imagem']['tmp_name'][$i],
                            'name'=>$_FILES['imagem']['name'][$i]];
                            $imagens[] = Painel::uploadFile($imagemAtual);   
                        } 

                        $sql = Mysql::conectar()->prepare("INSERT INTO `tb_admin.estoque` VALUES (null,?,?,?,?,?,?,?,?) ");
                        $sql->execute(array($nome,$descricao,$largura,$altura,$comprimento,$peso,$quantidade,$preco));
                        $lastId = MySql::conectar()->lastInsertId();
                        foreach ($imagens as $key => $value) {
                            Mysql::conectar()->exec("INSERT INTO `tb_admin.estoque_imagens` VALUES (null,$lastId,'$value')");
                        }
                        Painel::alert('sucesso','O produto foi cadastrado com sucesso!');
                    }
                    
                }
            ?>
            <div class="form-group">
                <label>Nome do produto:</label>   
                <input type="text" name="nome" >
            </div>
            <div class="form-group">
                <label>Descrição do produto:</label>   
                <textarea type="text" name="descricao"></textarea>
            </div>
            <div class="form-group">
                <label>Largura do produto:</label>   
                <input type="number" name="largura" min="0" max="900" step="1" value="0" >
            </div>
            <div class="form-group">
                <label>Altura do produto:</label>   
                <input type="number" name="altura" min="0" max="900" step="1" value="0" >
            </div>
            <div class="form-group">
                <label>Comprimento do produto:</label>   
                <input type="number" name="comprimento" min="0" max="900" step="1" value="0" >
            </div>   
            <div class="form-group">
                <label>Peso do produto:</label>   
                <input type="number" name="peso" min="0" max="900" step="1" value="0" >
            </div>           
            <div class="form-group">
                <label>Quantidade do produto:</label>   
                <input type="number" name="quantidade" min="0" max="900" step="1" value="0" >
            </div>
            <div class="form-group">
                <label>Preço:</label>   
                <input type="text" name="preco" >
            </div>
            <div class="form-group">
                <label>Selecione as imagens:</label>   
                <input multiple type="file" name="imagem[]" />
            </div>
            <div class="form-group"> 
                <input type="submit" value="Cadastrar!" name="acao" />
            </div>
        </form>
    </div>