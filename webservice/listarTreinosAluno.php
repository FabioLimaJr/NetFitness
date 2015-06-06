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


if(isset($_POST['idAluno']) && isset($_POST['senha']) && isset($_POST['login']))
{
    $fachada = Fachada::getInstance();
    $aluno = new Aluno($_POST['login'],$_POST['senha']);
    
    if($fachada->conferirLoginSenha($aluno))
    {       
        $aluno = new Aluno($_POST['idAluno']);
        $resposta = array();
        $listaTreinos = array();
        $listaTreinosRetornados = array();
        
        try
        {
            
            $alunoRetornado = $fachada->detalharAluno($aluno, EAGER);
            $listaTreinos = $alunoRetornado->getListaTreinos();
            
            foreach ($listaTreinos as $treino)
            {
                array_push($listaTreinosRetornados, $fachada->detalharTreino($treino, EAGER));        
            }
            
            if(sizeof($listaTreinos)==0)
            {
                $resposta['mensagem'] =  "O aluno não tem nenhum treino vinculado";
                $resposta['listaTreinos'] = "null";
            }
            else
            {
                $resposta['mensagem'] = "notNull";
                $resposta['listaTreinos'] = $listaTreinosRetornados;
            }
            
           
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