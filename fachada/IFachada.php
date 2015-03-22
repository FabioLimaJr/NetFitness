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
    
    public function incluirTreino($treino);
    public function alterarTreino($treino);
    public function excluirTreino($treino);
    public function listarTreino();
    public function detalharTreino($treino);
    
    public function listarOpinioes();
    
    public function inserirAlimento($alimento);
    public function alterarAlimento($alimento);
    public function excluirAlimento($alimento);
    public function listarAlimentos();
    public function detalharAlimento($alimento);
    
    public function inserirDieta($dieta);
    public function alterarDieta($dieta);
    public function excluirDieta($dieta);
    public function listarDietas();
    public function detalharDieta($dieta);
    
    
    //Nutricionista
    public function inserirNutricionista($nutricionista);
    public function alterarNutricionista($nutricionista);
    public function excluirNutricionista($nutricionista);
    public function listarNutricionistas();
    public function detalharNutricionista($nutricionista);
    
    
}
