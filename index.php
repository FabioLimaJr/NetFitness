<?php

 include('classesBasicas/Pessoa.php');
 include('classesBasicas/Aluno.php'); 
 include('classesBasicas/Professor.php');
 
 include('controlador/ControladorProfessor.php');
 include('controlador/ControladorAluno.php');

 include('conexao/Conexao.php');
 include('interfaceRepositorio/IRepositorioGenerico.php');
 include('repositorioGenerico/RepositorioGenerico.php');
 
 include('interfaceRepositorio/IRepositorioAluno.php');
 include('repositorio/RepositorioAluno.php');
 
 include('interfaceRepositorio/IRepositorioProfessor.php');
 include('repositorio/RepositorioProfessor.php');
 
 include('excecoes/Excecoes.php');
 
 
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


 $professor = new Professor();
 $professor->setSalario(1500);
 $professor->setCpf('12345678912');
 $professor->setNome('Ricardo');
 
 $controladorProfessor = new ControladorProfessor();
 try 
 {
   $professor->setIdPessoa($controladorProfessor->inserir($professor));
   echo "Professor inserido\n";
 } 
 catch (Exception $exc) 
 {
    echo $exc->getMessage();
 }
 
 $aluno = new Aluno();
 $aluno->setProfessor($professor);

 $aluno->setCpf('12379fj');
 $aluno->setNome('Marcos');
 $aluno->setOpiniao('Opinião Marcos');
 
 $controladorAluno = new ControladorAluno();
 try
 {
   $controladorAluno->inserir($aluno);
   echo "Aluno inserido\n";
 }
 catch (Exception $e)
 {
     echo $e->getMessage();
 }
 
  
         
?>
