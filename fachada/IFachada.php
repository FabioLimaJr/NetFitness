<?php
/**
 *
 * @author Marcelo
 */
interface IFachada {
    
    
    public function detalharCoordenador($coordenador, $fetchType);
    
    public function inserirAluno($aluno);
    public function alterarAluno($aluno);    
    public function excluirAluno($aluno);
    public function listarAlunos($fetchType);
    public function detalharAluno($aluno,$fetchType);
    
    public function inserirInstrutor($instrutor);
    public function alterarInstrutor($instrutor);
    public function excluirInstrutor($instrutor);
    public function listarInstrutores($fetchType);
    public function detalharInstrutor($instrutor, $fetchType);
    
    public function inserirSecretaria($secretaria);
    public function alterarSecretaria($secretaria);
    public function excluirSecretaria($secretaria);
    public function listarSecretarias($fetchType);
    public function detalharSecretaria($secretaria,$fetchType);
    
    public function logarCoordenador($coordenador);
    public function logarSecretaria($secretaria);
    public function logarAluno($aluno);
    public function logarInstrutor($instrutor);
    public function logarNutricionista($nutricionista);    
    
    public function inserirTreino($treino);
    public function alterarTreino($treino);
    public function excluirTreino($treino);
    public function listarTreinos($instrutor, $fetchType);
    public function detalharTreino($treino, $fetchType);
    
    //Opinião
    public function inserirOpiniao($opiniao);
    public function alterarOpiniao($opiniao);
    public function excluirOpiniao($opiniao);
    public function listarOpinioes($aluno);
    
    public function inserirAlimento($alimento);
    public function alterarAlimento($alimento);
    public function excluirAlimento($alimento);
    public function listarAlimentos($fetchType);
    public function detalharAlimento($alimento,$fetchType);
    
    public function inserirDieta($dieta);
    public function alterarDieta($dieta);
    public function excluirDieta($dieta);
    public function listarDietas($pessoa, $fetchType);
    public function detalharDieta($dieta,$fetchType);
    
    //Nutricionista
    public function inserirNutricionista($nutricionista);
    public function alterarNutricionista($nutricionista);
    public function excluirNutricionista($nutricionista);
    public function listarNutricionistas($fetchType);
    public function detalharNutricionista($nutricionista, $fetchType);
    
    //pagamento
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
    public function listarExamesFisicos($fetchType);
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
}
