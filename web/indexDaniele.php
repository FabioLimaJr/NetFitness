<?php

include('../classesBasicas/Instrutor.php');
include('../classesBasicas/Coordenador.php');
include('../classesBasicas/Musica.php');
include('../classesBasicas/Dieta.php');
include('../classesBasicas/Pagamento.php');
include('../classesBasicas/Treino.php');
include('../classesBasicas/ExameFisico.php');
include('../classesBasicas/Dica.php');
include('../classesBasicas/Aluno.php');
include('../classesBasicas/Secretaria.php');
include('../classesBasicas/Exercicio.php');
include('../classesBasicas/Opiniao.php');
include('../classesBasicas/Alimento.php');
include('../classesBasicas/Nutricionista.php');

include('../expressoesRegulares/ExpressoesRegulares.php');
include('../excecoes/Excecoes.php');

include("../fachada/Fachada.php");
//include('../repositorio/repositoriotest.php');
/*
try
{   
    $fachada = new Fachada();
    $fachada->getInstance();
    $aluno = new Aluno(10);
    $instrutor = new Instrutor(1);
    $exameFisico = new ExameFisico(null, '02/02/2015', "teste exame fisico 2", $aluno, $instrutor);
    $fachada->inserirExameFisico($exameFisico);
} 
catch (Exception $ex) 
{
  echo $ex->getMessage();
}
 */
ini_set('xdebug.var_display_max_depth', -1);

try
{   
    $fachada=Fachada::getInstance();
    
    /*
    $listaSecretarias = array();
    $listaSecretarias = $fachada->listarSecretarias(EAGER);
    var_dump($listaSecretarias);
    */
    
    /*
    $secretaria = new Secretaria(6);
    $secretariaRetornada = $fachada->detalharSecretaria($secretaria, EAGER);
    var_dump($secretariaRetornada);
    */
    
    /*
    $listaPagamentos = array();
    $listaPagamentos = $fachada->listarPagamentos(EAGER);
    var_dump($listaPagamentos);
    */
    
    /*
    $pagamento = new Pagamento(1);
    $pagamentoRetornado = $fachada->detalharPagamento($pagamento, EAGER);
    var_dump($pagamentoRetornado);
    */
    
    
    /*
    $listaOpinioes = array();
    
    $listaOpinioes = $fachada->listarOpinioes(EAGER);
    var_dump($listaOpinioes);
    */
    
    /*
    $opiniao = new Opiniao(1);
    $opiniaoRetornada = $fachada->detalharOpiniao($opiniao, EAGER);
    var_dump($opiniaoRetornada);
    */
    
    /*
    $pagamento = new Pagamento(1);
    $pagamentoRetornado = $fachada->detalharPagamento($pagamento, LAZY);
    var_dump($pagamentoRetornado);
    */
    
    
    /*
    $musica = new Musica(1);
    $musicaRetornada = $fachada->detalharMusica($musica,EAGER);
    var_dump($musicaRetornada);
    */
    
    /* 
    $listaMusicas = array();
    $listaMusicas = $fachada->listarMusicas(EAGER);
    var_dump($listaMusicas);
    */
    
    /*
    $listaNutricionistas = array();
    $listaNutricionistas = $fachada->listarNutricionistas(LAZY);
    var_dump($listaNutricionistas);
    */
    
    /*
    $nutricionista = new Nutricionista(9);
    $nutricionistaRetornada = $fachada->detalharNutricionista($nutricionista, LAZY);
    var_dump($nutricionistaRetornada);
    */
    
   
    
    /*
    $listaDietas = array();
    $nutricionista = new Nutricionista(9);
  
    
    $listaDietas = $fachada->listarDietas($nutricionista, LAZY);
    var_dump($listaDietas);
    */
    
    /*
    $dieta = new Dieta(1);
    $dietaRetornada = $fachada->detalharDieta($dieta, EAGER);
    var_dump($dietaRetornada);
    */
    
    /*
    $coordenador = new Coordenador(5);
    $coordenadorRetornado = $fachada->detalharCoordenador($coordenador,EAGER);
    var_dump($coordenadorRetornado);
    */
    
    /*
    $listaAlimentos = array();
    $listaAlimentos = $fachada->listarAlimentos(LAZY);
    var_dump($listaAlimentos);
    */
    /*
    $alimento = new Alimento(1);
    $alimentoRetornado = $fachada->detalharAlimento($alimento,LAZY);
    var_dump($alimentoRetornado);
    */
    
    /*
    $instrutor = new Instrutor(7);
    $listaTreinos = $fachada->listarTreinos($instrutor, EAGER);
    var_dump($listaTreinos);
    */

    /*
    $treino = new Treino(1);
    $treinoRetornado = $fachada->detalharTreino($treino, LAZY);
    var_dump($treinoRetornado);
    */
    
    /*
    $listaInstrutores = array();
    $listaInstrutores = $fachada->listarInstrutores(LAZY);
    var_dump($listaInstrutores);
    */
    
    /*
    $listaExercicios = array();
    $listaExercicios = $fachada->listarExercicios();
    var_dump($listaExercicios);
    
    $exercicio = new Exercicio(2);
    $exercicioRetornado = $fachada->detalharExercicio($exercicio);
    var_dump($exercicioRetornado);
    */
    
    /*
    $instrutor = new Instrutor(7);
    $instrutorRetornado = $fachada->detalharInstrutor($instrutor,LAZY);
    var_dump($instrutorRetornado);
    */
    
    /*   
    $listaExamesFisicos = array();
    $listaExamesFisicos = $fachada->listarExamesFisicos(LAZY);
    var_dump($listaExamesFisicos);
     */
    
    /*
    $exameFisico = new ExameFisico(5);
    $exameFisicoRetornado = $fachada->detalharExameFisico($exameFisico,EAGER);
    var_dump($exameFisicoRetornado);
    */
    
    /*
    $listaAlimentos = array();
    $listaAlimentos = $fachada->listarAlimentos(LAZY);
    var_dump($listaAlimentos);
    */
  
    /*
    $listaAlunos = array();   
    $listaAlunos = $fachada->listarAlunos(EAGER);   
    var_dump($listaAlunos);
    */
    
    
    /*
    $aluno = new Aluno(10);
    $alunoRetornado = $fachada->detalharAluno($aluno,LAZY);
    var_dump($alunoRetornado);
    */
    
   // $dietaRetornada = $fachada->detalharDieta($alunoRetornado->getDieta(),EAGER);
   // var_dump($dietaRetornada);
    
    /*
    $dica = new Dica(1);
    $dicaRetornada = $fachada->detalharDica($dica);
    
    $nutricionista = new Nutricionista(9);
    
    $listaDicas = $fachada->listarDicas($nutricionista);
    var_dump($listaDicas);
     */
  
    /*
    $secretaria = new Secretaria($alunoRetornado->getSecretaria()->getIdSecretaria());
    $secretariaRetornada = $fachada->detalharSecretaria($secretaria, EAGER);
    $alunoRetornado->setSecretaria($secretariaRetornada);
    */
    
    
} 
catch (Exception $ex) 
{
  echo $ex->getMessage();
}

/*
try
{   
    
    $fachada->getInstance();
    $aluno = new Aluno(10);
    $alunoRetornado = $fachada->detalharAluno($aluno,EAGER);
  
    
    $dieta = new Dieta($alunoRetornado->getDieta()->getIdDieta());
    $dietaRetornada = $fachada->detalharDieta($dieta, EAGER);  
    $alunoRetornado->setDieta($dietaRetornada);
    
    
    $secretaria = new Secretaria($alunoRetornado->getSecretaria()->getIdSecretaria());
    $secretariaRetornada = $fachada->detalharSecretaria($secretaria, EAGER);
    $alunoRetornado->setSecretaria($secretariaRetornada);
    
    
    var_dump($alunoRetornado);
} 
catch (Exception $ex) 
{
  echo $ex->getMessage();
}
*/

/*
try
{
    $reptest = new repositoriotest();
    $exercicio = new Exercicio(null, "banco 5", "banco 5", "banco 5");
    $reptest->inserir($exercicio,2,"");
    echo 'OK';
} 
catch (Exception $ex)
{
   echo $ex->getMessage();   
}*/