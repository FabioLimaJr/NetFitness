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

if(isset($_POST['listaExercicios']) && isset($_POST['senha']) && isset($_POST['login']))
{
    $fachada = Fachada::getInstance();   
    $instrutor = new Instrutor($_POST['login'],$_POST['senha']);
    
    if($fachada->conferirLoginSenha($instrutor))
    {
        $treino = new Treino(NULL);
        $listaExercicios = $_POST['listaExercicios'];
       //$listaExercicios = str_replace("[", "", $listaExercicios);
        //$listaExercicios = str_replace("]", "", $listaExercicios);
        $listaExerciciosRetornados = array();

        echo var_dump($listaExercicios);
        
        foreach ($listaExercicios as $exercicio)
        {
            
            $exercicioPost = new Exercicio($exercicio['idExercicio']);
            $exercicioRetornado = $fachada->detalharExercicio($exercicioPost);
            $exercicioRetornado.setSeries($exercicio['series']);
            $exercicioRetornado.setRepeticoes($exercicio['repeticoes']);
            
            array_push($listaExerciciosRetornados, $exercicioRetornado);

        }
        
        $treino->setListaExercicios($listaExerciciosRetornados);
        $treino->setInstrutor($fachada->detalharInstrutor($instrutor,LAZY));
        $treino->setDescricao($_POST['descricaoTreino']);
        $treino->setNome($_POST['nomeTreino']);
        $treino->setData("1999-02-02");
        
       // echo json_encode($treino);

     
/*
        try
        {
            
            $resposta['mensagem'] = "Treino inserido com sucesso";
            echo json_encode($resposta);

        } catch (Exception $ex) {
            $resposta['mensagem'] = $ex->getMessage();
            echo json_encode($resposta);
        }
 * */
 
    }
}

