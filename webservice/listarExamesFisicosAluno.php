<?php

include ('../classesBasicas/Pessoa.php');
include ('../classesBasicas/Aluno.php');
include ('../classesBasicas/Instrutor.php');
include ('../classesBasicas/Exercicio.php');
include ('../classesBasicas/Secretaria.php');
include ('../classesBasicas/Dieta.php');
include ('../classesBasicas/Alimento.php');
include ('../classesBasicas/Nutricionista.php');
include ('../classesBasicas/Musica.php');
include ('../classesBasicas/Pagamento.php');
include ('../classesBasicas/ExameFisico.php');
include ('../fachada/Fachada.php');

include ('../ferramentas/texto/Texto.php');


if(isset($_POST['idAluno']) && isset($_POST['senha']) && isset($_POST['login']))
{
   
    $fachada = Fachada::getInstance();
    $aluno = new Aluno($_POST['login'],$_POST['senha']);
    
    if($fachada->conferirLoginSenha($aluno))
    {       
        $aluno = new Aluno($_POST['idAluno']);
        $resposta = array();
        $listaExamesFisicos = array();

        try
        {
            
            $alunoRetornado = $fachada->detalharAluno($aluno, EAGER);
            $listaExamesFisicos = $fachada->listarExamesFisicos($alunoRetornado, LAZY);
            if(sizeof($listaExamesFisicos)==0)
            {
                $resposta['mensagem'] = "O aluno não realizou nenhum exame físico";
                $resposta['listaExamesFisicos'] = "null"; 
            }
            else
            {   
                $resposta['mensagem'] = "notNull";
                $resposta['listaExamesFisicos'] = $listaExamesFisicos;
            }
            
            echo json_encode((array)$resposta);
        } 
        catch (Exception $ex) 
        {
            $resposta['mensagem'] =  Texto::brReplace($ex->getMessage());
            $resposta['listaExamesFisicos'] = "null";
            echo json_encode($resposta);
        }
    }
    else
    {
        $resposta['mensagem'] = Excecoes::loginSenhaInvalidos();
        $resposta['listaExamesFisicos'] = "null";
        echo json_encode($resposta);
    }
    
}