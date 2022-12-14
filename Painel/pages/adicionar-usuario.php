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
        <h2><i class="fa fa-pencil"></i> Adicionar Usuário</h2>    
        <form method="post" enctype="multipart/form-data">
        <?php
              if(isset($_POST['acao'])){
                $nome = $_POST['nome'];
                $senha = $_POST['password'];
                $imagem = $_FILES['imagem'];
                $cargo = $_POST['cargo'];
                $login = $_POST['login'];

                if($login == ''){
                    Painel::alert('erro','O login está vázia!');
                }else if($nome == ''){
                    Painel::alert('erro','O nome está vázia!');
                }else if($senha == ''){
                    Painel::alert('erro','A senha está vázia!');
                }else if($cargo == ''){
                    Painel::alert('erro','O cargo precisa estar selecionado!');
                }else if($imagem['name'] == ''){
                    Painel::alert('erro','A imagem precisa está selecionada!');
                }else{
                    if($cargo >= $_SESSION['cargo']){
                        Painel::alert('erro','Você precisa selecionar um cargo menor que o seu!');
                    }else if(Painel::imagemValida($imagem) == false){
                        Painel::alert('erro','O formato especificado não está correto!');
                    }else if(Usuario::userExists($login)){
                        Painel::alert('erro','O login já existe, selecione outro!');
                    }else{
                        $usuario = new Usuario();
                        $imagem = Painel::uploadFile($imagem);
                        $usuario->cadastrarUsuario($login,$senha,$imagem,$nome,$cargo);
                        Painel::alert('sucesso','O cadastro do usuário '.$login.' foi feito com sucesso!');
                    }
                }
              }   
            ?>         
            <div class="form-group">
                <label>Nome:</label>   
                <input type="text" name="nome" />
            </div>
            <div class="form-group">
                <label>Login:</label>   
                <input type="text" name="login" />
            </div>   
            <div class="form-group">
                <label>Senha:</label>   
                <input type="password" name="password"  />
            </div>
            <div class="form-group">
                <label>Cargo:</label>   
                <select name="cargo">
                    <?php foreach(Painel::$cargos as $key => $value){
                        if($key < $_SESSION['cargo']) echo '<option value="'.$key.'">'.$value.'</option>';
                    } ?>
                </select>
            </div>
            <div class="form-group">
                <label>Imagem:</label>   
                <input type="file" name="imagem" />
                <input type="hidden" name="imagem_atual" />
            </div>
            <div class="form-group"> 
                <input type="submit" value="Atualizar" name="acao" />
            </div>
        </form>
    </div>
    
    