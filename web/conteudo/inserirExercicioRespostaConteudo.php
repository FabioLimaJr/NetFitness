<?php

include ('../classesBasicas/Aluno.php');
include ('../classesBasicas/Coordenador.php');
include ('../classesBasicas/Nutricionista.php');
include ('../classesBasicas/Instrutor.php');
include ('../classesBasicas/Secretaria.php');
session_start();

include ('../fachada/Fachada.php');
$mensagem = "";
try {
    
    $fachada = Fachada::getInstance();
    $exercicio = new Exercicio(NULL, $_POST['nome'], $_POST['musculo'], $_POST['descricao']);
    
    if($fachada->incluirExercicio($exercicio)){
        $mensagem = "Exercicio Inserido com Sucesso!!";
    }
} catch (Exception $exc) {
    $mensagem = $ex->getMessage();
}
echo $mensagem;
?>
