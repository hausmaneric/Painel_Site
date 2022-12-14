<?php
    $file = "templateFinanceiro.php";
    ob_start();
    include($file);
    $html = ob_get_clean();
    ob_end_clean();

    use Dompdf\Dompdf;

    $nome = (isset($_GET['pagamento']) && $_GET['pagamento'] == 'concluidos') ? 'Concluidos' : 'Pendentes';
    
    $dompdf = new DOMPDF();
    $dompdf->loadhtml($html);
    $dompdf->set_paper('a4', 'landscape');
    $dompdf->render();
    $dompdf->stream("Pagamentos.'$nome'.pdf");
    header('Content-type: application/pdf');
    $dompdf->output();
?>