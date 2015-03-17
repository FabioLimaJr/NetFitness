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
}
