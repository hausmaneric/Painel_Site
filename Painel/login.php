<?php
    if(isset($_COOKIE['lembrar'])){
        $user = $_COOKIE['user'];
        $password = $_COOKIE['password'];
        $sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.usuarios` WHERE user = ? AND password = ?");
        $sql->execute(array($user,$password));
        if($sql->rowCount() == 1){
            $info = $sql->fetch();
            $_SESSION['login'] = true;
            $_SESSION['user'] = $user;
            $_SESSION['password'] = $password;
            $_SESSION['id_user'] = $info['id'];
            $_SESSION['nome'] = $info['nome'];
            $_SESSION['cargo'] = $info['cargo'];       
            $_SESSION['img'] = $info['img'];  
            header('Location: '.INCLUDE_PATH_PAINEL);
            die();    
        }
    }
?>
<?php //echo INCLUDE_PATH_PAINEL; ?>
<html>
    <head>
        <title>Login</title>
        <meta charset="urf-8" />
        <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0">
        <meta name="description" content="Descrição do meu web site" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Roboto:wght@100&display=swap" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
        <div class="box-login">
            <?php
                if(isset($_POST['acao'])){
                    $user = $_POST['user'];
                    $password = $_POST['password'];
                    $sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.usuarios` WHERE user = ? AND password = ?");
                    $sql->execute(array($user,$password));
                    if($sql->rowCount() == 1){
                        $info = $sql->fetch();
                        $_SESSION['login'] = true;
                        $_SESSION['user'] = $user;
                        $_SESSION['password'] = $password;
                        $_SESSION['id_user'] = $info['id'];                        
                        $_SESSION['nome'] = $info['nome'];
                        $_SESSION['cargo'] = $info['cargo'];       
                        $_SESSION['img'] = $info['img'];    
                        if(isset($_POST['lembrar'])){
                            setcookie('Lembrar','true',time()+(60*60*24),'/');
                            setcookie('user',$user,time()+(60*60*24),'/');
                            setcookie('password',$password,time()+(60*60*24),'/');
                        }              
                        header('Location: '.INCLUDE_PATH_PAINEL);
                        die();
                    }else{
                        echo '<div class="erro-box"><div class="erro-icon"><i class="fa-solid fa-xmark"></i></div><div class="erro-text">Usuário ou senha incorretos!</div></div>';
                    }
                }
            ?>
            <h2>Efetue o login</h2>
            <form method="post">
                <input type="text" name="user" placeholder="Login..." required>
                <input type="password" name="password" placeholder="Senha..." required>
                <div class="form-group-login left">
                    <input type="submit" name="acao" value="Logar!">
                </div>
                <div class="form-group-login right">
                    <label>Lembrar-me</label>
                    <input type="checkbox" name="lembrar" />
                </div>
                <div class="clear"></div>
            </form>  
        </div>
    </body>
</html>