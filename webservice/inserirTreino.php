<?php

include ('../classesBasicas/Pessoa.php');
include ('../classesBasicas/Aluno.php');
include ('../classesBasicas/Instrutor.php');
include ('../classesBasicas/Treino.php');
include ('../classesBasicas/Exercicio.php');
include ('../classesBasicas/Secretaria.php');
include ('../expressoesRegulares/ExpressoesRegulares.php');
include ('../fachada/Fachada.php');

include ('../ferramentas/texto/Texto.php');

if(isset($_POST['listaExercicios']) && isset($_POST['senha']) && isset($_POST['login']))
{
    $fachada = Fachada::getInstance();   
    $instrutor = new Instrutor($_POST['login'],$_POST['senha']);
    
    if($fachada->conferirLoginSenha($instrutor))
    {
        $treino = new Treino(NULL);
        $listaExercicios = $_POST['listaExercicios'];
        $listaExercicios = str_replace("[", "", $listaExercicios);
        $listaExercicios = str_replace("]", "", $listaExercicios);
        $listaExercicios = str_replace("{", "", $listaExercicios);
        $listaExercicios = str_replace("}", "", $listaExercicios);
        $listaExercicios = str_replace("repeticoes=", "", $listaExercicios);
        $listaExercicios = str_replace("series=", "", $listaExercicios);
        $listaExercicios = str_replace("idExercicio=", "", $listaExercicios);
        
        $listaExerciciosSelecionados = array();
        $listaExerciciosRetornados = array();
        $listaExercicios = explode(",", $listaExercicios);

        for($i=0; $i < floor(sizeof($listaExercicios) / 3); $i++)
        {
            $listaExerciciosSelecionados[$i]['repeticoes']=$listaExercicios[$i*3];
            $listaExerciciosSelecionados[$i]['series']=$listaExercicios[$i*3+1];
            $listaExerciciosSelecionados[$i]['idExercicio']=$listaExercicios[$i*3+2];
        }
        
        foreach ($listaExerciciosSelecionados as $exercicio)
        {
            
            $exercicioPost = new Exercicio($exercicio['idExercicio']);
            $exercicioRetornado = $fachada->detalharExercicio($exercicioPost);
            $exercicioRetornado->setSeries($exercicio['series']);
            $exercicioRetornado->setRepeticoes($exercicio['repeticoes']);
         
            array_push($listaExerciciosRetornados, $exercicioRetornado);

        }
        
        $treino->setListaExercicios($listaExerciciosRetornados);
        $instrutor = new Instrutor($_POST['idInstrutor']);
        $treino->setInstrutor($fachada->detalharInstrutor($instrutor,LAZY));
        $treino->setDescricao($_POST['descricaoTreino']);
        $treino->setNome($_POST['nomeTreino']);
        date_default_timezone_set('America/Recife');
        $treino->setData(date('d-m-Y'));

        try
        {
            $fachada->inserirTreino($treino);   
            $resposta['mensagem'] = "Treino inserido com sucesso";
            $resposta['listaExercicios'] ="null";
            $resposta['listaTreinos'][0] = $treino;
            echo json_encode($resposta);
        } 
        catch (Exception $ex) 
        {
            $resposta['mensagem'] = Texto::brReplace($ex->getMessage());
            $resposta['listaExercicios'] ="null";
            $resposta['listaTreinos'][0] = $treino;
            echo json_encode($resposta);
        }
    }  
    else
    {
        $resposta['mensagem'] = Excecoes::loginSenhaInvalidos();
       $resposta['listaTreinos'][0] = $treino;
         $resposta['listaExercicios'] ="null";
        echo json_encode($resposta);
    }
}

