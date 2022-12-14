<?php 
    ini_set('max_execution_time','0');
    include('../config.php');

    if(Painel::logado() == false){
        include('login.php');
    }else{
        include('main.php');
    }
?>