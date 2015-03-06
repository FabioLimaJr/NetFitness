<?php

 include('classesBasicas/Pessoa.php');
 include('classesBasicas/Instrutor.php');
 include('classesBasicas/Coordenador.php');
 
 include('controlador/ControladorInstrutor.php');

 include('conexao/Conexao.php');
 include('interfaceRepositorio/IRepositorioGenerico.php');
 include('repositorioGenerico/RepositorioGenerico.php');
 
 include('interfaceRepositorio/IRepositorioSecretaria.php');
 include('repositorio/RepositorioSecretaria.php');
 
 include('interfaceRepositorio/IRepositorioInstrutor.php');
 include('repositorio/RepositorioInstrutor.php');
 
 include('excecoes/Excecoes.php');
 include('expressoesRegulares/ExpressoesRegulares.php');
 
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
//Teste Incluir Instrutor 
$coordenador = new Coordenador(1, array(), array(), array(), "", "", "", "", "", "", "");
$instrutor = new Instrutor(null, $coordenador, array(), array(), array(), "Marcelo Lopes", "123.456.654-23", "Rua teste", "myP@ssword01", "(81) 3438-3481", "MarceloLopes22", "marcelo_m.lopes2@hotmail.com");
 
 $controladorInstrutor = new ControladorInstrutor();
 try 
 {
   $instrutor = $controladorInstrutor->inserir($instrutor);
   echo "Professor inserido\n";
 } 
 catch (Exception $exc) 
 {
    echo $exc->getMessage();
 }
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
 }
  
 
 $controladorInstrutor = new ControladorInstrutor();
 $coordenador = new Coordenador(1, array(), array(), array(), "", "", "", "", "", "", "");
 $instrutor = new Instrutor(6, $coordenador, array(), array(), array(), "Marcelo", "123456789", "rua teste", "123", "1111-1111", "marcelo", "marcelomlopes2@gmail.com");
 
 try {
    $controladorInstrutor->excluir($instrutor);
    echo 'instrutor excluido';
} catch (Exception $exc) {
    echo $exc->getMessage();
}*/

 
 
?>

