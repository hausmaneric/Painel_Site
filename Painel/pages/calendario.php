<style>
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

    .card-title{
        width: 100%;
        padding:6px;
        color: white;
        margin:10px 0;
        font-size: 17px;
        font-weight: lighter;
        background: #0091ea;
    }

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

    .calendario-table td{
        border: 1px solid #ccc;
        text-align: center;
        cursor: pointer;
    }

    .day-selected{
        background: rgb(220,220,220);
    }

    .box-tarefas-single{
        background: #f4b03e;
        float: left;
        width: 33.3%;
        border: 4px solid white;
        color: white;
    }

    .box-tarefas-single h2{
        font-size: 20px;
        padding: 0 8px;
    }

    .box-alert{
        width: 100%;
        padding: 15px 0;     
    }

    .sucesso{
        background: #a5d6a7;
        text-align: center;
        color: white;
        padding: 8px 0;  
        margin-bottom: 8px; 
    }

    .erro{
        text-align: center;
        background: #F75353;
        color: white;
    }

</style>

<?php
	//$mes = isset($_GET['mes']) ? (int)$_GET['mes'] : date('m',time());
	//$ano = isset($_GET['ano']) ? (int)$_GET['ano'] : date('Y',time());

	$mes = date('m',time());
	$ano = date('Y',time());

	if($mes > 12)
		$mes = 12;
	if($mes < 1)
		$mes = 1;

	$numeroDias = cal_days_in_month(CAL_GREGORIAN,$mes,$ano);
	$diaInicialdoMes = date('N',strtotime("$ano-$mes-01"));

	$diaDeHoje = date('d',time());



	$diaDeHoje = "$ano-$mes-$diaDeHoje";

	$meses = array('Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','agosto','Setembro','Outubro','Novembro','Dezembro');

	//Nome do mês no formato de string!
	$nomeMes = $meses[(int)$mes-1];
?>

<div class="box-content">
	<h2><i class="fa fa-calendar" aria-hidden="true"></i> Calendário e Agenda | <u><?php echo $nomeMes ?></u>/<?php echo $ano; ?></h2></h2>

	<table class="calendario-table">
		<tr>
			<td>Domingo</td>
			<td>Segunda</td>
			<td>Terça</td>
			<td>Quarta</td>
			<td>Quinta</td>
			<td>Sexta</td>
			<td>Sabado</td>
		</tr>

		<?php
			$n = 1;
			$z = 0;
			$numeroDias+=$diaInicialdoMes;
			while ($n <= $numeroDias) {
				if($diaInicialdoMes == 7 && $z != $diaInicialdoMes){
					$z = 7;
					$n = 8;
				}
				if($n % 7 == 1){
					echo '<tr>';
				}

				if($z >= $diaInicialdoMes){
					$dia = $n - $diaInicialdoMes;
					if($dia < 10){
						$dia = str_pad($dia, strlen($dia)+1, "0", STR_PAD_LEFT);
					}
					$atual = "$ano-$mes-$dia";
					if($atual != $diaDeHoje){
					echo "<td dia=\"$atual\">$dia</td>";
					}else{
						echo '<td dia="'.$atual.'" class="day-selected">'.$dia.'</td>';
					}
				}else{
					echo "<td></td>";
					$z++;
				}
				if($n % 7 == 0){
					echo '</tr>';
				}
				$n++;
			}
		?>
		
	</table>

	<form method="post" action="<?php echo INCLUDE_PATH_PAINEL ?>ajax/calendario.php">
		<div class="card-title">Adicionar Tarefa para <?php echo date('d/m/Y',time()); ?></div>
		<input required="" type="text" name="tarefa" />
		<input type="hidden" name="data" value="<?php  echo date('Y-m-d'); ?>" />
		<input type="hidden" name="acao" value="inserir">
		<input type="submit"  value="Cadastrar!">
	</form>

	<div class="box-tarefas">
		<div class="card-title">
		Tarefas de <?php echo date('d/m/Y',time()); ?>
		</div>
		<?php
			$pegarTarefas = MySql::conectar()->prepare("SELECT * FROM `tb_admin.agenda` WHERE data = '$diaDeHoje' ORDER BY id DESC");
			$pegarTarefas->execute();
			$pegarTarefas = $pegarTarefas->fetchAll();
			foreach ($pegarTarefas as $key => $value) {

		?>
		<div class="box-tarefas-single">
			<h2><i class="fa fa-pencil"></i> <?php echo $value['tarefa']; ?></h2>
		</div>
		<?php } ?>
		<div class="clear"></div>
	</div>

</div>