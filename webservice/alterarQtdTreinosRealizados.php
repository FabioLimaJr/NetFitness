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
        $aluno = $fachada->detalharAluno(new Aluno($_POST['idAluno']), LAZY);
        $treino = $fachada->detalharTreino(new Treino($_POST['idTreino']), LAZY);
        
        try
        {
            $fachada->atualizarDatasTreinosRealizados($aluno, $treino, $_POST['qtdTreinos']);
            $resposta['datasAtualizadas']="true";
            $resposta['treino'] = $treino;
            $resposta['mensagem'] = "As datas dos treinos  foram atualizadas corretamente";
            echo json_encode($resposta); 
        } 
        catch (Exception $ex) 
        {
            $resposta['datasAtualizadas']="false";
            $resposta['treino'] = "null";
            $resposta['mensagem'] =  "Impossível atualizar as datas dos treinos: ".Texto::brReplace($ex->getMessage());
            echo json_encode($resposta);            
        }
        
    }
    
}
