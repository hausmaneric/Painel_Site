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
        <h2><i class="fa fa-pencil"></i> Cadastrar Slides</h2>    
        <form method="post" enctype="multipart/form-data">
        <?php

			if(isset($_POST['acao'])){
				$nome = $_POST['nome'];
				$imagem = $_FILES['imagem'];
				if($nome == ''){
					Painel::alert('erro','O campo nome não pode ficar vázio!');
				}else{
					//Podemos cadastrar!
					if(Painel::imagemValida($imagem) == false){
						Painel::alert('erro','O formato especificado não está correto!');
					}else{
						//Apenas cadastrar no banco de dados!
						$imagem = Painel::uploadFile($imagem);						
						$arr = ['nome'=>$nome,'slide'=>$imagem,'order_id'=>'0','nome_tabela'=>'tb_site.slides'];
						Painel::insert($arr);
						Painel::alert('sucesso','O cadastro do slide foi realizado com sucesso!');
					}
				}
				
			}
		?>      
            <div class="form-group">
                <label>Nome do Slide:</label>   
                <input type="text" name="nome" />
            </div>
            <div class="form-group">
                <label>Imagem:</label>   
                <input type="file" name="imagem" />
                <input type="hidden" name="imagem_atual" />
            </div>
            <div class="form-group"> 
                <input type="submit" value="Cadastrar!" name="acao" />
            </div>
        </form>
    </div>
    
    