<?php
    if(isset($_GET['excluir'])){
        $idExcluir = intval($_GET['excluir']);
        $selectImagem = MySql::conectar()->prepare("SELECT slide FROM `tb_site.slides` WHERE id = ?");
        $selectImagem->execute(array($_GET['excluir']));

        $imagem = $selectImagem->fetch()['slide'];
        Painel::deleteFile($imagem);
        Painel::deletar('tb_site.slides',$idExcluir);
        Painel::redirect(INCLUDE_PATH_PAINEL.'listar-slides');
    }else if(isset($_GET['order']) && isset($_GET['id'])){
        Painel::orderItem('tb_site.slides',$_GET['order'],$_GET['id']);
    }

    $paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    $porPagina = 4;

    $slides = Painel::selectAll('tb_site.slides',($paginaAtual - 1) * $porPagina,$porPagina);  
?>

<style>
.wraper-table{
    overflow-x: auto;
}

table{
    width: 100%;
    margin: 20px 0;
    border-collapse: collapse;
    min-width: 900px;
}

table tr:nth-of-type(1){
   background:#0091ea;
   color: white;
}

table tr{
    color: #555;
    border-bottom: 1px solid #ccc;
}

table td{
    padding: 8px;
}

table a.btn{
    text-decoration: none;
    padding: 4px 6px;
    background: #f4b03e;   
    color: white;
    font-size: 15px;   
}

a.btn.edit{
    background: #f4b03e;      
}

a.btn.delete{
    background: #e05c4e;
} 

a.btn.order{
    background: #0091ea;
}

.paginacao{
    text-align: center;
}

.paginacao a{
    font-size: 14px;
    margin: 0 8px;
    display: inline-block;
    padding: 3px 4px;
    border: 1px solid #ccc;
    text-decoration: none;
    color: #666;
}

.paginacao a.page-selected{
    background: rgb(220, 220, 220);
}

</style>

<div class="box-content">
    <h2><i class="fa fa-id-card-o"></i>Serviços Cadastrados</h2>  
    <div class="wraper-table">
        <table>
            <tr>
                <td>Nome</td>
                <td>Imagem</td>
                <td>#</td>
                <td>#</td>
                <td>#</td>
                <td>#</td>
            </tr>
            <?php
                foreach($slides as $key => $value){
            ?>
            <tr>
                <td><?php echo $value['nome']; ?></td>
                <td><img style="width:50px;height:50px;" src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $value['slide']; ?>"></img></td>
                <td><a class="btn edit" href="<?php INCLUDE_PATH_PAINEL ?>editar-slide?id=<?php echo $value['id']; ?>"><i style="padding-right:5px;" class="fa fa-pencil" ></i>Editar</a></td>
                <td><a actionbtn="delete" class="btn delete" href="<?php INCLUDE_PATH_PAINEL ?>listar-slides?excluir=<?php echo $value['id']; ?>"><i class="fa fa-times" style="padding-right:5px;"></i>Excluir</a></td>
                <td><a class="btn order" href="<?php INCLUDE_PATH_PAINEL ?>listar-slides?order=up&id=<?php echo $value['id']; ?>"><i class="fa fa-angle-up"></i></a></td>
                <td><a class="btn order" href="<?php INCLUDE_PATH_PAINEL ?>listar-slides?order=down&id=<?php echo $value['id']; ?>"><i class="fa fa-angle-down"></i></a></td>
            </tr>
            <?php } ?>
        </table>
    </div>
    <div class="paginacao">
        <?php 
            $totalPaginas = ceil(count(Painel::selectAll('tb_site.slides')) / $porPagina);
            for($i=1; $i <= $totalPaginas; $i++){
                if($i == $paginaAtual)
                    echo '<a class="page-selected" href="'.INCLUDE_PATH_PAINEL.'listar-slides?pagina='.$i.'">'.$i.'</a>';
                else    
                echo '<a href="'.INCLUDE_PATH_PAINEL.'listar-slides?pagina='.$i.'">'.$i.'</a>';
            }   
        ?>
    </div>
</div>