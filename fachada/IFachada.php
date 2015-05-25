<?php
/**
 *
 * @author Marcelo
 */
interface IFachada 
{
       
    //Pessoa
    public function conferirLoginSenha($pessoa);
    
    //Coordenador
    public function logarCoordenador($coordenador);
    public function detalharCoordenador($coordenador, $fetchType);
    
    //Aluno
    public function inserirAluno($aluno);
    public function alterarAluno($aluno);    
    public function excluirAluno($aluno);
    public function listarAlunos($fetchType);
    public function detalharAluno($aluno,$fetchType);
    public function logarAluno($aluno);
   
    //Instrutor
    public function inserirInstrutor($instrutor);
    public function alterarInstrutor($instrutor);
    public function excluirInstrutor($instrutor);
    public function listarInstrutores($fetchType);
    public function detalharInstrutor($instrutor, $fetchType);
    public function logarInstrutor($instrutor);
    
    //Secretária
    public function inserirSecretaria($secretaria);
    public function alterarSecretaria($secretaria);
    public function excluirSecretaria($secretaria);
    public function listarSecretarias($fetchType);
    public function detalharSecretaria($secretaria,$fetchType);
    public function logarSecretaria($secretaria);
    
    //Nutricionista
    public function inserirNutricionista($nutricionista);
    public function alterarNutricionista($nutricionista);
    public function excluirNutricionista($nutricionista);
    public function listarNutricionistas($fetchType);
    public function detalharNutricionista($nutricionista, $fetchType);
    public function logarNutricionista($nutricionista); 

    //Treino
    public function inserirTreino($treino);
    public function alterarTreino($treino);
    public function excluirTreino($treino);
    public function listarTreinos($instrutor, $fetchType);
    public function detalharTreino($treino, $fetchType);
    public function vincularTreinoAlunos($treino, $listaAlunos, $qtdTreinos);
    public function listarTreinoPorAluno($aluno, $fetchType);
    public function listarTreinosRealizados($aluno, $treino);
    
    //Opinião
    public function inserirOpiniao($opiniao);
    public function alterarOpiniao($opiniao);
    public function excluirOpiniao($opiniao);
    public function listarOpinioes($aluno);
     
    //Alimento
    public function inserirAlimento($alimento);
    public function alterarAlimento($alimento);
    public function excluirAlimento($alimento);
    public function listarAlimentos($fetchType);
    public function detalharAlimento($alimento,$fetchType);
    
    //Dieta
    public function inserirDieta($dieta);
    public function alterarDieta($dieta);
    public function excluirDieta($dieta);
    public function listarDietas($pessoa, $fetchType);
    public function detalharDieta($dieta,$fetchType);
    
    //Pagamento
    public function inserirPagamento($pagamento);
    public function alterarPagamento($pagamento);
    public function excluirPagamento($pagamento);
    public function listarPagamentos($fetchType);
    public function detalharPagamento($pagamento, $fetchType);
       
    //Exercicio
    public function inserirExercicio($exercicio);
    public function alterarExercicio($exercicio);
    public function excluirExercicio($exercicio);
    public function listarExercicios();
    public function detalharExercicio($exercicio);
      
    //Exame Fisico
    public function inserirExameFisico($exameFisico);
    public function listarExamesFisicos($pessoa, $fetchType);
    public function detalharExameFisico($exameFisico, $fetchType);
      
    //Dica
    public function inserirDica($dica, $pessoa);
    public function alterarDica($dica);
    public function excluirDica($dica);
    public function listarDicas($pessoa);
    public function detalharDica($dica);
    
    //Musica
    public function listarMusicas($fetchType);
    public function detalharMusica($musica, $fetchType);
    public function inserirMusica($musica);
    public function alterarMusica($musica);
    public function excluirMusica($musica);
    
    //Noticia
    public function inserirNoticia($noticia);
    public function alterarNoticia($noticia);    
    public function excluirNoticia($noticia);
    public function listarNoticia($secretaria,$fetchType);
    public function detalharNoticia($noticia,$fetchType);
       
}
