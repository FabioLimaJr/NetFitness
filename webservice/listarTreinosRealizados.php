<?php

    include ('../classesBasicas/Pessoa.php');
    include ('../classesBasicas/Aluno.php');
    include ('../classesBasicas/Instrutor.php');
    include ('../classesBasicas/Treino.php');
    include ('../classesBasicas/Exercicio.php');
    include ('../classesBasicas/Secretaria.php');
    include ('../classesBasicas/Dieta.php');
    include ('../classesBasicas/Alimento.php');
    include ('../classesBasicas/Nutricionista.php');
    include ('../classesBasicas/Musica.php');
    include ('../classesBasicas/Pagamento.php');
    include ('../fachada/Fachada.php');
    
    include ('../ferramentas/texto/Texto.php');


if(isset($_POST['idAluno']) && isset($_POST['idTreino']) && isset($_POST['senha']) && isset($_POST['login']))
{
    $fachada = Fachada::getInstance();
    $aluno = new Aluno($_POST['login'],$_POST['senha']);
    
    if($fachada->conferirLoginSenha($aluno))
    {       
        $aluno = new Aluno($_POST['idAluno']);
        $treino = new Treino($_POST['idTreino']);
        $treino = $fachada->detalharTreino($treino, LAZY);
        $resposta = array();
        $resposta['listaTreinosRealizados'] = array();

        try
        {
            $resposta['mensagem'] = "notNull";
            $resposta['listaTreinosRealizados'] = $fachada->listarTreinosRealizados($aluno, $treino);
            echo json_encode((array)$resposta);
        } 
        catch (Exception $ex) 
        {
            $resposta['mensagem'] =  Texto::brReplace($ex->getMessage());
            $resposta['listaTreinos'] = "null";
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

