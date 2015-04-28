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

if(isset($_POST['idTreino']) && isset($_POST['senha']) && isset($_POST['login']))
{
    $fachada = Fachada::getInstance();
    $treino = new Treino($_POST['idTreino']);
    $resposta = "";
    
    try
    {
        $fachada->excluirTreino($treino);
        
        $resposta['mensagem'] = "Treino excluido com sucesso";
        echo json_encode($resposta);
        
    } catch (Exception $ex) {
        $resposta['mensagem'] = $ex->getMessage();
        echo json_encode($resposta);
    }
}


