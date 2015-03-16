
<?php

 include('classesBasicas/Instrutor.php');
 include('classesBasicas/Coordenador.php');
 include('classesBasicas/Musica.php');
 include('classesBasicas/Dieta.php');
 include('classesBasicas/Pagamento.php');
 include('classesBasicas/Treino.php');
 include('classesBasicas/ExameFisico.php');
 include('classesBasicas/Dica.php');
 include('classesBasicas/Aluno.php');
 include('classesBasicas/Secretaria.php');
 include('classesBasicas/Exercicio.php');
 
 include('expressoesRegulares/ExpressoesRegulares.php');
 include('excecoes/Excecoes.php');
                 
 include("fachada/Fachada.php");

 

/*
 $fachada = Fachada::getInstance();
 
 $aluno = new Aluno(7, null, null, null, null, null, null, null, null, null, 
                    null, null, null, null, null);
 $alunoRet = $fachada->detalharAluno($aluno);
 
 var_dump($alunoRet);
 
 */
 /*
 $fachada = Fachada::getInstance();
 
 $instrutor = new Instrutor(3,null, null, null, null, null, null, null, null, null, null, null);
 
 $instrutorRet = $fachada->detalharInstrutor($instrutor);
 
 var_dump($instrutorRet);
 */
/*
 
 //Teste Listar Alunos
 $fachada = new Fachada();
 
 $fachada = Fachada::getInstance();
 
 try {
    $listaAlunos = $fachada->listarAlunos();
    var_dump($listaAlunos);
} catch (Exception $exc) {
    echo $exc->getMessage();
}

*/


 
 //Teste excluir professor
 /*
 $controladorProfessor = new ControladorProfessor();
 $professor = new Professor();
 
 $professor->setIdPessoa(9);
 try 
 {
    $controladorProfessor->excluir($professor);
    echo "Professor excluido com sucesso";
 }
 catch (Exception $exc) 
 {
    echo $exc->getMessage();
 }
  */
 
 //Teste ecluir aluno
 /*
 $controladorAluno = new ControladorAluno();
 $aluno = new Aluno();
 $aluno->setIdPessoa(12);
 try 
 {
    $controladorAluno->excluir($aluno);
    echo "Professor excluido com sucesso";
 } 
 catch (Exception $exc) 
 {
    echo $exc->getMessage();
 }
*/
 
 //Teste alterar professor
 /*
 $professor = new Professor();
 $professor->setSalario(1200);
 $professor->setCpf('00000000');
 $professor->setNome('Luis');
 $professor->setIdPessoa(11);
 
 $controladorProfessor = new ControladorProfessor();
 try 
 {
   $controladorProfessor->alterar($professor);
   echo("Atributos Professor alterados com successo");
 } 
 catch (Exception $exc) 
 {
    echo $exc->getMessage();
 }
*/
 /*$coordenador = new Coordenador(2, null, null, null, null, null, null, 
         null, null, null, null);
//Teste Incluir Instrutor 
$instrutor = new Instrutor(null, $coordenador, array(), array(), array(), "Marcelooo Lopes", "444.444.444-23", "Rua teste", "myP@ssword01", "(81) 3438-3481", "MarceloLopes22", "marcelo_m.lopes2@hotmail.com");
//$instrutor = new Instrutor(2, $coordenador, array(), array(), array(), "Marcelo Lopes", "123.456.654-23", "Rua teste", "myP@ssword01", "(81) 3438-3481", "MarceloLopes22", "marcelo_m.lopes2@hotmail.com");
 
 $controladorInstrutor = new ControladorInstrutor();
 try 
 {
   $instrutor = $controladorInstrutor->inserir($instrutor);
   //$instrutor = $controladorInstrutor->alterar($instrutor);
   echo "Instrutor inserido\n";
   //echo "Professor alterado\n";
 } 
 catch (Exception $exc) 
 {
    echo $exc->getMessage();
 }*/
 /*
 $RepositorioSecretaria = new RepositorioSecretaria();
 $RepositorioSecretaria->listar();
  */       
 //Teste excluir professor
 /*
 $controladorProfessor = new ControladorProfessor();
 $professor = new Professor();
 
 $professor->setIdPessoa(9);
 try 
 {
    $controladorProfessor->excluir($professor);
    echo "Professor excluido com sucesso";
 }
 catch (Exception $exc) 
 {
    echo $exc->getMessage();
 }*/
 
/* $controladorInstrutor = new ControladorInstrutor();
 $coordenador = new Coordenador(2, array(), array(), array(), "", "", "", "", "", "", "");
 $instrutor = new Instrutor(1, $coordenador, array(), array(), array(), "Marcelo Lopes", "123.456.654-23", "Rua teste", "myP@ssword01", "(81) 3438-3481", "MarceloLopes22", "marcelo_m.lopes2@hotmail.com");

 try {
    $controladorInstrutor->excluir($instrutor);
    echo 'instrutor excluido';
} catch (Exception $exc) {
    echo $exc->getMessage();
}

 
$coordenador = new Coordenador(2, array(), array(), array(), "", "", "", "", "", "", "");*/
 
 $exercicio = new Exercicio(5, "Supino inclinado", "Peito", "Na posicaoo deitada em um banco inclinado, faca uma pegada na barra com o dorso das maos voltado.");
 
 $fachada = Fachada::getInstance();
 
 $fachada->alterarExercicio($exercicio);
 
 ?>

