<?php

include ('../classesBasicas/Pessoa.php');
include ('../classesBasicas/Aluno.php');
include ('../classesBasicas/Opiniao.php');

include ('../fachada/Fachada.php');
include ('../expressoesRegulares/ExpressoesRegulares.php');


if(isset($_POST['idAluno']) && isset($_POST['senha']) && isset($_POST['login']) && isset($_POST['opiniao']))
{
    $fachada = Fachada::getInstance();
    $resposta = array();
    
    $aluno = new Aluno($_POST['login'], $_POST['senha']);
    $resposta = "";
    
    if($fachada->conferirLoginSenha($aluno))
    {
        date_default_timezone_set('America/Recife');
        $aluno = new Aluno($_POST['idAluno']);
        $opiniao = new Opiniao("NULL", $_POST['opiniao'], date("d-m-Y"), $aluno);
        
        try
        {
            $fachada->inserirOpiniao($opiniao);
            $resposta['mensagem'] = "Opinião inserida com sucesso";
        } 
        catch (Exception $ex) 
        {
            $resposta['mensagem'] = "Impossível inserir a opinião: ".$ex->getMessage();
        }
    }
    else
    {
        $resposta['mensagem'] = Excecoes::loginSenhaInvalidos();
        echo json_encode($resposta);
    }
}