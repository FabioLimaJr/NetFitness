<?php

include ('../classesBasicas/Pessoa.php');
include ('../classesBasicas/Aluno.php');
include ('../classesBasicas/Instrutor.php');
include ('../classesBasicas/Treino.php');
include ('../classesBasicas/Exercicio.php');
include ('../fachada/Fachada.php');

include ('../ferramentas/texto/Texto.php');


if(isset($_POST['idInstrutor']) && isset($_POST['senha']) && isset($_POST['login']))
{
    $fachada = Fachada::getInstance();
    $instrutor = new Instrutor($_POST['login'],$_POST['senha']);
    
    if($fachada->conferirLoginSenha($instrutor))
    {       
       
        $resposta = array();

        try
        {
            $resposta['mensagem'] = "notNull";
            $resposta['listaExercicios'] = $fachada->listarExercicios();
            echo json_encode((array)$resposta);
        } 
        catch (Exception $ex) 
        {
            $resposta['mensagem'] =  Texto::brReplace($ex->getMessage());
            $resposta['listaExercicios'] = "null";
            echo json_encode($resposta);
        }
    }
    else
    {
        $resposta['mensagem'] = Excecoes::loginSenhaInvalidos();
        $resposta['listaTreinos'] = "null";
        echo json_encode($resposta);
    }
    
}
