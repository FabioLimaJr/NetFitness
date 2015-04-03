<?php
/**
 *
 * @author Marcelo
 */
interface IFachada {
    
    public function incluirAluno($aluno);
    public function alterarAluno($aluno);    
    public function excluirAluno($aluno);
    public function listarAlunos();
    public function detalharAluno($aluno);
    
    public function incluirInstrutor($instrutor);
    public function alterarInstrutor($instrutor);
    public function excluirInstrutor($instrutor);
    public function listarInstrutores();
    public function detalharInstrutor($instrutor);
    
    public function incluirSecretaria($secretaria);
    public function alterarSecretaria($secretaria);
    public function excluirSecretaria($secretaria);
    public function listarSecretaria();
    public function detalharSecretaria($secretaria);
    
    public function logarCoordenador($coordenador);
    public function logarSecretaria($secretaria);
    public function logarAluno($aluno);
    public function logarInstrutor($instrutor);
    public function logarNutricionista($nutricionista);    
    
    public function inserirTreino($treino);
    public function alterarTreino($treino);
    public function excluirTreino($treino);
    public function listarTreino();
    public function detalharTreino($treino);
    
    //Opinião
    public function inserirOpiniao($opiniao);
    public function alterarOpiniao($opiniao);
    public function excluirOpiniao($opiniao);
    public function listarOpinioes();
    
    public function incluirAlimento($alimento);
    public function alterarAlimento($alimento);
    public function excluirAlimento($alimento);
    public function listarAlimentos();
    public function detalharAlimento($alimento);
    
    public function inserirDieta($dieta);
    public function alterarDieta($dieta);
    public function excluirDieta($dieta);
    public function listarDietas($nutricionista);
    public function detalharDieta($dieta);
    
    //Nutricionista
    public function inserirNutricionista($nutricionista);
    public function alterarNutricionista($nutricionista);
    public function excluirNutricionista($nutricionista);
    public function listarNutricionistas();
    public function detalharNutricionista($nutricionista);
    
    //pagamento
    public function inserirPagamento($pagamento);
    public function alterarPagamento($pagamento);
    public function excluirPagamento($pagamento);
    public function ListarPagamento();
    
    //Exercicio
    public function inserirExercicio($exercicio);
    public function alterarExercicio($exercicio);
    public function excluirExercicio($exercicio);
    public function listarExercicios();
    public function detalharExercicio($exercicio);
    
    //Exame Fisico
    public function inserirExameFisico($exameFisico);
    
    //Dica
    public function inserirDica($dica);
    public function alterarDica($dica);
    public function excluirDica($dica);
    public function listarDicas();
    public function detalharDica($dica);
}
