<?php

 include('classesBasicas/Pessoa.php');
 include('classesBasicas/Instrutor.php');
 include('classesBasicas/Coordenador.php');
 include('classesBasicas/Secretaria.php');
 include('classesBasicas/Aluno.php');
 
 include('controlador/ControladorInstrutor.php');
 include('controlador/ControladorSecretaria.php');
 include('controlador/ControladorAluno.php');

 include('conexao/Conexao.php');
 include('interfaceRepositorio/IRepositorioGenerico.php');
 include('repositorioGenerico/RepositorioGenerico.php');
 
 include('interfaceRepositorio/IRepositorioSecretaria.php');
 include('repositorio/RepositorioSecretaria.php');
 
 include('interfaceRepositorio/IRepositorioInstrutor.php');
 include('repositorio/RepositorioInstrutor.php');

 include('interfaceRepositorio/IRepositorioAluno.php');
 include('repositorio/RepositorioAluno.php');
 
 include('excecoes/Excecoes.php');
 include('expressoesRegulares/ExpressoesRegulares.php');
 
 include('fachada/IFachada.php');
 include('fachada/Fachada.php');
 
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
/*$coordenador = new Coordenador(2, array(), array(), array(), "", "", "", "", "", "", "");
$instrutor = new Instrutor(2, $coordenador, array(), array(), array(), "Marcelooo Lopes", "444.444.444-23", "Rua teste", "myP@ssword01", "(81) 3438-3481", "MarceloLopes22", "marcelo_m.lopes2@hotmail.com");
//$instrutor = new Instrutor(2, $coordenador, array(), array(), array(), "Marcelo Lopes", "123.456.654-23", "Rua teste", "myP@ssword01", "(81) 3438-3481", "MarceloLopes22", "marcelo_m.lopes2@hotmail.com");
 
 $controladorInstrutor = new ControladorInstrutor();
 try 
 {
   $instrutor = $controladorInstrutor->inserir($instrutor);
   //$instrutor = $controladorInstrutor->alterar($instrutor);
   echo "Professor inserido\n";
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
 
 /*$controladorInstrutor = new ControladorInstrutor();
 $coordenador = new Coordenador(2, array(), array(), array(), "", "", "", "", "", "", "");
 $instrutor = new Instrutor(1, $coordenador, array(), array(), array(), "Marcelo Lopes", "123.456.654-23", "Rua teste", "myP@ssword01", "(81) 3438-3481", "MarceloLopes22", "marcelo_m.lopes2@hotmail.com");

 try {
    $controladorInstrutor->excluir($instrutor);
    echo 'instrutor excluido';
} catch (Exception $exc) {
    echo $exc->getMessage();
}*//*
 // Teste Incluir secretaria
 // $idSecretaria, $nome, $cpf, $endereco, $senha, $telefone, $login, $email, $coordenador
 
 $coordenador = new Coordenador(2, null, null, null, null, null, null, null, null, null, null);
 //$secretaria = new Secretaria(22, "maria da penha", "123.456.789-10", "rua de maria da penha", "myP@ssord03", "(81) 1234-5678", "mariapenha123", "mariapenha@hotmail.com", $coordenador);
 $secretaria = new Secretaria(23, "julianas gomess", "111.222.333-44", "rua de juliana", "myP@ssord02", "(81) 1111-2222", "juli1234", "juliana@hotmail.com", $coordenador);
 //$repSecretaria = new RepositorioSecretaria();
 //$contSecretaria = new ControladorSecretaria();
 //$contSecretaria->inserir($secretaria);
 
 $fachada = Fachada::getInstance();
 //$fachada->incluirSecretaria($secretaria);
 // myP@ssord01
 
 // Testar o excluir secretaria
 
 $fachada->excluirSecretaria($secretaria);*/
 
 //Teste Incluir Aluno 
/*$coordenador = new Coordenador(2, array(), array(), array(), "qualquer","444.444.444-23", "Rua teste", "myP@ssword01", "(81) 3438-3481", "MariaOsvalda22", "maria_m.osvalda2@hotmail.com"); 
$secretaria = new Secretaria(19,"Maria Osvalda", "444.444.444-23", "Rua teste", "myP@ssword01", "(81) 3438-3481", "MariaOsvalda22", "maria_m.osvalda2@hotmail.com", "feminino", "opniao teste", $coordenador);
$aluno = new Aluno(null,"Fabio Lima", "111.111.111-11", "Rua da aurora", "myP@ssword01", "(81) 1111-1111", "FabioLima2", "fabio_l.lima2@hotmail.com", "masculino", "opniao teste", $secretaria);
 
 $controladorAluno = new ControladorAluno();
 try 
 {
   $aluno = $controladorAluno->inserir($aluno);
   //$aluno = $controladorAluno->alterar($aluno);
   echo "Aluno inserido\n";
   //echo "Aluno alterado\n";
 } 
 catch (Exception $exc) 
 {
    echo $exc->getMessage();
 }*/

 /*$controladorAluno = new ControladorAluno();
 $coordenador = new Coordenador(2, array(), array(), array(), "", "", "", "", "", "", "");
 $secretaria = new Secretaria(19,"Maria Osvalda", "444.444.444-23", "Rua teste", "myP@ssword01", "(81) 3438-3481", "MariaOsvalda22", "maria_m.osvalda2@hotmail.com", "feminino", "opniao teste", $coordenador);
 $aluno = new Aluno(20, "", "", "", "", "", "", "", "", "", $secretaria);

 try {
    $controladorAluno->excluir($aluno);
    echo 'aluno excluido';
} catch (Exception $exc) {
    echo $exc->getMessage();
}*/
 
 $controladorAluno = new ControladorAluno();
 $coordenador = new Coordenador(2, array(), array(), array(), "", "", "", "", "", "", "");
 //$secretaria = new Secretaria(19,"Maria Osvaldaaaaaaa", "444.444.444-23", "Rua teste", "myP@ssword01", "(81) 3438-3481", "MariaOsvalda22", "maria_m.osvalda2@hotmail.com", "feminino", "", $coordenador);
 $secretaria = new Secretaria(19, "", "", "", "", "", "", "", $coordenador);
 $aluno = new Aluno(23, "Marciooooo", "888.888.888-88", "rua qualquer", "myP@ssword01", "(81) 3438-3481", "MarcioooooOliveira22", "marcio_m.oliveira2@hotmail.com", "masculino", "opniao teste", $secretaria);

 try {
    $controladorAluno->alterar($aluno);
    echo 'aluno alterado';
} catch (Exception $exc) {
    echo $exc->getMessage();
}
 
/*$fachada = Fachada::getInstance();

$secretarias = array();

$secretarias = $fachada->listarSecretarias();

for($i = 0; $i < count($secretarias); $i++){
    
    echo 'Nome: ' . $secretarias[$i]->getNome();
}*/
 ?>

