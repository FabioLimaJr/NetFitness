
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
 include('../classesBasicas/Noticia.php');
 
 include('../expressoesRegulares/ExpressoesRegulares.php');
 include('../excecoes/Excecoes.php');
                 
 include("../fachada/Fachada.php");

 

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
 
 /*$exercicio = new Exercicio(NULL, "Supino reto", "Peito", "Na posicaoo deitada em um banco plano, faca uma pegada na barra com o dorso das maos voltado.");
 
 $fachada = Fachada::getInstance();
 
 $fachada->incluirExercicio($exercicio);*/
 
 //Teste Incluir Treino
//$instrutor = new Instrutor(7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
//$treino = new Treino(null, "corrida", "corrida na istera", $instrutor);
//$treino = new Treino(null, "corridor", "corridorrrrrrr na pista", $instrutor);
//$instrutor = new Instrutor(2, $coordenador, array(), array(), array(), "Marcelo Lopes", "123.456.654-23", "Rua teste", "myP@ssword01", "(81) 3438-3481", "MarceloLopes22", "marcelo_m.lopes2@hotmail.com");
 
//$fachada = new Fachada();

//$fachada = Fachada::getInstance();

//$controladorTreino = new ControladorTreino();
 /*try 
 {
     $fachada->incluirTreino($treino);
   //$treino = $controladorTreino->inserir($treino);
   //$instrutor = $controladorInstrutor->alterar($instrutor);
   echo "Treino inserido\n";
   //echo "Professor alterado\n";
 } 
 catch (Exception $exc) 
 {
    echo $exc->getMessage();
 }                
 */
 /*
  //Teste Listar Alunos
 $fachada = new Fachada();
 
 $fachada = Fachada::getInstance();
 
 $exercicio = new Exercicio(2, "", "", "");
 try {
    $listaExercicios = $fachada->detalharExercicio($exercicio);
    var_dump($listaExercicios);
} catch (Exception $exc) {
    echo $exc->getMessage();
}

 //Teste Incluir Alimento
 $nutricionista = new Nutricionista(9, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
//$treino = new Treino(null, "corrida", "corrida na istera", $instrutor);
$alimento = new Alimento(2,"Feijao", 11, 111, 1111, 11111, $nutricionista);
 
 
//$alimento = new Alimento(1,"Laranja", 2, 22, 222, 2222, $nutricionista);

$fachada = Fachada::getInstance();
//$controladorTreino = new ControladorTreino();
 try 
 {
    $listaAlimento = $fachada->detalharAlimento($alimento);
    var_dump($listaAlimento);
    //echo $fachada;
   //echo "Alimento inserido\n";
   //echo "Alimento alterado\n";
   // echo "Alimento excluido\n";
 } 
 catch (Exception $exc) 
 {
    echo $exc->getMessage();
 }
  */
//Teste Incluir Dica
 //$idDica, $descricao, $titulo
 /*$dica = new Dica(1,'teste dicaaaaa', 'titulo da dicaaaaaaa');
$fachada = Fachada::getInstance();
try {
    $listaDicas = $fachada->listarDica();*/
    //var_dump($listaDicas);
    //echo 'dica incluida';
    //echo 'dica alterada';
    //echo 'dica excluida';
/*} catch (Exception $exc) {
    echo $exc->getMessage();
}*/
 /*
 // Teste inserir treino
 $fachada = Fachada::getInstance();
 
 $exercicios = $fachada->listarExercicios();
 
 $instrutor = new Instrutor();
 $instrutor->setIdInstrutor(13);
 
 // $idTreino, $nome, $descricao, $instrutor, $listaExercicios, $series, $repeticoes
 $treino = new Treino(null, "treino teste três", "Descricao do treino teste três", $instrutor, $exercicios, 3, 10);
 
 $treino->setIdTreino(NULL);
 $treino->setNome("treino teste dois");
 $treino->setDescricao("descricao do treino teste dois");
 $treino->setInstrutor($instrutor);
 $treino->setListaExercicios($exercicios);
 $treino->setSeries(3);
 $treino->setRepeticoes(10);
 
 $fachada->inserirTreino($treino);
 
 echo 'Treino inserido com sucesso!!';
 */
 //Teste Incluir Noticia
 /*
    private $idNoticia;
    private $titulo;
    private $descricao;
    private $secretaria;
    */
 $secretaria  = new Secretaria(6);
 $noticia = new Noticia(null,'teste titulo','teste descricao',$secretaria);
$fachada = Fachada::getInstance();
try {
    $fachada->inserirNoticia($noticia);
    //$listaDicas = $fachada->listarDica();*/
    //var_dump($listaDicas);
    //echo 'dica incluida';
    //echo 'dica alterada';
    //echo 'dica excluida';
} catch (Exception $exc) {
    echo $exc->getMessage();
}
?>